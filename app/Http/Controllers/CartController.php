<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        $quantity = (int) $request->input('quantity', 1);
        $quantity = min($quantity, 20); // 👈 limit to 20

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

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Product added to cart']);
        }

        return redirect()->back(); // fallback for non-AJAX
    }

    public function update(Request $request, $id)
    {
        $quantity = min(max((int) $request->input('quantity', 1), 1), 20); // Clamp between 1–20

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

        return response()->json(['success' => false], 404);
    }

    public function remove($id) {
        $cart = session('cart', []);
        unset($cart[$id]);
        session(['cart' => $cart]);
        return redirect()->back();
    }
}