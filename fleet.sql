-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2020 at 05:28 PM
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
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `cars_sn` int(11) NOT NULL,
  `cars_code` varchar(100) CHARACTER SET utf8 NOT NULL,
  `cars_plate_number` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cars_chassis` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cars_engine` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cars_factory` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cars_model` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cars_year` char(4) CHARACTER SET utf8 NOT NULL,
  `cars_kilometer` int(6) NOT NULL,
  `cars_car_type` int(3) NOT NULL,
  `cars_owner_type_id` int(3) NOT NULL,
  `cars_supervisor_id` int(11) NOT NULL,
  `cars_project_id` int(11) NOT NULL,
  `cars_car_status` tinyint(1) NOT NULL,
  `cars_kilo_litre` decimal(5,2) NOT NULL,
  `cars_photo` char(15) NOT NULL,
  `cars_department_id` int(3) NOT NULL,
  `cars_long` decimal(5,2) NOT NULL,
  `cars_height` decimal(5,2) NOT NULL,
  `cars_peoples` int(2) NOT NULL,
  `cars_weight` int(5) NOT NULL,
  `cars_max_weight` int(5) NOT NULL,
  `cars_controller` varchar(50) CHARACTER SET utf8 NOT NULL,
  `cars_fuel-type` int(1) NOT NULL,
  `cars_tank_capacity` int(4) NOT NULL,
  `cars_oil_capacity` int(2) NOT NULL,
  `cars_oil_change` int(5) NOT NULL,
  `cars_tire_type_first` int(4) NOT NULL,
  `cars_number_first` int(2) NOT NULL,
  `cars_change_first` int(5) NOT NULL,
  `cars_tire_type_second` int(4) NOT NULL,
  `cars_number_second` int(2) NOT NULL,
  `cars_change_second` int(5) NOT NULL,
  `cars_price` int(8) NOT NULL,
  `cars_year_damage` int(2) NOT NULL,
  `cars_damage_price` int(8) NOT NULL,
  `cars_maintenance_budget` int(8) NOT NULL,
  `cars_annual_interest` decimal(6,2) NOT NULL,
  `cars_gps_fees` decimal(6,2) NOT NULL,
  `cars_maintenance _expectation` decimal(6,2) NOT NULL,
  `cars_expenses` decimal(6,2) NOT NULL,
  `max_kilo` int(6) NOT NULL,
  `cars_driver_salary` decimal(6,2) NOT NULL,
  `cars_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`cars_sn`, `cars_code`, `cars_plate_number`, `cars_chassis`, `cars_engine`, `cars_factory`, `cars_model`, `cars_year`, `cars_kilometer`, `cars_car_type`, `cars_owner_type_id`, `cars_supervisor_id`, `cars_project_id`, `cars_car_status`, `cars_kilo_litre`, `cars_photo`, `cars_department_id`, `cars_long`, `cars_height`, `cars_peoples`, `cars_weight`, `cars_max_weight`, `cars_controller`, `cars_fuel-type`, `cars_tank_capacity`, `cars_oil_capacity`, `cars_oil_change`, `cars_tire_type_first`, `cars_number_first`, `cars_change_first`, `cars_tire_type_second`, `cars_number_second`, `cars_change_second`, `cars_price`, `cars_year_damage`, `cars_damage_price`, `cars_maintenance_budget`, `cars_annual_interest`, `cars_gps_fees`, `cars_maintenance _expectation`, `cars_expenses`, `max_kilo`, `cars_driver_salary`, `cars_status`) VALUES
