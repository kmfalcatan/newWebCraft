-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 12:14 AM
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
  `unit_year` int(11) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(255) DEFAULT 'Your report has been approved'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `approved_report`
--

INSERT INTO `approved_report` (`approved_ID`, `user_ID`, `unit_ID`, `equipment_ID`, `report_issue`, `problem_desc`, `unit_img`, `unit_year`, `timestamp`, `status`) VALUES
(4, 7, 'UNIT-0007', 2, 'For return', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'in.png', 2023, '2024-04-25 19:20:03', 'Your report has been approved');

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
(1, 'MBFP-1003.jpg', 'Alcohol Dispenser', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae. Ut tempus ipsum eget sapien efficitur, id interdum lectus efficitur. Sed nec metus at ligula fringilla vestibulum.', 'College of Medicine', 'ICS-22-STF-0296/20-4', '1-04-05-100', 3, '1500', '4,500.00', '', 2022, 'warranty-cards-1477455472-2507666.jpeg', '2024-04-26', '2025-07-26', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae. Ut tempus ipsum eget sapien efficitur, id interdum lectus efficitur. Sed nec metus at ligula fringilla vestibulum.'),
(2, 'OIP.jpg', 'Cabiner', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae. Ut tempus ipsum eget sapien efficitur, id interdum lectus efficitur. Sed nec metus at ligula fringilla vestibulum.', 'College of Medicine', 'ICS-23-F101-0018/2-1-7', '1-04-06-010', 6, '9920', '69', '', 2023, '', '0000-00-00', '0000-00-00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae. Ut tempus ipsum eget sapien efficitur, id interdum lectus efficitur. Sed nec metus at ligula fringilla vestibulum.'),
(3, '', 'Chair', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae. Ut tempus ipsum eget sapien efficitur, id interdum lectus efficitur. Sed nec metus at ligula fringilla vestibulum.', 'College of Medicine', 'ICS-23-F101-0017/110-1-20', '1-04-06-010', 20, '1000', '20,000.00', '', 2023, 'warranty-cards-1477455472-2507666.jpeg', '0000-00-00', '0000-00-00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae. Ut tempus ipsum eget sapien efficitur, id interdum lectus efficitur. Sed nec metus at ligula fringilla vestibulum.');

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
(1, 1, 'Alcohol Dispenser', 5, 'Padwa Tingkasan', 2022),
(2, 1, 'Alcohol Dispenser', 6, 'Rogie Gabotero', 2024),
(3, 1, 'Alcohol Dispenser', 5, 'Padwa Tingkasan', 2022),
(4, 2, 'Cabiner', 7, 'Khriz Marr Falcatan', 2023),
(5, 2, 'Cabiner', 7, 'Khriz Marr Falcatan', 2023),
(6, 2, 'Cabiner', 7, 'Khriz Marr Falcatan', 2023),
(8, 2, 'Cabiner', 9, 'John Mark Taborada', 2023),
(9, 2, 'Cabiner', 9, 'John Taborada', 2023),
(10, 2, 'Cabiner', 9, 'John Taborada', 2023),
(11, 3, 'Chair', 7, 'Khriz Marr Falcatan', 2023),
(12, 3, 'Chair', 7, 'Khriz Marr Falcatan', 2023),
(13, 3, 'Chair', 7, 'Khriz Marr Falcatan', 2023),
(14, 3, 'Chair', 7, 'Khriz Marr Falcatan', 2023),
(15, 3, 'Chair', 7, 'Khriz Marr Falcatan', 2023),
(16, 3, 'Chair', 6, 'Rogie Gabotero', 2023),
(17, 3, 'Chair', 6, 'Rogie Gabotero', 2023),
(18, 3, 'Chair', 6, 'Rogie Gabotero', 2023),
(19, 3, 'Chair', 6, 'Rogie Gabotero', 2023),
(20, 3, 'Chair', 6, 'Rogie Gabotero', 2023),
(21, 3, 'Chair', 9, 'John Taborada', 2023),
(22, 3, 'Chair', 9, 'John Taborada', 2023),
(23, 3, 'Chair', 9, 'John Taborada', 2023),
(24, 3, 'Chair', 9, 'John Taborada', 2023),
(25, 3, 'Chair', 9, 'John Taborada', 2023),
(26, 3, 'Chair', 5, 'Padwa Tingkasan', 2023),
(27, 3, 'Chair', 5, 'Padwa Tingkasan', 2023),
(28, 3, 'Chair', 5, 'Padwa Tingkasan', 2023),
(29, 3, 'Chair', 5, 'Padwa Tingkasan', 2023),
(30, 3, 'Chair', 5, 'Padwa Tingkasan', 2023);

-- --------------------------------------------------------

--
-- Table structure for table `unit_history`
--

CREATE TABLE `unit_history` (
  `history_ID` int(11) NOT NULL,
  `equipment_ID` int(11) DEFAULT NULL,
  `unit_ID` varchar(255) DEFAULT NULL,
  `report_issue` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_history`
--

INSERT INTO `unit_history` (`history_ID`, `equipment_ID`, `unit_ID`, `report_issue`, `timestamp`) VALUES
(1, 1, 'UNIT-0002', 'Lost', '2024-04-25 19:01:01'),
(2, 2, 'UNIT-0007', 'For return', '2024-04-25 19:20:03');

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
(1, 9, 1, 'UNIT-0002', 1500.00, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. ', 'John', 'Taborada', 'john@gmail.com', 'Prof2', '2024-04-26', 'has submitted a replacement form', '2024-04-25 18:41:18');

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
(1, 2, 9, 'UNIT-0008', 'Lost', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse id urna eu eros consectetur varius. Nullam vitae semper lectus. Mauris bibendum lobortis metus, nec pharetra dolor mollis vitae', '2024-04-25 18:46:02', 'You have sent a report', NULL);

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
  `new_end_user_first_name` varchar(255) NOT NULL,
  `new_end_user_last_name` varchar(255) DEFAULT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `year_transfer` int(11) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'You have received a new unit transfer'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `unit_transfer`
--

INSERT INTO `unit_transfer` (`transfer_ID`, `unit_ID`, `equipment_ID`, `old_end_userID`, `new_end_userID`, `old_end_user_first_name`, `old_end_user_last_name`, `new_end_user_first_name`, `new_end_user_last_name`, `timestamp`, `year_transfer`, `status`) VALUES
(1, 'UNIT-0002', 1, 5, 9, 'Padwa', 'Tingkasan', 'John', 'Taborada', '2024-04-25 18:31:46', 2022, 'You have received a new unit transfer'),
(2, 'UNIT-0002', 1, 9, 6, 'John Mark', 'Taborada', 'Rogie', 'Gabotero', '2024-04-25 18:44:07', 2024, 'You have received a new unit transfer');

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
  `code` int(11) DEFAULT NULL,
  `rank` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department` varchar(255) NOT NULL,
  `profile_img` varchar(255) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_ID`, `username`, `first_name`, `last_name`, `middle_initial`, `password`, `role`, `email`, `code`, `rank`, `designation`, `department`, `profile_img`, `gender`, `address`) VALUES
(1, 'admin@wmsu', 'Ryan Jonathan', 'Torres', 'A.', '$2y$10$XG8/NXUe/iSDxsECH6PXROxPJUK0vcjJRT1twhgTEjEEfQzGs8wLG', 'admin', 'admin@gmail.com', NULL, 'CSM/CM Property Custodian', 'Laboratory Technician I', 'CSM - Stockroom', 'client.png', 'Male', 'Sta. Maria ZC'),
(5, 'pawpatrol', 'Padwa', 'Tingkasan', 'l', '$2y$10$vcAbLxOfufzxWfnxY4Gzvewqr3zzoy0FTUQ/qA9tt579fffncX1Aq', 'user', 'ashigasan28@gmail.com', 970194, 'Professor1', 'Ass. Laboratory Tech.', 'CCS', 'pow.png', '', 'Zamboanga City'),
(6, 'rogie@gab', 'Rogie', 'Gabotero', '', '$2y$10$953Irn9CmIdZQgMfN1uPZ.gC3RiwqExWcfD23NhToNOwulAOPFpuu', 'user', 'rogie@gmail.com', NULL, NULL, 'Laboratory Technician', 'CCS', '125491924_149660773560575_2376549420642600498_n.jpg', NULL, 'ZC'),
(7, 'khriz@wmsu', 'Khriz Marr', 'Falcatan', 'R.', '$2y$10$vj4HlvXd8GxHHidj/air5.JhBsLw7H1g1FEjI2mbzFUAvHjQozSZm', 'user', 'khriz@gmail.com', 0, 'Dean', 'Laboratory Technician', 'CTE', 'w.jpg', 'Male', 'ZC'),
(9, 'tabs@wmsu', 'John Mark', 'Taborada', 'M.', '$2y$10$LgCen5THdZ.A8xU6aR3r5ubRfGVcuRqfM86RdYiAjknKtcwIhkiW.', 'user', 'john@gmail.com', 0, 'Supervisor', 'Prof2', 'CCS', 'kyle kuzma.jpg', 'Male', 'Zamboanga City');

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
(1, 1, 5, 'Padwa Tingkasan', 'Alcohol Dispenser', 2),
(2, 2, 7, 'Khriz Marr Falcatan', 'Cabiner', 3),
(3, 2, 9, 'John Taborada', 'Cabiner', 3),
(4, 3, 7, 'Khriz Marr Falcatan', 'Chair', 5),
(5, 3, 6, 'Rogie Gabotero', 'Chair', 5),
(6, 3, 9, 'John Taborada', 'Chair', 5),
(7, 3, 5, 'Padwa Tingkasan', 'Chair', 5);

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
-- Indexes for table `unit_history`
--
ALTER TABLE `unit_history`
  ADD PRIMARY KEY (`history_ID`);

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
  MODIFY `approved_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `unit_history`
--
ALTER TABLE `unit_history`
  MODIFY `history_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unit_replacement`
--
ALTER TABLE `unit_replacement`
  MODIFY `replacement_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_report`
--
ALTER TABLE `unit_report`
  MODIFY `report_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit_transfer`
--
ALTER TABLE `unit_transfer`
  MODIFY `transfer_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_unit`
--
ALTER TABLE `user_unit`
  MODIFY `user_unit_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
