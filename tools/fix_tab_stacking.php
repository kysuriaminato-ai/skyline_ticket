<?php
$c = file_get_contents('app/Views/home/index.php');

// Add z-index to tab-content-wrapper so that it sits above the extra-services row
$c = preg_replace('/\.tab-pane\s*\{\s*display:\s*none;\s*animation:\s*fadeIn[^}]+\}/is', '.tab-content-wrapper { position: relative; z-index: 100; } $0', $c);

file_put_contents('app/Views/home/index.php', $c);
echo "Fixed stacking context issue by adding z-index to tab-content-wrapper.";
