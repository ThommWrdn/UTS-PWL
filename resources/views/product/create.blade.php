@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Tambah Produk</h4>
            </div>
            <div class="card-body">
                <form action="/product/simpan" method="post">
                    @csrf
                    
                    <div class="mb-3">
                        @error('kode_produk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="kode_produk" class="form-label fw-bold">Kode Produk</label>
                        <input type="text" class="form-control" id="kode_produk" name="kode_produk" placeholder="Misal: BRG001" value="{{ old('kode_produk') }}">
                    </div>
                    <div class="mb-3">
                        @error('nama_produk')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="nama_produk" class="form-label fw-bold">Nama Produk</label>
                        <input type="text" class="form-control" id="nama_produk" name="nama_produk" placeholder="Misal: Indomie Goreng" value="{{ old('nama_produk') }}">
                    </div>
                    <div class="mb-3">
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
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
