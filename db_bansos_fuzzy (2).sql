-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 30, 2026 at 05:41 PM
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
-- Database: `db_bansos_fuzzy`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_fuzzy`
--

CREATE TABLE `detail_fuzzy` (
  `id_detail` int(11) NOT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `kategori_fuzzy` varchar(50) DEFAULT NULL,
  `mu_rendah` decimal(5,2) DEFAULT NULL,
  `mu_sedang` decimal(5,2) DEFAULT NULL,
  `mu_tinggi` decimal(5,2) DEFAULT NULL,
  `alpha` decimal(5,2) DEFAULT NULL,
  `hasil_rule` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `detail_fuzzy`
--

INSERT INTO `detail_fuzzy` (`id_detail`, `id_penduduk`, `nama_kriteria`, `nilai`, `kategori_fuzzy`, `mu_rendah`, `mu_sedang`, `mu_tinggi`, `alpha`, `hasil_rule`, `created_at`) VALUES
(17, 1, 'Aset', 200, 'Rendah', 0.00, 0.00, 1.00, NULL, NULL, '2026-06-30 07:29:59'),
(18, 1, 'Pekerjaan', 100, 'Tinggi', 0.00, 1.00, 0.00, NULL, NULL, '2026-06-30 07:29:59'),
(19, 5, 'Aset', 150, 'Rendah', 0.00, 0.00, 0.50, NULL, NULL, '2026-06-30 07:29:59'),
(20, 3, 'Rumah', 40, 'Sedang', 0.60, 0.00, 0.00, NULL, NULL, '2026-06-30 07:29:59'),
(21, 2, 'Kondisi Lantai Rumah', 80, 'Rendah', 0.20, 0.60, 0.00, NULL, NULL, '2026-06-30 07:29:59');

-- --------------------------------------------------------

--
-- Table structure for table `fuzzy_membership`
--

CREATE TABLE `fuzzy_membership` (
  `id_membership` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nama_himpunan` varchar(50) DEFAULT NULL,
  `nilai_min` int(11) DEFAULT NULL,
  `nilai_tengah` int(11) DEFAULT NULL,
  `nilai_max` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hasil_seleksi`
--

CREATE TABLE `hasil_seleksi` (
  `id_hasil` int(11) NOT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `nilai_akhir` decimal(5,2) DEFAULT NULL,
  `status_kelayakan` varchar(50) DEFAULT NULL,
  `keterangan` text DEFAULT NULL,
  `tanggal_cetak` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hasil_seleksi`
--

