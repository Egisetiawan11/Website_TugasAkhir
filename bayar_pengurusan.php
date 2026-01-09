<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran Passport</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            line-height: 1.4;
            color: #333;
            background-color: #fff;
            padding: 20px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            border: 2px solid #2c3e50;
            border-radius: 10px;
            padding: 30px;
            background: #fff;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }
        
        .header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 3px solid #2c3e50;
        }
        
        .header h1 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 5px;
            letter-spacing: 1px;
        }
        
        .header h2 {
            color: #e74c3c;
            font-size: 18px;
            margin-bottom: 10px;
        }
        
        .header p {
            color: #7f8c8d;
            font-size: 14px;
            line-height: 1.5;
        }
        
        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-45deg);
            opacity: 0.1;
            font-size: 120px;
            color: #2c3e50;
            font-weight: bold;
            z-index: -1;
        }
        
        .receipt-number {
            text-align: center;
            background: #ecf0f1;
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
            border: 1px dashed #bdc3c7;
        }
        
        .receipt-number h3 {
            color: #2c3e50;
            font-size: 20px;
            font-weight: bold;
            letter-spacing: 3px;
        }
        
        .payment-info {
            margin: 30px 0;
        }
        
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
        }
        
        .info-table td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }
        
        .info-table tr:last-child td {
            border-bottom: 2px solid #2c3e50;
        }
        
        .info-table .label {
            font-weight: bold;
            width: 35%;
            color: #2c3e50;
        }
        
        .info-table .value {
            color: #34495e;
        }
        
        .payment-amount {
            text-align: center;
            background: #f8f9fa;
            padding: 25px;
            border-radius: 8px;
            margin: 30px 0;
            border: 2px solid #2c3e50;
        }
        
        .payment-amount h4 {
            color: #2c3e50;
            font-size: 18px;
            margin-bottom: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .amount {
            font-size: 32px;
            font-weight: bold;
            color: #27ae60;
            margin: 10px 0;
        }
        
        .terbilang {
            font-style: italic;
            color: #7f8c8d;
            font-size: 16px;
            margin-top: 10px;
            padding-top: 10px;
            border-top: 1px dashed #bdc3c7;
        }
        
        .status-badge {
            display: inline-block;
            background: #27ae60;
            color: white;
            padding: 8px 20px;
            border-radius: 20px;
            font-weight: bold;
            margin-top: 15px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .notes {
            background: #fff8e1;
            padding: 20px;
            border-radius: 8px;
            margin: 30px 0;
            border-left: 5px solid #f39c12;
        }
        
        .notes h5 {
            color: #d35400;
            margin-bottom: 10px;
            font-size: 16px;
        }
        
        .notes ul {
            padding-left: 20px;
            margin-bottom: 0;
        }
        
        .notes li {
            margin-bottom: 5px;
            font-size: 14px;
        }
        
        .footer {
            margin-top: 40px;
            padding-top: 20px;
            border-top: 2px solid #2c3e50;
        }
        
        .signature-area {
            display: flex;
            justify-content: space-between;
            margin: 30px 0;
        }
        
        .signature-box {
            text-align: center;
            width: 45%;
        }
        
        .signature-line {
            border-top: 1px solid #333;
            width: 80%;
            margin: 50px auto 10px;
            padding-top: 10px;
        }
        
        .print-info {
            text-align: center;
            font-size: 12px;
            color: #7f8c8d;
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px dashed #bdc3c7;
        }
        
        .stamp-note {
            text-align: center;
            font-style: italic;
            color: #e74c3c;
            font-weight: bold;
            margin-top: 15px;
            font-size: 14px;
        }
        
        .no-print {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background: #ecf0f1;
            border-radius: 5px;
        }
        
        @media print {
            body {
                padding: 0;
            }
            
            .no-print {
                display: none;
            }
            
            .container {
                border: none;
                box-shadow: none;
                padding: 20px;
            }
            
            .btn-print {
                display: none;
            }
        }
        
        .btn-print {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px 20px;
            background: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
        }
        
        .btn-print:hover {
            background: #2980b9;
        }
    </style>
</head>
<body>
    <?php
    // Contoh data - sesuaikan dengan database Anda
    $no_antrian = "PSP2025002";
    $nama_pemohon = "Budi Santoso";
    $tanggal_pembayaran = "09 December 2025, 03:49 WIB";
    $metode_pembayaran = "Tunai";
    $jumlah_pembayaran = 350000;
    $terbilang = "Tiga Ratus Lima Puluh Ribu Rupiah";
    $tanggal_cetak = "09 December 2025, 03:49:57 WIB";
    
    // Fungsi untuk format Rupiah
    function formatRupiah($angka) {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
    ?>
    
    <div class="watermark">BUKTI SAH</div>
    
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1>KANTOR IMIGRASI</h1>
            <h2>TANGERANG SELATAN</h2>
            <p>Jl. Raya Serpong No. 123, Tangerang Selatan</p>
            <p>Telp: (021) 1234567 | Email: imigrasi@tangerangselatan.go.id</p>
        </div>
        
        <!-- Nomor Bukti -->
        <div class="receipt-number">
            <h3>BUKTI PEMBAYARAN PASSPORT</h3>
            <h3><?php echo $no_antrian; ?></h3>
        </div>
        
        <!-- Informasi Pembayaran -->
        <div class="payment-info">
            <table class="info-table">
                <tr>
                    <td class="label">No. Antrian</td>
                    <td class="value">: <?php echo $no_antrian; ?></td>
                </tr>
                <tr>
                    <td class="label">Nama Pemohon</td>
                    <td class="value">: <?php echo $nama_pemohon; ?></td>
                </tr>
                <tr>
                    <td class="label">Tanggal Pembayaran</td>
                    <td class="value">: <?php echo $tanggal_pembayaran; ?></td>
                </tr>
                <tr>
                    <td class="label">Metode Pembayaran</td>
                    <td class="value">: <?php echo $metode_pembayaran; ?></td>
                </tr>
            </table>
        </div>
        
        <!-- Jumlah Pembayaran -->
        <div class="payment-amount">
            <h4>Jumlah Pembayaran</h4>
            <div class="amount"><?php echo formatRupiah($jumlah_pembayaran); ?></div>
            <div class="terbilang">(<?php echo $terbilang; ?>)</div>
            <div class="status-badge">LUNAS</div>
        </div>
        
        <!-- Catatan -->
        <div class="notes">
            <h5>Catatan Penting:</h5>
            <ul>
                <li>Bukti pembayaran ini adalah bukti sah bahwa pembayaran telah dilakukan.</li>
                <li>Harap simpan bukti pembayaran ini untuk keperluan pengambilan passport.</li>
                <li>Tunjukkan bukti ini saat pengambilan passport.</li>
                <li>Untuk informasi lebih lanjut, hubungi customer service kami.</li>
            </ul>
        </div>
        
        <!-- Footer dan Tanda Tangan -->
        <div class="footer">
            <div class="signature-area">
                <div class="signature-box">
                    <p>Tangerang Selatan, <?php echo date('d F Y'); ?></p>
                    <div class="signature-line"></div>
                    <p><strong>Petugas</strong></p>
                </div>
                
                <div class="signature-box">
                    <p>Pemohon</p>
                    <div class="signature-line"></div>
                    <p><strong><?php echo $nama_pemohon; ?></strong></p>
                </div>
            </div>
            
            <div class="stamp-note">
                Dokumen ini sah tanpa tanda tangan dan stempel
            </div>
            
            <div class="print-info">
                Dokumen ini dicetak oleh sistem pada <?php echo $tanggal_cetak; ?>
            </div>
        </div>
    </div>
    
    <!-- Tombol Cetak -->
    <div class="no-print">
        <button class="btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Cetak Bukti Pembayaran
        </button>
        <a href="pengurusan.php" class="btn-print" style="background: #95a5a6;">
            <i class="fas fa-arrow-left"></i> Kembali ke Pengurusan
        </a>
    </div>
    
    <script>
        // Auto print jika diperlukan
        window.onload = function() {
            // Uncomment baris berikut jika ingin auto print
            // window.print();
        };
    </script>
</body>
</html>