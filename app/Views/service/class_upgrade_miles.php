<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    .hero-banner {
        background: url('https://images.unsplash.com/photo-1601597111158-2fceff292cdc?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
        height: 400px;
        position: relative;
        display: flex;
        align-items: center;
    }
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(to right, rgba(12, 53, 71, 0.9) 0%, rgba(12, 53, 71, 0.4) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 1;
        color: white;
    }
    .hero-content h1 { font-weight: 800; font-size: 42px; margin-bottom: 15px; }
    
    .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-item.active { color: rgba(255,255,255,0.5); }
    
    .content-section {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        margin-top: -60px;
        position: relative;
        z-index: 2;
        margin-bottom: 60px;
    }
    
    .feature-box {
        text-align: center;
        padding: 30px 20px;
        border-radius: 12px;
        background: #f8fbff;
        border: 1px solid #e0ebf5;
        height: 100%;
        transition: 0.3s;
    }
    .feature-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,113,194,0.1);
        border-color: #0071c2;
    }
    .feature-icon {
        font-size: 40px;
        color: #f39c12;
        margin-bottom: 20px;
    }
    .feature-title {
        font-weight: 700;
        color: #0c3547;
        margin-bottom: 15px;
        font-size: 18px;
    }
</style>

<section class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASEURL ?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?= BASEURL ?>/service/classUpgrade">Nâng hạng ghế</a></li>
                <li class="breadcrumb-item active">Đổi dặm</li>
            </ol>
        </nav>
        <h1>Đổi Dặm Nâng Hạng</h1>
        <p class="lead w-50">Sử dụng dặm bay tích lũy của thẻ Bông Sen Vàng để thăng hoa trải nghiệm bay.</p>
    </div>
</section>

<div class="container content-section">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3 class="fw-bold mb-4" style="color: #0c3547;">Phần Thưởng Xứng Đáng</h3>
            <p class="text-muted mb-3" style="line-height: 1.8;">
                Chúng tôi luôn trân trọng sự đồng hành của bạn. Chương trình Đổi dặm nâng hạng cho phép Hội viên Bông Sen Vàng sử dụng dặm bay đã tích lũy để chuyển từ hạng vé Phổ thông lên hạng vé Thương gia hoặc Phổ thông đặc biệt.
            </p>
            <p class="text-muted mb-4" style="line-height: 1.8;">
                Với quy trình thao tác đơn giản qua ứng dụng hoặc website Skyline Ticket, chuyến đi sắp tới của bạn sẽ thoải mái hơn bao giờ hết mà không tốn kém thêm chi phí.
            </p>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1559526324-4b87b5e36e44?auto=format&fit=crop&w=800&q=80" alt="Đổi dặm bay" class="img-fluid rounded-3 shadow-sm">
        </div>
    </div>

    <h4 class="fw-bold mb-4 text-center" style="color: #0c3547;">Ưu Điểm Khi Sử Dụng Dặm Bay</h4>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-gift feature-icon"></i>
                <h5 class="feature-title">Quyền Lợi Hội Viên</h5>
                <p class="text-muted small">Biến dặm bay thành những chuyến đi êm ái trên khoang cao cấp nhất của máy bay.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-users feature-icon"></i>
                <h5 class="feature-title">Dành Cho Người Thân</h5>
                <p class="text-muted small">Hội viên hạng Bạch Kim và Vàng có đặc quyền sử dụng dặm của mình để nâng hạng vé cho người thân cùng bay.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-globe-asia feature-icon"></i>
                <h5 class="feature-title">Mạng Bay Rộng Khắp</h5>
                <p class="text-muted small">Áp dụng nâng hạng linh hoạt cho hầu hết các chặng bay Nội địa và Quốc tế do Skyline Ticket khai thác.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 p-4" style="background: #fafafa; border: 1px solid #ddd; border-radius: 12px;">
        <h5 class="fw-bold text-dark mb-2">Đăng Nhập Để Đổi Dặm</h5>
        <p class="text-muted mb-4">Vui lòng đăng nhập vào tài khoản hội viên của bạn để xem số dặm tích lũy và thực hiện yêu cầu nâng hạng.</p>
        <a href="<?= BASEURL ?>/auth/login" class="btn btn-dark fw-bold px-4 py-2" style="border-radius: 25px;"><i class="fas fa-sign-in-alt me-2"></i>Đăng Nhập Hệ Thống</a>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
