?<?php
function renderFareOptions($flightId, $basePrice, $dept, $dest, $adults, $children, $promo) {
    $ecoSaving = $basePrice;
    $ecoStandard = $basePrice + ($basePrice * 0.20);
    $ecoFlex = $basePrice + ($basePrice * 0.40);
    
    $premiumEco = $basePrice + ($basePrice * 0.80);
    $premiumEcoFlex = $basePrice + ($basePrice * 1.0);
    
    $bizStandard = $basePrice * 2.5;
    $bizFlex = $basePrice * 3.0;
    
    $buildUrl = function($price, $className) use ($flightId, $dept, $dest, $adults, $children, $promo) {
        $url = BASEURL . "/booking/checkout?flight_id=" . $flightId;
        $url .= "&price=" . $price;
        $url .= "&class_name=" . urlencode($className);
        $url .= "&dept=" . urlencode($dept) . "&dest=" . urlencode($dest);
        $url .= "&adults=" . $adults . "&children=" . $children;
        if (!empty($promo)) $url .= "&promo=" . $promo;
        return $url;
    };
    ?>
    <div class="collapse fare-collapse mt-3" id="fareOptions_<?= $flightId ?>">
        <div class="card card-body border-0 shadow-sm" style="background-color: #f8f9fa;">
            <ul class="nav nav-pills nav-fill mb-3" id="fareTabs_<?= $flightId ?>" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active fw-bold" id="eco-tab-<?= $flightId ?>" data-bs-toggle="tab" data-bs-target="#eco-<?= $flightId ?>" type="button" role="tab" style="background-color: #00635d; color: white; border-radius: 8px 0 0 8px;">
                        PH? TH�NG<br><small class="fw-normal">t? <?= number_format($ecoSaving) ?> VND</small>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="premium-tab-<?= $flightId ?>" data-bs-toggle="tab" data-bs-target="#premium-<?= $flightId ?>" type="button" role="tab" style="background-color: #a4babc; color: #1e3a5f; border-radius: 0;">
                        PH? TH�NG ??C BI?T<br><small class="fw-normal">t? <?= number_format($premiumEco) ?> VND</small>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-bold" id="biz-tab-<?= $flightId ?>" data-bs-toggle="tab" data-bs-target="#biz-<?= $flightId ?>" type="button" role="tab" style="background-color: #dcb345; color: #1e3a5f; border-radius: 0 8px 8px 0;">
                        TH??NG GIA<br><small class="fw-normal">t? <?= number_format($bizStandard) ?> VND</small>
                    </button>
                </li>
            </ul>
            
            <div class="tab-content" id="fareTabsContent_<?= $flightId ?>">
                <!-- Ph? th�ng -->
                <div class="tab-pane fade show active" id="eco-<?= $flightId ?>" role="tabpanel">
                    <div class="row g-3">
                        <!-- Ti?t ki?m -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm fare-card">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($ecoSaving) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Ph? Th�ng Ti?t Ki?m</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-muted me-2"></i> <strong>Thay ??i v�:</strong> Ph� ??i v� 1.600.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 1.800.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 23 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> Kh�ng qu� 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 60%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($ecoSaving, 'Ph? Th�ng Ti?t Ki?m') ?>" class="btn btn-outline-primary w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                        <!-- Ti�u chu?n -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm fare-card border-primary" style="border-width: 2px !important;">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($ecoStandard) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Ph? Th�ng Ti�u Chu?n</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-muted me-2"></i> <strong>Thay ??i v�:</strong> Ph� ??i v� 1.010.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 1.150.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 23 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> Kh�ng qu� 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 80%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($ecoStandard, 'Ph? Th�ng Ti�u Chu?n') ?>" class="btn btn-primary w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                        <!-- Linh ho?t -->
                        <div class="col-md-4">
                            <div class="card h-100 border-0 shadow-sm fare-card">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($ecoFlex) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Ph? Th�ng Linh Ho?t</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-success me-2"></i> <strong>Thay ??i v�:</strong> Mi?n ph�</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 500.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 23 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> Kh�ng qu� 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 110%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($ecoFlex, 'Ph? Th�ng Linh Ho?t') ?>" class="btn btn-outline-primary w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Ph? th�ng ??c bi?t -->
                <div class="tab-pane fade" id="premium-<?= $flightId ?>" role="tabpanel">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <div class="card h-100 border-0 shadow-sm fare-card border-primary" style="border-width: 2px !important;">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($premiumEco) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Ph? Th�ng ??c Bi?t Ti�u Chu?n</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-success me-2"></i> <strong>Thay ??i v�:</strong> ???c ph�p</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 650.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 32 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> 2 x 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 120%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($premiumEco, 'Ph? Th�ng ??c Bi?t Ti�u Chu?n') ?>" class="btn btn-primary w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card h-100 border-0 shadow-sm fare-card">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($premiumEcoFlex) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Ph? Th�ng ??c Bi?t Linh Ho?t</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-success me-2"></i> <strong>Thay ??i v�:</strong> ???c ph�p</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 500.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 32 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> 2 x 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 130%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($premiumEcoFlex, 'Ph? Th�ng ??c Bi?t Linh Ho?t') ?>" class="btn btn-outline-primary w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Th??ng gia -->
                <div class="tab-pane fade" id="biz-<?= $flightId ?>" role="tabpanel">
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <div class="card h-100 border-0 shadow-sm fare-card border-warning" style="border-width: 2px !important;">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($bizStandard) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Th??ng Gia Ti�u Chu?n</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-muted me-2"></i> <strong>Thay ??i v�:</strong> Ph� ??i 1.010.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 1.300.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 32 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> 2 x 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 150%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($bizStandard, 'Th??ng Gia Ti�u Chu?n') ?>" class="btn btn-warning text-dark w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card h-100 border-0 shadow-sm fare-card">
                                <div class="card-header bg-white text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($bizFlex) ?> <small>VND</small></h4>
                                    <div class="text-muted small">Th??ng Gia Linh Ho?t</div>
                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled small mb-4">
                                        <li class="mb-2"><i class="fas fa-exchange-alt text-success me-2"></i> <strong>Thay ??i v�:</strong> Mi?n ph�</li>
                                        <li class="mb-2"><i class="fas fa-undo text-muted me-2"></i> <strong>Ho�n v�:</strong> Ph� ho�n 650.000 VND</li>
                                        <li class="mb-2"><i class="fas fa-suitcase text-success me-2"></i> <strong>H�nh l� k� g?i:</strong> 1 x 32 kg</li>
                                        <li class="mb-2"><i class="fas fa-shopping-bag text-success me-2"></i> <strong>H�nh l� x�ch tay:</strong> 2 x 10kg</li>
                                        <li class="mb-2"><i class="fas fa-star text-warning me-2"></i> <strong>S? d?m:</strong> T�ch l?y 200%</li>
                                    </ul>
                                    <a href="<?= $buildUrl($bizFlex, 'Th??ng Gia Linh Ho?t') ?>" class="btn btn-outline-warning text-dark w-100 fw-bold btn-book">Ch?n gi� v�</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

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
    $promo = $_GET['promo'] ?? '';
?>

<!-- ================= THANH TÓM TẮT TÌM KIẾM ================= -->
<div class="search-summary-bar mb-4 py-3">
    <div class="container">
        <form action="<?= BASEURL ?>/flight/search" method="GET" class="d-flex justify-content-between align-items-center flex-wrap gap-2 w-100">
            <?php if (!empty($promo)): ?>
                <input type="hidden" name="promo" value="<?= htmlspecialchars($promo) ?>">
            <?php endif; ?>
            <div class="d-flex gap-2 flex-wrap flex-grow-1 align-items-center">
                <!-- Điểm đi và Điểm đến -->
                <div class="input-group flex-grow-1" style="min-width: 300px; max-width: 500px;">
                    <span class="input-group-text bg-white border-end-0"><i class="fas fa-plane-departure text-muted"></i></span>
                    <input type="text" name="departure" class="form-control border-start-0 ps-0 fw-bold" value="<?= htmlspecialchars($dept) ?>" required>
                    <span class="input-group-text bg-white border-start-0 border-end-0"><i class="fas fa-exchange-alt text-muted"></i></span>
                    <input type="text" name="destination" class="form-control border-start-0 ps-0 fw-bold" value="<?= htmlspecialchars($dest) ?>" required>
                </div>
                
                <!-- Ngày đi -->
                <div class="input-group" style="width: 200px;">
                    <span class="input-group-text bg-white border-end-0"><i class="far fa-calendar-alt text-muted"></i></span>
                    <input type="date" name="departure_date" class="form-control border-start-0 ps-0 fw-bold" value="<?= htmlspecialchars($date) ?>" required>
                </div>
                
                <!-- Hành khách -->
                <div class="input-group" style="width: 260px;">
                    <span class="input-group-text bg-white border-end-0" title="Người lớn"><i class="fas fa-user text-muted"></i></span>
                    <input type="number" name="adults" class="form-control border-start-0 ps-0 fw-bold" title="Người lớn" value="<?= $adults ?>" min="1" max="9" required>
                    <span class="input-group-text bg-white border-start-0 border-end-0" title="Trẻ em"><i class="fas fa-child text-muted"></i></span>
                    <input type="number" name="children" class="form-control border-start-0 ps-0 fw-bold" title="Trẻ em" value="<?= $children ?>" min="0" max="9">
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary fw-bold px-4" style="border-radius: 8px; background: #0071c2; height: 40px;">Cập nhật</button>
        </form>
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
                        Điểm dừng <a class="btn-clear" data-target="stops">Xóa</a>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-stop" type="checkbox" id="stopDirect" value="0" checked>
                        <label class="form-check-label" for="stopDirect">Bay thẳng</label>
                    </div>
                    <div class="form-check mb-2 d-flex align-items-center">
                        <input class="form-check-input filter-stop" type="checkbox" id="stop1" value="1" checked>
                        <label class="form-check-label" for="stop1">1 điểm dừng</label>
                    </div>
                    <div class="form-check d-flex align-items-center">
                        <input class="form-check-input filter-stop" type="checkbox" id="stop2" value="2" checked>
                        <label class="form-check-label" for="stop2">2+ điểm dừng</label>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <!-- Thời gian (Times) -->
                <div class="mb-4" id="timesFilterBox">
                    <div class="filter-title">
                        Thời gian <a class="btn-clear" data-target="times">Xóa</a>
                    </div>
                    
                    <div class="range-label" id="deptTimeLabel">Cất cánh 00:00 - 23:59</div>
                    <input type="range" class="form-range custom-range filter-time" min="0" max="24" value="24" id="deptTime">
                    <div class="d-flex justify-content-between text-muted" style="font-size: 12px; margin-top: -5px; margin-bottom: 20px;">
                        <span>00:00</span><span>23:59</span>
                    </div>

                    <div class="range-label" id="arrTimeLabel">Hạ cánh 00:00 - 23:59</div>
                    <input type="range" class="form-range custom-range filter-time" min="0" max="24" value="24" id="arrTime">
                    <div class="d-flex justify-content-between text-muted" style="font-size: 12px; margin-top: -5px;">
                        <span>00:00</span><span>23:59</span>
                    </div>
                </div>

                <hr class="text-muted opacity-25">

                <!-- Giá tiền (Price per person) -->
                <div class="mb-4" id="priceFilterBox">
                    <div class="filter-title">
                        Giá mỗi người <a class="btn-clear" data-target="price">Xóa</a>
                    </div>
                    <div class="range-label" id="priceLabelText">Lên đến 50,000,000 đ</div>
                    <input type="range" class="form-range custom-range filter-price" min="5000000" max="50000000" step="100000" value="50000000" id="priceRange">
                </div>

                <hr class="text-muted opacity-25">

                <!-- Hãng bay (Airlines) -->
                <div class="mb-2" id="airlinesFilterBox">
                    <div class="filter-title">
                        Hãng hàng không <a class="btn-clear" data-target="airlines">Xóa</a>
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
            
            <!-- INFO BAR -->
            <div class="mb-3 text-muted small">
                <i class="fas fa-info-circle text-primary me-1"></i> Giá trung bình mỗi người. Giá đã bao gồm thuế và phí.
            </div>

            <!-- ================= SẮP XẾP ================= -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="sort-tabs-container mb-0 flex-grow-1 me-3">
                    <div class="sort-tab" data-sort="cheapest">
                        <div class="sort-title">Rẻ nhất</div>
                        <div class="sort-desc">đ 12,500,000 • 14h 15m</div>
                    </div>
                    <div class="sort-tab active" data-sort="best">
                        <div class="sort-title">Tốt nhất</div>
                        <div class="sort-desc">đ 13,200,000 • 12h 25m</div>
                    </div>
                    <div class="sort-tab" data-sort="fastest">
                        <div class="sort-title">Nhanh nhất</div>
                        <div class="sort-desc">đ 15,800,000 • 10h 0m</div>
                    </div>
                </div>

                <div class="dropdown">
                    <button class="sort-dropdown-btn dropdown-toggle" type="button" id="sortMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        Sắp xếp: Tốt nhất <i class="fas fa-chevron-down ms-2 text-muted"></i>
                    </button>
                    <!-- Agoda Style Dropdown -->
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 sort-menu" aria-labelledby="sortMenuButton">
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="cheapest" data-text="Giá mỗi người">
                                <div class="fw-bold">Giá mỗi người</div>
                                <div class="text-muted small">Rẻ nhất trước</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option active-sort" href="#" data-sort="best" data-text="Tốt nhất">
                                <div class="fw-bold">Tốt nhất</div>
                                <div class="text-muted small">Chuyến bay ngắn & rẻ</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="fastest" data-text="Tổng thời gian">
                                <div class="fw-bold">Tổng thời gian bay</div>
                                <div class="text-muted small">Nhanh nhất trước</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="departure" data-text="Giờ cất cánh">
                                <div class="fw-bold">Giờ cất cánh</div>
                                <div class="text-muted small">Sớm nhất trước</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="arrival" data-text="Giờ hạ cánh">
                                <div class="fw-bold">Giờ hạ cánh</div>
                                <div class="text-muted small">Sớm nhất trước</div>
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item sort-option" href="#" data-sort="stops" data-text="Điểm dừng">
                                <div class="fw-bold">Điểm dừng</div>
                                <div class="text-muted small">Ít điểm dừng nhất</div>
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
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase-rolling me-1"></i> Hành lý xách tay</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase me-1"></i> Hành lý ký gửi</div>
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
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=991&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?><?= $promo ? '&promo=' . $promo : '' ?>" class="btn btn-book">Chọn</a>
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
                                <div class="text-muted small mt-1">Được khai thác một phần bởi Thai Vietjet</div>
                                <div class="flight-amenities text-success"><i class="fas fa-shopping-bag me-1"></i> Hành lý xách tay</div>
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
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=994&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?><?= $promo ? '&promo=' . $promo : '' ?>" class="btn btn-book">Chọn</a>
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
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase-rolling me-1"></i> Hành lý xách tay</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase me-1"></i> Hành lý ký gửi</div>
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
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=993&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?><?= $promo ? '&promo=' . $promo : '' ?>" class="btn btn-book">Chọn</a>
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
                                <div class="text-muted small mt-1">Được khai thác một phần bởi Scoot</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase-rolling me-1"></i> Hành lý xách tay</div>
                                <div class="flight-amenities text-success"><i class="fas fa-suitcase me-1"></i> Hành lý ký gửi</div>
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
                            <a href="<?= BASEURL ?>/booking/checkout?flight_id=995&class=eco&fare_index=0&dept=<?= urlencode($dept) ?>&dest=<?= urlencode($dest) ?>&adults=<?= $adults ?>&children=<?= $children ?><?= $promo ? '&promo=' . $promo : '' ?>" class="btn btn-book">Chọn</a>
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
            document.getElementById('sortMenuButton').innerHTML = 'Sắp xếp: ' + dropdownText + ' <i class="fas fa-chevron-down ms-2 text-muted"></i>';
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



