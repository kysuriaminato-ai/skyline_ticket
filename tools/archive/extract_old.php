<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript.jsonl';
$lines = file($path);
$output = [];
foreach ($lines as $line) {
    if (strpos($line, 'Showing lines 280 to 790') !== false) {
        $data = json_decode($line, true);
        $text = isset($data['content']) ? $data['content'] : '';
        
        $tlines = explode("\n", str_replace('\n', "\n", $text));
        
        foreach ($tlines as $tline) {
            $tline = rtrim($tline); // only right trim to preserve indent
            if (preg_match('/^\d+: (.*)$/', $tline, $matches)) {
                $output[] = $matches[1];
            } elseif (preg_match('/^\d+:$/', $tline, $matches)) {
                $output[] = '';
            }
        }
    }
}
file_put_contents('recovered_block.txt', implode("\n", $output));
echo 'Recovered ' . count($output) . ' lines.';
