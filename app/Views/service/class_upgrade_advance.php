<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f4f7f6; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    .hero-banner {
        background: url('https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
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
    
    .btn-upgrade {
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
        font-weight: 700;
        padding: 15px 40px;
        border-radius: 50px;
        border: none;
        display: inline-block;
        text-decoration: none;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .btn-upgrade:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(243,156,18,0.4);
        color: white;
    }
</style>

<section class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASEURL ?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="<?= BASEURL ?>/service/classUpgrade">Nâng hạng ghế</a></li>
                <li class="breadcrumb-item active">Mua trước</li>
            </ol>
        </nav>
        <h1>Nâng Hạng Mua Trước</h1>
        <p class="lead w-50">Tận hưởng dịch vụ đẳng cấp 5 sao với mức giá cực kỳ ưu đãi khi đặt trước chuyến bay.</p>
    </div>
</section>

<div class="container content-section">
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3 class="fw-bold mb-4" style="color: #0c3547;">Trải Nghiệm Hoàn Hảo Hơn</h3>
            <p class="text-muted mb-3" style="line-height: 1.8;">
                Chuẩn bị cho một chuyến đi hoàn hảo với dịch vụ Nâng hạng mua trước của Skyline Ticket. Bằng cách nâng hạng sớm, bạn không chỉ đảm bảo được vị trí yêu thích trên máy bay mà còn tiết kiệm hơn so với nâng hạng tại sân bay.
            </p>
            <p class="text-muted mb-4" style="line-height: 1.8;">
                Khách hàng nâng hạng Thương gia sẽ được phục vụ bữa ăn theo thực đơn cao cấp, sử dụng phòng chờ VIP, và tăng thêm hạn mức hành lý miễn cước.
            </p>
        </div>
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1542314831-c6a4d14faaf2?auto=format&fit=crop&w=800&q=80" alt="Dịch vụ cao cấp" class="img-fluid rounded-3 shadow-sm">
        </div>
    </div>

    <h4 class="fw-bold mb-4 text-center" style="color: #0c3547;">Đặc Quyền Dành Cho Bạn</h4>
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-couch feature-icon"></i>
                <h5 class="feature-title">Ghế Ngả Phẳng Tuyệt Đối</h5>
                <p class="text-muted small">Ghế ngồi khoang Thương gia được thiết kế đặc biệt có thể ngả phẳng 180 độ thành giường nằm, mang lại giấc ngủ sâu.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-utensils feature-icon"></i>
                <h5 class="feature-title">Ẩm Thực Đỉnh Cao</h5>
                <p class="text-muted small">Thưởng thức thực đơn phong phú được chế biến bởi các đầu bếp danh tiếng, đi kèm với các loại rượu vang thượng hạng.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <i class="fas fa-glass-martini-alt feature-icon"></i>
                <h5 class="feature-title">Phòng Chờ Thương Gia</h5>
                <p class="text-muted small">Thư giãn tại phòng khách Bông Sen trước chuyến bay với buffet ẩm thực, khu vực làm việc và giải trí riêng tư.</p>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 p-4" style="background: #fdfaf0; border: 1px dashed #f39c12; border-radius: 12px;">
        <h5 class="fw-bold text-dark mb-2">Bạn đã có mã đặt chỗ?</h5>
        <p class="text-muted mb-4">Nhập mã PNR của bạn ngay bây giờ để kiểm tra điều kiện nâng hạng và thanh toán mức giá ưu đãi.</p>
        <a href="<?= BASEURL ?>/service/seatSelection" class="btn-upgrade">Nâng Hạng Ngay</a>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
