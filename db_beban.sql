-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Waktu pembuatan: 06 Feb 2020 pada 09.06
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_beban`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `beban_kerja`
--

CREATE TABLE `beban_kerja` (
  `id` int(11) NOT NULL,
  `id_pegawai` int(120) NOT NULL,
  `tahun` varchar(16) DEFAULT NULL,
  `no_tugas` int(11) DEFAULT NULL,
  `beban_kerja` int(11) DEFAULT NULL,
  `freq` int(11) DEFAULT NULL,
  `bk_pertahun` int(11) DEFAULT NULL,
  `skr` int(11) DEFAULT NULL,
  `wpt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `beban_kerja`
--

INSERT INTO `beban_kerja` (`id`, `id_pegawai`, `tahun`, `no_tugas`, `beban_kerja`, `freq`, `bk_pertahun`, `skr`, `wpt`) VALUES
(1, 111112, '2019', 293, 20, 2, NULL, 10, NULL),
(2, 111112, '2020', 192213, 99, 1, NULL, 10, NULL),
(5, 123456789, '2020', 3127, 10, 2, NULL, 10, NULL),
(6, 111112, '2020', 192213, 10, 1, NULL, 10, NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `golongan`
--

CREATE TABLE `golongan` (
  `id` int(12) NOT NULL,
  `nm_golongan` varchar(200) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `golongan`
--

INSERT INTO `golongan` (`id`, `nm_golongan`, `keterangan`) VALUES
(1, 'IV E', 'Pembina Utama'),
(2, 'IV D', 'Pembina Utama Madya'),
(3, 'IV C', 'Pembina Utama Muda'),
(4, 'IV B', 'Pembina Tingkat 1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `jabatan`
--

CREATE TABLE `jabatan` (
  `id` int(11) NOT NULL,
  `jabatan` varchar(200) NOT NULL,
  `keterangan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `jabatan`
--

INSERT INTO `jabatan` (`id`, `jabatan`, `keterangan`) VALUES
(1, 'Ka.Bagian Umum', 'Kepala Bagian Umum'),
(3, 'Ka.Bag Keuangan', 'Kepala Bagian Keuangan'),
(4, 'Staf Kepegawaian', 'Staff Bagian Kepegawaian'),
(5, 'Sekretaris bupati', 'Sekretaris bupati');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pegawai`
--

CREATE TABLE `pegawai` (
  `id` int(80) NOT NULL,
  `nip` int(120) NOT NULL,
  `password` varchar(200) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `tempat_lahir` varchar(200) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `no_telp` varchar(80) NOT NULL,
  `id_gol` int(12) NOT NULL,
  `id_unit` int(12) NOT NULL,
  `id_jabatan` int(12) NOT NULL,
  `level` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pegawai`
--

INSERT INTO `pegawai` (`id`, `nip`, `password`, `nama`, `tempat_lahir`, `tgl_lahir`, `alamat`, `no_telp`, `id_gol`, `id_unit`, `id_jabatan`, `level`) VALUES
(1, 100000, '$2y$10$2z5PS0XqMcVh.elV/zy2lueDvheBsd4gieBW8hpKaqKQrnSjtoxEW', 'budi', 'luengputu', '2000-05-03', 'lueng putu', '098797391236', 1, 1, 1, 'Admin'),
(2, 111112, '$2y$10$Lsircp4ZWXhFSj8IF6dBkOxoks5cj.abSrLHHQBmRopsFRCu.m8gC', 'kokos', 'siglis', '2000-01-02', 'siglis', '201798275', 4, 2, 4, 'Pegawai'),
(8, 123456789, '$2y$10$DeR0.gCZL1lvDR6Jf4TPEOt89X9wxzjy5xFrCTsu5BH2fYK2.v2AK', 'Arman Maulana', 'Jakarta', '1980-08-10', 'Jakarta Pusat', '0981739617', 1, 1, 4, 'Pegawai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tgs_jab`
--

CREATE TABLE `tgs_jab` (
  `id` int(11) NOT NULL,
  `no_tugas` int(80) NOT NULL,
  `nama_tugas` varchar(255) NOT NULL,
  `id_jab` int(11) DEFAULT NULL,
  `periode` varchar(80) DEFAULT NULL,
  `total_wpt` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `tgs_jab`
--

INSERT INTO `tgs_jab` (`id`, `no_tugas`, `nama_tugas`, `id_jab`, `periode`, `total_wpt`) VALUES
(3, 192213, 'Fasilitas Mushola', 1, 'Pertahun', 30),
(4, 293, 'Membuat laporan persemestera', 3, 'Persemester', 10),
(5, 1887, 'Memasak nasi', 4, 'Perhari', 10),
(8, 3127, 'Membuat Rekapan', 5, 'Persemester', 10);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unit`
--

CREATE TABLE `unit` (
  `id` int(12) NOT NULL,
  `unit` varchar(200) NOT NULL,
  `keterangan` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `unit`
--

INSERT INTO `unit` (`id`, `unit`, `keterangan`) VALUES
(1, 'Bagian Umum', 'SDM Sarana dan Prasarana'),
(2, 'Biro Keuangan', 'Divisi Umum');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `beban_kerja`
--
ALTER TABLE `beban_kerja`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `golongan`
--
ALTER TABLE `golongan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tgs_jab`
--
ALTER TABLE `tgs_jab`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `beban_kerja`
--
ALTER TABLE `beban_kerja`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `golongan`
--
ALTER TABLE `golongan`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `jabatan`
--
ALTER TABLE `jabatan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `pegawai`
--
ALTER TABLE `pegawai`
  MODIFY `id` int(80) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tgs_jab`
--
ALTER TABLE `tgs_jab`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `unit`
--
ALTER TABLE `unit`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
