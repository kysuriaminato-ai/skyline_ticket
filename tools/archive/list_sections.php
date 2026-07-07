<?php
$c = file_get_contents('c:\\xampp\\htdocs\\skyline_ticket\\app\\Views\\home\\index.php');
preg_match_all('/<!-- ================= (.*?) ================= -->/', $c, $m);
print_r($m[1]);
