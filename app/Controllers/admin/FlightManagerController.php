<?php
// app/Controllers/admin/FlightManagerController.php

class FlightManagerController extends Controller {
    private $flightModel;

    public function __construct() {
        // Cả Admin và Staff đều được vào đây để quản lý chuyến bay
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
    
    // Các hàm CRUD khác
    public function create() {}
    public function store() {}
    public function edit($id) {}
    public function delete($id) {}
}
?>