(1, '12345', '11212', '', '', '', '', '', 0, 0, 0, 1, 1, 0, '0.00', '', 0, '0.00', '0.00', 0, 0, 0, '', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0.00', '0.00', '0.00', '0.00', 0, '0.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `car_check`
--

CREATE TABLE `car_check` (
  `car_check_sn` int(11) NOT NULL,
  `car_check_car_id` int(11) NOT NULL,
  `car_check_by` int(11) NOT NULL,
  `car_check_date` date NOT NULL,
  `car_check_tank` enum('0','1','2','3','4') NOT NULL,
  `car_check_kilos` int(6) NOT NULL,
  `car_check_photo` char(15) NOT NULL,
  `car_check_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_docments`
--

CREATE TABLE `car_docments` (
  `car_docments_sn` int(11) NOT NULL,
  `car_docments_name` varchar(50) NOT NULL,
  `car_docments_date_start` date NOT NULL,
  `car_docments_date_end` date NOT NULL,
  `car_docments_car_id` int(11) NOT NULL,
  `car_docments_photo` char(15) NOT NULL,
  `car_docments_value` decimal(6,2) NOT NULL,
  `car_docments_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_expenses`
--

CREATE TABLE `car_expenses` (
  `car_expenses_sn` int(11) NOT NULL,
  `car_expenses_car_id` int(11) NOT NULL,
  `car_expenses_expense_id` int(6) NOT NULL,
  `car_expenses_supply_id` int(11) NOT NULL,
  `car_expenses_date` date NOT NULL,
  `car_expenses_by` int(11) NOT NULL,
  `car_expenses_doc` char(15) NOT NULL,
  `car_expenses_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_fuel`
--

CREATE TABLE `car_fuel` (
  `car_fuel_sn` int(11) NOT NULL,
  `car_fuel_car_id` int(11) NOT NULL,
  `car_fuel_by` int(11) NOT NULL,
  `car_fuel_previous_read` float NOT NULL,
  `car_fuel_now_read` float NOT NULL,
  `car_fuel_date` date NOT NULL,
  `car_fuel_time` time NOT NULL,
  `car_fuel_fuel_id` int(3) NOT NULL,
  `car_fuel_station` varchar(255) CHARACTER SET utf8 NOT NULL,
  `car_fuel_amount` float NOT NULL,
  `car_fuel_counter_photo` char(15) NOT NULL,
  `car_fuel_pump_photo` char(15) NOT NULL,
  `car_fuel_invoice_photo` char(15) NOT NULL,
  `car_fuel_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_orders`
--

CREATE TABLE `car_orders` (
  `car_orders_sn` int(11) NOT NULL,
  `car_orders_car_id` int(11) NOT NULL,
  `car_orders_supervisor_id` int(11) NOT NULL,
  `car_orders_driver_id` int(11) NOT NULL,
  `car_orders_project_id` int(11) NOT NULL,
  `car_orders_road_id` int(11) NOT NULL,
  `car_orders_delivery_by` int(11) NOT NULL,
  `car_orders_delivery_kilos` int(6) NOT NULL,
  `car_orders_delivery_date` date NOT NULL,
  `car_orders_delivery_time` time NOT NULL,
  `car_orders_expect_kilos` int(6) NOT NULL,
  `car_orders_expect_date` date NOT NULL,
  `car_orders_expect_time` time NOT NULL,
  `car_orders_check_id` int(11) NOT NULL,
  `car_orders_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `car_owner`
--

CREATE TABLE `car_owner` (
  `car_owner_sn` int(3) NOT NULL,
  `car_owner_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `car_owner_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_owner`
--

INSERT INTO `car_owner` (`car_owner_sn`, `car_owner_name`, `car_owner_status`) VALUES
(1, 'الملكية 1', 1),
(2, 'الملكية 2', 1),
(3, 'ملكية 8', 1),
(4, 'TITLE B', 3);

-- --------------------------------------------------------

--
-- Table structure for table `car_status`
--

CREATE TABLE `car_status` (
  `car_status_sn` int(3) NOT NULL,
  `car_status_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `car_status_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `car_status`
--

INSERT INTO `car_status` (`car_status_sn`, `car_status_name`, `car_status_status`) VALUES
(1, 'حالة 1', 1),
(2, 'حالة 2', 1),
(3, 'new', 3),
(4, 'Mohamed', 3),
(5, 'AHmed', 3),
(6, 'أحمد محمد', 3);

-- --------------------------------------------------------

--
-- Table structure for table `check_items`
--

CREATE TABLE `check_items` (
  `check_items_sn` int(11) NOT NULL,
  `check_items_check_id` int(11) NOT NULL,
  `check_items_name` varchar(50) NOT NULL,
  `check_items_value` int(3) NOT NULL,
  `check_items_degree` int(2) NOT NULL,
  `check_items_note` text CHARACTER SET utf8 NOT NULL,
  `check_items_closed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `company_information`
--

CREATE TABLE `company_information` (
  `company_information_sn` int(1) NOT NULL,
  `company_information_name` varchar(255) CHARACTER SET utf8 NOT NULL,
  `company_information_address` text CHARACTER SET utf8 NOT NULL,
  `company_information_phone` char(11) NOT NULL,
  `company_information_photo` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company_information`
--

INSERT INTO `company_information` (`company_information_sn`, `company_information_name`, `company_information_address`, `company_information_phone`, `company_information_photo`) VALUES
(1, 'الكمار', '15 شارع محب ش2 القاهرة', '01149746836', '99014c7cf2.png');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `departments_sn` int(3) NOT NULL,
  `departments_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `departments_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`departments_sn`, `departments_name`, `departments_status`) VALUES
(1, 'قطاع 1', 3),
(2, 'قطاع 7', 1),
(5, 'أحمد محمد', 3),
(6, 'أحمد محمد', 3),
(7, '', 3),
(8, 'TITLE B', 3),
(10, 'TITLE B', 3),
(11, 'TITLE', 3),
(14, 'AHmed', 3),
(16, 'new', 3),
(17, 'aassxs', 3),
(18, 'Mohamed', 3),
(19, 'fawzy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `expenses_sn` int(6) NOT NULL,
  `expenses_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `expenses_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`expenses_sn`, `expenses_name`, `expenses_status`) VALUES
(1, 'مصروف 1', 1),
(2, 'مصروف 2', 1),
(3, 'مصروف 3', 1),
(6, 'مصروف 4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `forms_sn` int(11) NOT NULL,
  `forms_photo` char(15) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `forms_items`
--

CREATE TABLE `forms_items` (
  `forms_items_sn` int(3) NOT NULL,
  `forms_items_form_id` int(3) NOT NULL,
  `forms_items_name` char(50) CHARACTER SET utf8 NOT NULL,
  `forms_items_degrees` int(3) NOT NULL,
  `forms_items_order` int(2) NOT NULL,
  `forms_items_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `fuel_type`
--

CREATE TABLE `fuel_type` (
  `fuel_type_sn` int(3) NOT NULL,
  `fuel_type_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `fuel_type_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `fuel_type`
--

INSERT INTO `fuel_type` (`fuel_type_sn`, `fuel_type_name`, `fuel_type_status`) VALUES
(1, 'بنزين ', 1),
(2, 'سولار ', 1),
(3, 'غاز طبيعى', 1),
(4, 'حريق 78', 3),
(6, 'TITLE B', 3),
(7, 'TITLE', 3);

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

-- --------------------------------------------------------

--
-- Table structure for table `job_orders`
--

CREATE TABLE `job_orders` (
  `job_orders_sn` int(11) NOT NULL,
  `job_orders_car_id` int(11) NOT NULL,
  `job_orders_by` int(11) NOT NULL,
  `job_orders_date_in` date NOT NULL,
  `job_orders_time_in` time NOT NULL,
  `job_orders_kilometers` int(6) NOT NULL,
  `job_orders_date_expect` date NOT NULL,
  `job_orders_time_expect` time NOT NULL,
  `job_orders_tank` enum('0','1','2','3','4') NOT NULL,
  `job_orders_total_fix` float NOT NULL,
  `job_orders_total_price` float NOT NULL,
  `job_orders_discount` float NOT NULL,
  `job_orders_extra` float NOT NULL,
  `job_orders_notes` text CHARACTER SET utf8 NOT NULL,
  `job_orders_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `job_type_sn` int(3) NOT NULL,
  `job_type_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `job_type_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`job_type_sn`, `job_type_name`, `job_type_status`) VALUES
(1, 'وظيفة 1', 1),
(2, 'وظيفة 2', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `who` varchar(20) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text COLLATE utf8_bin NOT NULL,
  `data` text COLLATE utf8_bin NOT NULL,
  `periority` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `type`, `who`, `user_id`, `time`, `message`, `data`, `periority`) VALUES
(1, 0, 'user', 175, '2020-02-18 17:07:11', 'User #175opened [ type => user] , [ module => login] , [ mode => login] , [ id => 175] , ', '[ G_do => login] , [ P_username => Ahmed85@gmail.com] , [ P_password => 12345678] , ', 1),
(2, 0, 'admin', 175, '2020-02-18 17:07:22', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(3, 0, 'admin', 175, '2020-02-18 17:07:52', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(4, 0, 'admin', 175, '2020-02-18 17:20:35', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(5, 0, 'admin', 175, '2020-02-18 17:20:38', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(6, 0, 'admin', 175, '2020-02-18 17:27:32', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(7, 0, 'admin', 175, '2020-02-18 17:28:17', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(8, 0, 'admin', 175, '2020-02-18 17:29:16', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(9, 0, 'admin', 175, '2020-02-18 17:29:18', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(10, 0, 'admin', 175, '2020-02-18 17:29:30', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(11, 0, 'admin', 175, '2020-02-18 17:30:54', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(12, 0, 'admin', 175, '2020-02-18 17:30:59', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(13, 0, 'admin', 175, '2020-02-18 17:30:59', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(14, 0, 'admin', 175, '2020-02-18 17:32:08', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(15, 0, 'admin', 175, '2020-02-18 17:33:12', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(16, 0, 'admin', 175, '2020-02-18 17:33:45', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(17, 4, 'user', 175, '2020-02-19 11:44:54', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(18, 5, 'user', 175, '2020-02-19 11:46:06', 'User #175opened [ type => user] , [ module => system_information] , [ mode => edit_company_information] , [ id => 175] , ', '[ G_do => add_information] , [ P_name => 12235244578] , [ P_address => 15 شارع محب ش2 القاهرة] , [ P_phone => 01149746836] , ', 1),
(19, 4, 'user', 175, '2020-02-19 11:46:17', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(20, 5, 'user', 175, '2020-02-19 11:46:30', 'User #175opened [ type => user] , [ module => system_information] , [ mode => edit_company_information] , [ id => 175] , ', '[ G_do => add_information] , [ P_name => الكمار] , [ P_address => 15 شارع محب ش2 القاهرة] , [ P_phone => 01149746836] , ', 1),
(21, 0, 'admin', 175, '2020-02-19 11:46:57', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(22, 0, 'admin', 175, '2020-02-19 11:47:04', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(23, 0, 'admin', 175, '2020-02-19 11:47:08', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(24, 0, 'admin', 175, '2020-02-19 12:05:55', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(25, 0, 'admin', 175, '2020-02-19 12:15:51', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(26, 0, 'admin', 175, '2020-02-19 12:29:02', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => ] , [ id => 175] , ', '', 1),
(27, 0, 'admin', 175, '2020-02-19 12:29:10', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(28, 0, 'admin', 175, '2020-02-19 12:29:13', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(29, 0, 'admin', 175, '2020-02-19 12:29:15', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(30, 0, 'admin', 175, '2020-02-19 12:36:58', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(31, 0, 'admin', 175, '2020-02-19 12:43:10', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(32, 0, 'admin', 175, '2020-02-19 12:44:16', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(33, 0, 'admin', 175, '2020-02-19 12:53:54', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(34, 0, 'admin', 175, '2020-02-19 13:07:15', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(35, 0, 'admin', 175, '2020-02-19 13:07:24', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(36, 0, 'admin', 175, '2020-02-19 13:11:04', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(37, 0, 'admin', 175, '2020-02-19 13:11:27', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(38, 0, 'admin', 175, '2020-02-19 13:12:56', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(39, 0, 'admin', 175, '2020-02-19 13:13:07', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(40, 0, 'admin', 175, '2020-02-19 13:13:18', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(41, 0, 'admin', 175, '2020-02-19 13:13:23', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(42, 4, 'user', 175, '2020-02-19 13:13:46', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(43, 0, 'admin', 175, '2020-02-19 13:15:11', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(44, 0, 'admin', 175, '2020-02-19 13:19:10', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(45, 0, 'admin', 175, '2020-02-19 13:20:01', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(46, 0, 'admin', 175, '2020-02-19 13:20:03', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(47, 4, 'user', 175, '2020-02-19 13:20:11', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(48, 0, 'admin', 175, '2020-02-19 13:20:49', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(49, 0, 'admin', 175, '2020-02-19 13:20:51', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(50, 0, 'admin', 175, '2020-02-19 13:38:57', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(51, 0, 'admin', 175, '2020-02-19 13:42:27', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(52, 0, 'admin', 175, '2020-02-19 13:42:52', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(53, 0, 'admin', 175, '2020-02-19 13:52:15', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(54, 0, 'admin', 175, '2020-02-19 13:52:18', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(55, 0, 'admin', 175, '2020-02-19 13:52:18', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(56, 0, 'admin', 175, '2020-02-19 13:52:50', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(57, 0, 'admin', 175, '2020-02-19 13:52:53', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(58, 0, 'admin', 175, '2020-02-19 13:52:54', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(59, 0, 'admin', 175, '2020-02-19 13:52:57', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(60, 0, 'admin', 175, '2020-02-19 13:52:58', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(61, 0, 'admin', 175, '2020-02-19 13:52:59', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(62, 0, 'admin', 175, '2020-02-19 13:56:30', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(63, 0, 'admin', 175, '2020-02-19 14:09:48', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(64, 0, 'admin', 175, '2020-02-19 14:10:00', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(65, 0, 'admin', 175, '2020-02-19 14:10:47', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(66, 0, 'admin', 175, '2020-02-19 14:10:49', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(67, 0, 'admin', 175, '2020-02-19 14:16:16', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(68, 0, 'admin', 175, '2020-02-19 14:16:19', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(69, 0, 'admin', 175, '2020-02-19 14:16:21', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(70, 0, 'admin', 175, '2020-02-19 14:17:51', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(71, 0, 'admin', 175, '2020-02-19 14:18:56', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(72, 0, 'admin', 175, '2020-02-19 14:19:19', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(73, 0, 'admin', 175, '2020-02-19 14:19:44', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(74, 0, 'admin', 175, '2020-02-19 14:19:45', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(75, 0, 'admin', 175, '2020-02-19 14:19:46', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(76, 0, 'admin', 175, '2020-02-19 14:19:48', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(77, 0, 'admin', 175, '2020-02-19 14:19:51', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(78, 4, 'user', 175, '2020-02-19 14:42:15', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(79, 4, 'user', 175, '2020-02-19 14:43:31', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(80, 4, 'user', 175, '2020-02-19 14:43:46', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(81, 4, 'user', 175, '2020-02-19 14:44:22', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(82, 4, 'user', 175, '2020-02-19 14:44:57', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(83, 0, 'admin', 175, '2020-02-19 14:45:06', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(84, 0, 'admin', 175, '2020-02-19 14:45:08', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(85, 0, 'admin', 175, '2020-02-19 14:45:08', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(86, 0, 'admin', 175, '2020-02-19 15:16:21', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(87, 0, 'admin', 175, '2020-02-19 15:16:24', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(88, 0, 'admin', 175, '2020-02-19 15:16:27', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(89, 0, 'admin', 175, '2020-02-19 15:16:32', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(90, 0, 'admin', 175, '2020-02-19 15:16:43', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(91, 0, 'admin', 175, '2020-02-19 15:17:56', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(92, 0, 'admin', 175, '2020-02-19 15:23:56', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(93, 0, 'admin', 175, '2020-02-19 15:24:01', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(94, 0, 'admin', 175, '2020-02-19 15:24:03', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(95, 0, 'user', 175, '2020-02-19 23:08:39', 'User #175opened [ type => user] , [ module => login] , [ mode => login] , [ id => 175] , ', '[ G_do => login] , [ P_username => Ahmed85@gmail.com] , [ P_password => 12345678] , ', 1),
(96, 0, 'admin', 175, '2020-02-19 23:10:25', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(97, 0, 'admin', 175, '2020-02-19 23:10:29', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(98, 0, 'admin', 175, '2020-02-19 23:10:31', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(99, 0, 'admin', 175, '2020-02-19 23:10:36', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(100, 0, 'admin', 175, '2020-02-19 23:10:41', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(101, 0, 'admin', 175, '2020-02-19 23:10:43', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(102, 0, 'admin', 175, '2020-02-19 23:10:48', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(103, 0, 'admin', 175, '2020-02-19 23:10:57', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(104, 0, 'admin', 175, '2020-02-19 23:11:07', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(105, 0, 'admin', 175, '2020-02-19 23:11:14', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(106, 0, 'admin', 175, '2020-02-19 23:11:19', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(107, 0, 'admin', 175, '2020-02-19 23:11:21', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(108, 0, 'admin', 175, '2020-02-19 23:11:27', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(109, 0, 'admin', 175, '2020-02-19 23:11:32', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(110, 0, 'admin', 175, '2020-02-19 23:11:34', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(111, 0, 'admin', 175, '2020-02-19 23:11:36', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(112, 0, 'admin', 175, '2020-02-19 23:12:14', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(113, 0, 'admin', 175, '2020-02-19 23:12:16', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(114, 0, 'admin', 175, '2020-02-19 23:12:18', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(115, 0, 'admin', 175, '2020-02-19 23:12:23', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(116, 0, 'admin', 175, '2020-02-19 23:12:26', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(117, 0, 'admin', 175, '2020-02-19 23:13:37', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(118, 0, 'admin', 175, '2020-02-19 23:15:11', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(119, 0, 'admin', 175, '2020-02-19 23:15:38', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(120, 0, 'admin', 175, '2020-02-19 23:16:15', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(121, 0, 'admin', 175, '2020-02-19 23:16:22', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(122, 0, 'admin', 175, '2020-02-19 23:16:27', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(123, 0, 'admin', 175, '2020-02-19 23:17:33', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(124, 0, 'admin', 175, '2020-02-19 23:26:04', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(125, 0, 'admin', 175, '2020-02-19 23:26:10', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(126, 0, 'admin', 175, '2020-02-19 23:26:14', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(127, 0, 'admin', 175, '2020-02-19 23:26:17', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(128, 0, 'admin', 175, '2020-02-19 23:26:24', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(129, 0, 'admin', 175, '2020-02-19 23:26:27', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(130, 0, 'user', 175, '2020-02-20 11:37:18', 'User #175opened [ type => user] , [ module => login] , [ mode => login] , [ id => 175] , ', '[ G_do => login] , [ P_username => Ahmed85@gmail.com] , [ P_password => 12345678] , ', 1),
(131, 0, 'admin', 175, '2020-02-20 11:37:21', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(132, 0, 'admin', 175, '2020-02-20 11:37:39', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(133, 0, 'admin', 175, '2020-02-20 11:46:36', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(134, 0, 'admin', 175, '2020-02-20 11:46:42', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(135, 0, 'admin', 175, '2020-02-20 11:47:19', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(136, 0, 'admin', 175, '2020-02-20 11:47:21', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(137, 0, 'admin', 175, '2020-02-20 11:47:27', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(138, 0, 'admin', 175, '2020-02-20 11:47:42', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(139, 0, 'admin', 175, '2020-02-20 12:08:49', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(140, 0, 'admin', 175, '2020-02-20 12:08:52', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(141, 0, 'admin', 175, '2020-02-20 12:17:49', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(142, 0, 'admin', 175, '2020-02-20 12:17:53', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(143, 0, 'admin', 175, '2020-02-20 12:18:18', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(144, 0, 'admin', 175, '2020-02-20 12:20:49', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(145, 0, 'admin', 175, '2020-02-20 13:01:24', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(146, 0, 'admin', 175, '2020-02-20 13:01:33', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '', 1),
(147, 0, 'admin', 175, '2020-02-20 13:01:40', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(148, 0, 'admin', 175, '2020-02-20 13:01:43', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '', 1),
(149, 0, 'admin', 175, '2020-02-20 13:01:53', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '', 1),
(150, 0, 'admin', 175, '2020-02-20 13:02:00', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '', 1),
(151, 0, 'admin', 175, '2020-02-20 13:02:22', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '', 1),
(152, 0, 'admin', 175, '2020-02-20 13:02:25', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 2] , ', 1),
(153, 0, 'admin', 175, '2020-02-20 13:02:27', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(154, 0, 'admin', 175, '2020-02-20 13:03:37', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(155, 0, 'admin', 175, '2020-02-20 13:07:19', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(156, 0, 'admin', 175, '2020-02-20 13:08:07', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(157, 0, 'admin', 175, '2020-02-20 13:09:29', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(158, 0, 'admin', 175, '2020-02-20 13:09:56', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(159, 0, 'admin', 175, '2020-02-20 13:09:59', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(160, 0, 'user', 175, '2020-02-20 13:10:05', 'User #175opened [ type => user] , [ module => supplliers] , [ mode => delete] , [ total => 6] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 6] , [ P_permission => contacts_delete] , [ P_table => supplliers] , ', 1),
(161, 0, 'admin', 175, '2020-02-20 13:10:23', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(162, 0, 'user', 175, '2020-02-20 13:10:29', 'User #175opened [ type => user] , [ module => supplliers] , [ mode => delete] , [ total => 6] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 6] , [ P_permission => contacts_delete] , [ P_table => supplliers] , ', 1),
(163, 0, 'admin', 175, '2020-02-20 13:10:30', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(164, 0, 'admin', 175, '2020-02-20 13:11:22', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(165, 0, 'user', 175, '2020-02-20 13:11:29', 'User #175opened [ type => user] , [ module => supplliers] , [ mode => delete] , [ total => 6] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 6] , [ P_permission => contacts_delete] , [ P_table => supplliers] , ', 1),
(166, 0, 'admin', 175, '2020-02-20 13:12:47', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(167, 0, 'user', 175, '2020-02-20 13:12:51', 'User #175opened [ type => user] , [ module => supplliers] , [ mode => delete] , [ total => 6] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 6] , [ P_permission => contacts_delete] , [ P_table => supplliers] , ', 1),
(168, 0, 'admin', 175, '2020-02-20 13:14:54', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(169, 0, 'admin', 175, '2020-02-20 13:16:14', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(170, 0, 'admin', 175, '2020-02-20 13:16:17', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(171, 0, 'admin', 175, '2020-02-20 13:16:19', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(172, 0, 'admin', 175, '2020-02-20 13:16:20', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 6] , [ id => 175] , ', '', 1),
(173, 0, 'user', 175, '2020-02-20 13:16:25', 'User #175opened [ type => user] , [ module => suppliers] , [ mode => delete] , [ total => 6] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 6] , [ P_permission => contacts_delete] , [ P_table => suppliers] , ', 1),
(174, 0, 'admin', 175, '2020-02-20 13:16:45', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(175, 0, 'user', 175, '2020-02-20 13:16:52', 'User #175opened [ type => user] , [ module => suppliers] , [ mode => delete] , [ total => 5] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 5] , [ P_permission => contacts_delete] , [ P_table => suppliers] , ', 1),
(176, 0, 'admin', 175, '2020-02-20 13:17:59', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 4] , [ id => 175] , ', '', 1),
(177, 0, 'admin', 175, '2020-02-20 13:18:01', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 4] , [ id => 175] , ', '', 1),
(178, 0, 'admin', 175, '2020-02-20 13:51:32', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(179, 0, 'admin', 175, '2020-02-20 13:51:55', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(180, 0, 'admin', 175, '2020-02-20 14:04:06', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(181, 0, 'admin', 175, '2020-02-20 14:04:09', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '', 1),
(182, 0, 'admin', 175, '2020-02-20 14:04:15', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '[ G_page => 2] , ', 1),
(183, 0, 'admin', 175, '2020-02-20 14:04:18', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '[ G_page => 3] , ', 1),
(184, 0, 'admin', 175, '2020-02-20 14:04:21', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '[ G_page => 4] , ', 1),
(185, 0, 'admin', 175, '2020-02-20 14:04:28', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(186, 0, 'admin', 175, '2020-02-20 14:04:55', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '[ G_page => 2] , ', 1),
(187, 0, 'admin', 175, '2020-02-20 14:05:02', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 19] , [ id => 175] , ', '[ G_page => 3] , ', 1),
(188, 0, 'admin', 175, '2020-02-20 14:06:24', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 20] , [ id => 175] , ', '', 1),
(189, 0, 'admin', 175, '2020-02-20 14:06:48', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 20] , [ id => 175] , ', '', 1),
(190, 0, 'admin', 175, '2020-02-20 14:10:05', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(191, 0, 'admin', 175, '2020-02-20 14:10:22', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 22] , [ id => 175] , ', '', 1),
(192, 0, 'admin', 175, '2020-02-20 14:10:29', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(193, 0, 'admin', 175, '2020-02-20 14:12:23', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(194, 0, 'admin', 175, '2020-02-20 14:12:51', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(195, 0, 'admin', 175, '2020-02-20 14:12:52', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(196, 0, 'admin', 175, '2020-02-20 14:13:42', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(197, 0, 'admin', 175, '2020-02-20 14:13:43', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(198, 0, 'admin', 175, '2020-02-20 14:36:06', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(199, 0, 'admin', 175, '2020-02-20 14:36:17', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(200, 0, 'admin', 175, '2020-02-20 14:37:45', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(201, 0, 'admin', 175, '2020-02-20 14:38:17', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(202, 0, 'admin', 175, '2020-02-20 14:38:38', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(203, 0, 'admin', 175, '2020-02-20 15:04:29', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(204, 0, 'admin', 175, '2020-02-20 15:04:46', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '[ G_message => update] , ', 1),
(205, 0, 'admin', 175, '2020-02-20 15:04:49', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(206, 0, 'admin', 175, '2020-02-20 15:04:51', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(207, 0, 'admin', 175, '2020-02-20 15:04:53', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(208, 0, 'admin', 175, '2020-02-20 15:04:55', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(209, 0, 'admin', 175, '2020-02-20 15:05:26', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(210, 0, 'admin', 175, '2020-02-20 15:07:46', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 5] , [ id => 175] , ', '', 1),
(211, 0, 'admin', 175, '2020-02-20 15:23:10', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '', 1),
(212, 0, 'user', 175, '2020-02-20 15:23:19', 'User #175opened [ type => user] , [ module => users] , [ mode => delete] , [ total => 187] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 187] , [ P_permission => contacts_delete] , [ P_table => users] , ', 1),
(213, 0, 'user', 175, '2020-02-20 22:59:48', 'User #175opened [ type => user] , [ module => login] , [ mode => login] , [ id => 175] , ', '[ G_do => login] , [ P_username => Ahmed85@gmail.com] , [ P_password => 12345678] , ', 1),
(214, 4, 'user', 175, '2020-02-20 22:59:54', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(215, 0, 'admin', 175, '2020-02-20 23:00:02', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '', 1),
(216, 0, 'admin', 175, '2020-02-20 23:00:07', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '[ G_page => 2] , ', 1),
(217, 0, 'admin', 175, '2020-02-20 23:00:12', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '[ G_page => 1] , ', 1),
(218, 0, 'admin', 175, '2020-02-20 23:00:17', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(219, 0, 'admin', 175, '2020-02-20 23:00:21', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(220, 0, 'admin', 175, '2020-02-20 23:00:23', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(221, 0, 'admin', 175, '2020-02-20 23:00:26', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '', 1),
(222, 4, 'user', 175, '2020-02-20 23:00:28', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(223, 0, 'admin', 175, '2020-02-20 23:10:59', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '', 1),
(224, 0, 'admin', 175, '2020-02-20 23:11:04', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(225, 0, 'user', 175, '2020-02-25 13:25:39', 'User #175opened [ type => user] , [ module => login] , [ mode => login] , [ id => 175] , ', '[ G_do => login] , [ P_username => Ahmed85@gmail.com] , [ P_password => 12345678] , ', 1),
(226, 0, 'admin', 175, '2020-02-25 13:26:30', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 9] , [ id => 175] , ', '', 1),
(227, 0, 'user', 175, '2020-02-25 13:26:38', 'User #175opened [ type => user] , [ module => users] , [ mode => delete] , [ total => 191] , [ id => 175] , ', '[ G_do => delete_data] , [ P_id => 191] , [ P_permission => contacts_delete] , [ P_table => users] , ', 1),
(228, 0, 'admin', 175, '2020-02-25 13:26:41', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(229, 0, 'admin', 175, '2020-02-25 13:26:43', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(230, 0, 'admin', 175, '2020-02-25 13:26:46', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(231, 0, 'admin', 175, '2020-02-25 13:26:51', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(232, 0, 'admin', 175, '2020-02-25 13:26:55', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(233, 0, 'admin', 175, '2020-02-25 13:26:57', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(234, 0, 'admin', 175, '2020-02-25 13:27:00', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 8] , [ id => 175] , ', '', 1),
(235, 0, 'admin', 175, '2020-02-25 13:34:28', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 8] , [ id => 175] , ', '', 1),
(236, 0, 'admin', 175, '2020-02-25 13:34:30', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(237, 0, 'admin', 175, '2020-02-25 13:34:35', 'Admin #175opened [ type => admin] , [ module => suppliers] , [ mode => list] , [ total => 23] , [ id => 175] , ', '', 1),
(238, 0, 'admin', 175, '2020-02-25 14:11:19', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 8] , [ id => 175] , ', '', 1),
(239, 0, 'admin', 175, '2020-02-25 14:11:23', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 8] , [ id => 175] , ', '', 1),
(240, 0, 'admin', 175, '2020-02-25 14:16:12', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(241, 0, 'admin', 175, '2020-02-25 14:26:15', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 8] , [ id => 175] , ', '', 1),
(242, 0, 'admin', 175, '2020-02-25 14:38:11', 'Admin #175opened [ type => admin] , [ module => permission] , [ mode => view] , [ id => 175] , ', '', 1),
(243, 0, 'admin', 175, '2020-02-25 14:40:48', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(244, 0, 'admin', 175, '2020-02-25 14:40:57', 'Admin #175opened [ type => admin] , [ module => groups] , [ mode => list] , [ total => 1] , [ id => 175] , ', '', 1),
(245, 0, 'admin', 175, '2020-02-25 14:41:41', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(246, 0, 'admin', 175, '2020-02-25 14:45:42', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(247, 0, 'admin', 175, '2020-02-25 14:45:53', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(248, 0, 'admin', 175, '2020-02-25 14:47:00', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(249, 0, 'admin', 175, '2020-02-25 14:48:30', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(250, 0, 'admin', 175, '2020-02-25 14:48:36', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(251, 0, 'admin', 175, '2020-02-25 14:49:54', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(252, 0, 'admin', 175, '2020-02-25 14:49:56', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(253, 0, 'admin', 175, '2020-02-25 14:51:52', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(254, 0, 'admin', 175, '2020-02-25 15:02:49', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(255, 0, 'admin', 175, '2020-02-25 15:04:35', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(256, 0, 'admin', 175, '2020-02-25 15:04:47', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(257, 0, 'admin', 175, '2020-02-25 15:05:49', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(258, 0, 'admin', 175, '2020-02-25 15:06:00', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(259, 0, 'admin', 175, '2020-02-25 15:06:55', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(260, 0, 'admin', 175, '2020-02-25 15:07:37', 'Admin #175opened [ type => admin] , [ module => users] , [ mode => list] , [ total => 8] , [ id => 175] , ', '', 1),
(261, 4, 'user', 175, '2020-02-25 15:07:40', 'User #175opened [ type => user] , [ module => system_information] , [ mode => view] , [ id => 175] , ', '', 1),
(262, 0, 'admin', 175, '2020-02-25 15:15:36', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(263, 0, 'admin', 175, '2020-02-25 15:15:38', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(264, 0, 'admin', 175, '2020-02-25 15:20:42', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(265, 0, 'admin', 175, '2020-02-25 15:21:37', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(266, 0, 'admin', 175, '2020-02-25 15:22:05', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(267, 0, 'admin', 175, '2020-02-25 15:22:48', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(268, 0, 'admin', 175, '2020-02-25 15:22:58', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(269, 0, 'admin', 175, '2020-02-25 15:29:51', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(270, 0, 'admin', 175, '2020-02-25 15:39:25', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(271, 0, 'admin', 175, '2020-02-25 15:39:46', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(272, 0, 'admin', 175, '2020-02-25 15:48:48', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(273, 0, 'admin', 175, '2020-02-25 15:56:47', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(274, 0, 'user', 175, '2020-02-25 15:56:52', 'User #175opened [ type => user] , [ module => expenses] , [ mode => update] , [ total => 4] , [ id => 175] , ', '[ G_do => edit_expenses] , [ P_name => مصروف 4] , [ P_id => 4] , ', 1),
(275, 0, 'admin', 175, '2020-02-25 15:56:52', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(276, 0, 'admin', 175, '2020-02-25 15:56:52', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(277, 0, 'user', 175, '2020-02-25 15:57:00', 'User #175opened [ type => user] , [ module => expenses] , [ mode => update] , [ total => 4] , [ id => 175] , ', '[ G_do => edit_expenses] , [ P_name => مصروف] , [ P_id => 4] , ', 1),
(278, 0, 'admin', 175, '2020-02-25 15:57:00', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(279, 0, 'admin', 175, '2020-02-25 15:57:00', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(280, 0, 'user', 175, '2020-02-25 15:57:09', 'User #175opened [ type => user] , [ module => expenses] , [ mode => update] , [ total => 4] , [ id => 175] , ', '[ G_do => edit_expenses] , [ P_name => مصروف 2] , [ P_id => 4] , ', 1),
(281, 0, 'admin', 175, '2020-02-25 15:57:09', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(282, 0, 'admin', 175, '2020-02-25 15:57:09', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(283, 0, 'user', 175, '2020-02-25 15:57:22', 'User #175opened [ type => user] , [ module => expenses] , [ mode => update] , [ total => 4] , [ id => 175] , ', '[ G_do => edit_expenses] , [ P_name => مصروف 4] , [ P_id => 4] , ', 1),
(284, 0, 'admin', 175, '2020-02-25 15:57:22', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(285, 0, 'admin', 175, '2020-02-25 15:57:22', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(286, 0, 'admin', 175, '2020-02-25 15:58:22', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(287, 0, 'admin', 175, '2020-02-25 15:58:31', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(288, 0, 'admin', 175, '2020-02-25 15:58:55', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(289, 0, 'admin', 175, '2020-02-25 15:59:02', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(290, 0, 'admin', 175, '2020-02-25 15:59:36', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(291, 0, 'admin', 175, '2020-02-25 15:59:40', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(292, 0, 'admin', 175, '2020-02-25 16:00:12', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(293, 0, 'admin', 175, '2020-02-25 16:00:30', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(294, 0, 'admin', 175, '2020-02-25 16:00:37', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(295, 0, 'admin', 175, '2020-02-25 16:00:47', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1);
INSERT INTO `logs` (`id`, `type`, `who`, `user_id`, `time`, `message`, `data`, `periority`) VALUES
(296, 0, 'admin', 175, '2020-02-25 16:00:54', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(297, 0, 'admin', 175, '2020-02-25 16:01:12', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(298, 0, 'user', 175, '2020-02-25 16:01:15', 'User #175opened [ type => user] , [ module => expenses] , [ mode => update] , [ total => 4] , [ id => 175] , ', '[ G_do => edit_expenses] , [ P_name => مصروف 4] , [ P_id => 4] , ', 1),
(299, 0, 'admin', 175, '2020-02-25 16:01:16', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(300, 0, 'admin', 175, '2020-02-25 16:01:16', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(301, 0, 'admin', 175, '2020-02-25 16:06:34', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(302, 0, 'admin', 175, '2020-02-25 16:07:08', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(303, 0, 'admin', 175, '2020-02-25 16:19:37', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(304, 0, 'admin', 175, '2020-02-25 16:19:46', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(305, 0, 'admin', 175, '2020-02-25 16:19:49', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(306, 0, 'admin', 175, '2020-02-25 16:20:58', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(307, 0, 'user', 175, '2020-02-25 16:21:04', 'User #175opened [ type => user] , [ module => expenses] , [ mode => delete] , [ total => 4] , [ id => 175] , ', '[ G_do => delete_expenses] , [ P_id => 4] , ', 1),
(308, 0, 'admin', 175, '2020-02-25 16:21:04', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(309, 0, 'admin', 175, '2020-02-25 16:21:09', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(310, 0, 'admin', 175, '2020-02-25 16:23:55', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(311, 0, 'admin', 175, '2020-02-25 16:28:28', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(312, 0, 'admin', 175, '2020-02-25 16:29:01', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(313, 0, 'admin', 175, '2020-02-25 16:29:10', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(314, 0, 'admin', 175, '2020-02-25 16:30:40', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(315, 0, 'admin', 175, '2020-02-25 16:30:48', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(316, 0, 'admin', 175, '2020-02-25 16:34:00', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(317, 0, 'user', 175, '2020-02-25 16:34:20', 'User #175opened [ type => user] , [ module => expenses] , [ mode => add] , [ id => 175] , ', '[ G_do => add_expenses] , [ P_name => مصروف 2] , ', 1),
(318, 0, 'admin', 175, '2020-02-25 16:34:20', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(319, 0, 'admin', 175, '2020-02-25 16:35:00', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(320, 0, 'user', 175, '2020-02-25 16:35:05', 'User #175opened [ type => user] , [ module => expenses] , [ mode => delete] , [ total => 5] , [ id => 175] , ', '[ G_do => delete_expenses] , [ P_id => 5] , ', 1),
(321, 0, 'admin', 175, '2020-02-25 16:35:06', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(322, 0, 'admin', 175, '2020-02-25 16:35:14', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(323, 0, 'admin', 175, '2020-02-25 16:35:50', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(324, 0, 'admin', 175, '2020-02-25 16:36:34', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(325, 0, 'admin', 175, '2020-02-25 16:36:39', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(326, 0, 'admin', 175, '2020-02-25 16:36:46', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(327, 0, 'admin', 175, '2020-02-25 16:37:16', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(328, 0, 'admin', 175, '2020-02-25 16:37:23', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(329, 0, 'admin', 175, '2020-02-25 16:37:39', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(330, 0, 'user', 175, '2020-02-25 16:37:44', 'User #175opened [ type => user] , [ module => expenses] , [ mode => add] , [ id => 175] , ', '[ G_do => add_expenses] , [ P_name => مصروف 4] , ', 1),
(331, 0, 'admin', 175, '2020-02-25 16:37:45', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(332, 0, 'admin', 175, '2020-02-25 16:37:52', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(333, 0, 'admin', 175, '2020-02-25 16:38:05', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(334, 0, 'admin', 175, '2020-02-25 16:41:10', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(335, 0, 'admin', 175, '2020-02-25 16:41:37', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1),
(336, 0, 'admin', 175, '2020-02-25 16:41:57', 'Admin #175opened [ type => admin] , [ module => expenses] , [ mode => list] , [ id => 175] , ', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `log_params`
--

CREATE TABLE `log_params` (
  `id` int(11) NOT NULL,
  `log_id` int(11) NOT NULL,
  `position` varchar(50) COLLATE utf8_bin NOT NULL,
  `value` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `log_params`
--

INSERT INTO `log_params` (`id`, `log_id`, `position`, `value`) VALUES
(1, 1, 'type', 'user'),
(2, 1, 'module', 'login'),
(3, 1, 'mode', 'login'),
(4, 1, 'id', '175'),
(5, 2, 'type', 'admin'),
(6, 2, 'module', 'users'),
(7, 2, 'mode', 'list'),
(8, 2, 'total', '5'),
(9, 2, 'id', '175'),
(10, 3, 'type', 'admin'),
(11, 3, 'module', 'suppliers'),
(12, 3, 'mode', 'list'),
(13, 3, 'total', '1'),
(14, 3, 'id', '175'),
(15, 4, 'type', 'admin'),
(16, 4, 'module', 'suppliers'),
(17, 4, 'mode', 'list'),
(18, 4, 'total', '1'),
(19, 4, 'id', '175'),
(20, 5, 'type', 'admin'),
(21, 5, 'module', 'suppliers'),
(22, 5, 'mode', 'list'),
(23, 5, 'total', '1'),
(24, 5, 'id', '175'),
(25, 6, 'type', 'admin'),
(26, 6, 'module', 'suppliers'),
(27, 6, 'mode', 'list'),
(28, 6, 'total', '1'),
(29, 6, 'id', '175'),
(30, 7, 'type', 'admin'),
(31, 7, 'module', 'suppliers'),
(32, 7, 'mode', 'list'),
(33, 7, 'total', '1'),
(34, 7, 'id', '175'),
(35, 8, 'type', 'admin'),
(36, 8, 'module', 'suppliers'),
(37, 8, 'mode', 'list'),
(38, 8, 'total', '1'),
(39, 8, 'id', '175'),
(40, 9, 'type', 'admin'),
(41, 9, 'module', 'suppliers'),
(42, 9, 'mode', 'list'),
(43, 9, 'total', '1'),
(44, 9, 'id', '175'),
(45, 10, 'type', 'admin'),
(46, 10, 'module', 'suppliers'),
(47, 10, 'mode', 'list'),
(48, 10, 'total', '1'),
(49, 10, 'id', '175'),
(50, 11, 'type', 'admin'),
(51, 11, 'module', 'suppliers'),
(52, 11, 'mode', 'list'),
(53, 11, 'total', '1'),
(54, 11, 'id', '175'),
(55, 12, 'type', 'admin'),
(56, 12, 'module', 'suppliers'),
(57, 12, 'mode', 'list'),
(58, 12, 'total', '1'),
(59, 12, 'id', '175'),
(60, 13, 'type', 'admin'),
(61, 13, 'module', 'suppliers'),
(62, 13, 'mode', 'list'),
(63, 13, 'total', '1'),
(64, 13, 'id', '175'),
(65, 14, 'type', 'admin'),
(66, 14, 'module', 'suppliers'),
(67, 14, 'mode', 'list'),
(68, 14, 'total', '1'),
(69, 14, 'id', '175'),
(70, 15, 'type', 'admin'),
(71, 15, 'module', 'suppliers'),
(72, 15, 'mode', 'list'),
(73, 15, 'total', '1'),
(74, 15, 'id', '175'),
(75, 16, 'type', 'admin'),
(76, 16, 'module', 'suppliers'),
(77, 16, 'mode', 'list'),
(78, 16, 'total', '1'),
(79, 16, 'id', '175'),
(80, 17, 'type', 'user'),
(81, 17, 'module', 'system_information'),
(82, 17, 'mode', 'view'),
(83, 17, 'id', '175'),
(84, 18, 'type', 'user'),
(85, 18, 'module', 'system_information'),
(86, 18, 'mode', 'edit_company_information'),
(87, 18, 'id', '175'),
(88, 19, 'type', 'user'),
(89, 19, 'module', 'system_information'),
(90, 19, 'mode', 'view'),
(91, 19, 'id', '175'),
(92, 20, 'type', 'user'),
(93, 20, 'module', 'system_information'),
(94, 20, 'mode', 'edit_company_information'),
(95, 20, 'id', '175'),
(96, 21, 'type', 'admin'),
(97, 21, 'module', 'users'),
(98, 21, 'mode', 'list'),
(99, 21, 'total', '5'),
(100, 21, 'id', '175'),
(101, 22, 'type', 'admin'),
(102, 22, 'module', 'users'),
(103, 22, 'mode', 'list'),
(104, 22, 'total', '5'),
(105, 22, 'id', '175'),
(106, 23, 'type', 'admin'),
(107, 23, 'module', 'suppliers'),
(108, 23, 'mode', 'list'),
(109, 23, 'total', '1'),
(110, 23, 'id', '175'),
(111, 24, 'type', 'admin'),
(112, 24, 'module', 'suppliers'),
(113, 24, 'mode', 'list'),
(114, 24, 'total', '1'),
(115, 24, 'id', '175'),
(116, 25, 'type', 'admin'),
(117, 25, 'module', 'suppliers'),
(118, 25, 'mode', 'list'),
(119, 25, 'total', '1'),
(120, 25, 'id', '175'),
(121, 26, 'type', 'admin'),
(122, 26, 'module', 'groups'),
(123, 26, 'mode', 'list'),
(124, 26, 'total', ''),
(125, 26, 'id', '175'),
(126, 27, 'type', 'admin'),
(127, 27, 'module', 'suppliers'),
(128, 27, 'mode', 'list'),
(129, 27, 'total', '1'),
(130, 27, 'id', '175'),
(131, 28, 'type', 'admin'),
(132, 28, 'module', 'users'),
(133, 28, 'mode', 'list'),
(134, 28, 'total', '5'),
(135, 28, 'id', '175'),
(136, 29, 'type', 'admin'),
(137, 29, 'module', 'users'),
(138, 29, 'mode', 'list'),
(139, 29, 'total', '5'),
(140, 29, 'id', '175'),
(141, 30, 'type', 'admin'),
(142, 30, 'module', 'groups'),
(143, 30, 'mode', 'list'),
(144, 30, 'total', '1'),
(145, 30, 'id', '175'),
(146, 31, 'type', 'admin'),
(147, 31, 'module', 'groups'),
(148, 31, 'mode', 'list'),
(149, 31, 'total', '1'),
(150, 31, 'id', '175'),
(151, 32, 'type', 'admin'),
(152, 32, 'module', 'groups'),
(153, 32, 'mode', 'list'),
(154, 32, 'total', '1'),
(155, 32, 'id', '175'),
(156, 33, 'type', 'admin'),
(157, 33, 'module', 'groups'),
(158, 33, 'mode', 'list'),
(159, 33, 'total', '1'),
(160, 33, 'id', '175'),
(161, 34, 'type', 'admin'),
(162, 34, 'module', 'groups'),
(163, 34, 'mode', 'list'),
(164, 34, 'total', '1'),
(165, 34, 'id', '175'),
(166, 35, 'type', 'admin'),
(167, 35, 'module', 'groups'),
(168, 35, 'mode', 'list'),
(169, 35, 'total', '1'),
(170, 35, 'id', '175'),
(171, 36, 'type', 'admin'),
(172, 36, 'module', 'groups'),
(173, 36, 'mode', 'list'),
(174, 36, 'total', '1'),
(175, 36, 'id', '175'),
(176, 37, 'type', 'admin'),
(177, 37, 'module', 'groups'),
(178, 37, 'mode', 'list'),
(179, 37, 'total', '1'),
(180, 37, 'id', '175'),
(181, 38, 'type', 'admin'),
(182, 38, 'module', 'groups'),
(183, 38, 'mode', 'list'),
(184, 38, 'total', '1'),
(185, 38, 'id', '175'),
(186, 39, 'type', 'admin'),
(187, 39, 'module', 'groups'),
(188, 39, 'mode', 'list'),
(189, 39, 'total', '1'),
(190, 39, 'id', '175'),
(191, 40, 'type', 'admin'),
(192, 40, 'module', 'groups'),
(193, 40, 'mode', 'list'),
(194, 40, 'total', '1'),
(195, 40, 'id', '175'),
(196, 41, 'type', 'admin'),
(197, 41, 'module', 'groups'),
(198, 41, 'mode', 'list'),
(199, 41, 'total', '1'),
(200, 41, 'id', '175'),
(201, 42, 'type', 'user'),
(202, 42, 'module', 'system_information'),
(203, 42, 'mode', 'view'),
(204, 42, 'id', '175'),
(205, 43, 'type', 'admin'),
(206, 43, 'module', 'groups'),
(207, 43, 'mode', 'list'),
(208, 43, 'total', '1'),
(209, 43, 'id', '175'),
(210, 44, 'type', 'admin'),
(211, 44, 'module', 'groups'),
(212, 44, 'mode', 'list'),
(213, 44, 'total', '1'),
(214, 44, 'id', '175'),
(215, 45, 'type', 'admin'),
(216, 45, 'module', 'groups'),
(217, 45, 'mode', 'list'),
(218, 45, 'total', '1'),
(219, 45, 'id', '175'),
(220, 46, 'type', 'admin'),
(221, 46, 'module', 'groups'),
(222, 46, 'mode', 'list'),
(223, 46, 'total', '1'),
(224, 46, 'id', '175'),
(225, 47, 'type', 'user'),
(226, 47, 'module', 'system_information'),
(227, 47, 'mode', 'view'),
(228, 47, 'id', '175'),
(229, 48, 'type', 'admin'),
(230, 48, 'module', 'groups'),
(231, 48, 'mode', 'list'),
(232, 48, 'total', '1'),
(233, 48, 'id', '175'),
(234, 49, 'type', 'admin'),
(235, 49, 'module', 'groups'),
(236, 49, 'mode', 'list'),
(237, 49, 'total', '1'),
(238, 49, 'id', '175'),
(239, 50, 'type', 'admin'),
(240, 50, 'module', 'groups'),
(241, 50, 'mode', 'list'),
(242, 50, 'total', '1'),
(243, 50, 'id', '175'),
(244, 51, 'type', 'admin'),
(245, 51, 'module', 'groups'),
(246, 51, 'mode', 'list'),
(247, 51, 'total', '1'),
(248, 51, 'id', '175'),
(249, 52, 'type', 'admin'),
(250, 52, 'module', 'groups'),
(251, 52, 'mode', 'list'),
(252, 52, 'total', '1'),
(253, 52, 'id', '175'),
(254, 53, 'type', 'admin'),
(255, 53, 'module', 'suppliers'),
(256, 53, 'mode', 'list'),
(257, 53, 'total', '1'),
(258, 53, 'id', '175'),
(259, 54, 'type', 'admin'),
(260, 54, 'module', 'groups'),
(261, 54, 'mode', 'list'),
(262, 54, 'total', '1'),
(263, 54, 'id', '175'),
(264, 55, 'type', 'admin'),
(265, 55, 'module', 'groups'),
(266, 55, 'mode', 'list'),
(267, 55, 'total', '1'),
(268, 55, 'id', '175'),
(269, 56, 'type', 'admin'),
(270, 56, 'module', 'groups'),
(271, 56, 'mode', 'list'),
(272, 56, 'total', '1'),
(273, 56, 'id', '175'),
(274, 57, 'type', 'admin'),
(275, 57, 'module', 'users'),
(276, 57, 'mode', 'list'),
(277, 57, 'total', '5'),
(278, 57, 'id', '175'),
(279, 58, 'type', 'admin'),
(280, 58, 'module', 'groups'),
(281, 58, 'mode', 'list'),
(282, 58, 'total', '1'),
(283, 58, 'id', '175'),
(284, 59, 'type', 'admin'),
(285, 59, 'module', 'suppliers'),
(286, 59, 'mode', 'list'),
(287, 59, 'total', '1'),
(288, 59, 'id', '175'),
(289, 60, 'type', 'admin'),
(290, 60, 'module', 'groups'),
(291, 60, 'mode', 'list'),
(292, 60, 'total', '1'),
(293, 60, 'id', '175'),
(294, 61, 'type', 'admin'),
(295, 61, 'module', 'users'),
(296, 61, 'mode', 'list'),
(297, 61, 'total', '5'),
(298, 61, 'id', '175'),
(299, 62, 'type', 'admin'),
(300, 62, 'module', 'users'),
(301, 62, 'mode', 'list'),
(302, 62, 'total', '5'),
(303, 62, 'id', '175'),
(304, 63, 'type', 'admin'),
(305, 63, 'module', 'users'),
(306, 63, 'mode', 'list'),
(307, 63, 'total', '5'),
(308, 63, 'id', '175'),
(309, 64, 'type', 'admin'),
(310, 64, 'module', 'users'),
(311, 64, 'mode', 'list'),
(312, 64, 'total', '5'),
(313, 64, 'id', '175'),
(314, 65, 'type', 'admin'),
(315, 65, 'module', 'users'),
(316, 65, 'mode', 'list'),
(317, 65, 'total', '5'),
(318, 65, 'id', '175'),
(319, 66, 'type', 'admin'),
(320, 66, 'module', 'users'),
(321, 66, 'mode', 'list'),
(322, 66, 'total', '5'),
(323, 66, 'id', '175'),
(324, 67, 'type', 'admin'),
(325, 67, 'module', 'users'),
(326, 67, 'mode', 'list'),
(327, 67, 'total', '5'),
(328, 67, 'id', '175'),
(329, 68, 'type', 'admin'),
(330, 68, 'module', 'users'),
(331, 68, 'mode', 'list'),
(332, 68, 'total', '5'),
(333, 68, 'id', '175'),
(334, 69, 'type', 'admin'),
(335, 69, 'module', 'groups'),
(336, 69, 'mode', 'list'),
(337, 69, 'total', '1'),
(338, 69, 'id', '175'),
(339, 70, 'type', 'admin'),
(340, 70, 'module', 'groups'),
(341, 70, 'mode', 'list'),
(342, 70, 'total', '1'),
(343, 70, 'id', '175'),
(344, 71, 'type', 'admin'),
(345, 71, 'module', 'groups'),
(346, 71, 'mode', 'list'),
(347, 71, 'total', '1'),
(348, 71, 'id', '175'),
(349, 72, 'type', 'admin'),
(350, 72, 'module', 'groups'),
(351, 72, 'mode', 'list'),
(352, 72, 'total', '1'),
(353, 72, 'id', '175'),
(354, 73, 'type', 'admin'),
(355, 73, 'module', 'groups'),
(356, 73, 'mode', 'list'),
(357, 73, 'total', '1'),
(358, 73, 'id', '175'),
(359, 74, 'type', 'admin'),
(360, 74, 'module', 'groups'),
(361, 74, 'mode', 'list'),
(362, 74, 'total', '1'),
(363, 74, 'id', '175'),
(364, 75, 'type', 'admin'),
(365, 75, 'module', 'groups'),
(366, 75, 'mode', 'list'),
(367, 75, 'total', '1'),
(368, 75, 'id', '175'),
(369, 76, 'type', 'admin'),
(370, 76, 'module', 'groups'),
(371, 76, 'mode', 'list'),
(372, 76, 'total', '1'),
(373, 76, 'id', '175'),
(374, 77, 'type', 'admin'),
(375, 77, 'module', 'users'),
(376, 77, 'mode', 'list'),
(377, 77, 'total', '5'),
(378, 77, 'id', '175'),
(379, 78, 'type', 'user'),
(380, 78, 'module', 'system_information'),
(381, 78, 'mode', 'view'),
(382, 78, 'id', '175'),
(383, 79, 'type', 'user'),
(384, 79, 'module', 'system_information'),
(385, 79, 'mode', 'view'),
(386, 79, 'id', '175'),
(387, 80, 'type', 'user'),
(388, 80, 'module', 'system_information'),
(389, 80, 'mode', 'view'),
(390, 80, 'id', '175'),
(391, 81, 'type', 'user'),
(392, 81, 'module', 'system_information'),
(393, 81, 'mode', 'view'),
(394, 81, 'id', '175'),
(395, 82, 'type', 'user'),
(396, 82, 'module', 'system_information'),
(397, 82, 'mode', 'view'),
(398, 82, 'id', '175'),
(399, 83, 'type', 'admin'),
(400, 83, 'module', 'users'),
(401, 83, 'mode', 'list'),
(402, 83, 'total', '5'),
(403, 83, 'id', '175'),
(404, 84, 'type', 'admin'),
(405, 84, 'module', 'users'),
(406, 84, 'mode', 'list'),
(407, 84, 'total', '5'),
(408, 84, 'id', '175'),
(409, 85, 'type', 'admin'),
(410, 85, 'module', 'users'),
(411, 85, 'mode', 'list'),
(412, 85, 'total', '5'),
(413, 85, 'id', '175'),
(414, 86, 'type', 'admin'),
(415, 86, 'module', 'users'),
(416, 86, 'mode', 'list'),
(417, 86, 'total', '5'),
(418, 86, 'id', '175'),
(419, 87, 'type', 'admin'),
(420, 87, 'module', 'suppliers'),
(421, 87, 'mode', 'list'),
(422, 87, 'total', '1'),
(423, 87, 'id', '175'),
(424, 88, 'type', 'admin'),
(425, 88, 'module', 'groups'),
(426, 88, 'mode', 'list'),
(427, 88, 'total', '1'),
(428, 88, 'id', '175'),
(429, 89, 'type', 'admin'),
(430, 89, 'module', 'groups'),
(431, 89, 'mode', 'list'),
(432, 89, 'total', '1'),
(433, 89, 'id', '175'),
(434, 90, 'type', 'admin'),
(435, 90, 'module', 'groups'),
(436, 90, 'mode', 'list'),
(437, 90, 'total', '1'),
(438, 90, 'id', '175'),
(439, 91, 'type', 'admin'),
(440, 91, 'module', 'groups'),
(441, 91, 'mode', 'list'),
(442, 91, 'total', '1'),
(443, 91, 'id', '175'),
(444, 92, 'type', 'admin'),
(445, 92, 'module', 'groups'),
(446, 92, 'mode', 'list'),
(447, 92, 'total', '1'),
(448, 92, 'id', '175'),
(449, 93, 'type', 'admin'),
(450, 93, 'module', 'groups'),
(451, 93, 'mode', 'list'),
(452, 93, 'total', '1'),
(453, 93, 'id', '175'),
(454, 94, 'type', 'admin'),
(455, 94, 'module', 'users'),
(456, 94, 'mode', 'list'),
(457, 94, 'total', '5'),
(458, 94, 'id', '175'),
(459, 95, 'type', 'user'),
(460, 95, 'module', 'login'),
(461, 95, 'mode', 'login'),
(462, 95, 'id', '175'),
(463, 96, 'type', 'admin'),
(464, 96, 'module', 'users'),
(465, 96, 'mode', 'list'),
(466, 96, 'total', '5'),
(467, 96, 'id', '175'),
(468, 97, 'type', 'admin'),
(469, 97, 'module', 'suppliers'),
(470, 97, 'mode', 'list'),
(471, 97, 'total', '1'),
(472, 97, 'id', '175'),
(473, 98, 'type', 'admin'),
(474, 98, 'module', 'groups'),
(475, 98, 'mode', 'list'),
(476, 98, 'total', '1'),
(477, 98, 'id', '175'),
(478, 99, 'type', 'admin'),
(479, 99, 'module', 'users'),
(480, 99, 'mode', 'list'),
(481, 99, 'total', '5'),
(482, 99, 'id', '175'),
(483, 100, 'type', 'admin'),
(484, 100, 'module', 'groups'),
(485, 100, 'mode', 'list'),
(486, 100, 'total', '1'),
(487, 100, 'id', '175'),
(488, 101, 'type', 'admin'),
(489, 101, 'module', 'users'),
(490, 101, 'mode', 'list'),
(491, 101, 'total', '5'),
(492, 101, 'id', '175'),
(493, 102, 'type', 'admin'),
(494, 102, 'module', 'suppliers'),
(495, 102, 'mode', 'list'),
(496, 102, 'total', '1'),
(497, 102, 'id', '175'),
(498, 103, 'type', 'admin'),
(499, 103, 'module', 'suppliers'),
(500, 103, 'mode', 'list'),
(501, 103, 'total', '1'),
(502, 103, 'id', '175'),
(503, 104, 'type', 'admin'),
(504, 104, 'module', 'suppliers'),
(505, 104, 'mode', 'list'),
(506, 104, 'total', '1'),
(507, 104, 'id', '175'),
(508, 105, 'type', 'admin'),
(509, 105, 'module', 'suppliers'),
(510, 105, 'mode', 'list'),
(511, 105, 'total', '1'),
(512, 105, 'id', '175'),
(513, 106, 'type', 'admin'),
(514, 106, 'module', 'users'),
(515, 106, 'mode', 'list'),
(516, 106, 'total', '5'),
(517, 106, 'id', '175'),
(518, 107, 'type', 'admin'),
(519, 107, 'module', 'users'),
(520, 107, 'mode', 'list'),
(521, 107, 'total', '5'),
(522, 107, 'id', '175'),
(523, 108, 'type', 'admin'),
(524, 108, 'module', 'suppliers'),
(525, 108, 'mode', 'list'),
(526, 108, 'total', '1'),
(527, 108, 'id', '175'),
(528, 109, 'type', 'admin'),
(529, 109, 'module', 'suppliers'),
(530, 109, 'mode', 'list'),
(531, 109, 'total', '1'),
(532, 109, 'id', '175'),
(533, 110, 'type', 'admin'),
(534, 110, 'module', 'groups'),
(535, 110, 'mode', 'list'),
(536, 110, 'total', '1'),
(537, 110, 'id', '175'),
(538, 111, 'type', 'admin'),
(539, 111, 'module', 'users'),
(540, 111, 'mode', 'list'),
(541, 111, 'total', '5'),
(542, 111, 'id', '175'),
(543, 112, 'type', 'admin'),
(544, 112, 'module', 'users'),
(545, 112, 'mode', 'list'),
(546, 112, 'total', '5'),
(547, 112, 'id', '175'),
(548, 113, 'type', 'admin'),
(549, 113, 'module', 'suppliers'),
(550, 113, 'mode', 'list'),
(551, 113, 'total', '1'),
(552, 113, 'id', '175'),
(553, 114, 'type', 'admin'),
(554, 114, 'module', 'groups'),
(555, 114, 'mode', 'list'),
(556, 114, 'total', '1'),
(557, 114, 'id', '175'),
(558, 115, 'type', 'admin'),
(559, 115, 'module', 'users'),
(560, 115, 'mode', 'list'),
(561, 115, 'total', '5'),
(562, 115, 'id', '175'),
(563, 116, 'type', 'admin'),
(564, 116, 'module', 'users'),
(565, 116, 'mode', 'list'),
(566, 116, 'total', '5'),
(567, 116, 'id', '175'),
(568, 117, 'type', 'admin'),
(569, 117, 'module', 'users'),
(570, 117, 'mode', 'list'),
(571, 117, 'total', '5'),
(572, 117, 'id', '175'),
(573, 118, 'type', 'admin'),
(574, 118, 'module', 'users'),
(575, 118, 'mode', 'list'),
(576, 118, 'total', '5'),
(577, 118, 'id', '175'),
(578, 119, 'type', 'admin'),
(579, 119, 'module', 'users'),
(580, 119, 'mode', 'list'),
(581, 119, 'total', '5'),
(582, 119, 'id', '175'),
(583, 120, 'type', 'admin'),
(584, 120, 'module', 'groups'),
(585, 120, 'mode', 'list'),
(586, 120, 'total', '1'),
(587, 120, 'id', '175'),
(588, 121, 'type', 'admin'),
(589, 121, 'module', 'suppliers'),
(590, 121, 'mode', 'list'),
(591, 121, 'total', '1'),
(592, 121, 'id', '175'),
(593, 122, 'type', 'admin'),
(594, 122, 'module', 'suppliers'),
(595, 122, 'mode', 'list'),
(596, 122, 'total', '1'),
(597, 122, 'id', '175'),
(598, 123, 'type', 'admin'),
(599, 123, 'module', 'suppliers'),
(600, 123, 'mode', 'list'),
(601, 123, 'total', '1'),
(602, 123, 'id', '175'),
(603, 124, 'type', 'admin'),
(604, 124, 'module', 'suppliers'),
(605, 124, 'mode', 'list'),
(606, 124, 'total', '1'),
(607, 124, 'id', '175'),
(608, 125, 'type', 'admin'),
(609, 125, 'module', 'users'),
(610, 125, 'mode', 'list'),
(611, 125, 'total', '5'),
(612, 125, 'id', '175'),
(613, 126, 'type', 'admin'),
(614, 126, 'module', 'groups'),
(615, 126, 'mode', 'list'),
(616, 126, 'total', '1'),
(617, 126, 'id', '175'),
(618, 127, 'type', 'admin'),
(619, 127, 'module', 'suppliers'),
(620, 127, 'mode', 'list'),
(621, 127, 'total', '1'),
(622, 127, 'id', '175'),
(623, 128, 'type', 'admin'),
(624, 128, 'module', 'groups'),
(625, 128, 'mode', 'list'),
(626, 128, 'total', '1'),
(627, 128, 'id', '175'),
(628, 129, 'type', 'admin'),
(629, 129, 'module', 'users'),
(630, 129, 'mode', 'list'),
(631, 129, 'total', '5'),
(632, 129, 'id', '175'),
(633, 130, 'type', 'user'),
(634, 130, 'module', 'login'),
(635, 130, 'mode', 'login'),
(636, 130, 'id', '175'),
(637, 131, 'type', 'admin'),
(638, 131, 'module', 'users'),
(639, 131, 'mode', 'list'),
(640, 131, 'total', '5'),
(641, 131, 'id', '175'),
(642, 132, 'type', 'admin'),
(643, 132, 'module', 'suppliers'),
(644, 132, 'mode', 'list'),
(645, 132, 'total', '1'),
(646, 132, 'id', '175'),
(647, 133, 'type', 'admin'),
(648, 133, 'module', 'suppliers'),
(649, 133, 'mode', 'list'),
(650, 133, 'total', '1'),
(651, 133, 'id', '175'),
(652, 134, 'type', 'admin'),
(653, 134, 'module', 'suppliers'),
(654, 134, 'mode', 'list'),
(655, 134, 'total', '1'),
(656, 134, 'id', '175'),
(657, 135, 'type', 'admin'),
(658, 135, 'module', 'suppliers'),
(659, 135, 'mode', 'list'),
(660, 135, 'total', '1'),
(661, 135, 'id', '175'),
(662, 136, 'type', 'admin'),
(663, 136, 'module', 'suppliers'),
(664, 136, 'mode', 'list'),
(665, 136, 'total', '1'),
(666, 136, 'id', '175'),
(667, 137, 'type', 'admin'),
(668, 137, 'module', 'suppliers'),
(669, 137, 'mode', 'list'),
(670, 137, 'total', '1'),
(671, 137, 'id', '175'),
(672, 138, 'type', 'admin'),
(673, 138, 'module', 'suppliers'),
(674, 138, 'mode', 'list'),
(675, 138, 'total', '1'),
(676, 138, 'id', '175'),
(677, 139, 'type', 'admin'),
(678, 139, 'module', 'users'),
(679, 139, 'mode', 'list'),
(680, 139, 'total', '5'),
(681, 139, 'id', '175'),
(682, 140, 'type', 'admin'),
(683, 140, 'module', 'suppliers'),
(684, 140, 'mode', 'list'),
(685, 140, 'total', '1'),
(686, 140, 'id', '175'),
(687, 141, 'type', 'admin'),
(688, 141, 'module', 'users'),
(689, 141, 'mode', 'list'),
(690, 141, 'total', '5'),
(691, 141, 'id', '175'),
(692, 142, 'type', 'admin'),
(693, 142, 'module', 'groups'),
(694, 142, 'mode', 'list'),
(695, 142, 'total', '1'),
(696, 142, 'id', '175'),
(697, 143, 'type', 'admin'),
(698, 143, 'module', 'groups'),
(699, 143, 'mode', 'list'),
(700, 143, 'total', '1'),
(701, 143, 'id', '175'),
(702, 144, 'type', 'admin'),
(703, 144, 'module', 'suppliers'),
(704, 144, 'mode', 'list'),
(705, 144, 'total', '1'),
(706, 144, 'id', '175'),
(707, 145, 'type', 'admin'),
(708, 145, 'module', 'users'),
(709, 145, 'mode', 'list'),
(710, 145, 'total', '5'),
(711, 145, 'id', '175'),
(712, 146, 'type', 'admin'),
(713, 146, 'module', 'suppliers'),
(714, 146, 'mode', 'list'),
(715, 146, 'total', '6'),
(716, 146, 'id', '175'),
(717, 147, 'type', 'admin'),
(718, 147, 'module', 'groups'),
(719, 147, 'mode', 'list'),
(720, 147, 'total', '1'),
(721, 147, 'id', '175'),
(722, 148, 'type', 'admin'),
(723, 148, 'module', 'suppliers'),
(724, 148, 'mode', 'list'),
(725, 148, 'total', '6'),
(726, 148, 'id', '175'),
(727, 149, 'type', 'admin'),
(728, 149, 'module', 'suppliers'),
(729, 149, 'mode', 'list'),
(730, 149, 'total', '6'),
(731, 149, 'id', '175'),
(732, 150, 'type', 'admin'),
(733, 150, 'module', 'suppliers'),
(734, 150, 'mode', 'list'),
(735, 150, 'total', '6'),
(736, 150, 'id', '175'),
(737, 151, 'type', 'admin'),
(738, 151, 'module', 'suppliers'),
(739, 151, 'mode', 'list'),
(740, 151, 'total', '6'),
(741, 151, 'id', '175'),
(742, 152, 'type', 'admin'),
(743, 152, 'module', 'suppliers'),
(744, 152, 'mode', 'list'),
(745, 152, 'total', '6'),
(746, 152, 'id', '175'),
(747, 153, 'type', 'admin'),
(748, 153, 'module', 'suppliers'),
(749, 153, 'mode', 'list'),
(750, 153, 'total', '6'),
(751, 153, 'id', '175'),
(752, 154, 'type', 'admin'),
(753, 154, 'module', 'suppliers'),
(754, 154, 'mode', 'list'),
(755, 154, 'total', '6'),
(756, 154, 'id', '175'),
(757, 155, 'type', 'admin'),
(758, 155, 'module', 'suppliers'),
(759, 155, 'mode', 'list'),
(760, 155, 'total', '6'),
(761, 155, 'id', '175'),
(762, 156, 'type', 'admin'),
(763, 156, 'module', 'suppliers'),
(764, 156, 'mode', 'list'),
(765, 156, 'total', '6'),
(766, 156, 'id', '175'),
(767, 157, 'type', 'admin'),
(768, 157, 'module', 'suppliers'),
(769, 157, 'mode', 'list'),
(770, 157, 'total', '6'),
(771, 157, 'id', '175'),
(772, 158, 'type', 'admin'),
(773, 158, 'module', 'suppliers'),
(774, 158, 'mode', 'list'),
(775, 158, 'total', '6'),
(776, 158, 'id', '175'),
(777, 159, 'type', 'admin'),
(778, 159, 'module', 'suppliers'),
(779, 159, 'mode', 'list'),
(780, 159, 'total', '6'),
(781, 159, 'id', '175'),
(782, 160, 'type', 'user'),
(783, 160, 'module', 'supplliers'),
(784, 160, 'mode', 'delete'),
(785, 160, 'total', '6'),
(786, 160, 'id', '175'),
(787, 161, 'type', 'admin'),
(788, 161, 'module', 'suppliers'),
(789, 161, 'mode', 'list'),
(790, 161, 'total', '6'),
(791, 161, 'id', '175'),
(792, 162, 'type', 'user'),
(793, 162, 'module', 'supplliers'),
(794, 162, 'mode', 'delete'),
(795, 162, 'total', '6'),
(796, 162, 'id', '175'),
(797, 163, 'type', 'admin'),
(798, 163, 'module', 'suppliers'),
(799, 163, 'mode', 'list'),
(800, 163, 'total', '6'),
(801, 163, 'id', '175'),
(802, 164, 'type', 'admin'),
(803, 164, 'module', 'suppliers'),
(804, 164, 'mode', 'list'),
(805, 164, 'total', '6'),
(806, 164, 'id', '175'),
(807, 165, 'type', 'user'),
(808, 165, 'module', 'supplliers'),
(809, 165, 'mode', 'delete'),
(810, 165, 'total', '6'),
(811, 165, 'id', '175'),
(812, 166, 'type', 'admin'),
(813, 166, 'module', 'suppliers'),
(814, 166, 'mode', 'list'),
(815, 166, 'total', '6'),
(816, 166, 'id', '175'),
(817, 167, 'type', 'user'),
(818, 167, 'module', 'supplliers'),
(819, 167, 'mode', 'delete'),
(820, 167, 'total', '6'),
(821, 167, 'id', '175'),
(822, 168, 'type', 'admin'),
(823, 168, 'module', 'suppliers'),
(824, 168, 'mode', 'list'),
(825, 168, 'total', '6'),
(826, 168, 'id', '175'),
(827, 169, 'type', 'admin'),
(828, 169, 'module', 'suppliers'),
(829, 169, 'mode', 'list'),
(830, 169, 'total', '6'),
(831, 169, 'id', '175'),
(832, 170, 'type', 'admin'),
(833, 170, 'module', 'groups'),
(834, 170, 'mode', 'list'),
(835, 170, 'total', '1'),
(836, 170, 'id', '175'),
(837, 171, 'type', 'admin'),
(838, 171, 'module', 'users'),
(839, 171, 'mode', 'list'),
(840, 171, 'total', '5'),
(841, 171, 'id', '175'),
(842, 172, 'type', 'admin'),
(843, 172, 'module', 'suppliers'),
(844, 172, 'mode', 'list'),
(845, 172, 'total', '6'),
(846, 172, 'id', '175'),
(847, 173, 'type', 'user'),
(848, 173, 'module', 'suppliers'),
(849, 173, 'mode', 'delete'),
(850, 173, 'total', '6'),
(851, 173, 'id', '175'),
(852, 174, 'type', 'admin'),
(853, 174, 'module', 'suppliers'),
(854, 174, 'mode', 'list'),
(855, 174, 'total', '5'),
(856, 174, 'id', '175'),
(857, 175, 'type', 'user'),
(858, 175, 'module', 'suppliers'),
(859, 175, 'mode', 'delete'),
(860, 175, 'total', '5'),
(861, 175, 'id', '175'),
(862, 176, 'type', 'admin'),
(863, 176, 'module', 'suppliers'),
(864, 176, 'mode', 'list'),
(865, 176, 'total', '4'),
(866, 176, 'id', '175'),
(867, 177, 'type', 'admin'),
(868, 177, 'module', 'suppliers'),
(869, 177, 'mode', 'list'),
(870, 177, 'total', '4'),
(871, 177, 'id', '175'),
(872, 178, 'type', 'admin'),
(873, 178, 'module', 'suppliers'),
(874, 178, 'mode', 'list'),
(875, 178, 'total', '5'),
(876, 178, 'id', '175'),
(877, 179, 'type', 'admin'),
(878, 179, 'module', 'suppliers'),
(879, 179, 'mode', 'list'),
(880, 179, 'total', '5'),
(881, 179, 'id', '175'),
(882, 180, 'type', 'admin'),
(883, 180, 'module', 'users'),
(884, 180, 'mode', 'list'),
(885, 180, 'total', '5'),
(886, 180, 'id', '175'),
(887, 181, 'type', 'admin'),
(888, 181, 'module', 'suppliers'),
(889, 181, 'mode', 'list'),
(890, 181, 'total', '19'),
(891, 181, 'id', '175'),
(892, 182, 'type', 'admin'),
(893, 182, 'module', 'suppliers'),
(894, 182, 'mode', 'list'),
(895, 182, 'total', '19'),
(896, 182, 'id', '175'),
(897, 183, 'type', 'admin'),
(898, 183, 'module', 'suppliers'),
(899, 183, 'mode', 'list'),
(900, 183, 'total', '19'),
(901, 183, 'id', '175'),
(902, 184, 'type', 'admin'),
(903, 184, 'module', 'suppliers'),
(904, 184, 'mode', 'list'),
(905, 184, 'total', '19'),
(906, 184, 'id', '175'),
(907, 185, 'type', 'admin'),
(908, 185, 'module', 'suppliers'),
(909, 185, 'mode', 'list'),
(910, 185, 'total', '19'),
(911, 185, 'id', '175'),
(912, 186, 'type', 'admin'),
(913, 186, 'module', 'suppliers'),
(914, 186, 'mode', 'list'),
(915, 186, 'total', '19'),
(916, 186, 'id', '175'),
(917, 187, 'type', 'admin'),
(918, 187, 'module', 'suppliers'),
(919, 187, 'mode', 'list'),
(920, 187, 'total', '19'),
(921, 187, 'id', '175'),
(922, 188, 'type', 'admin'),
(923, 188, 'module', 'suppliers'),
(924, 188, 'mode', 'list'),
(925, 188, 'total', '20'),
(926, 188, 'id', '175'),
(927, 189, 'type', 'admin'),
(928, 189, 'module', 'suppliers'),
(929, 189, 'mode', 'list'),
(930, 189, 'total', '20'),
(931, 189, 'id', '175'),
(932, 190, 'type', 'admin'),
(933, 190, 'module', 'users'),
(934, 190, 'mode', 'list'),
(935, 190, 'total', '5'),
(936, 190, 'id', '175'),
(937, 191, 'type', 'admin'),
(938, 191, 'module', 'suppliers'),
(939, 191, 'mode', 'list'),
(940, 191, 'total', '22'),
(941, 191, 'id', '175'),
(942, 192, 'type', 'admin'),
(943, 192, 'module', 'suppliers'),
(944, 192, 'mode', 'list'),
(945, 192, 'total', '23'),
(946, 192, 'id', '175'),
(947, 193, 'type', 'admin'),
(948, 193, 'module', 'suppliers'),
(949, 193, 'mode', 'list'),
(950, 193, 'total', '23'),
(951, 193, 'id', '175'),
(952, 194, 'type', 'admin'),
(953, 194, 'module', 'suppliers'),
(954, 194, 'mode', 'list'),
(955, 194, 'total', '23'),
(956, 194, 'id', '175'),
(957, 195, 'type', 'admin'),
(958, 195, 'module', 'suppliers'),
(959, 195, 'mode', 'list'),
(960, 195, 'total', '23'),
(961, 195, 'id', '175'),
(962, 196, 'type', 'admin'),
(963, 196, 'module', 'suppliers'),
(964, 196, 'mode', 'list'),
(965, 196, 'total', '23'),
(966, 196, 'id', '175'),
(967, 197, 'type', 'admin'),
(968, 197, 'module', 'suppliers'),
(969, 197, 'mode', 'list'),
(970, 197, 'total', '23'),
(971, 197, 'id', '175'),
(972, 198, 'type', 'admin'),
(973, 198, 'module', 'suppliers'),
(974, 198, 'mode', 'list'),
(975, 198, 'total', '23'),
(976, 198, 'id', '175'),
(977, 199, 'type', 'admin'),
(978, 199, 'module', 'suppliers'),
(979, 199, 'mode', 'list'),
(980, 199, 'total', '23'),
(981, 199, 'id', '175'),
(982, 200, 'type', 'admin'),
(983, 200, 'module', 'suppliers'),
(984, 200, 'mode', 'list'),
(985, 200, 'total', '23'),
(986, 200, 'id', '175'),
(987, 201, 'type', 'admin'),
(988, 201, 'module', 'suppliers'),
(989, 201, 'mode', 'list'),
(990, 201, 'total', '23'),
(991, 201, 'id', '175'),
(992, 202, 'type', 'admin'),
(993, 202, 'module', 'suppliers'),
(994, 202, 'mode', 'list'),
(995, 202, 'total', '23'),
(996, 202, 'id', '175'),
(997, 203, 'type', 'admin'),
(998, 203, 'module', 'suppliers'),
(999, 203, 'mode', 'list'),
(1000, 203, 'total', '23'),
(1001, 203, 'id', '175'),
(1002, 204, 'type', 'admin'),
(1003, 204, 'module', 'suppliers'),
(1004, 204, 'mode', 'list'),
(1005, 204, 'total', '23'),
(1006, 204, 'id', '175'),
(1007, 205, 'type', 'admin'),
(1008, 205, 'module', 'groups'),
(1009, 205, 'mode', 'list'),
(1010, 205, 'total', '1'),
(1011, 205, 'id', '175'),
(1012, 206, 'type', 'admin'),
(1013, 206, 'module', 'users'),
(1014, 206, 'mode', 'list'),
(1015, 206, 'total', '5'),
(1016, 206, 'id', '175'),
(1017, 207, 'type', 'admin'),
(1018, 207, 'module', 'suppliers'),
(1019, 207, 'mode', 'list'),
(1020, 207, 'total', '23'),
(1021, 207, 'id', '175'),
(1022, 208, 'type', 'admin'),
(1023, 208, 'module', 'groups'),
(1024, 208, 'mode', 'list'),
(1025, 208, 'total', '1'),
(1026, 208, 'id', '175'),
(1027, 209, 'type', 'admin'),
(1028, 209, 'module', 'groups'),
(1029, 209, 'mode', 'list'),
(1030, 209, 'total', '1'),
(1031, 209, 'id', '175'),
(1032, 210, 'type', 'admin'),
(1033, 210, 'module', 'users'),
(1034, 210, 'mode', 'list'),
(1035, 210, 'total', '5'),
(1036, 210, 'id', '175'),
(1037, 211, 'type', 'admin'),
(1038, 211, 'module', 'users'),
(1039, 211, 'mode', 'list'),
(1040, 211, 'total', '9'),
(1041, 211, 'id', '175'),
(1042, 212, 'type', 'user'),
(1043, 212, 'module', 'users'),
(1044, 212, 'mode', 'delete'),
(1045, 212, 'total', '187'),
(1046, 212, 'id', '175'),
(1047, 213, 'type', 'user'),
(1048, 213, 'module', 'login'),
(1049, 213, 'mode', 'login'),
(1050, 213, 'id', '175'),
(1051, 214, 'type', 'user'),
(1052, 214, 'module', 'system_information'),
(1053, 214, 'mode', 'view'),
(1054, 214, 'id', '175'),
(1055, 215, 'type', 'admin'),
(1056, 215, 'module', 'users'),
(1057, 215, 'mode', 'list'),
(1058, 215, 'total', '9'),
(1059, 215, 'id', '175'),
(1060, 216, 'type', 'admin'),
(1061, 216, 'module', 'users'),
(1062, 216, 'mode', 'list'),
(1063, 216, 'total', '9'),
(1064, 216, 'id', '175'),
(1065, 217, 'type', 'admin'),
(1066, 217, 'module', 'users'),
(1067, 217, 'mode', 'list'),
(1068, 217, 'total', '9'),
(1069, 217, 'id', '175'),
(1070, 218, 'type', 'admin'),
(1071, 218, 'module', 'suppliers'),
(1072, 218, 'mode', 'list'),
(1073, 218, 'total', '23'),
(1074, 218, 'id', '175'),
(1075, 219, 'type', 'admin'),
(1076, 219, 'module', 'groups'),
(1077, 219, 'mode', 'list'),
(1078, 219, 'total', '1'),
(1079, 219, 'id', '175'),
(1080, 220, 'type', 'admin'),
(1081, 220, 'module', 'suppliers'),
(1082, 220, 'mode', 'list'),
(1083, 220, 'total', '23'),
(1084, 220, 'id', '175'),
(1085, 221, 'type', 'admin'),
(1086, 221, 'module', 'users'),
(1087, 221, 'mode', 'list'),
(1088, 221, 'total', '9'),
(1089, 221, 'id', '175'),
(1090, 222, 'type', 'user'),
(1091, 222, 'module', 'system_information'),
(1092, 222, 'mode', 'view'),
(1093, 222, 'id', '175'),
(1094, 223, 'type', 'admin'),
(1095, 223, 'module', 'users'),
(1096, 223, 'mode', 'list'),
(1097, 223, 'total', '9'),
(1098, 223, 'id', '175'),
(1099, 224, 'type', 'admin'),
(1100, 224, 'module', 'groups'),
(1101, 224, 'mode', 'list'),
(1102, 224, 'total', '1'),
(1103, 224, 'id', '175'),
(1104, 225, 'type', 'user'),
(1105, 225, 'module', 'login'),
(1106, 225, 'mode', 'login'),
(1107, 225, 'id', '175'),
(1108, 226, 'type', 'admin'),
(1109, 226, 'module', 'users'),
(1110, 226, 'mode', 'list'),
(1111, 226, 'total', '9'),
(1112, 226, 'id', '175'),
(1113, 227, 'type', 'user'),
(1114, 227, 'module', 'users'),
(1115, 227, 'mode', 'delete'),
(1116, 227, 'total', '191'),
(1117, 227, 'id', '175'),
(1118, 228, 'type', 'admin'),
(1119, 228, 'module', 'groups'),
(1120, 228, 'mode', 'list'),
(1121, 228, 'total', '1'),
(1122, 228, 'id', '175'),
(1123, 229, 'type', 'admin'),
(1124, 229, 'module', 'suppliers'),
(1125, 229, 'mode', 'list'),
(1126, 229, 'total', '23'),
(1127, 229, 'id', '175'),
(1128, 230, 'type', 'admin'),
(1129, 230, 'module', 'groups'),
(1130, 230, 'mode', 'list'),
(1131, 230, 'total', '1'),
(1132, 230, 'id', '175'),
(1133, 231, 'type', 'admin'),
(1134, 231, 'module', 'groups'),
(1135, 231, 'mode', 'list'),
(1136, 231, 'total', '1'),
(1137, 231, 'id', '175'),
(1138, 232, 'type', 'admin'),
(1139, 232, 'module', 'suppliers'),
(1140, 232, 'mode', 'list'),
(1141, 232, 'total', '23'),
(1142, 232, 'id', '175'),
(1143, 233, 'type', 'admin'),
(1144, 233, 'module', 'groups'),
(1145, 233, 'mode', 'list'),
(1146, 233, 'total', '1'),
(1147, 233, 'id', '175'),
(1148, 234, 'type', 'admin'),
(1149, 234, 'module', 'users'),
(1150, 234, 'mode', 'list'),
(1151, 234, 'total', '8'),
(1152, 234, 'id', '175'),
(1153, 235, 'type', 'admin'),
(1154, 235, 'module', 'users'),
(1155, 235, 'mode', 'list'),
(1156, 235, 'total', '8'),
(1157, 235, 'id', '175'),
(1158, 236, 'type', 'admin'),
(1159, 236, 'module', 'suppliers'),
(1160, 236, 'mode', 'list'),
(1161, 236, 'total', '23'),
(1162, 236, 'id', '175'),
(1163, 237, 'type', 'admin'),
(1164, 237, 'module', 'suppliers'),
(1165, 237, 'mode', 'list'),
(1166, 237, 'total', '23'),
(1167, 237, 'id', '175'),
(1168, 238, 'type', 'admin'),
(1169, 238, 'module', 'users'),
(1170, 238, 'mode', 'list'),
(1171, 238, 'total', '8'),
(1172, 238, 'id', '175'),
(1173, 239, 'type', 'admin'),
(1174, 239, 'module', 'users'),
(1175, 239, 'mode', 'list'),
(1176, 239, 'total', '8'),
(1177, 239, 'id', '175'),
(1178, 240, 'type', 'admin'),
(1179, 240, 'module', 'groups'),
(1180, 240, 'mode', 'list'),
(1181, 240, 'total', '1'),
(1182, 240, 'id', '175'),
(1183, 241, 'type', 'admin'),
(1184, 241, 'module', 'users'),
(1185, 241, 'mode', 'list'),
(1186, 241, 'total', '8'),
(1187, 241, 'id', '175'),
(1188, 242, 'type', 'admin'),
(1189, 242, 'module', 'permission'),
(1190, 242, 'mode', 'view'),
(1191, 242, 'id', '175'),
(1192, 243, 'type', 'admin'),
(1193, 243, 'module', 'groups'),
(1194, 243, 'mode', 'list'),
(1195, 243, 'total', '1'),
(1196, 243, 'id', '175'),
(1197, 244, 'type', 'admin'),
(1198, 244, 'module', 'groups'),
(1199, 244, 'mode', 'list'),
(1200, 244, 'total', '1'),
(1201, 244, 'id', '175'),
(1202, 245, 'type', 'admin'),
(1203, 245, 'module', 'expenses'),
(1204, 245, 'mode', 'list'),
(1205, 245, 'id', '175'),
(1206, 246, 'type', 'admin'),
(1207, 246, 'module', 'expenses'),
(1208, 246, 'mode', 'list'),
(1209, 246, 'id', '175'),
(1210, 247, 'type', 'admin'),
(1211, 247, 'module', 'expenses'),
(1212, 247, 'mode', 'list'),
(1213, 247, 'id', '175'),
(1214, 248, 'type', 'admin'),
(1215, 248, 'module', 'expenses'),
(1216, 248, 'mode', 'list'),
(1217, 248, 'id', '175'),
(1218, 249, 'type', 'admin'),
(1219, 249, 'module', 'expenses'),
(1220, 249, 'mode', 'list'),
(1221, 249, 'id', '175'),
(1222, 250, 'type', 'admin'),
(1223, 250, 'module', 'expenses'),
(1224, 250, 'mode', 'list'),
(1225, 250, 'id', '175'),
(1226, 251, 'type', 'admin'),
(1227, 251, 'module', 'expenses'),
(1228, 251, 'mode', 'list'),
(1229, 251, 'id', '175'),
(1230, 252, 'type', 'admin'),
(1231, 252, 'module', 'expenses'),
(1232, 252, 'mode', 'list'),
(1233, 252, 'id', '175'),
(1234, 253, 'type', 'admin'),
(1235, 253, 'module', 'expenses'),
(1236, 253, 'mode', 'list'),
(1237, 253, 'id', '175'),
(1238, 254, 'type', 'admin'),
(1239, 254, 'module', 'expenses'),
(1240, 254, 'mode', 'list'),
(1241, 254, 'id', '175'),
(1242, 255, 'type', 'admin'),
(1243, 255, 'module', 'expenses'),
(1244, 255, 'mode', 'list'),
(1245, 255, 'id', '175'),
(1246, 256, 'type', 'admin'),
(1247, 256, 'module', 'expenses'),
(1248, 256, 'mode', 'list'),
(1249, 256, 'id', '175'),
(1250, 257, 'type', 'admin'),
(1251, 257, 'module', 'expenses'),
(1252, 257, 'mode', 'list'),
(1253, 257, 'id', '175'),
(1254, 258, 'type', 'admin'),
(1255, 258, 'module', 'expenses'),
(1256, 258, 'mode', 'list'),
(1257, 258, 'id', '175'),
(1258, 259, 'type', 'admin'),
(1259, 259, 'module', 'expenses'),
(1260, 259, 'mode', 'list'),
(1261, 259, 'id', '175'),
(1262, 260, 'type', 'admin'),
(1263, 260, 'module', 'users'),
(1264, 260, 'mode', 'list'),
(1265, 260, 'total', '8'),
(1266, 260, 'id', '175'),
(1267, 261, 'type', 'user'),
(1268, 261, 'module', 'system_information'),
(1269, 261, 'mode', 'view'),
(1270, 261, 'id', '175'),
(1271, 262, 'type', 'admin'),
(1272, 262, 'module', 'expenses'),
(1273, 262, 'mode', 'list'),
(1274, 262, 'id', '175'),
(1275, 263, 'type', 'admin'),
(1276, 263, 'module', 'expenses'),
(1277, 263, 'mode', 'list'),
(1278, 263, 'id', '175'),
(1279, 264, 'type', 'admin'),
(1280, 264, 'module', 'expenses'),
(1281, 264, 'mode', 'list'),
(1282, 264, 'id', '175'),
(1283, 265, 'type', 'admin'),
(1284, 265, 'module', 'expenses'),
(1285, 265, 'mode', 'list'),
(1286, 265, 'id', '175'),
(1287, 266, 'type', 'admin'),
(1288, 266, 'module', 'expenses'),
(1289, 266, 'mode', 'list'),
(1290, 266, 'id', '175'),
(1291, 267, 'type', 'admin'),
(1292, 267, 'module', 'expenses'),
(1293, 267, 'mode', 'list'),
(1294, 267, 'id', '175'),
(1295, 268, 'type', 'admin'),
(1296, 268, 'module', 'expenses'),
(1297, 268, 'mode', 'list'),
(1298, 268, 'id', '175'),
(1299, 269, 'type', 'admin'),
(1300, 269, 'module', 'expenses'),
(1301, 269, 'mode', 'list'),
(1302, 269, 'id', '175'),
(1303, 270, 'type', 'admin'),
(1304, 270, 'module', 'expenses'),
(1305, 270, 'mode', 'list'),
(1306, 270, 'id', '175'),
(1307, 271, 'type', 'admin'),
(1308, 271, 'module', 'expenses'),
(1309, 271, 'mode', 'list'),
(1310, 271, 'id', '175'),
(1311, 272, 'type', 'admin'),
(1312, 272, 'module', 'expenses'),
(1313, 272, 'mode', 'list'),
(1314, 272, 'id', '175'),
(1315, 273, 'type', 'admin'),
(1316, 273, 'module', 'expenses'),
(1317, 273, 'mode', 'list'),
(1318, 273, 'id', '175'),
(1319, 274, 'type', 'user'),
(1320, 274, 'module', 'expenses'),
(1321, 274, 'mode', 'update'),
(1322, 274, 'total', '4'),
(1323, 274, 'id', '175'),
(1324, 275, 'type', 'admin'),
(1325, 275, 'module', 'expenses'),
(1326, 275, 'mode', 'list'),
(1327, 275, 'id', '175'),
(1328, 276, 'type', 'admin'),
(1329, 276, 'module', 'expenses'),
(1330, 276, 'mode', 'list'),
(1331, 276, 'id', '175'),
(1332, 277, 'type', 'user'),
(1333, 277, 'module', 'expenses'),
(1334, 277, 'mode', 'update'),
(1335, 277, 'total', '4'),
(1336, 277, 'id', '175'),
(1337, 278, 'type', 'admin'),
(1338, 278, 'module', 'expenses'),
(1339, 278, 'mode', 'list'),
(1340, 278, 'id', '175'),
(1341, 279, 'type', 'admin'),
(1342, 279, 'module', 'expenses'),
(1343, 279, 'mode', 'list'),
(1344, 279, 'id', '175'),
(1345, 280, 'type', 'user'),
(1346, 280, 'module', 'expenses'),
(1347, 280, 'mode', 'update'),
(1348, 280, 'total', '4'),
(1349, 280, 'id', '175'),
(1350, 281, 'type', 'admin'),
(1351, 281, 'module', 'expenses'),
(1352, 281, 'mode', 'list'),
(1353, 281, 'id', '175'),
(1354, 282, 'type', 'admin'),
(1355, 282, 'module', 'expenses'),
(1356, 282, 'mode', 'list'),
(1357, 282, 'id', '175'),
(1358, 283, 'type', 'user'),
(1359, 283, 'module', 'expenses'),
(1360, 283, 'mode', 'update'),
(1361, 283, 'total', '4'),
(1362, 283, 'id', '175'),
(1363, 284, 'type', 'admin'),
(1364, 284, 'module', 'expenses'),
(1365, 284, 'mode', 'list'),
(1366, 284, 'id', '175'),
(1367, 285, 'type', 'admin'),
(1368, 285, 'module', 'expenses'),
(1369, 285, 'mode', 'list'),
(1370, 285, 'id', '175'),
(1371, 286, 'type', 'admin'),
(1372, 286, 'module', 'expenses'),
(1373, 286, 'mode', 'list'),
(1374, 286, 'id', '175'),
(1375, 287, 'type', 'admin'),
(1376, 287, 'module', 'expenses'),
(1377, 287, 'mode', 'list'),
(1378, 287, 'id', '175'),
(1379, 288, 'type', 'admin'),
(1380, 288, 'module', 'expenses'),
(1381, 288, 'mode', 'list'),
(1382, 288, 'id', '175'),
(1383, 289, 'type', 'admin'),
(1384, 289, 'module', 'expenses'),
(1385, 289, 'mode', 'list'),
(1386, 289, 'id', '175'),
(1387, 290, 'type', 'admin'),
(1388, 290, 'module', 'expenses'),
(1389, 290, 'mode', 'list'),
(1390, 290, 'id', '175'),
(1391, 291, 'type', 'admin'),
(1392, 291, 'module', 'expenses'),
(1393, 291, 'mode', 'list'),
(1394, 291, 'id', '175'),
(1395, 292, 'type', 'admin'),
(1396, 292, 'module', 'expenses'),
(1397, 292, 'mode', 'list'),
(1398, 292, 'id', '175'),
(1399, 293, 'type', 'admin'),
(1400, 293, 'module', 'expenses'),
(1401, 293, 'mode', 'list'),
(1402, 293, 'id', '175'),
(1403, 294, 'type', 'admin'),
(1404, 294, 'module', 'expenses'),
(1405, 294, 'mode', 'list'),
(1406, 294, 'id', '175'),
(1407, 295, 'type', 'admin'),
(1408, 295, 'module', 'expenses'),
(1409, 295, 'mode', 'list'),
(1410, 295, 'id', '175'),
(1411, 296, 'type', 'admin'),
(1412, 296, 'module', 'expenses'),
(1413, 296, 'mode', 'list'),
(1414, 296, 'id', '175'),
(1415, 297, 'type', 'admin'),
(1416, 297, 'module', 'expenses'),
(1417, 297, 'mode', 'list'),
(1418, 297, 'id', '175'),
(1419, 298, 'type', 'user'),
(1420, 298, 'module', 'expenses'),
(1421, 298, 'mode', 'update'),
(1422, 298, 'total', '4'),
(1423, 298, 'id', '175'),
(1424, 299, 'type', 'admin'),
(1425, 299, 'module', 'expenses'),
(1426, 299, 'mode', 'list'),
(1427, 299, 'id', '175'),
(1428, 300, 'type', 'admin'),
(1429, 300, 'module', 'expenses'),
(1430, 300, 'mode', 'list'),
(1431, 300, 'id', '175'),
(1432, 301, 'type', 'admin'),
(1433, 301, 'module', 'expenses'),
(1434, 301, 'mode', 'list'),
(1435, 301, 'id', '175'),
(1436, 302, 'type', 'admin'),
(1437, 302, 'module', 'expenses'),
(1438, 302, 'mode', 'list'),
(1439, 302, 'id', '175'),
(1440, 303, 'type', 'admin'),
(1441, 303, 'module', 'expenses'),
(1442, 303, 'mode', 'list'),
(1443, 303, 'id', '175'),
(1444, 304, 'type', 'admin'),
(1445, 304, 'module', 'expenses'),
(1446, 304, 'mode', 'list'),
(1447, 304, 'id', '175'),
(1448, 305, 'type', 'admin'),
(1449, 305, 'module', 'expenses'),
(1450, 305, 'mode', 'list'),
(1451, 305, 'id', '175'),
(1452, 306, 'type', 'admin'),
(1453, 306, 'module', 'expenses'),
(1454, 306, 'mode', 'list'),
(1455, 306, 'id', '175'),
(1456, 307, 'type', 'user'),
(1457, 307, 'module', 'expenses'),
(1458, 307, 'mode', 'delete'),
(1459, 307, 'total', '4'),
(1460, 307, 'id', '175'),
(1461, 308, 'type', 'admin'),
(1462, 308, 'module', 'expenses'),
(1463, 308, 'mode', 'list'),
(1464, 308, 'id', '175'),
(1465, 309, 'type', 'admin'),
(1466, 309, 'module', 'expenses'),
(1467, 309, 'mode', 'list'),
(1468, 309, 'id', '175'),
(1469, 310, 'type', 'admin'),
(1470, 310, 'module', 'expenses'),
(1471, 310, 'mode', 'list'),
(1472, 310, 'id', '175'),
(1473, 311, 'type', 'admin'),
(1474, 311, 'module', 'expenses'),
(1475, 311, 'mode', 'list'),
(1476, 311, 'id', '175'),
(1477, 312, 'type', 'admin'),
(1478, 312, 'module', 'expenses'),
(1479, 312, 'mode', 'list'),
(1480, 312, 'id', '175'),
(1481, 313, 'type', 'admin'),
(1482, 313, 'module', 'expenses'),
(1483, 313, 'mode', 'list'),
(1484, 313, 'id', '175'),
(1485, 314, 'type', 'admin'),
(1486, 314, 'module', 'expenses'),
(1487, 314, 'mode', 'list'),
(1488, 314, 'id', '175'),
(1489, 315, 'type', 'admin'),
(1490, 315, 'module', 'expenses'),
(1491, 315, 'mode', 'list'),
(1492, 315, 'id', '175'),
(1493, 316, 'type', 'admin'),
(1494, 316, 'module', 'expenses'),
(1495, 316, 'mode', 'list'),
(1496, 316, 'id', '175'),
(1497, 317, 'type', 'user'),
(1498, 317, 'module', 'expenses'),
(1499, 317, 'mode', 'add'),
(1500, 317, 'id', '175'),
(1501, 318, 'type', 'admin'),
(1502, 318, 'module', 'expenses'),
(1503, 318, 'mode', 'list'),
(1504, 318, 'id', '175'),
(1505, 319, 'type', 'admin'),
(1506, 319, 'module', 'expenses'),
(1507, 319, 'mode', 'list'),
(1508, 319, 'id', '175'),
(1509, 320, 'type', 'user'),
(1510, 320, 'module', 'expenses'),
(1511, 320, 'mode', 'delete'),
(1512, 320, 'total', '5'),
(1513, 320, 'id', '175'),
(1514, 321, 'type', 'admin'),
(1515, 321, 'module', 'expenses'),
(1516, 321, 'mode', 'list'),
(1517, 321, 'id', '175'),
(1518, 322, 'type', 'admin'),
(1519, 322, 'module', 'expenses'),
(1520, 322, 'mode', 'list'),
(1521, 322, 'id', '175'),
(1522, 323, 'type', 'admin'),
(1523, 323, 'module', 'expenses'),
(1524, 323, 'mode', 'list'),
(1525, 323, 'id', '175'),
(1526, 324, 'type', 'admin'),
(1527, 324, 'module', 'expenses'),
(1528, 324, 'mode', 'list'),
(1529, 324, 'id', '175'),
(1530, 325, 'type', 'admin'),
(1531, 325, 'module', 'expenses'),
(1532, 325, 'mode', 'list'),
(1533, 325, 'id', '175'),
(1534, 326, 'type', 'admin'),
(1535, 326, 'module', 'expenses'),
(1536, 326, 'mode', 'list'),
(1537, 326, 'id', '175'),
(1538, 327, 'type', 'admin'),
(1539, 327, 'module', 'expenses'),
(1540, 327, 'mode', 'list'),
(1541, 327, 'id', '175'),
(1542, 328, 'type', 'admin'),
(1543, 328, 'module', 'expenses'),
(1544, 328, 'mode', 'list'),
(1545, 328, 'id', '175'),
(1546, 329, 'type', 'admin'),
(1547, 329, 'module', 'expenses'),
(1548, 329, 'mode', 'list'),
(1549, 329, 'id', '175'),
(1550, 330, 'type', 'user'),
(1551, 330, 'module', 'expenses'),
(1552, 330, 'mode', 'add'),
(1553, 330, 'id', '175'),
(1554, 331, 'type', 'admin'),
(1555, 331, 'module', 'expenses'),
(1556, 331, 'mode', 'list'),
(1557, 331, 'id', '175'),
(1558, 332, 'type', 'admin'),
(1559, 332, 'module', 'expenses'),
(1560, 332, 'mode', 'list'),
(1561, 332, 'id', '175'),
(1562, 333, 'type', 'admin'),
(1563, 333, 'module', 'expenses'),
(1564, 333, 'mode', 'list'),
(1565, 333, 'id', '175'),
(1566, 334, 'type', 'admin'),
(1567, 334, 'module', 'expenses'),
(1568, 334, 'mode', 'list'),
(1569, 334, 'id', '175'),
(1570, 335, 'type', 'admin'),
(1571, 335, 'module', 'expenses'),
(1572, 335, 'mode', 'list'),
(1573, 335, 'id', '175'),
(1574, 336, 'type', 'admin'),
(1575, 336, 'module', 'expenses'),
(1576, 336, 'mode', 'list'),
(1577, 336, 'id', '175');

-- --------------------------------------------------------

--
-- Table structure for table `log_type`
--

CREATE TABLE `log_type` (
  `id` int(11) NOT NULL,
  `type` varchar(20) COLLATE utf8_bin NOT NULL,
  `module` varchar(40) COLLATE utf8_bin NOT NULL,
  `mode` varchar(50) COLLATE utf8_bin NOT NULL,
  `params` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `log_type`
--

INSERT INTO `log_type` (`id`, `type`, `module`, `mode`, `params`) VALUES
(1, 'user', 'login', 'login', 'a:4:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:2:\"id\";}'),
(2, 'admin', 'users', 'list', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(3, 'admin', 'suppliers', 'list', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(4, 'user', 'system_information', 'view', 'a:4:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:2:\"id\";}'),
(5, 'user', 'system_information', 'edit_company_information', 'a:4:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:2:\"id\";}'),
(6, 'admin', 'groups', 'list', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(7, 'user', 'supplliers', 'delete', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(8, 'user', 'suppliers', 'delete', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(9, 'user', 'users', 'delete', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(10, 'admin', 'permission', 'view', 'a:4:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:2:\"id\";}'),
(11, 'admin', 'expenses', 'list', 'a:4:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:2:\"id\";}'),
(12, 'user', 'expenses', 'update', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(13, 'user', 'expenses', 'delete', 'a:5:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:5:\"total\";i:4;s:2:\"id\";}'),
(14, 'user', 'expenses', 'add', 'a:4:{i:0;s:4:\"type\";i:1;s:6:\"module\";i:2;s:4:\"mode\";i:3;s:2:\"id\";}');

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `management_sn` int(3) NOT NULL,
  `management_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `management_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `management`
--

INSERT INTO `management` (`management_sn`, `management_name`, `management_status`) VALUES
(1, 'الادارة 1', 1),
(2, 'الادارة 587', 1),
(3, 'ادارة 3', 1),
(4, 'new', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_jobs_items`
--

CREATE TABLE `order_jobs_items` (
  `order_jobs_items_sn` int(11) NOT NULL,
  `order_jobs_items_order_job_id` int(11) NOT NULL,
  `order_jobs_items_check_item_id` int(11) NOT NULL,
  `order_jobs_items_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_jobs_services`
--

CREATE TABLE `order_jobs_services` (
  `order_jobs_services_sn` int(11) NOT NULL,
  `order_jobs_services_order_job_id` int(11) NOT NULL,
  `order_jobs_services_service_id` int(11) NOT NULL,
  `order_jobs_services_supplier_id` int(11) NOT NULL,
  `order_jobs_services_cost` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `order_jobs_spares`
--

CREATE TABLE `order_jobs_spares` (
  `order_jobs_spares_sn` int(11) NOT NULL,
  `order_jobs_spares_order_job_id` int(11) NOT NULL,
  `order_jobs_spares_spare_id` int(11) NOT NULL,
  `order_jobs_spares_supplier_id` int(11) NOT NULL,
  `order_jobs_spares_cost` float NOT NULL,
  `order_jobs_spares_attach` char(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projects_sn` int(11) NOT NULL,
  `projects_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `projects_manger_id` int(11) NOT NULL,
  `projects_client` varchar(150) CHARACTER SET utf8 NOT NULL,
  `projects_contract_start` date NOT NULL,
  `projects_contract_end` date NOT NULL,
  `projects_client_phone` char(11) NOT NULL,
  `projects_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projects_sn`, `projects_name`, `projects_manger_id`, `projects_client`, `projects_contract_start`, `projects_contract_end`, `projects_client_phone`, `projects_status`) VALUES
(1, 'مشروع 1', 1, 'محمد أحمد', '2020-02-17', '2020-02-18', '0101234567', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_cars`
--

CREATE TABLE `project_cars` (
  `project_cars_sn` int(11) NOT NULL,
  `project_cars_project_id` int(11) NOT NULL,
  `project_cars_car_id` int(11) NOT NULL,
  `project_cars_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_car_types`
--

CREATE TABLE `project_car_types` (
  `project_car_types_sn` int(11) NOT NULL,
  `project_car_types_project_id` int(11) NOT NULL,
  `project_car_types_type_id` int(3) NOT NULL,
  `project_car_types_car_number` int(4) NOT NULL,
  `project_car_types_max_kilometer` int(5) NOT NULL,
  `project_car_types_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `project_roads`
--

CREATE TABLE `project_roads` (
  `project_roads_sn` int(11) NOT NULL,
  `project_roads_project_id` int(11) NOT NULL,
  `project_roads_code` int(11) NOT NULL,
  `project_roads_start` varchar(50) NOT NULL,
  `project_roads_end` varchar(50) NOT NULL,
  `project_roads_distance` float NOT NULL,
  `project_roads_complete_round` tinyint(1) NOT NULL,
  `project_roads_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `puck_up_car`
--

CREATE TABLE `puck_up_car` (
  `puck_up_car_sn` int(11) NOT NULL,
  `puck_up_car_car_id` int(11) NOT NULL,
  `puck_up_car_supervisor_id` int(11) NOT NULL,
  `puck_up_car_driver_id` int(11) NOT NULL,
  `puck_up_car_delivery_by` int(11) NOT NULL,
  `puck_up_car_kilos` int(6) NOT NULL,
  `puck_up_car_date` date NOT NULL,
  `puck_up_car_time` time NOT NULL,
  `puck_up_car_check_id` int(11) NOT NULL,
  `cpuck_up_car_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reminders`
--

CREATE TABLE `reminders` (
  `reminders_sn` int(11) NOT NULL,
  `reminders_car_id` int(11) NOT NULL,
  `reminders_type` enum('service','spare') NOT NULL,
  `reminders_type_id` int(11) NOT NULL,
  `reminders_start_date` date NOT NULL,
  `reminders_repeat_number` int(3) NOT NULL,
  `reminders_type_reminder` int(1) NOT NULL,
  `reminders_next_date` date NOT NULL,
  `reminders_repeat_kilo` int(6) NOT NULL,
  `reminders_remember_day` int(3) NOT NULL,
  `reminders_remember_kilo` int(6) NOT NULL,
  `reminders_notification_date` date NOT NULL,
  `reminders_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `reminders_members`
--

CREATE TABLE `reminders_members` (
  `reminders_members_sn` int(11) NOT NULL,
  `reminders_members_reminder_id` int(11) NOT NULL,
  `reminders_members_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `services_sn` int(11) NOT NULL,
  `services_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `services_notes` text CHARACTER SET utf8 NOT NULL,
  `services_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `suppliers_sn` int(11) NOT NULL,
  `suppliers_type` enum('repair','spare') NOT NULL,
  `suppliers_name` varchar(150) CHARACTER SET utf8 NOT NULL,
  `suppliers_supply_id` int(11) NOT NULL,
  `suppliers_accountable_id` int(11) NOT NULL COMMENT 'from users table',
  `suppliers_phone` char(11) NOT NULL,
  `suppliers_contract_start` date NOT NULL,
  `suppliers_contract_end` date NOT NULL,
  `suppliers_address` varchar(255) CHARACTER SET utf8 NOT NULL,
  `suppliers_city` varchar(50) CHARACTER SET utf8 NOT NULL,
  `suppliers_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `suppliers_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`suppliers_sn`, `suppliers_type`, `suppliers_name`, `suppliers_supply_id`, `suppliers_accountable_id`, `suppliers_phone`, `suppliers_contract_start`, `suppliers_contract_end`, `suppliers_address`, `suppliers_city`, `suppliers_email`, `suppliers_status`) VALUES
(1, 'spare', 'أحمد ', 1, 175, '01020304050', '2020-02-17', '2020-02-17', 'ءشؤءسؤ', 'القاهرة', 'ahmed78@gmail.com', 1),
(2, 'spare', 'محمد', 2, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(3, 'spare', 'محمد', 2, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(4, 'spare', 'محمد', 2, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(7, 'spare', 'staff', 3, 0, '01234567890', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(8, 'spare', 'fawzy', 4, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(9, 'spare', 'fawzy', 4, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(10, 'spare', 'fawzy', 4, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(11, 'spare', 'fawzy', 3, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(12, 'spare', 'fawzy', 3, 0, '01149746826', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(13, 'spare', 'new', 3, 0, '01149746826', '0000-00-00', '0000-00-00', 'Egypt', 'القاهرة', 'elmajiko85@gmail.com', 1),
(14, 'spare', 'new', 3, 0, '01149746826', '0000-00-00', '0000-00-00', 'Egypt', 'القاهرة', 'elmajiko85@gmail.com', 1),
(15, 'spare', 'new', 3, 0, '01149746826', '0000-00-00', '0000-00-00', 'Egypt', 'القاهرة', 'elmajiko85@gmail.com', 1),
(16, 'spare', 'new', 3, 0, '01149746826', '0000-00-00', '0000-00-00', 'Egypt', 'القاهرة', 'elmajiko85@gmail.com', 1),
(17, 'spare', 'new', 2, 0, '01777777777', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(18, 'spare', 'new', 2, 0, '01777777777', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(19, 'spare', 'new', 2, 0, '01777777777', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(20, 'spare', 'new', 2, 0, '01777777777', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(21, 'spare', 'new', 2, 0, '01777777777', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(22, 'spare', 'staff', 2, 0, '01123456789', '0000-00-00', '0000-00-00', 'Elmahdy , Cairo', 'القاهرة', 'fawzy@gmail.com', 1),
(23, 'spare', 'new', 3, 0, '0123567894', '0000-00-00', '0000-00-00', 'Egypt', 'القاهرة', 'fawzy@gmail.com', 1),
(24, 'spare', 'new', 3, 0, '0123567894', '2020-02-20', '2020-02-28', 'Egypt', 'القاهرة', 'fawzy@gmail.com', 1),
(25, 'spare', 'new', 3, 185, '0123567894', '2020-02-20', '2020-02-28', 'Egypt', 'القاهرة', 'fawzy@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `supply_type`
--

CREATE TABLE `supply_type` (
  `supply_type_sn` int(3) NOT NULL,
  `supply_type_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `supply_type_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `supply_type`
--

INSERT INTO `supply_type` (`supply_type_sn`, `supply_type_name`, `supply_type_status`) VALUES
(1, 'توريد 1', 1),
(2, 'توريد 2', 1),
(3, 'مكممك', 1),
(4, 'fawzy', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_type`
--

CREATE TABLE `transfer_type` (
  `transfer_type_sn` int(3) NOT NULL,
  `transfer_type_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `transfer_type_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transfer_type`
--

INSERT INTO `transfer_type` (`transfer_type_sn`, `transfer_type_name`, `transfer_type_status`) VALUES
(1, 'نوع نقل 1 ', 1),
(2, 'نوع نقل 2 ', 1),
(3, 'TITLE B', 3);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `users_sn` int(11) NOT NULL,
  `users_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `users_managment_id` int(11) NOT NULL,
  `users_job_id` int(11) NOT NULL,
  `users_qualification` varchar(25) CHARACTER SET utf8 NOT NULL,
  `users_birthday` date NOT NULL,
  `users_hiring_date` date NOT NULL,
  `users_phone` char(11) NOT NULL,
  `users_email` varchar(50) CHARACTER SET utf8 NOT NULL,
  `users_job_serial` int(11) NOT NULL,
  `users_net_salary` float NOT NULL,
  `users_salary_exchanges` float NOT NULL,
  `users_photo` char(15) NOT NULL,
  `users_personal_id` char(15) NOT NULL,
  `users_license_id` varchar(15) NOT NULL,
  `users_license_place` varchar(255) CHARACTER SET utf8 NOT NULL,
  `users_license_expired` date NOT NULL,
  `users_contract_finish` date NOT NULL,
  `users_contract_photo` char(15) NOT NULL,
  `users_notes` text CHARACTER SET utf8 NOT NULL,
  `users_username` varchar(50) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_group_id` int(3) NOT NULL,
  `users_last_login` date NOT NULL,
  `users_recovery_code` char(10) NOT NULL,
  `users_recovery_expired` datetime NOT NULL,
  `users_status` tinyint(1) NOT NULL,
  `users_kick` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`users_sn`, `users_name`, `users_managment_id`, `users_job_id`, `users_qualification`, `users_birthday`, `users_hiring_date`, `users_phone`, `users_email`, `users_job_serial`, `users_net_salary`, `users_salary_exchanges`, `users_photo`, `users_personal_id`, `users_license_id`, `users_license_place`, `users_license_expired`, `users_contract_finish`, `users_contract_photo`, `users_notes`, `users_username`, `users_password`, `users_group_id`, `users_last_login`, `users_recovery_code`, `users_recovery_expired`, `users_status`, `users_kick`) VALUES
(175, 'الادمن', 1, 1, 'ingner', '2019-05-02', '2020-02-09', '01146689213', 'Ahmed85@gmail.com', 23123, 1000, 201, '74d547db20.jpeg', '', '', '', '2020-02-09', '2020-02-03', '', '', 'fawzy587', '$2y$10$a5bzk.RxnAshdZoqKyeu/OLdBGeSH2FSZzWcCKXzQ3HQKw9aqlssi', 1, '2020-02-25', '5885773030', '2020-02-10 16:23:06', 1, 0),
(182, 'أحمد محمد', 1, 1, 'ingner', '2019-05-02', '2020-02-09', '01146689213', 'Ahmed85@gmail.com', 23123, 1000, 201, '74d547db20.jpeg', '', '', '', '2020-02-09', '2020-02-03', '', '', 'fawzy587', '$2y$10$a5bzk.RxnAshdZoqKyeu/OLdBGeSH2FSZzWcCKXzQ3HQKw9aqlssi', 1, '2020-02-17', '5885773030', '2020-02-10 16:23:06', 1, 0),
(183, 'موظف2', 1, 1, 'mmooko', '2020-02-09', '2020-02-09', '01146689213', 'elmajiko75@gmail.com', 23127, 1000, 1322, '74d547db20.jpeg', '', '', '', '0000-00-00', '0000-00-00', '', '', 'elmajiko85', '', 1, '2020-02-10', '8422304078', '2020-02-10 16:12:50', 1, 0),
(184, 'موظف3', 1, 1, 'mmooko', '2020-02-09', '2020-02-09', '01146689213', 'elmajiko97@gmail.com', 23127, 1000, 1322, '74d547db20.jpeg', '', '', '', '0000-00-00', '0000-00-00', '', '', 'elmajiko85', '', 1, '2020-02-10', '8422304078', '2020-02-10 16:12:50', 1, 0),
(185, 'موظف4', 1, 1, 'ingner', '2019-05-02', '2020-02-09', '01146689213', 'Ahmed857@gmail.com', 23123, 1000, 201, '74d547db20.jpeg', '', '', '', '2020-02-09', '2020-02-03', '', '', 'fawzy587', '$2y$10$a5bzk.RxnAshdZoqKyeu/OLdBGeSH2FSZzWcCKXzQ3HQKw9aqlssi', 1, '2020-02-17', '5885773030', '2020-02-10 16:23:06', 1, 0),
(186, 'موظف2', 1, 1, 'mmooko', '2020-02-09', '2020-02-09', '01146689213', 'elmajiko757@gmail.com', 23127, 1000, 1322, '74d547db20.jpeg', '', '', '', '0000-00-00', '0000-00-00', '', '', 'elmajiko85', '', 1, '2020-02-10', '8422304078', '2020-02-10 16:12:50', 1, 0),
(188, 'fawzy', 0, 2, 'مهندس', '0000-00-00', '0000-00-00', '01299967890', 'xx@gmail.com', 2132, 10000, 100, '7a0773c16d.png', '97c82ca5cd.jpg', '8899', '565', '0000-00-00', '0000-00-00', 'bd7c86a888.jpg', 'xxcc', 'fawzy56', '$2y$10$94ipDXsYoTSwFOcCDDyIMuqe5.PA6cN04Gb/5xXBVVQy.YbaX5ZnC', 1, '0000-00-00', '', '0000-00-00 00:00:00', 1, 1),
(189, 'fawzy', 0, 2, 'مهندس', '0000-00-00', '0000-00-00', '01299967890', 'xx@gmail.com', 2132, 10000, 100, 'c5031084b0.png', '72f886a48b.jpg', '8899', '565', '0000-00-00', '0000-00-00', '218028f226.jpg', 'xxcc', 'fawzy56', '$2y$10$CQPcLcd8TEKOE2U9mPgs8uNm6G3QCIiZpUgWNO2ZtVEBXwjOBBjrS', 1, '0000-00-00', '', '0000-00-00 00:00:00', 1, 1),
(190, 'fawzy', 0, 2, 'مهندس', '0000-00-00', '0000-00-00', '01299967890', 'xx@gmail.com', 2132, 10000, 100, '91f140f651.png', 'ce2e855795.jpg', '8899', '565', '0000-00-00', '0000-00-00', 'c83fdf985b.jpg', 'xxcc', 'fawzy56', '$2y$10$t9xmJXpTb6TQFqfSy.tNv.RbiOZHOzdYAfptWfXIGHCp94Zx/LQ7q', 1, '0000-00-00', '', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `wheel_size`
--

CREATE TABLE `wheel_size` (
  `wheel_size_sn` int(4) NOT NULL,
  `wheel_size_name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `wheel_size_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wheel_size`
--

INSERT INTO `wheel_size` (`wheel_size_sn`, `wheel_size_name`, `wheel_size_status`) VALUES
(1, 'مقاس 89', 1),
(2, 'مقاس', 1),
(3, 'مقاس 9', 3),
(4, 'Mohamed', 3),
(6, 'new_office', 1),
(7, 'new', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`cars_sn`);

--
-- Indexes for table `car_check`
--
ALTER TABLE `car_check`
  ADD PRIMARY KEY (`car_check_sn`);

--
-- Indexes for table `car_docments`
--
ALTER TABLE `car_docments`
  ADD PRIMARY KEY (`car_docments_sn`);

--
-- Indexes for table `car_expenses`
--
ALTER TABLE `car_expenses`
  ADD PRIMARY KEY (`car_expenses_sn`);

--
-- Indexes for table `car_fuel`
--
ALTER TABLE `car_fuel`
  ADD PRIMARY KEY (`car_fuel_sn`);

--
-- Indexes for table `car_orders`
--
ALTER TABLE `car_orders`
  ADD PRIMARY KEY (`car_orders_sn`);

--
-- Indexes for table `car_owner`
--
ALTER TABLE `car_owner`
  ADD PRIMARY KEY (`car_owner_sn`);

--
-- Indexes for table `car_status`
--
ALTER TABLE `car_status`
  ADD PRIMARY KEY (`car_status_sn`);

--
-- Indexes for table `check_items`
--
ALTER TABLE `check_items`
  ADD PRIMARY KEY (`check_items_sn`);

--
-- Indexes for table `company_information`
--
ALTER TABLE `company_information`
  ADD PRIMARY KEY (`company_information_sn`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`departments_sn`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`expenses_sn`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`forms_sn`);

--
-- Indexes for table `forms_items`
--
ALTER TABLE `forms_items`
  ADD PRIMARY KEY (`forms_items_sn`);

--
-- Indexes for table `fuel_type`
--
ALTER TABLE `fuel_type`
  ADD PRIMARY KEY (`fuel_type_sn`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`groups_sn`);

--
-- Indexes for table `job_orders`
--
ALTER TABLE `job_orders`
  ADD PRIMARY KEY (`job_orders_sn`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`job_type_sn`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_params`
--
ALTER TABLE `log_params`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_type`
--
ALTER TABLE `log_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`management_sn`);

--
-- Indexes for table `order_jobs_items`
--
ALTER TABLE `order_jobs_items`
  ADD PRIMARY KEY (`order_jobs_items_sn`);

--
-- Indexes for table `order_jobs_services`
--
ALTER TABLE `order_jobs_services`
  ADD PRIMARY KEY (`order_jobs_services_sn`);

--
-- Indexes for table `order_jobs_spares`
--
ALTER TABLE `order_jobs_spares`
  ADD PRIMARY KEY (`order_jobs_spares_sn`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`projects_sn`);

--
-- Indexes for table `project_cars`
--
ALTER TABLE `project_cars`
  ADD PRIMARY KEY (`project_cars_sn`);

--
-- Indexes for table `project_car_types`
--
ALTER TABLE `project_car_types`
  ADD PRIMARY KEY (`project_car_types_sn`);

--
-- Indexes for table `project_roads`
--
ALTER TABLE `project_roads`
  ADD PRIMARY KEY (`project_roads_sn`);

--
-- Indexes for table `puck_up_car`
--
ALTER TABLE `puck_up_car`
  ADD PRIMARY KEY (`puck_up_car_sn`);

--
-- Indexes for table `reminders`
--
ALTER TABLE `reminders`
  ADD PRIMARY KEY (`reminders_sn`);

--
-- Indexes for table `reminders_members`
--
ALTER TABLE `reminders_members`
  ADD PRIMARY KEY (`reminders_members_sn`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`services_sn`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`suppliers_sn`);

--
-- Indexes for table `supply_type`
--
ALTER TABLE `supply_type`
  ADD PRIMARY KEY (`supply_type_sn`);

--
-- Indexes for table `transfer_type`
--
ALTER TABLE `transfer_type`
  ADD PRIMARY KEY (`transfer_type_sn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`users_sn`);

--
-- Indexes for table `wheel_size`
--
ALTER TABLE `wheel_size`
  ADD PRIMARY KEY (`wheel_size_sn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `cars_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car_check`
--
ALTER TABLE `car_check`
  MODIFY `car_check_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_docments`
--
ALTER TABLE `car_docments`
  MODIFY `car_docments_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_expenses`
--
ALTER TABLE `car_expenses`
  MODIFY `car_expenses_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_fuel`
--
ALTER TABLE `car_fuel`
  MODIFY `car_fuel_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_orders`
--
ALTER TABLE `car_orders`
  MODIFY `car_orders_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `car_owner`
--
ALTER TABLE `car_owner`
  MODIFY `car_owner_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `car_status`
--
ALTER TABLE `car_status`
  MODIFY `car_status_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `check_items`
--
ALTER TABLE `check_items`
  MODIFY `check_items_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `company_information`
--
ALTER TABLE `company_information`
  MODIFY `company_information_sn` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `departments_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `expenses_sn` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `forms_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `forms_items`
--
ALTER TABLE `forms_items`
  MODIFY `forms_items_sn` int(3) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fuel_type`
--
ALTER TABLE `fuel_type`
  MODIFY `fuel_type_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `groups_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `job_orders`
--
ALTER TABLE `job_orders`
  MODIFY `job_orders_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `job_type_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT for table `log_params`
--
ALTER TABLE `log_params`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1578;

--
-- AUTO_INCREMENT for table `log_type`
--
ALTER TABLE `log_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `management_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `order_jobs_items`
--
ALTER TABLE `order_jobs_items`
  MODIFY `order_jobs_items_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_jobs_services`
--
ALTER TABLE `order_jobs_services`
  MODIFY `order_jobs_services_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_jobs_spares`
--
ALTER TABLE `order_jobs_spares`
  MODIFY `order_jobs_spares_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `projects_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `project_cars`
--
ALTER TABLE `project_cars`
  MODIFY `project_cars_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_car_types`
--
ALTER TABLE `project_car_types`
  MODIFY `project_car_types_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `project_roads`
--
ALTER TABLE `project_roads`
  MODIFY `project_roads_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `puck_up_car`
--
ALTER TABLE `puck_up_car`
  MODIFY `puck_up_car_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders`
--
ALTER TABLE `reminders`
  MODIFY `reminders_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminders_members`
--
ALTER TABLE `reminders_members`
  MODIFY `reminders_members_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `services_sn` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `suppliers_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `supply_type`
--
ALTER TABLE `supply_type`
  MODIFY `supply_type_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transfer_type`
--
ALTER TABLE `transfer_type`
  MODIFY `transfer_type_sn` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `users_sn` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=192;

--
-- AUTO_INCREMENT for table `wheel_size`
--
ALTER TABLE `wheel_size`
  MODIFY `wheel_size_sn` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
