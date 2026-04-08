<?php
namespace App\Produk{
    class Item{
        public $nama;
        public function __construct($nama){
            $this->nama = $nama;
        }
        public function info(){
            return "Produk : ". $this->nama;
        }
    }
}

namespace App\Service {
    use App\Produk\Item as ProdukItem;
    class Item {
        public $nama;

        // Constructor menerima object produk
        public function __construct(ProdukItem $produk){
            // Copy nama dari produk
            $this->nama = $produk->nama;
        }

        public function info(){
            return "Service dari produk : " . $this->nama;
        }
    }
}