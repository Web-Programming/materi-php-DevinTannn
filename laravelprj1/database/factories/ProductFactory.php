<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $stock = rand(0, 50);

        return [
            'name' => fake()->name(),
            'price' => rand(1000, 10000),
            'stock' => $stock, 
            'description' => fake()->text(100),
            
            // PASTIKAN BARIS INI SUDAH DIGANTI MENJADI ANGKA (BUKAN ['new', 'used'])
            'status' => $stock > 0 ? 1 : 0,
            
            'is_active' => true,
            'release_date' => now()->subDays(rand(1, 365)),
        ];
    }
}