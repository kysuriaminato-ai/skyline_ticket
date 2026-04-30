<?php
// app/Controllers/admin/SettingsController.php

class SettingsController extends Controller {

    public function __construct() {
        // Có thể khởi tạo model settings nếu có
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