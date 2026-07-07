<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$cssAdd = <<<EOD
    /* Premium Destination Cards */
    .dest-card-premium {
        position: relative;
        display: block;
        border-radius: 15px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        border: 1px solid rgba(255,255,255,0.8);
        transition: 0.4s ease;
        background: #fff;
        height: 160px;
    }
    .dest-card-premium:hover { 
        transform: scale(1.03); 
        box-shadow: 0 10px 25px rgba(27, 58, 57, 0.4); 
        border-color: rgba(27, 58, 57, 0.6); 
        z-index: 10;
    }
    .dest-card-premium img { 
        width: 100%; 
        height: 100%; 
        object-fit: cover; 
        transition: transform 0.6s ease; 
    }
    .dest-card-premium:hover img { 
        transform: scale(1.15); 
    }
    .dest-badge { 
        position: absolute; 
        top: 10px; left: 10px; 
        padding: 4px 10px; 
        font-size: 10px; font-weight: 700; color: #fff; 
        border-radius: 20px; z-index: 2; 
        box-shadow: 0 2px 5px rgba(0,0,0,0.3); 
        letter-spacing: 0.5px;
    }
    .badge-discount { background: linear-gradient(45deg, #e74c3c, #c0392b); }
    .badge-family { background: linear-gradient(45deg, #27ae60, #2ecc71); }
    .badge-romantic { background: linear-gradient(45deg, #9b59b6, #8e44ad); }
    .badge-hot { background: linear-gradient(45deg, #f39c12, #e67e22); }
    
    .dest-card-premium .info { 
        position: absolute; 
        bottom: 0; left: 0; width: 100%; 
        background: linear-gradient(to top, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.6) 60%, transparent 100%); 
        color: #fff; 
        padding: 25px 12px 10px; 
        text-align: left; 
        transition: padding 0.3s ease;
    }
    .dest-card-premium:hover .info {
        padding-bottom: 15px;
    }
    .dest-card-premium h6 { 
        font-size: 16px; font-weight: 800; margin: 0 0 4px; color: #fff; text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    }
    .dest-card-premium .desc { 
        font-size: 11px; color: #eee; margin-bottom: 6px; display: block; line-height: 1.3; 
        opacity: 0.9;
    }
    .dest-card-premium .price-row { 
        display: flex; justify-content: space-between; align-items: center; 
        margin-top: 5px; border-top: 1px solid rgba(255,255,255,0.2); padding-top: 6px;
    }
    .dest-card-premium .price { 
        font-size: 14px; font-weight: 800; color: #f1c40f; 
    }
    .dest-card-premium .book-text {
        font-size: 11px; font-weight: 600; text-transform: uppercase; color: #fff;
    }
    
    .dest-amenities { 
        display: flex; gap: 4px; position: absolute; top: 10px; right: 10px; z-index: 2; 
    }
    .dest-amenities i { 
        background: rgba(255,255,255,0.95); color: #1b3a39; 
        width: 22px; height: 22px; display: flex; align-items: center; justify-content: center; 
        border-radius: 50%; font-size: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.3); 
        transition: 0.3s;
    }
    .dest-card-premium:hover .dest-amenities i {
        background: #1b3a39; color: #fff;
    }
EOD;

$content = str_replace('</style>', $cssAdd . "\n</style>", $content);

$searchHtml = <<<EOD
                <!-- Tab: Tất cả -->
                <div class="dest-grid dom-tab-content active" id="dom-all">
                    <!-- Đà Nẵng -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" alt="Đà Nẵng">
                        <div class="info"><h6>Đà Nẵng</h6><small>Khám phá biển xanh</small></div>
                    </a>
                    <!-- Nha Trang -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1576485290814-1c72ea4ac9cf?auto=format&fit=crop&w=400&q=80" alt="Nha Trang">
                        <div class="info"><h6>Nha Trang</h6><small>Tuyệt tác nghỉ dưỡng</small></div>
                    </a>
                    <!-- Phú Quốc -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Phú Quốc" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1582650893339-71c12eab3a15?auto=format&fit=crop&w=400&q=80" alt="Phú Quốc">
                        <div class="info"><h6>Phú Quốc</h6><small>Đảo ngọc</small></div>
                    </a>
                    <!-- Hà Nội -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Hà Nội" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1599708153386-62bf3f044f51?auto=format&fit=crop&w=400&q=80" alt="Hà Nội">
                        <div class="info"><h6>Hà Nội</h6><small>Ngàn năm văn hiến</small></div>
                    </a>
                    <!-- Huế -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Huế" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1596700510526-a0f5a7e6ea57?auto=format&fit=crop&w=400&q=80" alt="Huế">
                        <div class="info"><h6>Huế</h6><small>Kinh thành cổ kính</small></div>
                    </a>
                    <!-- TP Hồ Chí Minh -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Hồ Chí Minh" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80" alt="TP Hồ Chí Minh">
                        <div class="info"><h6>Hồ Chí Minh</h6><small>Thành phố năng động</small></div>
                    </a>
                </div>

                <!-- Tab: Vé rẻ tháng này -->
                <div class="dom-tab-content" id="dom-cheap" style="display: none;">
                    <div class="alert alert-warning border-0 rounded-4 shadow-sm text-center">
                        <i class="fas fa-percent fa-2x mb-2 text-danger"></i>
                        <h5 class="fw-bold mb-1" style="color: #d35400;">Chào hè 2026</h5>
                        <p class="mb-0">Giảm ngay <strong>30% giá vé</strong> cho tất cả các chặng bay nội địa đặt trong tháng này!</p>
                    </div>
                </div>

                <!-- Tab: Điểm đến lãng mạn -->
                <div class="dest-grid dom-tab-content" id="dom-romantic" style="display: none; grid-template-columns: repeat(2, 1fr);">
                    <!-- Nha Trang -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1533088265057-0b5cda0a6b72?auto=format&fit=crop&w=400&q=80" alt="Tuần trăng mật Nha Trang" style="height: 120px;">
                        <div class="info"><h6>Nha Trang</h6><small>Tuần trăng mật lãng mạn</small></div>
                    </a>
                    <!-- Đà Nẵng -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng" class="dest-card-glass">
                        <img src="https://images.unsplash.com/photo-1620606016666-50d2bb0c41b8?auto=format&fit=crop&w=400&q=80" alt="Đà Nẵng cặp đôi" style="height: 120px;">
                        <div class="info"><h6>Đà Nẵng</h6><small>Khoảnh khắc cặp đôi</small></div>
                    </a>
                </div>

                <!-- Tab: Phù hợp gia đình -->
                <div class="dom-tab-content" id="dom-family" style="display: none;">
                    <div class="alert alert-success border-0 rounded-4 shadow-sm text-center">
                        <i class="fas fa-users fa-2x mb-2 text-success"></i>
                        <h5 class="fw-bold mb-1" style="color: #234b4e;">Kỳ nghỉ Gia đình Trọn vẹn</h5>
                        <p class="mb-0">Nhận ngay ưu đãi <strong>giảm 10% giá vé</strong> khi đặt chỗ cho gia đình từ 3 thành viên trở lên!</p>
                    </div>
                </div>
EOD;

$replaceHtml = <<<EOD
                <!-- Tab: Tất cả -->
                <div class="dest-grid dom-tab-content active" id="dom-all">
                    <!-- Đà Nẵng -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng" class="dest-card-premium">
                        <span class="dest-badge badge-hot">HOT NHẤT</span>
                        <div class="dest-amenities"><i class="fas fa-swimming-pool"></i><i class="fas fa-camera"></i></div>
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" alt="Đà Nẵng">
                        <div class="info">
                            <h6>Đà Nẵng</h6>
                            <span class="desc">Thành phố đáng sống với những cây cầu lung linh.</span>
                            <div class="price-row"><span class="price">Từ 1.250.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                    <!-- Nha Trang -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang" class="dest-card-premium">
                        <div class="dest-amenities"><i class="fas fa-water"></i><i class="fas fa-cocktail"></i></div>
                        <img src="https://images.unsplash.com/photo-1582650893339-71c12eab3a15?auto=format&fit=crop&w=400&q=80" alt="Nha Trang">
                        <div class="info">
                            <h6>Nha Trang</h6>
                            <span class="desc">Hòn ngọc viễn đông, bãi biển hoang sơ tuyệt đẹp.</span>
                            <div class="price-row"><span class="price">Từ 1.100.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                    <!-- Phú Quốc -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Phú Quốc" class="dest-card-premium">
                        <span class="dest-badge badge-family">GIA ĐÌNH</span>
                        <div class="dest-amenities"><i class="fas fa-umbrella-beach"></i><i class="fas fa-fish"></i></div>
                        <img src="https://images.unsplash.com/photo-1695449767812-70b13cf4a4bc?auto=format&fit=crop&w=400&q=80" alt="Phú Quốc">
                        <div class="info">
                            <h6>Phú Quốc</h6>
                            <span class="desc">Thiên đường đảo ngọc vẫy gọi gia đình bạn.</span>
                            <div class="price-row"><span class="price">Từ 1.500.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                    <!-- Hà Nội -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Hà Nội" class="dest-card-premium">
                        <div class="dest-amenities"><i class="fas fa-monument"></i><i class="fas fa-utensils"></i></div>
                        <img src="https://images.unsplash.com/photo-1599708153386-62bf3f044f51?auto=format&fit=crop&w=400&q=80" alt="Hà Nội">
                        <div class="info">
                            <h6>Hà Nội</h6>
                            <span class="desc">Trải nghiệm nét đẹp ngàn năm văn hiến.</span>
                            <div class="price-row"><span class="price">Từ 950.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                    <!-- Huế -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Huế" class="dest-card-premium">
                        <span class="dest-badge badge-romantic">LÃNG MẠN</span>
                        <div class="dest-amenities"><i class="fas fa-bicycle"></i><i class="fas fa-camera"></i></div>
                        <img src="https://images.unsplash.com/photo-1596700510526-a0f5a7e6ea57?auto=format&fit=crop&w=400&q=80" alt="Huế">
                        <div class="info">
                            <h6>Huế</h6>
                            <span class="desc">Chút mộng mơ bên dòng sông Hương êm đềm.</span>
                            <div class="price-row"><span class="price">Từ 850.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                    <!-- TP Hồ Chí Minh -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Hồ Chí Minh" class="dest-card-premium">
                        <div class="dest-amenities"><i class="fas fa-city"></i><i class="fas fa-shopping-bag"></i></div>
                        <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80" alt="TP Hồ Chí Minh">
                        <div class="info">
                            <h6>Hồ Chí Minh</h6>
                            <span class="desc">Nhịp sống sôi động không ngủ của Sài Thành.</span>
                            <div class="price-row"><span class="price">Từ 1.150.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                </div>

                <!-- Tab: Vé rẻ tháng này -->
                <div class="dest-grid dom-tab-content" id="dom-cheap" style="display: none;">
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Lạt" class="dest-card-premium">
                        <span class="dest-badge badge-discount">GIẢM 30%</span>
                        <div class="dest-amenities"><i class="fas fa-coins"></i><i class="fas fa-leaf"></i></div>
                        <img src="https://images.unsplash.com/photo-1620606016666-50d2bb0c41b8?auto=format&fit=crop&w=400&q=80" alt="Đà Lạt">
                        <div class="info">
                            <h6>Đà Lạt</h6>
                            <span class="desc">Săn mây giá hời đón không khí se lạnh.</span>
                            <div class="price-row"><span class="price" style="color: #e74c3c;"><del style="font-size:10px;color:#ccc;">1.500k</del> 950.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Phú Yên" class="dest-card-premium">
                        <span class="dest-badge badge-discount">GIẢM 20%</span>
                        <div class="dest-amenities"><i class="fas fa-coins"></i><i class="fas fa-water"></i></div>
                        <img src="https://images.unsplash.com/photo-1591873832811-92576b539c3e?auto=format&fit=crop&w=400&q=80" alt="Phú Yên">
                        <div class="info">
                            <h6>Phú Yên</h6>
                            <span class="desc">Hoa vàng trên cỏ xanh vẫy gọi.</span>
                            <div class="price-row"><span class="price" style="color: #e74c3c;"><del style="font-size:10px;color:#ccc;">1.200k</del> 890.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-arrow-right"></i></span></div>
                        </div>
                    </a>
                </div>

                <!-- Tab: Điểm đến lãng mạn -->
                <div class="dest-grid dom-tab-content" id="dom-romantic" style="display: none; grid-template-columns: repeat(2, 1fr);">
                    <!-- Nha Trang -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang" class="dest-card-premium">
                        <span class="dest-badge badge-romantic"><i class="fas fa-heart"></i> LÃNG MẠN</span>
                        <div class="dest-amenities"><i class="fas fa-wine-glass-alt"></i><i class="fas fa-spa"></i></div>
                        <img src="https://images.unsplash.com/photo-1695449767812-70b13cf4a4bc?auto=format&fit=crop&w=400&q=80" alt="Nha Trang lãng mạn">
                        <div class="info">
                            <h6>Nha Trang</h6>
                            <span class="desc">Tuần trăng mật riêng tư, tiệc tối dưới ánh nến lãng mạn.</span>
                            <div class="price-row"><span class="price">Từ 1.100.000đ</span><span class="book-text">Khám phá <i class="fas fa-heart"></i></span></div>
                        </div>
                    </a>
                    <!-- Đà Nẵng -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng" class="dest-card-premium">
                        <span class="dest-badge badge-romantic"><i class="fas fa-heart"></i> CẶP ĐÔI</span>
                        <div class="dest-amenities"><i class="fas fa-camera-retro"></i><i class="fas fa-coffee"></i></div>
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" alt="Đà Nẵng cặp đôi">
                        <div class="info">
                            <h6>Đà Nẵng</h6>
                            <span class="desc">Cùng người thương nắm tay dạo bước Bà Nà Hills.</span>
                            <div class="price-row"><span class="price">Từ 1.250.000đ</span><span class="book-text">Khám phá <i class="fas fa-heart"></i></span></div>
                        </div>
                    </a>
                </div>

                <!-- Tab: Phù hợp gia đình -->
                <div class="dest-grid dom-tab-content" id="dom-family" style="display: none;">
                    <!-- Phú Quốc -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Phú Quốc" class="dest-card-premium">
                        <span class="dest-badge badge-family">GIẢM 10% GIA ĐÌNH</span>
                        <div class="dest-amenities"><i class="fas fa-child"></i><i class="fas fa-swimming-pool"></i></div>
                        <img src="https://images.unsplash.com/photo-1582650893339-71c12eab3a15?auto=format&fit=crop&w=400&q=80" alt="Phú Quốc">
                        <div class="info">
                            <h6>Phú Quốc</h6>
                            <span class="desc">Safari hoang dã & công viên nước khổng lồ cho bé.</span>
                            <div class="price-row"><span class="price">Từ 1.350.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-users"></i></span></div>
                        </div>
                    </a>
                    <!-- Nha Trang -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang" class="dest-card-premium">
                        <span class="dest-badge badge-family">GIA ĐÌNH</span>
                        <div class="dest-amenities"><i class="fas fa-umbrella-beach"></i><i class="fas fa-gamepad"></i></div>
                        <img src="https://images.unsplash.com/photo-1576485290814-1c72ea4ac9cf?auto=format&fit=crop&w=400&q=80" alt="Nha Trang">
                        <div class="info">
                            <h6>Nha Trang</h6>
                            <span class="desc">Nghỉ dưỡng trọn gói All-inclusive cực kỳ thảnh thơi.</span>
                            <div class="price-row"><span class="price">Từ 1.100.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-users"></i></span></div>
                        </div>
                    </a>
                    <!-- Đà Nẵng -->
                    <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng" class="dest-card-premium">
                        <span class="dest-badge badge-family">GIA ĐÌNH</span>
                        <div class="dest-amenities"><i class="fas fa-sun"></i><i class="fas fa-ice-cream"></i></div>
                        <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" alt="Đà Nẵng">
                        <div class="info">
                            <h6>Đà Nẵng</h6>
                            <span class="desc">Tiện nghi, an toàn và ngập tràn trò chơi thú vị.</span>
                            <div class="price-row"><span class="price">Từ 1.250.000đ</span><span class="book-text">Đặt ngay <i class="fas fa-users"></i></span></div>
                        </div>
                    </a>
                </div>
EOD;

$content = str_replace($searchHtml, $replaceHtml, $content);
file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "UI upgraded successfully!";
