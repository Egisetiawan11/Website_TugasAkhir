<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id > 0) {
    $sql_select = "SELECT * FROM pengurusan WHERE id = $id";
    $result = mysqli_query($conn, $sql_select);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $no_antrian = $data['no_antrian'];
        
        $sql_delete = "DELETE FROM pengurusan WHERE id = $id";
        
        if (mysqli_query($conn, $sql_delete)) {
            header("Location: pengurusan.php?success=1&msg=Data berhasil dihapus");
            exit();
        } else {
            header("Location: pengurusan.php?error=delete_failed");
            exit();
        }
    } else {
        header("Location: pengurusan.php?error=data_not_found");
        exit();
    }
} else {
    header("Location: pengurusan.php");
    exit();
}
?>