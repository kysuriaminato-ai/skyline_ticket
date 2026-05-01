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
        // Nhận dữ liệu tìm kiếm
        $from = $_GET['from'] ?? '';
        $to = $_GET['to'] ?? '';
        $date = $_GET['date'] ?? '';
        $cabinClass = $_GET['cabin_class'] ?? 'Phổ thông (Economy)';
        $airlines = $_GET['airlines'] ?? [];
        $maxPrice = $_GET['max_price'] ?? 100000000;

        $hasSearch = (!empty($from) || !empty($to) || !empty($date));

        if ($hasSearch) {
            $flights = $this->flightModel->searchFlights($from, $to, $date, $airlines, $maxPrice);
        } else {
            $flights = []; 
        }

        // Truyền dữ liệu ra View
        $data = [
            'title' => 'Kết quả tìm kiếm vé',
            'flights' => $flights,
            'search_params' => [
                'from' => $from,
                'to' => $to,
                'date' => $date,
                'cabin_class' => $cabinClass,
                'airlines' => $airlines,
                'max_price' => $maxPrice
            ],
            'has_search' => $hasSearch
        ];

        // GỌI ĐẾN FILE VIEW list.php NHƯ CẤU TRÚC BẠN ĐÃ TẠO
        $this->view('flights/list', $data);
    }
}
?>