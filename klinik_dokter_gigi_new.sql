-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2022 at 05:47 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `klinik_dokter_gigi`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `idbarang` int(11) NOT NULL,
  `nama_barang` varchar(45) DEFAULT NULL,
  `harga_barang` int(11) DEFAULT NULL,
  `stok_barang` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`idbarang`, `nama_barang`, `harga_barang`, `stok_barang`) VALUES
(1, 'karet', 300000, 20),
(2, 'bracket', 500000, 30),
(3, 'bleaching', 10000, 20),
(5, 'scaling', 250000, 50),
(6, 'metal braces', 5000000, 3),
(7, 'dental carving wax', 15000, 500),
(8, 'amplas gigi', 5000, 300),
(9, 'clear retainer', 400000, 20);

-- --------------------------------------------------------

--
-- Table structure for table `dokter`
--

CREATE TABLE `dokter` (
  `iddokter` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dokter`
--

INSERT INTO `dokter` (`iddokter`, `user_iduser`) VALUES
(5, 25),
(6, 26),
(7, 27),
(8, 28);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_praktik`
--

CREATE TABLE `jadwal_praktik` (
  `idjadwal_praktik` int(11) NOT NULL,
  `hari` varchar(45) DEFAULT NULL,
  `jam` varchar(45) DEFAULT NULL,
  `dokter_iddokter` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwal_praktik`
--

INSERT INTO `jadwal_praktik` (`idjadwal_praktik`, `hari`, `jam`, `dokter_iddokter`) VALUES
(9, 'senin', '11:00', 7),
(10, 'senin', '13:00', 7),
(11, 'senin', '14:00', 7),
(12, 'selasa', '11:00', 7),
(13, 'selasa', '13:00', 7),
(14, 'selasa', '14:00', 7),
(15, 'rabu', '11:00', 7),
(16, 'rabu', '13:00', 7),
(17, 'rabu', '14:00', 7),
(18, 'kamis', '11:00', 7),
(19, 'kamis', '13:00', 7),
(20, 'kamis', '14:00', 7),
(21, 'jumat', '13:00', 7),
(22, 'jumat', '14:00', 7),
(23, 'rabu', '08:30', 6),
(24, 'rabu', '10:30', 6),
(25, 'rabu', '12:30', 6),
(26, 'senin', '14:30', 6),
(27, 'senin', '16:30', 6),
(28, 'senin', '17:30', 6),
(29, 'sabtu', '08:30', 6),
(30, 'sabtu', '10:30', 6),
(31, 'sabtu', '12:30', 6),
(32, 'selasa', '14:30', 6),
(33, 'selasa', '16:30', 6),
(34, 'selasa', '17:30', 6),
(35, 'minggu', '08:30', 6),
(36, 'minggu', '10:30', 6),
(37, 'minggu', '12:30', 6),
(38, 'minggu', '14:30', 6),
(39, 'minggu', '16:30', 6),
(40, 'minggu', '17:30', 6),
(41, 'minggu', '08:30', 5),
(42, 'minggu', '10:30', 5),
(43, 'minggu', '12:30', 5),
(44, 'rabu', '14:30', 5),
(45, 'rabu', '16:30', 5),
(46, 'rabu', '18:30', 5),
(47, 'kamis', '14:30', 5),
(48, 'kamis', '16:30', 5),
(49, 'kamis', '18:30', 5),
(50, 'jumat', '14:30', 5),
(51, 'jumat', '16:30', 5),
(52, 'jumat', '18:30', 5),
(53, 'sabtu', '14:30', 5),
(54, 'sabtu', '16:30', 5),
(55, 'sabtu', '18:30', 5),
(56, 'minggu', '14:30', 5),
(57, 'minggu', '16:30', 5),
(58, 'minggu', '18:30', 5),
(59, 'jumat', '08:30', 8),
(60, 'jumat', '10:30', 8),
(61, 'jumat', '12:30', 8),
(62, 'sabtu', '08:30', 8),
(63, 'sabtu', '10:30', 8),
(64, 'sabtu', '12:30', 8),
(65, 'senin', '14:30', 8),
(66, 'senin', '16:30', 8),
(67, 'selasa', '14:30', 8),
(68, 'selasa', '16:30', 8),
(69, 'kamis', '14:30', 8),
(70, 'kamis', '16:30', 8),
(71, 'sabtu', '14:30', 8),
(72, 'sabtu', '16:30', 8);

-- --------------------------------------------------------

--
-- Table structure for table `pasien`
--

CREATE TABLE `pasien` (
  `idpasien` int(11) NOT NULL,
  `user_iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pasien`
--

INSERT INTO `pasien` (`idpasien`, `user_iduser`) VALUES
(13, 29),
(14, 30),
(15, 31),
(17, 32),
(18, 33),
(19, 34),
(20, 35),
(21, 36),
(22, 37),
(23, 38),
(24, 39),
(25, 40),
(26, 41),
(27, 42),
(16, 43);

-- --------------------------------------------------------

--
-- Table structure for table `praktik_dijadwalkan`
--

CREATE TABLE `praktik_dijadwalkan` (
  `idpraktik_dijadwalkan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `keterangan` varchar(45) DEFAULT NULL,
  `jadwal_praktik_idjadwal_praktik` int(11) NOT NULL,
  `pasien_idpasien` int(11) NOT NULL,
  `status` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktik_dijadwalkan`
--

INSERT INTO `praktik_dijadwalkan` (`idpraktik_dijadwalkan`, `tanggal`, `keterangan`, `jadwal_praktik_idjadwal_praktik`, `pasien_idpasien`, `status`) VALUES
(11, '2022-07-27', 'check up 1', 44, 13, '1'),
(12, '2022-08-03', 'check up 2', 45, 13, '1'),
(13, '2022-08-10', 'check up 3', 44, 13, '0'),
(14, '2022-07-27', 'check up 1', 44, 14, '1'),
(15, '2022-08-03', 'check up 2', 45, 14, '1'),
(16, '2022-08-10', 'check up 3', 44, 14, '0'),
(17, '2022-07-27', 'check up 1', 44, 15, '1'),
(18, '2022-08-03', 'check up 2', 45, 15, '1'),
(19, '2022-08-10', 'check up 3', 44, 15, '0'),
(20, '2022-07-27', 'check up 1', 44, 16, '1'),
(21, '2022-08-03', 'check up 2', 45, 16, '1'),
(22, '2022-08-10', 'check up 3', 44, 16, '0'),
(23, '2022-07-18', 'check up 1', 26, 17, '1'),
(24, '2022-07-25', 'check up 2', 27, 17, '1'),
(25, '2022-08-01', 'check up 3', 28, 17, '1'),
(26, '2022-07-18', 'check up 1', 26, 18, '1'),
(27, '2022-07-25', 'check up 2', 27, 18, '1'),
(28, '2022-08-01', 'check up 3', 28, 19, '1'),
(29, '2022-07-18', 'check up 1', 26, 19, '1'),
(30, '2022-07-25', 'check up 2', 27, 19, '1'),
(31, '2022-08-01', 'check up 3', 28, 19, '0'),
(32, '2022-07-18', 'check up 1', 26, 20, '1'),
(33, '2022-07-25', 'check up 2', 27, 20, '1'),
(34, '2022-08-01', 'check up 3', 28, 20, '1'),
(35, '2022-07-06', 'check up 1', 15, 21, '1'),
(36, '2022-07-13', 'check up 2', 16, 21, '1'),
(37, '2022-07-27', 'check up 3', 17, 21, '0'),
(38, '2022-07-06', 'check up 1', 15, 22, '1'),
(39, '2022-07-13', 'check up 2', 16, 22, '1'),
(40, '2022-07-27', 'check up 3', 17, 22, '1'),
(41, '2022-07-06', 'check up 1', 15, 23, '1'),
(42, '2022-07-13', 'check up 2', 16, 23, '1'),
(43, '2022-07-27', 'check up 3', 17, 23, '1'),
(44, '2022-07-06', 'check up 1', 15, 24, '1'),
(45, '2022-07-13', 'check up 2', 16, 24, '1'),
(46, '2022-07-27', 'check up 3', 17, 24, '0'),
(47, '2022-07-07', 'check up 1', 69, 25, NULL),
(48, '2022-07-21', 'check up 2', 70, 25, NULL),
(49, '2022-07-28', 'check up 3', 70, 25, '1'),
(50, '2022-07-07', 'check up 1', 69, 26, NULL),
(51, '2022-07-21', 'check up 2', 70, 26, NULL),
(52, '2022-07-28', 'check up 3', 70, 26, '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `praktik_dijadwalkan_idpraktik_dijadwalkan` int(11) DEFAULT NULL,
  `metode_pembayaran` enum('cash','transfer') DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `praktik_dijadwalkan_idpraktik_dijadwalkan`, `metode_pembayaran`, `total_harga`, `created_at`) VALUES
(10, 11, 'cash', 200000, '2022-08-03 00:50:37'),
(11, 12, 'cash', 200000, '2022-08-03 00:50:37'),
(12, 13, 'cash', 200000, '2022-08-03 00:50:37'),
(13, 21, 'cash', 350000, '2022-08-07 22:40:15');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_detail`
--

CREATE TABLE `transaksi_detail` (
  `idtransaksi_detail` int(11) NOT NULL,
  `transaksi_idtransaksi` int(11) NOT NULL,
  `barang_idbarang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_detail`
--

INSERT INTO `transaksi_detail` (`idtransaksi_detail`, `transaksi_idtransaksi`, `barang_idbarang`, `jumlah`) VALUES
(27, 10, 7, 1),
(28, 10, 8, 1),
(29, 13, 5, 3);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `iduser` int(11) NOT NULL,
  `nama_user` varchar(60) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `noHp` varchar(20) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `level` enum('pemilik','admin','dokter','pasien') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`iduser`, `nama_user`, `alamat`, `noHp`, `email`, `username`, `password`, `level`) VALUES
(23, 'Dyah', 'Malang', '082345678', 'dyah03@gmail.com', 'admin', 'admin', 'admin'),
(24, 'Phandu Putra Haryu', 'Malang', '082156762', 'panduputra@gmail.com', 'owner', 'owner', 'pemilik'),
(25, 'Yolanda', 'Malang', '081234569', 'yola812@gmail.com', 'yolanda', 'yolanda', 'dokter'),
(26, 'Anta', 'Malang', '08135394174', 'antata55@gmail.com', 'anta', 'anta', 'dokter'),
(27, 'Phandu', 'Malang', '08123456782', 'phandumlg415@gmaill.com', 'phandu', 'phandu', 'dokter'),
(28, 'Claudia', 'Malang', '08114141259', 'claudentist15@gmail.com', 'claudia', 'claudia', 'dokter'),
(29, 'Meliana Agustina', 'Malang', '0823376543', 'melianaag@gmail.com', 'meliana', 'meliana', 'pasien'),
(30, 'Adi Supriono', 'Malang', '082345676', 'adis24151@gmail.com', 'adi', 'adi', 'pasien'),
(31, 'Christina Natalia', 'Malang', '083456944', 'christinanat21@gmail.com', 'christina', 'christina', 'pasien'),
(32, 'Tiffany Samantha', 'Malang', '0813480558', 'tiffanysam@gmail.com', 'tiffany', 'tiffany', 'pasien'),
(33, 'Sabrina Umi', 'Malang', '08123456789', 'sabrinaumi99@gmail.com', 'sabrina', 'sabrina', 'pasien'),
(34, 'Sophia Athena', 'Malang', '0811325107', 'sophiaathe89@gmail.com', 'sophia', 'sophia', 'pasien'),
(35, 'Jihad Muhammad', 'Malang', '08968654345', 'jihadmuh97@gmail.com', 'jihad', 'jihad', 'pasien'),
(36, 'Widya Indah', 'Malang', '087652358090', 'widyaindah@gmail.com', 'widya', 'widya', 'pasien'),
(37, 'Kristia Agustinus', 'Malang', '082098765', 'fentikris20@gmail.com', 'kristia', 'kristia', 'pasien'),
(38, 'Dhana Fahreza', 'Malang', '089345679', 'dhanareza90@gmail.com', 'dhana', 'dhana', 'pasien'),
(39, 'Nur Wafiana', 'Malang', '089763456789', 'nurwafiana@gmail.com', 'nur', 'nur', 'pasien'),
(40, 'Nandini Diva', 'Malang', '08962345678', 'nandinidiv12@gmail.com', 'nandini', 'nandini', 'pasien'),
(41, 'Adine Natha', 'Malang', '0899765291', 'adinenatha91@gmail.com', 'adine', 'adine', 'pasien'),
(42, 'Fika Damayati', 'Malang', '0898614234', 'fikadamayanti@gmail.com', 'fika', 'fika', 'pasien'),
(43, 'Yulia Farizki', 'Malang', '08123456789', 'yuliaf@gmail.com', 'yulia', 'yulia', 'pasien');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`idbarang`);

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`iddokter`),
  ADD KEY `fk_dokter_user1_idx` (`user_iduser`);

