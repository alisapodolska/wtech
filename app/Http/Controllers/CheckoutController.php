<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class CheckoutController extends Controller
{
    public function confirmPayment(Request $request)
    {
        $paymentMethod = $request->input('payment_method');
    
        $rules = [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'country' => 'required|string',
            'address' => 'required|string',
            'city' => 'required|string',
            'zip' => 'required|string',
            'phone' => 'required|string',
            'payment_method' => 'required|in:card,crypto,paypal',
        ];
    
        if ($paymentMethod === 'card') {
            $rules = array_merge($rules, [
                'card_name' => 'required|string',
                'card_number' => 'required|digits_between:13,19',
                'card_expiry' => 'required|regex:/^(0[1-9]|1[0-2])\/\d{2}$/',
                'card_cvv' => 'required|digits:3',
            ]);
        }
    
        $validator = Validator::make($request->all(), $rules);
    
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
    
        return back()->with('success', 'Payment method confirmed. You can now place your order.');
    }

    public function index()
    {
        $cartItems = session()->get('cart', []);
        
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
        $subtotal = $request->input('subtotal');
        
        $cartItems = session()->get('cart', []);
        
        if (empty($cartItems)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $totalAmount = collect($cartItems)->sum(fn($item) => $item['price'] * $item['quantity']);
        
        $delivery = 12.00;
        
        $totalAmount += $delivery;

        return view('checkout', compact('cartItems', 'subtotal', 'delivery', 'totalAmount'));
    }

    public function placeOrder(Request $request)
    {
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        $order = Order::create([
            'user_id' => auth()->id(),
            'total_amount' => collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']),
            'status' => 'pending',
        ]);

        foreach ($cart as $item) {
            $order->items()->create([
                'product_id' => $item['id'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('order.success');
    }

    public function showCheckout()
    {
        $cartItems = Cart::getContent();
    
        $subtotal = (float) $cartItems->sum(function($item) {
            return $item->price * $item->quantity;
        });
    
        $delivery = 12.00;
    
        $totalAmount = (float) ($subtotal + $delivery);
    
        return view('checkout', compact('cartItems', 'subtotal', 'delivery', 'totalAmount'));
    }
}
