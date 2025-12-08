<?php
require_once '../app/core/Database.php';

class User_model {
    private $table = 'users';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getAllUsers()
    {
        $this->db->query("SELECT * FROM {$this->table} ORDER BY id DESC");
        return $this->db->resultSet();
    }

    public function getUserById($id)
    {
        $this->db->query("SELECT * FROM {$this->table} WHERE id = :id LIMIT 1");
        $this->db->bind('id', $id);
        return $this->db->single();
    }

    public function addUser($data)
    {
        $this->db->query("INSERT INTO {$this->table} (name, email) VALUES (:name, :email)");
        $this->db->bind('name', $data['name']);
        $this->db->bind('email', $data['email']);
        return $this->db->execute();
    }

    public function updateUser($data)
    {
        $this->db->query("UPDATE {$this->table} SET nama = :nama, email = :email WHERE id = :id");
        $this->db->bind('nama', $data['nama']);
        $this->db->bind('email', $data['email']);
        $this->db->bind('id', $data['id']);
        return $this->db->execute();
    }

    public function deleteUser($id)
    {
        $this->db->query("DELETE FROM {$this->table} WHERE id = :id");
        $this->db->bind('id', $id);
        return $this->db->execute();
    }
}
