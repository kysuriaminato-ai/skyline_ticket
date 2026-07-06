<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Trang chủ - Skyline Ticket' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; }
        .navbar { background: transparent; box-shadow: none; position: absolute; top: 0; left: 0; width: 100%; z-index: 100; }
        .brand-logo { font-weight: 800; font-size: 24px; color: #fff; text-decoration: none; }
        .brand-logo span { color: #81d4fa; }

        /* HERO SECTION */
        .hero-section {
            background: url('https://images.unsplash.com/photo-1436491865332-7a61a109cc05?q=80&w=2074&auto=format&fit=crop') no-repeat center center/cover;
            padding: 180px 0 250px;
            position: relative;
            min-height: 75vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .hero-section::before {
            content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
            background: linear-gradient(to bottom, rgba(0,0,0,0.6) 0%, rgba(0,0,0,0.2) 15%, rgba(0,0,0,0.3) 100%);
        }
        
        /* TABS CONTROLS */
        .search-container { position: relative; z-index: 10; margin-top: 40px; }
        .search-box { background: white; border-radius: 15px; box-shadow: 0 10px 40px rgba(0,0,0,0.1); padding: 30px; position: relative; }
        
        .main-tabs { display: flex; border-bottom: 1px solid #e0e0e0; margin-bottom: 25px; }
        .main-tab { padding: 10px 25px; cursor: pointer; font-weight: 600; color: #666; position: relative; transition: 0.3s; }
        .main-tab:hover { color: #005e6a; }
        .main-tab.active { color: #005e6a; }
        .main-tab.active::after { content: ''; position: absolute; bottom: -1px; left: 0; width: 100%; height: 3px; background: #005e6a; border-radius: 3px 3px 0 0; }

        /* TABS PANES */
        .tab-pane { display: none; animation: fadeIn 0.4s ease forwards; }
        .tab-pane.active { display: block; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* ====== AIRPORT TRIGGER ====== */
        .airport-trigger {
            padding: 15px 20px;
            border: 1px solid #ced4da;
            border-radius: 8px;
            cursor: pointer;
            background: white;
            transition: 0.3s;
            position: relative;
        }
        .airport-trigger:hover { border-color: #005e6a; background: #fbfcfc; }
        .airport-trigger .label { font-size: 13px; color: #005e6a; font-weight: 600; margin-bottom: 2px; }
        .airport-trigger .code-display { font-size: 38px; font-weight: 800; color: #333; line-height: 1.1; }
        .airport-trigger .name-display { font-size: 13px; color: #666; margin-top: 5px; background: #f0f0f0; display: inline-block; padding: 2px 10px; border-radius: 12px; }
        
        .btn-swap {
            background: white; border: 1px solid #ced4da; border-radius: 50%;
            width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center;
            color: #005e6a; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
            z-index: 5; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
        .btn-swap:hover { background: #f0f8ff; transform: translate(-50%, -50%) rotate(180deg); border-color:#005e6a; }

        /* ====== MEGA DROPDOWN CHỌN SÂN BAY ====== */
        .mega-dropdown {
            position: absolute; top: calc(100% + 10px); left: 0; width: 100%; background: white;
            border-radius: 12px; box-shadow: 0 15px 50px rgba(0,0,0,0.2); z-index: 1000;
            display: none; overflow: hidden; border: 1px solid #e0e0e0;
        }
        .region-tabs { width: 200px; background: #f8f9fa; border-right: 1px solid #e0e0e0; }
        .region-tab { padding: 15px 20px; cursor: pointer; font-weight: 600; font-size: 14px; color: #555; border-bottom: 1px solid #eee; transition: 0.2s;}
        .region-tab.active { background: #005e6a; color: white; }
        .region-tab:hover:not(.active) { background: #e9ecef; color: #005e6a; }
        
        .airport-content { flex: 1; max-height: 400px; overflow-y: auto; padding: 20px; }
        .airport-group { display: none; }
        .airport-group.active { display: block; }
        .airport-item { display: flex; justify-content: space-between; align-items: center; padding: 12px 15px; cursor: pointer; border-bottom: 1px dashed #eee; transition: 0.2s; border-radius: 6px; }
        .airport-item:hover { background: #f2f9fa; color: #005e6a; padding-left: 20px;}
        .airport-item .city-name { font-weight: 600; color: #333; }
        .airport-item .country-name { font-size: 12px; color: #888; display: block; }
        .airport-item .code { font-weight: bold; color: #005e6a; background: #e0f2f1; padding: 3px 8px; border-radius: 4px; font-size: 13px;}

        /* BỘ LỌC NGÀY VÀ HÀNH KHÁCH */
        .form-control, .form-select { border-radius: 8px; padding: 12px 15px; border: 1px solid #ced4da; height: 50px; }
        
        /* PASSENGER DROPDOWN */
        .passenger-trigger { border: 1px solid #ced4da; border-radius: 8px; padding: 12px 15px 12px 40px; cursor: pointer; background: white; height: 50px; display: flex; align-items: center; justify-content: space-between; }
        .passenger-panel { position: absolute; top: 100%; left: 12px; right: 12px; background: white; border-radius: 8px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); padding: 20px; z-index: 100; display: none; border: 1px solid #e0e0e0; margin-top: 5px; }
        .passenger-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; }
        .counter-controls { display: flex; align-items: center; }
        .counter-btn { width: 32px; height: 32px; border-radius: 50%; border: 1px solid #005e6a; background: white; color: #005e6a; display: flex; justify-content: center; align-items: center; cursor: pointer; }
        .counter-value { width: 40px; text-align: center; font-weight: bold; }

        .btn-search { background-color: #005e6a; color: white; font-weight: bold; border-radius: 25px; transition: 0.3s; }
        .btn-search:hover { background-color: #00454e; transform: translateY(-2px); color: white;}

        /* ====== GIAO DIỆN QUẢN LÝ ĐẶT CHỖ ====== */
        .manage-input-box { display: flex; align-items: center; border-bottom: 2px solid #e0e0e0; padding: 10px 5px; margin-bottom: 20px; transition: 0.3s; }
        .manage-input-box:focus-within { border-color: #005e6a; }
        .manage-input-box i { font-size: 22px; color: #005e6a; margin-right: 15px; width: 30px; text-align: center; }
        .manage-input-content { flex: 1; }
        .manage-input-content label { font-size: 13px; color: #005e6a; font-weight: 600; margin-bottom: 5px; display: block; }
        .manage-input-content input { border: none; outline: none; width: 100%; font-size: 18px; font-weight: 600; color: #333; padding: 0; background: transparent; }
        .manage-input-content input::placeholder { color: #bbb; font-weight: 400; font-size: 16px; }

        .quick-links { margin-top: 30px; border-top: 1px solid #eee; padding-top: 25px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px;}
        .quick-link-item { text-align: center; text-decoration: none; color: #555; font-size: 14px; font-weight: 600; display: flex; align-items: center; transition: 0.3s; }
        .quick-link-item:hover { color: #005e6a; transform: translateY(-2px); }
        .quick-link-item i { margin-right: 8px; font-size: 18px; }

        /* ================= DESTINATION SECTION ================= */
        .dest-card { border-radius: 12px; overflow: hidden; transition: 0.3s; background: transparent; }
        .dest-card:hover { transform: translateY(-5px); }
        .dest-img { height: 160px; object-fit: cover; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s; margin-bottom: 10px;}
        .dest-card:hover .dest-img { box-shadow: 0 8px 20px rgba(0,0,0,0.2); }
        
        /* Style riêng cho khu vực Quốc tế giống hình mẫu */
        .dest-img-intl {
            height: 200px; 
            object-fit: cover; 
            border-radius: 20px 20px 0 0; /* Bo tròn lớn ở trên, vuông ở dưới */
            box-shadow: 0 4px 10px rgba(0,0,0,0.1); 
            transition: 0.3s; 
        }
        .dest-card:hover .dest-img-intl { box-shadow: 0 8px 20px rgba(0,0,0,0.2); }

        /* ================= FLOATING PROMO APP ================= */
        .promo-popup { position: fixed; bottom: 30px; right: 30px; background: white; border-radius: 16px; padding: 25px 20px 15px; width: 260px; box-shadow: 0 10px 30px rgba(0,0,0,0.15); z-index: 1050; border: 1px solid #e0e0e0; animation: slideUp 0.5s ease; }
        .btn-close-promo { position: absolute; top: -12px; right: -12px; background: #0d6efd; color: white; border: none; width: 30px; height: 30px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: 0.3s; font-size: 14px;}
        .btn-close-promo:hover { background: #0b5ed7; transform: scale(1.1); }
        @keyframes slideUp { from { transform: translateY(100px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

        /* ================= FOOTER TÙY CHỈNH ================= */
        .site-footer { background-color: #f6f8fb; }
        .footer-link { color: #555; text-decoration: none; transition: 0.3s; display: inline-block; font-size: 14px; cursor: pointer; }
        .footer-link:hover { color: #005e6a; transform: translateX(3px); }

        @media (max-width: 768px) {
            .mega-dropdown { flex-direction: column; width: 100vw; position: fixed; top: auto; bottom: 0; height: 70vh; border-radius: 20px 20px 0 0; z-index: 1050; }
            .region-tabs { width: 100%; display: flex; overflow-x: auto; border-right: none; border-bottom: 1px solid #e0e0e0; }
            .region-tab { white-space: nowrap; border-bottom: none; border-right: 1px solid #eee; }
            .btn-swap { transform: translate(-50%, -50%) rotate(90deg); }
            .btn-swap:hover { transform: translate(-50%, -50%) rotate(270deg); }
            .quick-links { justify-content: flex-start; }
            .quick-link-item { width: calc(50% - 15px); margin-bottom: 10px;}
            .promo-popup { display: none; }
        }

        /* EXTRA SERVICES ICONS */
        .extra-services { margin-top: 30px; border-top: 1px solid #e0e0e0; padding-top: 25px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;}
        .service-item { text-align: center; text-decoration: none; color: #555; font-size: 12px; font-weight: bold; flex: 1; min-width: 80px; display: flex; flex-direction: column; align-items: center; transition: 0.3s; text-transform: uppercase; }
        .service-item:hover { color: #005e6a; transform: translateY(-3px); }
        .service-item i { font-size: 26px; margin-bottom: 10px; color: #333; transition: 0.3s; }
        .service-item:hover i { color: #005e6a; }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg py-4">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="me-3 fw-bold text-white"><i class="fas fa-user-circle"></i> Xin chào, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    
                    <!-- NÚT TRANG QUẢN TRỊ HIỂN THỊ NẾU LÀ ADMIN HOẶC STAFF -->
                    <?php if (isset($_SESSION['role']) && ($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'staff')): ?>
                        <a href="<?= BASEURL ?>/admin/dashboard" class="btn btn-warning fw-bold me-2" style="background-color: #f6c23e; border: none; color: #fff;">
                            <i class="fas fa-cogs"></i> Trang Quản trị
                        </a>
                    <?php endif; ?>

                    <a href="<?= BASEURL ?>/auth/logout" class="btn btn-outline-light">Đăng xuất</a>
                <?php else: ?>
                    <a href="<?= BASEURL ?>/auth/login" class="btn btn-outline-light me-2 fw-bold px-4">Đăng nhập</a>
                    <a href="<?= BASEURL ?>/auth/register" class="btn btn-light fw-bold px-4 text-dark" style="border:none;">Đăng ký</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- HERO & SEARCH SECTION -->
    <section class="hero-section text-center text-white">
        <div class="container position-relative z-index-1">
            <h1 class="display-4 fw-bold mb-3" style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">KHÁM PHÁ THẾ GIỚI CÙNG SKYLINE</h1>
            <p class="lead mb-5" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.5);">Trải nghiệm dịch vụ bay đẳng cấp với hàng ngàn điểm đến</p>
        </div>
    <!-- FORM TÌM KIẾM -->
    <div class="container search-container text-start text-dark">
        <div class="search-box">
            
            <div class="main-tabs">
                <div class="main-tab active" data-tab="tab-muave"><i class="fas fa-ticket-alt me-2"></i> Mua vé</div>
                <div class="main-tab" data-tab="tab-quanly"><i class="fas fa-suitcase me-2"></i> Quản lý đặt chỗ</div>
                <div class="main-tab" data-tab="tab-thutuc"><i class="fas fa-check-circle me-2"></i> Làm thủ tục</div>
            </div>

            <!-- CONTAINER CHỨA CÁC TAB PANE -->
            <div class="tab-content-wrapper">
                
                <!-- ==================== TAB 1: MUA VÉ ==================== -->
                <div id="tab-muave" class="tab-pane active">
                    <form action="<?= BASEURL ?>/flight/search" method="GET" id="searchForm">
                        
                        <!-- Loại vé -->
                        <div class="d-flex gap-4 mb-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="trip_type" id="roundTrip" value="round" checked style="accent-color: #005e6a;">
                                <label class="form-check-label fw-bold" for="roundTrip">Khứ hồi</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="trip_type" id="oneWay" value="one_way" style="accent-color: #005e6a;">
                                <label class="form-check-label fw-bold" for="oneWay">Một chiều</label>
                            </div>
                        </div>

                        <!-- ĐIỂM ĐI & ĐIỂM ĐẾN -->
                        <div class="row g-0 align-items-center position-relative mb-4">
                            
                            <!-- Từ -->
                            <div class="col-md-5">
                                <div class="airport-trigger" id="deptTrigger" onclick="openAirportDropdown('dept', event)">
                                    <div class="label"><i class="fas fa-plane-departure me-1"></i> Từ</div>
                                    <div class="code-display" id="deptCode">HAN</div>
                                    <div class="name-display" id="deptName">Hà Nội, Việt Nam</div>
                                    <input type="hidden" name="departure" id="deptInput" value="Hà Nội (HAN)">
                                </div>
                            </div>
                            
                            <div class="col-md-2 position-relative" style="height: 0;">
                                <button type="button" class="btn-swap" id="btnSwap"><i class="fas fa-exchange-alt"></i></button>
                            </div>
                            
                            <!-- Đến -->
                            <div class="col-md-5">
                                <div class="airport-trigger" id="destTrigger" onclick="openAirportDropdown('dest', event)">
                                    <div class="label"><i class="fas fa-plane-arrival me-1"></i> Đến</div>
                                    <div class="code-display" id="destCode">MEL</div>
                                    <div class="name-display" id="destName">Melbourne, Úc</div>
                                    <input type="hidden" name="destination" id="destInput" value="Melbourne, Úc (MEL)">
                                </div>
                            </div>

                            <!-- MEGA DROPDOWN SẼ HIỂN THỊ Ở ĐÂY KHI CLICK -->
                            <div class="mega-dropdown" id="megaAirportDropdown">
                                <div class="d-flex flex-column flex-md-row h-100">
                                    <div class="region-tabs">
                                        <div class="region-tab active" data-target="vn">VIỆT NAM</div>
                                        <div class="region-tab" data-target="sea">ĐÔNG NAM Á</div>
                                        <div class="region-tab" data-target="nea">ĐÔNG BẮC Á</div>
                                        <div class="region-tab" data-target="eu">CHÂU ÂU</div>
                                        <div class="region-tab" data-target="au">CHÂU ĐẠI DƯƠNG</div>
                                        <div class="region-tab" data-target="us">BẮC MỸ</div>
                                    </div>
                                    <div class="airport-content">
                                        <!-- Việt Nam -->
                                        <div class="airport-group active" id="region-vn">
                                            <div class="airport-item" data-code="HAN" data-name="Hà Nội, Việt Nam" data-val="Hà Nội (HAN)">
                                                <div><span class="city-name">Hà Nội</span><span class="country-name">Việt Nam</span></div><span class="code">HAN</span>
                                            </div>
                                            <div class="airport-item" data-code="SGN" data-name="Tp. Hồ Chí Minh, Việt Nam" data-val="TP Hồ Chí Minh (SGN)">
                                                <div><span class="city-name">Tp. Hồ Chí Minh</span><span class="country-name">Việt Nam</span></div><span class="code">SGN</span>
                                            </div>
                                            <div class="airport-item" data-code="DAD" data-name="Đà Nẵng, Việt Nam" data-val="Đà Nẵng (DAD)">
                                                <div><span class="city-name">Đà Nẵng</span><span class="country-name">Việt Nam</span></div><span class="code">DAD</span>
                                            </div>
                                            <div class="airport-item" data-code="PQC" data-name="Phú Quốc, Việt Nam" data-val="Phú Quốc (PQC)">
                                                <div><span class="city-name">Phú Quốc</span><span class="country-name">Việt Nam</span></div><span class="code">PQC</span>
                                            </div>
                                            <div class="airport-item" data-code="CXR" data-name="Nha Trang, Việt Nam" data-val="Nha Trang (CXR)">
                                                <div><span class="city-name">Nha Trang</span><span class="country-name">Việt Nam</span></div><span class="code">CXR</span>
                                            </div>
                                            <div class="airport-item" data-code="BMV" data-name="Buôn Ma Thuột, Việt Nam" data-val="Buôn Ma Thuột (BMV)">
                                                <div><span class="city-name">Buôn Ma Thuột</span><span class="country-name">Việt Nam</span></div><span class="code">BMV</span>
                                            </div>
                                            <div class="airport-item" data-code="DLI" data-name="Đà Lạt, Việt Nam" data-val="Đà Lạt (DLI)">
                                                <div><span class="city-name">Đà Lạt</span><span class="country-name">Việt Nam</span></div><span class="code">DLI</span>
                                            </div>
                                        </div>
                                        
                                        <!-- Đông Nam Á -->
                                        <div class="airport-group" id="region-sea">
                                            <div class="airport-item" data-code="BKK" data-name="Bangkok, Thái Lan" data-val="Bangkok, Thái Lan (BKK)">
                                                <div><span class="city-name">Bangkok</span><span class="country-name">Thái Lan</span></div><span class="code">BKK</span>
                                            </div>
                                            <div class="airport-item" data-code="SIN" data-name="Singapore, Singapore" data-val="Singapore (SIN)">
                                                <div><span class="city-name">Singapore</span><span class="country-name">Singapore</span></div><span class="code">SIN</span>
                                            </div>
                                            <div class="airport-item" data-code="KUL" data-name="Kuala Lumpur, Malaysia" data-val="Kuala Lumpur (KUL)">
                                                <div><span class="city-name">Kuala Lumpur</span><span class="country-name">Malaysia</span></div><span class="code">KUL</span>
                                            </div>
                                            <div class="airport-item" data-code="CGK" data-name="Jakarta, Indonesia" data-val="Jakarta (CGK)">
                                                <div><span class="city-name">Jakarta</span><span class="country-name">Indonesia</span></div><span class="code">CGK</span>
                                            </div>
                                        </div>

                                        <!-- Đông Bắc Á -->
                                        <div class="airport-group" id="region-nea">
                                            <div class="airport-item" data-code="NRT" data-name="Tokyo, Nhật Bản" data-val="Tokyo, Nhật Bản (NRT)">
                                                <div><span class="city-name">Tokyo</span><span class="country-name">Nhật Bản</span></div><span class="code">NRT</span>
                                            </div>
                                            <div class="airport-item" data-code="ICN" data-name="Seoul, Hàn Quốc" data-val="Seoul, Hàn Quốc (ICN)">
                                                <div><span class="city-name">Seoul</span><span class="country-name">Hàn Quốc</span></div><span class="code">ICN</span>
                                            </div>
                                            <div class="airport-item" data-code="PEK" data-name="Bắc Kinh, Trung Quốc" data-val="Bắc Kinh (PEK)">
                                                <div><span class="city-name">Bắc Kinh</span><span class="country-name">Trung Quốc</span></div><span class="code">PEK</span>
                                            </div>
                                            <div class="airport-item" data-code="TPE" data-name="Đài Bắc, Đài Loan" data-val="Đài Bắc (TPE)">
                                                <div><span class="city-name">Đài Bắc</span><span class="country-name">Đài Loan</span></div><span class="code">TPE</span>
                                            </div>
                                        </div>

                                        <!-- Châu Âu -->
                                        <div class="airport-group" id="region-eu">
                                            <div class="airport-item" data-code="CDG" data-name="Paris, Pháp" data-val="Paris, Pháp (CDG)">
                                                <div><span class="city-name">Paris</span><span class="country-name">Pháp</span></div><span class="code">CDG</span>
                                            </div>
                                            <div class="airport-item" data-code="LHR" data-name="London, Anh" data-val="London, Anh (LHR)">
                                                <div><span class="city-name">London</span><span class="country-name">Anh</span></div><span class="code">LHR</span>
                                            </div>
                                            <div class="airport-item" data-code="FRA" data-name="Frankfurt, Đức" data-val="Frankfurt (FRA)">
                                                <div><span class="city-name">Frankfurt</span><span class="country-name">Đức</span></div><span class="code">FRA</span>
                                            </div>
                                        </div>

                                        <!-- Châu Úc -->
                                        <div class="airport-group" id="region-au">
                                            <div class="airport-item" data-code="SYD" data-name="Sydney, Úc" data-val="Sydney, Úc (SYD)">
                                                <div><span class="city-name">Sydney</span><span class="country-name">Úc</span></div><span class="code">SYD</span>
                                            </div>
                                            <div class="airport-item" data-code="MEL" data-name="Melbourne, Úc" data-val="Melbourne, Úc (MEL)">
                                                <div><span class="city-name">Melbourne</span><span class="country-name">Úc</span></div><span class="code">MEL</span>
                                            </div>
                                        </div>

                                        <!-- Bắc Mỹ -->
                                        <div class="airport-group" id="region-us">
                                            <div class="airport-item" data-code="LAX" data-name="Los Angeles, Mỹ" data-val="Los Angeles (LAX)">
                                                <div><span class="city-name">Los Angeles</span><span class="country-name">Mỹ</span></div><span class="code">LAX</span>
                                            </div>
                                            <div class="airport-item" data-code="JFK" data-name="New York, Mỹ" data-val="New York (JFK)">
                                                <div><span class="city-name">New York</span><span class="country-name">Mỹ</span></div><span class="code">JFK</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- NGÀY & HÀNH KHÁCH -->
                        <div class="row g-3">
                            <div class="col-md-3">
                                <label class="form-label text-muted mb-1" style="font-size: 13px;">Ngày đi</label>
                                <input type="date" name="departure_date" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label text-muted mb-1" style="font-size: 13px;">Ngày về</label>
                                <input type="date" name="return_date" id="returnDateInput" class="form-control">
                            </div>
                            <div class="col-md-6 position-relative">
                                <label class="form-label text-muted mb-1" style="font-size: 13px;">Hành khách</label>
                                <div class="passenger-trigger" id="passengerTrigger">
                                    <i class="fas fa-user-friends position-absolute text-muted" style="left: 25px;"></i>
                                    <span id="passengerDisplayText" class="fw-bold">2 Người lớn, 0 Trẻ em</span>
                                    <i class="fas fa-chevron-down text-muted" style="font-size: 14px;"></i>
                                </div>

                                <div class="passenger-panel" id="passengerPanel">
                                    <div class="passenger-row">
                                        <div>
                                            <div class="fw-bold">Người lớn</div>
                                            <div class="text-muted" style="font-size: 12px;">Từ 12 tuổi trở lên</div>
                                        </div>
                                        <div class="counter-controls">
                                            <button type="button" class="counter-btn" id="btnMinusAdult"><i class="fas fa-minus"></i></button>
                                            <div class="counter-value" id="adultCountText">2</div>
                                            <button type="button" class="counter-btn" id="btnPlusAdult"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="passenger-row">
                                        <div>
                                            <div class="fw-bold">Trẻ em</div>
                                            <div class="text-muted" style="font-size: 12px;">Dưới 12 tuổi</div>
                                        </div>
                                        <div class="counter-controls">
                                            <button type="button" class="counter-btn" id="btnMinusChild"><i class="fas fa-minus"></i></button>
                                            <div class="counter-value" id="childCountText">0</div>
                                            <button type="button" class="counter-btn" id="btnPlusChild"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="adults" id="inputAdults" value="2">
                                <input type="hidden" name="children" id="inputChildren" value="0">
                            </div>
                        </div>
                        
                        <!-- KHU VỰC NÚT TÌM KIẾM VÀ MÃ KHUYẾN MẠI -->
                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mt-4 pt-3 border-top">
                            <div class="promo-section mb-3 mb-md-0">
                                <a href="javascript:void(0)" id="btnTogglePromo" class="text-decoration-none fw-bold" style="color: #005e6a; font-size: 15px;">
                                    <i class="fas fa-ticket-alt me-2"></i>Thêm mã khuyến mại
                                </a>
                                <div id="promoInputWrapper" style="display: none; margin-top: 10px;">
                                    <input type="text" name="promo_code" class="form-control text-uppercase" placeholder="Nhập mã của bạn" style="max-width: 250px; border-color: #005e6a; box-shadow: none;">
                                </div>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-search px-5 py-3 fs-5">
                                    TÌM CHUYẾN BAY <i class="fas fa-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- ==================== TAB 2: QUẢN LÝ ĐẶT CHỖ ==================== -->
                <div id="tab-quanly" class="tab-pane">
                    <form action="<?= BASEURL ?>/booking/manage" method="GET">
                        <div class="row align-items-center mt-3">
                            <div class="col-md-5">
                                <div class="manage-input-box">
                                    <i class="fas fa-chair text-muted"></i>
                                    <div class="manage-input-content">
                                        <label>Mã đặt chỗ/Số vé điện tử</label>
                                        <input type="text" name="booking_code" placeholder="Nhập mã đặt chỗ/số vé điện tử" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-5">
                                <div class="manage-input-box">
                                    <i class="far fa-user text-muted"></i>
                                    <div class="manage-input-content">
                                        <label>Họ</label>
                                        <input type="text" name="last_name" placeholder="Nhập họ" value="<?= isset($_SESSION['user_name']) ? htmlspecialchars(explode(' ', trim($_SESSION['user_name']))[0]) : '' ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 text-end">
                                <button type="submit" class="btn btn-search w-100 px-3" style="height: 55px; border-radius: 25px; margin-bottom: 20px;">Tìm kiếm</button>
                            </div>
                        </div>

                        <div class="quick-links">
                            <a href="#" class="quick-link-item"><i class="fas fa-hand-holding-usd text-warning" style="color: #f39c12 !important;"></i> Giữ giá tốt</a>
                            <a href="#" class="quick-link-item"><i class="fas fa-chair" style="color: #f1c40f !important;"></i> Chọn chỗ ngồi</a>
                            <a href="#" class="quick-link-item"><i class="fas fa-shapes" style="color: #3498db !important;"></i> Thêm dịch vụ bổ trợ</a>
                            <a href="#" class="quick-link-item"><i class="fas fa-suitcase-rolling" style="color: #1abc9c !important;"></i> Thông tin hành lý</a>
                            <a href="#" class="quick-link-item"><i class="fas fa-exchange-alt" style="color: #95a5a6 !important;"></i> Thay đổi chuyến bay</a>
                        </div>
                    </form>
                </div>

                <!-- ==================== TAB 3: LÀM THỦ TỤC ==================== -->
                <div id="tab-thutuc" class="tab-pane">
                    <form action="<?= BASEURL ?>/booking/checkin" method="GET">
                        <div class="row align-items-center mt-3">
                            <div class="col-md-5">
                                <div class="manage-input-box">
                                    <i class="fas fa-qrcode text-muted"></i>
                                    <div class="manage-input-content">
                                        <label>Mã đặt chỗ / Số vé</label>
                                        <input type="text" name="pnr" placeholder="Nhập mã đặt chỗ (PNR)" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-5">
                                <div class="manage-input-box">
                                    <i class="far fa-id-card text-muted"></i>
                                    <div class="manage-input-content">
                                        <label>Họ hành khách</label>
                                        <input type="text" name="last_name" placeholder="Nhập họ" value="<?= isset($_SESSION['user_name']) ? htmlspecialchars(explode(' ', trim($_SESSION['user_name']))[0]) : '' ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 text-end">
                                <button type="submit" class="btn btn-search w-100 px-3" style="height: 55px; border-radius: 25px; margin-bottom: 20px;">Làm thủ tục</button>
                            </div>
                        </div>

                        <div class="alert alert-info mt-3 border-0" style="background-color: #f0f8ff; border-radius: 8px;">
                            <i class="fas fa-info-circle me-2 text-primary"></i> Hành khách có thể làm thủ tục trực tuyến từ <strong>24 giờ đến 1 giờ</strong> trước thời gian khởi hành dự kiến.
                        </div>
                    </form>
                </div>

            </div> <!-- END TAB CONTENT WRAPPER -->

            <!-- VNA STYLE EXTRA SERVICES -->
            <div class="extra-services">
                <a href="#" class="service-item">
                    <i class="fas fa-shopping-bag"></i>
                    Hành lý trả trước
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-chair"></i>
                    Nâng hạng ghế
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-shopping-cart"></i>
                    Mua sắm
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-building"></i>
                    Khách sạn & Tour
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-heartbeat"></i>
                    Bảo hiểm
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-ellipsis-h"></i>
                    Các dịch vụ khác
                </a>
            </div>
        </div>
    </div>
    </section>

    <!-- ================= DESTINATIONS SECTION ================= -->
    <?php 
        $tomorrow = date('Y-m-d', strtotime('+1 day'));
        $defaultParams = "&departure_date=$tomorrow&adults=2&children=0";
    ?>
    <div class="container my-5 pt-5">
        <h3 class="fw-bold mb-4" style="color: #333;">Các điểm đến thu hút nhất Việt Nam</h3>
        <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=TP Hồ Chí Minh (SGN)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1559508551-44bff1de756b?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Vũng Tàu">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Vũng Tàu</h6>
                            <small class="text-muted">6.329 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=TP Hồ Chí Minh (SGN)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Hồ Chí Minh">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Hồ Chí Minh</h6>
                            <small class="text-muted">15.546 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng (DAD)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Đà Nẵng">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Đà Nẵng</h6>
                            <small class="text-muted">5.534 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Hà Nội (HAN)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1599708153386-62bf3f034eb8?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Hà Nội">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Hà Nội</h6>
                            <small class="text-muted">10.744 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
             <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Phú Quốc (PQC)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Phú Quốc">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Phú Quốc</h6>
                            <small class="text-muted">8.124 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang (CXR)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1581337204873-ef36aa186caa?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img" alt="Nha Trang">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1">Nha Trang</h6>
                            <small class="text-muted">4.320 chuyến bay</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- ================= INTERNATIONAL DESTINATIONS SECTION (MỚI THÊM) ================= -->
    <div class="container my-5 pt-3">
        <h3 class="fw-bold mb-4" style="color: #333;">Các điểm đến phổ biến ngoài Việt Nam</h3>
        <div class="row g-3">
            <!-- Kuala Lumpur -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Kuala Lumpur (KUL)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1596422846543-74c6fc0e2811?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img-intl" alt="Kuala Lumpur">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1">Kuala Lumpur</h6>
                            <small class="text-muted">19.902 chỗ ở</small>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Manila -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Manila (MNL)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img-intl" alt="Manila">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1">Manila</h6>
                            <small class="text-muted">13.223 chỗ ở</small>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Jakarta -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Jakarta (CGK)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img-intl" alt="Jakarta">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1">Jakarta</h6>
                            <small class="text-muted">14.249 chỗ ở</small>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Dubai -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Dubai (DXB)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img-intl" alt="Dubai">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1">Dubai</h6>
                            <small class="text-muted">19.464 chỗ ở</small>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Bangkok -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Bangkok (BKK)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1508009603885-247a52f41baa?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img-intl" alt="Bangkok">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1">Bangkok</h6>
                            <small class="text-muted">12.048 chỗ ở</small>
                        </div>
                    </div>
                </a>
            </div>
            <!-- Tokyo (Bổ sung cho đủ 6 cột hiển thị đẹp trên màn hình lớn) -->
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Tokyo (NRT)<?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=400&q=80" class="card-img-top dest-img-intl" alt="Tokyo">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1">Tokyo</h6>
                            <small class="text-muted">12.486 chỗ ở</small>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- ================= FLOATING PROMO APP ================= -->
    <div id="appPromoPopup" class="promo-popup shadow-lg">
        <button class="btn-close-promo" onclick="document.getElementById('appPromoPopup').style.display='none'"><i class="fas fa-times"></i></button>
        <div class="text-center">
            <h6 class="fw-bold text-dark mb-1" style="font-size: 15px;">Giảm 10% khi đặt qua App!</h6>
            <p class="text-muted small mb-3">Quét mã QR để nhận ưu đãi tức thì</p>
            <div class="qr-container bg-light p-2 rounded-3 d-inline-block border mb-2">
                <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=DownloadSkylineApp" alt="QR Code" class="img-fluid" style="width: 100px; height: 100px;">
            </div>
            <a href="javascript:void(0);" class="d-block text-primary fw-bold small text-decoration-none mt-1 info-link">Xem tất cả <i class="fas fa-chevron-right ms-1" style="font-size:10px;"></i></a>
        </div>
    </div>

    <!-- ================= FOOTER ================= -->
    <footer class="site-footer border-top pt-5 pb-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h6 class="fw-bold text-dark mb-3">Trợ giúp</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="footer-link info-link">Trung tâm trợ giúp</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Câu hỏi thường gặp</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Chính sách bảo mật</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Chính sách về cookie</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Điều khoản sử dụng</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-3 col-md-4 col-6 mb-4">
                    <h6 class="fw-bold text-dark mb-3">Công ty TNHH TH</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="footer-link info-link">Về chúng tôi</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Tuyển dụng</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Báo chí</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Nhật ký mạng</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Tuyên bố về Đạo luật Nô lệ Hiện đại</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-4 col-6 mb-4">
                    <h6 class="fw-bold text-dark mb-3">Điểm du lịch</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="footer-link info-link">Quốc gia</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Mọi chặng bay</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Thành phố</a></li>
                    </ul>
                </div>

                <div class="col-lg-3 col-md-6 col-6 mb-4">
                    <h6 class="fw-bold text-dark mb-3">Đối tác của chúng tôi</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a class="footer-link info-link">Cổng thông tin đối tác YCS</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Partner Hub</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Quảng cáo trên Skyline</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Đối tác liên kết</a></li>
                        <li class="mb-2"><a class="footer-link info-link">Tư liệu API Hệ thống</a></li>
                    </ul>
                </div>

                <div class="col-lg-2 col-md-6 col-12 mb-4">
                    <h6 class="fw-bold text-dark mb-3">Tải ứng dụng</h6>
                    <ul class="list-unstyled">
                        <li class="mb-3"><a class="footer-link info-link"><i class="fab fa-apple me-2 fs-5 align-middle text-dark"></i> Ứng dụng iOS</a></li>
                        <li class="mb-3"><a class="footer-link info-link"><i class="fab fa-android me-2 fs-5 align-middle text-success"></i> Ứng dụng Android</a></li>
                    </ul>
                </div>
            </div>
            <hr class="mt-2 mb-4" style="border-color: #ddd;">
            <div class="text-center text-muted" style="font-size: 13px;">
                <p class="mb-0">Mọi tài liệu trên trang web này đều được bảo hộ bản quyền.</p>
                <p class="mt-1">© 2026 Skyline Ticket - Thuộc Công ty TNHH TH. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- ================= MODAL HIỂN THỊ DỮ LIỆU ĐỘNG (POPUP) ================= -->
    <div class="modal fade" id="infoDataModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2);">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" style="color: #005e6a;"><i class="fas fa-info-circle me-2"></i>Thông tin chi tiết</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-4">
                    <h4 class="fw-bold mb-3" id="modalDataTitle" style="color: #333;">Tiêu đề</h4>
                    <p class="text-muted" style="line-height: 1.6;">Chào mừng bạn đến với chuyên trang <strong><span id="modalDataKeyword"></span></strong> của chúng tôi.</p>
                    <div class="p-3 bg-light rounded-3 border mb-3">
                        <p class="mb-2"><i class="fas fa-building text-primary me-2"></i> <strong>Đơn vị chủ quản:</strong> Công ty TNHH TH</p>
                        <p class="mb-2"><i class="fas fa-database text-success me-2"></i> <strong>Trạng thái dữ liệu:</strong> Đang được cập nhật liên tục</p>
                        <p class="mb-0"><i class="fas fa-headset text-warning me-2"></i> <strong>Hỗ trợ đối tác:</strong> contact@th-company.vn</p>
                    </div>
                    <p class="text-muted mb-0" style="font-size: 14px;">Hệ thống đang tải và tổng hợp các dữ liệu thực tế liên quan đến chuyên mục này. Vui lòng quay lại sau hoặc liên hệ bộ phận hỗ trợ để biết thêm chi tiết. Xin cảm ơn!</p>
                </div>
                <div class="modal-footer border-0 pt-0 justify-content-center">
                    <button type="button" class="btn btn-secondary px-5 rounded-pill" data-bs-dismiss="modal">Đóng cửa sổ</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // ================= LOGIC HIỂN THỊ MODAL KHI CLICK VÀO LINK FOOTER =================
        document.addEventListener('DOMContentLoaded', function() {
            const infoModal = new bootstrap.Modal(document.getElementById('infoDataModal'));
            const titleEl = document.getElementById('modalDataTitle');
            const keywordEl = document.getElementById('modalDataKeyword');

            document.querySelectorAll('.info-link').forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const linkText = this.innerText.trim();
                    titleEl.innerText = linkText;
                    keywordEl.innerText = linkText;
                    infoModal.show();
                });
            });
        });

        // ================= LOGIC CHUYỂN TAB =================
        const mainTabs = document.querySelectorAll('.main-tab');
        const tabPanes = document.querySelectorAll('.tab-pane');

        mainTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                mainTabs.forEach(t => t.classList.remove('active'));
                tabPanes.forEach(p => p.classList.remove('active'));
                this.classList.add('active');
                const targetId = this.getAttribute('data-tab');
                document.getElementById(targetId).classList.add('active');
            });
        });

        // ================= LOGIC MEGA DROPDOWN (CHỌN SÂN BAY) =================
        let currentTarget = null;
        const megaDropdown = document.getElementById('megaAirportDropdown');

        window.openAirportDropdown = function(target, event) {
            event.stopPropagation();
            currentTarget = target;
            megaDropdown.style.display = 'block';
        }

        document.addEventListener('click', function(e) {
            if (!megaDropdown.contains(e.target) && !e.target.closest('.airport-trigger')) {
                megaDropdown.style.display = 'none';
            }
        });

        document.querySelectorAll('.region-tab').forEach(tab => {
            tab.addEventListener('click', function(e) {
                e.stopPropagation();
                document.querySelectorAll('.region-tab').forEach(t => t.classList.remove('active'));
                document.querySelectorAll('.airport-group').forEach(g => g.classList.remove('active'));
                this.classList.add('active');
                const targetId = 'region-' + this.getAttribute('data-target');
                document.getElementById(targetId).classList.add('active');
            });
        });

        document.querySelectorAll('.airport-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.stopPropagation();
                if(!currentTarget) return;
                
                const code = this.getAttribute('data-code');
                const name = this.getAttribute('data-name');
                const val = this.getAttribute('data-val');
                
                document.getElementById(currentTarget + 'Code').innerText = code;
                document.getElementById(currentTarget + 'Name').innerText = name;
                document.getElementById(currentTarget + 'Input').value = val;
                
                megaDropdown.style.display = 'none';

                if (currentTarget === 'dept') {
                    setTimeout(() => { document.getElementById('destTrigger').click(); }, 100);
                }
            });
        });

        document.getElementById('btnSwap').addEventListener('click', function() {
            const deptCode = document.getElementById('deptCode').innerText;
            const deptName = document.getElementById('deptName').innerText;
            const deptInput = document.getElementById('deptInput').value;

            const destCode = document.getElementById('destCode').innerText;
            const destName = document.getElementById('destName').innerText;
            const destInput = document.getElementById('destInput').value;

            document.getElementById('deptCode').innerText = destCode;
            document.getElementById('deptName').innerText = destName;
            document.getElementById('deptInput').value = destInput;

            document.getElementById('destCode').innerText = deptCode;
            document.getElementById('destName').innerText = destName;
            document.getElementById('destInput').value = deptInput;
        });

        // LOGIC Ô TÍCH KHỨ HỒI / MỘT CHIỀU
        const roundTripRadio = document.getElementById('roundTrip');
        const oneWayRadio = document.getElementById('oneWay');
        const returnDateInput = document.getElementById('returnDateInput');

        function updateDateInputs() {
            if (roundTripRadio.checked) {
                returnDateInput.disabled = false;
                returnDateInput.required = true;
            } else {
                returnDateInput.disabled = true;
                returnDateInput.required = false;
                returnDateInput.value = '';
            }
        }
        roundTripRadio.addEventListener('change', updateDateInputs);
        oneWayRadio.addEventListener('change', updateDateInputs);
        document.getElementById('multiCity').addEventListener('change', updateDateInputs);

        // LOGIC MÃ KHUYẾN MẠI
        const btnTogglePromo = document.getElementById('btnTogglePromo');
        const promoInputWrapper = document.getElementById('promoInputWrapper');
        const promoInput = document.querySelector('input[name="promo_code"]');

        btnTogglePromo.addEventListener('click', function() {
            if (promoInputWrapper.style.display === 'none') {
                promoInputWrapper.style.display = 'block';
                promoInput.focus();
                this.innerHTML = '<i class="fas fa-times me-2"></i>Hủy mã khuyến mại';
                this.style.color = '#dc3545';
            } else {
                promoInputWrapper.style.display = 'none';
                promoInput.value = '';
                this.innerHTML = '<i class="fas fa-ticket-alt me-2"></i>Thêm mã khuyến mại';
                this.style.color = '#005e6a';
            }
        });

        // LOGIC BẢNG CHỌN HÀNH KHÁCH
        const passengerTrigger = document.getElementById('passengerTrigger');
        const passengerPanel = document.getElementById('passengerPanel');
        const passengerDisplayText = document.getElementById('passengerDisplayText');

        passengerTrigger.addEventListener('click', function(e) {
            e.stopPropagation();
            passengerPanel.style.display = passengerPanel.style.display === 'block' ? 'none' : 'block';
        });

        passengerPanel.addEventListener('click', function(e) { e.stopPropagation(); });
        document.addEventListener('click', function() { passengerPanel.style.display = 'none'; });

        let adults = 2;
        let children = 0;

        function updatePassengerDisplay() {
            document.getElementById('adultCountText').innerText = adults;
            document.getElementById('childCountText').innerText = children;
            document.getElementById('inputAdults').value = adults;
            document.getElementById('inputChildren').value = children;
            passengerDisplayText.innerText = `${adults} Người lớn, ${children} Trẻ em`;
        }

        document.getElementById('btnMinusAdult').addEventListener('click', () => { if (adults > 1) { adults--; updatePassengerDisplay(); }});
        document.getElementById('btnPlusAdult').addEventListener('click', () => { adults++; updatePassengerDisplay(); });
        document.getElementById('btnMinusChild').addEventListener('click', () => { if (children > 0) { children--; updatePassengerDisplay(); }});
        document.getElementById('btnPlusChild').addEventListener('click', () => { children++; updatePassengerDisplay(); });

    </script>
</body>
</html>