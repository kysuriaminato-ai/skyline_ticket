<?php
// public/setup_database.php
// Script để setup database (CHỈ DÙNG LẦN ĐẦU, SAU ĐÓ XÓA FILE NÀY)

require_once '../app/config/config.php';

// Khởi tạo connection không có database (để tạo database)
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS);

if ($conn->connect_error) {
    die('❌ Lỗi kết nối: ' . $conn->connect_error);
}

// XÓA database cũ nếu tồn tại
$conn->query("DROP DATABASE IF EXISTS flight_db");

// Đọc file SQL
$sql = file_get_contents('../database.sql');

if ($sql === false) {
    die('❌ Lỗi: Không tìm thấy file database.sql');
}

// Chia thành các câu lệnh riêng biệt
$statements = array_filter(
    array_map('trim', explode(';', $sql)),
    function($stmt) { return !empty($stmt) && strpos($stmt, '--') !== 0; }
);

echo '<h2>🔄 Đang setup database...</h2>';
echo '<ul>';

$count = 0;
foreach ($statements as $statement) {
    if (empty(trim($statement))) continue;
    
    if ($conn->multi_query($statement . ";")) {
        echo '<li>✅ ' . substr($statement, 0, 50) . '...</li>';
        $count++;
        // Xóa các result sets
        while ($conn->more_results()) {
            $conn->next_result();
        }
    } else {
        echo '<li>❌ Lỗi: ' . htmlspecialchars($conn->error) . '</li>';
    }
}

echo '</ul>';
echo "<h3>✅ Setup hoàn tất! ($count câu lệnh)</h3>";
echo '<p><strong>Thông tin đăng nhập:</strong></p>';
echo '<ul>';
echo '<li>Email: <code>admin@skyline.com</code></li>';
echo '<li>Password: <code>admin123</code></li>';
echo '</ul>';
echo '<p><strong>Các bước tiếp theo:</strong></p>';
echo '<ol>';
echo '<li>Đăng xuất hiện tại (nếu có)</li>';
echo '<li><a href="' . BASEURL . '/" target="_blank">🏠 Về trang chủ</a></li>';
echo '<li>Đăng nhập với tài khoản admin</li>';
echo '<li><a href="' . BASEURL . '/admin" target="_blank">📊 Vào trang admin</a></li>';
echo '</ol>';
echo '<br><br><strong style="color:red;">⚠️ LƯU Ý: Hãy xóa file <code>setup_database.php</code> và <code>test_admin.php</code> sau khi hoàn thành!</strong>';

$conn->close();
?>
