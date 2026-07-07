<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript.jsonl';
$lines = file($path);
$chunks = [];
foreach ($lines as $line) {
    if (strpos($line, 'File Path: `file:///c:/xampp/htdocs/skyline_ticket/app/Views/home/index.php`') !== false) {
        preg_match('/Showing lines (\d+) to (\d+)/', $line, $m);
        if ($m) {
            $chunks[] = $m[1] . ' to ' . $m[2];
        }
    }
}
echo implode(', ', $chunks);
