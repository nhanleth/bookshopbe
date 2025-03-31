<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'publish_year' => 'required|string|max:4',
            'isbn' => 'required|string|max:13',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|max:2048', // Validate image
            'stock' => 'required|integer|min:0',
        ]);

        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path;
        }

        $product = Product::create($data);
        return response()->json($product, 201);
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product, 200);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'category_id' => 'sometimes|required|exists:categories,id',
            'description' => 'nullable|string',
            'publish_year' => 'sometimes|required|string|max:4',
            'isbn' => 'sometimes|required|string|max:13',
            'price' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|image|max:2048', // Validate image
            'stock' => 'sometimes|required|integer|min:0',
        ]);

        $product = Product::findOrFail($id);
        $data = $request->all();

        // Handle image upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $data['image'] = $path; // Store the path in the database
        }

        $product->update($data);
        return response()->json($product, 200);
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        return response()->json(null, 204);
    }

    public function getProducts()
    {
        $products = Product::all();
        return response()->json($products, 200);
    }

    public function getProductById($id)
    {
        $product = Product::findOrFail($id);
        $product->image = Storage::url($product->image);
        $productCategoryName = $product->category->name;
        return response()->json([
            'product' => $product,
            'category_name' => $productCategoryName
        ], 200);
    }
}