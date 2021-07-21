-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 14, 2021 at 05:41 PM
-- Server version: 10.4.19-MariaDB
-- PHP Version: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci-voting`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `calon`
--

CREATE TABLE `calon` (
  `id_calon` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `motto` varchar(250) NOT NULL,
  `alamat` text NOT NULL,
  `jenis_kelamin` varchar(50) NOT NULL,
  `tempat_lahir` varchar(50) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `foto` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calon`
--

INSERT INTO `calon` (`id_calon`, `nik`, `nama`, `motto`, `alamat`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `foto`) VALUES
(7, '32561561123468', 'Agung', 'Bersama membangun desa.', 'Perumahan Griya Mandala, Jl. Kehormatan Blok A No.19 Rt.002 Rw.08 Duri Kepa, Kebon Jeruk, Jakarta Barat, Indonesia, 11510', 'Laki-Laki', 'Jakarta', '2000-03-01', '1623684462_69610a27f2a6a7e78f62.jpeg'),
(8, '333122546482', 'Kencana', 'Cantik, Jujur, Amanah.', 'Jl. Kacang Kapri Muda Kav. 13 Utan Kayu Selatan, Matraman, Jakarta Timur, Indonesia, 13120', 'Perempuan', 'Bekasi', '2001-05-02', '1623684472_2edad3b77547e705f61d.jpeg'),
(9, '31256488446', 'Hamdan', 'Pengalaman-Profesional, Lanjutkan', 'Jl. Cinta Boulevard No.3 RT 07/02 Bintaro, Pesanggrahan, Jaksel, 12330', 'Laki-Laki', 'Jakarta', '1999-06-10', '1623684480_bda5807197b48919c6e5.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `pemilih`
--

CREATE TABLE `pemilih` (
  `id_pemilih` int(11) NOT NULL,
  `nik` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pemilih`
--

INSERT INTO `pemilih` (`id_pemilih`, `nik`, `nama`, `password`) VALUES
(5, '378491155666', 'Ade', '123456'),
(6, '378945612368', 'Kirana', '123456'),
(7, '30216486564', 'Gentur', '123456'),
(8, '3015697784512', 'Lala', '123456'),
(9, '3650514977952', 'Intan', '123456'),
(10, '300015494546', 'Fitri', '123456'),
(11, '378941561232', 'Hakim', '123456'),
(12, '3941184984566', 'Karno', '123456'),
(13, '3456154849846', 'Indri', '123456'),
(14, '333151984877', 'Lina', '123456'),
(15, '3989415122123', 'Kanigara', '123456'),
(16, '3745186565469', 'Laksita', '123456'),
(17, '3516156489153', 'Lintang', '123456'),
(18, '3789815616513', 'Nandana', '123456'),
(19, '3332849116515', 'Lingga', '123456'),
(20, '36177557687768', 'Maya ', '123456'),
(21, '378145686', 'Nawang', '123456'),
(22, '3331225414242', 'Opal', '123456'),
(23, '333452711787', 'Nadia ', '123456'),
(24, '3233737837777', 'Putri', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `voting`
--

CREATE TABLE `voting` (
  `id_voting` int(11) NOT NULL,
  `id_pemilih` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `tanggal` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `voting`
--

INSERT INTO `voting` (`id_voting`, `id_pemilih`, `id_calon`, `tanggal`) VALUES
(9, 5, 7, '2021-06-14 22:27:21'),
(10, 6, 8, '2021-06-14 22:28:34'),
(11, 7, 9, '2021-06-14 22:28:54'),
(12, 8, 8, '2021-06-14 22:29:12'),
(13, 9, 8, '2021-06-14 22:31:57'),
(14, 10, 8, '2021-06-14 22:33:46'),
(15, 11, 7, '2021-06-14 22:34:04'),
(16, 14, 7, '2021-06-14 22:34:54'),
(17, 15, 7, '2021-06-14 22:35:28'),
(18, 12, 7, '2021-06-14 22:37:56'),
(19, 13, 7, '2021-06-14 22:37:56'),
(20, 16, 7, '2021-06-14 22:38:44'),
(21, 17, 7, '2021-06-14 22:38:44'),
(22, 18, 7, '2021-06-14 22:39:03'),
(23, 19, 7, '2021-06-14 22:39:03'),
(24, 20, 8, '2021-06-14 22:39:37'),
(25, 21, 9, '2021-06-14 22:39:37'),
(26, 22, 9, '2021-06-14 22:40:09'),
(27, 23, 8, '2021-06-14 22:40:09'),
(28, 24, 7, '2021-06-14 22:41:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `calon`
--
ALTER TABLE `calon`
  ADD PRIMARY KEY (`id_calon`);

--
-- Indexes for table `pemilih`
--
ALTER TABLE `pemilih`
  ADD PRIMARY KEY (`id_pemilih`);

--
-- Indexes for table `voting`
--
ALTER TABLE `voting`
  ADD PRIMARY KEY (`id_voting`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `calon`
--
ALTER TABLE `calon`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `pemilih`
--
ALTER TABLE `pemilih`
  MODIFY `id_pemilih` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `voting`
--
ALTER TABLE `voting`
  MODIFY `id_voting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
