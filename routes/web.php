<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\customerPageController;
use App\Http\Controllers\KayuController;
use App\Http\Controllers\KayuAdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\penjualanController;
use Illuminate\Support\Facades\Artisan;

Route::get('/', [customerPageController::class, 'index']);
Route::get('/allproduct', [KayuController::class, 'index']);
Route::get('/detailproduct/{id}', [KayuController::class, 'show']);

// ------------------ Login Area ------------------ //
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::get('/register', [LoginController::class, 'showregister'])->name('login');
    Route::post('/register', [LoginController::class, 'register']);
    Route::post('/login', [LoginController::class, 'autentikasi']);
});
// ------------------ Edit Delete ------------------ //
Route::post('customabout/getEditForm',[AboutController::class,'getEditForm'])->name('about.getEditForm');
Route::post('customproduct/getEditForm',[KayuAdminController::class,'getEditForm'])->name('product.getEditForm');
Route::post('inputform/getInputForm',[customerPageController::class,'getInputForm'])->name('customerpage.product.getInputForm');
Route::post('inputform/store',[customerPageController::class,'store'])->name('customerPageController.store');
// ------------------ Logout ------------------ //
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ------------------ Dashboard (Redirected after login) ------------------ //
Route::middleware('auth:admin')->group(function () {
    Route::get('/homeadmin', function () {
        return view('customerpage.index');
    })->name('dashboard.admin');
    Route::get('/penjualan/{id}/selesaikan', [penjualanController::class, 'updateStatus'])
    ->name('penjualan.updateStatus');

});

Route::middleware('auth:pelanggans')->group(function () {
    Route::get('/homepelanggan', function () {
        return view('customerpage.index');
    })->name('dashboard.pelanggan');
    Route::get('daftarpembelian',[customerPageController::class,'showListPembelian'])->name('customerpage.product.daftarpembelian');
Route::post('/rating/store', [customerPageController::class, 'rating'])->name('rating.store');
Route::put('/penjualan/bayar/update', [customerPageController::class, 'updatePembayaran'])->name('penjualan.bayar.update');
});
Route::get('dashboard', [DashboardController::class,'index'])->middleware('auth:admin');
Route::resource('product', KayuAdminController::class)->middleware('auth:admin');
Route::resource('about', AboutController::class)->middleware('auth:admin');
Route::resource('penjualan', penjualanController::class)->middleware('auth:admin');
Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return 'Cache cleared';
});
