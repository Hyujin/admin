-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2022 at 07:59 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pds_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sss` decimal(20,2) NOT NULL,
  `phic` decimal(20,2) NOT NULL,
  `pagibig` decimal(20,2) NOT NULL,
  `others` decimal(20,2) NOT NULL,
  `ca` decimal(20,2) NOT NULL,
  `total_deductions` decimal(20,2) NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL,
  `emp_type` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `reg_manhour`
--

CREATE TABLE `reg_manhour` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `total_worked_hrs` decimal(20,2) NOT NULL,
  `total_nd_hrs` decimal(20,2) NOT NULL,
  `reg_hol_hrs` decimal(20,2) NOT NULL,
  `ot_hrs` decimal(20,2) NOT NULL,
  `spl_hol_hrs` decimal(20,2) NOT NULL,
  `prem_hrs` decimal(20,2) NOT NULL,
  `timestamps` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `reg_pay`
--

CREATE TABLE `reg_pay` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `basic_hrs_pay` decimal(20,2) NOT NULL,
  `nds_pay` decimal(20,2) NOT NULL,
  `allow_pay` decimal(20,2) NOT NULL,
  `dispute` decimal(20,2) NOT NULL,
  `spl_hol_pay` decimal(20,2) NOT NULL,
  `reg_hol_pay` decimal(20,2) NOT NULL,
  `prem_hol_pay` decimal(20,2) NOT NULL,
  `ot_pay` decimal(20,2) NOT NULL,
  `gross_pay` decimal(20,2) NOT NULL,
  `net_pay` decimal(20,2) NOT NULL,
  `visibility` boolean NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `reg_rate`
--

CREATE TABLE `reg_rate` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `daily_rate` decimal(20,2) NOT NULL,
  `hrly_rate` decimal(20,2) NOT NULL,
  `allow_hr_rate` decimal(20,2) NOT NULL,
  `nd_rate` decimal(20,2) NOT NULL,
  `timestamps` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `sales_manhour`
--

CREATE TABLE `sales_manhour` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `total_sales` decimal(20,2) NOT NULL,
  `training_days` decimal(20,2) NOT NULL,
  `reg_hol_hrs` decimal(20,2) NOT NULL,
  `total_num_days` decimal(20,2) NOT NULL,
  `spl_hrs` decimal(20,2) NOT NULL,
  `prem_hrs` decimal(20,2) NOT NULL,
  `timestamps` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Table structure for table `sales_pay`
--

CREATE TABLE `sales_pay` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `sales_pay` decimal(20,2) NOT NULL,
  `training_pay` decimal(20,2) NOT NULL,
  `allow_pay` decimal(20,2) NOT NULL,
  `dispute` decimal(20,2) NOT NULL,
  `spl_pay` decimal(20,2) NOT NULL,
  `reg_hol_pay` decimal(20,2) NOT NULL,
  `premium_pay` decimal(20,2) NOT NULL,
  `ot_pay` decimal(20,2) NOT NULL,
  `gross_pay` decimal(20,2) NOT NULL,
  `net_pay` decimal(20,2) NOT NULL,
  `timestamps` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `sales_rate`
--

CREATE TABLE `sales_rate` (
  `id` int(11) NOT NULL,
  `emp_id` int(11) NOT NULL,
  `training_rate` decimal(20,2) NOT NULL,
  `sales_rate` decimal(20,2) NOT NULL,
  `allow_rate` decimal(20,2) NOT NULL,
  `nd_rate` decimal(20,2) NOT NULL,
  `timestamps` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reg_manhour`
--
ALTER TABLE `reg_manhour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `reg_pay`
--
ALTER TABLE `reg_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `reg_rate`
--
ALTER TABLE `reg_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `sales_manhour`
--
ALTER TABLE `sales_manhour`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `sales_pay`
--
ALTER TABLE `sales_pay`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- Indexes for table `sales_rate`
--
ALTER TABLE `sales_rate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emp_id` (`emp_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `reg_manhour`
--
ALTER TABLE `reg_manhour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `reg_pay`
--
ALTER TABLE `reg_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `reg_rate`
--
ALTER TABLE `reg_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sales_manhour`
--
ALTER TABLE `sales_manhour`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `sales_pay`
--
ALTER TABLE `sales_pay`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `sales_rate`
--
ALTER TABLE `sales_rate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reg_manhour`
--
ALTER TABLE `reg_manhour`
  ADD CONSTRAINT `reg_manhour_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reg_pay`
--
ALTER TABLE `reg_pay`
  ADD CONSTRAINT `reg_pay_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reg_rate`
--
ALTER TABLE `reg_rate`
  ADD CONSTRAINT `reg_rate_ibfk_1` FOREIGN KEY (`emp_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
