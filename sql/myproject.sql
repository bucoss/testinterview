CREATE DATABASE IF NOT EXISTS myproject;
USE myproject;


CREATE TABLE IF NOT EXISTS products (
                                        id INT AUTO_INCREMENT PRIMARY KEY,
                                        name VARCHAR(50) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    availability_date DATE,
    in_stock TINYINT(1) NOT NULL DEFAULT 1
    );

INSERT INTO products (name, description, price, image, availability_date, in_stock) VALUES
                                                                                        ('Laptop ASUS ROG', 'Laptop de gaming performant', 5200.00, 'test', '2025-04-10', 1),
                                                                                        ('iPhone 14 Pro', 'Telefon flagship cu cameră avansată', 6200.00, 'test', '2025-05-01', 1),
                                                                                        ('Căști Wireless Sony', 'Căști noise-canceling premium', 899.99, 'test', '2025-03-25', 1),
                                                                                        ('Monitor Dell 27"', 'Monitor 4K cu refresh rate 144Hz', 2300.00, 'test', '2025-04-05', 1),
                                                                                        ('Tastatură mecanică', 'Tastatură RGB cu switch-uri mecanice', 450.50, 'test', '2025-03-30', 1);
