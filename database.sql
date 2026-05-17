CREATE DATABASE IF NOT EXISTS car_rental_auth CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE car_rental_auth;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('user','admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    reset_token VARCHAR(64) DEFAULT NULL,
    reset_expires DATETIME DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_admin_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cars (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    category VARCHAR(80) NOT NULL,
    price_per_day DECIMAL(10,2) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    description TEXT,
    availability ENUM('available','unavailable') NOT NULL DEFAULT 'available',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS bookings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    car_id INT NOT NULL,
    pickup_date DATE NOT NULL,
    return_date DATE NOT NULL,
    total_days INT NOT NULL,
    total_price DECIMAL(10,2) NOT NULL,
    status ENUM('pending','confirmed','cancelled','completed') NOT NULL DEFAULT 'pending',
    user_note TEXT DEFAULT NULL,
    admin_notes TEXT DEFAULT NULL,
    status_reason VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL,
    CONSTRAINT fk_booking_user FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    CONSTRAINT fk_booking_car FOREIGN KEY (car_id) REFERENCES cars(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS contact_messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(80) NOT NULL,
    last_name VARCHAR(80) NOT NULL,
    email VARCHAR(120) NOT NULL,
    phone VARCHAR(40) DEFAULT NULL,
    subject VARCHAR(120) NOT NULL,
    message TEXT NOT NULL,
    status ENUM('new','read','replied') NOT NULL DEFAULT 'new',
    admin_reply TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Default admin account:
-- Email/Username: admin@example.com / admin
-- Password: Admin@123
INSERT INTO users (username, email, password, role)
SELECT 'admin', 'admin@example.com', '$2y$12$JttFKbBf5U5OiKbM015ShOlSkmAMO9UOGgIt92rsgIvfYTyXvpC3.', 'admin'
WHERE NOT EXISTS (SELECT 1 FROM users WHERE email = 'admin@example.com' OR username = 'admin');

INSERT INTO admins (user_id)
SELECT id FROM users WHERE email = 'admin@example.com'
ON DUPLICATE KEY UPDATE user_id = user_id;

INSERT INTO cars (name, category, price_per_day, image, description, availability)
SELECT 'Ferrari 488 GTB', 'Sports', 150.00, 'img/2015-ferrari-458-speciale-maranello-2014-paris-motor-show-car-yellow-ferrari-front-view-car-0d357a91a3975dec0403139569ab7d23.png', 'Experience the thrill of driving this turbocharged masterpiece with 661 horsepower and a top speed of 205 mph.', 'available'
WHERE NOT EXISTS (SELECT 1 FROM cars WHERE name = 'Ferrari 488 GTB');

INSERT INTO cars (name, category, price_per_day, image, description, availability)
SELECT 'Ferrari Portofino', 'Convertible', 178.00, 'img/2017-ferrari-488-spider-sports-car-international-motor-show-germany-blue-ferrari-488-spider-car-front-69d13e8a4cc380de2a1094458b799d97.png', 'This elegant convertible combines breathtaking design with exhilarating performance for the perfect grand touring experience.', 'available'
WHERE NOT EXISTS (SELECT 1 FROM cars WHERE name = 'Ferrari Portofino');

INSERT INTO cars (name, category, price_per_day, image, description, availability)
SELECT 'Ferrari F8 Tributo', 'Sports', 243.00, 'img/sports-car-ferrari-458-red-ferrari-458-italia-sports-car-277b6eac2f5011d37c6d490f434a4eff.png', 'The most powerful V8 in Ferrari history, offering unparalleled performance and responsive handling.', 'available'
WHERE NOT EXISTS (SELECT 1 FROM cars WHERE name = 'Ferrari F8 Tributo');

INSERT INTO cars (name, category, price_per_day, image, description, availability)
SELECT 'Mercedes S-Class', 'Luxury Sedan', 120.00, 'img/thhgevkj1ll0b0nhatvap14tar-d8f4c6474358b52051d0198484bde467.png', 'Experience luxury and comfort with this flagship sedan featuring cutting-edge technology and sophisticated design.', 'available'
WHERE NOT EXISTS (SELECT 1 FROM cars WHERE name = 'Mercedes S-Class');


-- Safe upgrade statements for existing databases:
ALTER TABLE users ADD COLUMN IF NOT EXISTS reset_token VARCHAR(64) DEFAULT NULL;
ALTER TABLE users ADD COLUMN IF NOT EXISTS reset_expires DATETIME DEFAULT NULL;
ALTER TABLE bookings ADD COLUMN IF NOT EXISTS user_note TEXT DEFAULT NULL;
ALTER TABLE bookings ADD COLUMN IF NOT EXISTS admin_notes TEXT DEFAULT NULL;
ALTER TABLE bookings ADD COLUMN IF NOT EXISTS status_reason VARCHAR(255) DEFAULT NULL;
ALTER TABLE bookings ADD COLUMN IF NOT EXISTS updated_at TIMESTAMP NULL DEFAULT NULL;
ALTER TABLE contact_messages ADD COLUMN IF NOT EXISTS status ENUM('new','read','replied') NOT NULL DEFAULT 'new';
ALTER TABLE contact_messages ADD COLUMN IF NOT EXISTS admin_reply TEXT DEFAULT NULL;
