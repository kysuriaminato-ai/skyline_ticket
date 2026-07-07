<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript_full.jsonl';
$lines = file($path);
$found = [];
foreach ($lines as $i => $line) {
    if (stripos($line, 'TOP AIRLINE') !== false || stripos($line, 'CATEGORIES') !== false) {
        $found[] = 'Line ' . $i;
    }
}
echo 'Found in lines: ' . implode(', ', $found);
