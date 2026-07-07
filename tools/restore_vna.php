<?php
$c = file_get_contents('app/Views/flights/search.php');

$css = "
    /* ================= VNA STYLES ================= */
    .vna-tab:hover { opacity: 0.9; cursor:pointer; }
    .vna-fare-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    .vna-fare-card.border {
        border-color: #dee2e6 !important;
        border-width: 2px !important;
    }
    .vna-fare-card:hover {
        box-shadow: 0 8px 25px rgba(0, 113, 194, 0.2) !important;
        transform: scale(1.03) !important;
        border-color: #0071c2 !important;
        cursor: pointer;
    }
    .vna-benefits li { font-size: 13px; }
    .vna-flight-row { cursor: pointer; }
";

if (strpos($c, '.vna-tab:hover') === false) {
    $c = str_replace("</style>", "$css\n</style>", $c);
}

// Inject function definition at top if not exists
$vna_card = file_get_contents('tools/vna_card.php');
if (strpos($c, 'function renderVnaFlightCard') === false) {
    $vna_card = str_replace("}\n?>", "}\n?>\n<?php\n", $vna_card);
    $c = preg_replace('/<\?php/', $vna_card, $c, 1);
}

$replacement = '
<!-- INFO BAR -->
<div class="mb-3 text-muted small bg-white p-2 rounded shadow-sm border">
    <i class="fas fa-info-circle text-primary me-1"></i> Giá trung bình mỗi người. Giá đã bao gồm thuế và phí.
</div>
<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->
<div id="flightsListContainer">
<?php
renderVnaFlightCard(
    991, 13200000, 
    $dept, $dest, $adults, $children, $promo, 
    \'16:00\', \'04:25<sup class="text-danger">+1</sup>\', \'12h 25m\', \'1 điểm dừng\',
    \'https://upload.wikimedia.org/wikipedia/commons/thumb/1/1a/Vietnam_Airlines_logo.svg/200px-Vietnam_Airlines_logo.svg.png\',
    \'Vietnam Airlines\', \'\'
);
renderVnaFlightCard(
    994, 12500000, 
    $dept, $dest, $adults, $children, $promo, 
    \'05:30\', \'19:45\', \'14h 15m\', \'2+ điểm dừng\',
    \'https://upload.wikimedia.org/wikipedia/commons/thumb/d/db/VietJet_Air_logo.svg/200px-VietJet_Air_logo.svg.png\',
    \'Vietjet Air\', \'Được khai thác một phần bởi Thai Vietjet\'
);
renderVnaFlightCard(
    993, 15800000, 
    $dept, $dest, $adults, $children, $promo, 
    \'10:00\', \'20:00\', \'10h 00m\', \'Bay thẳng\',
    \'https://upload.wikimedia.org/wikipedia/commons/thumb/7/7b/Bamboo_Airways_logo.svg/200px-Bamboo_Airways_logo.svg.png\',
    \'Bamboo Airways\', \'\'
);
renderVnaFlightCard(
    995, 18573548, 
    $dept, $dest, $adults, $children, $promo, 
    \'20:00\', \'11:00<sup class="text-danger">+1</sup>\', \'17h 00m\', \'1 điểm dừng\',
    \'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/200px-Singapore_Airlines_Logo_2.svg.png\',
    \'Singapore Airlines\', \'Được khai thác một phần bởi Scoot\'
);
?>
</div>
';
$c = preg_replace('/<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->.*?<!-- End flightsListContainer -->/is', $replacement, $c);
$c = preg_replace('/<div id="flightsListContainer">.*?<\/div>\s*<\/div>\s*<!-- Hết Cột Phải -->/is', $replacement . "\n        </div> <!-- Hết Cột Phải -->", $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Restored VNA cards successfully.";
