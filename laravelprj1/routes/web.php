<?php

use Illuminate\Support\Facades\Route;

//Route ke halaman utama saya
Route::get('/', function () {
    echo "Halo, nama saya Devin Tan";
    //return view('welcome');
});

//Route ke halaman alamat
Route::get('/alamat', function(){
    echo "Jalan Kolonel Atmo 12. Palembang";
});

//Route ke /path1/path2/detail
Route::get('/path1/path2/detail', function(){
    echo "Jalan Kolonel Atmo 12. Palembang";
    echo "<br>";
    echo "Rt. 01 Rw. 02";
    echo "<br>";
    echo "Kecamatan Ilir Timur 1";
    echo "<br>";
    echo "Kota Palembang";
    echo "<br>";
    echo "Provinsi Sumatera Selatan";
});

//Route dinamis dengan parameter id
Route::get('/user/{id}', function($id){
    echo "User ID: ". $id;
});

//Route dinamis dengan parameter nama
Route::get('/user2/{name}', function($name){
    echo "User Name: ". $name;
});

//Route dinamis dengan opsinoal parameter nama
Route::get('/user3/{name?}', function($name = 'Tamu'){
    echo "User Name: ". $name;
});

//Route dinamis dengan parameter nama dan id
Route::get('/user4/{id}/{name}', function($id, $name){
    echo "User ID: ". $id;
    echo "<br>";
    echo "User Name: ". $name;
});

//Route dengan metode POST
Route::get('/simpan', function(){
    echo "Data berhasil disimpan";
});

//Route dengan metode PUT
Route::get('/update/{id}', function($id){
    echo "Data berhasil diperbaharui ID: ". $id;
});

//Route dengan metode PATCH
Route::get('/update2{id}', function($id){
    echo "Data berhasil diperbaharui ID: ". $id;
});

//Route dengan metode Delete
Route::get('/hapus/{id', function($id){
    echo "Data berhasil dihapus dengan ID: ". $id;
});

//Menampilkan Halaman Profil
Route::get('/profil', function(){
    return view("myprofile");
});

//Gunakan . untuk memisahkan folder dengan view
//Route::get('/detailproduk', function(){
//    return view("produk.detail");
//});

//Mengirim data ke view
Route::get('/detailproduk/{name}', function($name){
    return view("produk.detail",
        ['product_name' => $name,
        'id' => 101,
        'color' => 'Silver',
        'stock' => 12
        ]
    );
});

Route::get('/produk', function(){
    return view("produk.index");
});

Route::get('/produk/create', function(){
    return view("produk.create");
});

Route::get('/produk/search', function(){
    return view("produk.search");
});

Route::get('/produk/detail', function(){
    return view("produk.detail");
});

//Suplier
Route::get('/supplier', function(){
    return view("supplier.index");
});

//php artisan make:controller ProductController -r