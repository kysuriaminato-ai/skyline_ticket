<?php
// app/Core/AdminApp.php
class AdminApp {
    // Đặt Controller mặc định của Admin là Dashboard
    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct() {
        $url = $this->parseUrl();

        // 1. Tìm Controller trong thư mục app/Controllers/admin_panel/
        if(isset($url[0]) && file_exists('../app/Controllers/admin_panel/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        
        // Nạp file Controller
        require_once '../app/Controllers/admin_panel/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Tìm Method (Hàm trong Controller)
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // 3. Lấy Parameters
        $this->params = $url ? array_values($url) : [];

        // 4. Gọi hàm trong Controller và truyền tham số
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
    }
}
?>