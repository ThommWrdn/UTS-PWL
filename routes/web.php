<?php

// Mengambil class Route dari Laravel buat bikin rute URL
use Illuminate\Support\Facades\Route;
// Ga begitu dipake sih DB disini, tapi biarin aja
use Illuminate\Support\Facades\DB;
// Panggil controller Products
use App\Http\Controllers\ProductsController;
// Panggil controller Auth buat login
use App\Http\Controllers\AuthController;

// Kalo orang buka webnya pertama kali, arahin langsung ke halaman login
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('guest')->group(function(){
    // Route buat nampilin form login
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    // Route buat proses pas tombol login dipencet (methoh POST)
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

// Grouping route pake middleware auth, artinya cuman user yg udah login yg bisa akses ini
Route::middleware(['auth'])->group(function () {
    // Route buat nampilin dashboard setelah berhasil login (boleh diakses semua role)
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
});

// Grouping khusus untuk admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route buat proses logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    // Kumpulan route buat fitur CRUD Produk
    // 1. Tampil data
    Route::get('/product', [ProductsController::class, 'tampil'])->name('product.tampil');
    // 2. Nampilin form tambah data
    Route::get('/product/tambah', [ProductsController::class, 'tambah'])->name('product.tambah');
    // 3. Proses nyimpen data ke database
    Route::post('/product/simpan', [ProductsController::class, 'simpan'])->name('product.simpan');
    // 4. Nampilin form edit sesuai ID
    Route::get('/product/edit/{id}', [ProductsController::class, 'edit'])->name('product.edit');
    // 5. Proses update data ke database sesuai ID
    Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('product.update');
    // 6. Proses hapus data sesuai ID
    Route::get('/product/hapus/{id}', [ProductsController::class, 'hapus'])->name('product.hapus');
});