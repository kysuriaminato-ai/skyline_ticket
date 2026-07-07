<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

// Replace the missing IDs in the extra services container
$content = str_replace(
    '<a href="#" class="service-item">
                    <i class="fas fa-shopping-cart"></i>',
    '<a href="javascript:void(0)" class="service-item" id="shoppingServiceItem">
                    <i class="fas fa-shopping-cart"></i>',
    $content
);

$content = str_replace(
    '<a href="#" class="service-item">
                    <i class="fas fa-building"></i>',
    '<a href="javascript:void(0)" class="service-item" id="hotelServiceItem">
                    <i class="fas fa-building"></i>',
    $content
);

$content = str_replace(
    '<a href="#" class="service-item">
                    <i class="fas fa-heartbeat"></i>',
    '<a href="javascript:void(0)" class="service-item" id="insuranceServiceItem">
                    <i class="fas fa-heartbeat"></i>',
    $content
);

$content = str_replace(
    '<a href="#" class="service-item">
                    <i class="fas fa-ellipsis-h"></i>',
    '<a href="javascript:void(0)" class="service-item" id="otherServiceItem">
                    <i class="fas fa-ellipsis-h"></i>',
    $content
);

// Add the missing submenus
$submenus = <<<'EOD'
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
        </div>
    </div>
    </section>
EOD;

$content = str_replace(
    "        </div>\n    </div>\n    </section>",
    $submenus,
    $content
);

file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Injected submenus and updated IDs.";
