<?php
include 'config.php';

header('Content-Type: application/json');

if(isset($_GET['id']) && isset($_GET['status'])) {
    $id = intval($_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    
    $sql = "UPDATE pengurusan SET status = '$status' WHERE id = $id";
    
    if(mysqli_query($conn, $sql)) {
        echo json_encode(['success' => true, 'message' => 'Status berhasil diperbarui']);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Parameter tidak lengkap']);
}
?>