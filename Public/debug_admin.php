<?php
// public/debug_admin.php
session_start();

echo '<h2>🔍 DEBUG ADMIN PAGE</h2>';
echo '<hr>';

echo '<h3>📍 URL Request:</h3>';
echo '<pre>';
echo 'REQUEST_URI: ' . ($_SERVER['REQUEST_URI'] ?? 'N/A') . "\n";
echo 'QUERY_STRING: ' . ($_SERVER['QUERY_STRING'] ?? 'N/A') . "\n";
echo 'GET[url]: ' . ($_GET['url'] ?? 'N/A') . "\n";
echo '</pre>';

echo '<h3>🔐 SESSION INFO:</h3>';
echo '<pre>';
echo 'user_id: ' . ($_SESSION['user_id'] ?? 'NOT SET') . "\n";
echo 'user_name: ' . ($_SESSION['user_name'] ?? 'NOT SET') . "\n";
echo 'role: ' . ($_SESSION['role'] ?? 'NOT SET') . "\n";
echo '</pre>';

echo '<h3>📝 Full SESSION:</h3>';
echo '<pre>';
var_dump($_SESSION);
echo '</pre>';

echo '<h3>🧪 AdminApp.php Test:</h3>';
echo 'Is admin? ';
if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin') {
    echo '<span style="color:green;font-weight:bold;">✅ YES - Bạn có quyền admin</span>';
} else {
    echo '<span style="color:red;font-weight:bold;">❌ NO - Không phải admin</span>';
}

echo '<br><br><a href="' . (isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '/skyline_ticket/public/') . '">← Quay lại</a>';
?>
