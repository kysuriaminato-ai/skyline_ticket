<?php
// public/admin.php
session_start();

// Nạp các file cấu hình và lõi (Core)
require_once '../app/config/config.php';
require_once '../app/Core/AdminApp.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Database.php';

// Khởi chạy ứng dụng Admin
$app = new AdminApp();
?>
