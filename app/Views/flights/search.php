<?php require_once '../app/Views/layouts/header.php'; ?>

<!-- Nạp FontAwesome nếu chưa có -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

<style>
    body {
        background-color: #f7f9fa;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    
    /* ================= THANH TÌM KIẾM TRÊN CÙNG ================= */
    .search-summary-bar {
        background: #fff;
        border-bottom: 1px solid #e0e0e0;
        padding: 15px 0;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        position: sticky;
        top: 0;
        z-index: 100;
    }
    .summary-item {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #e9ecef;
        font-weight: 600;
        color: #333;
    }

    /* ================= BỘ LỌC (SIDEBAR - AGODA STYLE) ================= */
    .filter-sidebar {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        padding: 20px;
    }
    .filter-title {
        font-weight: 700;
        font-size: 16px;
        color: #333;
        margin-bottom: 15px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .btn-clear {
        font-size: 14px;
        color: #0071c2; /* Màu xanh Agoda */
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
    }
    .btn-clear:hover { text-decoration: underline; color: #004f87; }
    
    .form-check-label {
        color: #333;
        font-size: 14px;
        width: 100%;
        cursor: pointer;
    }
    .form-check-input {
        cursor: pointer;
        width: 18px;
        height: 18px;
        margin-right: 10px;
    }
    .form-check-input:checked {
        background-color: #0071c2;
        border-color: #0071c2;
    }

    /* Range Slider Custom (Agoda Style) */
    .custom-range {
        -webkit-appearance: none;
        width: 100%;
        height: 4px;
        background: #e0e0e0;
        border-radius: 5px;
        outline: none;
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .custom-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #0071c2;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    .custom-range::-moz-range-thumb {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #fff;
        border: 2px solid #0071c2;
        cursor: pointer;
        box-shadow: 0 1px 3px rgba(0,0,0,0.3);
    }
    .range-label {
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    /* ================= TABS SẮP XẾP (AGODA STYLE) ================= */
    .sort-tabs-container {
        display: flex;
        background: #fff;
        border-radius: 8px;
        border: 1px solid #e0e0e0;
        margin-bottom: 20px;
        overflow: hidden;
    }
    .sort-tab {
        flex: 1;
        padding: 12px 15px;
        text-align: center;
        cursor: pointer;
        border-right: 1px solid #e0e0e0;
        transition: 0.3s;
        position: relative;
    }
    .sort-tab:last-child { border-right: none; }
    .sort-tab:hover { background: #f8f9fa; }
    
    .sort-tab.active {
        background: #fff;
    }
    .sort-tab.active::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 3px;
        background: #0071c2;
    }
    
    .sort-title { font-weight: 700; font-size: 14px; color: #333; margin-bottom: 2px; }
    .sort-tab.active .sort-title { color: #0071c2; }
    .sort-desc { font-size: 13px; color: #777; }

    .sort-dropdown-btn {
        background: #fff;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        padding: 10px 15px;
        font-weight: 600;
        color: #333;
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
    }
    
    /* Dropdown Item Agoda Style */
    .dropdown-menu.sort-menu {
        width: 260px;
        border-radius: 8px;
        padding: 8px 0;
    }
    .dropdown-item.sort-option {
        padding: 10px 20px;
        border-left: 3px solid transparent;
    }
    .dropdown-item.sort-option:hover {
        background-color: #f0f8ff;
    }
    .dropdown-item.sort-option.active-sort {
        background-color: #f0f8ff;
        border-left-color: #0071c2;
    }
    .dropdown-item.sort-option.active-sort .fw-bold {
        color: #0071c2;
    }

    /* ================= FLIGHT CARD ================= */
    .flight-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #e0e0e0;
        padding: 20px;
        margin-bottom: 15px;
        transition: 0.3s;
        animation: fadeIn 0.4s;
    }
    @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

    .flight-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        border-color: #b3d4d8;
    }
    
    .airline-logo {
        width: 40px; height: 40px;
        object-fit: contain;
        margin-right: 15px;
    }
    .airline-name { font-weight: 700; color: #333; font-size: 14px;}
    .flight-amenities { font-size: 12px; color: #28a745; margin-top: 5px; }
    
    .flight-time { font-size: 22px; font-weight: 800; color: #333; }
    .flight-airport { font-size: 14px; color: #666; font-weight: 600; }
    
    .flight-duration {
        text-align: center;
        position: relative;
        padding: 0 15px;
    }
    .duration-line {
        height: 2px;
        background: #ced4da;
        width: 100%;
        margin: 8px 0;
        position: relative;
    }
    .stop-dot {
        width: 8px; height: 8px;
        background: #0071c2;
        border-radius: 50%;
        position: absolute;
        top: -3px; left: 50%;
        transform: translateX(-50%);
    }

    .flight-price { font-size: 24px; font-weight: 800; color: #e74c3c; }
    .btn-book {
        background: #0071c2;
        color: #fff;
        font-weight: 700;
        border-radius: 8px;
        padding: 10px 20px;
        width: 100%;
        transition: 0.3s;
    }
    .btn-book:hover { background: #005f9e; color: #fff; }
</style>

<?php 
    // Thu thập dữ liệu tìm kiếm từ URL
    $dept = $_GET['departure'] ?? 'Hà Nội (HAN)';
    $dest = $_GET['destination'] ?? 'Melbourne (MEL)';
    $date = $_GET['departure_date'] ?? date('Y-m-d', strtotime('+1 day'));
    $adults = $_GET['adults'] ?? 1;
    $children = $_GET['children'] ?? 0;
?>

<!-- ================= THANH TÓM TẮT TÌM KIẾM ================= -->
<div class="search-summary-bar mb-4">
    <div class="container d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div class="d-flex gap-2 flex-wrap">
            <div class="summary-item">
                <i class="fas fa-plane-departure text-muted me-2"></i> <?= htmlspecialchars($dept) ?> 
                <i class="fas fa-exchange-alt mx-2 text-muted"></i> <?= htmlspecialchars($dest) ?>
            </div>
            <div class="summary-item">
                <i class="far fa-calendar-alt text-muted me-2"></i> <?= date('D, d M', strtotime($date)) ?>
            </div>
            <div class="summary-item">
                <i class="fas fa-user-friends text-muted me-2"></i> <?= $adults ?> Người lớn, <?= $children ?> Trẻ em
            </div>
        </div>
        <a href="<?= BASEURL ?>/home" class="btn btn-outline-primary fw-bold" style="border-radius: 8px; border-color: #0071c2; color: #0071c2;">Search</a>
    </div>
</div>

<div class="container mb-5">
    <div class="row">
        
        <!-- ================= BỘ LỌC (CỘT TRÁI) ================= -->
        <div class="col-lg-3 mb-4">
            <div class="filter-sidebar">
                
                <!-- Điểm dừng (Stops) -->
                <div class="mb-4" id="stopsFilterBox">
                    <div class="filter-title">
                        Stops <a class="btn-clear" data-target="stops">Clear</a>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-stop" type="checkbox" id="stopDirect" value="0" checked>
                        <label class="form-check-label" for="stopDirect">Direct</label>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-stop" type="checkbox" id="stop1" value="1" checked>
                        <label class="form-check-label" for="stop1">1 Stop</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input filter-stop" type="checkbox" id="stop2" value="2" checked>
                        <label class="form-check-label" for="stop2">2 Stops+</label>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <!-- Thời gian (Times) -->
                <div class="mb-4" id="timesFilterBox">
                    <div class="filter-title">
                        Times <a class="btn-clear" data-target="times">Clear</a>
                    </div>
                    
                    <div class="range-label" id="deptTimeLabel">Departure 00:00 - 23:59</div>
                    <input type="range" class="form-range custom-range filter-time" min="0" max="24" value="24" id="deptTime">
                    <div class="d-flex justify-content-between text-muted" style="font-size: 12px; margin-top: -5px; margin-bottom: 20px;">
                        <span>00:00</span><span>23:59</span>
                    </div>

                    <div class="range-label" id="arrTimeLabel">Arrival 00:00 - 23:59</div>
                    <input type="range" class="form-range custom-range filter-time" min="0" max="24" value="24" id="arrTime">
                    <div class="d-flex justify-content-between text-muted" style="font-size: 12px; margin-top: -5px;">
                        <span>00:00</span><span>23:59</span>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <!-- Giá tiền (Price per person) -->
                <div class="mb-4" id="priceFilterBox">
                    <div class="filter-title">
                        Price per person <a class="btn-clear" data-target="price">Clear</a>
                    </div>
                    <div class="range-label" id="priceLabelText">Up to đ 50,000,000</div>
                    <input type="range" class="form-range custom-range filter-price" min="5000000" max="50000000" step="100000" value="50000000" id="priceRange">
                </div>

                <hr class="text-muted opacity-25">

                <!-- Hãng bay (Airlines) -->
                <div class="mb-2" id="airlinesFilterBox">
                    <div class="filter-title">
                        Select all airlines <a class="btn-clear" data-target="airlines">Clear</a>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-airline" type="checkbox" id="al1" value="VN" checked>
                        <label class="form-check-label" for="al1">Vietnam Airlines</label>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-airline" type="checkbox" id="al2" value="QH" checked>
                        <label class="form-check-label" for="al2">Bamboo Airways</label>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-airline" type="checkbox" id="al3" value="VJ" checked>
                        <label class="form-check-label" for="al3">Vietjet Air</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input filter-airline" type="checkbox" id="al4" value="SQ" checked>
                        <label class="form-check-label" for="al4">Singapore Airlines</label>
                    </div>
                </div>

            </div>
        </div>

        <!-- ================= KẾT QUẢ TÌM KIẾM (CỘT PHẢI) ================= -->
        <div class="col-lg-9">
            
            <p class="text-muted mb-3"><i class="fas fa-info-circle me-1 text-primary"></i> Average price per person. The price includes taxes and fees.</p>

            <!-- Agoda Style Sort Tabs -->
            <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
                <div class="sort-tabs-container flex-grow-1 mb-0">
                    <div class="sort-tab" data-sort="cheapest">
                        <div class="sort-title">Cheapest</div>
                        <div class="sort-desc">đ 12,500,000 • 14h 15m</div>
                    </div>
                    <div class="sort-tab active" data-sort="best">
                        <div class="sort-title">Best overall</div>
                        <div class="sort-desc">đ 13,200,000 • 12h 25m</div>
                    </div>
                    <div class="sort-tab" data-sort="fastest">
                        <div class="sort-title">Fastest</div>
                        <div class="sort-desc">đ 15,800,000 • 10h 0m</div>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="sort-dropdown-btn dropdown-toggle" type="button" id="sortMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by <i class="fas fa-chevron-down ms-2 text-muted"></i>
                    </button>
                    <!-- Agoda Style Dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 sort-menu" aria-labelledby="sortMenuButton">
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="cheapest" data-text="Price per person">
                                <div class="fw-bold">Price per person</div>
                                <div class="text-muted small">Cheapest first</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option active-sort" href="#" data-sort="best" data-text="Best">
                                <div class="fw-bold">Best</div>
                                <div class="text-muted small">Cheap short flights</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="fastest" data-text="Total journey time">
                                <div class="fw-bold">Total journey time</div>
                                <div class="text-muted small">Fastest first</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="departure" data-text="Departure time">
                                <div class="fw-bold">Departure time</div>
                                <div class="text-muted small">Earliest first</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="arrival" data-text="Arrival time">
                                <div class="fw-bold">Arrival time</div>
                                <div class="text-muted small">Earliest first</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="stops" data-text="Stops">
                                <div class="fw-bold">Stops</div>
                                <div class="text-muted small">Fewest stops first</div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ================= DANH SÁCH CHUYẾN BAY ================= -->
            <div id="flightsListContainer">
                
                <!-- Card 1: Nhanh & Tốt nhất -->
                <div class="flight-card position-relative overflow-hidden" 
                     data-price="13200000" data-stops="1" data-dept-time="16" data-arr-time="4.4" data-duration="745" data-airline="VN">
                    
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0 d-flex align-items-start">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/1b/Vietnam_Airlines_logo.svg/200px-Vietnam_Airlines_logo.svg.png" alt="VN Airlines" class="airline-logo">
                            <div>
                                <div class="airline-name">Vietnam Airlines</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase-rolling me-1"></i> Cabin bag</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase me-1"></i> Checked baggage</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center">
                                    <div class="flight-time">16:00</div>
                                    <div class="flight-airport">HAN</div>
                                </div>
                                
                                <div class="flight-duration flex-grow-1 mx-3">
                                    <div class="text-muted small fw-bold">12h 25m</div>
                                    <div class="duration-line"><div class="stop-dot"></div></div>
                                    <div class="text-muted small">1 Stop</div>
                                </div>

                                <div class="text-center">
                                    <div class="flight-time">04:25<sup class="text-danger small">+1</sup></div>
                                    <div class="flight-airport">MEL</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 border-start text-end">
                            <div class="flight-price mb-2">đ 13,200,000</div>
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=991&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?>" class="btn btn-book">Select</a>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Rẻ nhất -->
                <div class="flight-card position-relative overflow-hidden"
                     data-price="12500000" data-stops="2" data-dept-time="5.5" data-arr-time="19.75" data-duration="855" data-airline="VJ">
                    
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0 d-flex align-items-start">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/VietJet_Air_logo.svg/200px-VietJet_Air_logo.svg.png" alt="Vietjet" class="airline-logo">
                            <div>
                                <div class="airline-name">Vietjet Air</div>
                                <div class="text-muted small mt-1">Partially operated by Thai Vietjet</div>
                                <div class="flight-amenities text-success"><i class="fas fa-shopping-bag me-1"></i> Cabin bag</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center">
                                    <div class="flight-time">05:30</div>
                                    <div class="flight-airport">HAN</div>
                                </div>
                                
                                <div class="flight-duration flex-grow-1 mx-3">
                                    <div class="text-muted small fw-bold">14h 15m</div>
                                    <div class="duration-line">
                                        <div class="stop-dot" style="left: 30%;"></div>
                                        <div class="stop-dot" style="left: 70%;"></div>
                                    </div>
                                    <div class="text-muted small">2 Stops</div>
                                </div>

                                <div class="text-center">
                                    <div class="flight-time">19:45</div>
                                    <div class="flight-airport">MEL</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 border-start text-end">
                            <div class="flight-price mb-2 text-danger">đ 12,500,000</div>
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=994&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?>" class="btn btn-book">Select</a>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Bay Thẳng -->
                <div class="flight-card position-relative overflow-hidden"
                     data-price="15800000" data-stops="0" data-dept-time="10" data-arr-time="20" data-duration="600" data-airline="QH">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0 d-flex align-items-start">
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/9/9d/Bamboo_Airways_logo.svg/200px-Bamboo_Airways_logo.svg.png" alt="Bamboo" class="airline-logo" style="width: 50px;">
                            <div>
                                <div class="airline-name">Bamboo Airways</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase-rolling me-1"></i> Cabin bag</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase me-1"></i> Checked baggage</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center">
                                    <div class="flight-time">10:00</div>
                                    <div class="flight-airport">HAN</div>
                                </div>
                                
                                <div class="flight-duration flex-grow-1 mx-3">
                                    <div class="text-muted small fw-bold">10h 00m</div>
                                    <div class="duration-line"><div class="stop-dot d-none"></div></div>
                                    <div class="text-muted small">Direct</div>
                                </div>

                                <div class="text-center">
                                    <div class="flight-time">20:00</div>
                                    <div class="flight-airport">MEL</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 border-start text-end">
                            <div class="flight-price mb-2">đ 15,800,000</div>
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=993&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?>" class="btn btn-book">Select</a>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Singapore Airlines -->
                <div class="flight-card position-relative overflow-hidden"
                     data-price="18573548" data-stops="1" data-dept-time="20" data-arr-time="11" data-duration="720" data-airline="SQ">
                    <div class="row align-items-center">
                        <div class="col-md-3 mb-3 mb-md-0 d-flex align-items-start">
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/200px-Singapore_Airlines_Logo_2.svg.png" alt="Singapore Airlines" class="airline-logo" style="width: 50px;">
                            <div>
                                <div class="airline-name">Singapore Airlines</div>
                                <div class="text-muted small mt-1">Partially operated by Scoot</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase-rolling me-1"></i> Cabin bag</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase me-1"></i> Checked baggage</div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3 mb-md-0">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-center">
                                    <div class="flight-time">20:00</div>
                                    <div class="flight-airport">HAN</div>
                                </div>
                                
                                <div class="flight-duration flex-grow-1 mx-3">
                                    <div class="text-muted small fw-bold">12h 00m</div>
                                    <div class="duration-line"><div class="stop-dot"></div></div>
                                    <div class="text-muted small">1 Stop</div>
                                </div>

                                <div class="text-center">
                                    <div class="flight-time">11:00<sup class="text-danger small">+1</sup></div>
                                    <div class="flight-airport">MEL T2</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 border-start text-end">
                            <div class="flight-price mb-2">đ 18,573,548</div>
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=995&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?>" class="btn btn-book">Select</a>
                        </div>
                    </div>
                </div>

            </div> <!-- End flightsListContainer -->

        </div> <!-- Hết Cột Phải -->
    </div>
</div>

<!-- ================= JAVASCRIPT XỬ LÝ LỌC & SẮP XẾP ================= -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const priceRange = document.getElementById("priceRange");
        const priceLabelText = document.getElementById("priceLabelText");
        
        const deptTime = document.getElementById("deptTime");
        const deptTimeLabel = document.getElementById("deptTimeLabel");
        
        const arrTime = document.getElementById("arrTime");
        const arrTimeLabel = document.getElementById("arrTimeLabel");

        // Format tiền tệ chuẩn Agoda (ví dụ: 50,000,000)
        const formatter = new Intl.NumberFormat('en-US');

        function formatTime(val) {
            return val < 10 ? '0' + val + ':00' : val + ':00';
        }

        // Cập nhật nhãn khi kéo thanh trượt
        priceRange.addEventListener("input", function() {
            priceLabelText.innerHTML = "Up to đ " + formatter.format(this.value);
        });
        deptTime.addEventListener("input", function() {
            deptTimeLabel.innerHTML = "Departure 00:00 - " + formatTime(this.value);
        });
        arrTime.addEventListener("input", function() {
            arrTimeLabel.innerHTML = "Arrival 00:00 - " + formatTime(this.value);
        });

        // 1. THUẬT TOÁN LỌC (FILTERING)
        function applyFilters() {
            const maxPrice = parseInt(priceRange.value);
            const maxDeptTime = parseInt(deptTime.value);
            const maxArrTime = parseInt(arrTime.value);

            const allowedStops = [];
            document.querySelectorAll('.filter-stop:checked').forEach(cb => {
                allowedStops.push(parseInt(cb.value));
            });

            const allowedAirlines = [];
            document.querySelectorAll('.filter-airline:checked').forEach(cb => {
                allowedAirlines.push(cb.value);
            });

            const cards = document.querySelectorAll('.flight-card');
            let visibleCount = 0;

            cards.forEach(card => {
                const price = parseInt(card.getAttribute('data-price'));
                const stops = parseInt(card.getAttribute('data-stops'));
                const dept = parseFloat(card.getAttribute('data-dept-time'));
                const arr = parseFloat(card.getAttribute('data-arr-time'));
                const airline = card.getAttribute('data-airline');

                let isMatch = true;

                if (price > maxPrice) isMatch = false;
                if (dept > maxDeptTime) isMatch = false;
                if (arr > maxArrTime) isMatch = false;
                
                if (allowedStops.length === 0 || !allowedStops.includes(stops)) isMatch = false;
                if (allowedAirlines.length === 0 || !allowedAirlines.includes(airline)) isMatch = false;

                if (isMatch) {
                    card.style.display = 'block';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Handle "No flights found"
            let noFlightMsg = document.getElementById('noFlightMsg');
            if (visibleCount === 0) {
                if (!noFlightMsg) {
                    noFlightMsg = document.createElement('div');
                    noFlightMsg.id = 'noFlightMsg';
                    noFlightMsg.className = 'alert alert-warning text-center py-5 mt-3 shadow-sm rounded-3 border-0';
                    noFlightMsg.innerHTML = '<i class="fas fa-search-minus fa-3x mb-3 text-muted"></i><h5 class="fw-bold text-dark">No flights found</h5><p class="mb-0 text-muted">Try adjusting your filters.</p>';
                    document.getElementById('flightsListContainer').appendChild(noFlightMsg);
                }
                noFlightMsg.style.display = 'block';
            } else {
                if (noFlightMsg) noFlightMsg.style.display = 'none';
            }
        }

        // Gắn sự kiện (Event Listeners) cho tất cả bộ lọc
        document.querySelectorAll('.filter-sidebar input[type="checkbox"]').forEach(input => {
            input.addEventListener('change', applyFilters);
        });
        document.querySelectorAll('.filter-sidebar input[type="range"]').forEach(input => {
            input.addEventListener('change', applyFilters);
            input.addEventListener('input', applyFilters); 
        });

        // Tách riêng chức năng Clear theo từng nhóm (Agoda Style)
        document.querySelectorAll('.btn-clear').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const target = this.getAttribute('data-target');
                
                if(target === 'stops' || target === 'airlines') {
                    // Tích chọn lại tất cả checkbox trong vùng đó
                    const box = document.getElementById(target + 'FilterBox');
                    box.querySelectorAll('input[type="checkbox"]').forEach(cb => cb.checked = true);
                } 
                else if(target === 'times') {
                    // Reset thanh trượt thời gian về tối đa
                    const box = document.getElementById('timesFilterBox');
                    box.querySelectorAll('input[type="range"]').forEach(rg => {
                        rg.value = rg.max;
                        rg.dispatchEvent(new Event('input'));
                    });
                }
                else if(target === 'price') {
                    // Reset thanh trượt giá
                    const rg = document.getElementById('priceRange');
                    rg.value = rg.max;
                    rg.dispatchEvent(new Event('input'));
                }

                applyFilters();
            });
        });

        // 2. THUẬT TOÁN SẮP XẾP (SORTING)
        function sortFlights(sortType, dropdownText) {
            const container = document.getElementById('flightsListContainer');
            const cards = Array.from(container.querySelectorAll('.flight-card'));

            cards.sort((a, b) => {
                const priceA = parseInt(a.getAttribute('data-price'));
                const priceB = parseInt(b.getAttribute('data-price'));
                const durA = parseInt(a.getAttribute('data-duration'));
                const durB = parseInt(b.getAttribute('data-duration'));
                const deptA = parseFloat(a.getAttribute('data-dept-time'));
                const deptB = parseFloat(b.getAttribute('data-dept-time'));
                const arrA = parseFloat(a.getAttribute('data-arr-time'));
                const arrB = parseFloat(b.getAttribute('data-arr-time'));
                const stopsA = parseInt(a.getAttribute('data-stops'));
                const stopsB = parseInt(b.getAttribute('data-stops'));

                if (sortType === 'cheapest') {
                    return priceA - priceB;
                } else if (sortType === 'fastest') {
                    return durA - durB;
                } else if (sortType === 'best') {
                    let scoreA = priceA + (durA * 10000);
                    let scoreB = priceB + (durB * 10000);
                    return scoreA - scoreB;
                } else if (sortType === 'departure') {
                    return deptA - deptB;
                } else if (sortType === 'arrival') {
                    return arrA - arrB;
                } else if (sortType === 'stops') {
                    return stopsA - stopsB;
                }
            });

            cards.forEach(card => container.appendChild(card));

            // Cập nhật text cho Nút Dropdown
            document.getElementById('sortMenuButton').innerHTML = 'Sort by: ' + dropdownText + ' <i class="fas fa-chevron-down ms-2 text-muted"></i>';
        }

        // Gắn sự kiện click cho Tab Sắp xếp bên ngoài
        const sortTabs = document.querySelectorAll('.sort-tab');
        sortTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                sortTabs.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                const type = this.getAttribute('data-sort');
                let text = "Best";
                if(type === 'cheapest') text = "Price per person";
                if(type === 'fastest') text = "Total journey time";
                
                // Đồng bộ class Active trong Dropdown
                document.querySelectorAll('.sort-option').forEach(t => t.classList.remove('active-sort'));
                const matchedOption = document.querySelector('.sort-option[data-sort="'+type+'"]');
                if(matchedOption) matchedOption.classList.add('active-sort');

                sortFlights(type, text);
            });
        });

        // Gắn sự kiện click cho Menu Dropdown Sắp xếp bên trong
        const sortOptions = document.querySelectorAll('.sort-option');
        sortOptions.forEach(opt => {
            opt.addEventListener('click', function(e) {
                e.preventDefault();
                const type = this.getAttribute('data-sort');
                const text = this.getAttribute('data-text');
                
                // Active class trong Dropdown
                sortOptions.forEach(t => t.classList.remove('active-sort'));
                this.classList.add('active-sort');

                // Đồng bộ class Active cho Tab ngoài (nếu là 1 trong 3 tab chính)
                sortTabs.forEach(t => t.classList.remove('active'));
                const matchedTab = document.querySelector('.sort-tab[data-sort="'+type+'"]');
                if(matchedTab) matchedTab.classList.add('active');
                
                sortFlights(type, text);
            });
        });

        // Mặc định sort là Best
        sortFlights('best', 'Best');
    });

</script>

<?php require_once '../app/Views/layouts/footer.php'; ?>