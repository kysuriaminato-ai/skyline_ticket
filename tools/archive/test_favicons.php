<?php
$urls = [
    'https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://vietnamairlines.com&size=128',
    'https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://vietjetair.com&size=128',
    'https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://bambooairways.com&size=128',
    'https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://singaporeair.com&size=128',
    'https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://thaiairways.com&size=128'
];

foreach ($urls as $url) {
    $headers = @get_headers($url);
    if ($headers && strpos($headers[0], '200') !== false) {
        echo "[OK] $url\n";
    } else {
        echo "[FAIL] $url\n";
    }
}
