<?php
$c = file_get_contents('app/Views/flights/search.php');

// 1. Translations
$c = str_replace('Search', 'Tìm kiếm', $c);
$c = str_replace('Stops', 'Điểm dừng', $c);
$c = str_replace('>Direct<', '>Bay thẳng<', $c);
$c = str_replace('1 Stop', '1 điểm dừng', $c);
$c = str_replace('2+ Stops', '2+ điểm dừng', $c);
$c = str_replace('Clear', 'Xóa', $c);
$c = str_replace('Times', 'Thời gian', $c);
$c = str_replace('Take-off', 'Cất cánh', $c);
$c = str_replace('Landing', 'Hạ cánh', $c);
$c = str_replace('Price per person', 'Giá mỗi người', $c);
$c = str_replace('Airlines', 'Hãng hàng không', $c);
$c = str_replace('Cheapest', 'Rẻ nhất', $c);
$c = str_replace('Best', 'Tốt nhất', $c);
$c = str_replace('Fastest', 'Nhanh nhất', $c);
$c = str_replace('Cabin bag', 'Hành lý xách tay', $c);
$c = str_replace('Checked baggage', 'Hành lý ký gửi', $c);
$c = str_replace('Sort by:', 'Sắp xếp:', $c);
$c = str_replace('Total journey time', 'Tổng thời gian bay', $c);

// 2. Inject Notice and Fare UI helper
$helper = file_get_contents('C:\Users\MAi THU\.gemini\antigravity-ide\brain\084bed10-86e1-4182-ad15-9e743bede842\scratch\fare_ui.php');
$c = "<?php\n?>\n" . $helper . substr($c, 5); // replace first <?php

// Add the notice
$c = str_replace('<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->', "<!-- INFO BAR -->\n        <div class=\"mb-3 text-muted small\">\n            <i class=\"fas fa-info-circle text-primary me-1\"></i> Giá trung bình mỗi người. Giá đã bao gồm thuế và phí.\n        </div>\n        <!-- ================= DANH SÁCH CHUYẾN BAY ================= -->", $c);

// 3. Update flight cards
$c = preg_replace('/(<a href="[^"]+flight_id=991[^"]+" class="btn btn-book">)Select(<\/a>\s*<\/div>\s*<\/div>)/is', '<button type="button" class="btn btn-book w-100" data-bs-toggle="collapse" data-bs-target="#fareOptions_991">Chọn <i class="fas fa-chevron-down ms-1"></i></button></div></div><?php renderFareOptions(991, 13200000, $dept, $dest, $adults, $children, $promo); ?>', $c);

$c = preg_replace('/(<a href="[^"]+flight_id=994[^"]+" class="btn btn-book">)Select(<\/a>\s*<\/div>\s*<\/div>)/is', '<button type="button" class="btn btn-book w-100" data-bs-toggle="collapse" data-bs-target="#fareOptions_994">Chọn <i class="fas fa-chevron-down ms-1"></i></button></div></div><?php renderFareOptions(994, 12500000, $dept, $dest, $adults, $children, $promo); ?>', $c);

$c = preg_replace('/(<a href="[^"]+flight_id=993[^"]+" class="btn btn-book">)Select(<\/a>\s*<\/div>\s*<\/div>)/is', '<button type="button" class="btn btn-book w-100" data-bs-toggle="collapse" data-bs-target="#fareOptions_993">Chọn <i class="fas fa-chevron-down ms-1"></i></button></div></div><?php renderFareOptions(993, 15800000, $dept, $dest, $adults, $children, $promo); ?>', $c);

$c = preg_replace('/(<a href="[^"]+flight_id=995[^"]+" class="btn btn-book">)Select(<\/a>\s*<\/div>\s*<\/div>)/is', '<button type="button" class="btn btn-book w-100" data-bs-toggle="collapse" data-bs-target="#fareOptions_995">Chọn <i class="fas fa-chevron-down ms-1"></i></button></div></div><?php renderFareOptions(995, 18573548, $dept, $dest, $adults, $children, $promo); ?>', $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Done";
