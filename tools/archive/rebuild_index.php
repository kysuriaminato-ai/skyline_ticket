<?php
$index_php = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$tool_calls_json = file_get_contents('all_relevant_tool_calls.json');
$tool_calls = json_decode($tool_calls_json, true);

$css = $tool_calls[0]['call']['args']['ReplacementChunks'][0]['ReplacementContent'];
$css = str_replace("        .review-bg-circle { position: absolute; width: 380px; height: 380px; border-radius: 50%; background: #f0f6ff; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 1; }\n\n", "", $css);

$top_airlines_html = $tool_calls[0]['call']['args']['ReplacementChunks'][1]['ReplacementContent'];
$top_airlines_js = $tool_calls[0]['call']['args']['ReplacementChunks'][2]['ReplacementContent'];

$categories_html = $tool_calls[1]['call']['args']['ReplacementContent'];

$recovered_bottom = file_get_contents('recovered_chunk_800.txt');

// 1. Insert CSS
$index_php = str_replace("    </style>", $css, $index_php);

// 2. We need to replace from `<!-- ================= DESTINATIONS SECTION ================= -->` to the end of the file.
// First, modify $recovered_bottom to inject TOP AIRLINES
$recovered_bottom = str_replace("    <!-- ================= CLIENT REVIEW SECTION ================= -->", $top_airlines_html, $recovered_bottom);

// Inject JS
$recovered_bottom = str_replace("                upgradeSubmenu.style.display = 'flex';\n                }\n            });\n        }\n    </script>", $top_airlines_js, $recovered_bottom);

// Combine CATEGORIES + RECOVERED BOTTOM
$combined_bottom = $categories_html . "\n" . $recovered_bottom;

// Now cut the original index.php at `<!-- ================= DESTINATIONS SECTION ================= -->`
$pos = strpos($index_php, "<!-- ================= DESTINATIONS SECTION ================= -->");
$new_index_php = substr($index_php, 0, $pos) . $combined_bottom;

file_put_contents('new_index.php', $new_index_php);
echo "Done building new_index.php";
