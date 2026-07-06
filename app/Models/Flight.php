<?php
class Flight {
    private Database $db;

    public function __construct() {
        $this->db = new Database(); // Class bọc PDO
    }
    public function getAllFlights() { 
        $this->db->query("SELECT * FROM flights WHERE status = 1 ORDER BY departure_time ASC");
        return $this->db->resultSet();
    }
    public function searchFlights($from, $to, $date, $airlines, $maxPrice) {
        $query = "SELECT * FROM flights WHERE status = 1";
        
        if (!empty($from)) {
            $query .= " AND departure = :from";
        }
        if (!empty($to)) {
            $query .= " AND destination = :to";
        }
        if (!empty($date)) {
            $query .= " AND DATE(departure_time) = :date";
        }
        if (!empty($airlines)) {
            $query .= " AND airlines = :airlines";
        }
        if (!empty($maxPrice)) {
            $query .= " AND price <= :maxPrice";
        }
        
        $query .= " ORDER BY departure_time ASC";
        
        $this->db->query($query);
        
        if (!empty($from)) $this->db->bind(':from', $from);
        if (!empty($to)) $this->db->bind(':to', $to);
        if (!empty($date)) $this->db->bind(':date', $date);
        if (!empty($airlines)) $this->db->bind(':airlines', $airlines);
        if (!empty($maxPrice)) $this->db->bind(':maxPrice', $maxPrice);
        
        return $this->db->resultSet();
    }

    // Thêm hàm này vào trong class Flight
    public function getFlightById($id) {
        $this->db->query("SELECT * FROM flights WHERE id = :id AND status = 1");
        $this->db->bind(':id', $id);
        return $this->db->single(); // Trả về 1 dòng dữ liệu duy nhất
    }

    // Lấy tổng số chuyến bay
    public function getTotalFlights() {
        $this->db->query("SELECT COUNT(*) as total FROM flights WHERE status = 1");
        $row = $this->db->single();
        return $row['total'];
    }

    // Cập nhật giá vé
    public function updatePrice($flightId, $price) {
        $this->db->query("UPDATE flights SET price = :price WHERE id = :id");
        $this->db->bind(':price', $price);
        $this->db->bind(':id', $flightId);
        return $this->db->execute();
    }

    // Cập nhật số ghế
    public function updateSeats($flightId, $totalSeats, $availableSeats) {
        $this->db->query("UPDATE flights SET total_seats = :total, available_seats = :available WHERE id = :id");
        $this->db->bind(':total', $totalSeats);
        $this->db->bind(':available', $availableSeats);
        $this->db->bind(':id', $flightId);
        return $this->db->execute();
    }

    // Giảm ghế available khi đặt
    public function bookSeat($flightId) {
        $this->db->query("UPDATE flights SET available_seats = available_seats - 1 WHERE id = :id AND available_seats > 0");
        $this->db->bind(':id', $flightId);
        return $this->db->execute();
    }
}
?>

