<?php
session_start();

// konfigurasi
define('base_url', '/tugas-toko-online');

// load class controller terlebih dahulu
include_once "controllers/Controller.php";

// buat objek dari class controller
$controller = new Controller();

// tentukan bagaimana halaman akan di-load
if (!isset($_GET['page'])) {
    // pemanggilan method yang akan di-run
    $controller->index();
} else {
    switch ($_GET['page']) {
        case 'home':
            $controller->index();
            break;
            
        case 'member':
            $controller->member();
            break;
            
        case 'auth':
            $controller->auth();
            break;

        case 'produk':
            $controller->produk();
            break;
            
        case 'cart':
            $controller->cart();
            break;
            
        case 'checkout':
            $controller->checkout();
            break;
            
        case 'thanks':
            $controller->thanks();
            break;
            
        case 'logout':
            $controller->logout();
            break;

        default:
            $controller->index();
            break;
    }
}
