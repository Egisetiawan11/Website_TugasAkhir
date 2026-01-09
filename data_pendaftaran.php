<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pendaftaran Passport - Imigrasi Tangerang Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
            --warning: #f39c12;
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

        .stats-card {
            background: white;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            margin-bottom: 30px;
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .stats-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .table-container {
            background: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
        }

        .table-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }

        .table-title {
            color: var(--primary);
            font-weight: 600;
            margin: 0;
        }

        .table-title i {
            color: var(--secondary);
        }

        .btn-add {
            background: var(--success);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-add:hover {
            background: #219a52;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .table {
            margin-bottom: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--primary);
            color: white;
            border: none;
            padding: 15px;
            font-weight: 600;
            font-size: 0.95rem;
        }

        .table tbody td {
            padding: 15px;
            vertical-align: middle;
            border-color: #f8f9fa;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .badge-no {
            background: var(--secondary);
            color: white;
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .nama-pemohon {
            font-weight: 600;
            color: var(--dark);
        }

        .tanggal {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-edit {
            background: var(--secondary);
            color: white;
        }

        .btn-edit:hover {
            background: #2980b9;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
        }

        .btn-delete:hover {
            background: #c0392b;
            color: white;
            text-decoration: none;
            transform: translateY(-1px);
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            justify-content: center;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state i {
            font-size: 4rem;
            color: #bdc3c7;
            margin-bottom: 20px;
        }

        .empty-state h4 {
            color: #6c757d;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 25px;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-bottom: 25px;
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
            
            .table-container {
                padding: 20px;
            }
            
            .table-header {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 5px;
            }
            
            .btn-action {
                width: 100%;
                text-align: center;
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
                        <h1><i class="fas fa-database me-2"></i>Data Pendaftaran Passport</h1>
                        <p>Daftar seluruh pengajuan pembuatan Passport</p>
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
            <?php
            if (isset($_GET['deleted']) && $_GET['deleted'] == 1) {
                $nama = isset($_GET['nama']) ? htmlspecialchars($_GET['nama']) : 'Data';
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Berhasil!</strong> Data ' . $nama . ' telah dihapus.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            }

            if (isset($_GET['error'])) {
                $error_message = '';
                switch ($_GET['error']) {
                    case 'delete_failed':
                        $error_message = 'Gagal menghapus data. Silakan coba lagi.';
                        break;
                    case 'data_not_found':
                        $error_message = 'Data tidak ditemukan.';
                        break;
                    case 'no_id':
                        $error_message = 'ID data tidak diberikan.';
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

            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $sql_total = "SELECT COUNT(*) as total FROM pendaftaran";
                            $result_total = mysqli_query($conn, $sql_total);
                            $row_total = mysqli_fetch_assoc($result_total);
                            echo $row_total['total'];
                            ?>
                        </div>
                        <div class="stats-label">Total Pendaftar</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $sql_today = "SELECT COUNT(*) as today FROM pendaftaran WHERE DATE(tgl_daftar) = CURDATE()";
                            $result_today = mysqli_query($conn, $sql_today);
                            $row_today = mysqli_fetch_assoc($result_today);
                            echo $row_today['today'];
                            ?>
                        </div>
                        <div class="stats-label">Pendaftar Hari Ini</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-number">
                            <?php
                            $sql_month = "SELECT COUNT(*) as month FROM pendaftaran WHERE MONTH(tgl_daftar) = MONTH(CURDATE())";
                            $result_month = mysqli_query($conn, $sql_month);
                            $row_month = mysqli_fetch_assoc($result_month);
                            echo $row_month['month'];
                            ?>
                        </div>
                        <div class="stats-label">Pendaftar Bulan Ini</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stats-card">
                        <div class="stats-number text-success">
                            <i class="fas fa-database"></i>
                        </div>
                        <div class="stats-label">Data Tersimpan</div>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="table-header">
                    <h3 class="table-title"><i class="fas fa-list me-2"></i>Daftar Pengajuan</h3>
                    <div>
                        <a href="daftar.php" class="btn-add">
                            <i class="fas fa-plus me-2"></i>Tambah Data
                        </a>
                    </div>
                </div>

                <?php
                $sql = "SELECT * FROM pendaftaran ORDER BY id DESC";
                $result = mysqli_query($conn, $sql);
                $total_data = mysqli_num_rows($result);
                ?>

                <?php if ($total_data > 0): ?>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th width="20%">No. Antrian</th>
                                    <th width="30%">Nama Pemohon</th>
                                    <th width="25%">Tanggal Daftar</th>
                                    <th width="25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($row = mysqli_fetch_assoc($result)): ?>
                                <tr>
                                    <td>
                                        <span class="badge-no"><?php echo htmlspecialchars($row['no_antrian']); ?></span>
                                    </td>
                                    <td>
                                        <span class="nama-pemohon"><?php echo htmlspecialchars($row['nama_pemohon']); ?></span>
                                    </td>
                                    <td>
                                        <span class="tanggal">
                                            <i class="fas fa-calendar me-2"></i>
                                            <?php echo date('d/m/Y', strtotime($row['tgl_daftar'])); ?>
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </a>
                                            <a href="hapus.php?id=<?php echo $row['id']; ?>" class="btn-action btn-delete" 
                                               onclick="return confirm('Apakah Anda yakin ingin menghapus data <?php echo htmlspecialchars($row['nama_pemohon']); ?>?')">
                                                <i class="fas fa-trash me-1"></i>Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <i class="fas fa-inbox"></i>
                        <h4>Belum Ada Data Pendaftaran</h4>
                        <p>Silakan tambah data pendaftaran melalui form input</p>
                        <a href="daftar.php" class="btn-add">
                            <i class="fas fa-plus me-2"></i>Tambah Data Pendaftaran
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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