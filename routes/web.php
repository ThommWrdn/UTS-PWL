<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/product', [ProductsController::class, 'tampil'])->name('product.tampil');
    Route::get('/product/tambah', [ProductsController::class, 'tambah'])->name('product.tambah');
    Route::post('/product/simpan', [ProductsController::class, 'simpan'])->name('product.simpan');
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
    Route::get('/product/hapus/{id}', [ProductsController::class, 'hapus'])->name('product.hapus');
});