<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar produk (Index)
     */
    public function index()
    {
        $title = 'Daftar Produk';
        // Mengambil data dengan pagination
        $products = DB::table('products')->paginate(10);

        return view('produk.index', compact('title', 'products'));
    }

    /**
     * Menampilkan form untuk menambah produk (Create)
     */
    public function create() 
    {
        $title = "Tambah Produk";
        return view('produk.create', compact('title')); // pastikan 'produk.create' bukan 'product.create'
    }

    /**
     * Menyimpan produk baru ke database (Store)
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|min:3',
            'price' => 'required|numeric',
        ]);

        // Proses insert ke database
        DB::table('products')->insert([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
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
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'status' => $request->status,
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

        // Jika ada keyword, cari. Jika tidak, kirim koleksi kosong.
        if ($keyword) {
            $products = DB::table('products')
                ->where('name', 'like', "%" . $keyword . "%")
                ->paginate(10)
                ->withQueryString();
        } else {
            // Membuat paginator kosong agar tidak error di view
            $products = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10);
        }

        // Arahkan ke view produk.search, bukan produk.index
        return view('produk.search', compact('title', 'products'));
    }
}