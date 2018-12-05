-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2018 at 12:14 AM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testedmodo`
--
CREATE DATABASE IF NOT EXISTS `testedmodo` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `testedmodo`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `nama_lengkap`, `email`, `created_on`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrators', 'admin@admin.com', '2018-04-21 17:57:21');

-- --------------------------------------------------------

--
-- Table structure for table `dosen`
--

CREATE TABLE `dosen` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `dob` varchar(40) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `bidang_ahli` varchar(60) DEFAULT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dosen`
--

INSERT INTO `dosen` (`id`, `username`, `password`, `nama_lengkap`, `email`, `dob`, `phone`, `bidang_ahli`, `created_on`) VALUES
(1, 'dosen', 'ce28eed1511f631af6b2a7bb0a85d636', 'Dosen Pengajar', 'dosen@dosen.com', NULL, NULL, NULL, '2018-04-28 13:36:18');

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `kelasid` int(11) NOT NULL,
  `kelas_nama` varchar(50) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL,
  `kelas_deskripsi` varchar(200) DEFAULT NULL,
  `kelas_code` varchar(10) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modify_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `kelasinfo`
--

CREATE TABLE `kelasinfo` (
  `kelasid` int(11) NOT NULL,
  `mahasiswaid` int(11) NOT NULL,
  `pengajarid` int(11) NOT NULL,
  `kelas_kode` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `log_users_modify`
--

CREATE TABLE `log_users_modify` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `description` text NOT NULL,
  `modifierid` int(11) NOT NULL,
  `date_modify` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `type` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa`
--

CREATE TABLE `mahasiswa` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nama_lengkap` varchar(60) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `dob` varchar(40) DEFAULT NULL,
  `nim` varchar(12) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mahasiswa`
--

INSERT INTO `mahasiswa` (`id`, `username`, `password`, `nama_lengkap`, `email`, `phone`, `dob`, `nim`, `created_on`) VALUES
(1, 'maun12', '5787be38ee03a9ae5360f54d9026465f', 'Si Ma\'un', 'simaun@mhs.com', NULL, NULL, '502501205', '2018-04-24 13:05:34'),
(2, 'mhs', '0357a7592c4734a8b1e12bc48e29e9e9', 'mahasiswa teladan', 'mhs@mhs.com', '', '', '', '2018-04-25 22:49:13'),
(3, 'mhs2', '41f1b79f6392e10a3c4bd10272576826', 'mhs2', 'sad@ksjk.com', NULL, NULL, '', '2018-05-07 16:41:35');

-- --------------------------------------------------------

--
-- Table structure for table `notif_dosen`
--

CREATE TABLE `notif_dosen` (
  `id` int(11) NOT NULL,
  `notif_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `notif_msg` text,
  `userid_from` int(11) NOT NULL,
  `userid_to` int(11) NOT NULL,
  `kelasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notif_mhs`
--

CREATE TABLE `notif_mhs` (
  `id` int(11) NOT NULL,
  `notif_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `notif_msg` text,
  `userid_from` int(11) NOT NULL,
  `userid_to` int(11) NOT NULL,
  `kelasid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `quizid` int(11) NOT NULL,
  `quiz_nama` varchar(30) NOT NULL,
  `waktu` int(11) NOT NULL,
  `idkategori` int(11) NOT NULL,
  `pengajarid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quizinfo`
--

CREATE TABLE `quizinfo` (
  `infoid` int(11) NOT NULL,
  `quiz_soal` text NOT NULL,
  `quiz_jawaban` int(1) NOT NULL,
  `quiz_jawaban_1` text,
  `quiz_jawaban_2` text,
  `quiz_jawaban_3` text,
  `quiz_jawaban_4` text,
  `quiz_jawaban_5` text,
  `userid` int(11) UNSIGNED NOT NULL,
  `quizid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_kategori`
--

CREATE TABLE `quiz_kategori` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL,
  `dibuat_oleh` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_start`
--

CREATE TABLE `quiz_start` (
  `id` int(11) NOT NULL,
  `kelasid` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_start_mhs`
--

CREATE TABLE `quiz_start_mhs` (
  `id` int(11) NOT NULL,
  `kelasid` int(11) NOT NULL,
  `quizid` int(11) NOT NULL,
  `end_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `mahasiswaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quiz_temp`
--

CREATE TABLE `quiz_temp` (
  `id` int(11) NOT NULL,
  `mahasiswaid` int(11) NOT NULL,
  `idsoal` int(11) NOT NULL,
  `jawaban` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugas`
--

CREATE TABLE `tugas` (
  `tugasid` int(11) NOT NULL,
  `nama_tugas` varchar(60) NOT NULL,
  `deskripsi` text NOT NULL,
  `file_name` text,
  `pengajarid` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tugasinfo`
--

CREATE TABLE `tugasinfo` (
  `tugasinfoid` int(11) NOT NULL,
  `tugasid` int(11) NOT NULL,
  `keterangan` text,
  `kelasid` int(11) NOT NULL,
  `userid` int(11) UNSIGNED NOT NULL,
  `deadline` datetime DEFAULT NULL,
  `path_jawaban` text,
  `nilai` int(11) NOT NULL DEFAULT '-1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `dosen`
--
ALTER TABLE `dosen`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`kelasid`);

--
-- Indexes for table `log_users_modify`
--
ALTER TABLE `log_users_modify`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`,`modifierid`);

--
-- Indexes for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`,`email`,`nim`);

--
-- Indexes for table `notif_dosen`
--
ALTER TABLE `notif_dosen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notif_mhs`
--
ALTER TABLE `notif_mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`quizid`),
  ADD UNIQUE KEY `quiz_nama` (`quiz_nama`);

--
-- Indexes for table `quizinfo`
--
ALTER TABLE `quizinfo`
  ADD PRIMARY KEY (`infoid`);

--
-- Indexes for table `quiz_kategori`
--
ALTER TABLE `quiz_kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_start`
--
ALTER TABLE `quiz_start`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_start_mhs`
--
ALTER TABLE `quiz_start_mhs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz_temp`
--
ALTER TABLE `quiz_temp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tugas`
--
ALTER TABLE `tugas`
  ADD PRIMARY KEY (`tugasid`);

--
-- Indexes for table `tugasinfo`
--
ALTER TABLE `tugasinfo`
  ADD PRIMARY KEY (`tugasinfoid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `dosen`
--
ALTER TABLE `dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `kelasid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `log_users_modify`
--
ALTER TABLE `log_users_modify`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mahasiswa`
--
ALTER TABLE `mahasiswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notif_dosen`
--
ALTER TABLE `notif_dosen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `notif_mhs`
--
ALTER TABLE `notif_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `quizid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quizinfo`
--
ALTER TABLE `quizinfo`
  MODIFY `infoid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_kategori`
--
ALTER TABLE `quiz_kategori`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_start`
--
ALTER TABLE `quiz_start`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_start_mhs`
--
ALTER TABLE `quiz_start_mhs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quiz_temp`
--
ALTER TABLE `quiz_temp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tugas`
--
ALTER TABLE `tugas`
  MODIFY `tugasid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tugasinfo`
--
ALTER TABLE `tugasinfo`
  MODIFY `tugasinfoid` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
