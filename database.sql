-- Skyline Ticket Database Setup
-- Import file này vào phpMyAdmin

-- Tạo Database
CREATE DATABASE IF NOT EXISTS flight_db;
USE flight_db;

-- ==================== USERS TABLE ====================
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==================== FLIGHTS TABLE ====================
CREATE TABLE IF NOT EXISTS flights (
    id INT PRIMARY KEY AUTO_INCREMENT,
    flight_code VARCHAR(20) UNIQUE NOT NULL,
    departure VARCHAR(100) NOT NULL,
    destination VARCHAR(100) NOT NULL,
    departure_time DATETIME NOT NULL,
    arrival_time DATETIME NOT NULL,
    total_seats INT NOT NULL DEFAULT 180,
    available_seats INT NOT NULL DEFAULT 180,
    price DECIMAL(10, 2) NOT NULL,
    airlines VARCHAR(100),
    status INT DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==================== BOOKINGS TABLE ====================
CREATE TABLE IF NOT EXISTS bookings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    flight_id INT NOT NULL,
    booking_code VARCHAR(20) UNIQUE NOT NULL,
    passengers_count INT DEFAULT 1,
    total_price DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (flight_id) REFERENCES flights(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==================== PAYMENTS TABLE ====================
CREATE TABLE IF NOT EXISTS payments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    booking_id INT NOT NULL,
    amount DECIMAL(10, 2) NOT NULL,
    payment_method VARCHAR(50),
    status ENUM('pending', 'completed', 'failed') DEFAULT 'pending',
    transaction_id VARCHAR(100),
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ==================== INSERT SAMPLE DATA ====================

-- Thêm admin user
INSERT INTO users (fullname, email, password, role) VALUES
('Admin User', 'admin@skyline.com', '$2y$10$G1YE7.3e7SLBkPn4aEeVm.kTQ3VJ7RBUP8XWXKzVHhY1rH/2PVhW2', 'admin');
-- Password: admin123 (bcrypt hash)

-- Thêm sample users
INSERT INTO users (fullname, email, password, role) VALUES
('Nguyễn Văn A', 'user1@example.com', '$2y$10$J.4VFSgLSmQ1nWZ5c.BVouK5Q5K3S2c1O9J7Q1K2L3M4N5O6P7Q8R9', 'user'),
('Trần Thị B', 'user2@example.com', '$2y$10$J.4VFSgLSmQ1nWZ5c.BVouK5Q5K3S2c1O9J7Q1K2L3M4N5O6P7Q8R9', 'user'),
('Phạm Văn C', 'user3@example.com', '$2y$10$J.4VFSgLSmQ1nWZ5c.BVouK5Q5K3S2c1O9J7Q1K2L3M4N5O6P7Q8R9', 'user');
-- Mật khẩu mẫu: user123

-- Thêm sample flights
INSERT INTO flights (flight_code, departure, destination, departure_time, arrival_time, total_seats, available_seats, price, airlines, status) VALUES
('SL101', 'Hà Nội (HAN)', 'TP Hồ Chí Minh (SGN)', '2026-05-05 08:00:00', '2026-05-05 10:30:00', 180, 150, 1200000, 'Vietnam Airlines', 1),
('SL102', 'TP Hồ Chí Minh (SGN)', 'Đà Nẵng (DAD)', '2026-05-05 14:00:00', '2026-05-05 15:45:00', 180, 120, 800000, 'Vietjet Air', 1),
('SL103', 'Hà Nội (HAN)', 'Phú Quốc (PQC)', '2026-05-06 06:30:00', '2026-05-06 08:15:00', 180, 100, 1500000, 'Bamboo Airways', 1),
('SL104', 'Đà Nẵng (DAD)', 'Bangkok (BKK)', '2026-05-06 10:00:00', '2026-05-06 12:30:00', 180, 80, 2500000, 'Thai Airways', 1),
('SL105', 'TP Hồ Chí Minh (SGN)', 'Hà Nội (HAN)', '2026-05-07 15:00:00', '2026-05-07 17:30:00', 180, 140, 1200000, 'Vietnam Airlines', 1);

-- Thêm sample bookings
INSERT INTO bookings (user_id, flight_id, booking_code, passengers_count, total_price, status) VALUES
(2, 1, 'BK001', 2, 2400000, 'confirmed'),
(3, 2, 'BK002', 1, 800000, 'pending'),
(4, 3, 'BK003', 3, 4500000, 'confirmed');

-- Thêm sample payments
INSERT INTO payments (booking_id, amount, payment_method, status, transaction_id) VALUES
(1, 2400000, 'credit_card', 'completed', 'TXN-001'),
(2, 800000, 'bank_transfer', 'pending', 'TXN-002'),
(3, 4500000, 'credit_card', 'completed', 'TXN-003');

-- ==================== CREATE INDEXES ====================
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_flight_code ON flights(flight_code);
CREATE INDEX idx_booking_user ON bookings(user_id);
CREATE INDEX idx_booking_flight ON bookings(flight_id);
CREATE INDEX idx_payment_booking ON payments(booking_id);
