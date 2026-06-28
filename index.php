<?php
require_once 'config/database.php';
include 'includes/header.php';

$totalUsers = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$todayAttendance = $conn->query("SELECT COUNT(*) as total FROM attendance WHERE DATE(check_in_time) = CURDATE()")->fetch_assoc()['total'];
$presentToday = $conn->query("SELECT COUNT(*) as total FROM attendance WHERE DATE(check_in_time) = CURDATE() AND status = 'present'")->fetch_assoc()['total'];

$attendanceQuery = "SELECT a.id, a.rfid_uid, a.name, a.check_in_time, a.status 
                   FROM attendance a 
                   ORDER BY a.check_in_time DESC 
                   LIMIT 20";
$attendanceResult = $conn->query($attendanceQuery);
?>

<div class="dashboard">
    <h2><i class="fas fa-chart-line"></i> Dashboard</h2>
    
    <div class="stats-grid">
        <div class="stat-card">
            <i class="fas fa-users"></i>
            <h3>Total Pengguna</h3>
            <p><?php echo $totalUsers; ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-calendar-check"></i>
            <h3>Absensi Hari Ini</h3>
            <p><?php echo $todayAttendance; ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-user-check"></i>
            <h3>Hadir Hari Ini</h3>
            <p><?php echo $presentToday; ?></p>
        </div>
        <div class="stat-card">
            <i class="fas fa-clock"></i>
            <h3>Status</h3>
            <p style="font-size: 1rem; color: #28a745;">
                <i class="fas fa-circle"></i> Online
            </p>
        </div>
    </div>

    <div style="margin-top: 30px;">
        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 15px;">
            <h3><i class="fas fa-list"></i> Absensi Terbaru</h3>
            <button onclick="exportToCSV('attendanceTable', 'attendance_<?php echo date('Y-m-d'); ?>.csv')" class="btn btn-success">
                <i class="fas fa-file-export"></i> Export CSV
            </button>
        </div>
        
        <div class="table-responsive">
            <table id="attendanceTable" class="attendance-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>RFID UID</th>
                        <th>Nama</th>
                        <th>Waktu Check-in</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($attendanceResult->num_rows > 0): ?>
                        <?php while($row = $attendanceResult->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo htmlspecialchars($row['rfid_uid']); ?></td>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo date('d/m/Y H:i:s', strtotime($row['check_in_time'])); ?></td>
                                <td>
                                    <span class="status-badge <?php 
                                        echo $row['status'] == 'present' ? 'status-present' : 
                                            ($row['status'] == 'late' ? 'status-late' : 'status-absent'); 
                                    ?>">
                                        <?php echo ucfirst($row['status']); ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 30px; color: #999;">
                                <i class="fas fa-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                                Belum ada data absensi
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>