<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$search = <<<EOD
            <!-- ĐIỂM ĐẾN THU HÚT NHẤT VN -->
            <div class="glass-panel" style="flex: 1;">
                <h3>Các điểm đến thu hút nhất Việt Nam</h3>
                <div class="quick-tabs">
                    <button class="quick-tab active">Tất cả</button>
                    <button class="quick-tab">Vé rẻ tháng này</button>
                    <button class="quick-tab">Điểm đến lãng mạn</button>
                    <button class="quick-tab">Phù hợp gia đình</button>
                </div>
                <div class="dest-grid">
                    <?php if(!empty(\$data['topDomestic'])): ?>
                        <?php foreach (\$data['topDomestic'] as \$dest): 
                            \$destNameRaw = \$dest['destination'];
                            \$shortName = explode(', ', explode(' (', \$destNameRaw)[0])[0];
                            if (\$shortName === 'TP Hồ Chí Minh') \$shortName = 'Hồ Chí Minh';
                            \$imgUrl = isset(\$data['imageMapping'][\$shortName]) ? \$data['imageMapping'][\$shortName] : 'https://images.unsplash.com/photo-1559508551-44bff1de756b?auto=format&fit=crop&w=400&q=80';
                        ?>
                        <a href="<?= BASEURL ?>/flight/search?departure=&destination=<?= urlencode(\$destNameRaw) ?><?= \$defaultParams ?>" class="dest-card-glass">
                            <img src="<?= \$imgUrl ?>" alt="<?= htmlspecialchars(\$shortName) ?>">
                            <div class="info"><h6><?= htmlspecialchars(\$shortName) ?></h6><small><?= number_format(\$dest['bookings_count']) ?> lượt đặt</small></div>
                        </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center w-100">Đang cập nhật...</p>
                    <?php endif; ?>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>
EOD;

$replace = <<<EOD
            <!-- ĐIỂM ĐẾN THU HÚT NHẤT VN -->
            <div class="glass-panel" style="flex: 1;">
                <h3>Các điểm đến thu hút nhất Việt Nam</h3>
                <div class="quick-tabs" id="domesticTabs">
                    <button class="quick-tab active" data-target="dom-all">Tất cả</button>
                    <button class="quick-tab" data-target="dom-cheap">Vé rẻ tháng này</button>
                    <button class="quick-tab" data-target="dom-romantic">Điểm đến lãng mạn</button>
                    <button class="quick-tab" data-target="dom-family">Phù hợp gia đình</button>
                </div>
                
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

                <button class="btn-book-now mt-3">Book Now</button>
            </div>
EOD;

$content = str_replace($search, $replace, $content);

// Add Tab Switching JS Logic
$jsAdd = <<<EOD
        // ================= LOGIC TABS ĐIỂM ĐẾN TRONG NƯỚC =================
        const domTabs = document.querySelectorAll('#domesticTabs .quick-tab');
        const domContents = document.querySelectorAll('.dom-tab-content');
        
        domTabs.forEach(tab => {
            tab.addEventListener('click', function() {
                domTabs.forEach(t => t.classList.remove('active'));
                domContents.forEach(c => c.style.display = 'none');
                
                this.classList.add('active');
                const target = document.getElementById(this.getAttribute('data-target'));
                if (target) target.style.display = target.classList.contains('dest-grid') ? 'grid' : 'block';
            });
        });

EOD;

$content = str_replace('// ================= LOGIC ĐÁNH GIÁ KHÁCH HÀNG =================', $jsAdd . "\n        // ================= LOGIC ĐÁNH GIÁ KHÁCH HÀNG =================", $content);

file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Injected static domestic tab data!";
