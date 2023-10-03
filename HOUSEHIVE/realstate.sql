-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2023 at 06:16 AM
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
-- Database: `realstate`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `Admin_Id` int(10) NOT NULL,
  `UserName` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `Contact` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Position` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`Admin_Id`, `UserName`, `Password`, `Contact`, `Email`, `Position`) VALUES
(1, 'fcgvhbnm,', '$2y$10$JXV3qPzbOtOCKrBjVZJtNeyfI8vhjRr7sHFSjVvURLqyZUNGRd2QO', 0, 'hvbjnm@ghsj', 'fgvbhjn'),
(2, 'ketan', '$2y$10$LL0eFmtHUAiHXPFPexdI9e2HAkCUKMyrz4rnQGLhtM47gWaHW.uci', 19999, '19999999@q', 'fgvbhjn'),
(3, 'ketan', '$2y$10$5nNCPUBGzvuDn6CIGdukJudDVYdg3XN0u.D3rJOkzA4kybsz4sqJK', 0, '', ''),
(4, 'ketan', '$2y$10$hQMRpGZbXGlWOi/612pjm.FwLqj.MfF6jmh8ycAroCA0.TNT5ELye', 0, '', ''),
(5, 'ketan', '$2y$10$nhYW.kZqbhdOOrCcZ6QkT.dIK1KOsb7OFBdXWLTz4yRbd66b18xtC', 0, '', ''),
(6, 'ketan', '$2y$10$Tf./nXcFtmGE3eeggYlUB.kRKW8CnGsAJkT7Ypu6Fjtt7BzT7yJvu', 0, '', ''),
(7, 'ketan', '$2y$10$h6OACEjjFcVPmjq/qbq2/eqqbYfmZjQlBzSBTVjFsu7q.rXcFF9DO', 0, '', ''),
(8, 'ketan', '$2y$10$6.veB8aePIrx1AUU5Umu/.b1QW2GJ8T2TxE/Akzyt6hEkKxqvKpYK', 0, '', ''),
(9, 'ketan', '$2y$10$QkDOw0FedDAuxEYh95tLnuF5vQqKyMlPYrB06MuW9ygDwOx9Tyb/i', 0, '', ''),
(10, 'keshav', '$2y$10$N14FZM88htRvN0CruOjWwOLl5aJtRBD4qt3nDM9zanSo2TP.vzfEq', 981, 'asdfghjk@sdfg', 'ghvb'),
(11, 'ketan', '$2y$10$7LECxoJ4O/al2azTsQ92lenot3yk3D9dO/FJNJ0x7DZKsiOp04Rqa', 0, '', ''),
(12, 'ketan', '$2y$10$oz1aoJZM0wJ/zdcwY5VOruSyJOHUrFeVIl73bqPCzkCVFX7qlghEy', 0, '', ''),
(13, 'ketan', '$2y$10$82KjSl.8FP12r.5GoB849uDPghC.fQdzRIzZbjZpJ7ob8tN8I.ebG', 0, '', ''),
(14, 'ketan', '$2y$10$5yM7WscB1J0KJH5na4DVWOPvQ99k3RdOYN4gb224Vc0CNlCCvG1dO', 0, '', ''),
(15, 'ketan', '$2y$10$jy79q9Zk2Qm6GI0uDZf5veIBgSwbRgJqbVcgl3ItTNSX8VJ4aqAi2', 0, '', ''),
(16, 'ketan', '$2y$10$SsUXrqPdc/0IAhU3x/4Njezfe0d/07sQACEnr9CYkVs/N9LxOyeB6', 0, '', ''),
(17, 'ketan', '$2y$10$ej5ABYkLy8qn3Z6YHyEqUe7s0LzM93/HcoNA6LG1/8VexpyVexI6i', 0, '', ''),
(18, 'ketan', '$2y$10$Ay7sWi96mdaKk/EA42BAqeFZXpKYnnqcuJZcfOz53C1HmD9.DmEOi', 0, '', ''),
(19, 'ketan', '$2y$10$8k7KhH/UQRpOERxtqwmqWOUWhVp9s1X0ZxJwlsPNb0JNWjdmL/BXG', 0, '', ''),
(20, 'ketan', '$2y$10$HwnacNMKksY969hE7LADm.Bg8thfp2NMSzELqTNKfghbwJu3X46Ni', 0, '', ''),
(21, 'ketan', '$2y$10$2Y7owujqdg0M2LOuhNJN7uahp7MPhbgJBPK993P5EbdTrn3FNPyKa', 0, '', ''),
(22, 'ketan', '$2y$10$KVb2ahohKZGIrNZLNdgvfOkdF2IW3g.QNeWAjapYkJtPmY8yO60VS', 0, '', ''),
(23, 'ketan', '$2y$10$aPofj7Nh7oJhCTrSIel4gurBXEAovC2TvP45s.YI1L6ZmWcN0SHFy', 0, '', ''),
(24, 'ketan', '$2y$10$JWNctfLoj6KGHVdglRF.0eSXMNL5iRoA8xBx6sjG2txmAexFwlShq', 0, '', ''),
(25, 'ketan', '$2y$10$.lB3IxfpHYNWYH8QquCSa.FKUiyAvqVMh4lsXJCmntx46V6GZSSK6', 0, '', ''),
(26, 'ketan', '$2y$10$tW49tdwn8jATGyl2o23.kuIgcFXXqCP9hqRWlVeZFgGYLi/f4lujG', 0, '', ''),
(27, 'ketan', '$2y$10$KFDDjVBvRQcFAH/bbQcK2O9/xva4hLv05eR8I8WMA6yBp5xv1FbYS', 0, '', ''),
(28, 'ketan', '$2y$10$ABHivpblRxFDbjVJJ7ZDKOAwhdWyMUXuuigYUPuz7yhrvQRYLD72O', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `buy_hive`
--

CREATE TABLE `buy_hive` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `intrestedproperty` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buy_hive`
--

