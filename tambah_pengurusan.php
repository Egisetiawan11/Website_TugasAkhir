<?php 
include 'config.php'; 

$pendaftaran_data = getPendaftaranAvailable($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_antrian = mysqli_real_escape_string($conn, $_POST['no_antrian']);
    $nama_pemohon = mysqli_real_escape_string($conn, $_POST['nama_pemohon']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $tgl_periksa = mysqli_real_escape_string($conn, $_POST['tgl_periksa']);

    $daftar_ulang = getDaftarUlangByNo($conn, $no_antrian);
    
    // Menggunakan field yang benar: ijazah, akte, kk
    $berkas_ijazah = $daftar_ulang ? ($daftar_ulang['ijazah'] == 'Yes' ? 'Lengkap' : 'Tidak Lengkap') : 'Belum Diperiksa';
    $berkas_akte = $daftar_ulang ? ($daftar_ulang['akte'] == 'Yes' ? 'Lengkap' : 'Tidak Lengkap') : 'Belum Diperiksa';
    $berkas_kk = $daftar_ulang ? ($daftar_ulang['kk'] == 'Yes' ? 'Lengkap' : 'Tidak Lengkap') : 'Belum Diperiksa';

    $sql = "INSERT INTO pengurusan (no_antrian, nama_pemohon, berkas_ijazah, berkas_akte, berkas_kk, status, keterangan, tgl_periksa) 
            VALUES ('$no_antrian', '$nama_pemohon', '$berkas_ijazah', '$berkas_akte', '$berkas_kk', '$status', '$keterangan', '$tgl_periksa')";

    if (mysqli_query($conn, $sql)) {
        header("Location: pengurusan.php?success=1&msg=Data pengurusan berhasil ditambahkan");
        exit();
    } else {
        header("Location: pengurusan.php?error=database_error");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pengurusan - Imigrasi Tangerang Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
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
            margin-bottom: 30px;
        }

        .page-title h1 {
            font-weight: 700;
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
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .form-title {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f8f9fa;
        }

        .form-label {
            font-weight: 600;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .btn-submit {
            background: var(--secondary);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
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
        }

        .btn-submit:hover {
            background: #2980b9;
            color: white;
        }

        .info-box {
            background: #e3f2fd;
            border: 1px solid #bbdefb;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .info-box p {
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .text-note {
            font-size: 0.85rem;
            color: #6c757d;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <div class="page-title">
                        <h1><i class="fas fa-plus me-2"></i>Tambah Data Pengurusan</h1>
                        <p>Input data pengurusan Passport baru</p>
                    </div>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="pengurusan.php" class="btn-back">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="form-container">
                <h3 class="form-title"><i class="fas fa-user-plus me-2"></i>Form Data Pengurusan</h3>
                
                <form method="POST" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">No. Antrian</label>
                                <select class="form-select" name="no_antrian" id="no_antrian" required onchange="updateNamaPemohon()">
                                    <option value="">Pilih No. Antrian</option>
                                    <?php foreach($pendaftaran_data as $data): ?>
                                    <option value="<?php echo $data['no_antrian']; ?>">
                                        <?php echo $data['no_antrian'] . ' - ' . $data['nama_pemohon']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="text-note">*Hanya menampilkan data pendaftaran yang belum ada di pengurusan</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Nama Pemohon</label>
                                <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" readonly required>
                            </div>
                        </div>
                    </div>

                    <div class="info-box" id="infoBerkas" style="display: none;">
                        <h6><i class="fas fa-info-circle me-2"></i>Informasi Berkas yang Dibawa</h6>
                        <div id="berkasInfoContent"></div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Status Pengurusan</label>
                                <select class="form-select" name="status" required>
                                    <option value="Menunggu">Menunggu</option>
                                    <option value="Proses">Proses</option>
                                    <option value="Selesai">Selesai</option>
                                    <option value="Ditolak">Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Periksa</label>
                                <input type="date" class="form-control" name="tgl_periksa" value="<?php echo date('Y-m-d'); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3" placeholder="Masukkan keterangan jika ada"></textarea>
                        <div class="text-note">*Keterangan akan ditampilkan di kolom keterangan tabel pengurusan</div>
                    </div>

                    <div class="d-flex justify-content-between border-top pt-4">
                        <a href="pengurusan.php" class="btn-cancel">
                            <i class="fas fa-times me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn-submit">
                            <i class="fas fa-save me-2"></i>Simpan Data
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateNamaPemohon() {
            var selectedOption = document.getElementById('no_antrian').options[document.getElementById('no_antrian').selectedIndex];
            var text = selectedOption.text;
            var parts = text.split(' - ');
            
            if (parts.length >= 2 && selectedOption.value !== '') {
                document.getElementById('nama_pemohon').value = parts[1].trim();
                
                var noAntrian = selectedOption.value;
                fetch('get_berkas_daftar_ulang.php?no_antrian=' + noAntrian)
                    .then(response => response.json())
                    .then(data => {
                        var infoBox = document.getElementById('infoBerkas');
                        var contentBox = document.getElementById('berkasInfoContent');
                        
                        if (data.exists) {
                            var html = '<p><strong>Berkas yang dibawa saat daftar ulang:</strong></p>';
                            html += '<p><i class="fas fa-' + (data.ijazah == 'Yes' ? 'check text-success' : 'times text-danger') + ' me-2"></i> Ijazah: ' + (data.ijazah == 'Yes' ? 'Dibawa' : 'Tidak Dibawa') + '</p>';
                            html += '<p><i class="fas fa-' + (data.akte == 'Yes' ? 'check text-success' : 'times text-danger') + ' me-2"></i> Akte: ' + (data.akte == 'Yes' ? 'Dibawa' : 'Tidak Dibawa') + '</p>';
                            html += '<p><i class="fas fa-' + (data.kk == 'Yes' ? 'check text-success' : 'times text-danger') + ' me-2"></i> KK: ' + (data.kk == 'Yes' ? 'Dibawa' : 'Tidak Dibawa') + '</p>';
                            contentBox.innerHTML = html;
                            infoBox.style.display = 'block';
                        } else {
                            contentBox.innerHTML = '<p>Tidak ada data daftar ulang untuk nomor ini.</p>';
                            infoBox.style.display = 'block';
                        }
                    });
            } else {
                document.getElementById('nama_pemohon').value = '';
                document.getElementById('infoBerkas').style.display = 'none';
            }
        }
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>