<?php

use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\UomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/mst_uom', [UomController::class, 'index'])->name('master.uom');
    Route::post('/mst_uom', [UomController::class, 'store'])->name('master.uom.store');
    Route::put('/mst_uom/{iduom}', [UomController::class, 'update'])->name('master.uom.update');
    Route::delete('/mst_uom/{iduom}', [UomController::class, 'destroy'])->name('master.uom.destroy');

    Route::get('/mst_product', [ProductController::class, 'index'])->name('master.product');
    Route::post('/mst_product', [ProductController::class, 'store'])->name('master.product.store');
    Route::put('/mst_product/{idprod}', [ProductController::class, 'update'])->name('master.product.update');
    Route::delete('/mst_product/{idprod}', [ProductController::class, 'destroy'])->name('master.product.destroy');

    Route::get('/set_menu', [MenuController::class, 'index'])->name('settings.menu');
    Route::post('/set_menu', [MenuController::class, 'store'])->name('settings.menu.store');
    Route::put('/set_menu/{idmnu}', [MenuController::class, 'update'])->name('settings.menu.update');
    Route::delete('/set_menu/{idmnu}', [MenuController::class, 'destroy'])->name('settings.menu.destroy');
});

require __DIR__ . '/auth.php';
