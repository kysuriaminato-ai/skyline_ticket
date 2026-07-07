<?php
$c = file_get_contents('app/Views/flights/search.php');
$vna_card = file_get_contents('tools/vna_card.php');

// Insert it at the very beginning
$c = $vna_card . "\n" . $c;

file_put_contents('app/Views/flights/search.php', $c);
echo "Injected function successfully";
