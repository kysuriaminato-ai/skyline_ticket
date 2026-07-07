<?php
$c = file_get_contents('app/Views/home/index.php');

$newHtml = <<<HTML
        <!-- Khối 4: ĐỐI TÁC BAY UY TÍN -->
        <div class="glass-panel p-4 p-md-5">
            <div class="d-flex justify-content-between align-items-end mb-4">
                <h3 class="mb-0 fw-bold" style="color: #0c3547;">Đối Tác Bay Uy Tín</h3>
                <a href="<?= BASEURL ?>/flight/search" class="text-primary text-decoration-none fw-bold" style="font-size: 14px;">Xem tất cả <i class="fas fa-arrow-right ms-1"></i></a>
            </div>
            
            <!-- Chuyến bay vừa xem -->
            <div class="recently-viewed mb-4 p-3 rounded-3 shadow-sm d-flex align-items-center justify-content-between" style="background: linear-gradient(90deg, #f8f9fa, #ffffff); border-left: 4px solid #0071c2;">
                <div class="d-flex align-items-center">
                    <div class="icon-wrap bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                        <i class="fas fa-history"></i>
                    </div>
                    <div>
                        <h6 class="mb-1 fw-bold text-dark">Hà Nội (HAN) <i class="fas fa-plane mx-1 text-muted small"></i> Melbourne (MEL)</h6>
                        <div class="small text-muted">Vừa xem 15 phút trước &bull; 1 Người lớn</div>
                    </div>
                </div>
                <div class="text-end">
                    <div class="text-danger fw-bold mb-1">Chỉ từ 12.500.000 VND</div>
                    <a href="<?= BASEURL ?>/flight/search" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-bold">Tiếp tục đặt</a>
                </div>
            </div>

            <!-- Grid 3 cột cho các Hãng Bay -->
            <div class="row g-4">
                <!-- Vietnam Airlines -->
                <div class="col-md-4">
                    <a href="<?= BASEURL ?>/flight/search?airline=VN" class="text-decoration-none h-100 d-block">
                        <div class="airline-card position-relative rounded-4 overflow-hidden shadow-sm h-100">
                            <div class="airline-bg" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/4/4b/Vietnam_Airlines_Boeing_787-9_Dreamliner_VN-A861_SGN.jpg/800px-Vietnam_Airlines_Boeing_787-9_Dreamliner_VN-A861_SGN.jpg');"></div>
                            <div class="airline-overlay"></div>
                            <div class="airline-content position-absolute bottom-0 w-100 p-4 text-white">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Vietnam_Airlines_logo.svg/200px-Vietnam_Airlines_logo.svg.png" alt="Vietnam Airlines" class="bg-white rounded p-1 me-2" style="height: 30px; object-fit: contain;">
                                    <h5 class="mb-0 fw-bold">Vietnam Airlines</h5>
                                </div>
                                <p class="small mb-3 opacity-75">Đẳng cấp 4 sao - Miễn phí hành lý ký gửi</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fw-bold fs-6 text-warning">Chỉ từ 1.150.000đ</div>
                                    <div class="btn-book-sm bg-white text-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;"><i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Vietjet Air -->
                <div class="col-md-4">
                    <a href="<?= BASEURL ?>/flight/search?airline=VJ" class="text-decoration-none h-100 d-block">
                        <div class="airline-card position-relative rounded-4 overflow-hidden shadow-sm h-100">
                            <div class="airline-bg" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/d/d7/VietJet_Air_Airbus_A320-200_VN-A675.jpg/800px-VietJet_Air_Airbus_A320-200_VN-A675.jpg');"></div>
                            <div class="airline-overlay"></div>
                            <div class="airline-content position-absolute bottom-0 w-100 p-4 text-white">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/VietJet_Air_logo.svg/200px-VietJet_Air_logo.svg.png" alt="Vietjet Air" class="bg-white rounded p-1 me-2" style="height: 30px; object-fit: contain;">
                                    <h5 class="mb-0 fw-bold text-shadow">Vietjet Air</h5>
                                </div>
                                <p class="small mb-3 opacity-75">Vé siêu tiết kiệm - Bay mọi nơi</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fw-bold fs-6 text-warning">Chỉ từ 690.000đ</div>
                                    <div class="btn-book-sm bg-white text-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;"><i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>

                <!-- Bamboo Airways -->
                <div class="col-md-4">
                    <a href="<?= BASEURL ?>/flight/search?airline=QH" class="text-decoration-none h-100 d-block">
                        <div class="airline-card position-relative rounded-4 overflow-hidden shadow-sm h-100">
                            <div class="airline-bg" style="background-image: url('https://upload.wikimedia.org/wikipedia/commons/thumb/b/b3/Bamboo_Airways_Boeing_787-9_Dreamliner_VN-A819_SGN.jpg/800px-Bamboo_Airways_Boeing_787-9_Dreamliner_VN-A819_SGN.jpg');"></div>
                            <div class="airline-overlay"></div>
                            <div class="airline-content position-absolute bottom-0 w-100 p-4 text-white">
                                <div class="d-flex align-items-center mb-2">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Bamboo_Airways_logo.svg/200px-Bamboo_Airways_logo.svg.png" alt="Bamboo Airways" class="bg-white rounded p-1 me-2" style="height: 30px; object-fit: contain;">
                                    <h5 class="mb-0 fw-bold">Bamboo Airways</h5>
                                </div>
                                <p class="small mb-3 opacity-75">Hơn cả một chuyến bay - Dịch vụ tận tâm</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="fw-bold fs-6 text-warning">Chỉ từ 890.000đ</div>
                                    <div class="btn-book-sm bg-white text-dark rounded-circle d-flex justify-content-center align-items-center" style="width: 32px; height: 32px;"><i class="fas fa-arrow-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
