<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #f4f7f6; color: #1a1a2e; }

        /* NAVBAR */
        .top-nav { background: rgba(255,255,255,0.95); backdrop-filter: blur(20px); box-shadow: 0 2px 20px rgba(0,0,0,0.06); position: sticky; top: 0; z-index: 1000; }
        .brand-logo { font-weight: 900; font-size: 22px; color: #005e6a; text-decoration: none; letter-spacing: -0.5px; }
        .brand-logo span { color: #f39c12; }
        .nav-link-custom { color: #555; font-weight: 600; font-size: 14px; text-decoration: none; padding: 8px 16px; border-radius: 8px; transition: 0.2s; }
        .nav-link-custom:hover { background: #e0f2f1; color: #00897b; }

        /* HERO */
        .hero-section {
            background: linear-gradient(135deg, rgba(0,77,64,0.85), rgba(0,105,92,0.9)), url('https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1920&q=80') center/cover;
            padding: 100px 0 120px;
            color: #fff;
            text-align: center;
        }
        .hero-section h1 { font-weight: 900; font-size: 46px; letter-spacing: -1px; margin-bottom: 15px; }
        .hero-section p { font-size: 18px; opacity: 0.9; max-width: 650px; margin: 0 auto 30px; font-weight: 400; }
        .shield-icon { font-size: 60px; color: #4db6ac; margin-bottom: 20px; filter: drop-shadow(0 0 15px rgba(77,182,172,0.5)); }

        /* PNR FORM */
        .pnr-box {
            background: #fff; border-radius: 20px; padding: 40px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.1); margin-top: -60px; position: relative; z-index: 10;
            border-top: 5px solid #00897b;
        }
        .pnr-box h3 { font-weight: 800; color: #004d40; margin-bottom: 20px; font-size: 22px; }
        .form-control-custom { border: 2px solid #e0e0e0; border-radius: 12px; padding: 14px 20px; font-weight: 600; text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; }
        .form-control-custom:focus { border-color: #00897b; box-shadow: 0 0 0 4px rgba(0,137,123,0.1); }
        .btn-check-pnr { background: linear-gradient(135deg, #00897b, #00695c); color: #fff; border: none; border-radius: 12px; padding: 14px 30px; font-weight: 700; font-size: 15px; transition: 0.3s; width: 100%; height: 100%; }
        .btn-check-pnr:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,137,123,0.3); color: #fff; }

        /* SECTION TITLES */
        .section-title { font-size: 32px; font-weight: 900; color: #1a1a2e; margin-bottom: 10px; text-align: center; }
        .section-subtitle { font-size: 16px; color: #777; margin-bottom: 50px; text-align: center; max-width: 600px; margin-left: auto; margin-right: auto; }

        /* PRICING CARDS */
        .pricing-card {
            background: #fff; border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05); transition: 0.4s; border: 1px solid #eee;
            position: relative; height: 100%; display: flex; flex-direction: column;
        }
        .pricing-card:hover { transform: translateY(-10px); box-shadow: 0 20px 40px rgba(0,0,0,0.1); border-color: #00897b; }
        .pricing-header { padding: 30px 20px; text-align: center; border-bottom: 1px solid #f0f0f0; background: #fafafa; border-radius: 20px 20px 0 0; }
        .pricing-icon { font-size: 40px; color: #00897b; margin-bottom: 15px; }
        .pricing-title { font-weight: 800; font-size: 20px; color: #2c3e50; margin-bottom: 10px; }
        .pricing-price { font-size: 36px; font-weight: 900; color: #e74c3c; line-height: 1; }
        .pricing-price span { font-size: 14px; color: #999; font-weight: 500; }
        .pricing-body { padding: 30px 20px; flex-grow: 1; }
        .pricing-list { list-style: none; padding: 0; margin: 0 0 20px 0; }
        .pricing-list li { padding: 8px 0; border-bottom: 1px dashed #eee; font-size: 14px; color: #555; position: relative; padding-left: 25px; }
        .pricing-list li:last-child { border-bottom: none; }
        .pricing-list li::before { content: '\f00c'; font-family: 'Font Awesome 6 Free'; font-weight: 900; color: #2ecc71; position: absolute; left: 0; top: 9px; }
        .pricing-footer { padding: 0 20px 30px; text-align: center; margin-top: auto; }
        .btn-select-plan { background: #f8f9fa; color: #00897b; border: 2px solid #00897b; border-radius: 12px; padding: 12px 25px; font-weight: 700; transition: 0.3s; width: 100%; }
        .pricing-card:hover .btn-select-plan { background: #00897b; color: #fff; }

        .popular-badge { position: absolute; top: 15px; right: -35px; background: #e74c3c; color: #fff; font-size: 11px; font-weight: 800; padding: 5px 40px; transform: rotate(45deg); letter-spacing: 1px; }

        /* FEATURES SECTION */
        .feature-box { text-align: center; padding: 30px 20px; }
        .feature-box-icon { width: 80px; height: 80px; background: #e0f2f1; color: #00897b; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 32px; margin: 0 auto 20px; transition: 0.3s; }
        .feature-box:hover .feature-box-icon { background: #00897b; color: #fff; transform: scale(1.1); }
        .feature-box h4 { font-weight: 700; font-size: 18px; margin-bottom: 10px; color: #2c3e50; }
        .feature-box p { font-size: 14px; color: #666; line-height: 1.6; }

        /* FOOTER */
        .page-footer { background: #0c2233; color: rgba(255,255,255,0.6); padding: 40px 0; text-align: center; font-size: 14px; }
        .page-footer a { color: #4db6ac; text-decoration: none; }
    </style>
</head>
<body>

<!-- NAVBAR -->
<nav class="top-nav">
    <div class="container d-flex justify-content-between align-items-center py-3">
        <a href="<?= BASEURL ?>/home" class="brand-logo">SKYLINE<span>TICKET</span></a>
        <div class="d-flex gap-2">
            <a href="<?= BASEURL ?>/home" class="nav-link-custom"><i class="fas fa-home me-1"></i> Trang chủ</a>
            <a href="<?= BASEURL ?>/service/insurance" class="nav-link-custom" style="background:#e0f2f1; color:#00897b;"><i class="fas fa-shield-alt me-1"></i> Bảo Hiểm</a>
            <a href="<?= BASEURL ?>/service/shopping" class="nav-link-custom"><i class="fas fa-shopping-cart me-1"></i> Mua sắm</a>
            <a href="<?= BASEURL ?>/service/hotelTour" class="nav-link-custom"><i class="fas fa-hotel me-1"></i> Khách sạn & Tour</a>
        </div>
    </div>
</nav>

<!-- HERO -->
<section class="hero-section">
    <div class="container">
        <div class="shield-icon"><i class="fas fa-shield-check"></i></div>
        <h1>Bảo Hiểm Du Lịch Toàn Diện</h1>
        <p>Bảo vệ toàn diện cho mọi hành trình của bạn. An tâm tận hưởng chuyến đi, mọi rủi ro đã có Skyline Ticket lo.</p>
    </div>
</section>

<!-- PNR FORM -->
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="pnr-box text-center">
                <h3>Thêm Bảo Hiểm Vào Chuyến Bay Đã Đặt</h3>
                <form class="row g-3 mt-3 align-items-end" action="<?= BASEURL ?>/service/insurance" method="POST">
                    <div class="col-md-5 text-start">
                        <label class="form-label text-muted fw-bold" style="font-size:12px; margin-bottom:5px;">MÃ ĐẶT CHỖ (PNR)</label>
                        <input type="text" class="form-control form-control-custom" placeholder="VD: ABCXYZ" maxlength="6" name="pnr" required>
                    </div>
                    <div class="col-md-4 text-start">
                        <label class="form-label text-muted fw-bold" style="font-size:12px; margin-bottom:5px;">HỌ TÊN HÀNH KHÁCH</label>
                        <input type="text" class="form-control form-control-custom" placeholder="NGUYEN VAN A" name="fullname" required>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn-check-pnr">Tra Cứu <i class="fas fa-arrow-right ms-1"></i></button>
                    </div>
                </form>
                <div class="mt-4 text-muted" style="font-size:13px;">
                    <i class="fas fa-info-circle text-info me-1"></i> Chỉ áp dụng cho các chuyến bay chưa khởi hành.
                </div>
            </div>
        </div>
    </div>
</div>

<!-- PRICING CARDS -->
<div class="container mt-5 pt-5">
    <h2 class="section-title">Các Gói Bảo Hiểm Cơ Bản</h2>
    <p class="section-subtitle">Lựa chọn gói bảo vệ phù hợp với nhu cầu của chuyến đi. Biểu phí áp dụng cho 1 hành khách / 1 chặng bay.</p>
    
    <div class="row g-4 justify-content-center">
        <!-- Basic Plan -->
        <div class="col-md-6 col-lg-4">
            <div class="pricing-card">
                <div class="pricing-header">
                    <div class="pricing-icon"><i class="fas fa-clock"></i></div>
                    <h3 class="pricing-title">Trễ Chuyến Bay</h3>
                    <div class="pricing-price">49.000₫ <span>/người</span></div>
                </div>
                <div class="pricing-body">
                    <ul class="pricing-list">
                        <li>Bồi thường <strong>1.500.000₫</strong> nếu chuyến bay trễ quá 3 tiếng</li>
                        <li>Hỗ trợ chi phí ăn uống, khách sạn trong thời gian chờ</li>
                        <li>Bảo hiểm chuyến bay bị hủy do thời tiết</li>
                        <li>Quy trình bồi thường tự động qua tài khoản</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <button class="btn-select-plan" data-bs-toggle="modal" data-bs-target="#insuranceModal" data-plan="Trễ Chuyến Bay" data-price="49000">Chọn Gói Này</button>
                </div>
            </div>
        </div>
        
        <!-- Standard Plan -->
        <div class="col-md-6 col-lg-4">
            <div class="pricing-card" style="border: 2px solid #00897b; transform: scale(1.03); z-index:2; box-shadow: 0 15px 40px rgba(0,137,123,0.15);">
                <div class="popular-badge">PHỔ BIẾN</div>
                <div class="pricing-header" style="background: linear-gradient(135deg, #e0f2f1, #b2dfdb);">
                    <div class="pricing-icon" style="color:#00695c;"><i class="fas fa-suitcase"></i></div>
                    <h3 class="pricing-title" style="color:#004d40;">An Tâm Hành Lý</h3>
                    <div class="pricing-price" style="color:#c0392b;">89.000₫ <span>/người</span></div>
                </div>
                <div class="pricing-body">
                    <ul class="pricing-list">
                        <li>Bao gồm tất cả quyền lợi của gói Trễ Chuyến Bay</li>
                        <li>Bồi thường lên đến <strong>15.000.000₫</strong> cho hành lý thất lạc</li>
                        <li>Bồi thường hư hỏng hành lý trong quá trình vận chuyển</li>
                        <li>Hỗ trợ 2.000.000₫ mua vật dụng khẩn cấp nếu hành lý đến trễ</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <button class="btn-select-plan" style="background:#00897b; color:#fff;" data-bs-toggle="modal" data-bs-target="#insuranceModal" data-plan="An Tâm Hành Lý" data-price="89000">Chọn Gói Phổ Biến</button>
                </div>
            </div>
        </div>

        <!-- Premium Plan -->
        <div class="col-md-6 col-lg-4">
            <div class="pricing-card">
                <div class="pricing-header">
                    <div class="pricing-icon"><i class="fas fa-heartbeat"></i></div>
                    <h3 class="pricing-title">Y Tế Toàn Diện</h3>
                    <div class="pricing-price">199.000₫ <span>/người</span></div>
                </div>
                <div class="pricing-body">
                    <ul class="pricing-list">
                        <li>Bao gồm tất cả quyền lợi của gói An Tâm Hành Lý</li>
                        <li>Chi phí y tế nước ngoài lên đến <strong>2 Tỷ Đồng</strong></li>
                        <li>Vận chuyển y tế khẩn cấp, hồi hương không giới hạn</li>
                        <li>Trợ cấp nằm viện 1.000.000₫/ngày</li>
                        <li>Tổng đài hỗ trợ toàn cầu 24/7 (Đa ngôn ngữ)</li>
                    </ul>
                </div>
                <div class="pricing-footer">
                    <button class="btn-select-plan" data-bs-toggle="modal" data-bs-target="#insuranceModal" data-plan="Y Tế Toàn Diện" data-price="199000">Chọn Gói Này</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- WHY CHOOSE US -->
<div class="container mt-5 pt-5 mb-5">
    <div class="row align-items-center">
        <div class="col-lg-5 mb-4 mb-lg-0">
            <h2 class="fw-bold mb-4" style="color:#1a1a2e; font-size:32px;">Vì sao nên chọn bảo hiểm tại Skyline Ticket?</h2>
            <p class="text-muted mb-4" style="line-height:1.7;">Chúng tôi hợp tác với các tập đoàn bảo hiểm hàng đầu thế giới để mang đến sự bảo vệ tốt nhất cho bạn. Thủ tục đơn giản, bồi thường nhanh chóng, hoàn toàn trực tuyến.</p>
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-check-circle text-success fs-5 me-3"></i> <span class="fw-bold">100% Online:</span> Không giấy tờ phức tạp
            </div>
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-check-circle text-success fs-5 me-3"></i> <span class="fw-bold">Tự động bồi thường:</span> Trễ chuyến hệ thống tự quét
            </div>
            <div class="d-flex align-items-center mb-3">
                <i class="fas fa-check-circle text-success fs-5 me-3"></i> <span class="fw-bold">Hỗ trợ 24/7:</span> Có mặt khi bạn cần nhất
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row g-4">
                <div class="col-sm-6">
                    <div class="feature-box bg-white rounded-4 shadow-sm h-100 border">
                        <div class="feature-box-icon"><i class="fas fa-bolt"></i></div>
                        <h4>Giải Quyết Siêu Tốc</h4>
                        <p>Quy trình thẩm định bồi thường chỉ trong 3-5 ngày làm việc.</p>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="feature-box bg-white rounded-4 shadow-sm h-100 border">
                        <div class="feature-box-icon"><i class="fas fa-globe-americas"></i></div>
                        <h4>Bảo Vệ Toàn Cầu</h4>
                        <p>Mạng lưới đối tác y tế rộng khắp hơn 150 quốc gia và vùng lãnh thổ.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="page-footer">
    <div class="container">
        <p>&copy; 2026 <a href="<?= BASEURL ?>/home">Skyline Ticket</a>. Các gói bảo hiểm được phát hành bởi công ty Bảo Hiểm Toàn Cầu.</p>
    </div>
</footer>

<!-- INSURANCE MODAL -->
<div class="modal fade" id="insuranceModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 rounded-4 shadow-lg">
            <div class="modal-header text-white rounded-top-4 border-0 p-4" style="background: linear-gradient(135deg, #00897b, #00695c);">
                <h5 class="modal-title fw-bold fs-5"><i class="fas fa-shield-check me-2"></i>Thanh Toán Bảo Hiểm</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <form action="<?= BASEURL ?>/service/processInsurance" method="POST">
                    <div class="mb-4 text-center">
                        <span class="badge bg-light text-success mb-2 px-3 py-2 fs-6 rounded-pill">Gói: <span id="modalPlanName" class="fw-bold"></span></span>
                        <h3 class="fw-bold text-danger mb-0" id="modalPlanPriceStr"></h3>
                        <input type="hidden" id="modalPlanNameInput" name="plan_name" value="">
                        <input type="hidden" id="modalPlanPriceInput" name="plan_price" value="">
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold text-muted small">MÃ ĐẶT CHỖ (PNR)</label>
                        <input type="text" class="form-control form-control-custom" name="pnr" placeholder="Nhập 6 ký tự PNR" maxlength="6" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label fw-bold text-muted small">HỌ TÊN HÀNH KHÁCH</label>
                        <input type="text" class="form-control form-control-custom" name="fullname" placeholder="VD: NGUYEN VAN A" required>
                    </div>
                    
                    <button type="submit" class="btn-check-pnr w-100 py-3 rounded-pill fs-5 shadow-sm"><i class="fas fa-lock me-2"></i>Đến Trang Thanh Toán</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const insuranceModal = document.getElementById('insuranceModal');
    if (insuranceModal) {
        insuranceModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;
            const plan = button.getAttribute('data-plan');
            const price = button.getAttribute('data-price');
            
            document.getElementById('modalPlanName').textContent = plan;
            document.getElementById('modalPlanNameInput').value = plan;
            
            // Format price as VNĐ
            const priceStr = new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(price);
            document.getElementById('modalPlanPriceStr').textContent = priceStr;
            document.getElementById('modalPlanPriceInput').value = price;
        });
    }
</script>
</body>
</html>
