-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 15, 2019 at 02:04 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_savings`
--

-- --------------------------------------------------------

--
-- Table structure for table `activities`
--

CREATE TABLE `activities` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `activity` varchar(256) NOT NULL,
  `done_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `activities`
--

INSERT INTO `activities` (`activity_id`, `user_id`, `activity`, `done_on`) VALUES
(1, 1, 'created a new flexible plan', '2019-12-13 19:12:23'),
(2, 1, 'made a deposit  for Beli MOBIL', '2019-12-13 19:12:42'),
(3, 1, 'created a new strict plan', '2019-12-13 19:14:57'),
(4, 1, 'made a deposit  for Beli MOBIL', '2019-12-13 19:15:18'),
(5, 1, 'made a deposit  for Uang SPP', '2019-12-13 19:15:38'),
(6, 1, 'withdrew from Beli MOBIL', '2019-12-13 19:16:53'),
(7, 1, 'completed the plan for Beli MOBIL', '2019-12-13 19:17:17'),
(8, 1, 'created a new flexible plan', '2019-12-13 19:17:44'),
(9, 1, 'completed the plan for Beli Rumah', '2019-12-13 19:18:19'),
(10, 1, 'created a new flexible plan', '2019-12-13 19:24:51');

-- --------------------------------------------------------

--
-- Table structure for table `lists`
--

CREATE TABLE `lists` (
  `list_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(256) DEFAULT NULL,
  `est_cost` double NOT NULL,
  `goal_date` date DEFAULT NULL,
  `created_on` datetime NOT NULL,
  `save_freq` int(11) DEFAULT NULL,
  `trans_needed` int(11) DEFAULT NULL,
  `save_amount` double DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `category` varchar(20) NOT NULL,
  `complete_or_cancel_date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lists`
--

INSERT INTO `lists` (`list_id`, `title`, `description`, `est_cost`, `goal_date`, `created_on`, `save_freq`, `trans_needed`, `save_amount`, `status`, `category`, `complete_or_cancel_date`, `user_id`) VALUES
(1, 'Beli MOBIL', 'Jadi ini uang untuk beli mobil ditahun 2020', 14000000, NULL, '2019-12-13 19:12:23', NULL, NULL, NULL, 'completed', 'flexible', '2019-12-13 19:17:17', 1),
(2, 'Uang SPP', 'spp semester 2020', 1750000, '2020-03-07', '2019-12-13 19:14:57', 1, 84, 20588, 'on_going', 'strict', NULL, 1),
(3, 'Beli Rumah', 'No description.', 300000000, NULL, '2019-12-13 19:17:44', NULL, NULL, NULL, 'completed', 'flexible', '2019-12-13 19:18:19', 1),
(4, 'Beli apa lagi yaa', 'No description.', 12333000, NULL, '2019-12-13 19:24:51', NULL, NULL, NULL, 'on_going', 'flexible', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `list_details`
--

CREATE TABLE `list_details` (
  `list_detail_id` int(11) NOT NULL,
  `tr_date` datetime NOT NULL,
  `detail_amount` int(11) NOT NULL,
  `action` varchar(20) NOT NULL,
  `list_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `list_details`
--

INSERT INTO `list_details` (`list_detail_id`, `tr_date`, `detail_amount`, `action`, `list_id`) VALUES
(1, '2019-12-13 19:12:41', 150000, 'deposit', 1),
(2, '2019-12-13 19:15:17', 150000, 'deposit', 1),
(3, '2019-12-13 19:15:38', 20588, 'deposit', 2),
(4, '2019-12-13 19:16:51', 300000, 'withdraw', 1),
(5, '2019-12-13 19:17:17', 14000000, 'deposit', 1),
(6, '2019-12-13 19:18:18', 2147483647, 'deposit', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(256) NOT NULL,
  `register_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `image` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `register_date`, `image`, `role_id`) VALUES
(1, 'Ronoroa KID', 'ronoroakid@gmail.com', '$2y$10$SyrgOCY1H2tDU56NdZWEcugXPdDeYkbuAIlwUIP1ne7lJqcS/vIQy', '2019-12-03 09:36:59', 'default.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `wallets`
--

CREATE TABLE `wallets` (
  `wallet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wallets`
--

INSERT INTO `wallets` (`wallet_id`, `user_id`, `amount`) VALUES
(1, 2, 0),
(2, 1, 2147483647);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `fk_user_activity_id` (`user_id`);

--
-- Indexes for table `lists`
--
ALTER TABLE `lists`
  ADD PRIMARY KEY (`list_id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Indexes for table `list_details`
--
ALTER TABLE `list_details`
  ADD PRIMARY KEY (`list_detail_id`),
  ADD KEY `fk_list_id` (`list_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_role_id` (`role_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `wallets`
--
ALTER TABLE `wallets`
  ADD PRIMARY KEY (`wallet_id`),
  ADD KEY `fk_user_wallet_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activities`
--
ALTER TABLE `activities`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `lists`
--
ALTER TABLE `lists`
  MODIFY `list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `list_details`
--
ALTER TABLE `list_details`
  MODIFY `list_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `wallets`
--
ALTER TABLE `wallets`
  MODIFY `wallet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `activities`
--
ALTER TABLE `activities`
  ADD CONSTRAINT `fk_user_activity_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `lists`
--
ALTER TABLE `lists`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `list_details`
--
ALTER TABLE `list_details`
  ADD CONSTRAINT `fk_list_id` FOREIGN KEY (`list_id`) REFERENCES `lists` (`list_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_role_id` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`role_id`);

--
-- Constraints for table `wallets`
--
ALTER TABLE `wallets`
  ADD CONSTRAINT `fk_user_wallet_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
