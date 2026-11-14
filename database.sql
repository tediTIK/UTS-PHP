CREATE DATABASE IF NOT EXISTS kas_mushola CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE kas_mushola;

CREATE TABLE users (
 id INT AUTO_INCREMENT PRIMARY KEY,
 nama VARCHAR(100) NOT NULL,
 username VARCHAR(50) NOT NULL UNIQUE,
 password_hash VARCHAR(255) NOT NULL,
 role ENUM('admin','bendahara') NOT NULL DEFAULT 'bendahara',
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE transaksi (
 id INT AUTO_INCREMENT PRIMARY KEY,
 tanggal DATE NOT NULL,
 jenis ENUM('masuk','keluar') NOT NULL,
 uraian VARCHAR(255) NOT NULL,
 kategori VARCHAR(100) NOT NULL,
 nominal BIGINT UNSIGNED NOT NULL,
 metode VARCHAR(50) NOT NULL DEFAULT 'Kas Tunai',
 user_id INT NULL,
 created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
 FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Akun admin awal: username admin / password admin123
-- Hash di bawah adalah hash password admin123 (bcrypt).
INSERT INTO users(nama,username,password_hash,role)
VALUES ('Administrator','admin','$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2uheWG/igi.','admin');
