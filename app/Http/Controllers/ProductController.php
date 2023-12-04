<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\SingleProductResource;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    // auth all function except index and show
    public function __construct(){
        $this->middleware('auth:sanctum')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Retrieve all products from the database and paginate the results
        $products = Product::paginate(10);

        // Return a collection of product resources
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // create new product
        $product = Product::create($request->toArray());

        return response()->json([
            'message' => 'Product created successfully',
            'product' => new SingleProductResource($product),
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        // get single product
        return new SingleProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        // update product data but not slug (best practice)
        // $product->update($request->toArray());

        // update product data and slug
        $attributes = $request->toArray();
        $attributes['slug'] = Str::slug($request->name);
        $product->update($attributes);

        return response()->json([
            'message' => 'Product updated successfully',
            'product' => new SingleProductResource($product),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // deleted product
        $product->delete();

        return response()->json([
            'message' => 'Product was deleted successfully'
        ]);
    }
}