HTML;

$css = <<<CSS
        /* ================= NEW AIRLINES CARDS STYLES ================= */
        .airline-card { height: 260px; transition: all 0.4s ease; border: 1px solid rgba(0,0,0,0.05); }
        .airline-bg { 
            position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
            background-size: cover; background-position: center; 
            transition: all 0.5s ease;
        }
        .airline-overlay {
            position: absolute; top: 0; left: 0; width: 100%; height: 100%;
            background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.1) 100%);
            transition: opacity 0.3s ease;
        }
        .airline-content { z-index: 2; transition: transform 0.3s ease; }
        .btn-book-sm { opacity: 0; transform: translateX(-10px); transition: all 0.3s ease; }
        
        .airline-card:hover { transform: translateY(-5px); box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important; }
        .airline-card:hover .airline-bg { transform: scale(1.08); }
        .airline-card:hover .airline-overlay { background: linear-gradient(to top, rgba(0,113,194,0.9) 0%, rgba(0,0,0,0.4) 60%, rgba(0,0,0,0.1) 100%); }
        .airline-card:hover .btn-book-sm { opacity: 1; transform: translateX(0); }
        .airline-card:hover .airline-content p { opacity: 1 !important; color: #fff; }
        .text-shadow { text-shadow: 1px 1px 3px rgba(0,0,0,0.5); }
CSS;

// 1. Replace the old section
$c = preg_replace('/<!-- Khối 4: SEARCH TOP AIRLINES -->.*?<\/div>\s*<\/div>/is', $newHtml, $c);
$c = preg_replace('/<div class="glass-panel">\s*<h3>Search Top Airlines<\/h3>.*?<a href="<\?= BASEURL \?>\/flight\/search" class="btn-book-now">Book Now<\/a>\s*<\/div>/is', $newHtml, $c);

// 2. Inject new CSS
$c = str_replace("/* ================= TABS KHỎNG CÁCH ================= */", "$css\n        /* ================= TABS KHỎNG CÁCH ================= */", $c);
$c = str_replace("</style>", "$css\n    </style>", $c); // Fallback

file_put_contents('app/Views/home/index.php', $c);
echo "Injected new airline cards!";
