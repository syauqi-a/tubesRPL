-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2021 at 04:29 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_good_habit`
--
USE `db_good_habit`;
--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `nama_lengkap`, `username`, `email`, `password`, `jenis_kelamin`, `telepon`, `foto_profil`) VALUES
(2, 'Sulis', 'sulis1234', 'sulis@coba.com', '482c811da5d5b4bc6d497ffa98491e38', 'P', '123456789', NULL),
(3, 'Budhi', 'budhi1234', 'budy@coba.com', '482c811da5d5b4bc6d497ffa98491e38', 'P', NULL, NULL),
(4, 'Gabut', 'gabut1234', 'gabut@coba.com', '482c811da5d5b4bc6d497ffa98491e38', 'L', NULL, NULL),
(5, 'Ayung', 'ayung1234', 'ayong@coba.com', '482c811da5d5b4bc6d497ffa98491e38', 'L', NULL, NULL);

--
-- Dumping data for table `alamat`
--

INSERT INTO `alamat` (`jalan`, `kota`, `kodePos`, `id_akun`) VALUES
(NULL, NULL, NULL, 1),
('Jl.Melati No.2', 'Cirebon', '45167', 2),
(NULL, NULL, NULL, 3),
(NULL, NULL, NULL, 4),
(NULL, NULL, NULL, 5);

--
-- Dumping data for table `kebiasaan`
--

INSERT INTO `kebiasaan` (`id_kebiasaan`, `nama_kebiasaan`, `status_kebiasaan`, `waktu`, `ulang`, `deskripsi`, `ket`, `id_akun`) VALUES
(1, 'kegiatan1', 'pribadi', '19:57:00', 'tiap minggu', NULL, 'Thursday', 2),
(2, 'kegiatan2', 'pribadi', '12:46:00', 'tiap bulan', NULL, '19', 3),
(3, 'kegiatan3', 'pribadi', '02:01:00', 'tiap hari', NULL, NULL, 4),
(4, 'kegiatan4', 'pribadi', '11:19:00', 'tiap minggu', NULL, 'Saturday', 5),
(5, 'kegiatan5', 'pribadi', '04:06:00', 'tiap minggu', NULL, 'Wednesday', 2),
(6, 'kegiatan6', 'pribadi', '15:08:00', 'tiap minggu', NULL, 'Wednesday', 3),
(7, 'kegiatan7', 'pribadi', '02:02:00', 'tiap hari', NULL, NULL, 4),
(8, 'kegiatan8', 'pribadi', '07:07:00', 'tiap bulan', NULL, '20', 5),
(9, 'kegiatan9', 'pribadi', '18:42:00', 'tiap bulan', NULL, '23', 2),
(10, 'kegiatan10', 'pribadi', '16:13:00', 'tiap bulan', NULL, '23', 3),
(11, 'kegiatan11', 'pribadi', '21:09:00', 'tiap minggu', NULL, 'Tuesday', 4),
(12, 'kegiatan12', 'pribadi', '08:59:00', 'tiap hari', NULL, NULL, 5),
(13, 'kegiatan13', 'pribadi', '11:44:00', 'tiap minggu', NULL, 'Saturday', 2),
(14, 'kegiatan14', 'pribadi', '22:53:00', 'tiap hari', NULL, NULL, 3),
(15, 'kegiatan15', 'pribadi', '09:56:00', 'tiap minggu', NULL, 'Monday', 4),
(16, 'kegiatan16', 'pribadi', '01:16:00', 'tiap bulan', NULL, '1', 5),
(17, 'kegiatan17', 'pribadi', '20:45:00', 'tiap hari', NULL, NULL, 2),
(18, 'kegiatan18', 'pribadi', '17:56:00', 'tiap hari', NULL, NULL, 3),
(19, 'kegiatan19', 'pribadi', '17:13:00', 'tiap minggu', NULL, 'Thursday', 4),
(20, 'kegiatan20', 'pribadi', '06:15:00', 'tiap hari', NULL, NULL, 5),
(21, 'kegiatan21', 'pribadi', '15:14:00', 'tiap hari', NULL, NULL, 2),
(22, 'kegiatan22', 'pribadi', '14:03:00', 'tiap bulan', NULL, '16', 3),
(23, 'kegiatan23', 'pribadi', '02:36:00', 'tiap minggu', NULL, 'Wednesday', 4),
(24, 'kegiatan24', 'pribadi', '11:03:00', 'tiap bulan', NULL, '1', 5),
(25, 'kegiatan25', 'pribadi', '12:12:00', 'tiap bulan', NULL, '29', 2),
(26, 'kegiatan26', 'pribadi', '04:19:00', 'tiap bulan', NULL, '2', 3),
(27, 'kegiatan27', 'pribadi', '11:54:00', 'tiap minggu', NULL, 'Saturday', 4),
(28, 'kegiatan28', 'pribadi', '02:10:00', 'tiap hari', NULL, NULL, 5),
(29, 'kegiatan29', 'pribadi', '17:21:00', 'tiap minggu', NULL, 'Monday', 2),
(30, 'kegiatan30', 'pribadi', '04:12:00', 'tiap bulan', NULL, '29', 3),
(31, 'kegiatan31', 'pribadi', '14:20:00', 'tiap bulan', NULL, '28', 4),
(32, 'kegiatan32', 'pribadi', '04:29:00', 'tiap minggu', NULL, 'Sunday', 5),
(33, 'kegiatan33', 'pribadi', '15:09:00', 'tiap bulan', NULL, '15', 2),
(34, 'kegiatan34', 'pribadi', '09:11:00', 'tiap minggu', NULL, 'Wednesday', 3),
(35, 'kegiatan35', 'pribadi', '15:07:00', 'tiap bulan', NULL, '23', 4),
(36, 'kegiatan36', 'pribadi', '18:33:00', 'tiap minggu', NULL, 'Friday', 5),
(37, 'kegiatan37', 'pribadi', '11:23:00', 'tiap bulan', NULL, '21', 2),
(38, 'kegiatan38', 'pribadi', '20:51:00', 'tiap bulan', NULL, '17', 3),
(39, 'kegiatan39', 'pribadi', '06:59:00', 'tiap bulan', NULL, '6', 4),
(40, 'kegiatan40', 'pribadi', '11:28:00', 'tiap hari', NULL, NULL, 5),
(41, 'kegiatan41', 'pribadi', '11:36:00', 'tiap minggu', NULL, 'Tuesday', 2),
(42, 'kegiatan42', 'pribadi', '03:26:00', 'tiap bulan', NULL, '9', 3),
(43, 'kegiatan43', 'pribadi', '16:59:00', 'tiap minggu', NULL, 'Sunday', 4),
(44, 'kegiatan44', 'pribadi', '14:01:00', 'tiap bulan', NULL, '11', 5),
(45, 'kegiatan45', 'pribadi', '04:14:00', 'tiap minggu', NULL, 'Saturday', 2),
(46, 'kegiatan46', 'pribadi', '11:34:00', 'tiap hari', NULL, NULL, 3),
(47, 'kegiatan47', 'pribadi', '11:51:00', 'tiap bulan', NULL, '16', 4),
(48, 'kegiatan48', 'pribadi', '16:16:00', 'tiap minggu', NULL, 'Wednesday', 5),
(49, 'kegiatan49', 'pribadi', '11:28:00', 'tiap bulan', NULL, '29', 2),
(50, 'kegiatan50', 'pribadi', '02:01:00', 'tiap bulan', NULL, '10', 3),
(51, 'challenge1', 'challenge', '10:10:00', 'tiap hari', 'ini challenge1', NULL, 1),
(52, 'challenge2', 'challenge', '09:10:00', 'tiap hari', 'coba tambah challenge 2', NULL, 1),
(53, 'challenge3', 'challenge', '02:02:00', 'tiap hari', 'ini challenge3', NULL, 1),
(54, 'challenge4', 'challenge', '05:00:00', 'tiap hari', 'ini challenge4', NULL, 1),
(55, 'Rekomendasi1', 'rekomendasi', '20:15:00', 'tiap hari', 'ini rekomendasi1', NULL, 1),
(56, 'Rekomendasi2', 'rekomendasi', '05:15:00', 'tiap hari', 'ini rekomendasi2', NULL, 1),
(57, 'Rekomendasi3', 'rekomendasi', '10:50:00', 'tiap hari', 'ini rekomendasi3', NULL, 1),
(58, 'Rekomendasi4', 'rekomendasi', '13:00:00', 'tiap hari', 'ini rekomendasi4', NULL, 1);

--
-- Dumping data for table `hadiah`
--

INSERT INTO `hadiah` (`id_hadiah`, `kode_hadiah`, `nama_hadiah`, `deskripsi`, `period`, `claim`, `id_akun`) VALUES
(1, '4226581201806580','E-Money 25000', 'Hadiah bulan November 2020', '2020-11-01', 'y', 2),
(2, '2054882924317847','E-Money 25000', 'Hadiah bulan Desember 2020', '2020-12-01', 'y', 5),
(3, '9803782095381532','E-Money 25000', 'Hadiah bulan Januari 2021', '2021-01-01', 'y', 2),
(4, '2145372430220429','E-Money 25000', 'Hadiah bulan Febuari 2021', '2021-02-01', 'y', 5),
(5, '3281937750888122','E-Money 25000', 'Hadiah bulan Maret 2021', '2021-03-01', 'y', 4),
(6, '2013881476726082','E-Money 25000', 'Hadiah bulan April 2021', '2021-04-01', 'y', 1),
(7, '5926047653405007','E-Money 25000', 'Hadiah bulan Mei 2021', '2021-05-01', 'y', 1);

--
-- Dumping data for table `rekap_kebiasaan`
--

INSERT INTO `rekap_kebiasaan` (`id_akun`, `id_kebiasaan`, `tanggal`, `ketepatan`, `bukti`) VALUES
(2, 51, '2021-05-22 00:00:00', 264, NULL),
(2, 52, '2020-11-21 00:00:00', 128, NULL),
(2, 53, '2020-12-23 00:00:00', 10, NULL),
(2, 54, '2020-11-23 00:00:00', 10, NULL),
(2, 53, '2021-01-06 00:00:00', 285, NULL),
(2, 51, '2021-04-04 00:00:00', 467, NULL),
(2, 55, '2021-05-02 00:00:00', 272, NULL),
(2, 51, '2021-02-18 00:00:00', 312, NULL),
(2, 51, '2020-11-18 00:00:00', 390, NULL),
(2, 55, '2021-03-14 00:00:00', 213, NULL),
(2, 52, '2021-01-25 00:00:00', 397, NULL),
(2, 55, '2020-12-15 00:00:00', 458, NULL),
(2, 51, '2020-11-19 00:00:00', 310, NULL),
(2, 52, '2021-02-02 00:00:00', 493, NULL),
(3, 51, '2021-05-22 00:00:00', 516, NULL),
(3, 53, '2021-05-22 00:00:00', 1004, NULL),
(3, 54, '2020-11-17 00:00:00', 678, NULL),
(3, 54, '2021-05-01 00:00:00', 388, NULL),
(3, 53, '2021-05-08 00:00:00', 56, NULL),
(3, 54, '2021-04-29 00:00:00', 345, NULL),
(3, 51, '2021-04-12 00:00:00', 205, NULL),
(3, 54, '2020-11-23 00:00:00', 91, NULL),
(3, 54, '2021-03-29 00:00:00', 344, NULL),
(3, 55, '2021-04-15 00:00:00', 33, NULL),
(3, 52, '2020-12-02 00:00:00', 66, NULL),
(3, 53, '2020-11-23 00:00:00', 274, NULL),
(4, 52, '2020-12-01 00:00:00', 20, NULL),
(4, 53, '2020-11-09 00:00:00', 77, NULL),
(4, 52, '2020-12-07 00:00:00', 209, NULL),
(4, 52, '2021-02-01 00:00:00', 343, NULL),
(4, 55, '2021-01-26 00:00:00', 385, NULL),
(4, 54, '2021-03-27 00:00:00', 487, NULL),
(4, 52, '2021-02-28 00:00:00', 493, NULL),
(4, 54, '2021-03-23 00:00:00', 41, NULL),
(4, 53, '2021-01-03 00:00:00', 312, NULL),
(4, 51, '2020-11-24 00:00:00', 290, NULL),
(4, 52, '2020-11-27 00:00:00', 104, NULL),
(5, 52, '2020-11-13 00:00:00', 313, NULL),
(5, 51, '2020-12-08 00:00:00', 348, NULL),
(5, 52, '2020-12-25 00:00:00', 78, NULL),
(5, 53, '2021-05-03 00:00:00', 36, NULL),
(5, 51, '2021-05-08 00:00:00', 301, NULL),
(5, 53, '2020-12-06 00:00:00', 428, NULL),
(5, 51, '2020-12-18 00:00:00', 225, NULL),
(5, 54, '2020-12-14 00:00:00', 324, NULL),
(5, 55, '2021-01-24 00:00:00', 14, NULL),
(5, 51, '2021-05-13 00:00:00', 4, NULL),
(5, 52, '2021-04-18 00:00:00', 495, NULL),
(5, 52, '2021-02-27 00:00:00', 263, NULL),
(5, 54, '2021-02-20 00:00:00', 425, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
