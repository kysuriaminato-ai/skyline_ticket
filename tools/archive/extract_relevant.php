<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript_full.jsonl';
$lines = file($path);
$calls = [];
foreach ($lines as $i => $line) {
    if (strpos($line, 'replace_file_content') !== false && (stripos($line, 'CATEGORIES') !== false || stripos($line, 'CLIENT REVIEW') !== false)) {
        $data = json_decode($line, true);
        if (isset($data['tool_calls'])) {
            foreach ($data['tool_calls'] as $call) {
                if ($call['name'] === 'replace_file_content' || $call['name'] === 'multi_replace_file_content') {
                    $calls[] = ["line" => $i, "call" => $call];
                }
            }
        }
    }
}
file_put_contents('all_relevant_tool_calls.json', json_encode($calls, JSON_PRETTY_PRINT));
echo "Saved " . count($calls) . " tool calls.";
