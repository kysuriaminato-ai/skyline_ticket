<?php
// app/Models/Booking.php

class Booking {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Gợi ý: Hàm tạo đơn đặt vé mới sau khi khách hàng thanh toán
    public function createBooking($data) {
        // TODO: Logic thêm dữ liệu vào bảng bookings
        /*
        $this->db->query("INSERT INTO bookings (user_id, flight_id, fullname, phone, email, cabin_class, total_price, status) 
                          VALUES (:user_id, :flight_id, :fullname, :phone, :email, :cabin_class, :total_price, :status)");
        ... bind data ...
        return $this->db->execute();
        */
    }

    // Gợi ý: Lấy danh sách vé đã đặt của một người dùng (dùng cho trang Hồ sơ)
    public function getBookingsByUser($userId) {
        // TODO: Logic lấy vé theo user_id
        /*
        $this->db->query("SELECT * FROM bookings WHERE user_id = :user_id ORDER BY created_at DESC");
        $this->db->bind(':user_id', $userId);
        return $this->db->resultSet();
        */
    }

    // Lấy tổng số đặt chỗ
    public function getTotalBookings() {
        $this->db->query("SELECT COUNT(*) as total FROM bookings");
        $row = $this->db->single();
        return $row['total'];
    }

    // Lấy tất cả đặt chỗ
    public function getAllBookings() {
        $this->db->query("SELECT * FROM bookings ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Lấy booking theo ID
    public function getBookingById($id) {
        $this->db->query("SELECT * FROM bookings WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
?>