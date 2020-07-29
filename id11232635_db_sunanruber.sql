-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 29, 2020 at 06:24 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id11232635_db_sunanruber`
--

-- --------------------------------------------------------

--
-- Table structure for table `barang`
--

CREATE TABLE `barang` (
  `id_barang` int(5) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_karet` varchar(100) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `harga` int(11) NOT NULL,
  `jenis_packing` varchar(100) NOT NULL,
  `stuff_date` date NOT NULL,
  `rencana_stuff` enum('SIANG','MALAM') NOT NULL,
  `stock` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `barang`
--

INSERT INTO `barang` (`id_barang`, `nama`, `jenis_karet`, `jumlah`, `harga`, `jenis_packing`, `stuff_date`, `rencana_stuff`, `stock`) VALUES
(2, 'crumb rubber', 'Kering', 3, 1000, 'padat', '2019-08-09', 'SIANG', 13),
(3, 'barang', 'Setenga', 1, 10000, 'packing', '2019-10-13', 'SIANG', 10),
(4, 'crumb rubber', 'Kering', 100, 200000, 'padat', '2020-01-28', 'MALAM', 10),
(5, 'crumb rubber', 'kering', 500, 200000, 'padat', '2020-01-28', 'SIANG', 500),
(6, 'crumb rubber', 'kering', 200, 100000, 'padat', '2020-02-06', 'MALAM', 50);

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id_pembayaran` int(5) NOT NULL,
  `tanggal` date NOT NULL,
  `id_pesanan` int(5) NOT NULL,
  `jumlah` int(8) NOT NULL,
  `file` text NOT NULL,
  `id_pengguna_verifikator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id_pembayaran`, `tanggal`, `id_pesanan`, `jumlah`, `file`, `id_pengguna_verifikator`) VALUES
(11, '2019-10-14', 36, 10000, 'assets/upload/bukti_bayar/_5da44e39d241d.png', 1),
(12, '2019-10-15', 38, 303000, 'assets/upload/bukti_bayar/_5da5045b591a0.PNG', 1),
(13, '2019-10-15', 39, 100000, 'assets/upload/bukti_bayar/_5da58d3547e6f.jpg', 1),
(14, '2019-10-29', 40, 200000, 'assets/upload/bukti_bayar/_5db7e44238304.jpg', 1),
(15, '2019-12-25', 41, 4000, 'assets/upload/bukti_bayar/_5e037a5ee9283.png', 1),
(16, '2020-01-28', 42, 7000, 'assets/upload/bukti_bayar/_5e2f35fa5bfc5.jpg', NULL),
(17, '2020-01-28', 43, 240000, 'assets/upload/bukti_bayar/_5e2f368a6e0e1.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id_pengguna` int(5) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `telepon` varchar(20) DEFAULT NULL,
  `instansi` varchar(50) DEFAULT NULL,
  `alamat_instansi` text DEFAULT NULL,
  `level` enum('Admin','Pimpinan','Pelanggan','Gudang') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id_pengguna`, `username`, `password`, `nama_lengkap`, `email`, `alamat`, `telepon`, `instansi`, `alamat_instansi`, `level`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Awaludin', 'sibiduk@live.com', 'palembang', '081279798615', 'pt sunan rubber', 'palembang', 'Admin'),
(2, 'pelanggan', '7f78f06d2d1262a0a222ca9834b15d9d', 'Pelanggan Kalian', 'nurulfitri@gmail.com', 'sekayu', '085669345012', 'sekayu manufactured', 'sekayu', 'Pelanggan'),
(3, 'gudang', '202446dd1d6028084426867365b0c7a1', 'Muhammad Ramzi Agustian', 'sadeli@gmail.com', 'betung', '081373103843', 'betung', 'betung', 'Gudang'),
(7, 'bos', '15fc4a53992beba40ae91e5244e79dff', 'bos', 'bos@gmail.com', 'palembang', '081278767567', 'scopindo', 'palembang', 'Pimpinan'),
(9, 'p@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'purwa', 'p@gmail.com', 'palembang', '08128978979', 'cv loko', 'palembang', 'Pelanggan'),
(10, 'sibiduk@live.com', '6e9a7023042a0159039c1f0259903774', 'awal', 'sibiduk@live.com', 'kertapati', '081279798615', 'palembang', 'kertapati', 'Pelanggan'),
(11, 'slivecrotz@gmail.com', '25d55ad283aa400af464c76d713c07ad', 'nufi', 'slivecrotz@gmail.com', 'plg', '089778767676767', 'sekayu', 'sekayu', 'Pelanggan');

-- --------------------------------------------------------

--
-- Table structure for table `pengiriman`
--

CREATE TABLE `pengiriman` (
  `id_pengiriman` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `tgl_kirim` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengiriman`
