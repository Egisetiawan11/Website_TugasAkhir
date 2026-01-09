<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengajuan Passport </title>
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
            background-color: #f8f9fa;
            color: #333;
            line-height: 1.6;
        }

        .main-header {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: white;
            padding: 40px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            color: white;
        }

        .main-header h1 {
            font-weight: 700;
            margin-bottom: 10px;
            font-size: 2.5rem;
        }

        .main-header h3 {
            font-weight: 500;
            margin-bottom: 5px;
            opacity: 0.9;
        }

        .developer-badge {
            background: rgba(255, 255, 255, 0.2);
            padding: 8px 20px;
            border-radius: 20px;
            display: inline-block;
            margin-top: 15px;
            font-size: 0.9rem;
        }

        .main-content {
            padding: 60px 0;
        }

        .section-title {
            text-align: center;
            margin-bottom: 50px;
            color: var(--primary);
        }

        .section-title h2 {
            font-weight: 600;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #6c757d;
            font-size: 1.1rem;
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0,0,0,0.08);
            border: 1px solid #e9ecef;
            height: 100%;
            transition: all 0.3s ease;
            margin-bottom: 30px;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--info), #138496);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 2rem;
            color: white;
        }

        .feature-card h4 {
            color: var(--primary);
            font-weight: 600;
            margin-bottom: 15px;
        }

        .feature-card p {
            color: #6c757d;
            margin-bottom: 20px;
        }

        .btn-feature {
            background: var(--info);
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .btn-feature:hover {
            background: #138496;
            color: white;
            text-decoration: none;
            transform: translateY(-2px);
        }

        .stats-section {
            background: white;
            padding: 40px 0;
            border-top: 1px solid #e9ecef;
            border-bottom: 1px solid #e9ecef;
        }

        .stat-item {
            text-align: center;
            padding: 20px;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--secondary);
            margin-bottom: 5px;
        }

        .stat-label {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .main-footer {
            background: var(--primary);
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        .footer-content {
            opacity: 0.8;
        }

        .feature-card:nth-child(1) .feature-icon {
            background: linear-gradient(135deg, var(--secondary), #2980b9);
        }

        .feature-card:nth-child(2) .feature-icon {
            background: linear-gradient(135deg, var(--warning), #e67e22);
        }

        .feature-card:nth-child(3) .feature-icon {
            background: linear-gradient(135deg, var(--info), #138496);
        }

        @media (max-width: 768px) {
            .main-header {
                padding: 30px 0;
            }

            .main-header h1 {
                font-size: 2rem;
            }

            .main-content {
                padding: 40px 0;
            }

            .feature-card {
                padding: 25px 20px;
            }

            .feature-icon {
                width: 70px;
                height: 70px;
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <header class="main-header">
        <div class="container">
            <div class="logo-section">
                <div class="logo-icon">
                    <i class="fas fa-passport"></i>
                </div>
                <h1>Pengajuan Pembuatan Passport</h1>
                <!-- <h3>Kantor Imigrasi</h3>
                <h4>Tangerang Selatan</h4> -->
                <div class="developer-badge">
                    <i class="fas fa-code me-2"></i>Developer: Trenggono
                </div>
            </div>
        </div>
    </header>

    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">
                            <?php
                            $sql = "SELECT COUNT(*) as total FROM pendaftaran";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_assoc($result);
                            echo $row['total'];
                            ?>
                        </div>
                        <div class="stat-label">Total Pendaftar</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">24/7</div>
                        <div class="stat-label">Layanan Online</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number">100%</div>
                        <div class="stat-label">Data Aman</div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-item">
                        <div class="stat-number"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-label">Terpercaya</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <main class="main-content">
        <div class="container">
            <div class="section-title">
                <h2>Layanan Pengajuan Passport</h2>
                <p>Pilih layanan yang Anda butuhkan untuk pengajuan Passport</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-list"></i>
                        </div>
                        <h4>Pendaftaran</h4>
                        <p>Form pendaftaran pengajuan Passport baru. Isi data diri dengan lengkap dan benar untuk proses yang cepat.</p>
                        <a href="daftar.php" class="btn-feature">
                            <i class="fas fa-arrow-right me-2"></i>Mulai Pendaftaran
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h4>Pengurusan</h4>
                        <p>Kelola dan pantau proses pengajuan Passport Anda. Lihat status dan progress pengurusan dokumen.</p>
                        <a href="pengurusan.php" class="btn-feature">
                            <i class="fas fa-arrow-right me-2"></i>Lihat Pengurusan
                        </a>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-redo-alt"></i>
                        </div>
                        <h4>Daftar Ulang</h4>
                        <p>Perpanjang atau daftar ulang Passport Anda. Proses cepat untuk perpanjangan masa berlaku Passport.</p>
                        <a href="daftar_ulang.php" class="btn-feature">
                            <i class="fas fa-arrow-right me-2"></i>Daftar Ulang
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="feature-card">
                        <h4><i class="fas fa-info-circle me-2 text-primary"></i>Informasi Penting</h4>
                        <ul class="list-unstyled text-start">
                            <li><i class="fas fa-check text-success me-2"></i>Proses pendaftaran online 24 jam</li>
                            <li><i class="fas fa-check text-success me-2"></i>Data dijamin keamanannya</li>
                            <li><i class="fas fa-check text-success me-2"></i>Proses cepat dan terverifikasi</li>
                            <li><i class="fas fa-check text-success me-2"></i>Layanan customer support aktif</li>
                            <li><i class="fas fa-check text-success me-2"></i>Biaya passport Rp 355.000,-</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="feature-card">
                        <h4><i class="fas fa-clock me-2 text-primary"></i>Waktu Layanan</h4>
                        <p><strong>Senin - Jumat:</strong> 08:00 - 16:00 WIB</p>
                        <p><strong>Sabtu:</strong> 08:00 - 14:00 WIB</p>
                        <p><strong>Minggu & Hari Libur:</strong> Tutup</p>
                        <small class="text-muted">*Layanan online tersedia 24 jam</small>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer class="main-footer">
        <div class="container">
            <div class="footer-content">
                <p>&copy; 2025 Sistem Pengajuan Passport - Melayani dengan Cepat dan Akurat.</p>
                <!-- <p>Sistem Pengajuan Passport - Melayani dengan Cepat dan Akurat</p> -->
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php mysqli_close($conn); ?>