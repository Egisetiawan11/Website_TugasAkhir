<?php
// ==============================================
// KONEKSI DATABASE & AMBIL DATA
// ==============================================
include 'config.php';

// Debug: Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek apakah ada parameter no_antrian
if(isset($_GET['no_antrian'])) {
    $no_antrian = mysqli_real_escape_string($conn, $_GET['no_antrian']);
    
    // Query data pembayaran
    $sql = "SELECT * FROM pembayaran WHERE no_antrian = '$no_antrian' ORDER BY tgl_pembayaran DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    
    if($result && mysqli_num_rows($result) > 0) {
        $data = mysqli_fetch_assoc($result);
        
        // Ambil data
        $no_antrian = $data['no_antrian'];
        $nama_pemohon = $data['nama_pemohon'];
        $tanggal_pembayaran = date('d F Y, H:i', strtotime($data['tgl_pembayaran'])) . " WIB";
        $metode_pembayaran = $data['metode_pembayaran'] ?? 'Tunai';
        $jumlah_pembayaran = $data['jumlah'] ?? 350000;
        $status_pembayaran = $data['status'] ?? 'LUNAS';
        $keterangan = $data['keterangan'] ?? '';
        $no_pembayaran = $data['no_pembayaran'] ?? 'PAY' . date('YmdHis');
        
    } else {
        // Jika tidak ada di pembayaran, cari di pengurusan
        $sql2 = "SELECT * FROM pengurusan WHERE no_antrian = '$no_antrian' LIMIT 1";
        $result2 = mysqli_query($conn, $sql2);
        
        if($result2 && mysqli_num_rows($result2) > 0) {
            $data = mysqli_fetch_assoc($result2);
            
            $no_antrian = $data['no_antrian'];
            $nama_pemohon = $data['nama_pemohon'];
            $tanggal_pembayaran = date('d F Y, H:i') . " WIB";
            $metode_pembayaran = 'Tunai';
            $jumlah_pembayaran = $data['jumlah'] > 0 ? $data['jumlah'] : 350000;
            $status_pembayaran = $data['pembayaran'] == 'Sudah Bayar' ? 'LUNAS' : 'BELUM BAYAR';
            $keterangan = $data['keterangan'] ?? '';
            $no_pembayaran = 'PAY' . date('YmdHis');
            
        } else {
            // Data default untuk testing
            $no_antrian = "PSP2025002";
            $nama_pemohon = "Budi Santoso";
            $tanggal_pembayaran = date('d F Y, H:i') . " WIB";
            $metode_pembayaran = "Tunai";
            $jumlah_pembayaran = 350000;
            $status_pembayaran = "LUNAS";
            $keterangan = "Data contoh untuk testing";
            $no_pembayaran = 'PAY' . date('YmdHis');
        }
    }
} else {
    // Data default
    $no_antrian = "PSP2025002";
    $nama_pemohon = "Budi Santoso";
    $tanggal_pembayaran = date('d F Y, H:i') . " WIB";
    $metode_pembayaran = "Tunai";
    $jumlah_pembayaran = 350000;
    $status_pembayaran = "LUNAS";
    $keterangan = "Data contoh";
    $no_pembayaran = 'PAY' . date('YmdHis');
}

