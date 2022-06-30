<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierGoodRequest;
use App\Http\Resources\ArrayResource;
use App\Models\SupplierGood;
use Illuminate\Http\Request;

class SupplierGoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!$request->supplier_id) return ArrayResource::collection(SupplierGood::select("id as value", "name as label")->where("name", 'like', '%' . $request->search . '%')->get());
        if ($request->search) return ArrayResource::collection(SupplierGood::select("supplier_goods.id", "code", "supplier_goods.name", "price", "currency", "unit")
            ->join('suppliers', 'suppliers.id', '=', 'supplier_goods.supplier_id')->where("supplier_id", $request->supplier_id)->where(function ($query) use ($request) {
            $query->orWhere("code", 'like', '%' . $request->search . '%')
                    ->orWhere("supplier_goods.name", 'like', '%' . $request->search . '%')
                    ->orWhere("unit", 'like', '%' . $request->search . '%')
                    ->orWhere("price", 'like', '%' . $request->search . '%');
        })->paginate(12));
        if (!$request->search) return ArrayResource::collection(SupplierGood::select("supplier_goods.id", "code", "supplier_goods.name", "price", "currency", "unit")
            ->join('suppliers', 'suppliers.id', '=', 'supplier_goods.supplier_id')->where("supplier_id", $request->supplier_id)->paginate(12));
    }

    public function materialOptions(Request $request)
    {
        if ($request->id) return ArrayResource::collection(SupplierGood::select("id as value", "name as label")->where("name", 'like', '%' . $request->search . '%')->where("supplier_id", $request->id)->get());
        return [];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierGoodRequest $request)
    {
        $supplierGood = SupplierGood::create($request->validated());

        return new ArrayResource($supplierGood);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SupplierGood  $supplierGood
     * @return \Illuminate\Http\Response
     */
    public function show(SupplierGood $supplierGood)
    {
        return new ArrayResource($supplierGood);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SupplierGood  $supplierGood
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierGoodRequest $request, SupplierGood $supplierGood)
    {
        $supplierGood->update($request->validated());

        return new ArrayResource($supplierGood);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SupplierGood  $supplierGood
     * @return \Illuminate\Http\Response
     */
    public function destroy(SupplierGood $supplierGood)
    {
        $supplierGood->delete();

        return response()->noContent();
    }
}
