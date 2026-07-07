<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript_full.jsonl';
$lines = file($path);
$recovered_css = "";
$recovered_html = "";
$recovered_js = "";

foreach ($lines as $line) {
    if (strpos($line, 'multi_replace_file_content') !== false && (stripos($line, 'top-airlines-section') !== false || stripos($line, 'category-pill') !== false)) {
        $data = json_decode($line, true);
        if (isset($data['tool_calls'])) {
            foreach ($data['tool_calls'] as $call) {
                if ($call['name'] === 'multi_replace_file_content') {
                    file_put_contents('recovered_tool_call_' . rand(1000,9999) . '.json', json_encode($call, JSON_PRETTY_PRINT));
                }
            }
        }
    }
}
echo "Saved tool calls";
