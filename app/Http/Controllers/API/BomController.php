<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BomRequest;
use App\Http\Resources\ArrayResource;
use Illuminate\Http\Request;
use App\Models\Bom;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierGood;

class BomController extends Controller
{
    public function index(Request $request)
    {
        dd($request);
        if ($request->search) return ArrayResource::collection(Bom::where("name", 'like', '%' . $request->search . '%')->paginate(8));
        if (!$request->search) return ArrayResource::collection(Bom::paginate(8));
    }

    public function store(BomRequest $request)
    {
        dd($request);
        $bom = Bom::create($request->validated());

        return new ArrayResource($bom);
    }

    public function show(Bom $bom)
    {
        dd($bom);
        return new ArrayResource($bom);
    }

    public function update(BomRequest $request, Bom $bom)
    {
        $bom->update($request->validated());

        return new ArrayResource($bom);
    }

    public function destroy(Bom $bom)
    {
        $bom->delete();

        return response()->noContent();
    }

    public function getBomDetail($id) {
        $datas = Product::join('boms', 'boms.id_product', '=', 'products.id')
                        ->join('supplier_goods', 'supplier_goods.id', '=', 'boms.id_supplier_good')
                        ->join('suppliers', 'suppliers.id', '=', 'supplier_goods.supplier_id')
                        ->orderBy('product_name')
                        ->where('products.id', $id)
                        ->get(['products.name as product_name', 'suppliers.name as supplier_name', 'supplier_goods.name as supplier_product', 'boms.qty']);

        $data = [];
        foreach ($datas as $key => $value) {
            $data["product_name"] = $value["product_name"];
            $data["suppliers"][$key]["name"] = $value["supplier_name"];
            $data["suppliers"][$key]["barang"] = $value["supplier_product"];
            $data["suppliers"][$key]["qty"] = $value["qty"];
        }

        return response()->json(['data' => $data], 200);
    }
}
