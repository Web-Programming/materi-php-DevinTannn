<?php

namespace Database\Seeders;

use App\Models\Supplier; // 👈 WAJIB: Import model Supplier di atas
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function up(): void // Atau public function run(): void tergantung versi Laravel Anda
    {
        // FIX: Memerintahkan factory untuk membuat 20 data dummy supplier lengkap secara otomatis
        Supplier::factory(20)->create();
    }
}