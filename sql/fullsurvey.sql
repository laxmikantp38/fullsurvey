-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2018 at 03:37 PM
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
-- Database: `fullsurvey`
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
(6, 'test', 'test', '5aa9265f2307b.png', 'test', 'test', 'test', 'test@test.com', '123456', '', '', '', '2018-03-14 10:05:26', '2018-03-14 09:05:26');

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
(10, 'mynote', '', '2018-03-05 08:22:08', '2018-03-05 12:52:08'),
(11, 'test', '', '2018-03-14 04:26:08', '2018-03-14 08:56:08'),
(12, 'mytest22', '', '2018-03-14 04:26:22', '2018-03-14 08:56:22'),
(13, 'test', '', '2018-03-14 08:44:09', '2018-03-14 13:14:09');

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
(5, '', 'testnote32', 'false', '', 'md-teal-400-bg', 'Wed Mar 14 2018 18:44:56 GMT+0530 (India Standard Time)', 'Wed Feb 28 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"true\",\"text\":\"test11\"},{\"checked\":\"true\",\"text\":\"test12\"}]', '6,4', '2018-02-28 05:32:23', '2018-02-28 10:02:23'),
(6, '', 'testnote412', 'false', '', 'md-pink-400-bg', 'Wed Mar 14 2018 18:44:30 GMT+0530 (India Standard Time)', 'Wed Mar 14 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"tet\"}]', '5,6', '2018-02-28 05:35:52', '2018-02-28 10:05:52'),
(7, '', 'testnote5', 'true', '', 'md-indigo-400-bg', 'Wed Feb 28 2018 16:01:37 GMT+0530 (India Standard Time)', 'Thu Feb 22 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"test\"}]', '6,1', '2018-02-28 06:01:37', '2018-02-28 10:31:37'),
(8, 'My test 5', 'mytest note 5', 'false', '', 'md-green-300-bg', 'Mon Mar 05 2018 18:22:58 GMT+0530 (India Standard Time)', 'Fri Mar 30 2018 05:30:00 GMT+0530 (India Standard Time)', '[{\"checked\":\"false\",\"text\":\"test\"},{\"checked\":\"true\",\"text\":\"test2\"}]', '5,4', '2018-03-05 08:22:58', '2018-03-05 12:52:58');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `label` varchar(255) DEFAULT NULL,
  `color` varchar(200) DEFAULT NULL,
  `createDate` datetime DEFAULT NULL,
  `modifiedDate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `label`, `color`, `createDate`, `modifiedDate`) VALUES
(1, 'frontend', 'Frontend', '#388E3C', '2018-03-13 00:00:00', '2018-03-13 12:35:19'),
(2, 'backend', 'Backend', '#F44336', '2018-03-13 00:00:00', '2018-03-13 12:35:43'),
(3, 'API', 'API', '#FF9800', '2018-03-13 00:00:00', '2018-03-13 12:36:07'),
(4, 'issue', 'Issue', '#0091EA', '2018-03-13 00:00:00', '2018-03-13 12:36:31'),
(5, 'mobile', 'Mobile', '#9C27B0', '2018-03-13 00:00:00', '2018-03-13 12:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `todos`
--

CREATE TABLE `todos` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `notes` mediumtext,
  `startDate` varchar(200) DEFAULT NULL,
  `dueDate` varchar(200) DEFAULT NULL,
  `completed` varchar(200) DEFAULT NULL,
  `starred` varchar(200) DEFAULT NULL,
  `important` varchar(200) DEFAULT NULL,
  `deleted` varchar(200) DEFAULT NULL,
  `tags` mediumtext,
  `created_date` datetime DEFAULT NULL,
  `modified_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `todos`
--

