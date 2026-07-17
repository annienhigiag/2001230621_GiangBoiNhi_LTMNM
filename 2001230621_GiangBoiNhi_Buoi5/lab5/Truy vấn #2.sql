-- Xóa CSDL nếu đã tồn tại
DROP DATABASE IF EXISTS lab3_shop;
-- Tạo mới CSDL
CREATE DATABASE lab3_shop CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
-- Sử dụng CSDL
USE lab3_shop;
-- Bảng categories
CREATE TABLE categories (
category_id INT AUTO_INCREMENT PRIMARY KEY,
category_name VARCHAR(100) NOT NULL
);
-- Bảng products
CREATE TABLE products (
product_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(150) NOT NULL,
price DECIMAL(10,2) NOT NULL,
category_id INT,
FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
-- Bảng customers
CREATE TABLE customers (
customer_id INT AUTO_INCREMENT PRIMARY KEY,
name VARCHAR(100) NOT NULL,
email VARCHAR(150) UNIQUE
);
-- Bảng orders
CREATE TABLE orders (
order_id INT AUTO_INCREMENT PRIMARY KEY,
order_date DATE NOT NULL,
customer_id INT,
FOREIGN KEY (customer_id) REFERENCES customers(customer_id)
);
-- Bảng order_details
CREATE TABLE order_details (
order_id INT,
product_id INT,
quantity INT NOT NULL,
price DECIMAL(10,2) NOT NULL,
PRIMARY KEY (order_id, product_id),
FOREIGN KEY (order_id) REFERENCES orders(order_id),
FOREIGN KEY (product_id) REFERENCES products(product_id)
);
-- Dữ liệu mẫu cho categories
INSERT INTO categories (category_name) VALUES
('Điện thoại'),
('Laptop'),
('Phụ kiện');
-- Dữ liệu mẫu cho products
INSERT INTO products (name, price, category_id) VALUES
('iPhone 15 Pro Max', 33990000, 1),
('Samsung Galaxy S24 Ultra', 28990000, 1),
('MacBook Air M2', 28990000, 2),
('Dell XPS 13', 26990000, 2),
('Tai nghe AirPods Pro 2', 5490000, 3),
('Chuột Logitech MX Master 3S', 2490000, 3),
('Cáp sạc USB-C', 199000, 3),
('iPad Pro 12.9', 30990000, 1),
('Asus ZenBook', 18990000, 2),
('Bàn phím cơ Keychron K2', 2390000, 3);
-- Dữ liệu mẫu cho customers
INSERT INTO customers (name, email) VALUES
('Nguyễn Văn A', 'a.nguyen@example.com'),
('Trần Thị B', 'b.tran@example.com'),
('Lê Văn C', 'c.le@example.com');
-- Dữ liệu mẫu cho orders
INSERT INTO orders (order_date, customer_id) VALUES
('2025-08-01', 1),
('2025-08-02', 2),
('2025-08-03', 3),
('2025-08-05', 1);
-- Dữ liệu mẫu cho order_details
INSERT INTO order_details (order_id, product_id, quantity, price) VALUES
(1, 1, 1, 33990000),
(1, 5, 2, 5490000),
(2, 3, 1, 28990000),
(3, 2, 1, 28990000),
(3, 6, 1, 2490000),
(4, 4, 1, 26990000),
(4, 7, 3, 199000);