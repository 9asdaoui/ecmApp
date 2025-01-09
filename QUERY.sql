CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    image VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') DEFAULT 'client'
);

CREATE TABLE clients (
    user_id INT PRIMARY KEY,
    is_active BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (user_id) REFERENCES users(id) 
);

CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    total_price FLOAT,
    order_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT,
    product_id INT,
    quantity INT NOT NULL,
    price FLOAT NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price FLOAT NOT NULL,
    quantity INT NOT NULL,
    category VARCHAR(100),
    image VARCHAR(255)
);


INSERT INTO orders (user_id, status, total_price) 
VALUES (1, 'pending', 99.99);

INSERT INTO order_items (order_id, product_id, quantity, price)
VALUES 
    (1, 101, 2, 19.99),  -- Order ID 1, Product ID 101, Quantity 2, Price 19.99 each
    (1, 102, 1, 59.99);  -- Order ID 1, Product ID 102, Quantity 1, Price 59.99 each

