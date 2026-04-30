<?php
// app/Controllers/HomeController.php
class HomeController extends Controller {
    public function index() {
        $data = [
            'title' => 'Trang chủ - Skyline Ticket'
        ];
        // Load view trang chủ
        $this->view('home/index', $data);
    }
}
?>
