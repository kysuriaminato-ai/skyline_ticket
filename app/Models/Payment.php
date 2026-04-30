<?php
// app/Models/Payment.php

class Payment {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    // Tạo thanh toán mới
    public function createPayment($data) {
        $this->db->query("INSERT INTO payments (booking_id, amount, payment_method, status) VALUES (:booking_id, :amount, :payment_method, :status)");
        $this->db->bind(':booking_id', $data['booking_id']);
        $this->db->bind(':amount', $data['amount']);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':status', $data['status']);
        return $this->db->execute();
    }

    // Lấy tất cả thanh toán
    public function getAllPayments() {
        $this->db->query("SELECT * FROM payments ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Lấy thanh toán theo booking
    public function getPaymentsByBooking($bookingId) {
        $this->db->query("SELECT * FROM payments WHERE booking_id = :booking_id");
        $this->db->bind(':booking_id', $bookingId);
        return $this->db->resultSet();
    }

    // Cập nhật trạng thái thanh toán
    public function updatePaymentStatus($paymentId, $status) {
        $this->db->query("UPDATE payments SET status = :status WHERE id = :id");
        $this->db->bind(':status', $status);
        $this->db->bind(':id', $paymentId);
        return $this->db->execute();
    }

    // Lấy tổng doanh thu
    public function getTotalRevenue() {
        $this->db->query("SELECT SUM(amount) as total FROM payments WHERE status = 'completed'");
        $row = $this->db->single();
        return $row['total'] ?? 0;
    }
}
?>