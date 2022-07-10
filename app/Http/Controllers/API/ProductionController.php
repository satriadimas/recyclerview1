<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\ArrayResource;
use App\Models\Bom;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Production;
use App\Models\SupplierGood;
use App\Models\PoCalculation;
use PDF;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        if ($request->search) return ArrayResource::collection(Production::select("productions.id", "products.name", "productions.qty", "productions.date")->join('products', 'productions.id_product', '=', 'products.id')->where("products.name", 'like', '%' . $request->search . '%')->paginate(12));
        if (!$request->search) return ArrayResource::collection(Production::select("productions.id", "products.name", "productions.qty", "productions.date")->join('products', 'productions.id_product', '=', 'products.id')->paginate(12));
    }

    public function store(Request $request)
    {
        $id_product = $request->id_product;
        $qty = $request->qty;
        $date = $request->date;

        $data = [];

        for ($i=0; $i < count($id_product); $i++) { 
            $production = Production::insert(["id_product"=>$id_product[$i], "qty"=>$qty[$i], "date"=>$date]);
            $data[$i]["id_production"] = Production::latest('id')->value('id');

            $bom = Bom::where("id_product", $id_product[$i])->get();
            foreach ($bom as $key => $value) {
                
                $data[$i]["id_bom"][$key] = $value["id"];
            }
        }

        $insert_po = [];
        $no = 0;
        foreach ($data as $key => $value) {
            foreach ($value["id_bom"] as $x => $val) {
                $insert_po[$no]["id_production"] = $value["id_production"];
                $insert_po[$no]["id_bom"] = $val;
                $no++;
            }
        }

        
        $po = PoCalculation::insert($insert_po);

        return response()->noContent();
    }

    public function show(Production $production)
    {
        $data = $production->join('products', 'productions.id_product', '=', 'products.id')->first();
        return new ArrayResource($data);
    }

    public function destroy(Production $production)
    {
        $id_production = $production["id"];
        if ($production->delete()) {
            $po = PoCalculation::where("id_production", $id_production);
            $po->delete();
        }

        return response()->noContent();
    }

    public function getCalPo($supplier_id, Request $request) {
        $po = PoCalculation::select("supplier_goods.id as id","suppliers.name AS supplier", "supplier_goods.name AS material")
                            ->join('productions', 'productions.id', '=', 'po_calculations.id_production')
                            ->join('boms', 'boms.id', '=', 'po_calculations.id_bom')
                            ->join('supplier_goods', 'supplier_goods.id', '=', 'boms.id_supplier_good')
                            ->join('suppliers', 'suppliers.id', '=', 'supplier_goods.supplier_id')
                            ->where("suppliers.id", $supplier_id)->whereYear('date', $request->year)
                            ->groupBy("supplier_goods.id")
                            ->get();

        $data = [];

        foreach ($po as $key => $value) {

            $month = [];
            for ($i=1; $i <= 12; $i++) { 
                $bomProd = DB::table('boms')
                            ->selectRaw("ifnull(SUM(boms.qty),0) * ifnull(SUM(productions.qty),0) AS production")
                            ->join('productions', 'productions.id_product', '=', 'boms.id_product')
                            ->where('boms.id_supplier_good', $value->id)
                            ->whereYear('productions.date', $request->year)
                            ->whereMonth('productions.date', $i)
                            ->get();
                
                $matinout = DB::table('material_ins')
                            ->selectRaw("ifnull(SUM(material_ins.qty),0) as incoming, ifnull(SUM(material_outs.qty),0) as outgoing")
                            ->leftJoin('material_outs', 'material_outs.id_materials', '=', 'material_ins.id_materials')
                            ->where('material_ins.id_materials', $value->id)
                            ->whereMonth('material_ins.date', $i)
                            ->get();

                $poList = DB::table('po_lists')
                            ->selectRaw("IFNULL(SUM(qty), 0) as qty")
                            ->where('id_supplier_good', $value->id)
                            ->whereMonth('delivery_date', $i)
                            ->get();
                
                array_push($month, ["month"=>$i, "production"=>$bomProd[0]->production, "qty_po"=>$poList[0]->qty, "incoming"=>$matinout[0]->incoming, "outgoing"=>$matinout[0]->outgoing]);
            }
            $stock = 0;
            $outsanding = 0;
            for ($j=0; $j < count($month); $j++) { 
                if ($j > 0) {
                    
                    $outsanding = $outsanding + $month[$j]["incoming"] - $month[$j]["qty_po"];
                    $month[$j]["outstanding"] = $outsanding;

                    $stock = $stock + $month[$j]["incoming"] - $month[$j]["production"];
                    $month[$j]["stock"] = $stock;
                }else {
                    $outsanding = $month[$j]["incoming"] - $month[$j]["qty_po"];
                    $month[$j]["outstanding"] = $outsanding;

                    $stock = $month[$j]["incoming"] - $month[$j]["production"];
                    $month[$j]["stock"] = $stock;
                }

                //stock
                if ($j < 11) {
                    $month[$j]["standar_stock"] = $month[$j+1]["production"];
                    $month[$j]["rencana_po"] = ($stock * -1) + $month[$j+1]["production"];
                }else {
                    $month[$j]["standar_stock"] = 0;
                    $month[$j]["rencana_po"] = 0;
                }
            }

            array_push($data, array('id' => $value->id, 'supplier' => $value->supplier, 'material' => $value->material, 'month' => $month ));
        }

        return $data;
    }

    public function generatePDF(Request $request)
    {
        // return view('e-mrp', ['data' => $request[0]);
        $pdf = PDF::loadView('e-mrp', ['data' => $request->data])->setPaper('a4', 'landscape');
        return $pdf->download('E-MRP.pdf');
    }
}

