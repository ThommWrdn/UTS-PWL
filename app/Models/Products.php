<?php

namespace App\Models;

// Class Eloquent model bawaan laravel, fungsinya buat ngehubungin ke database
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    // Kasih tau kalo model ini nyambung ke tabel 'products' di database
    protected $table = 'products';
    
    // Field/kolom apa aja yang boleh diisi (mass assignable) biar aman dari mass assignment vulnerability
    protected $fillable = [
        'kode_produk',
        'nama_produk',
        'harga',
    ];
}
