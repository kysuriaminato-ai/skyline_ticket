<?php
$c = file_get_contents('app/Views/flights/search.php');

// Fix price label: put đ after the number
$c = str_replace(
    '"Lên đến đ " + formatter.format(this.value)',
    '"Lên đến " + formatter.format(this.value) + " đ"',
    $c
);

// Also fix old format if it's still there
$c = str_replace(
    '"Up to đ " + formatter.format(this.value)',
    '"Lên đến " + formatter.format(this.value) + " đ"',
    $c
);

file_put_contents('app/Views/flights/search.php', $c);
echo "Price label fixed!";
