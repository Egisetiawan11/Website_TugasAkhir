<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input data
    $no_antrian = mysqli_real_escape_string($conn, $_POST['no_antrian']);
    $nama_pemohon = mysqli_real_escape_string($conn, $_POST['nama_pemohon']);
    $tgl_daftar = mysqli_real_escape_string($conn, $_POST['tgl_daftar']);

    // Validasi data
    if (empty($no_antrian) || empty($nama_pemohon) || empty($tgl_daftar)) {
        header("Location: daftar.php?error=empty_fields");
        exit();
    }

    // Cek apakah no_antrian sudah ada
    $check_sql = "SELECT * FROM pendaftaran WHERE no_antrian = '$no_antrian'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: daftar.php?error=duplicate_no");
        exit();
    }

    // Insert data ke database
    $sql = "INSERT INTO pendaftaran (no_antrian, nama_pemohon, tgl_daftar) 
            VALUES ('$no_antrian', '$nama_pemohon', '$tgl_daftar')";

    if (mysqli_query($conn, $sql)) {
        // Redirect kembali ke halaman daftar dengan parameter success
        header("Location: daftar.php?success=1");
        exit();
    } else {
        header("Location: daftar.php?error=database_error");
        exit();
    }
}

// Jika akses langsung, redirect ke daftar.php
header("Location: daftar.php");
exit();
?>