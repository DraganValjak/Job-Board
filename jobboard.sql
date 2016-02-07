-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2016 at 10:30 AM
-- Server version: 10.1.8-MariaDB
-- PHP Version: 5.6.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jobboard`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Vozač'),
(2, 'Skladištar'),
(3, 'Dispečer');

-- --------------------------------------------------------

--
-- Table structure for table `ci_query`
--

CREATE TABLE `ci_query` (
  `id` int(11) NOT NULL,
  `query_string` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `postID` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `postID`, `user_id`, `comment`, `created_at`) VALUES
(1, 1, 2, 'Hej vidimo se sutra', '2016-02-07 09:27:49');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `company_id` int(11) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','passive') NOT NULL DEFAULT 'active',
  `type` int(1) DEFAULT '1',
  `user_image` varchar(255) DEFAULT 'http://localhost/job-board/images/blog/avatars/intern.jpg',
  `about` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`company_id`, `state_id`, `email`, `password`, `user_name`, `license`, `location`, `tel`, `url`, `created_date`, `status`, `type`, `user_image`, `about`) VALUES
(1, 1, 'company@company.com', '21232f297a57a5a743894a0e4a801fc3', 'Company', 'B', 'Croatia, Zagreb', '1234567', NULL, '2016-02-06 10:42:42', 'active', 1, 'http://localhost/job-board/profile_images/thumbs/22e30774ab7cbc287558a700d8c798da.jpg', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exspirience` varchar(50) DEFAULT NULL,
  `job_license` varchar(50) DEFAULT NULL,
  `job_type` varchar(30) NOT NULL,
  `body` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('active','passive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `user_id`, `category_id`, `state_id`, `title`, `exspirience`, `job_license`, `job_type`, `body`, `date_created`, `date_expires`, `status`) VALUES
(1, 2, 1, 1, 'Prvi oglas', 'Najmanje godinu dana', 'B', 'Za stalno', 'Laorem ipsum', '2016-02-06 10:29:23', '2016-02-29 10:29:23', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `hitchhikers`
--

CREATE TABLE `hitchhikers` (
  `id` int(11) NOT NULL,
  `user_company_id` int(11) NOT NULL,
  `from` varchar(200) DEFAULT NULL,
  `to` varchar(200) DEFAULT NULL,
  `at_what_time` varchar(50) DEFAULT NULL,
  `body` text,
  `date_hitchhiking` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','passive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `hitchhikers`
--

INSERT INTO `hitchhikers` (`id`, `user_company_id`, `from`, `to`, `at_what_time`, `body`, `date_hitchhiking`, `status`) VALUES
(1, 2, 'Varaždin', 'Zagreb', '07:00', 'Lorem ipsum', '2016-03-31 05:00:00', 'active'),
(2, 0, 'Čakovec', 'Zagreb', '11:00', 'Trakoko po oko kok', '2016-02-28 10:00:00', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_tel` varchar(50) DEFAULT NULL,
  `user_location` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `exspirience` varchar(50) DEFAULT NULL,
  `user_license` varchar(50) DEFAULT NULL,
  `job_type` varchar(30) NOT NULL,
  `body` text,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_expires` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status` enum('active','passive') NOT NULL DEFAULT 'active'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `company_id`, `category_id`, `state_id`, `name`, `user_email`, `user_tel`, `user_location`, `title`, `exspirience`, `user_license`, `job_type`, `body`, `date_created`, `date_expires`, `status`) VALUES
(1, 1, 1, 1, 'Company', 'company@company.com', '1234567', 'Croatia, Zagreb', 'Truck driver Wanted', 'Najmanje godinu dana', 'C1, C1+E', 'Za stalno', 'Truck driver .....', '2016-02-06 10:45:03', '2016-03-31 09:45:03', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `licence`
--

CREATE TABLE `licence` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `licence`
--

INSERT INTO `licence` (`id`, `name`) VALUES
(1, 'B'),
(2, 'B+E'),
(3, 'C1'),
(4, 'C1+E'),
(5, 'C'),
(6, 'C+E'),
(7, 'D1'),
(8, 'D1+E'),
(9, 'D'),
(10, 'D+E');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `state_name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `state_name`) VALUES
(1, 'Hrvatska'),
(2, 'Bosna i Hercegovina'),
(3, 'Srbija'),
(4, 'Slovenija');

-- --------------------------------------------------------

--
-- Table structure for table `temp_company`
--

CREATE TABLE `temp_company` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `user_name` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_password_key`
--

CREATE TABLE `temp_password_key` (
  `id` int(11) NOT NULL,
  `key` varchar(32) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE `temp_users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `state_id` smallint(6) NOT NULL,
  `facebook_id` bigint(20) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `license` varchar(50) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `tel` varchar(50) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','passive') NOT NULL DEFAULT 'active',
  `type` int(1) DEFAULT '0',
  `user_image` varchar(255) DEFAULT 'http://localhost/job-board/images/blog/avatars/intern.jpg',
  `about` tinytext
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `state_id`, `facebook_id`, `email`, `password`, `user_name`, `last_name`, `license`, `location`, `url`, `tel`, `created_date`, `status`, `type`, `user_image`, `about`) VALUES
(4, 1, 0, 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'admin', 'B', 'Laorem ipsum', NULL, '1234567', '2016-02-06 10:28:14', 'active', 2, 'http://localhost/job-board/images/blog/avatars/intern.jpg', 'Lorem ipsum...'),
(2, 1, 0, 'user@user.com', 'ee11cbb19052e40b07aac0ca060c23ee', 'user', 'user', 'B', 'Laorem ipsum', NULL, '1234567', '2016-02-06 10:28:14', 'active', 0, 'http://localhost/job-board/profile_images/thumbs/1b0c96fe1db904365d6f2626ddbca29a.png', 'Lorem ipsum...');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_query`
--
ALTER TABLE `ci_query`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`,`user_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hitchhikers`
--
ALTER TABLE `hitchhikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `licence`
--
ALTER TABLE `licence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `temp_company`
--
ALTER TABLE `temp_company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_password_key`
--
ALTER TABLE `temp_password_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_users`
--
ALTER TABLE `temp_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ci_query`
--
ALTER TABLE `ci_query`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hitchhikers`
--
ALTER TABLE `hitchhikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `licence`
--
ALTER TABLE `licence`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `temp_company`
--
ALTER TABLE `temp_company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_password_key`
--
ALTER TABLE `temp_password_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `temp_users`
--
ALTER TABLE `temp_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
