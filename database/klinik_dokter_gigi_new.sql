-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2022 at 02:23 AM
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
(4, 'Plester', 10000, 20);

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
(1, 2),
(2, 3),
(3, 8),
(4, 9);

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
(1, 'Senin', '10:00', 1),
(2, 'Selasa', '16:00', 2),
(3, 'Selasa', '14:00', 1),
(4, 'Senin', '15:00', 2),
(5, 'Rabu', '11:00', 3),
(6, 'Kamis', '13:00', 4),
(7, 'Kamis', '15:00', 3),
(8, 'Rabu', '10:00', 4),
(10, 'Rabu', '14:30', 4);

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
(1, 4),
(2, 5),
(3, 10),
(12, 22);

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
  `dokter_iddokter` int(11) NOT NULL,
  `status` enum('1','0') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `praktik_dijadwalkan`
--

INSERT INTO `praktik_dijadwalkan` (`idpraktik_dijadwalkan`, `tanggal`, `keterangan`, `jadwal_praktik_idjadwal_praktik`, `pasien_idpasien`, `dokter_iddokter`, `status`) VALUES
(1, '2022-07-04', 'check up 1', 1, 1, 1, '1'),
(2, '2022-07-05', 'check up 1', 2, 2, 2, '1'),
(3, '2022-07-06', 'check up 1c', 5, 3, 3, '1'),
(4, '2022-07-06', 'check up 1', 8, 1, 4, '0'),
(5, '2022-07-12', 'check up 1', 1, 12, 2, '1'),
(8, '2022-07-25', 'check up 2', 1, 12, 1, '0'),
(9, '2022-07-25', 'check up 1', 2, 12, 2, '0'),
(10, '2022-07-26', 'check up 2', 2, 12, 2, '0'),
(11, '2022-07-21', 'checkup', 2, 12, 2, '0');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi`
--

CREATE TABLE `transaksi` (
  `idtransaksi` int(11) NOT NULL,
  `praktik_dijadwalkan_idpraktik_dijadwalkan` int(11) DEFAULT NULL,
  `pasien_idpasien` int(11) NOT NULL,
  `metode_pembayaran` enum('cash','transfer') DEFAULT NULL,
  `total_harga` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi`
--

INSERT INTO `transaksi` (`idtransaksi`, `praktik_dijadwalkan_idpraktik_dijadwalkan`, `pasien_idpasien`, `metode_pembayaran`, `total_harga`, `created_at`) VALUES
(1, 1, 12, 'cash', 0, '2022-07-23 18:40:16'),
(2, 2, 1, 'transfer', 0, '2022-07-23 18:40:16'),
(3, 3, 12, 'cash', 0, '2022-07-23 18:40:16'),
(4, 4, 2, 'transfer', 0, '2022-07-22 18:40:16'),
(5, 5, 2, 'cash', 0, '2022-07-22 18:40:16'),
(6, 8, 3, 'cash', 0, '2022-07-22 18:40:16'),
(7, 9, 1, 'transfer', 0, '2022-07-25 19:35:59');

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
(18, 1, 2, 1),
(19, 1, 1, 1),
(20, 2, 1, 1),
(21, 2, 2, 1),
(22, 3, 1, 1),
(23, 4, 2, 1),
(24, 5, 1, 1),
(25, 6, 2, 1),
(26, 7, 2, 3);

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
(1, 'Viviana Caldecott', '80148 Bonner Park', '(808) 1391879', 'vcaldecott0@mac.com', 'vcaldecott', 'vcaldecott', 'pemilik'),
(2, 'Merci Skett', '78 Dayton Jacob', '(718) 2333249', 'mskett1@arizona.edu', 'mskett', 'mskett', 'dokter'),
(3, 'Revkah Snape', '4 Bluestem Point', '(838) 3496323', 'rsnape2@webs.com', 'rsnape', 'rsnape', 'dokter'),
(4, 'Dionisio Gorrick', '05908 Pierstorff Circle', '(230) 7987715', 'dgorrick3@wiley.com', 'dgorrick', 'dgorrick', 'pasien'),
(5, 'Levon Rubartelli', '3904 Goodland Crossing', '(953) 9804092', 'lrubartelli4@arizona.edu', 'lrubartelli', 'lrubartelli', 'pasien'),
(6, 'Garik Agnolo', '51627 Judy Alley', '(630) 2545117', 'gagnolo5@slashdot.org', 'gagnolo', 'gagnolo', 'admin'),
(7, 'Ike Maxted', '34 Johnson Hill', '(781) 1218635', 'imaxted6@a8.net', 'imaxted', 'imaxted', 'admin'),
(8, 'Myles Late', '141 Vahlen Terrace', '(375) 2059221', 'mlate7@ebay.co.uk', 'mlate', 'mlate', 'dokter'),
(9, 'Aldric Cartmail', '008 Talisman Park', '(919) 4987956', 'acartmail8@howstuffworks.com', 'acartmail', 'acartmail', 'dokter'),
(10, 'Derward Cawthorne', '346 Jenifer Lane', '(358) 5347053', 'dcawthorne9@cargocollective.com', 'dcawthome', 'dcawthome', 'pasien'),
(22, 'M Yusril H', 'Malang', '08123456789', 'yusril@dummy.com', 'myusrilh', 'myusrilh', 'pasien');

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
  ADD KEY `fk_praktik_dijadwalkan_pasien1_idx` (`pasien_idpasien`),
  ADD KEY `fk_praktik_dijadwalkan_dokter1_idx` (`dokter_iddokter`);

--
-- Indexes for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`idtransaksi`),
  ADD KEY `fk_transaksi_praktik_dijadwalkan` (`praktik_dijadwalkan_idpraktik_dijadwalkan`),
  ADD KEY `fk_transaksi_pasien1` (`pasien_idpasien`);

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
  MODIFY `idbarang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `iddokter` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwal_praktik`
--
ALTER TABLE `jadwal_praktik`
  MODIFY `idjadwal_praktik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pasien`
--
ALTER TABLE `pasien`
  MODIFY `idpasien` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `praktik_dijadwalkan`
--
ALTER TABLE `praktik_dijadwalkan`
  MODIFY `idpraktik_dijadwalkan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `idtransaksi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  MODIFY `idtransaksi_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `iduser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  ADD CONSTRAINT `fk_praktik_dijadwalkan_dokter1` FOREIGN KEY (`dokter_iddokter`) REFERENCES `dokter` (`iddokter`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_praktik_dijadwalkan_jadwal_praktik1` FOREIGN KEY (`jadwal_praktik_idjadwal_praktik`) REFERENCES `jadwal_praktik` (`idjadwal_praktik`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_praktik_dijadwalkan_pasien1` FOREIGN KEY (`pasien_idpasien`) REFERENCES `pasien` (`idpasien`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `fk_transaksi_pasien1` FOREIGN KEY (`pasien_idpasien`) REFERENCES `pasien` (`idpasien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_praktik_dijadwalkan` FOREIGN KEY (`praktik_dijadwalkan_idpraktik_dijadwalkan`) REFERENCES `praktik_dijadwalkan` (`idpraktik_dijadwalkan`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `transaksi_detail`
--
ALTER TABLE `transaksi_detail`
  ADD CONSTRAINT `fk_transaksi_detail_barang1` FOREIGN KEY (`barang_idbarang`) REFERENCES `barang` (`idbarang`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_transaksi_detail_transaksi1` FOREIGN KEY (`transaksi_idtransaksi`) REFERENCES `transaksi` (`idtransaksi`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
