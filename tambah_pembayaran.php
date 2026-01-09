<?php
include 'config.php';

// Ambil data pengurusan yang belum dibayar
$sql = "SELECT p.* FROM pengurusan p 
        LEFT JOIN pembayaran pb ON p.no_antrian = pb.no_antrian 
        WHERE pb.no_antrian IS NULL 
        AND p.status NOT IN ('Ditolak')";
$result = mysqli_query($conn, $sql);
$pengurusan_data = [];
while($row = mysqli_fetch_assoc($result)) {
    $pengurusan_data[] = $row;
}

// Harga tetap passport
$harga_passport = 350000;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $no_antrian = mysqli_real_escape_string($conn, $_POST['no_antrian']);
    $nama_pemohon = mysqli_real_escape_string($conn, $_POST['nama_pemohon']);
    $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
    $jumlah = mysqli_real_escape_string($conn, $_POST['jumlah']);
    $keterangan = mysqli_real_escape_string($conn, $_POST['keterangan']);
    $tgl_pembayaran = date('Y-m-d H:i:s');
    
    // Validasi jumlah
    $jumlah = str_replace(['Rp', '.', ' ', ','], '', $jumlah);
    $jumlah = intval($jumlah);
    
    // Generate nomor pembayaran
    $no_pembayaran = 'PAY' . date('YmdHis');
    
    // Mulai transaksi
    mysqli_begin_transaction($conn);
    
    try {
        // 1. Insert data pembayaran
        $sql1 = "INSERT INTO pembayaran (no_pembayaran, no_antrian, nama_pemohon, metode_pembayaran, jumlah, keterangan, tgl_pembayaran, status) 
                VALUES ('$no_pembayaran', '$no_antrian', '$nama_pemohon', '$metode_pembayaran', '$jumlah', '$keterangan', '$tgl_pembayaran', 'LUNAS')";
        
        if (!mysqli_query($conn, $sql1)) {
            throw new Exception("Gagal menyimpan pembayaran: " . mysqli_error($conn));
        }
        
        // 2. Update status di tabel pengurusan menjadi "Proses"
        $sql2 = "UPDATE pengurusan SET 
                status = 'Proses',
                pembayaran = 'Sudah Bayar',
                keterangan = CONCAT(IFNULL(keterangan, ''), ' | Pembayaran: $metode_pembayaran - $no_pembayaran')
                WHERE no_antrian = '$no_antrian'";
        
        if (!mysqli_query($conn, $sql2)) {
            throw new Exception("Gagal update status pengurusan: " . mysqli_error($conn));
        }
        
        // 3. Update status di tabel pendaftaran jika ada
        $sql3 = "UPDATE pendaftaran SET 
                status_pembayaran = 'LUNAS',
                updated_at = NOW()
                WHERE no_antrian = '$no_antrian'";
        
        mysqli_query($conn, $sql3); // Optional, tidak throw error jika gagal
        
        // Commit transaksi
        mysqli_commit($conn);
        
        // Redirect dengan parameter untuk cetak otomatis
        header("Location: cetak_pembayaran.php?no_antrian=$no_antrian&print=true&success=1");
        exit();
        
    } catch (Exception $e) {
        // Rollback transaksi jika error
        mysqli_rollback($conn);
        $error = $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Pembayaran - Imigrasi Tangerang Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #3498db;
            --success: #27ae60;
        }
        
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .page-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 30px 0;
            margin-bottom: 30px;
        }
        
        .form-container {
            background: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .status-info {
            background: #e8f5e9;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid var(--success);
            display: none;
        }
        
        .status-info.show {
            display: block;
        }
        
        .payment-methods {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }
        
        .payment-method {
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .payment-method.active {
            border-color: var(--success);
            background-color: #e8f5e9;
        }
        
        .btn-submit {
            background: var(--success);
            border: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
            color: white;
            width: 100%;
        }
        
        .btn-submit:hover {
            background: #219653;
            transform: translateY(-2px);
        }
        
        .rupiah-input:before {
            content: 'Rp';
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            font-weight: bold;
            color: var(--primary);
        }
        
        .rupiah-input input {
            padding-left: 50px;
        }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1><i class="fas fa-money-bill-wave me-2"></i>Tambah Pembayaran</h1>
                    <p class="mb-0">Input data pembayaran passport</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <a href="pembayaran.php" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>Kembali
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="form-container">
                        <h3 class="form-title mb-4"><i class="fas fa-credit-card me-2"></i>Form Pembayaran</h3>
                        
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            <strong>Perhatian:</strong> Setelah pembayaran berhasil, status pengurusan akan otomatis berubah menjadi <span class="badge bg-success">Proses</span> dan pembayaran menjadi <span class="badge bg-success">Sudah Bayar</span>
                        </div>
                        
                        <?php if(isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i><?php echo $error; ?>
                        </div>
                        <?php endif; ?>
                        
                        <div class="status-info" id="statusInfo">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-sync-alt fa-spin me-3 text-success"></i>
                                <div>
                                    <h6 class="mb-1">Status akan diperbarui otomatis:</h6>
                                    <p class="mb-0">
                                        <span class="badge bg-secondary">Menunggu</span> 
                                        <i class="fas fa-arrow-right mx-2"></i> 
                                        <span class="badge bg-success">Proses</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <form method="POST" action="" id="paymentForm">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">No. Antrian</label>
                                        <select class="form-select" name="no_antrian" id="no_antrian" required onchange="updateData()">
                                            <option value="">Pilih No. Antrian</option>
                                            <?php foreach($pengurusan_data as $data): ?>
                                            <option value="<?php echo $data['no_antrian']; ?>" 
                                                    data-status="<?php echo $data['status']; ?>"
                                                    data-pembayaran="<?php echo $data['pembayaran'] ?? 'Belum Bayar'; ?>">
                                                <?php echo $data['no_antrian'] . ' - ' . $data['nama_pemohon']; ?>
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <div class="form-text">*Hanya menampilkan data yang belum dibayar</div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Pemohon</label>
                                        <input type="text" class="form-control" id="nama_pemohon" name="nama_pemohon" readonly required>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Info Status Saat Ini -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body py-2">
                                            <small class="text-muted">Status Saat Ini:</small>
                                            <div id="currentStatus" class="fw-bold">-</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-body py-2">
                                            <small class="text-muted">Status Pembayaran:</small>
                                            <div id="currentPayment" class="fw-bold">-</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Metode Pembayaran -->
                            <div class="mb-4">
                                <label class="form-label mb-3">Metode Pembayaran <span class="text-danger">*</span></label>
                                <div class="payment-methods">
                                    <div class="payment-method" onclick="selectPaymentMethod('Tunai')">
                                        <i class="fas fa-money-bill-wave fa-2x mb-2"></i>
                                        <div class="fw-bold">Tunai</div>
                                        <small class="text-muted">Bayar di loket</small>
                                    </div>
                                    <div class="payment-method" onclick="selectPaymentMethod('Transfer Bank')">
                                        <i class="fas fa-university fa-2x mb-2"></i>
                                        <div class="fw-bold">Transfer</div>
                                        <small class="text-muted">BCA, BRI, BNI</small>
                                    </div>
                                    <div class="payment-method" onclick="selectPaymentMethod('QRIS')">
                                        <i class="fas fa-qrcode fa-2x mb-2"></i>
                                        <div class="fw-bold">QRIS</div>
                                        <small class="text-muted">Scan QR Code</small>
                                    </div>
                                    <div class="payment-method" onclick="selectPaymentMethod('Kartu Debit')">
                                        <i class="fas fa-credit-card fa-2x mb-2"></i>
                                        <div class="fw-bold">Kartu Debit</div>
                                        <small class="text-muted">EDC Machine</small>
                                    </div>
                                </div>
                                <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" required>
                                <div class="form-text" id="methodHelp">Pilih metode pembayaran</div>
                            </div>
                            
                            <!-- Jumlah Pembayaran -->
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pembayaran <span class="text-danger">*</span></label>
                                <div class="rupiah-input">
                                    <input type="text" class="form-control form-control-lg" 
                                           name="jumlah" id="jumlah" 
                                           value="Rp <?php echo number_format($harga_passport, 0, ',', '.'); ?>" 
                                           required onkeyup="formatRupiah(this)">
                                </div>
                                <div class="form-text mt-2">
                                    <button type="button" class="btn btn-sm btn-success me-2" onclick="setFullAmount()">
                                        <i class="fas fa-check me-1"></i> Rp <?php echo number_format($harga_passport, 0, ',', '.'); ?>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="document.getElementById('jumlah').value = ''">
                                        <i class="fas fa-times me-1"></i> Kosongkan
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Keterangan -->
                            <div class="mb-4">
                                <label class="form-label">Keterangan (Opsional)</label>
                                <textarea class="form-control" name="keterangan" rows="2" 
                                          placeholder="Contoh: Pembayaran via transfer BCA, No. Referensi: XXX"></textarea>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn-submit btn-lg">
                                    <i class="fas fa-save me-2"></i>Simpan Pembayaran & Update Status
                                </button>
                            </div>
                            
                            <div class="mt-3 text-center">
                                <small class="text-muted">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Setelah klik tombol di atas, status akan otomatis berubah dan bukti pembayaran akan dicetak
                                </small>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Harga passport
        const hargaPassport = <?php echo $harga_passport; ?>;
        
        function updateData() {
            const select = document.getElementById('no_antrian');
            const selectedOption = select.options[select.selectedIndex];
            const text = selectedOption.text;
            const parts = text.split(' - ');
            
            if (parts.length >= 2 && selectedOption.value !== '') {
                // Update nama pemohon
                document.getElementById('nama_pemohon').value = parts[1].trim();
                
                // Update status info
                const currentStatus = selectedOption.getAttribute('data-status') || 'Menunggu';
                const currentPayment = selectedOption.getAttribute('data-pembayaran') || 'Belum Bayar';
                
                document.getElementById('currentStatus').innerHTML = 
                    `<span class="badge bg-${currentStatus === 'Menunggu' ? 'warning' : 'info'}">${currentStatus}</span>`;
                
                document.getElementById('currentPayment').innerHTML = 
                    `<span class="badge bg-${currentPayment === 'Belum Bayar' ? 'danger' : 'success'}">${currentPayment}</span>`;
                
                // Show status info
                document.getElementById('statusInfo').classList.add('show');
            } else {
                document.getElementById('nama_pemohon').value = '';
                document.getElementById('statusInfo').classList.remove('show');
            }
        }
        
        function selectPaymentMethod(method) {
            // Remove active class from all methods
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active class to selected method
            event.currentTarget.classList.add('active');
            
            // Set hidden input value
            document.getElementById('metode_pembayaran').value = method;
            
            // Update help text
            const helpTexts = {
                'Tunai': 'Pembayaran tunai langsung di loket',
                'Transfer Bank': 'Transfer via bank (BCA, BRI, BNI, Mandiri)',
                'QRIS': 'Scan QR Code menggunakan aplikasi e-wallet',
                'Kartu Debit': 'Menggunakan kartu debit melalui EDC'
            };
            document.getElementById('methodHelp').innerHTML = 
                `<i class="fas fa-info-circle me-1"></i> ${helpTexts[method]}`;
        }
        
        function formatRupiah(input) {
            let value = input.value.replace(/[^\d]/g, '');
            
            if (value.length > 0) {
                value = parseInt(value).toLocaleString('id-ID');
                input.value = 'Rp ' + value;
            } else {
                input.value = '';
            }
        }
        
        function setFullAmount() {
            const amountInput = document.getElementById('jumlah');
            amountInput.value = 'Rp ' + hargaPassport.toLocaleString('id-ID');
        }
        
        // Form submission
        document.getElementById('paymentForm').addEventListener('submit', function(e) {
            const metode = document.getElementById('metode_pembayaran').value;
            const jumlah = document.getElementById('jumlah').value;
            
            if (!metode) {
                e.preventDefault();
                alert('Silakan pilih metode pembayaran!');
                return;
            }
            
            if (!jumlah || jumlah === 'Rp 0') {
                e.preventDefault();
                alert('Silakan isi jumlah pembayaran!');
                return;
            }
            
            // Show loading
            const submitBtn = this.querySelector('button[type="submit"]');
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            submitBtn.disabled = true;
        });
        
        // Initialize
        document.addEventListener('DOMContentLoaded', function() {
            // Set default payment method
            selectPaymentMethod.call(
                document.querySelector('.payment-method'),
                'Tunai'
            );
            
            // Set default amount
            setFullAmount();
            
            // Trigger update on page load if there's a selected value
            const select = document.getElementById('no_antrian');
            if (select.value) {
                updateData();
            }
        });
    </script>
</body>
</html>