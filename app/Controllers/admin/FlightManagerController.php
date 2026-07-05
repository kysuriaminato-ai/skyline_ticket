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
                header('Location: ' . BASEURL . '/admin/flightmanager');
                exit();
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
                header('Location: ' . BASEURL . '/admin/flightmanager');
                exit();
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
    
    // ==========================================
    // CÁC HÀM CRUD (Thêm, Sửa, Xóa chuyến bay)
    // ==========================================

    // Hiển thị Form thêm chuyến bay mới
    public function create() {
        $data = [
            'title' => 'Thêm Chuyến bay mới - Skyline Admin'
        ];
        $this->view('admin/flight_create', $data);
    }

    // Xử lý lưu chuyến bay mới vào CSDL
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'flight_code' => trim($_POST['flight_code']),
                'departure' => trim($_POST['departure']),
                'destination' => trim($_POST['destination']),
                'departure_time' => trim($_POST['departure_time']),
                'arrival_time' => trim($_POST['arrival_time']),
                'price' => trim($_POST['price']),
                'airlines' => trim($_POST['airlines']),
                'total_seats' => trim($_POST['total_seats'])
            ];

            if ($this->flightModel->addFlight($data)) {
                // Thêm thành công thì quay về trang danh sách
                header('Location: ' . BASEURL . '/admin/flightmanager');
                exit();
            } else {
                die('Có lỗi xảy ra khi thêm chuyến bay.');
            }
        }
    }

    public function edit($id) {}
    public function delete($id) {}
}
?>