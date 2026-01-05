<?php
/**
 * Model User
 * Menangani semua operasi database yang berkaitan dengan tabel users
 */
class User {
    // Property untuk menyimpan koneksi database
    private $pdo;

    /**
     * Constructor
     * $pdo - Objek koneksi database
     */
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Mengambil semua data pengguna dari database
     */
    public function getAllUsers() {
        $stmt = $this->pdo->prepare("SELECT * FROM users");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Mengambil data pengguna berdasarkan ID
     * $id - ID pengguna yang ingin diambil
     */
    public function getUserById($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function tambahDataUser($data)
    {
        $query = "INSERT INTO users (name, email) VALUES (:name, :email)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function hapusDataUser($id)
    {
        $query = "DELETE FROM users WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function ubahDataUser($data)
    {
        $query = "UPDATE users SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(':name', $data['name']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':id', $data['id']);
        $stmt->execute();

        return $stmt->rowCount();
    }

    public function cariDataUser($keyword)
    {
        $query = "SELECT * FROM users WHERE name LIKE :keyword OR email LIKE :keyword";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':keyword', "%$keyword%");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}