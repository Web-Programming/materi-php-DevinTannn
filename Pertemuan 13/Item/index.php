<?php 
// Ambil file yang benar
require_once __DIR__ . "/../app/produk/Item.php";
require_once __DIR__ . "/../app/service/Item.php";

// Gunakan namespace
use App\Produk\Item as ProdukItem;
use App\Service\Item as ServiceItem;

// Membuat instance produk
$produk = new ProdukItem("Laptop");

// Service ambil dari produk
$service = new ServiceItem($produk);

// Tambahan: produk lain
$produk2 = new ProdukItem("HP");
$service2 = new ServiceItem($produk2);

// Menampilkan hasil
echo "<h3>Data Produk</h3>";
echo $produk->info() . "<br>";
echo $service->info();

echo "<br><br>";

echo $produk2->info() . "<br>";
echo $service2->info();
?>