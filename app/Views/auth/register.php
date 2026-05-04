<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Đăng ký tài khoản - Skyline Ticket' ?></title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
        }
        /* Navbar */
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .brand-logo { font-weight: 800; font-size: 24px; color: #000; text-decoration: none; }
        .brand-logo span { color: #0d6efd; }
        
        /* Register Container */
        .register-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            padding: 40px;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        
        .section-title {
            font-weight: 700;
            font-size: 18px;
            color: #333;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f0f0;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
            color: #555;
        }
        .form-label span.text-danger { color: #dc3545; }
        
        .form-control, .form-select {
            border-radius: 8px;
            padding: 12px 15px;
            border: 1px solid #ced4da;
            font-size: 15px;
        }
        .form-control:focus, .form-select:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.15);
        }

        /* Password Rules */
        .pwd-rules {
            margin-top: 15px;
            font-size: 13px;
            color: #888;
        }
        .pwd-rules li {
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        .pwd-rules li i {
            margin-right: 8px;
            font-size: 14px;
        }
        .pwd-rules li.valid {
            color: #198754; /* Màu xanh success */
            font-weight: 600;
        }

        /* Tùy chỉnh Nút Đăng ký */
        .btn-register {
            background-color: #005e6a; /* Màu xanh ngọc giống mẫu VN Airlines */
            color: white;
            font-weight: bold;
            padding: 12px 30px;
            border-radius: 8px;
            border: none;
            transition: 0.3s;
        }
        .btn-register:hover {
            background-color: #00454e;
            color: white;
        }
        /* Giao diện khi nút bị vô hiệu hóa (xám) */
        .btn-register:disabled {
            background-color: #cccccc !important;
            color: #666666 !important;
            cursor: not-allowed;
            border: none;
        }

        .info-text { font-size: 12px; color: #888; margin-top: 5px; display: block; }
        
        /* Input Group cho Số điện thoại */
        .phone-group { display: flex; }
        .phone-group .form-select { width: 35%; border-top-right-radius: 0; border-bottom-right-radius: 0; }
        .phone-group .form-control { width: 65%; border-top-left-radius: 0; border-bottom-left-radius: 0; border-left: none; }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <a href="<?= BASEURL ?>/auth/login" class="btn btn-outline-primary fw-bold px-4">Đăng nhập</a>
            </div>
        </div>
    </nav>

    <!-- FORM ĐĂNG KÝ -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="register-container">
                    
                    <div class="text-center mb-5">
                        <i class="fas fa-user-plus" style="font-size: 40px; color: #0d6efd; margin-bottom: 15px;"></i>
                        <h2 class="fw-bold">Tạo tài khoản mới</h2>
                        <p class="text-muted">Đăng ký để quản lý hành trình dễ dàng hơn</p>
                    </div>

                    <!-- Hiển thị thông báo lỗi/thành công từ Controller -->
                    <?php if(!empty($data['error'])): ?>
                        <div class="alert alert-danger"><i class="fas fa-exclamation-circle me-2"></i><?= $data['error'] ?></div>
                    <?php endif; ?>
                    <?php if(!empty($data['success'])): ?>
                        <div class="alert alert-success"><i class="fas fa-check-circle me-2"></i><?= $data['success'] ?></div>
                    <?php endif; ?>

                    <form action="<?= BASEURL ?>/auth/register" method="POST" id="registerForm">
                        
                        <!-- SECTION 1: THÔNG TIN CÁ NHÂN -->
                        <div class="section-title">Thông tin cá nhân</div>
                        <div class="row g-4 mb-5">
                            <div class="col-md-6">
                                <label class="form-label">Danh xưng <span class="text-danger">*</span></label>
                                <select name="title" class="form-select" required>
                                    <option value="" selected disabled>Chọn danh xưng</option>
                                    <option value="Ông">Ông</option>
                                    <option value="Bà">Bà</option>
                                    <option value="Cô">Cô</option>
                                    <option value="Anh">Anh</option>
                                    <option value="Chị">Chị</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Giới tính <span class="text-danger">*</span></label>
                                <select name="gender" class="form-select" required>
                                    <option value="" selected disabled>Chọn giới tính</option>
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Họ <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Nhập Họ" required>
                                <span class="info-text">Thứ tự như trên CCCD/Hộ chiếu</span>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Đệm và Tên <span class="text-danger">*</span></label>
                                <input type="text" name="fullname" class="form-control" placeholder="Nhập Đệm và Tên" value="<?= $data['fullname'] ?? '' ?>" required>
                                <span class="info-text">Thứ tự như trên CCCD/Hộ chiếu</span>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Ngày sinh <span class="text-danger">*</span></label>
                                <input type="date" name="dob" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Quốc tịch <span class="text-danger">*</span></label>
                                <select name="nationality" class="form-select" required>
                                    <option value="Viet Nam" selected>Viet Nam</option>
                                    <option value="United States">United States</option>
                                    <option value="United Kingdom">United Kingdom</option>
                                    <option value="Japan">Japan</option>
                                    <option value="South Korea">South Korea</option>
                                    <option value="Singapore">Singapore</option>
                                    <option value="Thailand">Thailand</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Địa chỉ Email <span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control" placeholder="Nhập địa chỉ Email" value="<?= $data['email'] ?? '' ?>" required>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                <div class="phone-group">
                                    <select name="phone_code" class="form-select" required>
                                        <option value="+84" selected>🇻🇳 +84</option>
                                        <option value="+1">🇺🇸 +1</option>
                                        <option value="+44">🇬🇧 +44</option>
                                        <option value="+81">🇯🇵 +81</option>
                                        <option value="+82">🇰🇷 +82</option>
                                        <option value="+86">🇨🇳 +86</option>
                                        <option value="+65">🇸🇬 +65</option>
                                        <option value="+66">🇹🇭 +66</option>
                                    </select>
                                    <input type="tel" name="phone_number" class="form-control" placeholder="Nhập số điện thoại" required>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 2: KHỞI TẠO MẬT KHẨU -->
                        <div class="section-title">Khởi tạo mật khẩu</div>
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="form-label">Mật khẩu <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
                                    <i class="fas fa-eye-slash position-absolute text-muted cursor-pointer" id="togglePwd" style="right: 15px; top: 15px; cursor: pointer;"></i>
                                </div>
                                
                                <ul class="pwd-rules list-unstyled mt-3" id="pwdRules">
                                    <li id="rule-upper"><i class="far fa-check-circle"></i> Mật khẩu phải chứa ít nhất 1 ký tự chữ in hoa</li>
                                    <li id="rule-lower"><i class="far fa-check-circle"></i> Mật khẩu phải chứa ít nhất 1 ký tự chữ in thường</li>
                                    <li id="rule-length"><i class="far fa-check-circle"></i> Mật khẩu tối thiểu phải có 8 ký tự</li>
                                    <li id="rule-number"><i class="far fa-check-circle"></i> Mật khẩu phải chứa ít nhất 1 ký tự số</li>
                                    <li id="rule-special"><i class="far fa-check-circle"></i> Mật khẩu phải bao gồm ít nhất 1 ký tự đặc biệt (@ ! $ % * ? & .)</li>
                                </ul>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">Nhắc lại mật khẩu <span class="text-danger">*</span></label>
                                <div class="position-relative">
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Nhập lại mật khẩu" required>
                                </div>
                                <span class="info-text text-danger mt-2" id="pwdMatchError" style="display: none;">Mật khẩu nhắc lại không khớp!</span>
                            </div>
                        </div>

                        <!-- SECTION 3: ĐIỀU KHOẢN -->
                        <div class="mt-4 pt-3 border-top">
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" id="checkPromo" required>
                                <label class="form-check-label text-muted" for="checkPromo" style="font-size: 14px;">
                                    <span class="text-danger">*</span> Tôi đồng ý nhận tin tức và chương trình ưu đãi dành cho Hội viên Skyline Ticket. Tôi có thể rút lại sự đồng ý này bất cứ lúc nào thông qua đường link trong email.
                                </label>
                            </div>
                            <div class="form-check mb-4">
                                <input class="form-check-input" type="checkbox" id="checkTerms" required>
                                <label class="form-check-label text-muted" for="checkTerms" style="font-size: 14px;">
                                    <span class="text-danger">*</span> Tôi đồng ý với <a href="#" class="text-decoration-none">Điều kiện và điều khoản</a> của Chương trình và chấp thuận <a href="#" class="text-decoration-none">Chính sách bảo mật</a> của Skyline Ticket.
                                </label>
                            </div>

                            <div class="text-end">
                                <!-- Nút đăng ký mặc định bị khóa (màu xám) -->
                                <button type="submit" class="btn btn-register" id="btnSubmit" disabled>Đăng ký tài khoản</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="site-footer bg-white border-top py-4">
        <div class="container text-center text-muted">
            <p class="mb-0">© 2026 Skyline Ticket. All rights reserved.</p>
            <p class="mt-2 text-primary fw-bold" style="font-size:14px;">
                Đã có tài khoản? <a href="<?= BASEURL ?>/auth/login" class="text-decoration-none">Đăng nhập tại đây</a>
            </p>
        </div>
    </footer>

    <!-- JAVASCRIPT XỬ LÝ ĐIỀU KIỆN FORM -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const pwdInput = document.getElementById('password');
            const confirmPwdInput = document.getElementById('confirm_password');
            const togglePwd = document.getElementById('togglePwd');
            const btnSubmit = document.getElementById('btnSubmit');
            const pwdMatchError = document.getElementById('pwdMatchError');

            // Lấy TẤT CẢ các thẻ input, select có chứa thuộc tính "required"
            const allRequiredFields = document.querySelectorAll('#registerForm [required]');

            // Regex các quy tắc mật khẩu
            const ruleUpper = /[A-Z]/;
            const ruleLower = /[a-z]/;
            const ruleNumber = /[0-9]/;
            const ruleSpecial = /[@!$%*?&.]/;

            // Elements danh sách điều kiện
            const elUpper = document.getElementById('rule-upper');
            const elLower = document.getElementById('rule-lower');
            const elLength = document.getElementById('rule-length');
            const elNumber = document.getElementById('rule-number');
            const elSpecial = document.getElementById('rule-special');

            let isPwdValid = false;

            // Đổi màu dấu tick
            function toggleValidStyle(element, isValid) {
                if(isValid) {
                    element.classList.add('valid');
                    element.querySelector('i').classList.replace('far', 'fas');
                } else {
                    element.classList.remove('valid');
                    element.querySelector('i').classList.replace('fas', 'far');
                }
            }

            // Kiểm tra mật khẩu khớp
            function checkPasswordMatch() {
                if (confirmPwdInput.value.length > 0) {
                    if (confirmPwdInput.value !== pwdInput.value) {
                        pwdMatchError.style.display = 'block';
                    } else {
                        pwdMatchError.style.display = 'none';
                    }
                } else {
                    pwdMatchError.style.display = 'none';
                }
            }

            // TỔNG KIỂM TRA ĐỂ BẬT/TẮT NÚT ĐĂNG KÝ
            function checkFormValidity() {
                let allFilled = true;

                // Quét qua tất cả các ô có đánh dấu bắt buộc (*)
                allRequiredFields.forEach(field => {
                    if (field.type === 'checkbox') {
                        // Nếu là checkbox thì phải được tick
                        if (!field.checked) {
                            allFilled = false;
                        }
                    } else {
                        // Nếu là ô gõ chữ hoặc chọn danh sách thì không được bỏ trống
                        if (field.value.trim() === '') {
                            allFilled = false;
                        }
                    }
                });

                // Kết hợp thêm kiểm tra Mật khẩu đúng chuẩn & 2 mật khẩu trùng nhau
                const isMatch = (pwdInput.value === confirmPwdInput.value) && (pwdInput.value.length > 0);

                if (allFilled && isPwdValid && isMatch) {
                    btnSubmit.disabled = false; // Bật nút (màu xanh)
                } else {
                    btnSubmit.disabled = true; // Tắt nút (màu xám)
                }
            }

            // Móc sự kiện Lắng nghe vào TẤT CẢ các trường required
            allRequiredFields.forEach(field => {
                field.addEventListener('input', checkFormValidity);
                field.addEventListener('change', checkFormValidity);
            });

            // Lắng nghe sự kiện riêng cho ô Mật khẩu chính
            pwdInput.addEventListener('input', function() {
                const val = this.value;
                const hasUpper = ruleUpper.test(val);
                const hasLower = ruleLower.test(val);
                const hasLength = val.length >= 8;
                const hasNumber = ruleNumber.test(val);
                const hasSpecial = ruleSpecial.test(val);

                toggleValidStyle(elUpper, hasUpper);
                toggleValidStyle(elLower, hasLower);
                toggleValidStyle(elLength, hasLength);
                toggleValidStyle(elNumber, hasNumber);
                toggleValidStyle(elSpecial, hasSpecial);

                isPwdValid = hasUpper && hasLower && hasLength && hasNumber && hasSpecial;
                
                checkPasswordMatch();
                checkFormValidity();
            });

            // Lắng nghe ô Nhắc lại mật khẩu
            confirmPwdInput.addEventListener('input', function() {
                checkPasswordMatch();
                checkFormValidity();
            });

            // Hiện/Ẩn mật khẩu
            togglePwd.addEventListener('click', function() {
                if (pwdInput.type === 'password') {
                    pwdInput.type = 'text';
                    this.classList.replace('fa-eye-slash', 'fa-eye');
                } else {
                    pwdInput.type = 'password';
                    this.classList.replace('fa-eye', 'fa-eye-slash');
                }
            });
        });
    </script>
</body>
</html>