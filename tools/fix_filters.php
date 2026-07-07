<?php
$c = file_get_contents('app/Views/flights/search.php');

// 1. Fix the data-airline attribute: use IATA codes instead of substr
// Map airline names to IATA codes
$old_airline = "data-airline=\"<?= substr(\$airlineName,0,2) ?>\"";
$new_airline = "data-airline=\"<?php
    \$airlineCodeMap = [
        'Vietnam Airlines' => 'VN',
        'Vietjet Air' => 'VJ',
        'Bamboo Airways' => 'QH',
        'Singapore Airlines' => 'SQ',
    ];
    echo \$airlineCodeMap[\$airlineName] ?? substr(\$airlineName, 0, 2);
?>\"";
$c = str_replace($old_airline, $new_airline, $c);

// 2. Fix the data-stops attribute: handle 0, 1, 2+ properly
$old_stops = "data-stops=\"<?= (\$stopsText=='Bay thẳng')?0:1 ?>\"";
$new_stops = "data-stops=\"<?php
    if (strpos(\$stopsText, '2+') !== false) echo 2;
    elseif (strpos(\$stopsText, '1') !== false) echo 1;
    else echo 0;
?>\"";
$c = str_replace($old_stops, $new_stops, $c);

// 3. Fix the "No flights found" message to Vietnamese
$c = str_replace('>No flights found<', '>Không tìm thấy chuyến bay<', $c);
$c = str_replace('>Try adjusting your filters.<', '>Hãy thử điều chỉnh bộ lọc của bạn.<', $c);

// 4. Fix filter labels to Vietnamese
$c = str_replace('Departure 00:00 - ', 'Cất cánh 00:00 - ', $c);
$c = str_replace('Arrival 00:00 - ', 'Hạ cánh 00:00 - ', $c);
$c = str_replace('"Up to đ "', '"Lên đến đ "', $c);

// 5. Fix time range label display
$c = str_replace('"Up to đ " + formatter.format(this.value)', '"Lên đến " + formatter.format(this.value) + " đ"', $c);
$c = str_replace('"Departure 00:00 - " + formatTime(this.value)', '"Cất cánh 00:00 - " + formatTime(this.value)', $c);
$c = str_replace('"Arrival 00:00 - " + formatTime(this.value)', '"Hạ cánh 00:00 - " + formatTime(this.value)', $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Filter fixes applied successfully!";
