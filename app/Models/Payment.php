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
        $this->db->query("SELECT * FROM payments ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // --- HÀM MỚI BỔ SUNG CHO TRANG BÁO CÁO (Tránh lỗi Undefined Method) ---
    // ==============================================================
    // Lấy doanh thu theo từng tháng của năm hiện tại
    // ==============================================================
    public function getMonthlyRevenueReport() {
        $this->db->query("SELECT MONTH(created_at) as month, SUM(amount) as revenue 
                          FROM payments 
                          WHERE status = 'completed' AND YEAR(created_at) = YEAR(CURDATE()) 
                          GROUP BY MONTH(created_at)");
        return $this->db->resultSet();
    }
    
    // (Lưu ý: Nếu bạn có sẵn các hàm tạo thanh toán (createPayment) thì cứ giữ nguyên nhé)
}
?>