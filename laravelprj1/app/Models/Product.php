<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // jika nama tabel tidak sesuai dengan konvensi
    //maka kita bisa mendefinisikan nama tabel secara eksplisit
    protected $table = 'products';

    protected $fillable = [
        'name',
        'price',
        'description',
        'status',
        'is_active',
        'release_date'
    ];
}
