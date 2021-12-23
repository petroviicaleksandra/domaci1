-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2021 at 04:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `domaciphp`
--

-- --------------------------------------------------------

--
-- Table structure for table `film`
--

CREATE TABLE `film` (
  `filmId` int(11) NOT NULL,
  `naziv` varchar(255) NOT NULL,
  `trajanje` int(11) NOT NULL,
  `zanr` varchar(255) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `film`
--

INSERT INTO `film` (`filmId`, `naziv`, `trajanje`, `zanr`, `datum`) VALUES
(1, 'Marriage Story', 136, 'Drama', '2021-12-21'),
(2, 'Inception', 148, 'Akcija', '2021-12-23'),
(3, 'Atonement', 123, 'Drama', '2021-12-29'),
(4, 'The Prestige', 130, 'Triler', '2021-12-28'),
(5, 'Se7en', 127, 'Krimi', '2021-12-26'),
(6, 'Little Women', 135, 'Romansa', '2021-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `karta`
--

CREATE TABLE `karta` (
  `brojKarte` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `filmId` int(11) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `karta`
--

INSERT INTO `karta` (`brojKarte`, `userId`, `filmId`, `email`) VALUES
(7, 2, 2, 'admin@gmail.com'),
(8, 1, 6, 'aleks@gmail.com'),
(9, 1, 1, 'user@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `UserId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`UserId`, `username`, `password`) VALUES
(1, 'admin', 'admin'),
(2, 'aleks', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `film`
--
ALTER TABLE `film`
  ADD PRIMARY KEY (`filmId`);

--
-- Indexes for table `karta`
--
ALTER TABLE `karta`
  ADD PRIMARY KEY (`brojKarte`),
  ADD KEY `fk_User` (`userId`),
  ADD KEY `fk_film` (`filmId`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`UserId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `karta`
--
ALTER TABLE `karta`
  MODIFY `brojKarte` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `UserId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `karta`
--
ALTER TABLE `karta`
  ADD CONSTRAINT `fk_User` FOREIGN KEY (`UserId`) REFERENCES `korisnik` (`UserId`),
  ADD CONSTRAINT `fk_film` FOREIGN KEY (`FilmId`) REFERENCES `film` (`FilmId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
