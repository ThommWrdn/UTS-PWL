<!-- Ngambil layout/template bawaan dari folder layouts file app.blade.php -->
@extends('layouts.app')

<!-- Mulai naruh isi web di dalem section content -->
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Tambah Produk</h4>
            </div>
            <div class="card-body">
                <!-- Form buat nambah data, action ngarah ke route simpan, methodnya post biar gak keliatan di URL -->
                <form action="/product/simpan" method="post">
                    <!-- Wajib ada csrf dari laravel biar form-nya aman dan bisa disubmit (anti cross-site request forgery) -->
                    @csrf
                    
                    <div class="mb-3">
                        <!-- error digunakan untuk menampilkan pesan error dari validasi Laravel -->
                        @error('kode_produk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="kode_produk" class="form-label fw-bold">Kode Produk</label>
                        <!-- Attribute name="kode_produk" itu yang ditangkep sama request di controller -->
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Misal: BRG001" value="{{ old('kode_produk') }}">
                    </div>
                    <div class="mb-3">
                        <!-- error digunakan untuk menampilkan pesan error dari validasi Laravel -->
                        @error('nama_produk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Misal: Indomie Goreng" value="{{ old('nama_produk') }}">
                    </div>
                    <div class="mb-3">
                        <!-- error digunakan untuk menampilkan pesan error dari validasi Laravel -->
                        @error('harga')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="harga" class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="harga" name="harga" placeholder="3000" value="{{ old('harga') }}">
                        </div>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="/product" class="btn btn-secondary">Batal</a>
                        <!-- Tombol buat submit atau nyimpen, tipe submit penting banget buat ngirim form -->
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Nutup bagian content -->
@endsection
