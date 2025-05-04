-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 09:55 AM
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
-- Database: `kuliah_dbpuskesmas`
--

-- --------------------------------------------------------

--
-- Table structure for table `kelurahan`
--

CREATE TABLE `kelurahan` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `kec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kelurahan`
--

INSERT INTO `kelurahan` (`id`, `nama`, `kec_id`) VALUES
(1, 'Srengseng Sawah', 1),
(2, 'Cimanggis', 2),
(3, 'Kemayoran', 3),
(4, 'Cinere', 4),
(5, 'Tapos', 5);

-- --------------------------------------------------------

--
-- Table structure for table `paramedik`
--

CREATE TABLE `paramedik` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `gender` char(1) NOT NULL,
  `tmp_lahir` varchar(100) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `kategori` enum('dokter','perawat','apoteker','') NOT NULL,
  `telpon` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  `unit_kerja_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `paramedik`
--

INSERT INTO `paramedik` (`id`, `nama`, `gender`, `tmp_lahir`, `tgl_lahir`, `kategori`, `telpon`, `alamat`, `unit_kerja_id`) VALUES
(1, 'Dr. Bagas Dirgantara', 'L', 'Aceh', '1985-05-20', 'dokter', '081234567890', 'Jl. Sukatani No. 45', 1),
(2, 'Suster Dinda Lestari', 'P', 'Depok', '1990-08-12', 'perawat', '081345678901', 'Jl. H.Rijin No. 10', 2),
(3, 'Rey Khatulistiwa', 'L', 'Tangerang', '1988-03-05', 'apoteker', '081456789012', 'Jl. Belimbing 5 No. 7', 5),
(4, 'Suster Nadia Aziza', 'P', 'Bandung', '1992-11-25', 'perawat', '081567890123', 'Jl. Lautan Api No. 3', 4),
(5, 'Dr. Susi Susanti', 'P', 'Bogor', '1987-02-20', 'dokter', '081678901234', 'Jl. Mawar No. 67', 3);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL,
  `nama` varchar(45) NOT NULL,
  `tmp_lahir` varchar(45) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `gender` char(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `kelurahan_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`id`, `kode`, `nama`, `tmp_lahir`, `tgl_lahir`, `gender`, `email`, `alamat`, `kelurahan_id`) VALUES
(1, 'P001', 'Dimas Hermawan', 'Depok', '1995-04-27', 'L', 'dimas.hermawan@gmail.com', 'Jl. Harimau No. 10', 1),
(2, 'P002', 'Mutia Rahma', 'Jakarta', '1998-09-23', 'P', 'mutia.rahma@yahoo.com', 'Jl. Anggrek No. 8', 2),
(3, 'P003', 'Raffa Aditya', 'Bogor', '2000-01-12', 'L', 'raffa.aditya@gmail.com', 'Jl. Kasih Sayang No. 20', 5);

-- --------------------------------------------------------

--
-- Table structure for table `periksa`
--

CREATE TABLE `periksa` (
  `id` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `berat` double NOT NULL,
  `tinggi` double NOT NULL,
  `tensi` varchar(20) NOT NULL,
  `keterangan` text NOT NULL,
  `pasien_id` int(11) NOT NULL,
  `paramedik_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `periksa`
--

INSERT INTO `periksa` (`id`, `tanggal`, `berat`, `tinggi`, `tensi`, `keterangan`, `pasien_id`, `paramedik_id`) VALUES
(1, '2025-04-26', 86, 170, '120/80', 'Pemeriksaan rutin, pasien dalam kondisi serangan jantung', 1, 1),
(2, '2025-04-15', 59, 167, '180/120', 'Pasien mengeluh sakit kepala ringan dan sakit gigi.', 2, 2),
(3, '2025-03-12', 80, 172, '90/60', 'Pasien sedang dalam kondisi tekanan darah rendah, perlu kontrol lebih rutinan.', 3, 3);

-- --------------------------------------------------------

--
-- Table structure for table `unit_kerja`
--

CREATE TABLE `unit_kerja` (
  `id` int(11) NOT NULL,
  `nama` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_kerja`
--

INSERT INTO `unit_kerja` (`id`, `nama`) VALUES
(1, 'Dokter Umum'),
(2, 'Poli Umum'),
(3, 'Poli Gigi'),
(4, 'Laboratorium'),
(5, 'Farmasi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `kelurahan`
--
ALTER TABLE `kelurahan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paramedik`
--
ALTER TABLE `paramedik`
  ADD PRIMARY KEY (`id`),
  ADD KEY `unit_kerja_id` (`unit_kerja_id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kelurahan_id` (`kelurahan_id`);

--
-- Indexes for table `periksa`
--
ALTER TABLE `periksa`
  ADD PRIMARY KEY (`id`),
  ADD KEY `paramedik_id` (`paramedik_id`),
  ADD KEY `pasien_id` (`pasien_id`);

--
-- Indexes for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `kelurahan`
--
ALTER TABLE `kelurahan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `paramedik`
--
ALTER TABLE `paramedik`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periksa`
--
ALTER TABLE `periksa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_kerja`
--
ALTER TABLE `unit_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `paramedik`
--
ALTER TABLE `paramedik`
  ADD CONSTRAINT `paramedik_ibfk_1` FOREIGN KEY (`unit_kerja_id`) REFERENCES `unit_kerja` (`id`);

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `pasien_ibfk_1` FOREIGN KEY (`kelurahan_id`) REFERENCES `kelurahan` (`id`);

--
-- Constraints for table `periksa`
--
ALTER TABLE `periksa`
  ADD CONSTRAINT `periksa_ibfk_1` FOREIGN KEY (`paramedik_id`) REFERENCES `paramedik` (`id`),
  ADD CONSTRAINT `periksa_ibfk_2` FOREIGN KEY (`pasien_id`) REFERENCES `pasien` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
