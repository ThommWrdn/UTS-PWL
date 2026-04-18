<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category')->insert([
            [
                'name' => 'Elektronik',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pakaian',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Makanan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alat Tulis',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
