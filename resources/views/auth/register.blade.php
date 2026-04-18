@extends('layouts.app')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                <h3 class="mb-0 fw-bold">Register Sistem</h3>
            </div>
            
            <div class="card-body p-4">
                @if(session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                @if(session('failed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif

                <form method="POST" action="/register">
                        @csrf
                        
                        <div class="mb-3">
                            @error('name')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Nama</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Masukkan nama..." required autofocus> 
                        </div>

                        <div class="mb-3">
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Alamat Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email..." required> 
                        </div>

                        <div class="mb-3">
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password..." required> 
                        </div>

                        <div class="mb-3">
                            @error('password_confirmation')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Konfirmasi Password</label>
                            <input type="password" name="password_confirmation" class="form-control form-control-lg" placeholder="Masukkan konfirmasi password..." required> 
                        </div>

                        <div class="mb-3">
                            @error('role')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Role</label>
                            <select name="role" class="form-select form-select-lg" required>
                                <option value="">Pilih Role...</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>
                            </select>
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Sign Up</button>
                        </div>

                        <div class="mt-3 text-center">
                            <a href="/login" class="text-decoration-none">Sudah punya akun? Login</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection