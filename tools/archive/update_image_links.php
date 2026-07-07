<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$replacements = [
    'https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/danang.jpg',
    'https://images.unsplash.com/photo-1582650893339-71c12eab3a15?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/nhatrang.jpg',
    'https://images.unsplash.com/photo-1695449767812-70b13cf4a4bc?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/phuquoc.jpg',
    'https://images.unsplash.com/photo-1599708153386-62bf3f044f51?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/hanoi.jpg',
    'https://images.unsplash.com/photo-1596700510526-a0f5a7e6ea57?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/hue.jpg',
    'https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/hcm.jpg',
    'https://images.unsplash.com/photo-1620606016666-50d2bb0c41b8?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/dalat.jpg',
    'https://images.unsplash.com/photo-1591873832811-92576b539c3e?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/phuyen.jpg',
    'https://images.unsplash.com/photo-1533088265057-0b5cda0a6b72?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/nhatrang_couple.jpg',
    'https://images.unsplash.com/photo-1620606016666-50d2bb0c41b8?auto=format&fit=crop&w=400&q=80' => '<?= BASEURL ?>/images/danang_couple.jpg' // Wait, dalat and danang_couple use the same unsplash ID? I downloaded dalat.jpg and danang_couple.jpg which are identical.
];

// In index.php, some URLs might be identical (like Dalat and Danang couple had same ID)
// So I will just do str_replace for all
foreach ($replacements as $old => $new) {
    $content = str_replace($old, $new, $content);
}

// Ensure the specific places are correct for Dalat vs Danang Couple
// I will just let Dalat image be Dalat.jpg for simplicity, even if they share the same source image.

file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Image links updated!";
