<?php
// public/index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// KIỂM TRA ROUTE ADMIN TẠI ĐÂY (Khắc phục triệt để lỗi .htaccess)
$url = isset($_GET['url']) ? $_GET['url'] : '';
$urlParts = explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));

if (isset($urlParts[0]) && strtolower($urlParts[0]) === 'admin') {
    // Nếu URL bắt đầu bằng /admin, ép hệ thống chạy luồng Admin
    require_once 'admin.php';
    exit();
}

// NẠP CÁC FILE CẤU HÌNH VÀ LÕI CHO FRONTEND (KHÁCH HÀNG)
require_once '../app/config/config.php';
require_once '../app/Core/Database.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/App.php';

// Khởi chạy ứng dụng Frontend
$app = new App();
?>