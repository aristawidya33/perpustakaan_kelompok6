-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2026 at 05:13 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_perpustakaan`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id_anggota` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `nama_anggota` varchar(100) NOT NULL,
  `jurusan` varchar(100) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id_anggota`, `nim`, `nama_anggota`, `jurusan`, `alamat`, `no_hp`) VALUES
(1, '24020', 'Arista', 'Sistem Informasi', 'Padang', '08111111111'),
(2, '24021', 'Syarla', 'Sistem Informasi', 'Padang', '08222222222'),
(3, '24014', 'Putri', 'Teknik Informatika', 'Padang', '08333333333'),
(4, '24026', 'Tanti', 'Teknik Informatika', 'Padang', '08333333333'),
(5, '2012', 'Tata', 'Informatika', 'Solok', '0899999'),
(9, '24024', 'Mutia', 'Sistem Informasi', 'padang', '085555555');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `kode_buku` varchar(20) NOT NULL,
  `judul_buku` varchar(150) NOT NULL,
  `pengarang` varchar(100) DEFAULT NULL,
  `penerbit` varchar(100) DEFAULT NULL,
  `tahun_terbit` year(4) DEFAULT NULL,
  `stok` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `kode_buku`, `judul_buku`, `pengarang`, `penerbit`, `tahun_terbit`, `stok`) VALUES
(2, 'BK002', 'CodeIgniter', 'Andi', 'Informatika', '2022', 8),
(3, 'BK003', 'JavaScript', 'Rudi', 'Andi Publisher', '2024', 12),
(4, 'BK004', 'Basis Data', 'Joko', 'Gramedia', '2021', 7),
(5, 'BK005', 'PHP Native', 'Ahmad', 'Deepublish', '2023', 14);

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_anggota` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `lama_pinjam` int(11) DEFAULT 0,
  `denda` int(11) DEFAULT 0,
  `status` enum('dipinjam','dikembalikan') DEFAULT 'dipinjam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_anggota`, `id_buku`, `tanggal_pinjam`, `tanggal_kembali`, `lama_pinjam`, `denda`, `status`) VALUES
(1, 1, 2, '2026-06-05', '2026-06-05', 0, 0, 'dikembalikan'),
(2, 1, 3, '2026-06-05', '2026-06-05', 0, 0, 'dikembalikan'),
(4, 1, 2, '2026-12-03', '2026-12-03', 0, 0, 'dikembalikan'),
(5, 2, 2, '2026-12-06', '2026-08-12', -116, 0, 'dikembalikan'),
(6, 1, 2, '2026-06-10', '2026-06-10', 0, 0, 'dikembalikan'),
(7, 1, 2, '2026-06-10', '2026-06-10', 0, 0, 'dikembalikan'),
(8, 1, 3, '2026-12-06', '2026-12-06', 0, 0, 'dikembalikan'),
(9, 2, 3, '2026-11-05', '2026-12-08', 33, 60000, 'dikembalikan'),
(10, 2, 5, '2026-12-03', '0000-00-00', 0, 0, 'dipinjam');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `id_anggota` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `id_anggota`, `username`, `password`, `role`) VALUES
(1, NULL, 'admin', 'admin123', 'admin'),
(2, 1, '24020', 'widya123', 'mahasiswa'),
(3, 2, '24021', 'syarla0808', 'mahasiswa'),
(8, 3, '24014', '24014', 'mahasiswa'),
(9, 9, '24024', '24024', 'mahasiswa'),
(10, 4, '24026', '24026', 'mahasiswa');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_buku`
-- (See below for the actual view)
--
CREATE TABLE `v_buku` (
`id_peminjaman` int(11)
,`nim` varchar(20)
,`nama_anggota` varchar(100)
,`judul_buku` varchar(150)
,`tanggal_pinjam` date
,`tanggal_kembali` date
,`lama_pinjam` int(11)
,`denda` int(11)
,`status` enum('dipinjam','dikembalikan')
);

-- --------------------------------------------------------

--
-- Structure for view `v_buku`
--
DROP TABLE IF EXISTS `v_buku`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_buku`  AS SELECT `p`.`id_peminjaman` AS `id_peminjaman`, `a`.`nim` AS `nim`, `a`.`nama_anggota` AS `nama_anggota`, `b`.`judul_buku` AS `judul_buku`, `p`.`tanggal_pinjam` AS `tanggal_pinjam`, `p`.`tanggal_kembali` AS `tanggal_kembali`, `p`.`lama_pinjam` AS `lama_pinjam`, `p`.`denda` AS `denda`, `p`.`status` AS `status` FROM ((`peminjaman` `p` join `anggota` `a` on(`p`.`id_anggota` = `a`.`id_anggota`)) join `buku` `b` on(`p`.`id_buku` = `b`.`id_buku`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id_anggota`),
  ADD UNIQUE KEY `nim` (`nim`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`),
  ADD UNIQUE KEY `kode_buku` (`kode_buku`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_anggota` (`id_anggota`),
  ADD KEY `id_buku` (`id_buku`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `id_anggota` (`id_anggota`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id_anggota` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`id_anggota`) REFERENCES `anggota` (`id_anggota`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
