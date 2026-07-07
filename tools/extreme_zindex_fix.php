<?php
$c = file_get_contents('app/Views/home/index.php');

// Force extra-services to have z-index: 1 so it stays BELOW tab-content-wrapper
$c = preg_replace('/\.extra-services\s*\{[^}]+\}/is', '$0 .extra-services { z-index: 1; position: relative; }', $c);

// Ensure tab-content-wrapper has z-index: 100
if (strpos($c, '.tab-content-wrapper { position: relative; z-index: 100; }') === false) {
    $c = preg_replace('/\.tab-pane\s*\{\s*display:\s*none;\s*animation:\s*fadeIn[^}]+\}/is', '.tab-content-wrapper { position: relative; z-index: 100; } $0', $c);
}

// Make mega-dropdown even higher
$c = preg_replace('/\.mega-dropdown\s*\{[^}]+\}/is', '$0 .mega-dropdown { z-index: 1050 !important; }', $c);

file_put_contents('app/Views/home/index.php', $c);
echo "Applied extreme z-index fixes to extra-services and mega-dropdown.";
