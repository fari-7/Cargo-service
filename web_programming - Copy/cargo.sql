-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2024 at 07:07 PM
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
-- Database: `cargo`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_details`
--

CREATE TABLE `customer_details` (
  `fn` text NOT NULL,
  `ln` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `ph` int(20) NOT NULL,
  `tph` int(20) NOT NULL,
  `nid` int(50) NOT NULL,
  `dob` date NOT NULL,
  `Gender` text NOT NULL,
  `pass` varchar(255) NOT NULL,
  `ref` text NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer_details`
--

INSERT INTO `customer_details` (`fn`, `ln`, `mail`, `ph`, `tph`, `nid`, `dob`, `Gender`, `pass`, `ref`, `file_name`, `file_path`) VALUES
('promit', 'saha', 'promit@gmail.com', 1311211091, 0, 698555, '2024-12-23', 'Male', '$2y$10$hj050B7kbTSzuO9IsV5ik.1oNJoHBpItuMSfO5l6NrQmwxI3d8wrK', '', '67690d8f7ea39_BDS.docx', 'uploads/67690d8f7ea39_BDS.docx');

-- --------------------------------------------------------

--
-- Table structure for table `member_details`
--

CREATE TABLE `member_details` (
  `fn` text NOT NULL,
  `ln` text NOT NULL,
  `mail` varchar(50) NOT NULL,
  `ph` int(50) NOT NULL,
  `tph` int(50) NOT NULL,
  `nid` int(50) NOT NULL,
  `dob` date NOT NULL,
  `Gender` text NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member_details`
--

INSERT INTO `member_details` (`fn`, `ln`, `mail`, `ph`, `tph`, `nid`, `dob`, `Gender`, `pass`) VALUES
('fariha', 'tabassum', 'tabahshsh@gmail.com', 1311211091, 0, 698555, '2024-12-23', 'Female', '$2y$10$P59yGHWbWRdP6z3vhoY.aenWW2BEha529ht5/j5TSAbHaK2v7rKS.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_details`
--
ALTER TABLE `customer_details`
  ADD PRIMARY KEY (`ph`);

--
-- Indexes for table `member_details`
--
ALTER TABLE `member_details`
  ADD PRIMARY KEY (`ph`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
