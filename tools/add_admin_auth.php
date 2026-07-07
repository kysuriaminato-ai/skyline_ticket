<?php
$controllers = glob('app/Controllers/admin/*.php');

foreach ($controllers as $file) {
    $c = file_get_contents($file);
    
    // Skip if already has auth check
    if (strpos($c, 'isset($_SESSION[\'role\'])') !== false || strpos($c, 'isset($_SESSION["role"])') !== false) {
        continue;
    }

    // Prepare auth code
    // Dashboard, Users, Reports, Settings require 'admin'
    // FlightManager, BookingManager allow 'admin' and 'staff'
    $authCode = "";
    if (strpos($file, 'Dashboard') !== false || strpos($file, 'User') !== false || strpos($file, 'Report') !== false || strpos($file, 'Setting') !== false) {
        $authCode = <<<PHP
        if (!isset(\$_SESSION['role']) || \$_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
PHP;
    } else {
        $authCode = <<<PHP
        if (!isset(\$_SESSION['role']) || (\$_SESSION['role'] !== 'admin' && \$_SESSION['role'] !== 'staff')) {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
PHP;
    }

    // Insert after __construct() {
    $c = preg_replace('/public function __construct\(\)\s*\{/', "$0\n$authCode\n", $c);
    
    file_put_contents($file, $c);
    echo "Added auth to $file\n";
}
