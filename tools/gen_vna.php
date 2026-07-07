<?php
function generate_search_php() {
    return <<<'EOD'
<?php
function renderVnaFlightCard(, , , , , , , , , , , , , ) {
     = ;
     =  + ( * 0.20);
     =  + ( * 0.40);
     =  + ( * 0.80);
     =  + ( * 1.0);
     =  * 2.5;
     =  * 3.0;

     = function(, ) use (, , , , , ) {
         = BASEURL . "/booking/checkout?flight_id=" . ;
         .= "&price=" . ;
         .= "&class_name=" . urlencode();
         .= "&dept=" . urlencode() . "&dest=" . urlencode();
         .= "&adults=" .  . "&children=" . ;
        if (!empty())  .= "&promo=" . ;
        return ;
    };
    ?>
    <div class="vna-card-container mb-4 flight-card" data-price="<?=  ?>" data-stops="<?= (=='Bay thẳng')?0:1 ?>" data-dept-time="<?= (float)str_replace(':','.',) ?>" data-arr-time="<?= (float)str_replace(':','.',) ?>" data-duration="<?= (int) ?>" data-airline="<?= substr(,0,2) ?>">
        <!-- Main row -->
        <div class="vna-flight-row d-flex shadow-sm rounded overflow-hidden bg-white border">
            <!-- Left: Flight Info -->
            <div class="vna-flight-info p-4 d-flex align-items-center flex-grow-1" style="width: 45%;">
                <div class="w-100">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <div class="time-block text-start">
                            <h3 class="fw-bold mb-0 text-primary"><?=  ?></h3>
                            <small class="text-muted fw-bold">HAN</small>
                        </div>
                        <div class="duration-block text-center flex-grow-1 px-4">
                            <small class="text-muted d-block mb-1">Thời gian bay <?=  ?></small>
                            <div class="position-relative">
                                <hr class="my-1 border-primary" style="opacity: 0.3;">
                                <i class="fas fa-plane text-warning position-absolute top-50 start-50 translate-middle bg-white px-1"></i>
                            </div>
                            <small class="text-success fw-bold"><?=  ?></small>
                        </div>
                        <div class="time-block text-end">
                            <h3 class="fw-bold mb-0 text-primary"><?=  ?></h3>
                            <small class="text-muted fw-bold">MEL</small>
                        </div>
                    </div>
                    <div class="d-flex align-items-center mt-3 border-top pt-2">
                        <img src="<?=  ?>" alt="<?=  ?>" style="height: 24px;" class="me-2">
                        <small class="text-muted">Khai thác bởi <strong><?=  ?></strong> <?=  ? '- ' .  : '' ?></small>
                        <a href="#" class="ms-auto small text-primary text-decoration-none">Chi tiết hành trình <i class="fas fa-chevron-right ms-1" style="font-size:10px;"></i></a>
                    </div>
                </div>
            </div>
            
            <!-- Right: Class Tabs -->
            <div class="vna-class-tabs d-flex" style="width: 55%;" id="accordion_<?=  ?>">
                <!-- Phổ thông -->
                <div class="vna-tab vna-eco d-flex flex-column justify-content-center align-items-center p-3 text-center cursor-pointer" data-bs-toggle="collapse" data-bs-target="#fare_eco_<?=  ?>" style="flex:1; background-color: #005f6e; color: white; transition: 0.3s; border-left: 1px solid rgba(255,255,255,0.2);">
                    <div class="fw-bold text-uppercase mb-1">Phổ thông</div>
                    <div class="small opacity-75">từ</div>
                    <div class="fs-5 fw-bold mb-1"><?= number_format(, 0, ',', '.') ?></div>
                    <div class="small opacity-75">VND</div>
                    <i class="fas fa-chevron-down mt-2 opacity-50"></i>
                </div>
                <!-- Phổ thông đặc biệt -->
                <div class="vna-tab vna-premium d-flex flex-column justify-content-center align-items-center p-3 text-center cursor-pointer" data-bs-toggle="collapse" data-bs-target="#fare_prem_<?=  ?>" style="flex:1; background-color: #b2c8c4; color: #1e3a5f; transition: 0.3s; border-left: 1px solid rgba(0,0,0,0.1);">
                    <div class="fw-bold text-uppercase mb-1">Phổ thông đặc biệt</div>
                    <div class="small opacity-75">từ</div>
                    <div class="fs-5 fw-bold mb-1"><?= number_format(, 0, ',', '.') ?></div>
                    <div class="small opacity-75">VND</div>
                    <i class="fas fa-chevron-down mt-2 opacity-50"></i>
                </div>
                <!-- Thương gia -->
                <div class="vna-tab vna-biz d-flex flex-column justify-content-center align-items-center p-3 text-center cursor-pointer" data-bs-toggle="collapse" data-bs-target="#fare_biz_<?=  ?>" style="flex:1; background-color: #d8a23a; color: #1e3a5f; transition: 0.3s; border-left: 1px solid rgba(0,0,0,0.1);">
                    <div class="fw-bold text-uppercase mb-1">Thương gia</div>
                    <div class="small opacity-75">từ</div>
                    <div class="fs-5 fw-bold mb-1"><?= number_format(, 0, ',', '.') ?></div>
                    <div class="small opacity-75">VND</div>
                    <i class="fas fa-chevron-down mt-2 opacity-50"></i>
                </div>
            </div>
        </div>

        <!-- Collapsible Fare Families -->
        <div class="collapse-group shadow-sm bg-white rounded-bottom border border-top-0 overflow-hidden" id="accordionContent_<?=  ?>">
            <!-- ECO -->
            <div class="collapse" id="fare_eco_<?=  ?>" data-bs-parent="#accordionContent_<?=  ?>">
                <div class="p-4" style="border-top: 4px solid #005f6e;">
                    <div class="text-center mb-4"><h6 class="text-primary fw-bold">Chọn giá vé <a href="#" class="text-decoration-none ms-2"><i class="fas fa-external-link-alt"></i> Điều kiện giá vé</a></h6></div>
                    <div class="row g-3 justify-content-center">
                        <!-- Tiết kiệm -->
                        <div class="col-md-4">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Tiết Kiệm</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-muted mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-muted">Phí đổi vé 1.600.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 1.800.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 23 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">Không quá 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 60%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Phổ Thông Tiết Kiệm') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <!-- Tiêu chuẩn -->
                        <div class="col-md-4">
                            <div class="card h-100 vna-fare-card border-primary rounded-4 shadow-sm" style="border-width: 2px !important;">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Tiêu Chuẩn</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-muted mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-muted">Phí đổi vé 1.010.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 1.150.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 23 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">Không quá 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 80%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Phổ Thông Tiêu Chuẩn') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <!-- Linh hoạt -->
                        <div class="col-md-4">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Linh Hoạt</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 500.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 23 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">Không quá 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 110%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Phổ Thông Linh Hoạt') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PREMIUM ECO -->
            <div class="collapse" id="fare_prem_<?=  ?>" data-bs-parent="#accordionContent_<?=  ?>">
                <div class="p-4" style="border-top: 4px solid #b2c8c4;">
                    <div class="text-center mb-4"><h6 class="text-primary fw-bold">Chọn giá vé <a href="#" class="text-decoration-none ms-2"><i class="fas fa-external-link-alt"></i> Điều kiện giá vé</a></h6></div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4 border-primary shadow-sm" style="border-width: 2px !important;">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Đặc Biệt Tiêu Chuẩn</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 650.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 120%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Phổ Thông Đặc Biệt Tiêu Chuẩn') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Phổ Thông Đặc Biệt Linh Hoạt</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 500.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 130%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Phổ Thông Đặc Biệt Linh Hoạt') ?>" class="text-primary fw-bold text-decoration-none">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- BIZ -->
            <div class="collapse" id="fare_biz_<?=  ?>" data-bs-parent="#accordionContent_<?=  ?>">
                <div class="p-4" style="border-top: 4px solid #d8a23a;">
                    <div class="text-center mb-4"><h6 class="text-primary fw-bold">Chọn giá vé <a href="#" class="text-decoration-none ms-2"><i class="fas fa-external-link-alt"></i> Điều kiện giá vé</a></h6></div>
                    <div class="row g-3 justify-content-center">
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4 border-warning shadow-sm" style="border-width: 2px !important;">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Thương Gia Tiêu Chuẩn</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-muted mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-muted">Phí đổi vé 1.010.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 1.300.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 150%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Thương Gia Tiêu Chuẩn') ?>" class="text-warning fw-bold text-decoration-none" style="color: #d8a23a !important;">Chọn vé</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="card h-100 vna-fare-card border rounded-4">
                                <div class="card-header bg-transparent text-center border-bottom-0 pt-4 pb-0">
                                    <h4 class="fw-bold mb-1"><?= number_format(, 0, ',', '.') ?> <small class="fs-6 text-muted">VND</small></h4>
                                    <div class="text-muted small">Thương Gia Linh Hoạt</div>
                                </div>
                                <div class="card-body px-4">
                                    <ul class="list-unstyled small vna-benefits mb-0">
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-exchange-alt text-primary mt-1 me-3"></i> <div><strong>Thay đổi vé</strong><br><span class="text-primary">Được phép</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-undo text-muted mt-1 me-3"></i> <div><strong>Hoàn vé</strong><br><span class="text-muted">Phí hoàn 650.000 VND</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-suitcase text-primary mt-1 me-3"></i> <div><strong>Hành lý ký gửi</strong><br><span class="text-primary">1 x 32 kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-shopping-bag text-primary mt-1 me-3"></i> <div><strong>Hành lý xách tay</strong><br><span class="text-primary">2 x 10kg</span></div></li>
                                        <li class="d-flex align-items-start mb-3"><i class="fas fa-star text-warning mt-1 me-3"></i> <div><strong>Số dặm tích được</strong><br><span class="text-warning">Tích lũy 200%</span></div></li>
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent border-top-0 pb-4 px-4 text-center">
                                    <a href="<?= (, 'Thương Gia Linh Hoạt') ?>" class="text-warning fw-bold text-decoration-none" style="color: #d8a23a !important;">Chọn vé</a>
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
EOD;
}
file_put_contents('tools/vna_card.php', generate_search_php());
