<?php
// app/Controllers/admin/ReportsController.php

class ReportsController extends Controller {
    private $userModel;
    private $flightModel;
    private $bookingModel;
    private $paymentModel;

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

        $this->userModel = $this->model('User');
        $this->flightModel = $this->model('Flight');
        $this->bookingModel = $this->model('Booking');
        $this->paymentModel = $this->model('Payment');
    }

    // Trang báo cáo chính
    public function index() {
        $totalRevenue = $this->paymentModel->getTotalRevenue();
        $totalBookings = $this->bookingModel->getTotalBookings();
        $totalUsers = $this->userModel->getTotalUsers();
        $totalFlights = $this->flightModel->getTotalFlights();

        $monthlyBookings = $this->getMonthlyBookings();
        $monthlyRevenue = $this->getMonthlyRevenue();

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

    // Báo cáo chi tiết
    public function detailed() {
        $bookings = $this->bookingModel->getAllBookings();
        $payments = $this->paymentModel->getAllPayments();

        $data = [
            'title' => 'Báo cáo Chi tiết',
            'bookings' => $bookings,
            'payments' => $payments
        ];

        $this->view('admin/reports_detailed', $data);
    }

    private function getMonthlyBookings() {
        // ĐÃ SỬA: Gọi hàm getMonthlyBookingsReport() từ BookingModel
        return $this->bookingModel->getMonthlyBookingsReport();
    }

    private function getMonthlyRevenue() {
        // ĐÃ SỬA: Gọi hàm getMonthlyRevenueReport() từ PaymentModel
        return $this->paymentModel->getMonthlyRevenueReport();
    }
}
?>