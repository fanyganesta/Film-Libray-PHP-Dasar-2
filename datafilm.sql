-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2025 at 10:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `film_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `datafilm`
--

CREATE TABLE `datafilm` (
  `id` int(11) NOT NULL,
  `namaFilm` varchar(100) DEFAULT NULL,
  `deskripsiSingkat` varchar(255) DEFAULT NULL,
  `tahunTerbit` varchar(100) DEFAULT NULL,
  `rating` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `datafilm`
--

INSERT INTO `datafilm` (`id`, `namaFilm`, `deskripsiSingkat`, `tahunTerbit`, `rating`, `img`) VALUES
(1, 'The Shawshank Redemption', 'Dua pria dipenjara membentuk ikatan selama beberapa dekade, menemukan penghiburan dan penebusan melalui tindakan kebaikan bersama.', '1994', '9.3', NULL),
(2, 'The Godfather', 'Kisah epik keluarga kejahatan Amerika keturunan Italia, berpsat pada Vito Corleone, patriark yang me', '1972', '9.2', NULL),
(3, 'The Dark Night', 'Batman berpacu dengan waktu untuk menuelamatkan Gotham dari kehancuran yang ditimbulkan oleh teroris', '2008', '9.0', NULL),
(4, 'Pulp Fiction', 'Kisah-kisah yang saling terkait tentang dua pembunuh bayaran, seorang petinju, istri seorang gangste', '1994', '8.9', NULL),
(5, 'Forrest Gump', 'Kisah seorang pria polos namin berhati murni yang secara tidak sengaja menyaksikan dan memmengaruhi ', '1994', '8.8', NULL),
(6, 'Fight Club', 'Seorang pekerja kantoran yang menderita insomnia membentuk klub pertarungan bawah tanah bersama seor', '1999', '8.8', NULL),
(7, 'Parasite', 'Sebuah keluarga miskin menyususp ke rumah keluarga kaya, tetapi rahasia gelap yang tersembunyi menga', '2019', '8.5', NULL),
(8, 'Spirited Away', 'Seorang gadis muda pindah ke kota baru dan tersesat di dunia arwah, di mana ia harus bekerja untuk m', '2001', '8.6', NULL),
(9, 'Interstellar', 'Sekelompok penjelajah melakukan perjalanan melalui lubang cacing untuk mencari planet baru yang dapa', '2014', '8.7', NULL),
(10, 'Inception', 'Seorang pencuri ulung yang mencuri rahasia perusahaan dari alam bawah sadar seseorang, kini diberi t', '2010', '8.8', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `datafilm`
--
ALTER TABLE `datafilm`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `datafilm`
--
ALTER TABLE `datafilm`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
