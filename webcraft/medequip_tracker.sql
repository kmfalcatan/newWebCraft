-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 09:30 PM
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
-- Database: `medequip_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_ID` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `article` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `deployment` varchar(255) NOT NULL,
  `property_number` varchar(255) NOT NULL,
  `account_code` varchar(255) NOT NULL,
  `total_unit` int(11) NOT NULL,
  `unit_value` varchar(255) NOT NULL,
  `total_value` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `year_received` int(11) NOT NULL,
  `warranty_image` varchar(255) DEFAULT NULL,
  `warranty_start` date DEFAULT NULL,
  `warranty_end` date DEFAULT NULL,
  `instruction` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `equipment`
--

INSERT INTO `equipment` (`equipment_ID`, `image`, `article`, `description`, `deployment`, `property_number`, `account_code`, `total_unit`, `unit_value`, `total_value`, `remarks`, `year_received`, `warranty_image`, `warranty_start`, `warranty_end`, `instruction`) VALUES
(1, 'in.png', 'Charot', '', 'css', 'ICS-22-FO10', '1233-4545-99', 2, '100', '200.00', '', 2022, '', '0000-00-00', '0000-00-00', '')

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_ID` int(11) NOT NULL,
  `equipment_ID` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_ID`, `equipment_ID`, `equipment_name`, `user_ID`, `user`) VALUES
(1, 1, 'Charot', NULL, 'Padwa Tingkasan'),
(2, 1, 'Charot', NULL, 'Padwa Tingkasan'),

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_ID` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_initial` char(5) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user','anonymous') NOT NULL DEFAULT 'anonymous',
  `email` varchar(255) NOT NULL,
  `contact` varchar(15) NOT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `first_name`, `last_name`, `middle_initial`, `password`, `role`, `email`, `contact`, `designation`, `department`, `profile_img`, `gender`, `address`) VALUES
(1, 'admin@wmsu', 'Ryan Jonathan', 'Torres', 'I', '$2y$10$XG8/NXUe/iSDxsECH6PXROxPJUK0vcjJRT1twhgTEjEEfQzGs8wLG', 'admin', 'admin@gmail.com', '', 'Laboratory Technician', 'CSM', 'padwa.png', NULL, 'Zamboanga City'),
(2, 'pawie', 'Padwa', 'Tingkasan', 'S', '$2y$10$/pem/m8Svtsl/glQ5hJ3eOp9XcmHjCA1idTydv7yh7RHXYTHCwCty', 'user', 'ashigasan28@gmail.com', '', 'Dean', '', NULL, NULL, '');

-- --------------------------------------------------------

--
-- Table structure for table `user_unit`
--

CREATE TABLE `user_unit` (
  `user` varchar(255) NOT NULL,
  `article` varchar(255) NOT NULL,
  `units_handled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_unit`
--

INSERT INTO `user_unit` (`user`, `article`, `units_handled`) VALUES
('Padwa Tingkasan', 'Charot', 2)

--
-- Indexes for dumped tables
--

--
-- Indexes for table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_ID`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unit_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
