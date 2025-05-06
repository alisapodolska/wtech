<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        // Fetch cart items for the authenticated user
        $cart = Cart::where('user_id', Auth::id())
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

        return view('cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        if (!Auth::check()) {
            return $request->expectsJson()
                ? response()->json(['error' => 'Please log in to add items to your cart'], 401)
                : redirect()->route('login')->with('error', 'Please log in to add items to your cart.');
        }

        $request->validate([
            'quantity' => 'nullable|integer|min:1|max:20',
        ]);

        $product = Product::findOrFail($id);
        $quantity = (int) $request->input('quantity', 1);
        $quantity = min($quantity, 20); // Limit to 20

        // Find or create cart item
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        try {
            if ($cartItem) {
                // Update existing cart item
                $cartItem->quantity = min($cartItem->quantity + $quantity, 20);
                $cartItem->total_price = $cartItem->quantity * $product->price;
                $cartItem->save();
            } else {
                // Create new cart item
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quantity' => $quantity,
                    'total_price' => $quantity * $product->price,
                ]);
            }
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Failed to add product to cart: ' . $e->getMessage());
            return $request->expectsJson()
                ? response()->json(['error' => 'Failed to add product to cart'], 500)
                : redirect()->back()->with('error', 'Failed to add product to cart.');
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Product added to cart']);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, $id)
    {
        if (!Auth::check()) {
            return response()->json(['success' => false, 'error' => 'Please log in to update your cart'], 401);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1|max:20',
        ]);

        $quantity = min(max((int) $request->input('quantity', 1), 1), 20); // Clamp between 1–20

        // Find the cart item
        $cartItem = Cart::where('user_id', Auth::id())
            ->where('product_id', $id)
            ->first();

        if ($cartItem) {
            try {
                // Update quantity and total price
                $cartItem->quantity = $quantity;
                $cartItem->total_price = $quantity * $cartItem->product->price;
                $cartItem->save();

                // Calculate subtotal
                $subtotal = Cart::where('user_id', Auth::id())
                    ->with('product')
                    ->get()
                    ->sum(function ($item) {
                        return $item->quantity * $item->product->price;
                    });

                return response()->json([
                    'success' => true,
                    'newPrice' => number_format($cartItem->total_price, 2),
                    'subtotal' => number_format($subtotal, 2),
                ]);
            } catch (\Exception $e) {
                \Log::error('Failed to update cart: ' . $e->getMessage());
                return response()->json(['success' => false, 'error' => 'Failed to update cart'], 500);
            }
        }

        return response()->json(['success' => false, 'error' => 'Cart item not found'], 404);
    }

    public function remove($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Please log in to remove items from your cart.');
        }

        try {
            // Delete the cart item
            Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove product from cart.');
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }
}