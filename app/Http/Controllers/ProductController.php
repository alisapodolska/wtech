<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

        if ($request->has('min_price') || $request->has('max_price')) {
            $min = max(0, (int) $request->input('min_price', 0)); // Ensure min is not negative
            $max = min(150, (int) $request->input('max_price', 150)); // Cap max at 150
            // Ensure min is not greater than max
            if ($min > $max) {
                [$min, $max] = [$max, $min]; // Swap values if needed
            }
            $query->whereBetween('price', [$min, $max]);
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

        if ($request->has('min_price') || $request->has('max_price')) {
            $min = $request->input('min_price', 0);
            $max = $request->input('max_price', 150);
            $query->whereBetween('price', [$min, $max]);
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

    public function adminIndex()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('admin', compact('products')); // Pass products to the admin view
    }

    public function store(Request $request)
    {
        // Log the start of the method
        Log::info('Starting ProductController@store method');

        // Log the incoming request data
        Log::info('Incoming request data:', $request->all());

        // Validate the request
        Log::info('Validating request data');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:150',
            'description' => 'required|string',
            'image1' => 'required|url',
            'image2' => 'required|url',
            'volume' => 'nullable|string|max:100',
            'ingredients' => 'nullable|string',
            'type' => 'nullable|string|max:100',
        ]);

        // Log the validated data
        Log::info('Validated data:', $validated);

        try {
            // Log before creating the product
            Log::info('Attempting to create Product with data:', $validated);

            // Create the product
            Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'image1' => $validated['image1'],
                'image2' => $validated['image2'],
                'volume' => $validated['volume'] ?? null,
                'ingredients' => $validated['ingredients'] ?? null,
                'scent' => $validated['scent'] ?? null,
                'type' => $validated['type'] ?? null,
            ]);

            // Log success
            Log::info('Product created successfully');

            // Redirect back with success message
            return redirect()->route('admin')->with('success', 'Product added successfully!');
        } catch (\Exception $e) {
            // Log the error details
            Log::error('Error creating product: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());

            // Redirect back with error message
            return redirect()->route('admin')->with('error', 'Failed to add product. Error: ' . $e->getMessage());
        }
    }

    public function update(Request $request, Product $product)
    {
        Log::info('Starting ProductController@update method for product ID: ' . $product->id);
        Log::info('Incoming request data:', $request->all());

        Log::info('Validating request data');
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0|max:150',
            'description' => 'required|string',
            'image1' => 'required|url',
            'image2' => 'required|url',
            'volume' => 'nullable|string|max:100',
            'type' => 'nullable|in:Eau de Parfum,Eau de Toilette,Body Lotion,Castile Soap',
        ]);

        Log::info('Validated data:', $validated);

        try {
            Log::info('Attempting to update Product with data:', $validated);

            $product->update([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'image1' => $validated['image1'],
                'image2' => $validated['image2'],
                'volume' => $validated['volume'] ?? null,
                'scent' => $validated['scent'] ?? null,
                'type' => $validated['type'] ?? null,
            ]);

            Log::info('Product updated successfully');
            return redirect()->route('admin')->with('success', 'Product updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating product: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('admin')->with('error', 'Failed to update product. Error: ' . $e->getMessage());
        }
    }

    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return redirect()->route('admin')->with('success', 'Product deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            return redirect()->route('admin')->with('error', 'Failed to delete product. Error: ' . $e->getMessage());
        }
    }
}
