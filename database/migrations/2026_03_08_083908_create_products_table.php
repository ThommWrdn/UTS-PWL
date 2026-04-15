<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Fungsi buat ngejalanin php artisan migrate, yaitu buat bikin tabel di database MySQL otomatis
     */
    public function up(): void
    {
        // Bikin tabel namanya 'products'
        Schema::create('products', function (Blueprint $table) {
            // Kolom id otomatis auto increment dan jadi primary key
            $table->id();
            // Kolom kode_produk, tipenya varchar/string, unique biar ngga boleh ada kembar
            $table->string('kode_produk')->unique();
            // Kolom buat nama_produk
            $table->string('nama_produk');
            // Kolom buat harga, ini diset string padahal angka tapi yaudahlah
            $table->string('harga');
            // Bikin kolom otomatis created_at sama updated_at buat nyatet kapan data dibuat/diubah
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     * Buat ngerollback alias ngehapus tabel products kalo diketik php artisan migrate:rollback
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
