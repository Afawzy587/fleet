-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 05:27 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fleet`
--

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `groups_sn` int(11) NOT NULL,
  `groups_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `groups_notes` text CHARACTER SET utf8 NOT NULL,
  `system_information` tinyint(1) NOT NULL DEFAULT '1',
  `groups_status` tinyint(1) NOT NULL DEFAULT '1',
  `contacts_list` tinyint(1) NOT NULL DEFAULT '1',
  `contacts_add` tinyint(1) NOT NULL DEFAULT '1',
  `contacts_edit` tinyint(1) NOT NULL DEFAULT '1',
  `contacts_delete` tinyint(1) NOT NULL DEFAULT '1',
  `expenses_add` tinyint(1) NOT NULL DEFAULT '1',
  `expenses_edit` tinyint(1) NOT NULL DEFAULT '1',
  `expenses_delete` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`groups_sn`, `groups_name`, `groups_notes`, `system_information`, `groups_status`, `contacts_list`, `contacts_add`, `contacts_edit`, `contacts_delete`, `expenses_add`, `expenses_edit`, `expenses_delete`) VALUES
(1, 'مديري النظام	', 'جميع صلاحيات النظام	', 1, 1, 1, 1, 1, 1, 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groups_sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groups_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
