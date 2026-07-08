<?php
// app/Controllers/admin/DashboardController.php

class DashboardController extends Controller {
    private $userModel;
    private $flightModel;
    private $bookingModel;

    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }

        // CHẶN STAFF: Nếu không phải admin thì đẩy về trang bán vé
        if ($_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/admin/bookingmanager");
            exit();
        }

        // Khởi tạo các model
        $this->userModel = $this->model('User');

        $this->flightModel = $this->model('Flight');
        $this->bookingModel = $this->model('Booking');
    }

    // Trang dashboard của Admin
    public function index() {
        // Lấy thống kê
        $totalUsers = $this->userModel->getTotalUsers();
        $totalFlights = $this->flightModel->getTotalFlights();
        $totalBookings = $this->bookingModel->getTotalBookings();
        $totalRevenue = $this->bookingModel->getTotalRevenue();
        $monthlyReport = $this->bookingModel->getMonthlyBookingsReport();

        $data = [
            'title' => 'Dashboard - Quản trị hệ thống Skyline',
            'totalUsers' => $totalUsers,
            'totalFlights' => $totalFlights,
            'totalBookings' => $totalBookings,
            'totalRevenue' => $totalRevenue,
            'monthlyReport' => $monthlyReport
        ];

        // Gọi View hiển thị dashboard
        $this->view('admin/dashboard', $data);
    }
}
?>