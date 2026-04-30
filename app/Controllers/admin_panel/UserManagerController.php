<?php
// app/Controllers/admin_panel/UserManagerController.php

class UserManagerController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    // Trang danh sách người dùng
    public function index() {
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

    public function create() {}
    public function edit($id) {}
    public function delete($id) {}
}
?>
