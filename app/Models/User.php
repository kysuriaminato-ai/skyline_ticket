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

        return $row ? true : false;
    }

    // Đăng ký tài khoản người dùng mới (ĐÃ CẬP NHẬT THÊM TRƯỜNG)
    /**
     * @param array $data
     * @return bool
     */
    public function register(array $data): bool {
        $this->db->query("INSERT INTO users (title, gender, fullname, dob, nationality, email, phone, password) 
                          VALUES (:title, :gender, :fullname, :dob, :nationality, :email, :phone, :password)");
        
        // Gán các giá trị
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':gender', $data['gender']);
        $this->db->bind(':fullname', $data['fullname']);
        $this->db->bind(':dob', $data['dob']);
        $this->db->bind(':nationality', $data['nationality']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':phone', $data['phone']);
        $this->db->bind(':password', $data['password']);

        return $this->db->execute();
    }

    // Xử lý đăng nhập
    /**
     * @param string $email
     * @param string $password
     * @return mixed
     */
    public function login(string $email, string $password) {
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        if ($row) {
            if (password_verify($password, $row['password'])) {
                return $row; 
            }
        }
        return false;
    }

    // Lấy tổng số người dùng
    public function getTotalUsers(): int {
        $this->db->query("SELECT COUNT(*) as total FROM users");
        $row = $this->db->single();
        return (int)$row['total'];
    }

    // Lấy tất cả người dùng
    public function getAllUsers(): array {
        $this->db->query("SELECT id, fullname, email, role, created_at FROM users ORDER BY created_at DESC");
        return $this->db->resultSet();
    }

    // Cập nhật role của user
    public function updateRole(int $userId, string $role): bool {
        $this->db->query("UPDATE users SET role = :role WHERE id = :id");
        $this->db->bind(':role', $role);
        $this->db->bind(':id', $userId);
        return $this->db->execute();
    }

    // Lấy user theo ID
    public function getUserById(int $id) {
        $this->db->query("SELECT * FROM users WHERE id = :id");
        $this->db->bind(':id', $id);
        return $this->db->single();
    }
}
?>