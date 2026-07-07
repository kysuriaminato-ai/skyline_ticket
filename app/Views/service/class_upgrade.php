<?php require_once '../app/Views/layouts/header.php'; ?>

<style>
    body { background-color: #f8f9fa; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
    
    /* HERO BANNER */
    .hero-banner {
        background: linear-gradient(135deg, #0c3547 0%, #1a5276 50%, #2980b9 100%);
        padding: 50px 0;
        margin-bottom: 50px;
    }
    .hero-banner h1 {
        color: #fff;
        font-weight: 800;
        font-size: 36px;
    }
    .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
    .breadcrumb-item.active { color: rgba(255,255,255,0.5); }
    .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

    .page-title {
        font-weight: 700;
        color: #0c3547;
        margin-bottom: 40px;
        font-size: 28px;
    }

    /* UPGRADE OPTION ROW */
    .upgrade-row {
        background: #fff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.05);
        margin-bottom: 40px;
        border: 1px solid #eee;
    }
    .upgrade-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        min-height: 300px;
    }
    .upgrade-content {
        padding: 40px;
        display: flex;
        flex-direction: column;
        justify-content: center;
        height: 100%;
    }
    .upgrade-title {
        font-weight: 700;
        color: #0c3547;
        font-size: 22px;
        margin-bottom: 15px;
    }
    .upgrade-desc {
        color: #555;
        font-size: 15px;
        line-height: 1.6;
        margin-bottom: 20px;
    }
    .upgrade-features {
        list-style: none;
        padding-left: 0;
        margin-bottom: 25px;
    }
    .upgrade-features li {
        position: relative;
        padding-left: 25px;
        margin-bottom: 10px;
        color: #444;
        font-size: 14px;
    }
    .upgrade-features li::before {
        content: '\f00c';
        font-family: 'Font Awesome 5 Free';
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 2px;
        color: #f39c12;
    }
    .btn-discover {
        background: #0071c2;
        color: white;
        font-weight: 600;
        padding: 10px 25px;
        border-radius: 25px;
        border: none;
        display: inline-block;
        text-decoration: none;
        transition: 0.3s;
        align-self: flex-start;
    }
    .btn-discover:hover {
        background: #005a9c;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(0,113,194,0.3);
    }
</style>

<!-- HERO BANNER -->
<section class="hero-banner">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?= BASEURL ?>/home">Trang chủ</a></li>
                <li class="breadcrumb-item"><a href="#">Dịch vụ bổ sung</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nâng hạng ghế</li>
            </ol>
        </nav>
        <h1>Nâng Hạng Ghế</h1>
    </div>
</section>

<div class="container mb-5 pb-4">
    <h2 class="page-title">Các lựa chọn nâng hạng</h2>

    <!-- Option 1: Nâng hạng mua trước -->
    <div class="upgrade-row row g-0">
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=800&q=80" alt="Nâng hạng mua trước" class="upgrade-img">
        </div>
        <div class="col-md-6">
            <div class="upgrade-content">
                <h3 class="upgrade-title">Nâng hạng mua trước</h3>
                <p class="upgrade-desc">Với dịch vụ Nâng hạng mua trước, hành trình bay sẽ trở nên thoải mái và trọn vẹn hơn:</p>
                <ul class="upgrade-features">
                    <li>Ưu tiên làm thủ tục và ưu tiên lên máy bay giúp hành khách tiết kiệm thời gian chờ đợi.</li>
                    <li>Sử dụng phòng khách Thương gia với không gian yên tĩnh cùng dịch vụ cao cấp.</li>
                    <li>Ghế hạng Thương gia rộng rãi, ngả phẳng tuyệt đối, mang đến sự thoải mái trên những hành trình dài.</li>
                </ul>
                <a href="<?= BASEURL ?>/service/upgradeAdvance" class="btn-discover">Khám phá ngay</a>
            </div>
        </div>
    </div>

    <!-- Option 2: Nâng hạng giờ chót -->
    <div class="upgrade-row row g-0 flex-row-reverse">
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&w=800&q=80" alt="Nâng hạng giờ chót" class="upgrade-img">
        </div>
        <div class="col-md-6">
            <div class="upgrade-content">
                <h3 class="upgrade-title">Nâng hạng giờ chót</h3>
                <p class="upgrade-desc">Hành khách chưa mua dịch vụ Nâng hạng trước chuyến bay? Hãy nâng hạng ngay tại sân bay và tận hưởng những đặc quyền dành cho hạng Thương gia và Phổ thông đặc biệt.</p>
                <ul class="upgrade-features">
                    <li>Nâng hạng dễ dàng ngay tại quầy thủ tục sân bay.</li>
                    <li>Trải nghiệm dịch vụ đẳng cấp với mức phí ưu đãi giờ chót.</li>
                    <li>Tận hưởng bữa ăn cao cấp và không gian riêng tư.</li>
                </ul>
                <a href="<?= BASEURL ?>/service/upgradeLastMinute" class="btn-discover">Khám phá ngay</a>
            </div>
        </div>
    </div>

    <!-- Option 3: Đổi dặm nâng hạng -->
    <div class="upgrade-row row g-0">
        <div class="col-md-6">
            <img src="https://images.unsplash.com/photo-1601597111158-2fceff292cdc?auto=format&fit=crop&w=800&q=80" alt="Đổi dặm nâng hạng" class="upgrade-img">
        </div>
        <div class="col-md-6">
            <div class="upgrade-content">
                <h3 class="upgrade-title">Đổi dặm nâng hạng</h3>
                <p class="upgrade-desc">Hành khách là Hội viên Bông Sen Vàng có thể dùng dặm tích lũy để nâng lên hạng Thương gia hoặc Phổ thông đặc biệt với nhiều ưu đãi hấp dẫn.</p>
                <ul class="upgrade-features">
                    <li>Sử dụng dặm bay linh hoạt để trải nghiệm các hạng ghế cao cấp.</li>
                    <li>Áp dụng cho người thân nếu bạn là hội viên hạng Bạch Kim hoặc Vàng.</li>
                    <li>Nâng hạng trên cả chuyến bay nội địa và quốc tế.</li>
                </ul>
                <a href="<?= BASEURL ?>/service/upgradeMiles" class="btn-discover">Khám phá ngay</a>
            </div>
        </div>
    </div>
</div>

<?php require_once '../app/Views/layouts/footer.php'; ?>
