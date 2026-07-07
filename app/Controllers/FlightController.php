<?php
// app/Controllers/FlightController.php

class FlightController extends Controller {
    /** @var Flight */
    private $flightModel;

    public function __construct() {
        // Đã đổi thành 'Flight' cho khớp với tên class trong file app/Models/Flight.php
        $this->flightModel = $this->model('Flight');
    }

    public function index() {
        header("Location: " . BASEURL . "/flight/search");
        exit();
    }

    // Xử lý khi người dùng ấn nút Tìm kiếm từ trang chủ (URL: /flight/search)
    public function search() {
        // Nhận dữ liệu tìm kiếm từ form ở Trang chủ
        $departure = $_GET['departure'] ?? '';
        $destination = $_GET['destination'] ?? '';
        $departureDate = $_GET['departure_date'] ?? '';
        
        // Các dữ liệu khác từ form (hành khách, khứ hồi...)
        $adults = $_GET['adults'] ?? 2;
        $children = $_GET['children'] ?? 0;
        $roundTrip = $_GET['round_trip'] ?? null;
        $returnDate = $_GET['return_date'] ?? '';

        // Tham số bộ lọc (nếu có)
        $airlines = $_GET['airlines'] ?? [];
        $maxPrice = $_GET['max_price'] ?? 100000000;
        $promo = $_GET['promo'] ?? '';

        $hasSearch = (!empty($departure) || !empty($destination) || !empty($departureDate));

        if ($hasSearch) {
            // Truyền vào model (Đã map lại tên biến cho phù hợp với hàm searchFlights của bạn)
            $flights = $this->flightModel->searchFlights($departure, $destination, $departureDate, $airlines, $maxPrice);
        } else {
            $flights = []; 
        }

        // Truyền dữ liệu ra View
        $data = [
            'title' => 'Kết quả tìm kiếm vé - Skyline Ticket',
            'flights' => $flights,
            'search_params' => [
                'departure' => $departure,
                'destination' => $destination,
                'departure_date' => $departureDate,
                'return_date' => $returnDate,
                'adults' => $adults,
                'children' => $children,
                'round_trip' => $roundTrip,
                'airlines' => $airlines,
                'max_price' => $maxPrice,
                'promo' => $promo
            ],
            'has_search' => $hasSearch
        ];

        // GỌI ĐẾN FILE VIEW GIAO DIỆN TÌM KIẾM MÀ CHÚNG TA VỪA TẠO
        $this->view('flights/search', $data);
    }
}
?>