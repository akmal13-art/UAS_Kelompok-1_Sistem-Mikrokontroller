<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Attendance System</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="header-content">
                <h1><i class="fas fa-fingerprint"></i> Smart Attendance System</h1>
                <p class="subtitle">Sistem Absensi Otomatis Berbasis IoT</p>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">
                        <i class="fas fa-home"></i> Dashboard
                    </a></li>
                    <li><a href="register_rfid.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'register_rfid.php' ? 'active' : ''; ?>">
                        <i class="fas fa-id-card"></i> Daftar RFID
                    </a></li>
                    <li><a href="add_user.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'add_user.php' ? 'active' : ''; ?>">
                        <i class="fas fa-user-plus"></i> Tambah Pengguna
                    </a></li>
                </ul>
            </nav>
        </header>
        <main>