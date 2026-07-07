<?php
$c = file_get_contents('app/Views/home/index.php');

$js = <<<JS
        function selectCategoryDest(dest) {
            alert('Đã chọn điểm đến: ' + dest);
            // Optionally redirect to search page
            // window.location.href = '/skyline_ticket/public/flight/search?destination=' + encodeURIComponent(dest);
        }
JS;

$c = str_replace(
    "function loadCrossSell(destCode) {",
    $js . "\n\n        function loadCrossSell(destCode) {",
    $c
);

file_put_contents('app/Views/home/index.php', $c);
echo "Added selectCategoryDest function!";
