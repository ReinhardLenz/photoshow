-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db1.n.kapsi.fi
-- Generation Time: Aug 10, 2023 at 09:35 AM
-- Server version: 10.5.19-MariaDB-0+deb11u2
-- PHP Version: 8.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `raikkulenz`
--

-- --------------------------------------------------------

--
-- Table structure for table `sketches`
--

CREATE TABLE `sketches` (
  `id` int(128) NOT NULL,
  `rotate` int(128) NOT NULL,
  `text` varchar(1024) NOT NULL,
  `file` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `sketches`
--

INSERT INTO `sketches` (`id`, `rotate`, `text`, `file`) VALUES
(0, 270, 'ikkuna', 'ikkuna.png'),
(1, 270, 'hiiri', '2_hiiri.png'),
(2, 270, 'hundert', '1hundert.png'),
(3, 270, 'Piippu', 'piippu.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
