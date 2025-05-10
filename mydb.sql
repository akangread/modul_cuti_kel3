-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2025 at 11:17 AM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) DEFAULT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `manager` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id`, `kode`, `nama`, `manager`) VALUES
(9, '1DIVM', 'Management', 'Andi Prasetyo'),
(10, '2DIVK', 'Keuangan', 'Dewi Lestari'),
(11, '3DIVA', 'Akuntansi', 'Budi Santoso'),
(12, '4DIVR', 'Riset dan Teknologi', 'Ratna Sari'),
(13, '5DIVH', 'Human Capital', 'Rizky Ramadhan'),
(14, '6DIVP', 'Pengembangan Produk', 'Lia Kartika'),
(15, '7DIVC', 'Pemasaran', 'Fahmi Alamsyah');

-- --------------------------------------------------------

--
-- Table structure for table `jatah_cuti`
--

CREATE TABLE `jatah_cuti` (
  `id` int(11) NOT NULL,
  `tahun` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `pegawai_nip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `jatah_cuti`
--

INSERT INTO `jatah_cuti` (`id`, `tahun`, `jumlah`, `pegawai_nip`) VALUES
(4, 2023, 5, '07832653'),
(5, 2025, 18, '15728454'),
(6, 2025, 7, '56473829'),
(7, 2025, 9, '78645931'),
(8, 2025, 5, '93847261');

-- --------------------------------------------------------

--
-- Table structure for table `pegawai`
--

CREATE TABLE `pegawai` (
  `nip` varchar(20) NOT NULL,
  `gender` varchar(1) DEFAULT NULL,
  `tmp_lahir` varchar(45) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `telpon` varchar(20) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `divisi_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pegawai`
--

INSERT INTO `pegawai` (`nip`, `gender`, `tmp_lahir`, `tgl_lahir`, `telpon`, `alamat`, `divisi_id`) VALUES
('07832653', 'L', 'Jakarta', '1970-02-10', '019293465', 'Jl Kenangan No 20', 10),
('15728454', 'P', 'Bekasi', '1995-09-08', '089736451324', 'Jl Anggrek No.17', 12),
('56473829', 'P', 'Bandung', '1990-04-15', '081234567890', 'Jl Teratai No 5', 13),
('78645931', 'L', 'Garut', '1997-05-05', '08945321769', 'Jl H Rijin No 60', 11),
('93847261', 'L', 'Surabaya', '1998-12-22', '082345678912	', 'Jl Merdeka No 30', 14);

-- --------------------------------------------------------

--
-- Table structure for table `pengajuan_id`
--

CREATE TABLE `pengajuan_id` (
  `id` int(11) NOT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `ket` varchar(45) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `pegawai_nip` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `pengajuan_id`
--

INSERT INTO `pengajuan_id` (`id`, `tanggal_awal`, `tanggal_akhir`, `jumlah`, `ket`, `status`, `pegawai_nip`) VALUES
(5, '2024-10-10', '2024-10-15', 3, 'sakit', 'diproses', '07832653'),
(6, '2024-01-11', '2024-01-15', 4, 'urusan keluarga', 'disetujui', '15728454'),
(7, '2024-12-20', '2024-12-25', 10, 'liburan', 'ditolak', '56473829'),
(8, '2025-05-01', '2025-05-01', 1, 'keperluan pribadi', 'ditolak', '78645931'),
(9, '2025-02-14', '2025-02-16', 2, 'acara pernikahan', 'disetujui', '93847261');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user`, `password`) VALUES
('xavier', '$2y$10$ZF5gtvXxF4RLBA7I/vbBZujj3A.ZtY7IcDV5OwA/63DMGmFwr1vE6'),
('xavier', '$2y$10$ZF5gtvXxF4RLBA7I/vbBZujj3A.ZtY7IcDV5OwA/63DMGmFwr1vE6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_jatah_cuti_pegawai1` (`pegawai_nip`);

--
-- Indexes for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`nip`),
  ADD KEY `fk_pegawai_divisi` (`divisi_id`);

--
-- Indexes for table `pengajuan_id`
--
ALTER TABLE `pengajuan_id`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_pengajuan_id_pegawai1` (`pegawai_nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `pengajuan_id`
--
ALTER TABLE `pengajuan_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `jatah_cuti`
--
ALTER TABLE `jatah_cuti`
  ADD CONSTRAINT `fk_jatah_cuti_pegawai1` FOREIGN KEY (`pegawai_nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pegawai`
--
ALTER TABLE `pegawai`
  ADD CONSTRAINT `fk_pegawai_divisi` FOREIGN KEY (`divisi_id`) REFERENCES `divisi` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pengajuan_id`
--
ALTER TABLE `pengajuan_id`
  ADD CONSTRAINT `fk_pengajuan_id_pegawai1` FOREIGN KEY (`pegawai_nip`) REFERENCES `pegawai` (`nip`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
