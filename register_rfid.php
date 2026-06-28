<?php
require_once 'config/database.php';
include 'includes/header.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    if ($_POST['action'] == 'delete') {
        $id = intval($_POST['id']);
        $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        if ($stmt->execute()) {
            $message = "Data pengguna berhasil dihapus!";
            $messageType = "success";
        } else {
            $message = "Error: " . $conn->error;
            $messageType = "danger";
        }
        $stmt->close();
    }
}

$usersQuery = "SELECT * FROM users ORDER BY created_at DESC";
$usersResult = $conn->query($usersQuery);
?>

<div class="register-rfid">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px; margin-bottom: 25px;">
        <h2><i class="fas fa-id-card"></i> Daftar RFID Terdaftar</h2>
        <a href="add_user.php" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Pengguna
        </a>
    </div>
    
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>RFID UID</th>
                    <th>Nama</th>
                    <th>NIM</th>
                    <th>Departemen</th>
                    <th>Tanggal Daftar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($usersResult->num_rows > 0): ?>
                    <?php while($row = $usersResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><code><?php echo htmlspecialchars($row['rfid_uid']); ?></code></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['nim']); ?></td>
                            <td><?php echo htmlspecialchars($row['department']); ?></td>
                            <td><?php echo date('d/m/Y', strtotime($row['created_at'])); ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <input type="hidden" name="action" value="delete">
                                    <button type="submit" class="btn btn-danger" style="padding: 5px 10px; font-size: 0.8rem;" 
                                            onclick="return confirm('Apakah Anda yakin ingin menghapus pengguna <?php echo htmlspecialchars($row['name']); ?>?')">
                                        <i class="fas fa-trash"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 30px; color: #999;">
                            <i class="fas fa-id-card" style="font-size: 2rem; display: block; margin-bottom: 10px;"></i>
                            Belum ada pengguna terdaftar
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>