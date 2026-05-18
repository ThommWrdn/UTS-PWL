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
            $table->id();
            $table->foreignId('category_id')->constrained('category')->cascadeOnDelete();
            $table->string('name');
            $table->decimal('price', 12, 2);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
