<?php
$broken = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');
$original = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\new_index.php');

$tab3_marker = '<!-- ==================== TAB 3: LÀM THỦ TỤC ==================== -->';
$categories_marker = '<!-- ================= CATEGORIES SECTION ================= -->';

// Top part from broken
$top = substr($broken, 0, strpos($broken, $tab3_marker));

// Middle part from original
$mid_start = strpos($original, $tab3_marker);
$mid_end = strpos($original, $categories_marker);
$mid = substr($original, $mid_start, $mid_end - $mid_start);

// Bottom part from broken
$bottom_start = strpos($broken, $categories_marker);
$bottom = substr($broken, $bottom_start);

$fixed_html = $top . $mid . $bottom;

file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $fixed_html);
echo "Repaired HTML structure.";
