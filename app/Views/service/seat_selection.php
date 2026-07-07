<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; }

        /* NAVBAR */
        .navbar { background: linear-gradient(135deg, #0c3547 0%, #1a5276 50%, #2980b9 100%); box-shadow: 0 4px 20px rgba(0,0,0,0.15); }
        .brand-logo { font-weight: 800; font-size: 24px; color: #fff; text-decoration: none; }
        .brand-logo span { color: #f39c12; }
        .nav-link-custom { color: rgba(255,255,255,0.85); text-decoration: none; font-weight: 600; font-size: 14px; transition: all 0.3s; padding: 8px 16px; border-radius: 8px; }
        .nav-link-custom:hover { color: #fff; background: rgba(255,255,255,0.1); }

        /* HERO BANNER */
        .hero-banner {
            background: linear-gradient(135deg, #0c3547 0%, #1a5276 40%, #2980b9 100%);
            padding: 60px 0 40px;
            position: relative;
            overflow: hidden;
        }
        .hero-banner::before {
            content: ''; position: absolute; top: -50%; right: -20%; width: 600px; height: 600px;
            background: radial-gradient(circle, rgba(243,156,18,0.15) 0%, transparent 70%);
            border-radius: 50%;
        }
        .hero-banner::after {
            content: ''; position: absolute; bottom: -40%; left: -10%; width: 500px; height: 500px;
            background: radial-gradient(circle, rgba(161,196,253,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        .breadcrumb-item a { color: rgba(255,255,255,0.7); text-decoration: none; }
        .breadcrumb-item a:hover { color: #f39c12; }
        .breadcrumb-item.active { color: rgba(255,255,255,0.5); }
        .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

        /* INTRO SECTION */
        .intro-section { background: white; padding: 50px 0; border-bottom: 1px solid #eee; }
        .intro-icon { width: 60px; height: 60px; border-radius: 16px; background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 24px; flex-shrink: 0; }
        .intro-text h2 { font-weight: 800; color: #0c3547; font-size: 28px; margin-bottom: 12px; }
        .intro-text p { color: #666; line-height: 1.8; font-size: 15px; }

        /* STEPS */
        .steps-section { padding: 60px 0; background: #f8fbff; }
        .section-badge { display: inline-block; background: linear-gradient(135deg, #fff5e6 0%, #ffe0b2 100%); color: #e67e22; font-size: 12px; font-weight: 700; padding: 5px 16px; border-radius: 20px; text-transform: uppercase; letter-spacing: 1px; margin-bottom: 10px; }
        .section-title { font-size: 28px; font-weight: 800; color: #0c3547; margin-bottom: 40px; }
        
        .step-card {
            background: white; border-radius: 20px; padding: 35px 25px; text-align: center;
            border: 2px solid #f0f0f0; transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative; overflow: hidden; height: 100%;
        }
        .step-card::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 4px;
            background: linear-gradient(90deg, #f39c12, #e67e22); opacity: 0; transition: opacity 0.3s;
        }
        .step-card:hover { transform: translateY(-8px); box-shadow: 0 20px 50px rgba(12,53,71,0.12); border-color: #e0e0e0; }
        .step-card:hover::before { opacity: 1; }
        
        .step-number { width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #0c3547, #1a5276); color: white; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 20px; margin: 0 auto 20px; }
        .step-card h5 { font-weight: 700; color: #0c3547; margin-bottom: 12px; font-size: 17px; }
        .step-card p { color: #777; font-size: 14px; line-height: 1.7; }

        /* SEAT TYPES */
        .seat-types-section { padding: 60px 0; background: white; }
        .seat-type-card {
            border-radius: 20px; overflow: hidden; background: white;
            border: 2px solid #f0f0f0; transition: all 0.4s; position: relative; height: 100%;
        }
        .seat-type-card:hover { transform: translateY(-6px); box-shadow: 0 15px 40px rgba(0,0,0,0.1); }
        .seat-type-card img { width: 100%; height: 220px; object-fit: cover; transition: transform 0.5s; }
        .seat-type-card:hover img { transform: scale(1.05); }
        .seat-type-card .img-wrapper { overflow: hidden; position: relative; }
        .seat-type-card .badge-label {
            position: absolute; top: 15px; left: 15px; padding: 5px 14px; border-radius: 20px;
            font-size: 12px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px;
        }
        .seat-type-card .card-body { padding: 25px; }
        .seat-type-card h5 { font-weight: 700; color: #0c3547; margin-bottom: 10px; }
        .seat-type-card p { color: #777; font-size: 14px; line-height: 1.7; }
        .seat-type-card .price-tag { font-size: 22px; font-weight: 800; color: #e67e22; }
        .seat-type-card .price-tag small { font-size: 13px; color: #999; font-weight: 500; }

        .feature-list { list-style: none; padding: 0; margin: 15px 0 0; }
        .feature-list li { padding: 6px 0; font-size: 14px; color: #555; display: flex; align-items: center; }
        .feature-list li i { color: #27ae60; margin-right: 10px; font-size: 13px; width: 20px; text-align: center; }

        /* BOOKING FORM */
        .booking-section { padding: 60px 0; background: #f8fbff; }
        .booking-card {
            background: white; border-radius: 24px; padding: 40px; 
            box-shadow: 0 10px 40px rgba(0,0,0,0.06); border: 1px solid #eee;
        }
        .form-label-custom { font-size: 13px; color: #0c3547; font-weight: 700; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-control-custom, .form-select-custom {
            border-radius: 12px; padding: 14px 18px; border: 2px solid #e8eef5;
            font-size: 15px; font-weight: 500; transition: all 0.3s; height: auto;
        }
        .form-control-custom:focus, .form-select-custom:focus { border-color: #f39c12; box-shadow: 0 0 0 3px rgba(243,156,18,0.1); outline: none; }

        .btn-submit {
            background: linear-gradient(135deg, #f39c12 0%, #e67e22 100%); border: none;
            padding: 14px 50px; border-radius: 50px; font-weight: 700; color: white;
            font-size: 16px; transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.5px;
            box-shadow: 0 4px 15px rgba(243,156,18,0.3);
        }
        .btn-submit:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(243,156,18,0.45); color: white; background: linear-gradient(135deg, #e67e22 0%, #d35400 100%); }

        /* FAQ SECTION */
        .faq-section { padding: 60px 0; background: white; }
        .accordion-item { border: 2px solid #f0f0f0; border-radius: 16px !important; margin-bottom: 15px; overflow: hidden; }
        .accordion-button { font-weight: 700; color: #0c3547; font-size: 16px; padding: 20px 25px; background: white; }
        .accordion-button:not(.collapsed) { background: #f8fbff; color: #0c3547; box-shadow: none; }
        .accordion-button::after { background-size: 14px; }
        .accordion-button:focus { box-shadow: none; border-color: transparent; }
        .accordion-body { padding: 0 25px 25px; color: #666; line-height: 1.8; font-size: 15px; }

        /* NOTE SECTION */
        .note-box {
            background: linear-gradient(135deg, #fff9e6 0%, #fff3cd 100%);
            border-left: 5px solid #f39c12; border-radius: 0 16px 16px 0;
            padding: 25px 30px; margin-top: 30px;
        }
        .note-box h6 { font-weight: 700; color: #e67e22; margin-bottom: 10px; }
        .note-box p { color: #856404; font-size: 14px; line-height: 1.7; margin: 0; }

        /* FOOTER */
        .site-footer { background: #0c3547; padding: 40px 0; }
        .footer-text { color: rgba(255,255,255,0.6); font-size: 14px; }
        .footer-link { color: rgba(255,255,255,0.6); text-decoration: none; transition: 0.3s; }
        .footer-link:hover { color: #f39c12; }

        @media (max-width: 768px) {
            .hero-banner { padding: 40px 0 30px; }
            .intro-section { padding: 30px 0; }
            .booking-card { padding: 25px; }
            .section-title { font-size: 22px; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <a href="<?= BASEURL ?>/home" class="nav-link-custom me-2"><i class="fas fa-home me-1"></i> Trang chủ</a>
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="text-white me-3 fw-bold" style="font-size:14px;"><i class="fas fa-user-circle me-1"></i> <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="<?= BASEURL ?>/auth/logout" class="nav-link-custom" style="border: 1px solid rgba(255,255,255,0.3); border-radius: 25px; padding: 6px 20px;">Đăng xuất</a>
                <?php else: ?>
                    <a href="<?= BASEURL ?>/auth/login" class="nav-link-custom me-2">Đăng nhập</a>
                    <a href="<?= BASEURL ?>/auth/register" class="nav-link-custom" style="background: #f39c12; color: white; border-radius: 25px; padding: 8px 20px;">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- HERO BANNER -->
    <section class="hero-banner">
        <div class="container position-relative" style="z-index:2;">
            <nav aria-label="breadcrumb" class="mb-3">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="<?= BASEURL ?>/home">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="#">Dịch vụ bổ sung</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chọn trước chỗ ngồi</li>
                </ol>
            </nav>
            <h1 class="text-white fw-bold mb-3" style="font-size: 38px;">Chọn trước chỗ ngồi</h1>
            <p class="text-white mb-0" style="opacity: 0.8; max-width: 700px; line-height: 1.7;">
                Hãy chủ động lựa chọn vị trí yêu thích trên chuyến bay của bạn. Từ ghế cửa sổ để ngắm cảnh, ghế lối đi để di chuyển dễ dàng, hay ghế hàng đầu với không gian rộng rãi hơn.
            </p>
        </div>
    </section>

    <!-- INTRO SECTION -->
    <section class="intro-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="d-flex align-items-start gap-4">
                        <div class="intro-icon">
                            <i class="fas fa-chair"></i>
                        </div>
                        <div class="intro-text">
                            <h2>Tại sao nên chọn trước chỗ ngồi?</h2>
                            <p class="mb-0">
                                Với Skyline Ticket, bạn có thể chọn trước chỗ ngồi yêu thích trên máy bay, đảm bảo chuyến đi thoải mái nhất. 
                                Dịch vụ cho phép hành khách chủ động lựa chọn vị trí ngồi phù hợp với nhu cầu cá nhân — 
                                từ ghế cửa sổ để ngắm nhìn bầu trời, ghế lối đi tiện di chuyển, cho đến ghế hàng đầu với không gian để chân rộng rãi.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 text-center mt-4 mt-lg-0">
                    <img src="https://images.unsplash.com/photo-1540339832862-474599807836?auto=format&fit=crop&w=500&q=80" 
                         alt="Seat Selection" style="border-radius: 20px; width: 100%; max-width: 350px; box-shadow: 0 15px 40px rgba(0,0,0,0.1);">
                </div>
            </div>
        </div>
    </section>

    <!-- STEPS SECTION -->
    <section class="steps-section">
        <div class="container text-center">
            <span class="section-badge"><i class="fas fa-list-ol me-1"></i> Hướng dẫn</span>
            <h2 class="section-title">Hướng dẫn chọn trước chỗ ngồi</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">1</div>
                        <h5>Đăng nhập tài khoản</h5>
                        <p>Đăng nhập vào tài khoản Skyline Ticket hoặc nhập mã đặt chỗ của bạn.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">2</div>
                        <h5>Chọn chuyến bay</h5>
                        <p>Chọn chuyến bay bạn muốn đặt chỗ ngồi từ danh sách các chuyến bay sắp tới.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">3</div>
                        <h5>Chọn vị trí ghế</h5>
                        <p>Xem sơ đồ ghế và chọn vị trí yêu thích trên máy bay. Xem giá từng khu vực.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="step-card">
                        <div class="step-number">4</div>
                        <h5>Xác nhận & Thanh toán</h5>
                        <p>Xác nhận lựa chọn và thanh toán. Chỗ ngồi sẽ được giữ ngay lập tức cho bạn.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SEAT TYPES -->
    <section class="seat-types-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge"><i class="fas fa-couch me-1"></i> Loại ghế</span>
                <h2 class="section-title">Tận hưởng chuyến bay theo cách riêng</h2>
            </div>
            <div class="row g-4">
                <!-- Standard Seat -->
                <div class="col-lg-4">
                    <div class="seat-type-card">
                        <div class="img-wrapper">
                            <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=600&q=80" alt="Standard Seat">
                            <span class="badge-label bg-secondary text-white">Phổ thông</span>
                        </div>
                        <div class="card-body">
                            <h5>Ghế tiêu chuẩn</h5>
                            <p>Ghế ngồi tiêu chuẩn trên chuyến bay, đảm bảo thoải mái cho hành trình của bạn.</p>
                            <div class="price-tag">Miễn phí <small>/ được chỉ định tự động</small></div>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> Được chỉ định tự động khi check-in</li>
                                <li><i class="fas fa-check-circle"></i> Khoảng cách ghế tiêu chuẩn 79cm</li>
                                <li><i class="fas fa-check-circle"></i> Màn hình giải trí cá nhân</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Preferred Seat -->
                <div class="col-lg-4">
                    <div class="seat-type-card" style="border-color: #a1c4fd;">
                        <div class="img-wrapper">
                            <img src="https://images.unsplash.com/photo-1540339832862-474599807836?auto=format&fit=crop&w=600&q=80" alt="Preferred Seat">
                            <span class="badge-label text-white" style="background: linear-gradient(135deg, #2980b9, #3498db);">Ưu tiên</span>
                        </div>
                        <div class="card-body">
                            <h5>Ghế ưu tiên</h5>
                            <p>Ghế ở vị trí đẹp: cửa sổ, lối đi hoặc hàng trước, giúp bạn thoải mái hơn.</p>
                            <div class="price-tag">150.000₫ <small>/ mỗi chặng</small></div>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> Chọn ghế cửa sổ hoặc lối đi</li>
                                <li><i class="fas fa-check-circle"></i> Vị trí gần phía trước cabin</li>
                                <li><i class="fas fa-check-circle"></i> Ra máy bay nhanh hơn</li>
                                <li><i class="fas fa-check-circle"></i> Ngồi cạnh người đi cùng</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Extra Legroom -->
                <div class="col-lg-4">
                    <div class="seat-type-card" style="border-color: #f39c12;">
                        <div class="img-wrapper">
                            <img src="https://images.unsplash.com/photo-1570710891163-6d3b5c47248b?auto=format&fit=crop&w=600&q=80" alt="Extra Legroom">
                            <span class="badge-label text-white" style="background: linear-gradient(135deg, #f39c12, #e67e22);">Cao cấp</span>
                        </div>
                        <div class="card-body">
                            <h5>Ghế hàng đầu / Lối thoát hiểm</h5>
                            <p>Không gian để chân rộng rãi, lý tưởng cho hành trình dài và hành khách cao.</p>
                            <div class="price-tag">350.000₫ <small>/ mỗi chặng</small></div>
                            <ul class="feature-list">
                                <li><i class="fas fa-check-circle"></i> Không gian để chân tăng 50%</li>
                                <li><i class="fas fa-check-circle"></i> Khoảng cách ghế lên đến 97cm</li>
                                <li><i class="fas fa-check-circle"></i> Ưu tiên phục vụ đồ uống</li>
                                <li><i class="fas fa-check-circle"></i> Ngả ghế thoải mái hơn</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- NO TICKET BANNER -->
    <section class="py-4" style="background: linear-gradient(135deg, #0071c2 0%, #0c3547 100%);">
        <div class="container text-center">
            <h4 class="text-white fw-bold mb-2">Bạn chưa có vé máy bay?</h4>
            <p class="text-white mb-3" style="opacity: 0.9;">Đặt vé máy bay cùng Skyline Ticket ngay hôm nay và thỏa sức lựa chọn chỗ ngồi ưng ý!</p>
            <a href="<?= BASEURL ?>/flight/search" class="btn btn-light fw-bold px-4" style="color: #0071c2; border-radius: 25px;">
                <i class="fas fa-plane-departure me-2"></i> Mua vé máy bay ngay
            </a>
        </div>
    </section>

    <!-- BOOKING FORM -->
    <section class="booking-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge"><i class="fas fa-edit me-1"></i> Đặt chỗ</span>
                <h2 class="section-title">Chọn chỗ ngồi cho chuyến bay của bạn</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="booking-card">
                        <form action="<?= BASEURL ?>/service/processSeatSelection" method="POST" id="seatSelectionForm">
                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom"><i class="fas fa-hashtag me-1"></i> Mã đặt chỗ (PNR) *</label>
                                    <input type="text" name="pnr" class="form-control form-control-custom" placeholder="Ví dụ: ABC123" maxlength="6" style="text-transform: uppercase;" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom"><i class="fas fa-user me-1"></i> Họ hành khách *</label>
                                    <input type="text" name="last_name" class="form-control form-control-custom" placeholder="Nhập họ trên vé" required>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-4">
                                    <label class="form-label-custom"><i class="fas fa-plane-departure me-1"></i> Điểm đi *</label>
                                    <select name="departure" class="form-select form-select-custom" required>
                                        <option value="" selected disabled>Chọn điểm đi</option>
                                        <option value="HAN">Hà Nội (HAN)</option>
                                        <option value="SGN">TP. Hồ Chí Minh (SGN)</option>
                                        <option value="DAD">Đà Nẵng (DAD)</option>
                                        <option value="CXR">Nha Trang (CXR)</option>
                                        <option value="PQC">Phú Quốc (PQC)</option>
                                        <option value="HUI">Huế (HUI)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom"><i class="fas fa-plane-arrival me-1"></i> Điểm đến *</label>
                                    <select name="destination" class="form-select form-select-custom" required>
                                        <option value="" selected disabled>Chọn điểm đến</option>
                                        <option value="HAN">Hà Nội (HAN)</option>
                                        <option value="SGN">TP. Hồ Chí Minh (SGN)</option>
                                        <option value="DAD">Đà Nẵng (DAD)</option>
                                        <option value="CXR">Nha Trang (CXR)</option>
                                        <option value="PQC">Phú Quốc (PQC)</option>
                                        <option value="HUI">Huế (HUI)</option>
                                        <option value="SIN">Singapore (SIN)</option>
                                        <option value="BKK">Bangkok (BKK)</option>
                                        <option value="ICN">Seoul (ICN)</option>
                                        <option value="NRT">Tokyo (NRT)</option>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <label class="form-label-custom"><i class="far fa-calendar-alt me-1"></i> Ngày khởi hành *</label>
                                    <input type="date" name="departure_date" class="form-control form-control-custom" id="departureDate" required>
                                </div>
                            </div>

                            <div class="row g-4 mb-4">
                                <div class="col-md-6">
                                    <label class="form-label-custom"><i class="fas fa-chair me-1"></i> Loại ghế mong muốn</label>
                                    <select name="seat_type" class="form-select form-select-custom" required>
                                        <option value="" selected disabled>Chọn loại ghế</option>
                                        <option value="0">Ghế tiêu chuẩn (Miễn phí)</option>
                                        <option value="150000">Ghế ưu tiên - Cửa sổ (150.000₫)</option>
                                        <option value="150000">Ghế ưu tiên - Lối đi (150.000₫)</option>
                                        <option value="350000">Ghế hàng đầu (350.000₫)</option>
                                        <option value="350000">Ghế lối thoát hiểm (350.000₫)</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label-custom"><i class="fas fa-ticket-alt me-1"></i> Hạng dịch vụ</label>
                                    <select name="class_type" class="form-select form-select-custom">
                                        <option value="" selected disabled>Chọn hạng dịch vụ</option>
                                        <option value="eco">Phổ thông (Economy)</option>
                                        <option value="premium">Phổ thông đặc biệt (Premium Economy)</option>
                                        <option value="biz">Thương gia (Business)</option>
                                    </select>
                                </div>
                            </div>

                            <div class="note-box">
                                <h6><i class="fas fa-info-circle me-1"></i> Lưu ý quan trọng</h6>
                                <p>Dịch vụ chọn trước chỗ ngồi áp dụng cho các chuyến bay do Skyline Ticket khai thác. 
                                Phí chọn chỗ ngồi sẽ khác nhau tùy theo hành trình, hạng dịch vụ và vị trí ghế. 
                                Chỗ ngồi đã chọn có thể thay đổi do lý do khai thác mà không cần thông báo trước.</p>
                            </div>

                            <div class="text-center mt-5">
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-search me-2"></i> Xác minh & Tìm chỗ ngồi
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ SECTION -->
    <section class="faq-section">
        <div class="container">
            <div class="text-center mb-5">
                <span class="section-badge"><i class="fas fa-question-circle me-1"></i> FAQ</span>
                <h2 class="section-title">Câu hỏi thường gặp</h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-9">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    <i class="fas fa-plane me-3" style="color: #f39c12;"></i> Khi nào tôi có thể chọn trước chỗ ngồi?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Bạn có thể chọn trước chỗ ngồi ngay sau khi hoàn tất đặt vé, từ thời điểm mua vé cho đến trước 4 giờ so với giờ khởi hành. 
                                    Đối với hành khách chưa chọn chỗ, hệ thống sẽ tự động chỉ định ghế khi làm thủ tục check-in.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    <i class="fas fa-money-bill-wave me-3" style="color: #f39c12;"></i> Phí chọn chỗ ngồi là bao nhiêu?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Phí chọn chỗ ngồi phụ thuộc vào loại ghế và hành trình:<br>
                                    • <strong>Ghế tiêu chuẩn:</strong> Miễn phí (được chỉ định tự động)<br>
                                    • <strong>Ghế ưu tiên</strong> (cửa sổ/lối đi, gần phía trước): từ 150.000₫/chặng<br>
                                    • <strong>Ghế hàng đầu / Lối thoát hiểm:</strong> từ 350.000₫/chặng<br>
                                    Phí có thể thay đổi tùy chuyến bay quốc tế hay nội địa.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    <i class="fas fa-exchange-alt me-3" style="color: #f39c12;"></i> Tôi có thể thay đổi chỗ ngồi sau khi đã chọn không?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Có, bạn có thể thay đổi chỗ ngồi miễn phí (không tính phí đổi ghế) nếu ghế mới cùng loại. 
                                    Nếu nâng cấp lên loại ghế cao hơn, bạn chỉ cần trả phần chênh lệch. 
                                    Thay đổi phải được thực hiện trước 4 giờ so với giờ khởi hành.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                    <i class="fas fa-baby me-3" style="color: #f39c12;"></i> Trẻ em và trẻ sơ sinh có được chọn chỗ ngồi không?
                                </button>
                            </h2>
                            <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Trẻ em từ 2 tuổi trở lên có ghế riêng và có thể được chọn chỗ ngồi. 
                                    Trẻ sơ sinh dưới 2 tuổi không có ghế riêng, ngồi cùng người lớn đi kèm. 
                                    Lưu ý: Ghế hàng thoát hiểm không áp dụng cho hành khách dưới 15 tuổi.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                    <i class="fas fa-undo me-3" style="color: #f39c12;"></i> Tôi có được hoàn phí nếu hủy chọn chỗ ngồi?
                                </button>
                            </h2>
                            <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Phí chọn chỗ ngồi sẽ được hoàn lại nếu chuyến bay bị hủy bởi hãng. 
                                    Trong trường hợp hành khách tự hủy chọn chỗ, phí sẽ không được hoàn trả. 
                                    Nếu hãng thay đổi chỗ ngồi do lý do khai thác, bạn sẽ được hoàn phí hoặc sắp xếp ghế tương đương.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer class="site-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <a class="brand-logo" href="<?= BASEURL ?>/home" style="font-size: 20px;">SKYLINE<span>TICKET</span></a>
                    <p class="footer-text mt-2 mb-0">© 2024 Skyline Ticket. Đã đăng ký bản quyền.</p>
                </div>
                <div class="col-md-6 text-md-end mt-3 mt-md-0">
                    <a href="<?= BASEURL ?>/home" class="footer-link me-3">Trang chủ</a>
                    <a href="<?= BASEURL ?>/service/baggageBuy" class="footer-link me-3">Mua hành lý</a>
                    <a href="<?= BASEURL ?>/service/baggageInfo" class="footer-link me-3">Tra cứu hành lý</a>
                    <a href="<?= BASEURL ?>/service/seatSelection" class="footer-link">Chọn chỗ ngồi</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Set min date to today
        document.addEventListener('DOMContentLoaded', function() {
            const dateInput = document.getElementById('departureDate');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.setAttribute('min', today);
            }
        });

        function handleSeatSubmit() {
            // Show a premium modal-style alert
            const overlay = document.createElement('div');
            overlay.style.cssText = 'position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;display:flex;align-items:center;justify-content:center;animation:fadeIn 0.3s ease;';
            
            const modal = document.createElement('div');
            modal.style.cssText = 'background:white;border-radius:24px;padding:50px 40px;text-align:center;max-width:450px;width:90%;box-shadow:0 25px 60px rgba(0,0,0,0.3);animation:slideUp 0.4s ease;';
            modal.innerHTML = `
                <div style="width:80px;height:80px;border-radius:50%;background:linear-gradient(135deg,#f39c12,#e67e22);display:flex;align-items:center;justify-content:center;margin:0 auto 25px;">
                    <i class="fas fa-chair" style="font-size:35px;color:white;"></i>
                </div>
                <h4 style="font-weight:800;color:#0c3547;margin-bottom:12px;">Cảm ơn bạn!</h4>
                <p style="color:#777;line-height:1.7;margin-bottom:25px;">Yêu cầu chọn chỗ ngồi của bạn đã được ghi nhận. Hệ thống sẽ gửi xác nhận qua email trong vòng 24 giờ.</p>
                <button onclick="this.closest('div').parentElement.remove()" style="background:linear-gradient(135deg,#f39c12,#e67e22);color:white;border:none;padding:12px 40px;border-radius:50px;font-weight:700;cursor:pointer;font-size:15px;transition:all 0.3s;box-shadow:0 4px 15px rgba(243,156,18,0.3);" onmouseover="this.style.transform='translateY(-2px)'" onmouseout="this.style.transform='translateY(0)'">
                    Đã hiểu
                </button>
            `;
            
            overlay.appendChild(modal);
            document.body.appendChild(overlay);
            overlay.addEventListener('click', function(e) {
                if (e.target === overlay) overlay.remove();
            });
        }
    </script>
    <style>
        @keyframes fadeIn { from { opacity:0; } to { opacity:1; } }
        @keyframes slideUp { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
    </style>
</body>
</html>
