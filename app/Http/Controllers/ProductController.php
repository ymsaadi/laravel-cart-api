<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Get All Products
    public function index() {
        return ProductResource::collection(Product::all());
    }

    // Get a Product
    public function find($id) {
        return new ProductResource(Product::findOrFail($id));
    }

    // Post a Product
    public function store(Request $request) {
        $product = Product::create([
            'description' => $request->description,
            'image_urls' => $request->image_urls,
            'price' => $request->price,
        ]);
    }

    // Update a Product
    public function update($id, Request $request) {
        // $product = Product::find($id);
        $product = Product::updateOrCreate(
            ['id' => $id],
            [
                'description' => $request->description,
                'image_urls' => $request->image_urls,
                'price' => $request->price,
            ]
        );
    }

    // Delete a Product
    public function delete($id) {
        $product = Product::destroy($id);
    }
}
