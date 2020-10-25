-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2020 at 08:11 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cars_tracer`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED DEFAULT NULL,
  `mark_id` smallint(5) UNSIGNED DEFAULT NULL,
  `model_id` smallint(5) UNSIGNED DEFAULT NULL,
  `car_register_number` varchar(15) DEFAULT NULL,
  `car_create_date` datetime DEFAULT NULL,
  `car_update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `car_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_id`, `user_id`, `mark_id`, `model_id`, `car_register_number`, `car_create_date`, `car_update_date`, `car_status`) VALUES
(3, 72, 4, 15, 'te2222222', NULL, '2020-10-25 15:48:02', 0),
(4, 72, 2, 5, 'test3', NULL, '2020-10-25 13:38:28', 0),
(5, 72, 4, 10, '', '2020-10-25 16:28:26', '2020-10-25 14:28:27', 0),
(12, 72, 3, 9, 'test4111', NULL, '2020-10-25 15:16:10', 0),
(14, 72, 1, 1, '11111', NULL, '2020-10-25 15:48:41', 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_expenses`
--

CREATE TABLE `car_expenses` (
  `expense_id` int(10) UNSIGNED NOT NULL,
  `car_id` int(10) UNSIGNED DEFAULT NULL,
  `expense_price` decimal(5,2) DEFAULT NULL,
  `expense_title` varchar(100) DEFAULT NULL,
  `expense_description` text DEFAULT NULL,
  `expense_create_date` datetime DEFAULT NULL,
  `expense_update_date` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `expense_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_expenses`
--

INSERT INTO `car_expenses` (`expense_id`, `car_id`, `expense_price`, `expense_title`, `expense_description`, `expense_create_date`, `expense_update_date`, `expense_status`) VALUES
(1, 3, '3.00', 'tet', 'dsadsa', NULL, '2020-10-25 18:28:49', 0),
(3, 3, '13.00', 'title 1', '33333323333332222222223333333', NULL, '2020-10-25 19:49:05', 0),
(4, 3, '14.00', 'title 1', 'dsa das das dsa dsa dsa asd', NULL, '2020-10-25 19:14:59', 0),
(5, 3, '11.00', 'title 5555', '55555555555555', NULL, '2020-10-25 19:50:37', 0),
(6, 3, '10.00', 'title 4', 'dsa dsad sa das dsa sa dsa d', '2020-10-25 18:19:17', '2020-10-25 19:19:17', 0),
(8, 3, '13.00', 'title 1', '22222222222222222', '2020-10-25 18:40:55', '2020-10-25 19:40:55', 0),
(9, 3, '13.00', 'title 1', '3333333333', '2020-10-25 18:41:09', '2020-10-25 19:41:09', 0),
(11, 3, '13.00', 'title 1', 'dsadasdsa dsa dsa dsa', '2020-10-25 18:44:46', '2020-10-25 19:44:46', 0),
(12, 3, '14.00', 'title 1', 'dsa das das dsa dsa dsa asd', '2020-10-25 18:46:45', '2020-10-25 19:46:45', 0),
(13, 3, '14.00', 'title 1', 'dsa das das dsa dsa dsa asd', '2020-10-25 18:46:51', '2020-10-25 19:46:51', 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_marks`
--

CREATE TABLE `car_marks` (
  `mark_id` smallint(5) UNSIGNED NOT NULL,
  `mark_name` varchar(50) DEFAULT NULL,
  `mark_create_date` datetime DEFAULT NULL,
  `mark_update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `mark_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_marks`
--

INSERT INTO `car_marks` (`mark_id`, `mark_name`, `mark_create_date`, `mark_update_date`, `mark_status`) VALUES
(1, 'Toyota', '2020-10-25 09:39:43', '2020-10-25 07:39:43', 0),
(2, 'Honda', '2020-10-25 09:40:02', '2020-10-25 07:40:03', 0),
(3, 'BMV', '2020-10-25 09:40:03', '2020-10-25 07:40:03', 0),
(4, 'Mercedes', '2020-10-25 09:40:04', '2020-10-25 07:40:04', 0);

-- --------------------------------------------------------

--
-- Table structure for table `car_models`
--

CREATE TABLE `car_models` (
  `model_id` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `mark_id` int(5) UNSIGNED NOT NULL,
  `model_name` varchar(50) DEFAULT NULL,
  `model_create_date` datetime DEFAULT NULL,
  `model_update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `model_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `car_models`
--

INSERT INTO `car_models` (`model_id`, `mark_id`, `model_name`, `model_create_date`, `model_update_date`, `model_status`) VALUES
(1, 1, 'C-HR', NULL, '2020-10-25 07:40:52', 0),
(2, 1, 'RAV4', NULL, '2020-10-25 07:41:03', 0),
(3, 1, 'Corolla', NULL, '2020-10-25 07:41:18', 0),
(4, 1, 'Yaris', NULL, '2020-10-25 07:41:40', 0),
(5, 2, 'Civic', NULL, '2020-10-25 07:42:10', 0),
(6, 2, 'Accord', NULL, '2020-10-25 07:42:20', 0),
(7, 3, 'X1', NULL, '2020-10-25 07:44:04', 0),
(8, 3, 'X2', NULL, '2020-10-25 07:44:11', 0),
(9, 3, 'X3', NULL, '2020-10-25 07:44:23', 0),
(10, 3, 'X4', NULL, '2020-10-25 07:44:35', 0),
(11, 3, 'X5', NULL, '2020-10-25 07:44:41', 0),
(12, 3, 'X6', NULL, '2020-10-25 07:44:49', 0),
(13, 4, 'A-Class', NULL, '2020-10-25 07:45:22', 0),
(14, 4, 'C-Class', NULL, '2020-10-25 07:45:29', 0),
(15, 4, 'Benz', NULL, '2020-10-25 07:45:45', 0),
(16, 4, 'S-Class', NULL, '2020-10-25 07:46:16', 0),
(17, 4, 'SLS AMG', NULL, '2020-10-25 07:46:24', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_password` varchar(150) NOT NULL,
  `user_create_date` datetime DEFAULT NULL,
  `user_update_date` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_status` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_email`, `user_password`, `user_create_date`, `user_update_date`, `user_status`) VALUES
(1, 'John', 'Doe', NULL, '2020-10-24 18:31:42', 0),
(24, 'John2', 'Doe2', NULL, '2020-10-24 19:15:38', 0),
(26, 'John3', 'Doe2', NULL, '2020-10-24 19:21:50', 0),
(28, 'John31', 'Doe', NULL, '2020-10-24 19:23:56', 0),
(30, 'John32', 'Doe', NULL, '2020-10-24 19:24:08', 0),
(31, 'yrdy', 'tttд', NULL, '2020-10-24 19:24:55', 0),
(33, 'yrdyd', 'tttд', NULL, '2020-10-24 19:25:09', 0),
(34, 'trim(yrdyd)', 'trim(tttд)', NULL, '2020-10-24 19:31:56', 0),
(35, 'trim(yrdy)', 'trim(tttд)', NULL, '2020-10-24 19:31:58', 0),
(40, ' . trim(yrdy) . ', ' . trim(tttд) .', NULL, '2020-10-24 19:33:43', 0),
(42, 'yrdyd1', 'tttд', NULL, '2020-10-24 19:37:47', 0),
(43, 'yrdy12', 'tttд', NULL, '2020-10-24 19:37:50', 0),
(44, 'yrdy3', 'tttд', NULL, '2020-10-24 19:37:57', 0),
(71, 'yrdy@dsa.bg', 'tttд', NULL, '2020-10-24 19:49:59', 0),
(72, 'bozhidar@mail.bg', 'tttд', NULL, '2020-10-24 19:56:56', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_id`),
  ADD UNIQUE KEY `car_register_number` (`car_register_number`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `mark_id` (`mark_id`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `car_expenses`
--
ALTER TABLE `car_expenses`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `expense_id` (`expense_id`),
  ADD KEY `car_id` (`car_id`);

--
-- Indexes for table `car_marks`
--
ALTER TABLE `car_marks`
  ADD PRIMARY KEY (`mark_id`),
  ADD KEY `mark_id` (`mark_id`);

--
-- Indexes for table `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `mark_id` (`mark_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `car_expenses`
--
ALTER TABLE `car_expenses`
  MODIFY `expense_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `car_marks`
--
ALTER TABLE `car_marks`
  MODIFY `mark_id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `FK_cars_car_marks` FOREIGN KEY (`mark_id`) REFERENCES `car_marks` (`mark_id`),
  ADD CONSTRAINT `FK_cars_car_models` FOREIGN KEY (`model_id`) REFERENCES `car_models` (`model_id`),
  ADD CONSTRAINT `FK_cars_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `car_expenses`
--
ALTER TABLE `car_expenses`
  ADD CONSTRAINT `FK_car_expenses_cars` FOREIGN KEY (`car_id`) REFERENCES `cars` (`car_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
