<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Đăng nhập - Skyline Ticket' ?></title>
    <!-- Tích hợp Bootstrap 5 và FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            background-color: #f4f7f6; /* Màu nền nhẹ nhàng giống ảnh của bạn */
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            padding: 40px 30px;
            width: 100%;
            max-width: 450px; /* Độ rộng vừa phải */
        }
        .login-icon {
            font-size: 55px;
            color: #0d6efd;
            text-align: center;
            margin-bottom: 15px;
        }
        /* Style riêng cho nút Đăng nhập đậm lên */
        .btn-login {
            background-color: #0d6efd;
            color: white;
            padding: 10px 25px;
            border-radius: 8px;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }
    </style>
</head>
<body>

    <div class="login-card">
        <!-- Biểu tượng và Tiêu đề -->
        <div class="login-icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <h3 class="text-center fw-bold mb-1">Đăng nhập</h3>
        <p class="text-center text-muted mb-4">Chào mừng bạn quay trở lại Skyline</p>

        <!-- Hiển thị lỗi nếu đăng nhập sai -->
        <?php if (!empty($data['error'])): ?>
            <div class="alert alert-danger text-center p-2 mb-4"><?= $data['error'] ?></div>
        <?php endif; ?>

        <!-- Form Đăng nhập -->
        <form action="<?= BASEURL ?>/auth/login" method="POST">
            
            <!-- Trường Tên đăng nhập / Email / SĐT -->
            <div class="mb-3">
                <label for="email" class="form-label fw-bold" style="font-size: 14px;">Email, số điện thoại hoặc tên đăng nhập</label>
                <!-- Code logic ở Backend đang dùng biến 'email', nên ta giữ nguyên name="email" -->
                <input type="text" class="form-control p-2" id="email" name="email" placeholder="Nhập thông tin đăng nhập..." required>
            </div>
            
            <!-- Trường Mật khẩu -->
            <div class="mb-4">
                <label for="password" class="form-label fw-bold" style="font-size: 14px;">Mật khẩu</label>
                <input type="password" class="form-control p-2" id="password" name="password" placeholder="Nhập mật khẩu..." required>
            </div>

            <!-- Hàng chứa Ô tích Lưu mật khẩu và Nút Đăng nhập -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <!-- Bên trái: Lưu mật khẩu -->
                <div class="form-check">
                    <input class="form-check-input cursor-pointer" type="checkbox" id="rememberMe" name="remember">
                    <label class="form-check-label text-muted" for="rememberMe" style="cursor: pointer;">
                        Lưu mật khẩu
                    </label>
                </div>
                
                <!-- Bên phải: Nút đăng nhập đậm -->
                <button type="submit" class="btn btn-login fw-bold border-0">Đăng nhập</button>
            </div>
        </form>

        <!-- Phần Footer -->
        <div class="text-center mt-2 pt-4 border-top">
            <span class="text-muted">Bạn chưa có tài khoản?</span> 
            <a href="<?= BASEURL ?>/auth/register" class="text-decoration-none fw-bold" style="color: #0d6efd;">Đăng ký ngay</a>
        </div>
    </div>

    <!-- Bootstrap JS (Dùng cho các hiệu ứng giao diện nếu có) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
