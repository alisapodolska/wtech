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

        $sort = $request->query('sort', 'asc'); // Default to ascending (high to low)
        $sort = in_array($sort, ['asc', 'desc']) ? $sort : 'asc'; // Validate sort parameter
        $query->orderBy('price', $sort);

        $products = $query->paginate(12)->appends($request->query());

        // Pass sort parameter to the view
        return view('catalog', compact('products', 'sort'));
    }

    public function search(Request $request)
    {
        $query = Product::query();

        if ($request->has('query')) {
            $query->where('name', 'like', $request->input('query') . '%');
        }

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

        $sort = $request->query('sort', 'asc'); // Default to ascending (high to low)
        $sort = in_array($sort, ['asc', 'desc']) ? $sort : 'asc'; // Validate sort parameter
        $query->orderBy('price', $sort);

        $products = $query->paginate(12)->appends($request->query());

        return view('search', compact('products', 'sort'));
    }

    public function search_live(Request $request)
    {
        $query = $request->input('query');

        $products = [];

        if ($query) {
            $products = Product::whereRaw('LOWER(name) LIKE ?', [strtolower($query) . '%'])
                ->get(['id', 'name']);
        }

        return response()->json($products);
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
