<?php
// app/Models/Booking.php

class Booking {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    // ==============================================================
    // 1. TẠO ĐƠN HÀNG MỚI
    // ==============================================================
    public function createBooking($data) {
        $this->db->query("INSERT INTO bookings 
                          (user_id, flight_id, booking_code, passengers_count, total_price, status, contact_name, contact_phone, contact_email, addons_info) 
                          VALUES 
                          (:user_id, :flight_id, :booking_code, :passengers_count, :total_price, :status, :contact_name, :contact_phone, :contact_email, :addons_info)");
        
        $this->db->bind(':user_id', $data['user_id']);
        $this->db->bind(':flight_id', $data['flight_id']);
        $this->db->bind(':booking_code', $data['booking_code']);
        $this->db->bind(':passengers_count', $data['passengers_count']);
        $this->db->bind(':total_price', $data['total_price']);
        $this->db->bind(':status', $data['status']);
        $this->db->bind(':contact_name', $data['contact_name'] ?? null);
        $this->db->bind(':contact_phone', $data['contact_phone'] ?? null);
        $this->db->bind(':contact_email', $data['contact_email'] ?? null);
        $this->db->bind(':addons_info', $data['addons_info'] ?? null);
        
        if($this->db->execute()) {
            $this->db->query("SELECT LAST_INSERT_ID() as id");
            $row = $this->db->single();
            return is_object($row) ? $row->id : $row['id'];
        }
        return false;
    }

    // ==============================================================
    // 2. LẤY ĐƠN HÀNG BẰNG MÃ CODE
    // ==============================================================
    public function getBookingByCode($code) {
        $this->db->query("SELECT b.*, u.fullname, u.email, f.flight_code, f.departure, f.destination, f.departure_time 
                          FROM bookings b
                          LEFT JOIN users u ON b.user_id = u.id
                          LEFT JOIN flights f ON b.flight_id = f.id
                          WHERE b.booking_code = :code");
        $this->db->bind(':code', $code);
        $result = $this->db->single();
        return $result ? (array)$result : false; 
    }

    // ==============================================================
    // 3. CẬP NHẬT TRẠNG THÁI
    // ==============================================================
    public function updateBookingStatus($code, $status) {
        $this->db->query("UPDATE bookings SET status = :status WHERE booking_code = :code");
        $this->db->bind(':status', $status);
        $this->db->bind(':code', $code);
        return $this->db->execute();
    }

    // ==============================================================
    // 4. LẤY DANH SÁCH VÉ CỦA USER (Profile)
    // ==============================================================
    public function getBookingsByUser($userId) {
        $this->db->query("SELECT b.*, f.flight_code, f.departure, f.destination, f.departure_time 
                          FROM bookings b 
                          JOIN flights f ON b.flight_id = f.id 
                          WHERE b.user_id = :user_id 
                          ORDER BY b.created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
    }

    // ==============================================================
    // 5. CÁC HÀM CHO ADMIN (Thống kê và Quản lý)
    // ==============================================================
    public function getTotalBookings() {
        $this->db->query("SELECT COUNT(*) as total FROM bookings");
        $row = $this->db->single();
        return is_object($row) ? $row->total : $row['total'];
    }

    public function getAllBookings() {
        $this->db->query("SELECT b.*, u.fullname, u.email, f.flight_code 
                          FROM bookings b 
                          LEFT JOIN users u ON b.user_id = u.id 
                          LEFT JOIN flights f ON b.flight_id = f.id
                          ORDER BY b.created_at DESC");
        return $this->db->resultSet();
    }

    public function getBookingById($id) {
        $this->db->query("SELECT b.*, u.fullname, u.email, f.flight_code, f.departure, f.destination, f.departure_time 
                          FROM bookings b
                          LEFT JOIN users u ON b.user_id = u.id
                          LEFT JOIN flights f ON b.flight_id = f.id
                          WHERE b.id = :id");
        $this->db->bind(':id', $id);
        $result = $this->db->single();
        return $result ? (array)$result : false;
    }

    // --- HÀM MỚI BỔ SUNG CHO TRANG BÁO CÁO (Tránh lỗi Undefined Method) ---
    public function getMonthlyBookingsReport() {
        $this->db->query("SELECT MONTH(created_at) as month, COUNT(*) as count 
                          FROM bookings 
                          WHERE YEAR(created_at) = YEAR(CURDATE()) 
                          GROUP BY MONTH(created_at)");
        return $this->db->resultSet();
    }
}
?>