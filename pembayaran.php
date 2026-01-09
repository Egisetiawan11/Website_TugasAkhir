<?php
include 'config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "SELECT * FROM pengurusan WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) == 0) {
    header("Location: pengurusan.php?error=data_not_found");
    exit();
}

$row = mysqli_fetch_assoc($result);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $metode_pembayaran = mysqli_real_escape_string($conn, $_POST['metode_pembayaran']);
    $jumlah_pembayaran = mysqli_real_escape_string($conn, $_POST['jumlah_pembayaran']);
    $tgl_pembayaran = date('Y-m-d H:i:s');

    $sql_update = "UPDATE pengurusan SET 
                    metode_pembayaran = '$metode_pembayaran',
                    jumlah_pembayaran = '$jumlah_pembayaran',
                    status_pembayaran = 'Sudah Bayar',
                    tgl_pembayaran = '$tgl_pembayaran'
                  WHERE id = $id";

    if (mysqli_query($conn, $sql_update)) {
        header("Location: pengurusan.php?success=1&msg=Pembayaran berhasil diproses");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Passport - Imigrasi Tangerang Selatan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body { background-color: #f5f5f5; padding: 20px; }
        .payment-container { max-width: 700px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.08); }
        .payment-title { color: #27ae60; font-weight: 600; margin-bottom: 25px; padding-bottom: 15px; border-bottom: 2px solid #f0f0f0; }
        .data-info { background: #e8f5e9; border-radius: 8px; padding: 20px; margin-bottom: 25px; }
        .payment-methods { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-bottom: 25px; }
        .payment-method { border: 2px solid #e0e0e0; border-radius: 8px; padding: 20px; cursor: pointer; transition: all 0.3s; text-align: center; }
        .payment-method:hover { border-color: #27ae60; background: #f1f8f4; }
        .payment-method.active { border-color: #27ae60; background: #e8f5e9; }
        .payment-method i { font-size: 2rem; color: #27ae60; margin-bottom: 10px; }
        .payment-method .method-name { font-weight: 600; color: #333; }
        .btn-pay { background: #27ae60; color: white; padding: 12px 30px; border: none; border-radius: 8px; width: 100%; font-weight: 500; }
        .btn-cancel { background: #95a5a6; color: white; padding: 12px 25px; text-decoration: none; border-radius: 8px; width: 100%; font-weight: 500; display: inline-block; text-align: center; }
        .form-label { font-weight: 600; }
        .amount-display { font-size: 2rem; font-weight: 700; color: #27ae60; text-align: center; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="payment-container">
        <h3 class="payment-title"><i class="fas fa-money-bill-wave me-2"></i>Pembayaran Passport</h3>
        
        <div class="data-info">
            <h6><strong>Informasi Pemohon</strong></h6>
            <p><strong>No. Antrian:</strong> <?php echo $row['no_antrian']; ?></p>
            <p><strong>Nama Pemohon:</strong> <?php echo $row['nama_pemohon']; ?></p>
            <p><strong>Status:</strong> <span class="badge bg-warning"><?php echo $row['status']; ?></span></p>
        </div>
        
        <form method="POST">
            <div class="mb-4">
                <label class="form-label">Jumlah Pembayaran</label>
                <div class="amount-display">Rp <?php echo number_format($row['jumlah_pembayaran'], 0, ',', '.'); ?></div>
                <input type="hidden" name="jumlah_pembayaran" value="<?php echo $row['jumlah_pembayaran']; ?>">
            </div>
            
            <div class="mb-4">
                <label class="form-label">Pilih Metode Pembayaran</label>
                <div class="payment-methods">
                    <div class="payment-method" onclick="selectMethod('Transfer Bank', this)">
                        <i class="fas fa-university"></i>
                        <div class="method-name">Transfer Bank</div>
                    </div>
                    <div class="payment-method" onclick="selectMethod('E-Wallet', this)">
                        <i class="fas fa-wallet"></i>
                        <div class="method-name">E-Wallet</div>
                    </div>
                    <div class="payment-method" onclick="selectMethod('Kartu Kredit', this)">
                        <i class="fas fa-credit-card"></i>
                        <div class="method-name">Kartu Kredit</div>
                    </div>
                    <div class="payment-method" onclick="selectMethod('Tunai', this)">
                        <i class="fas fa-money-bill"></i>
                        <div class="method-name">Tunai</div>
                    </div>
                    <div class="payment-method" onclick="selectMethod('QRIS', this)">
                        <i class="fas fa-qrcode"></i>
                        <div class="method-name">QRIS</div>
                    </div>
                    <div class="payment-method" onclick="selectMethod('Virtual Account', this)">
                        <i class="fas fa-mobile-alt"></i>
                        <div class="method-name">Virtual Account</div>
                    </div>
                </div>
                <input type="hidden" name="metode_pembayaran" id="metode_pembayaran" required>
            </div>
            
            <div class="alert alert-info">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Informasi:</strong> Setelah pembayaran berhasil, Anda dapat mencetak bukti pembayaran dari halaman pengurusan.
            </div>
            
            <div class="d-flex gap-3 mt-4 pt-3 border-top">
                <a href="pengurusan.php" class="btn-cancel">
                    <i class="fas fa-times me-2"></i>Batal
                </a>
                <button type="submit" class="btn-pay" id="btnPay" disabled>
                    <i class="fas fa-check me-2"></i>Bayar Sekarang
                </button>
            </div>
        </form>
    </div>

    <script>
        function selectMethod(method, element) {
            // Remove active from all
            document.querySelectorAll('.payment-method').forEach(el => {
                el.classList.remove('active');
            });
            
            // Add active to selected
            element.classList.add('active');
            
            // Set value
            document.getElementById('metode_pembayaran').value = method;
            
            // Enable button
            document.getElementById('btnPay').disabled = false;
        }
    </script>
</body>
</html>
<?php mysqli_close($conn); ?>