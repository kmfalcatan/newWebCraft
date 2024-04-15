-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 14, 2024 at 07:55 PM
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
(1, 6, 'UNIT-0009', 2, 'For return', 'Damaged', 'print.png', '2024-04-07 12:22:29', 'Your report has been approved'),
(2, 0, 'UNIT-0001', 0, 'Lost', 'dfgfd', '', '2024-04-08 17:53:08', 'Your report has been approved'),
(3, 0, 'UNIT-0001', 0, 'Lost', 'dfgfd', '', '2024-04-08 18:01:46', 'Your report has been approved'),
(4, 6, 'UNIT-0009', 2, 'For return', 'Damaged', 'print.png', '2024-04-08 18:06:54', 'Your report has been approved'),
(10, 5, 'UNIT-0002', 25, 'Lost', 'dfds', '', '2024-04-10 16:47:58', 'Your report has been approved'),
(11, 1, 'UNIT-0003', 25, 'Lost', 'dfds', '', '2024-04-10 17:46:24', 'Your report has been approved'),
(12, 1, 'UNIT-0003', 25, 'For return', 'sdfsdf', '', '2024-04-10 18:04:16', 'Your report has been approved');

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
(25, 'MBFP-1003.jpg', 'Alcohol Dispenser', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'College of Medicine', 'ICS-24-STF-0296/20-4', '1-04-06-010', 3, '500', '2,000.00', '', 2024, 'in.png', '2024-04-08', '2025-04-08', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'),
(26, '905613308e1a3ec2a28271f2693d03b5.jpg', 'Cabinet', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'College of Medicine', 'ICS-22-STF-0296/20-4', '1-04-06-010', 1, '100', '100.00', '', 2022, 'in.png', '2024-04-08', '2025-04-08', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'),
(27, 'in.png', 'Chair', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'College of Medicine', 'ICS-22-STF-0296/20-4', '1-04-06-010', 1, '100', '100.00', '', 2022, 'in.png', '2022-06-09', '2023-06-09', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'),
(28, '', 'Table', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'College of Medicine', 'ICS-22-STF-0296/20-4', '1-04-06-010', 1, '100', '100.00', '', 2022, '', '0000-00-00', '0000-00-00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit'),
(29, '', 'pen', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor', 'College of Medicine', 'ICS-22-STF-0296/20-4', '1-04-06-010', 1, '100', '100.00', '', 2022, '', '0000-00-00', '0000-00-00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unit_ID` int(11) NOT NULL,
  `equipment_ID` int(11) NOT NULL,
  `equipment_name` varchar(255) NOT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `year_received` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`unit_ID`, `equipment_ID`, `equipment_name`, `user_ID`, `user`, `year_received`) VALUES
(2, 25, 'Alcohol Dispenser', 5, 'Padwa Tingkasan', NULL),
(3, 25, 'Alcohol Dispenser', 6, 'Rogie Gabotero', 2024),
(4, 25, 'Alcohol Dispenser', 6, 'Rogie Gabotero', NULL),
(5, 26, 'Cabinet', 6, 'Rogie Gabotero', NULL),
(6, 27, 'Chair', 5, 'Padwa Tingkasan', 2024),
(7, 28, 'Table', 5, 'Padwa Tingkasan', NULL),
(8, 29, 'pen', 6, 'Rogie Gabotero', 2022);

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
(3, 1, 6, 'UNIT-0003', 'Lost', 'nawala', '2024-04-07 12:22:15', 'You have sent a report', NULL),
(4, 25, 5, 'UNIT-0001', 'Lost', 'dfgfd', '2024-04-08 17:52:31', 'You have sent a report', NULL),
(5, 25, 5, 'UNIT-0002', 'Lost', 'dfds', '2024-04-08 18:17:22', 'You have sent a report', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unit_transfer`
--

CREATE TABLE `unit_transfer` (
  `transfer_ID` int(11) NOT NULL,
  `unit_ID` varchar(255) DEFAULT NULL,
  `equipment_ID` int(11) DEFAULT NULL,
  `old_end_userID` int(11) DEFAULT NULL,
  `new_end_userID` int(11) DEFAULT NULL,
  `old_end_user_first_name` varchar(255) DEFAULT NULL,
  `old_end_user_last_name` varchar(255) DEFAULT NULL,
  `new_end_user_first_name` varchar(255) DEFAULT NULL,
  `new_end_user_last_name` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `year_transfer` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'You have received a new unit transfer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_transfer`
--

INSERT INTO `unit_transfer` (`transfer_ID`, `unit_ID`, `equipment_ID`, `old_end_userID`, `new_end_userID`, `old_end_user_first_name`, `old_end_user_last_name`, `new_end_user_first_name`, `new_end_user_last_name`, `timestamp`, `year_transfer`, `status`) VALUES
(1, 'UNIT-0001', 25, 5, 6, 'Padwa', 'Tingkasan', 'Rogie', 'Gabotero', '2024-04-08 13:47:10', NULL, 'You have received a new unit transfer'),
(16, 'UNIT-0006', 27, 6, 5, 'Rogie', 'Gabotero', 'Padwa', 'Tingkasan', '2024-04-13 09:17:53', NULL, 'You have received a new unit transfer'),
(17, 'UNIT-0008', 29, 5, 6, 'Padwa', 'Tingkasan', 'Rogie', 'Gabotero', '2024-04-13 09:26:03', NULL, 'You have received a new unit transfer'),
(20, 'UNIT-0003', 25, 6, 5, 'Rogie', 'Gabotero', 'Padwa', 'Tingkasan', '2024-04-13 09:55:53', 2022, 'You have received a new unit transfer'),
(21, 'UNIT-0003', 25, 5, 6, 'Padwa', 'Tingkasan', 'Rogie', 'Gabotero', '2024-04-13 09:57:18', 2023, 'You have received a new unit transfer');

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
  `user_unit_ID` int(11) NOT NULL,
  `equipment_ID` int(11) DEFAULT NULL,
  `user_ID` int(11) DEFAULT NULL,
  `user` varchar(255) NOT NULL,
  `article` varchar(255) NOT NULL,
  `units_handled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_unit`
--

INSERT INTO `user_unit` (`user_unit_ID`, `equipment_ID`, `user_ID`, `user`, `article`, `units_handled`) VALUES
(1, 25, 5, 'Padwa Tingkasan', 'Alcohol Dispenser', 1),
(2, 25, 6, 'Rogie Gabotero', 'Alcohol Dispenser', 2),
(3, 26, 6, 'Rogie Gabotero', 'Cabinet', 1),
(4, 27, 6, 'Rogie Gabotero', 'Chair', 1),
(5, 28, 5, 'Padwa Tingkasan', 'Table', 1),
(6, 29, 5, 'Padwa Tingkasan', 'pen', 1);

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
-- Indexes for table `unit_transfer`
--
ALTER TABLE `unit_transfer`
  ADD PRIMARY KEY (`transfer_ID`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_ID`);

--
-- Indexes for table `user_unit`
--
ALTER TABLE `user_unit`
  ADD PRIMARY KEY (`user_unit_ID`),
  ADD KEY `fk_equipment_id` (`equipment_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `approved_report`
--
ALTER TABLE `approved_report`
  MODIFY `approved_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `unit_replacement`
--
ALTER TABLE `unit_replacement`
  MODIFY `replacement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_report`
--
ALTER TABLE `unit_report`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `unit_transfer`
--
ALTER TABLE `unit_transfer`
  MODIFY `transfer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_unit`
--
ALTER TABLE `user_unit`
  MODIFY `user_unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_unit`
--
ALTER TABLE `user_unit`
  ADD CONSTRAINT `fk_equipment_id` FOREIGN KEY (`equipment_ID`) REFERENCES `equipment` (`equipment_ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