// ==============================================
// FUNGSI TERBILANG
// ==============================================
function angkaKeTerbilang($angka) {
    $angka = intval($angka);
    if ($angka == 0) return "Nol";
    
    $satuan = ['', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan'];
    $belasan = ['Sepuluh', 'Sebelas', 'Dua Belas', 'Tiga Belas', 'Empat Belas', 'Lima Belas', 
                'Enam Belas', 'Tujuh Belas', 'Delapan Belas', 'Sembilan Belas'];
    
    $terbilang = '';
    
    if ($angka >= 1000000000) {
        $miliar = floor($angka / 1000000000);
        $terbilang .= angkaKeTerbilang($miliar) . ' Miliar ';
        $angka %= 1000000000;
    }
    
    if ($angka >= 1000000) {
        $juta = floor($angka / 1000000);
        $terbilang .= angkaKeTerbilang($juta) . ' Juta ';
        $angka %= 1000000;
    }
    
    if ($angka >= 1000) {
        $ribu = floor($angka / 1000);
        if ($ribu == 1) {
            $terbilang .= 'Seribu ';
        } else {
            $terbilang .= angkaKeTerbilang($ribu) . ' Ribu ';
        }
        $angka %= 1000;
    }
    
    if ($angka >= 100) {
        $ratus = floor($angka / 100);
        if ($ratus == 1) {
            $terbilang .= 'Seratus ';
        } else {
            $terbilang .= $satuan[$ratus] . ' Ratus ';
        }
        $angka %= 100;
    }
    
    if ($angka >= 20) {
        $puluh = floor($angka / 10);
        $terbilang .= $satuan[$puluh] . ' Puluh ';
        $angka %= 10;
    } elseif ($angka >= 10) {
        $terbilang .= $belasan[$angka - 10] . ' ';
        $angka = 0;
    }
    
    if ($angka > 0) {
        $terbilang .= $satuan[$angka] . ' ';
    }
    
    return trim($terbilang);
}

// Generate terbilang
$terbilang = angkaKeTerbilang($jumlah_pembayaran) . ' Rupiah';

// Format tanggal cetak
$tanggal_cetak = date('d F Y, H:i:s') . " WIB";
$tanggal_hari_ini = date('d F Y');

// Fungsi format Rupiah
function formatRupiah($angka) {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

// Auto print jika ada parameter
$auto_print = isset($_GET['print']) && $_GET['print'] == 'true';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran Passport</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* RESET & GLOBAL */
        @page {
            size: A4;
            margin: 15mm;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.4;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
        
        /* CONTAINER UTAMA */
        .receipt-container {
            width: 100%;
            max-width: 800px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            border: 1px solid #ddd;
            padding: 30px;
            margin-bottom: 20px;
        }
        
        /* HEADER */
        .header {
            text-align: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #2c3e50;
        }
        
        .header h1 {
            font-size: 24px;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 5px;
        }
        
        .header h2 {
            font-size: 20px;
            font-weight: 600;
            color: #3498db;
            margin-bottom: 10px;
        }
        
        .header-info {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 15px;
            margin-top: 8px;
            font-size: 13px;
            color: #7f8c8d;
        }
        
        /* RECEIPT NUMBER */
        .receipt-number {
            text-align: center;
            background: #f8f9fa;
            padding: 15px;
            border-radius: 6px;
            margin: 15px 0;
            border: 1px solid #dee2e6;
        }
        
        .receipt-title {
            font-size: 18px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .receipt-code {
            font-size: 24px;
            font-weight: 800;
            color: #e74c3c;
            letter-spacing: 2px;
        }
        
        /* PAYMENT INFO */
        .payment-info {
            margin: 20px 0;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .info-table tr {
            border-bottom: 1px solid #eee;
        }
        
        .info-table tr:last-child {
            border-bottom: 2px solid #2c3e50;
        }
        
        .info-table td {
            padding: 10px 12px;
            font-size: 14px;
        }
        
        .info-label {
            font-weight: 600;
            color: #2c3e50;
            width: 35%;
            vertical-align: top;
        }
        
        .info-value {
            color: #34495e;
        }
        
        /* PAYMENT AMOUNT - DIPERKECIL */
        .payment-amount {
            background: linear-gradient(to right, #f8f9fa, #e8f4fc);
            padding: 20px;
            text-align: center;
            border-radius: 6px;
            margin: 20px 0;
            border: 1px solid #3498db;
        }
        
        .payment-amount h3 {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 15px;
            text-transform: uppercase;
        }
        
        .amount {
            font-size: 28px;
            font-weight: 800;
            color: #27ae60;
            margin: 10px 0;
            letter-spacing: 1px;
        }
        
        .terbilang {
            font-style: italic;
            color: #7f8c8d;
            font-size: 14px;
            margin: 10px 0;
            padding: 10px 0;
            border-top: 1px dashed #bdc3c7;
            line-height: 1.3;
        }
        
        .status-badge {
            background: linear-gradient(to right, #27ae60, #2ecc71);
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: 700;
            font-size: 14px;
            display: inline-block;
            margin-top: 10px;
            text-transform: uppercase;
        }
        
        /* FOOTER & SIGNATURE */
        .footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 2px solid #2c3e50;
        }
        
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
            text-align: center;
        }
        
        .signature-box {
            width: 45%;
        }
        
        .signature-date {
            margin-bottom: 50px;
            font-size: 13px;
        }
        
        .signature-line {
            width: 180px;
            height: 1px;
            border-top: 1px solid #333;
            margin: 0 auto 10px;
            position: relative;
        }
        
        .signature-name {
            font-weight: 600;
            font-size: 14px;
            margin-top: 8px;
            color: #2c3e50;
        }
        
        .signature-title {
            font-size: 13px;
            color: #7f8c8d;
            margin-top: 3px;
        }
        
        .stamp-note {
            text-align: center;
            font-style: italic;
            color: #e74c3c;
            font-weight: 600;
            margin: 20px 0;
            font-size: 13px;
            padding: 12px;
            background: #fef5f5;
            border-radius: 5px;
            border: 1px dashed #e743c7;
        }
        
        .print-info {
            text-align: center;
            font-size: 11px;
            color: #95a5a6;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px dashed #bdc3c7;
        }
        
        /* PRINT ACTIONS */
        .print-actions {
            margin-top: 20px;
            text-align: center;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 6px;
            width: 100%;
            max-width: 800px;
        }
        
        .btn {
            padding: 10px 25px;
            border: none;
            border-radius: 5px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin: 0 8px;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .btn-print {
            background: #3498db;
            color: white;
        }
        
        .btn-print:hover {
            background: #2980b9;
        }
        
        .btn-back {
            background: #95a5a6;
            color: white;
        }
        
        .btn-back:hover {
            background: #7f8c8d;
        }
        
        /* PRINT STYLES */
        @media print {
            body {
                padding: 0 !important;
                background: white !important;
                margin: 0 !important;
            }
            
            .receipt-container {
                box-shadow: none !important;
                border: none !important;
                margin: 0 !important;
                padding: 10px !important;
                max-width: 100% !important;
            }
            
            .print-actions {
                display: none !important;
            }
            
            /* Perkecil lagi saat print */
            .payment-amount {
                padding: 15px !important;
            }
            
            .amount {
                font-size: 24px !important;
            }
            
            .terbilang {
                font-size: 12px !important;
            }
            
            /* Ensure single page */
            .receipt-container {
                page-break-inside: avoid;
                page-break-after: avoid;
            }
        }
        
        /* RESPONSIVE */
        @media (max-width: 768px) {
            body {
                padding: 10px;
            }
            
            .receipt-container {
                padding: 15px;
            }
            
            .header h1 {
                font-size: 20px;
            }
            
            .header h2 {
                font-size: 18px;
            }
            
            .receipt-code {
                font-size: 20px;
            }
            
            .amount {
                font-size: 22px;
            }
            
            .payment-amount h3 {
                font-size: 14px;
            }
            
            .terbilang {
                font-size: 12px;
            }
            
            .signature-area {
                flex-direction: column;
                gap: 30px;
            }
            
            .signature-box {
                width: 100%;
            }
            
            .header-info {
                flex-direction: column;
                gap: 8px;
                font-size: 12px;
            }
        }
        
        /* EXTRA COMPACT FOR MOBILE */
        @media (max-width: 480px) {
            .payment-amount {
                padding: 15px 10px;
            }
            
            .amount {
                font-size: 20px;
            }
            
            .terbilang {
                font-size: 11px;
                padding: 8px 0;
            }
            
            .status-badge {
                font-size: 12px;
                padding: 6px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="receipt-container">
        <!-- HEADER -->
        <div class="header">
            <h1>KANTOR IMIGRASI</h1>
            <h2>TANGERANG SELATAN</h2>
            <div class="header-info">
                <div><i class="fas fa-map-marker-alt"></i> Jl. Raya Serpong No. 123, Tangerang Selatan</div>
                <div><i class="fas fa-phone"></i> (021) 1234567</div>
                <div><i class="fas fa-envelope"></i> imigrasi@tangerangselatan.go.id</div>
            </div>
        </div>
        
        <!-- RECEIPT NUMBER -->
        <div class="receipt-number">
            <div class="receipt-title">BUKTI PEMBAYARAN PASSPORT</div>
            <div class="receipt-code"><?php echo htmlspecialchars($no_pembayaran); ?></div>
        </div>
        
        <!-- PAYMENT INFO -->
        <div class="payment-info">
            <table class="info-table">
                <tr>
                    <td class="info-label">No. Antrian</td>
                    <td class="info-value">: <?php echo htmlspecialchars($no_antrian); ?></td>
                </tr>
                <tr>
                    <td class="info-label">Nama Pemohon</td>
                    <td class="info-value">: <?php echo htmlspecialchars($nama_pemohon); ?></td>
                </tr>
                <tr>
                    <td class="info-label">Tanggal Pembayaran</td>
                    <td class="info-value">: <?php echo htmlspecialchars($tanggal_pembayaran); ?></td>
                </tr>
                <tr>
                    <td class="info-label">Metode Pembayaran</td>
                    <td class="info-value">: <?php echo htmlspecialchars($metode_pembayaran); ?></td>
                </tr>
                <?php if(!empty($keterangan)): ?>
                <tr>
                    <td class="info-label">Keterangan</td>
                    <td class="info-value">: <?php echo htmlspecialchars($keterangan); ?></td>
                </tr>
                <?php endif; ?>
            </table>
        </div>
        
        <!-- PAYMENT AMOUNT YANG LEBIH KOMPAK -->
        <div class="payment-amount">
            <h3>JUMLAH PEMBAYARAN</h3>
            <div class="amount"><?php echo formatRupiah($jumlah_pembayaran); ?></div>
            <div class="terbilang">(<?php echo $terbilang; ?>)</div>
            <div class="status-badge"><?php echo $status_pembayaran; ?></div>
        </div>
        
        <!-- FOOTER & SIGNATURE -->
        <div class="footer">
            <div class="signature-area">
                <!-- PETUGAS -->
                <div class="signature-box">
                    <div class="signature-date">
                        Tangerang Selatan, <?php echo $tanggal_hari_ini; ?>
                    </div>
                    <div class="signature-line"></div>
                    <div class="signature-name">Petugas</div>
                    <div class="signature-title">Kantor Imigrasi Tangerang Selatan</div>
                </div>
                
                <!-- PEMOHON -->
                <div class="signature-box">
                    <div class="signature-date">
                        &nbsp; <!-- Spacer untuk alignment -->
                    </div>
                    <div class="signature-line"></div>
                    <div class="signature-name"><?php echo htmlspecialchars($nama_pemohon); ?></div>
                    <div class="signature-title">Pemohon</div>
                </div>
            </div>
            
            <!-- STAMP NOTE -->
            <div class="stamp-note">
                <i class="fas fa-stamp"></i> Dokumen ini sah tanpa tanda tangan dan stempel
            </div>
            
            <!-- PRINT INFO -->
            <div class="print-info">
                <i class="fas fa-print"></i> Dicetak oleh sistem pada <?php echo $tanggal_cetak; ?>
            </div>
        </div>
    </div>
    
    <!-- PRINT ACTIONS -->
    <div class="print-actions">
        <button class="btn btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Bukti Pembayaran
        </button>
        <a href="pengurusan.php" class="btn btn-back">
            <i class="fas fa-arrow-left"></i> Kembali ke Pengurusan
        </a>
    </div>
    
    <script>
        // Auto print jika ada parameter
        <?php if($auto_print): ?>
        window.onload = function() {
            setTimeout(function() {
                window.print();
                
                // Redirect setelah print
                setTimeout(function() {
                    window.location.href = "pengurusan.php?success=1&msg=Bukti pembayaran berhasil dicetak";
                }, 1000);
            }, 500);
        };
        <?php endif; ?>
    </script>
</body>
</html>
<?php 
mysqli_close($conn);
?>