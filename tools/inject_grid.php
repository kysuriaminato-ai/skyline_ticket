<?php
$file = 'c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php';
$content = file_get_contents($file);

$startMarker = '        <!-- ================= CATEGORIES SECTION ================= -->';
$endMarker = '    <!-- ================= CLIENT REVIEW SECTION ================= -->';

$startPos = strpos($content, $startMarker);
$endPos = strpos($content, $endMarker);

if ($startPos === false || $endPos === false) {
    echo "ERROR: Could not find markers.\n";
    echo "Start: " . ($startPos !== false ? "FOUND at $startPos" : "NOT FOUND") . "\n";
    echo "End: " . ($endPos !== false ? "FOUND at $endPos" : "NOT FOUND") . "\n";
    
    // Try alternate markers
    $startMarker2 = '<!-- ================= CATEGORIES SECTION ================= -->';
    $endMarker2 = '<!-- ================= CLIENT REVIEW SECTION ================= -->';
    $startPos = strpos($content, $startMarker2);
    $endPos = strpos($content, $endMarker2);
    echo "Alt Start: " . ($startPos !== false ? "FOUND at $startPos" : "NOT FOUND") . "\n";
    echo "Alt End: " . ($endPos !== false ? "FOUND at $endPos" : "NOT FOUND") . "\n";
    
    if ($startPos === false || $endPos === false) {
        exit("Aborting.\n");
    }
}

$before = substr($content, 0, $startPos);
$after = substr($content, $endPos);

