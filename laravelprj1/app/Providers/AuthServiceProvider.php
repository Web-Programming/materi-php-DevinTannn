<?php

namespace App\Providers;

// FIX 1: Import Model User agar type-hint (User $user) tidak error
use App\Models\User; 
// Import Facade Gate untuk panggilan statis
use Illuminate\Support\Facades\Gate; 
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Mengelola produk & supplier hanya bisa diakses oleh user dengan role 'admin'
        Gate::define('manage-products', function (User $user) {
            return $user->role === 'admin';
        });

        // Untuk update produk, hanya admin dan sales yang bisa mengaksesnya
        Gate::define('update-products', function (User $user) {
            return $user->role === 'admin' || $user->role === 'sales';
        });

        // Untuk menghapus produk, hanya admin yang bisa melakukannya
        Gate::define('delete-products', function (User $user) {
            return $user->role === 'admin';
        });

        // Untuk membuat produk dapat dijalankan oleh user yang sudah login 
        Gate::define('create-products', function (User $user) {
            return $user->role === 'sales'; 
        });
    }
}