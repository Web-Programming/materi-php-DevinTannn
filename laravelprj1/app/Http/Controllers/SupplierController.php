<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class SupplierController extends Controller
{
    /**
     * Menampilkan daftar semua supplier (Index)
     */
    public function index()
    {
        $title = 'Daftar Supplier';
        // Ambil data supplier dengan pagination 10 data per halaman
        $suppliers = DB::table('suppliers')->paginate(10);

        return view('supplier.index', compact('title', 'suppliers'));
    }

    /**
     * Menampilkan form untuk menambah supplier baru (Create)
     */
    public function create()
    {
        $title = 'Tambah Supplier Baru';
        return view('supplier.create', compact('title'));
    }

    /**
     * Menyimpan data supplier baru ke database (Store)
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // Simpan ke database
        DB::table('suppliers')->insert([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    /**
     * Mencari supplier berdasarkan nama atau telepon di halaman terpisah (Search)
     */
    public function search(Request $request)
    {
        $title = 'Pencarian Supplier';
        $keyword = $request->get('keyword');

        if ($keyword) {
            $suppliers = DB::table('suppliers')
                ->where('name', 'like', "%" . $keyword . "%")
                ->orWhere('phone', 'like', "%" . $keyword . "%")
                ->paginate(10)
                ->withQueryString();
        } else {
            // Jika keyword kosong, kirim pagination kosong agar view tidak error
            $suppliers = new LengthAwarePaginator([], 0, 10);
        }

        return view('supplier.search', compact('title', 'suppliers'));
    }

    /**
     * Menampilkan detail lengkap satu supplier (Show)
     */
    public function show($id)
    {
        $title = 'Detail Supplier';
        $supplier = DB::table('suppliers')->where('id', $id)->first();

        if (!$supplier) {
            abort(404);
        }

        return view('supplier.show', compact('title', 'supplier'));
    }

    /**
     * Menampilkan form untuk mengedit data supplier (Edit)
     */
    public function edit($id)
    {
        $title = 'Edit Supplier';
        $supplier = DB::table('suppliers')->where('id', $id)->first();

        if (!$supplier) {
            abort(404);
        }

        return view('supplier.edit', compact('title', 'supplier'));
    }

    /**
     * Memperbarui data supplier di database (Update)
     */
    public function update(Request $request, $id)
    {
        // Validasi data yang diubah
        $request->validate([
            'name' => 'required|min:3',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // Proses update
        DB::table('suppliers')->where('id', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_at' => now(),
        ]);

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil diperbarui!');
    }

    /**
     * Menghapus data supplier dari database (Destroy)
     */
    public function destroy($id)
    {
        DB::table('suppliers')->where('id', $id)->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }
}