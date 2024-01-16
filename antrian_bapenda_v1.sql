-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Jan 12, 2024 at 07:38 AM
-- Server version: 5.7.34
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `antrian_bapenda_v1`
--

-- --------------------------------------------------------

--
-- Table structure for table `akseslevel`
--

CREATE TABLE `akseslevel` (
  `KodeLevel` int(11) NOT NULL,
  `NamaLevel` varchar(150) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `akseslevel`
--

INSERT INTO `akseslevel` (`KodeLevel`, `NamaLevel`, `IsAktif`) VALUES
(1, 'admin', 1),
(2, 'petugas', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fiturlevel`
--

CREATE TABLE `fiturlevel` (
  `ViewData` tinyint(4) DEFAULT NULL,
  `AddData` tinyint(4) DEFAULT NULL,
  `EditData` tinyint(4) DEFAULT NULL,
  `DeleteData` tinyint(4) DEFAULT NULL,
  `PrintData` tinyint(4) DEFAULT NULL,
  `KodeLevel` int(11) NOT NULL,
  `KodeFitur` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fiturlevel`
--

INSERT INTO `fiturlevel` (`ViewData`, `AddData`, `EditData`, `DeleteData`, `PrintData`, `KodeLevel`, `KodeFitur`) VALUES
(1, 1, 1, 1, 1, 1, 1),
(1, 1, 1, 1, 1, 1, 2),
(1, 1, 1, 1, 1, 1, 3),
(1, 1, 1, 1, 1, 1, 4),
(1, 1, 1, 1, 1, 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `mstaudiopemanggil`
--

CREATE TABLE `mstaudiopemanggil` (
  `IDPanggil` varchar(25) NOT NULL,
  `Nomor` int(11) DEFAULT NULL,
  `FileAudio` varchar(255) DEFAULT NULL,
  `Nama` varchar(150) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mstlayanan`
--

CREATE TABLE `mstlayanan` (
  `IDLayanan` varchar(25) NOT NULL,
  `NamaLayanan` varchar(255) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstlayanan`
--

INSERT INTO `mstlayanan` (`IDLayanan`, `NamaLayanan`, `IsAktif`) VALUES
('23', 'fgjfghgh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mstloket`
--

CREATE TABLE `mstloket` (
  `IDLoket` varchar(25) NOT NULL,
  `NamaLoket` varchar(255) DEFAULT NULL,
  `NoLoket` int(11) DEFAULT NULL,
  `FileAudio` varchar(255) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL,
  `IsAvailable` tinyint(4) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstloket`
--

INSERT INTO `mstloket` (`IDLoket`, `NamaLoket`, `NoLoket`, `FileAudio`, `IsAktif`, `IsAvailable`, `UserName`) VALUES
('1', 'abcd', 1, NULL, 1, 1, 'joni');

-- --------------------------------------------------------

--
-- Table structure for table `mstpengunjung`
--

CREATE TABLE `mstpengunjung` (
  `IDUser` varchar(25) NOT NULL,
  `NIK` varchar(255) DEFAULT NULL,
  `NamaLengkap` varchar(255) DEFAULT NULL,
  `NoHP` varchar(25) DEFAULT NULL,
  `TglRegister` date DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstpengunjung`
--

INSERT INTO `mstpengunjung` (`IDUser`, `NIK`, `NamaLengkap`, `NoHP`, `TglRegister`, `IsAktif`, `Password`, `Email`) VALUES
('1', '1234567890', 'harry maguire', '081234567890', '2023-08-07', 1, 'MTIzNDU=', 'hary@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `mstpertanyaanspm`
--

CREATE TABLE `mstpertanyaanspm` (
  `IDPertanyaan` varchar(25) NOT NULL,
  `Pertanyaan` mediumtext,
  `NoUrut` int(11) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL,
  `JenisSurvey` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mstuserlogin`
--

CREATE TABLE `mstuserlogin` (
  `UserName` varchar(255) NOT NULL,
  `NamaLengkap` varchar(255) DEFAULT NULL,
  `NoHP` varchar(50) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  `KodeLevel` int(11) DEFAULT NULL,
  `IsPetugasLoket` tinyint(4) DEFAULT '0',
  `IsAdmin` tinyint(4) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mstuserlogin`
--

INSERT INTO `mstuserlogin` (`UserName`, `NamaLengkap`, `NoHP`, `IsAktif`, `Password`, `KodeLevel`, `IsPetugasLoket`, `IsAdmin`) VALUES
('admin', 'Admindu 1', '085745910591', 1, '$2a$12$DgI/I0mCJ/ZznJZCQoqdR.l4CbsN.5h7q9HS0c6jSBGqWUGJ0Enqm', 1, 0, 1),
('joni', 'joni kuchiyose no jutsu', '08123456789', 1, 'MTIzNDU=', 2, 1, 0),
('kominfo@jombangkab.go.id', 'Budi', '0232112', NULL, '123456', NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `nilaispm`
--

CREATE TABLE `nilaispm` (
  `IDKunjungan` varchar(25) NOT NULL,
  `IDPertanyaan` varchar(25) NOT NULL,
  `JawabUser` varchar(255) DEFAULT NULL,
  `SkorUser` int(11) DEFAULT NULL,
  `JenisSurvey` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `opsijawaban`
--

CREATE TABLE `opsijawaban` (
  `NoUrut` int(11) NOT NULL,
  `NarasiJawaban` mediumtext,
  `Skor` int(11) DEFAULT NULL,
  `IDPertanyaan` varchar(25) NOT NULL,
  `JenisSurvey` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `serverfitur`
--

CREATE TABLE `serverfitur` (
  `KodeFitur` int(11) NOT NULL,
  `NoUrut` int(11) DEFAULT NULL,
  `NamaFitur` varchar(250) DEFAULT NULL,
  `KelompokFitur` varchar(255) DEFAULT NULL,
  `IsAktif` tinyint(4) DEFAULT NULL,
  `Icon` text,
  `Slug` varchar(255) DEFAULT NULL,
  `Url` varchar(255) DEFAULT NULL,
  `Method` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `serverfitur`
--

INSERT INTO `serverfitur` (`KodeFitur`, `NoUrut`, `NamaFitur`, `KelompokFitur`, `IsAktif`, `Icon`, `Slug`, `Url`, `Method`) VALUES
(1, 1, 'Manajemen Loket', 'Manajemen Loket', 1, 'feather-grid', 'manajemen-loket', 'App\\Http\\Livewire\\Admin\\Manajemenloket\\Loket', 'get'),
(2, 2, 'Manajemen Layanan', 'Manajemen Layanan', 1, 'feather-grid', 'manajemen-layanan', 'App\\Http\\Controllers\\Master\\LayananController', 'auto'),
(3, 3, 'Daftar Merk', 'Manajemen Kendaraan', 0, 'feather-grid', 'daftar-merk', 'App\\Http\\Controllers\\Master\\MerkController', 'get'),
(4, 4, 'Daftar Type', 'Manajemen Kendaraan', 0, 'feather-grid', 'daftar-type', 'App\\Http\\Controllers\\Master\\TypeController', 'get'),
(5, 5, 'Manajemen Via Payment', 'Manajemen Via Payment', 0, 'feather-grid', 'manajemen-payment', 'App\\Http\\Controllers\\Master\\PaymentController', 'get'),
(6, 6, 'Setting Biaya', 'Setting Biaya', 0, 'feather-grid', 'setting-biaya', 'App\\Http\\Controllers\\Master\\BiayaController', 'get'),
(7, 7, 'Transaksi', 'Transaksi', 0, 'feather-grid', 'transaksi', 'App\\Http\\Controllers\\Transaksi\\TransController', 'get'),
(8, 8, 'Laporan Hutang', 'Laporan', 0, 'feather-grid', 'laporan-hutang', 'App\\Http\\Controllers\\Laporan\\LaporanController', 'get'),
(9, 9, 'Laporan Piutang', 'Laporan', 0, 'feather-grid', 'laporan-piutang', 'App\\Http\\Controllers\\Laporan\\LaporanController', 'get');

-- --------------------------------------------------------

--
-- Table structure for table `serverlog`
--

CREATE TABLE `serverlog` (
  `KodeLog` varchar(25) NOT NULL,
  `DateTimeLog` date DEFAULT NULL,
  `JenisTransaksi` varchar(255) DEFAULT NULL,
  `NoTransaksi` varchar(255) DEFAULT NULL,
  `Action` varchar(255) DEFAULT NULL,
  `Dskripsi` mediumtext,
  `IPAddress` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sistemsetting`
--

CREATE TABLE `sistemsetting` (
  `NoSetting` int(11) NOT NULL,
  `NamaSetting` varchar(150) DEFAULT NULL,
  `Value1` mediumtext,
  `Value2` mediumtext,
  `Value3` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trkunjungan`
--

CREATE TABLE `trkunjungan` (
  `IDKunjungan` varchar(25) NOT NULL,
  `TanggalJam` date DEFAULT NULL,
  `JamDilayani` time DEFAULT NULL,
  `NoAntrian` int(11) DEFAULT NULL,
  `StatusAntrian` enum('tunggu','proses','lewati','selesai','batal') DEFAULT NULL,
  `IDLoket` varchar(25) DEFAULT NULL,
  `UserName` varchar(255) DEFAULT NULL,
  `IDUser` varchar(25) DEFAULT NULL,
  `NilaiSPM` float DEFAULT NULL,
  `IDLayanan` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trkunjungan`
--

INSERT INTO `trkunjungan` (`IDKunjungan`, `TanggalJam`, `JamDilayani`, `NoAntrian`, `StatusAntrian`, `IDLoket`, `UserName`, `IDUser`, `NilaiSPM`, `IDLayanan`) VALUES
('1', '2023-08-07', NULL, 1, 'tunggu', '1', NULL, '1', NULL, NULL),
('2', '2023-08-07', NULL, 2, 'tunggu', '1', NULL, '1', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akseslevel`
--
ALTER TABLE `akseslevel`
  ADD PRIMARY KEY (`KodeLevel`);

--
-- Indexes for table `fiturlevel`
--
ALTER TABLE `fiturlevel`
  ADD PRIMARY KEY (`KodeLevel`,`KodeFitur`),
  ADD KEY `FK_fiturlevel_serverfitur` (`KodeFitur`);

--
-- Indexes for table `mstaudiopemanggil`
--
ALTER TABLE `mstaudiopemanggil`
  ADD PRIMARY KEY (`IDPanggil`);

--
-- Indexes for table `mstlayanan`
--
ALTER TABLE `mstlayanan`
  ADD PRIMARY KEY (`IDLayanan`);

--
-- Indexes for table `mstloket`
--
ALTER TABLE `mstloket`
  ADD PRIMARY KEY (`IDLoket`),
  ADD KEY `FK_mstloket_mstuserlogin` (`UserName`);

--
-- Indexes for table `mstpengunjung`
--
ALTER TABLE `mstpengunjung`
  ADD PRIMARY KEY (`IDUser`);

--
-- Indexes for table `mstpertanyaanspm`
--
ALTER TABLE `mstpertanyaanspm`
  ADD PRIMARY KEY (`IDPertanyaan`,`JenisSurvey`);

--
-- Indexes for table `mstuserlogin`
--
ALTER TABLE `mstuserlogin`
  ADD PRIMARY KEY (`UserName`),
  ADD KEY `FK_mstuserlogin_akseslevel` (`KodeLevel`);

--
-- Indexes for table `nilaispm`
--
ALTER TABLE `nilaispm`
  ADD PRIMARY KEY (`IDKunjungan`,`IDPertanyaan`,`JenisSurvey`),
  ADD KEY `FK_nilaispm_mstpertanyaanspm` (`IDPertanyaan`,`JenisSurvey`);

--
-- Indexes for table `opsijawaban`
--
ALTER TABLE `opsijawaban`
  ADD PRIMARY KEY (`NoUrut`,`IDPertanyaan`,`JenisSurvey`),
  ADD KEY `FK_opsijawaban_mstpertanyaanspm` (`IDPertanyaan`,`JenisSurvey`);

--
-- Indexes for table `serverfitur`
--
ALTER TABLE `serverfitur`
  ADD PRIMARY KEY (`KodeFitur`);

--
-- Indexes for table `serverlog`
--
ALTER TABLE `serverlog`
  ADD PRIMARY KEY (`KodeLog`);

--
-- Indexes for table `sistemsetting`
--
ALTER TABLE `sistemsetting`
  ADD PRIMARY KEY (`NoSetting`);

--
-- Indexes for table `trkunjungan`
--
ALTER TABLE `trkunjungan`
  ADD PRIMARY KEY (`IDKunjungan`),
  ADD KEY `FK_trkunjungan_mstlayanan` (`IDLayanan`),
  ADD KEY `FK_trkunjungan_mstpengunjung` (`IDUser`),
  ADD KEY `FK_trkunjungan_mstuserlogin` (`UserName`),
  ADD KEY `FK_trkunjungan_mstloket` (`IDLoket`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fiturlevel`
--
ALTER TABLE `fiturlevel`
  ADD CONSTRAINT `FK_fiturlevel_akseslevel` FOREIGN KEY (`KodeLevel`) REFERENCES `akseslevel` (`KodeLevel`),
  ADD CONSTRAINT `FK_fiturlevel_serverfitur` FOREIGN KEY (`KodeFitur`) REFERENCES `serverfitur` (`KodeFitur`);

--
-- Constraints for table `mstloket`
--
ALTER TABLE `mstloket`
  ADD CONSTRAINT `FK_mstloket_mstuserlogin` FOREIGN KEY (`UserName`) REFERENCES `mstuserlogin` (`UserName`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `mstuserlogin`
--
ALTER TABLE `mstuserlogin`
  ADD CONSTRAINT `FK_mstuserlogin_akseslevel` FOREIGN KEY (`KodeLevel`) REFERENCES `akseslevel` (`KodeLevel`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `nilaispm`
--
ALTER TABLE `nilaispm`
  ADD CONSTRAINT `FK_nilaispm_mstpertanyaanspm` FOREIGN KEY (`IDPertanyaan`,`JenisSurvey`) REFERENCES `mstpertanyaanspm` (`IDPertanyaan`, `JenisSurvey`),
  ADD CONSTRAINT `FK_nilaispm_trkunjungan` FOREIGN KEY (`IDKunjungan`) REFERENCES `trkunjungan` (`IDKunjungan`);

--
-- Constraints for table `opsijawaban`
--
ALTER TABLE `opsijawaban`
  ADD CONSTRAINT `FK_opsijawaban_mstpertanyaanspm` FOREIGN KEY (`IDPertanyaan`,`JenisSurvey`) REFERENCES `mstpertanyaanspm` (`IDPertanyaan`, `JenisSurvey`);

--
-- Constraints for table `trkunjungan`
--
ALTER TABLE `trkunjungan`
  ADD CONSTRAINT `FK_trkunjungan_mstlayanan` FOREIGN KEY (`IDLayanan`) REFERENCES `mstlayanan` (`IDLayanan`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `FK_trkunjungan_mstloket` FOREIGN KEY (`IDLoket`) REFERENCES `mstloket` (`IDLoket`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `FK_trkunjungan_mstpengunjung` FOREIGN KEY (`IDUser`) REFERENCES `mstpengunjung` (`IDUser`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `FK_trkunjungan_mstuserlogin` FOREIGN KEY (`UserName`) REFERENCES `mstuserlogin` (`UserName`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
