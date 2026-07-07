<?php
$file = 'c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php';
$content = file_get_contents($file);

// Update Shopping button to link to /service/shopping
$content = str_replace(
    'data-bs-toggle="offcanvas" data-bs-target="#dutyFreeOffcanvas"',
    'onclick="window.location.href=\'<?= BASEURL ?>/service/shopping\'"',
    $content
);

// Update Hotel/Tour button to link to /service/hotelTour
$content = str_replace(
    'onclick="toggleContextualServices()"',
    'onclick="window.location.href=\'<?= BASEURL ?>/service/hotelTour\'"',
    $content
);

file_put_contents($file, $content);
echo "Updated homepage service bar links!\n";