--
-- Indexes for table `jadwal_praktik`
--
ALTER TABLE `jadwal_praktik`
  ADD PRIMARY KEY (`idjadwal_praktik`),
  ADD KEY `fk_jadwal_praktik_dokter1_idx` (`dokter_iddokter`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`idpasien`),
  ADD KEY `fk_pasien_user1_idx` (`user_iduser`);

--
-- Indexes for table `praktik_dijadwalkan`
--
ALTER TABLE `praktik_dijadwalkan`
  ADD PRIMARY KEY (`idpraktik_dijadwalkan`),
  ADD KEY `fk_praktik_dijadwalkan_jadwal_praktik1_idx` (`jadwal_praktik_idjadwal_praktik`),
  ADD KEY `fk_praktik_dijadwalkan_pasien1_idx` (`pasien_idpasien`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `fk_transaksi_praktik_dijadwalkan` (`praktik_dijadwalkan_idpraktik_dijadwalkan`);

--
-- Indexes for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD PRIMARY KEY (`idtransaksi_detail`),
  ADD KEY `fk_transaksi_detail_transaksi1_idx` (`transaksi_idtransaksi`),
  ADD KEY `fk_transaksi_detail_barang1_idx` (`barang_idbarang`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`iduser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `iddokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `jadwal_praktik`
--
ALTER TABLE `jadwal_praktik`
  MODIFY `idjadwal_praktik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `idpasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `praktik_dijadwalkan`
--
ALTER TABLE `praktik_dijadwalkan`
  MODIFY `idpraktik_dijadwalkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `idtransaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dokter`
--
ALTER TABLE `dokter`
  ADD CONSTRAINT `fk_dokter_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `jadwal_praktik`
--
ALTER TABLE `jadwal_praktik`
  ADD CONSTRAINT `fk_jadwal_praktik_dokter1` FOREIGN KEY (`dokter_iddokter`) REFERENCES `dokter` (`iddokter`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pasien`
--
ALTER TABLE `pasien`
  ADD CONSTRAINT `fk_pasien_user1` FOREIGN KEY (`user_iduser`) REFERENCES `user` (`iduser`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `praktik_dijadwalkan`
--
ALTER TABLE `praktik_dijadwalkan`
  ADD CONSTRAINT `fk_praktik_dijadwalkan_jadwal_praktik1` FOREIGN KEY (`jadwal_praktik_idjadwal_praktik`) REFERENCES `jadwal_praktik` (`idjadwal_praktik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_praktik_dijadwalkan_pasien1` FOREIGN KEY (`pasien_idpasien`) REFERENCES `pasien` (`idpasien`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_praktik_dijadwalkan` FOREIGN KEY (`praktik_dijadwalkan_idpraktik_dijadwalkan`) REFERENCES `praktik_dijadwalkan` (`idpraktik_dijadwalkan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `transaksi_detail_ibfk_1` FOREIGN KEY (`barang_idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `transaksi_detail_transaksi_id` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
