<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    if (Illuminate\Support\Facades\Auth::check()) {
        if (Illuminate\Support\Facades\Auth::user()->role == 'admin') {
            return redirect()->intended('admin/dashboard');
        } else {
            return redirect()->intended('user/dashboard');
        }
    }
    return redirect()->route('login');
});


Route::middleware('guest')->group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('admin.dashboard');
});

Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [AuthController::class, 'dashboard'])->name('user.dashboard');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/show', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/tambah', [OrderController::class, 'create'])->name('order.tambah');
    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order/edit/{id}', [OrderController::class, 'edit'])->name('order.edit');
    Route::post('/order/update/{id}', [OrderController::class, 'update'])->name('order.update');
    Route::get('/order/hapus/{id}', [OrderController::class, 'destroy'])->name('order.hapus');
    Route::get('/order/detail/{id}', [OrderController::class, 'detail'])->name('order.detail');

    Route::get('/order/history', [OrderController::class, 'history'])->name('order.history');
    Route::get('/order/history/{id}', [OrderController::class, 'historyShow'])->name('order.history.show');

});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/product', [ProductsController::class, 'index'])->name('product.index');
    Route::get('/product/show', [ProductsController::class, 'show'])->name('product.show');
    Route::get('/product/tambah', [ProductsController::class, 'create'])->name('product.tambah');
    Route::post('/product/simpan', [ProductsController::class, 'store'])->name('product.simpan');
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
    Route::get('/product/hapus/{id}', [ProductsController::class, 'destroy'])->name('product.hapus');
});