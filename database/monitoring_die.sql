-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 17 Sep 2024 pada 16.42
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `monitoring_die`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `monitoringuniquedie`
--

CREATE TABLE `monitoringuniquedie` (
  `id` int(11) NOT NULL,
  `nama_die` varchar(50) DEFAULT NULL,
  `A1N` int(11) DEFAULT NULL,
  `B1N` int(11) DEFAULT NULL,
  `C1N` int(11) DEFAULT NULL,
  `C2N` int(11) DEFAULT NULL,
  `C3N` int(11) DEFAULT NULL,
  `C4N` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `monitoringuniquedie`
--

INSERT INTO `monitoringuniquedie` (`id`, `nama_die`, `A1N`, `B1N`, `C1N`, `C2N`, `C3N`, `C4N`) VALUES
(1, 'Unique Die N1', 19, 1, 3, 2, 6, 40),
(2, 'Unique Die N2', 2, 3, 1, 2, 8, 3),
(3, 'Unique Die N3', 4, 1, 6, 4, 7, 3),
(4, 'Unique Die N4', 50, 7, 2, 1, 4, 5),
(5, 'Unique Die N5', 9, 1, 3, 6, 2, 7),
(6, 'Unique Die N6', 5, 6, 5, 4, 3, 2),
(7, 'Unique Die N7', 9, 10, 10, 2, 1, 5),
(8, 'Unique Die N8', 9, 1, 8, 10, 1, 9),
(9, 'Unique Die N9', 2, 6, 5, 5, 9, 10),
(10, 'Unique Die N10', 10, 1, 1, 8, 1, 8),
(11, 'Unique Die NH 1', 1, 1, 1, 1, 1, 1),
(12, 'Unique Die NH 2', 2, 2, 2, 2, 2, 2),
(13, 'Unique Die NH 3', 20, 3, 3, 3, 3, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `unique_die_shots`
--

CREATE TABLE `unique_die_shots` (
  `id` int(11) NOT NULL,
  `shift` varchar(50) DEFAULT NULL,
  `mesin_dc` varchar(50) DEFAULT NULL,
  `general_die` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `unique_die` varchar(50) DEFAULT NULL,
  `value_die` varchar(100) DEFAULT NULL,
  `total_shot` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `unique_die_shots`
--

INSERT INTO `unique_die_shots` (`id`, `shift`, `mesin_dc`, `general_die`, `tanggal`, `unique_die`, `value_die`, `total_shot`) VALUES
(4, 'red', '2', '6', '2024-09-10', 'UDN8', 'C3N', 10),
(5, 'red', '2', '6', '2024-09-17', 'UDN2', 'A1N', 10),
(6, 'red', '2', '6', '2024-09-17', 'UDN1', 'B1N', 10),
(8, 'red', '20', '6', '2024-09-17', 'UDN1', 'A1N', 100);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `monitoringuniquedie`
--
ALTER TABLE `monitoringuniquedie`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `unique_die_shots`
--
ALTER TABLE `unique_die_shots`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `monitoringuniquedie`
--
ALTER TABLE `monitoringuniquedie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `unique_die_shots`
--
ALTER TABLE `unique_die_shots`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
