<?php
class ProfileController extends Controller {
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
    }

    public function index() {
        $bookingModel = $this->model('Booking');
        // Lấy danh sách vé của user đang đăng nhập
        $myBookings = $bookingModel->getBookingsByUser($_SESSION['user_id']);

        $data = [
            'title' => 'Lịch sử đặt vé - Skyline Ticket',
            'bookings' => $myBookings
        ];

        $this->view('profile/index', $data);
    }
}
?>


