<?php
// app/Controllers/CheckoutController.php
class CheckoutController extends Controller {
    /** @var Flight */
    private $flightModel;

    public function __construct() {
        // Đảm bảo bạn có hàm getFlightById() trong FlightModel
        $this->flightModel = $this->model('Flight');
    }

    public function index() {
        // 1. Nhận ID từ URL
        $flight_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $cabin_class = isset($_GET['cabin_class']) ? $_GET['cabin_class'] : 'Phổ thông (Economy)';

        // 2. Lấy thông tin chuyến bay từ DB thông qua Model
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

    public function process() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $flight_id = $_POST['flight_id'] ?? '';
            $fullname = $_POST['fullname'] ?? '';
            
            // Cập nhật số lượng ghế sau khi đặt
            $this->flightModel->bookSeat($flight_id);

            echo "<div style='text-align: center; margin-top: 50px; font-family: sans-serif;'>";
            echo "<h1 style='color: green;'>Đặt vé thành công!</h1>";
            echo "<p>Cảm ơn hành khách <strong>" . htmlspecialchars($fullname) . "</strong> đã đặt vé.</p>";
            echo "<a href='" . BASEURL . "/home' style='padding: 10px 20px; background: #0056b3; color: #fff; text-decoration: none; border-radius: 5px;'>Quay lại trang chủ</a>";
            echo "</div>";
        } else {
            header("Location: " . BASEURL . "/home");
            exit();
        }
    }
}
?>