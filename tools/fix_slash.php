<?php
$c = file_get_contents('app/Views/flights/search.php');

// Fix the \
$c = str_replace('\$', '$', $c);
$c = str_replace('\', '', $c);

file_put_contents('app/Views/flights/search.php', $c);
echo "Fixed backslash error.";
