<?php
$db = new PDO('mysql:host=localhost;dbname=skyline_ticket', 'root', '');
$domesticCodes = ['SGN', 'HAN', 'DAD', 'PQC', 'CXR', 'HPH', 'VCA', 'VII', 'HUI', 'DLI', 'VDO', 'BMV', 'PXU', 'UIH', 'THD', 'VCL', 'TBB', 'VKG', 'VCS', 'CAH', 'DIN'];
$regexp = '(' . implode('|', $domesticCodes) . ')';

$sqlDomestic = "SELECT f.destination, COUNT(b.id) as bookings_count FROM flights f LEFT JOIN bookings b ON f.id = b.flight_id WHERE f.status = 1 AND f.destination REGEXP '$regexp' GROUP BY f.destination";
$sqlIntl = "SELECT f.destination, COUNT(b.id) as bookings_count FROM flights f LEFT JOIN bookings b ON f.id = b.flight_id WHERE f.status = 1 AND f.destination NOT REGEXP '$regexp' GROUP BY f.destination";

echo "Domestic:\n";
print_r($db->query($sqlDomestic)->fetchAll(PDO::FETCH_ASSOC));
echo "\nIntl:\n";
print_r($db->query($sqlIntl)->fetchAll(PDO::FETCH_ASSOC));
