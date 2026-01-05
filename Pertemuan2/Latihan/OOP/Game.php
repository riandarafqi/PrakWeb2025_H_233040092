<?php 
require_once 'Produk.php';
require_once 'Komik.php';

class Game extends Produk {
  public $waktuMain;

  public function __construct($judul, $penulis, $penerbit, $harga, $waktuMain)
  {
    parent::__construct($judul, $penulis, $penerbit, $harga);
    $this->waktuMain = $waktuMain;
  }

  public function getInfoProduk() {
    $str = "Game : " . Parent::getLabel() . " (Rp . " . $this->harga . ") - {$this->waktuMain} Jam.";
    return $str;
  }
}

$produk1 = new Game("The Witcher 3", "CD Projekt Red", "CD Projekt", 300000, 100);
$produk1 = new Komik("Naruto", "Massashi Kishimoto", "Shounen Jump", 20000, 350);

echo $produk1->getInfoProduk();
echo "<br>";
echo $produk2->getInfoProduk();

?>