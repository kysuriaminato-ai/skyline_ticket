<?php
$c = file_get_contents('app/Views/flights/search.php');

$replacement = "
<!-- INFO BAR -->
<div class=\"mb-3 text-muted small bg-white p-2 rounded shadow-sm border\">
    <i class=\"fas fa-info-circle text-primary me-1\"></i> Giá trung bình mỗi người. Giá đã bao gồm thuế và phí.
</div>
<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->
<?php
renderVnaFlightCard(
    991, 13200000, 
    \, \, \, \, \, 
    '16:00', '04:25<sup class=\"text-danger\">+1</sup>', '12h 25m', '1 điểm dừng',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Vietnam_Airlines_logo.svg/200px-Vietnam_Airlines_logo.svg.png',
    'Vietnam Airlines', ''
);
renderVnaFlightCard(
    994, 12500000, 
    \, \, \, \, \, 
    '05:30', '19:45', '14h 15m', '2+ điểm dừng',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/VietJet_Air_logo.svg/200px-VietJet_Air_logo.svg.png',
    'Vietjet Air', 'Được khai thác một phần bởi Thai Vietjet'
);
renderVnaFlightCard(
    993, 15800000, 
    \, \, \, \, \, 
    '10:00', '20:00', '10h 00m', 'Bay thẳng',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Bamboo_Airways_logo.svg/200px-Bamboo_Airways_logo.svg.png',
    'Bamboo Airways', ''
);
renderVnaFlightCard(
    995, 18573548, 
    \, \, \, \, \, 
    '20:00', '11:00<sup class=\"text-danger\">+1</sup>', '17h 00m', '1 điểm dừng',
    'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/200px-Singapore_Airlines_Logo_2.svg.png',
    'Singapore Airlines', 'Được khai thác một phần bởi Scoot'
);
?>
";

$c = preg_replace('/<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->.*?<!-- Hết Cột Phải -->/is', $replacement . "\n            </div> <!-- Hết Cột Phải -->", $c);

// CSS
$css = "
    /* ================= VNA STYLES ================= */
    .vna-tab:hover { opacity: 0.9; cursor:pointer; }
    .vna-fare-card { transition: 0.3s; }
    .vna-fare-card:hover { box-shadow: 0 5px 15px rgba(0,0,0,0.1); transform: translateY(-2px); }
    .vna-benefits li { font-size: 13px; }
    .vna-flight-row { cursor: pointer; }
";
$c = str_replace("<style>\n", "<style>\n$css", $c);

// Fix PHP tag
$c = str_replace("?> require_once '../app/Views/layouts/header.php'; ?>", "<?php require_once '../app/Views/layouts/header.php'; ?>", $c);

// Translations
$c = str_replace('>Search<', '>Tìm kiếm<', $c);
$c = str_replace('>Stops<', '>Điểm dừng<', $c);
$c = str_replace('>Direct<', '>Bay thẳng<', $c);
$c = str_replace('>1 Stop<', '>1 điểm dừng<', $c);
$c = str_replace('>2+ Stops<', '>2+ điểm dừng<', $c);
$c = str_replace('>Clear<', '>Xóa<', $c);
$c = str_replace('>Times<', '>Thời gian<', $c);
$c = str_replace('>Take-off<', '>Cất cánh<', $c);
$c = str_replace('>Landing<', '>Hạ cánh<', $c);
$c = str_replace('Price per person', 'Giá mỗi người', $c);
$c = str_replace('>Airlines<', '>Hãng hàng không<', $c);
$c = str_replace('"Cheapest"', '"Rẻ nhất"', $c);
$c = str_replace('>Cheapest<', '>Rẻ nhất<', $c);
$c = str_replace('"Best"', '"Tốt nhất"', $c);
$c = str_replace('>Best<', '>Tốt nhất<', $c);
$c = str_replace('"Fastest"', '"Nhanh nhất"', $c);
$c = str_replace('>Fastest<', '>Nhanh nhất<', $c);
$c = str_replace('Cabin bag', 'Hành lý xách tay', $c);
$c = str_replace('Checked baggage', 'Hành lý ký gửi', $c);
$c = str_replace('Sort by:', 'Sắp xếp:', $c);
$c = str_replace('Total journey time', 'Tổng thời gian bay', $c);
$c = str_replace("'Sort by: '", "'Sắp xếp: '", $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Replaced properly";