--

INSERT INTO `pengiriman` (`id_pengiriman`, `id_pesanan`, `tgl_kirim`) VALUES
(1, 36, '2019-10-14'),
(2, 38, '2019-10-15'),
(3, 39, '2019-10-15'),
(4, 40, '2019-10-29'),
(5, 41, '2019-12-26');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id_pesanan` int(11) NOT NULL,
  `id_pengguna` int(11) NOT NULL,
  `alamat_kirim` text NOT NULL,
  `status` enum('dipesan','upload bukti bayar','dibayar','dikirim','diterima') NOT NULL,
  `time_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id_pesanan`, `id_pengguna`, `alamat_kirim`, `status`, `time_created`) VALUES
(36, 9, 'palembang', 'dikirim', '2019-10-14 02:14:00'),
(38, 9, 'talang jambe palembang', 'dikirim', '2019-10-15 06:17:28'),
(39, 10, 'kertapati', 'dikirim', '2019-10-15 16:08:50'),
(40, 11, 'sekayu', 'dikirim', '2019-10-29 14:02:02'),
(41, 2, 'sekayu', 'dikirim', '2019-12-23 22:40:29'),
(42, 2, 'plg\r\n', 'upload bukti bayar', '2019-12-24 22:18:46'),
(43, 2, 'SEKAYU', 'upload bukti bayar', '2019-12-24 22:34:31'),
(44, 2, 'jambi', 'dipesan', '2020-01-27 11:50:47'),
(45, 2, 'jakarta', 'dipesan', '2020-01-27 11:51:28'),
(46, 2, 'palembang', 'dipesan', '2020-01-27 12:00:42');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan_detail`
--

CREATE TABLE `pesanan_detail` (
  `id` int(11) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_barang` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `subTotal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pesanan_detail`
--

INSERT INTO `pesanan_detail` (`id`, `id_pesanan`, `id_barang`, `jumlah`, `harga`, `subTotal`) VALUES
(36, 36, 3, 1, 10000, 10000),
(39, 38, 2, 3, 1000, 3000),
(40, 38, 3, 30, 10000, 300000),
(41, 39, 3, 10, 10000, 100000),
(42, 40, 3, 20, 10000, 200000),
(43, 41, 2, 4, 1000, 4000),
(44, 42, 2, 7, 1000, 7000),
(45, 43, 3, 8, 10000, 80000),
(46, 43, 3, 9, 10000, 90000),
(47, 43, 3, 7, 10000, 70000),
(48, 44, 2, 5, 1000, 5000),
(49, 45, 3, 4, 10000, 40000),
(50, 46, 3, 2, 10000, 20000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`id_barang`);

--
-- Indexes for table `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_penjualan` (`id_pesanan`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id_pengguna`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `pengiriman`
--
ALTER TABLE `pengiriman`
  ADD PRIMARY KEY (`id_pengiriman`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `idUser` (`id_pengguna`),
  ADD KEY `idStatus` (`status`);

--
-- Indexes for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idPesanan` (`id_pesanan`),
  ADD KEY `idProduk` (`id_barang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barang`
--
ALTER TABLE `barang`
  MODIFY `id_barang` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id_pembayaran` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id_pengguna` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pengiriman`
--
ALTER TABLE `pengiriman`
  MODIFY `id_pengiriman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id_pesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pesanan_detail`
--
ALTER TABLE `pesanan_detail`
  ADD CONSTRAINT `pesanan_detail_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
