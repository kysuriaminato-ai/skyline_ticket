<?php
$db = new PDO('mysql:host=localhost;dbname=skyline_ticket', 'root', '');
$stmt = $db->query('SELECT id, destination, status FROM flights LIMIT 10');
print_r($stmt->fetchAll(PDO::FETCH_ASSOC));
