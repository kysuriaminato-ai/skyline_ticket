<?php
// public/index.php
session_start();

// Lấy URL từ GET parameter
$url = $_GET['url'] ?? '';

// Nếu URL bắt đầu bằng "admin", gọi admin.php thay vì App.php
if (strpos($url, 'admin') === 0) {
    require_once '../app/config/config.php';
    require_once '../app/Core/AdminApp.php';
    require_once '../app/Core/Controller.php';
    require_once '../app/Core/Database.php';

    // TẠMM BỎ CHECK QUYỀN ĐỂ TEST
    // if (!isset($_SESSION['user_name']) || $_SESSION['role'] !== 'admin') {
    //     die("Bạn không có quyền truy cập khu vực này!");
    // }

    // Xóa "admin/" từ URL và đặt lại $_GET['url']
    $_GET['url'] = substr($url, 6); // Bỏ "admin/" (6 ký tự)
    
    // Khởi chạy ứng dụng Admin
    $app = new AdminApp();
    exit;
}

// Nếu không phải admin, chạy ứng dụng bình thường
require_once '../app/config/config.php';
require_once '../app/Core/App.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Database.php';

// Khởi tạo ứng dụng (Kích hoạt Router)
$app = new App();
?>
