<?php
$c = file_get_contents('app/Models/Booking.php');

$newMethods = <<<PHP

    public function getTotalRevenue() {
        \$this->db->query("SELECT SUM(total_price) as total FROM bookings WHERE status = 'confirmed'");
        \$row = \$this->db->single();
        return (is_object(\$row) ? \$row->total : \$row['total']) ?? 0;
    }

    public function getRecentBookings(\$limit = 4) {
        \$this->db->query("SELECT b.*, u.fullname, u.email, f.flight_code, f.departure, f.destination 
                          FROM bookings b 
                          LEFT JOIN users u ON b.user_id = u.id 
                          LEFT JOIN flights f ON b.flight_id = f.id
                          ORDER BY b.created_at DESC LIMIT :limit");
        \$this->db->bind(':limit', \$limit);
        return \$this->db->resultSet();
    }
PHP;

// Find the last closing brace
$pos = strrpos($c, '}');
if ($pos !== false) {
    $c = substr_replace($c, $newMethods . "\n}", $pos, 1);
    file_put_contents('app/Models/Booking.php', $c);
    echo "Added getTotalRevenue and getRecentBookings to Booking.php";
} else {
    echo "Could not find closing brace";
}
