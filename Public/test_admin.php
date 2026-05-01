<?php
// public/test_admin.php
// File helper để set admin role (CHỈ DÙNG CHO DEV, XÓA SAU KHI HOÀN THÀNH)

require_once '../app/config/config.php';
require_once '../app/Core/Database.php';

// Khởi tạo database connection
$db = new Database();

// Email của user muốn set làm admin
$admin_email = $_GET['email'] ?? 'admin@example.com'; // Thay bằng email thực của bạn

// Update role thành admin
$db->query("UPDATE users SET role = :role WHERE email = :email");
$db->bind(':role', 'admin');
$db->bind(':email', $admin_email);

if ($db->execute()) {
    echo "✅ Cập nhật role thành admin thành công cho: $admin_email";
    echo "<br><a href='" . BASEURL . "/admin'>👉 Truy cập trang admin</a>";
} else {
    echo "❌ Lỗi: Không thể cập nhật role hoặc email không tồn tại";
}
?>
