<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    .hero-banner {
        background: url('https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
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
                <li class="breadcrumb-item active">Giờ chót</li>
            </ol>
        </nav>
        <h1>Nâng Hạng Giờ Chót</h1>
        <p class="lead w-50">Cơ hội tận hưởng dịch vụ cao cấp ngay tại sân bay với mức giá hấp dẫn khi chuyến bay còn chỗ.</p>
    </div>
</section>

<div class="container content-section">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3 class="fw-bold mb-4" style="color: #0c3547;">Quyết Định Nhanh, Trải Nghiệm Lớn</h3>
            <p class="text-muted mb-3" style="line-height: 1.8;">
                Bạn đột nhiên muốn thay đổi trải nghiệm bay của mình tại sân bay? Nâng hạng giờ chót là lựa chọn hoàn hảo. Dịch vụ này cho phép hành khách mua vé hạng Phổ thông có cơ hội được trải nghiệm hạng Thương gia hoặc Phổ thông Đặc biệt ngay trước khi khởi hành.
            </p>
            <p class="text-muted mb-4" style="line-height: 1.8;">
                Vui lòng liên hệ nhân viên Skyline Ticket tại quầy thủ tục sân bay để kiểm tra tình trạng chỗ trống và mức phí áp dụng cho chuyến bay của bạn.
            </p>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=800&q=80" alt="Nâng hạng tại sân bay" class="img-fluid rounded-3 shadow-sm">
        </div>
    </div>

    <h4 class="fw-bold mb-4 text-center" style="color: #0c3547;">Tại Sao Nên Chọn Nâng Hạng Giờ Chót?</h4>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-tag feature-icon"></i>
                <h5 class="feature-title">Giá Đặc Biệt Tại Quầy</h5>
                <p class="text-muted small">Thường xuyên có các chương trình giảm giá nâng hạng đặc biệt chỉ áp dụng riêng cho những hành khách yêu cầu tại quầy thủ tục.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-bolt feature-icon"></i>
                <h5 class="feature-title">Xử Lý Nhanh Chóng</h5>
                <p class="text-muted small">Chỉ mất vài phút thao tác cùng nhân viên quầy, thẻ lên máy bay mới của bạn sẽ được in ra với vị trí ghế cao cấp.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-suitcase feature-icon"></i>
                <h5 class="feature-title">Quyền Lợi Hành Lý</h5>
                <p class="text-muted small">Ngay cả khi nâng hạng phút chót, hành lý của bạn vẫn được gắn thẻ ưu tiên "Priority" để lấy sớm nhất khi hạ cánh.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 p-4" style="background: #e8f4fd; border: 1px dashed #0071c2; border-radius: 12px;">
        <h5 class="fw-bold text-dark mb-2"><i class="fas fa-info-circle me-2 text-primary"></i>Lưu ý</h5>
        <p class="text-muted mb-0">Dịch vụ nâng hạng giờ chót phụ thuộc hoàn toàn vào tình trạng ghế trống trên chuyến bay thực tế. Skyline Ticket không đảm bảo luôn có ghế Thương gia trống cho tất cả các chuyến bay.</p>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
