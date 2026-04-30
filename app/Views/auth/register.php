<!-- app/Views/auth/register.php -->
<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                    <h3 class="fw-bold">Tạo tài khoản mới</h3>
                    <p class="text-muted">Đăng ký để quản lý hành trình dễ dàng hơn</p>
                </div>

                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if(!empty($data['error'])): ?>
                    <div class="alert alert-danger rounded-3">
                        <i class="fas fa-exclamation-circle me-2"></i> <?= $data['error']; ?>
                    </div>
                <?php endif; ?>

                <!-- Hiển thị thông báo thành công và ẩn form -->
                <?php if(!empty($data['success'])): ?>
                    <div class="alert alert-success rounded-3">
                        <i class="fas fa-check-circle me-2"></i> <?= $data['success']; ?>
                    </div>
                <?php else: ?>
                    <form action="<?= BASEURL ?>/auth/register" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Họ và tên</label>
                            <!-- Giữ lại value nếu người dùng nhập lỗi để họ không phải gõ lại -->
                            <input type="text" class="form-control py-2" name="fullname" value="<?= htmlspecialchars($data['fullname'] ?? '') ?>" required placeholder="Nhập họ và tên đầy đủ">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Địa chỉ Email</label>
                            <input type="email" class="form-control py-2" name="email" value="<?= htmlspecialchars($data['email'] ?? '') ?>" required placeholder="Ví dụ: email@gmail.com">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-muted">Mật khẩu</label>
                            <input type="password" class="form-control py-2" name="password" required placeholder="Tạo mật khẩu (Ít nhất 6 ký tự)">
                        </div>
                        <div class="mb-4">
                            <label class="form-label fw-bold small text-muted">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control py-2" name="confirm_password" required placeholder="Nhập lại mật khẩu">
                        </div>
                        <button type="submit" class="btn w-100 py-2 fw-bold text-white" style="background-color: var(--secondary-color); border: none;">Đăng ký ngay</button>
                    </form>
                <?php endif; ?>
                
                <div class="text-center mt-4">
                    <p class="mb-0">Đã có tài khoản? <a href="<?= BASEURL ?>/auth/login" class="text-decoration-none fw-bold text-primary">Đăng nhập tại đây</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>