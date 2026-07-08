<?php
// app/Controllers/BookingController.php

class BookingController extends Controller {
    
    public function __construct() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
    }

    // 1. Thêm hàm index() để tránh lỗi khi user chỉ gõ /booking
    public function index() {
        header("Location: " . BASEURL . "/home");
        exit();
    }

    // 2. Thêm hàm checkin() để xử lý luồng từ URL /booking/checkin
    public function checkin() {
        $pnr = $_GET['pnr'] ?? '';
        $lastName = $_GET['last_name'] ?? '';

        // Tạm in ra màn hình để xác nhận hệ thống đã bắt đúng hàm
        echo "<div style='font-family: sans-serif; margin: 50px;'>";
        echo "<h2>Trang Check-in trực tuyến</h2>";
        echo "<p>Đang kiểm tra vé cho mã PNR: <strong>" . htmlspecialchars($pnr) . "</strong></p>";
        echo "<p>Họ khách hàng: <strong>" . htmlspecialchars($lastName) . "</strong></p>";
        echo "</div>";
        
        // Sau này bạn có thể viết thêm logic DB và gọi View ở đây:
        // $this->view('booking/checkin', ['pnr' => $pnr]);
    }

    public function checkout() {
        $flightId = $_GET['flight_id'] ?? null;
        $class_name = $_GET['class_name'] ?? 'Phổ Thông Tiết Kiệm';
        $price = isset($_GET['price']) ? (int)$_GET['price'] : 13200000;
        $adults = (int)($_GET['adults'] ?? 1);
        $children = (int)($_GET['children'] ?? 0);

        if (!$flightId) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $price_per_pax = $price;
        $total_price = $price_per_pax * ($adults + $children);

        $promo = $_GET['promo'] ?? '';
        $promoName = '';
        $discountAmount = 0;

        if ($promo === 'summer2026') {
            $promoName = 'Chào hè 2026 (-10%)';
            $discountAmount = $total_price * 0.10;
        } else if ($promo === 'family15' && ($adults + $children) >= 3) {
            $promoName = 'Ưu đãi gia đình (-15%)';
            $discountAmount = $total_price * 0.15;
        }

        $final_price = $total_price - $discountAmount;

        $data = [
            'title' => 'Thanh toán & Đặt vé - Skyline Ticket',
            'flight' => [
                'id' => $flightId,
                'flight_code' => 'VN 273',
                'departure' => $_GET['dept'] ?? 'Hà Nội (HAN)',
                'destination' => $_GET['dest'] ?? 'Melbourne (MEL)',
                'departure_time' => '2026-05-05 16:00:00',
                'arrival_time' => '2026-05-06 04:25:00'
            ],
            'info' => [
                'class' => $class_name,
                'adults' => $adults,
                'children' => $children,
                'price_per_pax' => $price_per_pax,
                'total_price' => $total_price,
                'promo_name' => $promoName,
                'discount_amount' => $discountAmount,
                'final_price' => $final_price
            ]
        ];

        $this->view('booking/checkout', $data);
    }

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $flightId = $_POST['flight_id'];
            $totalPrice = $_POST['total_price']; // Giá đã bao gồm Tiện ích
            $adults = (int)$_POST['adults'];
            $children = (int)$_POST['children'];
            $totalPassengers = $adults + $children;
            
            // Lấy thông tin khách hàng từ Form
            $contactName = $_POST['contact_name'] ?? '';
            $contactPhone = $_POST['contact_phone'] ?? '';
            $contactEmail = $_POST['contact_email'] ?? '';
            
            // Đóng gói thông tin Tiện ích (Gói hỗ trợ + Bảo hiểm + Nâng hạng ghế + Bảo hiểm Du lịch)
            $addons = [
                'support_tier' => $_POST['support_tier'] ?? 0,
                'baggage_protection' => isset($_POST['baggage_protection']) ? 150000 : 0,
                'seat_upgrade' => $_POST['seat_upgrade'] ?? 0,
                'insurance' => $_POST['insurance'] ?? 0
            ];
            $addonsJson = json_encode($addons);
            
            $db = new Database();

            // Khắc phục lỗi Duplicate Flight & Rút gọn chuỗi để không bị tràn VARCHAR
            $db->query("SELECT id FROM flights WHERE id = :id");
            $db->bind(':id', $flightId);
            if (!$db->single()) {
                // Rút ngắn mã xuống dạng FLT-XXXXX để tránh lỗi SQL Data Too Long
                $unique_flight_code = 'FLT-' . substr(time(), -5) . $flightId; 
                $db->query("INSERT INTO flights (id, flight_code, departure, destination, departure_time, arrival_time, price, airlines, status, total_seats, available_seats) 
                            VALUES (:id, :flight_code, 'HAN', 'MEL', '2026-05-05 16:00:00', '2026-05-06 04:25:00', :price, 'Skyline Airlines', 1, 180, 180)");
                $db->bind(':id', $flightId);
                $db->bind(':flight_code', $unique_flight_code);
                $db->bind(':price', $totalPrice / $totalPassengers);
                $db->execute();
            }

            $bookingCode = 'BK-' . strtoupper(substr(md5(uniqid()), 0, 4));

            // Đưa thêm thông tin khách hàng vào mảng
            $bookingModel = $this->model('Booking');
            $bookingData = [
                'user_id' => $_SESSION['user_id'],
                'flight_id' => $flightId,
                'booking_code' => $bookingCode,
                'passengers_count' => $totalPassengers,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'contact_name' => $contactName,
                'contact_phone' => $contactPhone,
                'contact_email' => $contactEmail,
                'addons_info' => $addonsJson
            ];

            $bookingId = $bookingModel->createBooking($bookingData);

            if ($bookingId) {
                $_SESSION['last_booking_time'] = time();
                header("Location: " . BASEURL . "/booking/payment?code=" . $bookingCode);
                exit();
            } else {
                die("Lỗi: Không thể khởi tạo đơn hàng.");
            }
        }
    }

    // SỬ DỤNG MODEL THAY VÌ GỌI DATABASE TRỰC TIẾP (Khắc phục lỗi màn hình trắng)
    public function payment() {
        $bookingCode = $_GET['code'] ?? null;
        if (!$bookingCode) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $bookingModel = $this->model('Booking');
        $booking = $bookingModel->getBookingByCode($bookingCode);

        if (!$booking) die("Đơn hàng không tồn tại.");

        $startTime = $_SESSION['last_booking_time'] ?? time();
        $elapsed = time() - $startTime;
        $remaining = 600 - $elapsed;

        $data = [
            'booking' => $booking,
            'remaining_time' => ($remaining > 0) ? $remaining : 0
        ];

        $this->view('booking/payment', $data);
    }

    public function confirmPayment() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $code = $_POST['booking_code'];
            
            $bookingModel = $this->model('Booking');
            if ($bookingModel->updateBookingStatus($code, 'confirmed')) {
                echo "<script>
                    window.location.href = '" . BASEURL . "/booking/ticket?code=" . $code . "';
                </script>";
            }
        }
    }

    public function ticket() {
        $bookingCode = $_GET['code'] ?? null;
        if (!$bookingCode) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $bookingModel = $this->model('Booking');
        $booking = $bookingModel->getBookingByCode($bookingCode);

        if (!$booking) {
            die("Đơn hàng không tồn tại.");
        }

        // Đảm bảo chỉ người mua hoặc admin mới xem được vé
        if ($_SESSION['user_id'] != $booking['user_id'] && $_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $data = [
            'title' => 'Vé Máy Bay Điện Tử - Skyline Ticket',
            'booking' => $booking
        ];

        $this->view('booking/ticket', $data);
    }

    public function cancelBooking() {
        $code = $_GET['code'] ?? '';
        $bookingModel = $this->model('Booking');
        $bookingModel->updateBookingStatus($code, 'cancelled');
    }

    public function history() {
        $bookingModel = $this->model('Booking');
        $bookings = $bookingModel->getBookingsByUser($_SESSION['user_id']);
        
        $data = [
            'title' => 'Lịch sử thanh toán & Đặt vé - Skyline Ticket',
            'bookings' => $bookings
        ];
        $this->view('booking/history', $data);
    }

    public function getMonthlyBookingsReport() {
        $this->db->query("SELECT MONTH(created_at) as month, COUNT(*) as count FROM bookings WHERE YEAR(created_at) = YEAR(CURDATE()) GROUP BY MONTH(created_at)");
        return $this->db->resultSet();
    }
}
?>