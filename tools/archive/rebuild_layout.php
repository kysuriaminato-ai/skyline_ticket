<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$startMarker = '<!-- ================= CATEGORIES SECTION ================= -->';
$endMarker = '<!-- ================= CLIENT REVIEW SECTION ================= -->';

$startPos = strpos($content, $startMarker);
$endPos = strpos($content, $endMarker);

if ($startPos !== false && $endPos !== false) {
    $before = substr($content, 0, $startPos);
    $after = substr($content, $endPos);
    
    // I need to preserve the dynamic data logic but wrap it in the new aesthetic.
    $newHTML = <<<'EOD'
<!-- ================= GRID LAYOUT ================= -->
<style>
    /* CSS Grid Layout */
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
    }
    .btn-book-now:hover { background-color: #173234; transform: translateY(-2px); color: #fff; }

    /* Categories Specific */
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
        border-radius: 50px; /* Oval shape */
        margin-bottom: 8px;
    }
    .cat-item span { font-size: 11px; font-weight: 600; display: block; line-height: 1.2; }

    /* Quick tabs */
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
    }
    .quick-tab.active, .quick-tab:hover { background: #234b4e; color: #fff; border-color: #234b4e; }

    /* Destination specific */
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

<div class="container mt-5">
    <!-- PERSONALIZED RECOMMENDED SECTION -->
    <?php if (isset($recommended) && !empty($recommended['destinations'])): ?>
    <div class="glass-panel mb-4" style="background: linear-gradient(135deg, #fff0e6, #ffe0cc);">
        <h3 style="color: #d35400;"><i class="fas fa-magic me-2"></i> Gợi ý riêng từ <?= htmlspecialchars($recommended['departure']) ?></h3>
        <div class="dest-grid" style="grid-template-columns: repeat(4, 1fr);">
            <?php foreach ($recommended['destinations'] as $dest): 
                $destNameRaw = $dest['destination'];
                $shortName = explode(', ', explode(' (', $destNameRaw)[0])[0];
                if ($shortName === 'TP Hồ Chí Minh') $shortName = 'Hồ Chí Minh';
                $imgUrl = isset($imageMapping[$shortName]) ? $imageMapping[$shortName] : 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=400&q=80';
            ?>
            <a href="<?= BASEURL ?>/flight/search?departure=<?= urlencode($recommended['departure']) ?>&destination=<?= urlencode($destNameRaw) ?><?= $defaultParams ?>" class="dest-card-glass">
                <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($shortName) ?>">
                <div class="info"><h6><?= htmlspecialchars($shortName) ?></h6><small><i class="fas fa-fire text-danger"></i> <?= number_format($dest['bookings_count']) ?></small></div>
            </a>
            <?php endforeach; ?>
        </div>
    </div>
    <?php endif; ?>

    <div class="dashboard-grid">
        <!-- Cột Trái -->
        <div class="grid-col-left d-flex flex-column" style="gap: 25px;">
            <!-- DANH MỤC -->
            <div class="glass-panel">
                <h3>Danh mục Điểm đến</h3>
                <div class="category-grid">
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1539650116574-8efeb43e2750?auto=format&fit=crop&w=200&q=80" alt="Kim tự tháp"><span>Kim tự tháp</span></a>
                    <a href="#" class="cat-item active"><img src="https://images.unsplash.com/photo-1516466723877-e4ec1d736c8a?auto=format&fit=crop&w=200&q=80" alt="Núi rừng"><span>Núi rừng</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1564507592227-0b0b5c0658e7?auto=format&fit=crop&w=200&q=80" alt="Nhà thờ"><span>Nhà thờ Hồi giáo</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1473580044384-7ba9967e16a0?auto=format&fit=crop&w=200&q=80" alt="Sa mạc"><span>Sa mạc</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1502602898657-3e907a5ea58f?auto=format&fit=crop&w=200&q=80" alt="Tháp"><span>Tháp</span></a>
                    <a href="#" class="cat-item"><img src="https://images.unsplash.com/photo-1507525428034-b723cf961d3e?auto=format&fit=crop&w=200&q=80" alt="Bãi biển"><span>Bãi biển</span></a>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>

            <!-- ĐIỂM ĐẾN PHỔ BIẾN NGOÀI VIỆT NAM -->
            <div class="glass-panel">
                <h3>Các điểm đến phổ biến ngoài Việt Nam</h3>
                <div class="quick-tabs">
                    <button class="quick-tab active">Tất cả</button>
                    <button class="quick-tab">Điểm đến lãng mạn</button>
                    <button class="quick-tab">Phù hợp gia đình</button>
                </div>
                <div class="dest-grid">
                    <?php if(!empty($topIntl)): ?>
                        <?php foreach ($topIntl as $dest): 
                            $destNameRaw = $dest['destination'];
                            $shortName = explode(', ', explode(' (', $destNameRaw)[0])[0];
                            $imgUrl = isset($imageMapping[$shortName]) ? $imageMapping[$shortName] : 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=400&q=80';
                        ?>
                        <a href="<?= BASEURL ?>/flight/search?departure=&destination=<?= urlencode($destNameRaw) ?><?= $defaultParams ?>" class="dest-card-glass">
                            <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($shortName) ?>">
                            <div class="info"><h6><?= htmlspecialchars($shortName) ?></h6><small><?= number_format($dest['bookings_count']) ?> lượt đặt</small></div>
                        </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center w-100">Đang cập nhật...</p>
                    <?php endif; ?>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>
        </div>

        <!-- Cột Phải -->
        <div class="grid-col-right d-flex flex-column" style="gap: 25px;">
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
                    <?php if(!empty($topDomestic)): ?>
                        <?php foreach ($topDomestic as $dest): 
                            $destNameRaw = $dest['destination'];
                            $shortName = explode(', ', explode(' (', $destNameRaw)[0])[0];
                            if ($shortName === 'TP Hồ Chí Minh') $shortName = 'Hồ Chí Minh';
                            $imgUrl = isset($imageMapping[$shortName]) ? $imageMapping[$shortName] : 'https://images.unsplash.com/photo-1559508551-44bff1de756b?auto=format&fit=crop&w=400&q=80';
                        ?>
                        <a href="<?= BASEURL ?>/flight/search?departure=&destination=<?= urlencode($destNameRaw) ?><?= $defaultParams ?>" class="dest-card-glass">
                            <img src="<?= $imgUrl ?>" alt="<?= htmlspecialchars($shortName) ?>">
                            <div class="info"><h6><?= htmlspecialchars($shortName) ?></h6><small><?= number_format($dest['bookings_count']) ?> lượt đặt</small></div>
                        </a>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-center w-100">Đang cập nhật...</p>
                    <?php endif; ?>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>

            <!-- SEARCH TOP AIRLINES -->
            <div class="glass-panel">
                <h3>Search Top Airlines</h3>
                <div class="airlines-carousel-wrapper" style="padding: 0;">
                    <div class="airlines-carousel" style="padding: 10px 0;">
                        <!-- Vietnam Airlines -->
                        <a href="<?= BASEURL ?>/flight/search?airline=vn" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                            <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://vietnamairlines.com" alt="VNA" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name" style="font-size: 13px;">VN Airlines</span>
                        </a>
                        <!-- Vietjet Air -->
                        <a href="<?= BASEURL ?>/flight/search?airline=vj" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                            <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://vietjetair.com" alt="VJ" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name" style="font-size: 13px;">Vietjet Air</span>
                        </a>
                        <!-- Bamboo Airways -->
                        <a href="<?= BASEURL ?>/flight/search?airline=qh" class="airline-pill" style="min-width: 160px; background: rgba(255,255,255,0.7); border: none;">
                            <div class="airline-logo-wrap" style="width: 35px; height: 35px;"><img src="https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://bambooairways.com" alt="QH" style="width: 25px; height: 25px;"></div>
                            <span class="airline-name" style="font-size: 13px;">Bamboo Airways</span>
                        </a>
                    </div>
                </div>
                <button class="btn-book-now">Book Now</button>
            </div>
        </div>
    </div>
</div>

EOD;

    $content = $before . $newHTML . "\n" . $after;
    file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
    echo "Successfully injected grid layout!";
} else {
    echo "Failed to find markers.";
}
