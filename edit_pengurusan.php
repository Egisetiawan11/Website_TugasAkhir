<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data yang akan diedit
$sql = "SELECT * FROM pengurusan WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: pengurusan.php?error=data_not_found");
    exit();
}

$row = mysqli_fetch_assoc($result);

// Ambil data daftar ulang untuk informasi berkas
$daftar_ulang = getDaftarUlangByNo($conn, $row['no_antrian']);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $berkas_ijazah = mysqli_real_escape_string($conn, $_POST['berkas_ijazah']);
    $berkas_akte = mysqli_real_escape_string($conn, $_POST['berkas_akte']);
    $berkas_kk = mysqli_real_escape_string($conn, $_POST['berkas_kk']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $tgl_periksa = mysqli_real_escape_string($conn, $_POST['tgl_periksa']);

    $sql_update = "UPDATE pengurusan SET 
                    berkas_ijazah = '$berkas_ijazah',
                    berkas_akte = '$berkas_akte',
                    berkas_kk = '$berkas_kk',
                    status = '$status',
                    keterangan = '$keterangan',
                    tgl_periksa = '$tgl_periksa'
                  WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: pengurusan.php?success=1&msg=Data berhasil diupdate");
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
    <title>Edit Data Pengurusan - Imigrasi Tangerang Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f8f9fa;
            color: #333;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .page-title h1 {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 2.2rem;
        }

        .page-title p {
            opacity: 0.9;
            margin-bottom: 0;
        }

        .btn-back {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .main-content {
            padding: 40px 0;
        }

        .edit-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            max-width: 800px;
            margin: 0 auto;
        }

        .edit-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
            text-align: center;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        .btn-update {
            background: var(--secondary);
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-update:hover {
            background: #2980b9;
            transform: translateY(-2px);
        }

        .btn-cancel:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
            text-decoration: none;
        }

        .info-box {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .berkas-status {
            display: flex;
            flex-direction: column;
            gap: 8px;
            margin-top: 10px;
        }

        .berkas-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.9rem;
        }

        .badge-lengkap {
            background: #27ae60;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.75rem;
        }

        .badge-tidak-lengkap {
            background: #e74c3c;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.75rem;
        }

        .badge-belum {
            background: #95a5a6;
            color: white;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 0.75rem;
        }

        .current-status {
            display: inline-block;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
        }

        .status-proses {
            background: #f39c12;
            color: white;
        }

        .status-selesai {
            background: #27ae60;
            color: white;
        }

        .status-ditolak {
            background: #e74c3c;
            color: white;
        }

        .status-menunggu {
            background: #95a5a6;
            color: white;
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 20px 0;
            }
            
            .page-title h1 {
                font-size: 1.8rem;
            }
            
            .main-content {
                padding: 20px 0;
            }
            
            .edit-container {
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-title">
                        <h1><i class="fas fa-edit me-2"></i>Edit Data Pengurusan</h1>
                        <p>Perbarui informasi pengurusan Passport</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="pengurusan.php" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Data
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="edit-container">
                <h3 class="edit-title"><i class="fas fa-user-edit me-2"></i>Form Edit Data Pengurusan</h3>
                
                <!-- Informasi Data -->
                <div class="info-box mb-4">
                    <h6><i class="fas fa-info-circle me-2"></i>Informasi Data</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>No. Antrian:</strong> <?php echo htmlspecialchars($row['no_antrian']); ?></p>
                            <p><strong>Nama Pemohon:</strong> <?php echo htmlspecialchars($row['nama_pemohon']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Status Saat Ini:</strong> 
                                <span class="current-status 
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
                            <p><strong>Pembayaran:</strong> 
                                <span class="badge <?php echo $row['status_pembayaran'] == 'Sudah Bayar' ? 'bg-success' : ($row['status_pembayaran'] == 'Pending' ? 'bg-warning' : 'bg-danger'); ?>">
                                    <?php echo $row['status_pembayaran']; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                    
                    <?php if($daftar_ulang): ?>
                    <div class="mt-3 pt-3 border-top">
                        <p class="mb-2"><strong><i class="fas fa-file-alt me-2"></i>Berkas yang dibawa saat daftar ulang:</strong></p>
                        <div class="berkas-status">
                            <div class="berkas-item">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-<?php echo $daftar_ulang['ijazah'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?> me-2"></i>
                                    <strong class="me-2">Ijazah:</strong>
                                    <?php echo $daftar_ulang['ijazah'] == 'Yes' ? 'Dibawa' : 'Tidak Dibawa'; ?>
                                </span>
                            </div>
                            <div class="berkas-item">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-<?php echo $daftar_ulang['akte'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?> me-2"></i>
                                    <strong class="me-2">Akte:</strong>
                                    <?php echo $daftar_ulang['akte'] == 'Yes' ? 'Dibawa' : 'Tidak Dibawa'; ?>
                                </span>
                            </div>
                            <div class="berkas-item">
                                <span class="d-flex align-items-center">
                                    <i class="fas fa-<?php echo $daftar_ulang['kk'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?> me-2"></i>
                                    <strong class="me-2">KK:</strong>
                                    <?php echo $daftar_ulang['kk'] == 'Yes' ? 'Dibawa' : 'Tidak Dibawa'; ?>
                                </span>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <p class="text-muted mt-3 mb-0"><i class="fas fa-info-circle me-2"></i>Tidak ada data daftar ulang untuk nomor ini.</p>
                    <?php endif; ?>
                </div>
                
                <form method="POST">
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-file-check me-2"></i>Status Berkas</label>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Ijazah</label>
                                    <select class="form-select" name="berkas_ijazah" required>
                                        <option value="Belum Diperiksa" <?php echo (isset($row['berkas_ijazah']) && $row['berkas_ijazah'] == 'Belum Diperiksa') ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                        <option value="Lengkap" <?php echo (isset($row['berkas_ijazah']) && $row['berkas_ijazah'] == 'Lengkap') ? 'selected' : ''; ?>>Lengkap</option>
                                        <option value="Tidak Lengkap" <?php echo (isset($row['berkas_ijazah']) && $row['berkas_ijazah'] == 'Tidak Lengkap') ? 'selected' : ''; ?>>Tidak Lengkap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">Akte</label>
                                    <select class="form-select" name="berkas_akte" required>
                                        <option value="Belum Diperiksa" <?php echo (isset($row['berkas_akte']) && $row['berkas_akte'] == 'Belum Diperiksa') ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                        <option value="Lengkap" <?php echo (isset($row['berkas_akte']) && $row['berkas_akte'] == 'Lengkap') ? 'selected' : ''; ?>>Lengkap</option>
                                        <option value="Tidak Lengkap" <?php echo (isset($row['berkas_akte']) && $row['berkas_akte'] == 'Tidak Lengkap') ? 'selected' : ''; ?>>Tidak Lengkap</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label class="form-label">KK</label>
                                    <select class="form-select" name="berkas_kk" required>
                                        <option value="Belum Diperiksa" <?php echo (isset($row['berkas_kk']) && $row['berkas_kk'] == 'Belum Diperiksa') ? 'selected' : ''; ?>>Belum Diperiksa</option>
                                        <option value="Lengkap" <?php echo (isset($row['berkas_kk']) && $row['berkas_kk'] == 'Lengkap') ? 'selected' : ''; ?>>Lengkap</option>
                                        <option value="Tidak Lengkap" <?php echo (isset($row['berkas_kk']) && $row['berkas_kk'] == 'Tidak Lengkap') ? 'selected' : ''; ?>>Tidak Lengkap</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-tasks me-2"></i>Status Pengurusan</label>
                            <select class="form-select" name="status" required>
                                <option value="Menunggu" <?php echo $row['status'] == 'Menunggu' ? 'selected' : ''; ?>>Menunggu</option>
                                <option value="Proses" <?php echo $row['status'] == 'Proses' ? 'selected' : ''; ?>>Proses</option>
                                <option value="Selesai" <?php echo $row['status'] == 'Selesai' ? 'selected' : ''; ?>>Selesai</option>
                                <option value="Ditolak" <?php echo $row['status'] == 'Ditolak' ? 'selected' : ''; ?>>Ditolak</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label"><i class="fas fa-calendar me-2"></i>Tanggal Periksa</label>
                            <input type="date" class="form-control" name="tgl_periksa" value="<?php echo $row['tgl_periksa']; ?>">
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label"><i class="fas fa-comment me-2"></i>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan keterangan tambahan..."><?php echo htmlspecialchars($row['keterangan']); ?></textarea>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <a href="pengurusan.php" class="btn-cancel me-md-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-update">
                            <i class="fas fa-save me-2"></i>Update Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set min date untuk tanggal periksa ke hari ini
            const today = new Date().toISOString().split('T')[0];
            const tglPeriksaInput = document.querySelector('input[name="tgl_periksa"]');
            if (tglPeriksaInput && !tglPeriksaInput.value) {
                tglPeriksaInput.value = today;
            }
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>