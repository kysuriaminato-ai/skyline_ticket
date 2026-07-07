<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    .hero-banner {
        background: url('https://images.unsplash.com/photo-1570125909232-eb263c188f7e?auto=format&fit=crop&w=1920&q=80') center/cover no-repeat;
        height: 450px;
        position: relative;
        display: flex;
        align-items: center;
    }
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(135deg, rgba(12, 53, 71, 0.95) 0%, rgba(12, 53, 71, 0.6) 100%);
    }
    .hero-content {
        position: relative;
        z-index: 1;
        color: white;
    }
    .hero-content h1 { font-weight: 800; font-size: 48px; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; color: #00e5ff; }
    
    .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-item.active { color: rgba(255,255,255,0.5); }
    
    .content-section {
        background: white;
        border-radius: 16px;
        padding: 50px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.05);
        margin-top: -80px;
        position: relative;
        z-index: 2;
        margin-bottom: 60px;
    }
    
    .feature-box {
        text-align: center;
        padding: 40px 20px;
        border-radius: 16px;
        background: #fff;
        border: 1px solid #f0f0f0;
        height: 100%;
        transition: 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
        box-shadow: 0 5px 15px rgba(0,0,0,0.03);
    }
    .feature-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0,113,194,0.1);
        border-color: #a1c4fd;
    }
    .feature-icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #f0f6ff 0%, #e0ebf5 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: #0071c2;
        font-size: 32px;
        transition: 0.3s;
    }
    .feature-box:hover .feature-icon-wrapper {
        background: linear-gradient(135deg, #0071c2 0%, #0c3547 100%);
        color: white;
    }
    .feature-title { font-weight: 800; color: #0c3547; margin-bottom: 15px; font-size: 20px; }
    
    .price-tag {
        display: inline-block;
        background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%);
        color: white;
        font-weight: 800;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 18px;
        margin-bottom: 20px;
        box-shadow: 0 4px 10px rgba(243,156,18,0.3);
    }

    .btn-book {
        background: linear-gradient(135deg, #0c3547 0%, #0071c2 100%);
        color: white;
        font-weight: 700;
        padding: 15px 45px;
        border-radius: 50px;
        border: none;
        display: inline-block;
        text-decoration: none;
        transition: all 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-size: 16px;
    }
    .btn-book:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,113,194,0.4);
        color: white;
        background: linear-gradient(135deg, #0071c2 0%, #005a9c 100%);
    }
    
    .info-list li { margin-bottom: 12px; color: #555; position: relative; padding-left: 25px; }
    .info-list li::before {
        content: '\f058';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0; top: 2px;
        color: #2ecc71;
    }
</style>

<section class="hero-banner">
    <div class="hero-overlay"></div>
    <div class="container hero-content">
        <nav aria-label="breadcrumb" class="mb-3">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASEURL ?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Dịch vụ bổ sung</a></li>
                <li class="breadcrumb-item active">Sky Sofa</li>
            </ol>
        </nav>
        <h1>Dịch vụ Sky Sofa</h1>
        <p class="lead w-50" style="color: #e0ebf5;">Biến dải 3 ghế ngồi thành một chiếc giường rộng rãi. Trải nghiệm sự thoải mái tuyệt đối cho những chuyến bay dài cùng người thân.</p>
    </div>
</section>

<div class="container content-section">
    <div class="row align-items-center mb-5 pb-3">
        <div class="col-md-6 pe-lg-5">
            <div class="price-tag">Chỉ từ 400.000 VNĐ / Chặng</div>
            <h2 class="fw-bold mb-4" style="color: #0c3547; font-size: 32px;">Giường Bay Giữa Tầng Mây</h2>
            <p class="text-muted mb-4" style="line-height: 1.8; font-size: 16px;">
                Dịch vụ <strong>Sky Sofa</strong> của Skyline Ticket mang đến cho bạn cơ hội bao trọn một hàng gồm 3 ghế ngồi liên tiếp trên khoang Phổ thông. Phần tựa tay giữa các ghế có thể gập lên hoàn toàn, tạo thành một không gian phẳng và rộng rãi như một chiếc sofa thực thụ.
            </p>
            <p class="text-muted mb-4" style="line-height: 1.8; font-size: 16px;">
                Đây là lựa chọn hoàn hảo dành cho các cặp đôi cần không gian riêng tư, gia đình có trẻ nhỏ cần chỗ ngủ thoải mái, hoặc đơn giản là bạn muốn duỗi thẳng chân thư giãn trên những chặng bay quốc tế kéo dài.
            </p>
            <a href="<?= BASEURL ?>/service/seatSelection" class="btn-book mt-2">Đặt Sky Sofa Ngay</a>
        </div>
        <div class="col-md-6 mt-4 mt-md-0">
            <img src="https://images.unsplash.com/photo-1520697830682-8984920409bc?auto=format&fit=crop&w=800&q=80" alt="Sky Sofa Trải Nghiệm" class="img-fluid rounded-3 shadow-lg" style="border: 8px solid #f8fbff;">
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="feature-box">
                <div class="feature-icon-wrapper"><i class="fas fa-bed"></i></div>
                <h4 class="feature-title">Không Gian Rộng Rãi</h4>
                <p class="text-muted small">Sở hữu trọn vẹn 3 ghế ngồi liền kề, mang lại không gian nằm duỗi chân thoải mái như ở nhà.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <div class="feature-icon-wrapper"><i class="fas fa-baby-carriage"></i></div>
                <h4 class="feature-title">Tuyệt Vời Cho Trẻ Em</h4>
                <p class="text-muted small">Giải pháp lý tưởng giúp trẻ nhỏ có giấc ngủ ngon, bố mẹ cũng nhàn nhã hơn trong suốt chuyến bay.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-box">
                <div class="feature-icon-wrapper"><i class="fas fa-shield-alt"></i></div>
                <h4 class="feature-title">Riêng Tư & An Toàn</h4>
                <p class="text-muted small">Tách biệt với hành khách khác, đảm bảo sức khỏe và tận hưởng tối đa sự riêng tư cho bản thân.</p>
            </div>
        </div>
    </div>

    <hr class="my-5" style="border-color: #eee;">

    <div class="row">
        <div class="col-12">
            <h4 class="fw-bold mb-4" style="color: #0c3547;"><i class="fas fa-exclamation-circle me-2 text-warning"></i>Điều Kiện Áp Dụng</h4>
            <ul class="list-unstyled info-list ms-2">
                <li>Chỉ áp dụng trên các chuyến bay do Skyline Ticket khai thác bằng tàu bay thân rộng (Airbus A350, Boeing 787).</li>
                <li>Hành khách cần đặt dịch vụ ít nhất <strong>24 giờ</strong> trước thời gian khởi hành dự kiến.</li>
                <li>Sky Sofa không bao gồm chăn gối trải giường chuẩn của hạng Thương gia (hành khách sẽ sử dụng chăn gối tiêu chuẩn hạng Phổ thông).</li>
                <li>Dịch vụ không được áp dụng cho chỗ ngồi tại lối thoát hiểm.</li>
                <li>Trong trường hợp thay đổi lịch bay do lỗi của hãng, hành khách sẽ được hoàn lại 100% phí dịch vụ Sky Sofa.</li>
            </ul>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
