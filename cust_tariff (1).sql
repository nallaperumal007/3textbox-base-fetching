-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2024 at 11:57 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `csdexpre_trip`
--

-- --------------------------------------------------------

--
-- Table structure for table `cust_tariff`
--

CREATE TABLE `cust_tariff` (
  `id` int(11) NOT NULL,
  `cust_brcode` varchar(100) DEFAULT NULL,
  `cust_code` varchar(10) DEFAULT NULL,
  `name` varchar(200) DEFAULT NULL,
  `org` varchar(100) DEFAULT NULL,
  `dest` varchar(100) DEFAULT NULL,
  `veh_type` varchar(3) DEFAULT '0',
  `rate` decimal(10,2) DEFAULT 0.00,
  `km_rate` decimal(10,2) DEFAULT 0.00,
  `kms` int(11) DEFAULT 0,
  `active_sts` varchar(1) DEFAULT NULL,
  `trip_type` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cust_tariff`
--
ALTER TABLE `cust_tariff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cust_tariff`
--
ALTER TABLE `cust_tariff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=143;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
