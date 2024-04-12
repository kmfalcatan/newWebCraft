-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 02:26 PM
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

-- admin acc
-- 
-- username :    admin@wmsu
-- password  :   adminPass
-- --------------------------------------------------------
-- 
-- user acc
-- 
-- username  :   pawpatrol
-- password  :   user1@wmsu
-- 
-- username  :   rogie@gab
-- password  :   user2@wmsu
--
-- Table structure for table `approved_report`
--

CREATE TABLE `approved_report` (
  `approved_ID` int(11) NOT NULL,
  `user_ID` int(11) NOT NULL,
  `unit_ID` varchar(255) DEFAULT NULL,
  `equipment_ID` int(11) NOT NULL,
  `report_issue` varchar(255) NOT NULL,
  `problem_desc` text NOT NULL,
  `unit_img` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Your report has been approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_report`
--

INSERT INTO `approved_report` (`approved_ID`, `user_ID`, `unit_ID`, `equipment_ID`, `report_issue`, `problem_desc`, `unit_img`, `timestamp`, `status`) VALUES
(1, 6, 'UNIT-0009', 2, 'For return', 'Damaged', 'print.png', '2024-04-07 12:22:29', 'Your report has been approved');

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
(1, 'MBFP-1003.jpg', 'Alcohol Dispenser', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', 'College of Medicine', 'ICS-22-STF-0296/20-4', '1-04-06-010', 4, '500', '2,000.00', '', 2022, 'in.png', '2024-04-07', '2024-05-09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'),
(2, '', 'Cabinet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'College of Medicine', 'ICS-24-STF-0296/20-4', '1-04-06-010', 4, '1000', '5,000.00', '', 2024, 'in.png', '2024-04-06', '2024-04-24', '');

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
(1, 1, 'Alcohol Dispenser', NULL, 'Padwa Tingkasan'),
(2, 1, 'Alcohol Dispenser', NULL, 'Padwa Tingkasan'),
(3, 1, 'Alcohol Dispenser', NULL, 'Rogie Gabotero'),
(4, 1, 'Alcohol Dispenser', NULL, 'Rogie Gabotero'),
(5, 2, 'Cabinet', NULL, 'Padwa Tingkasan'),
(6, 2, 'Cabinet', NULL, 'Padwa Tingkasan'),
(7, 2, 'Cabinet', NULL, 'Padwa Tingkasan'),
(8, 2, 'Cabinet', NULL, 'Rogie Gabotero');

-- --------------------------------------------------------

--
-- Table structure for table `unit_replacement`
--

CREATE TABLE `unit_replacement` (
  `replacement_ID` int(11) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `equipment_ID` int(11) DEFAULT NULL,
  `unit_ID` varchar(255) DEFAULT NULL,
  `unit_cost` decimal(10,2) DEFAULT NULL,
  `unit_specs` varchar(255) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `replacement_date` date DEFAULT NULL,
  `status` varchar(255) DEFAULT 'has submitted a replacement form',
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_replacement`
--

INSERT INTO `unit_replacement` (`replacement_ID`, `user_ID`, `equipment_ID`, `unit_ID`, `unit_cost`, `unit_specs`, `first_name`, `last_name`, `email`, `designation`, `replacement_date`, `status`, `timestamp`) VALUES
(1, 6, 2, 'UNIT-0009', 5500.00, 'asdsadsadas', 'Rogie', 'Gabotero', 'rogie@gmail.com', 'Laboratory Technician', '2024-04-07', 'has submitted a replacement form', '2024-04-07 12:24:21');

-- --------------------------------------------------------

--
-- Table structure for table `unit_report`
--

CREATE TABLE `unit_report` (
  `report_ID` int(11) NOT NULL,
  `equipment_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `unit_ID` varchar(50) DEFAULT NULL,
  `report_issue` varchar(255) DEFAULT NULL,
  `problem_desc` text DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(255) NOT NULL DEFAULT 'You have sent a report',
  `unit_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_report`
--

INSERT INTO `unit_report` (`report_ID`, `equipment_ID`, `user_ID`, `unit_ID`, `report_issue`, `problem_desc`, `timestamp`, `status`, `unit_img`) VALUES
(1, 1, 5, 'UNIT-0001', 'Lost', 'Lost unit', '2024-04-07 12:14:23', 'You have sent a report', NULL),
(2, 2, 6, 'UNIT-0009', 'For return', 'Damaged', '2024-04-07 12:20:38', 'You have sent a report', 'print.png'),
(3, 1, 6, 'UNIT-0003', 'Lost', 'nawala', '2024-04-07 12:22:15', 'You have sent a report', NULL);

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
(1, 'admin@wmsu', 'Kyle', 'Kuzma', 'k', '$2y$10$XG8/NXUe/iSDxsECH6PXROxPJUK0vcjJRT1twhgTEjEEfQzGs8wLG', 'admin', 'kyle@gmail.com', '', 'Laboratory Technician', 'College of Medicine', 'kyle kuzma.jpg', NULL, 'Manila'),
(5, 'pawpatrol', 'Padwa', 'Tingkasan', 'S', '$2y$10$P8xIqUxertjdLg8WkMDBfuzk84rL0Dvp9gr54VplKiI/3hTlX6J/C', 'user', 'ashigasan28@gmail.com', '', 'Dean', 'CCS', 'pow.png', 'Female', 'Zamboanga City'),
(6, 'rogie@gab', 'Rogie', 'Gabotero', '', '$2y$10$953Irn9CmIdZQgMfN1uPZ.gC3RiwqExWcfD23NhToNOwulAOPFpuu', 'user', 'rogie@gmail.com', '', 'Laboratory Technician', 'CCS', '125491924_149660773560575_2376549420642600498_n.jpg', NULL, 'ZC');

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
('Padwa Tingkasan', 'Alcohol Dispenser', 2),
('Rogie Gabotero', 'Alcohol Dispenser', 2),
('Padwa Tingkasan', 'Cabinet', 3),
('Rogie Gabotero', 'Cabinet', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `approved_report`
--
ALTER TABLE `approved_report`
  ADD PRIMARY KEY (`approved_ID`);

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
-- Indexes for table `unit_replacement`
--
ALTER TABLE `unit_replacement`
  ADD PRIMARY KEY (`replacement_ID`);

--
-- Indexes for table `unit_report`
--
ALTER TABLE `unit_report`
  ADD PRIMARY KEY (`report_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_report`
--
ALTER TABLE `approved_report`
  MODIFY `approved_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `unit_replacement`
--
ALTER TABLE `unit_replacement`
  MODIFY `replacement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_report`
--
ALTER TABLE `unit_report`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
