-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 05, 2020 at 06:19 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chemtronics_india`
--
CREATE DATABASE IF NOT EXISTS `chemtronics_india` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `chemtronics_india`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `companyName` varchar(50) NOT NULL,
  `countryCode` varchar(8) NOT NULL,
  `mobileNumber` varchar(15) NOT NULL,
  `endUser` varchar(32) NOT NULL,
  `email` varchar(320) NOT NULL,
  `token` char(100) NOT NULL,
  `password` char(60) NOT NULL,
  `emailVerified` tinyint(1) NOT NULL,
  `mobileVerified` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `companyName`, `countryCode`, `mobileNumber`, `endUser`, `email`, `token`, `password`, `emailVerified`, `mobileVerified`) VALUES
(3, 'Arihant', 'Lunkar', '', '+91', '9560810245', 'End User', 'arihant-cse15@snu.edu.in', 'e48eaaa15abd1462c586753a6f553edb40ba4ba959fce0916d13c7e5e80d9e8688660280311b236f2696efead6ff2c5d224e', '$2y$10$gB8XepERN.k3ZT1FGgJCF.cpclvm7SxEVeUcccdto3VkTZJcDiMy.', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
