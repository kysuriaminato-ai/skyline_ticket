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

        // 1. Tìm Controller
        if(isset($url[0]) && file_exists('../app/Controllers/' . ucfirst($url[0]) . 'Controller.php')) {
            $this->controller = ucfirst($url[0]) . 'Controller';
            unset($url[0]);
        }
        require_once '../app/Controllers/' . $this->controller . '.php';
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
            // SỬA Ở ĐÂY: Tách bỏ phần Query String (các tham số phía sau dấu ?)
            // Điều này giúp ngăn lỗi không tìm thấy tên hàm (method)
            $url = explode('?', $_GET['url'])[0];
            
            // Xóa dấu / ở cuối, lọc ký tự an toàn và cắt mảng
            return explode('/', filter_var(rtrim($url, '/'), FILTER_SANITIZE_URL));
        }
    }
}
?>