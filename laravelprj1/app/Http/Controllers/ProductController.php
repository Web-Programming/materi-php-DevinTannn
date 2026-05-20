<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk (Index) + Fitur Filter dari Dashboard
     */
    public function index(Request $request)
    {
        $title = 'Daftar Produk';
        
        // 1. Mulai query dasar dari tabel products
        $query = DB::table('products');

        // 2. Cek apakah ada kiriman filter status dari link Dashboard (?status=...)
        if ($request->has('status')) {
            if ($request->status == 'tersedia') {
                $query->where('status', 1);
            } elseif ($request->status == 'habis') {
                $query->where('status', 0);
            }
        }

        // 3. Mengambil data dengan pagination (dan mempertahankan query string status di URL)
        $products = $query->paginate(10)->withQueryString();

        // 4. Mengembalikan data ke view
        return view('produk.index', compact('title', 'products'));
    }

    /**
     * Menampilkan form untuk menambah produk (Create)
     */
    public function create() 
    {
        Gate::authorize('create-products');
        
        $title = "Tambah Produk";
        return view('produk.create', compact('title'));
    }

    /**
     * Menyimpan produk baru ke database (Store)
     */
    public function store(Request $request)
    {
        // 1. Validasi input (Wajib mengisi stock minimal angka 0)
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
        ]);

        // 2. Tentukan status otomatis berdasarkan kuantitas stok
        $statusOtomatis = $request->stock > 0 ? 1 : 0;

        // 3. Proses insert ke database
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock, // Kolom stock ditambahkan
            'description' => $request->description,
            'status' => $statusOtomatis, // Nilai status otomatis dari pengecekan stok
            'is_active' => $request->has('is_active') ? 1 : 0,
            'release_date' => $request->release_date,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('produk.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail produk (Show)
     */
    public function show(string $id)
    {
        $title = 'Detail Produk';
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        return view('produk.detail', compact('title', 'product'));
    }

    /**
     * Menampilkan form edit produk (Edit)
     */
    public function edit(string $id)
    {
        $title = 'Edit Produk';
        $product = DB::table('products')->where('id', $id)->first();

        if (!$product) {
            abort(404);
        }

        return view('produk.edit', compact('title', 'product'));
    }

    /**
     * Memperbarui data produk di database (Update)
     */
    public function update(Request $request, string $id)
    {
        // 1. Validasi input data saat perubahan dilakukan
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
        ]);

        // 2. Hitung ulang status otomatis berdasarkan nilai stok baru
        $statusOtomatis = $request->stock > 0 ? 1 : 0;

        // 3. Proses update ke database
        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock, // Kolom stock diupdate
            'description' => $request->description,
            'status' => $statusOtomatis, // Nilai status ikut disesuaikan otomatis
            'is_active' => $request->has('is_active') ? 1 : 0,
            'release_date' => $request->release_date,
            'updated_at' => now(),
        ]);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui!');
    }

    /**
     * Menghapus produk (Destroy)
     */
    public function destroy(string $id)
    {
        DB::table('products')->where('id', $id)->delete();
        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus!');
    }

    /**
     * Mencari produk berdasarkan nama (Search)
     */
    public function search(Request $request)
    {
        $title = 'Pencarian Produk';
        $keyword = $request->get('keyword');

        // Mulai query dasar ke tabel products
        $query = DB::table('products');

        // FIX: Jika ada keyword dari navbar / form, jalankan query filter nama
        if ($keyword) {
            $query->where('name', 'like', "%" . $keyword . "%");
        }

        // Ambil data menggunakan pagination (Jika keyword kosong, akan menampilkan seluruh produk)
        $products = $query->paginate(10)->withQueryString();

        return view('produk.search', compact('title', 'products'));
    }
}   