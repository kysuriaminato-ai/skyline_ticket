<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript_full.jsonl';
$lines = file($path);
$output = [];
foreach ($lines as $line) {
    if (strpos($line, 'Showing lines 800 to 1274') !== false) {
        $data = json_decode($line, true);
        $text = isset($data['content']) ? $data['content'] : '';
        if (!$text && isset($data['tool_responses'][0]['output'])) {
            $text = $data['tool_responses'][0]['output'];
        }
        
        $tlines = explode("\n", str_replace('\n', "\n", $text));
        
        foreach ($tlines as $tline) {
            $tline = rtrim($tline); // only right trim to preserve indent
            if (preg_match('/^(\d+): (.*)$/', $tline, $matches)) {
                $output[] = $matches[2];
            } elseif (preg_match('/^(\d+):$/', $tline, $matches)) {
                $output[] = '';
            }
        }
        break;
    }
}
file_put_contents('recovered_chunk_800.txt', implode("\n", $output));
echo 'Recovered ' . count($output) . ' lines.';
