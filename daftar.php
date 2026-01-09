<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pendaftaran Passport </title>
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
            text-align: left;
        }

        .page-title h1 {
            font-weight: 700;
            margin-bottom: 5px;
            font-size: 2.2rem;
        }

        .page-title p {
            opacity: 0.9;
            margin-bottom: 0;
            font-size: 1.1rem;
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
            margin-bottom: 30px;
        }

        .section-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
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

        .stats-card {
            background: linear-gradient(135deg, var(--secondary), #2980b9);
            color: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
        }

        .stats-number {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 5px;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .info-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
        }

        .info-item {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .info-icon {
            width: 45px;
            height: 45px;
            background: rgba(52, 152, 219, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: var(--secondary);
            font-size: 1.1rem;
        }

        .info-content h6 {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .info-content small {
            color: #6c757d;
        }

        .btn-submit {
            background: var(--success);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            background: #219a52;
            transform: translateY(-2px);
        }

        .btn-reset {
            background: #6c757d;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-reset:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }

        .btn-manage {
            background: var(--secondary);
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-manage:hover {
            background: #2980b9;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 20px 0;
            }
            
            .page-title {
                text-align: center;
                margin-bottom: 20px;
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
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-title">
                        <h1><i class="fas fa-user-plus me-2"></i>Form Pendaftaran Passport</h1>
                        <p>Pengajuan pembuatan Passport baru</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="index.php" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-container">
                        <h3 class="section-title"><i class="fas fa-user-circle me-2"></i>Data Pemohon</h3>
                        
                        <?php
                        if (isset($_GET['success']) && $_GET['success'] == 1) {
                            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <i class="fas fa-check-circle me-2"></i>
                                    <strong>Berhasil!</strong> Data pendaftaran telah disimpan.
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        }
                        
                        if (isset($_GET['error'])) {
                            $error_message = '';
                            switch ($_GET['error']) {
                                case 'empty_fields':
                                    $error_message = 'Semua field harus diisi!';
                                    break;
                                case 'duplicate_no':
                                    $error_message = 'No. Antrian sudah ada! Gunakan nomor yang berbeda.';
                                    break;
                                case 'database_error':
                                    $error_message = 'Terjadi kesalahan database. Silakan coba lagi.';
                                    break;
                                default:
                                    $error_message = 'Terjadi kesalahan. Silakan coba lagi.';
                            }
                            
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <i class="fas fa-exclamation-triangle me-2"></i>
                                    <strong>Error!</strong> ' . $error_message . '
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                                  </div>';
                        }
                        ?>

                        <form action="proses_daftar.php" method="POST" onsubmit="return validateForm()">
                            <div class="mb-4">
                                <label for="no_antrian" class="form-label">No. Antrian</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-hashtag"></i></span>
                                    <input type="text" class="form-control" id="no_antrian" name="no_antrian" 
                                           placeholder="Masukkan nomor antrian" required
                                           value="<?php echo isset($_POST['no_antrian']) ? htmlspecialchars($_POST['no_antrian']) : ''; ?>">
                                </div>
                                <div class="help-text">Contoh: PS001</div>
                            </div>

                            <div class="mb-4">
                                <label for="nama_pemohon" class="form-label">Nama Lengkap Pemohon</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" 
                                           placeholder="Masukkan nama lengkap" required
                                           value="<?php echo isset($_POST['nama_pemohon']) ? htmlspecialchars($_POST['nama_pemohon']) : ''; ?>">
                                </div>
                                <div class="help-text">Isi dengan nama lengkap sesuai dokumen resmi</div>
                            </div>

                            <div class="mb-4">
                                <label for="tgl_daftar" class="form-label">Tanggal Pendaftaran</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                    <input type="date" class="form-control" id="tgl_daftar" name="tgl_daftar" required
                                           value="<?php echo isset($_POST['tgl_daftar']) ? $_POST['tgl_daftar'] : date('Y-m-d'); ?>">
                                </div>
                            </div>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end border-top pt-4">
                                <button type="reset" class="btn btn-reset me-md-2">
                                    <i class="fas fa-redo me-2"></i>Reset Form
                                </button>
                                <button type="submit" class="btn btn-submit">
                                    <i class="fas fa-save me-2"></i>Simpan Data
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="form-container">
                        <h3 class="section-title"><i class="fas fa-database me-2"></i>Manajemen Data</h3>
                        <p class="text-muted mb-3">Kelola data pendaftaran yang telah tersimpan dalam sistem</p>
                        <a href="data_pendaftaran.php" class="btn-manage">
                            <i class="fas fa-table me-2"></i>Lihat Data Pendaftaran
                        </a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $sql = "SELECT COUNT(*) as total FROM pendaftaran";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['total'];
                            ?>
                        </div>
                        <div class="stats-label">Total Pendaftar</div>
                    </div>

                    <div class="info-card">
                        <h5 class="section-title mb-4"><i class="fas fa-info-circle me-2"></i>Informasi</h5>
                        
                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <div class="info-content">
                                <h6>Proses Cepat</h6>
                                <small>Pengajuan online 24 jam</small>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="info-content">
                                <h6>Data Aman</h6>
                                <small>Terjamin keamanannya</small>
                            </div>
                        </div>

                        <div class="info-item">
                            <div class="info-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="info-content">
                                <h6>Terpercaya</h6>
                                <small>Resmi Imigrasi</small>
                            </div>
                        </div>
                    </div>

                    <div class="info-card mt-4">
                        <h5 class="section-title mb-4"><i class="fas fa-lightbulb me-2"></i>Tips Pengisian</h5>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Isi data dengan benar</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Gunakan nama lengkap</li>
                            <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Periksa sebelum simpan</li>
                            <li><i class="fas fa-check text-success me-2"></i>Simpan bukti pendaftaran</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function validateForm() {
            const noAntrian = document.getElementById('no_antrian').value;
            const namaPemohon = document.getElementById('nama_pemohon').value;
            const tglDaftar = document.getElementById('tgl_daftar').value;
            
            if (!noAntrian || !namaPemohon || !tglDaftar) {
                alert('Semua field harus diisi!');
                return false;
            }
            return true;
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            const tglDaftar = document.getElementById('tgl_daftar');
            if (!tglDaftar.value) {
                tglDaftar.valueAsDate = new Date();
            }

            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>