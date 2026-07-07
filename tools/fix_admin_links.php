<?php
$files = [
    'app/Views/admin/user_role.php',
    'app/Views/admin/flight_seats.php',
    'app/Views/admin/flight_price.php',
    'app/Views/admin/bookings_list.php'
];

foreach ($files as $file) {
    if (file_exists($file)) {
        $c = file_get_contents($file);
        // Avoid the closing tag issue by concatenating strings
        $replaceString = 'href="<?' . '= BASEURL ?' . '>/admin/';
        $c = str_replace('href="/admin/', $replaceString, $c);
        file_put_contents($file, $c);
        echo "Fixed links in $file\n";
    }
}
