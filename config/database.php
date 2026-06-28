<?php
// config/database.php

// Konfigurasi database - SESUAIKAN DENGAN KOMPUTER ANDA
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // default XAMPP: root
define('DB_PASS', '');            // default XAMPP: kosong
define('DB_NAME', 'smart_attendance');

// Membuat koneksi
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");

function showError($message) {
    return "<div class='alert alert-danger'>$message</div>";
}

function showSuccess($message) {
    return "<div class='alert alert-success'>$message</div>";
}
?>