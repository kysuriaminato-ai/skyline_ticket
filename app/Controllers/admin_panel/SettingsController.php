<?php
// app/Controllers/admin_panel/SettingsController.php

class SettingsController extends Controller {
    public function __construct() {}

    public function index() {
        $data = ['title' => 'Cài đặt Hệ thống - Skyline Admin'];
        $this->view('admin/settings', $data);
    }

    public function update() {}
}
?>
