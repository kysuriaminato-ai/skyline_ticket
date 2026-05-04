<?php
// app/Core/AdminApp.php
class AdminApp {
    /** @var mixed */
    protected $controller = 'DashboardController';
    /** @var string */
    protected $method = 'index';
    /** @var array */
    protected $params = [];

    public function __construct() {
        // 1. Chỉ admin và staff mới được vào khu vực này
        if (!isset($_SESSION['user_id']) || !in_array($_SESSION['role'], ['admin', 'staff'])) {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }

        // 2. Phân luồng trang mặc định (khi chỉ gõ /admin)
        if ($_SESSION['role'] === 'staff') {
            $this->controller = 'BookingManagerController'; // Trang mặc định của nhân viên
        } else {
            $this->controller = 'DashboardController'; // Trang mặc định của Admin
        }

        $url = $this->parseUrl();

        // Xóa phần tử 'admin' từ URL nếu có (do htaccess truyền vào)
        if (isset($url[0]) && strtolower($url[0]) === 'admin') {
            array_shift($url); 
        }

        // Tìm Controller trong thư mục app/Controllers/admin/
        if(isset($url[0]) && file_exists('../app/Controllers/admin/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        
        require_once '../app/Controllers/admin/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Tìm Method (Hàm trong Controller)
        if(isset($url[1])) {
            if(method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Lấy Parameters
        $this->params = $url ? array_values($url) : [];

        // Gọi hàm trong Controller và truyền tham số
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    /**
     * @return array|null
     */
    public function parseUrl() {
        if(isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
?>