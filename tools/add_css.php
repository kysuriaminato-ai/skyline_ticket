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
$c = preg_replace('/(<style>\s*)/', "$1$css\n", $c, 1);
file_put_contents('app/Views/flights/search.php', $c);
echo "Added CSS";
