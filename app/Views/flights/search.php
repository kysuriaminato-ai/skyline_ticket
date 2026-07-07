<?php
function renderVnaFlightCard($flightId, $basePrice, $dept, $dest, $adults, $children, $promo, $deptTimeStr, $arrTimeStr, $duration, $stopsText, $airlineLogo, $airlineName, $airlineSub) {
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
    <div class="vna-card-container mb-4 flight-card" style="border:none; padding:0; background:transparent; box-shadow:none;" data-price="<?= $basePrice ?>" data-stops="<?php
    if (strpos($stopsText, '2+') !== false) echo 2;
    elseif (strpos($stopsText, '1') !== false) echo 1;
    else echo 0;
?>" data-arr-time="<?= (float)str_replace(':','.',$arrTimeStr) ?>" data-duration="<?= (int)$duration ?>" data-airline="<?php
    $airlineCodeMap = [
        'Vietnam Airlines' => 'VN',
        'Vietjet Air' => 'VJ',
        'Bamboo Airways' => 'QH',
        'Singapore Airlines' => 'SQ',
    ];
    echo $airlineCodeMap[$airlineName] ?? substr($airlineName, 0, 2);
?>">
        <!-- Main row -->
        <div class="vna-flight-row d-flex shadow-sm rounded overflow-hidden bg-white border">
            <!-- Left: Flight Info -->
            <div class="vna-flight-info p-4 d-flex align-items-center flex-grow-1" style="width: 45%;">
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="time-block text-start">
                            <h3 class="fw-bold mb-0 text-primary"><?= $deptTimeStr ?></h3>
                            <small class="text-muted fw-bold">HAN</small>
                        </div>
                        <div class="duration-block text-center flex-grow-1 px-4">
                            <small class="text-muted d-block mb-1">Thời gian bay <?= $duration ?></small>
                            <div class="position-relative">
                                <hr class="my-1 border-primary" style="opacity: 0.3;">
                                <i class="fas fa-plane text-warning position-absolute top-50 start-50 translate-middle bg-white px-1"></i>
                            </div>
                            <small class="text-success fw-bold"><?= $stopsText ?></small>
                        </div>
                        <div class="time-block text-end">
                            <h3 class="fw-bold mb-0 text-primary"><?= $arrTimeStr ?></h3>
                            <small class="text-muted fw-bold">MEL</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3 border-top pt-2">
                        
                        <small class="text-muted">Khai thác bởi <strong><?= $airlineName ?></strong> <?= $airlineSub ? '- ' . $airlineSub : '' ?></small>
                        <a href="#" class="ms-auto small text-primary text-decoration-none">Chi tiết hành trình <i class="fas fa-chevron-right ms-1" style="font-size:10px;"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Right: Class Tabs -->
            <div class="vna-class-tabs d-flex" style="width: 55%;" id="accordion_<?= $flightId ?>">
                <!-- Phổ thông -->
                <div class="vna-tab vna-eco d-flex flex-column justify-content-center align-items-center p-3 text-center" role="button" data-bs-toggle="collapse" data-bs-target="#fare_eco_<?= $flightId ?>" style="flex:1; background-color: #005f6e; color: white; transition: 0.3s; border-left: 1px solid rgba(255,255,255,0.2);">
                    <div class="fw-bold text-uppercase mb-1">Phổ thông</div>
                    <div class="small opacity-75">từ</div>
                    <div class="fs-5 fw-bold mb-1"><?= number_format($ecoSaving, 0, ',', '.') ?></div>
                    <div class="small opacity-75">VND</div>
                    <i class="fas fa-chevron-down mt-2 opacity-50"></i>
                </div>
                <!-- Phổ thông đặc biệt -->
                <div class="vna-tab vna-premium d-flex flex-column justify-content-center align-items-center p-3 text-center" role="button" data-bs-toggle="collapse" data-bs-target="#fare_prem_<?= $flightId ?>" style="flex:1; background-color: #b2c8c4; color: #1e3a5f; transition: 0.3s; border-left: 1px solid rgba(0,0,0,0.1);">
                    <div class="fw-bold text-uppercase mb-1">Phổ thông đặc biệt</div>
                    <div class="small opacity-75">từ</div>
                    <div class="fs-5 fw-bold mb-1"><?= number_format($premiumEco, 0, ',', '.') ?></div>
                    <div class="small opacity-75">VND</div>
                    <i class="fas fa-chevron-down mt-2 opacity-50"></i>
                </div>
                <!-- Thương gia -->
                <div class="vna-tab vna-biz d-flex flex-column justify-content-center align-items-center p-3 text-center" role="button" data-bs-toggle="collapse" data-bs-target="#fare_biz_<?= $flightId ?>" style="flex:1; background-color: #d8a23a; color: #1e3a5f; transition: 0.3s; border-left: 1px solid rgba(0,0,0,0.1);">
                    <div class="fw-bold text-uppercase mb-1">Thương gia</div>
                    <div class="small opacity-75">từ</div>
                    <div class="fs-5 fw-bold mb-1"><?= number_format($bizStandard, 0, ',', '.') ?></div>
                    <div class="small opacity-75">VND</div>
                    <i class="fas fa-chevron-down mt-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Collapsible Fare Families -->
        <div class="collapse-group shadow-sm bg-white rounded-bottom border border-top-0 overflow-hidden" id="accordionContent_<?= $flightId ?>">
            <!-- ECO -->
            <div class="collapse" id="fare_eco_<?= $flightId ?>" data-bs-parent="#accordionContent_<?= $flightId ?>">
                <div class="p-4" style="border-top: 4px solid #005f6e;">
                    <div class="text-center mb-4"><h6 class="text-primary fw-bold">Chọn giá vé <a href="#" class="text-decoration-none ms-2"><i class="fas fa-external-link-alt"></i> Điều kiện giá vé</a></h6></div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-4">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($ecoSaving, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Tiết Kiệm</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-muted">Phí đổi vé 1.600.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 1.800.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 23 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">Không quá 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 60%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($ecoSaving, 'Phổ Thông Tiết Kiệm') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 vna-fare-card border-primary rounded-4 shadow-sm" style="border-width: 2px !important;">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($ecoStandard, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Tiêu Chuẩn</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-muted">Phí đổi vé 1.010.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 1.150.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 23 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">Không quá 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 80%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($ecoStandard, 'Phổ Thông Tiêu Chuẩn') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($ecoFlex, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Linh Hoạt</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 500.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 23 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">Không quá 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 110%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($ecoFlex, 'Phổ Thông Linh Hoạt') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PREMIUM ECO -->
            <div class="collapse" id="fare_prem_<?= $flightId ?>" data-bs-parent="#accordionContent_<?= $flightId ?>">
                <div class="p-4" style="border-top: 4px solid #b2c8c4;">
                    <div class="text-center mb-4"><h6 class="text-primary fw-bold">Chọn giá vé <a href="#" class="text-decoration-none ms-2"><i class="fas fa-external-link-alt"></i> Điều kiện giá vé</a></h6></div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4 border-primary shadow-sm" style="border-width: 2px !important;">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($premiumEco, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Đặc Biệt Tiêu Chuẩn</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 650.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 120%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($premiumEco, 'Phổ Thông Đặc Biệt Tiêu Chuẩn') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($premiumEcoFlex, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Đặc Biệt Linh Hoạt</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 500.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 130%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($premiumEcoFlex, 'Phổ Thông Đặc Biệt Linh Hoạt') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BIZ -->
            <div class="collapse" id="fare_biz_<?= $flightId ?>" data-bs-parent="#accordionContent_<?= $flightId ?>">
                <div class="p-4" style="border-top: 4px solid #d8a23a;">
                    <div class="text-center mb-4"><h6 class="text-primary fw-bold">Chọn giá vé <a href="#" class="text-decoration-none ms-2"><i class="fas fa-external-link-alt"></i> Điều kiện giá vé</a></h6></div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4 border-warning shadow-sm" style="border-width: 2px !important;">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($bizStandard, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Thương Gia Tiêu Chuẩn</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-muted">Phí đổi vé 1.010.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 1.300.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 150%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($bizStandard, 'Thương Gia Tiêu Chuẩn') ?>" class="text-warning fw-bold text-decoration-none" style="color: #d8a23a !important;">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format($bizFlex, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Thương Gia Linh Hoạt</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0 text-start">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3" style="width: 15px;"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 650.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3" style="width: 15px;"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3" style="width: 15px;"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 200%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= $buildUrl($bizFlex, 'Thương Gia Linh Hoạt') ?>" class="text-warning fw-bold text-decoration-none" style="color: #d8a23a !important;">Chọn vé</a>
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
<?php
 require_once '../app/Views/layouts/header.php'; ?>

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

    /* ================= VNA STYLES ================= */
    .vna-tab:hover { opacity: 0.9; cursor:pointer; }
    .vna-fare-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .vna-fare-card.border {
        border-color: #dee2e6 !important;
        border-width: 2px !important;
    }
    .vna-fare-card:hover {
        box-shadow: 0 8px 25px rgba(0, 113, 194, 0.2) !important;
        transform: scale(1.03) !important;
        border-color: #0071c2 !important;
        cursor: pointer;
    }
    .vna-benefits li { font-size: 13px; }
    .vna-flight-row { cursor: pointer; }

</style>

<?php 
    // Thu thập dữ liệu tìm kiếm từ URL
    $dept = $_GET['departure'] ?? 'Hà Nội (HAN)';
    $dest = $_GET['destination'] ?? 'Melbourne (MEL)';
    $date = $_GET['departure_date'] ?? date('Y-m-d', strtotime('+1 day'));
    $adults = $_GET['adults'] ?? 1;
    $children = $_GET['children'] ?? 0;
    $promo = $_GET['promo'] ?? '';
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
            
            

                

            
<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->

<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->
<div id="flightsListContainer">
<?php
renderVnaFlightCard(
    991, 13200000, 
    $dept, $dest, $adults, $children, $promo, 
    '16:00', '04:25<sup class="text-danger">+1</sup>', '12h 25m', '1 điểm dừng',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Vietnam_Airlines_logo.svg/200px-Vietnam_Airlines_logo.svg.png',
    'Vietnam Airlines', ''
);
renderVnaFlightCard(
    994, 12500000, 
    $dept, $dest, $adults, $children, $promo, 
    '05:30', '19:45', '14h 15m', '2+ điểm dừng',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/VietJet_Air_logo.svg/200px-VietJet_Air_logo.svg.png',
    'Vietjet Air', 'Được khai thác một phần bởi Thai Vietjet'
);
renderVnaFlightCard(
    993, 15800000, 
    $dept, $dest, $adults, $children, $promo, 
    '10:00', '20:00', '10h 00m', 'Bay thẳng',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Bamboo_Airways_logo.svg/200px-Bamboo_Airways_logo.svg.png',
    'Bamboo Airways', ''
);
renderVnaFlightCard(
    995, 18573548, 
    $dept, $dest, $adults, $children, $promo, 
    '20:00', '11:00<sup class="text-danger">+1</sup>', '17h 00m', '1 điểm dừng',
    'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/200px-Singapore_Airlines_Logo_2.svg.png',
    'Singapore Airlines', 'Được khai thác một phần bởi Scoot'
);
?>
</div>

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
            priceLabelText.innerHTML = "Lên đến " + formatter.format(this.value) + " đ";
        });
        deptTime.addEventListener("input", function() {
            deptTimeLabel.innerHTML = "Cất cánh 00:00 - " + formatTime(this.value);
        });
        arrTime.addEventListener("input", function() {
            arrTimeLabel.innerHTML = "Hạ cánh 00:00 - " + formatTime(this.value);
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
            if (cards.length === 0) return;
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
                    noFlightMsg.innerHTML = '<i class="fas fa-search-minus fa-3x mb-3 text-muted"></i><h5 class="fw-bold text-dark">Không tìm thấy chuyến bay</h5><p class="mb-0 text-muted">Hãy thử điều chỉnh bộ lọc của bạn.</p>';
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
            if (!container) return;
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
            if(document.getElementById('sortMenuButton')) document.getElementById('sortMenuButton').innerHTML = 'Sort by: ' + dropdownText + ' <i class="fas fa-chevron-down ms-2 text-muted"></i>';
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