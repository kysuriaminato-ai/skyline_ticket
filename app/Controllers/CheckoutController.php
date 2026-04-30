<?php
// app/Controllers/CheckoutController.php
class CheckoutController extends Controller {
    private $flightModel;

    public function __construct() {
        // Đảm bảo bạn có hàm getFlightById() trong FlightModel
        $this->flightModel = $this->model('FlightModel');
    }

    public function index() {
        // 1. Nhận ID từ URL
        $flight_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $cabin_class = isset($_GET['cabin_class']) ? $_GET['cabin_class'] : 'Phổ thông (Economy)';

        // 2. Lấy thông tin chuyến bay từ DB thông qua Model
        // (Lưu ý: Bạn cần thêm hàm getFlightById($id) vào trong app/Models/FlightModel.php nhé)
        $flight = $this->flightModel->getFlightById($flight_id);

        if (!$flight) {
            // Nếu không tìm thấy, điều hướng về trang chủ
            header("Location: " . BASEURL . "/home");
            exit();
        }

        // 3. Xử lý logic tính tiền (Logic đặt ở Controller, không để ở View)
        $price_multiplier = 1;
        if (strpos($cabin_class, 'Phổ thông ĐB') !== false) { $price_multiplier = 1.5; }
        elseif (strpos($cabin_class, 'Thương gia') !== false) { $price_multiplier = 3; }
        elseif (strpos($cabin_class, 'Hạng nhất') !== false) { $price_multiplier = 5; }

        $base_price = $flight["price"] * $price_multiplier; 
        $tax_fee = 1000000; 
        $total_price = $base_price + $tax_fee; 

        // 4. Gói dữ liệu và gọi View
        $data = [
            'title' => 'Thanh toán an toàn - Skyline Ticket',
            'flight' => $flight,
            'cabin_class' => $cabin_class,
            'base_price' => $base_price,
            'tax_fee' => $tax_fee,
            'total_price' => $total_price
        ];

        $this->view('flights/checkout', $data);
    }
}
?>
