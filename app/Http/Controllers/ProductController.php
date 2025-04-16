<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('volume')) {
            $query->whereIn('volume', $request->input('volume'));
        }

        if ($request->has('category')) {
            $query->whereIn('scent', $request->input('category'));
        }

        if ($request->has('type')) {
            $query->where('type', $request->input('type'));
        }

        if ($request->has('price')) {
            $query->where('price', '<=', $request->input('price'));
        }

        $products = $query->get();
        return view('catalog', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);

        $relatedProducts = Product::where('scent', $product->scent)
            ->where('id', '!=', $product->id)
            ->take(3)
            ->get();

        return view('product-desc', compact('product', 'relatedProducts'));
    }
}
