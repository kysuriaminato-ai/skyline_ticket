<?php
$content = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');

$replacements = [
    'https://upload.wikimedia.org/wikipedia/vi/thumb/e/e1/Vietnam_Airlines_Logo_-_Bi%E1%BB%83u_t%C6%B0%E1%BB%A3ng_c%E1%BB%A7a_Vietnam_Airlines.svg/1200px-Vietnam_Airlines_Logo_-_Bi%E1%BB%83u_t%C6%B0%E1%BB%A3ng_c%E1%BB%A7a_Vietnam_Airlines.svg.png' => 'https://logo.clearbit.com/vietnamairlines.com',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/8/8e/VietJet_Air_logo.svg/2560px-VietJet_Air_logo.svg.png' => 'https://logo.clearbit.com/vietjetair.com',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/4/4d/Bamboo_Airways_logo.svg/2560px-Bamboo_Airways_logo.svg.png' => 'https://logo.clearbit.com/bambooairways.com',
    'https://upload.wikimedia.org/wikipedia/en/thumb/6/6b/Singapore_Airlines_Logo_2.svg/1200px-Singapore_Airlines_Logo_2.svg.png' => 'https://logo.clearbit.com/singaporeair.com',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/0/09/Thai_Airways_Logo.svg/2560px-Thai_Airways_Logo.svg.png' => 'https://logo.clearbit.com/thaiairways.com',
    'https://upload.wikimedia.org/wikipedia/en/thumb/9/9b/Qatar_Airways_Logo.svg/1200px-Qatar_Airways_Logo.svg.png' => 'https://logo.clearbit.com/qatarairways.com',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/Emirates_logo.svg/1200px-Emirates_logo.svg.png' => 'https://logo.clearbit.com/emirates.com',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/5/51/Korean_Air_Logo.svg/1200px-Korean_Air_Logo.svg.png' => 'https://logo.clearbit.com/koreanair.com',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/3/34/Japan_Airlines_Logo_%28Arrow%29.svg/2560px-Japan_Airlines_Logo_%28Arrow%29.svg.png' => 'https://logo.clearbit.com/jal.co.jp',
    'https://upload.wikimedia.org/wikipedia/commons/thumb/9/98/All_Nippon_Airways_Logo.svg/2560px-All_Nippon_Airways_Logo.svg.png' => 'https://logo.clearbit.com/ana.co.jp',
    'https://upload.wikimedia.org/wikipedia/en/thumb/1/17/Cathay_Pacific_logo.svg/1200px-Cathay_Pacific_logo.svg.png' => 'https://logo.clearbit.com/cathaypacific.com',
    'https://upload.wikimedia.org/wikipedia/en/thumb/3/3a/EVA_Air_logo.svg/1200px-EVA_Air_logo.svg.png' => 'https://logo.clearbit.com/evaair.com'
];

foreach ($replacements as $old => $new) {
    $content = str_replace($old, $new, $content);
}

file_put_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php', $content);
echo "Replaced logos.";
