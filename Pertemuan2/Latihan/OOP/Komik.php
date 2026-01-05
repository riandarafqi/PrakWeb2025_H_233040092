<?php
require_once __DIR__ . '/Produk.php';

class Komik extends Produk {
  public $jmlHalaman;

  public function __construct($judul, $penulis, $penerbit, $harga, $jmlHalaman)
  {
    parent::__construct($judul, $penulis, $penerbit, $harga);
    $this->jmlHalaman = $jmlHalaman;
  }

  public function getInfoProduk() {
    $str = "Komik : " . parent::getLabel() . " | (Rp. " . $this->harga . ") - {$this->jmlHalaman} Halaman";
    return $str;
  }
}


?>