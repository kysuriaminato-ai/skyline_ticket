<?php
// app/Controllers/admin/FlightManagerController.php

class FlightManagerController extends Controller {
    /** @var Flight */
    private $flightModel;

    public function __construct() {
        // Khởi tạo model Flight (Sử dụng chung file app/Models/Flight.php)
        $this->flightModel = $this->model('Flight');
    }

    // Trang danh sách chuyến bay của Admin
    public function index() {
        $flights = $this->flightModel->getAllFlights();
        $data = [
            'title' => 'Quản lý Chuyến bay - Skyline Admin',
            'flights' => $flights
        ];
        $this->view('admin/flights_list', $data);
    }

    // Cập nhật giá vé
    /**
     * @param int|string $id
     */
    public function updatePrice($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $price = $_POST['price'];
            if ($this->flightModel->updatePrice($id, $price)) {
                header('Location: /admin/flightmanager');
            } else {
                die('Lỗi cập nhật giá');
            }
        } else {
            $flight = $this->flightModel->getFlightById($id);
            $data = [
                'title' => 'Cập nhật Giá Vé',
                'flight' => $flight
            ];
            $this->view('admin/flight_price', $data);
        }
    }

    // Cập nhật ghế
    /**
     * @param int|string $id
     */
    public function updateSeats($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $totalSeats = $_POST['total_seats'];
            $availableSeats = $_POST['available_seats'];
            if ($this->flightModel->updateSeats($id, $totalSeats, $availableSeats)) {
                header('Location: /admin/flightmanager');
            } else {
                die('Lỗi cập nhật ghế');
            }
        } else {
            $flight = $this->flightModel->getFlightById($id);
            $data = [
                'title' => 'Cập nhật Ghế',
                'flight' => $flight
            ];
            $this->view('admin/flight_seats', $data);
        }
    }
    
    // Gợi ý khung sườn các hàm quản lý trong tương lai (CRUD)
    public function create() {}
    public function store() {}
    
    /**
     * @param int|string $id
     */
    public function edit($id) {}
    
    /**
     * @param int|string $id
     */
    public function delete($id) {}
}
?>