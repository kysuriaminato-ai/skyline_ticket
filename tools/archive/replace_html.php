<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$search = <<<'EOD'
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
EOD;

$replace = <<<'EOD'
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
                <a href="javascript:void(0)" class="service-item" id="shoppingServiceItem">
                    <i class="fas fa-shopping-cart"></i>
                    <span><?= __('service_nav.shopping') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="hotelServiceItem">
                    <i class="fas fa-building"></i>
                    <span><?= __('service_nav.hotel_tour') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="insuranceServiceItem">
                    <i class="fas fa-heartbeat"></i>
                    <span><?= __('service_nav.insurance') ?></span>
                </a>
                <a href="javascript:void(0)" class="service-item" id="otherServiceItem">
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

            <div class="service-submenu" id="shoppingSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/shopping" class="submenu-link">SKYLINE DUTY FREE</a>
                <a href="<?= BASEURL ?>/service/souvenir" class="submenu-link">QUÀ LƯU NIỆM</a>
                <a href="<?= BASEURL ?>/service/inflightShopping" class="submenu-link">MUA SẮM TRÊN KHÔNG</a>
            </div>

            <div class="service-submenu" id="hotelSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/hotelBooking" class="submenu-link">ĐẶT PHÒNG KHÁCH SẠN</a>
                <a href="<?= BASEURL ?>/service/tourPackage" class="submenu-link">GÓI NGHỈ DƯỠNG</a>
                <a href="<?= BASEURL ?>/service/carRental" class="submenu-link">THUÊ XE TỰ LÁI</a>
            </div>

            <div class="service-submenu" id="insuranceSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/flightDelayInsurance" class="submenu-link">BẢO HIỂM TRỄ CHUYẾN</a>
                <a href="<?= BASEURL ?>/service/comprehensiveInsurance" class="submenu-link">BẢO HIỂM TOÀN DIỆN</a>
            </div>

            <div class="service-submenu" id="otherSubmenu" style="display: none;">
                <a href="<?= BASEURL ?>/service/loungeAccess" class="submenu-link">PHÒNG CHỜ THƯƠNG GIA</a>
                <a href="<?= BASEURL ?>/service/wheelchair" class="submenu-link">DỊCH VỤ XE ĐẨY</a>
                <a href="<?= BASEURL ?>/service/medicalAssist" class="submenu-link">TRỢ GIÚP Y TẾ</a>
            </div>
EOD;

if (strpos($content, $search) !== false) {
    $content = str_replace($search, $replace, $content);
    file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
    echo "Successfully replaced HTML!";
} else {
    echo "Failed to find the search string in index.php!";
}
