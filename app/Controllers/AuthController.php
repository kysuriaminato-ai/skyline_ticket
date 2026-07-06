<?php
// app/Controllers/AuthController.php

class AuthController extends Controller {
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    // ================= XỬ LÝ ĐĂNG NHẬP =================
    public function login() {
        if (isset($_SESSION['user_name'])) {
            header("Location: " . BASEURL . "/home");
            exit();
        }

        $data = [
            'title' => 'Đăng nhập - Skyline Ticket',
            'error' => ''
        ];

        // Bắt thông báo từ trang đăng ký chuyển sang
        if (isset($_GET['registered']) && $_GET['registered'] == 'success') {
            $data['success'] = 'Đăng ký thành công! Vui lòng đăng nhập bằng tài khoản vừa tạo.';
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');

            if (empty($email) || empty($password)) {
                $data['error'] = 'Vui lòng nhập đầy đủ email và mật khẩu.';
            } else {
                $loggedInUser = $this->userModel->login($email, $password);

                if ($loggedInUser) {
                    $_SESSION['user_id'] = $loggedInUser['id'];
                    $_SESSION['user_name'] = $loggedInUser['fullname'];
                    $_SESSION['role'] = $loggedInUser['role'] ?? 'user';
                    
                    // Redirect to welcome splash screen (3 seconds) before going to destination
                    header("Location: " . BASEURL . "/auth/welcome");
                    exit();
                } else {
                    $data['error'] = 'Email hoặc mật khẩu không chính xác.';
                }
            }
        }
        $this->view('auth/login', $data);
    }

    // ================= XỬ LÝ ĐĂNG KÝ =================
    public function register() {
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Hứng toàn bộ dữ liệu mới từ Form
            $title_user = trim($_POST['title'] ?? '');
            $gender = trim($_POST['gender'] ?? '');
            $last_name = trim($_POST['last_name'] ?? '');
            $first_name = trim($_POST['fullname'] ?? '');
            $fullname = $last_name . ' ' . $first_name; // Gộp Họ và Đệm Tên
            $dob = trim($_POST['dob'] ?? '');
            $nationality = trim($_POST['nationality'] ?? '');
            $email = trim($_POST['email'] ?? '');
            
            // Gộp mã vùng và số điện thoại
            $phone_code = trim($_POST['phone_code'] ?? '');
            $phone_number = trim($_POST['phone_number'] ?? '');
            $phone = $phone_code . ' ' . $phone_number;

            $password = trim($_POST['password'] ?? '');
            $confirm_password = trim($_POST['confirm_password'] ?? '');

            // Kiểm tra rỗng
            if (empty($last_name) || empty($first_name) || empty($email) || empty($password) || empty($dob) || empty($phone_number)) {
                $data['error'] = 'Vui lòng điền đầy đủ các trường thông tin bắt buộc (*).';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['error'] = 'Định dạng email không hợp lệ.';
            } elseif ($password !== $confirm_password) {
                $data['error'] = 'Mật khẩu xác nhận không khớp.';
            } else {
                if ($this->userModel->findUserByEmail($email)) {
                    $data['error'] = 'Email này đã được sử dụng. Vui lòng chọn email khác.';
                } else {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Gói gọn vào mảng để truyền sang Model (Chính là mảng mà User.php đang báo thiếu)
                    $userData = [
                        'title' => $title_user,
                        'gender' => $gender,
                        'fullname' => trim($fullname),
                        'dob' => $dob,
                        'nationality' => $nationality,
                        'email' => $email,
                        'phone' => $phone,
                        'password' => $hashed_password
                    ];

                    if ($this->userModel->register($userData)) {
                        // Thành công -> Chuyển về trang đăng nhập
                        header('Location: ' . BASEURL . '/auth/login?registered=success');
                        exit();
                    } else {
                        $data['error'] = 'Đã có lỗi xảy ra trong quá trình đăng ký. Vui lòng thử lại sau.';
                    }
                }
            }
        }
        $this->view('auth/register', $data);
    }

    // ================= TRANG CHÀO MỪNG (SPLASH SCREEN) =================
    public function welcome() {
        // Chỉ hiển thị nếu đã đăng nhập
        if (!isset($_SESSION['user_name'])) {
            header("Location: " . BASEURL . "/auth/login");
            exit();
        }
        $data = ['title' => 'Chào mừng - Skyline Ticket'];
        $this->view('auth/welcome', $data);
    }

    // ================= XỬ LÝ ĐĂNG XUẤT =================
    public function logout() {
        $_SESSION = array();
        session_destroy();
        header("Location: " . BASEURL . "/home");
        exit();
    }
}
?>