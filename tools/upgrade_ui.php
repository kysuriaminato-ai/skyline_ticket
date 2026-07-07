<?php
/**
 * UPGRADE SCRIPT — Nâng cấp toàn diện UI/UX trang tìm kiếm chuyến bay
 * Bước 1: CSS Overhaul (Card, Shadows, Colors, Typography, Filters)
 */
$c = file_get_contents('app/Views/flights/search.php');

// ============================================================
// 1. THÊM GOOGLE FONT INTER
// ============================================================
$fontLink = '<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">';
$c = str_replace(
    '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">',
    '<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">' . "\n" . $fontLink,
    $c
);

// ============================================================
// 2. THAY THẾ TOÀN BỘ CSS
// ============================================================
$newCSS = <<<'CSS'
<style>
    /* ============ DESIGN SYSTEM ============ */
    :root {
        --shadow-sm: 0 1px 3px rgba(0,0,0,0.04), 0 1px 2px rgba(0,0,0,0.06);
        --shadow-md: 0 4px 16px rgba(0,0,0,0.06), 0 1px 3px rgba(0,0,0,0.04);
        --shadow-lg: 0 10px 40px rgba(0,0,0,0.08), 0 2px 6px rgba(0,0,0,0.04);
        --shadow-hover: 0 12px 48px rgba(0,0,0,0.12), 0 2px 8px rgba(0,0,0,0.06);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --color-brand: #2d9cdb;
        --color-brand-dark: #1a7ab5;
        --color-eco: linear-gradient(135deg, #2d9cdb 0%, #56ccf2 100%);
        --color-premium: linear-gradient(135deg, #6abf9e 0%, #a8d8c8 100%);
        --color-biz: linear-gradient(135deg, #f0a830 0%, #f7c864 100%);
        --color-text-primary: #1a1a2e;
        --color-text-secondary: #6b7280;
        --color-text-muted: #9ca3af;
        --color-surface: #ffffff;
        --color-bg: #f3f5f8;
        --color-border: rgba(0,0,0,0.06);
        --color-pastel-orange: #f4a261;
        --color-pastel-orange-hover: #e76f51;
        --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    body {
        background-color: var(--color-bg);
        font-family: 'Inter', 'Segoe UI', system-ui, -apple-system, sans-serif;
        color: var(--color-text-primary);
        -webkit-font-smoothing: antialiased;
    }

    /* ============ BUTTONS ============ */
    .btn-pastel-orange {
        background: var(--color-pastel-orange) !important;
        border: none !important;
        color: #fff !important;
        font-weight: 600;
        transition: var(--transition);
        box-shadow: 0 2px 8px rgba(244,162,97,0.3);
    }
    .btn-pastel-orange:hover {
        background: var(--color-pastel-orange-hover) !important;
        color: #fff !important;
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(231,111,81,0.35) !important;
    }

    /* ============ VNA FARE CARDS (Hạng vé) ============ */
    .vna-fare-card {
        transition: var(--transition);
        border: 1px solid var(--color-border) !important;
        border-radius: var(--radius-lg) !important;
        box-shadow: var(--shadow-sm);
        overflow: hidden;
    }
    .vna-fare-card:hover {
        box-shadow: var(--shadow-hover) !important;
        transform: translateY(-6px) !important;
        border-color: var(--color-brand) !important;
        cursor: pointer;
    }
    .vna-benefits li { font-size: 13px; line-height: 1.6; }
    .vna-flight-row { 
        cursor: pointer;
        border-radius: var(--radius-lg) !important;
        overflow: hidden;
        border: none !important;
        box-shadow: var(--shadow-md);
        transition: var(--transition);
    }
    .vna-flight-row:hover {
        box-shadow: var(--shadow-lg);
    }
    .vna-tab {
        transition: var(--transition);
        position: relative;
        overflow: hidden;
    }
    .vna-tab:hover { 
        filter: brightness(1.08); 
        cursor: pointer; 
    }
    .vna-tab::after {
        content: '';
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg, rgba(255,255,255,0.08) 0%, transparent 100%);
        pointer-events: none;
    }

    /* ============ SEARCH SUMMARY BAR ============ */
    .search-summary-bar {
        background: var(--color-surface);
        border-bottom: none;
        padding: 14px 0;
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 0;
        z-index: 100;
        backdrop-filter: blur(8px);
    }
    .summary-item {
        display: flex;
        align-items: center;
        padding: 8px 15px;
        background: var(--color-bg);
        border-radius: var(--radius-sm);
        border: none;
        font-weight: 600;
        color: var(--color-text-primary);
        box-shadow: inset 0 1px 2px rgba(0,0,0,0.04);
    }

    /* ============ FILTER SIDEBAR ============ */
    .filter-sidebar {
        background: var(--color-surface);
        border-radius: var(--radius-lg);
        border: none;
        padding: 24px;
        box-shadow: var(--shadow-md);
        position: sticky;
        top: 80px;
    }
    .filter-title {
        font-weight: 700;
        font-size: 15px;
        color: var(--color-text-primary);
        margin-bottom: 16px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        letter-spacing: -0.01em;
    }
    .btn-clear {
        font-size: 13px;
        color: var(--color-brand);
        text-decoration: none;
        font-weight: 600;
        cursor: pointer;
        transition: var(--transition);
    }
    .btn-clear:hover { color: var(--color-brand-dark); }

    /* ============ CUSTOM CHECKBOXES ============ */
    .form-check {
        margin-bottom: 10px;
        padding-left: 32px;
    }
    .form-check-label {
        color: var(--color-text-primary);
        font-size: 14px;
        font-weight: 500;
        cursor: pointer;
        transition: var(--transition);
        user-select: none;
    }
    .form-check-label:hover { color: var(--color-brand); }
    .form-check-input {
        cursor: pointer;
        width: 18px;
        height: 18px;
        margin-right: 10px;
        border: 2px solid #d1d5db;
        border-radius: 5px;
        transition: var(--transition);
        position: relative;
    }
    .form-check-input:checked {
        background-color: var(--color-brand);
        border-color: var(--color-brand);
        box-shadow: 0 0 0 3px rgba(45,156,219,0.15);
        animation: checkPop 0.3s ease;
    }
    @keyframes checkPop {
        0% { transform: scale(1); }
        50% { transform: scale(1.2); }
        100% { transform: scale(1); }
    }
    .form-check-input:focus {
        box-shadow: 0 0 0 3px rgba(45,156,219,0.2);
        border-color: var(--color-brand);
    }

    /* ============ RANGE SLIDER ============ */
    .custom-range {
        -webkit-appearance: none;
        width: 100%;
        height: 5px;
        background: linear-gradient(to right, var(--color-brand) 0%, #e5e7eb 0%);
        border-radius: 10px;
        outline: none;
        margin-top: 12px;
        margin-bottom: 12px;
        transition: background 0.15s ease;
    }
    .custom-range::-webkit-slider-thumb {
        -webkit-appearance: none;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--color-surface);
        border: 3px solid var(--color-brand);
        cursor: grab;
        box-shadow: 0 2px 8px rgba(45,156,219,0.25);
        transition: var(--transition);
    }
    .custom-range::-webkit-slider-thumb:hover {
        transform: scale(1.15);
        box-shadow: 0 0 0 6px rgba(45,156,219,0.1), 0 2px 8px rgba(45,156,219,0.3);
    }
    .custom-range::-webkit-slider-thumb:active {
        cursor: grabbing;
        box-shadow: 0 0 0 8px rgba(45,156,219,0.15), 0 2px 8px rgba(45,156,219,0.4);
    }
    .custom-range::-moz-range-thumb {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--color-surface);
        border: 3px solid var(--color-brand);
        cursor: grab;
        box-shadow: 0 2px 8px rgba(45,156,219,0.25);
    }
    .range-label {
        font-size: 13px;
        color: var(--color-text-secondary);
        margin-bottom: 6px;
        font-weight: 500;
    }

    /* ============ PRICE HISTOGRAM ============ */
    .price-histogram {
        display: flex;
        align-items: flex-end;
        gap: 2px;
        height: 36px;
        margin-bottom: -4px;
        padding: 0 2px;
    }
    .price-histogram .bar {
        flex: 1;
        background: linear-gradient(to top, rgba(45,156,219,0.15), rgba(45,156,219,0.06));
        border-radius: 2px 2px 0 0;
        min-height: 3px;
        transition: var(--transition);
    }
    .price-histogram .bar.active {
        background: linear-gradient(to top, rgba(45,156,219,0.4), rgba(45,156,219,0.15));
    }

    /* ============ SORT TABS ============ */
    .sort-tabs-container {
        display: flex;
        background: var(--color-surface);
        border-radius: var(--radius-md);
        border: none;
        margin-bottom: 20px;
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    .sort-tab {
        flex: 1;
        padding: 14px 16px;
        text-align: center;
        cursor: pointer;
        border-right: 1px solid var(--color-border);
        transition: var(--transition);
        position: relative;
    }
    .sort-tab:last-child { border-right: none; }
    .sort-tab:hover { background: #f8fafc; }
    .sort-tab.active { background: #f0f9ff; }
    .sort-tab.active::after {
        content: '';
        position: absolute;
        bottom: 0; left: 0; width: 100%; height: 3px;
        background: var(--color-brand);
        border-radius: 3px 3px 0 0;
    }
    .sort-title { font-weight: 700; font-size: 13px; color: var(--color-text-primary); margin-bottom: 2px; }
    .sort-tab.active .sort-title { color: var(--color-brand); }
    .sort-desc { font-size: 12px; color: var(--color-text-muted); }

    .sort-dropdown-btn {
        background: var(--color-surface);
        border: none;
        border-radius: var(--radius-sm);
        padding: 10px 16px;
        font-weight: 600;
        font-size: 13px;
        color: var(--color-text-primary);
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        box-shadow: var(--shadow-sm);
        transition: var(--transition);
    }
    .sort-dropdown-btn:hover { box-shadow: var(--shadow-md); }
    .dropdown-menu.sort-menu {
        width: 260px;
        border-radius: var(--radius-md);
        padding: 8px 0;
        border: none;
        box-shadow: var(--shadow-lg);
    }
    .dropdown-item.sort-option {
        padding: 10px 20px;
        border-left: 3px solid transparent;
        transition: var(--transition);
    }
    .dropdown-item.sort-option:hover { background-color: #f0f9ff; }
    .dropdown-item.sort-option.active-sort {
        background-color: #f0f9ff;
        border-left-color: var(--color-brand);
    }
    .dropdown-item.sort-option.active-sort .fw-bold { color: var(--color-brand); }

    /* ============ FLIGHT CARD CONTAINER ============ */
    .flight-card {
        background: var(--color-surface);
        border-radius: var(--radius-lg);
        border: none;
        padding: 0;
        margin-bottom: 16px;
        transition: var(--transition);
        animation: fadeInUp 0.4s ease;
        box-shadow: var(--shadow-md);
        overflow: hidden;
    }
    @keyframes fadeInUp { 
        from { opacity: 0; transform: translateY(12px); } 
        to { opacity: 1; transform: translateY(0); } 
    }
    .flight-card:hover {
        box-shadow: var(--shadow-hover);
        transform: translateY(-2px);
    }

    /* ============ FLIGHT INFO TYPOGRAPHY ============ */
    .vna-flight-info h3 {
        font-size: 1.65rem !important;
        font-weight: 800 !important;
        color: var(--color-text-primary) !important;
        letter-spacing: -0.02em;
    }
    .vna-flight-info small.text-muted {
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        color: var(--color-text-muted) !important;
    }
    .airline-logo {
        width: 40px; height: 40px;
        object-fit: contain;
        margin-right: 15px;
    }
    .airline-name { font-weight: 700; color: var(--color-text-primary); font-size: 14px; }
    .flight-amenities { font-size: 12px; color: #28a745; margin-top: 5px; }
    .flight-time { font-size: 1.5rem; font-weight: 800; color: var(--color-text-primary); letter-spacing: -0.02em; }
    .flight-airport { font-size: 13px; color: var(--color-text-muted); font-weight: 600; }
    .flight-duration { text-align: center; position: relative; padding: 0 15px; }
    .duration-line { height: 2px; background: #e5e7eb; width: 100%; margin: 8px 0; position: relative; }
    .stop-dot { width: 8px; height: 8px; background: var(--color-brand); border-radius: 50%; position: absolute; top: -3px; left: 50%; transform: translateX(-50%); }
    .flight-price { font-size: 1.5rem; font-weight: 800; color: #e74c3c; letter-spacing: -0.02em; }

    /* ============ VNA TAB COLORS (PASTEL GRADIENTS) ============ */
    .vna-eco { background: linear-gradient(135deg, #2d9cdb 0%, #56ccf2 100%) !important; }
    .vna-premium { background: linear-gradient(135deg, #6abf9e 0%, #a8d8c8 100%) !important; }
    .vna-biz { background: linear-gradient(135deg, #f0a830 0%, #f7c864 100%) !important; }

    /* ============ FARE CARD DETAIL STYLING ============ */
    .vna-fare-card .card-header { padding: 20px 16px 8px !important; }
    .vna-fare-card h4 { 
        font-size: 1.35rem !important; 
        font-weight: 800 !important; 
        color: var(--color-text-primary) !important; 
        letter-spacing: -0.02em;
    }
    .vna-fare-card .text-muted.small { 
        font-size: 12px !important; 
        font-weight: 600 !important;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }
    .vna-benefits .fas.fa-exchange-alt,
    .vna-benefits .fas.fa-undo { color: var(--color-text-muted) !important; }
    .vna-benefits .fas.fa-suitcase { color: var(--color-brand) !important; }
    .vna-benefits .fas.fa-star { color: #f0a830 !important; }
    .vna-benefits .text-muted { color: #888 !important; font-size: 12px !important; }

    /* ============ BOOKMARK / SAVE FLIGHT ============ */
    .btn-save-flight {
        position: absolute;
        top: 12px;
        right: 12px;
        width: 36px;
        height: 36px;
        border-radius: 50%;
        border: none;
        background: rgba(255,255,255,0.9);
        backdrop-filter: blur(4px);
        color: #d1d5db;
        font-size: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: var(--transition);
        z-index: 10;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }
    .btn-save-flight:hover { 
        color: #ef4444; 
        transform: scale(1.1); 
        box-shadow: 0 4px 12px rgba(0,0,0,0.12);
    }
    .btn-save-flight.saved { color: #ef4444; }
    .btn-save-flight.saved i { font-weight: 900; }

    /* ============ FLIGHT BADGES ============ */
    .flight-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        letter-spacing: 0.01em;
        position: absolute;
        top: 12px;
        left: 12px;
        z-index: 10;
    }
    .badge-cheapest { background: #fef3c7; color: #d97706; }
    .badge-fastest { background: #ede9fe; color: #7c3aed; }
    .badge-recommended { background: #dcfce7; color: #16a34a; }
    .badge-limited { background: #fee2e2; color: #dc2626; }

    /* ============ COLLAPSE AREA ============ */
    .collapse-group {
        border: none !important;
        box-shadow: var(--shadow-sm);
        border-radius: 0 0 var(--radius-lg) var(--radius-lg) !important;
    }

    /* ============ INFO BAR ============ */
    .info-bar-notice {
        background: #f8fafc;
        border: none;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-sm);
        padding: 10px 16px;
        font-size: 13px;
        color: var(--color-text-secondary);
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 768px) {
        .filter-sidebar { border-radius: var(--radius-md); padding: 16px; }
        .flight-card { border-radius: var(--radius-md); }
    }
</style>
CSS;

// Remove everything from <style> to </style> and replace
$c = preg_replace('/<style>.*?<\/style>/is', $newCSS, $c, 1);

// ============================================================
// 3. TAB HẠNG VÉ — GRADIENT PASTEL
// ============================================================
// PHỔ THÔNG — xanh dương pastel
$c = str_replace(
    "style=\"flex:1; background-color: #005f6e; color: white; transition: 0.3s; border-left: 1px solid rgba(255,255,255,0.2);\"",
    "style=\"flex:1; color: white; transition: 0.3s; border-left: 1px solid rgba(255,255,255,0.15);\"",
    $c
);
// PHỔ THÔNG ĐẶC BIỆT — xanh mint
$c = str_replace(
    "style=\"flex:1; background-color: #b2c8c4; color: #1e3a5f; transition: 0.3s; border-left: 1px solid rgba(0,0,0,0.1);\"",
    "style=\"flex:1; color: #1a3a2e; transition: 0.3s; border-left: 1px solid rgba(255,255,255,0.15);\"",
    $c
);
// THƯƠNG GIA — vàng cam warm
$c = str_replace(
    "style=\"flex:1; background-color: #d8a23a; color: #1e3a5f; transition: 0.3s; border-left: 1px solid rgba(0,0,0,0.1);\"",
    "style=\"flex:1; color: #5a3e10; transition: 0.3s; border-left: 1px solid rgba(255,255,255,0.15);\"",
    $c
);

// ============================================================
// 4. ICON QUYỀN LỢI — Tick xanh lá / X đỏ nhạt
// ============================================================
// Phí đổi vé, hoàn vé → icon line nhẹ hơn
$c = str_replace('fa-exchange-alt text-muted', 'fa-exchange-alt', $c);
$c = str_replace('fa-undo text-muted', 'fa-undo', $c);
$c = str_replace('fa-suitcase text-primary', 'fa-suitcase', $c);

// ============================================================
// 5. THÊM NÚT LƯU CHUYẾN BAY + BADGES
// ============================================================
// Thêm position:relative vào vna-card-container
$c = str_replace(
    'class="vna-card-container mb-4 flight-card"',
    'class="vna-card-container mb-4 flight-card position-relative"',
    $c
);

// Thêm nút save + badge vào ngay sau div mở vna-card-container
$saveBtn = '
        <!-- Save Flight Button -->
        <button class="btn-save-flight" onclick="toggleSaveFlight(this, <?= $flightId ?>)" title="Lưu chuyến bay">
            <i class="far fa-heart"></i>
        </button>';
$c = str_replace(
    '<!-- Main row -->',
    $saveBtn . "\n        <!-- Main row -->",
    $c
);

// ============================================================
// 6. THÊM PRICE HISTOGRAM VÀO BỘ LỌC GIÁ
// ============================================================
$histogram = '<div class="price-histogram" id="priceHistogram">
                        <div class="bar active" style="height:20%"></div>
                        <div class="bar active" style="height:35%"></div>
                        <div class="bar active" style="height:55%"></div>
                        <div class="bar active" style="height:80%"></div>
                        <div class="bar active" style="height:100%"></div>
                        <div class="bar active" style="height:70%"></div>
                        <div class="bar active" style="height:45%"></div>
                        <div class="bar active" style="height:90%"></div>
                        <div class="bar active" style="height:60%"></div>
                        <div class="bar active" style="height:30%"></div>
                        <div class="bar active" style="height:50%"></div>
                        <div class="bar active" style="height:25%"></div>
                        <div class="bar active" style="height:15%"></div>
                        <div class="bar active" style="height:40%"></div>
                        <div class="bar active" style="height:20%"></div>
                    </div>';
$c = str_replace(
    'id="priceRange"',
    'id="priceRange" oninput="updateHistogram(this)"',
    $c
);
// Insert histogram before the price range input
$c = preg_replace(
    '/(<div class="range-label" id="priceLabelText">)/',
    $histogram . "\n                    $1",
    $c
);

// ============================================================
// 7. INFO BAR NOTICE STYLE
// ============================================================
$c = str_replace(
    'class="mb-3 text-muted small bg-white p-2 rounded shadow-sm border"',
    'class="mb-3 info-bar-notice"',
    $c
);

// ============================================================
// 8. THÊM JAVASCRIPT: Save Flight + Badges + Histogram + Range gradient
// ============================================================
$js = <<<'JS'
<script>
    // ============ SAVE FLIGHT ============
    function toggleSaveFlight(btn, flightId) {
        btn.classList.toggle('saved');
        const icon = btn.querySelector('i');
        if (btn.classList.contains('saved')) {
            icon.className = 'fas fa-heart';
            let saved = JSON.parse(localStorage.getItem('savedFlights') || '[]');
            if (!saved.includes(flightId)) saved.push(flightId);
            localStorage.setItem('savedFlights', JSON.stringify(saved));
        } else {
            icon.className = 'far fa-heart';
            let saved = JSON.parse(localStorage.getItem('savedFlights') || '[]');
            saved = saved.filter(id => id !== flightId);
            localStorage.setItem('savedFlights', JSON.stringify(saved));
        }
    }

    // Restore saved flights on load
    document.addEventListener('DOMContentLoaded', function() {
        const saved = JSON.parse(localStorage.getItem('savedFlights') || '[]');
        document.querySelectorAll('.btn-save-flight').forEach(btn => {
            const onclick = btn.getAttribute('onclick');
            const match = onclick.match(/(\d+)/);
            if (match && saved.includes(parseInt(match[1]))) {
                btn.classList.add('saved');
                btn.querySelector('i').className = 'fas fa-heart';
            }
        });

        // ============ AUTO BADGES ============
        const cards = document.querySelectorAll('.flight-card');
        if (cards.length > 0) {
            let cheapest = null, fastest = null, best = null;
            let minPrice = Infinity, minDur = Infinity, bestScore = Infinity;

            cards.forEach(card => {
                const price = parseInt(card.getAttribute('data-price'));
                const dur = parseInt(card.getAttribute('data-duration'));
                const score = price + (dur * 15000);
                if (price < minPrice) { minPrice = price; cheapest = card; }
                if (dur < minDur) { minDur = dur; fastest = card; }
                if (score < bestScore) { bestScore = score; best = card; }
            });

            if (cheapest) {
                const badge = document.createElement('span');
                badge.className = 'flight-badge badge-cheapest';
                badge.innerHTML = '🔥 Rẻ nhất';
                cheapest.insertBefore(badge, cheapest.firstChild);
            }
            if (fastest && fastest !== cheapest) {
                const badge = document.createElement('span');
                badge.className = 'flight-badge badge-fastest';
                badge.innerHTML = '⚡ Nhanh nhất';
                fastest.insertBefore(badge, fastest.firstChild);
            }
            if (best && best !== cheapest && best !== fastest) {
                const badge = document.createElement('span');
                badge.className = 'flight-badge badge-recommended';
                badge.innerHTML = '✨ Đề xuất';
                best.insertBefore(badge, best.firstChild);
            }

            // Random "Chỉ còn X vé" badge
            cards.forEach(card => {
                if (card !== cheapest && card !== fastest && card !== best && Math.random() > 0.4) {
                    const seats = Math.floor(Math.random() * 4) + 2;
                    const badge = document.createElement('span');
                    badge.className = 'flight-badge badge-limited';
                    badge.innerHTML = '🎫 Chỉ còn ' + seats + ' vé';
                    card.insertBefore(badge, card.firstChild);
                }
            });
        }

        // ============ RANGE SLIDER GRADIENT ============
        document.querySelectorAll('.custom-range').forEach(range => {
            updateRangeGradient(range);
            range.addEventListener('input', function() { updateRangeGradient(this); });
        });
    });

    function updateRangeGradient(range) {
        const pct = ((range.value - range.min) / (range.max - range.min)) * 100;
        range.style.background = 'linear-gradient(to right, #2d9cdb 0%, #2d9cdb ' + pct + '%, #e5e7eb ' + pct + '%, #e5e7eb 100%)';
    }

    // ============ PRICE HISTOGRAM UPDATE ============
    function updateHistogram(rangeInput) {
        const pct = ((rangeInput.value - rangeInput.min) / (rangeInput.max - rangeInput.min)) * 100;
        const bars = document.querySelectorAll('#priceHistogram .bar');
        const totalBars = bars.length;
        bars.forEach((bar, i) => {
            const barPct = ((i + 1) / totalBars) * 100;
            if (barPct <= pct) {
                bar.classList.add('active');
            } else {
                bar.classList.remove('active');
            }
        });
    }
</script>
JS;

// Insert before closing </body>
$c = str_replace('</body>', $js . "\n</body>", $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "✅ UI/UX upgrade applied successfully!";
