-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 18, 2022 at 09:38 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `actions`
--

CREATE TABLE `actions` (
  `id` int(10) NOT NULL,
  `tc_id` int(5) NOT NULL,
  `action_seq` int(3) NOT NULL,
  `action_name` varchar(100) NOT NULL,
  `action_disable` tinyint(1) NOT NULL,
  `row_seq` int(2) NOT NULL,
  `field` varchar(50) NOT NULL,
  `sub_field` varchar(50) NOT NULL,
  `value` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `actions`
--

INSERT INTO `actions` (`id`, `tc_id`, `action_seq`, `action_name`, `action_disable`, `row_seq`, `field`, `sub_field`, `value`) VALUES
(3, 1, 1, 'open\"webpage\"=;\',./|\\', 0, 1, 'go to link', 'selenium action', 'https://demo.zeuz.ai/web/level/one/scenerios/login'),
(4, 1, 2, 'click action', 0, 1, 'att_name', 'element parameter', 'att_val'),
(5, 1, 2, 'click action', 0, 2, 'click', 'selenium action', 'click'),
(9, 1, 1, 'as', 0, 1, 'go to link', 'selenium action', 'asc'),
(10, 1, 1, 'as', 0, 1, 'go to link', 'selenium action', 'asc'),
(33, 9, 1, 'temp_name', 0, 1, 'go to link', 'selenium action', 'https://demo.zeuz.ai/web/level/one/scenerios/web_level_one_scenerio_update_inline_input_fields'),
(34, 9, 2, 'temp_name', 0, 1, 'att_name', 'element parameter', 'att_val'),
(35, 9, 2, 'temp_name', 0, 2, 'click', 'selenium action', 'click'),
(36, 9, 3, 'temp_name', 0, 1, 'att_name', 'selenium action', 'att_val'),
(37, 9, 3, 'temp_name', 0, 2, 'text', 'selenium action', 'val222'),
(38, 23, 1, 'temp_name', 0, 1, 'go to link', 'selenium action', 'https://demo.zeuz.ai/web/level/one/scenerios/login'),
(39, 23, 2, 'temp_name', 0, 1, 'go to link', 'selenium action', 'asdasd');

-- --------------------------------------------------------

--
-- Table structure for table `testcases`
--

CREATE TABLE `testcases` (
  `id` int(5) NOT NULL,
  `tc_name` varchar(255) NOT NULL,
  `tc_obj` text NOT NULL,
  `tc_creation_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `testcases`
--

INSERT INTO `testcases` (`id`, `tc_name`, `tc_obj`, `tc_creation_date`) VALUES
(9, 'sidebar', 'obj', '2022-06-01 18:18:46'),
(15, 'dashboard', 'to test dashboard', '2022-06-01 18:29:50'),
(23, 'a2', 'a2', '2022-06-02 12:29:51'),
(24, 'riad', 'test riad', '2022-06-02 13:33:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `run_status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `run_status`) VALUES
(1, 'admin', 'admin', 'no');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `actions`
--
ALTER TABLE `actions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testcases`
--
ALTER TABLE `testcases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `actions`
--
ALTER TABLE `actions`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `testcases`
--
ALTER TABLE `testcases`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;