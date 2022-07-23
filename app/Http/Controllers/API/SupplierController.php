<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Http\Resources\ArrayResource;
use App\Models\Supplier;
use App\Models\SupplierGood;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->search) return ArrayResource::collection(Supplier::where("name", 'like', '%' . $request->search . '%')->orWhere("address", 'like', '%' . $request->search . '%')->orWhere("contact", 'like', '%' . $request->search . '%')->paginate(20));
        if (!$request->search) return ArrayResource::collection(Supplier::paginate(12));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $supplier = Supplier::create($request->validated());

        return new ArrayResource($supplier);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return new ArrayResource($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->validated());

        return new ArrayResource($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier_id = $supplier->id;
        if ($supplier->delete()) {
            SupplierGood::where('supplier_id',$supplier_id)->delete();
        }

        return response()->noContent();
    }

    public function supplierOptions(Request $request)
    {
        $list = Supplier::where("name", 'like', '%' . $request->search . '%')->limit(3)->get(['id as value', 'name as label']);

        return $list;
    }
}
