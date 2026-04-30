<!-- app/Views/home/index.php -->
<?php require_once '../app/Views/layouts/header.php'; ?>

<!-- Hero Banner -->
<div class="hero-section">
    <div class="container">
        <h1 class="display-4 fw-bold mb-3">Khám phá thế giới cùng Skyline</h1>
        <p class="lead mb-4">Hệ thống đặt vé máy bay nhanh chóng, tiện lợi và giá rẻ nhất</p>
    </div>
</div>

<!-- Form Tìm Kiếm Nổi (Overlapping Search Widget) -->
<div class="container mb-5">
    <div class="search-widget shadow-lg">
        <!-- Form trỏ hành động (action) sang FlightController để xử lý tìm kiếm -->
        <form action="<?= BASEURL ?>/flight" method="GET">
            <div class="row g-3 align-items-end">
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="fas fa-plane-departure me-2 text-primary"></i>Điểm đi</label>
                    <input type="text" class="form-control py-2" name="from" placeholder="Ví dụ: HAN, SGN...">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="fas fa-plane-arrival me-2 text-primary"></i>Điểm đến</label>
                    <input type="text" class="form-control py-2" name="to" placeholder="Ví dụ: DAD, PQC...">
                </div>
                <div class="col-md-3">
                    <label class="form-label fw-bold small text-muted"><i class="far fa-calendar-alt me-2 text-primary"></i>Ngày đi</label>
                    <input type="date" class="form-control py-2" name="date">
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-search w-100 py-2 fs-5">
                        <i class="fas fa-search me-2"></i>Tìm chuyến bay
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Phần Giới thiệu Điểm đến nổi bật -->
<div class="container my-5 pt-4">
    <div class="text-center mb-5">
        <h3 class="fw-bold">Điểm đến thịnh hành</h3>
        <p class="text-muted">Các hành trình được yêu thích nhất trong tháng</p>
    </div>
    
    <div class="row g-4">
        <!-- Card 1 -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div style="height: 200px; background-color: #ddd; background-image: url('https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?q=80&w=600&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold mb-1">Hà Nội <i class="fas fa-exchange-alt mx-2 text-muted"></i> Đà Nẵng</h5>
                    <p class="text-muted small">Từ 850.000đ</p>
                    <a href="<?= BASEURL ?>/flight?from=HAN&to=DAD" class="btn btn-outline-primary rounded-pill px-4">Đặt ngay</a>
                </div>
            </div>
        </div>
        
        <!-- Card 2 -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div style="height: 200px; background-color: #ddd; background-image: url('https://images.unsplash.com/photo-1583417319070-4a69db38a482?q=80&w=600&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold mb-1">TP. HCM <i class="fas fa-exchange-alt mx-2 text-muted"></i> Phú Quốc</h5>
                    <p class="text-muted small">Từ 1.250.000đ</p>
                    <a href="<?= BASEURL ?>/flight?from=SGN&to=PQC" class="btn btn-outline-primary rounded-pill px-4">Đặt ngay</a>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden">
                <div style="height: 200px; background-color: #ddd; background-image: url('https://images.unsplash.com/photo-1509316975850-ff9c5deb0cd9?q=80&w=600&auto=format&fit=crop'); background-size: cover; background-position: center;"></div>
                <div class="card-body p-4 text-center">
                    <h5 class="fw-bold mb-1">TP. HCM <i class="fas fa-exchange-alt mx-2 text-muted"></i> Bangkok</h5>
                    <p class="text-muted small">Từ 2.100.000đ</p>
                    <a href="<?= BASEURL ?>/flight?from=SGN&to=BKK" class="btn btn-outline-primary rounded-pill px-4">Đặt ngay</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Dịch vụ của chúng tôi -->
<div class="bg-white py-5 mt-5">
    <div class="container">
        <div class="row text-center g-4">
            <div class="col-md-4">
                <div class="p-3">
                    <i class="fas fa-headset fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Hỗ trợ 24/7</h5>
                    <p class="text-muted small">Đội ngũ CSKH luôn sẵn sàng hỗ trợ bạn bất cứ lúc nào.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <i class="fas fa-tags fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Giá Tốt Nhất</h5>
                    <p class="text-muted small">Luôn cập nhật các chương trình khuyến mãi và vé rẻ nhất.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3">
                    <i class="fas fa-shield-alt fa-3x text-primary mb-3"></i>
                    <h5 class="fw-bold">Thanh Toán An Toàn</h5>
                    <p class="text-muted small">Bảo mật tuyệt đối thông tin thanh toán của hành khách.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>