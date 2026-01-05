<?php
/**
 * Controller User
 * Mengatur tampilan daftar user dan detail user
 */
class UserController {
    private $userModel;

    // Constructor - buat object User model
    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    // Method utama - routing berdasarkan parameter id
    public function index() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->detail($_GET['id']);
        } else {
            $this->list();
        }
    }

    // Tampilkan daftar semua user
    private function list() {
        $users = $this->userModel->getAllUsers();
        require_once __DIR__ . '/../views/list.php';
    }

    // Tampilkan detail user berdasarkan id
    private function detail($id) {
        $user = $this->userModel->getUserById($id);
        require_once __DIR__ . '/../views/detail.php';
    }
}
