<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no_antrian = mysqli_real_escape_string($conn, $_POST['no_antrian']);
    $nama_pemohon = mysqli_real_escape_string($conn, $_POST['nama_pemohon']);
    $hari_datang = mysqli_real_escape_string($conn, $_POST['hari_datang']);
    $tgl_datang = mysqli_real_escape_string($conn, $_POST['tgl_datang']);
    
    // PERBAIKAN: Menggunakan ijazah, akte, kk (bukan foto, ktp, kk)
    $ijazah = isset($_POST['ijazah']) && $_POST['ijazah'] == 'Yes' ? 'Yes' : 'No';
    $akte = isset($_POST['akte']) && $_POST['akte'] == 'Yes' ? 'Yes' : 'No';
    $kk = isset($_POST['kk']) && $_POST['kk'] == 'Yes' ? 'Yes' : 'No';
    
    $pengambilan = mysqli_real_escape_string($conn, $_POST['pengambilan']);

    // Validasi data
    if (empty($no_antrian) || empty($nama_pemohon) || empty($hari_datang) || empty($tgl_datang) || empty($pengambilan)) {
        header("Location: daftar_ulang.php?error=empty_fields");
        exit();
    }

    // Cek apakah no_antrian sudah melakukan daftar ulang
    $check_sql = "SELECT * FROM daftar_ulang WHERE no_antrian = '$no_antrian'";
    $check_result = mysqli_query($conn, $check_sql);
    
    if (mysqli_num_rows($check_result) > 0) {
        header("Location: daftar_ulang.php?error=duplicate_no");
        exit();
    }

    // Insert data ke database
    // PERBAIKAN: Menggunakan kolom ijazah, akte, kk
    $sql = "INSERT INTO daftar_ulang (no_antrian, nama_pemohon, hari_datang, tgl_datang, ijazah, akte, kk, pengambilan) 
            VALUES ('$no_antrian', '$nama_pemohon', '$hari_datang', '$tgl_datang', '$ijazah', '$akte', '$kk', '$pengambilan')";

    if (mysqli_query($conn, $sql)) {
        header("Location: daftar_ulang.php?success=1");
        exit();
    } else {
        header("Location: daftar_ulang.php?error=database_error&msg=" . urlencode(mysqli_error($conn)));
        exit();
    }
}

// Jika akses langsung, redirect ke daftar_ulang.php
header("Location: daftar_ulang.php");
exit();
?>