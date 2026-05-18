@extends('layouts.app')

@section('content')

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-warning text-dark">
                <h4 class="m-0">Edit Produk</h4>
            </div>
            <div class="card-body">
                <form action="/product/update/{{ $p->id }}" method="post" enctype="multipart/form-data">
                    @csrf
                    

                    <div class="mb-3">
                        @error('name')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name', $p->name) }}">
                    </div>
                    
                    <div class="mb-3">
                        @error('price')
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @enderror
                        <label class="form-label fw-bold">Harga</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number" class="form-control" name="price" value="{{ old('price', $p->price) }}">
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
                        <button type="submit" class="btn btn-warning text-white fw-bold">Update Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
