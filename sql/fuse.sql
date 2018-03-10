-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2018 at 03:05 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fuse`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `address` mediumtext,
  `birthday` varchar(200) DEFAULT NULL,
  `notes` varchar(255) DEFAULT NULL,
  `createdDate` datetime DEFAULT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `lastName`, `avatar`, `nickname`, `company`, `jobTitle`, `email`, `phone`, `address`, `birthday`, `notes`, `createdDate`, `modifiedDate`) VALUES
(1, 'Tarun', 'Upadhyay', '', 'tarun', 'Parulsoft', 'Web Developer', 'tarun@test.com', '8871457781', 'Geeta bhawan', '', '', '2018-02-28 12:47:28', '2018-02-28 11:47:28'),
(2, 'Raj', 'Kumar', 'assets/images/avatars/profile.jpg', 'raju', 'Raj Travel', 'Transporter', 'raju@test.com', '8871457781', 'Geeta bhawan', 'Wed Feb 28 2018 00:00:00 GMT+0530 (India Standard Time)', 'test', '2018-02-28 12:48:43', '2018-02-28 11:48:43'),
(3, 'Mithun', 'Chakrawarty', 'assets/images/avatars/profile.jpg', 'mithun', 'Parulsoft', 'SEO', 'mithun@test.com', '1234567890', 'Bhawarkua', 'Wed Feb 28 2018 00:00:00 GMT+0530 (India Standard Time)', 'test note', '2018-02-28 12:52:09', '2018-02-28 11:52:09'),
(4, 'Rakeshnew', 'Upadhyay', '', 'tarundemo', 'Test company', 'web developer', 'rakesh@test.com', '8871457781', 'Geeta bhawan', 'Thu Mar 29 2018 00:00:00 GMT+0530 (India Standard Time)', 'test', '2018-03-05 14:02:45', '2018-03-05 13:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `labels`
--

CREATE TABLE `labels` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `modifiedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `name`, `color`, `createdDate`, `modifiedDate`) VALUES
(1, 'Family', 'md-green-300-bg', '2018-02-20 18:30:00', '2018-02-21 10:21:58'),
(2, 'Work', NULL, '2018-02-20 18:30:00', '2018-02-21 10:22:16'),
(3, 'Todos', 'md-yellow-300-bg', '2018-02-20 18:30:00', '2018-02-21 10:22:47'),
(4, 'Prior', 'md-red-300-bg', '2018-02-20 18:30:00', '2018-02-21 10:23:14'),
(5, 'Personal', 'md-blue-300-bg', '2018-02-20 18:30:00', '2018-02-21 10:23:41'),
(6, 'Friends', 'md-orange-300-bg', '2018-02-20 18:30:00', '2018-02-21 10:24:01'),
(9, 'test', '', '2018-02-28 04:57:49', '2018-02-28 09:27:49'),
(10, 'mynote', '', '2018-03-05 08:22:08', '2018-03-05 12:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` mediumtext,
  `archive` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `color` varchar(255) DEFAULT NULL,
  `time` varchar(200) DEFAULT NULL,
  `reminder` varchar(200) DEFAULT NULL,
  `checklist` varchar(255) DEFAULT NULL,
  `labels` varchar(255) DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT NULL,
  `modifiedDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `title`, `description`, `archive`, `image`, `color`, `time`, `reminder`, `checklist`, `labels`, `createdDate`, `modifiedDate`) VALUES
(3, '', 'mytest2', 'false', '', 'md-amber-500-bg', 'Wed Feb 28 2018 14:54:38 GMT+0530 (India Standard Time)', '', '[{\"checked\":\"false\",\"text\":\"test\"},{\"checked\":\"false\",\"text\":\"test1\"}]', '', '2018-02-28 04:54:38', '2018-02-28 09:24:38'),
(4, 'test', 'testnote11', 'false', '', 'md-yellow-800-bg', 'Wed Feb 28 2018 15:24:27 GMT+0530 (India Standard Time)', 'Wed Feb 28 2018 05:30:00 GMT+0530 (India Standard Time)', '', '6,4', '2018-02-28 05:24:27', '2018-02-28 09:54:27'),
(5, '', 'testnote3', 'false', '', 'md-teal-400-bg', 'Wed Feb 28 2018 15:32:23 GMT+0530 (India Standard Time)', 'Wed Feb 28 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"test11\"},{\"checked\":\"true\",\"text\":\"test12\"}]', '6,4', '2018-02-28 05:32:23', '2018-02-28 10:02:23'),
(6, '', 'testnote4', 'false', '', 'md-pink-400-bg', 'Wed Feb 28 2018 15:35:52 GMT+0530 (India Standard Time)', 'Wed Mar 14 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"tet\"}]', '5,6', '2018-02-28 05:35:52', '2018-02-28 10:05:52'),
(7, '', 'testnote5', 'true', '', 'md-indigo-400-bg', 'Wed Feb 28 2018 16:01:37 GMT+0530 (India Standard Time)', 'Thu Feb 22 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"test\"}]', '6,1', '2018-02-28 06:01:37', '2018-02-28 10:31:37'),
(8, 'My test 5', 'mytest note 5', 'false', '', 'md-green-300-bg', 'Mon Mar 05 2018 18:22:58 GMT+0530 (India Standard Time)', 'Fri Mar 30 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"test\"},{\"checked\":\"true\",\"text\":\"test2\"}]', '5,4', '2018-03-05 08:22:58', '2018-03-05 12:52:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `labels`
--
ALTER TABLE `labels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
