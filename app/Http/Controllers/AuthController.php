<?php

namespace App\Http\Controllers;

// Import buat ngambil input formulir
use Illuminate\Http\Request;
// Import tool Auth dari Laravel buat ngatur login/logout
use Illuminate\Support\Facades\Auth;
// Import model User dari database
use App\Models\User;

class AuthController extends Controller
{
    // Fungsi buat nampilin halaman login awal
    public function showLogin()
    {
        // View login ini ada di resources/views/login.blade.php
        return view('login');
    }

    // Fungsi buat proses ngecek login bener atau salah
    public function login(Request $request)
    {
        // Validasi inputan: email harus bener formatnya, dan password ga boleh kosong
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        // Coba cocokin email sama password di database
        if (Auth::attempt($credentials)) {
            // Kalo bener, bikin sesi baru biar lebih aman
            $request->session()->regenerate();
            // Arahin langsung masuk ke dashboard
            return redirect()->intended('dashboard');
        }
        
        // Kalo gagal (salah ketik password dll), balikin ke halaman login + kasih notif error
        return back()->with('failed', 'Email atau password salah!');
    }

    // Fungsi buat keluar alias logout
    public function logout(Request $request)
    {
        // Proses logout bawaan laravel
        Auth::logout();
        
        // Hapus semua data session biar ga bisa diback (aman)
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Terus arahin balik ke halaman login
        return redirect()->route('login');
    }

    // Fungsi buat nampilin halaman utama (dashboard) abis login sukses
    public function dashboard()
    {
        // View-nya ngarah ke file dashboard.blade.php
        return view('dashboard');
    }
}
