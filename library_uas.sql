-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 03, 2020 at 01:22 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_uas`
--

-- --------------------------------------------------------

--
-- Table structure for table `anggota`
--

CREATE TABLE `anggota` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT 'image-default-anggota.png',
  `nisn` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `tanggal_daftar` datetime NOT NULL DEFAULT current_timestamp(),
  `no_hp` varchar(30) NOT NULL,
  `jenis_kelamin_id` int(11) NOT NULL,
  `anggota_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota`
--

INSERT INTO `anggota` (`id`, `nama_lengkap`, `gambar`, `nisn`, `password`, `tanggal_masuk`, `tanggal_daftar`, `no_hp`, `jenis_kelamin_id`, `anggota_status_id`) VALUES
(1, 'Rahmad Firmansyah', '5ecf5c00e3830.png', '12639816249162', '123', '2020-05-26', '2020-05-26 00:00:00', '08123456789', 1, 2),
(2, 'Adji Susanto', 'image-default-anggota.png', '92836478367282', '101', '2020-05-27', '2020-05-27 00:00:00', '0853782983382', 1, 2),
(3, 'Ratna Siregar', 'image-default-anggota.png', '29384627839482', '098', '2020-05-26', '2020-05-26 00:15:16', '0895287615892', 2, 1),
(4, 'Arif Rahmanto S.', 'image-default-anggota.png', '9273847283921', '273', '2020-05-04', '2020-05-01 00:00:00', '0895298317826', 1, 1),
(5, 'M. Abdul Rozak', 'image-default-anggota.png', '82937894618293', '283', '2020-04-29', '2020-05-13 00:18:24', '081678352938', 1, 2),
(7, 'Sueb', '5ed343611b1a3.png', '1212412947', '123', '2020-05-31', '2020-06-07 00:00:00', '12413513513', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `anggota_status`
--

CREATE TABLE `anggota_status` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `anggota_status`
--

INSERT INTO `anggota_status` (`id`, `nama_status`) VALUES
(1, 'Aktif'),
(2, 'Tidak Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(255) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL,
  `kode_buku` varchar(255) NOT NULL,
  `overview_buku` varchar(255) NOT NULL,
  `penulis_buku` varchar(255) NOT NULL,
  `penerbit_buku` varchar(255) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `stok` int(11) NOT NULL,
  `rak_id` int(11) NOT NULL,
  `kategori_buku_id` int(11) NOT NULL,
  `tanggal_input` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `gambar`, `kode_buku`, `overview_buku`, `penulis_buku`, `penerbit_buku`, `tanggal_terbit`, `stok`, `rak_id`, `kategori_buku_id`, `tanggal_input`) VALUES
(1, 'Naruto', '', '0001 NRT', 'Naruto Merupakan Ninja yang tumbuh dna besar sendiri', 'fimansyahaha', 'firmansyahaha', '2020-05-28', 5, 1, 3, '2020-05-27'),
(2, 'Psikologi Sosial', '', '0002 Psikologi', 'Bagaimana memahami psikologi dalam interaksi di masyarakat.', 'Olivia Silvi', 'Mizan', '2020-05-28', 2, 2, 2, '2020-05-27'),
(3, 'Laskar Pelangi', '', '0003 Fiksi', 'Buku ini menceritakan tentang kehidpuan 10 anak dari keluaga miskin', 'Andrea Hirata', 'Andi Publisher', '2020-05-11', 2, 3, 1, '2020-05-27'),
(4, 'Bahasa Pemrograman Java', '5ecfcbed89b36.png', '0004 Pemro', 'Beelajar dan memahami bagaimana penggunaan dan implementasi code dalam bahasa pemrograman java', 'Eiichiro Oda', 'Shueisha', '2020-05-03', 2, 5, 5, '2020-05-27'),
(20, 'Cara membuat ERD', '5ecfa74d97874.jpg', '0009 ERD', 'ERD merupakan hal yang penting dalam sistem basisdata', 'Firmansyah', 'Firman Production', '1960-02-02', 1, 1, 1, '2020-05-28');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_kelamin`
--

