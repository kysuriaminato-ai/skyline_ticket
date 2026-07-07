<?php
$db = new PDO('mysql:host=localhost;dbname=skyline_ticket', 'root', '');
$stmt = $db->query('DESCRIBE flights');
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