$gridHTML = <<<'EOD'
<!-- ================= GRID LAYOUT 2x2 ================= -->
<style>
    .dashboard-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
        margin-bottom: 50px;
    }
    .glass-panel {
        background: linear-gradient(135deg, #dae7e3 0%, #b8cfcf 100%);
        border-radius: 20px;
        padding: 30px;
        position: relative;
        display: flex;
        flex-direction: column;
        box-shadow: inset 2px 2px 5px rgba(255,255,255,0.7), 0 10px 20px rgba(0,0,0,0.05);
    }
    .glass-panel h3 {
        font-size: 20px;
        font-weight: 700;
        color: #1b3a39;
        margin-bottom: 25px;
        font-family: serif;
    }
    .btn-book-now {
        margin-top: auto;
        align-self: center;
        background-color: #234b4e;
        color: #fff;
        border-radius: 20px;
        padding: 8px 30px;
        font-size: 14px;
        font-weight: 600;
        text-transform: none;
        border: none;
        box-shadow: 0 4px 10px rgba(35,75,78,0.3);
        transition: 0.3s;
        text-decoration: none;
        display: inline-block;
    }
    .btn-book-now:hover { background-color: #173234; transform: translateY(-2px); color: #fff; }

    .category-grid {
        display: grid;
        grid-template-columns: repeat(6, 1fr);
        gap: 10px;
        margin-bottom: 20px;
    }
    .cat-item {
        background: rgba(255,255,255,0.6);
        border-radius: 12px;
        padding: 10px 5px;
        text-align: center;
        text-decoration: none;
        color: #333;
        transition: 0.3s;
        border: 1px solid rgba(255,255,255,0.8);
    }
    .cat-item:hover, .cat-item.active { background: rgba(255,255,255,0.9); transform: translateY(-5px); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .cat-item img {
        width: 100%;
        height: 70px;
        object-fit: cover;
        border-radius: 50px;
        margin-bottom: 8px;
    }
    .cat-item span { font-size: 11px; font-weight: 600; display: block; line-height: 1.2; }

    .quick-tabs { display: flex; gap: 8px; margin-bottom: 20px; flex-wrap: wrap; }
    .quick-tab {
        background: transparent;
        border: 1px solid #7c9b9b;
        color: #333;
        border-radius: 20px;
        padding: 5px 15px;
        font-size: 12px;
        font-weight: 600;
        transition: 0.3s;
        cursor: pointer;
    }
    .quick-tab.active, .quick-tab:hover { background: #234b4e; color: #fff; border-color: #234b4e; }

    .dest-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 15px;
        margin-bottom: 20px;
    }
    .dest-card-glass {
        background: rgba(255,255,255,0.5);
        border-radius: 12px;
        overflow: hidden;
        text-decoration: none;
        color: inherit;
        border: 1px solid rgba(255,255,255,0.8);
        transition: 0.3s;
    }
    .dest-card-glass:hover { transform: translateY(-5px); background: rgba(255,255,255,0.8); box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
    .dest-card-glass img { width: 100%; height: 90px; object-fit: cover; }
    .dest-card-glass .info { padding: 8px; text-align: center; }
    .dest-card-glass h6 { font-size: 12px; font-weight: 700; margin: 0; color: #1b3a39; }
    .dest-card-glass small { font-size: 10px; color: #555; }

    @media (max-width: 992px) { .dashboard-grid { grid-template-columns: 1fr; } .category-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 576px) { .dest-grid { grid-template-columns: repeat(2, 1fr); } }
</style>

<?php
    $tomorrow = date('Y-m-d', strtotime('+1 day'));
    $defaultParams = "&departure_date=$tomorrow&adults=2&children=0";
?>

<div class="container mt-5">
    <div class="dashboard-grid">
        <!-- Ô 1: DANH MỤC ĐIỂM ĐẾN -->
        <div class="glass-panel">
            <h3>Danh mục Điểm đến</h3>
            <div class="category-grid">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Cairo (CAI)<?= $defaultParams ?>" class="cat-item">
                    <img src="https://images.unsplash.com/photo-1539667468225-eebb663053e6?auto=format&fit=crop&w=200&q=80" alt="Kim tự tháp">
                    <span>Kim tự tháp</span>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Kathmandu (KTM)<?= $defaultParams ?>" class="cat-item">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?auto=format&fit=crop&w=200&q=80" alt="Núi rừng">
                    <span>Núi rừng</span>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Delhi (DEL)<?= $defaultParams ?>" class="cat-item">
                    <img src="https://images.unsplash.com/photo-1524492412937-b28074a5d7da?auto=format&fit=crop&w=200&q=80" alt="Nhà thờ Hồi giáo">
                    <span>Nhà thờ Hồi giáo</span>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Dubai (DXB)<?= $defaultParams ?>" class="cat-item">
                    <img src="https://images.unsplash.com/photo-1473580044384-7ba9967e16a0?auto=format&fit=crop&w=200&q=80" alt="Sa mạc">
                    <span>Sa mạc</span>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Paris, Pháp (CDG)<?= $defaultParams ?>" class="cat-item">
                    <img src="https://images.unsplash.com/photo-1511739001486-6bfe10ce785f?auto=format&fit=crop&w=200&q=80" alt="Tháp">
                    <span>Tháp</span>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Denpasar (DPS)<?= $defaultParams ?>" class="cat-item">
                    <img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=200&q=80" alt="Bãi biển">
                    <span>Bãi biển</span>
                </a>
            </div>
            <a href="<?= BASEURL ?>/flight/search" class="btn-book-now">Book Now</a>
        </div>

        <!-- Ô 2: ĐIỂM ĐẾN THU HÚT NHẤT VIỆT NAM -->
        <div class="glass-panel">
            <h3>Các điểm đến thu hút nhất Việt Nam</h3>
            <div class="quick-tabs" id="vnTabs">
                <button class="quick-tab active" data-tab="all">Tất cả</button>
                <button class="quick-tab" data-tab="cheap">Vé rẻ tháng này</button>
                <button class="quick-tab" data-tab="romantic">Điểm đến lãng mạn</button>
                <button class="quick-tab" data-tab="family">Phù hợp gia đình</button>
            </div>
            <div class="dest-grid" id="vnDestGrid">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Đà Nẵng (DAD)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all cheap romantic">
                    <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" alt="Đà Nẵng">
                    <div class="info"><h6>Đà Nẵng</h6><small>5.534 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Nha Trang (CXR)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all cheap romantic">
                    <img src="https://images.unsplash.com/photo-1581337204873-ef36aa186caa?auto=format&fit=crop&w=400&q=80" alt="Nha Trang">
                    <div class="info"><h6>Nha Trang</h6><small>4.320 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Phú Quốc (PQC)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all family romantic">
                    <img src="https://images.unsplash.com/photo-1528127269322-539801943592?auto=format&fit=crop&w=400&q=80" alt="Phú Quốc">
                    <div class="info"><h6>Phú Quốc</h6><small>8.124 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Hà Nội (HAN)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all family">
                    <img src="https://images.unsplash.com/photo-1509060464153-44667396260f?auto=format&fit=crop&w=400&q=80" alt="Hà Nội">
                    <div class="info"><h6>Hà Nội</h6><small>10.744 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=TP Hồ Chí Minh (SGN)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all cheap family">
                    <img src="https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80" alt="Hồ Chí Minh">
                    <div class="info"><h6>Hồ Chí Minh</h6><small>15.546 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Huế (HUI)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all romantic">
                    <img src="https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80" alt="Huế">
                    <div class="info"><h6>Huế</h6><small>3.210 chuyến bay</small></div>
                </a>
            </div>
            <a href="<?= BASEURL ?>/flight/search" class="btn-book-now">Book Now</a>
        </div>

        <!-- Ô 3: ĐIỂM ĐẾN PHỔ BIẾN NGOÀI VIỆT NAM -->
        <div class="glass-panel">
            <h3>Các điểm đến phổ biến ngoài Việt Nam</h3>
            <div class="quick-tabs" id="intlTabs">
                <button class="quick-tab active" data-tab="all">Tất cả</button>
                <button class="quick-tab" data-tab="romantic">Điểm đến lãng mạn</button>
                <button class="quick-tab" data-tab="family">Phù hợp gia đình</button>
            </div>
            <div class="dest-grid" id="intlDestGrid">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Bangkok (BKK)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all romantic family">
                    <img src="https://images.unsplash.com/photo-1504214208698-ea1916a2195a?auto=format&fit=crop&w=400&q=80" alt="Bangkok">
                    <div class="info"><h6>Bangkok</h6><small>12.048 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Tokyo (NRT)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all romantic">
                    <img src="https://images.unsplash.com/photo-1503899036084-c55cdd92da26?auto=format&fit=crop&w=400&q=80" alt="Tokyo">
                    <div class="info"><h6>Tokyo</h6><small>12.486 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Dubai (DXB)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all family">
                    <img src="https://images.unsplash.com/photo-1512453979798-5ea266f8880c?auto=format&fit=crop&w=400&q=80" alt="Dubai">
                    <div class="info"><h6>Dubai</h6><small>19.464 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Kuala Lumpur (KUL)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all family">
                    <img src="https://images.unsplash.com/photo-1508062878650-88b52897f298?auto=format&fit=crop&w=400&q=80" alt="Kuala Lumpur">
                    <div class="info"><h6>Kuala Lumpur</h6><small>19.902 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Manila (MNL)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all">
                    <img src="https://images.unsplash.com/photo-1518509562904-e7ef99cdcc86?auto=format&fit=crop&w=400&q=80" alt="Manila">
                    <div class="info"><h6>Manila</h6><small>13.223 chuyến bay</small></div>
                </a>
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=Jakarta (CGK)<?= $defaultParams ?>" class="dest-card-glass" data-tags="all family">
                    <img src="https://images.unsplash.com/photo-1555899434-94d1368aa7af?auto=format&fit=crop&w=400&q=80" alt="Jakarta">
                    <div class="info"><h6>Jakarta</h6><small>14.249 chuyến bay</small></div>
                </a>
            </div>
            <a href="<?= BASEURL ?>/flight/search" class="btn-book-now">Book Now</a>
        </div>

        <!-- Ô 4: SEARCH TOP AIRLINES -->
        <div class="glass-panel">
            <h3>Search Top Airlines</h3>
            <div class="airlines-carousel-wrapper" style="padding: 0;">
                <div class="airlines-carousel" id="airlinesCarousel" style="padding: 10px 0;">
                    <a href="<?= BASEURL ?>/flight/search?airline=vietnam-airlines" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                        <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://upload.wikimedia.org/wikipedia/vi/thumb/e/e1/Vietnam_Airlines_Logo_-_Bi%E1%BB%83u_t%C6%B0%E1%BB%A3ng_c%E1%BB%A7a_Vietnam_Airlines.svg/1200px-Vietnam_Airlines_Logo_-_Bi%E1%BB%83u_t%C6%B0%E1%BB%A3ng_c%E1%BB%A7a_Vietnam_Airlines.svg.png" alt="VNA" style="width: 25px; height: 25px;"></div>
                        <span class="airline-name" style="font-size: 13px;">VN Airlines</span>
                    </a>
                    <a href="<?= BASEURL ?>/flight/search?airline=vietjet-air" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                        <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/VietJet_Air_logo.svg/2560px-VietJet_Air_logo.svg.png" alt="VJ" style="width: 25px; height: 25px;"></div>
                        <span class="airline-name" style="font-size: 13px;">Vietjet Air</span>
                    </a>
                    <a href="<?= BASEURL ?>/flight/search?airline=bamboo-airways" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                        <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Bamboo_Airways_logo.svg/2560px-Bamboo_Airways_logo.svg.png" alt="QH" style="width: 25px; height: 25px;"></div>
                        <span class="airline-name" style="font-size: 13px;">Bamboo Airways</span>
                    </a>
                </div>
            </div>
            <a href="<?= BASEURL ?>/flight/search" class="btn-book-now">Book Now</a>
        </div>
    </div>
</div>

<script>
// Tab filtering for VN destinations
document.querySelectorAll('#vnTabs .quick-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('#vnTabs .quick-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        const filter = this.getAttribute('data-tab');
        document.querySelectorAll('#vnDestGrid .dest-card-glass').forEach(card => {
            const tags = card.getAttribute('data-tags') || '';
            card.style.display = tags.includes(filter) ? '' : 'none';
        });
    });
});

// Tab filtering for International destinations
document.querySelectorAll('#intlTabs .quick-tab').forEach(tab => {
    tab.addEventListener('click', function() {
        document.querySelectorAll('#intlTabs .quick-tab').forEach(t => t.classList.remove('active'));
        this.classList.add('active');
        const filter = this.getAttribute('data-tab');
        document.querySelectorAll('#intlDestGrid .dest-card-glass').forEach(card => {
            const tags = card.getAttribute('data-tags') || '';
            card.style.display = tags.includes(filter) ? '' : 'none';
        });
    });
});
</script>

EOD;

$content = $before . $gridHTML . "\n" . $after;
file_put_contents($file, $content);
echo "Successfully injected 2x2 grid layout!\n";
