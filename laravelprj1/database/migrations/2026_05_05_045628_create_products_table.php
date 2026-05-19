<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0); // Kolom stock digabung di sini
            $table->text('description')->nullable();
            
            // Menggunakan tinyInteger (1 = tersedia, 0 = habis) agar cocok dengan logika controller & index
            $table->tinyInteger('status')->default(0); 
            
            $table->boolean('is_active')->default(true);
            $table->date('release_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};