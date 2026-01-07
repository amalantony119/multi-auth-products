<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index()
    {
        return Product::all();
    }

    // Store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'price'    => 'required|numeric',
            'category' => 'required|string',
            'stock'    => 'required|integer',
            'image'    => 'nullable|image',
        ]);

        // ✅ IMAGE HANDLING GOES HERE
        $image = $request->file('image')
            ? $request->file('image')->store('products', 'public')
            : 'products/default.png';

        Product::create([
            'name'     => $data['name'],
            'price'    => $data['price'],
            'category' => $data['category'],
            'stock'    => $data['stock'],
            'image'    => $image,
        ]);

        return redirect()->back()->with('success', 'Product created');
    }

    // Update existing product
    public function update(Request $request, Product $product)
    {
        $data = $request->validate([
            'name'     => 'required|string',
            'price'    => 'required|numeric',
            'category' => 'required|string',
            'stock'    => 'required|integer',
            'image'    => 'nullable|image',
        ]);

        // ✅ IMAGE HANDLING GOES HERE TOO
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('products', 'public');
        } else {
            $image = $product->image; // keep old image
        }

        $product->update([
            'name'     => $data['name'],
            'price'    => $data['price'],
            'category' => $data['category'],
            'stock'    => $data['stock'],
            'image'    => $image,
        ]);

        return redirect()->back()->with('success', 'Product updated');
    }
}
