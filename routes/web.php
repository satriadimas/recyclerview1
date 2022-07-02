<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Api\WarehouseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => 'auth'], function() {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    
    Route::get('/supplier', function () {
        return Inertia::render('supplier/index');
    })->name('supplier');
    
    Route::get('/supplier/{id}/goods', function ($id) {
        return Inertia::render('supplier/detail/index', ['id' => $id]);
    })->name('supplier-goods');
    
    Route::get('/mrp', function () {
        return Inertia::render('po/kalkulasi/index');
    })->name('mrp');
    
    Route::get('/warehouse', function () {
        return Inertia::render('warehouse/index');
    })->name('warehouse');

    Route::get('/warehouse/stock', function () {
        return Inertia::render('warehouse/contents/stock/index');
    })->name('stock');
    
    Route::get('/warehouse/incoming', function () {
        return Inertia::render('warehouse/contents/incoming/index');
    })->name('incoming');
    
    Route::get('/warehouse/outgoing', function () {
        return Inertia::render('warehouse/contents/outgoing/index');
    })->name('outgoing');
    
    Route::get('/po', function () {
        return Inertia::render('po/form/index');
    })->name('po');

    Route::get('/po/add', function () {
        return Inertia::render('po/form/add/index');
    })->name('addPo');
    
    Route::get('/bom', function () {
        return Inertia::render('bom/index');
    })->name('bom');
    
    Route::get('/bom/{id}/detail', function ($id) {
        return Inertia::render('bom/detail/index', ['id' => $id]);
    })->name('bom-detail');
    
    Route::get('/model', function () {
        return Inertia::render('model/index');
    })->name('model');
    
    Route::get('/production', function () {
        return Inertia::render('production/index');
    })->name('production');
});

require __DIR__.'/auth.php';
