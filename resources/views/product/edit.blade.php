<!-- Ngambil layout app.blade.php -->
@extends('layouts.app')

<!-- Masuk ke bagian content -->
@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="m-0">Edit Produk</h4>
            </div>
            <div class="card-body">
                <!-- Form buat update data, ID-nya dilempar ke URL biar tau data mana yang diubah -->
                <form action="/product/update/{{ $p->id }}" method="post">
                    <!-- Keamanan bawaan laravel wajib dipake -->
                    @csrf
                    
                    <div class="mb-3">
                        <!-- error digunakan untuk menampilkan pesan error dari validasi Laravel -->
                        @error('kode_produk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="form-label fw-bold">Kode Produk</label>
                        <!-- Isi otomatis valuenya diambil dari database $p -->
                        <input type="text" class="form-control" name="kode_produk" value="{{ old('kode_produk', $p->kode_produk) }}">
                    </div>
                    
                    <div class="mb-3">
                        <!-- error digunakan untuk menampilkan pesan error dari validasi Laravel -->
                        @error('nama_produk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" class="form-control" name="nama_produk" value="{{ old('nama_produk', $p->nama_produk) }}">
                    </div>
                    
                    <div class="mb-3">
                        <!-- error digunakan untuk menampilkan pesan error dari validasi Laravel -->
                        @error('harga')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="harga" value="{{ old('harga', $p->harga) }}">
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-end gap-2">
                        <a href="/product" class="btn btn-secondary">Batal</a>
                        <!-- Tombol buat nyimpen perubahan (update) -->
                        <button type="submit" class="btn btn-warning text-white fw-bold">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Selesai bagian content -->
@endsection
