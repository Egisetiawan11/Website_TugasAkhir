-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2026 at 01:08 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_paspor`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar`
--

CREATE TABLE `daftar` (
  `no_daftar` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `tgl_daftar` date DEFAULT NULL,
  `hari` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `jam` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daftar`
--

INSERT INTO `daftar` (`no_daftar`, `nama`, `tgl_daftar`, `hari`, `tanggal`, `jam`) VALUES
('001', 'Tulus Setiawan', '2026-01-07', 'Wednesday', '2026-01-07', '21:52:35'),
('002', 'Crice Agustina', '2026-01-08', 'Thursday', '2026-01-08', '17:13:11'),
('003', 'Damar Cahyo', '2026-01-08', 'Thursday', '2026-01-08', '17:13:25'),
('004', 'Trenggono', '2026-01-08', 'Thursday', '2026-01-08', '17:13:47'),
('005', 'Auliya', '2026-01-08', 'Thursday', '2026-01-08', '17:14:10'),
('006', 'Eri', '2026-01-08', 'Thursday', '2026-01-08', '17:14:28'),
('007', 'Kuple Kunyuk', '2026-01-09', 'Friday', '2026-01-09', '17:14:46');

-- --------------------------------------------------------

--
-- Table structure for table `ulang`
--

CREATE TABLE `ulang` (
  `no_daftar` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `hari_harus_datang` varchar(20) DEFAULT NULL,
  `tgl_harus_datang` date DEFAULT NULL,
  `hari_datang` varchar(20) DEFAULT NULL,
  `tgl_datang` date DEFAULT NULL,
  `ktp` varchar(10) DEFAULT NULL,
  `kk` varchar(10) DEFAULT NULL,
  `ijazah` varchar(10) DEFAULT NULL,
  `keperluan` varchar(20) DEFAULT NULL,
  `keterangan` varchar(10) DEFAULT NULL,
  `no_antrian` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ulang`
--

INSERT INTO `ulang` (`no_daftar`, `nama`, `hari_harus_datang`, `tgl_harus_datang`, `hari_datang`, `tgl_datang`, `ktp`, `kk`, `ijazah`, `keperluan`, `keterangan`, `no_antrian`) VALUES
('002', 'Crice Agustina', 'Kamis', '2026-01-08', 'Kamis', '2026-01-08', 'Ada', 'Ada', 'Tidak', 'Wisata', 'Tidak', 1),
('003', 'Damar Cahyo', 'Kamis', '2026-01-08', 'Kamis', '2026-01-08', 'Ada', 'Ada', 'Tidak', 'Wisata', 'Tidak', 0),
('004', 'Trenggono', 'Kamis', '2026-01-08', 'Kamis', '2026-01-08', 'Ada', 'Ada', 'Ada', 'Wisata', 'OK', 2),
('005', 'Auliya', 'Kamis', '2026-01-08', 'Kamis', '2026-01-08', 'Ada', 'Tidak', 'Ada', 'Wisata', 'Tidak', 0),
('006', 'Eri', 'Kamis', '2026-01-08', 'Kamis', '2026-01-08', 'Ada', 'Ada', 'Ada', 'Wisata', 'OK', 3);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
