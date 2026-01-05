<?php
require_once __DIR__ . '/../app/config/Database.php';
require_once __DIR__ . '/../app/config/Config.php';
require_once __DIR__ . '/../app/models/User.php';
require_once __DIR__ . '/../app/controllers/UserController.php';
require_once __DIR__ . '/../core/Flasher.php';

$database = new Database();
$pdo = $database->connect();

$controller = new UserController($pdo);

if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case 'tambah':
            $controller->tambah();
            break;
        case 'hapus':
            if (isset($_GET['id'])) {
                $controller->hapus($_GET['id']);
            }
            break;
        case 'ubah':
            $controller->ubah();
            break;
        case 'cari':
            $controller->cari();
            break;    
        default:
            $controller->index();
    }
} else {
    $controller->index();
}