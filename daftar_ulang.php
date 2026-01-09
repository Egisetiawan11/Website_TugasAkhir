<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Ulang Passport - Imigrasi Tangerang Selatan</title>
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

        .form-container {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            margin-bottom: 30px;
        }

        .form-title {
            color: var(--primary);
            font-weight: 600;
            font-size: 1.3rem;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            display: flex;
            align-items: center;
        }

        .form-title i {
            margin-right: 10px;
            color: var(--secondary);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
            font-size: 0.95rem;
            display: block;
        }

        .form-control, .form-select {
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--secondary);
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }

        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e0e0e0;
            border-right: none;
        }

        .option-group {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
            margin-top: 5px;
        }

        .form-check {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 0;
        }

        .form-check-input {
            width: 18px;
            height: 18px;
            margin-top: 0;
        }

        .form-check-label {
            font-size: 0.95rem;
            color: #555;
        }

        .btn-submit {
            background: var(--secondary);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
        }

        .btn-submit:hover {
            background: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
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
            padding: 12px 15px;
            border: none;
            font-size: 0.9rem;
        }

        .table tbody td {
            padding: 12px 15px;
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

        .berkas-icons {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .berkas-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
        }

        .icon-check {
            color: var(--secondary);
            font-size: 1rem;
        }

        .icon-times {
            color: var(--danger);
            font-size: 1rem;
        }

        .berkas-label {
            color: #666;
            min-width: 50px;
        }

        .text-yes {
            color: var(--secondary);
            font-weight: 500;
        }

        .text-no {
            color: var(--danger);
            font-weight: 500;
        }

        .badge-pengambilan {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.85rem;
            font-weight: 500;
            display: inline-block;
            background: var(--secondary);
            color: white;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn-action {
            padding: 8px 15px;
            border-radius: 6px;
            font-size: 0.9rem;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 80px;
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

        .form-check-input:checked {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }

        .form-check-input[type="checkbox"]:checked {
            background-color: var(--secondary);
            border-color: var(--secondary);
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
            
            .form-container, .table-container {
                padding: 20px;
            }
            
            .option-group {
                flex-direction: column;
                gap: 10px;
            }
            
            .action-buttons {
                flex-direction: column;
                gap: 8px;
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
                padding: 10px 12px;
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
                    <h1><i class="fas fa-redo-alt me-2"></i>Daftar Ulang Passport</h1>
                    <p>Formulir Pendaftaran Ulang Passport</p>
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
                $msg = isset($_GET['msg']) ? urldecode($_GET['msg']) : 'Data daftar ulang berhasil disimpan.';
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
                    case 'duplicate_no':
                        $error_msg = 'No. Antrian sudah melakukan daftar ulang!';
                        break;
                    case 'delete_failed':
                        $error_msg = 'Gagal menghapus data!';
                        break;
                    case 'data_not_found':
                        $error_msg = 'Data tidak ditemukan!';
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

            <div class="form-container">
                <h3 class="form-title"><i class="fas fa-edit me-2"></i>Input Daftar Ulang</h3>
                
                <form action="proses_daftar_ulang.php" method="POST" id="formDaftarUlang">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">No. Antrian</label>
                                <select class="form-select" name="no_antrian" id="no_antrian" required>
                                    <option value="">Pilih No. Antrian</option>
                                    <?php
                                    $sql = "SELECT no_antrian, nama_pemohon FROM pendaftaran ORDER BY no_antrian";
                                    $result = mysqli_query($conn, $sql);
                                    if ($result && mysqli_num_rows($result) > 0) {
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $check_sql = "SELECT * FROM daftar_ulang WHERE no_antrian = '{$row['no_antrian']}'";
                                            $check_result = mysqli_query($conn, $check_sql);
                                            $disabled = mysqli_num_rows($check_result) > 0 ? 'disabled' : '';
                                            $status = mysqli_num_rows($check_result) > 0 ? ' (Sudah Daftar Ulang)' : '';
                                            
                                            echo '<option value="'.$row['no_antrian'].'" '.$disabled.'>'
                                                .$row['no_antrian'].' - '.$row['nama_pemohon'].$status.'</option>';
                                        }
                                    } else {
                                        echo '<option value="">Belum ada data pendaftaran</option>';
                                    }
                                    ?>
                                </select>
                                <small class="text-muted mt-2 d-block">Pilih nomor antrian dari data yang sudah ada</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Nama Pemohon</label>
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" readonly required>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Hari Datang</label>
                                        <select class="form-select" name="hari_datang" id="hari_datang" required>
                                            <option value="">Pilih Hari</option>
                                            <option value="Senin">Senin</option>
                                            <option value="Selasa">Selasa</option>
                                            <option value="Rabu">Rabu</option>
                                            <option value="Kamis">Kamis</option>
                                            <option value="Jumat">Jumat</option>
                                            <option value="Sabtu">Sabtu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Datang</label>
                                        <input type="date" class="form-control" name="tgl_datang" id="tgl_datang" required>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="form-label">Berkas yang Dibawa</label>
                                <div class="option-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="ijazah" id="ijazah" value="Yes">
                                        <label class="form-check-label" for="ijazah">Ijazah</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="akte" id="akte" value="Yes">
                                        <label class="form-check-label" for="akte">Akte</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="kk" id="kk" value="Yes">
                                        <label class="form-check-label" for="kk">KK</label>
                                    </div>
                                </div>
                                <small class="text-muted mt-2 d-block">Centang berkas yang dibawa oleh pemohon</small>
                            </div>

                            <div class="form-group">
                                <label class="form-label">Pengambilan</label>
                                <div class="option-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengambilan" id="sendiri" value="Sendiri" required>
                                        <label class="form-check-label" for="sendiri">Sendiri</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="pengambilan" id="wakilkan" value="Diwakilkan">
                                        <label class="form-check-label" for="wakilkan">Diwakilkan</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4 pt-3 border-top">
                        <button type="submit" class="btn btn-submit">
                            <i class="fas fa-save me-2"></i>Simpan Data Daftar Ulang
                        </button>
                    </div>
                </form>
            </div>

            <div class="table-container">
                <h3 class="table-title"><i class="fas fa-list me-2"></i>Data Daftar Ulang</h3>
                
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th width="5%">No.</th>
                                <th width="15%">No. Antrian</th>
                                <th width="20%">Nama Pemohon</th>
                                <th width="10%">Hari</th>
                                <th width="15%">Tanggal</th>
                                <th width="15%">Berkas</th>
                                <th width="10%">Pengambilan</th>
                                <th width="10%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $data_daftar_ulang = getDaftarUlangData($conn);
                            $no = 1;
                            
                            if (count($data_daftar_ulang) > 0):
                                foreach($data_daftar_ulang as $row): 
                            ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><strong><?php echo htmlspecialchars($row['no_antrian']); ?></strong></td>
                                <td><?php echo htmlspecialchars($row['nama_pemohon']); ?></td>
                                <td><?php echo $row['hari_datang']; ?></td>
                                <td><?php echo date('d/m/Y', strtotime($row['tgl_datang'])); ?></td>
                                <td>
                                    <div class="berkas-icons">
                                        <div class="berkas-item">
                                            <span class="berkas-label">Ijazah:</span>
                                            <?php if (isset($row['ijazah']) && $row['ijazah'] == 'Yes'): ?>
                                                <i class="fas fa-check-circle icon-check"></i>
                                                <span class="text-yes">Ya</span>
                                            <?php else: ?>
                                                <i class="fas fa-times-circle icon-times"></i>
                                                <span class="text-no">Tidak</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="berkas-item">
                                            <span class="berkas-label">Akte:</span>
                                            <?php if (isset($row['akte']) && $row['akte'] == 'Yes'): ?>
                                                <i class="fas fa-check-circle icon-check"></i>
                                                <span class="text-yes">Ya</span>
                                            <?php else: ?>
                                                <i class="fas fa-times-circle icon-times"></i>
                                                <span class="text-no">Tidak</span>
                                            <?php endif; ?>
                                        </div>
                                        <div class="berkas-item">
                                            <span class="berkas-label">KK:</span>
                                            <?php if (isset($row['kk']) && $row['kk'] == 'Yes'): ?>
                                                <i class="fas fa-check-circle icon-check"></i>
                                                <span class="text-yes">Ya</span>
                                            <?php else: ?>
                                                <i class="fas fa-times-circle icon-times"></i>
                                                <span class="text-no">Tidak</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge-pengambilan">
                                        <?php echo $row['pengambilan']; ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="edit_daftar_ulang.php?id=<?php echo $row['id']; ?>" class="btn-action btn-edit">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </a>
                                        <a href="hapus_daftar_ulang.php?id=<?php echo $row['id']; ?>" 
                                           class="btn-action btn-delete" 
                                           onclick="return confirm('Apakah Anda yakin ingin menghapus data daftar ulang <?php echo htmlspecialchars($row['nama_pemohon']); ?>?')">
                                            <i class="fas fa-trash me-1"></i>Hapus
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php 
                                endforeach;
                            else: ?>
                            <tr>
                                <td colspan="8">
                                    <div class="empty-state">
                                        <i class="fas fa-inbox"></i>
                                        <p>Belum ada data daftar ulang</p>
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
        document.getElementById('no_antrian').addEventListener('change', function() {
            var noAntrian = this.value;
            var namaField = document.getElementById('nama_pemohon');
            
            if (noAntrian) {
                var selectedOption = this.options[this.selectedIndex];
                var text = selectedOption.text;
                var parts = text.split(' - ');
                
                if (parts.length >= 2) {
                    var nama = parts[1].replace(' (Sudah Daftar Ulang)', '');
                    namaField.value = nama.trim();
                } else {
                    namaField.value = '';
                }
            } else {
                namaField.value = '';
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date();
            var yyyy = today.getFullYear();
            var mm = String(today.getMonth() + 1).padStart(2, '0');
            var dd = String(today.getDate()).padStart(2, '0');
            var todayFormatted = yyyy + '-' + mm + '-' + dd;
            
            var tanggalField = document.getElementById('tgl_datang');
            if (tanggalField && !tanggalField.value) {
                tanggalField.value = todayFormatted;
            }
            
            var days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
            var dayName = days[today.getDay()];
            
            var hariField = document.getElementById('hari_datang');
            if (hariField && hariField.value === '') {
                hariField.value = dayName;
            }
            
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                setTimeout(() => {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
        
        document.getElementById('formDaftarUlang').addEventListener('submit', function(e) {
            var noAntrian = document.getElementById('no_antrian').value;
            var hariDatang = document.getElementById('hari_datang').value;
            var tglDatang = document.getElementById('tgl_datang').value;
            var pengambilan = document.querySelector('input[name="pengambilan"]:checked');
            
            if (!noAntrian) {
                alert('Silakan pilih No. Antrian!');
                e.preventDefault();
                return false;
            }
            
            if (!hariDatang) {
                alert('Silakan pilih Hari Datang!');
                e.preventDefault();
                return false;
            }
            
            if (!tglDatang) {
                alert('Silakan pilih Tanggal Datang!');
                e.preventDefault();
                return false;
            }
            
            if (!pengambilan) {
                alert('Silakan pilih opsi Pengambilan!');
                e.preventDefault();
                return false;
            }
            
            return true;
        });
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>