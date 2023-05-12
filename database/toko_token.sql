-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 12 Bulan Mei 2023 pada 02.02
-- Versi server: 10.4.24-MariaDB
-- Versi PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko_token`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `pemesanan`
--

CREATE TABLE `pemesanan` (
  `id_pemesanan` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `harga` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `tanggal` int(11) NOT NULL,
  `email_user` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `bukti_bayar` varchar(255) NOT NULL,
  `tanggal_bayar` int(11) NOT NULL,
  `metode` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `pemesanan`
--

INSERT INTO `pemesanan` (`id_pemesanan`, `id_pelanggan`, `jumlah`, `harga`, `total`, `tanggal`, `email_user`, `status`, `bukti_bayar`, `tanggal_bayar`, `metode`, `token`) VALUES
(30, 2147483647, 1, 100000, 103000, 1683681139, 'susise@gmail.com', '3', 'BG_Zoom2.png', 1683698246, 'bri', '123415261317'),
(31, 2147483647, 2, 1000000, 2003000, 1683684843, 'a@gmail.com', '3', 'bulan.jpg', 1683684863, 'bri', '123415261317'),
(32, 2147483647, 3, 100000, 303000, 1683687368, 'a@gmail.com', '2', 'gunung1.jpg', 1683688398, 'bri', ''),
(33, 2147483647, 2, 200000, 403000, 1683688383, 'a@gmail.com', '1', '', 0, '', ''),
(34, 2147483647, 1, 50000, 53000, 1683695626, 'a@gmail.com', '3', 'logounicef.png', 1683695724, 'bri', '123415261317'),
(35, 2147483647, 3, 200000, 603000, 1683695832, 'a@gmail.com', '2', 'BG_Zoom1.png', 1683695858, 'gopay', ''),
(36, 2147483647, 1, 20000, 23000, 1683695843, 'a@gmail.com', '1', '', 0, '', ''),
(37, 2147483647, 1, 50000, 53000, 1683698114, 'susise@gmail.com', '2', 'bulan3.jpg', 1683709485, 'bri', ''),
(38, 2147483647, 1, 50000, 53000, 1683709464, 'susise@gmail.com', '1', '', 0, '', ''),
(39, 2147483647, 3, 10000, 33000, 1683709511, 'susise@gmail.com', '3', 'eidmubarak1.png', 1683709529, 'gopay', '123415261317'),
(40, 2147483647, 2, 1000000, 2003000, 1683709641, 'a@gmail.com', '3', 'Logo_UNSOED_4.png', 1683709691, 'bri', '123415261317');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tabel_status`
--

CREATE TABLE `tabel_status` (
  `id_status` int(11) NOT NULL,
  `name_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tabel_status`
--

INSERT INTO `tabel_status` (`id_status`, `name_status`) VALUES
(1, 'Menunggu pembayaran'),
(2, 'Menunggu konfirmasi'),
(3, 'Transaksi selesai');

-- --------------------------------------------------------

--
-- Struktur dari tabel `token`
--

CREATE TABLE `token` (
  `id` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `harga` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `token`
--

INSERT INTO `token` (`id`, `judul`, `harga`) VALUES
(1, 'Rp5.000', 5000),
(2, 'Rp10.000', 10000),
(3, 'Rp15.000', 15000),
(4, 'Rp20.000', 20000),
(5, 'Rp50.000', 50000),
(6, 'Rp100.000', 100000),
(7, 'Rp200.000', 200000),
(8, 'Rp500.000', 500000),
(9, 'Rp1.000.000', 1000000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(3, 'Susi Setianingsih', 'susisetia234@gmail.com', 'Acer_Wallpaper_01_5000x2814.jpg', '$2y$10$4oJJkcNDP6EHEo/.diGPdeWw6zLeRE9CQMTftrviNPYkcE8txFvou', 1, 1, 1655460207),
(4, 'Bae Suzy', 'admin@gmail.com', 'contoh.jpg', '$2y$10$2UflpDTbCDhTENoGPYHK2OCk.TjQsmCEVGD0dlL46xAO2eLMu1Piq', 1, 1, 1655523309),
(6, 'susi', 'susise@gmail.com', 'eidmubarak.png', '$2y$10$LVjl7FMIAVa6.kDcR1qfSekh/bXNEJpQ9zz9O3CyqmINUlJ6eGj76', 2, 1, 1672677879),
(11, 'Balqist', 'a@gmail.com', 'bulan.jpg', '$2y$10$8iThbxXWJvFBxGvdqXZ06OU8/wphubXNIO9wpRDceSkWR1/s2OU4.', 2, 1, 1683642617);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_role`
--

CREATE TABLE `user_role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_role`
--

INSERT INTO `user_role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(7, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(8, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(13, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(17, 1, 'All User', 'admin/all_user', 'fas fa-fw fa-users', 1),
(21, 2, 'Beranda', 'user', 'fas fa-wa fa-home', 1),
(22, 2, 'Pemesanan', 'user/pemesanan', 'fas fa-fw fa-shopping-cart', 1),
(23, 2, 'Riwayat', 'user/riwayat', 'fas fa-fw fa-history', 1),
(24, 1, 'Task', 'admin/task', 'fas fa-fw fa-tasks', 1);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  ADD PRIMARY KEY (`id_pemesanan`);

--
-- Indeks untuk tabel `tabel_status`
--
ALTER TABLE `tabel_status`
  ADD PRIMARY KEY (`id_status`);

--
-- Indeks untuk tabel `token`
--
ALTER TABLE `token`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `pemesanan`
--
ALTER TABLE `pemesanan`
  MODIFY `id_pemesanan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tabel_status`
--
ALTER TABLE `tabel_status`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `token`
--
ALTER TABLE `token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `user_role`
--
ALTER TABLE `user_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
