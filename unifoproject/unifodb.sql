-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 08 Feb 2023 pada 03.01
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `unifodb`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(8, 31, 'Erika', 'erika@gmail.com', '081234543456', 'hai\r\n'),
(9, 31, 'Erika', 'erika@gmail.com', '0986890', 'cihuy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reg`
--

CREATE TABLE `reg` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_univ` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `reg`
--

INSERT INTO `reg` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_univ`, `total_price`, `placed_on`, `payment_status`) VALUES
(13, 31, 'Erika Naura Uzlami', '081232134567', 'erika@gmail.com', 'Perempuan', 'Perumahan Roro Jonggrang Kecamatan Waru Kabupaten Sidoarjo Jawa Timur - 61261', ', Institut Teknologi Telkom Surabaya ( 1 )', 1, '01-Feb-2023', 'completed'),
(14, 31, 'Safira Indala Sulfa', '085678564321', 'safira@gmail.com', 'Perempuan', 'Perumahan Sibotax Kecamatan Duduksampeyan Kabupaten Gresik Jawa Timur - 61286', ', UPN Veteran Jawa Timur ( 1 )', 1, '01-Feb-2023', 'completed'),
(23, 31, 'Erika Naura Uzlami', '080000000000', 'erika@gmail.com', 'Perempuan', 'Perumahan Roro Jonggrang Kecamatan Waru Kabupaten Sidoarjo Indonesia - 61261', ', UPN Veteran Jawa Timur ( 1 )', 1, '06-Feb-2023', 'completed'),
(24, 31, 'Jokoo', '0890007778', 'jk@gmail.com', 'Laki - Laki', 'Perumahan tok dalang Kecamatan Kromo Kabupaten Blora Jawa Tengah - 67212', ', Universitas Islam Negeri Sunan Ampel ( 1 )', 1, '06-Feb-2023', 'pending'),
(25, 31, 'Erika Naura Uzlami', '000000000000', 'erika@gmail.com', 'Perempuan', 'Perumahan Roro Jonggrang Kecamatan Waru Kabupaten Sidoarjo Indonesia - 61261', ', Universitas 17 Agustus Surabaya ( 1 )', 1, '06-Feb-2023', 'completed'),
(26, 31, 'Erika Naura Uzlami', '08976351891', 'erika@gmail.com', 'Perempuan', 'Perumahan Roro Jonggrang Kecamatan Waru Kabupaten Sidoarjo Indonesia - 61261', ', Institut Teknologi Telkom Surabaya ( 1 )', 1, '06-Feb-2023', 'pending');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reg_univ`
--

CREATE TABLE `reg_univ` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktur dari tabel `univ`
--

CREATE TABLE `univ` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `category` varchar(20) NOT NULL,
  `details` varchar(500) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `univ`
--

INSERT INTO `univ` (`id`, `name`, `category`, `details`, `price`, `image`) VALUES
(26, 'Universitas Airlangga', 'PTN', 'Kampus negeri ini memiliki sebuah nilai sejarah yang otentik, terutama dari segi pendiriannya. Bagaimana tidak, kampus yang berada di kota pahlawan, Surabaya, ini didirikan pada tepat pada tanggal 10 November 1954 bertepatan dengan perayaan hari pahlawan yang ke-9. Selain dari unsur sejarah, Unair juga merupakan kampus yang unggul, bahkan hingga tingkat internasional, lho! Asal kalian tahu, ternyata Unair berhasil mendapatkan peringkat 201-300 dunia pada THE Impact 2022 dengan total skor 81 dari', 1, 'unair.png'),
(27, 'Institut Teknologi Telkom Surabaya', 'PTS', 'Perguruan Tinggi berstandar internasional berbasis Teknologi Informasi dan Komunikasi (ICT) yang berfokus pada bidang maritim, transportasi, dan logistik. Institut Teknologi Surabaya (ITTelkom Surabaya) merupakan lembaga pendidikan tinggi di bawah naungan Yayasan Pendidikan Telkom yang mendukung daya saing Bangsa Indonesia. ITTelkom Surabaya menjadi perguruan tinggi pertama yang memfokuskan diri pada bidang bidang maritim, transportasi, dan logistik.', 1, 'itts.jpg'),
(28, 'UPN Veteran Jawa Timur', 'PTN', 'Universitas Pembangunan Nasional &#34;Veteran&#34; Jawa Timur (disingkat sebagai UPN &#34;Veteran&#34; Jatim atau UPNVJT) adalah sebuah perguruan tinggi negeri di Indonesia yang berada di Surabaya, Jawa Timur. UPN &#34;Veteran&#34; Jatim berdiri sejak 5 Juli 1959 dan saat ini dipimpin oleh Rektor Prof. Dr. Ir. Akhmad Fauzi, M.MT., IPU.\r\n\r\nPada tahun 2014, UPN &#34;Veteran&#34; Jawa Timur mengalami perubahan status kelembagaan dari perguruan tinggi swasta menjadi perguruan tinggi negeri.', 1, 'upn.jpeg'),
(29, 'Universitas Islam Negeri Sunan Ampel', 'PTN', 'Universitas Islam Negeri Sunan Ampel disingkat UIN Sunan Ampel atau UINSA adalah salah satu perguruan tinggi keagamaan Islam negeri di Kota Surabaya yang menyelenggarakan pendidikan tinggi dengan paradigma keilmuan model menara kembar tersambung (integrated twin-towers). Paradigma ini menerapkan pendekatan Islamisasi nalar yang dibutuhkan demi terciptanya tata keilmuan yang saling melengkapi antara ilmu-ilmu keislaman, sosial-humaniora, serta sains dan teknologi. Kata Sunan Ampel pada UIN terseb', 1, 'uinsa.jpg'),
(32, 'Universitas 17 Agustus Surabaya', 'PTS', 'Telkom University pun memiliki komitmen dalam memberikan pelayanan pendidikan yang berkualitas. Ini ditunjukkan dengan raihan Akreditasi “A” atau Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) serta Akreditasi Internasional untuk beberapa prodi. Sejalan dengan ini, Kemendikbud d/h Kemenristekdikti menobatkan Telkom University sebagai Perguruan Tinggi Swasta Terbaik di Indonesia.\r\nSemoga website ini dapat menjadi sarana informasi yang berguna dan dapat menjembatani seluruh pemang', 1, 'untag.png'),
(33, 'Universitas DInamika', 'PTS', 'Telkom University pun memiliki komitmen dalam memberikan pelayanan pendidikan yang berkualitas. Ini ditunjukkan dengan raihan Akreditasi “A” atau Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) serta Akreditasi Internasional untuk beberapa prodi. Sejalan dengan ini, Kemendikbud d/h Kemenristekdikti menobatkan Telkom University sebagai Perguruan Tinggi Swasta Terbaik di Indonesia.\r\nSemoga website ini dapat menjadi sarana informasi yang berguna dan dapat menjembatani seluruh pemang', 1, 'universitas dinamika.jpg'),
(34, 'Universitas Gadjah Mada', 'PTN', 'Telkom University pun memiliki komitmen dalam memberikan pelayanan pendidikan yang berkualitas. Ini ditunjukkan dengan raihan Akreditasi “A” atau Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) serta Akreditasi Internasional untuk beberapa prodi. Sejalan dengan ini, Kemendikbud d/h Kemenristekdikti menobatkan Telkom University sebagai Perguruan Tinggi Swasta Terbaik di Indonesia.\r\nSemoga website ini dapat menjadi sarana informasi yang berguna dan dapat menjembatani seluruh pemang', 1, 'ugm.jpg'),
(35, 'Universitas Brawijaya', 'PTN', 'Telkom University pun memiliki komitmen dalam memberikan pelayanan pendidikan yang berkualitas. Ini ditunjukkan dengan raihan Akreditasi “A” atau Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) serta Akreditasi Internasional untuk beberapa prodi. Sejalan dengan ini, Kemendikbud d/h Kemenristekdikti menobatkan Telkom University sebagai Perguruan Tinggi Swasta Terbaik di Indonesia.\r\nSemoga website ini dapat menjadi sarana informasi yang berguna dan dapat menjembatani seluruh pemang', 1, 'ub.jpeg'),
(36, 'Universitas Muhammadiyah Malang', 'PTS', 'Telkom University pun memiliki komitmen dalam memberikan pelayanan pendidikan yang berkualitas. Ini ditunjukkan dengan raihan Akreditasi “A” atau Unggul dari Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT) serta Akreditasi Internasional untuk beberapa prodi. Sejalan dengan ini, Kemendikbud d/h Kemenristekdikti menobatkan Telkom University sebagai Perguruan Tinggi Swasta Terbaik di Indonesia.\r\nSemoga website ini dapat menjadi sarana informasi yang berguna dan dapat menjembatani seluruh pemang', 1, 'umm.jpg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user',
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`, `image`) VALUES
(31, 'Maziyatul Ilma Salsabila', 'ilma@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 'user', 'WhatsApp Image 2021-12-31 at 14.59.09.jpeg'),
(32, 'admin', 'admin@gmail.com', 'b0baee9d279d34fa1dfd71aadb908c3f', 'admin', 'WhatsApp Image 2022-01-01 at 08.37.23.jpeg');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `pid` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reg`
--
ALTER TABLE `reg`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `reg_univ`
--
ALTER TABLE `reg_univ`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `univ`
--
ALTER TABLE `univ`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT untuk tabel `reg`
--
ALTER TABLE `reg`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT untuk tabel `reg_univ`
--
ALTER TABLE `reg_univ`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT untuk tabel `univ`
--
ALTER TABLE `univ`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
