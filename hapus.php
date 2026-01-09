<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm_delete'])) {
    $id = $_POST['id'];
    
    $sql_select = "SELECT * FROM pendaftaran WHERE id = $id";
    $result = mysqli_query($conn, $sql_select);
    
    if (mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        $nama_pemohon = $data['nama_pemohon'];
        
        $sql_delete = "DELETE FROM pendaftaran WHERE id = $id";
        
        if (mysqli_query($conn, $sql_delete)) {
            header("Location: data_pendaftaran.php?deleted=1&nama=" . urlencode($nama_pemohon));
            exit();
        } else {
            header("Location: data_pendaftaran.php?error=delete_failed");
            exit();
        }
    } else {
        header("Location: data_pendaftaran.php?error=data_not_found");
        exit();
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM pendaftaran WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    
    if (!$result || mysqli_num_rows($result) == 0) {
        die("Data tidak ditemukan!");
    }
    
    $row = mysqli_fetch_assoc($result);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Data - Sistem Passport</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --danger: #e74c3c;
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
            background: linear-gradient(135deg, var(--danger), #c0392b);
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

        .confirmation-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            max-width: 500px;
            margin: 0 auto;
            text-align: center;
        }

        .warning-icon {
            font-size: 4rem;
            color: var(--danger);
            margin-bottom: 20px;
        }

        .confirmation-title {
            color: var(--danger);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .data-info {
            background: #f8d7da;
            border: 1px solid #f5c6cb;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 25px;
        }

        .data-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            font-size: 0.95rem;
        }

        .data-label {
            font-weight: 600;
            color: #721c24;
        }

        .data-value {
            color: #721c24;
        }

        .warning-text {
            color: #721c24;
            font-size: 0.9rem;
            margin-bottom: 25px;
        }

        .btn-delete-confirm {
            background: var(--danger);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-delete-confirm:hover {
            background: #c0392b;
            transform: translateY(-2px);
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
            
            .confirmation-container {
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
                        <h1><i class="fas fa-trash-alt me-2"></i>Hapus Data</h1>
                        <p>Konfirmasi penghapusan data pendaftaran</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="data_pendaftaran.php" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="confirmation-container">
                <div class="warning-icon">
                    <i class="fas fa-exclamation-triangle"></i>
                </div>
                
                <h3 class="confirmation-title">Konfirmasi Penghapusan</h3>
                <p class="text-muted mb-4">Anda akan menghapus data berikut:</p>

                <div class="data-info">
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

                <p class="warning-text">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    <strong>Peringatan:</strong> Tindakan ini tidak dapat dibatalkan. Data yang dihapus tidak dapat dikembalikan.
                </p>

                <form method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="hidden" name="confirm_delete" value="1">
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                        <a href="data_pendaftaran.php" class="btn-cancel me-md-2">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-delete-confirm">
                            <i class="fas fa-trash me-2"></i>Ya, Hapus Data
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