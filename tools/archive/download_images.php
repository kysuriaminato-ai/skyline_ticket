<?php
$images = [
    'danang.jpg' => 'https://images.unsplash.com/photo-1559592413-7cec4d0cae2b?auto=format&fit=crop&w=400&q=80',
    'nhatrang.jpg' => 'https://images.unsplash.com/photo-1582650893339-71c12eab3a15?auto=format&fit=crop&w=400&q=80',
    'phuquoc.jpg' => 'https://images.unsplash.com/photo-1695449767812-70b13cf4a4bc?auto=format&fit=crop&w=400&q=80',
    'hanoi.jpg' => 'https://images.unsplash.com/photo-1599708153386-62bf3f044f51?auto=format&fit=crop&w=400&q=80',
    'hue.jpg' => 'https://images.unsplash.com/photo-1596700510526-a0f5a7e6ea57?auto=format&fit=crop&w=400&q=80',
    'hcm.jpg' => 'https://images.unsplash.com/photo-1583417319070-4a69db38a482?auto=format&fit=crop&w=400&q=80',
    'dalat.jpg' => 'https://images.unsplash.com/photo-1620606016666-50d2bb0c41b8?auto=format&fit=crop&w=400&q=80',
    'phuyen.jpg' => 'https://images.unsplash.com/photo-1591873832811-92576b539c3e?auto=format&fit=crop&w=400&q=80',
    'nhatrang_couple.jpg' => 'https://images.unsplash.com/photo-1533088265057-0b5cda0a6b72?auto=format&fit=crop&w=400&q=80',
    'danang_couple.jpg' => 'https://images.unsplash.com/photo-1620606016666-50d2bb0c41b8?auto=format&fit=crop&w=400&q=80'
];

$dir = 'c:\\xampp\\htdocs\\skyline_ticket\\public\\images';
if (!file_exists($dir)) {
    mkdir($dir, 0777, true);
}

$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36');

foreach ($images as $filename => $url) {
    $path = $dir . '\\' . $filename;
    curl_setopt($ch, CURLOPT_URL, $url);
    $data = curl_exec($ch);
    if ($data !== false) {
        file_put_contents($path, $data);
        echo "Downloaded $filename\n";
    } else {
        echo "Failed to download $filename: " . curl_error($ch) . "\n";
    }
}
curl_close($ch);
echo "Done downloading images.";
