<?php
// app/Controllers/admin/DashboardController.php

class DashboardController extends Controller {
    private $userModel;
    private $flightModel;
    private $bookingModel;
    // private $paymentModel;

    public function __construct() {
        // Khởi tạo các model
        $this->userModel = $this->model('User');
        $this->flightModel = $this->model('Flight');
        $this->bookingModel = $this->model('Booking');
        // $this->paymentModel = $this->model('Payment');
    }

    // Trang dashboard của Admin
    public function index() {
        // Lấy thống kê
        $totalUsers = $this->userModel->getTotalUsers();
        $totalFlights = $this->flightModel->getTotalFlights();
        $totalBookings = $this->bookingModel->getTotalBookings();
        // $totalRevenue = $this->paymentModel->getTotalRevenue();
        $totalRevenue = 0; // Tạm fix - sẽ tạo bảng payments sau

        $data = [
            'title' => 'Dashboard - Quản trị hệ thống Skyline',
            'totalUsers' => $totalUsers,
            'totalFlights' => $totalFlights,
            'totalBookings' => $totalBookings,
            'totalRevenue' => $totalRevenue
        ];

        // Gọi View hiển thị dashboard
        $this->view('admin/dashboard', $data);
    }
}
?>