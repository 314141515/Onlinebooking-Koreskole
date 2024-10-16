-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 09, 2024 at 07:59 AM
-- Server version: 8.3.0
-- PHP Version: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `korelerer`
--

DROP TABLE IF EXISTS `korelerer`;
CREATE TABLE IF NOT EXISTS `korelerer` (
  `KoreLereId` int NOT NULL AUTO_INCREMENT,
  `KoreLereNavn` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `Gear` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `Erfaring` int NOT NULL,
  PRIMARY KEY (`KoreLereId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `korelerer`
--

INSERT INTO `korelerer` (`KoreLereId`, `KoreLereNavn`, `Gear`, `Erfaring`) VALUES
(4, 'Svejs', 'Automat', 8),
(3, 'Azwar', 'Manuel', 6);

-- --------------------------------------------------------

--
-- Table structure for table `koreselekstra`
--

DROP TABLE IF EXISTS `koreselekstra`;
CREATE TABLE IF NOT EXISTS `koreselekstra` (
  `EkstraId` int NOT NULL AUTO_INCREMENT,
  `KorseEkstraNavn` varchar(100) COLLATE utf8mb3_danish_ci NOT NULL,
  `KorseEkstraTid` varchar(50) COLLATE utf8mb3_danish_ci NOT NULL,
  `KorseEkstraPris` decimal(10,2) NOT NULL,
  PRIMARY KEY (`EkstraId`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `koreselekstra`
--

INSERT INTO `koreselekstra` (`EkstraId`, `KorseEkstraNavn`, `KorseEkstraTid`, `KorseEkstraPris`) VALUES
(1, 'Ekstra Køresel', '1 time og 30 min', 1000.00),
(2, 'Ekstra Kørsel ', '45 minutter', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `korsel`
--

DROP TABLE IF EXISTS `korsel`;
CREATE TABLE IF NOT EXISTS `korsel` (
  `KorselNavn` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `KorselsTid` varchar(150) CHARACTER SET utf8mb3 COLLATE utf8mb3_danish_ci NOT NULL,
  `KorselsPris` int NOT NULL,
  PRIMARY KEY (`KorselNavn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;

--
-- Dumping data for table `korsel`
--

INSERT INTO `korsel` (`KorselNavn`, `KorselsTid`, `KorselsPris`) VALUES
('Kørsel 1', '1 time og 30 min', 1000),
('Kørsel 2', '1 time og 30 min', 1000),
('Kørsel 3', '1 time og 30 min', 1000),
('Kørsel 4', '1 time og 30 min', 1000),
('Kørsel 5', '1 time og 30 min', 1000),
('Kørsel 6', '1 time og 30 min', 1000),
('Kørsel 7', '1 time og 30 min', 1000),
('Kørsel 8', '1 time og 30 min', 1000);

-- --------------------------------------------------------

--
-- Table structure for table `valgte_datoer`
--

DROP TABLE IF EXISTS `valgte_datoer`;
CREATE TABLE IF NOT EXISTS `valgte_datoer` (
  `id` int NOT NULL AUTO_INCREMENT,
  `dato` date NOT NULL,
  `brugernavn` varchar(100) COLLATE utf8mb3_danish_ci NOT NULL,
  `tid` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `dato` (`dato`,`tid`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_danish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
