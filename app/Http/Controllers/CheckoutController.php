<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\OrderInfo;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function confirmPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');

        $rules = [
            'customer_name' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:card,after_delivery,paypal',
        ];

        if ($paymentMethod === 'card') {
            $rules = array_merge($rules, [
                'card_name' => 'required|string',
                'card_number' => ['required', 'regex:/^\d{16}$/'],
                'card_expiry' => ['required', 'regex:/^(0[1-9]|1[0-2])\/\d{2}$/'],
                'card_cvv' => 'required|digits:3',
            ]);
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Payment method confirmed. You can now place your order.'
        ]);
    }

    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->mapWithKeys(function ($item) {
                    if (!$item->product) {
                        \Log::warning('Product not found for cart item', ['product_id' => $item->product_id]);
                        return [];
                    }
                    return [$item->product_id => [
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'image' => $item->product->image1,
                        'volume' => $item->product->volume,
                    ]];
                })->filter()->toArray();
        } else {
            $cartItems = session()->get('cart', []);
        }

        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $delivery = 12.00;
        $totalAmount = $subtotal + $delivery;

        return view('checkout', compact('cartItems', 'subtotal', 'delivery', 'totalAmount'));
    }

    public function checkout(Request $request)
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->mapWithKeys(function ($item) {
                    if (!$item->product) {
                        \Log::warning('Product not found for cart item', ['product_id' => $item->product_id]);
                        return [];
                    }
                    return [$item->product_id => [
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'image' => $item->product->image1,
                        'volume' => $item->product->volume,
                    ]];
                })->filter()->toArray();
        } else {
            $cartItems = session()->get('cart', []);
        }

        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $subtotal = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        $delivery = 12.00;
        $totalAmount = $subtotal + $delivery;

        return view('checkout', compact('cartItems', 'subtotal', 'delivery', 'totalAmount'));
    }

    public function placeOrder(Request $request)
    {
        \Log::info('Received order request with data:', $request->all());

        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->mapWithKeys(function ($item) {
                    if (!$item->product) {
                        \Log::warning('Product not found for cart item', ['product_id' => $item->product_id]);
                        return [];
                    }
                    return [$item->product_id => [
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'image' => $item->product->image1,
                        'volume' => $item->product->volume,
                    ]];
                })->filter()->toArray();
        } else {
            $cart = session()->get('cart', []);
        }

        if (empty($cart)) {
            return response()->json(['success' => false, 'message' => 'Cart is empty']);
        }

        try {
            DB::beginTransaction();

            // Calculate totals
            $totalPrice = (float) collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
            $totalAmount = (int) collect($cart)->sum(fn($item) => $item['quantity']);

            // Create the order
            $order = Order::create([
                'user_id' => auth()->check() ? auth()->id() : null,
                'date' => now(),
                'status' => 'pending',
                'total_price' => number_format($totalPrice, 2, '.', ''),
                'total_amount' => $totalAmount,
                'created_at' => now()
            ]);

            // Format phone number if phone code is provided
            $phone = $request->input('phone');
            if ($request->has('phone_code')) {
                $phone = $request->input('phone_code') . $phone;
            }

            // Create order info
            $orderInfo = OrderInfo::create([
                'order_id' => $order->id,
                'phone' => $phone,
                'email' => $request->input('email'),
                'customer_name' => $request->input('customer_name'),
                'country' => $request->input('country'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'payment_method' => $request->input('payment_method')
            ]);

            foreach ($cart as $productId => $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'quantity' => $item['quantity'],
                    'price' => number_format($item['price'], 2, '.', '')
                ]);
            }

            // Clear the cart
            if (Auth::check()) {
                Cart::where('user_id', Auth::id())->delete();
            } else {
                session()->forget('cart');
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully',
                'order_id' => $order->id
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'An error occurred while placing your order: ' . $e->getMessage()
            ]);
        }
    }

    public function showCheckout()
    {
        $cartItems = Cart::getContent();

        $subtotal = (float) $cartItems->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $delivery = 12.00;

        $totalAmount = (float) ($subtotal + $delivery);

        return view('checkout', compact('cartItems', 'subtotal', 'delivery', 'totalAmount'));
    }

    public function showProfile()
    {
        $user = auth()->user();
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('myProfile', compact('orders'));
    }
}