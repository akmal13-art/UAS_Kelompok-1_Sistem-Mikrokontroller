<?php
require_once 'config/database.php';
include 'includes/header.php';

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $rfid_uid = trim($_POST['rfid_uid']);
    $name = trim($_POST['name']);
    $nim = trim($_POST['nim']);
    $department = trim($_POST['department']);
    
    $errors = [];
    if (empty($rfid_uid)) $errors[] = "RFID UID harus diisi";
    if (empty($name)) $errors[] = "Nama harus diisi";
    
    if (!empty($rfid_uid)) {
        $checkStmt = $conn->prepare("SELECT id FROM users WHERE rfid_uid = ?");
        $checkStmt->bind_param("s", $rfid_uid);
        $checkStmt->execute();
        $checkResult = $checkStmt->get_result();
        if ($checkResult->num_rows > 0) {
            $errors[] = "RFID UID sudah terdaftar!";
        }
        $checkStmt->close();
    }
    
    if (empty($errors)) {
        $stmt = $conn->prepare("INSERT INTO users (rfid_uid, name, nim, department) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $rfid_uid, $name, $nim, $department);
        
        if ($stmt->execute()) {
            $message = "Pengguna berhasil ditambahkan!";
            $messageType = "success";
            $_POST = array();
        } else {
            $message = "Error: " . $conn->error;
            $messageType = "danger";
        }
        $stmt->close();
    } else {
        $message = implode("<br>", $errors);
        $messageType = "danger";
    }
}

function generateRFID() {
    $chars = '0123456789ABCDEF';
    $uid = '';
    for ($i = 0; $i < 8; $i++) {
        $uid .= $chars[rand(0, 15)];
    }
    return $uid;
}
?>

<div class="add-user">
    <h2><i class="fas fa-user-plus"></i> Tambah Pengguna</h2>
    
    <?php if ($message): ?>
        <div class="alert alert-<?php echo $messageType; ?>">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    
    <div class="card">
        <form method="POST" action="">
            <div class="form-group">
                <label for="rfid_uid"><i class="fas fa-id-card"></i> RFID UID *</label>
                <input type="text" id="rfid_uid" name="rfid_uid" 
                       value="<?php echo isset($_POST['rfid_uid']) ? htmlspecialchars($_POST['rfid_uid']) : ''; ?>" 
                       placeholder="Contoh: A1B2C3D4" required>
                <br>
                <button type="button" onclick="document.getElementById('rfid_uid').value = '<?php echo generateRFID(); ?>'" 
                        class="btn" style="margin-top: 5px; background: #6c757d; color: white; padding: 5px 15px; border: none; border-radius: 5px; cursor: pointer;">
                    <i class="fas fa-sync"></i> Generate UID
                </button>
            </div>
            
            <div class="form-group">
                <label for="name"><i class="fas fa-user"></i> Nama Lengkap *</label>
                <input type="text" id="name" name="name" 
                       value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" 
                       placeholder="Masukkan nama lengkap" required>
            </div>
            
            <div class="form-group">
                <label for="nim"><i class="fas fa-id-badge"></i> NIM/NIP</label>
                <input type="text" id="nim" name="nim" 
                       value="<?php echo isset($_POST['nim']) ? htmlspecialchars($_POST['nim']) : ''; ?>" 
                       placeholder="Masukkan NIM atau NIP">
            </div>
            
            <div class="form-group">
                <label for="department"><i class="fas fa-building"></i> Departemen</label>
                <input type="text" id="department" name="department" 
                       value="<?php echo isset($_POST['department']) ? htmlspecialchars($_POST['department']) : ''; ?>" 
                       placeholder="Masukkan departemen">
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary" style="width: 100%;">
                <i class="fas fa-save"></i> Simpan Pengguna
            </button>
        </form>
    </div>
    
    <div style="margin-top: 20px;">
        <a href="register_rfid.php" class="btn" style="background: #6c757d; color: white; padding: 10px 20px; text-decoration: none; border-radius: 10px; display: inline-block;">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar RFID
        </a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>