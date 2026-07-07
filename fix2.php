<?php
$c = file_get_contents('app/Views/flights/search.php');
$fixed = mb_convert_encoding($c, 'Windows-1252', 'UTF-8');
file_put_contents('app/Views/flights/search_fixed.php', $fixed);
