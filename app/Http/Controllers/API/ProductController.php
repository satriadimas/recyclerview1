<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ArrayResource;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) return ArrayResource::collection(Product::where("name", 'like', '%' . $request->search . '%')->paginate(8));
        if (!$request->search) return ArrayResource::collection(Product::paginate(8));
    }

    public function store(ProductRequest $request)
    {
        $product = Product::create($request->validated());

        return new ArrayResource($product);
    }

    public function show(Product $product)
    {
        return new ArrayResource($product);
    }

    public function update(ProductRequest $request, Product $product)
    {
        $product->update($request->validated());

        return new ArrayResource($product);
    }

    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }
}
