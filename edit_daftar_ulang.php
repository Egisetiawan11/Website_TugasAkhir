<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Ambil data yang akan diedit
$sql = "SELECT * FROM daftar_ulang WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: daftar_ulang.php?error=data_not_found");
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $no_antrian = mysqli_real_escape_string($conn, $_POST['no_antrian']);
    $nama_pemohon = mysqli_real_escape_string($conn, $_POST['nama_pemohon']);
    $hari_datang = mysqli_real_escape_string($conn, $_POST['hari_datang']);
    $tgl_datang = mysqli_real_escape_string($conn, $_POST['tgl_datang']);
    $ijazah = isset($_POST['ijazah']) && $_POST['ijazah'] == 'Yes' ? 'Yes' : 'No';
    $akte = isset($_POST['akte']) && $_POST['akte'] == 'Yes' ? 'Yes' : 'No';
    $kk = isset($_POST['kk']) && $_POST['kk'] == 'Yes' ? 'Yes' : 'No';
    $pengambilan = mysqli_real_escape_string($conn, $_POST['pengambilan']);

    // Update data
    $sql_update = "UPDATE daftar_ulang SET 
                    hari_datang = '$hari_datang',
                    tgl_datang = '$tgl_datang',
                    ijazah = '$ijazah',
                    akte = '$akte',
                    kk = '$kk',
                    pengambilan = '$pengambilan'
                  WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: daftar_ulang.php?success=1&msg=Data berhasil diupdate");
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
    <title>Edit Data Daftar Ulang - Imigrasi Tangerang Selatan</title>
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
            max-width: 700px;
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
            padding: 10px 25px;
            border: none;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-cancel {
            background: #6c757d;
            color: white;
            padding: 10px 25px;
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

        .current-data {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .option-group {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 10px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
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
            
            .option-group {
                flex-direction: column;
                gap: 10px;
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
                        <h1><i class="fas fa-edit me-2"></i>Edit Data Daftar Ulang</h1>
                        <p>Perbarui informasi daftar ulang Passport</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="daftar_ulang.php" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Data
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="edit-container">
                <h3 class="edit-title"><i class="fas fa-user-edit me-2"></i>Form Edit Data Daftar Ulang</h3>
                
                <div class="current-data">
                    <h6><i class="fas fa-info-circle me-2"></i>Data Saat Ini</h6>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>No. Antrian:</strong> <?php echo htmlspecialchars($row['no_antrian']); ?></p>
                            <p><strong>Nama Pemohon:</strong> <?php echo htmlspecialchars($row['nama_pemohon']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Hari Datang:</strong> <?php echo $row['hari_datang']; ?></p>
                            <p><strong>Tanggal Datang:</strong> <?php echo date('d/m/Y', strtotime($row['tgl_datang'])); ?></p>
                        </div>
                    </div>
                </div>

                <form method="POST">
                    <!-- Data yang tidak bisa diubah -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">No. Antrian</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['no_antrian']); ?>" readonly>
                            <input type="hidden" name="no_antrian" value="<?php echo $row['no_antrian']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Pemohon</label>
                            <input type="text" class="form-control" value="<?php echo htmlspecialchars($row['nama_pemohon']); ?>" readonly>
                            <input type="hidden" name="nama_pemohon" value="<?php echo $row['nama_pemohon']; ?>">
                        </div>
                    </div>
                    
                    <!-- Hari & Tanggal -->
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Hari Datang</label>
                            <select class="form-select" name="hari_datang" required>
                                <option value="Senin" <?php echo $row['hari_datang'] == 'Senin' ? 'selected' : ''; ?>>Senin</option>
                                <option value="Selasa" <?php echo $row['hari_datang'] == 'Selasa' ? 'selected' : ''; ?>>Selasa</option>
                                <option value="Rabu" <?php echo $row['hari_datang'] == 'Rabu' ? 'selected' : ''; ?>>Rabu</option>
                                <option value="Kamis" <?php echo $row['hari_datang'] == 'Kamis' ? 'selected' : ''; ?>>Kamis</option>
                                <option value="Jumat" <?php echo $row['hari_datang'] == 'Jumat' ? 'selected' : ''; ?>>Jumat</option>
                                <option value="Sabtu" <?php echo $row['hari_datang'] == 'Sabtu' ? 'selected' : ''; ?>>Sabtu</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Datang</label>
                            <input type="date" class="form-control" name="tgl_datang" value="<?php echo $row['tgl_datang']; ?>" required>
                        </div>
                    </div>
                    
                    <!-- Berkas -->
                    <div class="mb-4">
                        <label class="form-label">Berkas yang Dibawa</label>
                        <div class="option-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="ijazah" id="ijazah" value="Yes" 
                                    <?php echo (isset($row['ijazah']) && $row['ijazah'] == 'Yes') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="ijazah">Ijazah</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="akte" id="akte" value="Yes"
                                    <?php echo (isset($row['akte']) && $row['akte'] == 'Yes') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="akte">Akte</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="kk" id="kk" value="Yes"
                                    <?php echo (isset($row['kk']) && $row['kk'] == 'Yes') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="kk">KK</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Pengambilan -->
                    <div class="mb-4">
                        <label class="form-label">Pengambilan</label>
                        <div class="option-group">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pengambilan" id="sendiri" value="Sendiri"
                                    <?php echo (isset($row['pengambilan']) && $row['pengambilan'] == 'Sendiri') ? 'checked' : ''; ?> required>
                                <label class="form-check-label" for="sendiri">Sendiri</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="pengambilan" id="wakilkan" value="Diwakilkan"
                                    <?php echo (isset($row['pengambilan']) && $row['pengambilan'] == 'Diwakilkan') ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="wakilkan">Diwakilkan</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Buttons -->
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <a href="daftar_ulang.php" class="btn-cancel me-md-2">
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
</body>
</html>
<?php mysqli_close($conn); ?>