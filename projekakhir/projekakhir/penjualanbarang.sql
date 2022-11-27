-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 19 Nov 2022 pada 16.15
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `penjualanbarang`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `barang`
--

CREATE TABLE `barang` (
  `ID` varchar(30) NOT NULL,
  `ID_Cabang` varchar(30) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Harga` int(11) NOT NULL,
  `Gambar` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `barang`
--

INSERT INTO `barang` (`ID`, `ID_Cabang`, `Nama`, `Harga`, `Gambar`) VALUES
('12', 'H001', 'Kipas Angin', 120000, 'Kipas Angin.jpg'),
('FJ01', 'H002', 'Laptop', 2000000, 'Laptop.jpg'),
('FJ02', 'H001', 'Kulkas', 300000, 'Kulkas.jpg'),
('FJ03', 'H001', 'lampu', 70000, 'Lampu.jpg');

--
-- Trigger `barang`
--
DELIMITER $$
CREATE TRIGGER `update hapus barang` AFTER DELETE ON `barang` FOR EACH ROW BEGIN
	UPDATE cabang
    SET
    	Jumlah_Barang=Jumlah_Barang-1
    WHERE
    	ID = OLD.ID_Cabang;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update tambah barang` AFTER INSERT ON `barang` FOR EACH ROW BEGIN
	UPDATE cabang
    SET
    	Jumlah_Barang=Jumlah_Barang+1
    WHERE
    	ID = NEW.ID_Cabang;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cabang`
--

CREATE TABLE `cabang` (
  `ID` varchar(30) NOT NULL,
  `Nama` varchar(30) NOT NULL,
  `Lokasi` varchar(30) NOT NULL,
  `Jumlah_Barang` int(30) NOT NULL,
  `Telepon` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `cabang`
--

INSERT INTO `cabang` (`ID`, `Nama`, `Lokasi`, `Jumlah_Barang`, `Telepon`) VALUES
('H001', 'Elektronik Jaya 1', 'Jalan Pramuka', 3, '024-8449888'),
('H002', 'Fashion Jaya ', 'Jalan M.Yamin', 1, '024-8416222');

-- --------------------------------------------------------

--
-- Struktur dari tabel `feedback`
--

CREATE TABLE `feedback` (
  `ID` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `Feed` text NOT NULL,
  `waktu` varchar(50) NOT NULL,
  `star` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `feedback`
--

INSERT INTO `feedback` (`ID`, `ID_User`, `Feed`, `waktu`, `star`) VALUES
(8, 22, 'barang sangat berkualitas', '30-11-2021 18:12:58', 4),
(16, 25, 'barang agak usang', '03-12-2021 07:48:04', 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID` int(11) NOT NULL,
  `ID_User` int(11) NOT NULL,
  `ID_Barang` varchar(30) NOT NULL,
  `Jumlah_Barang` int(11) NOT NULL,
  `Total_Harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `transaksi`
--

INSERT INTO `transaksi` (`ID`, `ID_User`, `ID_Barang`, `Jumlah_Barang`, `Total_Harga`) VALUES
(11, 22, 'FJ01', 1, 2000000),
(13, 25, 'FJ03', 3, 600000),
(14, 22, 'FJ01', 3, 6000000),
(15, 28, '12', 4, 480000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `LastName` varchar(255) DEFAULT NULL,
  `JenisKelamin` varchar(255) NOT NULL,
  `Umur` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `LastName`, `JenisKelamin`, `Umur`, `email`, `password`) VALUES
(20, 'admin', 'admin', 'Pria', '2021-12-07', 'admin@gmail.com', '0192023a7bbd73250516f069df18b500'),
(22, 'Ahmad', 'Riadii', 'Pria', '2000-11-01', 'riadi@gmail.com', 'e6cd9b352b94ea9b12318e4c06da7230'),
(25, 'Abdullah', 'Khodirat', 'Pria', '2021-12-19', 'abdul@gmail.com', '82027888c5bb8fc395411cb6804a066c'),
(28, 'Joko', ' Diwowo', 'Pria', '1997-06-24', 'joko@gmail.com', '9ba0009aa81e794e628a04b51eaf7d7f');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_Hotel` (`ID_Cabang`);

--
-- Indeks untuk tabel `cabang`
--
ALTER TABLE `cabang`
  ADD PRIMARY KEY (`ID`);

--
-- Indeks untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_User` (`ID_User`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_User` (`ID_User`),
  ADD KEY `ID_Kamar` (`ID_Barang`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `barang`
--
ALTER TABLE `barang`
  ADD CONSTRAINT `barang_ibfk_1` FOREIGN KEY (`ID_Cabang`) REFERENCES `cabang` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`ID_User`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_2` FOREIGN KEY (`ID_Barang`) REFERENCES `barang` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_ibfk_3` FOREIGN KEY (`ID_User`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
