<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

// 1. Remove the service-pills that I added previously (because they are redundant with the bottom bar)
$searchPills = <<<EOD
                    <!-- CROSS-SELLING ECOSYSTEM -->
                    <div class="mt-4 pt-4 border-top cross-selling-wrapper">
                        <h6 class="fw-bold text-muted mb-3" style="font-size: 13px; text-transform: uppercase;"><i class="fas fa-star text-warning me-1"></i> Tối ưu chuyến đi của bạn</h6>
                        <div class="d-flex flex-wrap gap-2 service-pills">
                            <button type="button" class="btn-service" onclick="toggleContextualServices()"><i class="fas fa-hotel text-primary"></i> Khách sạn & Tour</button>
                            <button type="button" class="btn-service" data-bs-toggle="offcanvas" data-bs-target="#dutyFreeOffcanvas"><i class="fas fa-shopping-bag text-danger"></i> Mua sắm Miễn Thuế</button>
                            <button type="button" class="btn-service" data-bs-toggle="modal" data-bs-target="#checklistModal"><i class="fas fa-clipboard-check text-success"></i> Trợ lý Nhắc nhở</button>
                            <button type="button" class="btn-service"><i class="fas fa-wifi text-info"></i> eSIM Quốc tế</button>
                            <button type="button" class="btn-service"><i class="fas fa-car text-warning"></i> Đưa đón Sân bay</button>
                        </div>
EOD;

$content = str_replace($searchPills, '                    <!-- CROSS-SELLING ECOSYSTEM (Moved to extra-services) -->', $content);

// 2. We also need to extract the contextualServices div and move it below the extra-services bar
$searchContextual = <<<EOD
                        <!-- KHU VỰC GỢI Ý KHÁCH SẠN & TOUR (Ẩn mặc định, hiện khi bấm) -->
                        <div id="contextualServices" class="mt-4 p-3 rounded-4" style="display: none; background: #f8fbfa; border: 1px dashed #b2bec3;">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div>
                                    <h5 class="fw-bold mb-1" style="color: #005e6a;">Gợi ý dành riêng cho hành trình đến <span id="csDestName" class="text-danger">Melbourne</span></h5>
                                    <p class="text-muted small mb-0"><i class="fas fa-tag text-warning"></i> Đặt kèm để giảm thêm <strong>15% giá vé máy bay</strong>!</p>
                                </div>
                                <button class="btn btn-sm btn-close" onclick="toggleContextualServices()"></button>
                            </div>
                            <div class="cs-carousel-container">
                                <!-- Cards will be injected by JS -->
                                <div class="d-flex gap-3 overflow-auto pb-3 pt-1 px-1" id="csCardWrapper" style="scrollbar-width: thin;"></div>
                            </div>
                        </div>
                    </div>
EOD;

$content = str_replace($searchContextual, '', $content); // Remove it from inside the form

// 3. Update extra-services block and append the contextualServices div below it
$searchExtraServices = <<<EOD
            <!-- VNA STYLE EXTRA SERVICES -->
            <div class="extra-services">
                <a href="javascript:void(0)" class="service-item" id="baggageServiceItem">
                    <i class="fas fa-shopping-bag"></i>
                    <span><?= __('service_nav.baggage') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="upgradeServiceItem">
                    <i class="fas fa-chair"></i>
                    <span><?= __('service_nav.upgrade') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-shopping-cart"></i>
                    <span><?= __('service_nav.shopping') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-building"></i>
                    <span><?= __('service_nav.hotel_tour') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-heartbeat"></i>
                    <span><?= __('service_nav.insurance') ?></span>
                </a>
                <a href="#" class="service-item">
                    <i class="fas fa-ellipsis-h"></i>
                    <span><?= __('service_nav.others') ?></span>
                </a>
            </div>
            
            <!-- SUBMENU DƯỚI EXTRA SERVICES -->
            <div class="service-submenu" id="baggageSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/baggageBuy" class="submenu-link"><?= __('service_nav.baggage_buy') ?></a>
                <a href="<?= BASEURL ?>/service/baggageInfo" class="submenu-link"><?= __('service_nav.baggage_info') ?></a>
            </div>
            
            <div class="service-submenu" id="upgradeSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/seatSelection" class="submenu-link">CHỌN CHỖ NGỒI</a>
                <a href="<?= BASEURL ?>/service/classUpgrade" class="submenu-link">NÂNG HẠNG</a>
                <a href="<?= BASEURL ?>/service/skySofa" class="submenu-link">SKY-SOFA</a>
            </div>
        </div>
