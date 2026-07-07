<?php
$c = file_get_contents('app/Views/flights/search.php');

$c = str_replace('<!-- ================= DANH SACH CHUY?N BAY ================= -->', '<!-- ================= DANH SACH CHUY?N BAY ================= -->'."\n".'<div id="flightsListContainer">', $c);

$c = str_replace('?>'."\n".'            </div> <!-- H?t C?t Ph?i -->', '?>'."\n".'</div>'."\n".'            </div> <!-- H?t C?t Ph?i -->', $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Added flightsListContainer wrapper";
