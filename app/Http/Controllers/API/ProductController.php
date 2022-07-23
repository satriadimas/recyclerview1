<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ArrayResource;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Bom;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) return ArrayResource::collection(Product::where("name", 'like', '%' . $request->search . '%')->paginate(20));
        if (!$request->search) return ArrayResource::collection(Product::paginate(12));
    }
    
    public function productOptions(Request $request)
    {
        $data = [];
        $list = Product::where("name", 'like', '%' . $request->search . '%')->limit(5)->get(['products.id as value', 'products.name as label']);

        foreach ($list as $key => $value) {
            $bom = Bom::where('id_product', $value['value'])->get();
            if (count($bom) > 0) {
                array_push($data, $value);
            }
        }
        return $data;
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
        $id_product = $product["id"];
        if ($product->delete()) {
            $bom = Bom::where("id_product", $id_product);
            $bom->delete();
        }

        return response()->noContent();
    }
}
