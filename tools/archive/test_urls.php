<?php
$urls = [
    'https://cdn.worldvectorlogo.com/logos/vietnam-airlines.svg',
    'https://cdn.worldvectorlogo.com/logos/vietjet-air.svg',
    'https://cdn.worldvectorlogo.com/logos/bamboo-airways.svg',
    'https://cdn.worldvectorlogo.com/logos/singapore-airlines-1.svg',
    'https://cdn.worldvectorlogo.com/logos/thai-airways-1.svg',
    'https://cdn.worldvectorlogo.com/logos/qatar-airways-1.svg',
    'https://cdn.worldvectorlogo.com/logos/emirates-airlines.svg',
    'https://cdn.worldvectorlogo.com/logos/korean-air-2.svg',
    'https://cdn.worldvectorlogo.com/logos/japan-airlines-1.svg',
    'https://cdn.worldvectorlogo.com/logos/ana-1.svg',
    'https://cdn.worldvectorlogo.com/logos/cathay-pacific.svg',
    'https://cdn.worldvectorlogo.com/logos/eva-air.svg'
];

foreach ($urls as $url) {
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        echo "[OK] $url\n";
    } else {
        echo "[FAIL] $url\n";
    }
}
