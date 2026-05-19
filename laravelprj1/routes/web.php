<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

//Route ke halaman utama saya
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

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
// Route::get('/detailproduk/{name}', function($name){
//     return view("produk.detail",
//         ['product_name' => $name,
//         'id' => 101,
//         'color' => 'Silver',
//         'stock' => 12
//         ]
//     );
// });

// Route::get('/produk', [ProductController::class, 'index']);


// Route::get('/produk/create', [ProductController::class, 'create']);

// Route::get('/produk/search', [ProductController::class, 'search']);

// Route::get('/produk/detail/{id}', [ProductController::class, 'show']);

// ==================== HOME (LANDING PAGE) ====================
// FIX: Mengembalikan view Landing Page langsung agar tidak dilempar ke login
Route::get('/', function () {
    return view('App.dashboard.home'); 
})->name('home');

// ==================== ROUTE AUTHENTIKASI ====================
// Tampilkan form register
Route::get('/register', [AuthController::class, 'registerForm'])
    ->name('register')
    ->middleware('guest'); // hanya bisa diakses jika BELUM login

// Proses simpan register
Route::post('/register', [AuthController::class, 'register'])
    ->middleware('guest');

// Tampilkan form login
Route::get('/login', [AuthController::class, 'loginForm'])
    ->name('login') // nama route ini WAJIB 'login' agar middleware auth berfungsi
    ->middleware('guest');

// Proses login
Route::post('/login', [AuthController::class, 'login'])
    ->middleware('guest');

// Proses logout (gunakan POST untuk keamanan, bukan GET)
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth'); // hanya bisa diakses jika SUDAH login


// ==================== ROUTE YANG DILINDUNGI ====================
// Semua route di dalam group ini hanya bisa diakses jika sudah login
Route::middleware('auth')->group(function () {
    
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 1. Taruh rute search DI ATAS resource
    Route::get('/produk/search', [ProductController::class, 'search'])->name('produk.search');
    Route::get('/supplier/search', [SupplierController::class, 'search'])->name('supplier.search');

    // 2. Resource mencakup (index, create, store, show, edit, update, destroy)
    Route::resource('produk', ProductController::class);
    Route::resource('supplier', SupplierController::class);
});