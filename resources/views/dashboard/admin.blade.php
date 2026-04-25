@extends('layouts.app')

@section('content')

    <div class="row align-items-center mb-4">
        <div class="col-md-6">
            <h1 class="display-6 fw-bold">Dashboard</h1>
            <p class="lead text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
        <div class="col-md-6 d-flex justify-content-md-end gap-2 mt-3 mt-md-0 flex-wrap">
            @if(Auth::user()->role == 'admin')
                <a href="/product" class="btn btn-primary shadow-sm"><i class="bi bi-box me-1"></i>Kelola Data Produk</a>
                <a href="{{ route('admin.orders') }}" class="btn btn-warning shadow-sm text-dark"><i class="bi bi-basket2 me-1"></i>Kelola Pesanan</a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body py-5 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon" width="100" class="mb-3 opacity-50">
                    <h3 class="fw-bold">Akses Anda: <span class="text-primary text-uppercase">{{ Auth::user()->role }}</span></h3>
                    @if(Auth::user()->role == 'admin')
                        <p class="text-secondary">Anda memiliki akses penuh untuk menambah, mengedit, dan menghapus produk di sistem OP Store.</p>
                        <div class="d-flex gap-2 justify-content-center flex-wrap mt-2">
                            <a href="/product" class="btn btn-outline-primary"><i class="bi bi-box me-1"></i>Menuju Halaman Produk</a>
                            <a href="{{ route('admin.orders') }}" class="btn btn-outline-warning text-dark"><i class="bi bi-basket2 me-1"></i>Kelola Pesanan</a>
                        </div>
                    @else
                        <p class="text-secondary">Anda login sebagai User biasa. Anda hanya dapat melihat dashboard ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
