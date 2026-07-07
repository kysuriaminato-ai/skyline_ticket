<?php
$file = 'app/Views/flights/search.php';
$content = file_get_contents($file);
// Remove BOM and leading stray ?
$content = preg_replace('/^[\xef\xbb\xbf\?]+/', '', $content);
file_put_contents($file, $content);
echo "Stripped BOM and ?";
