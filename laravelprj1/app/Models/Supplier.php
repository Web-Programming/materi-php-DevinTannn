<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Mengizinkan penggunaan data dummy (Factory)
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory; // Memasang fitur factory ke model ini

    protected $table = 'suppliers';

    // FIX: Menambahkan kolom phone dan address agar diizinkan masuk ke database
    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];
}