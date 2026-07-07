<?php
// app/Core/App.php
class App {
    /** @var mixed */
    protected $controller = 'HomeController';
    /** @var string */
    protected $method = 'index';
    /** @var array */
    protected $params = [];

        public function __construct() {
        $url = $this->parseUrl();
        $controllerDir = '../app/Controllers/';

        // Check if URL targets a subdirectory (like admin/)
        if(isset($url[0]) && is_dir($controllerDir . strtolower($url[0]))) {
            $controllerDir .= strtolower($url[0]) . '/';
            // Unset the directory from URL so the next segment becomes the controller
            unset($url[0]);
            $url = array_values($url);
        }

        // 1. Tìm Controller
        if(isset($url[0]) && file_exists($controllerDir . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        
        require_once $controllerDir . $this->controller . '.php';
        $this->controller = new $this->controller;

        // 2. Tìm Method (Hàm trong Controller)
        // Since we might have unset $url[0] multiple times, let's just re-index it now
        $url = $url ? array_values($url) : [];
        if(isset($url[0])) {
            if(method_exists($this->controller, $url[0])) {
                $this->method = $url[0];
                unset($url[0]);
            }
        }

        // 3. Lấy Parameters
        $this->params = $url ? array_values($url) : [];

        // 4. Gọi hàm trong Controller và truyền tham số
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl() {
        if(isset($_GET['url'])) {
            // SỬA Ở ĐÂY: Tách bỏ phần Query String (các tham số phía sau dấu ?)
            // Điều này giúp ngăn lỗi không tìm thấy tên hàm (method)
            $url = explode('?', $_GET['url'])[0];
            
            // Xóa dấu / ở cuối, lọc ký tự an toàn và cắt mảng
            return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
        }
    }
}
?>