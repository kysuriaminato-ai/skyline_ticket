<?php
// app/Controllers/AuthController.php

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        // Khởi tạo model User (Sử dụng chung file app/Models/User.php)
        $this->userModel = $this->model('User');
    }

    // Trang Đăng nhập
    public function login() {
        // Nếu đã đăng nhập, chuyển hướng về trang chủ
        if (isset($_SESSION['user_name'])) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $data = [
            'title' => 'Đăng nhập - Skyline Ticket',
            'error' => ''
        ];

        // Xử lý khi người dùng submit form đăng nhập
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $data['error'] = 'Vui lòng nhập đầy đủ email và mật khẩu.';
            } else {
                // Gọi model để kiểm tra đăng nhập
                $loggedInUser = $this->userModel->login($email, $password);

                if ($loggedInUser) {
                    // Tạo session
                    $_SESSION['user_id'] = $loggedInUser['id'];
                    $_SESSION['user_name'] = $loggedInUser['fullname'];
                    $_SESSION['role'] = $loggedInUser['role'] ?? 'user';
                    
                    header("Location: " . BASEURL . "/home");
                    exit();
                } else {
                    $data['error'] = 'Email hoặc mật khẩu không chính xác.';
                }
            }
        }

        // Gọi view hiển thị form đăng nhập
        $this->view('auth/login', $data);
    }

    // Trang Đăng ký
    public function register() {
        // Nếu đã đăng nhập, chuyển hướng về trang chủ
        if (isset($_SESSION['user_name'])) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $data = [
            'title' => 'Đăng ký - Skyline Ticket',
            'error' => '',
            'success' => '',
            'fullname' => '',
            'email' => ''
        ];

        // Xử lý khi người dùng submit form đăng ký
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Lấy dữ liệu và làm sạch
            $data['fullname'] = trim($_POST['fullname'] ?? '');
            $data['email'] = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');

            // Validate
            if (empty($data['fullname']) || empty($data['email']) || empty($password) || empty($confirm_password)) {
                $data['error'] = 'Vui lòng điền đầy đủ thông tin.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Định dạng email không hợp lệ.';
            } elseif ($password !== $confirm_password) {
                $data['error'] = 'Mật khẩu xác nhận không khớp.';
            } elseif (strlen($password) < 6) {
                 $data['error'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
            } else {
                // Kiểm tra email đã tồn tại chưa
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['error'] = 'Email này đã được sử dụng. Vui lòng chọn email khác.';
                } else {
                    // Mã hóa mật khẩu và tạo tài khoản
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    $userData = [
                        'fullname' => $data['fullname'],
                        'email' => $data['email'],
                        'password' => $hashed_password
                    ];

                    if ($this->userModel->register($userData)) {
                        $data['success'] = 'Đăng ký thành công! Bạn có thể chuyển đến <a href="' . BASEURL . '/auth/login" class="fw-bold">trang đăng nhập</a>.';
                        // Reset form
                        $data['fullname'] = '';
                        $data['email'] = '';
                    } else {
                        $data['error'] = 'Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau.';
                    }
                }
            }
        }

        // Gọi view hiển thị form đăng ký
        $this->view('auth/register', $data);
    }

    // Xử lý Đăng xuất
    public function logout() {
        // Hủy bỏ tất cả các biến session
        $_SESSION = array();

        // Phá hủy session
        session_destroy();

        // Chuyển hướng về trang chủ
        header("Location: " . BASEURL . "/home");
        exit();
    }
}
?>