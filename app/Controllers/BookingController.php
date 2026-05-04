<?php
// app/Controllers/BookingController.php

class BookingController extends Controller {
    private $flightModel;

    public function __construct() {
        // Đảm bảo người dùng đã đăng nhập mới được vào trang đặt vé
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
        $this->flightModel = $this->model('Flight');
    }

    // Trang hiển thị form nhập thông tin hành khách và thanh toán
    public function checkout() {
        // Nhận dữ liệu từ URL (chuyển từ trang tìm kiếm sang)
        $flightId = $_GET['flight_id'] ?? null;
        $class = $_GET['class'] ?? 'eco'; // eco, preeco, biz
        $fareIndex = $_GET['fare_index'] ?? 0;
        
        // Hứng tên Sân bay từ trang tìm kiếm đẩy qua
        $dept = $_GET['dept'] ?? 'Hà Nội (HAN)';
        $dest = $_GET['dest'] ?? 'Melbourne (MEL)';
        
        $adults = 1;
        $children = 0;

        if (!$flightId) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        // Tự động điều chỉnh mức giá tùy theo bay Nội địa hay Quốc tế
        $isDomestic = (stripos($dest, 'Phú Quốc') !== false || stripos($dest, 'Hồ Chí Minh') !== false || stripos($dest, 'Đà Nẵng') !== false || stripos($dest, 'Nha Trang') !== false || stripos($dest, 'Đà Lạt') !== false);
        $basePrice1 = $isDomestic ? 1500000 : 16053000;
        $basePrice2 = $isDomestic ? 1200000 : 14500000;
        $basePrice3 = $isDomestic ? 900000 : 12200000;

        // MẢNG DỮ LIỆU DEMO THÔNG MINH
        $demoFlights = [
            991 => ['id' => 991, 'flight_code' => 'VN 273', 'departure' => $dept, 'destination' => $dest, 'departure_time' => date('Y-m-d 16:00:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 18:25:00', strtotime('+1 days')), 'price' => $basePrice1, 'airlines' => 'Vietnam Airlines'],
            992 => ['id' => 992, 'flight_code' => 'VN 249', 'departure' => $dept, 'destination' => $dest, 'departure_time' => date('Y-m-d 15:30:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 17:45:00', strtotime('+1 days')), 'price' => $basePrice1, 'airlines' => 'Vietnam Airlines'],
            993 => ['id' => 993, 'flight_code' => 'QH 215', 'departure' => $dept, 'destination' => $dest, 'departure_time' => date('Y-m-d 10:00:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 12:25:00', strtotime('+1 days')), 'price' => $basePrice2, 'airlines' => 'Bamboo Airways'],
            994 => ['id' => 994, 'flight_code' => 'VJ 189', 'departure' => $dept, 'destination' => $dest, 'departure_time' => date('Y-m-d 05:30:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 07:45:00', strtotime('+1 days')), 'price' => $basePrice3, 'airlines' => 'Vietjet Air']
        ];

        // Lấy thông tin chuyến bay từ DB thật
        $flight = $this->flightModel->getFlightById($flightId);

        // NẾU ID >= 991 tức là người dùng đang thao tác trên các chuyến bay giả lập
        if ($flightId >= 991 && isset($demoFlights[$flightId])) {
            $flight = $demoFlights[$flightId];
        }

        if (!$flight) {
            die("Không tìm thấy chuyến bay.");
        }

        // Tính toán lại giá vé dựa trên hạng ghế
        $basePrice = $flight['price'];
        $finalPrice = $basePrice;
        $className = 'Phổ thông';

        if ($class === 'preeco') {
            $finalPrice = $basePrice + ($isDomestic ? 1500000 : 8622000);
            $className = 'Phổ thông Đặc biệt';
        } elseif ($class === 'biz') {
            $finalPrice = $basePrice + ($isDomestic ? 3500000 : 39103000);
            $className = 'Thương gia';
        }

        // Thêm phí loại vé (Tiêu chuẩn/Linh hoạt)
        if ($fareIndex == 1) {
            $finalPrice += ($isDomestic ? 500000 : 5000000); 
            $className .= ' Linh hoạt';
        } else {
            $className .= ' Tiêu chuẩn';
        }

        $data = [
            'title' => 'Thanh toán & Đặt vé - Skyline Ticket',
            'flight' => $flight,
            'booking_info' => [
                'class' => $class,
                'class_name' => $className,
                'price_per_pax' => $finalPrice,
                'adults' => $adults,
                'children' => $children,
                'total_price' => $finalPrice * $adults 
            ]
        ];

        // GỌI GIAO DIỆN THANH TOÁN
        $this->view('booking/checkout', $data);
    }

    public function process() {
        // ... logic lưu database sẽ viết ở đây ...
    }
}
?>