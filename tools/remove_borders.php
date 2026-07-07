<?php
$c = file_get_contents('app/Views/flights/search.php');
$c = str_replace('class="card h-100 vna-fare-card border-primary rounded-4 shadow-sm"', 'class="card h-100 vna-fare-card border rounded-4"', $c);
$c = str_replace('class="card h-100 vna-fare-card border rounded-4 border-primary shadow-sm"', 'class="card h-100 vna-fare-card border rounded-4"', $c);
$c = str_replace('class="card h-100 vna-fare-card border rounded-4 border-warning shadow-sm"', 'class="card h-100 vna-fare-card border rounded-4"', $c);
$c = str_replace('style="border-width: 2px !important;"', '', $c);
file_put_contents('app/Views/flights/search.php', $c);
echo "Borders removed";
