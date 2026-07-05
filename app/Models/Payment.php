<?php
// app/Models/Payment.php

class Payment {
    private Database $db;

    public function __construct() {
        $this->db = new Database();
    }

    // ==============================================================
    // Lấy tổng doanh thu (cho Dashboard/Reports)
    // ==============================================================
    public function getTotalRevenue() {
        $this->db->query("SELECT SUM(amount) as total FROM payments WHERE status = 'completed'");
        $row = $this->db->single();
        
        if ($row) {
            return is_object($row) ? $row->total : ($row['total'] ?? 0);
        }
        return 0;
    }

    // ==============================================================
    // Lấy toàn bộ danh sách thanh toán (cho Báo cáo chi tiết)
    // ==============================================================
    public function getAllPayments() {
        // ĐÃ SỬA: Thay created_at thành payment_date
        $this->db->query("SELECT * FROM payments ORDER BY payment_date DESC");
        return $this->db->resultSet();
    }

    // --- HÀM MỚI BỔ SUNG CHO TRANG BÁO CÁO ---
    // ==============================================================
    // Lấy doanh thu theo từng tháng của năm hiện tại
    // ==============================================================
    public function getMonthlyRevenueReport() {
        // ĐÃ SỬA: Thay created_at thành payment_date
        $this->db->query("SELECT MONTH(payment_date) as month, SUM(amount) as revenue 
                          FROM payments 
                          WHERE status = 'completed' AND YEAR(payment_date) = YEAR(CURDATE()) 
                          GROUP BY MONTH(payment_date)");
        return $this->db->resultSet();
    }
}
?>