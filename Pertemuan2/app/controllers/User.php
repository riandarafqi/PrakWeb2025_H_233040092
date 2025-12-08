<?php
require_once '../app/core/Controller.php';

class User extends Controller {

    public function __construct()
    {
        // nothing for now
    }

    public function index()
    {
        $model = $this->model('User_model');
        $data = ['users' => $model->getAllUsers()];
        $this->view('templates/header', ['title' => 'Daftar User']);
        $this->view('user/index', $data);
        $this->view('templates/footer');
    }

    public function detail($id = null)
    {
        if (!$id) { header('Location: ' . BASEURL . '/user'); exit; }
        $model = $this->model('User_model');
        $data = ['user' => $model->getUserById($id)];
        $this->view('templates/header', ['title' => 'Detail User']);
        $this->view('user/detail', $data);
        $this->view('templates/footer');
    }

    public function create()
    {
        $this->view('templates/header', ['title' => 'Tambah User']);
        $this->view('user/create');
        $this->view('templates/footer');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = $this->model('User_model');
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            if ($name === '' || $email === '') {
                header('Location: ' . BASEURL . '/user/create');
                exit;
            }
            $model->addUser(['name' => $name, 'email' => $email]);
        }
        header('Location: ' . BASEURL . '/user');
    }

    public function edit($id = null)
    {
        if (!$id) { header('Location: ' . BASEURL . '/user'); exit; }
        $model = $this->model('User_model');
        $data = ['user' => $model->getUserById($id)];
        $this->view('templates/header', ['title' => 'Edit User']);
        $this->view('user/edit', $data);
        $this->view('templates/footer');
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model = $this->model('User_model');
            $id = $_POST['id'] ?? null;
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            if ($id && $name !== '' && $email !== '') {
                $model->updateUser(['id'=>$id,'name'=>$name,'email'=>$email]);
            }
        }
        header('Location: ' . BASEURL . '/user');
    }

    public function delete($id = null)
    {
        if ($id) {
            $model = $this->model('User_model');
            $model->deleteUser($id);
        }
        header('Location: ' . BASEURL . '/user');
    }
}
