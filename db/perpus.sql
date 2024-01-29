-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Waktu pembuatan: 27 Jan 2024 pada 03.30
-- Versi server: 8.0.35-0ubuntu0.22.04.1
-- Versi PHP: 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perpus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `bukuID` int NOT NULL,
  `judul` varchar(50) NOT NULL,
  `penulis` varchar(50) NOT NULL,
  `penerbit` varchar(50) NOT NULL,
  `tahunTerbit` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoriBuku`
--

CREATE TABLE `kategoriBuku` (
  `kategoriID` int NOT NULL,
  `namaKategori` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategoriBuku_relasi`
--

CREATE TABLE `kategoriBuku_relasi` (
  `kategoriBukuID` int NOT NULL,
  `bukuID` int NOT NULL,
  `kategoriID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `koleksiPribadi`
--

CREATE TABLE `koleksiPribadi` (
  `koleksiID` int NOT NULL,
  `userID` int NOT NULL,
  `bukuID` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `peminjaman`
--

CREATE TABLE `peminjaman` (
  `peminjamanID` int NOT NULL,
  `userID` int NOT NULL,
  `bukuID` int NOT NULL,
  `tanggalPeminjaman` date NOT NULL,
  `tanggalPengembalian` date NOT NULL,
  `statusPeminjaman` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `ulasanBuku`
--

CREATE TABLE `ulasanBuku` (
  `ulasanID` int NOT NULL,
  `userID` int NOT NULL,
  `bukuID` int NOT NULL,
  `ulasan` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `rating` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `userID` int NOT NULL,
  `role` enum('admin','petugas','peminjam') NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `namaLengkap` varchar(20) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`userID`, `role`, `username`, `password`, `email`, `namaLengkap`, `alamat`) VALUES
(1, 'admin', 'admin', '202cb962ac59075b964b07152d234b70', 'admin123@gmail.com', 'admin', 'Semarang'),
(4, 'peminjam', 'risky', '202cb962ac59075b964b07152d234b70', 'saririsky86@gmail.com', 'sari risky', 'jl.kenangan'),
(9, 'peminjam', 'kaga', '202cb962ac59075b964b07152d234b70', 'sampah6989@gmail.com', 'Kagura', 'from dusk till dawn'),
(10, 'admin', 'kagura', '202cb962ac59075b964b07152d234b70', 'saririsky86@gmail.com', 'admin Kagura', 'from dusk till dawn');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`bukuID`);

--
-- Indeks untuk tabel `kategoriBuku`
--
ALTER TABLE `kategoriBuku`
  ADD PRIMARY KEY (`kategoriID`);

--
-- Indeks untuk tabel `kategoriBuku_relasi`
--
ALTER TABLE `kategoriBuku_relasi`
  ADD PRIMARY KEY (`kategoriBukuID`),
  ADD UNIQUE KEY `bukuID` (`bukuID`,`kategoriID`),
  ADD KEY `kategoriID` (`kategoriID`);

--
-- Indeks untuk tabel `koleksiPribadi`
--
ALTER TABLE `koleksiPribadi`
  ADD PRIMARY KEY (`koleksiID`),
  ADD UNIQUE KEY `userID` (`userID`,`bukuID`),
  ADD KEY `bukuID` (`bukuID`);

--
-- Indeks untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`peminjamanID`),
  ADD UNIQUE KEY `userID` (`userID`,`bukuID`),
  ADD KEY `bukuID` (`bukuID`);

--
-- Indeks untuk tabel `ulasanBuku`
--
ALTER TABLE `ulasanBuku`
  ADD PRIMARY KEY (`ulasanID`),
  ADD UNIQUE KEY `userID` (`userID`,`bukuID`),
  ADD KEY `bukuID` (`bukuID`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `bukuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `kategoriBuku`
--
ALTER TABLE `kategoriBuku`
  MODIFY `kategoriID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT untuk tabel `kategoriBuku_relasi`
--
ALTER TABLE `kategoriBuku_relasi`
  MODIFY `kategoriBukuID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `koleksiPribadi`
--
ALTER TABLE `koleksiPribadi`
  MODIFY `koleksiID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `peminjamanID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `ulasanBuku`
--
ALTER TABLE `ulasanBuku`
  MODIFY `ulasanID` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `kategoriBuku_relasi`
--
ALTER TABLE `kategoriBuku_relasi`
  ADD CONSTRAINT `kategoriBuku_relasi_ibfk_1` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`),
  ADD CONSTRAINT `kategoriBuku_relasi_ibfk_2` FOREIGN KEY (`kategoriID`) REFERENCES `kategoriBuku` (`kategoriID`);

--
-- Ketidakleluasaan untuk tabel `koleksiPribadi`
--
ALTER TABLE `koleksiPribadi`
  ADD CONSTRAINT `koleksiPribadi_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `koleksiPribadi_ibfk_2` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`);

--
-- Ketidakleluasaan untuk tabel `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`);

--
-- Ketidakleluasaan untuk tabel `ulasanBuku`
--
ALTER TABLE `ulasanBuku`
  ADD CONSTRAINT `ulasanBuku_ibfk_1` FOREIGN KEY (`bukuID`) REFERENCES `buku` (`bukuID`),
  ADD CONSTRAINT `ulasanBuku_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`userID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
