-- Tạo cơ sở dữ liệu userdb nếu chưa tồn tại
CREATE DATABASE IF NOT EXISTS userdb
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

-- Chọn cơ sở dữ liệu userdb
USE userdb;

-- Tạo bảng users
CREATE TABLE IF NOT EXISTS users
(
    -- Mã tài khoản tự động tăng
    id INT AUTO_INCREMENT PRIMARY KEY,

    -- Tên đăng nhập
    username VARCHAR(100) NOT NULL UNIQUE,

    -- Email
    email VARCHAR(150) NOT NULL UNIQUE,

    -- Mật khẩu đã được mã hóa
    password VARCHAR(255) NOT NULL,

    -- Thời gian tạo tài khoản
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);