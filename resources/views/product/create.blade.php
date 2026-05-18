@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white">
                <h4 class="m-0">Tambah Produk</h4>
            </div>
            <div class="card-body">
                <form action="/products/simpan" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="name" class="form-label fw-bold">Nama Produk</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Misal: Indomie Goreng" value="{{ old('name') }}">
                    </div>
                    <div class="mb-3">
                        @error('price')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="price" class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" id="price" name="price" placeholder="3000" value="{{ old('price') }}">
                        </div>
                    </div>
                    <div class="mb-3">
                        @error('gambar')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label for="gambar" class="form-label fw-bold">Gambar</label>
                        <input type="file" class="form-control" id="gambar" name="gambar" value="{{ old('gambar') }}">
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
