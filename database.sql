-- Online Book Store Database Schema

CREATE DATABASE IF NOT EXISTS online_bookstore;
USE online_bookstore;

-- Admin Table
CREATE TABLE IF NOT EXISTS admin (
    admin_id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert default admin (password: admin123)
INSERT INTO admin (username, password, email, full_name) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin@bookstore.com', 'Admin User');

-- Students Table
CREATE TABLE IF NOT EXISTS students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    address TEXT,
    city VARCHAR(50),
    state VARCHAR(50),
    zip_code VARCHAR(10),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    category_id INT PRIMARY KEY AUTO_INCREMENT,
    category_name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample categories
INSERT INTO categories (category_name, description) VALUES
('Fiction', 'Novels and story books'),
('Non-Fiction', 'Real life stories and biographies'),
('Science', 'Scientific books and research'),
('Technology', 'Computer science and technology books'),
('Business', 'Business and management books'),
('Self-Help', 'Personal development books'),
('Academic', 'Educational and textbooks'),
('Children', 'Books for children');

-- Subcategories Table
CREATE TABLE IF NOT EXISTS subcategories (
    subcategory_id INT PRIMARY KEY AUTO_INCREMENT,
    category_id INT NOT NULL,
    subcategory_name VARCHAR(100) NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(category_id) ON DELETE CASCADE
);

-- Insert sample subcategories
INSERT INTO subcategories (category_id, subcategory_name) VALUES
(1, 'Mystery'), (1, 'Romance'), (1, 'Thriller'),
(2, 'Biography'), (2, 'History'), (2, 'Travel'),
(3, 'Physics'), (3, 'Chemistry'), (3, 'Biology'),
(4, 'Programming'), (4, 'Web Development'), (4, 'AI & ML'),
(5, 'Marketing'), (5, 'Finance'), (5, 'Leadership'),
(6, 'Motivation'), (6, 'Productivity'), (6, 'Health'),
(7, 'Mathematics'), (7, 'Engineering'), (7, 'Medicine'),
(8, 'Picture Books'), (8, 'Young Adult'), (8, 'Educational');

-- Books Table
CREATE TABLE IF NOT EXISTS books (
    book_id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    author VARCHAR(100) NOT NULL,
    isbn VARCHAR(20) UNIQUE,
    category_id INT NOT NULL,
    subcategory_id INT,
    description TEXT,
    price DECIMAL(10, 2) NOT NULL,
    stock_quantity INT DEFAULT 0,
    image VARCHAR(255),
    publisher VARCHAR(100),
    publication_year INT,
    pages INT,
    language VARCHAR(50) DEFAULT 'English',
    status ENUM('active', 'inactive') DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(category_id),
    FOREIGN KEY (subcategory_id) REFERENCES subcategories(subcategory_id)
);

-- Insert sample books
INSERT INTO books (title, author, isbn, category_id, subcategory_id, description, price, stock_quantity, publisher, publication_year, pages) VALUES
-- Fiction Books
('The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 1, 1, 'A classic American novel set in the Jazz Age', 12.99, 50, 'Scribner', 1925, 180),
('To Kill a Mockingbird', 'Harper Lee', '9780061120084', 1, 1, 'A gripping tale of racial injustice and childhood innocence', 14.99, 45, 'Harper Perennial', 1960, 324),
('1984', 'George Orwell', '9780451524935', 1, 3, 'A dystopian social science fiction novel', 13.99, 60, 'Signet Classic', 1949, 328),
('Pride and Prejudice', 'Jane Austen', '9780141439518', 1, 2, 'A romantic novel of manners', 11.99, 55, 'Penguin Classics', 1813, 432),
('The Alchemist', 'Paulo Coelho', '97880132350884', 4, 10, 'A handbook of agile software craftsmanship', 42.99, 25, 'Prentice Hall', 2008, 464),
('The Lean Startup', 'Eric Ries', '9780307887894', 5, 13, 'How constant innovation creates radically successful businesses', 26.99, 35, 'Crown Business', 2011, 336),
('Atomic Habits', 'James Clear', '9780735211292', 6, 16, 'An easy and proven way to build good habits', 24.99, 55, 'Avery', 2018, 320);

-- Cart Table
CREATE TABLE IF NOT EXISTS cart (
    cart_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    book_id INT NOT NULL,
    quantity INT DEFAULT 1,
    added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    UNIQUE KEY unique_cart_item (student_id, book_id)
);

-- Shipping Addresses Table
CREATE TABLE IF NOT EXISTS shipping_addresses (
    address_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    address_line1 VARCHAR(255) NOT NULL,
    address_line2 VARCHAR(255),
    city VARCHAR(50) NOT NULL,
    state VARCHAR(50) NOT NULL,
    zip_code VARCHAR(10) NOT NULL,
    country VARCHAR(50) DEFAULT 'USA',
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
);

-- Orders Table
CREATE TABLE IF NOT EXISTS orders (
    order_id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    order_number VARCHAR(50) UNIQUE NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    shipping_address_id INT NOT NULL,
    payment_method VARCHAR(50) DEFAULT 'COD',
    order_status ENUM('pending', 'processing', 'shipped', 'delivered', 'cancelled') DEFAULT 'pending',
    shipping_status VARCHAR(100),
    tracking_number VARCHAR(100),
    order_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    shipped_date TIMESTAMP NULL,
    delivered_date TIMESTAMP NULL,
    FOREIGN KEY (student_id) REFERENCES students(student_id),
    FOREIGN KEY (shipping_address_id) REFERENCES shipping_addresses(address_id)
);

-- Order Items Table
CREATE TABLE IF NOT EXISTS order_items (
    order_item_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    book_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    subtotal DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE,
    FOREIGN KEY (book_id) REFERENCES books(book_id)
);

-- Order Status History Table
CREATE TABLE IF NOT EXISTS order_status_history (
    history_id INT PRIMARY KEY AUTO_INCREMENT,
    order_id INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    notes TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (order_id) REFERENCES orders(order_id) ON DELETE CASCADE
);

-- Reviews Table (Optional)
CREATE TABLE IF NOT EXISTS reviews (
    review_id INT PRIMARY KEY AUTO_INCREMENT,
    book_id INT NOT NULL,
    student_id INT NOT NULL,
    rating INT CHECK (rating BETWEEN 1 AND 5),
    review_text TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (book_id) REFERENCES books(book_id) ON DELETE CASCADE,
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE
);
