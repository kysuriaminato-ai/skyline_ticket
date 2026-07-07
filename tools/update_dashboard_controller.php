<?php
$c = file_get_contents('app/Controllers/admin/DashboardController.php');

$search = <<<PHP
        \$totalRevenue = 0; // Tạm fix - sẽ tạo bảng payments sau

        \$data = [
            'title' => 'Dashboard - Quản trị hệ thống Skyline',
            'totalUsers' => \$totalUsers,
            'totalFlights' => \$totalFlights,
            'totalBookings' => \$totalBookings,
            'totalRevenue' => \$totalRevenue
        ];
PHP;

$replace = <<<PHP
        \$totalRevenue = \$this->bookingModel->getTotalRevenue();
        \$recentBookings = \$this->bookingModel->getRecentBookings(4);
        \$monthlyReport = \$this->bookingModel->getMonthlyBookingsReport();

        \$data = [
            'title' => 'Dashboard - Quản trị hệ thống Skyline',
            'totalUsers' => \$totalUsers,
            'totalFlights' => \$totalFlights,
            'totalBookings' => \$totalBookings,
            'totalRevenue' => \$totalRevenue,
            'recentBookings' => \$recentBookings,
            'monthlyReport' => \$monthlyReport
        ];
PHP;

$c = str_replace($search, $replace, $c);
file_put_contents('app/Controllers/admin/DashboardController.php', $c);
echo "Updated DashboardController.php\n";

// Also we should delete or rename AdminController.php to avoid any weird confusion later
if (file_exists('app/Controllers/AdminController.php')) {
    rename('app/Controllers/AdminController.php', 'app/Controllers/AdminController.bak');
    echo "Backed up AdminController.php\n";
}
