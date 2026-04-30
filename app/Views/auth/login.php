<!-- app/Views/auth/login.php -->
<?php require_once '../app/Views/layouts/header.php'; ?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 p-4">
                <div class="text-center mb-4">
                    <i class="fas fa-user-circle fa-3x text-primary mb-3"></i>
                    <h3 class="fw-bold">Đăng nhập</h3>
                    <p class="text-muted">Chào mừng bạn quay trở lại Skyline</p>
                </div>

                <!-- Hiển thị thông báo lỗi nếu có -->
                <?php if(!empty($data['error'])): ?>
                    <div class="alert alert-danger rounded-3">
                        <i class="fas fa-exclamation-circle me-2"></i> <?= $data['error']; ?>
                    </div>
                <?php endif; ?>

                <form action="<?= BASEURL ?>/auth/login" method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold small text-muted">Địa chỉ Email</label>
                        <input type="email" class="form-control py-2" name="email" required placeholder="Nhập email của bạn">
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold small text-muted">Mật khẩu</label>
                        <input type="password" class="form-control py-2" name="password" required placeholder="Nhập mật khẩu">
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember">
                            <label class="form-check-label small" for="remember">Ghi nhớ tôi</label>
                        </div>
                        <a href="#" class="small text-decoration-none text-primary">Quên mật khẩu?</a>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 fw-bold" style="background-color: var(--secondary-color); border: none;">Đăng nhập</button>
                </form>
                
                <div class="text-center mt-4">
                    <p class="mb-0">Chưa có tài khoản? <a href="<?= BASEURL ?>/auth/register" class="text-decoration-none fw-bold text-primary">Đăng ký ngay</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>