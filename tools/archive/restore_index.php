<?php
// Restore script to sequentially apply all modifications to index.php
echo "Starting restoration...\n";

// 1. Revert to original
exec('git checkout c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');
echo "Git checkout complete.\n";

$scripts = [
    'rebuild_layout.php',
    'fix_variables.php',
    'fix_images.php',
    'revert_images.php',
    'inject_tabs.php',
    'upgrade_ui.php',
    'update_image_links.php',
    'inject_cross_selling.php',
    'fix_service_bar.php',
    'inject_cross_selling_new.php'
];

foreach ($scripts as $script) {
    if (file_exists($script)) {
        echo "Running $script...\n";
        exec('c:\\xampp\\php\\php.exe ' . $script, $output, $return_var);
        echo implode("\n", $output) . "\n";
        $output = [];
    } else {
        echo "Missing $script\n";
    }
}
echo "Restoration finished!\n";
