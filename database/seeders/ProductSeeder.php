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
        // Ambil category pertama yang sudah diisi oleh CategorySeeder
        $categoryId = DB::table('category')->first()->id;

        Products::insert([
            [
                'category_id' => $categoryId,
                'name' => 'Sistem Informasi Kasir (Berbasis Web)',
                'price' => 1500000,
                'stock' => 10,
                'description' => 'Aplikasi lengkap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'name' => 'Template Desain UI/UX E-Commerce',
                'price' => 250000,
                'stock' => 25,
                'description' => 'Template E-Commerce',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'name' => 'E-Book Mahir Belajar Laravel 11',
                'price' => 75000,
                'stock' => 50,
                'description' => 'Materi mantap',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'name' => 'Source Code: Sistem Manajemen Rumah Sakit',
                'price' => 3000000,
                'stock' => 5,
                'description' => 'Skala Enterprise',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'name' => 'Aset Vektor 3D Premium (Tech Theme)',
                'price' => 120000,
                'stock' => 100,
                'description' => 'Vektor modern',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'category_id' => $categoryId,
                'name' => 'E-Book Seri Master PHP & MySQL',
                'price' => 65000,
                'stock' => 88,
                'description' => 'Fundamental PHP',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
