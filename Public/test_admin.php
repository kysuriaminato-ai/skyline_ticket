<?php
// public/test_admin.php
// Công cụ hỗ trợ cấp quyền Admin nhanh

require_once '../app/config/config.php';
require_once '../app/Core/Database.php';

$db = new Database();
$admin_email = $_GET['email'] ?? '';

// Kiểm tra xem có truyền email lên URL chưa
if (empty($admin_email)) {
    die("<div style='font-family: sans-serif; text-align: center; margin-top: 50px;'>
            <h3 style='color: red;'>❌ Lỗi: Chưa có email.</h3>
            <p>Vui lòng nhập email trên thanh địa chỉ URL.</p>
            <p>Ví dụ: <code>http://localhost/skyline_ticket/public/test_admin.php?email=quantri@gmail.com</code></p>
         </div>");
}

// Chạy lệnh cập nhật quyền Admin
$db->query("UPDATE users SET role = 'admin' WHERE email = :email");
$db->bind(':email', $admin_email);

if ($db->execute()) {
    echo "<div style='font-family: sans-serif; text-align: center; margin-top: 100px;'>";
    echo "<h1 style='color: #1cc88a;'>✅ Cấp quyền Admin thành công!</h1>";
    echo "<p style='font-size: 18px;'>Tài khoản <strong>{$admin_email}</strong> hiện đã là Quản trị viên hệ thống.</p>";
    echo "<br>";
    echo "<a href='" . BASEURL . "/auth/login' style='padding: 12px 25px; background: #4e73df; color: white; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px;'>Đi đến trang Đăng nhập</a>";
    echo "</div>";
} else {
    echo "<h3 style='color: red; text-align: center;'>❌ Lỗi hệ thống: Không thể kết nối Database.</h3>";
}
?>