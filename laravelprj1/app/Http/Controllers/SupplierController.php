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
        // 1. FIX: Menambahkan validasi untuk email (boleh kosong/nullable, tapi jika diisi format harus email dan unik)
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'nullable|email|unique:suppliers,email',
            'phone' => 'required',
            'address' => 'required',
        ]);

        // 2. FIX: Menyertakan request email untuk dimasukkan ke database
        DB::table('suppliers')->insert([
            'name' => $request->name,
            'email' => $request->email, 
            'phone' => $request->phone,
            'address' => $request->address,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil ditambahkan!');
    }

    /**
     * Mencari supplier berdasarkan nama, telepon, atau email di halaman terpisah (Search)
     */
    public function search(Request $request)
    {
        $title = 'Pencarian Supplier';
        $keyword = $request->get('keyword');

        if ($keyword) {
            // FIX: Menambahkan fitur pencarian berdasarkan email juga agar makin fungsional
            $suppliers = DB::table('suppliers')
                ->where('name', 'like', "%" . $keyword . "%")
                ->orWhere('phone', 'like', "%" . $keyword . "%")
                ->orWhere('email', 'like', "%" . $keyword . "%")
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
        // 1. FIX: Menambahkan validasi email pada proses update, abaikan keunikan untuk ID supplier ini sendiri
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'nullable|email|unique:suppliers,email,' . $id,
            'phone' => 'required',
            'address' => 'required',
        ]);

        // 2. FIX: Menyertakan update data email ke database
        DB::table('suppliers')->where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
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