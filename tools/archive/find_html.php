<?php
$path = 'C:\\Users\\MAi THU\\.gemini\\antigravity-ide\\brain\\084bed10-86e1-4182-ad15-9e743bede842\\.system_generated\\logs\\transcript_full.jsonl';
$lines = file($path);
$html = "";
foreach ($lines as $i => $line) {
    if (stripos($line, 'top-airlines-section') !== false) {
        $data = json_decode($line, true);
        if (isset($data['content'])) {
            $html .= "\n\n--- From Line $i (Content) ---\n" . substr($data['content'], 0, 1000);
        }
        if (isset($data['tool_calls'])) {
            foreach ($data['tool_calls'] as $call) {
                if ($call['name'] === 'replace_file_content' || $call['name'] === 'multi_replace_file_content' || $call['name'] === 'write_to_file') {
                    $html .= "\n\n--- From Line $i (Tool Call) ---\n" . json_encode($call);
                }
            }
        }
        if (isset($data['tool_responses'][0]['output'])) {
            $html .= "\n\n--- From Line $i (Response) ---\n" . substr($data['tool_responses'][0]['output'], 0, 1000);
        }
    }
}
file_put_contents('top_airlines_search.txt', $html);
echo "Done";
