-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 26, 2020 at 03:20 PM
-- Server version: 5.7.23
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `skladiste`
--

-- --------------------------------------------------------

--
-- Table structure for table `artikl`
--

DROP TABLE IF EXISTS `artikl`;
CREATE TABLE IF NOT EXISTS `artikl` (
  `sifraArtikla` int(20) NOT NULL AUTO_INCREMENT,
  `nazivArtikla` varchar(50) DEFAULT NULL,
  `JMJ` varchar(5) DEFAULT NULL,
  `cijenaArtikla` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`sifraArtikla`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `artikl`
--

INSERT INTO `artikl` (`sifraArtikla`, `nazivArtikla`, `JMJ`, `cijenaArtikla`) VALUES
(2, 'Opeka 50x19x19 cm', 'kom', '7.00'),
(3, 'Ljepilo za keramiku', 'kom', '2.00'),
(4, 'Bakrena cijev 15x0,8 mm', 'm', '24.00'),
(5, 'Zbuka temeljna', 'kg', '2.00'),
(6, 'Cement Optimo', 'kg', '1.00'),
(7, 'Betonski blok 40x20x16 cm', 'kom', '20.00'),
(8, 'Stiropor za fasade 8 cm', 'm2', '24.00');

-- --------------------------------------------------------

--
-- Table structure for table `dokument`
--

DROP TABLE IF EXISTS `dokument`;
CREATE TABLE IF NOT EXISTS `dokument` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tip` varchar(5) CHARACTER SET utf8 COLLATE utf8_croatian_ci DEFAULT NULL,
  `datum` datetime DEFAULT NULL,
  `zaposlenik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=198 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokument`
--

INSERT INTO `dokument` (`id`, `tip`, `datum`, `zaposlenik`) VALUES
(1, 'PS', '2018-01-01 00:00:00', 'Ivo Ivic'),
(2, 'PS', '2018-01-01 00:00:00', NULL),
(3, 'PS', '2018-01-01 00:00:00', NULL),
(4, 'PS', '2018-01-01 00:00:00', NULL),
(5, 'PS', '2018-01-01 00:00:00', NULL),
(6, 'PS', '2018-01-01 00:00:00', NULL),
(7, 'PS', '2018-01-01 00:00:00', NULL),
(8, 'PS', '2018-01-01 00:00:00', NULL),
(188, 'PR', '2019-09-23 11:38:28', 'Admin Test'),
(187, 'PR', '2019-09-21 18:50:52', 'Admin Test'),
(197, 'IZD', '2020-05-26 17:14:33', 'Admin Test'),
(196, 'PR', '2019-09-24 16:52:29', 'Admin Test'),
(195, 'PR', '2019-09-24 10:44:55', 'Admin Test'),
(194, 'PR', '2019-09-23 12:02:39', 'Matea Setnik'),
(193, 'IZD', '2019-09-23 11:58:34', 'Admin Test'),
(192, 'IZD', '2019-09-23 11:57:56', 'Admin Test'),
(191, 'PR', '2019-09-23 11:55:55', 'Admin Test'),
(190, 'PR', '2019-09-23 11:54:01', 'Admin Test'),
(189, 'PR', '2019-09-23 11:53:04', 'Admin Test');

-- --------------------------------------------------------

--
-- Table structure for table `dokument1(ne koristim)`
--

DROP TABLE IF EXISTS `dokument1(ne koristim)`;
CREATE TABLE IF NOT EXISTS `dokument1(ne koristim)` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipDokumenta` varchar(5) NOT NULL,
  `datumDokumenta` varchar(10) NOT NULL,
  `sifraArtikla` int(20) DEFAULT NULL,
  `kolicina` int(20) DEFAULT NULL,
  `zaposlenik` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`,`tipDokumenta`,`datumDokumenta`),
  KEY `FK1` (`sifraArtikla`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dokument1(ne koristim)`
--

INSERT INTO `dokument1(ne koristim)` (`id`, `tipDokumenta`, `datumDokumenta`, `sifraArtikla`, `kolicina`, `zaposlenik`) VALUES
(1, 'PS', '01-01-2018', 1, 10, NULL),
(2, 'PS', '01-01-2018', 2, 1000, NULL),
(3, 'PS', '01-01-2018', 3, 50, NULL),
(4, 'PS', '01-01-2018', 4, 70, NULL),
(5, 'PS', '01-01-2018', 5, 100, NULL),
(6, 'PS', '01-01-2018', 6, 200, NULL),
(7, 'PS', '01-01-2018', 7, 100, NULL),
(8, 'PS', '01-01-2018', 8, 200, NULL),
(9, 'IZD', '08-01-2018', 2, 35, NULL),
(10, 'PR', '05-01-2018', 5, 44, NULL),
(16, 'IZD', '30-05-2019', 4, 14, NULL),
(13, 'PR', '25-01-2018', 3, 18, NULL),
(17, 'IZD', '30-05-2019', 3, 2, NULL),
(18, 'PR', '31-05-2019', 6, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `korisnickoIme` varchar(20) NOT NULL,
  `lozinka` varchar(20) DEFAULT NULL,
  `admin` int(1) DEFAULT NULL,
  `ime` varchar(50) DEFAULT NULL,
  `prezime` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`korisnickoIme`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`korisnickoIme`, `lozinka`, `admin`, `ime`, `prezime`) VALUES
('ivo.ivic', '12345', 1, 'Ivo', 'Ivic'),
('pero.peric', '12345', 1, 'Pero', 'Peric'),
('student', 'student', 1, 'Admin', 'Test'),
('trifke123', '12345', 0, 'danijel', 'trifunovic'),
('zrnic123', '12345', 1, 'marko', 'zrnic'),
('suzana.setnik', '12345', 0, 'Suzana', 'Setnik');

-- --------------------------------------------------------

--
-- Table structure for table `stanjeskladista`
--

DROP TABLE IF EXISTS `stanjeskladista`;
CREATE TABLE IF NOT EXISTS `stanjeskladista` (
  `id` int(11) NOT NULL,
  `tipDokumenta` varchar(5) DEFAULT NULL,
  `datumDokumenta` varchar(10) DEFAULT NULL,
  `sifraArtikla` int(20) DEFAULT NULL,
  `nazivArtikla` varchar(50) DEFAULT NULL,
  `kolicinaUlaz` int(20) DEFAULT NULL,
  `iznosUlaz` decimal(20,0) DEFAULT NULL,
  `kolicinaIzlaz` int(20) DEFAULT NULL,
  `iznosIzlaz` decimal(20,0) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK1` (`sifraArtikla`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `stavke`
--

DROP TABLE IF EXISTS `stavke`;
CREATE TABLE IF NOT EXISTS `stavke` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokument_id` int(11) DEFAULT NULL,
  `sifraArtikla` int(11) DEFAULT NULL,
  `kolicina` int(11) DEFAULT NULL,
  `JMJ` varchar(5) NOT NULL,
  `nazivArtikla` varchar(255) DEFAULT NULL,
  `cijenaArtikla` decimal(12,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk1` (`dokument_id`),
  KEY `fk2` (`sifraArtikla`)
) ENGINE=MyISAM AUTO_INCREMENT=265 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stavke`
--

INSERT INTO `stavke` (`id`, `dokument_id`, `sifraArtikla`, `kolicina`, `JMJ`, `nazivArtikla`, `cijenaArtikla`) VALUES
(1, 1, 1, 6, 'kom', NULL, NULL),
(2, 2, 2, 10, 'kom', NULL, NULL),
(3, 3, 3, 50, 'kom', NULL, NULL),
(4, 4, 4, 75, 'm', NULL, NULL),
(5, 5, 5, 100, 'kg', NULL, NULL),
(6, 6, 6, 120, 'kg', NULL, NULL),
(7, 7, 7, 150, 'kom', NULL, NULL),
(8, 8, 8, 200, 'm2', NULL, NULL),
(217, 187, 3, 4, 'kom', 'Ljepilo za keramiku', '2.00'),
(216, 187, 2, 3, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(264, 197, 3, 123, 'kom', 'Ljepilo za keramiku', '2.00'),
(263, 197, 2, 123123, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(262, 196, 50, 2, 'kom', 'mjesalica', '299.00'),
(261, 195, 46, 12, 'kg', 'Cement 3kg', '19.99'),
(260, 194, 46, 12, 'kg', 'Cement 3kg', '19.99'),
(259, 193, 45, 11, 'kom', 'cigla', '3.99'),
(258, 193, 8, 29, 'm2', 'Stiropor za fasade 8 cm', '24.00'),
(257, 193, 7, 43, 'kom', 'Betonski blok 40x20x16 cm', '20.00'),
(256, 193, 6, 11, 'kg', 'Cement Optimo', '1.00'),
(255, 193, 5, 22, 'kg', 'Zbuka temeljna', '2.00'),
(254, 193, 4, 25, 'm', 'Bakrena cijev 15x0,8 mm', '24.00'),
(253, 193, 3, 32, 'kom', 'Ljepilo za keramiku', '2.00'),
(252, 193, 2, 2, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(251, 192, 2, 3, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(250, 191, 45, 3, 'kom', 'cigla', '3.99'),
(249, 191, 8, 21, 'm2', 'Stiropor za fasade 8 cm', '24.00'),
(248, 191, 7, 32, 'kom', 'Betonski blok 40x20x16 cm', '20.00'),
(247, 191, 6, 10, 'kg', 'Cement Optimo', '1.00'),
(246, 191, 5, 3, 'kg', 'Zbuka temeljna', '2.00'),
(245, 191, 4, 43, 'm', 'Bakrena cijev 15x0,8 mm', '24.00'),
(244, 191, 3, 50, 'kom', 'Ljepilo za keramiku', '2.00'),
(243, 191, 2, 12, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(242, 190, 45, 16, 'kom', 'cigla', '3.99'),
(241, 190, 8, 51, 'm2', 'Stiropor za fasade 8 cm', '24.00'),
(240, 190, 7, 33, 'kom', 'Betonski blok 40x20x16 cm', '20.00'),
(239, 190, 6, 15, 'kg', 'Cement Optimo', '1.00'),
(238, 190, 5, 21, 'kg', 'Zbuka temeljna', '2.00'),
(237, 190, 4, 18, 'm', 'Bakrena cijev 15x0,8 mm', '24.00'),
(236, 190, 3, 3, 'kom', 'Ljepilo za keramiku', '2.00'),
(235, 190, 2, 11, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(234, 189, 45, 11, 'kom', 'cigla', '3.99'),
(233, 189, 8, 21, 'm2', 'Stiropor za fasade 8 cm', '24.00'),
(232, 189, 7, 15, 'kom', 'Betonski blok 40x20x16 cm', '20.00'),
(231, 189, 6, 3, 'kg', 'Cement Optimo', '1.00'),
(230, 189, 5, 12, 'kg', 'Zbuka temeljna', '2.00'),
(229, 189, 4, 1, 'm', 'Bakrena cijev 15x0,8 mm', '24.00'),
(228, 189, 3, 3, 'kom', 'Ljepilo za keramiku', '2.00'),
(227, 189, 2, 2, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(226, 188, 45, 20, 'kom', 'cigla', '3.99'),
(225, 188, 8, 1, 'm2', 'Stiropor za fasade 8 cm', '24.00'),
(224, 188, 7, 1, 'kom', 'Betonski blok 40x20x16 cm', '20.00'),
(223, 188, 6, 1, 'kg', 'Cement Optimo', '1.00'),
(222, 188, 5, 1, 'kg', 'Zbuka temeljna', '2.00'),
(221, 188, 4, 1, 'm', 'Bakrena cijev 15x0,8 mm', '24.00'),
(220, 188, 3, 1, 'kom', 'Ljepilo za keramiku', '2.00'),
(219, 188, 2, 1, 'kom', 'Opeka 50x19x19 cm', '7.00'),
(218, 187, 4, 2, 'm', 'Bakrena cijev 15x0,8 mm', '24.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
