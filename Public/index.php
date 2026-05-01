<?php
// public/index.php
session_start();

// Mọi request tới /admin/* đã được file .htaccess điều hướng thẳng sang admin.php rồi.
// Do đó file index.php này CHỈ dùng cho client/người dùng bình thường.

require_once '../app/config/config.php';
require_once '../app/Core/App.php';
require_once '../app/Core/Controller.php';
require_once '../app/Core/Database.php';

// Khởi tạo ứng dụng (Kích hoạt Router Frontend)
$app = new App();
?>