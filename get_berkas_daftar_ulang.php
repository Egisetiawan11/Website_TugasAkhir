<?php
include 'config.php';

header('Content-Type: application/json');

if (isset($_GET['no_antrian'])) {
    $no_antrian = mysqli_real_escape_string($conn, $_GET['no_antrian']);
    
    // PERBAIKAN: Ganti 'foto, ktp, kk' dengan 'ijazah, akte, kk'
    $sql = "SELECT ijazah, akte, kk FROM daftar_ulang WHERE no_antrian = '$no_antrian'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        echo json_encode([
            'exists' => true,
            // PERBAIKAN: Key juga harus 'ijazah', 'akte', 'kk'
            'ijazah' => $data['ijazah'],
            'akte' => $data['akte'],
            'kk' => $data['kk']
        ]);
    } else {
        echo json_encode([
            'exists' => false,
            'message' => 'Tidak ada data daftar ulang'
        ]);
    }
} else {
    echo json_encode([
        'error' => 'No antrian tidak diberikan'
    ]);
}

mysqli_close($conn);
?>