<?php
$c = file_get_contents('app/Views/flights/search.php');

// 1. Add CSS for btn-pastel-orange
$css = "
    .btn-pastel-orange {
        background-color: #f4a261 !important;
        border-color: #f4a261 !important;
        color: #ffffff !important;
        transition: all 0.3s ease;
    }
    .btn-pastel-orange:hover {
        background-color: #e76f51 !important;
        border-color: #e76f51 !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(231, 111, 81, 0.3);
    }
";
$c = preg_replace('/(<style>\s*)/', "$1$css\n", $c, 1);

// 2. Change Cập nhật button
$c = str_replace(
    'class="btn btn-primary fw-bold px-4" style="border-radius: 8px; background: #0071c2; height: 40px;">Cập nhật',
    'class="btn btn-pastel-orange rounded-pill fw-bold px-4 text-white" style="height: 40px;">Cập nhật',
    $c
);

// 3. Change Chọn vé buttons (Eco)
$c = str_replace(
    'class="text-primary fw-bold text-decoration-none">Chọn vé',
    'class="btn btn-pastel-orange rounded-pill text-white fw-bold px-4 py-2">Chọn vé',
    $c
);

// 4. Change Chọn vé buttons (Business)
$c = str_replace(
    'class="text-warning fw-bold text-decoration-none" style="color: #d8a23a !important;">Chọn vé',
    'class="btn btn-pastel-orange rounded-pill text-white fw-bold px-4 py-2">Chọn vé',
    $c
);

file_put_contents('app/Views/flights/search.php', $c);
echo "Buttons updated to pastel orange";
