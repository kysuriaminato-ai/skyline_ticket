<?php
$c = file_get_contents('app/Views/flights/search.php');

// Remove English average price text
$c = preg_replace('/<p class="text-muted mb-3"><i class="fas fa-info-circle me-1 text-primary"><\/i> Average price per person\. The price includes taxes and fees\.<\/p>\s*/', '', $c);

// Remove the whole sorting bar (Agoda Style Sort Tabs and Dropdown)
$c = preg_replace('/<!-- Agoda Style Sort Tabs -->.*?<\/div>\s*<\/div>\s*<\/div>/is', '', $c);

// Remove all duplicated Vietnamese INFO BAR notices
$c = preg_replace('/<!-- INFO BAR -->\s*<div class="mb-3 text-muted small bg-white p-2 rounded shadow-sm border">\s*<i class="fas fa-info-circle text-primary me-1"><\/i>.*?<\/div>\s*/is', '', $c);

// Fix JS to avoid null reference error on sortMenuButton
$c = str_replace(
    "document.getElementById('sortMenuButton').innerHTML = 'Sort by: ' + dropdownText",
    "if(document.getElementById('sortMenuButton')) document.getElementById('sortMenuButton').innerHTML = 'Sort by: ' + dropdownText",
    $c
);

file_put_contents('app/Views/flights/search.php', $c);
echo "Removed highlighted sections and fixed JS.";
