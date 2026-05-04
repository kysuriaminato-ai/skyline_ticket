<?php
// public/index.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

// NẠP CÁC FILE CẤU HÌNH VÀ LÕI
require_once '../app/config/config.php';
require_once '../app/Core/Database.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/App.php';

// Khởi chạy ứng dụng Frontend
$app = new App();
?>