<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT p.*, d.ijazah, d.akte, d.kk 
        FROM pengurusan p 
        LEFT JOIN daftar_ulang d ON p.no_antrian = d.no_antrian 
        WHERE p.id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: pengurusan.php?error=data_not_found");
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // PERBAIKAN: Menggunakan berkas_ijazah, berkas_akte, berkas_kk
    $berkas_ijazah = mysqli_real_escape_string($conn, $_POST['berkas_ijazah']);
    $berkas_akte = mysqli_real_escape_string($conn, $_POST['berkas_akte']);
    $berkas_kk = mysqli_real_escape_string($conn, $_POST['berkas_kk']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $tgl_periksa = mysqli_real_escape_string($conn, $_POST['tgl_periksa']);

    // PERBAIKAN: Update dengan kolom yang benar
    $sql_update = "UPDATE pengurusan SET 
                    berkas_ijazah = '$berkas_ijazah',
                    berkas_akte = '$berkas_akte',
                    berkas_kk = '$berkas_kk',
                    status = '$status',
                    keterangan = '$keterangan',
                    tgl_periksa = '$tgl_periksa'
                  WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: pengurusan.php?success=1&msg=Pemeriksaan berhasil disimpan");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Periksa Pengurusan - Imigrasi Tangerang Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        /* ... (style tetap sama) ... */
    </style>
</head>
<body>
    <!-- ... (header tetap sama) ... -->

    <main class="main-content">
        <div class="container">
            <div class="check-container">
                <h3 class="check-title"><i class="fas fa-clipboard-check me-2"></i>Form Pemeriksaan</h3>
                
                <div class="data-info">
                    <h6><i class="fas fa-info-circle me-2"></i>Informasi Pemohon</h6>
                    <p><strong>No. Antrian:</strong> <?php echo htmlspecialchars($row['no_antrian']); ?></p>
                    <p><strong>Nama Pemohon:</strong> <?php echo htmlspecialchars($row['nama_pemohon']); ?></p>
                    <p><strong>Status Saat Ini:</strong> 
                        <span class="badge-status 
                            <?php 
                            switch($row['status']) {
                                case 'Proses': echo 'status-proses'; break;
                                case 'Selesai': echo 'status-selesai'; break;
                                case 'Ditolak': echo 'status-ditolak'; break;
                                default: echo 'status-menunggu';
                            }
                            ?>">
                            <?php echo $row['status']; ?>
                        </span>
                    </p>
                    <?php if($row['ijazah']): ?>
                    <div class="berkas-info">
                        <p><strong>Berkas yang dibawa saat daftar ulang:</strong></p>
                        <div class="berkas-item">
                            <i class="fas fa-<?php echo $row['ijazah'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?>"></i>
                            <span>Ijazah: <?php echo $row['ijazah'] == 'Yes' ? 'Dibawa' : 'Tidak Dibawa'; ?></span>
                        </div>
                        <div class="berkas-item">
                            <i class="fas fa-<?php echo $row['akte'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?>"></i>
                            <span>Akte: <?php echo $row['akte'] == 'Yes' ? 'Dibawa' : 'Tidak Dibawa'; ?></span>
                        </div>
                        <div class="berkas-item">
                            <i class="fas fa-<?php echo $row['kk'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?>"></i>
                            <span>KK: <?php echo $row['kk'] == 'Yes' ? 'Dibawa' : 'Tidak Dibawa'; ?></span>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                
                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label">Status Berkas</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Ijazah</label>
                                    <!-- PERBAIKAN: Menggunakan berkas_ijazah -->
                                    <select class="form-select" name="berkas_ijazah" required>
                                        <option value="Belum Diperiksa" <?php echo $row['berkas_ijazah'] == 'Belum Diperiksa' ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                        <option value="Lengkap" <?php echo $row['berkas_ijazah'] == 'Lengkap' ? 'selected' : ''; ?>>Lengkap</option>
                                        <option value="Tidak Lengkap" <?php echo $row['berkas_ijazah'] == 'Tidak Lengkap' ? 'selected' : ''; ?>>Tidak Lengkap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Akte</label>
                                    <!-- PERBAIKAN: Menggunakan berkas_akte -->
                                    <select class="form-select" name="berkas_akte" required>
                                        <option value="Belum Diperiksa" <?php echo $row['berkas_akte'] == 'Belum Diperiksa' ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                        <option value="Lengkap" <?php echo $row['berkas_akte'] == 'Lengkap' ? 'selected' : ''; ?>>Lengkap</option>
                                        <option value="Tidak Lengkap" <?php echo $row['berkas_akte'] == 'Tidak Lengkap' ? 'selected' : ''; ?>>Tidak Lengkap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">KK</label>
                                    <!-- PERBAIKAN: Menggunakan berkas_kk -->
                                    <select class="form-select" name="berkas_kk" required>
                                        <option value="Belum Diperiksa" <?php echo $row['berkas_kk'] == 'Belum Diperiksa' ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                        <option value="Lengkap" <?php echo $row['berkas_kk'] == 'Lengkap' ? 'selected' : ''; ?>>Lengkap</option>
                                        <option value="Tidak Lengkap" <?php echo $row['berkas_kk'] == 'Tidak Lengkap' ? 'selected' : ''; ?>>Tidak Lengkap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Status Pengurusan</label>
                            <select class="form-select" name="status" required>
                                <option value="Menunggu" <?php echo $row['status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                <option value="Proses" <?php echo $row['status'] == 'Proses' ? 'selected' : ''; ?>>Proses</option>
                                <option value="Selesai" <?php echo $row['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                <option value="Ditolak" <?php echo $row['status'] == 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Periksa</label>
                            <input type="date" class="form-control" name="tgl_periksa" value="<?php echo $row['tgl_periksa'] ?: date('Y-m-d'); ?>" required>
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label">Keterangan Pemeriksaan</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan keterangan pemeriksaan"><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <a href="pengurusan.php" class="btn-cancel me-md-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-check">
                            <i class="fas fa-check me-2"></i>Simpan Pemeriksaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>