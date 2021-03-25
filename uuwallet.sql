-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3325
-- Generation Time: Mar 25, 2021 at 02:55 AM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uuwallet`
--

-- --------------------------------------------------------

--
-- Table structure for table `balance_tbl`
--

CREATE TABLE `balance_tbl` (
  `balance_id` int(11) NOT NULL,
  `balance_date` varchar(255) NOT NULL,
  `balance_month` varchar(255) NOT NULL,
  `balance_income` int(11) NOT NULL,
  `balance_expense` int(11) NOT NULL,
  `balance_remain` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `balance_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `balance_tbl`
--

INSERT INTO `balance_tbl` (`balance_id`, `balance_date`, `balance_month`, `balance_income`, `balance_expense`, `balance_remain`, `email`, `balance_created`) VALUES
(10, '2021-02-01', 'Fed, 2021', 2287, 1835, 500, 'rafi@gmail.com', '2021-03-23 04:36:59'),
(11, '2021-01-01', 'Jan, 2021', 2287, 1835, 400, 'rafi@gmail.com', '2021-03-23 04:36:59'),
(12, '2020-12-01', 'Dec, 2020', 2287, 1835, 600, 'rafi@gmail.com', '2021-03-23 04:36:59'),
(13, '2021-03-23', 'March, 2021', 3187, 1735, 1452, 'rafi@gmail.com', '2021-03-23 05:43:39'),
(14, '2021-03-23', 'March, 2021', 2022, 800, 1222, 'oho@gmail.com', '2021-03-23 07:05:28'),
(16, '2021-03-25', 'March, 2021', 600, 500, 100, 'huh@gmail.com', '2021-03-25 01:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `budget_tbl`
--

CREATE TABLE `budget_tbl` (
  `budget_id` int(11) NOT NULL,
  `budget` int(11) NOT NULL,
  `budget_month` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `budget_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget_tbl`
--

INSERT INTO `budget_tbl` (`budget_id`, `budget`, `budget_month`, `email`, `budget_created`) VALUES
(4, 2000, 'March, 2021', 'rafi@gmail.com', '2021-03-21 03:22:38'),
(5, 3000, 'March, 2021', 'oho@gmail.com', '2021-03-21 15:38:40'),
(6, 2000, 'March, 2021', 'joker@gmail.com', '2021-03-22 15:52:44'),
(7, 2000, 'March, 2021', 'huh@gmail.com', '2021-03-25 01:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `expense_tbl`
--

CREATE TABLE `expense_tbl` (
  `expense_id` int(11) NOT NULL,
  `expense_date` varchar(255) NOT NULL,
  `expense_type` varchar(255) NOT NULL,
  `expense_amount` varchar(255) NOT NULL,
  `expense_sign` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `expense_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_tbl`
--

INSERT INTO `expense_tbl` (`expense_id`, `expense_date`, `expense_type`, `expense_amount`, `expense_sign`, `email`, `expense_created`) VALUES
(3, '2021-02-03', 'Food', '32', '-', 'rafi@gmail.com', '2021-03-20 14:18:17'),
(6, '2021-02-11', 'Travel', '100', '-', 'rafi@gmail.com', '2021-03-20 15:17:05'),
(7, '2021-01-06', 'Travel', '100', '-', 'rafi@gmail.com', '2021-03-20 15:17:35'),
(9, '2021-03-11', 'Entertainment', '500', '-', 'rafi@gmail.com', '2021-03-21 03:25:10'),
(10, '2021-03-03', 'Travel', '23', '-', 'rafi@gmail.com', '2021-03-21 05:52:40'),
(14, '2021-03-11', 'Phone Bill', '100', '-', 'rafi@gmail.com', '2021-03-21 06:20:30'),
(15, '2021-03-10', 'Food', '100', '-', 'rafi@gmail.com', '2021-03-21 14:26:12'),
(16, '2021-03-02', 'Internet Bill', '12', '-', 'rafi@gmail.com', '2021-03-21 14:28:11'),
(17, '2021-03-05', 'Entertainment', '100', '-', 'oho@gmail.com', '2021-03-21 15:39:05'),
(18, '2021-03-25', 'Travel', '300', '-', 'oho@gmail.com', '2021-03-21 15:41:42'),
(19, '2021-03-04', 'Media Services', '100', '-', 'oho@gmail.com', '2021-03-21 16:54:23'),
(24, '2021-03-25', 'Food', '100', '-', 'rafi@gmail.com', '2021-03-24 02:16:34'),
(25, '2021-03-24', 'Travel', '500', '-', 'rafi@gmail.com', '2021-03-24 03:03:10'),
(26, '2021-03-08', 'Travel', '300', '-', 'oho@gmail.com', '2021-03-24 04:45:45'),
(27, '2021-03-01', 'Entertainment', '500', '-', 'huh@gmail.com', '2021-03-25 01:53:55');

-- --------------------------------------------------------

--
-- Table structure for table `income_tbl`
--

CREATE TABLE `income_tbl` (
  `income_id` int(11) NOT NULL,
  `income_date` varchar(255) NOT NULL,
  `income_type` varchar(255) NOT NULL,
  `income_amount` varchar(255) NOT NULL,
  `income_sign` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `income_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `income_tbl`
--

INSERT INTO `income_tbl` (`income_id`, `income_date`, `income_type`, `income_amount`, `income_sign`, `email`, `income_created`) VALUES
(4, '2021-03-11', 'Buisary/Grant', '122', '+', 'rafi@gmail.com', '2021-03-20 16:27:47'),
(5, '2021-02-11', 'Job', '1100', '+', 'rafi@gmail.com', '2021-03-20 16:28:01'),
(6, '2021-03-24', 'Student Loan', '299', '+', 'rafi@gmail.com', '2021-03-20 16:28:18'),
(7, '2021-03-12', 'Job', '100', '+', 'rafi@gmail.com', '2021-03-21 05:51:46'),
(8, '2021-03-11', 'Job', '1000', '+', 'rafi@gmail.com', '2021-03-21 15:26:31'),
(9, '2021-03-11', 'Other', '100', '+', 'rafi@gmail.com', '2021-03-21 15:27:11'),
(10, '2021-03-10', 'Student Loan', '12', '+', 'oho@gmail.com', '2021-03-21 15:38:20'),
(11, '2021-03-06', 'Buisary/Grant', '555', '+', 'oho@gmail.com', '2021-03-21 16:57:16'),
(12, '2021-03-12', 'Buisary/Grant', '1000', '+', 'rafi@gmail.com', '2021-03-22 04:04:13'),
(13, '2021-03-06', 'Other', '500', '+', 'rafi@gmail.com', '2021-03-22 04:04:38'),
(14, '2021-03-04', 'Buisary/Grant', '100', '+', 'rafi@gmail.com', '2021-03-22 06:28:17'),
(15, '2021-03-01', 'Student Loan', '1000', '+', 'joker@gmail.com', '2021-03-22 15:53:45'),
(16, '2021-03-11', 'Job', '500', '+', 'rafi@gmail.com', '2021-03-23 04:37:43'),
(22, '2021-03-03', 'Buisary/Grant', '500', '+', 'rafi@gmail.com', '2021-03-23 06:50:00'),
(23, '2021-03-03', 'Job', '400', '+', 'rafi@gmail.com', '2021-03-23 06:59:13'),
(24, '2021-03-02', 'Student Loan', '500', '+', 'rafi@gmail.com', '2021-03-23 06:59:48'),
(25, '2021-03-06', 'Student Loan', '100', '+', 'oho@gmail.com', '2021-03-23 07:10:59'),
(26, '2021-03-05', 'Job', '500', '+', 'oho@gmail.com', '2021-03-23 07:11:31'),
(27, '2021-03-22', 'Student Loan', '100', '+', 'rafi@gmail.com', '2021-03-23 13:34:44'),
(28, '2021-03-23', 'Student Loan', '200', '+', 'oho@gmail.com', '2021-03-23 13:37:19'),
(29, '2021-03-25', 'Other', '200', '+', 'oho@gmail.com', '2021-03-24 04:19:09'),
(30, '2021-03-02', 'Student Loan', '600', '+', 'huh@gmail.com', '2021-03-25 01:54:58');

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`id`, `email`, `phone`, `country`, `state`, `city`, `image`, `created`, `updated`) VALUES
(2, 'rafi@gmail.com', '012323344444', 'USA', 'dhaka', 'London', '1616168691_83414733_198556214617321_6746619767693508608_n.jpg', '2021-02-27 10:01:25', '2021-03-23 02:24:36'),
(3, 'apollo@gmail.com', '123456789', 'USA', '', '', '1614432335_83414733_198556214617321_6746619767693508608_n.jpg', '2021-02-27 13:25:16', '2021-02-27 13:25:35'),
(4, 'polo@gmail.com', '3434234', 'Dhaka', '', '', 'placeholder-16-9.jpg', '2021-03-03 09:40:58', '2021-03-03 09:44:05'),
(5, 'hero@gmail.com', '1234578', '', '', '', 'placeholder-16-9.jpg', '2021-03-20 02:20:12', '2021-03-20 02:20:12'),
(6, 'oho@gmail.com', '12322', '', '', '', 'placeholder-16-9.jpg', '2021-03-21 15:37:50', '2021-03-21 15:37:50'),
(7, 'joker@gmail.com', '121212', '', '', '', 'placeholder-16-9.jpg', '2021-03-22 15:51:59', '2021-03-22 15:51:59'),
(8, 'huh@gmail.com', '243232', '', '', '', 'placeholder-16-9.jpg', '2021-03-25 01:52:56', '2021-03-25 01:52:56');

-- --------------------------------------------------------

--
-- Table structure for table `user_tbl`
--

CREATE TABLE `user_tbl` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_tbl`
--

INSERT INTO `user_tbl` (`id`, `fname`, `lname`, `email`, `phone`, `password`, `created`) VALUES
(4, 'Rafi', 'Mahafid', 'rafi@gmail.com', '0123233', '$2y$10$fEp6.n33lG3DJvCjqJWAseMwdi/p0qt3f26XgdGcy9mTK1C/gWhQC', '2021-02-27 10:01:25'),
(5, 'web', 'apollo', 'apollo@gmail.com', '123456789', '$2y$10$j1LcArkIO9rzIKMAfCwARum/a2GB1gZn.gbyIVKsYTdL/EGBIhBYm', '2021-02-27 13:25:15'),
(6, 'Itooo', 'Pollo', 'polo@gmail.com', '3434234', '$2y$10$4evq5cFM7jmXNn7PBO/tN.X59mzjGO1mvqGm3naSOiMYcoEB43wk2', '2021-03-03 09:40:58'),
(7, 'Hero', 'Area', 'hero@gmail.com', '1234578', '$2y$10$.lxiZ9h0MDwClMwKukvzjOBkP8O5Mps1OKlEXVZllX82HkVqe19Fe', '2021-03-20 02:20:12'),
(8, 'Jahan', 'Oho', 'oho@gmail.com', '12322', '$2y$10$XDo/TEf7JUazZiUEzwB2uu/G5AeVkoti5aNAr70h.3oE/jNeyJTm6', '2021-03-21 15:37:50'),
(9, 'talha', 'Joker', 'joker@gmail.com', '121212', '$2y$10$fOuq6CgcIVdKSx5zpbCmr.0SBouZ4TnvjbyHPa.P.TEGIq4akULdO', '2021-03-22 15:51:59'),
(10, 'huhu', 'huhuh', 'huh@gmail.com', '243232', '$2y$10$q76fpgoQhSh4Fl5v7sXCEuxBIIITyJGjWbXKwRhoiRwp6MUkqx5Yq', '2021-03-25 01:52:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `balance_tbl`
--
ALTER TABLE `balance_tbl`
  ADD PRIMARY KEY (`balance_id`),
  ADD KEY `balance_tbl_ibfk_1` (`email`);

--
-- Indexes for table `budget_tbl`
--
ALTER TABLE `budget_tbl`
  ADD PRIMARY KEY (`budget_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `income_tbl`
--
ALTER TABLE `income_tbl`
  ADD PRIMARY KEY (`income_id`),
  ADD KEY `email` (`email`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_info_ibfk_1` (`email`);

--
-- Indexes for table `user_tbl`
--
ALTER TABLE `user_tbl`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `balance_tbl`
--
ALTER TABLE `balance_tbl`
  MODIFY `balance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `budget_tbl`
--
ALTER TABLE `budget_tbl`
  MODIFY `budget_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `income_tbl`
--
ALTER TABLE `income_tbl`
  MODIFY `income_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_tbl`
--
ALTER TABLE `user_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance_tbl`
--
ALTER TABLE `balance_tbl`
  ADD CONSTRAINT `balance_tbl_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_tbl` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `budget_tbl`
--
ALTER TABLE `budget_tbl`
  ADD CONSTRAINT `budget_tbl_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_tbl` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expense_tbl`
--
ALTER TABLE `expense_tbl`
  ADD CONSTRAINT `expense_tbl_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_tbl` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `income_tbl`
--
ALTER TABLE `income_tbl`
  ADD CONSTRAINT `income_tbl_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_tbl` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `user_info_ibfk_1` FOREIGN KEY (`email`) REFERENCES `user_tbl` (`email`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
