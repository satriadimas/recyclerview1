<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\SupplierGoodController;
use App\Http\Controllers\Api\BomController;
use App\Http\Controllers\Api\ProductionController;
use App\Http\Controllers\Api\WarehouseController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('products', ProductController::class);
Route::get('product/options', [ProductController::class, 'productOptions']);
Route::apiResource('suppliers', SupplierController::class);
Route::apiResource('supplier-goods', SupplierGoodController::class);
Route::get('material/options', [SupplierGoodController::class, 'materialOptions']);
Route::apiResource('bom', BomController::class);
Route::get('bom/{id}/detail', [BomController::class, 'getBomDetail']);
Route::apiResource('production', ProductionController::class);
Route::get('calculation/po/{supplier_id}', [ProductionController::class, 'getCalPo']);
Route::get('po', [WarehouseController::class, 'getPo']);
Route::post('po', [WarehouseController::class, 'addPo']);
Route::get('po/detail/{id}', [WarehouseController::class, 'getPoDetail']);
Route::get('supplier/options', [SupplierController::class, 'supplierOptions']);
Route::get('warehouse/stock', [WarehouseController::class, 'getStock']);
Route::get('warehouse/incoming', [WarehouseController::class, 'getIncoming']);
Route::post('warehouse/incoming/add', [WarehouseController::class, 'addIncoming']);
Route::get('warehouse/outgoing', [WarehouseController::class, 'getOutgoing']);
Route::post('warehouse/outgoing/add', [WarehouseController::class, 'addOutgoing']);
Route::delete('warehouse/incoming/{id}', [WarehouseController::class, 'deleteIncoming']);
Route::delete('warehouse/outgoing/{id}', [WarehouseController::class, 'deleteOutgoing']);

Route::get('generate-pdf/{id}', [WarehouseController::class, 'generatePDF']);
Route::get('mrp-pdf/{supplier_id}', [ProductionController::class, 'generatePDF']);