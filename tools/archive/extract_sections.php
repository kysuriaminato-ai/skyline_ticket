<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript_full.jsonl';
$lines = file($path);
$output = [];
foreach ($lines as $i => $line) {
    if (stripos($line, 'TOP AIRLINE') !== false && stripos($line, 'CATEGORIES') !== false) {
        $data = json_decode($line, true);
        if (isset($data['content'])) {
            file_put_contents('found_sections.txt', $data['content']);
            echo "Extracted from line " . $i;
            exit;
        } elseif (isset($data['tool_responses'][0]['output'])) {
            file_put_contents('found_sections.txt', $data['tool_responses'][0]['output']);
            echo "Extracted from line " . $i;
            exit;
        }
    }
}
