CREATE TABLE products(id INT AUTO_INCREMENT PRIMARY KEY,name VARCHAR(150) NOT NULL,price DECIMAL(10,2)NOT NULL,decsription TEXT,image VARCHAR(255),category VARCHAR(100),create_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP);






CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(200),
    price INT,
    image VARCHAR(200),
    category VARCHAR(50)
);



CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    address TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE order_items(
id INT AUTO_INCREMENT PRIMARY KEY,
order_id INT,
product_id INT,
quantity INT,
price FLOAT
);


CREATE TABLE orders(
id INT AUTO_INCREMENT PRIMARY KEY,
user_id INT,
total_amount FLOAT,
order_date DATETIME
);


CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

UPDATE orders SET status='Confirmed' WHERE status='confirmed';
UPDATE orders SET status='Pending' WHERE status='pending';


CREATE TABLE shipping (
id INT AUTO_INCREMENT PRIMARY KEY,
order_id INT,
fullname VARCHAR(100),
address TEXT,
city VARCHAR(100),
mobile VARCHAR(20)
);

ALTER TABLE orders ADD status VARCHAR(20) DEFAULT 'Pending';

ALTER TABLE orders 
ADD status VARCHAR(20) DEFAULT 'Pending';