INSERT INTO `todos` (`id`, `title`, `notes`, `startDate`, `dueDate`, `completed`, `starred`, `important`, `deleted`, `tags`, `created_date`, `modified_date`) VALUES
(3, 'Proident tempor est nulla irure ad est', 'Id nulla nulla proident deserunt deserunt proident in quis. Cillum reprehenderit labore id anim laborum.', 'Wednesday, January 29, 2014 3:17 PM', 'null', 'false', 'false', 'false', 'false', '[\r\n                {\r\n                    \"id\": 1,\r\n                    \"name\": \"frontend\",\r\n                    \"label\": \"Frontend\",\r\n                    \"color\": \"#388E3C\"\r\n                }\r\n            ]', '2018-03-13 00:00:00', '2018-03-13 12:57:37'),
(4, 'Magna quis irure quis ea pariatur laborum', NULL, 'Sunday, February 1, 2015 1:30 PM', 'Friday, December 30, 2016 10:07 AM', 'true', 'true', 'true', 'false', '[\r\n                {\r\n                    \"id\": 1,\r\n                    \"name\": \"frontend\",\r\n                    \"label\": \"Frontend\",\r\n                    \"color\": \"#388E3C\"\r\n                },\r\n                {\r\n                    \"id\": 4,\r\n                    \"name\": \"issue\",\r\n                    \"label\": \"Issue\",\r\n                    \"color\": \"#0091EA\"\r\n                }\r\n            ]', '2018-03-13 00:00:00', '2018-03-13 12:59:03'),
(9, 'todaytestwork', 'test', 'Tue Mar 13 2018 18:48:07 GMT+0530 (India Standard Time)', 'Thu Mar 15 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'true', '[                 {                     \"id\": 1,                     \"name\": \"frontend\",                     \"label\": \"Frontend\",                     \"color\": \"#388E3C\"                 },                 {                     \"id\": 4,                     \"name\": \"issue\",                     \"label\": \"Issue\",                     \"color\": \"#0091EA\"                 }             ]', '2018-03-13 14:18:35', '2018-03-13 13:18:35'),
(10, 'task1', 'test', 'Tue Mar 13 2018 18:52:08 GMT+0530 (India Standard Time)', 'Thu Mar 22 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'true', '[                 {                     \"id\": 1,                     \"name\": \"frontend\",                     \"label\": \"Frontend\",                     \"color\": \"#388E3C\"                 },                 {                     \"id\": 4,                     \"name\": \"issue\",                     \"label\": \"Issue\",                     \"color\": \"#0091EA\"                 }             ]', '2018-03-13 14:22:30', '2018-03-13 13:22:30'),
(11, 'task2', 'test&#65279;', 'Tue Mar 13 2018 18:55:23 GMT+0530 (India Standard Time)', 'Thu Mar 22 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'true', '[                 {                     \"id\": 1,                     \"name\": \"frontend\",                     \"label\": \"Frontend\",                     \"color\": \"#388E3C\"                 },                 {                     \"id\": 4,                     \"name\": \"issue\",                     \"label\": \"Issue\",                     \"color\": \"#0091EA\"                 }             ]', '2018-03-13 14:25:40', '2018-03-13 13:25:40'),
(12, 'task4', 'teseee', 'Tue Mar 13 2018 18:57:49 GMT+0530 (India Standard Time)', 'Thu Mar 22 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'true', '[                 {                     \"id\": 1,                     \"name\": \"frontend\",                     \"label\": \"Frontend\",                     \"color\": \"#388E3C\"                 },                 {                     \"id\": 4,                     \"name\": \"issue\",                     \"label\": \"Issue\",                     \"color\": \"#0091EA\"                 }             ]', '2018-03-13 14:28:08', '2018-03-13 13:28:08'),
(13, 'newtask1', 'test1', 'Tue Mar 13 2018 19:32:52 GMT+0530 (India Standard Time)', 'Wed Mar 21 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'false', '[{\"name\":\"test1\",\"label\":\"test1\",\"color\":\"#FF9800\",\"$$hashKey\":\"object:453\"},{\"name\":\"test2\",\"label\":\"test2\",\"color\":\"#9C27B0\",\"$$hashKey\":\"object:461\"},{\"name\":\"test3\",\"label\":\"test3\",\"color\":\"#FF9800\",\"$$hashKey\":\"object:469\"},{\"name\":\"test4\",\"label\":\"test4\",\"color\":\"#388E3C\",\"$$hashKey\":\"object:477\"}]', '2018-03-13 15:03:08', '2018-03-13 14:03:08'),
(15, 'atest', 'test', 'Wed Mar 14 2018 16:25:28 GMT+0530 (India Standard Time)', 'Thu Mar 15 2018 00:00:00 GMT+0530 (India Standard Time)', 'true', 'true', 'false', 'false', '[{\"name\":\"test1\",\"label\":\"test1\",\"color\":\"#FF9800\"},{\"name\":\"test2\",\"label\":\"test2\",\"color\":\"#9C27B0\"},{\"name\":\"teg\",\"label\":\"teg\",\"color\":\"#9C27B0\"},{\"name\":\"tag3\",\"label\":\"tag3\",\"color\":\"#9C27B0\"}]', '2018-03-14 11:55:49', '2018-03-14 10:55:49'),
(16, 'anewtest', 'test', 'Wed Mar 14 2018 16:26:54 GMT+0530 (India Standard Time)', 'Thu Mar 15 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'true', '[{\"name\":\"test1\",\"label\":\"test1\",\"color\":\"#FF9800\",\"$$hashKey\":\"object:453\"},{\"name\":\"test2\",\"label\":\"test2\",\"color\":\"#9C27B0\",\"$$hashKey\":\"object:461\"},{\"name\":\"test3\",\"label\":\"test3\",\"color\":\"#FF9800\",\"$$hashKey\":\"object:469\"},{\"name\":\"test4\",\"label\":\"test4\",\"color\":\"#388E3C\",\"$$hashKey\":\"object:477\"}]', '2018-03-14 11:57:15', '2018-03-14 10:57:15'),
(17, 'amytestqq', 'test', 'Wed Mar 14 2018 16:53:33 GMT+0530 (India Standard Time)', 'Wed Mar 14 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'false', '[{\"name\":\"tag1\",\"label\":\"tag1\",\"color\":\"#F44336\"},{\"name\":\"tag2\",\"label\":\"tag2\",\"color\":\"#F44336\"}]', '2018-03-14 12:24:03', '2018-03-14 11:24:03'),
(18, 'amytest1', 'test', 'Wed Mar 14 2018 16:55:45 GMT+0530 (India Standard Time)', 'Wed Mar 14 2018 00:00:00 GMT+0530 (India Standard Time)', 'true', 'true', 'true', 'false', '[{\"name\":\"mytag1\",\"label\":\"mytag1\",\"color\":\"#FF9800\",\"$$hashKey\":\"object:671\"}]', '2018-03-14 12:26:34', '2018-03-14 11:26:34'),
(19, 'test11', 'test', 'Wed Mar 14 2018 18:23:21 GMT+0530 (India Standard Time)', 'Wed Mar 14 2018 00:00:00 GMT+0530 (India Standard Time)', 'false', 'false', 'false', 'false', '[{\"name\":\"test1\",\"label\":\"test1\",\"color\":\"#9C27B0\",\"$$hashKey\":\"object:549\"},{\"name\":\"test2\",\"label\":\"test2\",\"color\":\"#388E3C\",\"$$hashKey\":\"object:557\"}]', '2018-03-14 13:53:41', '2018-03-14 12:53:41'),
(20, 'anewtest22', 'test', 'Wed Mar 14 2018 18:23:57 GMT+0530 (India Standard Time)', 'Wed Mar 14 2018 00:00:00 GMT+0530 (India Standard Time)', 'true', 'true', 'true', 'false', '[{\"name\":\"tea\",\"label\":\"tea\",\"color\":\"#F44336\",\"$$hashKey\":\"object:538\"}]', '2018-03-14 13:54:14', '2018-03-14 12:54:14');

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
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `todos`
--
ALTER TABLE `todos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `labels`
--
ALTER TABLE `labels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `todos`
--
ALTER TABLE `todos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
