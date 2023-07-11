-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 10, 2023 at 02:14 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

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
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `firstName`, `middleName`, `lastName`, `position`, `birthday`, `gender`, `phone`, `email`, `province`, `city`, `barangay`, `street`, `user_name`, `password`, `role`, `image`, `dateCreated`) VALUES
(1, 'John Paulo', 'Arquiza', 'Bascuguin', 'Officer In Charge', '0000-00-00', 'Male', '09395424305', 'johnpauloarquizabascuguin@gmail.com', 'Kapito Lian, Batangas', '', '', '', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'd41d8cd98f00b204e9800998ecf8427e1686916117.jpg', '2023-06-24 20:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `crew_members`
--

CREATE TABLE `crew_members` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crew_members`
--

INSERT INTO `crew_members` (`id`, `firstName`, `middleName`, `lastName`, `position`, `birthday`, `gender`, `phone`, `email`, `province`, `city`, `barangay`, `street`, `image`, `dateCreated`) VALUES
(2, 'Arnold', 'Andulan', 'Mendoza', 'Crew Member', '1999-06-29', 'Female', '09395424305', 'Arnold@gmail.com', 'Batangas', 'Lian', 'Bungahan', 'Molino', '', '2023-07-03 15:33:30'),
(4, 'John Paulo', 'Arquiza', 'Bascuguin', 'Crew Member', '2023-07-04', 'Female', '5465454645', 'johnpauloarquizabascuguin@gmail.com', 'Batangas', 'Lian', 'Kapito', 'Molino', '', '2023-07-04 11:59:12');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `firstName`, `middleName`, `lastName`, `position`, `birthday`, `gender`, `phone`, `email`, `province`, `city`, `barangay`, `street`, `user_name`, `password`, `role`, `image`, `dateCreated`) VALUES
(3, 'Cedrick', 'Bautista', 'Andulan', '', '2011-07-09', 'Male', '09395424305', 'Arnold@gmail.com', 'Batangas', 'Lian', 'Kapito', 'Molino', 'angelo', 'db5f129ea96443734426b116276a1766', 'driver', '', '2023-07-07 23:39:16'),
(4, 'Marian', 'Arquiza', 'Bascuguin', 'Driver', '1999-03-27', 'Female', '09267755223', 'Marian@gmail.com', 'Cavite', 'Alfonzo', 'Kapito', 'Alatires', '', '', '', '', '2023-07-09 19:49:05');

-- --------------------------------------------------------

--
-- Table structure for table `garbage_trucks`
--

CREATE TABLE `garbage_trucks` (
  `id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `capacity` varchar(50) NOT NULL,
  `plateNumber` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `garbage_trucks`
--

INSERT INTO `garbage_trucks` (`id`, `brand`, `model`, `capacity`, `plateNumber`) VALUES
(21, 'Volvo', 'VHD', '15', 'ABC123'),
(22, 'Mercedes', 'Econic', '20', 'DEF456');

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

CREATE TABLE `staffs` (
  `id` int(11) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `middleName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `barangay` varchar(100) NOT NULL,
  `street` varchar(100) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `dateCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staffs`
--

INSERT INTO `staffs` (`id`, `firstName`, `middleName`, `lastName`, `position`, `birthday`, `gender`, `phone`, `email`, `province`, `city`, `barangay`, `street`, `user_name`, `password`, `role`, `image`, `dateCreated`) VALUES
(6, 'Layka', 'Arquiza', 'Bascuguin', '', '0000-00-00', '', '09395424305', '20-71291@g.batstate-u.edu.ph', '', '', '', '', '', '', '', '', '2023-07-07 23:24:53'),
(7, 'Carlo', 'Arquiza', 'Bascuguin', '', '0000-00-00', '', '09395424305', '20-71291@g.batstate-u.edu.ph', '', '', '', '', 'carlo', 'db5f129ea96443734426b116276a1766', 'staff', '', '2023-07-08 00:26:20'),
(8, 'John Paulo', 'Arquiza', 'Bascuguin', '', '0000-00-00', '', '09395424305', '20-71291@g.batstate-u.edu.ph', '', '', '', '', 'johnpaulo', 'db5f129ea96443734426b116276a1766', 'staff', '', '2023-07-08 00:58:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `crew_members`
--
ALTER TABLE `crew_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `garbage_trucks`
--
ALTER TABLE `garbage_trucks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffs`
--
ALTER TABLE `staffs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `crew_members`
--
ALTER TABLE `crew_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `garbage_trucks`
--
ALTER TABLE `garbage_trucks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staffs`
--
ALTER TABLE `staffs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
