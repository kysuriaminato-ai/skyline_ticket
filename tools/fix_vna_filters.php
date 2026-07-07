<?php
$c = file_get_contents('app/Views/flights/search.php');

// Replace the data attributes in the vna-card-container div
$c = preg_replace(
    '/data-stops="<\?= \(\$stopsText==.*?\) \?>"/',
    'data-stops="<?php
    if (strpos($stopsText, \'2+\') !== false) echo 2;
    elseif (strpos($stopsText, \'1\') !== false) echo 1;
    else echo 0;
?>"',
    $c
);

$c = preg_replace(
    '/data-airline="<\?= substr\(\$airlineName,\s*0,\s*2\) \?>"/',
    'data-airline="<?php
    $airlineCodeMap = [
        \'Vietnam Airlines\' => \'VN\',
        \'Vietjet Air\' => \'VJ\',
        \'Bamboo Airways\' => \'QH\',
        \'Singapore Airlines\' => \'SQ\',
    ];
    echo $airlineCodeMap[$airlineName] ?? substr($airlineName, 0, 2);
?>"',
    $c
);

file_put_contents('app/Views/flights/search.php', $c);
echo "Fixed data-stops and data-airline logic in renderVnaFlightCard.";
