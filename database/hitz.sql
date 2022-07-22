-- --------------------------------------------------------

--
-- Table structure for table `districts`
--

CREATE TABLE `districts` (
  `id` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `regency_id` char(4) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `districts`
--

INSERT INTO `districts` (`id`, `regency_id`, `name`) VALUES
('3573010', '3573', 'KEDUNGKANDANG'),
('3573020', '3573', 'SUKUN'),
('3573030', '3573', 'KLOJEN'),
('3573040', '3573', 'BLIMBING'),
('3573050', '3573', 'LOWOKWARU');

-- --------------------------------------------------------

--
-- Table structure for table `hz_barang`
--

CREATE TABLE `hz_barang` (
  `barang_id` int(11) NOT NULL,
  `kode` varchar(10) NOT NULL DEFAULT '',
  `nama` varchar(30) NOT NULL DEFAULT '',
  `satuan` varchar(3) NOT NULL DEFAULT '''''',
  `jumlah` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hz_dokter`
--

CREATE TABLE `hz_dokter` (
  `dokter_id` int(11) NOT NULL,
  `nama` varchar(30) NOT NULL DEFAULT '',
  `almt` text NOT NULL,
  `phon` bigint(20) NOT NULL DEFAULT 0,
  `pass` char(32) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hz_jadwal`
--

CREATE TABLE `hz_jadwal` (
  `jadwal_id` int(11) NOT NULL,
  `hari` int(11) NOT NULL DEFAULT 0,
  `mulai` time NOT NULL,
  `selesai` time NOT NULL,
  `dokter` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hz_order`
--

CREATE TABLE `hz_order` (
  `tgl` date NOT NULL,
  `pasien` int(11) NOT NULL DEFAULT 0,
  `keluhan` varchar(160) NOT NULL DEFAULT '''''',
  `tarif` int(11) NOT NULL DEFAULT 0,
  `barang` int(11) DEFAULT 0,
  `jumlah` int(11) DEFAULT 0,
  `bukti` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hz_pasien`
--

CREATE TABLE `hz_pasien` (
  `pasien_id` int(11) NOT NULL,
  `nik` bigint(20) DEFAULT 0,
  `nama` varchar(30) DEFAULT '',
  `tmp` varchar(30) DEFAULT '',
  `tgl` date DEFAULT NULL,
  `districts_id` char(7) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `villages_id` char(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT '',
  `almt` varchar(160) DEFAULT '',
  `phon` bigint(20) NOT NULL DEFAULT 0,
  `foto` longblob DEFAULT NULL,
  `mail` varchar(160) NOT NULL DEFAULT '',
  `pass` char(32) NOT NULL DEFAULT '',
  `on_active` enum('No','Yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `hz_tarif`
--

CREATE TABLE `hz_tarif` (
  `tarif_id` int(11) NOT NULL,
  `tgl` date NOT NULL,
  `jadwal` int(11) NOT NULL DEFAULT 0,
  `harga` int(11) NOT NULL DEFAULT 0,
  `pasien` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `villages`
--

CREATE TABLE `villages` (
  `id` char(10) COLLATE utf8_unicode_ci NOT NULL,
  `district_id` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `villages`
--

INSERT INTO `villages` (`id`, `district_id`, `name`) VALUES
('3573010001', '3573010', 'ARJOWINANGUN'),
('3573010002', '3573010', 'TLOGOWARU'),
('3573010003', '3573010', 'WONOKOYO'),
('3573010004', '3573010', 'BUMIAYU'),
('3573010005', '3573010', 'BURING'),
('3573010006', '3573010', 'MERGOSONO'),
('3573010007', '3573010', 'KOTALAMA'),
('3573010008', '3573010', 'KEDUNGKANDANG'),
('3573010009', '3573010', 'SAWOJAJAR'),
('3573010010', '3573010', 'MADYOPURO'),
('3573010011', '3573010', 'LESANPURO'),
('3573010012', '3573010', 'CEMOROKANDANG'),
('3573020001', '3573020', 'KEBONSARI'),
('3573020002', '3573020', 'GADANG'),
('3573020003', '3573020', 'CIPTOMULYO'),
('3573020005', '3573020', 'BANDUNGREJOSARI'),
('3573020006', '3573020', 'BAKALAN KRAJAN'),
('3573020007', '3573020', 'MULYOREJO'),
('3573020008', '3573020', 'BANDULAN'),
('3573020009', '3573020', 'TANJUNGREJO'),
('3573020010', '3573020', 'PISANG CANDI'),
('3573020011', '3573020', 'KARANG BESUKI'),
('3573030001', '3573030', 'KASIN'),
('3573030002', '3573030', 'SUKOHARJO'),
('3573030003', '3573030', 'KIDUL DALEM'),
('3573030004', '3573030', 'KAUMAN'),
('3573030005', '3573030', 'BARENG'),
('3573030006', '3573030', 'GADINGKASRI'),
('3573030007', '3573030', 'ORO ORO DOWO'),
('3573030008', '3573030', 'KLOJEN'),
('3573030009', '3573030', 'RAMPAL CELAKET'),
('3573030010', '3573030', 'SAMAAN'),
('3573030011', '3573030', 'PENANGGUNGAN'),
('3573040001', '3573040', 'JODIPAN'),
('3573040002', '3573040', 'POLEHAN'),
('3573040003', '3573040', 'KESATRIAN'),
('3573040004', '3573040', 'BUNULREJO'),
('3573040005', '3573040', 'PURWANTORO'),
('3573040006', '3573040', 'PANDANWANGI'),
('3573040007', '3573040', 'BLIMBING'),
('3573040008', '3573040', 'PURWODADI'),
('3573040009', '3573040', 'POLOWIJEN'),
('3573040010', '3573040', 'ARJOSARI'),
('3573040011', '3573040', 'BALEARJOSARI'),
('3573050001', '3573050', 'MERJOSARI'),
('3573050002', '3573050', 'DINOYO'),
('3573050003', '3573050', 'SUMBERSARI'),
('3573050004', '3573050', 'KETAWANGGEDE'),
('3573050005', '3573050', 'JATIMULYO'),
('3573050006', '3573050', 'LOWOKWARU'),
('3573050007', '3573050', 'TULUSREJO'),
('3573050008', '3573050', 'MOJOLANGU'),
('3573050009', '3573050', 'TUNJUNGSEKAR'),
('3573050010', '3573050', 'TASIKMADU'),
('3573050012', '3573050', 'TLOGOMAS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `districts`
--
ALTER TABLE `districts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hz_barang`
--
ALTER TABLE `hz_barang`
  ADD PRIMARY KEY (`barang_id`);

--
-- Indexes for table `hz_dokter`
--
ALTER TABLE `hz_dokter`
  ADD PRIMARY KEY (`dokter_id`);

--
-- Indexes for table `hz_jadwal`
--
ALTER TABLE `hz_jadwal`
  ADD PRIMARY KEY (`jadwal_id`);

--
-- Indexes for table `hz_pasien`
--
ALTER TABLE `hz_pasien`
  ADD PRIMARY KEY (`pasien_id`);

--
-- Indexes for table `hz_tarif`
--
ALTER TABLE `hz_tarif`
  ADD PRIMARY KEY (`tarif_id`);

--
-- Indexes for table `villages`
--
ALTER TABLE `villages`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hz_barang`
--
ALTER TABLE `hz_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hz_dokter`
--
ALTER TABLE `hz_dokter`
  MODIFY `dokter_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hz_jadwal`
--
ALTER TABLE `hz_jadwal`
  MODIFY `jadwal_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hz_pasien`
--
ALTER TABLE `hz_pasien`
  MODIFY `pasien_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hz_tarif`
--
ALTER TABLE `hz_tarif`
  MODIFY `tarif_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
