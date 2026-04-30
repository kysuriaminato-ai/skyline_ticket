<?php
// app/Controllers/admin_panel/ReportsController.php

class ReportsController extends Controller {
    private $userModel;
    private $flightModel;
    private $bookingModel;

    public function __construct() {
        $this->userModel = $this->model('User');
        $this->flightModel = $this->model('Flight');
        $this->bookingModel = $this->model('Booking');
    }

    public function index() {
        $totalRevenue = 0;
        $totalBookings = $this->bookingModel->getTotalBookings();
        $totalUsers = $this->userModel->getTotalUsers();
        $totalFlights = $this->flightModel->getTotalFlights();
        $monthlyBookings = [];
        $monthlyRevenue = [];

        $data = [
            'title' => 'Báo cáo và Thống kê - Skyline Admin',
            'totalRevenue' => $totalRevenue,
            'totalBookings' => $totalBookings,
            'totalUsers' => $totalUsers,
            'totalFlights' => $totalFlights,
            'monthlyBookings' => $monthlyBookings,
            'monthlyRevenue' => $monthlyRevenue
        ];

        $this->view('admin/reports', $data);
    }

    public function detailed() {
        $bookings = $this->bookingModel->getAllBookings();
        $data = [
            'title' => 'Báo cáo Chi tiết',
            'bookings' => $bookings,
            'payments' => []
        ];
        $this->view('admin/reports_detailed', $data);
    }
}
?>
