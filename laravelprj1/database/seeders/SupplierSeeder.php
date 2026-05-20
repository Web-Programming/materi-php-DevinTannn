<?php

namespace Database\Seeders;

use App\Models\Supplier; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void //  Ubah up() menjadi run()
    {
        // Memerintahkan factory untuk membuat 20 data dummy supplier lengkap secara otomatis
        Supplier::factory(20)->create();
    }
}