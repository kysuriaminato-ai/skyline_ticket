<?php
// public/admin.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// NẠP CÁC FILE CẤU HÌNH VÀ LÕI ADMIN
require_once '../app/config/config.php';   
require_once '../app/Core/Database.php';   
require_once '../app/Core/Controller.php'; 
require_once '../app/Core/AdminApp.php';   

// Khởi chạy ứng dụng Admin
$app = new AdminApp();
?>