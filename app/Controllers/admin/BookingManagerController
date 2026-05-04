<?php
// app/Controllers/admin/BookingManagerController.php

class BookingManagerController extends Controller {
    private $bookingModel;
    private $paymentModel;

    public function __construct() {
        // Cả Admin và Staff đều được vào đây để bán vé (Không có lệnh if chặn)
        $this->bookingModel = $this->model('Booking');
        $this->paymentModel = $this->model('Payment');
    }

    // Trang danh sách đặt chỗ
    public function index() {
        $bookings = $this->bookingModel->getAllBookings();

        $data = [
            'title' => 'Quản lý Đặt chỗ - Skyline Admin',
            'bookings' => $bookings
        ];

        $this->view('admin/bookings_list', $data);
    }

    // Xem chi tiết booking và thanh toán
    public function viewDetail($id) {
        $booking = $this->bookingModel->getBookingById($id);
        $payments = $this->paymentModel->getPaymentsByBooking($id);

        $data = [
            'title' => 'Chi tiết Đặt chỗ',
            'booking' => $booking,
            'payments' => $payments
        ];

        $this->view('admin/booking_detail', $data);
    }

    // Các hàm CRUD khác
    public function create() {}
    public function edit($id) {}
    public function delete($id) {}
}
?>