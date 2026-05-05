<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Daftar Produk';

        $products = [
            ['id' => 1, 'name' => 'Laptop', 'price' => 25000000],
            ['id' => 2, 'name' => 'Mouse', 'price' => 300000],
            ['id' => 3, 'name' => 'Keyboard', 'price' => 500000],
        ];
        //$products = product::all(); // cara 1
        $products = DB::select('SELECT * FROM products'); //cara 2
        //$products = DB::table('products')->get(); //cara 3

        //return view('produk.index', compact('products'));
        return view('produk.index', compact('title', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = 'Detail Produk';
        $product = ['id' => 4, 'name' => 'Product ' . 'Computer', 'price' => 10.99];
        return view('produk.detail', compact('id', 'product', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
