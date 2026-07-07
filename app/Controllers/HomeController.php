<?php
// app/Controllers/HomeController.php

class HomeController extends Controller {
    public function index() {
        $flightModel = $this->model('Flight');
        
        $topDomestic = $flightModel->getTopDestinations(true, 4);
        $topIntl = $flightModel->getTopDestinations(false, 4);
        
        $recommended = null;
        if (isset($_SESSION['user_id'])) {
            $recommended = $flightModel->getRecommendedDestinations($_SESSION['user_id'], 4);
        }

        // Image mapping dictionary
        $imageMapping = [
            'Hồ Chí Minh' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80',
            'Hà Nội' => 'https://images.unsplash.com/photo-1599708153386-62bf3f044f51?auto=format&fit=crop&w=400&q=80',
            'Đà Nẵng' => 'https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80',
            'Vũng Tàu' => 'https://images.unsplash.com/photo-1602492576352-7b1f63d0c644?auto=format&fit=crop&w=400&q=80',
            'Phú Quốc' => 'https://images.unsplash.com/photo-1582650893339-71c12eab3a15?auto=format&fit=crop&w=400&q=80',
            'Nha Trang' => 'https://images.unsplash.com/photo-1576485290814-1c72ea4ac9cf?auto=format&fit=crop&w=400&q=80',
            'Bangkok' => 'https://images.unsplash.com/photo-1508009603885-247a5fb04114?auto=format&fit=crop&w=400&q=80',
            'Kuala Lumpur' => 'https://images.unsplash.com/photo-1506169894395-36397e4aa545?auto=format&fit=crop&w=400&q=80',
            'Manila' => 'https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=400&q=80',
            'Jakarta' => 'https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=400&q=80',
            'Dubai' => 'https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=400&q=80',
            'Tokyo' => 'https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?auto=format&fit=crop&w=400&q=80'
        ];

        $data = [
            'title' => 'Trang chủ - Skyline Ticket',
            'topDomestic' => $topDomestic,
            'topIntl' => $topIntl,
            'recommended' => $recommended,
            'imageMapping' => $imageMapping
        ];
        
        $this->view('home/index', $data);
    }
}
?>