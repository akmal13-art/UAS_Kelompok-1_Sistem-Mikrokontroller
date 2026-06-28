-- Membuat database
CREATE DATABASE IF NOT EXISTS smart_attendance;
USE smart_attendance;

-- Tabel users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    rfid_uid VARCHAR(50) UNIQUE NOT NULL,
    name VARCHAR(100) NOT NULL,
    nim VARCHAR(50),
    department VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabel attendance
CREATE TABLE IF NOT EXISTS attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    rfid_uid VARCHAR(50),
    name VARCHAR(100),
    check_in_time DATETIME,
    status ENUM('present', 'late', 'absent') DEFAULT 'present',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Data contoh
INSERT INTO users (rfid_uid, name, nim, department) VALUES
('A1B2C3D4', 'Ahmad Fauzi', '2021001', 'Teknik Informatika'),
('E5F6G7H8', 'Budi Santoso', '2021002', 'Sistem Informasi'),
('I9J0K1L2', 'Citra Dewi', '2021003', 'Teknik Komputer');