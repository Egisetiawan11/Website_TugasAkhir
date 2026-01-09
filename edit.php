<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM pendaftaran WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    die("Data tidak ditemukan!");
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_antrian = mysqli_real_escape_string($conn, $_POST['no_antrian']);
    $nama_pemohon = mysqli_real_escape_string($conn, $_POST['nama_pemohon']);
    $tgl_daftar = mysqli_real_escape_string($conn, $_POST['tgl_daftar']);

    $sql = "UPDATE pendaftaran SET no_antrian='$no_antrian', nama_pemohon='$nama_pemohon', tgl_daftar='$tgl_daftar' WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil diupdate!');
                window.location.href = 'data_pendaftaran.php';
              </script>";
    } else {
        echo "<script>
                alert('Error: " . mysqli_error($conn) . "');
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Pendaftaran - Sistem Passport</title>
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

        .page-title {
            text-align: left
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

        .form-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            max-width: 600px;
            margin: 0 auto;
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
            text-align: center;
        }

        .section-title i {
            color: var(--secondary);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-right: none;
        }

        .help-text {
            font-size: 0.875rem;
            color: #6c757d;
            margin-top: 5px;
        }

        .btn-update {
            background: var(--secondary);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
        }

        .btn-update:hover {
            background: #2980b9;
            transform: translateY(-2px);
            color: white;
        }

        .btn-cancel {
            background: #6c757d;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            color: white;
        }

        .btn-cancel:hover {
            background: #5a6268;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .current-data {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 25px;
        }

        .current-data h6 {
            color: #1565c0;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .data-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .data-label {
            font-weight: 500;
            color: #1565c0;
        }

        .data-value {
            color: #1565c0;
        }

        .form-group {
            margin-bottom: 25px;
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
            
            .form-container {
                padding: 20px;
            }
            
            .data-item {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .data-value {
                margin-top: 2px;
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
                        <h1><i class="fas fa-edit me-2"></i>Edit Data Pendaftaran</h1>
                        <p>Perbarui informasi pendaftaran Passport</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="data_pendaftaran.php" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Data
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="form-container">
                <h3 class="section-title"><i class="fas fa-user-edit me-2"></i>Form Edit Data</h3>
                
                <div class="current-data">
                    <h6><i class="fas fa-info-circle me-2"></i>Data Saat Ini</h6>
                    <div class="data-item">
                        <span class="data-label">No. Antrian:</span>
                        <span class="data-value"><?php echo htmlspecialchars($row['no_antrian']); ?></span>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Nama Pemohon:</span>
                        <span class="data-value"><?php echo htmlspecialchars($row['nama_pemohon']); ?></span>
                    </div>
                    <div class="data-item">
                        <span class="data-label">Tanggal Daftar:</span>
                        <span class="data-value"><?php echo date('d/m/Y', strtotime($row['tgl_daftar'])); ?></span>
                    </div>
                </div>

                <form method="POST">
                    <div class="form-group">
                        <label for="no_antrian" class="form-label">No. Antrian</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                            <input type="text" class="form-control" id="no_antrian" name="no_antrian" 
                                   placeholder="Masukkan nomor antrian" required
                                   value="<?php echo htmlspecialchars($row['no_antrian']); ?>">
                        </div>
                        <div class="help-text">Contoh: PSP2025001</div>
                    </div>

                    <div class="form-group">
                        <label for="nama_pemohon" class="form-label">Nama Lengkap Pemohon</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" 
                                   placeholder="Masukkan nama lengkap" required
                                   value="<?php echo htmlspecialchars($row['nama_pemohon']); ?>">
                        </div>
                        <div class="help-text">Isi dengan nama lengkap sesuai dokumen resmi</div>
                    </div>

                    <div class="form-group">
                        <label for="tgl_daftar" class="form-label">Tanggal Pendaftaran</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" required
                                   value="<?php echo $row['tgl_daftar']; ?>">
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                        <a href="data_pendaftaran.php" class="btn-cancel me-md-2">
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
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tgl_daftar').min = today;
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>