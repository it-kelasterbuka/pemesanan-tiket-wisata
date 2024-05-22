-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: sql313.infinityfree.com
-- Waktu pembuatan: 20 Apr 2024 pada 14.01
-- Versi server: 10.4.17-MariaDB
-- Versi PHP: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `if0_36369470_pwl`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `nama_lengkap` varchar(255) NOT NULL,
  `nomor_identitas` varchar(20) NOT NULL,
  `nomor_hp` varchar(15) NOT NULL,
  `pilihan_tiket` varchar(50) NOT NULL,
  `jadwal_berangkat` datetime NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'dalam antrian'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pesanan`
--

INSERT INTO `pesanan` (`id`, `username`, `nama_lengkap`, `nomor_identitas`, `nomor_hp`, `pilihan_tiket`, `jadwal_berangkat`, `status`) VALUES
(5, 'Bedul', 'Ahmad Randi', '123456789', '082215478921', 'Minangkabau', '2024-04-19 08:00:00', 'diterima'),
(6, 'Bedul', 'Ahmad Randi', '12345678', '082215478921', 'Borsel', '2024-04-25 06:00:00', 'diterima'),
(7, 'Bedul', 'Ahmad Randi', '12345678', '082215478921', 'Toronipa', '2024-05-01 05:30:00', 'diterima'),
(8, 'Beruk', 'Beruk kece', '0289829791', '073837382929929', 'Minangkabau', '2024-04-17 04:14:00', 'diterima'),
(9, 'Annita', 'Annita Herry Yani', '1234', '0878123456', 'Toronipa', '2024-04-23 05:30:00', 'dalam antrian'),
(10, 'Bedul', 'Ahmad Randi', '1234567', '081222674591', 'Minangkabau', '2024-05-04 08:00:00', 'diterima'),
(11, 'Bedul', 'Ahmad Randi', '123456777', '081222674591', 'Borsel', '2024-06-08 04:00:00', 'diterima'),
(12, 'Annita', 'Annita Herry Yani', '1234', '0878123456', 'Borsel', '2024-04-25 03:02:00', 'dalam antrian'),
(13, 'hakim', 'Muhammad Kafrawi Hakim', '23445789', '087888123', 'tangerang', '2024-04-25 21:15:00', 'dalam antrian'),
(14, 'Annita', 'Annita Herry Yani', '1234', '0878123456', 'Minangkabau', '2024-04-30 18:30:00', 'diterima'),
(15, 'Bedul', 'Ahmad Randi', '12345678', '082215478921', 'Borsel', '2024-04-20 10:35:00', 'dalam antrian'),
(16, 'Adam', 'Jordan', '3452', '1233566', 'Borsel', '2024-04-22 21:00:00', 'diterima');

-- --------------------------------------------------------

--
-- Struktur dari tabel `Roles`
--

CREATE TABLE `Roles` (
  `ID` int(11) NOT NULL,
  `Role` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `Roles`
--

INSERT INTO `Roles` (`ID`, `Role`) VALUES
(1, 'client'),
(2, 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `confirmPass` varchar(100) NOT NULL,
  `roles_id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `Password`, `confirmPass`, `roles_id`) VALUES
(1, 'demo', '$2y$10$73hFiD8SiRQ791uWg/Qz0O1527V48gmAx5DjGypYNC6jcoHAN.4re', '', 2),
(2, 'Bedul', '$2y$10$RyiVbmZ.qoHIoLiuSxhB0up1BDdPdsv3M2YdzqcrJvRqdsR62v1xq', '', 1),
(3, 'Adam', '$2y$10$bL8pOs4cymnVhjm.ANvh/emOSP8a1L7ij6TaM41yxBtPq6Y1r/Ki2', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `Roles`
--
ALTER TABLE `Roles`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `roles_id` (`roles_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `Roles`
--
ALTER TABLE `Roles`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
