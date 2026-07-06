<?php
// Bật session cho toàn bộ trang web
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Định nghĩa hằng số thư mục gốc để dễ gọi file sau này
define('ROOT_DIR', dirname(__DIR__)); 

// Nạp các file lõi
require_once ROOT_DIR . '/app/config/config.php';
require_once ROOT_DIR . '/app/Core/Database.php';
require_once ROOT_DIR . '/app/Core/Controller.php';
require_once ROOT_DIR . '/app/Core/App.php';

// Khởi chạy ứng dụng
$app = new App();