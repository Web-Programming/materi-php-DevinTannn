<?php
namespace Perpustakaan;

// Class Buku
class Buku{
    // Property
    public $judul;
    public $penulis;

    // Method
    function dibaca(){
        return "Buku sedang dibaca";
    }

    function ditutup(){
        return "Buku ditutup";
    }
}

// Menggunakan namespace
use Perpustakaan\Buku;

// Membuat inisial namespace
use Perpustakaan\Buku as Book;

// Instansiasi object
$buku_andi = new Buku();
$buku_siti = new Buku();

// Set property
$buku_andi->judul = "Pemrograman PHP";
$buku_andi->penulis = "Andi";

// Tampilkan property
echo "Buku Andi";
echo "<br>Judul : ", $buku_andi->judul;
echo "<br>Penulis : ", $buku_andi->penulis;

// Tampilkan method
echo "<br>";
echo $buku_andi->dibaca();
echo "<br>";
echo $buku_andi->ditutup();
?>