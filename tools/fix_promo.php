<?php
$c = file_get_contents('app/Views/flights/search.php');
$phpBlock = "<?php 
    // Thu thập dữ liệu
    \$dept = \$_GET['departure'] ?? 'Hà Nội (HAN)';
    \$dest = \$_GET['destination'] ?? 'Melbourne (MEL)';
    \$date = \$_GET['departure_date'] ?? date('Y-m-d', strtotime('+1 day'));
    \$adults = \$_GET['adults'] ?? 1;
    \$children = \$_GET['children'] ?? 0;
    \$promo = \$_GET['promo'] ?? '';
?>";
$c = preg_replace('/<\?php\s*\$dept = \$_GET\[.*?\] \?\? \'H.*?\';\s*\$dest = \$_GET\[.*?\] \?\? \'M.*?\';\s*\$date = \$_GET\[.*?\] \?\? date\(\'Y-m-d\', strtotime\(\'\+1 day\'\)\);\s*\$adults = \$_GET\[.*?\] \?\? 1;\s*\?>/is', $phpBlock, $c);

// If the above regex doesn't match, let's just insert $promo manually if it's missing
if (strpos($c, '$promo = $_GET') === false) {
    $c = str_replace("\$adults = \$_GET['adults'] ?? 1;", "\$adults = \$_GET['adults'] ?? 1;\n    \$children = \$_GET['children'] ?? 0;\n    \$promo = \$_GET['promo'] ?? '';", $c);
}

file_put_contents('app/Views/flights/search.php', $c);
echo "Fixed promo undefined variable.";
