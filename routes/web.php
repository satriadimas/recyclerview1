<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/supplier', function () {
    return Inertia::render('supplier/index');
})->middleware(['auth', 'verified'])->name('supplier');

Route::get('/supplier/{id}/goods', function ($id) {
    return Inertia::render('supplier/detail/index', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('supplier-goods');

Route::get('/po', function () {
    return Inertia::render('po/index');
})->middleware(['auth', 'verified'])->name('po');

Route::get('/bom', function () {
    return Inertia::render('bom/index');
})->middleware(['auth', 'verified'])->name('bom');

Route::get('/bom/{id}/detail', function ($id) {
    return Inertia::render('bom/detail/index', ['id' => $id]);
})->middleware(['auth', 'verified'])->name('bom-detail');

Route::get('/model', function () {
    return Inertia::render('model/index');
})->middleware(['auth', 'verified'])->name('model');

Route::get('/production', function () {
    return Inertia::render('production/index');
})->middleware(['auth', 'verified'])->name('production');

require __DIR__.'/auth.php';
