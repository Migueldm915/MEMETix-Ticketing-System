-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 12:28 PM
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
-- Database: `memetix`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `paymentID` int(11) NOT NULL,
  `userID` int(11) DEFAULT NULL,
  `eventID` int(11) DEFAULT NULL,
  `payment_mode` enum('Card','GCash') NOT NULL,
  `payment_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `cartID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `checkout`
--

INSERT INTO `checkout` (`paymentID`, `userID`, `eventID`, `payment_mode`, `payment_date`, `cartID`) VALUES
(47, NULL, 1, '', '2024-04-04 01:42:42', NULL),
(48, NULL, 1, '', '2024-04-04 01:43:46', NULL),
(49, NULL, 1, '', '2024-04-04 01:45:38', NULL),
(50, NULL, 1, '', '2024-04-04 01:45:43', NULL),
(51, NULL, 1, '', '2024-04-04 01:46:14', NULL),
(52, NULL, 1, '', '2024-04-04 01:56:56', NULL),
(53, NULL, 1, '', '2024-04-04 01:59:21', NULL),
(54, NULL, 1, '', '2024-04-04 02:00:08', NULL),
(55, NULL, 1, '', '2024-04-04 02:03:19', NULL),
(56, NULL, 1, '', '2024-04-04 02:06:35', NULL),
(57, NULL, 1, '', '2024-04-04 02:08:21', NULL),
(58, NULL, 1, '', '2024-04-04 02:10:15', NULL),
(59, NULL, 1, '', '2024-04-04 02:10:44', NULL),
(62, NULL, 1, '', '2024-04-04 02:11:45', NULL),
(63, NULL, 1, '', '2024-04-04 02:20:47', NULL),
(64, NULL, 1, '', '2024-04-04 02:22:21', NULL),
(65, NULL, 1, '', '2024-04-04 02:23:48', NULL),
(66, NULL, 6, '', '2024-04-04 02:26:38', NULL),
(67, NULL, 3, '', '2024-04-04 03:38:41', NULL),
(68, NULL, 1, '', '2024-04-04 10:25:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eventlist`
--

CREATE TABLE `eventlist` (
  `eventID` int(11) NOT NULL,
  `eventname` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `picture` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventlist`
--

INSERT INTO `eventlist` (`eventID`, `eventname`, `venue`, `date`, `time`, `picture`) VALUES
(1, 'IVE The First World Tour', 'SM MOA', 'July 13, 2024', '7:00 PM', 'event1.jpg'),
(3, 'ED SHEERAN', 'SMDC Festival Grounds', 'April 9, 2024', '6:30 PM', 'event2.jpg'),
(4, 'Niall Horan 2024', 'SM MOA', 'May 13, 2024', '7:00 PM', 'event3.png'),
(5, 'Aurora Music Festival', 'Clark Global City', 'April 6, 2024', '2:00 PM', 'event4.jpeg'),
(6, 'Aurora Music Festival', 'Clark Global City', 'April 7, 2024', '2:00 PM', 'event4.jpeg'),
(18, 'BTOB FAN-CON 2024', 'SM MOA', 'April 07, 2024', '06:00 PM', 'event5.jpeg'),
(20, 'Boys Like Girls', 'Araneta Coliseum', 'April 20, 2024', '08:00 PM', 'event6.jpeg'),
(22, 'Elliot Concert Bananza', 'Sa Bahay ni Elliot', 'February 29, 2028', '12:00 AM', 'event7.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `eventsections`
--

CREATE TABLE `eventsections` (
  `eventID` int(11) DEFAULT NULL,
  `vip_price` decimal(10,2) DEFAULT NULL,
  `lb_price` decimal(10,2) DEFAULT NULL,
  `ub_price` decimal(10,2) DEFAULT NULL,
  `genad_price` decimal(10,2) DEFAULT NULL,
  `vip_count` int(11) DEFAULT NULL,
  `lb_count` int(11) DEFAULT NULL,
  `ub_count` int(11) DEFAULT NULL,
  `genad_count` int(11) DEFAULT NULL,
  `vip_quantity` int(11) NOT NULL,
  `lb_quantity` int(11) NOT NULL,
  `ub_quantity` int(11) NOT NULL,
  `genad_quantity` int(11) NOT NULL,
  `cartID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventsections`
--

INSERT INTO `eventsections` (`eventID`, `vip_price`, `lb_price`, `ub_price`, `genad_price`, `vip_count`, `lb_count`, `ub_count`, `genad_count`, `vip_quantity`, `lb_quantity`, `ub_quantity`, `genad_quantity`, `cartID`) VALUES
(1, 100.00, 80.00, 60.00, 40.00, 200, 250, 350, 400, 0, 0, 0, 0, 7),
(3, 120.00, 90.00, 70.00, 50.00, 150, 250, 350, 450, 0, 0, 0, 0, 8),
(4, 150.00, 100.00, 80.00, 60.00, 200, 300, 400, 500, 0, 0, 0, 0, 9),
(5, 180.00, 110.00, 90.00, 60.00, 200, 300, 400, 450, 0, 0, 0, 0, 10),
(6, 200.00, 120.00, 100.00, 50.00, 150, 250, 350, 450, 0, 0, 0, 0, 11),
(18, 220.00, 130.00, 110.00, 40.00, 100, 200, 350, 450, 0, 0, 0, 0, 12),
(20, 50.00, 45.00, 40.00, 15.00, 100, 250, 400, 750, 0, 0, 0, 0, 13),
(22, 5000.00, 2500.00, 1250.00, 725.00, 50, 100, 125, 150, 0, 0, 0, 0, 15);

-- --------------------------------------------------------

--
-- Table structure for table `login_userdetails`
--

CREATE TABLE `login_userdetails` (
  `userID` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwords` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_userdetails`
--

INSERT INTO `login_userdetails` (`userID`, `username`, `passwords`, `lastname`, `firstname`, `email`) VALUES
(1, 'eli', '12345', 'Dela Cruz', 'Elisha Belle', 'elisha_delacruz@dlsu.edu.ph'),
(13, 'JackBogart', 'password', 'BOgart', 'Jack', 'bogart@coolkid.com'),
(14, 'komi', '12345', 'sedonk', 'mikoko', 'miko@miko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `userID` (`userID`),
  ADD KEY `eventID` (`eventID`),
  ADD KEY `fk_cartID` (`cartID`);

--
-- Indexes for table `eventlist`
--
ALTER TABLE `eventlist`
  ADD PRIMARY KEY (`eventID`);

--
-- Indexes for table `eventsections`
--
ALTER TABLE `eventsections`
  ADD PRIMARY KEY (`cartID`),
  ADD KEY `eventID` (`eventID`);

--
-- Indexes for table `login_userdetails`
--
ALTER TABLE `login_userdetails`
  ADD PRIMARY KEY (`userID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `paymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `eventlist`
--
ALTER TABLE `eventlist`
  MODIFY `eventID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `eventsections`
--
ALTER TABLE `eventsections`
  MODIFY `cartID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `login_userdetails`
--
ALTER TABLE `login_userdetails`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkout`
--
ALTER TABLE `checkout`
  ADD CONSTRAINT `checkout_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `login_userdetails` (`userID`),
  ADD CONSTRAINT `checkout_ibfk_2` FOREIGN KEY (`eventID`) REFERENCES `eventlist` (`eventID`),
  ADD CONSTRAINT `fk_cartID` FOREIGN KEY (`cartID`) REFERENCES `eventsections` (`cartID`);

--
-- Constraints for table `eventsections`
--
ALTER TABLE `eventsections`
  ADD CONSTRAINT `eventsections_ibfk_1` FOREIGN KEY (`eventID`) REFERENCES `eventlist` (`eventID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
