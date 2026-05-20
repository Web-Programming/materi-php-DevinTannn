<?php

namespace App\Http\Controllers;

use App\Models\Product; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Ditambahkan untuk mendukung fungsi raw query

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Menghitung total semua varian product
        $totalProduct = Product::count();

        // 2. Menghitung product yang tersedia (status = 1)
        $productTersedia = Product::where('status', 1)->count();

        // 3. Menghitung product yang habis (status = 0)
        $productHabis = Product::where('status', 0)->count();
        
        // 4. FIX: Menghitung total nilai stok yang benar (Harga dikali Stok)
        $totalNilai = Product::select(DB::raw('SUM(price * stock) as total'))->first()->total ?? 0;
        $nilaiStok = 'Rp ' . number_format($totalNilai, 0, ',', '.');
        
        // 5. Mengambil 5 product terbaru yang baru ditambahkan
        $productTerbaru = Product::latest()->take(5)->get();

        // 6. Mengirim data ke view dashboard
        return view('dashboard.dashboard', compact(
            'totalProduct',
            'productTersedia',
            'productHabis',
            'nilaiStok',
            'productTerbaru'
        ));
    }
}