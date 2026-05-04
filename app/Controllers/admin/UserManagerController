<?php
// app/Controllers/admin/UserManagerController.php

class UserManagerController extends Controller {
    private $userModel;

    public function __construct() {
        // CHẶN STAFF: Nếu không phải admin thì đẩy về trang bán vé
        if ($_SESSION['role'] !== 'admin') {
            header("Location: " . BASEURL . "/admin/bookingmanager");
            exit();
        }

        $this->userModel = $this->model('User');
    }

    // Trang danh sách người dùng
    public function index() {
        // Lấy tất cả người dùng
        $users = $this->userModel->getAllUsers();

        $data = [
            'title' => 'Quản lý Người dùng - Skyline Admin',
            'users' => $users
        ];

        $this->view('admin/users_list', $data);
    }

    // Cập nhật role
    public function updateRole($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $role = $_POST['role'];
            if ($this->userModel->updateRole($id, $role)) {
                header('Location: /admin/usermanager');
            } else {
                die('Lỗi cập nhật role');
            }
        } else {
            $user = $this->userModel->getUserById($id);
            $data = [
                'title' => 'Cập nhật Quyền',
                'user' => $user
            ];
            $this->view('admin/user_role', $data);
        }
    }

    // Các hàm CRUD khác
    public function create() {
        // TODO: Form thêm user
    }

    public function edit($id) {
        // TODO: Form sửa user
    }

    public function delete($id) {
        // TODO: Xóa user
    }
}
?>