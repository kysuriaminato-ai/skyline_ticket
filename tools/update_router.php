<?php
$c = file_get_contents('app/Core/App.php');

$newRouting = <<<PHP
    public function __construct() {
        \$url = \$this->parseUrl();
        \$controllerDir = '../app/Controllers/';

        // Check if URL targets a subdirectory (like admin/)
        if(isset(\$url[0]) && is_dir(\$controllerDir . strtolower(\$url[0]))) {
            \$controllerDir .= strtolower(\$url[0]) . '/';
            // Unset the directory from URL so the next segment becomes the controller
            unset(\$url[0]);
            \$url = array_values(\$url);
        }

        // 1. Tìm Controller
        if(isset(\$url[0]) && file_exists(\$controllerDir . ucfirst(\$url[0]) . 'Controller.php')) {
            \$this->controller = ucfirst(\$url[0]) . 'Controller';
            unset(\$url[0]);
        }
        
        require_once \$controllerDir . \$this->controller . '.php';
        \$this->controller = new \$this->controller;

        // 2. Tìm Method (Hàm trong Controller)
        if(isset(\$url[1])) {
            // Re-index array if needed
            \$url = array_values(\$url);
            if(isset(\$url[1]) && method_exists(\$this->controller, \$url[1])) {
                \$this->method = \$url[1];
                unset(\$url[1]);
            }
        }

        // 3. Lấy Parameters
        \$this->params = \$url ? array_values(\$url) : [];

        // 4. Gọi hàm trong Controller và truyền tham số
        call_user_func_array([\$this->controller, \$this->method], \$this->params);
    }
PHP;

// Need to replace the whole __construct method carefully
$start = strpos($c, 'public function __construct() {');
$end = strpos($c, 'public function parseUrl() {');

if ($start !== false && $end !== false) {
    $c = substr_replace($c, $newRouting . "\n\n    ", $start, $end - $start);
    file_put_contents('app/Core/App.php', $c);
    echo "App.php updated successfully.\n";
} else {
    echo "Could not find __construct in App.php\n";
}
