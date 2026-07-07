<?php
$file = 'c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php';
$content = file_get_contents($file);

// Replace shopping cart item
$content = preg_replace(
    '/<a href="#" class="service-item">\s*<i class="fas fa-shopping-cart"><\/i>\s*<span><\?= __\(\'service_nav.shopping\'\) \?><\/span>\s*<\/a>/',
    '<button type="button" class="service-item" data-bs-toggle="offcanvas" data-bs-target="#dutyFreeOffcanvas" style="background:none; border:none; color:inherit; text-decoration:none;">' . "\n" .
    '                    <i class="fas fa-shopping-cart text-danger"></i>' . "\n" .
    '                    <span><?= __(\'service_nav.shopping\') ?></span>' . "\n" .
    '                </button>',
    $content
);

// Replace hotel/tour item
$content = preg_replace(
    '/<a href="#" class="service-item">\s*<i class="fas fa-building"><\/i>\s*<span><\?= __\(\'service_nav.hotel_tour\'\) \?><\/span>\s*<\/a>/',
    '<button type="button" class="service-item" onclick="toggleContextualServices()" style="background:none; border:none; color:inherit; text-decoration:none;">' . "\n" .
    '                    <i class="fas fa-building text-primary"></i>' . "\n" .
    '                    <span><?= __(\'service_nav.hotel_tour\') ?></span>' . "\n" .
    '                </button>',
    $content
);

// Replace insurance item
$content = preg_replace(
    '/<a href="#" class="service-item">\s*<i class="fas fa-heartbeat"><\/i>\s*<span><\?= __\(\'service_nav.insurance\'\) \?><\/span>\s*<\/a>/',
    '<button type="button" class="service-item" onclick="alert(\'Vui lòng chọn chuyến bay trước. Bạn có thể thêm bảo hiểm tại bước Thanh Toán.\')" style="background:none; border:none; color:inherit; text-decoration:none;">' . "\n" .
    '                    <i class="fas fa-shield-alt text-success"></i>' . "\n" .
    '                    <span><?= __(\'service_nav.insurance\') ?></span>' . "\n" .
    '                </button>',
    $content
);

// Replace others item
$content = preg_replace(
    '/<a href="#" class="service-item">\s*<i class="fas fa-ellipsis-h"><\/i>\s*<span><\?= __\(\'service_nav.others\'\) \?><\/span>\s*<\/a>/',
    '<button type="button" class="service-item" data-bs-toggle="modal" data-bs-target="#checklistModal" style="background:none; border:none; color:inherit; text-decoration:none;">' . "\n" .
    '                    <i class="fas fa-clipboard-check text-warning"></i>' . "\n" .
    '                    <span><?= __(\'service_nav.others\') ?></span>' . "\n" .
    '                </button>',
    $content
);

file_put_contents($file, $content);
echo "Fixed via Regex!\n";
