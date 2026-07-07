<?php
$c = file_get_contents('app/Views/flights/search.php');

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
echo "Translated successfully";
