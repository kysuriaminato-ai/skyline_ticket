<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$bad_start = strpos($content, '<!DOCTYPE html>', 100); // Find second DOCTYPE
$bad_end = strpos($content, '.service-item:hover { color: #005e6a; transform: translateY(-3px); }', $bad_start);

if ($bad_start !== false && $bad_end !== false) {
    $good_css = <<<EOD
        .footer-link { color: #555; text-decoration: none; transition: 0.3s; display: inline-block; font-size: 14px; cursor: pointer; }
        .footer-link:hover { color: #005e6a; transform: translateX(3px); }

        @media (max-width: 768px) {
            .mega-dropdown { flex-direction: column; width: 100vw; position: fixed; top: auto; bottom: 0; height: 70vh; border-radius: 20px 20px 0 0; z-index: 1050; }
            .region-tabs { width: 100%; display: flex; overflow-x: auto; border-right: none; border-bottom: 1px solid #e0e0e0; }
            .region-tab { white-space: nowrap; border-bottom: none; border-right: 1px solid #eee; }
            .btn-swap { transform: translate(-50%, -50%) rotate(90deg); }
            .btn-swap:hover { transform: translate(-50%, -50%) rotate(270deg); }
            .quick-links { justify-content: flex-start; }
            .quick-link-item { width: calc(50% - 15px); margin-bottom: 10px;}
            
            /* Make promo popup responsive and avoid overlapping mobile UI */
            .promo-popup { 
                bottom: 80px !important; 
                right: 20px !important; 
                width: calc(100% - 40px) !important;
                max-width: 320px;
                padding: 15px 15px 10px !important;
                display: block !important;
            }
            .promo-popup .qr-container { display: none !important; }
        }

        /* EXTRA SERVICES ICONS */
        .extra-services { margin-top: 30px; border-top: 1px solid #e0e0e0; padding-top: 25px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 10px;}
        .service-item { text-align: center; text-decoration: none; color: #555; font-size: 12px; font-weight: bold; flex: 1; min-width: 80px; display: flex; flex-direction: column; align-items: center; transition: 0.3s; text-transform: uppercase; }
        
EOD;

    // We replace from the second DOCTYPE to just before the service-item:hover rule
    $fixed = substr($content, 0, $bad_start) . $good_css . substr($content, $bad_end);
    file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $fixed);
    echo "Fixed duplicate HTML successfully!";
} else {
    echo "Could not find the bounds to fix.";
}
