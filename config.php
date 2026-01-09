<?php
// config.php
$host = "localhost";
$username = "root";
$password = "";
$database = "passport_db";

// Koneksi ke MySQL server
$conn = mysqli_connect($host, $username, $password);

if (!$conn) {
    die("Koneksi MySQL gagal: " . mysqli_connect_error());
}

// Buat database jika belum ada
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $database";
if (!mysqli_query($conn, $sql_create_db)) {
    die("Gagal membuat database: " . mysqli_error($conn));
}

// Pilih database
mysqli_select_db($conn, $database);

// Buat tabel pendaftaran
$sql_pendaftaran = "CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_antrian VARCHAR(50) NOT NULL UNIQUE,
    nama_pemohon VARCHAR(100) NOT NULL,
    tgl_daftar DATE NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql_pendaftaran)) {
    echo "Gagal membuat tabel pendaftaran: " . mysqli_error($conn) . "<br>";
}

// Buat tabel daftar_ulang dengan kolom IJAZAH, AKTE, KK (bukan FOTO, KTP, KK)
$sql_daftar_ulang = "CREATE TABLE IF NOT EXISTS daftar_ulang (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_antrian VARCHAR(50) NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    hari_datang VARCHAR(20) NOT NULL,
    tgl_datang DATE NOT NULL,
    ijazah ENUM('Yes', 'No') DEFAULT 'No',
    akte ENUM('Yes', 'No') DEFAULT 'No',
    kk ENUM('Yes', 'No') DEFAULT 'No',
    pengambilan VARCHAR(20) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql_daftar_ulang)) {
    echo "Gagal membuat tabel daftar_ulang: " . mysqli_error($conn) . "<br>";
}

// Buat tabel pengurusan dengan kolom pembayaran
$sql_pengurusan = "CREATE TABLE IF NOT EXISTS pengurusan (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    no_antrian VARCHAR(50) NOT NULL,
    nama_pemohon VARCHAR(100) NOT NULL,
    berkas_foto ENUM('Lengkap', 'Tidak Lengkap', 'Belum Diperiksa') DEFAULT 'Belum Diperiksa',
    berkas_ktp ENUM('Lengkap', 'Tidak Lengkap', 'Belum Diperiksa') DEFAULT 'Belum Diperiksa',
    berkas_kk ENUM('Lengkap', 'Tidak Lengkap', 'Belum Diperiksa') DEFAULT 'Belum Diperiksa',
    status ENUM('Proses', 'Selesai', 'Ditolak', 'Menunggu') DEFAULT 'Menunggu',
    keterangan TEXT,
    tgl_periksa DATE,
    status_pembayaran ENUM('Belum Bayar', 'Sudah Bayar', 'Pending') DEFAULT 'Belum Bayar',
    metode_pembayaran VARCHAR(50),
    jumlah_pembayaran DECIMAL(10,2) DEFAULT 350000.00,
    tgl_pembayaran DATETIME,
    bukti_pembayaran VARCHAR(255),
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if (!mysqli_query($conn, $sql_pengurusan)) {
    echo "Gagal membuat tabel pengurusan: " . mysqli_error($conn) . "<br>";
}

// Fungsi untuk mendapatkan data daftar ulang
function getDaftarUlangData($conn) {
    $sql = "SELECT * FROM daftar_ulang ORDER BY id DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

// Fungsi untuk mendapatkan data pengurusan
function getPengurusanData($conn) {
    $sql = "SELECT p.*, 
                   COALESCE(d.ijazah, 'No') as ijazah_dibawa,
                   COALESCE(d.akte, 'No') as akte_dibawa,
                   COALESCE(d.kk, 'No') as kk_dibawa
            FROM pengurusan p
            LEFT JOIN daftar_ulang d ON p.no_antrian = d.no_antrian
            ORDER BY p.id DESC";
    $result = mysqli_query($conn, $sql);
    $data = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

// Fungsi untuk mendapatkan data pendaftaran yang belum ada di pengurusan
function getPendaftaranAvailable($conn) {
    $sql = "SELECT p.* FROM pendaftaran p 
            WHERE NOT EXISTS (
                SELECT 1 FROM pengurusan pu WHERE pu.no_antrian = p.no_antrian
            )
            ORDER BY p.no_antrian";
    $result = mysqli_query($conn, $sql);
    $data = [];
    
    if ($result && mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
    }
    return $data;
}

// Fungsi untuk mendapatkan data daftar ulang berdasarkan no_antrian
function getDaftarUlangByNo($conn, $no_antrian) {
    $sql = "SELECT * FROM daftar_ulang WHERE no_antrian = '$no_antrian'";
    $result = mysqli_query($conn, $sql);
    
    if ($result && mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    }
    return false;
}
?>