-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 09:56 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garabagego`
--

-- --------------------------------------------------------

--
-- Table structure for table `fuelconsumption`
--

CREATE TABLE `fuelconsumption` (
  `id` int(11) NOT NULL,
  `FuelType` varchar(40) NOT NULL,
  `TankBalance` int(11) NOT NULL,
  `FuelPurchased` int(11) NOT NULL,
  `FeulDeduct` int(11) NOT NULL,
  `EndTripTankBalance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuelconsumption`
--

INSERT INTO `fuelconsumption` (`id`, `FuelType`, `TankBalance`, `FuelPurchased`, `FeulDeduct`, `EndTripTankBalance`) VALUES
(1, 'Diesel', 75, 5, 8, 67),
(2, 'Diesel', 67, 10, 5, 72),
(3, 'Diesel', 72, 5, 6, 71),
(4, 'Diesel', 71, 3, 7, 67),
(5, 'Diesel', 67, 5, 10, 62),
(6, 'Diesel', 62, 3, 7, 58);

-- --------------------------------------------------------

--
-- Table structure for table `maintenancedetail`
--

CREATE TABLE `maintenancedetail` (
  `id` int(11) NOT NULL,
  `DateRequest` date NOT NULL,
  `RequestBy` varchar(50) NOT NULL,
  `WorkOrderNo` int(11) NOT NULL,
  `WorkPerformedBy` varchar(50) NOT NULL,
  `DescriptionRepair/Maintenance` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maintenancedetail`
--

INSERT INTO `maintenancedetail` (`id`, `DateRequest`, `RequestBy`, `WorkOrderNo`, `WorkPerformedBy`, `DescriptionRepair/Maintenance`) VALUES
(1, '2023-06-26', 'Lian Menro', 1, 'talyer', 'Change of Battery'),
(2, '2023-06-30', 'Lian Mernro', 2, 'Talyer', 'Change of Brake Pad '),
(3, '2023-07-02', 'Lian Menro', 3, 'Talyer', 'Change of Fuel Pump'),
(4, '2023-07-07', 'Lian Mernro', 4, 'Talyer', 'Water Pump'),
(5, '2023-07-09', 'Lian Menro', 5, 'Talyer', 'Change of Battery Terminal'),
(6, '2023-07-14', 'Lian Mernro', 6, 'Talyer', 'Engine Low Power and White Smoke');

-- --------------------------------------------------------

--
-- Table structure for table `materialrequired`
--

CREATE TABLE `materialrequired` (
  `id` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `UnitOfIssue` varchar(50) NOT NULL,
  `Item` varchar(50) NOT NULL,
  `StockNo` int(11) NOT NULL,
  `Cost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materialrequired`
--

INSERT INTO `materialrequired` (`id`, `Quantity`, `UnitOfIssue`, `Item`, `StockNo`, `Cost`) VALUES
(1, 1, 'set', 'Water Pump', 0, 16500),
(2, 2, 'Set', 'Engine Battery', 0, 8700),
(4, 2, 'set', 'Battery Terminal', 0, 200),
(5, 1, 'set', 'Fuel Pump', 0, 11000),
(6, 2, 'Set', 'Clutch', 1, 2400),
(7, 4, ' set', 'Brake Pad', 0, 4400),
(8, 6, 'Set', 'Bushings', 0, 1800);

-- --------------------------------------------------------

--
-- Table structure for table `menrostaff`
--

CREATE TABLE `menrostaff` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tripticket`
--

CREATE TABLE `tripticket` (
  `id` int(11) NOT NULL,
  `GarbageDepartureTime` time NOT NULL,
  `LocationArrivalTime` time NOT NULL,
  `GarbageArrivalTime` int(11) NOT NULL,
  `TravelPurpuse` varchar(50) NOT NULL,
  `Date` date NOT NULL,
  `GTID` int(11) NOT NULL,
  `TDID` int(11) NOT NULL,
  `LocID` int(11) NOT NULL,
  `FCID` int(11) NOT NULL,
  `AdminID` int(11) NOT NULL,
  `StaffID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fuelconsumption`
--
ALTER TABLE `fuelconsumption`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maintenancedetail`
--
ALTER TABLE `maintenancedetail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `materialrequired`
--
ALTER TABLE `materialrequired`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menrostaff`
--
ALTER TABLE `menrostaff`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tripticket`
--
ALTER TABLE `tripticket`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fuelconsumption`
--
ALTER TABLE `fuelconsumption`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `maintenancedetail`
--
ALTER TABLE `maintenancedetail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `materialrequired`
--
ALTER TABLE `materialrequired`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `menrostaff`
--
ALTER TABLE `menrostaff`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tripticket`
--
ALTER TABLE `tripticket`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
