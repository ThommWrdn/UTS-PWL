<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\AuthController;

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
});

Route::middleware(['auth'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/product', [AuthController::class, 'tampil'])->name('product.tampil');
    Route::get('/product/tambah', [ProductsController::class, 'tambah'])->name('product.tambah');
    Route::post('/product/simpan', [ProductsController::class, 'simpan'])->name('product.simpan');
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
    Route::get('/product/hapus/{id}', [ProductsController::class, 'hapus'])->name('product.hapus');
});