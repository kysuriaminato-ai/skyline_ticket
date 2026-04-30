<?php
// app/Controllers/admin_panel/BookingManagerController.php

class BookingManagerController extends Controller {
    private $bookingModel;

    public function __construct() {
        $this->bookingModel = $this->model('Booking');
    }

    public function index() {
        $bookings = $this->bookingModel->getAllBookings();
        $data = [
            'title' => 'Quản lý Đặt chỗ - Skyline Admin',
            'bookings' => $bookings
        ];
        $this->view('admin/bookings_list', $data);
    }

    public function viewDetail($id) {
        $booking = $this->bookingModel->getBookingById($id);
        $data = [
            'title' => 'Chi tiết Đặt chỗ',
            'booking' => $booking,
            'payments' => []
        ];
        $this->view('admin/booking_detail', $data);
    }

    public function create() {}
    public function edit($id) {}
    public function delete($id) {}
}
?>
