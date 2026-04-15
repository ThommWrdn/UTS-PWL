<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Kolom-kolom di tabel user (database) yang boleh diisi pas proses register / seeder
     * Kolom lain yang ngga disebut disini nggak akan bisa masukin datanya sembarangan
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * Kolom yang disembunyiin misal datanya di-fetch/dijadiin JSON
     * Biar password orang ngga kelihatan
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     * Buat otomatis ngubah tipe data, misal password otomatis di-hash (enkripsi)
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
