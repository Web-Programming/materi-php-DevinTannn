<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kosongkan tabel produk terlebih dahulu agar tidak menumpuk
        DB::table('products')->truncate();

        // Loop untuk membuat 50 data fake yang aman
        for ($i = 1; $i <= 50; $i++) {
            // 1. Acak jumlah stok terlebih dahulu
            $stock = rand(0, 50);

            // 2. Tentukan status otomatis (1 = tersedia jika stok > 0, 0 = habis)
            $statusOtomatis = $stock > 0 ? 1 : 0;

            DB::table('products')->insert([
                'name' => fake()->name(), 
                'price' => rand(1000, 10000),
                'stock' => $stock, // FIX: Kolom stock dimasukkan
                'description' => fake()->text(100), 
                'status' => $statusOtomatis, // FIX: Menggunakan angka 1 atau 0 (bukan teks 'used')
                'is_active' => true,
                'release_date' => now()->subDays(rand(1, 365)),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}