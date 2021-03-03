-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Mar 2021 pada 10.14
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
-- Database: `db_spp_88`
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
(7, 'X RPL 3', 'Rekayasa Perangkat Lunak'),
(8, 'X RPL 2', 'Rekayasa Perangkat Lunak'),
(9, 'X RPL 1', 'Rekayasa Perangkat Lunak'),
(12, 'X TI 1', 'Teknik Industri'),
(13, 'X TI 2', 'Teknik Industri'),
(14, 'X TI 3', 'Teknik Industri'),
(15, 'X TO 1', 'Teknik Otomotif'),
(16, 'X TO 2', 'Teknik Otomotif'),
(17, 'X TO 3', 'Teknik Otomotif'),
(18, 'X TE 1', 'Teknik Elektronika'),
(19, 'X TE 2', 'Teknik Elektronika'),
(20, 'X TE 3', 'Teknik Elektronika');

-- --------------------------------------------------------

--
-- Struktur dari tabel `nisn`
--

CREATE TABLE `nisn` (
  `id` int(11) NOT NULL,
  `nisn` bigint(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `nisn`
--

INSERT INTO `nisn` (`id`, `nisn`) VALUES
(1, 78392758),
(2, 27185739),
(4, 98371657),
(5, 24147561),
(6, 49185028),
(7, 97561042),
(8, 39175021),
(9, 43148693),
(10, 18672619);

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
(18, 1, 18672619, '2021-03-03', 'Januari', '2021', 1, 150000),
(19, 1, 18672619, '2021-03-03', 'April', '2021', 1, 150000);

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
(1, 'Hafid Ardiansyah', 'hafid@gmail.com', 'hafid', 'admin'),
(12, 'Citra', 'citra@gmail.com', 'citra', 'petugas'),
(13, 'Desiyana', 'desiyana@gmail.com', 'desiyana', 'petugas'),
(14, 'Alifia', 'alifia@gmail.com', 'alifia', 'petugas'),
(15, 'Revi', 'revi@gmail.com', 'revi', 'admin'),
(16, 'Hakim', 'hakim@gmail.com', 'hakim', 'petugas');

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
(18672619, 9731, 'Pranata Wibowo', 9, 'Kpg. Baiduri No. 172, Cirebon 43116, SumSel', 81247592182, 1),
(27185739, 8735, 'Titi Andriani', 7, 'Jln. Madiun No. 759, Subulussalam', 81343775142, 1),
(39175021, 7432, 'Hasna Pratiwi', 9, 'Gg. Abdul No. 950, Serang 60158, JaTim', 32472240249, 1),
(43148693, 5398, 'Estiono Simbolon S.I.Kom', 8, 'Kpg. Barasak No. 887, Pekalongan', 81472847381, 1),
(78392758, 8971, 'Michelle Rahmawati M.Kom.', 7, 'Gg. Kali No. 731, Tual 72710, MalUt', 81216116708, 1);

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
(1, 2020, 150000),
(2, 2021, 160000);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `nisn`
--
ALTER TABLE `nisn`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `nisn`
--
ALTER TABLE `nisn`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `pembayaran`
--
ALTER TABLE `pembayaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `pengguna`
--
ALTER TABLE `pengguna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `siswa`
--
ALTER TABLE `siswa`
  MODIFY `nisn` bigint(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1234567891;

--
-- AUTO_INCREMENT untuk tabel `spp`
--
ALTER TABLE `spp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
