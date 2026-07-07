<?php
$c = file_get_contents('app/Views/flights/search.php');

// Insert flightsListContainer before the cards
$c = str_replace('<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->'."\n".'<?php', '<!-- ================= DANH SÁCH CHUYẾN BAY ================= -->'."\n".'<div id="flightsListContainer">'."\n".'<?php', $c);

// Insert closing tags before the script
$c = str_replace('?>'."\n".'<script>', '?>'."\n".'</div>'."\n".'</div> <!-- Hết Cột Phải -->'."\n".'</div> <!-- Hết container -->'."\n".'<script>', $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Added missing divs safely";
