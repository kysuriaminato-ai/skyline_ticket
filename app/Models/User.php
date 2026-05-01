<?php
// app/Models/User.php

class User {
    /** @var Database */
    private $db;

    public function __construct() {
        $this->db = new Database(); // Khởi tạo kết nối CSDL
    }

    // Kiểm tra xem email đã tồn tại trong hệ thống chưa
    /**
     * @param string $email
     * @return bool
     */
    public function findUserByEmail(string $email): bool {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        
        $row = $this->db->single();

        // Nếu có dữ liệu trả về nghĩa là email đã tồn tại
        if ($row) {
            return true;
        } else {
            return false;
        }
    }

    // Đăng ký tài khoản người dùng mới
    /**
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool {
        $this->db->query("INSERT INTO users (fullname, email, password) VALUES (:fullname, :email, :password)");
        
        // Gán các giá trị an toàn
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);

        // Thực thi câu lệnh
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }

    // Xử lý đăng nhập
    /**
     * @param string $email
     * @param string $password
     * @return mixed Trả về mảng thông tin user nếu thành công, false nếu thất bại
     */
    public function login(string $email, string $password) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        // Nếu tìm thấy người dùng
        if ($row) {
            $hashed_password = $row['password'];
            // Kiểm tra mật khẩu mã hóa
            if (password_verify($password, $hashed_password)) {
                return $row; // Đăng nhập thành công, trả về mảng thông tin người dùng
            }
        }
        
        // Đăng nhập thất bại
        return false;
    }

    // Lấy tổng số người dùng
    /**
     * @return int
     */
    public function getTotalUsers(): int {
        $this->db->query("SELECT COUNT(*) as total FROM users");
        $row = $this->db->single();
        return (int)$row['total'];
    }

    // Lấy tất cả người dùng
    /**
     * @return array
     */
    public function getAllUsers(): array {
        $this->db->query("SELECT id, fullname, email, role, created_at FROM users ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Cập nhật role của user
    /**
     * @param int $userId
     * @param string $role
     * @return bool
     */
    public function updateRole(int $userId, string $role): bool {
        $this->db->query("UPDATE users SET role = :role WHERE id = :id");
        $this->db->bind(':role', $role);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    // Lấy user theo ID
    /**
     * @param int $id
     * @return mixed Trả về mảng thông tin user hoặc false nếu không tìm thấy
     */
    public function getUserById(int $id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
?>