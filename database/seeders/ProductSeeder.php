<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Products; // Assuming the model is named Products

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Products::insert([
            [
                'kode_produk' => 'DIG-001',
                'nama_produk' => 'Sistem Informasi Kasir (Berbasis Web)',
                'harga' => '1500000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_produk' => 'DIG-002',
                'nama_produk' => 'Template Desain UI/UX E-Commerce',
                'harga' => '250000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_produk' => 'DIG-003',
                'nama_produk' => 'E-Book Mahir Belajar Laravel 11',
                'harga' => '75000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_produk' => 'DIG-004',
                'nama_produk' => 'Source Code: Sistem Manajemen Rumah Sakit',
                'harga' => '3000000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_produk' => 'DIG-005',
                'nama_produk' => 'Aset Vektor 3D Premium (Tech Theme)',
                'harga' => '120000',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode_produk' => 'DIG-006',
                'nama_produk' => 'E-Book Seri Master PHP & MySQL',
                'harga' => '65000',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
