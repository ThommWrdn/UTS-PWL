@extends('layouts.app')

@section('content')

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="card shadow-lg border-0 rounded-4">
            <div class="card-header bg-primary text-white text-center py-3 rounded-top-4">
                <h3 class="mb-0 fw-bold">Login Sistem</h3>
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

                <form method="POST" action="/login">
                        @csrf
                        
                        <div class="mb-3">
                            @error('email')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Alamat Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" placeholder="Masukkan email..." required autofocus> 
                        </div>

                        <div class="mb-4">
                            @error('password')
                                <div class="alert alert-danger" role="alert">
                                    {{ $message }}
                                </div>
                            @enderror
                            <label class="form-label fw-bold">Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" placeholder="Masukkan password..." required> 
                        </div>
                        
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg fw-bold">Sign In</button>
                        </div>
                </form>
            </div>
        </div>
        
        <p class="text-center text-muted mt-3">
            Testing Account:<br>
            Admin: <strong>admin@gmail.com</strong> (admin123)<br>
            User: <strong>user@gmail.com</strong> (user123)
        </p>
    </div>
</div>

@endsection
