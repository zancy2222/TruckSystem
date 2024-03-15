-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2024 at 02:42 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trucksystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `repairexpenses`
--

CREATE TABLE `repairexpenses` (
  `PlateNumber` varchar(255) NOT NULL,
  `ExpenseDate` date NOT NULL,
  `ExpenseType` varchar(255) DEFAULT NULL,
  `Cost` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tripmonitor`
--

CREATE TABLE `tripmonitor` (
  `TripID` int(11) NOT NULL,
  `ClientName` varchar(255) DEFAULT NULL,
  `PlateNumber` varchar(255) DEFAULT NULL,
  `DeliveryDate` date DEFAULT NULL,
  `Source` varchar(255) DEFAULT NULL,
  `Destination` varchar(255) DEFAULT NULL,
  `Rate` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `truck`
--

CREATE TABLE `truck` (
  `TruckID` int(11) NOT NULL,
  `PlateNumber` varchar(255) DEFAULT NULL,
  `TruckType` varchar(255) DEFAULT NULL,
  `TruckMake` varchar(255) DEFAULT NULL,
  `EngineNumber` varchar(255) DEFAULT NULL,
  `ChassisNumber` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `repairexpenses`
--
ALTER TABLE `repairexpenses`
  ADD PRIMARY KEY (`PlateNumber`,`ExpenseDate`);

--
-- Indexes for table `tripmonitor`
--
ALTER TABLE `tripmonitor`
  ADD PRIMARY KEY (`TripID`),
  ADD KEY `PlateNumber` (`PlateNumber`);

--
-- Indexes for table `truck`
--
ALTER TABLE `truck`
  ADD PRIMARY KEY (`TruckID`),
  ADD UNIQUE KEY `PlateNumber` (`PlateNumber`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tripmonitor`
--
ALTER TABLE `tripmonitor`
  MODIFY `TripID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `truck`
--
ALTER TABLE `truck`
  MODIFY `TruckID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `repairexpenses`
--
ALTER TABLE `repairexpenses`
  ADD CONSTRAINT `repairexpenses_ibfk_1` FOREIGN KEY (`PlateNumber`) REFERENCES `truck` (`PlateNumber`);

--
-- Constraints for table `tripmonitor`
--
ALTER TABLE `tripmonitor`
  ADD CONSTRAINT `tripmonitor_ibfk_1` FOREIGN KEY (`PlateNumber`) REFERENCES `truck` (`PlateNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
