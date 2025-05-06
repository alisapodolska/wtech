<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $cartItems = Cart::where('user_id', Auth::id())
                ->with('product')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->product_id => [
                        'name' => $item->product->name,
                        'price' => $item->product->price,
                        'quantity' => $item->quantity,
                        'image' => $item->product->image1,
                        'volume' => $item->product->volume,
                    ]];
                })->toArray();
        } else {
            $cartItems = session()->get('cart', []);
        }

        return view('cart', ['cart' => $cartItems]);
    }

    public function add(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $quantity = min((int) $request->input('quantity', 1), 20);

            if (Auth::check()) {
                $cartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $id)
                    ->first();

                if ($cartItem) {
                    $cartItem->quantity = min($cartItem->quantity + $quantity, 20);
                    $cartItem->save();
                } else {
                    Cart::create([
                        'user_id' => Auth::id(),
                        'product_id' => $id,
                        'quantity' => $quantity,
                    ]);
                }
            } else {
                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    $cart[$id]['quantity'] = min($cart[$id]['quantity'] + $quantity, 20);
                } else {
                    $cart[$id] = [
                        'name' => $product->name,
                        'price' => $product->price,
                        'quantity' => $quantity,
                        'image' => $product->image1,
                        'volume' => $product->volume,
                    ];
                }

                session()->put('cart', $cart);
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Product added to cart']);
            }

            return redirect()->back();
        } catch (QueryException $e) {
            \Log::error('Database error adding product to cart: ' . $e->getMessage(), ['product_id' => $id, 'user_id' => Auth::id()]);
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Database error: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Could not add product to cart.');
        } catch (\Exception $e) {
            \Log::error('Error adding product to cart: ' . $e->getMessage(), ['product_id' => $id, 'user_id' => Auth::id()]);
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Server error: ' . $e->getMessage()], 500);
            }
            return redirect()->back()->with('error', 'Could not add product to cart.');
        }
    }

    public function update(Request $request, $id)
    {
        $quantity = min(max((int) $request->input('quantity', 1), 1), 20);

        if (Auth::check()) {
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = $quantity;
                $cartItem->save();

                $updatedPrice = $cartItem->product->price * $quantity;
                $subtotal = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get()
                    ->sum(fn($item) => $item->product->price * $item->quantity);

                return response()->json([
                    'success' => true,
                    'newPrice' => number_format($updatedPrice, 2),
                    'subtotal' => number_format($subtotal, 2),
                ]);
            }
        } else {
            $cart = session()->get('cart', []);

            if (isset($cart[$id])) {
                $cart[$id]['quantity'] = $quantity;
                session()->put('cart', $cart);

                $updatedPrice = $cart[$id]['price'] * $quantity;
                $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);

                return response()->json([
                    'success' => true,
                    'newPrice' => number_format($updatedPrice, 2),
                    'subtotal' => number_format($subtotal, 2),
                ]);
            }
        }

        return response()->json(['success' => false], 404);
    }

    public function remove($id)
    {
        if (Auth::check()) {
            Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->back();
    }
}