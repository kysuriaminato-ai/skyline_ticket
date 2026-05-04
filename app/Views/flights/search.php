<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Kết quả tìm kiếm - Skyline Ticket' ?></title>
    <!-- Bootstrap 5 & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; }
        .navbar { background: white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .brand-logo { font-weight: 800; font-size: 24px; color: #000; text-decoration: none; }
        .brand-logo span { color: #0d6efd; }
        
        .search-info-header { background: #fff; border-bottom: 1px solid #e0e0e0; padding: 20px 0; margin-bottom: 20px; }
        .info-alert { background-color: #f8f9fa; border: 1px solid #e0e0e0; border-radius: 8px; padding: 15px 20px; font-size: 14px; margin-bottom: 20px; display: flex; align-items: flex-start; }
        .info-alert i { margin-right: 10px; margin-top: 3px; }

        /* ================= SIDEBAR BỘ LỌC ================= */
        .filter-sidebar { background: white; border-radius: 12px; padding: 20px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e0e0e0; position: sticky; top: 20px; }
        .filter-title { font-weight: 700; font-size: 18px; margin-bottom: 15px; border-bottom: 2px solid #f0f0f0; padding-bottom: 10px; }
        .filter-group { margin-bottom: 20px; }
        .filter-group-title { font-weight: 600; font-size: 15px; margin-bottom: 10px; color: #333; }
        .form-check-label { font-size: 14px; color: #555; cursor: pointer; user-select: none; }

        /* ================= FLIGHT CARD ================= */
        .flight-item-container { background: white; border-radius: 12px; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(0,0,0,0.05); border: 1px solid #e0e0e0; transition: all 0.3s; overflow: hidden; }
        .flight-item-container:hover { box-shadow: 0 8px 25px rgba(0,0,0,0.1); }
        .flight-card-v2 { display: flex; background: white; position: relative; z-index: 2; }
        
        /* CỘT TRÁI: THÔNG TIN BAY */
        .flight-info-col { flex: 1; padding: 20px; display: flex; align-items: center; }
        .time-big { font-size: 22px; font-weight: 700; color: #005e6a; line-height: 1.2; }
        .airport-code { font-size: 16px; font-weight: 700; color: #333; }
        
        .flight-duration-img { text-align: center; padding: 0 15px; flex: 1; }
        
        /* ====== TÊN HÃNG BAY NẰM TRÊN CÙNG ====== */
        .airline-name-top { display: flex; align-items: center; justify-content: center; margin-bottom: 10px; }
        .airline-name-top img { width: 20px; height: 20px; margin-right: 8px; object-fit: contain; }
        .airline-name-top strong { font-size: 14px; color: #333; }
        .airline-name-top span { font-size: 13px; color: #777; margin-left: 5px; }

        .duration-text { font-size: 12px; color: #666; margin-bottom: 8px; }
        .line-wrapper { position: relative; height: 2px; background: #d0d0d0; display: flex; align-items: center; justify-content: center; }
        .line-wrapper .flight-icon { position: absolute; background: white; padding: 0 10px; color: #005e6a; font-size: 16px; }
        .stops-text { font-size: 12px; color: #005e6a; margin-top: 8px; font-weight: 600; }
        

        /* CỘT PHẢI: HẠNG GHẾ */
        .flight-pricing-col { display: flex; gap: 8px; padding: 15px 15px 15px 0; }
        .class-box { position: relative; width: 135px; border-radius: 10px; padding: 25px 8px 15px; text-align: center; cursor: pointer; transition: all 0.3s; display: flex; flex-direction: column; z-index: 3; }
        .class-box:hover { transform: translateY(-3px); box-shadow: 0 6px 15px rgba(0,0,0,0.1); }
        
        .eco-box { background-color: #005e6a; color: white; }
        .preeco-box { background-color: #cbdcdb; color: #005e6a; }
        .biz-box { background-color: #eeb83e; color: #005e6a; }

        .class-box.active { transform: translateY(0); box-shadow: none; border-bottom-left-radius: 0; border-bottom-right-radius: 0; }
        .class-box::after { content: ''; position: absolute; bottom: -10px; left: 50%; transform: translateX(-50%); border-width: 10px 12px 0; border-style: solid; border-color: transparent; display: none; z-index: 10; }
        .eco-box.active::after { border-color: #005e6a transparent transparent transparent; display: block; }
        .preeco-box.active::after { border-color: #cbdcdb transparent transparent transparent; display: block; }
        .biz-box.active::after { border-color: #eeb83e transparent transparent transparent; display: block; }

        .class-name { font-size: 13px; font-weight: 800; text-transform: uppercase; margin-bottom: 8px; }
        .price-from { font-size: 12px; opacity: 0.9; margin-bottom: 2px; }
        .class-price { font-size: 17px; font-weight: 800; margin: 0; line-height: 1.2; }
        .class-currency { font-size: 11px; font-weight: 600; opacity: 0.9; margin-bottom: 10px; }
        .class-box .fa-chevron-down { margin-top: auto; opacity: 0.8; transition: 0.3s; }
        .class-box.active .fa-chevron-down { transform: rotate(180deg); }
        .class-box .fa-tag { position: absolute; top: 12px; right: 10px; font-size: 14px; opacity: 0.9; }

        .seats-badge { position: absolute; top: -12px; left: 50%; transform: translateX(-50%); background: #005e6a; color: white; font-size: 10px; font-weight: 700; padding: 3px 8px; border-radius: 4px; white-space: nowrap; box-shadow: 0 2px 5px rgba(0,0,0,0.2); z-index: 10; }

        /* BẢNG CHI TIẾT GIÁ VÉ */
        .fare-details-panel { display: none; background-color: #fbfcfc; border-top: 1px solid #e0e0e0; padding: 25px 15px; position: relative; z-index: 1; }
        .fare-card { background: white; border: 2px solid #e0e0e0; border-radius: 12px; width: 260px; padding: 0; cursor: pointer; transition: 0.3s; display: flex; flex-direction: column; }
        .fare-card:hover { border-color: #005e6a; box-shadow: 0 8px 20px rgba(0,94,106,0.1); }
        .fare-card.selected { border-color: #005e6a; box-shadow: 0 4px 15px rgba(0,94,106,0.15); background-color: #f2f9fa; }
        .fare-card-header { padding: 15px; text-align: center; border-bottom: 1px dashed #e0e0e0; }
        .fare-card-header input[type="radio"] { transform: scale(1.3); margin-bottom: 10px; accent-color: #005e6a; cursor: pointer; }
        .fare-card-price { font-size: 18px; font-weight: 800; color: #333; margin-bottom: 5px; }
        .fare-card-name { font-size: 13px; font-weight: 700; color: #555; text-transform: uppercase; }
        .fare-card-badge { display: inline-block; background: #005e6a; color: white; font-size: 10px; padding: 3px 8px; border-radius: 4px; margin-top: 5px; }

        .fare-features { padding: 15px; font-size: 12px; color: #444; flex: 1; }
        .fare-feature-item { display: flex; align-items: flex-start; margin-bottom: 12px; }
        .fare-feature-item i { margin-right: 8px; margin-top: 2px; font-size: 14px; color: #005e6a; width: 16px; text-align: center; }
        .feature-title { font-weight: 700; color: #333; margin-bottom: 2px; }
        
        .btn-continue { background-color: #005e6a; color: white; font-weight: bold; padding: 12px 40px; border-radius: 25px; border: none; transition: 0.3s; font-size: 16px; position: relative; z-index: 50; }
        .btn-continue:hover { background-color: #00454e; color: white; transform: translateY(-2px); box-shadow: 0 4px 10px rgba(0,94,106,0.2); }

        /* BẢNG LƯU Ý PHÍA DƯỚI */
        .flight-notice-box { background-color: white; border-radius: 12px; border: 1px solid #e0e0e0; padding: 25px; font-size: 13px; color: #333; line-height: 1.6; margin-top: 30px; box-shadow: 0 4px 15px rgba(0,0,0,0.02); }
        .flight-notice-box a { color: #005e6a; text-decoration: underline; font-weight: 600; cursor: pointer; }
        .flight-notice-box a:hover { color: #00454e; }

        /* MODAL BAGGAGE DETAILS */
        .baggage-detail-view { display: none; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
        .btn-back-modal { background: none; border: none; color: #005e6a; font-weight: 600; font-size: 15px; padding: 0; margin-bottom: 20px; transition: 0.2s; }
        .btn-back-modal:hover { color: #00454e; text-decoration: underline; }
        .detail-table th { background-color: #e0f2f1; color: #005e6a; font-size: 14px; }
        .detail-table td { font-size: 14px; vertical-align: middle; }

        /* ================= UPGRADE MODAL STYLES ================= */
        .upgrade-banner { width: 100%; height: 180px; object-fit: cover; border-radius: 12px 12px 0 0; }
        .upgrade-table { width: 100%; border-collapse: separate; border-spacing: 0; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; margin-top: 15px; }
        .upgrade-table th, .upgrade-table td { padding: 15px; border-bottom: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0; font-size: 14px; vertical-align: middle; }
        .upgrade-table th:last-child, .upgrade-table td:last-child { border-right: none; }
        .upgrade-table tr:last-child td { border-bottom: none; }
        .col-feature { width: 20%; font-weight: 600; color: #555; background-color: #fbfcfc; }
        .col-current { width: 40%; text-align: center; }
        .col-upgrade { width: 40%; text-align: center; background-color: #f0f8ff; } 
        
        .header-current { background-color: #117887; color: white; font-weight: 700; text-transform: uppercase; padding: 15px !important; }
        .header-upgrade { background-color: #005e6a; color: white; font-weight: 700; text-transform: uppercase; padding: 15px !important; position: relative; }
        .header-upgrade::before { content: 'ĐỀ XUẤT'; position: absolute; top: -12px; right: 15px; background: #eeb83e; color: #005e6a; font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.2); }
        
        .btn-keep { background-color: #eeb83e; color: #005e6a; font-weight: bold; padding: 12px 25px; border-radius: 8px; border: none; transition: 0.3s; width: 100%; cursor: pointer;}
        .btn-keep:hover { background-color: #dca028; }
        .btn-upgrade { background-color: white; color: #005e6a; font-weight: bold; padding: 12px 25px; border-radius: 8px; border: 2px solid #005e6a; transition: 0.3s; width: 100%; cursor: pointer;}
        .btn-upgrade:hover { background-color: #005e6a; color: white; }

        .filter-hidden { display: none !important; }

        @media (max-width: 1200px) {
            .flight-card-v2 { flex-direction: column; }
            .flight-pricing-col { padding: 15px; overflow-x: auto; border-top: 1px dashed #e0e0e0; }
            .class-box { min-width: 130px; }
            .class-box::after { display: none !important; }
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg py-3">
        <div class="container">
            <a class="brand-logo" href="<?= BASEURL ?>/home">SKYLINE<span>TICKET</span></a>
            <div class="d-flex align-items-center ms-auto">
                <?php if (isset($_SESSION['user_name'])): ?>
                    <span class="me-3 fw-bold"><i class="fas fa-user-circle"></i> Xin chào, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="<?= BASEURL ?>/auth/logout" class="btn btn-outline-danger">Đăng xuất</a>
                <?php else: ?>
                    <a href="<?= BASEURL ?>/auth/login" class="btn btn-outline-primary fw-bold px-4">Đăng nhập</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <div class="search-info-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h4 class="mb-0 fw-bold" style="color: #005e6a;">
                    <?= !empty($data['search_params']['departure']) ? htmlspecialchars($data['search_params']['departure']) : 'Hà Nội (HAN)' ?> 
                    <i class="fas fa-exchange-alt mx-2 text-muted"></i> 
                    <?= !empty($data['search_params']['destination']) ? htmlspecialchars($data['search_params']['destination']) : 'Melbourne, Úc (MEL)' ?>
                </h4>
                <a href="<?= BASEURL ?>/home" class="btn btn-outline-secondary btn-sm"><i class="fas fa-search me-2"></i>Tìm lại</a>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT -->
    <div class="container my-4">
        
        <div class="info-alert">
            <i class="fas fa-info-circle fa-lg mt-1 text-primary"></i>
            <div>Các chuyến bay hiển thị theo thứ tự mặc định do Skyline Ticket lựa chọn. Quý khách vui lòng chọn tính năng Bộ lọc để thay đổi hiển thị.</div>
        </div>

        <div class="row">
            <!-- ================= CỘT TRÁI: BỘ LỌC ================= -->
            <div class="col-lg-3 mb-4">
                <div class="filter-sidebar">
                    <div class="filter-title"><i class="fas fa-filter me-2"></i>Bộ lọc</div>
                    
                    <!-- Lọc hãng hàng không -->
                    <div class="filter-group">
                        <div class="filter-group-title">Hãng hàng không</div>
                        <div class="form-check mb-2">
                            <input class="form-check-input airline-filter" type="checkbox" id="airline_vna" value="Vietnam Airlines" checked>
                            <label class="form-check-label d-flex justify-content-between" for="airline_vna">
                                <span>Vietnam Airlines</span>
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input airline-filter" type="checkbox" id="airline_vj" value="Vietjet Air" checked>
                            <label class="form-check-label d-flex justify-content-between" for="airline_vj">
                                <span>Vietjet Air</span>
                            </label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input airline-filter" type="checkbox" id="airline_bb" value="Bamboo Airways" checked>
                            <label class="form-check-label d-flex justify-content-between" for="airline_bb">
                                <span>Bamboo Airways</span>
                            </label>
                        </div>
                    </div>

                    <!-- Lọc giờ cất cánh -->
                    <div class="filter-group">
                        <div class="filter-group-title">Giờ cất cánh</div>
                        <div class="form-check mb-2">
                            <input class="form-check-input time-filter" type="checkbox" id="time1" value="early_morning">
                            <label class="form-check-label" for="time1">Sáng sớm (00:00 - 06:00)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input time-filter" type="checkbox" id="time2" value="morning">
                            <label class="form-check-label" for="time2">Buổi sáng (06:00 - 12:00)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input time-filter" type="checkbox" id="time3" value="afternoon">
                            <label class="form-check-label" for="time3">Buổi chiều (12:00 - 18:00)</label>
                        </div>
                        <div class="form-check mb-2">
                            <input class="form-check-input time-filter" type="checkbox" id="time4" value="evening">
                            <label class="form-check-label" for="time4">Buổi tối (18:00 - 24:00)</label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ================= CỘT PHẢI: DANH SÁCH CHUYẾN BAY ================= -->
            <div class="col-lg-9" id="flightListContainer">
                
                <?php 
                $searchDept = !empty($data['search_params']['departure']) ? $data['search_params']['departure'] : 'Hà Nội (HAN)';
                $searchDest = !empty($data['search_params']['destination']) ? $data['search_params']['destination'] : 'Melbourne, Úc (MEL)';

                // Nhận diện chuyến bay nội địa để set giá demo cho hợp lý
                $isDomestic = (stripos($searchDest, 'Phú Quốc') !== false || stripos($searchDest, 'Hồ Chí Minh') !== false || stripos($searchDest, 'Đà Nẵng') !== false || stripos($searchDest, 'Nha Trang') !== false || stripos($searchDest, 'Đà Lạt') !== false);
                
                $basePrice1 = $isDomestic ? 1500000 : 16053000;
                $basePrice2 = $isDomestic ? 1200000 : 14500000;
                $basePrice3 = $isDomestic ? 900000 : 12200000;

                $demoFlights = [
                    ['id' => 991, 'airlines' => 'Vietnam Airlines', 'flight_code' => 'VN 273', 'departure' => $searchDept, 'destination' => $searchDest, 'departure_time' => date('Y-m-d 16:00:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 18:25:00', strtotime('+1 days')), 'price' => $basePrice1],
                    ['id' => 992, 'airlines' => 'Vietnam Airlines', 'flight_code' => 'VN 249', 'departure' => $searchDept, 'destination' => $searchDest, 'departure_time' => date('Y-m-d 15:30:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 17:45:00', strtotime('+1 days')), 'price' => $basePrice1],
                    ['id' => 993, 'airlines' => 'Bamboo Airways', 'flight_code' => 'QH 215', 'departure' => $searchDept, 'destination' => $searchDest, 'departure_time' => date('Y-m-d 10:00:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 12:25:00', strtotime('+1 days')), 'price' => $basePrice2],
                    ['id' => 994, 'airlines' => 'Vietjet Air', 'flight_code' => 'VJ 189', 'departure' => $searchDept, 'destination' => $searchDest, 'departure_time' => date('Y-m-d 05:30:00', strtotime('+1 days')), 'arrival_time' => date('Y-m-d 07:45:00', strtotime('+1 days')), 'price' => $basePrice3]
                ];

                // Lọc bỏ lỗi khi mảng flights DB bị rỗng/lỗi
                $validFlights = [];
                if (!empty($data['flights']) && is_array($data['flights'])) {
                    foreach($data['flights'] as $f) {
                        if(is_array($f) && !empty($f['departure_time'])) {
                            $validFlights[] = $f;
                        }
                    }
                }
                
                // Quyết định dữ liệu hiển thị (Thực tế hay Demo)
                $flightListToDisplay = !empty($validFlights) ? $validFlights : $demoFlights;

                foreach ($flightListToDisplay as $flight): 
                    $fid = $flight['id'];
                    $priceEco = $flight['price'];
                    $pricePreEco = $flight['price'] + ($isDomestic ? 1500000 : 8622000);
                    $priceBiz = $flight['price'] + ($isDomestic ? 3500000 : 39103000);

                    $deptTime = date('H:i', strtotime($flight['departure_time']));
                    $arrTime = date('H:i', strtotime($flight['arrival_time']));
                    
                    $hour = (int)date('H', strtotime($flight['departure_time']));
                    if ($hour < 6) $timeCat = 'early_morning';
                    elseif ($hour < 12) $timeCat = 'morning';
                    elseif ($hour < 18) $timeCat = 'afternoon';
                    else $timeCat = 'evening';

                    $diff = strtotime($flight['arrival_time']) - strtotime($flight['departure_time']);
                    $hours = floor($diff / 3600);
                    $mins = floor(($diff % 3600) / 60);
                    $duration = "{$hours}h {$mins}phút";

                    preg_match('/\((.*?)\)/', $flight['departure'], $deptMatch);
                    $deptCode = $deptMatch[1] ?? substr($flight['departure'], 0, 3);
                    
                    preg_match('/\((.*?)\)/', $flight['destination'], $destMatch);
                    $destCode = $destMatch[1] ?? substr($flight['destination'], 0, 3);

                    $airlineName = $flight['airlines'] ?? 'Vietnam Airlines';
                    if (stripos($airlineName, 'Vietjet') !== false) {
                        $logoUrl = 'https://w7.pngwing.com/pngs/351/365/png-transparent-vietjet-air-airline-logo-vietnam-airlines-ho-chi-minh-city-vietjet-logo-text-sign-sticker.png';
                        $logoStyle = 'object-fit:contain;';
                    } elseif (stripos($airlineName, 'Bamboo') !== false) {
                        $logoUrl = 'https://upload.wikimedia.org/wikipedia/vi/thumb/8/87/Bamboo_Airways_logo.svg/2560px-Bamboo_Airways_logo.svg.png';
                        $logoStyle = 'object-fit:contain;';
                    } else {
                        $logoUrl = 'https://booking.vietnamairlines.com/images/vna_logo.png';
                        $logoStyle = 'background:#005e6a; border-radius:50%; object-fit:contain;';
                    }
                ?>
                <!-- CHUYẾN BAY -->
                <div class="flight-item-container" id="flight-item-<?= $fid ?>" data-airline="<?= $airlineName ?>" data-time="<?= $timeCat ?>">
                    <div class="flight-card-v2">
                        <div class="flight-info-col">
                            <div class="row w-100 align-items-center">
                                <div class="col-3 text-center">
                                    <div class="time-big"><?= $deptTime ?></div>
                                    <div class="airport-code"><?= strtoupper($deptCode) ?></div>
                                </div>
                                <div class="col-6 flight-duration-img">
                                    <div class="airline-name-top">
                                        <img src="<?= $logoUrl ?>" alt="Logo" style="<?= $logoStyle ?>">
                                        <strong><?= htmlspecialchars($airlineName) ?></strong>
                                        <span>(<?= htmlspecialchars($flight['flight_code']) ?>)</span>
                                    </div>
                                    <div class="duration-text">Thời gian bay <?= $duration ?></div>
                                    <div class="line-wrapper"><i class="fas fa-plane flight-icon"></i></div>
                                    <div class="stops-text"><i class="fas fa-circle" style="font-size:6px; vertical-align:middle; margin-right:4px;"></i> Bay thẳng</div>
                                </div>
                                <div class="col-3 text-center">
                                    <div class="time-big"><?= $arrTime ?> <sup style="font-size: 10px; color: #888;">+1 ngày</sup></div>
                                    <div class="airport-code"><?= strtoupper($destCode) ?></div>
                                </div>
                            </div>
                        </div>

                        <div class="flight-pricing-col">
                            <div class="class-box eco-box class-selector" data-flight="<?= $fid ?>" data-type="eco" data-baseprice="<?= $priceEco ?>">
                                <div class="class-name">Phổ thông</div>
                                <div class="price-from">từ</div>
                                <div class="class-price"><?= number_format($priceEco, 0, ',', '.') ?></div>
                                <div class="class-currency">VND</div>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                            
                            <div class="class-box preeco-box class-selector" data-flight="<?= $fid ?>" data-type="preeco" data-baseprice="<?= $pricePreEco ?>">
                                <div class="seats-badge">5 ghế còn lại</div>
                                <div class="class-name">Phổ thông đặc biệt</div>
                                <div class="price-from">từ</div>
                                <div class="class-price"><?= number_format($pricePreEco, 0, ',', '.') ?></div>
                                <div class="class-currency">VND</div>
                                <i class="fas fa-chevron-down"></i>
                            </div>

                            <div class="class-box biz-box class-selector" data-flight="<?= $fid ?>" data-type="biz" data-baseprice="<?= $priceBiz ?>">
                                <div class="seats-badge">7 ghế còn lại</div>
                                <div class="class-name">Thương gia</div>
                                <div class="price-from">từ</div>
                                <div class="class-price"><?= number_format($priceBiz, 0, ',', '.') ?></div>
                                <div class="class-currency">VND</div>
                                <i class="fas fa-chevron-down"></i>
                            </div>
                        </div>
                    </div>

                    <div class="fare-details-panel" id="panel-flight-<?= $fid ?>">
                        <div class="text-center mb-3">
                            <h5 class="fw-bold mb-1">Chọn giá vé</h5>
                            <a href="javascript:void(0)" class="text-decoration-none" style="font-size: 12px; color: #005e6a;">Điều kiện giá vé <i class="fas fa-external-link-alt ms-1"></i></a>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-3 flex-wrap fare-options-container" id="fare-container-<?= $fid ?>">
                            <!-- Content injected by JS -->
                        </div>

                        <div class="text-center mt-4">
                            <p class="text-muted mb-3" id="prompt-text-<?= $fid ?>" style="font-size: 14px;">Vui lòng chọn giá vé để tiếp tục.</p>
                            <!-- NÚT TIẾP TỤC ĐÃ SỬA LỖI -->
                            <button type="button" class="btn btn-continue btn-proceed-booking" id="btn-proceed-<?= $fid ?>" style="display: none;" data-flight="<?= $fid ?>">Tiếp tục</button>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>

                <div id="noResultMsg" class="alert alert-warning text-center mt-3" style="display: none;">
                    <i class="fas fa-search-minus fa-2x mb-2"></i>
                    <p class="mb-0 fw-bold">Không tìm thấy chuyến bay nào phù hợp với bộ lọc!</p>
                </div>
                
                <!-- ================= BẢNG LƯU Ý ================= -->
                <div class="flight-notice-box">
                    <p class="mb-2 fw-bold">Tra cứu thông tin hành lý <a href="javascript:void(0)" id="btnBaggage">tại đây</a>.</p>
                    <p class="mb-1 fw-bold">Lưu ý: Giá dưới đây đã bao gồm thuế, phí</p>
                    <p class="mb-0"><a href="javascript:void(0)" id="btnSpecialService">+ Phí Dịch Vụ Đặc Biệt</a></p>
                    <p class="mb-3"><a href="javascript:void(0)" id="btnTaxFee">+ Thuế, Phí, Lệ phí & Phụ thu</a></p>
                    <p class="mb-3">Đồng tiền thanh toán hiển thị theo "Quốc gia/Vùng" đã chọn, Quý khách kiểm tra kỹ đồng tiền trước khi thanh toán.</p>
                    <p class="mb-3">Skyline Ticket (SLT) sẽ không chịu trách nhiệm nếu Quý khách bị từ chối quá cảnh/nhập cảnh do thiếu thị thực.</p>
                    <p class="mb-1 fw-bold">Để có hành trình thuận lợi, Quý khách lưu ý các thông tin sau:</p>
                    <p class="mb-1">• Trường hợp quá cảnh tại Việt Nam và hành trình có ít nhất một chặng bay nội địa Việt Nam, ví dụ: Sydney - Tp. Hồ Chí Minh - Hà Nội - Paris, Quý khách cần chuẩn bị thị thực quá cảnh Việt Nam.</p>
                    <p class="mb-3">• Trường hợp quá cảnh Anh nối chuyến giữa chuyến bay của SLT và British Airways để đến các quốc gia khác, ví dụ: hành trình Hà Nội - London - Frankfurt, hành lý không được làm thủ tục đến điểm cuối và Quý khách lưu ý tìm hiểu quy định của nước sở tại về giấy tờ quá cảnh/nhập cảnh.</p>
                    <p class="mb-0">Khi quý khách mua vé hạng Thương gia hoặc Phổ thông đặc biệt trên hành trình có kết hợp các chuyến bay do Skyline Ticket khai thác hoặc do hãng hàng không đối tác khai thác (bao gồm cả chuyến bay liên danh), vui lòng lưu ý rằng dịch vụ hạng Thương gia/Phổ thông đặc biệt có thể không được cung cấp trên một số chặng bay vì lý do khai thác.</p>
                </div>

            </div>
        </div>
    </div>

    <!-- ================= MODAL NÂNG HẠNG VÉ ================= -->
    <div class="modal fade" id="upgradeModal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content" style="border-radius: 12px; border: none; overflow: hidden; box-shadow: 0 15px 40px rgba(0,0,0,0.2);">
                <img src="https://images.unsplash.com/photo-1542296332-2e4473faf563?q=80&w=1200&auto=format&fit=crop" class="upgrade-banner" alt="Hạng Thương Gia">
                <div class="modal-body p-4 p-md-5 bg-white">
                    <h4 class="fw-bold" style="color: #005e6a; margin-bottom: 5px;" id="upgradeTitle">Nâng hạng lên Thương Gia Tiêu Chuẩn chỉ với ... VND</h4>
                    <p class="text-muted mb-4">Tận hưởng chuyến bay với nhiều quyền lợi hơn</p>
                    <table class="upgrade-table">
                        <thead>
                            <tr>
                                <th class="col-feature border-0 bg-white"></th>
                                <th class="col-current header-current rounded-start" id="upgCurrentName">PHỔ THÔNG LINH HOẠT</th>
                                <th class="col-upgrade header-upgrade rounded-end" id="upgUpgradeName">THƯƠNG GIA TIÊU CHUẨN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-feature">Thay đổi vé</td>
                                <td class="col-current" id="upgCurrentChange">Phí đổi vé...</td>
                                <td class="col-upgrade" id="upgUpgradeChange">Phí đổi vé...</td>
                            </tr>
                            <tr>
                                <td class="col-feature">Hoàn vé</td>
                                <td class="col-current" id="upgCurrentRefund">Phí hoàn vé...</td>
                                <td class="col-upgrade" id="upgUpgradeRefund">Phí hoàn vé...</td>
                            </tr>
                            <tr>
                                <td class="col-feature">Hành lý ký gửi</td>
                                <td class="col-current" id="upgCurrentBaggage">1 x 23 kg</td>
                                <td class="col-upgrade fw-bold text-dark" id="upgUpgradeBaggage">2 x 32 kg</td>
                            </tr>
                            <tr>
                                <td class="col-feature">Hành lý xách tay</td>
                                <td class="col-current text-success fw-bold" id="upgCurrentCabin"><i class="fas fa-check me-1"></i> Không quá 12kg</td>
                                <td class="col-upgrade text-success fw-bold" id="upgUpgradeCabin"><i class="fas fa-check me-1"></i> Không quá 18kg</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mt-4 g-3">
                        <div class="col-md-6">
                            <button type="button" class="btn-keep" onclick="handleUpgradeChoice(false)">GIỮ <span id="btnKeepFareText">PHỔ THÔNG</span></button>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn-upgrade" onclick="handleUpgradeChoice(true)">NÂNG HẠNG LÊN THƯƠNG GIA TIÊU CHUẨN</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL ĐĂNG NHẬP -->
    <div class="modal fade" id="loginRequiredModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-header border-0 pb-0"><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
                <div class="modal-body text-center pb-5 px-4">
                    <div class="mb-4"><i class="fas fa-user-lock" style="font-size: 60px; color: #0d6efd; background: #f0f8ff; padding: 25px; border-radius: 50%;"></i></div>
                    <h4 class="fw-bold mb-3">Yêu cầu Đăng nhập</h4>
                    <p class="text-muted mb-4">Bạn cần đăng nhập để có thể tiến hành đặt vé.</p>
                    <div class="d-grid gap-3">
                        <a href="<?= BASEURL ?>/auth/login" class="btn btn-primary fw-bold py-2">Đăng nhập</a>
                        <a href="<?= BASEURL ?>/auth/register" class="btn btn-outline-primary fw-bold py-2">Tạo tài khoản</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL HÀNH LÝ -->
    <div class="modal fade" id="baggageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content p-4 text-center"><h5>Tham khảo quy định hành lý trên trang của hãng.</h5></div>
        </div>
    </div>

    <!-- MODAL DỊCH VỤ -->
    <div class="modal fade" id="specialServiceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4 text-center"><h5>Phí dịch vụ đặc biệt được áp dụng tùy hãng.</h5></div>
        </div>
    </div>

    <!-- MODAL THUẾ PHÍ -->
    <div class="modal fade" id="taxFeeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content p-4 text-center"><h5>Thuế phí đã được tính trong giá vé.</h5></div>
        </div>
    </div>

    <!-- Bootstrap JS Required for Modals -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPT TỐI ƯU HÓA HOÀN TOÀN -->
    <script>
        window.currentSelectedFlight = null;
        window.currentSelectedGroup = null;
        window.currentSelectedIndex = null;
        let upgradeModalInstance = null;
        let loginModalInstance = null;

        function showBaggageDetail(id) {
            document.getElementById('baggage-cards-view').style.display = 'none';
            document.querySelectorAll('.baggage-detail-view').forEach(view => { view.style.display = 'none'; });
            document.getElementById('baggage-detail-' + id).style.display = 'block';
        }

        function hideBaggageDetail() {
            document.querySelectorAll('.baggage-detail-view').forEach(view => { view.style.display = 'none'; });
            document.getElementById('baggage-cards-view').style.display = 'flex';
        }

        function resetBaggageModal() { hideBaggageDetail(); }

        document.addEventListener('DOMContentLoaded', function() {
            upgradeModalInstance = new bootstrap.Modal(document.getElementById('upgradeModal'));
            loginModalInstance = new bootstrap.Modal(document.getElementById('loginRequiredModal'));
            
            const isLoggedInString = '<?php echo isset($_SESSION['user_id']) ? "true" : "false"; ?>';
            const isLoggedIn = (isLoggedInString === 'true');

            // Biến PHP xác định nội địa hay quốc tế
            const isDomesticFlight = <?= isset($isDomestic) && $isDomestic ? 'true' : 'false' ?>;

            // Logic giá vé linh hoạt Nội Địa vs Quốc Tế
            const fareData = {
                eco: [
                    { name: "Phổ Thông Tiêu Chuẩn", priceAdd: isDomesticFlight ? 200000 : 5205000, seats: 0, change: "Phí đổi vé " + (isDomesticFlight ? "300k" : "3.165k"), refund: "Phí hoàn vé " + (isDomesticFlight ? "500k" : "4.483k"), baggage: "1 x 23 kg", cabin: "12kg" },
                    { name: "Phổ Thông Linh Hoạt", priceAdd: isDomesticFlight ? 500000 : 18020000, seats: 0, change: "Phí đổi vé " + (isDomesticFlight ? "Miễn phí" : "3.165k"), refund: "Phí hoàn vé " + (isDomesticFlight ? "300k" : "4.983k"), baggage: "2 x 23 kg", cabin: "12kg" }
                ],
                preeco: [
                    { name: "Đặc Biệt Tiêu Chuẩn", priceAdd: isDomesticFlight ? 500000 : 6523000, seats: 0, change: "Phí đổi vé " + (isDomesticFlight ? "300k" : "3.165k"), refund: "Phí hoàn vé " + (isDomesticFlight ? "500k" : "4.483k"), baggage: "2 x 23 kg", cabin: "18kg" },
                    { name: "Đặc Biệt Linh Hoạt", priceAdd: isDomesticFlight ? 1000000 : 25851000, seats: 8, change: "Phí đổi vé " + (isDomesticFlight ? "Miễn phí" : "2.637k"), refund: "Phí hoàn vé " + (isDomesticFlight ? "300k" : "3.165k"), baggage: "2 x 23 kg", cabin: "18kg" }
                ],
                biz: [
                    { name: "Thương Gia Tiêu Chuẩn", priceAdd: isDomesticFlight ? 1000000 : 14012000, seats: 8, change: "Phí đổi vé " + (isDomesticFlight ? "Miễn phí" : "3.165k"), refund: "Phí hoàn vé " + (isDomesticFlight ? "Miễn phí" : "4.483k"), baggage: "2 x 32 kg", cabin: "18kg" },
                    { name: "Thương Gia Linh Hoạt", priceAdd: isDomesticFlight ? 2000000 : 24639000, seats: 8, change: "Phí đổi vé Miễn phí", refund: "Phí hoàn vé Miễn phí", baggage: "2 x 32 kg", cabin: "18kg" }
                ]
            };

            const formatMoney = (amount) => amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".") + " VND";

            const createFareCardHTML = (fare, basePrice, flightId, index, groupKey) => {
                const finalPrice = parseInt(basePrice) + fare.priceAdd;
                const badgeHTML = fare.seats > 0 ? `<div class="fare-card-badge"><i class="fas fa-bell"></i> còn ${fare.seats} ghế</div>` : '';
                return `
                    <div class="fare-card" data-flight="${flightId}" data-index="${index}" data-group="${groupKey}" data-rawprice="${finalPrice}">
                        <div class="fare-card-header">
                            <input type="radio" name="fare_selection_${flightId}" value="${index}">
                            <div class="fare-card-price">${formatMoney(finalPrice)}</div>
                            <div class="fare-card-name">${fare.name}</div>
                            ${badgeHTML}
                        </div>
                        <div class="fare-features">
                            <div class="fare-feature-item"><i class="fas fa-exchange-alt"></i> <div><div class="feature-title">Thay đổi vé</div><div class="feature-desc">${fare.change}</div></div></div>
                            <div class="fare-feature-item"><i class="fas fa-undo"></i> <div><div class="feature-title">Hoàn vé</div><div class="feature-desc">${fare.refund}</div></div></div>
                            <div class="fare-feature-item"><i class="fas fa-suitcase-rolling"></i> <div><div class="feature-title">Hành lý ký gửi</div><div class="feature-desc">${fare.baggage}</div></div></div>
                        </div>
                    </div>`;
            };

            document.querySelectorAll('.class-selector').forEach(box => {
                box.addEventListener('click', function() {
                    const flightId = this.getAttribute('data-flight');
                    const type = this.getAttribute('data-type');
                    const basePrice = this.getAttribute('data-baseprice');
                    const panel = document.getElementById(`panel-flight-${flightId}`);
                    const container = document.getElementById(`fare-container-${flightId}`);
                    const isActive = this.classList.contains('active');

                    document.querySelectorAll(`.class-selector[data-flight="${flightId}"]`).forEach(b => b.classList.remove('active'));

                    if (isActive) {
                        panel.style.display = 'none';
                        document.getElementById(`prompt-text-${flightId}`).style.display = 'block';
                        document.getElementById(`btn-proceed-${flightId}`).style.display = 'none';
                    } else {
                        this.classList.add('active');
                        let html = '';
                        fareData[type].forEach((fare, index) => { 
                            html += createFareCardHTML(fare, basePrice, flightId, index, type); 
                        });
                        container.innerHTML = html;
                        panel.style.display = 'block';
                        document.getElementById(`prompt-text-${flightId}`).style.display = 'block';
                        document.getElementById(`btn-proceed-${flightId}`).style.display = 'none';

                        container.querySelectorAll('.fare-card').forEach(card => {
                            card.addEventListener('click', function() {
                                container.querySelectorAll('.fare-card').forEach(c => c.classList.remove('selected'));
                                this.classList.add('selected');
                                this.querySelector('input[type="radio"]').checked = true;
                                document.getElementById(`prompt-text-${flightId}`).style.display = 'none';
                                document.getElementById(`btn-proceed-${flightId}`).style.display = 'inline-block';
                            });
                        });
                    }
                });
            });

            // ================= HÀM CHUYỂN HƯỚNG SANG THANH TOÁN (SỬA LỖI URL) =================
            window.proceedBookingAction = function(isUpgraded) {
                if (!isLoggedIn) {
                    if (loginModalInstance) loginModalInstance.show();
                } else {
                    let finalClass = isUpgraded ? 'biz' : window.currentSelectedGroup;
                    let finalIndex = isUpgraded ? 0 : window.currentSelectedIndex;
                    
                    // Lấy chính xác điểm đi, điểm đến đã tìm kiếm đưa vào URL
                    let deptParam = encodeURIComponent('<?= !empty($searchDept) ? addslashes($searchDept) : 'Hà Nội (HAN)' ?>');
                    let destParam = encodeURIComponent('<?= !empty($searchDest) ? addslashes($searchDest) : 'Melbourne, Úc (MEL)' ?>');

                    window.location.href = '<?= BASEURL ?>/booking/checkout?flight_id=' + window.currentSelectedFlight + '&class=' + finalClass + '&fare_index=' + finalIndex + '&dept=' + deptParam + '&dest=' + destParam;
                }
            };

            window.handleUpgradeChoice = function(isUpgraded) {
                if (upgradeModalInstance) upgradeModalInstance.hide();
                setTimeout(function() { window.proceedBookingAction(isUpgraded); }, 300);
            };

            // ================= SỰ KIỆN CLICK NÚT "TIẾP TỤC" =================
            document.body.addEventListener('click', function(e) {
                const btn = e.target.closest('.btn-proceed-booking');
                
                if (btn) {
                    e.preventDefault(); 
                    const flightId = btn.getAttribute('data-flight');
                    window.currentSelectedFlight = flightId; 

                    const container = document.getElementById(`fare-container-${flightId}`);
                    const selectedRadio = container.querySelector('input[type="radio"]:checked');
                    
                    if (!selectedRadio) { alert("Vui lòng chọn một hạng vé trước khi tiếp tục."); return; }
                    
                    const selectedCard = selectedRadio.closest('.fare-card');
                    window.currentSelectedGroup = selectedCard.getAttribute('data-group'); 
                    window.currentSelectedIndex = selectedCard.getAttribute('data-index'); 
                    const currentPrice = parseInt(selectedCard.getAttribute('data-rawprice'));
                    
                    if (window.currentSelectedGroup === 'biz') {
                        window.proceedBookingAction(false);
                        return;
                    }

                    const targetUpgradeObj = fareData.biz[0]; 
                    const bizBox = document.querySelector(`.class-selector[data-flight="${flightId}"][data-type="biz"]`);
                    
                    if (bizBox) {
                        const bizBasePrice = parseInt(bizBox.getAttribute('data-baseprice'));
                        const upgradePrice = bizBasePrice + targetUpgradeObj.priceAdd;
                        const diffPrice = upgradePrice - currentPrice;
                        
                        if (diffPrice > 0) {
                            document.getElementById('upgradeTitle').innerText = `Nâng hạng lên ${targetUpgradeObj.name} chỉ với ${formatMoney(diffPrice)}`;
                            
                            const currentName = selectedCard.querySelector('.fare-card-name').innerText;
                            document.getElementById('upgCurrentName').innerText = currentName;
                            document.getElementById('btnKeepFareText').innerText = currentName.toUpperCase(); 
                            
                            const currentFareObj = fareData[window.currentSelectedGroup][window.currentSelectedIndex];
                            document.getElementById('upgCurrentChange').innerHTML = currentFareObj.change;
                            document.getElementById('upgCurrentRefund').innerHTML = currentFareObj.refund;
                            document.getElementById('upgCurrentBaggage').innerText = currentFareObj.baggage;
                            document.getElementById('upgCurrentCabin').innerHTML = `<i class="fas fa-check me-1"></i> ${currentFareObj.cabin}`;

                            document.getElementById('upgUpgradeName').innerText = targetUpgradeObj.name.toUpperCase();
                            document.getElementById('upgUpgradeChange').innerHTML = targetUpgradeObj.change;
                            document.getElementById('upgUpgradeRefund').innerHTML = targetUpgradeObj.refund;
                            document.getElementById('upgUpgradeBaggage').innerText = targetUpgradeObj.baggage;
                            document.getElementById('upgUpgradeCabin').innerHTML = `<i class="fas fa-check me-1"></i> ${targetUpgradeObj.cabin}`;

                            if (upgradeModalInstance) upgradeModalInstance.show();
                        } else {
                            window.proceedBookingAction(false);
                        }
                    } else {
                        window.proceedBookingAction(false);
                    }
                }
            });

            // ================= LOGIC BỘ LỌC =================
            const airlineFilters = document.querySelectorAll('.airline-filter');
            const timeFilters = document.querySelectorAll('.time-filter');
            const flightCards = document.querySelectorAll('.flight-item-container');
            const noResultMsg = document.getElementById('noResultMsg');

            function filterFlights() {
                const selectedAirlines = Array.from(airlineFilters).filter(cb => cb.checked).map(cb => cb.value);
                const selectedTimes = Array.from(timeFilters).filter(cb => cb.checked).map(cb => cb.value);
                let visibleCount = 0;

                flightCards.forEach(card => {
                    const cardAirline = card.getAttribute('data-airline');
                    const cardTime = card.getAttribute('data-time');
                    const matchAirline = selectedAirlines.includes(cardAirline);
                    const matchTime = selectedTimes.length === 0 || selectedTimes.includes(cardTime);
                    
                    if (matchAirline && matchTime) {
                        card.classList.remove('filter-hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('filter-hidden');
                        card.querySelector('.fare-details-panel').style.display = 'none';
                        card.querySelectorAll('.class-selector').forEach(b => b.classList.remove('active'));
                    }
                });
                noResultMsg.style.display = (visibleCount === 0) ? 'block' : 'none';
            }

            airlineFilters.forEach(cb => cb.addEventListener('change', filterFlights));
            timeFilters.forEach(cb => cb.addEventListener('change', filterFlights));
        });
    </script>
</body>
</html>