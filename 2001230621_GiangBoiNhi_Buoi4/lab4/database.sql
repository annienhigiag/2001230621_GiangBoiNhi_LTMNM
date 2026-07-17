-- ===========================================
-- Tạo CSDL
-- ===========================================

CREATE DATABASE IF NOT EXISTS labdb
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE labdb;

-- ===========================================
-- Tạo bảng students
-- ===========================================

CREATE TABLE students
(
    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    email VARCHAR(100) UNIQUE,

    phone VARCHAR(20),

    birthday DATE
);

-- ===========================================
-- Dữ liệu mẫu
-- ===========================================

INSERT INTO students(name,email,phone,birthday)
VALUES
('Nguyễn Văn A','a@gmail.com','0900000001','2003-05-10'),

('Trần Thị B','b@gmail.com','0900000002','2002-08-20'),

('Lê Văn C','c@gmail.com','0900000003','2004-01-15'),

('Phạm Thị D','d@gmail.com','0900000004','2003-11-09'),

('Hoàng Văn E','e@gmail.com','0900000005','2002-12-30');