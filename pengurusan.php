<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengurusan Passport - Imigrasi Tangerang Selatan</title>
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
            --info: #17a2b8;
            --light: #f8f9fa;
            --dark: #343a40;
        }

        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #f5f5f5;
            color: #333;
        }

        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 25px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 5px;
        }

        .page-title p {
            opacity: 0.9;
            margin-bottom: 0;
            font-size: 1rem;
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
            transform: translateY(-2px);
        }

        .main-content {
            padding: 0 0 30px 0;
        }

        .table-container {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
        }

        .table-title {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
        }

        .table-title i {
            margin-right: 10px;
            color: var(--secondary);
        }

        .table {
            font-size: 0.92rem;
            margin-bottom: 0;
            border-radius: 8px;
            overflow: hidden;
        }

        .table thead th {
            background: var(--primary);
            color: white;
            font-weight: 600;
            padding: 12px 10px;
            border: none;
            font-size: 0.9rem;
        }

        .table tbody td {
            padding: 12px 10px;
            vertical-align: middle;
            border-bottom: 1px solid #f0f0f0;
            color: #555;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(52, 152, 219, 0.05);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
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

        /* Badge Pembayaran */
        .badge-bayar {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
        }

        .bayar-sudah {
            background: #27ae60;
            color: white;
        }

        .bayar-belum {
            background: #e74c3c;
            color: white;
        }

        .bayar-pending {
            background: #f39c12;
            color: white;
        }

        .berkas-status {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .berkas-item {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.85rem;
        }

        .berkas-label {
            min-width: 45px;
            color: #666;
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

        .icon-dibawa {
            font-size: 0.8rem;
            padding: 2px 6px;
            border-radius: 3px;
            background: #e3f2fd;
            color: #1976d2;
        }

        .keterangan-text {
            max-width: 150px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            font-size: 0.85rem;
            color: #666;
        }

        .action-buttons {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .btn-action {
            padding: 6px 12px;
            border-radius: 6px;
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 500;
        }

        .btn-edit {
            background: var(--secondary);
            color: white;
            border: 1px solid #2980b9;
        }

        .btn-edit:hover {
            background: #2980b9;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
        }

        .btn-delete {
            background: var(--danger);
            color: white;
            border: 1px solid #c0392b;
        }

        .btn-delete:hover {
            background: #c0392b;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(192, 57, 43, 0.3);
        }

        .btn-check {
            background: var(--success);
            color: white;
            border: 1px solid #219a52;
        }

        .btn-check:hover {
            background: #219a52;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(33, 154, 82, 0.3);
        }

        .btn-bayar {
            background: var(--warning);
            color: white;
            border: 1px solid #e67e22;
        }

        .btn-bayar:hover {
            background: #e67e22;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(230, 126, 34, 0.3);
        }

        .btn-cetak {
            background: var(--info);
            color: white;
            border: 1px solid #138496;
        }

        .btn-cetak:hover {
            background: #138496;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(19, 132, 150, 0.3);
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 1.1rem;
            margin-bottom: 0;
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
            margin-bottom: 25px;
        }

        .filter-section {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
            border: 1px solid #e9ecef;
        }

        .filter-title {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary);
        }

        @media (max-width: 768px) {
            .page-header {
                padding: 20px 0;
                margin-bottom: 20px;
            }
            
            .page-title h1 {
                font-size: 1.6rem;
            }
            
            .main-content {
                padding: 0 0 20px 0;
            }
            
            .table-container {
                padding: 20px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 6px;
            }
            
            .btn-action {
                width: 100%;
                justify-content: center;
            }
            
            .table {
                font-size: 0.85rem;
            }
            
            .table thead th, 
            .table tbody td {
                padding: 10px 8px;
            }
            
            .berkas-item {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="page-title">
                    <h1><i class="fas fa-tasks me-2"></i>Pengurusan Passport</h1>
                    <p>Kelola dan pantau proses pengajuan Passport Anda</p>
                </div>
                <div>
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
            if (isset($_GET['success'])) {
                $msg = isset($_GET['msg']) ? urldecode($_GET['msg']) : 'Data pengurusan berhasil diperbarui.';
                echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        <strong>Berhasil!</strong> ' . $msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            }
            
            if (isset($_GET['error'])) {
                $error_msg = '';
                switch ($_GET['error']) {
                    case 'empty_fields':
                        $error_msg = 'Semua field harus diisi!';
                        break;
                    case 'data_not_found':
                        $error_msg = 'Data tidak ditemukan!';
                        break;
                    case 'delete_failed':
                        $error_msg = 'Gagal menghapus data!';
                        break;
                    case 'duplicate_no':
                        $error_msg = 'Data pengurusan sudah ada untuk nomor antrian ini!';
                        break;
                    default:
                        $error_msg = 'Terjadi kesalahan. Silakan coba lagi.';
                }
                
                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Error!</strong> ' . $error_msg . '
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                      </div>';
            }
            ?>

            <div class="filter-section">
                <h5 class="filter-title"><i class="fas fa-filter me-2"></i>Filter Data</h5>
                <div class="row g-3">
                    <div class="col-md-3">
                        <select class="form-select" id="filterStatus" onchange="filterTable()">
                            <option value="">Semua Status</option>
                            <option value="Menunggu">Menunggu</option>
                            <option value="Proses">Proses</option>
                            <option value="Selesai">Selesai</option>
                            <option value="Ditolak">Ditolak</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <select class="form-select" id="filterPembayaran" onchange="filterTable()">
                            <option value="">Semua Pembayaran</option>
                            <option value="Belum Bayar">Belum Bayar</option>
                            <option value="Sudah Bayar">Sudah Bayar</option>
                            <option value="Pending">Pending</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="filterNoAntrian" placeholder="Cari No. Antrian" onkeyup="filterTable()">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-secondary w-100" onclick="resetFilter()">
                            <i class="fas fa-redo me-2"></i>Reset Filter
                        </button>
                    </div>
                </div>
            </div>

            <div class="table-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="table-title mb-0"><i class="fas fa-list me-2"></i>Data Pengurusan Passport</h3>
                    <a href="tambah_pengurusan.php" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Tambah Data
                    </a>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-hover" id="tablePengurusan">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="10%">No. Antrian</th>
                                <th width="13%">Nama Pemohon</th>
                                <th width="15%">Berkas</th>
                                <th width="10%">Status</th>
                                <th width="12%">Pembayaran</th>
                                <th width="10%">Jumlah</th>
                                <th width="12%">Keterangan</th>
                                <th width="13%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data_pengurusan = getPengurusanData($conn);
                            $no = 1;
                            
                            if (count($data_pengurusan) > 0):
                                foreach($data_pengurusan as $row): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['no_antrian']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['nama_pemohon']); ?></td>
                                <td>
                                    <div class="berkas-status">
                                        <div class="berkas-item">
                                            <span class="berkas-label">Ijazah:</span>
                                            <span class="icon-dibawa" title="Berkas yang dibawa">
                                                <i class="fas fa-<?php echo isset($row['ijazah_dibawa']) && $row['ijazah_dibawa'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?>"></i>
                                            </span>
                                            <?php 
                                            $badge_class = '';
                                            switch(isset($row['berkas_ijazah']) ? $row['berkas_ijazah'] : 'Belum Diperiksa') {
                                                case 'Lengkap': $badge_class = 'badge-lengkap'; break;
                                                case 'Tidak Lengkap': $badge_class = 'badge-tidak-lengkap'; break;
                                                default: $badge_class = 'badge-belum';
                                            }
                                            ?>
                                            <span class="<?php echo $badge_class; ?>"><?php echo isset($row['berkas_ijazah']) ? $row['berkas_ijazah'] : 'Belum Diperiksa'; ?></span>
                                        </div>
                                        <div class="berkas-item">
                                            <span class="berkas-label">Akte:</span>
                                            <span class="icon-dibawa" title="Berkas yang dibawa">
                                                <i class="fas fa-<?php echo isset($row['akte_dibawa']) && $row['akte_dibawa'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?>"></i>
                                            </span>
                                            <?php 
                                            $badge_class = '';
                                            switch(isset($row['berkas_akte']) ? $row['berkas_akte'] : 'Belum Diperiksa') {
                                                case 'Lengkap': $badge_class = 'badge-lengkap'; break;
                                                case 'Tidak Lengkap': $badge_class = 'badge-tidak-lengkap'; break;
                                                default: $badge_class = 'badge-belum';
                                            }
                                            ?>
                                            <span class="<?php echo $badge_class; ?>"><?php echo isset($row['berkas_akte']) ? $row['berkas_akte'] : 'Belum Diperiksa'; ?></span>
                                        </div>
                                        <div class="berkas-item">
                                            <span class="berkas-label">KK:</span>
                                            <span class="icon-dibawa" title="Berkas yang dibawa">
                                                <i class="fas fa-<?php echo isset($row['kk_dibawa']) && $row['kk_dibawa'] == 'Yes' ? 'check text-success' : 'times text-danger'; ?>"></i>
                                            </span>
                                            <?php 
                                            $badge_class = '';
                                            switch(isset($row['berkas_kk']) ? $row['berkas_kk'] : 'Belum Diperiksa') {
                                                case 'Lengkap': $badge_class = 'badge-lengkap'; break;
                                                case 'Tidak Lengkap': $badge_class = 'badge-tidak-lengkap'; break;
                                                default: $badge_class = 'badge-belum';
                                            }
                                            ?>
                                            <span class="<?php echo $badge_class; ?>"><?php echo isset($row['berkas_kk']) ? $row['berkas_kk'] : 'Belum Diperiksa'; ?></span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <?php 
                                    $status_class = '';
                                    switch($row['status']) {
                                        case 'Proses': $status_class = 'status-proses'; break;
                                        case 'Selesai': $status_class = 'status-selesai'; break;
                                        case 'Ditolak': $status_class = 'status-ditolak'; break;
                                        default: $status_class = 'status-menunggu';
                                    }
                                    ?>
                                    <span class="badge-status <?php echo $status_class; ?>">
                                        <?php echo $row['status']; ?>
                                    </span>
                                </td>
                                <td>
                                    <?php 
                                    $bayar_class = '';
                                    switch($row['status_pembayaran']) {
                                        case 'Sudah Bayar': $bayar_class = 'bayar-sudah'; break;
                                        case 'Pending': $bayar_class = 'bayar-pending'; break;
                                        default: $bayar_class = 'bayar-belum';
                                    }
                                    ?>
                                    <span class="badge-bayar <?php echo $bayar_class; ?>">
                                        <?php echo $row['status_pembayaran']; ?>
                                    </span>
                                    <?php if(isset($row['metode_pembayaran']) && $row['metode_pembayaran']): ?>
                                    <br><small class="text-muted"><?php echo $row['metode_pembayaran']; ?></small>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <strong>Rp <?php echo number_format($row['jumlah_pembayaran'], 0, ',', '.'); ?></strong>
                                </td>
                                <td>
                                    <div class="keterangan-text" title="<?php echo htmlspecialchars($row['keterangan']); ?>">
                                        <?php 
                                        echo !empty($row['keterangan']) ? 
                                            (strlen($row['keterangan']) > 30 ? 
                                                substr($row['keterangan'], 0, 30) . '...' : 
                                                $row['keterangan']) : 
                                            '-';
                                        ?>
                                    </div>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="edit_pengurusan.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit" title="Edit Data">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="periksa_pengurusan.php?id=<?php echo $row['id']; ?>" class="btn-action btn-check" title="Periksa">
                                            <i class="fas fa-check"></i>
                                        </a>
                                        <?php if($row['status_pembayaran'] == 'Belum Bayar'): ?>
                                        <a href="pembayaran.php?id=<?php echo $row['id']; ?>" class="btn-action btn-bayar" title="Bayar">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if($row['status_pembayaran'] == 'Sudah Bayar'): ?>
                                        <a href="cetak_pembayaran.php?id=<?php echo $row['id']; ?>" class="btn-action btn-cetak" target="_blank" title="Cetak Bukti">
                                            <i class="fas fa-print"></i>
                                        </a>
                                        <?php endif; ?>
                                        <a href="hapus_pengurusan.php?id=<?php echo $row['id']; ?>" 
                                           class="btn-action btn-delete" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data pengurusan <?php echo htmlspecialchars($row['nama_pemohon']); ?>?')" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                endforeach;
                            else: ?>
                            <tr>
                                <td colspan="9">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Belum ada data pengurusan</p>
                                        <a href="tambah_pengurusan.php" class="btn btn-primary mt-3">
                                            <i class="fas fa-plus me-2"></i>Tambah Data Pengurusan
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function filterTable() {
            const filterStatus = document.getElementById('filterStatus').value.toLowerCase();
            const filterPembayaran = document.getElementById('filterPembayaran').value.toLowerCase();
            const filterNoAntrian = document.getElementById('filterNoAntrian').value.toLowerCase();
            const table = document.getElementById('tablePengurusan');
            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) {
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                
                if (cells.length < 9) continue;
                
                const noAntrian = cells[1].textContent.toLowerCase();
                const status = cells[4].textContent.toLowerCase();
                const pembayaran = cells[5].textContent.toLowerCase();
                
                const matchNoAntrian = filterNoAntrian === '' || noAntrian.includes(filterNoAntrian);
                const matchStatus = filterStatus === '' || status.includes(filterStatus);
                const matchPembayaran = filterPembayaran === '' || pembayaran.includes(filterPembayaran);
                
                if (matchNoAntrian && matchStatus && matchPembayaran) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        }

        function resetFilter() {
            document.getElementById('filterStatus').value = '';
            document.getElementById('filterPembayaran').value = '';
            document.getElementById('filterNoAntrian').value = '';
            filterTable();
        }

        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });

            const urlParams = new URLSearchParams(window.location.search);
            const status = urlParams.get('status');
            if (status) {
                document.getElementById('filterStatus').value = status;
                filterTable();
            }
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>