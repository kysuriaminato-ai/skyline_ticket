<?php
// app/Core/Controller.php
class Controller {
    // Hàm nạp Model
    /**
     * @param string $model
     * @return mixed
     */
    public function model(string $model) {
        require_once '../app/Models/' . $model . '.php';
        return new $model();
    }

    // Hàm nạp View
    /**
     * @param string $view
     * @param array $data
     * @return void
     */
    public function view(string $view, array $data = []) {
        if(file_exists('../app/Views/' . $view . '.php')) {
            require_once '../app/Views/' . $view . '.php';
        } else {
            die("Lỗi: View '$view' không tồn tại.");
        }
    }
}
?>