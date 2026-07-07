<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$start_marker = '<!-- ================= DESTINATIONS SECTION ================= -->';
$end_marker = '<!-- ================= SEARCH TOP AIRLINES SECTION ================= -->';

$start_pos = strpos($content, $start_marker);
$end_pos = strpos($content, $end_marker);

if ($start_pos !== false && $end_pos !== false) {
    $top_part = substr($content, 0, $start_pos);
    $bottom_part = substr($content, $end_pos);

    $dynamic_html = <<<'EOD'
<!-- ================= QUICK TABS & DESTINATIONS ================= -->
<?php
$quickTabsHTML = '
<div class="d-flex justify-content-center mb-4 quick-tabs-container">
    <button class="btn btn-primary rounded-pill me-2 px-4 shadow-sm" style="background-color: #005e6a; border: none;">Tất cả</button>
    <button class="btn btn-outline-secondary bg-white rounded-pill me-2 px-3 shadow-sm border-0 text-dark">Vé rẻ tháng này</button>
    <button class="btn btn-outline-secondary bg-white rounded-pill me-2 px-3 shadow-sm border-0 text-dark">Điểm đến lãng mạn</button>
    <button class="btn btn-outline-secondary bg-white rounded-pill px-3 shadow-sm border-0 text-dark">Phù hợp gia đình</button>
</div>';
?>

<!-- ================= PERSONALIZED RECOMMENDED SECTION ================= -->
<?php if (isset($recommended) && !empty($recommended['destinations'])): ?>
<div class="container my-5 pt-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold m-0" style="color: #e67e22;"><i class="fas fa-magic me-2"></i> Gợi ý riêng từ <?= htmlspecialchars($recommended['departure']) ?></h3>
    </div>
    <div class="row g-3">
        <?php foreach ($recommended['destinations'] as $dest): 
            $destNameRaw = $dest['destination'];
            $destName = explode(' (', $destNameRaw)[0];
            $shortName = explode(', ', $destName)[0];
            if ($shortName === 'TP Hồ Chí Minh') $shortName = 'Hồ Chí Minh';
            $imgUrl = isset($imageMapping[$shortName]) ? $imageMapping[$shortName] : 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=400&q=80';
        ?>
        <div class="col-6 col-md-4 col-lg-3">
            <a href="<?= BASEURL ?>/flight/search?departure=<?= urlencode($recommended['departure']) ?>&destination=<?= urlencode($destNameRaw) ?><?= $defaultParams ?>" class="text-decoration-none">
                <div class="card border-0 dest-card shadow-sm" style="border-radius: 15px; overflow: hidden; transition: transform 0.3s;">
                    <img src="<?= $imgUrl ?>" class="card-img-top" style="height: 160px; object-fit: cover;" alt="<?= htmlspecialchars($shortName) ?>">
                    <div class="card-body p-3 text-center bg-light">
                        <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($shortName) ?></h6>
                        <small class="text-danger fw-bold"><i class="fas fa-fire me-1"></i><?= number_format($dest['bookings_count']) ?> lượt đặt</small>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>

<!-- ================= DESTINATIONS SECTION ================= -->
<div class="container my-5 <?= isset($recommended) ? 'pt-2' : 'pt-5' ?>">
    <h3 class="fw-bold mb-3 text-center" style="color: #333;"><?= __('home.destinations_vn') ?></h3>
    <?= $quickTabsHTML ?>
    <div class="row g-3">
        <?php if(!empty($topDomestic)): ?>
            <?php foreach ($topDomestic as $dest): 
                $destNameRaw = $dest['destination'];
                $destName = explode(' (', $destNameRaw)[0];
                $destNameParts = explode(', ', $destName);
                $shortName = $destNameParts[0];
                if ($shortName === 'TP Hồ Chí Minh') $shortName = 'Hồ Chí Minh';
                $imgUrl = isset($imageMapping[$shortName]) ? $imageMapping[$shortName] : 'https://images.unsplash.com/photo-1559508551-44bff1de756b?auto=format&fit=crop&w=400&q=80';
            ?>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=<?= urlencode($destNameRaw) ?><?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="<?= $imgUrl ?>" class="card-img-top dest-img" alt="<?= htmlspecialchars($shortName) ?>" style="border-radius: 12px;">
                        <div class="card-body p-0 pt-2 text-center">
                            <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($shortName) ?></h6>
                            <small class="text-muted"><?= number_format($dest['bookings_count']) ?> lượt đặt</small>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted w-100">Đang cập nhật dữ liệu...</p>
        <?php endif; ?>
    </div>
</div>

<!-- ================= INTERNATIONAL DESTINATIONS SECTION ================= -->
<div class="container my-5 pt-3">
    <h3 class="fw-bold mb-3 text-center" style="color: #333;"><?= __('home.destinations_intl') ?></h3>
    <?= $quickTabsHTML ?>
    <div class="row g-3">
        <?php if(!empty($topIntl)): ?>
            <?php foreach ($topIntl as $dest): 
                $destNameRaw = $dest['destination'];
                $destName = explode(' (', $destNameRaw)[0];
                $destNameParts = explode(', ', $destName);
                $shortName = $destNameParts[0];
                $imgUrl = isset($imageMapping[$shortName]) ? $imageMapping[$shortName] : 'https://images.unsplash.com/photo-1436491865332-7a61a109cc05?auto=format&fit=crop&w=400&q=80';
            ?>
            <div class="col-6 col-md-4 col-lg-2">
                <a href="<?= BASEURL ?>/flight/search?departure=&destination=<?= urlencode($destNameRaw) ?><?= $defaultParams ?>" class="text-decoration-none">
                    <div class="card border-0 dest-card">
                        <img src="<?= $imgUrl ?>" class="card-img-top dest-img-intl" alt="<?= htmlspecialchars($shortName) ?>" style="border-radius: 12px;">
                        <div class="card-body p-0 pt-3 text-center">
                            <h6 class="fw-bold text-dark mb-1"><?= htmlspecialchars($shortName) ?></h6>
                            <small class="text-muted"><?= number_format($dest['bookings_count']) ?> lượt đặt</small>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted w-100">Đang cập nhật dữ liệu...</p>
        <?php endif; ?>
    </div>
</div>
    </div> <!-- Close wrapper div if any -->

EOD;

    $fixed = $top_part . $dynamic_html . $bottom_part;
    file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $fixed);
    echo "Replaced static HTML with dynamic blocks successfully!";
} else {
    echo "Could not find markers.";
}
