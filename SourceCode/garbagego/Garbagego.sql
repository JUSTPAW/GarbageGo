-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2023 at 09:52 AM
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
-- Database: `garbagego`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `AdminID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Position` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`AdminID`, `FirstName`, `LastName`, `PhoneNo`, `Position`, `Email`, `Address`) VALUES
(1, 'Diego', 'Hernandez', 935535553, 'Admin', 'adminexample@gmail.com', 'Barangay, Malaruhatan Lian,Batangas');

-- --------------------------------------------------------

--
-- Table structure for table `completioninformation`
--

CREATE TABLE `completioninformation` (
  `CIID` int(11) NOT NULL,
  `DateCompleted` date NOT NULL,
  `MaterialsUsed` varchar(50) NOT NULL,
  `TimeRequired` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `completioninformation`
--

INSERT INTO `completioninformation` (`CIID`, `DateCompleted`, `MaterialsUsed`, `TimeRequired`) VALUES
(1, '0000-00-00', 'Request for Repair/Servicing', '2023-06-26 09:33:32'),
(2, '0000-00-00', 'Maintenance Work Order Form', '2023-06-26 09:33:32'),
(3, '0000-00-00', 'Drivers Trip Ticket', '2023-06-26 09:33:32'),
(4, '0000-00-00', 'Waste Collection Monitoring Report', '2023-06-26 09:33:32');

-- --------------------------------------------------------

--
-- Table structure for table `crewmember`
--

CREATE TABLE `crewmember` (
  `CrewID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `crewmember`
--

INSERT INTO `crewmember` (`CrewID`, `FirstName`, `LastName`, `PhoneNo`, `Email`, `Address`) VALUES
(1, 'Anthony', 'De Lima', 935535553, 'anthonydelima@gamil.com', 'Barangay, Tres Lian,Batangas'),
(2, 'Maccoy', 'Ignacio', 925525552, 'maccoyignacio@gmail.com', 'Barangay, Dos Lian,Batangas'),
(3, 'Gerald', 'Estacion', 945545545, 'geraldestacion@gmail.com', 'Barangay, Dos Lian, Batangas'),
(4, 'Jinggoy', 'Particio', 936636663, 'jinggoyparticio', 'Barangay, Malaruhatan Lian,Batangas'),
(5, 'Carlo', 'Pagandoy', 975575575, 'carlopagandoy@gmail.com', 'Barangay, 4 Lian, Batangas');

-- --------------------------------------------------------

--
-- Table structure for table `garbagetruck`
--

CREATE TABLE `garbagetruck` (
  `GTID` int(11) NOT NULL,
  `PlateNumber` varchar(50) NOT NULL,
  `TruckModel` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `garbagetruck`
--

INSERT INTO `garbagetruck` (`GTID`, `PlateNumber`, `TruckModel`) VALUES
(1, 'GC 2260', 'Foton'),
(2, '10B704', 'Foton'),
(3, 'GC22710', 'Foton'),
(4, '23CG08', 'Foton'),
(5, 'CG 55467', 'Foton');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `ScheID` int(11) NOT NULL,
  `Day` varchar(50) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `DateCreated` datetime NOT NULL,
  `DateonUpdate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`ScheID`, `Day`, `Location`, `DateCreated`, `DateonUpdate`) VALUES
(1, 'Monday', 'Barangay, Uno Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(2, 'Monday', 'Barangay, Dos Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(3, 'Monday', 'Barangay, Tres Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(4, 'Monday', 'Barangay, 4 Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(5, 'Monday', 'Barangay, 5 Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(6, 'Tuesday', 'Barangay, Malaruhatan Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(7, 'Wednesday', 'Barangay, San Diego Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(8, 'Thursday', 'Barangay, Binubusan Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(9, 'Thursday', 'Barangay, Luyahan Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03'),
(10, 'Friday', 'Barangay, Matabungkay Lian, Batangas', '2023-06-26 09:24:03', '2023-06-26 09:24:03');

-- --------------------------------------------------------

--
-- Table structure for table `truckdriver`
--

CREATE TABLE `truckdriver` (
  `TDID` int(11) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `PhoneNo` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `truckdriver`
--

INSERT INTO `truckdriver` (`TDID`, `FirstName`, `LastName`, `PhoneNo`, `Email`, `Address`) VALUES
(1, 'Gregor', 'Tenorio', 996784567, 'gregor@gmail.com', 'Barangay, Bungahan Lian,Batangas'),
(2, 'Leonardo', 'Davila', 956438762, 'leonardodavid@gmail.com', 'Barangay, Prenza Lian, Batangas'),
(3, 'Edgar', 'Dimakulangan', 987065432, 'edgardimakulangan@gmail.com', 'Barangay, Bagong Pook Lian, Batangas'),
(4, 'Angelo', 'Firma', 987645329, 'angelofirma@gmail.com', 'Barangay, Malaruhatan Lian, Batangas'),
(5, 'Kanor', 'Dimagiba', 987689654, 'kanor@gmail.com', 'Barangay, Puting Kahoy Lian, Batangas');

-- --------------------------------------------------------

--
-- Table structure for table `wastecollectionreport`
--

CREATE TABLE `wastecollectionreport` (
  `WCRID` int(11) NOT NULL,
  `OfficialStation` varchar(50) NOT NULL,
  `DistanceRoute` varchar(50) NOT NULL,
  `WasteVolumeDisposed` int(11) NOT NULL,
  `GTID` int(11) NOT NULL,
  `TDID` int(11) NOT NULL,
  `CrewID` int(11) NOT NULL,
  `LocID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AdminID`);

--
-- Indexes for table `completioninformation`
--
ALTER TABLE `completioninformation`
  ADD PRIMARY KEY (`CIID`);

--
-- Indexes for table `crewmember`
--
ALTER TABLE `crewmember`
  ADD PRIMARY KEY (`CrewID`);

--
-- Indexes for table `garbagetruck`
--
ALTER TABLE `garbagetruck`
  ADD PRIMARY KEY (`GTID`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`ScheID`);

--
-- Indexes for table `truckdriver`
--
ALTER TABLE `truckdriver`
  ADD PRIMARY KEY (`TDID`);

--
-- Indexes for table `wastecollectionreport`
--
ALTER TABLE `wastecollectionreport`
  ADD PRIMARY KEY (`WCRID`),
  ADD UNIQUE KEY `CrewID` (`CrewID`),
  ADD UNIQUE KEY `GTID` (`GTID`),
  ADD UNIQUE KEY `TDID` (`TDID`),
  ADD UNIQUE KEY `LocID` (`LocID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `completioninformation`
--
ALTER TABLE `completioninformation`
  MODIFY `CIID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `crewmember`
--
ALTER TABLE `crewmember`
  MODIFY `CrewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `garbagetruck`
--
ALTER TABLE `garbagetruck`
  MODIFY `GTID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `ScheID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `truckdriver`
--
ALTER TABLE `truckdriver`
  MODIFY `TDID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `wastecollectionreport`
--
ALTER TABLE `wastecollectionreport`
  MODIFY `WCRID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
