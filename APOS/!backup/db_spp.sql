-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2023 at 10:30 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_spp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(11) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `bulan` varchar(10) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `nominal_bayar` varchar(25) NOT NULL,
  `total_bayar` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `nama_siswa`, `nama_petugas`, `bulan`, `tanggal_bayar`, `nominal_bayar`, `total_bayar`) VALUES
(1, 'yanas', 'dewa', 'Desember', '2023-02-03', '650000', '650000'),
(2, 'jondar', 'yudi', 'Januari', '2023-02-03', '650000', '650000');

-- --------------------------------------------------------

--
-- Table structure for table `tb_petugas`
--

CREATE TABLE `tb_petugas` (
  `nip` int(11) NOT NULL,
  `nama_petugas` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `no_tlp` varchar(12) NOT NULL,
  `lvl_user` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_petugas`
--

INSERT INTO `tb_petugas` (`nip`, `nama_petugas`, `password`, `alamat`, `no_tlp`, `lvl_user`) VALUES
(1, 'dewa', 'dewas', 'akasia', '081317019124', 'admin'),
(2, 'yudi', 'menhan', 'teja kula', '082239148120', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `tb_siswa`
--

CREATE TABLE `tb_siswa` (
  `nis` int(4) NOT NULL,
  `nama_siswa` varchar(25) NOT NULL,
  `password` varchar(25) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `angkatan` varchar(5) NOT NULL,
  `alamat` varchar(25) NOT NULL,
  `telp` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_siswa`
--

INSERT INTO `tb_siswa` (`nis`, `nama_siswa`, `password`, `kelas`, `angkatan`, `alamat`, `telp`) VALUES
(1, 'yanas', 'yanas', 'XII RPL 3', '2023', 'Akasia', '08919248177'),
(3, 'jondar', 'menhan', 'XII TKJ 4', '2023', 'Batukaru', '08223914812');

-- --------------------------------------------------------

--
-- Table structure for table `tb_spp`
--

CREATE TABLE `tb_spp` (
  `angkatan` varchar(5) NOT NULL,
  `nominal` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_spp`
--

INSERT INTO `tb_spp` (`angkatan`, `nominal`) VALUES
('2022', '600000'),
('2023', '650000'),
('2024', '700000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `fk_petugas` (`nama_petugas`),
  ADD KEY `fk_siswa` (`nama_siswa`);

--
-- Indexes for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  ADD PRIMARY KEY (`nip`),
  ADD UNIQUE KEY `nama_petugas` (`nama_petugas`);

--
-- Indexes for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD PRIMARY KEY (`nis`),
  ADD UNIQUE KEY `nama_siswa` (`nama_siswa`),
  ADD KEY `fk_angkatan` (`angkatan`);

--
-- Indexes for table `tb_spp`
--
ALTER TABLE `tb_spp`
  ADD PRIMARY KEY (`angkatan`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_petugas`
--
ALTER TABLE `tb_petugas`
  MODIFY `nip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  MODIFY `nis` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `fk_petugas` FOREIGN KEY (`nama_petugas`) REFERENCES `tb_petugas` (`nama_petugas`),
  ADD CONSTRAINT `fk_siswa` FOREIGN KEY (`nama_siswa`) REFERENCES `tb_siswa` (`nama_siswa`);

--
-- Constraints for table `tb_siswa`
--
ALTER TABLE `tb_siswa`
  ADD CONSTRAINT `fk_angkatan` FOREIGN KEY (`angkatan`) REFERENCES `tb_spp` (`angkatan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
