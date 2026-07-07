<?php
$c = file_get_contents('app/Controllers/AdminController.php');

$search = <<<PHP
        \$totalRevenue = 0;

        \$data = [
            'title' => 'Dashboard - Quản trị hệ thống Skyline',
            'totalUsers' => \$totalUsers,
            'totalFlights' => \$totalFlights,
            'totalBookings' => \$totalBookings,
            'totalRevenue' => \$totalRevenue
        ];
PHP;

$replace = <<<PHP
        \$totalRevenue = \$bookingModel->getTotalRevenue();
        \$recentBookings = \$bookingModel->getRecentBookings(4);
        \$monthlyReport = \$bookingModel->getMonthlyBookingsReport();

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
file_put_contents('app/Controllers/AdminController.php', $c);
echo "Updated AdminController.php";