INSERT INTO `hasil_seleksi` (`id_hasil`, `id_penduduk`, `nilai_akhir`, `status_kelayakan`, `keterangan`, `tanggal_cetak`) VALUES
(1, 1, 150.00, 'Sangat Layak', 'Memenuhi seluruh kriteria bantuan sosial', '2026-06-30'),
(2, 2, 80.00, 'Sangat Layak', 'Memenuhi seluruh kriteria bantuan sosial', '2026-06-30'),
(3, 3, 40.00, 'Kurang Layak', 'Masih perlu pertimbangan', '2026-06-30'),
(4, 5, 150.00, 'Sangat Layak', 'Memenuhi seluruh kriteria bantuan sosial', '2026-06-30'),
(5, 4, 0.00, 'Tidak Layak', 'Tidak memenuhi kriteria', '2026-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `import_excel`
--

CREATE TABLE `import_excel` (
  `id_import` int(11) NOT NULL,
  `nama_file` varchar(100) DEFAULT NULL,
  `jumlah_data` int(11) DEFAULT NULL,
  `tanggal_import` date DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kriteria`
--

CREATE TABLE `kriteria` (
  `id_kriteria` int(11) NOT NULL,
  `nama_kriteria` varchar(100) DEFAULT NULL,
  `kode_kriteria` varchar(10) DEFAULT NULL,
  `bobot` decimal(5,2) DEFAULT NULL,
  `tipe` varchar(20) DEFAULT NULL,
  `keterangan` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kriteria`
--

INSERT INTO `kriteria` (`id_kriteria`, `nama_kriteria`, `kode_kriteria`, `bobot`, `tipe`, `keterangan`) VALUES
(1, 'Aset', 'C1', 15.00, 'Benefit', 'Nilai kepemilikan aset keluarga'),
(2, 'Rumah', 'C2', 15.00, 'Cost', 'Kondisi tempat tinggal'),
(3, 'Kondisi Lantai Rumah', 'C3', 10.00, 'Cost', 'Jenis dan kondisi lantai rumah'),
(4, 'Kondisi Dinding Rumah', 'C4', 10.00, 'Cost', 'Jenis dan kondisi dinding rumah'),
(5, 'Kepemilikan Rumah', 'C5', 10.00, 'Cost', 'Status kepemilikan rumah'),
(6, 'Pekerjaan', 'C6', 10.00, 'Cost', 'Jenis pekerjaan kepala keluarga'),
(7, 'Penghasilan', 'C7', 15.00, 'Cost', 'Jumlah penghasilan keluarga'),
(8, 'Tanggungan', 'C8', 10.00, 'Benefit', 'Jumlah anggota keluarga yang ditanggung'),
(9, 'Syarat Lain', 'C9', 5.00, 'Benefit', 'Faktor tambahan penerima bantuan'),
(10, 'umur', 'c98', 40.00, 'Benefit', 'muda,parubaya,tua'),
(12, 'penghasilan', 'c15', 20.00, 'Benefit', 'pendapatan perbulan');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penduduk`
--

CREATE TABLE `penduduk` (
  `id_penduduk` int(11) NOT NULL,
  `nik` varchar(20) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `jenis_kelamin` enum('Laki-laki','Perempuan') DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `desa` varchar(100) DEFAULT NULL,
  `kecamatan` varchar(100) DEFAULT NULL,
  `pekerjaan` varchar(100) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penduduk`
--

INSERT INTO `penduduk` (`id_penduduk`, `nik`, `nama`, `jenis_kelamin`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `desa`, `kecamatan`, `pekerjaan`, `no_hp`, `created_at`) VALUES
(1, '320209080801009', 'eli putra zalukhu', 'Laki-laki', 'medan', '2000-10-07', 'jln.imam bonjol link.II', 'cemara', 'lubuk pakam', 'mahasiswa', '082278205711', '2026-06-28 16:18:58'),
(2, '1204150710000002', 'zaluhku', 'Laki-laki', 'lolofaoso', '2000-07-31', 'jln.imam bonjol link.II', 'cemara', 'lubuk pakam', 'mahasiswa', '082278205711', '2026-06-28 16:23:24'),
(3, '3202090808010888', 'Lira Barus', 'Perempuan', 'medan', '1998-02-11', 'jln.imam bonjol link.II', 'cemara', 'lubuk pakam', 'buruh', '082278205718', '2026-06-28 23:16:25'),
(4, '320254308010888', 'nias', 'Laki-laki', 'medan', '1998-02-11', 'hbaer sngdm', 'cemara', 'lubuk pakam', 'buruh', '082278205718', '2026-06-29 14:36:53'),
(5, '1209340910000007', 'iman', 'Laki-laki', 'medan', '1995-10-26', 'jln. medan', 'cemara', 'lubuk pakam', 'petani', '087965764324', '2026-06-29 14:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `penilaian`
--

CREATE TABLE `penilaian` (
  `id_penilaian` int(11) NOT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `id_sub` int(11) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `tanggal_penilaian` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `penilaian`
--

INSERT INTO `penilaian` (`id_penilaian`, `id_penduduk`, `id_kriteria`, `id_sub`, `nilai`, `tanggal_penilaian`) VALUES
(1, 1, 1, 1, 200, '2026-06-28'),
(2, 2, 3, 1, 80, '2026-06-29'),
(3, 3, 2, 3, 40, '2026-06-29'),
(4, 5, 1, 7, 150, '2026-06-29'),
(5, 1, 6, 14, 100, '2026-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `proses_fuzzy`
--

CREATE TABLE `proses_fuzzy` (
  `id_proses` int(11) NOT NULL,
  `id_penduduk` int(11) DEFAULT NULL,
  `nilai_fuzzy` decimal(5,2) DEFAULT NULL,
  `kategori` varchar(50) DEFAULT NULL,
  `tanggal_proses` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proses_fuzzy`
--

INSERT INTO `proses_fuzzy` (`id_proses`, `id_penduduk`, `nilai_fuzzy`, `kategori`, `tanggal_proses`) VALUES
(1, 1, 0.00, 'Tidak Layak', '2026-06-29'),
(2, 1, 0.00, 'Tidak Layak', '2026-06-29');

-- --------------------------------------------------------

--
-- Table structure for table `rule_fuzzy`
--

CREATE TABLE `rule_fuzzy` (
  `id_rule` int(11) NOT NULL,
  `aset` varchar(50) DEFAULT NULL,
  `rumah` varchar(50) DEFAULT NULL,
  `lantai` varchar(50) DEFAULT NULL,
  `dinding` varchar(50) DEFAULT NULL,
  `kepemilikan` varchar(50) DEFAULT NULL,
  `pekerjaan` varchar(50) DEFAULT NULL,
  `penghasilan` varchar(50) DEFAULT NULL,
  `tanggungan` varchar(50) DEFAULT NULL,
  `syarat_lain` varchar(50) DEFAULT NULL,
  `hasil` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rule_fuzzy`
--

INSERT INTO `rule_fuzzy` (`id_rule`, `aset`, `rumah`, `lantai`, `dinding`, `kepemilikan`, `pekerjaan`, `penghasilan`, `tanggungan`, `syarat_lain`, `hasil`) VALUES
(1, 'Rendah', 'Rendah', 'Rendah', 'Rendah', 'Rendah', 'Rendah', 'Rendah', 'Rendah', 'Rendah', 'Sangat Layak'),
(2, 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Sedang', 'Tidak Layak'),
(3, 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tinggi', 'Tidak Layak'),
(4, 'Sedang', 'Sedang', 'Rendah', 'Rendah', 'Tinggi', 'Tinggi', 'Sedang', 'Rendah', 'Tinggi', 'Kurang Layak');

-- --------------------------------------------------------

--
-- Table structure for table `sub_kriteria`
--

CREATE TABLE `sub_kriteria` (
  `id_sub` int(11) NOT NULL,
  `id_kriteria` int(11) DEFAULT NULL,
  `nama_sub` varchar(100) DEFAULT NULL,
  `nilai` int(11) DEFAULT NULL,
  `kategori_fuzzy` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_kriteria`
--

INSERT INTO `sub_kriteria` (`id_sub`, `id_kriteria`, `nama_sub`, `nilai`, `kategori_fuzzy`) VALUES
(1, 5, 'milik sendiri', 200, 'Rendah'),
(2, 6, 'tidak tetap', 30, 'Rendah'),
(3, 2, 'milik orang tua', 20, 'Sedang'),
(4, 2, 'sewa', 20, 'Rendah'),
(5, 8, 'banyak', 50, 'Tinggi'),
(6, 1, 'tidak memiliki', 200, 'Rendah'),
(7, 1, 'sedikit', 150, 'Rendah'),
(8, 1, 'cukup', 100, 'Sedang'),
(9, 1, 'banyak', 50, 'Tinggi'),
(10, 8, '> 6 orang', 200, 'Rendah'),
(11, 8, '> 4 orang', 150, 'Rendah'),
(12, 8, '2-3', 100, 'Sedang'),
(13, 8, '1 orang', 50, 'Tinggi'),
(14, 8, 'tidak ada', 0, 'Tinggi'),
(15, 12, '3.000.000/bulan', 50, 'Sedang'),
(16, 7, '6.000.000', 100, 'Tinggi');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(20) DEFAULT 'admin',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `nama`, `username`, `password`, `role`, `created_at`) VALUES
(1, 'Administrator', 'admin', '0192023a7bbd73250516f069df18b500', 'admin', '2026-06-27 19:21:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_fuzzy`
--
ALTER TABLE `detail_fuzzy`
  ADD PRIMARY KEY (`id_detail`);

--
-- Indexes for table `fuzzy_membership`
--
ALTER TABLE `fuzzy_membership`
  ADD PRIMARY KEY (`id_membership`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `hasil_seleksi`
--
ALTER TABLE `hasil_seleksi`
  ADD PRIMARY KEY (`id_hasil`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `import_excel`
--
ALTER TABLE `import_excel`
  ADD PRIMARY KEY (`id_import`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `kriteria`
--
ALTER TABLE `kriteria`
  ADD PRIMARY KEY (`id_kriteria`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `penduduk`
--
ALTER TABLE `penduduk`
  ADD PRIMARY KEY (`id_penduduk`),
  ADD UNIQUE KEY `nik` (`nik`);

--
-- Indexes for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD PRIMARY KEY (`id_penilaian`),
  ADD KEY `id_penduduk` (`id_penduduk`),
  ADD KEY `id_kriteria` (`id_kriteria`),
  ADD KEY `id_sub` (`id_sub`);

--
-- Indexes for table `proses_fuzzy`
--
ALTER TABLE `proses_fuzzy`
  ADD PRIMARY KEY (`id_proses`),
  ADD KEY `id_penduduk` (`id_penduduk`);

--
-- Indexes for table `rule_fuzzy`
--
ALTER TABLE `rule_fuzzy`
  ADD PRIMARY KEY (`id_rule`);

--
-- Indexes for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD PRIMARY KEY (`id_sub`),
  ADD KEY `id_kriteria` (`id_kriteria`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_fuzzy`
--
ALTER TABLE `detail_fuzzy`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `fuzzy_membership`
--
ALTER TABLE `fuzzy_membership`
  MODIFY `id_membership` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hasil_seleksi`
--
ALTER TABLE `hasil_seleksi`
  MODIFY `id_hasil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `import_excel`
--
ALTER TABLE `import_excel`
  MODIFY `id_import` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kriteria`
--
ALTER TABLE `kriteria`
  MODIFY `id_kriteria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `penduduk`
--
ALTER TABLE `penduduk`
  MODIFY `id_penduduk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `penilaian`
--
ALTER TABLE `penilaian`
  MODIFY `id_penilaian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `proses_fuzzy`
--
ALTER TABLE `proses_fuzzy`
  MODIFY `id_proses` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rule_fuzzy`
--
ALTER TABLE `rule_fuzzy`
  MODIFY `id_rule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  MODIFY `id_sub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fuzzy_membership`
--
ALTER TABLE `fuzzy_membership`
  ADD CONSTRAINT `fuzzy_membership_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);

--
-- Constraints for table `hasil_seleksi`
--
ALTER TABLE `hasil_seleksi`
  ADD CONSTRAINT `hasil_seleksi_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`);

--
-- Constraints for table `import_excel`
--
ALTER TABLE `import_excel`
  ADD CONSTRAINT `import_excel_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`);

--
-- Constraints for table `penilaian`
--
ALTER TABLE `penilaian`
  ADD CONSTRAINT `penilaian_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`),
  ADD CONSTRAINT `penilaian_ibfk_2` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`),
  ADD CONSTRAINT `penilaian_ibfk_3` FOREIGN KEY (`id_sub`) REFERENCES `sub_kriteria` (`id_sub`);

--
-- Constraints for table `proses_fuzzy`
--
ALTER TABLE `proses_fuzzy`
  ADD CONSTRAINT `proses_fuzzy_ibfk_1` FOREIGN KEY (`id_penduduk`) REFERENCES `penduduk` (`id_penduduk`);

--
-- Constraints for table `sub_kriteria`
--
ALTER TABLE `sub_kriteria`
  ADD CONSTRAINT `sub_kriteria_ibfk_1` FOREIGN KEY (`id_kriteria`) REFERENCES `kriteria` (`id_kriteria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
