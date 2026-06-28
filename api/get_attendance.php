<?php
header('Content-Type: application/json');

require_once '../config/database.php';

$query = "SELECT id, rfid_uid, name, check_in_time, status 
          FROM attendance 
          ORDER BY check_in_time DESC 
          LIMIT 50";
$result = $conn->query($query);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $row['check_in_time'] = date('d/m/Y H:i:s', strtotime($row['check_in_time']));
        $data[] = $row;
    }
}

echo json_encode([
    'success' => true,
    'data' => $data
]);

$conn->close();
?>