CREATE TABLE `jenis_kelamin` (
  `id` int(11) NOT NULL,
  `nama_jenis` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_kelamin`
--

INSERT INTO `jenis_kelamin` (`id`, `nama_jenis`) VALUES
(1, 'Laki - Laki'),
(2, 'Perempuan');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_buku`
--

CREATE TABLE `kategori_buku` (
  `id` int(11) NOT NULL,
  `nama_kategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_buku`
--

INSERT INTO `kategori_buku` (`id`, `nama_kategori`) VALUES
(1, 'Fiksi'),
(2, 'Sosial'),
(3, 'Komik'),
(4, 'Ilmu Pengetahuan Alam'),
(5, 'Bahasa Pemrograman');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_rak`
--

CREATE TABLE `lokasi_rak` (
  `id` int(11) NOT NULL,
  `nama_lokasi` varchar(100) NOT NULL,
  `detail_lokasi` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi_rak`
--

INSERT INTO `lokasi_rak` (`id`, `nama_lokasi`, `detail_lokasi`) VALUES
(1, 'Ruang 1', 'Dekat Perpustakaan'),
(2, 'Ruang 2 Lantai 3', 'Perpustakaan Lantai 2'),
(3, 'Ruang 3 Lantai 2', 'Perpustakaan Lantai 4');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id` int(11) NOT NULL,
  `tanggal_pinjam` date NOT NULL,
  `tanggal_kembali` date NOT NULL,
  `buku_id` int(11) NOT NULL,
  `anggota_id` int(11) NOT NULL,
  `petugas_id` int(11) NOT NULL,
  `status_peminjaman_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id`, `tanggal_pinjam`, `tanggal_kembali`, `buku_id`, `anggota_id`, `petugas_id`, `status_peminjaman_id`) VALUES
(6, '2020-01-01', '2020-06-15', 1, 1, 3, 2),
(10, '2020-03-11', '2020-05-27', 1, 3, 3, 2),
(11, '2020-04-15', '2020-05-29', 1, 3, 2, 2),
(13, '2020-06-10', '2020-06-27', 3, 2, 3, 1),
(15, '2020-06-19', '2020-06-26', 1, 3, 3, 1),
(16, '2020-05-15', '2020-06-19', 1, 3, 3, 2),
(17, '2020-05-22', '2020-06-18', 3, 3, 2, 1),
(18, '2020-09-26', '2020-07-06', 3, 4, 3, 1),
(19, '2020-06-10', '2020-06-25', 4, 1, 4, 1),
(20, '2020-06-17', '2020-06-29', 4, 1, 4, 1),
(21, '2020-06-13', '2020-06-18', 4, 1, 5, 1),
(22, '2020-06-04', '2020-06-11', 3, 1, 5, 1),
(23, '2020-06-11', '2020-06-25', 1, 2, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id` int(11) NOT NULL,
  `peminjaman_id` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id`, `peminjaman_id`, `tanggal_pengembalian`, `denda`) VALUES
(26, 6, '2020-06-11', 0),
(27, 11, '2020-06-04', 3000),
(28, 10, '2020-06-25', 14500),
(29, 16, '2020-06-11', 0);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id` int(11) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT 'image-default-anggota.png',
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `no_hp` varchar(20) NOT NULL,
  `tanggal_buat` date NOT NULL,
  `jenis_kelamin_id` int(11) NOT NULL,
  `petugas_role_id` int(11) NOT NULL,
  `anggota_status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id`, `nama_lengkap`, `gambar`, `username`, `password`, `no_hp`, `tanggal_buat`, `jenis_kelamin_id`, `petugas_role_id`, `anggota_status_id`) VALUES
(1, 'Bambang Santoso', '5ed40aabc0202.png', 'bambang', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '08123124124', '2020-05-26', 1, 1, 1),
(2, 'Febria Erliana', '5ed779c30ce5d.jpg', 'febi', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '089652835728', '2020-05-01', 2, 2, 1),
(3, 'Budi Ismail Q.', 'image-default-anggota.png', 'Budi', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '0825374893827', '2020-05-11', 1, 2, 1),
(4, '123124', 'image-default-anggota.png', 'Sueb', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '08123124124', '2020-05-26', 1, 1, 1),
(5, 'Yono', '5ed36129c6d0e.png', 'yon', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '08123412412', '2020-05-14', 1, 1, 1),
(6, 'Yayuk', '5ed75a902968e.jpg', 'yayuks', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '08123412412', '2020-06-12', 2, 1, 1),
(7, 'Ardi', '5ed75ef0e6d53.jpg', 'ardi', '$2y$10$BL7drx7RdYO4MuWDpndGbe1YCs4FswcWs0KUkhT6AccSdAjg0O3Ry', '08123412412', '2020-06-05', 1, 2, 1),
(8, 'Admin Mikrolibrary', '5ed7720b6c343.jpg', 'admin', '$2y$10$aQNmfQoYFtfsGxDeH3UDnejiJEzSlgdLf0dfQOEeRPtXG2GOv9YyS', '08721381624', '2020-06-03', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `petugas_role`
--

CREATE TABLE `petugas_role` (
  `id` int(11) NOT NULL,
  `nama_role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas_role`
--

INSERT INTO `petugas_role` (`id`, `nama_role`) VALUES
(1, 'Admin'),
(2, 'Operator');

-- --------------------------------------------------------

--
-- Table structure for table `rak`
--

CREATE TABLE `rak` (
  `id` int(11) NOT NULL,
  `nama_rak` varchar(100) NOT NULL,
  `lokasi_rak_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rak`
--

INSERT INTO `rak` (`id`, `nama_rak`, `lokasi_rak_id`) VALUES
(1, 'RAK A', 1),
(2, 'RAK 2C', 3),
(3, 'RAK 2B', 3),
(4, 'RAK 6A', 2),
(5, 'RAK 3A', 2);

-- --------------------------------------------------------

--
-- Table structure for table `status_peminjaman`
--

CREATE TABLE `status_peminjaman` (
  `id` int(11) NOT NULL,
  `nama_status` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `status_peminjaman`
--

INSERT INTO `status_peminjaman` (`id`, `nama_status`) VALUES
(1, 'Menunggu'),
(2, 'Selesai');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nisn` (`nisn`),
  ADD KEY `anggota_to_jenisKelamin` (`jenis_kelamin_id`),
  ADD KEY `anggota_to_anggotaStatus` (`anggota_status_id`);

--
-- Indexes for table `anggota_status`
--
ALTER TABLE `anggota_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`),
  ADD KEY `buku_to_kategoriBuku` (`kategori_buku_id`),
  ADD KEY `buku_to_rak` (`rak_id`);

--
-- Indexes for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lokasi_rak`
--
ALTER TABLE `lokasi_rak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id`),
  ADD KEY `peminjaman_to_buku` (`buku_id`),
  ADD KEY `peminjaman_to_petugas` (`petugas_id`),
  ADD KEY `peminjaman_to_anggota` (`anggota_id`),
  ADD KEY `peminjaman_to_status` (`status_peminjaman_id`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `penngembalian_to_peminjaman` (`peminjaman_id`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `petugas_to_petugasRole` (`petugas_role_id`),
  ADD KEY `petugas_to_jenisKelamin` (`jenis_kelamin_id`),
  ADD KEY `petugas_to_anggotaStatus` (`anggota_status_id`);

--
-- Indexes for table `petugas_role`
--
ALTER TABLE `petugas_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rak`
--
ALTER TABLE `rak`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rak_to_lokasiRak` (`lokasi_rak_id`);

--
-- Indexes for table `status_peminjaman`
--
ALTER TABLE `status_peminjaman`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `anggota_status`
--
ALTER TABLE `anggota_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `jenis_kelamin`
--
ALTER TABLE `jenis_kelamin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kategori_buku`
--
ALTER TABLE `kategori_buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `lokasi_rak`
--
ALTER TABLE `lokasi_rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `petugas_role`
--
ALTER TABLE `petugas_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `rak`
--
ALTER TABLE `rak`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `status_peminjaman`
--
ALTER TABLE `status_peminjaman`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `anggota`
--
ALTER TABLE `anggota`
  ADD CONSTRAINT `anggota_to_anggotaStatus` FOREIGN KEY (`anggota_status_id`) REFERENCES `anggota_status` (`id`),
  ADD CONSTRAINT `anggota_to_jenisKelamin` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `jenis_kelamin` (`id`);

--
-- Constraints for table `buku`
--
ALTER TABLE `buku`
  ADD CONSTRAINT `buku_to_kategoriBuku` FOREIGN KEY (`kategori_buku_id`) REFERENCES `kategori_buku` (`id`),
  ADD CONSTRAINT `buku_to_rak` FOREIGN KEY (`rak_id`) REFERENCES `rak` (`id`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_to_anggota` FOREIGN KEY (`anggota_id`) REFERENCES `anggota` (`id`),
  ADD CONSTRAINT `peminjaman_to_buku` FOREIGN KEY (`buku_id`) REFERENCES `buku` (`id`),
  ADD CONSTRAINT `peminjaman_to_petugas` FOREIGN KEY (`petugas_id`) REFERENCES `petugas` (`id`),
  ADD CONSTRAINT `peminjaman_to_status` FOREIGN KEY (`status_peminjaman_id`) REFERENCES `status_peminjaman` (`id`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `penngembalian_to_peminjaman` FOREIGN KEY (`peminjaman_id`) REFERENCES `peminjaman` (`id`);

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_to_anggotaStatus` FOREIGN KEY (`anggota_status_id`) REFERENCES `anggota_status` (`id`),
  ADD CONSTRAINT `petugas_to_jenisKelamin` FOREIGN KEY (`jenis_kelamin_id`) REFERENCES `jenis_kelamin` (`id`),
  ADD CONSTRAINT `petugas_to_petugasRole` FOREIGN KEY (`petugas_role_id`) REFERENCES `petugas_role` (`id`);

--
-- Constraints for table `rak`
--
ALTER TABLE `rak`
  ADD CONSTRAINT `rak_to_lokasiRak` FOREIGN KEY (`lokasi_rak_id`) REFERENCES `lokasi_rak` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
