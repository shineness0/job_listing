<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index() {
        $products = Product::get();

        if($products->count() > 0) {
            return ProductResource::collection($products);
        } else {
            return Response::json(['message' => 'No record available'], 200);
        }
    }

    public function store(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'description' => 'required',
        'price' => 'required|integer',
    ]);

    if($validator->fails()) {
        return Response::json([
            'error' => 'All fields are required'
        ], 400);
    }

    $product = Product::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
    ]);

    return response()->json([
        'message' => 'Product created successfully',
        'data' => new ProductResource($product)
    ], 201);
}

public function show($id) {
    $product = Product::find($id);
    if($product) {
        return new ProductResource($product);
    } else {
        return Response::json(['message' => 'Product not found'], 404);
    }
}

public function update(Request $request, Product $product) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'description' => 'required',
        'price' => 'required|integer',
    ]);

    if($validator->fails()) {
        return Response::json(['error' => $validator->messages()], 400);
    }

    try {
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => __('Product updated successfully'),
            'data' => new ProductResource($product)
        ], 200);
    } catch (\Exception $e) {
        return Response::json(['error' => __('Failed to update product')], 500);
    }
}

public function destroy(Product $product) {
    $product->delete();
    return Response::json(['message' => 'Product deleted successfully'], 200);
}
}