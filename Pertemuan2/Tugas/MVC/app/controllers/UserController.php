<?php
class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function view($view, $data = [])
    {
        extract($data); 
        require_once __DIR__ . '/../views/' . $view . '.php';
    }

    // Routing utama
    public function index() {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $this->detail($_GET['id']);
        } else {
            $this->list();
        }
    }

    // Daftar user
    private function list() {
        $users = $this->userModel->getAllUsers();
        require_once __DIR__ . '/../views/list.php';
    }

    // Detail user
    private function detail($id) {
        $user = $this->userModel->getUserById($id);
        require_once __DIR__ . '/../views/detail.php';
    }

    // 👇 Proses simpan user baru
    public function tambah()
    {
        if ($this->userModel->tambahDataUser($_POST) > 0) {
            Flasher::setFlash('berhasil', 'ditambahkan', 'success');
            header('Location: index.php');
            exit;
        } else {
            Flasher::setFlash('gagal', 'ditambahkan', 'danger');
            header('Location: index.php');
            exit;
        }
    }

    public function hapus($id)
    {
        if( $this->userModel->hapusDataUser($id) > 0 ) {
            Flasher::setFlash('berhasil', 'dihapus', 'success');
            header('Location: index.php');
            exit;
        } else {
            Flasher::setFlash('gagal', 'dihapus', 'danger');
            header('Location: index.php');
            exit;
        }
    }

    public function getubah()
    {
        echo json_encode($this->userModel->getUserById($_POST['id']));
    }

    public function ubah()
    {
        if( $this->userModel->ubahDataUser($_POST) > 0 ) {
            Flasher::setFlash('berhasil', 'diubah', 'success');
            header('Location: index.php');
            exit;
        } else {
            Flasher::setFlash('gagal', 'diubah', 'danger');
            header('Location: index.php');
            exit;
        } 
    }

    public function cari()
    {
        $keyword = $_POST['keyword'] ?? '';
        $data['judul'] = 'Hasil Pencarian User';
        $data['users'] = $this->userModel->cariDataUser($keyword);
        $this->view('list', $data);
    }
}