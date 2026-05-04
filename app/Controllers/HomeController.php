<?php
// app/Controllers/HomeController.php

class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Trang chủ - Skyline Ticket'
        ];
        
        // Gọi view trang chủ để hiển thị giao diện
        $this->view('home/index', $data);
    }
}
?>