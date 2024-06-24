-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2024 at 03:54 AM
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
-- Database: `import`
--

-- --------------------------------------------------------

--
-- Table structure for table `db_tables`
--

CREATE TABLE `db_tables` (
  `id` int(11) NOT NULL,
  `rundate` date NOT NULL,
  `dbname` varchar(255) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `noof_rec` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `db_tables`
--

INSERT INTO `db_tables` (`id`, `rundate`, `dbname`, `tablename`, `noof_rec`) VALUES
(1, '2023-06-19', ' SalesDB', ' SalesData', 1500),
(2, '2023-06-18', ' HRDB', ' Employees', 500),
(3, '2023-06-17', ' Inventory', ' Products', 3000),
(4, '2023-06-19', ' SalesDB', ' SalesData', 1500),
(5, '2023-06-18', ' HRDB', ' Employees', 500),
(6, '2023-06-17', ' Inventory', ' Products', 3000),
(7, '2023-06-19', ' SalesDB', ' SalesData', 1500),
(8, '2023-06-18', ' HRDB', ' Employees', 500),
(9, '2023-06-17', ' Inventory', ' Products', 3000),
(10, '2023-06-19', ' SalesDB', ' SalesData', 1500),
(11, '2023-06-18', ' HRDB', ' Employees', 500),
(12, '2023-06-17', ' Inventory', ' Products', 3000);

-- --------------------------------------------------------

--
-- Table structure for table `runfile`
--

CREATE TABLE `runfile` (
  `id` int(11) NOT NULL,
  `rundate` date NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `runfile`
--

INSERT INTO `runfile` (`id`, `rundate`, `remarks`) VALUES
(1, '2023-06-19', 'Import'),
(2, '2023-06-19', 'Import'),
(3, '2023-06-19', 'Import'),
(4, '2023-06-19', 'Import');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `db_tables`
--
ALTER TABLE `db_tables`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `runfile`
--
ALTER TABLE `runfile`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `db_tables`
--
ALTER TABLE `db_tables`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `runfile`
--
ALTER TABLE `runfile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
