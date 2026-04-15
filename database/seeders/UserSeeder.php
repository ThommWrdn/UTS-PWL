<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
// Import seeder buat masukin data palsu bawaan laravel
use Illuminate\Database\Seeder;
// Import modul yang buat ngehash (ngenkripsi) password
use Illuminate\Support\Facades\Hash;
// Import tabel (model) User biar bisa di panggil diproses bikin datanya
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * Fungsi yang bakal jalan waktu diketik php artisan db:seed
     */
    public function run(): void
    {
        // Langsung insert satu baris data login ke tabel user
        User::create([
            // Namanya disetting ini
            'name' => 'Admin',
            // Email ini wajib dipake pas mau masuk/login aplikasinya
            'email' => 'admin@gmail.com',
            // Pssword di-hash biar di db berupa karakter acak (di enkripsi), ketikan aslinya: admin123
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
        ]);
    }
}