EOD;

$replaceExtraServices = <<<EOD
            <!-- VNA STYLE EXTRA SERVICES -->
            <div class="extra-services">
                <a href="javascript:void(0)" class="service-item" id="baggageServiceItem">
                    <i class="fas fa-shopping-bag"></i>
                    <span><?= __('service_nav.baggage') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="upgradeServiceItem">
                    <i class="fas fa-chair"></i>
                    <span><?= __('service_nav.upgrade') ?></span>
                </a>
                <!-- Gắn Offcanvas vào Mua Sắm -->
                <a href="javascript:void(0)" class="service-item" data-bs-toggle="offcanvas" data-bs-target="#dutyFreeOffcanvas">
                    <i class="fas fa-shopping-cart text-danger"></i>
                    <span><?= __('service_nav.shopping') ?></span>
                </a>
                <!-- Gắn hàm toggle vào Khách sạn & Tour -->
                <a href="javascript:void(0)" class="service-item" onclick="toggleContextualServices()">
                    <i class="fas fa-building text-primary"></i>
                    <span><?= __('service_nav.hotel_tour') ?></span>
                </a>
                <!-- Link tới trang Bảo hiểm -->
                <a href="javascript:void(0)" class="service-item" onclick="alert('Vui lòng chọn chuyến bay trước. Bạn có thể thêm bảo hiểm tại bước Thanh Toán.')">
                    <i class="fas fa-shield-alt text-success"></i>
                    <span><?= __('service_nav.insurance') ?></span>
                </a>
                <!-- Gắn Modal Trợ lý vào Dịch vụ khác -->
                <a href="javascript:void(0)" class="service-item" data-bs-toggle="modal" data-bs-target="#checklistModal">
                    <i class="fas fa-clipboard-check text-warning"></i>
                    <span><?= __('service_nav.others') ?></span>
                </a>
            </div>
            
            <!-- SUBMENU DƯỚI EXTRA SERVICES -->
            <div class="service-submenu" id="baggageSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/baggageBuy" class="submenu-link"><?= __('service_nav.baggage_buy') ?></a>
                <a href="<?= BASEURL ?>/service/baggageInfo" class="submenu-link"><?= __('service_nav.baggage_info') ?></a>
            </div>
            
            <div class="service-submenu" id="upgradeSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/seatSelection" class="submenu-link">CHỌN CHỖ NGỒI</a>
                <a href="<?= BASEURL ?>/service/classUpgrade" class="submenu-link">NÂNG HẠNG</a>
                <a href="<?= BASEURL ?>/service/skySofa" class="submenu-link">SKY-SOFA</a>
            </div>
            
            <!-- KHU VỰC GỢI Ý KHÁCH SẠN & TOUR (Ẩn mặc định, hiện khi bấm) -->
            <div id="contextualServices" class="mt-3 p-3 rounded-4" style="display: none; background: rgba(255, 255, 255, 0.9); backdrop-filter: blur(10px); border: 1px dashed #005e6a;">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h5 class="fw-bold mb-1" style="color: #005e6a;"><i class="fas fa-star text-warning me-1"></i> Gợi ý dành riêng cho hành trình đến <span id="csDestName" class="text-danger">Melbourne</span></h5>
                        <p class="text-muted small mb-0"><i class="fas fa-tag text-warning"></i> Đặt kèm để giảm thêm <strong>15% giá vé máy bay</strong>!</p>
                    </div>
                    <button class="btn btn-sm btn-close" onclick="toggleContextualServices()"></button>
                </div>
                <div class="cs-carousel-container">
                    <!-- Cards will be injected by JS -->
                    <div class="d-flex gap-3 overflow-auto pb-3 pt-1 px-1" id="csCardWrapper" style="scrollbar-width: thin;"></div>
                </div>
            </div>
        </div>
EOD;

$content = str_replace($searchExtraServices, $replaceExtraServices, $content);
file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Fixed click issues on Service Bar!";
