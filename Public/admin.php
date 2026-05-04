<?php
// public/admin.php
session_start();

// NẠP CÁC FILE CẤU HÌNH VÀ LÕI (CORE) TẠI ĐÂY MỘT LẦN DUY NHẤT VÀ THEO ĐÚNG THỨ TỰ
require_once '../app/config/config.php';   // 1. Cấu hình (hằng số như BASEURL, DB_HOST...)
require_once '../app/Core/Database.php';   // 2. Database (nếu Model nào cần ngay lập tức)
require_once '../app/Core/Controller.php'; // 3. Base Controller
require_once '../app/Core/AdminApp.php';   // 4. Lõi Ứng dụng Admin

// Khởi chạy ứng dụng Admin
$app = new AdminApp();
?>