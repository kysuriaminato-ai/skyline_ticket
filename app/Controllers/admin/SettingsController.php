<?php
// app/Controllers/admin/SettingsController.php

class SettingsController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }

        // CHẶN STAFF: Nếu không phải admin thì đẩy về trang bán vé
        if ($_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/admin/bookingmanager");
            exit();
        }
    }

    // Trang cài đặt hệ thống
    public function index() {
        $data = [
            'title' => 'Cài đặt Hệ thống - Skyline Admin'
        ];

        $this->view('admin/settings', $data);
    }

    // Lưu cài đặt
    public function update() {
        // TODO: Logic cập nhật cài đặt
    }
}
?>