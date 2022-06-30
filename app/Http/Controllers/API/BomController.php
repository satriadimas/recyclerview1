<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ArrayResource;
use Illuminate\Http\Request;
use App\Models\Bom;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplierGood;

class BomController extends Controller
{
    public function store(Request $request)
    {
        $id_product = $request->id_product;
        $id_supplier_good = $request->id_supplier_good;
        $qty = $request->qty;

        
        $data = [];
        
        foreach ($id_supplier_good as $key => $value) {
            array_push($data, ["id_product"=>$id_product, "id_supplier_good"=>$value, "qty"=>$qty] );
        }
        
        $bom = Bom::insert($data);

        return response()->json(['data' => $data], 200);
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
                        ->get(['boms.id', 'products.name as product_name', 'suppliers.name as supplier_name', 'supplier_goods.name as supplier_product', 'boms.qty']);
        $data = [];
        foreach ($datas as $key => $value) {
            $data["product_name"] = $value["product_name"];
            $data["suppliers"][$key]["id"] = $value["id"];
            $data["suppliers"][$key]["name"] = $value["supplier_name"];
            $data["suppliers"][$key]["barang"] = $value["supplier_product"];
            $data["suppliers"][$key]["qty"] = $value["qty"];
        }

        return response()->json(['data' => $data], 200);
    }
}
