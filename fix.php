<?php
$c = file_get_contents('app/Views/flights/search.php');
file_put_contents('app/Views/flights/search_fixed.php', utf8_decode($c));
