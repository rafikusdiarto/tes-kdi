<?php

use App\Http\Controllers\Master\ProductController;
use App\Http\Controllers\Master\UomController;
use App\Http\Controllers\Master\VendorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\MenuController;
use App\Http\Controllers\Transaction\OfferController;
use App\Http\Controllers\Transaction\PortalController;
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

    Route::get('/mst_vendor', [VendorController::class, 'index'])->name('master.vendor');
    Route::post('/mst_vendor', [VendorController::class, 'store'])->name('master.vendor.store');
    Route::put('/mst_vendor/{idvend}', [VendorController::class, 'update'])->name('master.vendor.update');
    Route::delete('/mst_vendor/{idvend}', [VendorController::class, 'destroy'])->name('master.vendor.destroy');

    Route::get('/mst_vendor', [VendorController::class, 'index'])->name('master.vendor');

    Route::get('/trn_offer', [OfferController::class, 'index'])->name('transaction.offer');
    Route::put('/trn_offer/{idofr}', [OfferController::class, 'update'])->name('transaction.offer.update');
    Route::put('/trn_offer/update_sts/{idofr}', [OfferController::class, 'updateStats'])->name('transaction.offer.updateStats');

    Route::get('/set_menu', [MenuController::class, 'index'])->name('settings.menu');
    Route::post('/set_menu', [MenuController::class, 'store'])->name('settings.menu.store');
    Route::put('/set_menu/{idmnu}', [MenuController::class, 'update'])->name('settings.menu.update');
    Route::delete('/set_menu/{idmnu}', [MenuController::class, 'destroy'])->name('settings.menu.destroy');
});

Route::get('/portal_supplier', [PortalController::class, 'index'])->name('transaction.portal');
Route::post('/portal_supplier', [PortalController::class, 'store'])->name('transaction.portal.store');
Route::post('/api/vendor/store-quick', [PortalController::class, 'storeVendorQuick'])->name('api.vendor.store');
Route::post('/api/product/store-quick', [PortalController::class, 'storeProductQuick'])->name('api.product.store');

require __DIR__ . '/auth.php';
