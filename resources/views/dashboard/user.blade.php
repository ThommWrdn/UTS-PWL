@extends('layouts.app')

@section('content')

    <div class="row align-items-center mb-4">
        <div class="col-md-8">
            <h1 class="display-6 fw-bold">Dashboard</h1>
            <p class="lead text-muted">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-sm border-0 bg-light">
                <div class="card-body py-5 text-center">
                    <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="User Icon" width="100" class="mb-3 opacity-50">
                    <h3 class="fw-bold">Akses Anda: <span class="text-primary text-uppercase">{{ Auth::user()->role }}</span></h3>
                    @if(Auth::user()->role == 'user')
                        <p class="text-secondary">Anda login sebagai User biasa. Anda hanya dapat melihat dashboard ini.</p>
                        <a href="{{ route('order.index') }}" class="btn btn-primary mt-3">Lihat Produk</a>
                    @else
                        <p class="text-secondary">Anda login sebagai Admin . Anda hanya dapat melihat dashboard ini.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
