<?php
namespace Kendaraan;
//Cara penulisan class Mobil 
class Mobil{
    //Cara penulisan property
    public $warna;
    public $merk;

    //Cara penulisan method
    function maju(){
        //Isi method maju()
        return "Mobil maju";
    }

    function berhenti(){
        //Isi method berhenti()
        return "Mobil berhenti";
    }
}

//Cara menggunakan namaspace
use Kendaraan\Mobil;

//Membuat inisial namespace
use Kendaraan\Mobil as KMobil;

//Instansi object
$mobil_ahmad = new Mobil();
$mobil_anton = new Mobil();

//Set property
$mobil_ahmad->warna = "Hitam";
$mobil_ahmad->merk = "Toyota";

//Tampilkan property
echo "Mobil Ahmad";
echo "<br>Warna : ", $mobil_ahmad->warna;
echo "<br>Merk : ", $mobil_ahmad->merk;

//Tampilkan method
echo $mobil_ahmad->maju();
echo "<br>";
echo $mobil_ahmad->berhenti();
?>