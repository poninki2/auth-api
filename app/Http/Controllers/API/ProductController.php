<?php

namespace App\Http\Controllers\API;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->has('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%")
                    ->orWhereJsonContains('tags', $search);
            });
        }

        return response()->json($query->orderBy('name')->get());
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric',
            'image' => 'required|string',
            'images' => 'nullable|array',
            'category' => 'required|string',
            'in_stock' => 'boolean',
            'rating' => 'nullable|numeric',
            'reviews' => 'nullable|integer',
            'featured' => 'boolean',
            'tags' => 'nullable|array',
        ]);

        $product = Product::create($data);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string',
            'description' => 'sometimes|nullable|string',
            'price' => 'sometimes|numeric',
            'original_price' => 'sometimes|nullable|numeric',
            'image' => 'sometimes|string',
            'images' => 'sometimes|nullable|array',
            'category' => 'sometimes|string',
            'in_stock' => 'sometimes|boolean',
            'rating' => 'sometimes|numeric',
            'reviews' => 'sometimes|integer',
            'featured' => 'sometimes|boolean',
            'tags' => 'sometimes|nullable|array',
        ]);

        $product->update($data);

        return response()->json(['success' => true, 'product' => $product]);
    }

    public function destroy($id)
    {
        Product::destroy($id);
        return response()->json(['success' => true]);
    }
}
