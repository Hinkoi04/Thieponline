CREATE DATABASE IF NOT EXISTS graduation_invitation CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE graduation_invitation;

-- Bảng lưu thông tin thiệp và đường dẫn ảnh
CREATE TABLE IF NOT EXISTS page_info (
    id INT PRIMARY KEY AUTO_INCREMENT,
    grad_name VARCHAR(100),
    event_date DATE,
    event_time VARCHAR(20),
    location_name VARCHAR(255),
    address TEXT,
    quote TEXT,
    hero_image VARCHAR(255) DEFAULT 'uploads/hero_default.jpg',
    avatar_image VARCHAR(255) DEFAULT 'uploads/avatar_default.jpg'
);

-- Thêm dữ liệu mẫu cho thông tin
INSERT INTO page_info (grad_name, event_date, event_time, location_name, address, quote) 
VALUES ('Nguyễn Lê An Ngọc', '2026-07-20', '07:30', 'Trường Đại học Thăng Long', 'Đường Nghiêm Xuân Yêm, Định Công, Hà Nội', 'Mong những lời chúc phúc của bạn ngày chia tay là chiếc ô che nắng, che mưa cho tôi vượt mọi chông gai đời người.');

-- Bảng lưu lời chúc (RSVP)
CREATE TABLE IF NOT EXISTS rsvp_messages (
    id INT PRIMARY KEY AUTO_INCREMENT,
    guest_name VARCHAR(100),
    message TEXT,
    attendance_status VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Bảng lưu lịch trình sự kiện (Timeline)
CREATE TABLE IF NOT EXISTS timeline (
    id INT PRIMARY KEY AUTO_INCREMENT,
    time_str VARCHAR(20),
    description VARCHAR(255),
    order_num INT DEFAULT 0
);

-- Thêm dữ liệu mẫu cho Lịch trình
INSERT INTO timeline (time_str, description, order_num) VALUES 
('07:30', 'Làm lễ ở hội trường', 1),
('10:30', 'Chung vui và chụp ảnh', 2);