<?php
$c = file_get_contents('app/Views/flights/search.php');

// Remove the airline logo image from the flight cards
$c = preg_replace('/<img src="<\?= \$airlineLogo \?>" alt="<\?= \$airlineName \?>" style="height: 24px;" class="me-2">/', '', $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Removed airline logos.";
