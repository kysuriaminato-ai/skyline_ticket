<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$content = str_replace(
    'https://logo.clearbit.com/', 
    'https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&size=128&url=http://', 
    $content
);

file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Replaced clearbit URLs with gstatic favicons.";