INSERT INTO `buy_hive` (`id`, `fname`, `lname`, `email`, `description`, `intrestedproperty`, `price`) VALUES
(1, 'xfcgvnbm', ' bnm,', ' cbmnmn ', 'c bn', 'hvhbjk', '20 Lakh or Below');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(20) NOT NULL,
  `text` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `text`) VALUES
(1, 'asdfgchj', 'srdgfhj@sdfg', 'sfdxgcfvb'),
(2, 'ketan arya', 'gggggg@gggggg', 'asdfghjsdfghjdfghj');

-- --------------------------------------------------------

--
-- Table structure for table `property_list`
--

CREATE TABLE `property_list` (
  `id` int(10) NOT NULL,
  `property_id` int(11) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `seller_info` varchar(255) NOT NULL,
  `property_type` varchar(255) NOT NULL,
  `property_description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `price` varchar(100) NOT NULL,
  `approval_status` enum('Pending','Approved') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `property_list`
--

INSERT INTO `property_list` (`id`, `property_id`, `seller_name`, `seller_info`, `property_type`, `property_description`, `location`, `price`, `approval_status`) VALUES
(1, 1000, 'keshav arya', '78963145/ketan@g', 'condo', 'nice house', 'hehe', 'fixed', 'Approved'),
(2, 1001, 'ketanji cfg', 'vg/gcfh', 'bvn ', 'fcghb', 'b n', 'nigotiable', 'Approved'),
(3, 10011, 'keshav arya', '9871908614/aryaketan@gmail.com', 'condo', 'great view', 'cal', 'fixed', 'Approved'),
(4, 100, 'keta ji', '0987766543/ddddd@zxzxzxz', 'house', 'asdfgh', 'gjh', 'fixed', 'Approved'),
(5, 21, '[value-3] [value-4]', '[value-11]/[value-5]', '[value-9]', '[value-12]', '[value-8]', '[value-13]', 'Approved'),
(6, 122, '[value-2] [value-3]', '[value-10]/[value-4]', '[value-8]', '[value-11]', '[value-7]', '[value-12]', 'Approved');

-- --------------------------------------------------------

--
-- Table structure for table `rent_hive`
--

CREATE TABLE `rent_hive` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `rentemail` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `rentdescription` text DEFAULT NULL,
  `intrestedproperty` varchar(255) DEFAULT NULL,
  `price` varchar(50) DEFAULT NULL,
  `agree` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rent_hive`
--

INSERT INTO `rent_hive` (`id`, `firstname`, `lastname`, `rentemail`, `country`, `city`, `phone`, `rentdescription`, `intrestedproperty`, `price`, `agree`) VALUES
(1, ' hbnm', 'v hbjn', 'hvjb', 'bn', 'hgbj', 'vjbh', 'vhjbhn', 'vvhjbhn', '1 Crore Or More', 0),
(2, ' hbnm', 'v hbjn', 'hvjb', 'bn', 'hgbj', 'vjbh', 'vhjbhn', 'vvhjbhn', '1 Crore Or More', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sell_hive`
--

CREATE TABLE `sell_hive` (
  `property_id` int(11) NOT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `proptype` varchar(255) DEFAULT NULL,
  `pricebid` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `agree` tinyint(1) DEFAULT NULL,
  `files` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sell_hive`
--

INSERT INTO `sell_hive` (`property_id`, `fname`, `lname`, `email`, `country`, `city`, `location`, `proptype`, `pricebid`, `phone`, `description`, `price`, `agree`, `files`) VALUES
(120, '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', '[value-13]', 0, '[value-15]'),
(123, '[value-2]', '[value-3]', '[value-4]', '[value-5]', '[value-6]', '[value-7]', '[value-8]', '[value-9]', '[value-10]', '[value-11]', '[value-12]', 0, '[value-14]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `userid` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `phone`, `email`, `password`, `address`) VALUES
(9, 'ketan', '1234567890', 'arya@1', '12345', 'ghj'),
(10, '', '', '', '', ''),
(11, 'vijay', '1234567898', 'vfuy@gmai.com', '123456', 'delhi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`Admin_Id`);

--
-- Indexes for table `buy_hive`
--
ALTER TABLE `buy_hive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_list`
--
ALTER TABLE `property_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `property_id` (`property_id`);

--
-- Indexes for table `rent_hive`
--
ALTER TABLE `rent_hive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sell_hive`
--
ALTER TABLE `sell_hive`
  ADD PRIMARY KEY (`property_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `Admin_Id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `buy_hive`
--
ALTER TABLE `buy_hive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `property_list`
--
ALTER TABLE `property_list`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `rent_hive`
--
ALTER TABLE `rent_hive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sell_hive`
--
ALTER TABLE `sell_hive`
  MODIFY `property_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
