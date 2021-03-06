-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 06 Mar 2021 pada 06.40
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spp`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(10) NOT NULL,
  `kompetensi_keahlian` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`, `kompetensi_keahlian`) VALUES
(1, 'XII RPL 3', 'Rekayasa Perangkat Lunak'),
(2, 'XII RPL 2', 'Rekayasa Perangkat Lunak'),
(3, 'XII RPL 1', 'Rekayasa Perangkat Lunak'),
(4, 'XII TKJ 3', 'Teknik Komputer dan Jaringan'),
(5, 'XII TKJ 2', 'Teknik Komputer dan Jaringan'),
(6, 'XII TKJ 1', 'Teknik Komputer dan Jaringan'),
(7, 'XII TEI 3', 'Teknik Elektronika Industri'),
(8, 'XII TEI 2', 'Teknik Elektronika Industri'),
(9, 'XII TEI 1', 'Teknik Elektronika Industri'),
(10, 'XII TKR 3', 'Teknik Kendarangan Ringan'),
(11, 'XII TKR 2', 'Teknik Kendarangan Ringan'),
(12, 'XII TKR 1', 'Teknik Kendarangan Ringan'),
(13, 'XII TSM 3', 'Teknik Sepeda Motor'),
(14, 'XII TSM 2', 'Teknik Sepeda Motor'),
(15, 'XII TSM 1', 'Teknik Sepeda Motor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran`
--

CREATE TABLE `pembayaran` (
  `id` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `nisn` int(10) NOT NULL,
  `tanggal_bayar` date NOT NULL,
  `bulan_dibayar` varchar(10) NOT NULL,
  `tahun_dibayar` varchar(4) NOT NULL,
  `id_spp` int(11) NOT NULL,
  `jumlah_bayar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_petugas`, `nisn`, `tanggal_bayar`, `bulan_dibayar`, `tahun_dibayar`, `id_spp`, `jumlah_bayar`) VALUES
(15, 22, 12332111, '2021-03-04', 'Februari', '2020', 5, 110000),
(18, 26, 78392758, '2021-03-04', 'Januari', '2020', 5, 110000),
(19, 26, 78392758, '2021-03-04', 'Februari', '2020', 5, 110000),
(20, 26, 78392758, '2021-03-04', 'Maret', '2020', 5, 110000),
(21, 27, 24147561, '2021-03-04', 'Januari', '2021', 6, 100000),
(22, 27, 24147561, '2021-03-04', 'Februari', '2021', 6, 100000),
(23, 27, 24147561, '2021-03-04', 'Maret', '2021', 6, 100000),
(24, 27, 24147561, '2021-03-04', 'April', '2021', 6, 100000),
(25, 24, 24147561, '2021-03-04', 'Mei', '2021', 6, 100000),
(26, 24, 24147561, '2021-03-04', 'Juni', '2021', 6, 100000),
(27, 24, 24147561, '2021-03-04', 'Juli', '2021', 6, 150000),
(28, 22, 12332111, '2021-03-04', 'Maret', '2020', 5, 120000),
(29, 28, 75984011, '2021-03-04', 'Januari', '2020', 5, 110000),
(30, 22, 12332111, '2021-03-05', 'Januari', '2020', 5, 110000),
(31, 22, 12332111, '2021-03-05', 'April', '2020', 5, 110000),
(32, 22, 12332111, '2021-03-05', 'Mei', '2020', 5, 110000),
(33, 22, 12332111, '2021-03-05', 'Juni', '2020', 5, 110000),
(34, 22, 12332111, '2021-03-05', 'Juli', '2020', 5, 110000),
(35, 22, 12332111, '2021-03-05', 'Agustus', '2020', 5, 110000),
(36, 22, 12332111, '2021-03-05', 'September', '2020', 5, 110000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengguna`
--

CREATE TABLE `pengguna` (
  `id` int(11) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `email` varchar(25) NOT NULL,
  `kata_sandi` varchar(50) NOT NULL,
  `tingkat` enum('admin','petugas','siswa') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pengguna`
--

INSERT INTO `pengguna` (`id`, `nama`, `email`, `kata_sandi`, `tingkat`) VALUES
(19, 'Ardi', 'ardi@gmail.com', 'ardi', 'admin'),
(20, 'Alvian', 'alvian@gmail.com', 'alvian', 'petugas'),
(22, 'Rifad', 'rifad@gmail.com', 'rifad', 'petugas'),
(24, 'Hakim', 'hakim@gmail.com', 'hakim', 'petugas'),
(25, 'Citra', 'citra@gmail.com', 'citra', 'petugas'),
(26, 'Desyana', 'desyana@gmail.com', 'desyana', 'petugas'),
(27, 'Alifia', 'alifia@gmail.com', 'alifia', 'petugas'),
(28, 'Revi', 'revi@gmail.com', 'revi', 'petugas'),
(29, 'Dhela', 'dhela@gmail.com', 'dhela', 'petugas'),
(30, 'Dewangga', 'dewangga@gmail.com', 'dewangga', 'petugas'),
(37, 'Budi', 'budi@gmail.com', 'budi', 'petugas');

-- --------------------------------------------------------

--
-- Struktur dari tabel `siswa`
--

CREATE TABLE `siswa` (
  `nisn` bigint(10) NOT NULL,
  `nis` bigint(8) NOT NULL,
  `nama` varchar(35) NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `alamat` text NOT NULL,
  `no_telepon` bigint(12) NOT NULL,
  `id_spp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `siswa`
--

INSERT INTO `siswa` (`nisn`, `nis`, `nama`, `id_kelas`, `alamat`, `no_telepon`, `id_spp`) VALUES
(12332111, 9812, 'Ilsa Puspita', 3, 'Kpg. Flora No. 755, Malang 92603, PapBar', 39326348816, 5),
(14729057, 1821, 'Diana Gunarto', 8, 'Gg. Bank Dagang Negara No. 668, Binjai 63026, NTT', 86910662034, 6),
(18672619, 9890, 'Sadina Setiawan', 2, 'Gg. Rumah Sakit No. 599, Tanjung Pinang 87325, DIY', 52807758784, 6),
(24147561, 9071, 'Endah Haryanti', 5, 'Psr. Kusmanto No. 750, Sawahlunto 43438, PapBar', 5804149093, 6),
(27185739, 9872, 'Wani Sinaga', 2, 'Jln. Pasir Koja No. 212, Yogyakarta', 65403053189, 6),
(39175021, 2352, 'Violet Santoso', 4, 'Gg. Bahagia No. 75, Palembang 26747, Gorontalo', 37856634861, 6),
(43148693, 9724, 'Niyaga Rajasa', 10, 'Ki. Panjaitan No. 712, Administrasi Jakarta Pusat 39996, Gorontalo', 5956322631, 6),
(49185028, 12412, 'Jais Lestari', 3, 'Kpg. Rumah Sakit No. 813, Pasuruan 67771, NTT', 57544079901, 6),
(57392710, 1218, 'Naradi Hartati', 2, 'Jln. Qrisdoren No. 334, Bandar Lampung 83077, DKI', 6541203645, 6),
(58915784, 5231, 'Ellis Nababan', 8, 'Ki. Basuki No. 612, Pagar Alam 14862, BaBel', 9599369046, 6),
(65819521, 9832, 'Jarwi Hartati', 10, 'Psr. Cikutra Timur No. 638, Pekanbaru 22486, JaBar', 48454401612, 6),
(70341758, 7912, 'Elisa Namaga', 6, 'Ki. Sadang Serang No. 316, Administrasi Jakarta Barat 17496, NTB', 29161407712, 5),
(75937147, 1282, 'Kala Astuti', 7, 'Jln. Sudirman No. 749, Tarakan 98029, KepR', 93186550537, 6),
(75984011, 2423, 'Garang Firmansyah', 12, 'Jr. Sukajadi No. 133, Kotamobagu 99014, SumUt', 8496851921, 5),
(78392758, 5212, 'Estiawan Nuraini', 3, 'Kpg. Teuku Umar No. 324, Pariaman 40566', 81859523150, 5),
(79834756, 1723, 'Halima Simanjuntak', 6, 'Jr. Bakti No. 772, Pangkal Pinang 41314, Banten', 97414603867, 6),
(90245679, 5621, 'Daryani Oktaviani', 1, 'Psr. Kiaracondong No. 467, Gunungsitoli 45186, JaTim', 7281999039, 6),
(97561042, 4531, 'Padma Kurniawan', 15, 'Jln. R.M. Said No. 83, Binjai 40484, SulBar', 52287844841, 6),
(98371657, 5341, 'Siska Yolanda', 8, 'Jln. Qrisdoren No. 103, Batam 33985, JaTim', 8021685880, 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `spp`
--

CREATE TABLE `spp` (
  `id` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `nominal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `spp`
--

INSERT INTO `spp` (`id`, `tahun`, `nominal`) VALUES
(1, 2018, 110000),
(2, 2019, 110000),
(5, 2020, 110000),
(6, 2021, 100000),
(7, 2015, 100000),
(8, 2016, 100000),
(9, 2017, 100000),
(10, 2014, 100000),
(11, 2013, 100000),
(12, 2012, 90000),
(13, 2011, 90000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nisn`);

--
-- Indeks untuk tabel `spp`
--
ALTER TABLE `spp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nisn` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=824123522;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
