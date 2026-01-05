<?php
class Database {
    // Konfigurasi database
    private $host = "localhost";
    private $dbname = "pertemuan2";
    private $username = "root";
    private $password = "";
    private $pdo;

    /**
     * Method untuk koneksi ke database
     */
    public function connect() {
        // Cek apakah koneksi sudah dibuat
        if ($this->pdo === null) {
            try {
                // Buat koneksi PDO
                $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
                // Set error mode ke exception
                $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Koneksi gagal: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }
}
