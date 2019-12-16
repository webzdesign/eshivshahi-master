-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 16, 2019 at 12:02 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eshivhlh_transport_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `accesstypes`
--

CREATE TABLE `accesstypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `accesstypes`
--

INSERT INTO `accesstypes` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Vendor', NULL, NULL, '2018-08-30 14:19:07', '2018-08-30 15:05:57', NULL),
(2, 'Division', NULL, NULL, '2018-08-31 12:50:54', '2018-09-12 09:16:59', NULL),
(3, 'Depot', NULL, NULL, '2018-08-31 12:50:28', '2018-08-31 12:50:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `allowusers`
--

CREATE TABLE `allowusers` (
  `id` int(10) UNSIGNED NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL,
  `accesstype_id` int(10) UNSIGNED NOT NULL,
  `no_of_users` int(10) UNSIGNED NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `allowusers`
--

INSERT INTO `allowusers` (`id`, `usertype_id`, `accesstype_id`, `no_of_users`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 1, 1, 0, 1, '2018-09-10 16:46:40', '2018-09-14 23:26:18', NULL),
(2, 3, 1, 3, 0, NULL, '2018-09-10 16:46:53', '2018-09-10 16:46:53', NULL),
(3, 8, 3, 1, 0, 1, '2018-09-10 16:47:13', '2019-01-02 12:31:03', NULL),
(4, 9, 3, 1, 0, 1, '2018-09-10 16:47:49', '2019-01-02 12:31:13', NULL),
(5, 7, 3, 1, 0, NULL, '2018-09-10 16:48:05', '2018-09-10 16:48:05', NULL),
(6, 6, 3, 1, 0, NULL, '2018-09-10 16:48:20', '2018-09-10 16:48:20', NULL),
(7, 5, 2, 1, 0, NULL, '2018-09-10 16:48:47', '2018-09-10 16:48:47', NULL),
(8, 4, 2, 1, 0, NULL, '2018-09-10 16:49:02', '2018-09-10 16:49:02', NULL),
(9, 10, 2, 1, 0, NULL, '2018-09-10 16:49:25', '2018-09-10 16:49:25', NULL),
(11, 36, 2, 2, 0, 0, NULL, '2018-09-12 09:57:10', NULL),
(13, 38, 3, 1, 1, NULL, NULL, NULL, NULL),
(14, 0, 0, 2, 1, NULL, '2018-12-28 11:54:25', '2018-12-28 11:54:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billsummaries`
--

CREATE TABLE `billsummaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `bill_no` int(11) DEFAULT NULL,
  `parisishtha_a_id` int(10) UNSIGNED NOT NULL,
  `parisishtha_b_id` int(11) UNSIGNED NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `depot_id` int(11) DEFAULT NULL,
  `billing_period` longtext COLLATE utf8mb4_unicode_ci,
  `gov_voucher_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `route_id` int(11) DEFAULT NULL,
  `vehicle_id` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_id` int(11) DEFAULT NULL,
  `vendorinvoice_id` int(10) UNSIGNED DEFAULT NULL,
  `vendor_invoice_amt` double(10,2) DEFAULT NULL,
  `gov_approve_amt` double(10,2) DEFAULT NULL,
  `vendor_deduction_amt` double(10,2) DEFAULT NULL,
  `final_payable_amt` double(10,2) DEFAULT NULL,
  `other_deduction` double DEFAULT NULL,
  `other_deduction_remark` longtext COLLATE utf8mb4_unicode_ci,
  `per_deduction` double DEFAULT NULL,
  `per_deduction_remark` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_deduction` double NOT NULL DEFAULT '0',
  `vendor_reimbursement` double NOT NULL DEFAULT '0',
  `prev_deduction` double DEFAULT NULL,
  `prev_deduction_remark` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_previous_deduction_remarks` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_reimbursement_remark` longtext COLLATE utf8mb4_unicode_ci,
  `tds` float(10,2) DEFAULT NULL,
  `amount_after_tds` float(10,2) DEFAULT NULL,
  `vendor_confirm` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `update_status` tinyint(1) NOT NULL DEFAULT '0',
  `update_status_division` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `billsummaries`
--

INSERT INTO `billsummaries` (`id`, `bill_no`, `parisishtha_a_id`, `parisishtha_b_id`, `division_id`, `depot_id`, `billing_period`, `gov_voucher_no`, `route_id`, `vehicle_id`, `vendor_id`, `vendorinvoice_id`, `vendor_invoice_amt`, `gov_approve_amt`, `vendor_deduction_amt`, `final_payable_amt`, `other_deduction`, `other_deduction_remark`, `per_deduction`, `per_deduction_remark`, `vendor_deduction`, `vendor_reimbursement`, `prev_deduction`, `prev_deduction_remark`, `vendor_previous_deduction_remarks`, `vendor_reimbursement_remark`, `tds`, `amount_after_tds`, `vendor_confirm`, `status`, `delete_status`, `update_status`, `update_status_division`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 15, 29, '2019-11-01,2019-11-15', 'STest1', 60, '22*++*22*++*27*++*25*++*24*++*23*++*24*++*22*++*24*++*27*++*25*++*24*++*23*++*24*++*23', 2, 1, 114103.14, 89822.50, 61356.64, 28465.86, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, -146285.00, 1, 1, 0, 0, 0, 11, NULL, '2019-12-13 05:14:54', '2019-12-13 05:19:16'),
(2, 1, 3, 3, 15, 29, '2019-11-01,2019-11-15', 'STest3', 61, '22*++*23*++*23*++*22*++*26*++*25*++*23*++*23*++*23*++*26*++*26*++*23*++*22*++*26*++*26', 2, 2, 87798.76, 128551.50, 14802.36, 113749.14, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, -146285.00, 1, 1, 0, 0, 0, 11, NULL, '2019-12-13 05:14:54', '2019-12-16 10:59:45'),
(3, 1, 5, 5, 15, 29, '2019-11-01,2019-11-15', 'STest5', 62, 'noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', 2, 3, 114221.14, 0.00, 288500.00, -288500.00, NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, -146285.00, 1, 1, 0, 0, 0, 11, NULL, '2019-12-13 05:14:54', '2019-12-16 10:08:55'),
(4, 2, 2, 2, 15, 29, '2019-11-16,2019-11-30', 'STest2', 60, '22*++*22*++*25*++*23*++*23*++*26*++*23*++*23*++*23*++*25*++*24*++*24*++*24*++*23*++*22', 2, NULL, NULL, 103369.50, 24192.94, 79176.56, NULL, NULL, NULL, NULL, 146285, 0, NULL, NULL, NULL, NULL, NULL, -170410.80, 1, 1, 0, 0, 0, 11, NULL, '2019-12-13 05:18:27', '2019-12-13 05:19:12'),
(5, 2, 4, 4, 15, 29, '2019-11-16,2019-11-30', 'STest4', 61, 'noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', 2, NULL, NULL, 0.00, 88500.00, -88500.00, NULL, NULL, NULL, NULL, 146285, 0, NULL, NULL, NULL, NULL, NULL, -170410.80, 1, 1, 0, 0, 0, 11, NULL, '2019-12-13 05:18:27', '2019-12-13 05:19:12'),
(6, 2, 6, 6, 15, 29, '2019-11-16,2019-11-30', 'STest6', 62, '22*++*23*++*23*++*22*++*26*++*23*++*23*++*23*++*22*++*23*++*24*++*25*++*25*++*25*++*25', 2, NULL, NULL, 0.00, 14802.36, -14802.36, NULL, NULL, NULL, NULL, 146285, 0, NULL, NULL, NULL, NULL, NULL, -170410.80, 1, 1, 0, 0, 0, 11, NULL, '2019-12-13 05:18:27', '2019-12-13 05:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `billsummary_confirm`
--

CREATE TABLE `billsummary_confirm` (
  `id` int(11) UNSIGNED NOT NULL,
  `depot_id` int(11) DEFAULT NULL,
  `division_id` int(11) DEFAULT NULL,
  `billsummary_id` int(11) UNSIGNED NOT NULL,
  `usertype_id` int(11) UNSIGNED NOT NULL,
  `sequence` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `confirm_by` int(11) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `query` longtext,
  `queryraised_at` timestamp NULL DEFAULT NULL,
  `query_status` int(11) DEFAULT NULL COMMENT 'queryraised = 1, resolved =2	'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billsummary_confirm`
--

INSERT INTO `billsummary_confirm` (`id`, `depot_id`, `division_id`, `billsummary_id`, `usertype_id`, `sequence`, `confirm_by`, `created_at`, `updated_at`, `user_id`, `query`, `queryraised_at`, `query_status`) VALUES
(1, 29, 15, 1, 7, 1, 0, '2019-12-13 05:14:54', '2019-12-13 05:14:54', NULL, NULL, NULL, NULL),
(2, 29, 15, 1, 38, 2, 0, '2019-12-13 05:14:55', '2019-12-13 05:14:55', NULL, NULL, NULL, NULL),
(3, 29, 15, 1, 6, 3, 0, '2019-12-13 05:14:55', '2019-12-13 05:14:55', NULL, NULL, NULL, NULL),
(4, 29, 15, 1, 5, 4, 0, '2019-12-13 05:14:56', '2019-12-13 05:14:56', NULL, NULL, NULL, NULL),
(5, 29, 15, 1, 4, 5, 0, '2019-12-13 05:14:57', '2019-12-13 05:14:57', NULL, NULL, NULL, NULL),
(6, 29, 15, 1, 10, 6, 0, '2019-12-13 05:14:57', '2019-12-13 05:14:57', NULL, NULL, NULL, NULL),
(7, 29, 15, 2, 7, 1, 0, '2019-12-13 05:18:27', '2019-12-13 05:18:27', NULL, NULL, NULL, NULL),
(8, 29, 15, 2, 38, 2, 0, '2019-12-13 05:18:27', '2019-12-13 05:18:27', NULL, NULL, NULL, NULL),
(9, 29, 15, 2, 6, 3, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28', NULL, NULL, NULL, NULL),
(10, 29, 15, 2, 5, 4, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28', NULL, NULL, NULL, NULL),
(11, 29, 15, 2, 4, 5, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28', NULL, NULL, NULL, NULL),
(12, 29, 15, 2, 10, 6, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billsummary_log`
--

CREATE TABLE `billsummary_log` (
  `id` int(11) NOT NULL,
  `billsummary_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billsummary_log`
--

INSERT INTO `billsummary_log` (`id`, `billsummary_id`, `user_id`, `updated_at`) VALUES
(1, 2, 11, '2019-12-13 05:19:13'),
(2, 1, 11, '2019-12-13 05:19:16');

-- --------------------------------------------------------

--
-- Table structure for table `billsummary_view`
--

CREATE TABLE `billsummary_view` (
  `id` int(11) UNSIGNED NOT NULL,
  `billsummary_id` int(11) UNSIGNED NOT NULL,
  `usertype_id` int(11) UNSIGNED NOT NULL,
  `parisishthaa_id` tinyint(1) NOT NULL DEFAULT '0',
  `parisishthab_id` tinyint(1) NOT NULL DEFAULT '0',
  `vendorinvoiceid` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `billsummary_view`
--

INSERT INTO `billsummary_view` (`id`, `billsummary_id`, `usertype_id`, `parisishthaa_id`, `parisishthab_id`, `vendorinvoiceid`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 0, 0, 0, '2019-12-13 05:14:55', '2019-12-13 05:14:55'),
(2, 1, 38, 0, 0, 0, '2019-12-13 05:14:55', '2019-12-13 05:14:55'),
(3, 1, 6, 0, 0, 0, '2019-12-13 05:14:55', '2019-12-13 05:14:55'),
(4, 1, 5, 0, 0, 0, '2019-12-13 05:14:57', '2019-12-13 05:14:57'),
(5, 1, 4, 0, 0, 0, '2019-12-13 05:14:57', '2019-12-13 05:14:57'),
(6, 1, 10, 0, 0, 0, '2019-12-13 05:14:57', '2019-12-13 05:14:57'),
(7, 2, 7, 0, 0, 0, '2019-12-13 05:18:27', '2019-12-13 05:18:27'),
(8, 2, 38, 0, 0, 0, '2019-12-13 05:18:27', '2019-12-13 05:18:27'),
(9, 2, 6, 0, 0, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28'),
(10, 2, 5, 0, 0, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28'),
(11, 2, 4, 0, 0, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28'),
(12, 2, 10, 0, 0, 0, '2019-12-13 05:18:28', '2019-12-13 05:18:28'),
(13, 4, 7, 0, 0, 0, '2019-12-13 05:19:12', '2019-12-13 05:19:12'),
(14, 4, 38, 0, 0, 0, '2019-12-13 05:19:12', '2019-12-13 05:19:12'),
(15, 4, 6, 0, 0, 0, '2019-12-13 05:19:12', '2019-12-13 05:19:12'),
(16, 4, 5, 0, 0, 0, '2019-12-13 05:19:12', '2019-12-13 05:19:12'),
(17, 4, 4, 0, 0, 0, '2019-12-13 05:19:12', '2019-12-13 05:19:12'),
(18, 4, 10, 0, 0, 0, '2019-12-13 05:19:12', '2019-12-13 05:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE `charges` (
  `id` int(11) NOT NULL,
  `diesel_rate` varchar(255) NOT NULL,
  `vor_charges` longtext NOT NULL,
  `washing_charges` longtext NOT NULL,
  `parking_charges` longtext NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `diesel_rate`, `vor_charges`, `washing_charges`, `parking_charges`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, '59.3', '0,2950,5900', '0,156', '0,118', NULL, '2019-06-14 20:34:05', '2019-12-04 23:26:55');

-- --------------------------------------------------------

--
-- Table structure for table `city_masters`
--

CREATE TABLE `city_masters` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `companydetails`
--

CREATE TABLE `companydetails` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companydetails`
--

INSERT INTO `companydetails` (`id`, `name`) VALUES
(1, 'eShivshahi');

-- --------------------------------------------------------

--
-- Table structure for table `depots`
--

CREATE TABLE `depots` (
  `id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `depots`
--

INSERT INTO `depots` (`id`, `division_id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 1, 'Beed', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(2, 1, 'Parli', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(3, 2, 'Shegaon', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(4, 2, 'Malkapur', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(5, 3, 'Jalgaon', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(6, 4, 'Jalna', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(7, 4, 'Jafrabad', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(8, 5, 'Gargoti', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(9, 5, 'Chandgad', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(10, 5, 'Aajra', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(11, 5, 'Kolhapur', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(12, 5, 'Sambhaji Nagar', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(13, 6, 'Udgir', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(14, 6, 'Nilanga', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(15, 6, 'Latur', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(16, 7, 'Nagpur', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(17, 8, 'Nanded', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(18, 9, 'Nashik', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(19, 10, 'Nandurbar', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(20, 11, 'Omerga', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(21, 11, 'Osmanabad', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(22, 12, 'Parbhani', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(23, 12, 'Gangakhed', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(24, 13, 'Mahad', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(25, 13, 'Shirvardhan', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(26, 13, 'Murud', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(27, 14, 'Guhagar', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(28, 14, 'Ratnagiri', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(29, 15, 'Satara', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(30, 16, 'Barshi', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(31, 16, 'Akkalkot', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(32, 16, 'Solapur', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(33, 17, 'Borivali', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(34, 17, 'Kalyan', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(35, 18, 'Yavatmal', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(36, 19, 'Shivajinagar', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(37, 19, 'Chinchwad', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(38, 20, 'Alibagh', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(39, 23, 'Mumbai Central', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45'),
(40, 5, 'Ichalkaranji', NULL, NULL, NULL),
(41, 22, 'Ahmedabad', NULL, NULL, NULL),
(42, 17, 'Thane I', NULL, NULL, '2019-05-15 23:36:13'),
(43, 23, 'Kurla', NULL, NULL, NULL),
(44, 24, 'Panji', NULL, NULL, NULL),
(45, 25, 'Boisar', NULL, NULL, NULL),
(46, 19, 'Swargate', NULL, NULL, NULL),
(47, 23, 'Parel', NULL, NULL, NULL),
(48, 26, 'Tarakpur', NULL, NULL, NULL),
(49, 19, 'Nigdi', NULL, '2019-01-06 22:20:41', '2019-01-06 22:20:41'),
(50, 19, 'Vallabhnagar', NULL, '2019-01-06 22:36:18', '2019-01-06 22:36:18'),
(51, 17, 'Thane II', NULL, '2019-01-15 15:25:31', '2019-01-15 15:25:31'),
(52, 27, 'Akola', NULL, '2019-01-16 16:50:24', '2019-01-16 16:50:24'),
(53, 16, 'Pandharpur', NULL, '2019-02-04 16:24:22', '2019-02-04 16:24:22'),
(54, 28, 'Aurangabad CIDCO', NULL, '2019-02-04 16:24:48', '2019-05-31 13:05:59'),
(55, 2, 'Mehkar', NULL, '2019-02-04 16:25:16', '2019-02-04 16:25:16'),
(56, 26, 'Shirdi', NULL, '2019-02-04 16:26:59', '2019-02-04 16:26:59'),
(57, 15, 'Karad', NULL, '2019-02-09 15:37:11', '2019-02-09 15:37:11'),
(58, 10, 'Dhule', NULL, '2019-02-28 11:34:18', '2019-02-28 11:34:18'),
(59, 29, 'Gadchiroli', NULL, '2019-03-15 11:17:28', '2019-03-15 11:17:28'),
(60, 30, 'Sangli', NULL, '2019-03-18 14:12:28', '2019-03-18 14:12:28'),
(61, 31, 'Malvan', NULL, '2019-03-27 10:56:47', '2019-03-27 10:56:47'),
(62, 31, 'Sawantwadi', NULL, '2019-04-26 01:18:58', '2019-04-26 01:18:58'),
(63, 5, 'Kurundwad', NULL, '2019-04-26 01:28:04', '2019-04-26 01:28:04'),
(64, 26, 'Shevgaon', NULL, '2019-04-26 01:31:59', '2019-04-26 01:31:59'),
(65, 26, 'Ahmednagar', NULL, '2019-04-26 01:36:13', '2019-04-26 01:36:13'),
(66, 9, 'Satana', NULL, '2019-04-26 01:49:20', '2019-04-26 01:49:20'),
(67, 10, 'Shahada', NULL, '2019-04-26 01:54:40', '2019-04-26 01:54:40'),
(68, 6, 'Ahmadpur', NULL, '2019-04-26 02:10:43', '2019-04-26 02:10:43'),
(69, 32, 'Amravati', NULL, '2019-04-26 02:20:01', '2019-04-26 02:20:01'),
(70, 19, 'Baramati', NULL, '2019-04-26 02:24:29', '2019-04-26 02:24:29'),
(71, 6, 'Ausa', NULL, '2019-04-26 02:27:30', '2019-04-26 02:27:30'),
(72, 32, 'Paratwada', NULL, '2019-04-29 18:06:41', '2019-04-29 18:06:41'),
(73, 32, 'Daryapur', NULL, '2019-04-29 18:06:59', '2019-04-29 18:06:59'),
(74, 28, 'Paithan', NULL, '2019-04-29 18:07:19', '2019-04-29 18:07:19'),
(75, 26, 'Shrirampur', NULL, '2019-04-29 18:07:56', '2019-04-29 18:07:56'),
(76, 26, 'Kopargaon', NULL, '2019-04-29 18:08:15', '2019-04-29 18:08:15'),
(77, 26, 'Jamkhed', NULL, '2019-04-29 18:08:35', '2019-04-29 18:08:35'),
(78, 10, 'Shirpur', NULL, '2019-04-29 18:09:06', '2019-04-29 18:09:06'),
(79, 8, 'Deglur', NULL, '2019-04-29 18:10:02', '2019-04-29 18:10:02'),
(80, 8, 'Biloli', NULL, '2019-04-29 18:10:16', '2019-04-29 18:10:16'),
(81, 4, 'Ambad', NULL, '2019-04-29 18:11:25', '2019-04-29 18:11:25'),
(82, 3, 'Pachora', NULL, '2019-04-29 18:14:18', '2019-04-29 18:14:18'),
(83, 3, 'Chalisgaon', NULL, '2019-04-29 18:14:31', '2019-04-29 18:14:31'),
(84, 3, 'Chopda', NULL, '2019-04-29 18:14:40', '2019-04-29 18:14:40'),
(85, 33, 'Bhandara', NULL, '2019-04-29 18:15:21', '2019-04-29 18:15:21'),
(86, 33, 'Tumsar', NULL, '2019-04-29 18:15:34', '2019-04-29 18:15:34'),
(87, 14, 'Dapoli', NULL, '2019-04-29 18:18:59', '2019-04-29 18:18:59'),
(88, 14, 'Chiplun', NULL, '2019-04-29 18:19:10', '2019-04-29 18:19:10'),
(89, 14, 'Khed', NULL, '2019-04-29 18:19:19', '2019-04-29 18:19:19'),
(90, 13, 'Alibag', NULL, '2019-04-29 18:19:42', '2019-04-29 18:19:42'),
(91, 13, 'Roha', NULL, '2019-04-29 18:19:52', '2019-04-29 18:19:52'),
(92, 31, 'Vengurla', NULL, '2019-04-29 18:21:22', '2019-04-29 18:21:22'),
(93, 31, 'Sindhudurg', NULL, '2019-04-29 18:21:49', '2019-04-29 18:21:49'),
(94, 31, 'Kudal', NULL, '2019-04-29 18:22:10', '2019-04-29 18:22:10'),
(95, 29, 'Aheri', NULL, '2019-04-29 18:23:21', '2019-04-29 18:23:21'),
(96, 15, 'Mahabaleshwar', NULL, '2019-04-29 18:24:29', '2019-04-29 18:24:29'),
(97, 30, 'Vita', NULL, '2019-04-29 18:24:54', '2019-04-29 18:24:54'),
(98, 30, 'Miraj', NULL, '2019-04-29 18:25:09', '2019-04-29 18:25:09'),
(99, 1, 'Ambejogai', NULL, '2019-04-29 18:26:33', '2019-04-29 18:26:33'),
(100, 1, 'Gevrai', NULL, '2019-04-29 18:26:58', '2019-04-29 18:26:58'),
(101, 1, 'Mazalgaon', NULL, '2019-04-29 18:27:18', '2019-04-29 18:27:18'),
(102, 2, 'Chikhali', NULL, '2019-04-29 18:28:52', '2019-04-29 18:28:52'),
(103, 34, 'Chandrapur', NULL, '2019-04-29 18:30:54', '2019-04-29 18:30:54'),
(104, 28, 'Aurangabad CBS', NULL, '2019-05-15 22:41:05', '2019-05-31 13:06:18'),
(105, 13, 'Shrivardhan', NULL, '2019-05-16 00:04:03', '2019-05-16 00:04:03'),
(106, 18, 'Wani', NULL, '2019-05-16 00:04:56', '2019-05-16 00:04:56'),
(107, 18, 'Pandharkavada', NULL, '2019-05-16 00:05:40', '2019-05-16 00:05:40'),
(108, 7, 'Ganeshpeth', NULL, '2019-05-16 00:06:29', '2019-05-16 00:06:29'),
(109, 7, 'Ghatroad', NULL, '2019-05-16 00:06:43', '2019-05-16 00:06:43'),
(110, 7, 'Imamwada', NULL, '2019-05-16 00:06:58', '2019-05-16 00:06:58'),
(111, 7, 'Katol', NULL, '2019-05-16 00:07:13', '2019-05-16 00:07:13'),
(112, 3, 'Raver', NULL, '2019-05-16 00:07:40', '2019-05-16 00:07:40'),
(113, 28, 'Aurangabad', NULL, '2019-05-22 11:19:16', '2019-05-22 11:19:16'),
(114, 2, 'Buldhana', NULL, '2019-05-31 13:16:39', '2019-05-31 13:16:39'),
(115, 19, 'Pune', NULL, '2019-05-31 13:55:53', '2019-05-31 13:55:53'),
(116, 35, 'Hyderabad', NULL, '2019-06-11 23:43:50', '2019-06-11 23:43:50'),
(117, 27, 'Washim', NULL, '2019-06-14 23:16:08', '2019-06-14 23:16:08'),
(118, 36, 'Adilabad', NULL, '2019-06-14 23:17:19', '2019-06-14 23:17:19'),
(119, 27, 'Akot', NULL, '2019-06-14 23:20:14', '2019-06-14 23:20:14'),
(120, 18, 'Pusad', NULL, '2019-06-14 23:23:08', '2019-06-14 23:23:08'),
(121, 9, 'Trimbakeshwar', NULL, '2019-07-01 22:41:40', '2019-07-01 22:41:40'),
(122, 37, 'Bangalore', NULL, '2019-07-01 22:44:42', '2019-07-01 22:44:42'),
(123, 11, 'Tuljapur', NULL, '2019-07-01 23:54:26', '2019-07-01 23:54:26'),
(124, 38, 'Indore', NULL, '2019-07-03 01:05:10', '2019-07-03 01:05:10'),
(125, 39, 'Bijapur', NULL, '2019-07-03 16:07:26', '2019-07-03 16:07:26'),
(126, 25, 'Palghar', NULL, '2019-07-26 16:05:13', '2019-07-26 16:05:13'),
(127, 17, 'Thane', NULL, '2019-07-27 17:55:46', '2019-07-27 17:55:46');

-- --------------------------------------------------------

--
-- Table structure for table `divisions`
--

CREATE TABLE `divisions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `divisions`
--

INSERT INTO `divisions` (`id`, `name`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Beed', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(2, 'Buldhana', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(3, 'Jalgaon', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(4, 'Jalna', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(5, 'Kolhapur', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(6, 'Latur', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(7, 'Nagpur', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(8, 'Nanded', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(9, 'Nashik', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(10, 'Dhule', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(11, 'Osmandabad', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(12, 'Parbhani', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(13, 'Raigad', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(14, 'Ratnagiri', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(15, 'Satara', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(16, 'Solapur', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(17, 'Thane', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(18, 'Yavatmal', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(19, 'Pune', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(20, 'Alibagh', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45'),
(22, 'Ahmedabad', NULL, NULL, NULL),
(23, 'Mumbai', NULL, NULL, '2019-07-15 12:43:20'),
(24, 'Panji', NULL, NULL, NULL),
(25, 'Palghar', NULL, NULL, NULL),
(26, 'Ahmednagar', NULL, NULL, NULL),
(27, 'Akola', NULL, '2019-01-16 16:49:56', '2019-01-16 16:49:56'),
(28, 'Aurangabad', NULL, '2019-02-04 15:58:41', '2019-02-04 15:58:41'),
(29, 'Gadchiroli', NULL, '2019-03-15 11:17:00', '2019-03-15 11:17:00'),
(30, 'Sangli', NULL, '2019-03-18 14:12:09', '2019-03-18 14:12:09'),
(31, 'Sindhudurg', NULL, '2019-03-27 10:56:30', '2019-03-27 10:56:30'),
(32, 'Amravati', NULL, '2019-04-26 02:19:48', '2019-04-26 02:19:48'),
(33, 'Bhandara', NULL, '2019-04-29 18:15:02', '2019-04-29 18:15:02'),
(34, 'Chandrapur', NULL, '2019-04-29 18:30:42', '2019-04-29 18:30:42'),
(35, 'Hyderabad', NULL, '2019-06-11 23:43:33', '2019-06-11 23:43:33'),
(36, 'Adilabad', NULL, '2019-06-14 23:17:03', '2019-06-14 23:17:03'),
(37, 'Bangalore', NULL, '2019-07-01 22:44:28', '2019-07-01 22:44:28'),
(38, 'Indore', NULL, '2019-07-03 01:04:58', '2019-07-03 01:04:58'),
(39, 'Bijapur', NULL, '2019-07-03 16:07:12', '2019-07-03 16:07:12');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2018_08_22_102709_create_divisions_table', 1),
(4, '2018_08_22_104043_create_depots_table', 1),
(5, '2018_08_23_070213_create_usertypes_table', 1),
(6, '2018_08_23_070932_create_accesstypes_table', 1),
(7, '2018_08_23_071729_create_allowusers_table', 1),
(8, '2018_08_23_074600_create_permissions_table', 1),
(9, '2018_08_23_075836_create_vendors_table', 1),
(10, '2018_08_23_081142_create_vendor_accountants_table', 1),
(11, '2018_08_23_081443_create_vehicles_table', 1),
(12, '2018_08_23_083018_create_vendorinvoices_table', 1),
(13, '2018_08_23_101441_create_parisishtha_bs_table', 1),
(14, '2018_08_23_110647_create_parisishtha_as_table', 1),
(15, '2018_08_23_112255_create_billsummaries_table', 1),
(16, '2018_08_23_113147_create_module_hierarchies_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_name` varchar(191) NOT NULL,
  `display_name` varchar(191) NOT NULL,
  `display_sequence` int(11) NOT NULL,
  `routes` varchar(191) NOT NULL,
  `icon` varchar(191) NOT NULL,
  `is_master` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `display_name`, `display_sequence`, `routes`, `icon`, `is_master`) VALUES
(1, 'Divisions', 'Divisions', 1, 'division', 'fa fa-bars', 1),
(2, 'Depots', 'Depots', 2, 'depot', 'fa fa-institution', 1),
(4, 'User Types', 'User Types', 4, 'usertype', 'fa fa-users', 1),
(3, 'Access Type', 'Access Type', 3, 'accesstype', 'fa fa-tasks', 1),
(5, 'Allow User Logins', 'Allow User Logins', 5, 'allowuser', 'fa fa-check', 1),
(6, 'User Master', 'User Master', 6, 'user', 'fa fa-user', 1),
(8, 'Vendor Manager', 'Vendor Manager', 10, 'vendormanager', 'fa fa-user', 0),
(7, 'Vendor', 'Vendor', 9, 'vendordetail', 'fa fa-bank', 0),
(9, 'Vendor Accountant', 'Vendor Accountant', 11, 'vendoraccountant', 'fa fa-user', 0),
(10, 'Vehicle Master', 'Vehicle Master', 12, 'vehicle', 'fa fa-cab', 1),
(11, 'Vendor Invoice', 'Vendor Invoice', 13, 'vendorinvoice', 'fa fa-minus-square', 0),
(12, 'Parisishtha B', 'Parisishtha B', 14, 'parisishthab', 'fa fa-delicious', 0),
(13, 'Parisishtha A', 'Parisishtha A', 15, 'parisishthaa', 'fa fa-square', 0),
(14, 'Bill Summary', 'Bill Summary', 16, 'billsummary', 'fa fa-print', 0),
(15, 'Parisishtha B Invoice\r\n', 'Parisishtha B Voucher\r\n', 17, 'parisishthabinvoice', 'fa fa-th-large', 0),
(18, 'Permission\r\n', 'Permission', 7, 'permission', 'fa fa-key', 1),
(16, 'Set Hierarchy\r\n', 'Set Hierarchy', 8, 'hierarchy', 'fa fa-exchange', 1),
(43, 'Bill Summary Confirm\r\n', 'Bill Summary Confirm', 19, 'billsummaryconfirm', 'fa fa-check', 0),
(44, 'Bill Summary Confirm\r\n', 'Bill Summary Confirm', 19, 'billsummarymanagerconfirm', 'fa fa-check', 0),
(45, 'Rate Master\r\n', 'Rate Master', 7, 'ratemaster', 'fa fa-money', 1),
(46, 'Route Master\r\n', 'Route Master', 7, 'routemaster', 'fa fa-ils', 1),
(48, 'Rate/Charges', 'Rate/Charges', 12, 'charges', 'fa fa-money', 1),
(49, 'Query', 'Query', 50, 'query', 'fa fa-question', 0);

-- --------------------------------------------------------

--
-- Table structure for table `module_hierarchies`
--

CREATE TABLE `module_hierarchies` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL,
  `hierarchy_sequence` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `module_hierarchies`
--

INSERT INTO `module_hierarchies` (`id`, `module_id`, `usertype_id`, `hierarchy_sequence`) VALUES
(14, 14, 4, 5),
(13, 14, 5, 4),
(12, 14, 6, 3),
(11, 14, 38, 2),
(10, 14, 7, 1),
(15, 14, 10, 6);

-- --------------------------------------------------------

--
-- Table structure for table `parisishtha_as`
--

CREATE TABLE `parisishtha_as` (
  `id` int(10) UNSIGNED NOT NULL,
  `parisishtha_b_id` int(10) UNSIGNED NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `depot_id` int(10) UNSIGNED DEFAULT NULL,
  `billing_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `vendorinvoice_id` int(10) UNSIGNED DEFAULT NULL,
  `voucher_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_date` date NOT NULL,
  `route_id` int(11) UNSIGNED DEFAULT NULL,
  `vehicle_id` longtext COLLATE utf8mb4_unicode_ci,
  `total_kms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_kms` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `per_km_rate` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `avg_km_as_per_contract` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avg_km_total_as_per_contract` double DEFAULT NULL,
  `rate_for_avg_km` double DEFAULT NULL,
  `amount_for_avg_km` double DEFAULT NULL,
  `total_amount_for_avg` double DEFAULT NULL,
  `diesel_amt` double DEFAULT NULL,
  `diesel_rate` double DEFAULT NULL,
  `diesel_amount` double DEFAULT NULL,
  `diesel_final_amount` double DEFAULT NULL,
  `amountWoDeduct` double DEFAULT NULL,
  `extra_diesel_amt` double DEFAULT NULL,
  `adblue_charge` double DEFAULT NULL,
  `vehical_exp` double DEFAULT NULL,
  `vor_exp` double DEFAULT NULL,
  `parking_charge` double DEFAULT NULL,
  `hault_tax` double DEFAULT NULL,
  `wash_exp` longtext COLLATE utf8mb4_unicode_ci,
  `other_exp` double DEFAULT NULL,
  `total_tax` double DEFAULT NULL,
  `amount_payable` double DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `delete_status` tinyint(1) NOT NULL DEFAULT '0',
  `update_status` tinyint(1) NOT NULL DEFAULT '0',
  `update_status_division` tinyint(1) DEFAULT '0',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0',
  `diesel_saving` double NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parisishtha_as`
--

INSERT INTO `parisishtha_as` (`id`, `parisishtha_b_id`, `division_id`, `depot_id`, `billing_period`, `vendor_id`, `vendorinvoice_id`, `voucher_no`, `voucher_date`, `route_id`, `vehicle_id`, `total_kms`, `avg_kms`, `per_km_rate`, `amount`, `total_amount`, `avg_km_as_per_contract`, `avg_km_total_as_per_contract`, `rate_for_avg_km`, `amount_for_avg_km`, `total_amount_for_avg`, `diesel_amt`, `diesel_rate`, `diesel_amount`, `diesel_final_amount`, `amountWoDeduct`, `extra_diesel_amt`, `adblue_charge`, `vehical_exp`, `vor_exp`, `parking_charge`, `hault_tax`, `wash_exp`, `other_exp`, `total_tax`, `amount_payable`, `status`, `delete_status`, `update_status`, `update_status_division`, `pay_status`, `diesel_saving`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 15, 29, '2019-11-01,2019-11-15', 2, 1, 'STest1', '2019-12-13', 60, '22*++*22*++*27*++*25*++*24*++*23*++*24*++*22*++*24*++*27*++*25*++*24*++*23*++*24*++*23', '5890', '589.00', '15.250', 89822.5, 89822.5, '0', 0, 0, 0, 0, 0, 0, 0, 0, 89822.5, 24326.64, 0, 10000, 23600, 1770, 0, '1560', 100, 61356.64, 28465.86, 1, 0, 1, 0, 1, 0, 181, NULL, '2019-12-12 15:13:06', '2019-12-13 05:14:54', NULL),
(2, 2, 15, 29, '2019-11-16,2019-11-30', 2, NULL, 'STest2', '2019-12-12', 60, '22*++*22*++*25*++*23*++*23*++*26*++*23*++*23*++*23*++*25*++*24*++*24*++*24*++*23*++*22', '5890', '471.20', '16.400', 96596, 96596, '5890.00', 0, 1.15, 6773.5, 6773.5, 0, 0, 0, 0, 103369.5, 23792.94, 400, 0, 0, 0, 0, '0', 0, 24192.94, 79176.56, 1, 0, 0, 0, 1, 0, 34, NULL, '2019-12-12 15:13:42', '2019-12-13 05:18:27', NULL),
(3, 3, 15, 29, '2019-11-01,2019-11-15', 2, 2, 'STest3', '2019-12-12', 61, '22*++*23*++*23*++*22*++*26*++*25*++*23*++*23*++*23*++*26*++*26*++*23*++*22*++*26*++*26', '8085', '539.00', '15.900', 128551.5, 128551.5, '0', 0, 0, 0, 0, 0, 0, 0, 0, 128551.5, 13032.36, 0, 0, 0, 1770, 0, '0', 0, 14802.36, 113749.14, 1, 0, 1, 0, 1, 0, 34, NULL, '2019-12-12 15:20:36', '2019-12-16 10:59:45', NULL),
(4, 4, 15, 29, '2019-11-16,2019-11-30', 2, NULL, 'STest4', '2019-12-12', 61, 'noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', '0', '0.00', '0', 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 88500, 0, 0, '0', 0, 88500, -88500, 1, 0, 0, 0, 1, 0, 34, NULL, '2019-12-12 15:20:49', '2019-12-13 05:18:27', NULL),
(5, 5, 15, 29, '2019-11-01,2019-11-15', 2, 3, 'STest5', '2019-12-12', 62, 'noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', '0', '0.00', '0', 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 88500, 0, 0, '0', 200000, 288500, -288500, 1, 0, 1, 0, 1, 0, 34, NULL, '2019-12-12 15:31:44', '2019-12-16 10:08:55', NULL),
(6, 6, 15, 29, '2019-11-16,2019-11-30', 2, NULL, 'STest6', '2019-12-12', 62, '22*++*23*++*23*++*22*++*26*++*23*++*23*++*23*++*22*++*23*++*24*++*25*++*25*++*25*++*25', '8085', '0.00', '0', 0, 0, '0', 0, 0, 0, 0, 0, 0, 0, 0, 0, 13032.36, 0, 0, 0, 1770, 0, '0', 0, 14802.36, -14802.36, 1, 0, 0, 0, 1, 0, 34, NULL, '2019-12-12 15:33:40', '2019-12-13 05:18:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parisishtha_as_log`
--

CREATE TABLE `parisishtha_as_log` (
  `id` int(11) NOT NULL,
  `parisishtha_a_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parisishtha_bs`
--

CREATE TABLE `parisishtha_bs` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(11) UNSIGNED NOT NULL,
  `depot_id` int(11) UNSIGNED NOT NULL,
  `division_id` int(11) UNSIGNED NOT NULL,
  `billing_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` longtext COLLATE utf8mb4_unicode_ci,
  `vendor_id` int(10) UNSIGNED DEFAULT NULL,
  `vendorinvoice_id` int(10) UNSIGNED DEFAULT '0',
  `voucher_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voucher_date` date NOT NULL,
  `date` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `relevant_agreement` longtext COLLATE utf8mb4_unicode_ci,
  `schedule_complete` longtext COLLATE utf8mb4_unicode_ci,
  `kms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `diesel_ltr` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `diese_per_ltr_price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adblue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adblue_price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `breaddown_charge` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `breaddown_charge_value` longtext COLLATE utf8mb4_unicode_ci,
  `vor_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parking_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hault_tax` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `wash_exp` longtext COLLATE utf8mb4_unicode_ci,
  `other_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_km` float(10,2) NOT NULL,
  `diesel_as_per_gov` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_filled_diesel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_diesel_charged` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `is_vendor_confirm` int(10) NOT NULL DEFAULT '0',
  `is_parisishtha_a_created` tinyint(1) NOT NULL DEFAULT '0',
  `update_status` tinyint(1) NOT NULL DEFAULT '0',
  `update_status_division` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL COMMENT '0-save,1-save and submit',
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `idling_minutes` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parisishtha_bs`
--

INSERT INTO `parisishtha_bs` (`id`, `route_id`, `depot_id`, `division_id`, `billing_period`, `vehicle_id`, `vendor_id`, `vendorinvoice_id`, `voucher_no`, `voucher_date`, `date`, `relevant_agreement`, `schedule_complete`, `kms`, `diesel_ltr`, `diese_per_ltr_price`, `adblue`, `adblue_price`, `breaddown_charge`, `breaddown_charge_value`, `vor_exp`, `parking_exp`, `hault_tax`, `wash_exp`, `other_exp`, `total_km`, `diesel_as_per_gov`, `extra_filled_diesel`, `extra_diesel_charged`, `remarks`, `is_vendor_confirm`, `is_parisishtha_a_created`, `update_status`, `update_status_division`, `status`, `from_date`, `to_date`, `idling_minutes`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 60, 29, 15, '2019-11-01,2019-11-15', '22*++*22*++*27*++*25*++*24*++*23*++*24*++*22*++*24*++*27*++*25*++*24*++*23*++*24*++*23', 2, 1, 'STest1', '2019-12-13', '2019-11-01,2019-11-02,2019-11-03,2019-11-04,2019-11-05,2019-11-06,2019-11-07,2019-11-08,2019-11-09,2019-11-10,2019-11-11,2019-11-12,2019-11-13,2019-11-14,2019-11-15', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '539,539,539,539,539,539,539,539,539,539,50,100,50,100,200', '140,140,140,140,140,140,140,140,140,140,140,0,100,0,140', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,10000,,,,', '*++**++**++**++**++**++**++**++**++**++*10000,0,0,0,0,0,10000*++**++**++**++*', ',,,,,,,,,,,5900,5900,5900,5900', '118,118,118,118,118,118,118,118,118,118,118,118,118,118,118', ',,,,,,,,,,,,,,', '156,156,,156,156,,156,156,,156,156,,156,156,', ',,,,,,,,,,,,,,100', 5890.00, '1369.77', '410.23', '24326.64', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 0, 1, 1, 0, 1, '2019-11-01', '2019-11-15', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 34, 181, '2019-12-12 15:09:14', '2019-12-13 00:35:13', NULL),
(2, 60, 29, 15, '2019-11-16,2019-11-30', '22*++*22*++*25*++*23*++*23*++*26*++*23*++*23*++*23*++*25*++*24*++*24*++*24*++*23*++*22', 2, NULL, 'STest2', '2019-12-12', '2019-11-16,2019-11-17,2019-11-18,2019-11-19,2019-11-20,2019-11-21,2019-11-22,2019-11-23,2019-11-24,2019-11-25,2019-11-26,2019-11-27,2019-11-28,2019-11-29,2019-11-30', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '*++**++**++**++**++**++**++**++**++**++*1*++*1*++*1*++*1*++*1', '539,539,539,539,539,539,539,539,539,539,50,100,50,100,200', '140,140,140,140,140,140,140,140,140,140,140,0,100,0,140', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,20,,,,,,,,,,,,', ',,20,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', ',,,,,,,,,,,,,,', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 5890.00, '1369.77', '401.23', '23792.94', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 0, 1, 0, 0, 1, '2019-11-16', '2019-11-30', '10,10,10,10,10,10,10,10,10,10,10,10,10,10,10', 34, 34, '2019-12-12 15:12:15', '2019-12-12 15:15:01', NULL),
(3, 61, 29, 15, '2019-11-01,2019-11-15', '22*++*23*++*23*++*22*++*26*++*25*++*23*++*23*++*23*++*26*++*26*++*23*++*22*++*26*++*26', 2, 2, 'STest3', '2019-12-12', '2019-11-01,2019-11-02,2019-11-03,2019-11-04,2019-11-05,2019-11-06,2019-11-07,2019-11-08,2019-11-09,2019-11-10,2019-11-11,2019-11-12,2019-11-13,2019-11-14,2019-11-15', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '539,539,539,539,539,539,539,539,539,539,539,539,539,539,539', '140,140,140,140,140,140,140,140,140,140,140,140,140,140,140', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', ',,,,,,,,,,,,,,', '118,118,118,118,118,118,118,118,118,118,118,118,118,118,118', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 8085.00, '1880.23', '219.77', '13032.36', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 0, 1, 1, 0, 1, '2019-11-01', '2019-11-15', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 34, NULL, '2019-12-12 15:16:49', '2019-12-16 10:59:44', NULL),
(4, 61, 29, 15, '2019-11-16,2019-11-30', 'noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', 2, NULL, 'STest4', '2019-12-12', '2019-11-16,2019-11-17,2019-11-18,2019-11-19,2019-11-20,2019-11-21,2019-11-22,2019-11-23,2019-11-24,2019-11-25,2019-11-26,2019-11-27,2019-11-28,2019-11-29,2019-11-30', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 0.00, '0.00', '0.00', '0.00', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 0, 1, 0, 0, 1, '2019-11-16', '2019-11-30', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 34, NULL, '2019-12-12 15:18:55', '2019-12-12 15:20:49', NULL),
(5, 62, 29, 15, '2019-11-01,2019-11-15', 'noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', 2, 3, 'STest5', '2019-12-12', '2019-11-01,2019-11-02,2019-11-03,2019-11-04,2019-11-05,2019-11-06,2019-11-07,2019-11-08,2019-11-09,2019-11-10,2019-11-11,2019-11-12,2019-11-13,2019-11-14,2019-11-15', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '0,0,0,00,0,0,0,0,0,0,0,0,0,0,0', '00,0,0,0,0,0,0,0,0,0,0,0,0,0,0', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900,5900', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,200000', 0.00, '0.00', '0.00', '0.00', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 0, 1, 1, 0, 1, '2019-11-01', '2019-11-15', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 34, NULL, '2019-12-12 15:25:57', '2019-12-16 10:08:55', NULL),
(6, 62, 29, 15, '2019-11-16,2019-11-30', '22*++*23*++*23*++*22*++*26*++*23*++*23*++*23*++*22*++*23*++*24*++*25*++*25*++*25*++*25', 2, NULL, 'STest6', '2019-12-12', '2019-11-16,2019-11-17,2019-11-18,2019-11-19,2019-11-20,2019-11-21,2019-11-22,2019-11-23,2019-11-24,2019-11-25,2019-11-26,2019-11-27,2019-11-28,2019-11-29,2019-11-30', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '539,539,539,539,539,539,539,539,539,539,539,539,539,539,539', '140,140,140,140,140,140,140,140,140,140,140,140,140,140,140', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', ',,,,,,,,,,,,,,', '118,118,118,118,118,118,118,118,118,118,118,118,118,118,118', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 8085.00, '1880.23', '219.77', '13032.36', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 0, 1, 0, 0, 1, '2019-11-16', '2019-11-30', '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 34, NULL, '2019-12-12 15:31:27', '2019-12-12 15:33:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parisishtha_bs_log`
--

CREATE TABLE `parisishtha_bs_log` (
  `id` int(11) NOT NULL,
  `parisishtha_bs_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parisishtha_bs_log`
--

INSERT INTO `parisishtha_bs_log` (`id`, `parisishtha_bs_id`, `user_id`, `updated_at`) VALUES
(1, 2, 34, '2019-12-12 15:13:58'),
(2, 1, 181, '2019-12-13 00:13:12'),
(3, 1, 181, '2019-12-13 00:34:34');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `create` tinyint(1) NOT NULL DEFAULT '0',
  `edit` tinyint(1) NOT NULL DEFAULT '0',
  `view` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `usertype_id`, `module_id`, `create`, `edit`, `view`) VALUES
(1, 4, 12, 0, 0, 1),
(2, 4, 13, 0, 0, 1),
(3, 4, 14, 0, 0, 1),
(4, 5, 12, 1, 1, 1),
(5, 5, 13, 1, 1, 1),
(6, 5, 14, 1, 1, 1),
(7, 10, 12, 0, 0, 1),
(8, 10, 13, 0, 0, 1),
(9, 10, 14, 0, 0, 1),
(10, 6, 12, 0, 0, 1),
(11, 6, 13, 0, 0, 1),
(12, 6, 14, 0, 0, 1),
(13, 7, 12, 0, 0, 1),
(14, 7, 13, 0, 0, 1),
(15, 7, 14, 0, 0, 1),
(16, 8, 12, 1, 1, 1),
(17, 8, 13, 1, 1, 1),
(18, 8, 14, 1, 1, 1),
(19, 9, 12, 1, 1, 1),
(20, 9, 13, 1, 1, 1),
(21, 9, 14, 1, 1, 1),
(22, 38, 12, 0, 0, 1),
(23, 38, 13, 0, 0, 1),
(24, 38, 14, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rate_masters`
--

CREATE TABLE `rate_masters` (
  `id` int(11) UNSIGNED NOT NULL,
  `bus_type` varchar(255) NOT NULL,
  `from_km` varchar(255) NOT NULL,
  `to_km` varchar(255) NOT NULL,
  `rate` float(10,3) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rate_masters`
--

INSERT INTO `rate_masters` (`id`, `bus_type`, `from_km`, `to_km`, `rate`, `created_at`, `updated_at`) VALUES
(1, 'seater', '300', '349', 19.410, '2018-09-28 07:13:53', '2018-09-28 07:13:53'),
(2, 'seater', '350', '399', 18.120, '2018-09-28 07:14:11', '2018-09-28 07:14:11'),
(3, 'seater', '400', '449', 17.100, '2018-09-28 07:14:31', '2018-09-28 07:14:31'),
(4, 'seater', '450', '499', 16.400, '2018-09-28 07:14:47', '2018-09-28 07:14:47'),
(5, 'seater', '500', '549', 15.900, '2018-09-28 07:15:05', '2018-09-28 07:15:05'),
(6, 'seater', '550', '599', 15.250, '2018-09-28 07:15:20', '2018-09-28 07:15:20'),
(7, 'seater', '600', '649', 14.750, '2018-09-28 07:15:37', '2018-09-28 07:15:37'),
(8, 'seater', '650', '699', 14.400, '2018-09-28 07:15:57', '2018-09-28 07:15:57'),
(9, 'seater', '700', '749', 13.850, '2018-09-28 07:16:30', '2018-09-28 07:16:30'),
(10, 'seater', '750', '799', 13.350, '2018-10-03 12:45:33', '2018-10-03 18:15:33'),
(11, 'seater', '800', '100000', 13.000, '2018-10-03 12:45:45', '2018-10-03 18:15:45'),
(12, 'sleeper', '300', '349', 20.895, '2018-09-28 07:19:13', '2018-09-28 07:19:13'),
(13, 'sleeper', '350', '399', 19.195, '2018-09-28 07:19:34', '2018-09-28 07:19:34'),
(14, 'sleeper', '400', '449', 17.095, '2018-09-28 07:19:52', '2018-09-28 07:19:52'),
(15, 'sleeper', '450', '499', 16.595, '2018-09-28 07:20:39', '2018-09-28 07:20:39'),
(16, 'sleeper', '500', '549', 16.145, '2018-09-28 07:20:59', '2018-09-28 07:20:59'),
(17, 'sleeper', '550', '599', 15.645, '2018-09-28 07:21:21', '2018-09-28 07:21:21'),
(18, 'sleeper', '600', '649', 14.895, '2018-09-28 07:21:49', '2018-09-28 07:21:49'),
(19, 'sleeper', '650', '699', 14.395, '2018-09-28 07:22:11', '2018-09-28 07:22:11'),
(20, 'sleeper', '700', '749', 13.845, '2018-09-28 07:23:07', '2018-09-28 07:23:07'),
(21, 'sleeper', '750', '799', 13.345, '2018-09-28 07:23:44', '2018-09-28 07:23:44'),
(22, 'sleeper', '800', '100000', 13.000, '2018-09-28 07:24:13', '2018-09-28 07:24:13');

-- --------------------------------------------------------

--
-- Table structure for table `route_masters`
--

CREATE TABLE `route_masters` (
  `id` int(11) UNSIGNED NOT NULL,
  `from_depot` int(11) UNSIGNED NOT NULL,
  `to_depot` int(11) UNSIGNED NOT NULL,
  `scheduled_km` varchar(255) NOT NULL,
  `division_id` int(11) NOT NULL,
  `to_division` int(11) NOT NULL,
  `trip_hrs` int(11) DEFAULT NULL,
  `trip_min` int(11) DEFAULT NULL,
  `scheduled_time` longtext,
  `scheduled_number` longtext NOT NULL,
  `bus_type` varchar(255) NOT NULL,
  `maximum_ideling_minutes` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '0 for inactive 1 for active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `route_masters`
--

INSERT INTO `route_masters` (`id`, `from_depot`, `to_depot`, `scheduled_km`, `division_id`, `to_division`, `trip_hrs`, `trip_min`, `scheduled_time`, `scheduled_number`, `bus_type`, `maximum_ideling_minutes`, `status`, `created_at`, `updated_at`) VALUES
(1, 42, 11, '419.6', 17, 5, 0, 0, '20:00', '1', 'seater', 120, 1, '2019-11-25 04:23:46', '2019-12-02 18:23:58'),
(2, 42, 11, '419.6', 17, 5, 0, 0, '21:00', '2', 'seater', 120, 1, '2019-11-25 04:23:46', '2019-11-28 19:27:53'),
(3, 42, 57, '620', 17, 15, 0, 0, '09:00', '3', 'seater', 120, 1, '2019-11-25 04:23:46', '2019-11-25 04:23:46'),
(4, 42, 20, '486.5', 17, 11, 0, 0, '05:15', '4', 'seater', 120, 1, '2019-11-25 04:23:46', '2019-11-25 04:23:46'),
(5, 51, 11, '773.1', 17, 5, 0, 0, '05:15', '5', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(6, 51, 11, '773.1', 17, 5, 0, 0, '23:30', '6', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(7, 51, 116, '712.1', 17, 35, 0, 0, '18:30', '7', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(8, 34, 46, '319.2', 17, 19, 0, 0, '07:00', '8', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(9, 34, 46, '319.2', 17, 19, 0, 0, '12:00', '9', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(10, 34, 46, '319.2', 17, 19, 0, 0, '18:30', '10', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(11, 34, 65, '420', 17, 26, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(12, 34, 65, '420', 17, 26, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(13, 39, 121, '408.4', 23, 9, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(14, 39, 121, '408.4', 23, 9, 0, 0, '09:45', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(15, 39, 121, '408.4', 23, 9, 0, 0, '23:15', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(16, 39, 122, '1016', 23, 37, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(17, 39, 116, '1447.2', 23, 35, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(18, 45, 11, '995.2', 25, 5, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(19, 45, 11, '995.2', 25, 5, 0, 0, '19:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(20, 46, 11, '454', 19, 5, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(21, 46, 11, '454', 19, 5, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(22, 46, 11, '454', 19, 5, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(23, 46, 11, '454', 19, 5, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(24, 46, 11, '454', 19, 5, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(25, 46, 11, '454', 19, 5, 0, 0, '07:30', '40', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(26, 46, 11, '454', 19, 5, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(27, 46, 11, '454', 19, 5, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:47', '2019-11-25 04:23:47'),
(28, 46, 11, '454', 19, 5, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(29, 46, 11, '454', 19, 5, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(30, 46, 11, '454', 19, 5, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(31, 46, 11, '454', 19, 5, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(32, 37, 116, '576.3', 19, 35, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(33, 37, 16, '758.7', 19, 7, 0, 0, '22:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(34, 36, 113, '699.6', 19, 28, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(35, 36, 113, '699.6', 19, 28, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(36, 36, 113, '699.6', 19, 28, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(37, 36, 113, '699.6', 19, 28, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(38, 36, 113, '699.6', 19, 28, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(39, 36, 113, '699.6', 19, 28, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(40, 36, 113, '699.6', 19, 28, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(41, 36, 18, '638.4', 19, 9, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-28 19:11:45'),
(42, 36, 18, '638.4', 19, 9, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(43, 36, 18, '638.4', 19, 9, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(44, 36, 18, '638.4', 19, 9, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(45, 36, 18, '638.4', 19, 9, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(46, 36, 18, '638.4', 19, 9, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(47, 36, 18, '638.4', 19, 9, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(48, 36, 18, '638.4', 19, 9, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(49, 36, 18, '638.4', 19, 9, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(50, 36, 18, '638.4', 19, 9, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(51, 36, 18, '638.4', 19, 9, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(52, 36, 18, '638.4', 19, 9, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(53, 36, 123, '596.4', 19, 11, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(54, 36, 123, '596.4', 19, 11, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(55, 70, 46, '390.4', 19, 19, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(56, 70, 46, '390.4', 19, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(57, 70, 46, '390.4', 19, 19, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(58, 70, 46, '390.4', 19, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(59, 70, 46, '390.4', 19, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(60, 29, 39, '538.18', 15, 23, 0, 0, '05:30', '23', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-29 12:13:34'),
(61, 29, 39, '538.18', 15, 23, 0, 0, '06:00', '24', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-29 12:13:49'),
(62, 29, 39, '538.18', 15, 23, 0, 0, '07:00', '26', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-29 12:14:14'),
(63, 29, 39, '538.18', 15, 23, 0, 0, '07:30', '28', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-29 12:14:32'),
(64, 29, 39, '538.18', 15, 23, 0, 0, '08:30', '29', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-12-03 20:33:55'),
(65, 29, 39, '538.18', 15, 23, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:48', '2019-11-25 04:23:48'),
(66, 29, 39, '538.18', 15, 23, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(67, 29, 39, '538.18', 15, 23, 0, 0, '11:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(68, 29, 39, '538.18', 15, 23, 0, 0, '12:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(69, 29, 39, '538.18', 15, 23, 0, 0, '14:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(70, 29, 39, '538.18', 15, 23, 0, 0, '14:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(71, 29, 39, '538.18', 15, 23, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(72, 29, 39, '538.18', 15, 23, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(73, 29, 39, '538.18', 15, 23, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(74, 29, 39, '538.18', 15, 23, 0, 0, '17:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(75, 29, 39, '538.18', 15, 23, 0, 0, '18:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(76, 29, 39, '538.18', 15, 23, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(77, 29, 39, '538.18', 15, 23, 0, 0, '19:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(78, 29, 39, '538.18', 15, 23, 0, 0, '20:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(79, 29, 39, '538.18', 15, 23, 0, 0, '22:00', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(80, 29, 39, '538.18', 15, 23, 0, 0, '22:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(81, 29, 39, '538.18', 15, 23, 0, 0, '23:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(82, 29, 33, '570.6', 15, 17, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(83, 29, 33, '570.6', 15, 17, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:49', '2019-11-25 04:23:49'),
(84, 29, 33, '570.6', 15, 17, 0, 0, '11:30', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(85, 29, 33, '570.6', 15, 17, 0, 0, '12:30', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(86, 29, 33, '570.6', 15, 17, 0, 0, '13:30', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(87, 29, 33, '570.6', 15, 17, 0, 0, '15:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(88, 29, 33, '570.6', 15, 17, 0, 0, '22:30', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(89, 29, 46, '423.2', 15, 19, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(90, 29, 46, '423.2', 15, 19, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(91, 29, 46, '423.2', 15, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(92, 29, 46, '423.2', 15, 19, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(93, 29, 46, '423.2', 15, 19, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(94, 29, 46, '423.2', 15, 19, 0, 0, '11:00', '', 'seater', 120, 1, '2019-11-25 04:23:50', '2019-11-25 04:23:50'),
(95, 29, 46, '423.2', 15, 19, 0, 0, '12:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(96, 29, 46, '423.2', 15, 19, 0, 0, '13:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(97, 29, 46, '423.2', 15, 19, 0, 0, '14:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(98, 29, 46, '423.2', 15, 19, 0, 0, '15:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(99, 29, 46, '423.2', 15, 19, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(100, 29, 46, '423.2', 15, 19, 0, 0, '17:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(101, 29, 18, '652', 15, 9, 0, 0, '06:45', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(102, 96, 115, '371.1', 15, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(103, 96, 115, '371.1', 15, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(104, 96, 115, '371.1', 15, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(105, 96, 115, '371.1', 15, 19, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(106, 96, 115, '371.1', 15, 19, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(107, 96, 115, '371.1', 15, 19, 0, 0, '12:30', '', 'seater', 120, 1, '2019-11-25 04:23:51', '2019-11-25 04:23:51'),
(108, 96, 115, '371.1', 15, 19, 0, 0, '14:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(109, 96, 115, '371.1', 15, 19, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(110, 96, 115, '371.1', 15, 19, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(111, 96, 115, '371.1', 15, 19, 0, 0, '17:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(112, 96, 115, '371.1', 15, 19, 0, 0, '18:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(113, 96, 18, '336.5', 15, 9, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(114, 96, 39, '530.7', 15, 23, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(115, 11, 116, '568.4', 5, 35, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(116, 11, 39, '395.5', 5, 23, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(117, 11, 39, '395.5', 5, 23, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(118, 11, 39, '395.5', 5, 23, 0, 0, '22:00', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(119, 11, 33, '412', 5, 17, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(120, 11, 33, '412', 5, 17, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(121, 11, 18, '453', 5, 9, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(122, 11, 38, '375.5', 5, 20, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(123, 11, 38, '375.5', 5, 20, 0, 0, '20:00', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(124, 11, 46, '454', 5, 19, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(125, 11, 46, '454', 5, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(126, 11, 46, '454', 5, 19, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(127, 11, 46, '454', 5, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:52', '2019-11-25 04:23:52'),
(128, 11, 46, '454', 5, 19, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(129, 11, 46, '454', 5, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(130, 11, 46, '454', 5, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(131, 11, 46, '454', 5, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(132, 11, 46, '454', 5, 19, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(133, 12, 49, '527.4', 5, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(134, 12, 49, '527.4', 5, 19, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(135, 12, 44, '464', 5, 24, 0, 0, '06:45', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(136, 12, 44, '464', 5, 24, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(137, 40, 18, '460', 5, 9, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:53', '2019-11-25 04:23:53'),
(138, 40, 46, '490', 5, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(139, 40, 46, '490', 5, 19, 0, 0, '11:30', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(140, 8, 47, '889.6', 5, 23, 0, 0, '08:45', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(141, 8, 47, '889.6', 5, 23, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(142, 8, 46, '580', 5, 19, 0, 0, '09:15', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(143, 9, 33, '531.6', 5, 17, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(144, 10, 46, '635.2', 5, 19, 0, 0, '13:15', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(145, 60, 46, '681.9', 30, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:54', '2019-11-25 04:23:54'),
(146, 60, 46, '681.9', 30, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(147, 60, 46, '681.9', 30, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(148, 60, 46, '681.9', 30, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(149, 60, 46, '681.9', 30, 19, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(150, 60, 46, '681.9', 30, 19, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(151, 60, 3, '615', 30, 2, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(152, 60, 3, '615', 30, 2, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(153, 98, 46, '478.6', 30, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(154, 98, 46, '478.6', 30, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(155, 98, 46, '478.6', 30, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(156, 98, 46, '478.6', 30, 19, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(157, 98, 46, '478.6', 30, 19, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(158, 98, 46, '478.6', 30, 19, 0, 0, '11:30', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(159, 97, 46, '408', 30, 19, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(160, 97, 37, '440', 30, 19, 0, 0, '14:15', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(161, 32, 116, '622.3', 16, 35, 0, 0, '05:45', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(162, 32, 116, '622.3', 16, 35, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(163, 32, 116, '622.3', 16, 35, 0, 0, '12:15', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(164, 32, 46, '496.3', 16, 19, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(165, 32, 46, '496.3', 16, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(166, 32, 46, '496.3', 16, 19, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(167, 53, 39, '384.1', 16, 23, 0, 0, '22:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(168, 53, 46, '653.1', 16, 19, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:55', '2019-11-25 04:23:55'),
(169, 30, 46, '672.6', 16, 19, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(170, 30, 46, '672.6', 16, 19, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(171, 30, 46, '672.6', 16, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(172, 30, 46, '672.6', 16, 19, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(173, 30, 46, '672.6', 16, 19, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(174, 30, 46, '672.6', 16, 19, 0, 0, '11:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(175, 66, 36, '608.8', 9, 19, 0, 0, '11:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(176, 66, 36, '608.8', 9, 19, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(177, 18, 33, '514.8', 9, 17, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(178, 18, 33, '514.8', 9, 17, 0, 0, '12:30', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(179, 18, 36, '638.4', 9, 19, 0, 0, '07:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(180, 18, 36, '638.4', 9, 19, 0, 0, '08:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(181, 18, 36, '638.4', 9, 19, 0, 0, '09:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(182, 18, 36, '638.4', 9, 19, 0, 0, '10:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(183, 18, 36, '638.4', 9, 19, 0, 0, '13:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(184, 18, 36, '638.4', 9, 19, 0, 0, '14:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(185, 18, 36, '638.4', 9, 19, 0, 0, '15:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(186, 18, 36, '638.4', 9, 19, 0, 0, '16:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(187, 18, 36, '638.4', 9, 19, 0, 0, '17:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(188, 18, 36, '638.4', 9, 19, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(189, 18, 36, '638.4', 9, 19, 0, 0, '08:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(190, 18, 36, '638.4', 9, 19, 0, 0, '09:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(191, 18, 36, '638.4', 9, 19, 0, 0, '10:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(192, 18, 36, '638.4', 9, 19, 0, 0, '11:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(193, 18, 36, '638.4', 9, 19, 0, 0, '13:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(194, 18, 36, '638.4', 9, 19, 0, 0, '14:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(195, 18, 36, '638.4', 9, 19, 0, 0, '15:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(196, 18, 36, '638.4', 9, 19, 0, 0, '16:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(197, 18, 36, '638.4', 9, 19, 0, 0, '17:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(198, 18, 16, '707.9', 9, 7, 0, 0, '20:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(199, 18, 113, '795.6', 9, 28, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(200, 18, 41, '526.3', 9, 22, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(201, 18, 11, '452.6', 9, 5, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(202, 18, 124, '421.1', 9, 38, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(203, 18, 113, '570.3', 9, 28, 0, 0, '06:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(204, 18, 113, '570.3', 9, 28, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(205, 18, 113, '570.3', 9, 28, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(206, 18, 113, '570.3', 9, 28, 0, 0, '11:00', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(207, 18, 113, '570.3', 9, 28, 0, 0, '11:45', '', 'seater', 120, 1, '2019-11-25 04:23:56', '2019-11-25 04:23:56'),
(208, 18, 113, '570.3', 9, 28, 0, 0, '12:00', '', 'seater', 120, 1, '2019-11-25 04:23:57', '2019-11-25 04:23:57'),
(209, 18, 113, '570.3', 9, 28, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:57', '2019-11-25 04:23:57'),
(210, 18, 113, '570.3', 9, 28, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:57', '2019-11-25 04:23:57'),
(211, 18, 58, '637.6', 9, 10, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(212, 18, 58, '637.6', 9, 10, 0, 0, '06:45', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(213, 18, 58, '637.6', 9, 10, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(214, 18, 58, '637.6', 9, 10, 0, 0, '07:45', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(215, 18, 5, '514.4', 9, 3, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(216, 18, 5, '514.4', 9, 3, 0, 0, '17:30', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(217, 18, 84, '467.8', 9, 3, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(218, 18, 84, '467.8', 9, 3, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(219, 75, 115, '378.2', 26, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(220, 75, 115, '378.2', 26, 19, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(221, 75, 115, '378.2', 26, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(222, 75, 115, '378.2', 26, 19, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:58', '2019-11-25 04:23:58'),
(223, 75, 39, '608.6', 26, 23, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(224, 64, 115, '371.4', 26, 19, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(225, 64, 115, '371.4', 26, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(226, 64, 115, '371.4', 26, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(227, 64, 115, '371.4', 26, 19, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(228, 64, 115, '371.4', 26, 19, 0, 0, '12:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(229, 64, 115, '371.4', 26, 19, 0, 0, '15:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(230, 58, 115, '341', 10, 19, 0, 0, '22:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(231, 58, 115, '341', 10, 19, 0, 0, '22:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(232, 58, 18, '638', 10, 9, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(233, 58, 18, '638', 10, 9, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(234, 19, 115, '428.8', 10, 19, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(235, 67, 115, '438.5', 10, 19, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(236, 67, 39, '429.2', 10, 23, 0, 0, '20:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(237, 5, 37, '417.5', 3, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(238, 5, 37, '417.5', 3, 19, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(239, 5, 18, '509.8', 3, 9, 0, 0, '15:15', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(240, 5, 18, '509.8', 3, 9, 0, 0, '17:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(241, 83, 37, '353', 3, 19, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(242, 112, 37, '469', 3, 19, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(243, 54, 39, '405.3', 28, 23, 0, 0, '22:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(244, 54, 39, '405.3', 28, 23, 0, 0, '23:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(245, 54, 16, '506.8', 28, 7, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(246, 54, 52, '504.8', 28, 27, 0, 0, '08:15', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(247, 54, 52, '504.8', 28, 27, 0, 0, '12:00', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(248, 54, 52, '504.8', 28, 27, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:23:59', '2019-11-25 04:23:59'),
(249, 54, 52, '504.8', 28, 27, 0, 0, '17:45', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(250, 54, 115, '484.6', 28, 19, 0, 0, '04:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(251, 54, 115, '484.6', 28, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(252, 54, 15, '553.2', 28, 6, 0, 0, '14:45', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(253, 54, 15, '553.2', 28, 6, 0, 0, '17:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(254, 54, 15, '553.2', 28, 6, 0, 0, '19:15', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(255, 54, 1, '527.2', 28, 1, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(256, 54, 1, '527.2', 28, 1, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(257, 54, 1, '527.2', 28, 1, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(258, 104, 115, '699.6', 28, 19, 0, 0, '05:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(259, 104, 115, '699.6', 28, 19, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(260, 104, 115, '699.6', 28, 19, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(261, 104, 115, '699.6', 28, 19, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(262, 104, 115, '699.6', 28, 19, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(263, 104, 115, '699.6', 28, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(264, 104, 115, '699.6', 28, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(265, 104, 115, '699.6', 28, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(266, 104, 115, '699.6', 28, 19, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(267, 104, 115, '699.6', 28, 19, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(268, 104, 115, '699.6', 28, 19, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(269, 104, 18, '795.6', 28, 9, 0, 0, '06:15', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(270, 104, 18, '795.6', 28, 9, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(271, 104, 18, '795.6', 28, 9, 0, 0, '07:45', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(272, 104, 18, '795.6', 28, 9, 0, 0, '13:45', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(273, 104, 16, '513.9', 28, 7, 0, 0, '18:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(274, 104, 16, '513.9', 28, 7, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(275, 104, 11, '463.5', 28, 5, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(276, 104, 125, '434.3', 28, 39, 0, 0, '20:45', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(277, 104, 38, '371.3', 28, 20, 0, 0, '07:45', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(278, 125, 125, '513.9', 39, 39, 0, 0, '20:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(279, 74, 39, '374', 28, 23, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(280, 17, 116, '600', 8, 35, 0, 0, '09:00', '', 'seater', 240, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(281, 17, 116, '600', 8, 35, 0, 0, '10:00', '', 'seater', 240, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(282, 17, 116, '600', 8, 35, 0, 0, '11:00', '', 'seater', 240, 1, '2019-11-25 04:24:00', '2019-11-25 04:24:00'),
(283, 17, 116, '600', 8, 35, 0, 0, '20:00', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(284, 17, 116, '600', 8, 35, 0, 0, '21:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(285, 17, 116, '600', 8, 35, 0, 0, '23:00', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(286, 17, 32, '536', 8, 16, 0, 0, '05:00', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(287, 17, 32, '536', 8, 16, 0, 0, '08:00', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(288, 17, 32, '536', 8, 16, 0, 0, '10:00', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(289, 17, 32, '536', 8, 16, 0, 0, '12:00', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(290, 17, 32, '536', 8, 16, 0, 0, '21:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(291, 17, 32, '536', 8, 16, 0, 0, '22:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(292, 17, 115, '471.6', 8, 19, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(293, 17, 115, '471.6', 8, 19, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(294, 17, 115, '471.6', 8, 19, 0, 0, '20:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(295, 79, 116, '424', 8, 35, 0, 0, '05:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(296, 79, 116, '424', 8, 35, 0, 0, '06:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(297, 79, 116, '424', 8, 35, 0, 0, '08:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(298, 79, 116, '424', 8, 35, 0, 0, '09:30', '', 'seater', 240, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(299, 17, 11, '508.9', 8, 5, 0, 0, '20:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(300, 17, 16, '378.1', 8, 7, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(301, 13, 50, '407.5', 6, 19, 0, 0, '14:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(302, 68, 50, '400', 6, 19, 0, 0, '13:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(303, 14, 50, '392.9', 6, 19, 0, 0, '08:45', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(304, 14, 50, '392.9', 6, 19, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(305, 71, 50, '359.3', 6, 19, 0, 0, '12:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(306, 71, 50, '359.3', 6, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(307, 71, 69, '436.1', 6, 32, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(308, 1, 115, '535', 1, 19, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(309, 1, 115, '535', 1, 19, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(310, 1, 115, '535', 1, 19, 0, 0, '23:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(311, 1, 39, '425', 1, 23, 0, 0, '20:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(312, 1, 33, '402', 1, 17, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(313, 99, 116, '704', 1, 35, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(314, 99, 116, '704', 1, 35, 0, 0, '21:30', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(315, 100, 39, '407.4', 1, 23, 0, 0, '20:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(316, 101, 39, '482.5', 1, 23, 0, 0, '17:00', '', 'seater', 120, 1, '2019-11-25 04:24:01', '2019-11-25 04:24:01'),
(317, 2, 36, '719.6', 1, 19, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(318, 2, 36, '719.6', 1, 19, 0, 0, '20:30', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(319, 6, 11, '502.4', 4, 5, 0, 0, '18:00', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(320, 6, 115, '599.4', 4, 19, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(321, 6, 115, '599.4', 4, 19, 0, 0, '18:00', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(322, 81, 115, '610.1', 4, 19, 0, 0, '11:00', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(323, 81, 115, '610.1', 4, 19, 0, 0, '19:30', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(324, 7, 43, '495', 4, 23, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(325, 86, 52, '352.5', 33, 27, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(326, 86, 72, '611.8', 33, 32, 0, 0, '05:30', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(327, 59, 16, '340', 29, 7, 0, 0, '05:45', '', 'seater', 120, 1, '2019-11-25 04:24:02', '2019-11-25 04:24:02'),
(328, 59, 16, '340', 29, 7, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(329, 59, 16, '340', 29, 7, 0, 0, '15:00', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(330, 59, 16, '340', 29, 7, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(331, 95, 116, '1310', 29, 35, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(332, 103, 16, '609.6', 34, 7, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(333, 103, 16, '609.6', 34, 7, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(334, 103, 16, '609.6', 34, 7, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(335, 103, 16, '609.6', 34, 7, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:03', '2019-11-25 04:24:03'),
(336, 103, 59, '508.2', 34, 29, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(337, 69, 115, '595.8', 32, 19, 0, 0, '19:00', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(338, 69, 53, '628.1', 32, 16, 0, 0, '18:00', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(339, 72, 16, '413.4', 32, 7, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(340, 72, 16, '413.4', 32, 7, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(341, 73, 16, '421.6', 32, 7, 0, 0, '08:00', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(342, 73, 16, '421.6', 32, 7, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(343, 107, 52, '445.8', 18, 27, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(344, 107, 52, '445.8', 18, 27, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(345, 106, 16, '536.8', 18, 7, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:04', '2019-11-25 04:24:04'),
(346, 35, 16, '592.4', 18, 7, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(347, 35, 16, '592.4', 18, 7, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(348, 35, 16, '592.4', 18, 7, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(349, 35, 16, '592.4', 18, 7, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(350, 102, 113, '566.4', 2, 28, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(351, 3, 56, '365', 2, 26, 0, 0, '21:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(352, 109, 115, '747.1', 7, 19, 0, 0, '18:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(353, 108, 115, '747.1', 7, 19, 0, 0, '17:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(354, 108, 113, '513.9', 7, 28, 0, 0, '18:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(355, 108, 18, '705.3', 7, 9, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(356, 108, 52, '508.8', 7, 27, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(357, 108, 118, '405', 7, 36, 0, 0, '09:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(358, 110, 117, '589.6', 7, 27, 0, 0, '15:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(359, 108, 120, '502', 7, 18, 0, 0, '15:15', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(360, 108, 59, '689', 7, 29, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(361, 108, 103, '609.6', 7, 34, 0, 0, '06:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(362, 108, 103, '609.6', 7, 34, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(363, 108, 103, '609.6', 7, 34, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(364, 108, 103, '609.6', 7, 34, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(365, 108, 32, '633.6', 7, 16, 0, 0, '16:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(366, 109, 59, '680', 7, 29, 0, 0, '05:45', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(367, 109, 118, '405', 7, 36, 0, 0, '07:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(368, 110, 118, '405', 7, 36, 0, 0, '10:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(369, 110, 118, '405', 7, 36, 0, 0, '12:15', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(370, 110, 69, '624.4', 7, 32, 0, 0, '06:10', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(371, 110, 69, '624.4', 7, 32, 0, 0, '16:40', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(372, 110, 119, '500', 7, 27, 0, 0, '08:40', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(373, 111, 52, '489.6', 7, 27, 0, 0, '07:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(374, 29, 33, '575.4', 15, 17, 0, 0, '06:00', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(375, 29, 33, '575.4', 15, 17, 0, 0, '08:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(376, 29, 33, '575.4', 15, 17, 0, 0, '10:30', '', 'seater', 120, 1, '2019-11-25 04:24:05', '2019-11-25 04:24:05'),
(377, 29, 33, '575.4', 15, 17, 0, 0, '13:00', '', 'seater', 120, 1, '2019-11-25 04:24:06', '2019-11-25 04:24:06'),
(378, 29, 33, '575.4', 15, 17, 0, 0, '14:30', '', 'seater', 120, 1, '2019-11-25 04:24:07', '2019-11-25 04:24:07'),
(379, 29, 33, '575.4', 15, 17, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:24:08', '2019-11-25 04:24:08'),
(380, 29, 33, '575.4', 15, 17, 0, 0, '16:30', '', 'seater', 120, 1, '2019-11-25 04:24:09', '2019-11-25 04:24:09'),
(381, 29, 33, '575.4', 15, 17, 0, 0, '17:30', '', 'seater', 120, 1, '2019-11-25 04:24:10', '2019-11-25 04:24:10'),
(382, 29, 33, '575.4', 15, 17, 0, 0, '18:30', '', 'seater', 120, 1, '2019-11-25 04:24:10', '2019-11-25 04:24:10'),
(383, 99, 115, '347', 1, 19, 0, 0, '09:30', '', 'seater', 120, 1, '2019-11-25 04:24:10', '2019-11-25 04:24:10'),
(384, 99, 115, '347', 1, 19, 0, 0, '20:30', '', 'seater', 120, 1, '2019-11-25 04:24:10', '2019-11-25 04:24:10'),
(385, 69, 16, '624.4', 32, 7, 0, 0, '07:15', '', 'seater', 120, 1, '2019-11-25 04:24:10', '2019-11-25 04:24:10'),
(386, 69, 16, '624.4', 32, 7, 0, 0, '07:45', '', 'seater', 120, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(387, 107, 115, '751.4', 18, 19, 0, 0, '15:30', '', 'seater', 120, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(388, 36, 44, '467.4', 19, 24, 0, 0, '04:30', '', 'seater', 180, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(389, 36, 44, '467.4', 19, 24, 0, 0, '05:15', '', 'seater', 180, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(390, 36, 44, '467.4', 19, 24, 0, 0, '16:00', '', 'seater', 180, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(391, 36, 44, '467.4', 19, 24, 0, 0, '19:00', '', 'seater', 180, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(392, 36, 44, '467.4', 19, 24, 0, 0, '20:30', '', 'seater', 180, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11'),
(393, 39, 78, '396.2', 23, 10, 0, 0, '19:30', '', 'seater', 180, 1, '2019-11-25 04:24:11', '2019-11-25 04:24:11');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(25) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL,
  `accesstype_id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `otp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 for inactive 1 for active',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `division_id`, `depot_id`, `usertype_id`, `accesstype_id`, `status`, `otp`, `active_status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Welcome', 'Admin', 'admin@gmail.com', '1111111111', '$2y$10$5HXs6aH99vN4ujhtVnLHUunoqcaWsAvzYAZE640aDXj0un0eZ9LFu', 1, 11, 1, 1, 1, NULL, 1, 0, 0, '2LF1h0VZsttlYrBELiOoLJJfydze6tVwZBfO7wj8dgfNtSu27wn60qazFuGp', '2018-08-30 07:30:13', '2019-03-08 10:14:15', NULL),
(2, 'Welcome', 'Admin', 'admin1@gmail.com', '9999999999', '$2y$10$doI7dq.ykG3QCsycwgGqweMJ8A8N/mWc1WfWd9p8Vboq10WFcHZoq', 1, 11, 1, 1, 1, NULL, 1, 0, 0, 'O9sFc3eOYodpr9h1zSIiQpp55pTTKoyjHBPHhtmRENUN83WoaP3fbRFdJL2O', '2018-08-30 07:30:13', '2018-08-30 07:30:21', NULL),
(3, 'Vendor', 'Manager', NULL, '8291784861', '$2y$10$QtwNApM3lvVPr.HJ6./TOOBEx/HY9v59Iv1lfY70H8edjQFj1cSea', 0, 0, 2, 1, 1, 'NgKdiA', 1, 1, 1, 'bTcTHmxOlRy268lHm4mBqx2BF5d0fWX62t8h4xSV9T56rosXwbKNtIG81ZuL', '2019-01-02 16:00:31', '2019-01-02 16:10:25', NULL),
(4, 'Vendor', 'Accountant', NULL, '8655431449', '$2y$10$CBCLiKRbdKazhTiZySjrDu93wqewKlCcIQfhdOjotI8J7xmTn/r5q', 0, 0, 3, 1, 1, '6543FH', 1, 1, 1, 'NlBEmju137WT9fSRTruhcaoi31pVzADWPKUwLHaXpI7FF9CQaA7dU59WqEHI', '2019-01-02 16:08:58', '2019-01-02 16:11:43', NULL),
(5, 'Vendor', 'Manager', NULL, '8291921764', '$2y$10$iFuIE7styBREXOtEDbXj5.ek0F9AthddOXxKX9jJTiBvkC5jpDSr.', 0, 0, 2, 1, 1, '386591', 1, 1, NULL, 'hWmPzVvJKGFNsWO4O4nhFHCKgjEfX0qy4UVwnTfpftdaHnAjTkhSDIe4uVk3', '2019-01-02 16:12:18', '2019-01-02 16:12:18', NULL),
(6, 'Vendor', 'Accountant', NULL, '9920881627', '$2y$10$HFKyO14/12oxtJ.Pnf0BfuPNq1uV8bZ0d5i3HlvhdrNLBSQuhv9vG', 0, 0, 3, 1, 1, '784314', 1, 1, NULL, 'loVOyPcuzVL6yJQsSKy0S6zjvRNVXehNASfhMkt1SsrDPjm9TYuXSmU5XMqM', '2019-01-02 16:13:04', '2019-01-02 16:13:04', NULL),
(7, 'Vendor', 'Manager', NULL, '8657460530', '$2y$10$CJZW0fhrkN59JVlgZN3Hze4Uv24bAM2maWwdr8I5gE7j60Lsvi0Zy', 0, 0, 2, 1, 1, '47eYLr', 1, 1, NULL, 'Cg6AQ5vQhYCxPHqTM5HT7WuQnmbpRwLaothcp8SYWqQzUZEZ51TJSlJvJl7E', '2019-01-02 16:14:26', '2019-11-13 07:38:18', NULL),
(8, 'Vendor', 'Accountant', NULL, '8657432691', '$2y$10$dLU7mLOe9IP9AcSZCzjYw..zkP9BJmAswmiAyUuXBS1Coifr1B8bK', 0, 0, 3, 1, 1, '0NoCS8', 1, 1, NULL, 'XaLVscOdC2X01kffBWayqPIOrHM81fnOjywnvq1p24KzssK85uZpcFghpCdp', '2019-01-02 16:16:57', '2019-11-13 07:38:18', NULL),
(9, 'Vendor', 'Manager', NULL, '8657471241', '$2y$10$qUXS0xBfEp/AptG5vcdbK.iUVuAyP.haiuTqI5sN4a7WKkkEkoRX2', 0, 0, 2, 1, 1, 'ifKnc2', 1, 1, NULL, 'hbjBNVROtgHw6MmfWXgRNVW4XQxbndlOoEfVviRvgpQh20zELeFXJY4oihyS', '2019-01-02 16:26:42', '2019-01-02 16:26:42', NULL),
(10, 'Vendor', 'Accountant', NULL, '9082906242', '$2y$10$PXeaHDaSoRI1u5mRD4mgZ.k1WizUHabRW2O/.4pt3gJyOehGKvOYG', 0, 0, 3, 1, 1, '398718', 1, 1, NULL, 'eo5LHFaUw7WFuMnzfUxSQc2J4e6l79vQcd5VgdNir5A2ygtvZ2uVLkItFVx1', '2019-01-02 16:32:31', '2019-01-02 16:32:31', NULL),
(11, 'Bill', 'Preparator', NULL, '9922886644', '$2y$10$8oaOY/W0xfcktVqT9WP/juPWMf/jMbYvfycQM8YsS.wO6r2zHaZiS', 15, 29, 8, 3, 1, '34xC5q', 1, 1, 1, '9dxGR1RrANlkuoLPYFi5n3UVUjh3PTY9YIXTycmh1FvdEAylALw7pK5yIVpB', '2019-01-02 17:34:33', '2019-01-12 12:27:22', NULL),
(12, 'Bill Preparator', 'UDGIR', NULL, '8369092373', '$2y$10$VUFwz2Gs19zmQnjpnU0QdO0wiv5Dtj46fMMykM2ex5gTTGjiPq8Yy', 6, 13, 8, 3, 1, 'RrPoUl', 1, 1, 1, '0FFcpht577dKZmzInBfqyerEPtnjGILJYwYkmlqv6obMQdfTD1r4WZa7TWiO', '2019-01-02 17:41:55', '2019-01-02 17:55:48', NULL),
(13, 'Asmita', 'Dhotre', NULL, '7045983746', '$2y$10$KwvWSSPqeFTJ3Oa5fKt85evxGso8oOhPcQWm7R8kNLUEN/BqRmeZe', 17, 51, 9, 3, 1, 'HXgXzB', 1, 1, 1, 'AlJJcjff0B51IjX2ozZmVTmJg2vFYmUaof5o32CC9mEj41fOBu6yBYVYVRZi', '2019-01-05 11:12:02', '2019-05-18 00:06:55', NULL),
(14, 'S.B.', 'Thorat', NULL, '8308184769', '$2y$10$/9JvLqy2NWP3IE7oBH7.6eVvz8XXLuKVCXORxOZPwASxbhKv4usNC', 16, 32, 9, 3, 1, '327506', 1, 1, 1, '0A69WF0OGgjJ6kp9oiTC6oWMUGQSnhct1plCXTO2M8NAKmsa3x9nl83G6hYe', '2019-01-07 10:49:28', '2019-08-06 16:55:13', NULL),
(15, 'Sangram', 'Lad', NULL, '8483842829', '$2y$10$IY0kejV0sdTKPQUO98O0bu3gUUh25bnon5ChnSG5mkxik.2rfoKaa', 5, 8, 9, 3, 1, 'XVtWW7', 1, 1, NULL, 'wqbwZmheXRwOb7ShbCQQSLq055ZfYXeAqltz4kQGMJoTS4nl7eu5Aa9sUl7E', '2019-01-07 12:25:48', '2019-01-07 12:25:48', NULL),
(16, 'Narendra', 'Yawalkar', NULL, '7038328110', '$2y$10$lSUM69boXc3Noh8JrlT0tuUZa0wDO60zMGVLMZ27K5sAdreQfVH7.', 7, 108, 9, 3, 1, '769405', 1, 1, 1, 'O0iO4htx4KB0ZY2b4Uai05oiKKtrr5HfWT6mkbSgYwPtRKdtRkD0wBTLPA0D', '2019-01-07 14:15:11', '2019-05-24 12:34:27', NULL),
(17, 'Sunil', 'Sadawarte', NULL, '9604978896', '$2y$10$ZmU6XT.vRMKdyteVkFSOb.4giA3s6t08mC6I76hQBG4rnQU9X5aoC', 12, 22, 9, 3, 1, 'xd8i7S', 1, 1, NULL, 'mt0BAuhc2Xxkfx2ahmrg68TADNGgkXbTrcHwPXffL1AtRFFYXsoHCETrYZ3S', '2019-01-07 14:54:23', '2019-01-07 14:54:23', NULL),
(18, 'Sachin', 'Hajare', NULL, '7385186530', '$2y$10$/8nwYwiL93NLvm7Fdqs87.m9suuZ0VeM88ZYhxJDhK7to0RPj0Xiq', 11, 21, 9, 3, 1, '6UP5YO', 1, 1, NULL, 'iS7t5kTfGn8AUtTOluI6OoL9Wqo5FECFlWMhHP1hBL7za57KgoPnnHhb4ojp', '2019-01-08 13:06:19', '2019-01-08 13:06:19', NULL),
(19, 'Madhuri', 'Gajageshwar', NULL, '7387968420', '$2y$10$Amtq9incpdsy1ZHxkjdjQuBWSfxwWtlCGQdzoYjMt3a/aBtZtG38m', 5, 11, 9, 3, 1, 'M2k7ad', 1, 1, 1, 'lsl9iQO9hDqcEBBzgy4yGoR4uPY732QMx14VhUR7CBC4xnpnxS6KJSQjo688', '2019-01-08 13:13:29', '2019-01-08 13:53:39', NULL),
(20, 'Kunal', 'Godam', NULL, '8208035149', '$2y$10$ULwb18KI1lF/qkKfurgwi.yssn5e/aSEdDnqr9n60ZVbbmha.RkEy', 1, 2, 9, 3, 1, 'gpkuOI', 1, 1, NULL, '11FSl1ejPhz3pXrtxNpwmx8UEWjjMNLkGCl9Ky0U0ozBHUoORqPa8Rg96vq0', '2019-01-08 15:43:35', '2019-01-08 15:43:35', NULL),
(21, 'Prakash', 'Khandekar', NULL, '8624939596', '$2y$10$2GSynxr3xEIiXrUBQQ8BFukWL0iBG8WiO7USDaiMCuft2KS6slBL2', 5, 12, 9, 3, 1, '0u3bZz', 1, 1, 1, 'jxUM2yp0g1PX2YJA0BFuFQqn03lHjqRBXehoVjmxB7kxRtP0GLbVZGiwDvuy', '2019-01-09 11:47:17', '2019-05-18 00:03:58', NULL),
(22, 'Fajaj', 'Shaikh', NULL, '9860266785', '$2y$10$fqTgxc7kfidt5pSzB2wcnOS/j1KsnA1Ff.IV8a53pVlmez91CPs92', 11, 20, 9, 3, 1, 'eNRQY1', 1, 1, NULL, 'ZZQLb5mOS8Wv1GxkJDpmOAxF5IKatDve1LcZu0PO0nKALZ7tFwQyLnMIFgOP', '2019-01-09 11:49:08', '2019-01-09 11:49:08', NULL),
(23, 'Mangesh', 'Kendre', NULL, '9657990388', '$2y$10$2GmRjqj5/mi.L42kMO6Ey.964Ko24dhJWO2sNluVuesEcKs.KAlDa', 12, 23, 9, 3, 1, 'Ej93Me', 1, 1, NULL, '6VLgtRJ2wOgCv99rUBTXZTM3Sn7whbQk06uCXUOmfNf8mDKDi38h0Gh0oxtH', '2019-01-09 12:50:51', '2019-01-09 12:50:51', NULL),
(24, 'Jeevan', 'Chavan', NULL, '8668865569', '$2y$10$DrzAv96q.WNY89zOe67VNO2IQZ2ZqR2owc6hZcDeG4xasrMPR6taO', 2, 4, 9, 3, 1, '7idZin', 1, 1, NULL, 'n2wwDD4yVFVlB8H59MhWeJBqm8IiXZQd9siaKCbDMTZGBetfkZ9jQ6UAFCpR', '2019-01-09 13:13:48', '2019-01-09 13:13:48', NULL),
(25, 'Dattatrey', 'Koli', NULL, '9421204154', '$2y$10$Olbbu1fQNKHH1ZQM7/JrceY7BQqsLC2CSjLuDnUNN8F.T1SbTSS5e', 5, 40, 9, 3, 1, 'bqKjKC', 1, 1, 1, 'hcidcuICsDyD0jImoKPy77DaAUGiYVdzQimGBILo7lseqcF13j0rw6XgRiT5', '2019-01-10 11:33:07', '2019-05-18 00:06:31', NULL),
(26, 'Darshana', 'Bhavarkar', NULL, '8668334587', '$2y$10$eu/J9k9/t7tHeSEgG6jxFeWiXVrF6RO2Xgo30Bu93vThlD1sqJYu.', 2, 3, 9, 3, 1, '922759', 1, 1, 1, 'QlGkAsooBCpjGUUT3gjKzorQSFh643Zd299evFP8CxvqGGJnOm81kVOqzhM8', '2019-01-10 13:10:54', '2019-10-08 14:46:43', NULL),
(27, 'Dyanoba', 'Jadhav', NULL, '9860739727', '$2y$10$AXQgFx73l3VfGlwHsYxbi.jUE07qwl5IrNs6SL4D3YiBXrLlt0mfO', 6, 15, 9, 3, 1, 'fOOFLK', 1, 1, NULL, 'H1xnOGbXnpV3CZqERcZtOygcSkpjuyS8EVL46CyRaVnuqRlzUz1hRdySH6jF', '2019-01-10 14:17:47', '2019-01-10 14:17:47', NULL),
(28, 'Dattatray', 'Dighe', NULL, '9967164238', '$2y$10$SWg9Ruzv8T8nk1MvutPuW.IerJcfQn82uzf4XIVVcyCiRhYjanIBK', 23, 43, 9, 3, 1, 'vp5Cuy', 1, 1, NULL, 'nEFlvhvQwQbLfJi2ZCBuL3dT7GzNxGOg8XUOMshzLWoaayr6h4ckP2VuOYdE', '2019-01-10 15:13:41', '2019-01-10 15:13:41', NULL),
(29, 'Yashwant', 'Kulkarni', NULL, '9975351201', '$2y$10$67eUj9c3J34k/06T5My2UeTmARy6CswlZqHUpnYJyh5tlq2wt/eae', 3, 5, 9, 3, 1, '924914', 1, 1, NULL, 'COuy1OvyjcfQhB2Vw6f6QyPCJDB9Te4bm6tH1s4wxVFBItwu95qLNF0Ji8ev', '2019-01-11 13:01:16', '2019-01-11 13:01:16', NULL),
(30, 'Namrata', 'Dhanke', NULL, '8108991174', '$2y$10$wC/MzOsMFzcmtcy0InFDnuAGsmPjbBEgNQqsCqXu8t.mWUhGa/O.K', 17, 34, 9, 3, 1, '588883', 1, 1, NULL, 'fXjNIzqM4UzFdQZwKgY7XuY16MiKJeVXNMEtmYEty2rJHkK62V2lZas1fViK', '2019-01-11 14:16:59', '2019-01-11 14:16:59', NULL),
(31, 'Ravindra', 'Rathod', NULL, '9168572175', '$2y$10$Rep3AUSOpx7euCvX4Awhd.FHBAXEKw19ubCd4FAxPLhtKidz1Ugaa', 18, 35, 9, 3, 1, '1slgss', 1, 1, 1, 'savlDKOZMGpTQ5Zkxs8w1bhgu90UeV5zQHgm4KSz6ooYxCRsSsVA6FJ8Gvl5', '2019-01-11 16:09:01', '2019-01-11 16:11:39', NULL),
(32, 'Govind', 'Ujawane', NULL, '9921826222', '$2y$10$r/Yjy1qrQBR4Avj.pbKcK.UDTXezZIOc4NZv5dJA.FBtetpW.y85S', 18, 35, 7, 3, 1, 't2dG8v', 1, 1, NULL, 'dXB1cFKVwMSiMefBehRXEYjZEYnTgH2kusGjYSlerNlHUIOlM7SqFvt7SgA8', '2019-01-11 16:50:03', '2019-01-11 16:50:03', NULL),
(33, 'Anil', 'Patil', NULL, '9730702082', '$2y$10$qmzmDE0yvxJ8pK4/c4jpneCrdkc6EefTzEMr7G6VR9z2b/h109Q/W', 16, 31, 9, 3, 1, 'mCYW86', 1, 1, NULL, 'WhxHK6gf69Bk8cmtMkefpq9YSCHoKSDKVIEtazIiii0oICtvg4Ntr9gfOHUU', '2019-01-12 12:18:10', '2019-01-12 12:18:10', NULL),
(34, 'Vishal', 'Gade', NULL, '9922596506', '$2y$10$jxu2Hzy9n6BOGy03w.dNhuHJKUeLjacMwtbnk49T52lspCZfqGbb.', 15, 29, 9, 3, 1, '123456', 1, 1, 1, 'bznFCfsbNtCNag4hrWbFdn9druqb4p4SYlgblIH9AJ7WX8ymjhphqDT1DLMc', '2019-01-12 12:27:43', '2019-08-06 17:21:20', NULL),
(35, 'Rohini', 'Ajage', NULL, '9422995070', '$2y$10$REZkIK.rRAppDY4k4Vztr.KCNWKgal2fZAGK9MdanKZfO8P3kHlam', 9, 18, 9, 3, 1, '621038', 1, 1, 1, 'DxO0jnoWQgTnSPI5JykMpossoLZqiJtTM95eu8pV4r3LYW49RwzVJBiFOn5l', '2019-01-14 11:46:42', '2019-08-28 13:05:15', NULL),
(36, 'Keshav', 'Sangale', NULL, '8888812029', '$2y$10$ihu8kZD0tAY312ynsBPxXuux6l//OXf.lmPixMpOB3dKjeJRDtHCO', 9, 18, 7, 3, 1, 'z15JFi', 1, 1, NULL, 'ezNwTxcZT7xTFNZoNtUe8ecSMbPgBkkKmnr70jmx32HW0nWb29OZwpISTIYX', '2019-01-15 11:23:05', '2019-01-15 11:23:05', NULL),
(37, 'Amit', 'Bansode', NULL, '9172603940', '$2y$10$eU9Dd4JZttOIEt6fmLpIQu3Vr0JJ1Rp6ErocfpycmD48PZ2SttMK.', 6, 13, 9, 3, 1, 'fh5F5n', 1, 1, NULL, 'ffiC8INBKZco6vC1KhSG4vmpedzx9GdjCAmRpz2Moj86nNLo37a8bpwA6hcP', '2019-01-15 15:38:04', '2019-01-15 15:38:04', NULL),
(38, 'Snehal', 'Muneshwar', NULL, '8605483994', '$2y$10$keh8bxWsbIp6XJGc24Ld3.MJ1hD8ICKHqLbJ/qtoQL9rkgj2uCsCC', 19, 36, 9, 3, 1, '5VLWCD', 1, 1, 1, 'wQxYa07zlHG1oYgdD6S5Qtt55kXm1cgtn2rO5RdtCznd1UOQjAuX62jd7QBm', '2019-01-16 13:09:00', '2019-11-09 14:49:34', NULL),
(39, 'R.T.', 'Jadhav', NULL, '9850912415', '$2y$10$j1vEqFkV9zgdqc2d3ulS2uqv2X.4bj8.Fj8lMGJUW0plEu4S47EOy', 19, 37, 9, 3, 1, '1mwXGl', 1, 1, NULL, 'CgNCwD86vGcRDidy4E0EjnuCVjdj8O5WNvapgjlRIrHpcRECQR7NuINiKk88', '2019-01-16 16:45:12', '2019-07-26 16:01:07', NULL),
(40, 'Sandhya', 'Mane', NULL, '9420482095', '$2y$10$Tt7nZHViW1BEMUTQTSGKUOedmeRB3wvKRdYwqiBIJjbpuvGrgjVxm', 19, 37, 8, 3, 1, 'wKkk1s', 1, 1, NULL, 'ARSQaBDSdjqL0RbQg6w3WyR1SCoTysk6f0pqCtoIild2bH4bKRs84ycbSxWz', '2019-01-16 16:47:08', '2019-08-03 16:42:10', NULL),
(41, 'D.G.', 'Patil', NULL, '9421546748', '$2y$10$pdp617d6nRpBkwuqSIMSTOi6A8.YU3SN3ZcTILhz3wHK4grEXKJSm', 25, 45, 9, 3, 1, '898958', 1, 1, 1, 'tmapl0Fru9xnZsx3LWORkwZBCPWnSoAea18NVKvuhgCKV56E0YwaN7SqQOMI', '2019-01-18 11:30:21', '2019-07-11 16:33:53', NULL),
(42, 'Shrikrishna', 'Munde', NULL, '7038581003', '$2y$10$Nvm4phwi7itYAOlAyzCp4ODhgNI3k31HP0tBidiUtPLoGk2kLk6/a', 1, 1, 9, 3, 1, 'TE3OeX', 1, 1, NULL, 'HTvqQ7YlGlzePwYFKySP3EBE3weiR8TAvQNcjieh3CLbSGUvAOmNhKFSazVO', '2019-01-21 13:19:42', '2019-01-21 13:19:42', NULL),
(43, 'Dadarav', 'Darade', NULL, '9923845605', '', 2, 4, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-22 15:12:08', '2019-01-22 15:12:08', NULL),
(44, 'xxxxx', 'xxxxx', NULL, '0000000000', '', 2, 4, 7, 3, 0, '123456', 1, 1, 1, NULL, '2019-01-22 15:13:08', '2019-10-24 14:44:54', NULL),
(45, 'Badiram', 'Kinge', NULL, '9850468276', '$2y$10$ogd2n2tAHz/iyjzJcpitCOiexn5p92HeKzFPf5Ig8jS15pfnzy7IS', 2, 4, 38, 3, 1, '123456', 1, 1, NULL, '3jmkw9nZJCDLmwkXmlfSrsAIER3shudhr6RSP43OQXelMm9RaUkzlECtN60l', '2019-01-22 15:13:56', '2019-01-22 15:13:56', NULL),
(46, 'Pravin', 'Yadav', NULL, '9867053836', '$2y$10$tNuOARAOkL8rULDe9Kaome/xUqUPsJDi6J68SHoemJNVSPwkfjdmW', 17, 42, 9, 3, 1, '655286', 1, 1, NULL, 'v5i9aSunc2W8wORW0CNjtVe5sVrGpaugk0sXo2IRdCaDWzz7jRGCX9PT7G4S', '2019-01-22 15:37:08', '2019-01-22 15:37:08', NULL),
(47, 'Raju', 'Birajdar', NULL, '8275924242', '$2y$10$MItCynpV8eTHLlRpkC6AgO2lvJKuoDuEfS96oT55LGEgh6WeuerPO', 6, 14, 9, 3, 1, 'vgpT01', 1, 1, NULL, 'FSXPQb58pDu4d2X2MusHi6vknd6oi2zoOKe8iQ2tzNZBt9HobXHhTTPB5JbZ', '2019-01-23 13:54:49', '2019-01-23 13:54:49', NULL),
(48, 'Ashok', 'Pawar', NULL, '8208517944', '', 6, 14, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-23 13:56:19', '2019-01-23 13:56:19', NULL),
(49, 'Anuradha', 'Waghmare', NULL, '7721069031', '$2y$10$wRnO8lQbo/LVDoX/U4bXdetrqIc.c0icCsdF9r3cSkWtvh2pSrA.W', 6, 14, 38, 3, 1, 'XfH860', 1, 1, NULL, 'HKv74BRakeaQBCbDxvklM61tJt7a1ZCaBeKgPBNZ2267DRCKemFkRrQVKBQE', '2019-01-23 13:57:28', '2019-01-23 13:57:28', NULL),
(50, 'Yuvraj', 'Thadkar', NULL, '9922850099', '', 6, 14, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-23 13:59:12', '2019-01-23 13:59:12', NULL),
(51, 'S.A.', 'Bhivate', NULL, '8329773384', '$2y$10$CwE3YVlpntDXXgKGBfq9d.XPMOWCCk6A1L.k3weUrSwZeKszdVKD6', 2, 3, 6, 3, 1, '476112', 1, 1, NULL, 'yWO3J5FHZnztuQcCGVMNAyRXhAaThKw4accTYOS0lPODzoe0RA7U83oI166s', '2019-01-23 17:03:52', '2019-01-23 17:03:52', NULL),
(52, 'Ashok', 'Musale', NULL, '9922496649', '$2y$10$4Rho0qDYl0HSpTaawRrWTOZb5iyf.nZ5mGbf0YAkOUBeVgdjBZCU6', 2, 3, 7, 3, 1, '359944', 1, 1, NULL, 'wzuMxmY60A0Hpfwv8sIOzGss1cRsSzHTllI3XvowjIYxrm1XQza4uE0gJx1d', '2019-01-23 17:06:03', '2019-01-23 17:06:03', NULL),
(53, 'Ashok', 'Deshmukh', NULL, '9423445949', '$2y$10$u3udLmNg5rlm4O7hVqUGHu/pQlXVATtXv3QZSvItQlfM1BGG3rNvW', 2, 3, 38, 3, 1, '894466', 1, 1, 1, 'JKP3Owq4gqHzlukjPYmkqewkkMPTaC643uNfMPWRNXCvi6PrEkRXsYRw7J3Z', '2019-01-23 17:06:45', '2019-10-08 14:47:36', NULL),
(54, 'D.D.', 'Tangature', NULL, '9049348471', '$2y$10$9FwPo9Jq/rOgPv9YxcH3nuSAvMtO7OXo6IPVt79kP/5930SMh7pSm', 6, 13, 7, 3, 1, '8FjsH9', 1, 1, NULL, 'V31ObiNHCR6xDJ7Vckit4tkn1cftpvmaY0bfdTBw3AzztlCAT7UguEAJBLD7', '2019-01-24 14:05:53', '2019-01-24 14:05:53', NULL),
(55, 'Pramod', 'Bansode', NULL, '9970464550', '$2y$10$FpeyJuSkMVm4ApqrNkFqEuudGg6ml6diEWpzYomMVFdn8xbsbJioS', 6, 13, 38, 3, 1, '8E7uL7', 1, 1, NULL, 'WF4zM844AuwsQFD76N0L95noeLZ7kg3wqF2CoV5SmZGjbGRFhpMN5kBh0TIi', '2019-01-24 14:06:42', '2019-01-24 14:06:42', NULL),
(56, 'Shrinivas', 'Wagdarikar', NULL, '7058848249', '$2y$10$76MMHTCICHoKwAD/mr1FOeKkcDc/16XH17BJT78fEgynzQOSf1iJG', 6, 13, 6, 3, 1, '123456', 1, 1, 1, 'bXyOG3TdcNNtbL7z1xdzAcagpvBXEDElhbLSCHzRAGtQjGwlmbyXhuYbdjeS', '2019-01-24 14:07:32', '2019-02-06 14:30:55', NULL),
(57, 'Ujwala', 'Shetye', NULL, '9673243313', '$2y$10$kbJTzOMTFBQSrggB5udgc.NX1wLk1wdY0IfZSe5FoC9Rmf2rPmeiG', 14, 28, 9, 3, 1, '123456', 1, 1, NULL, 'ekEtS9ilQS7bQz2L794X6uHrtIabEoaOA4SYcx3GUjAbtP06NpCMQzJYFHhA', '2019-01-25 11:47:16', '2019-01-25 11:47:16', NULL),
(58, 'Sagar', 'Patil', NULL, '8275031742', '$2y$10$5vKwP1dcgC2.eYHEkNnp2.o6M82YRjVVcWY6mVGzFMbHbYtnuosFS', 5, 12, 7, 3, 1, '123456', 1, 1, 1, '7AvEVT0dUHdwn9NT3IZqz6EkrJ5UYCiL2MZiRUwIA4MYUcTOYx8omaKoRv6o', '2019-01-25 11:47:56', '2019-07-27 18:03:15', NULL),
(59, 'Ajaykumar', 'More', NULL, '9890041667', '', 14, 28, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-25 11:48:36', '2019-01-25 11:48:36', NULL),
(60, 'Subhash', 'Mandavkar', NULL, '9404762529', '$2y$10$/KRoZX0PX.opAmxeG9v8Gue.YX5xQNQC4L.iJ3QIuHuw6g/tbBNeC', 14, 28, 38, 3, 1, '123456', 1, 1, NULL, 'WnmdRNXmYPl8n2a69WQj0NPpzp25dv43UTFAnsYq81z5bQHm1kTM6QYoVwzS', '2019-01-25 12:22:57', '2019-01-25 12:22:57', NULL),
(61, 'Rameshwar', 'Hadbe', NULL, '7972390892', '', 12, 23, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-25 12:24:56', '2019-01-25 12:24:56', NULL),
(62, 'Ashok', 'Mekewad', NULL, '8552079526', '', 12, 23, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-25 12:26:00', '2019-01-25 12:26:00', NULL),
(63, 'Anand', 'Dharmadhikari', NULL, '9421386169', '', 12, 23, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-25 12:45:11', '2019-01-25 12:45:11', NULL),
(64, 'Anil', 'Bidave', NULL, '7020323638', '$2y$10$88NkQjofwix6ttUhe2zSrOTF0p6KxdGflBQoNwHjYXc4wIqc2kHEC', 1, 2, 7, 3, 1, '123456', 1, 1, NULL, 'A3GbVZBloGqiyCqQveClhX2cveYUCaSMql6GEyPSqxZLYdoSpFzXNcwCzEP1', '2019-01-25 15:02:22', '2019-01-25 15:02:22', NULL),
(65, 'Santosh', 'Chavan', NULL, '9604551668', '', 1, 2, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-25 15:03:23', '2019-01-25 15:03:23', NULL),
(66, 'R.B.', 'Rajput', NULL, '8668899870', '', 1, 2, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-25 15:14:56', '2019-01-25 15:14:56', NULL),
(67, 'Hanmant', 'Chapte', NULL, '9763554952', '$2y$10$cNtFeMfLl2KOZ1vzc.N3TuOZAK15HQhfexVFlOVP9uGkxrNOOol1y', 11, 20, 7, 3, 1, '123456', 1, 1, NULL, 'XSKOnm2Isi0R3V3EhrMOPNyx3vEW1XbjLxP9W0NNRIZFN3m8heguvTJZvhB3', '2019-01-30 10:36:20', '2019-01-30 10:36:20', NULL),
(68, 'Kishan', 'Jadhav', NULL, '9922156651', '$2y$10$PVkyPgQ9fKnDHeohVR9Zdeagaf4bfX3QEpAT3x900tfMN3e8sA4mW', 11, 20, 38, 3, 1, '123456', 1, 1, NULL, 'rC3fckf7xe2mlCh3sWH48P8nfpCkpcDnophCEMrYCMHyhVi1wfyjSYch48Hx', '2019-01-30 10:37:21', '2019-01-30 10:37:21', NULL),
(69, 'Dagdu', 'Kasbe', NULL, '8421040499', '$2y$10$VVFDLeOOF8e2vRuLem3xjOWS7lzYZLvk3ha0tfn5Dvq8F8zIDb09i', 11, 20, 6, 3, 1, '123456', 1, 1, NULL, 'jwsgy9HKmF9bZCDFtHznr4mRGJSQcVsFoZ6AAbaQbNKm9z6KhvR2vX7GmWPm', '2019-01-30 10:38:31', '2019-01-30 10:38:31', NULL),
(70, 'Babasaheb', 'Bansode', NULL, '9922248054', '', 16, 31, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-30 16:34:55', '2019-01-30 16:34:55', NULL),
(71, 'Parmeshwar', 'Jawale', NULL, '9921339010', '', 16, 31, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-30 16:35:48', '2019-01-30 16:35:48', NULL),
(72, 'Ramesh', 'Mantra', NULL, '9970247008', '', 16, 31, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-01-30 16:36:39', '2019-01-30 16:36:39', NULL),
(73, 'Jankiram', 'Holkar', NULL, '9284183626', '$2y$10$mseBQcKmqKUV7ZEW4nr7J.uvCvLaQ6ShI31TOAFh.rd2Ax8xxtYQy', 4, 7, 9, 3, 1, '503136', 1, 1, 1, 'D85bjgJlGnJXdThbqodE8fylnTHsn5R4Sm97Czw0w7Vo2Z8l5kJamiEXlAMX', '2019-02-01 11:56:22', '2019-10-15 16:12:57', NULL),
(74, 'Sanjay', 'Shinde', NULL, '9730947844', '$2y$10$kMTCXUDk3Cp4dmm1MIZsge3bJxJ1TG5vwXj8ThOLFt5Yi4XDbMM7e', 5, 11, 7, 3, 1, '123456', 1, 1, NULL, 'Ze0aa3G5sJQ71nSNPW8I7an8GCVAwGKBbyPNRvcRkV9byORTbUxykVmVneXv', '2019-02-01 14:44:39', '2019-02-01 14:44:39', NULL),
(75, 'Laxman', 'Lokhande', NULL, '8329881675', '', 4, 7, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-02-01 14:45:49', '2019-02-01 14:45:49', NULL),
(76, 'Vijaysingh', 'Jadhav', NULL, '9850712126', '$2y$10$iXvH5mDJOfKOoJ/iqAVls.6VyV5dXrpmZeBuOTmaCxXgiwuYqsDvW', 5, 11, 38, 3, 1, '123456', 1, 1, NULL, 'HN1RVh9ZJZnn0q9sLVrE0UL9nwMt5HQrHzAZH21J1o6FGw3KOi5fRJc570qg', '2019-02-01 14:50:41', '2019-02-01 14:50:41', NULL),
(77, 'Ajay', 'Patil', NULL, '8554935906', '$2y$10$3IevA9joRIGaFUKUjOpkbeE3Q56MWUUrUNFOgfEFz7MyhEvIj5EFK', 5, 11, 6, 3, 1, '123456', 1, 1, NULL, 'uNAq8W7R6qY9x4i8ox8PDlbqDvQVkhnxfkVx6H91XVt1tzhR16SX5zV7t9hi', '2019-02-01 14:51:45', '2019-02-01 14:51:45', NULL),
(78, 'Umesh', 'Shinde', NULL, '9421420053', '$2y$10$L0t6t7N92/ats1wuKJBhHu4GTI5K4L8f8rgrqKLVl3mT2s87MAdF.', 4, 7, 38, 3, 1, '278450', 1, 1, NULL, 'EcBANY8eFmVdnUOhUR3kVXjUzXiUgcdRyRItiZj62m4kL4mK11go1rDBQ8W6', '2019-02-01 14:53:48', '2019-02-01 14:53:48', NULL),
(79, 'Sumit', 'Mahajan', NULL, '9420223944', '$2y$10$cqhXkRJMtoCdJpEZ5AlvLOw2TtD4YFUoo61PRW80A7Nkxb/devkFe', 8, 17, 9, 3, 1, '123456', 1, 1, NULL, 'eJKn2VDch1OCFbay8wik7LH4FFKVT3o2t2okhTdEbP3bDlcpGYLywz0yOdk8', '2019-02-02 12:29:50', '2019-02-02 13:39:02', NULL),
(80, 'Rajkumar', 'Tiprale', NULL, '9975031292', '$2y$10$xloaFAIO2XxE98u9TQLfReEztTwUKesPfr482ZQTg74VXHoeO8Dt2', 8, 17, 7, 3, 1, '123456', 1, 1, NULL, 'pmWv0gWgHPTJ8oIbJBh7RcXrtaaklBG8VxI2atubRmW2jJ59okZUbTlzCUaC', '2019-02-02 13:53:32', '2019-02-02 13:53:32', NULL),
(81, 'Satish', 'Gunjkar', NULL, '9970973286', '$2y$10$0zpXGW26Q20oT7IApk1I3OpvK9k9JbA95zZT8mO4mExjxjW5VTiWO', 8, 17, 38, 3, 1, '2gkYxo', 1, 1, NULL, 'vCiia8O9zX0NkebEzZwh6uyYWjvdrYQMOFDqnbWBBqX1gQZBocsetOkQZALl', '2019-02-02 14:27:13', '2019-02-02 14:27:13', NULL),
(82, 'Purushottam', 'Vyavahare', NULL, '9970706024', '$2y$10$hOPcSl/id1F7ViBTd.j9COLDQoad82ryAAJ8lD.sU1k3684TV4RAq', 8, 17, 6, 3, 1, '123456', 1, 1, NULL, 'V0FNEXZdPcIKVeRNA0b0LpMGZqVztEFqS6XUkm3nGBzhZaCiGhrXUQBtf0Mr', '2019-02-02 14:28:09', '2019-02-02 14:28:09', NULL),
(83, 'Rakesh', 'Ramteke', NULL, '9096359068', '$2y$10$ogRLXManoKlows2qc1wKFun/OpmOW3Q5y8i9bMSWMqM8Tsg0/r5AG', 7, 108, 7, 3, 1, 'BtPC4h', 1, 1, 1, 'QVTmJacEEiQfAOcFHgoZSxaGxpxsMCRyK5rkKooxDHJP3pntfB9WuSH47Ywa', '2019-02-04 15:14:17', '2019-05-24 12:30:26', NULL),
(84, 'Jagdish', 'Atram', NULL, '8554984400', '$2y$10$CdZx/5XSbxnwgItNT8EnOefKVc0qlD54k9QAB3SUu1BlcUm3x6pU6', 7, 108, 38, 3, 1, 'qQSKID', 1, 1, 1, 'iBJ5HF8YqtvE9U9ggrXoXUKXFUL0Loj4n9ZEJOK15SEZi7oAY2oE4aQ0X34S', '2019-02-04 15:15:01', '2019-05-24 12:31:39', NULL),
(85, 'Vijay', 'Kude', 'dmstganeshpeth@gmail.com', '7020446886', '$2y$10$xp5LBS2.vrMCinTbZLgXe.4JmkoJPgYZ436.3EmWi/dBmeNipzgu.', 7, 108, 6, 3, 1, 'DiheU1', 1, 1, 1, 'nPauU7kv6JKOj1NlH6XT5GJyYwKgmEbhdTLAOepbUKnqMRPzRZv93FDPfcBL', '2019-02-04 15:17:20', '2019-05-24 12:35:14', NULL),
(86, 'Pravin', 'Jadhav', NULL, '9404270130', '', 6, 15, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-02-06 13:01:44', '2019-02-06 13:01:44', NULL),
(87, 'Santosh', 'Bridve', NULL, '9890088144', '', 6, 15, 38, 3, 0, NULL, 1, 1, 1, NULL, '2019-02-06 13:03:32', '2019-03-22 10:13:50', NULL),
(88, 'Yashawant', 'Kamtode', NULL, '9881671293', '', 6, 15, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-02-06 13:04:48', '2019-02-06 13:04:48', NULL),
(89, 'Prathamesh', 'Borse', NULL, '9130387687', '$2y$10$ObAB1Gy1niSnASPgPNepHOgaYRkpCMgEXa6M1ChCHZE37wAHDX8iq', 3, 5, 6, 3, 1, '428771', 1, 1, NULL, 'lFItmznKysJtRMlPSdqn8dpL1s4FfPnjVEMgq0pgkTuFS7jB7fM1Rq1esIs4', '2019-02-07 17:18:45', '2019-02-07 17:18:45', NULL),
(90, 'Nilima', 'Bagul', NULL, '8390349700', '$2y$10$wwmNAAL.2pQNA9OFAaE.qeBw7Kirs7bZeEVCREtrpjlX.2OYk9JEK', 3, 5, 7, 3, 1, 'GHjQv0', 1, 1, NULL, 'cFFuMWQfyrwqWJ1qlFQMNBd9dO4iP2cnscvYzAzojFoKJkg2aDlJMTjD7ycx', '2019-02-07 17:19:34', '2019-02-07 17:19:34', NULL),
(91, 'Ashok', 'Sapkale', NULL, '9421001258', '', 3, 5, 38, 3, 0, NULL, 1, 1, 1, NULL, '2019-02-07 17:20:33', '2019-05-27 11:10:02', NULL),
(92, 'Anil', 'Bahiram', NULL, '9158931344', '$2y$10$Y03luSIxRVerApjg.v14pORcv9KfFCy.2lXJrutKpmSYAPzH25F.i', 10, 58, 38, 3, 1, 'zln9lT', 1, 1, NULL, 'dE5KvEt0j0Pejf25BItrcCuBu6VrrWPwwuFaz8UxJY7R5lfydCpanX73zQhQ', '2019-02-28 11:35:06', '2019-03-13 12:51:06', NULL),
(93, 'Kamini', 'Patil', NULL, '9518783028', '$2y$10$Z9dIC9RA4O9cALvuPkRHC.3QZA4Et/0j9WJzgWYFihEVaEQFJuGGG', 10, 58, 9, 3, 1, 'rsrNjR', 1, 1, NULL, '3LMDDWXKjshJJAGeC05zNfG0i0ZtAUptkxLveJUbjkB8vCtxvuqdFLpI8JJo', '2019-03-02 17:08:45', '2019-03-02 17:08:45', NULL),
(94, 'Ghanshyam', 'Bagul', NULL, '9423918021', '$2y$10$fTobT8o/YRvFuasRHaqN4OepSvGz9aQSvrYg8CZMwANo7uYfMUl5K', 10, 58, 7, 3, 1, '617441', 1, 1, 1, '3FdVVdXrjRh6DuEn6yVZRnvTvXUb9iLSCV3qfz3w9w6edxzoS4jVzTF1AIhe', '2019-03-02 17:09:37', '2019-05-27 11:01:15', NULL),
(95, 'Bhagwan', 'Jagnor', NULL, '9403162299', '$2y$10$gWUnrLuGpHTqK/Snq/Igiu4lOi.iiop/8QKfRrVht5QRpnohctPrG', 10, 58, 6, 3, 1, 'ScohgM', 1, 1, NULL, 'JL8PMawaLL89Fy2MvEWGKqdKiUjjf2OIYwSa2ZhDPBlyyXN8BNSMQig93jE0', '2019-03-02 17:11:01', '2019-03-02 17:11:01', NULL),
(96, 'Sandip', 'Gavate', NULL, '9850519597', '$2y$10$ERXFeXDbnE8ZT7UgGR7ViO582bbL6/wbB1f3B4VzcaBOcxkvY7yAK', 26, 75, 9, 3, 1, '958504', 1, 1, 1, '6ymbWHzXoisifupkcPcdeNCnl3MbzG64Tcj0igW7m9z2OVbQSykvnIqGNxqx', '2019-03-08 10:59:30', '2019-05-27 10:08:09', NULL),
(97, 'Hemlal', 'Naik', NULL, '9284312694', '$2y$10$JHqWUQ3cf1xmGOJ3jUnStOEpJB/hKuRGZkDMDzhmbXFrOWFDdSvzi', 29, 59, 9, 3, 1, 'gJaXYa', 1, 1, 1, 'bhZInRTiMd2MqtMptQimDtioIF9FrE6Sqct4iSYf2NG8M7f5p1e1z9Flm2T3', '2019-03-15 11:18:33', '2019-05-24 15:39:11', NULL),
(98, 'Navnath', 'Dhakane', NULL, '9595504163', '$2y$10$Zcm/gY.Kju3.xT09Gr/BN.fno8divNFlI36LW2fccyDUwC0Tq32pO', 30, 60, 9, 3, 1, '6D78XU', 1, 1, NULL, 'Wf2eIIHZy6fa0odoDD8y2XWiQGRfUPnYXcSenRHWPFuzYvcjL4KQT5tVFz3z', '2019-03-18 14:13:21', '2019-03-18 14:13:21', NULL),
(99, 'A.P', 'Manmode', NULL, '9869465074', '$2y$10$4zde01yl4BWDCQfHFEmZ2.Mu4qjnuwBsmbS7aq0ta/WtoalQEcc5y', 23, 43, 7, 3, 1, 'G3W9MY', 1, 1, NULL, 'vEdv1lW0SGJRKHXzaRj4tQDwgKZLGkgRf6adNA4oGFJwUobVLDmkRf1im9zF', '2019-03-25 14:20:20', '2019-03-25 14:20:20', NULL),
(100, 'Bharat', 'Pashilkar', NULL, '8286637850', '$2y$10$oM58QcrNYxlDWSQG1iV0v.tOweBwD635zICE9mVAfqwZkgt49nvZS', 23, 43, 38, 3, 1, 'zkqSVW', 1, 1, NULL, 'mJOjAZFQYSbBramFcXQDruptP46tjLxiixUv9Sdw969dKFJJtZ7mJpMvntd5', '2019-03-25 14:21:25', '2019-03-25 14:21:25', NULL),
(101, 'Gulab', 'Bachhav', NULL, '9423358981', '$2y$10$ukYOYG07CbRODBdEuAta5u/LGgI36bsY7RmHU3DqHtEaXrVG.zJQi', 23, 43, 6, 3, 1, 'c5VrUs', 1, 1, 1, 'L1vpBOsxXfkrfQyJQoXwe9i3DnFuNWmYt9G7f51gSjI9CCfyP7fBb818BhCW', '2019-03-25 14:22:15', '2019-03-25 14:25:40', NULL),
(102, 'Dilip', 'Hindalekar', NULL, '9421234844', '', 31, 61, 9, 3, 0, 'tSRb7J', 1, 1, NULL, NULL, '2019-03-27 10:57:31', '2019-03-27 10:57:31', NULL),
(103, 'Prashant', 'Gujarathi', NULL, '9422288123', '$2y$10$Ez3ZZwZ27BbXNlHL7YPgTOA4NFQg33mA7QaghXBCO/2R0Cm8Sj.Tu', 10, 19, 9, 3, 1, '6mO83R', 1, 1, NULL, 'QtzvIATJtmZRT4MEOryFLzLEN756gIaoPVRHcanA87AIXsCN5LyG5rbgSzC4', '2019-04-26 01:01:28', '2019-04-26 01:01:28', NULL),
(104, 'Manoj', 'Tiwari', NULL, '7798769890', '', 10, 19, 7, 3, 0, NULL, 1, 1, 1, NULL, '2019-04-26 01:02:11', '2019-05-27 11:03:07', NULL),
(105, 'Dilip', 'Valvi', NULL, '9403428130', '$2y$10$E0Pw/g0gcx6V3.54yYo4HuQa/Vao6TE77CvKXdDyBPsQ25sl3xnAO', 10, 19, 38, 3, 1, 'BR3Y8g', 1, 1, NULL, 'nbp4QoqJ4hLFp3h4nO2i7if5egvTNybHM1GDbtpdr6Z6Fnr3Xe7bqUyS14VC', '2019-04-26 01:13:46', '2019-04-26 01:13:46', NULL),
(106, 'Manoj', 'Pawar', NULL, '9420703884', '$2y$10$YZzEcm/NLdSeSPGP02OlVuuBxgxFhbsES4DV1Si1nFcFXnGGfXGmC', 10, 19, 6, 3, 1, 'W5kEXy', 1, 1, NULL, 'drA9FKRv1l7c3ug6FHuXG1IwQPAokqmcO7soBPLdgUEFVNOCmXea1XJF5kgE', '2019-04-26 01:14:28', '2019-04-26 01:14:28', NULL),
(107, 'Raghunath', 'Savakare', NULL, '9403425894', '$2y$10$6InA29Xra1nPoboZdjhG.OBSW0NezaH0wnnCMBTPng3fyYwI3iFVO', 10, 58, 5, 2, 1, '2j55y0', 1, 1, 1, 'UVnCfzPcmKT4UWhuRxU9hGeoGWp7E9wvPNQdFHfErI7Q6esnLCAvsJHctXzB', '2019-04-26 01:15:03', '2019-05-27 10:58:16', NULL),
(108, 'Milind', 'Sangale', NULL, '8208737059', '$2y$10$BsyMXnLq6P2agn7FsPQHFOW3KnboWuMdTst3HnD03NtIdwJS6pTKO', 10, 58, 4, 2, 1, '8Tm0PD', 1, 1, 1, 'XgpRGyFX0hvkomxGgQqhOHbTjIr5B4Sq7burHbhHwjSYzo9myiSl1ttEmQt4', '2019-04-26 01:15:37', '2019-05-27 10:58:56', NULL),
(109, 'Manisha', 'Sapkal', NULL, '9405572362', '', 10, 58, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:16:24', '2019-04-26 01:16:24', NULL),
(110, 'S.B.', 'Sayyad', NULL, '9420909484', '', 31, 62, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:19:50', '2019-04-26 01:19:50', NULL),
(111, 'A.A.', 'Kamate', NULL, '9403368585', '', 31, 62, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:20:59', '2019-04-26 01:20:59', NULL),
(112, 'P.V.', 'Yelekar', NULL, '7887301090', '', 31, 62, 9, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:22:37', '2019-04-26 01:22:37', NULL),
(113, 'Kiran', 'Saptsagar', NULL, '9423821040', '', 5, 63, 9, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:28:46', '2019-04-26 01:28:46', NULL),
(114, 'Salim', 'Ahamad', NULL, '9096821153', '', 5, 63, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:29:18', '2019-04-26 01:29:18', NULL),
(115, 'Bhagyashri', 'Joshi', NULL, '8605065712', '', 5, 63, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:30:13', '2019-04-26 01:30:13', NULL),
(116, 'Sudhir', 'Sutar', NULL, '9270130520', '', 5, 63, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:30:48', '2019-04-26 01:30:48', NULL),
(117, 'Sainath', 'Khedaker', NULL, '7972516725', '$2y$10$FdIk7gLqhtzuR0ikAzVp0uWdlctLXsmUZCEblbJBiDAU93NrfNTrG', 26, 64, 9, 3, 1, '512211', 1, 1, NULL, '0CPx3St6Le3MBp9u4vR3lElRvczr1OvSwuPvenzZNHKAVnPR9HvP0CFzhyjJ', '2019-04-26 01:32:59', '2019-04-26 01:32:59', NULL),
(118, 'Pravin', 'Divaker', NULL, '9527284953', '$2y$10$qrDLOsU3SxOHv/wx8nEA7uPAxONX4KmRezrEfMOcCG40MDXzdlwWi', 26, 64, 7, 3, 1, 'bQ21mr', 1, 1, NULL, 'IylH2qv8DbpAGjP0OVtM9YbqxxN6AzR1iVhlCdLndskH9DEU9aQzb7Aq0hpM', '2019-04-26 01:33:34', '2019-04-26 01:33:34', NULL),
(119, 'Rijavanabi', 'Sheikh', NULL, '9552312866', '$2y$10$7gI4fNXxbZVwbHvtMAuIyuYh9JA.FrMd5ywnD/HrRasmjZtcRcgTO', 26, 64, 38, 3, 1, 'l407dP', 1, 1, NULL, 'DcjnKleyqOg3xzB2LolYUEzEWWI3pITqtGAjZiBRbeGdGhJERCapieRJUMlT', '2019-04-26 01:34:39', '2019-04-26 01:34:39', NULL),
(120, 'Vasudev', 'Devraj', NULL, '8007448344', '$2y$10$EGgskjPODK2NeXrnbw1sa.T1HohC2bt4FHKX6OhVsrBq905PwctUi', 26, 64, 6, 3, 1, 'sDFfkm', 1, 1, NULL, 'xTHmU4uFTO02DxCTByeAf5mbwXZpJ4xRYhg1ygaQkNgRc32pCy7DmcHDZpZt', '2019-04-26 01:35:10', '2019-04-26 01:35:10', NULL),
(121, 'Nitin', 'Hatavalane', NULL, '9890182453', '$2y$10$Fy6qnxijksNJrwdffh6BvOHPFWEnZkLNaAAFfAc4tr8RabOqn3Ggi', 26, 65, 5, 2, 1, '5IVKFr', 1, 1, NULL, 'xu5u8gLSIg1sJKdgPLDBIrWfMHnxKBMgsiwVaTs1BLVzSC6OGcKvzvydybss', '2019-04-26 01:37:07', '2019-04-26 01:37:07', NULL),
(122, 'Vrunda', 'Kangale', NULL, '9766034063', '$2y$10$GGVgxKQNYF0fNgA21d52.ODAOzdsubft1xgm7JuiZeCfjnBtbNHRy', 26, 65, 4, 2, 1, '9DBJnn', 1, 1, NULL, 'pGhfmJ8jUnldKhYldczfmA0KVzv2wQWSCR7XmQNVREi1vPkgtEpH6fslLnKh', '2019-04-26 01:37:42', '2019-04-26 01:37:42', NULL),
(123, 'Vijay', 'Gite', NULL, '9403709123', '', 26, 65, 10, 2, 0, NULL, 1, 1, 1, NULL, '2019-04-26 01:38:07', '2019-05-27 10:02:29', NULL),
(124, 'Suchita', 'Pawar', NULL, '9112812065', '$2y$10$oiS/8cwPZwGvaUdghkCgg.I1pgfWAKceBDAyZc1Q5dyv/K.1Dd0Pa', 9, 66, 9, 3, 1, 'CmSRcE', 1, 1, NULL, 'fZqUdE8K2btcbHWTIhlQKnaghSmmXZG8cBm2iQoapF9MfOmBkoCbslV8R67A', '2019-04-26 01:50:04', '2019-04-26 01:50:04', NULL),
(125, 'Prakash', 'Mahajan', NULL, '9552745061', '$2y$10$yU76oQTodbdcWp5NZeHQ2.D7G2XwRfkAkpoZmW7HM.gzLxXzwxOOS', 9, 66, 7, 3, 1, 'Gxp4qF', 1, 1, NULL, 'J5IpyhguErzclNlaS2ybSD5gSCP4kWwC3wRe4BleWofRGOumb8YP30BsM14W', '2019-04-26 01:50:40', '2019-04-26 01:50:40', NULL),
(126, 'Kailas', 'Mandge', NULL, '9545172023', '$2y$10$A/mm7xSwykabnBgi296fT.gjJV4BHyuEjl1mpCQkCX9ANeVW/jnRS', 9, 66, 38, 3, 1, 'CQkEIU', 1, 1, NULL, '0ewg1rByornGVxgrOj7aZi1QQ7QMvz3Y7rss5hMs7lEVGPGQDAB2MbVs4YnS', '2019-04-26 01:51:21', '2019-04-26 01:51:21', NULL),
(127, 'Umesh', 'Birari', NULL, '9028925891', '$2y$10$LrCnfIsO0qR2cRfEnLzCduDpx9gXQAeNMJkiQn50L3BqTK6kuGmIy', 9, 66, 6, 3, 1, 'WY9HtI', 1, 1, NULL, '6AJrchGYJ1rhkjJxCgCGxuEaSbgmkQ3mgpiCKp9a880D6JXOoUrUdW31EJQO', '2019-04-26 01:52:02', '2019-04-26 01:52:02', NULL),
(128, 'Kiran', 'Deshmukh', NULL, '9890321047', '$2y$10$3Kg/vZ6ywTxgP2880baHF.2oJiZGOmnSnuyHvhmn0OzUeAo8h1CZe', 9, 18, 4, 2, 1, 'fGNPbW', 1, 1, 1, 'b5EsqcRv2JC5LIXiC9yH7wcLmF21GOTdTPbFdO9Dq05ejTPelueRioX7kySI', '2019-04-26 01:52:36', '2019-05-27 11:49:16', NULL),
(129, 'Nitin', 'Maind', NULL, '9325386692', '', 9, 18, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 01:53:16', '2019-04-26 01:53:16', NULL),
(130, 'Sunil', 'Sapre', NULL, '9021247843', '$2y$10$Q1O/UBbCcdgVAoa9l1IGcORgAT0q5xWfnL1vSyEWSNJrqIRy.zKBC', 10, 67, 9, 3, 1, '7mxYts', 1, 1, NULL, 'R0Cd9Me14F65kOPFEwfTZJuOYGUQ8zJGYBtO2BErUJGhHhlEHDgUOBPYjIuq', '2019-04-26 01:55:33', '2019-04-26 01:55:33', NULL),
(131, 'Kishor', 'Magre', NULL, '9028561229', '$2y$10$SR3PDqmBmKaeaK.Q6Q1tauzfAHeEDba.VJxL9s3GgiPi2MrYpUSje', 10, 67, 7, 3, 1, 'iX8yvt', 1, 1, NULL, 'kSPkqWAvwdRxPREHLvHJxrZfvso2ZGdpOaLWaAoLuBuG1xduYS4e0tylej0o', '2019-04-26 01:56:02', '2019-04-26 01:56:02', NULL),
(132, 'Gautam', 'Pawar', NULL, '9420601395', '$2y$10$X1g3bjUMMeZQQxA/ulWdtuNmAkc3TPUOOlsIdKFMAHSpUJp5TiTGa', 10, 67, 38, 3, 1, '548024', 1, 1, NULL, 'mh2LHAEUxxeJAuDtWiPUbEEQppRnLdPx4WMvpm3VmtuQnYkRhRa7YfLmaPll', '2019-04-26 01:56:41', '2019-04-26 01:56:41', NULL),
(133, 'Yogesh', 'Lingayat', NULL, '9403714511', '$2y$10$pEeyUHOvd4nid1Tc4aAi7eOppxkgWBrBN8vaFkR7VTTK2umx22fLu', 10, 67, 6, 3, 1, 'dl6FVi', 1, 1, 1, 'B0jYszFJKBZRg3Odg8QxKUdPcvwfxqH3cbLdDPqVCXFEbYKVugbN4kYOU0LJ', '2019-04-26 01:57:08', '2019-05-27 11:28:32', NULL),
(134, 'Dipti', 'Murkute', NULL, '8999870757', '$2y$10$K3kvotBQ3KVmTCvh9z5Q9.3al5MhRR6p0AISd6WmVpsMCk.gcoi4K', 6, 68, 9, 3, 1, '234170', 1, 1, 1, 'OoxUJVNhA5RgeSUVqCrrdGpM0chTeRM9A77iQJ98FzgqhSkAixtY7NveuxaX', '2019-04-26 02:11:25', '2019-10-01 16:00:14', NULL),
(135, 'Chandmiya', 'Deshmukh', NULL, '9922215812', '$2y$10$02ytMHm.c3cXBZEcXo45x.EFXlSq3Zq9123SPWiIMxDj7flJpL0Qy', 6, 68, 7, 3, 1, '996249', 1, 1, NULL, 'GKaJ93upx97csPvF4HnyNsh8x8GlMqjzTK7mUPlTvTkKFJI058qj1KdbJ01b', '2019-04-26 02:12:12', '2019-04-26 02:12:12', NULL),
(136, 'Rajkumar', 'Gaikwad', NULL, '9421694624', '$2y$10$SeKradc3U6JPWvZouW1kQ.1jyw.tezZssTThmjRyqH2RspW6TT.x.', 6, 68, 38, 3, 1, '675597', 1, 1, NULL, NULL, '2019-04-26 02:12:44', '2019-04-26 02:12:44', NULL),
(137, 'Mithun', 'Rathod', NULL, '8999721203', '$2y$10$mx0XFgTBhsE/ceulPIKNOec7410/SSPZBEJyKIXAK0gpPi1iH8Xrq', 6, 68, 6, 3, 1, '196214', 1, 1, NULL, 'iIJYFSndSbV97fbzAQKizEFRCgaaqKG25BZU8FtduxwuuxVoKchKxnennVWJ', '2019-04-26 02:13:29', '2019-04-26 02:13:29', NULL),
(138, 'Ramakant', 'Patil', NULL, '9834298740', '$2y$10$9QvkBaydc5dboHOpQFMSq.FqDuaFmMqJGcTDn4ipQ6Gnldn47UTBu', 6, 15, 5, 2, 1, 'ZRGdPF', 1, 1, 1, 'E1om767pUuZUEzTis1HMx8gZNn1c1JpjFa8kCBiV88cJ14graVyADgSXULsG', '2019-04-26 02:14:16', '2019-05-22 14:43:04', NULL),
(139, 'A', 'Bandgar', NULL, '7620645982', '', 6, 15, 4, 2, 0, NULL, 1, 1, NULL, NULL, '2019-04-26 02:14:49', '2019-04-26 02:14:49', NULL),
(140, 'Sachin', 'Shirsagar', NULL, '9422548204', '$2y$10$ph3b1.azGjnzYrhn4.7OLu4znGjDDL0e8KN2JdT2su7cnKv/9sb6e', 6, 15, 10, 2, 1, 'MYb5sM', 1, 1, NULL, 'hoCc2ixLchmFtYbyzDHUUhgPSbDd2KnhMdgGRAn1IPGyS8p42WWYCAnJrFZd', '2019-04-26 02:15:28', '2019-04-26 02:15:28', NULL),
(141, 'Suraj', 'Deshmukh', NULL, '9850368610', '$2y$10$X9sgnIn.hsjD89XPt5finOvCiuN.uhCp8QY2sb12pcB3EE4md39zO', 32, 69, 9, 3, 1, '6kkuHa', 1, 1, NULL, 'XQLkh66owY98in6jNGQfI32y5p8oNLvgC21aEUhn0P6bR0BJI1a81gTO77BJ', '2019-04-26 02:20:35', '2019-04-26 02:20:35', NULL),
(142, 'Shailesh', 'Gavai', NULL, '7057206368', '$2y$10$ur868Fo16BsKyr3ywu3PSOjNqpVUbKmu7/VipB8SPhtMQCjUTd5XW', 32, 69, 7, 3, 1, 'HniY0s', 1, 1, NULL, '94ibb5qBDAjhUD2RMYtmpsqmo5kmYuPNpivuJWPqHLDVmdf00Gkv2umwZUFv', '2019-04-26 02:21:05', '2019-04-26 02:21:05', NULL),
(143, 'Abhishek', 'Gulhane', NULL, '9764196237', '$2y$10$cemHJpfd/vzTK8Sr.GS/TuxpTekJKn6ui7R4N9qy6NJ0tqNL0mZ1a', 32, 69, 38, 3, 1, '643212', 1, 1, 1, 'pqGkbG9qV2GzlVlWKfPepURyqnP5PkCllJHXLUetJlwGxNUZxxMMTbLp4SvU', '2019-04-26 02:21:45', '2019-05-24 15:07:28', NULL),
(144, 'Nitin', 'Jaiswal', 'depotmanageramt@gmail.com', '9175157999', '$2y$10$mgO3E6U47SFtZirtPUWAMO5nQan.DRoSriOvYQobmQYkewQsN1mz6', 32, 69, 6, 3, 1, 'F2LYMp', 1, 1, 1, 'xx524FsQrVdkQnlIqpSNdS6MXvfi7TazuD82AYnhqpPYB8d9i9AMYM3HPy5t', '2019-04-26 02:22:07', '2019-05-24 15:17:31', NULL),
(145, 'Pallavi', 'Patil', NULL, '7350303871', '$2y$10$L/rav0mswM29g62tWPnpzOtjY7bwb0SzagSB/mUxqKE3be7sdxwdu', 19, 37, 7, 3, 1, 'DlCckd', 1, 1, NULL, 'qhYiq9vlBMevEbzuIRLQPxyfEDa5xon5DzwFK4GIJyMHDNv86o5yj7CJXI5s', '2019-04-26 02:22:55', '2019-04-26 02:22:55', NULL),
(146, 'C.V.', 'Bhokate', NULL, '9881397549', '$2y$10$MsqjF7Z0cBXgYKAUdiUGD.0E2J9qAmWXW2CBIFLB9yoerfE8XN2va', 19, 37, 38, 3, 1, 'zqlUZP', 1, 1, NULL, 'gxU8DmTKxIfqbuSieVU5WbZsesSJDAuJ2eaKuzKxekZeZa2QqFg83ew6F5v2', '2019-04-26 02:23:31', '2019-04-26 02:23:31', NULL),
(147, 'Sanjay', 'Bhosale', NULL, '7972430680', '$2y$10$q2m42oJhfrqZl6xD/qJ9m.kKZEsCnSdwt7Zb0bnj1uLNE3heBHVbu', 19, 37, 6, 3, 1, '268079', 1, 1, 1, '1bqoI5fNTZtCCPneELbJj5NQDFSDNerBUOXKpCBdzPAMgB06gc0Vbl0FEsls', '2019-04-26 02:24:04', '2019-05-14 14:05:43', NULL),
(148, 'Salim', 'Shaikh', NULL, '9890009029', '$2y$10$bz1f.Wv6WKLQ5/mT7yaqpuru4Oa1DnwtfD0.arvSBSroWLGkavQni', 19, 70, 9, 3, 1, 'PtBsp3', 1, 1, 1, 'L43Om5tqXE07qErmQ0qoYsFEUOghg4el6cRZn5XapLwqJzdS86LCP2LGeUoN', '2019-04-26 02:25:03', '2019-05-14 13:29:51', NULL),
(149, 'Parshuram', 'Bhosale', NULL, '9284213221', '$2y$10$2SBduZ0AhTm2WiAlnACdvOyUo7EzLtod8Axly/g5wyXTtVqkJXcDi', 19, 70, 7, 3, 1, 'NoYecO', 1, 1, 1, 'jEkS1oGmlqvAjERr5Do9cfSK0SYe0I4kLrAv4yTfF5pbPasQbRGZTUnoqmRV', '2019-04-26 02:25:40', '2019-05-14 14:04:24', NULL),
(150, 'Sanjay', 'Ratnaparkhi', NULL, '9730318325', '$2y$10$SOaTmP4iyvpC2ENCAweMROVmrTQC3EtXrXiX5Jh9oovbLhFTjXGEi', 19, 70, 38, 3, 1, 'pOFosH', 1, 1, NULL, 'jn5NRlllcc3Y1zlOp37wm8hpFEi5xj7K2vxFRQ2bcDLz3yEsYTtgiLxiqxNq', '2019-04-26 02:26:13', '2019-04-26 02:26:13', NULL),
(151, 'Amol', 'Gonjari', NULL, '9890255418', '$2y$10$2zu.TjY.ulT5Wm4LZ8dhqOielukoVgumf4Bf.79fzfXxHu4zUKWMK', 19, 70, 6, 3, 1, 'AKdV68', 1, 1, NULL, '2NvmiHWIwu4GRHh454BQ67EyZ22uamma1dqp5pa8Ii6VqCfFvQOP7kGAYXne', '2019-04-26 02:26:39', '2019-04-26 02:26:39', NULL),
(152, 'Vikram', 'Giri', NULL, '8149479684', '$2y$10$bQ7doK85R6Mwhin3QUswjeHPGOCcSs4ZSIy3p/JqXHieIuvxBR9O6', 6, 71, 9, 3, 1, '687414', 1, 1, NULL, 'O7JxUnR2yqi2Nn1U0HrNADdYJYmyMTBC1v5vFzFWVQJczim5S7Ao9i4WALka', '2019-04-26 02:28:15', '2019-04-26 02:28:15', NULL),
(153, 'Reshma', 'Kapse', NULL, '7028398385', '$2y$10$518.nzUVT7J5b9UGR2a13.9Wn1p89FJcyw3wHIlDFUuglwEG01uP6', 6, 71, 7, 3, 1, '791130', 1, 1, NULL, 'ghknunN7R422sZ36AdGj32cMLRLv4KyBCaK07Lmj6JkzpSdOuKyAgb6eNM62', '2019-04-26 02:28:50', '2019-04-26 02:28:50', NULL),
(154, 'Mallikarjun', 'Nigurdge', NULL, '9096716141', '$2y$10$MJP5FjO3M0x3B.zf7fsVaeGAz3rgEnqyb4K2AFtGTBS.oc7S1kiSa', 6, 71, 38, 3, 1, 'jsLnaF', 1, 1, NULL, 'hFjA8fend51gsP1JGxKH5g0BhJlkAMBSR2zHljlWiitwSxnOfOGoUIlrlCd8', '2019-04-26 02:29:52', '2019-04-26 02:29:52', NULL),
(155, 'Pandurang', 'Patil', NULL, '8830114971', '$2y$10$fLO4PzUBIVk94lwWKU50Yu9lLh7.Tk4EPzX3VNyiLsKdg9M/gV.xK', 6, 71, 6, 3, 1, '404396', 1, 1, NULL, 'GLRN0bOH6yKinqqERZkeW8QcyFI11I4Fl7BoDo38dMQmhV9k9b0oNyK0IoAX', '2019-04-26 02:30:25', '2019-04-26 02:30:25', NULL),
(156, 'Swati', 'Chavan', NULL, '8691008000', '', 0, 0, 2, 1, 0, NULL, 1, 1, NULL, NULL, '2019-04-29 18:50:43', '2019-04-29 18:50:43', NULL),
(157, 'Vasudev', 'Joshi', NULL, '9890454001', '$2y$10$FpMPH40eJZ7JlZXCBdHLIuwPSGjsjHFXXobkYg1MrAdmpzMdoUD.W', 5, 10, 9, 3, 1, 'GytOEg', 1, 1, NULL, 'UKWkxJLLgqZ2ri9UB5wiB87GqahnEC95Oe8iNevyroYcHIWLTl8N2MHsVzW4', '2019-05-14 10:34:07', '2019-05-14 10:34:07', NULL),
(158, 'Ganesh', 'Wanjare', NULL, '7888179687', '$2y$10$v/nF946uQGnX7rq/GRcsne2ddumIirkCiZ3H5qnBholoBVjllCORO', 5, 9, 9, 3, 1, 'OCuO6o', 1, 1, NULL, '0u5cXKiSGlGg0LOJXTRuxRoRuUvms8sAcsPAHamSSmN9LHoS1W5EQNdYPtUZ', '2019-05-14 10:39:28', '2019-05-14 10:39:28', NULL),
(159, 'Vijay', 'Havaldar', NULL, '9423825139', '$2y$10$l72ea16N7mlkSx4Wh2A..uXDCmFW4bLFWoPtvC3bN/eKZHxVmsi8.', 5, 9, 6, 3, 1, '4WrgDK', 1, 1, NULL, 'A9PQdQGjn03Tzfh9ONsCrGJ63Rj7hDT4YI9LXtQJ6UqC6c3jANEIcru93gmD', '2019-05-14 11:41:11', '2019-05-14 11:41:11', NULL),
(160, 'Gautam', 'Gadve', NULL, '8888026892', '$2y$10$N7Atvf7nJmFXaF/.yoTcauV2zjwPM1/zNEbALCdrFloIrLxKFpqIS', 5, 9, 7, 3, 1, 'p7CcKB', 1, 1, NULL, 'mg3yso1yQtfy9EcSBeSpBpKRhJqR0dXmdKivvFrmNu9WOSxpbFqu2HhHgO4e', '2019-05-14 11:41:43', '2019-05-14 11:41:43', NULL),
(161, 'Bharamana', 'Patil', NULL, '7447808136', '$2y$10$UHTMkKQl/82f5DUsaN8yjeLZBUPFiuylyGHAj15JUgNVwMOe6SGXW', 5, 9, 38, 3, 1, 'IqNY9H', 1, 1, NULL, 'Fg2VFgedmsadwXujoV6eu02SFVnlFrv6O04ovnYrBzMXKzzjplD2wBPLYGAf', '2019-05-14 11:42:14', '2019-05-14 11:42:14', NULL),
(162, 'Kashinath', 'Kalkutaki', NULL, '9270705977', '$2y$10$65.M3bM/HtbEObxrgKMDLON9DFxn7zK9xsPx4qHyHbRxZ23uOk.aC', 5, 10, 7, 3, 1, 'FkBRio', 1, 1, NULL, 'wSRSvmGjrSe4ODNnvHEsKL6DN5BHZ4iGW7EymlDflddpUcMDmXuoMT8JAaeZ', '2019-05-14 12:07:54', '2019-05-14 12:07:54', NULL),
(163, 'Suresh', 'Patki', NULL, '9637499183', '$2y$10$kmVTmwtFhJ6mzq5w3xvw7OC9nZ3n9LU0TcC25R8GnCnzfSmuqGieW', 5, 10, 38, 3, 1, 'KRx2q4', 1, 1, NULL, 'xZITmxnBIT96Pj8sqbqiYQ62F6PArYm5FQVMylRb59IRb6sporhXeMMb7RcH', '2019-05-14 12:09:58', '2019-05-14 12:09:58', NULL),
(164, 'Prithviraj', 'Chavan', NULL, '9503774316', '$2y$10$cylXaFnUCagzl2DOYNhb8uUhafkjuZX2z9OOq4zL33x5pQyroBB9G', 5, 10, 6, 3, 1, 'flgRoe', 1, 1, NULL, 'XaNimtVMedukj6MtTLbYMkpuOJmdofPA8Q0zF5okKIwfFO3lpD6YS3P3IN6a', '2019-05-14 12:10:32', '2019-05-14 12:10:32', NULL),
(165, 'Mahesh', 'Shinde', NULL, '9975633802', '$2y$10$7vj7Ii5NiGOWgmkMq8h1X.m7r2dKfpsB0kzz2mQDdB12r2yiVKVBy', 15, 96, 9, 3, 1, '795229', 1, 1, NULL, 'cVSbnc9G4IXBr9rc2ZOFW79pZihNffnqA8BD4uTzQdsMhx64TtoO6N6AwrxI', '2019-05-14 12:32:52', '2019-05-14 12:32:52', NULL),
(166, 'Pandurang', 'Mute', NULL, '9421806317', '$2y$10$4wK9..MSrmp9lyJzLw.gIOoX0NMul8qjHUNsOemwU.P1p7eTkrX0u', 15, 96, 7, 3, 1, 'd5yQ6e', 1, 1, NULL, 'C5MULRrwvpEmeNALfYUrl9LcKtMx8GKVQLOZCYTl77ne9BUeELgk5wWwuWl9', '2019-05-14 12:34:19', '2019-05-14 12:34:19', NULL),
(167, 'Amol', 'Shelar', NULL, '9665325111', '$2y$10$srrFTeqFPCNHbj0Cp40.WuWIAPoroqwY8T4oQ0fG0VKZnRkupZd/G', 15, 96, 38, 3, 1, 'k6oDZ7', 1, 1, NULL, 'acgkQn97gQeIHxmSUqg4egQrAfiarJpWSyThijmVjS7mKEMqCJfcOOQk3udD', '2019-05-14 12:34:57', '2019-05-14 12:34:57', NULL),
(168, 'Namdev', 'Patange', NULL, '9766241778', '$2y$10$NQktbFaK.eX9SVOaJVKgk.ZXsB1DPvqTrnvdzRhBBYIT14M1zLic.', 15, 96, 6, 3, 1, 'x4h0Hy', 1, 1, NULL, 'DM9e1mkFVWzjT0QPRXiC5I9hgkz6t73qZUThM6yT5jj4OCNEcE3pPfTVnHXx', '2019-05-14 12:35:36', '2019-05-14 12:35:36', NULL),
(169, 'V D', 'Bhumkar', NULL, '9970514706', '$2y$10$1hBrKqFa.5p8TNi0TQdTBu4t70ClQvpshL0g2IP9SQFrSm/8/dmbu', 16, 53, 9, 3, 1, '261637', 1, 1, NULL, 'uePOdCVYrw3mTto4ADMi2TYDBQge6BZGcBvkJqOIe943MQpiyCnjQmYvlKJg', '2019-05-14 13:09:01', '2019-05-14 13:09:01', NULL),
(170, 'Ratnakar', 'Lad', NULL, '9518340280', '$2y$10$ENO3HyIHhpGxJGbAgC.BWOywlXgpwJBn4RnOAkd3jAV8vJ6miPxlK', 16, 53, 7, 3, 1, '938645', 1, 1, 1, 'Itx2wGgra3gfFlG77vaansRgqwoHuKGPXTYQHytLxDcg54QcTdqnV2m71pUB', '2019-05-14 13:09:31', '2019-09-13 14:00:25', NULL),
(171, 'D V', 'Kulkarni', NULL, '9975757090', '$2y$10$ATPoPx1cM3rS9k297LQ4begloaGDS7ia6xGWfHQFMzFarxSMuusBO', 16, 53, 38, 3, 1, '204004', 1, 1, NULL, 'kXOsIIlNnDnDO13yhZ6Xgngv9gNmf44uLrT2amNTcKk05PESKMmbJqxdw02i', '2019-05-14 13:09:56', '2019-05-14 13:09:56', NULL),
(172, 'S D', 'Jadhav', NULL, '7507539555', '$2y$10$D16fslydXnVQDUbt6Fnm/uvrYheRVQXGkygGD8Uyp1F62.uoiOMnC', 16, 53, 6, 3, 1, '275474', 1, 1, NULL, 'qTYwU3mgiEHGh3FSG5rTp0fRwswN1GtCKcbLz51OKqZeOTnqcZNfsBQB6SQn', '2019-05-14 13:10:26', '2019-05-14 13:10:26', NULL),
(173, 'Uday', 'Deshpande', NULL, '9822553380', '$2y$10$Jh1LkzVAh/f6dXVNVaxsputQ0qGYw0VyX8CkUOUkXISN8V0/L9orG', 5, 11, 4, 2, 1, 'nJR45T', 1, 1, NULL, 'zPGWoheVAKbBNtS6x7kYJTQkQ3Qt1uihlj3bVdEQ5IS1MHG4Ps2znNJ4dk86', '2019-05-14 13:20:05', '2019-05-14 13:20:05', NULL),
(174, 'Vilas', 'Chougule', NULL, '9604475662', '$2y$10$.lrN2MYiWqoe/lr851/bI.YOPzpXa9xglj4YAKeS9xSj6n.rQqyh2', 5, 11, 5, 2, 1, '717984', 1, 1, NULL, 'oka6Rer8cxu8leKv39c8tUfsw2FisAo0RtIckxQyj7PA8pLBafbCxRmYlqSZ', '2019-05-14 13:21:19', '2019-05-14 13:21:19', NULL),
(175, 'Rohan', 'Palange', NULL, '7875943617', '', 5, 11, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-05-14 13:24:09', '2019-05-14 13:24:09', NULL),
(176, 'Avinash', 'Gaikwad', NULL, '9021154747', '$2y$10$hPwcjl0jjpawWGZMMO144.UUzfUiBDjTMg898mtVYZfjovGESj83C', 16, 32, 4, 2, 1, '703630', 1, 1, NULL, 'pD0K4p4kUKCzB1fKXJPADJpfBUEJfUzRqymN9AytDkEGKwVCAs78eUgTp7aE', '2019-05-14 13:28:28', '2019-05-14 13:28:28', NULL),
(177, 'Madhukar', 'Batgiri', NULL, '7020548142', '$2y$10$pCzc657kDecJVukDp89b6ud3n7hWxl2KIhq33YK1XE9ImSCwjKWzu', 16, 32, 5, 2, 1, 'R3tcle', 1, 1, NULL, '42WE5lomqO0mPYHRrV3ty9bTYtzNodlXDoGJt6533fCxJGVMTrobw7JCLhsR', '2019-05-14 13:29:25', '2019-05-14 13:29:25', NULL),
(178, 'Ramakant', 'Gaikwad', NULL, '9423532555', '', 16, 32, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-05-14 13:30:12', '2019-05-14 13:30:12', NULL),
(179, 'Sagar', 'Palsule', NULL, '7517539562', '', 15, 29, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-05-14 13:32:03', '2019-05-14 13:32:03', NULL),
(180, 'Deepali', 'Kulkarni', NULL, '9011247575', '$2y$10$QiUj4n5SjWy3zWmx8EPNbuVmLOVPI9zkxnCbN2D/oGfSa3bw3LCgq', 15, 29, 4, 2, 1, 'umHoS1', 1, 1, NULL, 'RubF6NOloqflth7mI1IQARTgmgGzYpBXA82DVEuFFNrA28qBCMhLwAUwzuEc', '2019-05-14 13:32:49', '2019-05-14 13:32:49', NULL),
(181, 'Shobha', 'Patole', NULL, '9270692503', '$2y$10$RakrKCtSNqf2m5C3p4Nhs.uaNqJObq3mdX/DEaNgHvKLbsEaPN3qe', 15, 29, 5, 2, 1, '123456', 1, 1, NULL, 'Fqc0UsfVGNLdXqTAJ7gd28Oxwf0NzFE0mmYGrS62MxFdAKndekFPlNa29mPI', '2019-05-14 13:33:23', '2019-05-14 13:33:23', NULL),
(182, 'Kailash', 'Pawar', NULL, '9881871609', '$2y$10$2z1.ofVETBA78F5OaAh2IOxQx4bdyJbB9miWbUH2UJwjEFoV4y/FG', 30, 97, 9, 3, 1, 'TDNLsY', 1, 1, NULL, 'bGLczU0SswewTCS2OhNDf1ynTq33jjBgWaMSrJgrZsNogtaIvg51TojqcQ9H', '2019-05-14 13:49:50', '2019-05-14 13:49:50', NULL),
(183, 'Uday', 'Pawar', NULL, '9765220548', '$2y$10$YvDbdb7He3YNTrjM3WB6xeZZxyKq85qwJd.vmLyrGhV/ORtCjF6vW', 30, 97, 7, 3, 1, '446757', 1, 1, NULL, 'iBNeHCVL1CGXiXszIC3IS5BFJDgdDcKadyxBzhYhtAiyk00cMrRteWRfoOJz', '2019-05-14 13:50:16', '2019-05-14 13:50:16', NULL),
(184, 'Sandeep', 'Fonde', NULL, '9823181939', '$2y$10$4Z/iPEGpa7tYOyNuMr1uGe71YApO6iTVYL8eIe4puIAEqIgKCuIFy', 30, 97, 38, 3, 1, 'PDTq5k', 1, 1, NULL, 'CpGDeXUe1fiUXnZFacSCIIoPUQHy9k96SnCvoZEECUiWYIbS9YjG214WfoYP', '2019-05-14 13:50:45', '2019-05-14 13:50:45', NULL),
(185, 'Avinash', 'Thorat', NULL, '9823971964', '$2y$10$IfPVsjIxNqNQq5GuHVRSkuYdMwiuXzwVKmV3xaE50nyHjOJWA.hca', 30, 97, 6, 3, 1, '735088', 1, 1, NULL, 'mjEZuUs7sDIfRCyotUccVnRHfvhua6YvVXJ1H1TnvHV5RGS6Z5Suqat3Vp4U', '2019-05-14 13:51:12', '2019-05-14 13:51:12', NULL),
(186, 'Sunita', 'Madhe', NULL, '9420322772', '$2y$10$MM2Z9ltGFblZvXapDdyQu.0U.ChtRT828GBGPWVFmWUdCpj96JM7S', 19, 36, 38, 3, 1, 'jYTFe0', 1, 1, NULL, 'nzqrDCqgTEVaTgtOkpkP7WcXR4mRr2m6WqCi3LaDdkRhOGJA9ebpCBiLJGuw', '2019-05-14 14:06:59', '2019-05-14 14:06:59', NULL),
(187, 'Janardhan', 'Londhe', NULL, '7083472694', '$2y$10$JQt9DwaUOaFXMz.JHFOVROal.n0dqg1XK6GKjRseZgf/nbpGim1wS', 19, 36, 7, 3, 1, 'WmTPlY', 1, 1, NULL, '7WFAB8hao1io3c2vWzg6FUaDa1m9WhBhmoomu0fkr1NW1v29kmEX3ixC5RkN', '2019-05-14 14:07:36', '2019-05-14 14:07:36', NULL),
(188, 'Anil', 'Bhise', NULL, '9552820189', '$2y$10$wZuOUZUYThQ/KZLRLIWKDuKE2VOLvP9XEpzPEZlu8Pn2kyY9naqLe', 19, 36, 6, 3, 1, 'VpWaPx', 1, 1, NULL, 'MExmBKjLp3WKlK04d2zTfbqY5i1ubiEbpidQwv69mv9e8TbuUyMacIZLkiDw', '2019-05-14 14:08:11', '2019-05-14 14:08:11', NULL),
(189, 'Ravindra', 'Phanse', NULL, '9763166313', '$2y$10$wtHnpvr5cGY63bGUk.Z0P.tU/.Ux7TvJGfZKddII7Kpnq8tmLInfy', 19, 46, 9, 3, 1, '468298', 1, 1, 1, 'PgXaM7zDyaIswigJHee4ZYu747iYpHCpRTRHeqQp46up8YWLLYYpDDOqrLxf', '2019-05-14 14:25:05', '2019-05-15 22:14:56', NULL),
(190, 'Ashok', 'Aghav', NULL, '8600653001', '$2y$10$RFLQa2tywy23lwt54Jvt3O4K8xyJewM.jaznmnONetbv35jNOU8KW', 19, 46, 7, 3, 1, '4MHtT6', 1, 1, 1, 'FS1qFiP0vNPlB3VHZgkaQTLOkhQHflSHUDnKRYfbsQ2lVMKDRbel2MMBLhF4', '2019-05-14 14:25:46', '2019-05-15 22:15:24', NULL),
(191, 'Kirti', 'Sahstrabhojani', NULL, '9673200652', '$2y$10$HYBbUnXIhPIzLj1shWtTS.KyBIaxt3sA8/CQhBOFkILZ.oV.hPV3C', 19, 46, 38, 3, 1, 'uiHow8', 1, 1, 1, '70qFqS5y3WteB49ZdjPZknqv8AFBj4eqoXZQLWekDXzbuDhkllmn8MR7x14j', '2019-05-14 14:26:32', '2019-06-21 17:05:07', NULL),
(192, 'Sachin', 'Shinde', NULL, '7588379858', '$2y$10$YR.V7lm7gXZHq/8ehn10qu7X4Aj7GruoOhfj/Hi5PzHHm86zLS6HG', 19, 46, 6, 3, 1, 'boUfuF', 1, 1, 1, 'zNhPq4XopB1gVdzaRoVqgYq4IpzsF0zMLP5xBprgYTA39tHtewbGrm2hvKZX', '2019-05-14 14:27:08', '2019-05-15 22:14:39', NULL),
(193, 'Balasaheb', 'Bhosale', NULL, '9921340434', '$2y$10$iXoIJQWvecSXnDndw.NR0uUzDFKHSppgpIeEl0.59MppU4I38UZfS', 16, 30, 9, 3, 1, '355685', 1, 1, 1, 'SOqTNmiAXQKQTuPaRxq3g5u056e2vTyEmL5ZWCY66yopNHCuTYVbTIO7fHQD', '2019-05-14 14:56:46', '2019-09-17 11:32:28', NULL),
(194, 'Pramod', 'Shinde', NULL, '9175446744', '$2y$10$tQ1qCEgq.zuXDqEtoNZM4esN02zNSjtwgY1HEiC/ZhhYVQNugi.nW', 16, 30, 7, 3, 1, '598544', 1, 1, NULL, 'XmnZylc40zTrZlydI1Uu7XE5okslAdyvRs5nLEuLsIqlqjMvsfIdaHX9SGhC', '2019-05-14 14:57:17', '2019-05-14 14:57:17', NULL),
(195, 'Shrikant', 'Koppa', NULL, '9850102735', '$2y$10$vooCxmto82vAB5FDn7ikr.tj5MdUP4UzVZgckYbFFMzjJxduMkvCC', 16, 30, 38, 3, 1, 'Dy7e4T', 1, 1, NULL, '0Mf1rlADEM7EJoT4bwz1vP7XpHPAP7Ge5ux0xmkiJgMU1cqteiQSsZ5gRT2y', '2019-05-14 14:57:45', '2019-05-14 14:57:45', NULL),
(196, 'Mohan', 'Wakle', NULL, '9404012912', '$2y$10$SD13B3CxW61XE9i5k5O1mu0T9YCmcfmFajiRuhAeUUD2PirdUmPiW', 16, 30, 6, 3, 1, 'NrNWpS', 1, 1, NULL, 'iPDDbDGMr5fgbLQxcykuk41nnEvHnwfzS81byBs0fWqdTpqNL0F0eYYeL0zt', '2019-05-14 14:58:11', '2019-05-14 14:58:11', NULL),
(197, 'Alamshaha', 'Pathan', NULL, '9359001485', '$2y$10$/wNAKPdJASX14AtJzQwhYuKG8/aLWtaaGj8lwMnvympSkvvP.L9JC', 30, 98, 9, 3, 1, 'RvwLRp', 1, 1, NULL, 'ZQnmjKchMUth27kpRA7hfZYvm5KQLEsf8oMfMktmk1WCc0CipybST7hVgzoC', '2019-05-14 15:06:45', '2019-05-14 15:06:45', NULL),
(198, 'Deepak', 'Hetambe', NULL, '9702273691', '$2y$10$zZHPh2d/4fUBGoNDNPYHtu34eTiEcU0rn7Gcxb9EaOKnR2NlHoWnS', 30, 60, 6, 3, 1, 'YU9viL', 1, 1, 1, 'vHuarFYvSyXLoB3wSuIQfC2d7vbGtwdqnhr9ifHsNIzfFMbibsXyxEN8TOzs', '2019-05-14 15:06:58', '2019-05-15 22:15:56', NULL),
(199, 'Sheetal', 'Mane', NULL, '7038540120', '$2y$10$b4t.eY6pjQXM4b1XOyliSeJdlBRKpoO/9f2yTNggTrrAa/3SnWnRq', 30, 98, 7, 3, 1, 'vtTon8', 1, 1, NULL, '9OGSERSEE13LOPIY9buONlvNU5UOjjPCHfgduTXlC1qVH2O1zxpZYApD7VQL', '2019-05-14 15:07:16', '2019-05-14 15:07:16', NULL),
(200, 'Zakirhussain', 'Inamdar', NULL, '8668713732', '$2y$10$A2dHUHZMO1JoXqbzCzrnReqWXyfUD4vshbOXnc8dA7LzS6k.YzYWC', 30, 98, 38, 3, 1, 'TIgaGg', 0, 1, NULL, '4VrGzbveG8ZApPE8UxbxiOkRtP5gK7unJgNY30U88tvTbVNr2r5o2Olu68nV', '2019-05-14 15:08:13', '2019-11-13 06:54:49', NULL),
(201, 'Deepak', 'Khilare', NULL, '7972048602', '$2y$10$Og.eIN4JPYCn3xyjjFCpb.mbdeV7AfOzinUUL7/g0oBSLwHGxaynS', 30, 60, 7, 3, 1, '114156', 1, 1, 1, 'FaSQIM6tVlVcqd8186V5GtGCAppzUbC9DK4wcpqjr24fAnzDl0Mvmm2FkHjH', '2019-05-14 15:08:34', '2019-05-15 22:16:13', NULL),
(202, 'Shivaji', 'Khandekar', NULL, '8999065171', '$2y$10$liq8ZOh3ZpBWwEn8gSwBee1donZg1fTe3cICy94lwPClFwJXw0bye', 30, 98, 6, 3, 1, 'BOY2Pg', 1, 1, NULL, 'VUNbwk9e97ORBFsKTjgOnsVLjsqRh5ZtWcC0H7K1VClt85sNDC9SKEgd1fE5', '2019-05-14 15:08:43', '2019-05-14 15:08:43', NULL),
(203, 'Sujata', 'Kakade', NULL, '9970653478', '$2y$10$CoWFpkw4wIAhin2GnkNXoOY0Vek0vzHKlDKIncn4PaqlPuMArrMrK', 30, 60, 8, 3, 1, '132824', 1, 1, 1, 'yPfjsi775mgeSuxSYKxInBG3ZHte4UMfh0DUncghdv5xxcGCbdhHCWdmZvPr', '2019-05-14 15:13:34', '2019-05-15 22:14:14', NULL),
(204, 'Narendra', 'Salunkhe', NULL, '9823150670', '$2y$10$gO64id0tCK6965943vbKh.yzcZXZ2YClvACVXP3diKyxZvBSZ0xkC', 30, 60, 5, 2, 1, 'dJjXqU', 1, 1, NULL, 'gygRCh909a9ovdOld0vQwzuEVzpaMLDTn0yViGr3e5QWgwXMFkzHNAMJQLFz', '2019-05-14 15:40:05', '2019-05-14 15:40:05', NULL),
(205, 'Manini', 'Telvekar', NULL, '7972048849', '$2y$10$VGdKHeb0SP1MVHmGbwVR5ugVX/KA4zfoGUIAk2nEIYqTMI3aVxda.', 30, 60, 4, 2, 1, '5yi03K', 1, 1, NULL, 'XnLg2hAIXoT8BHAkatOghBdc4uAS41g5E70GYnQmj8iOxF6upG38QA3AWP50', '2019-05-14 15:45:45', '2019-05-14 15:45:45', NULL);
INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `mobile`, `password`, `division_id`, `depot_id`, `usertype_id`, `accesstype_id`, `status`, `otp`, `active_status`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(206, 'Ranjit', 'Anande', NULL, '9881641668', '$2y$10$oPzW5IPJe7a46PsrKTfIa.2r4dAUOzCMwLAvQKDUoslt1R7yKjBXS', 19, 115, 5, 2, 1, '664734', 1, 1, 1, 'bIsOuL50ToyoEh8Biii4kYyLrGsshrRNlXjqKydk5FqyQiru1Gp3eUYkyRCJ', '2019-05-14 15:53:14', '2019-11-11 17:30:26', NULL),
(207, 'Sandeep', 'Pharne', 'msrtcaopune@yahoo.in', '9960122264', '$2y$10$QP2AztRT1eioEfZLtM4u6uM6wGKP.2hRVIKdAGoT2QCXjeyEFKBmy', 19, 115, 4, 2, 1, 'yUqSeS', 1, 1, 1, '3NjJ3xzl6PZRijPtQeRMpHCuu8XiEIq0u0Ek0sisOOm8P3snf3tfqFs0K10g', '2019-05-14 15:57:09', '2019-05-31 13:57:20', NULL),
(208, 'Yamini', 'Joshi', NULL, '7620586881', '$2y$10$DBoProdF2eJtRv7WKI91GOpUrzTJtmtLeorUhXwDjpVVV7jLyw7Bi', 19, 115, 10, 2, 1, 'agHy39', 1, 1, 1, '2eb0B0p8d6yfNJs2SWjR0nRr5SiArjEqxCZyyGzEntyhFHN4kdi2lQgkk5jy', '2019-05-14 16:07:23', '2019-05-31 13:56:46', NULL),
(209, 'Chirag', 'Daga', NULL, '9925242303', '$2y$10$ewdHo3KkNmwNN2Ba.W1yoeaPr.4Ovm./qa.9TsE1u2Jkw5NcZPTv2', 0, 0, 2, 1, 1, '852904', 1, 1, 1, 'BUTOYMNNvKKOwGJPNYPSRpemFnanSQ24bhKcTViTsCLVeaLLd3HxIUsUD3y2', '2019-05-15 22:12:02', '2019-05-31 16:14:20', NULL),
(210, 'Dilip', 'Kumbhar', NULL, '9726698775', '$2y$10$IrfAGEn0qNDa.LXldjjAeuOaFGvdBps3f1N3SXG.VTC8auXICZyLa', 0, 0, 3, 1, 1, '806060', 1, 1, NULL, '7UfjcdkY61RH7kpR4YZl6HFkSC2Nx6TUbGKKw60RYpNHDG1Q0jqAglJVpfZU', '2019-05-15 22:12:44', '2019-05-15 22:12:44', NULL),
(211, 'Shubham', 'Mahadik', NULL, '9687644798', '', 0, 0, 3, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-15 22:13:10', '2019-05-15 22:13:10', NULL),
(212, 'Gopichand', 'More', NULL, '9687644800', '$2y$10$vaRjd2AxJk4MtgWR3if7L.sTjAQse593vAGTqngc6tvBhGslYR496', 0, 0, 3, 1, 1, '164121', 1, 1, 209, '6kLs315FEhFVZwHhyq4aUjX2Y3xWhxB3Mh5nfitvGUGkBLAGeEKJcW0hWB1Y', '2019-05-15 22:13:34', '2019-08-06 18:25:43', NULL),
(213, 'Sanjay', 'Dau', NULL, '9822530341', '$2y$10$IWoNxPBv5C1iJ/d2y1mpB./8twuVW/kcQKnpxOQA9Bn5wLNekQBGS', 0, 0, 2, 1, 1, 'K1cQpl', 1, 1, 1, 'ze7vh5VLzqc7P0hxEfFWdSD28Ltq3HWxgx5FGdgGZNN8J7z6LbMq4kiLcnel', '2019-05-16 00:02:07', '2019-06-12 15:46:45', NULL),
(214, 'Mahesh', 'Gayakwad', 'maheshigayakwad@gmail.com', '9637447542', '$2y$10$GrC7bYFLW9GR.iJkXoPJ5uQOmApNXDSbHerJMmAvFx5EQd7Nlyuiy', 0, 0, 3, 1, 1, 'kkyDWc', 1, 1, 213, 'e40y1EsmGDEmWJrXWA6r5ryLCupoCgbIndY4OJ9iXPs0TxOkxxePElSIVSS3', '2019-05-16 00:02:25', '2019-08-03 20:58:02', NULL),
(215, 'Anil', 'Malusare', NULL, '7722083848', '', 0, 0, 2, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 00:12:06', '2019-05-18 00:12:06', NULL),
(216, 'Siddharth', 'Terdale', NULL, '8605016870', '', 0, 0, 3, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 00:12:42', '2019-05-18 00:12:42', NULL),
(217, 'Rajendra', 'Chaudhari', NULL, '8928570444', '$2y$10$3zaPbjaS6xyDN8/KyCFS1OPzNcYDkAjaUKPu/gJvoN6MOhSs4/fLi', 0, 0, 3, 1, 1, '462187', 1, 1, NULL, 'C7mIrCMpu8UmXm6fPNRAMmj2eZ8mqfl2g0EvYnB3el8zmQhGF1vwkQ2Uu5VL', '2019-05-18 00:13:10', '2019-05-18 00:13:10', NULL),
(218, 'Prashant', 'Borate', NULL, '9623628317', '', 0, 0, 3, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 00:13:42', '2019-05-18 00:13:42', NULL),
(219, 'Ganesh', 'Patil', NULL, '9834551758', '', 0, 0, 2, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 01:29:19', '2019-05-18 01:29:19', NULL),
(220, 'Sudhir', 'Patil', NULL, '9766614922', '', 0, 0, 3, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 01:29:37', '2019-05-18 01:29:37', NULL),
(221, 'Dinesh', 'Jadhav', NULL, '8669667481', '', 0, 0, 3, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 01:29:53', '2019-05-18 01:29:53', NULL),
(222, 'Sanjay', 'Jamsandekar', NULL, '8421983314', '', 0, 0, 3, 1, 0, NULL, 1, 1, NULL, NULL, '2019-05-18 01:30:18', '2019-05-18 01:30:18', NULL),
(223, 'Bismilla', 'Sayyad', NULL, '9403234374', '$2y$10$7UvI9f/Nl1nmYlLEtHCbMOtRIKt5799KHoCPTA6z3iioKpbOGSQYW', 15, 29, 7, 3, 1, '123456', 1, 1, 1, 'eiSYIFWfZdPkTmQ3DRfH9dK343CGHKqJd8sCuXCmMTJuxggyDWSLiXnP0Pjd', '2019-05-19 01:05:35', '2019-08-30 20:16:01', NULL),
(224, 'Deepa', 'Budhavale', NULL, '9284018391', '$2y$10$G/imfuBw/gTk3WzZPXYO0.m4wuVuzcyZypRSd49z8eux2zTprbEw.', 15, 29, 38, 3, 1, '123456', 1, 1, NULL, 'Nvj7eACgquZpnzy163tBxf2NV6ZFZa7S5aYjkJVX1Sa4HvZT4NMnmdjyoWdH', '2019-05-19 01:06:22', '2019-05-19 01:06:22', NULL),
(225, 'Nandkumar', 'Dhumal', NULL, '9921167228', '$2y$10$Kyr.y.rJTPU44FS0NqjxKef5utE7EOcN/Wn8SFsZnBxIdB2udkfxe', 15, 29, 6, 3, 1, '123456', 1, 1, NULL, 'GmNtspZ8vCfTFVOromgtvBd3n0lnRhwrdjSVbPQXJZc8CB8ZhEj7bJnySlwI', '2019-05-19 01:07:20', '2019-06-05 13:40:22', NULL),
(226, 'Geeta', 'Palshikar', NULL, '9860636274', '$2y$10$u3Kbx2XjBS3e6XSBwhaVEOgZeEAtD0WS/JRSjgIo7rIni2yerYuHa', 28, 104, 38, 3, 1, 'Zvaaym', 1, 1, 1, 'V4brPabvpeIZ1DdqMDw1iuCPXpxwbtsaOFDpZgAJBwTZYVGK3VDDIcq4AOLc', '2019-05-22 10:16:40', '2019-08-14 17:22:51', NULL),
(227, 'Yogesh', 'Gite', NULL, '8087749775', '$2y$10$KPTSA5dmeiuz9qy3zVXT8O/itW0yyy1S1bcqyQRyNemsd.xdtr/b.', 28, 104, 7, 3, 1, 's60llV', 1, 1, NULL, 'jPdTbNy8zy1WXjrzCcJ6zSZgn9ZZ8sFfchiQgAkhsXY5b2hsjwbE6c7xrYTp', '2019-05-22 10:30:31', '2019-05-22 10:30:31', NULL),
(228, 'Gajanan', 'Madke', NULL, '9423792007', '$2y$10$mYKCP9GaAdMx6gFnR9CoqeJd5pMe.e.g8NGFH.ZsS20wA6RuCPBvS', 28, 74, 7, 3, 1, 'i6sNRJ', 1, 1, NULL, '3TB8NrmP7yGC9FV1ztuj7HXyo5jOZsy7f0yUrhH7DC39zatNbXgNUYLynfJQ', '2019-05-22 10:35:03', '2019-05-22 10:35:03', NULL),
(229, 'Bhakti', 'Bangal', NULL, '9604346796', '$2y$10$ZDXaLW81iptOZg2IVqVin.OcdCFUvgAcRcdWKXNqWYS1DGV9FO5CO', 28, 54, 9, 3, 1, 'NSrCts', 1, 1, NULL, 'Up5to5CYYQarISbUC5evAMQCZcA9BGMGRmvUD14TmvSIbJUAXFhU4IjjtgkO', '2019-05-22 10:35:38', '2019-05-22 10:35:38', NULL),
(230, 'Rajendrasingh', 'Pardeshi', NULL, '9423725130', '$2y$10$/J9Vntuaw8xrsb3eNK43NuPjIE9O/oHUzGs/gBgn7KaSJvBPIMBo.', 28, 104, 9, 3, 1, 'bkKj6K', 1, 1, NULL, 'PamBzqYBuYCNgB7ravOr5PBieFGcNRpZu31cSyvELkNQvoJdyHoYVTmPFuEI', '2019-05-22 10:38:16', '2019-05-22 10:38:16', NULL),
(231, 'S.S.', 'Suryavanshi', NULL, '7972153693', '$2y$10$WQcpxpy/osH1aYce5NYceu3ztrb4pqqOCHEzS7eyU4nw1KmFmypfa', 28, 54, 7, 3, 1, 'jZ6BHI', 1, 1, NULL, 'OsIXbDsGU4ALbB7N6YFaRRSAqqUx9QOJbRrJK0LSeA0oRFcDdSR5fjSfEIbN', '2019-05-22 10:40:04', '2019-05-22 10:40:04', NULL),
(232, 'Anjali', 'Raut', NULL, '9970281465', '$2y$10$oMwq1NKUsUV8i4pCYMX4GOGccu1dIWtTpfWhlbK8CQJHsw8gfVavW', 28, 54, 38, 3, 1, 'qnVR2K', 1, 1, NULL, 'luPhOXVgyQdE5lg8bZWGrwfNSRrIDxmhR9bPslUqWYxF4TCS9NLjpO7w3Sp5', '2019-05-22 10:40:49', '2019-05-22 10:40:49', NULL),
(233, 'Suhas', 'Tarwade', NULL, '9561566421', '$2y$10$zEYr5mDoUfEDx25QPxjOgurMCts/kOP6AwHd5AUvh2p8GTqVneoUK', 28, 74, 6, 3, 1, 'GNAhib', 1, 1, NULL, '537CTkwo8QwHoEI5rIpDkAUJwuHkjPX8si4ObEy8vDHTOp4i89lqlfiOZv0z', '2019-05-22 10:42:35', '2019-05-22 10:42:35', NULL),
(234, 'Amol', 'Bhusari', NULL, '9623029623', '$2y$10$KSgo5msU14knrS7qvAeJT.hIU7sZDoDzmpRRlnPnZRQOP8RR3WRcq', 28, 54, 6, 3, 1, 'qbyBBz', 1, 1, NULL, '49GMKpbXcmsaiQZH5lo7DO1iBR1tQq1O0SE4OJPC8HeV3JNVZP9NeQF2Y6OC', '2019-05-22 10:44:37', '2019-05-22 10:44:37', NULL),
(235, 'Vinod', 'Jadhav', NULL, '8806370941', '$2y$10$u5.WEzdFPVxdgE6HuwjHf.xcZLY4f5agXlmC658RN/rSRsJkb.N2i', 28, 74, 9, 3, 1, 'hTo7Rc', 1, 1, NULL, 'W7rK1wuHCXqfu4zoAppATtxcGE6HLWx40W4SQRW0qs552VCtSmPsllQdrckT', '2019-05-22 10:46:14', '2019-05-22 10:46:14', NULL),
(236, 'Bapurao', 'Pandhare', NULL, '9763354930', '$2y$10$fLapVBj34f5WriP..9vAEuMFyImnt.wjga6F9eyguQO6PzE4B6LE6', 1, 101, 38, 3, 1, 'w2RRdS', 1, 1, 1, 'RPHN8aFs1DaMO4U01IcPLQXE1UKQIiHhI6cgoV32KkmIOSfLVA18EVb0aate', '2019-05-22 10:49:59', '2019-05-22 12:30:53', NULL),
(237, 'Shakil', 'Qureshi', NULL, '9420017786', '$2y$10$m9/DS22plc50lfJdFZ04iuHLINuzlHTH3fR0AiB6ZY/QoJ5i4cwNi', 1, 101, 9, 3, 1, 'hrUZ6o', 1, 1, NULL, 'WdcPXbsiVg9r8RWRGL9NXjgQbtCPutdD8fw3qmpCnP8dcRSxuXPOssypJGpu', '2019-05-22 10:51:58', '2019-05-22 10:51:58', NULL),
(238, 'Dattatray', 'Kalam', NULL, '9420032996', '$2y$10$aRiU9tZANrGiTnVo6k7DUeqPDzV6Tjv1a.SDAYwclAnr3F67REEH2', 1, 101, 6, 3, 1, '264952', 1, 1, NULL, 'lMwBeT57s8pnC7kcZlGc0xCeRPT1g7CHkYTakvDiq7zwQQ57I0zXidhHn8Sh', '2019-05-22 10:54:28', '2019-05-22 10:54:28', NULL),
(239, 'Vitthal', 'Supare', NULL, '9822362418', '$2y$10$CEwwFmwWxEd6FNuHahKyh.XaTZXph9mcsO2PZtKARf99qE84npnMa', 28, 74, 38, 3, 1, 'kQxK5P', 1, 1, 1, 'ftqtZQaQYBxcAGMK7xcoYOJY6fbhurYL2JUKo0NjISJBeZ1PN8YikcVxjBHe', '2019-05-22 10:57:12', '2019-05-27 14:55:00', NULL),
(240, 'R.B.', 'Kulkarni', NULL, '9588419441', '', 1, 1, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-05-22 10:57:56', '2019-05-22 10:57:56', NULL),
(241, 'Ritesh', 'Shinde', NULL, '8888777433', '$2y$10$JnONz5Psja6/J4yFlXiJIutmP4/fu0rPFKdboVNYMVFghyZ7OuKT6', 1, 1, 38, 3, 1, 'ZYeBpg', 1, 1, NULL, 'JWpl2mxwv2TEupzWHlHpbrQEN6925OK2MURKbsOnCrJBUuRIPaYYFIxfvK7U', '2019-05-22 10:58:52', '2019-05-22 10:58:52', NULL),
(242, 'N.H.', 'Pawar', NULL, '8275926011', '$2y$10$tXBbLJ5UPgzuvm8LP9YIievlVCYlun7yCC.V6t12x2rYqe1VD3qh6', 1, 1, 6, 3, 1, 'UONusC', 1, 1, NULL, 'mnkV71bIeFwAfDd3XP79v8hRUShjVbIKTozIe9xUPTnht3y2K2thkzdf17rm', '2019-05-22 10:59:23', '2019-05-22 10:59:23', NULL),
(243, 'Sunil', 'Shinde', NULL, '9403756535', '$2y$10$L1VwfMoFtx8RCDXuDMP4NuGjm1PL6U5WdJl1Ap1vPVAF7/mLskQue', 28, 104, 6, 3, 1, 'HkhrLl', 1, 1, NULL, '4sicjtrhAdV7GLwzYIQyq6vK8UfrdnZ9W7khkfqwHkFUwEKMvezeZ8XPID2T', '2019-05-22 11:12:58', '2019-05-22 11:12:58', NULL),
(244, 'Prakash', 'Mahure', NULL, '9421435608', '$2y$10$.RLFdT.R3e/xH4ypXQzRHu.p1FPVQHvvo/OJX.tMuVAx2xZ.cP94W', 28, 113, 5, 2, 1, 'Gqdkfg', 1, 1, NULL, 'dhLLR7x7Q7nAu9KFlfLPk99k3X43Wq6e780vjSg6StOAj7SeNETVosnIER5g', '2019-05-22 11:19:53', '2019-05-22 11:19:53', NULL),
(245, 'Vandana', 'Chintal', NULL, '9371687455', '$2y$10$8NlolC9liM7qsmGLwWRhO.RPQe4AOzavyzXPIaxlsUpDqZoUSIbte', 28, 113, 4, 2, 1, 'SqEBTw', 1, 1, NULL, 'v14YCv9MFIWBzBokYLtX0cuIC2DbA7mxp1crL4IG9kZwoRG3utvRf6Rzqxgv', '2019-05-22 11:20:36', '2019-05-22 11:20:36', NULL),
(246, 'Kishor', 'Somvanshi', NULL, '7385738930', '$2y$10$s00nOLmuETZALUc4Aeaqp.srZdiGs.aBUwDAKN33Lxs/BlTsAtyvq', 28, 113, 10, 2, 1, '6STqbR', 1, 1, 1, 'QG7swiz0sc3lIxBR87YL84kYfH1f5eNdCdWcwG9FWj2ge2KSNa2RM9u5JE5W', '2019-05-22 11:22:10', '2019-05-22 16:26:57', NULL),
(247, 'Narayan', 'Munde DAO', NULL, '9421343552', '$2y$10$F9cxuEMJixLB3OOxkNVhFuEKOn3G6YZBahzDcMqbb.E6uYrct736C', 1, 1, 4, 2, 1, '305180', 1, 1, 1, 'KAgSeQo1ouhhblVrn9YnvKODcuWJdFel0NRuB7q5RVn7oXw9UF81NqxsCuQf', '2019-05-22 12:08:27', '2019-05-22 12:13:36', NULL),
(248, 'Narayan', 'Munde DIV ACCT', NULL, '9284317655', '$2y$10$imDglqoZ3A8N11Okz5isWegqZ1OpwIWcBK6FdPHuC6CgrS8FsKsjK', 1, 1, 5, 2, 1, '159718', 1, 1, NULL, 'oBklvigZEporVALgQdj5qxQzolhMtWjkd808WElio2AYtjkxktb4o94sltbj', '2019-05-22 12:13:15', '2019-05-22 12:13:15', NULL),
(249, 'Sanjay', 'Supekar', NULL, '9869660444', '', 1, 1, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-05-22 12:17:00', '2019-05-22 12:17:00', NULL),
(250, 'Mohan', 'Kombade', NULL, '9834763951', '$2y$10$VLSbUxBaB/yByUPn1L6YcelXb8nr44/WV9LFYEMT0MIK5Zq5JiXsO', 1, 101, 7, 3, 1, 'K1rIMV', 1, 1, NULL, 'Sw5QmtfLjWRx5duRMb500AwTAkFcl6AZSRYsohAz33wRGy35Pyi0tXBRHQJN', '2019-05-22 12:32:31', '2019-05-22 12:32:31', NULL),
(251, 'Umesh', 'Joshi', NULL, '9405067638', '$2y$10$u6pIE/G.AZKEIs2GGXPCseVMW92t/HlHlNz9u97wSxnyhos1.pgn6', 4, 81, 38, 3, 1, 'ZlGDzW', 1, 1, 1, 'RvIYyvGJK4CJFVlrahAGkNgVMji3e6glpQCVVoI1o7UBr0gSQMDM8LmEJON3', '2019-05-22 14:37:02', '2019-06-21 17:20:03', NULL),
(252, 'Arun', 'Shahagadkar', NULL, '9403494028', '$2y$10$WD1V0cWYM5XXauNP/dtVn.OcBSXWW32giPtNY8WUBtmMR9lExac4W', 4, 81, 9, 3, 1, 'H7TRaY', 1, 1, NULL, 'hK9PWefmYZi4pqHrsQYBc1Fiwc8VrWY7ANR8RsqLLnGVvFgPHuo96sQnMYOB', '2019-05-22 14:38:09', '2019-05-22 14:38:09', NULL),
(253, 'Sanghamitra', 'Tribhuvan', NULL, '9405479906', '$2y$10$jonxY3hzh3hQDUHegng2f.mE/zX5N6nfjPlrnKoNYuHHSLIHyraXC', 4, 6, 4, 2, 1, 'ePSkVw', 1, 1, 1, 'sVanRueensetPFo6SPH6hhxgGc8i4Ie4vXE9a9GV81KWNCcSf4GyjALhkFtj', '2019-05-22 14:41:08', '2019-05-31 13:35:18', NULL),
(254, 'Omkar', 'Kulkarni', 'omkulkarni160@gmail.com', '8888418160', '$2y$10$4/InsXXqNHtFy6pKkQ7.quP3MkVhl9KzB4gLYGTEBkjg4WeIIsnNO', 1, 99, 38, 3, 1, 'p2HStS', 1, 1, 1, 'WRBVV3pKL9aERhhEBfSpbTZsvmWG2zQRs4KIcypLB69PC8lbTaxRglvS3YbC', '2019-05-22 14:49:10', '2019-08-28 18:22:46', NULL),
(255, 'Akshay', 'Kalam', 'akshaykalam@gmail.com', '9975761112', '$2y$10$WhzW1N/g1NHH3jkfO5rA8.3fdO0W6d8ZZJV05urjUoz0MCzSkX5Zm', 1, 99, 9, 3, 1, 'C3o1SB', 1, 1, NULL, 'ek3kaC7OT3MUy5GGBoZ9bjH4CwDoWXw1Kipx2IUb7PJbnIuWsWJsT2YZ7HSX', '2019-05-22 14:50:17', '2019-05-22 14:50:17', NULL),
(256, 'Shivraj', 'Karad', NULL, '9881446354', '$2y$10$AZ189Al3mDNOyLKd1qkS2.C0YBD/zG7QbtXRIxxzfwOryBzmSJCg.', 1, 99, 6, 3, 1, 'duKYYM', 1, 1, NULL, 'ROuSBuhtBelje3Fwc0MWsxw9igsUdWKpSQwohGFMDLX4TnXrhohmVLwFQjYX', '2019-05-22 14:51:11', '2019-05-22 14:51:11', NULL),
(257, 'Amar', 'Raut', NULL, '9922812603', '$2y$10$xBMj1q23QDIjkouq0Mkgi.7hebiWuGUOLNXvvPvStqWMSxRnSLsj.', 1, 99, 7, 3, 1, 'z4jcH2', 1, 1, 1, 'mvBzLNwHeU6kKfePDsI0WqpFNTWpvCDh4OLGBoHt8REZVGUeS8JWYlpxsBiX', '2019-05-22 14:52:44', '2019-05-22 14:58:56', NULL),
(258, 'Surendra', 'Tandale', NULL, '8600549337', '$2y$10$YXP9Th6fPvdN0zd4iC1/9uWQ//bY5tmz5uNV5o6U2JLD3wmxAhfxq', 4, 81, 6, 3, 1, '9hFEtm', 1, 1, NULL, 'GDlC9CpjcBicHUGA8Fvu8Frp9Owp3SJngLrQFViMlEEaTM2eahVMV3tJQal9', '2019-05-22 15:00:00', '2019-05-22 15:00:00', NULL),
(259, 'Subhash', 'Deshmukh', NULL, '9423848667', '$2y$10$92ncz2.uBm2ga.yo1SwHk.QNCNR8VqT9EaesBVXJV4kvrDLPZD.72', 4, 81, 7, 3, 1, 'TGiW5p', 1, 1, NULL, 'lDCsB0OEqRLFYGovYk86blVFWFA5Kp3NiLCQYEet4IfhY7zEmsMEnQudtweY', '2019-05-22 15:00:46', '2019-05-22 15:00:46', NULL),
(260, 'Yudhishthir', 'Ramchaware', NULL, '9850322486', '$2y$10$PsTUBbu5luHU5eyccy1bLO7VozHYu0sIlDJjfN8ZI5YrYl7u7V15W', 33, 86, 6, 3, 1, 'n3Pmwh', 1, 1, NULL, 'l5lIzCbPmwKDxGeRL7p6UYOZf4Ef6YmndAJtTlthv5nBgv5cAAuJNPrgKxMX', '2019-05-24 10:42:38', '2019-05-24 10:42:38', NULL),
(261, 'Dnyaneshwar', 'Ghatole', NULL, '9096064385', '$2y$10$gzjpfu4zuExTWJWE6HALSuB6ENDt9bsQygLTdNLINDb/B3k9cta8q', 33, 86, 9, 3, 1, 'HwKIzw', 1, 1, NULL, '0kz9yqAgmf6QupNDtMALroapVprxjePL1BDSup1RMYOWqJUgxMBVo8BRyL1v', '2019-05-24 10:43:42', '2019-05-24 10:43:42', NULL),
(262, 'Rachna', 'Maskare', NULL, '9767478144', '$2y$10$oxTy1uGiPcqEvE9bxzboWu0kMu6oS59SyY6h5SUQbgxMzSG6HyUWu', 33, 86, 7, 3, 1, 'HuYxf3', 1, 1, NULL, 'QO3PzkbOkXG0shV9MBWj43dzawgOhtwzRt6dq58l7EE6qH15dIZHvTy2sByb', '2019-05-24 10:44:41', '2019-05-24 10:44:41', NULL),
(263, 'Rekha', 'Bhoyar', NULL, '9923623091', '$2y$10$ljz79pRRLiWTl9Pt4f2Ou.pSdw7ULn/HPNDvMA3E01Ui3ak6jrAhq', 33, 86, 38, 3, 1, '987859', 1, 1, 1, 'BYtQabVbyjyWeNvfDHW1VDumF002GsQecpHaSBPSqxCKbaeRlvykbWBtrumd', '2019-05-24 10:45:44', '2019-08-30 12:42:05', NULL),
(264, 'Mangesh', 'Pande', 'dmgd7132@gmail.com', '8605799326', '$2y$10$7xpgfWQncG0B82xuIXljUuDt9qxWUjIR5IhQxYclVyTsIkK.wtFcC', 29, 59, 6, 3, 1, 'ezQd2O', 1, 1, NULL, 'a6Nvupe8XG71nTgzZPTjKD9VxCO73LMGJNTFMSEYbFfIqp2cELPTJtlw37Uv', '2019-05-24 11:08:30', '2019-05-24 11:08:30', NULL),
(265, 'Pradeep', 'Salodkar', NULL, '9168317414', '$2y$10$YOmGYFIeojiI1z2lNwZ6.OSglfdXuVs8dRo3.T2/xU01eK/HL.R82', 29, 59, 7, 3, 1, 'pUFU9g', 1, 1, NULL, 'uHBpoHd1ecJVH3E5Yu5BRbvofS5yQFDZp8wmVxwX6kYq9vMGhWHKrtk6viLT', '2019-05-24 11:09:16', '2019-05-24 11:09:16', NULL),
(266, 'Kuldip', 'Rangari', 'dmkatol2016@gmil.com', '8956502584', '$2y$10$TOppPl5xyXc5hofy3/ipqu8U.MCSGU6VgJTdkbALyaGLPLAcT6c9m', 7, 111, 6, 3, 1, 'ft1aKf', 1, 1, NULL, 'HAwfSCeGjS4EqdA8fDNtGb4FFe44KK565Kvw2b9zgIEwe4JXRiE0szTV1b1z', '2019-05-24 11:09:40', '2019-05-24 11:09:40', NULL),
(267, 'Arun', 'Pendam', NULL, '9545708953', '$2y$10$yECuwe14xdAoskmraG4yAevYL6AH7Smi4xg7V4toF8PK0FyB4s/QW', 29, 59, 8, 3, 1, 'dQudoc', 1, 1, NULL, 'liiCoMS6vxyE33yb2l9UmBtkwQV6bhzEu9YrfPN44XITFG64WR4GhMiey2Yr', '2019-05-24 11:10:17', '2019-05-24 11:10:17', NULL),
(268, 'Dipak', 'Tamgadge', 'dmkatol2016@gmail.com', '9881556907', '$2y$10$G6QL3/h9tN/kqmGyYyUeIeONqQ9GVGuxbIQlJOAAyfcK/JvL2JRUq', 7, 111, 7, 3, 1, 'WYpiau', 1, 1, NULL, 'KlyhZtEh5SBc3bjiTQ0fi63udOqvZseiF7p6PsVxYt5LH9ATwmbQRku1tIPr', '2019-05-24 11:12:00', '2019-05-24 11:12:00', NULL),
(269, 'Gajendra', 'Fulper', NULL, '9823346188', '$2y$10$.VGbj.a5V7eFG44zthKM0.pP4tujWxn4YIBjwty/6.oyqhZHko5fS', 7, 111, 38, 3, 1, 'rj29lQ', 1, 1, 1, 'KXzaQAFcjpsiRzLMWuq2Cjqf72E7RdnglEnIbQYiu3XR0eBRQvHlLNUPQP6f', '2019-05-24 11:27:27', '2019-05-24 11:27:56', NULL),
(270, 'Sumit', 'Dhoke', NULL, '8459413893', '$2y$10$ilthxOWgmSZGm7JFWjodlOFE8w0b9ssAB6mXJZf/bO/olFh/627qy', 7, 111, 9, 3, 1, 'j7ocMB', 1, 1, NULL, 'pYCyC8t6UnOrYNGAN0T5nwU7vtJRcOSNRcYJQn1QEncvvbQ3UwgtY87Zot7A', '2019-05-24 11:28:31', '2019-05-24 11:28:31', NULL),
(271, 'Anil', 'Amnerkar', 'dmimamwada@gmail.com', '9158519444', '$2y$10$CKsWjQR8oN9i8HwX3mxAWO995Th86OnPw.SRNgOMCT.hyMMW9ILcu', 7, 110, 6, 3, 1, 'QZ47SC', 1, 1, NULL, 'j20FZ63DqNFZkkxz8sgpFDf4BWZeEtEeIPcbga7jsxOU7l2K2BCU3vOZfKHq', '2019-05-24 11:34:45', '2019-05-24 11:34:45', NULL),
(272, 'Anant', 'Tatar', 'dmpandharkwda@gmail.com', '7559486255', '$2y$10$WiyfD8jWpa6Owd5l4af/u.cTXaRcC1XPMarxjfwvvmMxFaxwPR9Gm', 18, 107, 6, 3, 1, 'ghMZKT', 1, 1, NULL, 'zhyYiwuYbi20HWNuguMrppMZI1ZUrVAjNcK3k0wpwI6P7bLW9S2rbbhsOYft', '2019-05-24 11:37:12', '2019-05-24 11:37:12', NULL),
(273, 'Lata', 'Mulewar', NULL, '8857067909', '$2y$10$iA5bKuT3nH1iTylLIcf8Uu6YaVQ8UIGWPLyeMUd2PUb7bRYjqoQ6e', 18, 107, 7, 3, 1, '257333', 1, 1, NULL, 'V41LGgvQlG8WDHPmP6Hrw1v5c1wKMmq7M666MdqsMAJ3kxGKbANBqCgBNJ5i', '2019-05-24 11:38:16', '2019-05-24 11:38:16', NULL),
(274, 'Vaidehi', 'Fasale', NULL, '9767500993', '$2y$10$ySBJ0tDcCJne..JET/j1iO7db9/T0hZWfpFSVoGWY00uLDcbtyYQS', 18, 107, 38, 3, 1, '7oBhcY', 1, 1, NULL, 'EK2iaSs4VK4m3z86YNIzX5rxm4lVz6ypgJcFRz2ijeLGRfdOTLupI9YneBvl', '2019-05-24 11:39:46', '2019-05-24 11:39:46', NULL),
(275, 'Rajni', 'Ramteke', 'rajnirtk18@gmail.com', '9923794084', '$2y$10$8cj6f82..SnQsUnkfttlluEb6vbQ44NTa.EN5cAQ5/EqyBFKiKDZW', 7, 110, 38, 3, 1, 'RLF4W0', 1, 1, NULL, 'TbohiSsEEJijoAWgsxpU567Ou45FyzEdbFMgAI3vdfi7r7bKVi9PYAZt0TQu', '2019-05-24 11:40:41', '2019-05-24 11:40:41', NULL),
(276, 'Tushar', 'Tidake', NULL, '9689323373', '$2y$10$rWEKF8etj91qeX7hoATdme5dMMU6PTK2ZVhlsmrQpYB.o1l9W1oOG', 18, 107, 9, 3, 1, 'J8UAVz', 1, 1, NULL, 'akKYSnpFnn0vE8T6TYyoLC3WReGsVspH4X92lbeKe72usNLyqvLnPQp1DpFS', '2019-05-24 11:40:54', '2019-05-24 11:40:54', NULL),
(277, 'Parmanand', 'Khobragade', 'pnkhobragade63@gmail.com', '9834633351', '$2y$10$knBODJoFo5P8COjCEk9P7.i/py5BSDcxWmyqZ98aU.k2kEol4Dnaa', 7, 110, 7, 3, 1, 'RXtnCu', 1, 1, NULL, 'FZkPUrwBVfreq0OMcWQGFgG8C2R3Cy0mdLjFyVjzHiCnuMIvPATbtuIr2MJ1', '2019-05-24 11:43:02', '2019-05-24 11:43:02', NULL),
(278, 'Sujata', 'Salam', 'sujatasalaam@gmail.com', '9021740201', '$2y$10$Ovxf6yBdAtCCgDlByQ3AGe0CFOLV1SdY/cb4gjaVB.8FVQGiOSpt.', 7, 110, 9, 3, 1, '3UNp7w', 1, 1, NULL, 'HztPDnKrTFJROpEPFQyeOk0JPGuu0aaxqRWSxtaj8lqxfJNh45qAGbznjrbA', '2019-05-24 11:46:56', '2019-05-24 11:46:56', NULL),
(279, 'Sumedh', 'Tiple', 'sumedhtiple23@gmail.com', '9823922271', '$2y$10$rYC.IVIyzVo07IHlkH7IO.5cRk3rLPqZYofrCjyNP.IzItsdkym5S', 18, 106, 6, 3, 1, 'VDceQu', 1, 1, NULL, 'Sorcx6WoU5tzlefIapSlZFN80GrGGPMkbEVOALAU8p1fqQhdTWhmHYZ7PPZE', '2019-05-24 11:47:23', '2019-05-24 11:47:23', NULL),
(280, 'Vasant', 'Tekam', NULL, '8975134685', '$2y$10$9nA.PwoTFpnFdLpT7kWRRu6qH8uDieaLBp1UIpBbog/F1/Jjjv142', 18, 106, 7, 3, 1, 'jWyRtz', 1, 1, 1, 'Yb1ghwaiqSntbCVb1MGY7AfGJPbzoENDsUa7esFQDEfbLsCyb7q4HMPWYDAX', '2019-05-24 11:48:53', '2019-05-24 13:00:17', NULL),
(281, 'Hukmeshwar', 'Chopane', NULL, '9689370668', '$2y$10$3Yi59BsdVszSlsmiNU4kHu0ioSlNSSAraHBmO9L6VtUkm4bUFTh72', 18, 106, 38, 3, 1, 'iRGVzX', 1, 1, NULL, 'bAWXqpbLtLsYHtqaYdsuhRDH50jIcT112XqHIS86DGi2RsKiNgdY5E86tnza', '2019-05-24 11:51:53', '2019-05-24 11:51:53', NULL),
(282, 'Vaishali', 'Khadse', NULL, '8411044290', '$2y$10$2aGmImM1LmJSihDYKOvdt.N7as.AT11THAHdllQs266B5BSG0.3RO', 18, 106, 9, 3, 1, 'fR2RbK', 1, 1, NULL, 'oHDFI3JPbKOXfkvhkIAoxFrHHUcxSp9uk6Ilx8GoENAKIOkSKMViesO1768z', '2019-05-24 11:53:14', '2019-05-24 11:53:14', NULL),
(283, 'Ashwin', 'Dodke', 'dao.stgdc@gmail.com', '9970514471', '$2y$10$pRYwzLN8pjcd6/yKhukEdO32u9xrk597bkSTqNBd6jfx.mcrRPAJS', 29, 59, 5, 2, 1, 'TGNnPP', 1, 1, NULL, 'D1WxrbC0IzCAMkwb5LCLjBtrLdgtMJDpqRIrd49TW0ghPRnLOupdXkuVRbw5', '2019-05-24 12:00:51', '2019-05-24 12:00:51', NULL),
(284, 'Yuvraj', 'Rathod', 'dmahr7133@gmail.com', '9158360688', '$2y$10$a6oEfgw5P648H8u0Z0TMYeXwCmH1ILTXEFC4ee9W5ClR3UMz5ea4K', 29, 95, 6, 3, 1, 'lkhrqw', 1, 1, NULL, 'LYJZV1Y25t0ypzTPjtfbPfgRKRIt3ow2ILrQCYLLFYnkD1tk5xoyRNZ3zsyN', '2019-05-24 12:03:54', '2019-05-24 12:03:54', NULL),
(285, 'Jitendra', 'Rajvaidya', NULL, '8275823664', '$2y$10$SueW6GR02XKvDgMlsy9.ju7B3nZPDNxP6X2vQZGH0mlPUPvSiw/du', 29, 95, 7, 3, 1, 'vsvme7', 1, 1, NULL, 'fHeV0aNCT29OPhjPnO8dog8W4QIQLOUf0GuqPKD0lNtNmeKO0qcfpnD0WRvp', '2019-05-24 12:06:13', '2019-05-24 12:06:13', NULL),
(286, 'Charan', 'Chahare', NULL, '8055717127', '$2y$10$Z8XrE9sl7ASHRweySwg.BeyuamQab3MptNp6RPNckg67pwMvOYzri', 29, 95, 38, 3, 1, 'VdbkfQ', 1, 1, NULL, 'kj3gYjgnVvWTRHpvP7P6NaVQG2rK2pADfs7kO5WQbLf65tlDRbgYgRS1TZ0S', '2019-05-24 12:07:08', '2019-05-24 12:07:08', NULL),
(287, 'Subhash', 'Bonde', NULL, '9834353981', '$2y$10$4qaIiDYlwRqOqLQQ2NxPuuHxE9v1vnfcxODrHrY8cYtdnpSOZepB6', 29, 95, 9, 3, 1, '74g9aG', 1, 1, 1, 'JvbexhBoCc3wuzkz7HmRDrFbaGHJYTOZ3MNVg4X0aYimpwGLW4FnMyjmqPQp', '2019-05-24 12:10:01', '2019-05-24 12:22:58', NULL),
(288, 'Seema', 'Ghate', NULL, '7249268622', '$2y$10$oh3/8ieTfQT4bprel5idDe2OIYWhJtbZKtBfnCdMhQ5O9nAc2z5Ku', 7, 109, 9, 3, 1, '409702', 1, 1, 1, 'MhzSO4JJkiS6AxdU8tq8qHPiLn6n5NNgDj69QtoXi1InkJgYMKLMxkY6bhcV', '2019-05-24 12:12:22', '2019-10-24 14:42:49', NULL),
(289, 'Vijay', 'Dhundhate', 'dmghatroad2016@gmail.com', '9975025689', '$2y$10$g9FG8qNCx6HCISL97W.KzOpT1vwzabO1MAUKwMqPYThtMcn7wEzYy', 7, 109, 7, 3, 1, '308975', 1, 1, NULL, 'MRqcktxcKXTKUnHFIxpAJY8KPYPt1nF7zkXqlKp94Vlyp52GhpDsb55A0WUP', '2019-05-24 12:17:21', '2019-05-24 12:17:21', NULL),
(290, 'Pankaj', 'Marwade', 'p.marwade@rediffmail.com', '9511680558', '$2y$10$U/agNP1AChbQEq0zssmKz.r55GbblPybAt59uVziACiql6OFpSxJq', 7, 109, 38, 3, 1, '254711', 1, 1, NULL, 'Sy6UG2fNjsTiR1wjM4YPoWlJ6JCFyIOefvQ09z5pvIl34K65K86xMJQj5z08', '2019-05-24 12:21:11', '2019-05-24 12:21:11', NULL),
(291, 'Ramesh', 'Uikey', 'ramlaxm26@gmail.com', '9527258101', '$2y$10$P93cAuYyBDheRyXMymdAHOpvMUmATiVbSdD6GCgVPQPdGa.Db3NlS', 18, 35, 6, 3, 1, 'hTxXNj', 1, 1, NULL, 't5zjHhJltcrVnCuQamKoHSfAzSTFuzDMb6hzyMblxRA991Z8dbIQBmHCfVRm', '2019-05-24 12:22:18', '2019-05-24 12:22:18', NULL),
(292, 'Pravin', 'Waghamare', 'pw827628@gmail.com', '8793500601', '$2y$10$1VRRRfNJS2/fVtEPD.uzFuEt7fm/Nf/ln31SalaqzTFKtliaLuw3C', 7, 16, 5, 2, 1, 'vneTgO', 1, 1, NULL, 'vnI9GZziCJxaAEGcnEV9CKzrFpG4OhVe9lVFwDipudf3msJrr2OSl9Veqfci', '2019-05-24 12:23:58', '2019-05-24 12:23:58', NULL),
(293, 'Kiran', 'Rathod', NULL, '9011901596', '$2y$10$Cj/Wpq7uKe6wvh.krwCBZOLXBc5lFKUrhje.zwa68Mp7BNgx2Xvci', 18, 35, 38, 3, 1, 'aEiRxO', 1, 1, NULL, 'Dboo6z3DvAl0RFAyoDQbsu3iVNZT4K3y4BZrdRK31jkCT1FPr6YN5FcBkuTG', '2019-05-24 12:25:36', '2019-05-24 12:25:36', NULL),
(294, 'Sanjay', 'Chaulwar', 'daongp@rediffmail.com', '9158129830', '$2y$10$k3xjdeC9FanNnyB3ab2.ouYpZHMEwqe1KUgnz3wwBCsFbVIyz3ohq', 7, 16, 4, 2, 1, 'v01A21', 1, 1, NULL, 'ACFroug1kRdKK1kBqJEY7ApPH9DuXKlwmvHGyivo4epWsB7QERFAhlPiop7L', '2019-05-24 12:25:53', '2019-05-24 12:25:53', NULL),
(295, 'Dilip', 'Todase', 'diliptodase4@gmail.com', '9403048348', '$2y$10$mh3gWmMvWnqcws5XfhkfGeu7o0NJ9zi56eTViuTAxK5p3sp7rt4Am', 18, 35, 4, 2, 1, '6TbJGV', 1, 1, NULL, 'DI9tEW2q7sKhns9rsxYCrkgPLKdgJVYo6rnbGMlbFJAI1PMEEPSRLsMyMQuI', '2019-05-24 12:27:59', '2019-05-24 12:27:59', NULL),
(296, 'Dasharath', 'Marskolhe', 'msrtcaccytl@yahoo.com', '8605728275', '$2y$10$3wE6moyWd2g6dsWw3jDP0uQNQFFOpcBNCa3nteVOpASdUkg165xUi', 18, 35, 5, 2, 1, '133759', 1, 1, NULL, 'CMLmZVHVHR8TQLnO5oDoN2493aaEYwHCNmgw6dygi36ffxjuGARHBPhIdPXw', '2019-05-24 12:29:55', '2019-05-24 12:29:55', NULL),
(297, 'Surendra', 'Waghdhare', 'daostbhandara@yahoo.com', '8999242716', '$2y$10$0zfOt3XDWAFxWufZ.M7jA.jpLLhNcFk7JM5cEZuRbrEhX93TtRKGO', 33, 85, 4, 2, 1, '529919', 1, 1, NULL, 'thdsnlvdV2odnnJFqfYup5LHWSIb0cSQPJuhI6F2NSJ3iDjwl59KySL62Psc', '2019-05-24 12:34:48', '2019-05-24 12:34:48', NULL),
(298, 'Amol', 'Uikey', 'amol09_uikey@rediffmail.com', '9923172930', '$2y$10$AP.eugc7fwObUIXuVG/quuwr6xG/MN2F67C9rXn1CWycqegkiT/.G', 33, 85, 5, 2, 1, 'Egxijh', 1, 1, NULL, 'qPO9UxnZb41Rukgzyi59Um7dIHKlrtAD5eU20k67BCpW9TfbUYEVM6O3D7xP', '2019-05-24 12:40:46', '2019-05-24 12:40:46', NULL),
(299, 'Aniket', 'Ballal', 'depotmanagerpdt@gmail.com', '9503544657', '$2y$10$Qe6JbQdtVZS4/YVl5Vqh4.YqLrLIB0.v02EexWiEyNivkYh4xMUKy', 32, 72, 6, 3, 1, 'CauR0l', 1, 1, NULL, '3wTwyjELZfWBxeVNIIc9a4HYTNbtWrK5Mq9QNRaFXXGzrg20lyMpBox3IH4p', '2019-05-24 12:43:26', '2019-05-24 12:43:26', NULL),
(300, 'Nilesh', 'Mokalkar', NULL, '9545285599', '$2y$10$AJujEHNDQ2dtMBCr21PBkuMXKZjb.ah9OlcTOFw.Qwc7TaOQxC3Jm', 32, 72, 7, 3, 1, 'BKoVBr', 1, 1, NULL, 'M13jqfbqIuA7dGLsqrL57TmrSaJUVaJXpQLIhoxHfBA5y6sn68QzmMfohhB7', '2019-05-24 12:44:27', '2019-05-24 12:44:27', NULL),
(301, 'Pravin', 'Nanhe', NULL, '8483954826', '$2y$10$8KZYvPw26n/kXAig8/VWN.XUEPhs7NrcHU42uiypk1xdx4Qkd8cOC', 32, 72, 38, 3, 1, 'h4UGrI', 1, 1, NULL, 'a2egsa0QVes2ut5C1j9wlC1fEVe9buiuN8w3h7LkUDfg4A8m1lGAaRxH9OOz', '2019-05-24 12:45:23', '2019-05-24 12:45:23', NULL),
(302, 'Lalit', 'Meshram', 'lalit.meshra66@gmail.com', '7385224364', '$2y$10$/SQoBHTka1r8W0oTYkCANuF5Ma9RAXdqWay.XrmRUZqgfIMhLU/xy', 7, 16, 9, 3, 1, 'JPZnmc', 1, 1, NULL, 'O6FIWAbKAywZOd3uBRFk58sCS2V81Jx65X1s4iF3F3QgQU1qzPBFl7BO0lbY', '2019-05-24 12:46:00', '2019-05-24 12:46:00', NULL),
(303, 'Anita', 'Sadafale', NULL, '9689180182', '$2y$10$SzwUrk07K1HA6saTmOqUVe4NC8rIvUq/M1kVxMTOn6IpXzVFJ0uaC', 32, 72, 9, 3, 1, 'mPyz92', 1, 1, NULL, '3F1xnAnUsqhCW6xgFsKgHe07wQ9AO6otko2mEz19dslWZGp6qoB9SqJgvq1O', '2019-05-24 12:47:10', '2019-05-24 12:47:10', NULL),
(304, 'Jaikumar', 'Ingole', 'daryapurdm@gmail.com', '9156826592', '$2y$10$NbH2UFnuyVIS/C5ZEvSMvuvWoC/cBlTTL8xb9kVciQRRWelmJH7fu', 32, 73, 6, 3, 1, 'f8ipdX', 1, 1, NULL, '7JgyANxJ5qKMSnIG3J6wIjGksaGYl5stuD4t655ER4odaLLzKWYuNQBcTKqP', '2019-05-24 14:36:15', '2019-05-24 14:36:15', NULL),
(305, 'Pawan', 'Lajurkar', 'lajurkar7@gmail.com', '9096689525', '$2y$10$BXihe1kqjDj.oc5tq7LuD.QI04VRNjcsWyTtQpTiWYAmZToQZw9nW', 32, 73, 7, 3, 1, 'nq13kd', 1, 1, NULL, 'Ja1IPQi0wbGg3Z7wb9qyYwvUObHHRM6P95iwJEa7daMRvinItpFNI0HAft2y', '2019-05-24 14:42:09', '2019-05-24 14:42:09', NULL),
(306, 'Sachin', 'Dhole', 'sachindhole341@gmail.com', '9922960930', '$2y$10$MXsBzVum8sR9drVxj.d6d.5/6rVKYAIFb/yfROCAUeD0Kj5qPzx7y', 32, 73, 38, 3, 1, 'mjr5Cw', 1, 1, NULL, 'RXwu043dVaQ7FDG7rHuu3ZRh7wrvNtkrX0jUOvZyiZNbTX3RFhNWCHlgbJRS', '2019-05-24 14:46:12', '2019-05-24 14:46:12', NULL),
(307, 'Pallavi', 'Mane', 'snehaladgokar@gmail.com', '8805263171', '$2y$10$qsMCSXNAl3kCbB/fR3rCSuxYjkJVUxnW17J5y3fpoQQZIBeZt5IA6', 32, 73, 9, 3, 1, 'HMyizp', 1, 1, NULL, 'QSLV7Hc41fu7gTwt6xhHvhk6kNaCn46VIdhHgEw2mtVqsGjZPQLVk8thp9Kl', '2019-05-24 14:49:12', '2019-05-24 14:49:12', NULL),
(308, 'Nitin', 'Meshram', 'amtmsrtcacc@ymail.com', '9420074707', '$2y$10$X7CBFlmyYoVEuisOGnLFsuzzO0XGpoGqDTIKJUBQg2bbZ3N701TsG', 32, 69, 4, 2, 1, 'XabGfP', 1, 1, NULL, 'ska4pYme4vBJ6tq237KQVy9CbSJK4jICrRVfNw6UaxAf4yeNaAptrgybFn3H', '2019-05-24 14:56:43', '2019-05-24 14:56:43', NULL),
(309, 'Raju', 'Lakhadive', 'raju.lakhadive@gmail.com', '8552882078', '$2y$10$05VIlEQOUeMwHr8NBg6yQOop9I5OglCug2.1gb5HaOkDe8a1pBltK', 32, 69, 5, 2, 1, 'SF94E2', 1, 1, NULL, 'pCzoEFHpW2JqVN7GNpEBryPN8iLTEw9ZvjO6Wz325tZcNWajlOTIvGBVXZdT', '2019-05-24 15:01:18', '2019-05-24 15:01:18', NULL),
(310, 'Vijay', 'wakode', 'dmckl01@gmail.com', '9420242097', '$2y$10$Nt13SzwRhjDyV2jExCVgaevZg4Hux2lTZHWQ0pmP7OFRlC6zlCF92', 2, 102, 6, 3, 1, 'TLlmvf', 1, 1, 1, NULL, '2019-05-24 15:29:18', '2019-05-24 15:41:11', NULL),
(311, 'Rajendra', 'Folane', NULL, '9850343282', '$2y$10$IDocNfQ8IaYFpn1gXwtTUOVwDrxiP3jQyVb0mmDQynkZ/V8JjGK3q', 2, 102, 38, 3, 1, 'yxhbVk', 1, 1, NULL, 'wuutdfMQniYDMud5mS4dZ8PIiovEtcfVvBYp8m1A0cN2JteWENXS0GfAWv6f', '2019-05-24 15:30:01', '2019-05-24 15:30:01', NULL),
(312, 'Arun', 'Padghan', NULL, '9096391002', '$2y$10$c4ICzaoEW0WN/FKS.IzA0.tB7DH7AbREuB6vhjUnN9cIg899kYLi2', 2, 102, 9, 3, 1, 'R1yCQp', 1, 1, NULL, '5JRIk4lTwHn3prXIabL87uGupAv6zZYQLuDNG2xN7prGUaqKNj01nSqt06YW', '2019-05-24 15:30:31', '2019-05-24 15:30:31', NULL),
(313, 'Santosh', 'Jogdande', NULL, '9881564020', '$2y$10$dXl306q0GYBXWOaC1I3qXeKZMg3tfrQXlV1VbdUQWDJTCiCulFawS', 2, 102, 7, 3, 1, 'KSr0Jx', 1, 1, NULL, NULL, '2019-05-24 15:31:04', '2019-05-24 15:31:04', NULL),
(314, 'Mahesh', 'Thorve', 'daomsrtcbldss56@yahoo.com', '8087104740', '', 2, 114, 4, 2, 0, NULL, 1, 1, 1, NULL, '2019-05-24 15:33:33', '2019-05-31 13:17:18', NULL),
(315, 'Sheetal', 'Shirsath', 'ssheetalshirsath25@gmail.com', '7755992259', '$2y$10$5FieTOeZ/.KFCsfYmB7BROE.lZggS/TKjFpWKRYjBbgAMPX7zTRxW', 7, 109, 6, 3, 1, '782906', 1, 1, 1, '9vbYrWRHIiDmv4so3cI4cfsIBPW2ORLdVgnASFGI2BPUjn19vB64lR3wsxCB', '2019-05-24 15:34:22', '2019-10-17 12:55:54', NULL),
(316, 'Sandip', 'Rayalwar', NULL, '8149742159', '', 2, 114, 10, 2, 0, NULL, 1, 1, 1, NULL, '2019-05-24 15:40:27', '2019-05-31 13:17:33', NULL),
(317, 'Sachin', 'Dafle', 'sbdafle@gmail.com', '9403620862', '$2y$10$GvH2fElnA2igVToKcfasTON5qGtPpPJ2h8u8AD.PZr1FCTPTR3gT2', 34, 103, 6, 3, 1, 'O1eJeB', 1, 1, NULL, 'aIkc9W4U8rKZKSexwHmaTMjFTJGJweFga0riY7WLK1HOy0YUXNpZ9ySwaogB', '2019-05-24 15:41:12', '2019-08-29 17:06:47', NULL),
(318, 'Swaranasingh', 'Chahel', NULL, '9423146760', '$2y$10$CyvZt7NnzmPxTUfIQZtUKOeR9fL35dt3o.d/zGyYdWezHTOfBMZY.', 2, 114, 5, 2, 1, '499441', 1, 1, 1, NULL, '2019-05-24 15:43:17', '2019-05-31 13:16:57', NULL),
(319, 'Hemantkmar', 'Gowardhan', 'dhanrajgowardhan@gmail.com', '7588773483', '$2y$10$jhYIW8b00p5oGGAThwz5GOnHdD2pfr03c6oA8WuUAxLo4HcAJ0eWa', 34, 103, 7, 3, 1, '966908', 1, 1, NULL, 'WDhzQFUBMfk2L3zYHE9Xm8rgJTPH3CBn9mpJcoosmQyN0T5t9ytvYRRHwC8D', '2019-05-24 15:44:01', '2019-05-24 15:44:01', NULL),
(320, 'Vinod', 'Borkute', 'vinod.borkute@yahoo.com', '7588101122', '$2y$10$sx7WVeEb2X0possmNABw2.2Q/yU61xQoiXjAfowiWyog828kfBSrS', 34, 103, 9, 3, 1, 'PFwMxm', 1, 1, 1, 'DtXvP2zJ5kzmOPmj1nr2pLhQCxB2JFvg29MjAcKOJanR0E6sBGQYl4ujucBC', '2019-05-24 15:47:52', '2019-07-31 17:11:38', NULL),
(321, 'Shahista', 'Shaikh', NULL, '9970656220', '$2y$10$mSLYKNZIXRrvVFBzj7M6juPm.L54Hfno9sat/TTWP1V60/wPMbM.y', 34, 103, 38, 3, 1, '918623', 1, 1, NULL, 'hncqBzFP65qPhzXZ95ugmwQI0yiRQkTORxV0SzW6hdu5NiPDjBzJPY8RrnJt', '2019-05-24 15:56:53', '2019-05-24 15:56:53', NULL),
(322, 'Purushottam', 'Yerewar', 'pbyerewar@gmail.com', '9284711736', '$2y$10$1ieaqi0A7fFBVgo1jx6B1eZre7b1r859xNv75ZTz8S4pxx5SsZBDi', 34, 103, 4, 2, 1, '781124', 1, 1, 1, NULL, '2019-05-24 16:04:06', '2019-05-24 16:32:08', NULL),
(323, 'Sanjay', 'Gaoture', NULL, '9595022880', '$2y$10$oPkZ8Bj..peozOYbWOQdse9vYHY5SYLvdftsV8z0QjzQiFLyv/eJO', 34, 103, 5, 2, 1, 'OjXsiw', 1, 1, NULL, 'Zj34O420r7tlDtpkP6sAfUB2lgV5Pawa85GDTcyFO7QoMQKHGCbBDYnG5lBe', '2019-05-24 16:33:10', '2019-05-24 16:33:10', NULL),
(324, 'Sandip', 'Nikam', NULL, '9579380697', '$2y$10$7R/LJAklHW9U0E3fttSP..dxr.8/SZsLxlYILddBeWy3oKqmf/NvC', 3, 83, 6, 3, 1, 'eDHUtE', 1, 1, NULL, 'Fiata4Y6fvvLLTmwmrZVAhDCbomsb11aiXchMiI7NsczfxasTkmIvifKygHb', '2019-05-27 11:06:50', '2019-05-27 11:06:50', NULL),
(325, 'Deepak', 'Sonawane', NULL, '9890728618', '$2y$10$hM1B.JQxC8YdzscNed81teuH4DQDLbJaAoPN.4CgWMiSd/YRuGD12', 3, 83, 38, 3, 1, 'uZGcaa', 1, 1, NULL, 'EDwP4pv3mYmlZGOBzlwkxk7bBy1VO0KSjWfLu3ZggO6L7XGhfYr3KhZcJNjz', '2019-05-27 11:07:51', '2019-05-27 11:07:51', NULL),
(326, 'Ananda', 'Sonatakke', NULL, '9146420053', '$2y$10$2oG/j/3PD7rAizrtUEvhoOfTUotPWoCKNZkr7pUnY6SXH2cKP5Yvu', 3, 83, 7, 3, 1, 'bpcZZC', 1, 1, NULL, 'AODtWVIn1749VVCwXVvAaYq6soCVMChX8mQMbbS4OltE07PzaPzJYTGGWXRy', '2019-05-27 11:08:32', '2019-05-27 11:08:32', NULL),
(327, 'Narayan', 'Wani', NULL, '9860033252', '$2y$10$6t2zFJfpjAWf.4AWygu3Ye34aHam24yTftXLG6iU3YoENR3VrP7LS', 3, 83, 9, 3, 1, '5mWVjs', 1, 1, NULL, 'QXpnGlKODs87WFSMifG252pLdSaKt5XGsx9NkT6AjLoQVJpjcLGfKQeCGDh4', '2019-05-27 11:09:09', '2019-05-27 11:09:09', NULL),
(328, 'Nitin', 'Thakre', NULL, '9422763007', '$2y$10$btWJICL6JaW1DZJYRwKQ/eux33Cm68BV4Rd6SrC7meBcveCrQy3Va', 9, 18, 5, 2, 1, 'JR4wpl', 1, 1, NULL, 'RrcXbrlSg5nGIMzLQ4rDiwgZIyVklh3W8EleVyLJvPtupqZ9a39nAyxW0n5q', '2019-05-27 11:51:40', '2019-05-27 11:51:40', NULL),
(329, 'Kiran', 'Wani', NULL, '9766944514', '$2y$10$RgzUbI6e35lJ4kZc68YHWuRyRKomrO4iz116CC1aseGOGcUS86WaG', 3, 112, 38, 3, 1, 'TMnkcJ', 1, 1, 1, 'xVZ0dN3AC5sh9YvWUE33NBBToz8hCzsPrKihWtTkQbpld9pHjoCsdMtTSLNn', '2019-05-27 11:55:10', '2019-05-27 11:58:31', NULL),
(330, 'Chandu', 'Choudhari', NULL, '7588647095', '$2y$10$sxQeLgneBBurH43W2H3c6OeV7prJI.uFAc1zlqioN65QdJhLRuFam', 3, 112, 6, 3, 1, 'MpHAMj', 1, 1, NULL, 'viuNGB9w31ZJzeyeGv1oBrybXfEzHMCHU1kNQ0PvuJduYVuxVO2oell8578N', '2019-05-27 12:04:12', '2019-05-27 12:04:12', NULL),
(331, 'Ganesh', 'Rane', NULL, '9421514131', '$2y$10$T/9z9mGJjp8wDqSGhfWVkegKzm.CkxoXtKlufYFehVAVHoWMgjXZC', 3, 112, 9, 3, 1, 'mP7oyj', 1, 1, 1, 'dRpZLsRjRBvEz9qacqeY6U5x7Z8g0QZUdiuEnOuyM9gPSffl4YbWAsLT3er4', '2019-05-27 12:05:01', '2019-07-27 17:09:59', NULL),
(332, 'Sandip', 'Tayade', NULL, '8208965130', '$2y$10$5EfAk.clgiBLZRKz9pUyCO8/rdI5FUjGoAflSfW0RvuSwZ.lMulF.', 3, 112, 7, 3, 1, 'aLVabO', 1, 1, NULL, 'm5VPvmz8fkDd9w6tQfIJ3T6bT2l0E5bsphsoplCcfFRHV5gxw5CudlPrTknH', '2019-05-27 12:06:00', '2019-05-27 12:06:00', NULL),
(333, 'Shivkumar', 'Ashtekar', NULL, '8087715774', '$2y$10$Z726IqoLoVJS9pu2ycONguPlo4P0QgeE3iGFWQ15t/3bqJgJ98L46', 9, 18, 38, 3, 1, 'GxFeq6', 1, 1, NULL, '4LvNlxYXnr5wcwNnC7cwuOijIkvdXC0FRPPaDzAEAP4awRHHcW0LL6vdbH5u', '2019-05-27 12:25:01', '2019-05-27 12:25:01', NULL),
(334, 'Kiran', 'Shinde', NULL, '9850121196', '$2y$10$oc08gGoVXm4IGKTb9nFa5.IOLwPQrV3Kn..89GbCzH0WbDORrnj6C', 26, 75, 7, 3, 1, 'fvlPOe', 1, 1, NULL, '0icWDoePpp51Ou5esMFgchG1JeOVncOX9aNBTFeMySexB2ql3IHpuNl5hluq', '2019-05-27 13:29:44', '2019-05-27 13:29:44', NULL),
(335, 'Dattatray', 'Gawali', NULL, '7972312701', '$2y$10$/JAwbXi69JNWlTMakzcO7.UDtaZztME20kxu89Yv/GgiguAVHi4Dy', 26, 75, 38, 3, 1, 'Obt7t9', 1, 1, NULL, '5QS764qolWiK3dcejJEzea8qopBmc6UPMdvFOv89QAlQaOwyz83EulSFLyna', '2019-05-27 13:32:43', '2019-05-27 13:32:43', NULL),
(336, 'Kishor', 'Patil', NULL, '9112654560', '$2y$10$tWnWvid9dycHNvfL40lZbuC1Dwmj/ZR2QUi8sf0BlleCZ/MkpL.m2', 9, 18, 6, 3, 1, 'sQkuKA', 1, 1, NULL, 'TRFbGMJIcueJVNbxUKjgAmc9g4FKlz7hD3Hha2IlWAUF76ysJIYR5HDCrzZI', '2019-05-27 13:48:14', '2019-05-27 13:48:14', NULL),
(337, 'Sanjay', 'Sonawane', NULL, '9423711652', '$2y$10$gVhyo.IiEWEw3smA4oDCsOb5tZ4pQXOgTvLYNAr.fxa6nu.oHlvV6', 3, 5, 4, 2, 1, 'uS4kcJ', 1, 1, NULL, '0pqQsb9mQP04IK8LYLTYUNXF8BXi8se6rCPfpcn9GZaopiQon6btP1jQFWsd', '2019-05-27 14:04:06', '2019-05-27 14:04:06', NULL),
(338, 'Yogesh', 'Sonawane', NULL, '9284273874', '$2y$10$uC2NNc/lQSXtrZgGBoOJ/.y595GaZ17qJ85SlJIqpQnpbDVsvwSQC', 3, 5, 5, 2, 1, 'nlOhQ2', 1, 1, 1, '8T9sGA2GOO6BNm7OAArWfLkGHr7r2MFeBXlMylX2ObxuYsxauNAe9blIYHkM', '2019-05-27 14:04:43', '2019-05-27 14:47:42', NULL),
(339, 'Rakesh', 'Shivade', NULL, '8208014691', '$2y$10$bnzhISrnnGOACKFFfpHlr.0/HZsFsPQb7GOoyCu9Hx2YlHxE5yqjy', 26, 75, 6, 3, 1, 'ThjdsP', 1, 1, NULL, '39D9GbsJ8AA3ciHTL0Qea4yZVQj4EekvegcXzAKsdhQkjD6bcQhiOehNrMBp', '2019-05-27 14:45:07', '2019-05-27 14:45:07', NULL),
(340, 'Vinodkumar', 'Bhalerao', NULL, '9021893704', '', 33, 85, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-06-10 13:20:01', '2019-06-10 13:20:01', NULL),
(341, 'Swati', 'Chavan', NULL, '9967742944', '$2y$10$jODL61F8UqFd4ip3lH6eDuRQBqOA6M9s6rm8LT.QaPjhGntjFZfE.', 0, 0, 3, 1, 1, 'LICHSC', 1, 1, NULL, 'IJoEQWoD23j28oVlWSIeGI64NH6nmeYEHZLPut0IIfwWJPltpnQYCxOocXSk', '2019-06-12 16:45:28', '2019-06-12 16:45:28', NULL),
(342, 'Sharad', 'Pandit', NULL, '9423910063', '', 4, 7, 7, 3, 0, NULL, 1, 1, 1, NULL, '2019-06-26 12:21:00', '2019-10-24 14:45:44', NULL),
(343, 'Rupali', 'Tondale', NULL, '8308648356', '', 5, 8, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 12:50:25', '2019-06-26 12:50:25', NULL),
(344, 'Rohan', 'Desai', NULL, '9860487676', '', 5, 8, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 12:50:58', '2019-06-26 12:50:58', NULL),
(345, 'Ghanshyam', 'Chavan', NULL, '8983724258', '', 5, 8, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 12:51:38', '2019-06-26 12:51:38', NULL),
(346, 'Mahesh', 'Jadhav', NULL, '7021901604', '$2y$10$qHWg7rEzAXkcGbxiVX19Be1tp/nhm6Y1rDtHWv6c6cl5yRJaWoWgW', 23, 39, 9, 3, 1, '883118', 1, 1, 1, 'h8HlsW4wVU2tQrW5acAOwa2KW8pztmQVT5kmX9T4GN03Nu08zX5znxPrKSmJ', '2019-06-26 13:42:36', '2019-08-09 14:54:34', NULL),
(347, 'Satish', 'Lipare', NULL, '9987177435', '', 23, 39, 7, 3, 0, NULL, 1, 1, 1, NULL, '2019-06-26 13:43:25', '2019-11-10 18:33:22', NULL),
(348, 'Tejashri', 'Pakhare', NULL, '8104793743', '', 23, 39, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:44:11', '2019-06-26 13:44:11', NULL),
(349, 'Sunil', 'Pawar', NULL, '9422432091', '', 23, 39, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:44:44', '2019-06-26 13:44:44', NULL),
(350, 'Baswant', 'Deshmukh', NULL, '7744084143', '', 8, 79, 9, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:47:49', '2019-06-26 13:47:49', NULL),
(351, 'Chandrajit', 'Gilache', NULL, '8421749253', '', 8, 79, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:49:03', '2019-06-26 13:49:03', NULL),
(352, 'Prakash', 'Bhutapalle', NULL, '9970641181', '', 8, 79, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:49:47', '2019-06-26 13:49:47', NULL),
(353, 'Vishnu', 'Wavle', NULL, '9960111610', '', 8, 79, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:50:34', '2019-06-26 13:50:34', NULL),
(354, 'Santosh', 'Nirde', NULL, '8275926817', '$2y$10$Wu4H8IcDmEOD.aYLgqynYuTN86mrTwh8UKFTInu2n3EOMdBCIy7zi', 8, 17, 5, 2, 1, '871004', 1, 1, NULL, 'HIaqkVrFF3gVaSerzKtmcCPZP3XU6u4Ndot7tkrVJSbE6d37qvol9wWnnZLZ', '2019-06-26 13:51:24', '2019-06-26 13:51:24', NULL),
(355, 'Santosh', 'Shingane', NULL, '9970443556', '', 8, 17, 4, 2, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:52:12', '2019-06-26 13:52:12', NULL),
(356, 'Avinash', 'Kachre', NULL, '8275038417', '', 8, 17, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-06-26 13:52:58', '2019-06-26 13:52:58', NULL),
(357, 'D.U.', 'Rathod', NULL, '9975407542', '$2y$10$1AJZ2cWk6UPhh1J4tU604uIQ/mvsVY020Dtz/Rkph2yLMtxVj7phG', 25, 45, 7, 3, 1, '346830', 1, 1, 1, 'DJqVSlK0KJHIepWhpQD9VgZexnE5r2imvTNEmd745ztlWaGOOWzZTIqI9WPv', '2019-07-11 16:34:51', '2019-08-10 14:38:46', NULL),
(358, 'V.V.', 'Chaudhary', NULL, '9028417315', '$2y$10$gYszuGlTlzJOfcxlQBIx/O23P4/JHtblEeD45eOX2CbNoFw8YZ4Eu', 25, 45, 38, 3, 1, '228147', 1, 1, NULL, 'J5njsBDCh8YQ34EB4V3qn5LgU9aVL4542XdYbwB3X0IGGeMtjIVkzqGFwNek', '2019-07-11 16:35:38', '2019-07-11 16:35:38', NULL),
(359, 'Dilip', 'Bhosale', NULL, '9860448128', '$2y$10$T8j1haIYIqEYoo1muc/mV.BEw2Xn9jAuQrN4CQlQnmypNfNLeVywe', 25, 45, 6, 3, 1, '361697', 1, 1, 1, 'NBL8tDsistqbzLNp0bTGoNAU5R3aWS0A1XuwtVL8UJWiZCXRYEtawkwu3CzE', '2019-07-11 16:36:22', '2019-08-06 17:40:16', NULL),
(360, 'Tukaram', 'Salunkhe', NULL, '7798315227', '', 17, 34, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 12:26:16', '2019-07-15 12:26:16', NULL),
(361, 'Rajesh', 'Budhner', NULL, '9324827932', '', 17, 34, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 12:26:54', '2019-07-15 12:26:54', NULL),
(362, 'Vijay', 'Gaikwad', NULL, '9922639950', '', 17, 34, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 12:27:22', '2019-07-15 12:27:22', NULL),
(363, 'Suvarna', 'Vadde', NULL, '9657309506', '', 5, 40, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 12:39:29', '2019-07-15 12:39:29', NULL),
(364, 'Smita', 'Gawade', NULL, '7219483970', '', 5, 40, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 12:40:47', '2019-07-15 12:40:47', NULL),
(365, 'Amit', 'Girame', NULL, '8007688229', '', 5, 40, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 12:41:39', '2019-07-15 12:41:39', NULL),
(366, 'Rajendrakumar', 'Patil', NULL, '9422798145', '', 34, 103, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 13:33:10', '2019-07-15 13:33:10', NULL),
(367, 'Avinash', 'Kulkarni', NULL, '9049306614', '', 4, 6, 5, 2, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 15:27:18', '2019-07-15 15:27:18', NULL),
(368, 'Uddhav', 'Wavre', NULL, '8830647407', '', 4, 6, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-07-15 15:28:13', '2019-07-15 15:28:13', NULL),
(369, 'Ashokkumar', 'Wadibhasme', NULL, '9623778823', '', 29, 59, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-07-17 00:48:10', '2019-07-17 00:48:10', NULL),
(370, 'A.T.', 'Garkal', NULL, '9404697644', '', 1, 100, 9, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-17 00:57:19', '2019-07-17 00:57:19', NULL),
(371, 'H.B.', 'Giri', NULL, '8669100714', '', 1, 100, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-17 00:58:41', '2019-07-17 00:58:41', NULL),
(372, 'S.B.', 'Inde', NULL, '7558370611', '', 1, 100, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-17 00:59:38', '2019-07-17 00:59:38', NULL),
(373, 'S.P.', 'Salunke', NULL, '9822409932', '', 1, 100, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-17 01:00:21', '2019-07-17 01:00:21', NULL),
(374, 'Sanjay', 'Shelar', NULL, '9890619192', '$2y$10$5znBJDHSNJZG1obhxZXSx.eUjbhvCqlOJLSK4Z6FsvQR//W7hSkc6', 25, 126, 5, 2, 1, '629891', 1, 1, NULL, 'orpzmB0ekedhlkLOG9fxgiXZSjcmNLNH9rwqXzJkKvO7dIBflh26WnFeSQ0S', '2019-07-26 16:05:38', '2019-07-26 16:05:38', NULL),
(375, 'Sanjay', 'Gaidhani', NULL, '9970643451', '$2y$10$dRKD7.cv9aC55xerPp4E..DIaZ8zQOVfU9eMx5h7PiJDxllFR15bW', 25, 126, 4, 2, 1, '797123', 1, 1, NULL, 'n046byNXGdhhB7SVTlaFYiiezpINTTilJpOW65zUmGYxsEpy8p7Lt5DuRJkO', '2019-07-26 16:06:12', '2019-07-26 16:06:12', NULL),
(376, 'Ajit', 'Gaikwad', NULL, '9869404957', '$2y$10$GTdPvnR3kC9LJ.dDQeNtu.teF0WyFQLfeaiDP9YyoMuMD5uUamM.W', 25, 126, 10, 2, 1, '578727', 1, 1, 1, 'qak6veluvWUBC1LmGJJUCyib20XaCGBFGzJv9kDKu3Ke1RjYMiZR0J2kvTIo', '2019-07-26 16:06:42', '2019-08-01 12:01:39', NULL),
(377, 'Ananta', 'Fasale', NULL, '9272390749', '$2y$10$yrNwog8efAgZ.peZf7eVY.X2Za6kfMSk0MTaiPQVq7WD7NTbw5G6K', 17, 127, 5, 2, 1, '277939', 1, 1, NULL, 'Gu248zmdGqLrqa4pVLMTVXhS5tTvLAhWe2jbZ7YdeiL5P3YbPyuOZtlUmbRU', '2019-07-27 17:56:42', '2019-07-27 17:56:42', NULL),
(378, 'Pallavi', 'Joshi', NULL, '7276510201', '$2y$10$Qo2LWxkHZEBRQYkqqRDmyO8d9d2EEaHvbtaPxc50VfHv9x1aF2Lw2', 17, 127, 4, 2, 1, '161205', 1, 1, NULL, 'HlMiMbbragWQvRiQdTlbhs4NS6jLey9J4q7trJyjZGVX4JuGe43w6v5vZB2A', '2019-07-27 17:57:23', '2019-07-27 17:57:23', NULL),
(379, 'G.D.', 'Kabade', NULL, '8482921175', '', 17, 127, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-07-27 17:58:08', '2019-07-27 17:58:08', NULL),
(380, 'Sunil', 'Gawli', NULL, '9960241212', '', 5, 12, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-27 18:04:25', '2019-07-27 18:04:25', NULL),
(381, 'Sheetal', 'Birajdar', NULL, '8087726052', '', 5, 12, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-27 18:05:23', '2019-07-27 18:05:23', NULL),
(382, 'V.V.', 'Gaikwad', NULL, '8875001042', '', 17, 51, 7, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-31 17:27:47', '2019-07-31 17:27:47', NULL),
(383, 'S.E.', 'Kamble', NULL, '9272661090', '', 17, 51, 38, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-31 17:33:32', '2019-07-31 17:33:32', NULL),
(384, 'P.S.', 'Bhangre', NULL, '9867424110', '', 17, 51, 6, 3, 0, NULL, 1, 1, NULL, NULL, '2019-07-31 17:34:05', '2019-07-31 17:34:05', NULL),
(385, 'Shrikant', 'Gabhane', NULL, '9987983396', '', 32, 69, 10, 2, 0, NULL, 1, 1, NULL, NULL, '2019-08-01 01:50:57', '2019-08-01 01:50:57', NULL),
(386, 'P.S.', 'Hangal', NULL, '9665222828', '$2y$10$ndCtC.gYm0Si694bDT347uOB3S05GqUvqRhqgu4gp5oiBIKp2Bzta', 16, 32, 7, 3, 1, '332663', 1, 1, NULL, 'mJfhIuRbQJDBEI4zSU3qtk5Dm7vumqtUVHFybBWrgPs6hiGkCnNa6wxWuVqn', '2019-08-06 16:59:03', '2019-08-06 16:59:03', NULL),
(387, 'V.S.', 'Bhosale', NULL, '9518351419', '$2y$10$Sy14QDHGMe9YY0LqmeKRcuSagTjeHkPx0.WWEL74phGtb.2t7PVJC', 16, 32, 38, 3, 1, '956341', 1, 1, NULL, 'VnXLrOr8xUu7MtwKWlzzF34L1ixZfWnLLOdWjAA5XA3Dc4pHdVFYB0hdgou7', '2019-08-06 16:59:59', '2019-08-06 16:59:59', NULL),
(388, 'M.G.', 'Dalvi', NULL, '9421031555', '$2y$10$XGlriskBCB9cC0GPy0V6C.EAC60CaW7he3Mnx1.aJIdEYG3Ehz9Em', 16, 32, 6, 3, 1, '588751', 1, 1, 1, '7tJRztLNHkSi4ON7RLTdtZLalCVvcSRViVxcTPebNB7mFZsFR0LQTKM201cX', '2019-08-06 17:01:19', '2019-09-28 15:09:27', NULL),
(389, 'Palash', 'Maraskolhe', NULL, '9689050064', '$2y$10$p7Peo7QyBK5hJjCURzTJP.jcUEjsoJ/KFr5qnPsDgflPVsgWmDVuO', 0, 0, 3, 1, 1, '251645', 1, 213, NULL, 'wSi7LFwZ0gnegQzWMEmJLYdaLsNL2s2F0pnVaCGVtX8BD7zi8EsEl0FOkrqc', '2019-08-09 11:00:18', '2019-08-09 11:00:18', NULL),
(390, 'Ramesh', 'Wankhede', NULL, '9420734233', '$2y$10$bdRnsVd2XP0bytgN29s1LuZ1lPNKedkEIoujKCTSaKi/plEm1.3/.', 4, 6, 9, 3, 1, '183327', 1, 1, NULL, 'QJ6V15jmVnq3GN8A4iWuKFbvJinC5WjLqAtC0eJNNhqUajniO6imh1ngcTjg', '2019-09-30 16:02:24', '2019-09-30 16:02:24', NULL),
(391, 'Bhimrao', 'Rathod', NULL, '8830632228', '$2y$10$X0lE62jMP4.ZAz.FFKrTQ.R859ckqKWkNvYuQuK9Bbb2gQywtBXey', 4, 6, 7, 3, 1, '260169', 1, 1, NULL, 'I6OZ4ETvnCqmWKOccML0c0575ls5PE9XMI7MLuUSrL49twkz8EiMkUb18ugd', '2019-09-30 16:03:25', '2019-09-30 16:03:25', NULL),
(392, 'Ganesh', 'Wagh', NULL, '9028806981', '$2y$10$lU089gVYQwKrC7D.wC2EqeDiUZ8mHx9Cq2oPNb682Kg2/YhIPxHKC', 4, 6, 38, 3, 1, '937231', 1, 1, NULL, '9rfFFyOmoNitBGa5pqzvVLE3IY1cc34qdjUDxAkDSiqngx68Og2XPzn1xZTx', '2019-09-30 16:04:16', '2019-09-30 16:04:16', NULL),
(393, 'Pandit', 'Chavan', NULL, '9423730331', '$2y$10$up3ORyiWYl00Ub3fpKcpKuGF7AK6RFweaqJ0Au6K3cE086fbHuxsS', 4, 6, 6, 3, 1, '619754', 1, 1, NULL, '9g1h8zbrqy66yobTkbOFSnwxUyuzo4I0L4emf2335IATtwJ8v5y7hjyRqoDo', '2019-09-30 16:05:24', '2019-09-30 16:05:24', NULL),
(394, 'D.N.', 'Shinde', NULL, '9822824067', '$2y$10$mye4k.bIei7ImmIGbxMmm.tb.6E6Njl/vX.27SkOO7j32uJHr48bC', 17, 42, 6, 3, 1, '572761', 1, 1, NULL, 'MId5vUSiDwbvQ06PBVMIPNM39YxoYjQN0koEICIaiSQHDEHfGVtMgmTs5pac', '2019-10-14 14:34:44', '2019-10-14 14:34:44', NULL),
(395, 'S.B.', 'Sonwalkar', NULL, '9766814322', '$2y$10$MY7XW.1ca1y1PUTMxrRSG.RNB3Q8JH5Yr6Os.fqamoWLracjwjOKu', 17, 42, 7, 3, 1, '841303', 1, 1, NULL, 'Miosp3nN8PkWYPM5cdfXJErwwt1YdGT7kyUPC7sNOrsSl4ZpxRqEGWZnVLsL', '2019-10-14 14:35:39', '2019-10-14 14:35:39', NULL),
(396, 'M.M.', 'Bansode', NULL, '7066897778', '$2y$10$bBeq.uBen6yktCeYi2pdiu/6sz7.BnoQgI6WOB2KZ.6f3thSEtlwO', 17, 42, 38, 3, 1, '884888', 1, 1, NULL, 'qYw6IZqBKh2T5UyTwNct2z3mngmwwH7qQj34SUgM6rnz63rNy8P1l1ByKuRW', '2019-10-14 14:36:26', '2019-10-14 14:36:26', NULL),
(397, 'testing manager', 'testing', 'testing@gmail.com', '1212121212', '$2y$10$doI7dq.ykG3QCsycwgGqweMJ8A8N/mWc1WfWd9p8Vboq10WFcHZoq', 0, 0, 2, 1, 0, NULL, 0, 2, NULL, NULL, '2019-11-13 08:02:10', '2019-11-13 09:38:50', NULL),
(398, 'testing accountant', 'account', 'account@gmail.com', '2323232323', '$2y$10$doI7dq.ykG3QCsycwgGqweMJ8A8N/mWc1WfWd9p8Vboq10WFcHZoq', 0, 0, 3, 1, 0, NULL, 0, 2, NULL, NULL, '2019-11-13 08:02:48', '2019-11-13 09:38:50', NULL),
(399, 'er', 'er', NULL, '4545455454', '', 19, 115, 8, 3, 0, NULL, 1, 2, NULL, NULL, '2019-11-13 09:14:39', '2019-11-13 09:14:39', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `usertypes`
--

CREATE TABLE `usertypes` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `usertypes`
--

INSERT INTO `usertypes` (`id`, `name`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 0, 0, '2018-08-30 14:18:02', '2018-08-31 08:17:16', NULL),
(2, 'Vendor Manager', 0, 0, '2018-08-30 14:18:26', '2018-08-31 06:56:49', NULL),
(3, 'Vendor Accountant', 0, 0, '2018-08-30 14:18:45', '2018-08-31 05:59:48', NULL),
(4, 'Divisional Accounts Officer', 0, 1, '2018-09-05 12:02:12', '2019-07-27 17:58:20', NULL),
(5, 'Divisional Accountant', 0, 1, '2018-09-05 12:01:45', '2019-07-27 17:58:31', NULL),
(6, 'Depot Manager', 0, 0, '2018-09-05 12:01:21', '2018-09-05 12:01:21', NULL),
(7, 'Asst Traffic Superintendent', 0, 1, '2018-09-05 12:00:29', '2019-01-02 17:32:09', NULL),
(8, 'Junior Accountant', 0, 0, '2018-09-05 11:58:55', '2018-09-05 11:58:55', NULL),
(9, 'Senior Clerk', 0, 0, '2018-08-31 08:17:39', '2018-08-31 12:52:08', NULL),
(10, 'Divisional Controller', 0, 1, '2018-09-05 12:02:41', '2019-07-27 17:58:41', NULL),
(37, 'test', 1, NULL, '2018-09-14 23:25:12', '2018-09-14 23:25:12', NULL),
(38, 'Depot Accountant', 1, NULL, '2018-10-02 15:24:35', '2018-10-02 15:24:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_master_logs`
--

CREATE TABLE `user_master_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL COMMENT '0 for inactive 1 for active',
  `updated_by` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `vehicle_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bus_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT '1' COMMENT '0 for inactive 1 for active',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vendor_id`, `vehicle_no`, `bus_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'MH03 CP5220', 'sleeper', 0, 3, 2, '2019-01-02 16:56:06', '2019-11-15 10:49:18', NULL),
(2, 1, 'MH03 CP3717', 'sleeper', 1, 3, NULL, '2019-01-02 17:02:41', '2019-01-02 17:02:41', NULL),
(3, 1, 'MH03 CP3716', 'sleeper', 1, 3, NULL, '2019-01-02 17:29:14', '2019-01-02 17:29:14', NULL),
(4, 1, 'MH03 CP3715', 'sleeper', 1, 3, NULL, '2019-01-02 17:29:56', '2019-01-02 17:29:56', NULL),
(5, 1, 'MH03 CP2791', 'seater', 1, 1, NULL, '2019-01-03 15:24:36', '2019-01-03 15:24:36', NULL),
(6, 1, 'MH03 CP3713', 'sleeper', 1, 1, NULL, '2019-01-03 15:26:45', '2019-01-03 15:26:45', NULL),
(7, 1, 'MH03 CP4553', 'sleeper', 1, 1, NULL, '2019-01-03 15:31:07', '2019-01-03 15:31:07', NULL),
(8, 1, 'MH03 CP4559', 'sleeper', 1, 1, NULL, '2019-01-03 15:31:59', '2019-01-03 15:31:59', NULL),
(9, 1, 'MH03 CP4556', 'sleeper', 1, 1, 1, '2019-01-03 15:39:28', '2019-02-23 16:42:43', NULL),
(10, 1, 'MH03 CP4560', 'sleeper', 1, 1, NULL, '2019-01-03 15:40:20', '2019-01-03 15:40:20', NULL),
(11, 1, 'MH03 CP4558', 'sleeper', 1, 1, NULL, '2019-01-03 15:46:07', '2019-01-03 15:46:07', NULL),
(12, 1, 'MH03 CP4557', 'sleeper', 1, 1, 1, '2019-01-03 15:48:31', '2019-02-23 16:55:03', NULL),
(13, 1, 'MH03 CP4730', 'seater', 1, 1, 1, '2019-01-03 15:55:02', '2019-01-03 15:55:13', NULL),
(14, 1, 'MH03 CP4898', 'sleeper', 1, 1, 1, '2019-01-03 15:57:53', '2019-01-04 14:01:05', NULL),
(15, 1, 'MH03 CP5224', 'seater', 1, 1, 3, '2019-01-03 15:59:15', '2019-01-22 14:38:28', NULL),
(16, 1, 'MH03 CP5218', 'seater', 1, 1, NULL, '2019-01-03 16:00:10', '2019-01-03 16:00:10', NULL),
(17, 1, 'MH03 CP5223', 'seater', 1, 1, NULL, '2019-01-03 16:00:33', '2019-01-03 16:00:33', NULL),
(18, 1, 'MH03 CP5221', 'seater', 1, 1, NULL, '2019-01-03 16:00:54', '2019-01-03 16:00:54', NULL),
(19, 1, 'MH03 CP2793', 'seater', 1, 1, NULL, '2019-01-03 16:02:24', '2019-01-03 16:02:24', NULL),
(20, 1, 'MH03 CP2792', 'seater', 1, 1, NULL, '2019-01-03 16:04:03', '2019-01-03 16:04:03', NULL),
(21, 1, 'MH03 CP3714', 'sleeper', 1, 1, NULL, '2019-01-03 16:20:44', '2019-01-03 16:20:44', NULL),
(22, 2, 'MH03 CP3281', 'seater', 1, 1, 1, '2019-01-03 16:24:22', '2019-11-10 18:31:57', NULL),
(23, 2, 'MH03 CP3280', 'seater', 1, 1, NULL, '2019-01-03 16:24:50', '2019-01-03 16:24:50', NULL),
(24, 2, 'MH03 CP3301', 'seater', 1, 1, 1, '2019-01-03 16:30:42', '2019-08-09 15:43:20', NULL),
(25, 2, 'MH03 CP3279', 'seater', 1, 1, 1, '2019-01-03 16:31:45', '2019-08-09 15:05:59', NULL),
(26, 2, 'MH03 CP4314', 'sleeper', 1, 1, 1, '2019-01-03 16:36:02', '2019-08-28 12:58:36', NULL),
(27, 2, 'MH03 CP4312', 'sleeper', 1, 1, NULL, '2019-01-03 16:36:37', '2019-01-03 16:36:37', NULL),
(28, 2, 'MH03 CP4415', 'sleeper', 1, 1, 1, '2019-01-03 16:37:48', '2019-08-28 18:13:51', NULL),
(29, 2, 'MH03 CP4547', 'sleeper', 1, 1, NULL, '2019-01-03 16:41:39', '2019-01-03 16:41:39', NULL),
(30, 2, 'MH03 CP4548', 'sleeper', 1, 1, 1, '2019-01-03 16:49:12', '2019-07-31 18:09:57', NULL),
(31, 2, 'MH03 CP4552', 'sleeper', 1, 1, NULL, '2019-01-03 16:57:21', '2019-01-03 16:57:21', NULL),
(32, 2, 'MH03 CP4550', 'sleeper', 1, 1, NULL, '2019-01-03 16:58:03', '2019-01-03 16:58:03', NULL),
(33, 2, 'MH03 CP4549', 'sleeper', 1, 1, NULL, '2019-01-03 16:58:43', '2019-01-03 16:58:43', NULL),
(34, 2, 'MH03 CP4551', 'sleeper', 1, 1, NULL, '2019-01-03 16:59:16', '2019-01-03 16:59:16', NULL),
(35, 2, 'MH03 CP4728', 'sleeper', 1, 1, 1, '2019-01-03 16:59:56', '2019-11-02 12:46:16', NULL),
(36, 2, 'MH03 CP5022', 'seater', 1, 1, NULL, '2019-01-03 17:00:45', '2019-01-03 17:00:45', NULL),
(37, 2, 'MH03 CP5028', 'seater', 1, 1, 1, '2019-01-03 17:01:07', '2019-10-24 14:37:05', NULL),
(38, 2, 'MH03 CP5025', 'seater', 1, 1, NULL, '2019-01-03 17:01:32', '2019-01-03 17:01:32', NULL),
(39, 2, 'MH03 CP5027', 'seater', 1, 1, 1, '2019-01-03 17:01:50', '2019-10-24 14:36:48', NULL),
(40, 2, 'MH03 CP5024', 'seater', 1, 1, NULL, '2019-01-03 17:02:10', '2019-01-03 17:02:10', NULL),
(41, 2, 'MH03 CP5211', 'seater', 1, 1, NULL, '2019-01-03 17:02:36', '2019-01-03 17:02:36', NULL),
(42, 2, 'MH03 CP5209', 'seater', 1, 1, NULL, '2019-01-03 17:03:02', '2019-01-03 17:03:02', NULL),
(43, 2, 'MH03 CP5210', 'seater', 1, 1, NULL, '2019-01-03 17:03:24', '2019-01-03 17:03:24', NULL),
(44, 2, 'MH03 CP5208', 'seater', 1, 1, NULL, '2019-01-03 17:03:45', '2019-01-03 17:03:45', NULL),
(45, 4, 'MH02 ER3277', 'seater', 1, 1, NULL, '2019-01-03 17:13:03', '2019-01-03 17:13:03', NULL),
(46, 4, 'MH02 ER3284', 'seater', 1, 1, NULL, '2019-01-03 17:25:55', '2019-01-03 17:25:55', NULL),
(47, 4, 'MH02 ER3276', 'seater', 1, 1, NULL, '2019-01-03 17:26:56', '2019-01-03 17:26:56', NULL),
(48, 4, 'MH02 ER3556', 'seater', 1, 1, NULL, '2019-01-03 17:27:55', '2019-01-03 17:27:55', NULL),
(49, 4, 'MH02 ER4077', 'sleeper', 1, 1, NULL, '2019-01-03 17:28:32', '2019-01-03 17:28:32', NULL),
(50, 4, 'MH02 ER4076', 'sleeper', 1, 1, NULL, '2019-01-03 17:29:10', '2019-01-03 17:29:10', NULL),
(51, 4, 'MH02 ER4075', 'sleeper', 1, 1, NULL, '2019-01-03 17:29:47', '2019-01-03 17:29:47', NULL),
(52, 4, 'MH02 ER4079', 'seater', 1, 1, NULL, '2019-01-03 17:30:34', '2019-01-03 17:30:34', NULL),
(53, 4, 'MH02 ER4085', 'sleeper', 1, 1, NULL, '2019-01-03 17:31:45', '2019-01-03 17:31:45', NULL),
(54, 4, 'MH02 ER4177', 'sleeper', 1, 1, NULL, '2019-01-03 17:32:46', '2019-01-03 17:32:46', NULL),
(55, 4, 'MH02 ER4174', 'sleeper', 1, 1, NULL, '2019-01-03 17:35:56', '2019-01-03 17:35:56', NULL),
(56, 4, 'MH02 ER4179', 'sleeper', 1, 1, NULL, '2019-01-03 17:36:47', '2019-01-03 17:36:47', NULL),
(57, 4, 'MH02 ER4173', 'sleeper', 1, 1, NULL, '2019-01-03 17:37:20', '2019-01-03 17:37:20', NULL),
(58, 4, 'MH02 ER4176', 'seater', 1, 1, NULL, '2019-01-03 17:38:47', '2019-01-03 17:38:47', NULL),
(59, 4, 'MH02 ER4178', 'seater', 1, 1, NULL, '2019-01-03 17:39:11', '2019-01-03 17:39:11', NULL),
(60, 4, 'MH02 ER4180', 'seater', 1, 1, NULL, '2019-01-03 17:39:39', '2019-01-03 17:39:39', NULL),
(61, 4, 'MH02 ER4429', 'seater', 1, 1, NULL, '2019-01-03 17:40:15', '2019-01-03 17:40:15', NULL),
(62, 4, 'MH02 ER4428', 'sleeper', 1, 1, NULL, '2019-01-03 17:40:46', '2019-01-03 17:40:46', NULL),
(63, 4, 'MH02 ER4430', 'seater', 1, 1, NULL, '2019-01-03 17:41:30', '2019-01-03 17:41:30', NULL),
(64, 4, 'MH02 ER4427', 'sleeper', 1, 1, NULL, '2019-01-03 17:42:09', '2019-01-03 17:42:09', NULL),
(65, 4, 'MH02 ER4635', 'sleeper', 1, 1, NULL, '2019-01-03 17:43:02', '2019-01-03 17:43:02', NULL),
(66, 3, 'MH03 CP3934', 'seater', 1, 1, 1, '2019-01-03 17:44:22', '2019-06-10 12:52:27', NULL),
(67, 3, 'MH03 CP4112', 'sleeper', 1, 1, NULL, '2019-01-03 17:45:28', '2019-01-03 17:45:28', NULL),
(68, 3, 'MH03 CP4107', 'sleeper', 1, 1, NULL, '2019-01-03 17:45:54', '2019-01-03 17:45:54', NULL),
(69, 3, 'MH03 CP4310', 'sleeper', 1, 1, NULL, '2019-01-03 17:46:23', '2019-01-03 17:46:23', NULL),
(70, 3, 'MH03 CP4109', 'sleeper', 1, 1, NULL, '2019-01-03 17:46:48', '2019-01-03 17:46:48', NULL),
(71, 3, 'MH03 CP4108', 'sleeper', 1, 1, NULL, '2019-01-03 17:47:21', '2019-01-03 17:47:21', NULL),
(72, 3, 'MH03 CP4110', 'sleeper', 1, 1, NULL, '2019-01-03 17:48:08', '2019-01-03 17:48:08', NULL),
(73, 3, 'MH03 CP4543', 'sleeper', 1, 1, NULL, '2019-01-03 17:48:41', '2019-01-03 17:48:41', NULL),
(74, 3, 'MH03 CP4405', 'seater', 1, 1, NULL, '2019-01-03 17:49:08', '2019-01-03 17:49:08', NULL),
(75, 3, 'MH03 CP4406', 'seater', 1, 1, NULL, '2019-01-03 17:49:43', '2019-01-03 17:49:43', NULL),
(76, 3, 'MH03 CP4403', 'seater', 1, 1, NULL, '2019-01-03 17:50:07', '2019-01-03 17:50:07', NULL),
(77, 3, 'MH03 CP4404', 'seater', 1, 1, NULL, '2019-01-03 17:50:31', '2019-01-03 17:50:31', NULL),
(78, 3, 'MH03 CP4409', 'sleeper', 1, 1, NULL, '2019-01-03 17:51:07', '2019-01-03 17:51:07', NULL),
(79, 3, 'MH03 CP4413', 'sleeper', 1, 1, NULL, '2019-01-03 17:51:40', '2019-01-03 17:51:40', NULL),
(80, 3, 'MH03 CP4410', 'sleeper', 1, 1, NULL, '2019-01-03 17:52:10', '2019-01-03 17:52:10', NULL),
(81, 3, 'MH03 CP4408', 'sleeper', 1, 1, NULL, '2019-01-03 17:53:14', '2019-01-03 17:53:14', NULL),
(82, 3, 'MH03 CP4411', 'sleeper', 0, 1, NULL, '2019-01-03 17:53:48', '2019-07-31 18:13:06', NULL),
(83, 3, 'MH03 CP4542', 'sleeper', 1, 1, NULL, '2019-01-03 17:54:33', '2019-01-03 17:54:33', NULL),
(84, 3, 'MH03 CP4729', 'seater', 1, 1, NULL, '2019-01-03 17:55:17', '2019-01-03 17:55:17', NULL),
(85, 3, 'MH03 CP4899', 'seater', 1, 1, 1, '2019-01-03 17:55:50', '2019-03-04 17:45:49', NULL),
(86, 3, 'MH03 CP5213', 'seater', 1, 1, NULL, '2019-01-03 17:56:11', '2019-01-03 17:56:11', NULL),
(87, 3, 'MH03 CP5214', 'seater', 1, 1, NULL, '2019-01-03 17:56:32', '2019-01-03 17:56:32', NULL),
(88, 3, 'MH03 CP5217', 'seater', 1, 1, NULL, '2019-01-03 17:58:29', '2019-01-03 17:58:29', NULL),
(89, 3, 'MH03 CP5215', 'seater', 1, 1, NULL, '2019-01-03 17:59:08', '2019-01-03 17:59:08', NULL),
(90, 3, 'MH03 CP5212', 'seater', 1, 1, NULL, '2019-01-03 17:59:35', '2019-01-03 17:59:35', NULL),
(91, 3, 'MH03 CP5216', 'seater', 1, 1, NULL, '2019-01-03 18:00:02', '2019-01-03 18:00:02', NULL),
(92, 2, 'MH03 CP3278', 'seater', 1, 1, 1, '2019-01-03 18:01:40', '2019-08-09 15:05:31', NULL),
(93, 4, 'MH02 ER3275', 'seater', 1, 1, 1, '2019-01-03 18:02:10', '2019-06-10 12:52:49', NULL),
(94, 4, 'MH02 ER3278', 'seater', 1, 1, NULL, '2019-01-03 18:02:47', '2019-01-03 18:02:47', NULL),
(95, 1, 'MH03 CP4802', 'seater', 1, 1, 1, '2019-01-03 18:05:55', '2019-09-20 16:40:01', NULL),
(96, 1, 'MH03 CP4801', 'seater', 1, 1, NULL, '2019-01-03 18:06:27', '2019-01-03 18:06:27', NULL),
(97, 1, 'MH03 CP5226', 'seater', 1, 1, 1, '2019-01-03 18:07:01', '2019-09-20 16:40:40', NULL),
(98, 2, 'MH03 CP4313', 'sleeper', 1, 1, 1, '2019-01-04 12:52:09', '2019-08-28 12:59:11', NULL),
(99, 4, 'MH02 ER4181', 'sleeper', 1, 1, NULL, '2019-01-04 12:54:19', '2019-01-04 12:54:19', NULL),
(100, 4, 'MH02 ER4182', 'sleeper', 1, 1, NULL, '2019-01-04 12:55:02', '2019-01-04 12:55:02', NULL),
(101, 4, 'MH02 ER4078', 'seater', 1, 1, NULL, '2019-01-16 13:47:21', '2019-01-16 13:47:21', NULL),
(102, 1, 'MH03 CP2794', 'seater', 1, 1, NULL, '2019-02-09 16:50:08', '2019-02-09 16:50:08', NULL),
(103, 1, 'MH03 CP2790', 'seater', 1, 1, NULL, '2019-02-09 18:57:58', '2019-02-09 18:57:58', NULL),
(104, 1, 'MH03 CP5476', 'sleeper', 1, 1, NULL, '2019-02-23 17:48:40', '2019-02-23 17:48:40', NULL),
(105, 5, 'MH 04 HY 5261', 'seater', 1, 1, 1, '2019-04-29 18:55:11', '2019-06-19 13:47:13', NULL),
(106, 6, 'MH 04 JK 2847', 'seater', 1, 1, 1, '2019-05-15 22:22:18', '2019-10-11 15:10:49', NULL),
(107, 6, 'MH 04 JK 3151', 'seater', 1, 1, 1, '2019-05-15 22:22:44', '2019-10-11 15:05:34', NULL),
(108, 6, 'MH 04 JK 3163', 'seater', 0, 1, NULL, '2019-05-15 22:23:03', '2019-08-20 22:46:06', NULL),
(109, 6, 'MH 04 JK 2849', 'seater', 1, 1, 1, '2019-05-15 22:23:25', '2019-05-15 22:42:29', NULL),
(110, 6, 'MH 04 JK 2843', 'seater', 1, 1, 1, '2019-05-15 22:23:47', '2019-05-15 22:42:53', NULL),
(111, 6, 'MH 04 JK 3168', 'seater', 1, 1, 1, '2019-05-15 22:24:08', '2019-05-15 22:43:05', NULL),
(112, 6, 'MH 04 JK 3146', 'seater', 1, 1, 1, '2019-05-15 22:24:27', '2019-05-15 22:43:16', NULL),
(113, 6, 'MH 04 JK 2850', 'seater', 1, 1, 1, '2019-05-15 22:24:49', '2019-05-15 22:43:28', NULL),
(114, 6, 'MH 04 JK 5780', 'seater', 1, 1, 1, '2019-05-15 22:25:08', '2019-05-15 22:43:44', NULL),
(115, 6, 'MH 04 JK 4629', 'seater', 1, 1, 1, '2019-05-15 22:25:24', '2019-10-11 15:12:15', NULL),
(116, 6, 'MH 04 JK 4628', 'seater', 1, 1, 1, '2019-05-15 22:25:50', '2019-08-13 23:54:38', NULL),
(117, 6, 'MH 04 JK 3154', 'seater', 1, 1, 1, '2019-05-15 22:26:10', '2019-08-20 22:31:37', NULL),
(118, 6, 'MH 04 JK 2842', 'seater', 1, 1, 1, '2019-05-15 22:26:20', '2019-08-20 22:43:08', NULL),
(119, 6, 'MH 04 JK 3171', 'seater', 1, 1, 1, '2019-05-15 22:26:38', '2019-08-20 22:42:43', NULL),
(120, 6, 'MH 04 JK 2846', 'seater', 1, 1, 1, '2019-05-15 22:27:04', '2019-10-11 15:10:01', NULL),
(121, 6, 'MH 04 JK 2848', 'seater', 1, 1, 1, '2019-05-15 22:27:23', '2019-10-11 15:09:43', NULL),
(122, 6, 'MH 04 JK 1271', 'seater', 1, 1, 1, '2019-05-15 22:27:52', '2019-08-20 22:39:51', NULL),
(123, 6, 'MH 04 JK 1272', 'seater', 1, 1, 1, '2019-05-15 22:28:15', '2019-08-20 22:40:06', NULL),
(124, 6, 'MH 04 JK 3152', 'seater', 1, 1, 1, '2019-05-15 22:28:39', '2019-08-20 22:21:39', NULL),
(125, 6, 'MH 04 JK 2515', 'seater', 1, 1, NULL, '2019-05-15 22:29:00', '2019-05-15 22:29:00', NULL),
(126, 6, 'MH 04 JK 0196', 'seater', 1, 1, NULL, '2019-05-15 22:29:14', '2019-05-15 22:29:14', NULL),
(127, 6, 'MH 04 JK 2513', 'seater', 1, 1, NULL, '2019-05-15 22:29:35', '2019-05-15 22:29:35', NULL),
(128, 6, 'MH 04 JK 2514', 'seater', 1, 1, NULL, '2019-05-15 22:29:49', '2019-05-15 22:29:49', NULL),
(129, 6, 'MH 04 JK 2215', 'seater', 1, 1, 1, '2019-05-15 22:30:08', '2019-08-13 23:55:18', NULL),
(130, 6, 'MH 04 JK 1266', 'seater', 1, 1, 1, '2019-05-15 22:30:26', '2019-10-11 15:12:32', NULL),
(131, 6, 'MH 04 JK 2216', 'seater', 1, 1, 1, '2019-05-15 22:30:38', '2019-10-11 15:07:30', NULL),
(132, 6, 'MH 04 JK 1265', 'seater', 1, 1, 1, '2019-05-15 22:30:53', '2019-08-20 22:29:13', NULL),
(133, 6, 'MH 04 JK 3165', 'seater', 1, 1, 1, '2019-05-15 22:31:07', '2019-08-20 22:30:06', NULL),
(134, 6, 'MH 04 JK 3156', 'seater', 1, 1, 1, '2019-05-15 22:31:26', '2019-10-11 15:11:04', NULL),
(135, 6, 'MH 04 JK 3157', 'seater', 1, 1, 1, '2019-05-15 22:31:51', '2019-10-11 15:05:57', NULL),
(136, 6, 'MH 04 JK 3149', 'seater', 1, 1, 1, '2019-05-15 22:32:08', '2019-10-11 15:11:37', NULL),
(137, 6, 'MH 04 JK 3150', 'seater', 1, 1, 1, '2019-05-15 22:32:25', '2019-10-11 15:11:58', NULL),
(138, 6, 'MH 04 JK 0198', 'seater', 1, 1, 1, '2019-05-15 22:32:48', '2019-08-20 22:34:33', NULL),
(139, 6, 'MH 04 JK 0199', 'seater', 1, 1, 1, '2019-05-15 22:33:03', '2019-08-20 22:34:55', NULL),
(140, 6, 'MH 04 JK 3155', 'seater', 1, 1, NULL, '2019-05-15 22:33:23', '2019-05-15 22:33:23', NULL),
(141, 6, 'MH 04 JK 3161', 'seater', 1, 1, NULL, '2019-05-15 22:33:39', '2019-05-15 22:33:39', NULL),
(142, 6, 'MH 04 JK 1273', 'seater', 1, 1, NULL, '2019-05-15 22:34:05', '2019-05-15 22:34:05', NULL),
(143, 6, 'MH 04 JK 0749', 'seater', 1, 1, NULL, '2019-05-15 22:34:23', '2019-05-15 22:34:23', NULL),
(144, 6, 'MH 04 JK 2841', 'seater', 1, 1, NULL, '2019-05-15 22:34:42', '2019-05-15 22:34:42', NULL),
(145, 6, 'MH 04 JK  2512', 'seater', 1, 1, 1, '2019-05-15 22:34:58', '2019-05-15 22:35:50', NULL),
(146, 6, 'MH 04 HY 9783', 'seater', 1, 1, NULL, '2019-05-15 22:36:19', '2019-05-15 22:36:19', NULL),
(147, 6, 'MH 04 JK 8775', 'seater', 1, 1, NULL, '2019-05-15 22:36:38', '2019-05-15 22:36:38', NULL),
(148, 6, 'MH 04 HY 9782', 'seater', 1, 1, NULL, '2019-05-15 22:36:52', '2019-05-15 22:36:52', NULL),
(149, 6, 'MH 04 JK 0194', 'seater', 1, 1, NULL, '2019-05-15 22:37:14', '2019-05-15 22:37:14', NULL),
(150, 6, 'MH 04 JK 0267', 'seater', 1, 1, NULL, '2019-05-15 22:37:32', '2019-05-15 22:37:32', NULL),
(151, 6, 'MH 04 JK 1270', 'seater', 1, 1, NULL, '2019-05-15 22:37:54', '2019-05-15 22:37:54', NULL),
(152, 6, 'MH 04 JK 0428', 'seater', 1, 1, NULL, '2019-05-15 22:38:15', '2019-05-15 22:38:15', NULL),
(153, 6, 'MH 04 JK 0755', 'seater', 1, 1, 1, '2019-05-15 22:38:31', '2019-11-02 12:43:40', NULL),
(154, 6, 'MH 04 HY 9631', 'seater', 1, 1, NULL, '2019-05-15 22:54:29', '2019-05-15 22:54:29', NULL),
(155, 6, 'MH 04 JK 0429', 'seater', 1, 1, NULL, '2019-05-15 22:54:49', '2019-05-15 22:54:49', NULL),
(156, 6, 'MH 04 JK 0192', 'seater', 1, 1, NULL, '2019-05-15 22:55:10', '2019-05-15 22:55:10', NULL),
(157, 6, 'MH 04 JK 0737', 'seater', 1, 1, NULL, '2019-05-15 22:55:32', '2019-05-15 22:55:32', NULL),
(158, 6, 'MH 04 JU 8774', 'seater', 1, 1, NULL, '2019-05-15 22:55:45', '2019-05-15 22:55:45', NULL),
(159, 6, 'MH 04 JU 8775', 'seater', 1, 1, NULL, '2019-05-15 22:56:10', '2019-05-15 22:56:10', NULL),
(160, 6, 'MH 04 JU 8776', 'seater', 1, 1, NULL, '2019-05-15 22:56:50', '2019-05-15 22:56:50', NULL),
(161, 6, 'MH 04 JK 1267', 'seater', 1, 1, NULL, '2019-05-15 22:57:13', '2019-05-15 22:57:13', NULL),
(162, 6, 'MH 04 JK 0427', 'seater', 1, 1, NULL, '2019-05-15 22:57:34', '2019-05-15 22:57:34', NULL),
(163, 6, 'MH 04 JK 1268', 'seater', 1, 1, NULL, '2019-05-15 22:57:47', '2019-05-15 22:57:47', NULL),
(164, 6, 'MH 04 JK 0195', 'seater', 1, 1, NULL, '2019-05-15 22:58:01', '2019-05-15 22:58:01', NULL),
(165, 6, 'MH 04 JK 4624', 'seater', 1, 1, NULL, '2019-05-15 22:58:25', '2019-05-15 22:58:25', NULL),
(166, 6, 'MH 04 JK 4625', 'seater', 1, 1, NULL, '2019-05-15 22:58:34', '2019-05-15 22:58:34', NULL),
(167, 6, 'MH 04 JK 4627', 'seater', 1, 1, NULL, '2019-05-15 22:58:59', '2019-05-15 22:58:59', NULL),
(168, 6, 'MH 04 JK 4631', 'seater', 1, 1, NULL, '2019-05-15 22:59:13', '2019-05-15 22:59:13', NULL),
(169, 6, 'MH 04 JK 4632', 'seater', 1, 1, NULL, '2019-05-15 22:59:37', '2019-05-15 22:59:37', NULL),
(170, 6, 'MH 04 JK 4633', 'seater', 1, 1, NULL, '2019-05-15 22:59:47', '2019-05-15 22:59:47', NULL),
(171, 6, 'MH 04 JK 4650', 'seater', 1, 1, NULL, '2019-05-15 23:00:02', '2019-05-15 23:00:02', NULL),
(172, 6, 'MH 04 JK 5781', 'seater', 1, 1, NULL, '2019-05-15 23:00:18', '2019-05-15 23:00:18', NULL),
(173, 6, 'MH 04 HY 9780', 'seater', 1, 1, 1, '2019-05-15 23:00:41', '2019-08-20 22:27:20', NULL),
(174, 6, 'MH 04 HY 9784', 'seater', 1, 1, 1, '2019-05-15 23:00:52', '2019-08-20 22:27:39', NULL),
(175, 6, 'MH 04 JK 0190', 'seater', 1, 1, 1, '2019-05-15 23:01:09', '2019-10-11 15:06:31', NULL),
(176, 6, 'MH 04 JK 0268', 'seater', 1, 1, 1, '2019-05-15 23:01:32', '2019-08-20 22:25:43', NULL),
(177, 6, 'MH 04 JK 0197', 'seater', 1, 1, 1, '2019-05-15 23:01:57', '2019-10-11 15:07:02', NULL),
(178, 6, 'MH 04 JK 0193', 'seater', 1, 1, 1, '2019-05-15 23:02:13', '2019-08-20 22:26:07', NULL),
(179, 6, 'MH 04 JK 4630', 'seater', 1, 1, 1, '2019-05-15 23:02:29', '2019-10-11 15:03:26', NULL),
(180, 6, 'MH 04 JK 4634', 'seater', 1, 1, 1, '2019-05-15 23:02:43', '2019-08-13 23:55:02', NULL),
(181, 5, 'MH 04 HY 5262', 'seater', 1, 1, NULL, '2019-05-15 23:05:10', '2019-05-15 23:05:10', NULL),
(182, 5, 'MH 47 E 8031', 'seater', 1, 1, NULL, '2019-05-15 23:05:35', '2019-05-15 23:05:35', NULL),
(183, 5, 'MH 47 E 8026', 'seater', 1, 1, NULL, '2019-05-15 23:05:57', '2019-05-15 23:05:57', NULL),
(184, 5, 'MH 47 E 8029', 'seater', 1, 1, NULL, '2019-05-15 23:06:15', '2019-05-15 23:06:15', NULL),
(185, 5, 'MH 47 E 8035', 'seater', 1, 1, NULL, '2019-05-15 23:06:29', '2019-05-15 23:06:29', NULL),
(186, 5, 'MH 47 Y 0565', 'seater', 1, 1, NULL, '2019-05-15 23:06:57', '2019-05-15 23:06:57', NULL),
(187, 5, 'MH 47 Y 0544', 'seater', 1, 1, NULL, '2019-05-15 23:07:10', '2019-05-15 23:07:10', NULL),
(188, 5, 'MH 47 Y 0822', 'seater', 1, 1, NULL, '2019-05-15 23:07:29', '2019-05-15 23:07:29', NULL),
(189, 5, 'MH 47 Y 0956', 'seater', 1, 1, NULL, '2019-05-15 23:07:48', '2019-05-15 23:07:48', NULL),
(190, 5, 'MH 47 Y 0952', 'seater', 1, 1, NULL, '2019-05-15 23:08:04', '2019-05-15 23:08:04', NULL),
(191, 5, 'MH 47 Y 0539', 'seater', 1, 1, NULL, '2019-05-15 23:08:20', '2019-05-15 23:08:20', NULL),
(192, 5, 'MH 47 Y 0953', 'seater', 1, 1, NULL, '2019-05-15 23:08:36', '2019-05-15 23:08:36', NULL),
(193, 5, 'MH 47 E 8037', 'seater', 1, 1, NULL, '2019-05-15 23:08:48', '2019-05-15 23:08:48', NULL),
(194, 5, 'MH 47 E 8024', 'seater', 1, 1, NULL, '2019-05-15 23:09:02', '2019-05-15 23:09:02', NULL),
(195, 5, 'MH 47 E 8033', 'seater', 1, 1, NULL, '2019-05-15 23:09:14', '2019-05-15 23:09:14', NULL),
(196, 5, 'MH 47 E 8034', 'seater', 1, 1, NULL, '2019-05-15 23:09:25', '2019-05-15 23:09:25', NULL),
(197, 5, 'MH 47 Y 0826', 'seater', 1, 1, NULL, '2019-05-15 23:09:41', '2019-05-15 23:09:41', NULL),
(198, 5, 'MH 47 Y 0824', 'seater', 1, 1, NULL, '2019-05-15 23:09:56', '2019-05-15 23:09:56', NULL),
(199, 5, 'MH 47 Y 543', 'seater', 1, 1, NULL, '2019-05-15 23:10:24', '2019-05-15 23:10:24', NULL),
(200, 5, 'MH 47 Y 0955', 'seater', 1, 1, NULL, '2019-05-15 23:10:39', '2019-05-15 23:10:39', NULL),
(201, 5, 'MH 47 Y 0954', 'seater', 1, 1, NULL, '2019-05-15 23:10:59', '2019-05-15 23:10:59', NULL),
(202, 5, 'MH 47 Y 0895', 'seater', 1, 1, NULL, '2019-05-15 23:11:17', '2019-05-15 23:11:17', NULL),
(203, 5, 'MH 47 E 8030', 'seater', 1, 1, NULL, '2019-05-15 23:11:29', '2019-05-15 23:11:29', NULL),
(204, 5, 'MH 47 Y 0020', 'seater', 1, 1, NULL, '2019-05-15 23:11:49', '2019-05-15 23:11:49', NULL),
(205, 5, 'MH 47 Y 0028', 'seater', 1, 1, NULL, '2019-05-15 23:12:07', '2019-05-15 23:12:07', NULL),
(206, 5, 'MH 47 Y 0019', 'seater', 1, 1, NULL, '2019-05-15 23:12:22', '2019-05-15 23:12:22', NULL),
(207, 5, 'MH 47 E 8040', 'seater', 1, 1, NULL, '2019-05-15 23:12:35', '2019-05-15 23:12:35', NULL),
(208, 5, 'MH 47 Y 0029', 'seater', 1, 1, NULL, '2019-05-15 23:12:49', '2019-05-15 23:12:49', NULL),
(209, 5, 'MH 47 Y 0089', 'seater', 1, 1, NULL, '2019-05-15 23:13:27', '2019-05-15 23:13:27', NULL),
(210, 5, 'MH 47 Y 0087', 'seater', 1, 1, NULL, '2019-05-15 23:13:47', '2019-05-15 23:13:47', NULL),
(211, 5, 'MH 47 Y 0086', 'seater', 1, 1, NULL, '2019-05-15 23:14:02', '2019-05-15 23:14:02', NULL),
(212, 5, 'MH 47 Y 0014', 'seater', 1, 1, NULL, '2019-05-15 23:14:23', '2019-05-15 23:14:23', NULL),
(213, 5, 'MH 47 Y 0090', 'seater', 1, 1, NULL, '2019-05-15 23:14:34', '2019-05-15 23:14:34', NULL),
(214, 5, 'MH 47 Y 0298', 'seater', 1, 1, NULL, '2019-05-15 23:15:03', '2019-05-15 23:15:03', NULL),
(215, 5, 'MH 47 Y 0299', 'seater', 1, 1, NULL, '2019-05-15 23:15:24', '2019-05-15 23:15:24', NULL),
(216, 5, 'MH 47 Y 0091', 'seater', 1, 1, NULL, '2019-05-15 23:15:35', '2019-05-15 23:15:35', NULL),
(217, 5, 'MH 47 Y 0092', 'seater', 1, 1, NULL, '2019-05-15 23:15:50', '2019-05-15 23:15:50', NULL),
(218, 5, 'MH 47 Y 4117', 'seater', 1, 1, NULL, '2019-05-15 23:18:58', '2019-05-15 23:18:58', NULL),
(219, 5, 'MH 47 Y 0535', 'seater', 1, 1, NULL, '2019-05-15 23:19:11', '2019-05-15 23:19:11', NULL),
(220, 5, 'MH 47 Y 0306', 'seater', 1, 1, 1, '2019-05-15 23:19:23', '2019-08-12 17:20:28', NULL),
(221, 5, 'MH 47 Y 4115', 'seater', 1, 1, 1, '2019-05-15 23:19:43', '2019-08-12 17:20:45', NULL),
(222, 5, 'MH 47 Y 2050', 'seater', 1, 1, 1, '2019-05-15 23:19:58', '2019-08-12 17:21:03', NULL),
(223, 5, 'MH 47 Y 0304', 'seater', 1, 1, 1, '2019-05-15 23:20:18', '2019-08-12 17:19:19', NULL),
(224, 5, 'MH 47 Y 2459', 'seater', 1, 1, NULL, '2019-05-15 23:22:22', '2019-05-15 23:22:22', NULL),
(225, 5, 'MH 47 Y 4118', 'seater', 1, 1, 1, '2019-05-15 23:22:40', '2019-06-19 13:49:39', NULL),
(226, 5, 'MH 47 E 8038', 'seater', 1, 1, NULL, '2019-05-15 23:22:52', '2019-05-15 23:22:52', NULL),
(227, 5, 'MH 47 E 8036', 'seater', 1, 1, NULL, '2019-05-15 23:23:05', '2019-05-15 23:23:05', NULL),
(228, 5, 'MH 47 Y 4625', 'seater', 1, 1, NULL, '2019-05-15 23:23:19', '2019-05-15 23:23:19', NULL),
(229, 5, 'MH 47 Y 4634', 'seater', 1, 1, NULL, '2019-05-15 23:23:39', '2019-05-15 23:23:39', NULL),
(230, 5, 'MH 47 Y 2461', 'seater', 1, 1, NULL, '2019-05-15 23:24:09', '2019-05-15 23:24:09', NULL),
(231, 5, 'MH 47 Y 2462', 'seater', 1, 1, NULL, '2019-05-15 23:24:21', '2019-05-15 23:24:21', NULL),
(232, 5, 'MH 47 Y 2463', 'seater', 1, 1, 1, '2019-05-15 23:24:35', '2019-06-19 13:42:29', NULL),
(233, 5, 'MH 47 Y 0957', 'seater', 1, 1, NULL, '2019-05-15 23:26:02', '2019-05-15 23:26:02', NULL),
(234, 5, 'MH 47 Y 0307', 'seater', 1, 1, NULL, '2019-05-15 23:26:19', '2019-05-15 23:26:19', NULL),
(235, 5, 'MH 47 Y 0302', 'seater', 1, 1, NULL, '2019-05-15 23:26:31', '2019-05-15 23:26:31', NULL),
(236, 5, 'MH 47 Y 0301', 'seater', 1, 1, NULL, '2019-05-15 23:26:43', '2019-05-15 23:26:43', NULL),
(237, 5, 'MH 47 E 8039', 'seater', 1, 1, NULL, '2019-05-15 23:26:57', '2019-05-15 23:26:57', NULL),
(238, 5, 'MH 47 Y 4632', 'seater', 1, 1, NULL, '2019-05-15 23:27:09', '2019-05-15 23:27:09', NULL),
(239, 5, 'MH 47 Y 4627', 'seater', 1, 1, NULL, '2019-05-15 23:27:20', '2019-05-15 23:27:20', NULL),
(240, 5, 'MH 47 Y 1258', 'seater', 1, 1, 1, '2019-05-15 23:27:33', '2019-06-19 13:41:47', NULL),
(241, 5, 'MH 47 E 8032', 'seater', 1, 1, 1, '2019-05-15 23:28:38', '2019-06-19 13:42:14', NULL),
(242, 5, 'MH 47 Y 0308', 'seater', 1, 1, 1, '2019-05-15 23:28:58', '2019-08-12 17:19:50', NULL),
(243, 5, 'MH 47 Y 0533', 'seater', 1, 1, 1, '2019-05-15 23:29:13', '2019-08-12 17:20:08', NULL),
(244, 5, 'MH 47 Y 0542', 'seater', 1, 1, NULL, '2019-05-15 23:29:29', '2019-05-15 23:29:29', NULL),
(245, 5, 'MH 47 Y 0958', 'seater', 1, 1, NULL, '2019-05-15 23:29:42', '2019-05-15 23:29:42', NULL),
(246, 5, 'MH 47 Y 2460', 'seater', 1, 1, NULL, '2019-05-15 23:29:55', '2019-05-15 23:29:55', NULL),
(247, 5, 'MH 47 Y 2465', 'seater', 1, 1, NULL, '2019-05-15 23:30:08', '2019-05-15 23:30:08', NULL),
(248, 5, 'MH 47 Y 3267', 'seater', 1, 1, NULL, '2019-05-15 23:32:16', '2019-05-15 23:32:16', NULL),
(249, 5, 'MH 47 Y 3268', 'seater', 1, 1, NULL, '2019-05-15 23:32:32', '2019-05-15 23:32:32', NULL),
(250, 5, 'MH 47 Y 0536', 'seater', 1, 1, NULL, '2019-05-15 23:32:45', '2019-05-15 23:32:45', NULL),
(251, 5, 'MH 47 Y 0534', 'seater', 1, 1, NULL, '2019-05-15 23:33:00', '2019-05-15 23:33:00', NULL),
(252, 5, 'MH 47 Y 0541', 'seater', 1, 1, NULL, '2019-05-15 23:33:14', '2019-05-15 23:33:14', NULL),
(253, 5, 'MH 47 Y 0537', 'seater', 1, 1, NULL, '2019-05-15 23:33:30', '2019-05-15 23:33:30', NULL),
(254, 5, 'MH 47 Y 0017', 'seater', 1, 1, NULL, '2019-05-15 23:33:45', '2019-05-15 23:33:45', NULL),
(255, 5, 'MH 47 Y 0843', 'seater', 1, 1, NULL, '2019-05-15 23:34:06', '2019-05-15 23:34:06', NULL),
(256, 5, 'MH 47 Y 1257', 'seater', 1, 1, NULL, '2019-05-15 23:34:20', '2019-05-15 23:34:20', NULL),
(257, 5, 'MH 47 Y 0538', 'seater', 1, 1, 1, '2019-05-15 23:34:34', '2019-08-12 17:21:21', NULL),
(258, 5, 'MH 47 Y 0825', 'seater', 1, 1, NULL, '2019-05-15 23:34:48', '2019-05-15 23:34:48', NULL),
(259, 5, 'MH 47 Y 0977', 'seater', 1, 1, NULL, '2019-05-15 23:35:07', '2019-05-15 23:35:07', NULL),
(260, 5, 'MH 47 Y 0564', 'seater', 1, 1, NULL, '2019-05-15 23:35:20', '2019-05-15 23:35:20', NULL),
(261, 5, 'MH 47 Y 2049', 'seater', 1, 1, NULL, '2019-05-15 23:35:34', '2019-05-15 23:35:34', NULL),
(262, 5, 'MH 47 Y 2051', 'seater', 1, 1, NULL, '2019-05-15 23:35:54', '2019-05-15 23:35:54', NULL),
(263, 7, 'MH18 BG2427', 'seater', 1, 1, NULL, '2019-05-15 23:53:52', '2019-05-15 23:53:52', NULL),
(264, 7, 'MH18 BG2428', 'seater', 1, 1, NULL, '2019-05-15 23:54:06', '2019-05-15 23:54:06', NULL),
(265, 7, 'MH18 BG2256', 'seater', 1, 1, NULL, '2019-05-15 23:54:21', '2019-05-15 23:54:21', NULL),
(266, 7, 'MH18 BG2445', 'seater', 1, 1, NULL, '2019-05-15 23:54:37', '2019-05-15 23:54:37', NULL),
(267, 7, 'MH18 BG1537', 'sleeper', 1, 1, 1, '2019-05-15 23:54:52', '2019-07-22 13:02:49', NULL),
(268, 7, 'MH18 BG1676', 'sleeper', 1, 1, 1, '2019-05-15 23:55:26', '2019-07-22 13:02:59', NULL),
(269, 7, 'MH18 BG1675', 'sleeper', 1, 1, 1, '2019-05-15 23:55:45', '2019-07-22 13:03:07', NULL),
(270, 7, 'MH18 BG2429', 'sleeper', 1, 1, 1, '2019-05-15 23:56:02', '2019-07-22 13:03:22', NULL),
(271, 7, 'MH18 BG2176', 'seater', 1, 1, NULL, '2019-05-15 23:56:18', '2019-05-15 23:56:18', NULL),
(272, 7, 'MH18 BG2257', 'seater', 1, 1, NULL, '2019-05-15 23:56:32', '2019-05-15 23:56:32', NULL),
(273, 7, 'MH18 BG1479', 'seater', 1, 1, NULL, '2019-05-15 23:56:50', '2019-05-15 23:56:50', NULL),
(274, 7, 'MH18 BG2130', 'seater', 1, 1, NULL, '2019-05-15 23:57:05', '2019-05-15 23:57:05', NULL),
(275, 7, 'MH18 BG1535', 'seater', 1, 1, NULL, '2019-05-15 23:57:18', '2019-05-15 23:57:18', NULL),
(276, 7, 'MH18 BG2134', 'seater', 1, 1, NULL, '2019-05-15 23:57:31', '2019-05-15 23:57:31', NULL),
(277, 7, 'MH18 BG2422', 'seater', 1, 1, 1, '2019-05-15 23:57:45', '2019-11-10 18:32:30', NULL),
(278, 7, 'MH18 BG2423', 'seater', 1, 1, 1, '2019-05-15 23:57:58', '2019-11-10 18:32:48', NULL),
(279, 7, 'MH18 BG1351', 'seater', 1, 1, NULL, '2019-05-15 23:58:17', '2019-05-15 23:58:17', NULL),
(280, 7, 'MH18 BG1481', 'seater', 1, 1, NULL, '2019-05-15 23:58:32', '2019-05-15 23:58:32', NULL),
(281, 7, 'MH18 BG2587', 'sleeper', 1, 1, 1, '2019-05-15 23:58:50', '2019-10-16 16:58:20', NULL),
(282, 7, 'MH18 BG2588', 'sleeper', 1, 1, 1, '2019-05-15 23:59:03', '2019-10-16 16:58:52', NULL),
(283, 8, 'MH-29-BE1031', 'seater', 1, 1, NULL, '2019-05-16 00:16:00', '2019-05-16 00:16:00', NULL),
(284, 8, 'MH-29-BE1032', 'seater', 1, 1, NULL, '2019-05-16 00:16:22', '2019-05-16 00:16:22', NULL),
(285, 8, 'MH-29-BE0834', 'seater', 1, 1, NULL, '2019-05-16 00:16:37', '2019-05-16 00:16:37', NULL),
(286, 8, 'MH-29-BE0835', 'seater', 1, 1, NULL, '2019-05-16 00:16:54', '2019-05-16 00:16:54', NULL),
(287, 8, 'MH-29-BE0956', 'sleeper', 1, 1, NULL, '2019-05-16 00:17:11', '2019-05-16 00:17:11', NULL),
(288, 8, 'MH-29-BE1019', 'sleeper', 1, 1, NULL, '2019-05-16 00:17:27', '2019-05-16 00:17:27', NULL),
(289, 8, 'MH-29-BE0957', 'sleeper', 1, 1, NULL, '2019-05-16 00:17:45', '2019-05-16 00:17:45', NULL),
(290, 8, 'MH-29-BE1023', 'sleeper', 1, 1, NULL, '2019-05-16 00:18:00', '2019-05-16 00:18:00', NULL),
(291, 8, 'MH-29-BE0837', 'seater', 1, 1, 1, '2019-05-16 00:18:24', '2019-08-12 17:00:40', NULL),
(292, 8, 'MH-29-BE0934', 'seater', 1, 1, 1, '2019-05-16 00:18:56', '2019-08-12 17:01:02', NULL),
(293, 8, 'MH-29-BE0832', 'seater', 1, 1, NULL, '2019-05-16 00:19:15', '2019-05-16 00:19:15', NULL),
(294, 8, 'MH-29-BE0935', 'seater', 1, 1, NULL, '2019-05-16 00:19:30', '2019-05-16 00:19:30', NULL),
(295, 8, 'MH-29-BE1211', 'seater', 1, 1, NULL, '2019-05-16 00:19:49', '2019-05-16 00:19:49', NULL),
(296, 8, 'MH-29-BE1218', 'seater', 1, 1, NULL, '2019-05-16 00:20:02', '2019-05-16 00:20:02', NULL),
(297, 8, 'MH-29-BE1206', 'seater', 1, 1, 1, '2019-05-16 00:20:16', '2019-08-12 18:04:39', NULL),
(298, 8, 'MH-29-BE1389', 'sleeper', 1, 1, NULL, '2019-05-16 00:20:31', '2019-05-16 00:20:31', NULL),
(299, 8, 'MH-29-BE1394', 'sleeper', 1, 1, NULL, '2019-05-16 00:20:46', '2019-05-16 00:20:46', NULL),
(300, 8, 'MH-29-BE0981', 'seater', 1, 1, NULL, '2019-05-16 00:21:17', '2019-05-16 00:21:17', NULL),
(301, 8, 'MH-29-BE1030', 'seater', 1, 1, NULL, '2019-05-16 00:21:36', '2019-05-16 00:21:36', NULL),
(302, 8, 'MH-29-BE1066', 'seater', 1, 1, NULL, '2019-05-16 00:21:48', '2019-05-16 00:21:48', NULL),
(303, 8, 'MH-29-BE1067', 'seater', 1, 1, NULL, '2019-05-16 00:22:03', '2019-05-16 00:22:03', NULL),
(304, 8, 'MH-29-BE0902', 'seater', 1, 1, NULL, '2019-05-16 00:22:17', '2019-05-16 00:22:17', NULL),
(305, 8, 'MH-29-BE1512', 'sleeper', 1, 1, NULL, '2019-05-16 00:22:32', '2019-05-16 00:22:32', NULL),
(306, 8, 'MH-29-BE1511', 'sleeper', 1, 1, NULL, '2019-05-16 00:22:46', '2019-05-16 00:22:46', NULL),
(307, 8, 'MH-29-BE1259', 'seater', 1, 1, 1, '2019-05-16 00:23:05', '2019-08-12 18:05:58', NULL),
(308, 8, 'MH-29-BE1226', 'sleeper', 1, 1, NULL, '2019-05-16 00:23:23', '2019-05-16 00:23:23', NULL),
(309, 8, 'MH-29-BE1017', 'sleeper', 1, 1, NULL, '2019-05-16 00:23:42', '2019-05-16 00:23:42', NULL),
(310, 8, 'MH-29-BE0958', 'sleeper', 1, 1, NULL, '2019-05-16 00:23:56', '2019-05-16 00:23:56', NULL),
(311, 8, 'MH-29-BE1217', 'sleeper', 1, 1, NULL, '2019-05-16 00:24:09', '2019-05-16 00:24:09', NULL),
(312, 8, 'MH-29-BE0955', 'sleeper', 1, 1, 1, '2019-05-16 00:24:22', '2019-08-12 17:37:11', NULL),
(313, 8, 'MH-29-BE1021', 'sleeper', 1, 1, 1, '2019-05-16 00:24:46', '2019-08-12 17:37:38', NULL),
(314, 8, 'MH-29-BE0807', 'seater', 1, 1, NULL, '2019-05-16 00:25:40', '2019-05-16 00:25:40', NULL),
(315, 8, 'MH-29-BE0875', 'seater', 1, 1, NULL, '2019-05-16 00:25:54', '2019-05-16 00:25:54', NULL),
(316, 8, 'MH-29-BE0804', 'seater', 1, 1, 1, '2019-05-16 00:26:08', '2019-08-12 18:06:22', NULL),
(317, 8, 'MH-29-BE1064', 'seater', 1, 1, NULL, '2019-05-16 00:26:20', '2019-05-16 00:26:20', NULL),
(318, 8, 'MH-29-BE1065', 'seater', 1, 1, NULL, '2019-05-16 00:26:32', '2019-05-16 00:26:32', NULL),
(319, 8, 'MH-29-BE1068', 'seater', 1, 1, NULL, '2019-05-16 00:26:46', '2019-05-16 00:26:46', NULL),
(320, 8, 'MH-29-BE1209', 'seater', 1, 1, NULL, '2019-05-16 00:27:02', '2019-05-16 00:27:02', NULL),
(321, 8, 'MH-29-BE1779', 'sleeper', 1, 1, 1, '2019-05-16 00:27:21', '2019-08-12 18:08:51', NULL),
(322, 8, 'MH-29-BE1584', 'sleeper', 1, 1, 1, '2019-05-16 00:27:38', '2019-08-12 18:07:59', NULL),
(323, 8, 'MH-29-BE0976', 'seater', 1, 1, NULL, '2019-05-16 00:28:14', '2019-05-16 00:28:14', NULL),
(324, 8, 'MH-29-BE0979', 'seater', 1, 1, NULL, '2019-05-16 00:28:34', '2019-05-16 00:28:34', NULL),
(325, 8, 'MH-29-BE0980', 'seater', 1, 1, NULL, '2019-05-16 00:28:48', '2019-05-16 00:28:48', NULL),
(326, 8, 'MH-29-BE0803', 'seater', 1, 1, 1, '2019-05-16 00:29:13', '2019-08-12 18:00:08', NULL),
(327, 8, 'MH-29-BE0873', 'seater', 1, 1, 1, '2019-05-16 00:29:32', '2019-08-12 18:00:25', NULL),
(328, 8, 'MH-29-BE0802', 'seater', 1, 1, NULL, '2019-05-16 00:29:47', '2019-05-16 00:29:47', NULL),
(329, 8, 'MH-29-BE0805', 'seater', 1, 1, NULL, '2019-05-16 00:30:03', '2019-05-16 00:30:03', NULL),
(330, 8, 'MH-29-BE0904', 'seater', 1, 1, NULL, '2019-05-16 00:30:17', '2019-05-16 00:30:17', NULL),
(331, 8, 'MH-29-BE0906', 'seater', 1, 1, NULL, '2019-05-16 00:30:30', '2019-05-16 00:30:30', NULL),
(332, 8, 'MH-29-BE0806', 'seater', 1, 1, NULL, '2019-05-16 00:30:44', '2019-05-16 00:30:44', NULL),
(333, 8, 'MH-29-BE0833', 'seater', 1, 1, NULL, '2019-05-16 00:30:58', '2019-05-16 00:30:58', NULL),
(334, 8, 'MH-29-BE0838', 'seater', 1, 1, NULL, '2019-05-16 00:31:11', '2019-05-16 00:31:11', NULL),
(335, 8, 'MH-29-BE0874', 'seater', 1, 1, NULL, '2019-05-16 00:31:26', '2019-05-16 00:31:26', NULL),
(336, 8, 'MH-29-BE0876', 'seater', 1, 1, NULL, '2019-05-16 00:31:41', '2019-05-16 00:31:41', NULL),
(337, 8, 'MH-29-BE0903', 'seater', 1, 1, NULL, '2019-05-16 00:31:56', '2019-05-16 00:31:56', NULL),
(338, 8, 'MH-29-BE0905', 'seater', 1, 1, NULL, '2019-05-16 00:32:10', '2019-05-16 00:32:10', NULL),
(339, 8, 'MH-29-BE0973', 'seater', 1, 1, NULL, '2019-05-16 00:32:25', '2019-05-16 00:32:25', NULL),
(340, 8, 'MH-29-BE1018', 'sleeper', 1, 1, 1, '2019-05-16 00:32:41', '2019-08-12 18:16:47', NULL),
(341, 8, 'MH-29-BE1022', 'seater', 1, 1, NULL, '2019-05-16 00:32:54', '2019-05-16 00:32:54', NULL),
(342, 8, 'MH-29-BE1335', 'sleeper', 1, 1, NULL, '2019-05-16 00:33:10', '2019-05-16 00:33:10', NULL),
(343, 8, 'MH-29-BE1395', 'sleeper', 1, 1, NULL, '2019-05-16 00:33:25', '2019-05-16 00:33:25', NULL),
(344, 8, 'MH-29-BE0901', 'seater', 1, 1, NULL, '2019-05-16 00:33:54', '2019-05-16 00:33:54', NULL),
(345, 8, 'MH-29-BE0977', 'seater', 1, 1, NULL, '2019-05-16 00:35:09', '2019-05-16 00:35:09', NULL),
(346, 8, 'MH-29-BE0978', 'seater', 1, 1, NULL, '2019-05-16 00:35:27', '2019-05-16 00:35:27', NULL),
(347, 9, 'MH 14 GU 0080', 'seater', 1, 1, 1, '2019-05-18 00:15:54', '2019-09-01 15:15:25', NULL),
(348, 9, 'MH 14 GU 0081', 'seater', 1, 1, NULL, '2019-05-18 00:16:13', '2019-05-18 00:16:13', NULL),
(349, 9, 'MH 14 GU 0238', 'seater', 1, 1, 1, '2019-05-18 00:16:30', '2019-09-01 15:16:15', NULL),
(350, 9, 'MH 14 GU 0239', 'seater', 1, 1, 1, '2019-05-18 00:16:46', '2019-09-01 15:16:32', NULL),
(351, 9, 'MH 14 GU 0634', 'seater', 1, 1, NULL, '2019-05-18 00:17:07', '2019-05-18 00:17:07', NULL),
(352, 9, 'MH 14 GU 0359', 'seater', 1, 1, 1, '2019-05-18 00:17:23', '2019-11-02 12:37:56', NULL),
(353, 9, 'MH 14 GU 0360', 'seater', 1, 1, 1, '2019-05-18 00:17:39', '2019-11-02 12:37:40', NULL),
(354, 9, 'MH 14 GU 0636', 'seater', 1, 1, NULL, '2019-05-18 00:17:56', '2019-05-18 00:17:56', NULL),
(355, 9, 'MH 14 GU 2447', 'seater', 1, 1, NULL, '2019-05-18 00:18:12', '2019-05-18 00:18:12', NULL),
(356, 9, 'MH 14 GU 3108', 'seater', 1, 1, 1, '2019-05-18 00:18:25', '2019-11-02 12:34:27', NULL),
(357, 9, 'MH 14 GU 0076', 'seater', 1, 1, 1, '2019-05-18 00:18:40', '2019-09-01 15:16:55', NULL),
(358, 9, 'MH 14 GU 0242', 'seater', 1, 1, 1, '2019-05-18 00:18:54', '2019-09-01 15:17:18', NULL),
(359, 9, 'MH 14 GU 3104', 'seater', 1, 1, 1, '2019-05-18 00:19:10', '2019-11-02 12:39:28', NULL),
(360, 9, 'MH 14 GU 3103', 'seater', 1, 1, NULL, '2019-05-18 00:19:24', '2019-05-18 00:19:24', NULL),
(361, 9, 'MH 14 GU 0361', 'seater', 1, 1, NULL, '2019-05-18 00:19:48', '2019-05-18 00:19:48', NULL),
(362, 9, 'MH 14 GU 0362', 'seater', 1, 1, NULL, '2019-05-18 00:20:10', '2019-05-18 00:20:10', NULL),
(363, 9, 'MH 14 GU 2073', 'seater', 1, 1, NULL, '2019-05-18 00:20:29', '2019-05-18 00:20:29', NULL),
(364, 9, 'MH 14 GU 0638', 'seater', 1, 1, NULL, '2019-05-18 00:20:40', '2019-05-18 00:20:40', NULL),
(365, 9, 'MH 14 GU 2071', 'seater', 1, 1, NULL, '2019-05-18 00:20:54', '2019-05-18 00:20:54', NULL),
(366, 9, 'MH 14 GD 8445', 'seater', 1, 1, NULL, '2019-05-18 00:21:07', '2019-05-18 00:21:07', NULL),
(367, 9, 'MH 14 GU 0645', 'seater', 1, 1, NULL, '2019-05-18 00:21:19', '2019-05-18 00:21:19', NULL),
(368, 9, 'MH 14 GD 8437', 'seater', 1, 1, NULL, '2019-05-18 00:21:31', '2019-05-18 00:21:31', NULL),
(369, 9, 'MH 14 GU 0705', 'seater', 1, 1, NULL, '2019-05-18 00:21:44', '2019-05-18 00:21:44', NULL),
(370, 9, 'MH 14 GU 0635', 'seater', 1, 1, NULL, '2019-05-18 00:21:58', '2019-05-18 00:21:58', NULL),
(371, 9, 'MH 14 GD 8435', 'seater', 1, 1, NULL, '2019-05-18 00:22:12', '2019-05-18 00:22:12', NULL),
(372, 9, 'MH 14 GD 8436', 'seater', 1, 1, NULL, '2019-05-18 00:22:25', '2019-05-18 00:22:25', NULL),
(373, 9, 'MH 14 GU 2075', 'seater', 1, 1, 1, '2019-05-18 00:22:41', '2019-11-02 12:33:41', NULL),
(374, 9, 'MH 14 GU 2077', 'seater', 1, 1, 1, '2019-05-18 00:22:57', '2019-11-02 12:34:04', NULL),
(375, 9, 'MH 14 GU 0701', 'seater', 1, 1, 1, '2019-05-18 00:23:10', '2019-11-02 12:34:52', NULL),
(376, 9, 'MH 14 GU 0358', 'seater', 1, 1, NULL, '2019-05-18 00:23:27', '2019-05-18 00:23:27', NULL),
(377, 9, 'MH 14 GU 3116', 'seater', 1, 1, NULL, '2019-05-18 00:23:45', '2019-05-18 00:23:45', NULL),
(378, 9, 'MH 14 GU 3187', 'seater', 1, 1, NULL, '2019-05-18 00:23:58', '2019-05-18 00:23:58', NULL),
(379, 9, 'MH 14 GU 0363', 'seater', 1, 1, NULL, '2019-05-18 00:24:13', '2019-05-18 00:24:13', NULL),
(380, 9, 'MH 14 GD 8735', 'seater', 1, 1, NULL, '2019-05-18 00:24:28', '2019-05-18 00:24:28', NULL),
(381, 9, 'MH 14 GU 0642', 'seater', 1, 1, NULL, '2019-05-18 00:24:46', '2019-05-18 00:24:46', NULL),
(382, 9, 'MH 14 GU 2445', 'seater', 1, 1, NULL, '2019-05-18 00:25:01', '2019-05-18 00:25:01', NULL),
(383, 9, 'MH 14 GU 0644', 'seater', 1, 1, NULL, '2019-05-18 00:25:14', '2019-05-18 00:25:14', NULL),
(384, 9, 'MH 14 GU 0698', 'seater', 1, 1, NULL, '2019-05-18 00:25:26', '2019-05-18 00:25:26', NULL),
(385, 9, 'MH 14 GU 2939', 'seater', 1, 1, NULL, '2019-05-18 00:25:38', '2019-05-18 00:25:38', NULL),
(386, 9, 'MH 14 GU 2446', 'seater', 1, 1, NULL, '2019-05-18 00:25:51', '2019-05-18 00:25:51', NULL),
(387, 9, 'MH 14 GU 0643', 'seater', 1, 1, NULL, '2019-05-18 00:26:04', '2019-05-18 00:26:04', NULL),
(388, 9, 'MH 14 GU 2444', 'seater', 1, 1, NULL, '2019-05-18 00:26:23', '2019-05-18 00:26:23', NULL),
(389, 9, 'MH 14 GU 0637', 'seater', 1, 1, NULL, '2019-05-18 00:26:40', '2019-05-18 00:26:40', NULL),
(390, 9, 'MH 14 GU 2672', 'seater', 1, 1, NULL, '2019-05-18 00:26:53', '2019-05-18 00:26:53', NULL),
(391, 9, 'MH 14 GU 2673', 'seater', 1, 1, NULL, '2019-05-18 00:27:17', '2019-05-18 00:27:17', NULL),
(392, 9, 'MH 14 GU 3107', 'seater', 1, 1, NULL, '2019-05-18 00:27:32', '2019-05-18 00:27:32', NULL),
(393, 9, 'MH 14 GU 0640', 'seater', 1, 1, NULL, '2019-05-18 00:27:46', '2019-05-18 00:27:46', NULL),
(394, 9, 'MH 14 GU 2312', 'seater', 1, 1, NULL, '2019-05-18 00:27:59', '2019-05-18 00:27:59', NULL),
(395, 9, 'MH 14 GD 8734', 'seater', 1, 1, NULL, '2019-05-18 00:28:12', '2019-05-18 00:28:12', NULL),
(396, 9, 'MH 14 GU 3105', 'seater', 1, 1, NULL, '2019-05-18 00:30:24', '2019-05-18 00:30:24', NULL),
(397, 9, 'MH 14 GU 3106', 'seater', 1, 1, NULL, '2019-05-18 00:30:38', '2019-05-18 00:30:38', NULL),
(398, 9, 'MH 14 GU 0704', 'seater', 1, 1, NULL, '2019-05-18 00:30:59', '2019-05-18 00:30:59', NULL),
(399, 9, 'MH 14 GU 0886', 'seater', 1, 1, NULL, '2019-05-18 00:31:14', '2019-05-18 00:31:14', NULL),
(400, 9, 'MH 14 GD 8736', 'seater', 1, 1, NULL, '2019-05-18 00:31:26', '2019-05-18 00:31:26', NULL),
(401, 9, 'MH 14 GD 8737', 'seater', 1, 1, NULL, '2019-05-18 00:31:39', '2019-05-18 00:31:39', NULL),
(402, 9, 'MH 14 GU 0240', 'seater', 1, 1, NULL, '2019-05-18 00:31:52', '2019-05-18 00:31:52', NULL),
(403, 9, 'MH 14 GU 0241', 'seater', 1, 1, NULL, '2019-05-18 00:32:08', '2019-05-18 00:32:08', NULL),
(404, 9, 'MH 14 GU 2068', 'seater', 1, 1, NULL, '2019-05-18 00:33:27', '2019-05-18 00:33:27', NULL),
(405, 9, 'MH 14 GU 2448', 'seater', 1, 1, NULL, '2019-05-18 00:33:44', '2019-05-18 00:33:44', NULL),
(406, 9, 'MH 14 GU 2674', 'seater', 1, 1, NULL, '2019-05-18 00:34:02', '2019-05-18 00:34:02', NULL),
(407, 9, 'MH 14 GU 2675', 'seater', 1, 1, NULL, '2019-05-18 00:34:22', '2019-05-18 00:34:22', NULL),
(408, 9, 'MH 14 GU 2898', 'seater', 1, 1, NULL, '2019-05-18 00:34:37', '2019-05-18 00:34:37', NULL),
(409, 9, 'MH 14 GU 2899', 'seater', 1, 1, NULL, '2019-05-18 00:34:51', '2019-05-18 00:34:51', NULL),
(410, 9, 'MH 14 GU 2901', 'seater', 1, 1, NULL, '2019-05-18 00:35:05', '2019-05-18 00:35:05', NULL),
(411, 9, 'MH 14 GU 2066', 'seater', 1, 1, NULL, '2019-05-18 00:35:22', '2019-05-18 00:35:22', NULL),
(412, 9, 'MH 14 GU 2070', 'seater', 1, 1, NULL, '2019-05-18 00:35:35', '2019-05-18 00:35:35', NULL),
(413, 9, 'MH 14 GU 2072', 'seater', 1, 1, NULL, '2019-05-18 00:36:41', '2019-05-18 00:36:41', NULL),
(414, 9, 'MH 14 GU 2074', 'seater', 1, 1, NULL, '2019-05-18 00:36:57', '2019-05-18 00:36:57', NULL),
(415, 9, 'MH 14 GU 2076', 'seater', 1, 1, NULL, '2019-05-18 00:37:12', '2019-05-18 00:37:12', NULL),
(416, 9, 'MH 14 GU 2078', 'seater', 1, 1, NULL, '2019-05-18 00:37:25', '2019-05-18 00:37:25', NULL),
(417, 9, 'MH 14 GU 3293', 'seater', 1, 1, NULL, '2019-05-18 00:37:40', '2019-05-18 00:37:40', NULL),
(418, 9, 'MH 14 GU 3294', 'seater', 1, 1, NULL, '2019-05-18 00:37:57', '2019-05-18 00:37:57', NULL),
(419, 9, 'MH 14 GU 3295', 'seater', 1, 1, 1, '2019-05-18 00:38:11', '2019-11-02 12:39:04', NULL),
(420, 9, 'MH 14 GU 3296', 'seater', 1, 1, NULL, '2019-05-18 00:38:24', '2019-05-18 00:38:24', NULL),
(421, 9, 'MH 14 GU 3297', 'seater', 1, 1, NULL, '2019-05-18 00:38:37', '2019-05-18 00:38:37', NULL),
(422, 9, 'MH 14 GU 3109', 'seater', 1, 1, NULL, '2019-05-18 00:39:01', '2019-05-18 00:39:01', NULL),
(423, 9, 'MH 14 GU 3110', 'seater', 1, 1, NULL, '2019-05-18 00:39:16', '2019-05-18 00:39:16', NULL),
(424, 9, 'MH 14 GU 3114', 'seater', 1, 1, NULL, '2019-05-18 00:39:30', '2019-05-18 00:39:30', NULL),
(425, 9, 'MH 14 GU 2069', 'seater', 1, 1, NULL, '2019-05-18 00:39:48', '2019-05-18 00:39:48', NULL),
(426, 9, 'MH 14 GU 0706', 'seater', 1, 1, NULL, '2019-05-18 00:40:09', '2019-05-18 00:40:09', NULL),
(427, 9, 'MH 14 GD 9614', 'seater', 1, 1, 1, '2019-05-18 00:40:26', '2019-07-28 16:28:13', NULL),
(428, 9, 'MH 14 GD 9615', 'seater', 1, 1, 1, '2019-05-18 00:40:40', '2019-07-28 16:28:26', NULL),
(429, 9, 'MH 14 GU 3188', 'seater', 1, 1, NULL, '2019-05-18 00:40:57', '2019-05-18 00:40:57', NULL),
(430, 9, 'MH 14 GU 3190', 'seater', 1, 1, NULL, '2019-05-18 00:41:11', '2019-05-18 00:41:11', NULL),
(431, 9, 'MH 14 GU 3191', 'seater', 1, 1, NULL, '2019-05-18 00:41:23', '2019-05-18 00:41:23', NULL),
(432, 9, 'MH 14 GU 3192', 'seater', 1, 1, NULL, '2019-05-18 00:41:35', '2019-05-18 00:41:35', NULL),
(433, 9, 'MH 14 GU 2938', 'seater', 1, 1, NULL, '2019-05-18 00:41:50', '2019-05-18 00:41:50', NULL),
(434, 9, 'MH 14 GD 9619', 'seater', 1, 1, 1, '2019-05-18 00:42:05', '2019-11-02 12:36:28', NULL),
(435, 9, 'MH 14 GU 3405', 'seater', 1, 1, NULL, '2019-05-18 00:42:26', '2019-05-18 00:42:26', NULL),
(436, 9, 'MH 14 GU 3406', 'seater', 1, 1, NULL, '2019-05-18 00:42:41', '2019-05-18 00:42:41', NULL),
(437, 9, 'MH 14 GU 3407', 'seater', 1, 1, NULL, '2019-05-18 00:42:55', '2019-05-18 00:42:55', NULL),
(438, 9, 'MH 14 GD 9620', 'seater', 1, 1, NULL, '2019-05-18 00:43:09', '2019-05-18 00:43:09', NULL),
(439, 9, 'MH 14 GD 8441', 'seater', 1, 1, NULL, '2019-05-18 00:43:23', '2019-05-18 00:43:23', NULL),
(440, 9, 'MH 14 GD 6090', 'seater', 1, 1, NULL, '2019-05-18 00:43:40', '2019-05-18 00:43:40', NULL),
(441, 9, 'MH 14 GD 8443', 'seater', 1, 1, NULL, '2019-05-18 00:43:53', '2019-05-18 00:43:53', NULL),
(442, 9, 'MH 14 GD 8446', 'seater', 1, 1, NULL, '2019-05-18 00:44:08', '2019-05-18 00:44:08', NULL),
(443, 9, 'MH 14 GU 2986', 'seater', 1, 1, NULL, '2019-05-18 00:44:30', '2019-05-18 00:44:30', NULL),
(444, 9, 'MH 14 GD 8738', 'seater', 1, 1, NULL, '2019-05-18 00:44:44', '2019-05-18 00:44:44', NULL),
(445, 9, 'MH 14 GU 0078', 'seater', 1, 1, NULL, '2019-05-18 00:45:01', '2019-05-18 00:45:01', NULL),
(446, 9, 'MH 14 GU 0079', 'seater', 1, 1, NULL, '2019-05-18 00:45:17', '2019-05-18 00:45:17', NULL),
(447, 10, 'MH 14 GU 2460', 'seater', 1, 1, NULL, '2019-05-18 01:30:56', '2019-05-18 01:30:56', NULL),
(448, 10, 'MH 14 GU 2467', 'seater', 1, 1, NULL, '2019-05-18 01:31:12', '2019-05-18 01:31:12', NULL),
(449, 10, 'MH 14GU 1376', 'seater', 1, 1, NULL, '2019-05-18 01:31:39', '2019-05-18 01:31:39', NULL),
(450, 10, 'MH 14 GU 3218', 'seater', 1, 1, NULL, '2019-05-18 01:31:53', '2019-05-18 01:31:53', NULL),
(451, 10, 'MH 14 GU 0223', 'seater', 1, 1, NULL, '2019-05-18 01:32:09', '2019-05-18 01:32:09', NULL),
(452, 10, 'MH 14GU 3145', 'seater', 1, 1, NULL, '2019-05-18 01:32:25', '2019-05-18 01:32:25', NULL),
(453, 10, 'MH 14 GU 3147', 'seater', 1, 1, NULL, '2019-05-18 01:32:36', '2019-05-18 01:32:36', NULL),
(454, 10, 'MH 14 GU 3146', 'seater', 1, 1, NULL, '2019-05-18 01:32:50', '2019-05-18 01:32:50', NULL),
(455, 10, 'MH 14 GU 0224', 'seater', 1, 1, NULL, '2019-05-18 01:33:05', '2019-05-18 01:33:05', NULL),
(456, 10, 'MH 14 GU 0225', 'seater', 1, 1, NULL, '2019-05-18 01:33:17', '2019-05-18 01:33:17', NULL),
(457, 10, 'MH 14 GU 2237', 'seater', 1, 1, NULL, '2019-05-18 01:33:34', '2019-05-18 01:33:34', NULL),
(458, 10, 'MH 14 GU 1371', 'seater', 1, 1, NULL, '2019-05-18 01:33:48', '2019-05-18 01:33:48', NULL),
(459, 10, 'MH 14 GU 1373', 'seater', 1, 1, NULL, '2019-05-18 01:34:02', '2019-05-18 01:34:02', NULL),
(460, 10, 'MH 14 GU 1374', 'seater', 1, 1, NULL, '2019-05-18 01:34:18', '2019-05-18 01:34:18', NULL),
(461, 10, 'MH 14 GU 1375', 'seater', 1, 1, NULL, '2019-05-18 01:34:36', '2019-05-18 01:34:36', NULL),
(462, 10, 'MH 14 GU 1378', 'seater', 1, 1, NULL, '2019-05-18 01:34:52', '2019-05-18 01:34:52', NULL),
(463, 10, 'MH 14 GU 0739', 'seater', 1, 1, NULL, '2019-05-18 01:35:06', '2019-05-18 01:35:06', NULL),
(464, 10, 'MH 14 GU 0738', 'seater', 1, 1, NULL, '2019-05-18 01:35:23', '2019-05-18 01:35:23', NULL),
(465, 10, 'MH 14 GU 1956', 'seater', 1, 1, NULL, '2019-05-18 01:35:42', '2019-05-18 01:35:42', NULL),
(466, 10, 'MH 14 GU 4340', 'seater', 1, 1, NULL, '2019-05-18 01:35:57', '2019-05-18 01:35:57', NULL),
(467, 10, 'MH 14 GU 4392', 'seater', 1, 1, NULL, '2019-05-18 01:36:13', '2019-05-18 01:36:13', NULL),
(468, 10, 'MH 14 GU 0593', 'seater', 1, 1, NULL, '2019-05-18 01:36:26', '2019-05-18 01:36:26', NULL),
(469, 10, 'MH 14 GU 4336', 'seater', 1, 1, NULL, '2019-05-18 01:36:41', '2019-05-18 01:36:41', NULL),
(470, 10, 'MH 14 GU 0227', 'seater', 1, 1, NULL, '2019-05-18 01:37:02', '2019-05-18 01:37:02', NULL),
(471, 10, 'MH 14 GU 4337', 'seater', 1, 1, NULL, '2019-05-18 01:37:16', '2019-05-18 01:37:16', NULL),
(472, 10, 'MH 14 GU 1954', 'seater', 1, 1, NULL, '2019-05-18 01:37:28', '2019-05-18 01:37:28', NULL),
(473, 10, 'MH 14 GU 2461', 'seater', 1, 1, NULL, '2019-05-18 01:37:42', '2019-05-18 01:37:42', NULL),
(474, 10, 'MH 14 GU 1952', 'seater', 1, 1, NULL, '2019-05-18 01:37:58', '2019-05-18 01:37:58', NULL),
(475, 10, 'MH 14 GU 2234', 'seater', 1, 1, NULL, '2019-05-18 01:38:10', '2019-05-18 01:38:10', NULL),
(476, 10, 'MH 14 GU 2466', 'seater', 1, 1, NULL, '2019-05-18 01:38:28', '2019-05-18 01:38:28', NULL),
(477, 10, 'MH 14 GU 2465', 'seater', 1, 1, NULL, '2019-05-18 01:38:42', '2019-05-18 01:38:42', NULL),
(478, 10, 'MH 14 GU 2231', 'seater', 1, 1, NULL, '2019-05-18 01:38:54', '2019-05-18 01:38:54', NULL),
(479, 10, 'MH 14 GU 0588', 'seater', 1, 1, NULL, '2019-05-18 01:39:10', '2019-05-18 01:39:10', NULL),
(480, 10, 'MH 14 GU 0591', 'seater', 1, 1, NULL, '2019-05-18 01:39:24', '2019-05-18 01:39:24', NULL),
(481, 10, 'MH 14 GU 0592', 'seater', 1, 1, NULL, '2019-05-18 01:39:38', '2019-05-18 01:39:38', NULL),
(482, 10, 'MH 14 GU 2459', 'seater', 1, 1, NULL, '2019-05-18 01:39:59', '2019-05-18 01:39:59', NULL),
(483, 8, 'MH29BE1779', 'sleeper', 0, 1, NULL, '2019-05-27 12:39:19', '2019-08-12 18:08:59', NULL),
(484, 8, 'MH29BE1584', 'sleeper', 0, 1, NULL, '2019-05-27 12:39:54', '2019-08-12 18:08:12', NULL),
(485, 5, 'MH 47 Y 0016', 'seater', 1, 1, 1, '2019-06-19 13:48:10', '2019-06-19 13:50:18', NULL),
(486, 5, 'MH 47 Y 2464', 'seater', 1, 1, NULL, '2019-06-19 14:58:12', '2019-06-19 14:58:12', NULL),
(487, 2, 'MH03 CP 4414', 'seater', 1, 1, NULL, '2019-07-31 18:10:56', '2019-07-31 18:10:56', NULL),
(488, 6, 'MH04 JK0752', 'seater', 1, 1, NULL, '2019-08-13 23:52:02', '2019-08-13 23:52:02', NULL),
(489, 6, 'MH04 JK0753', 'seater', 1, 1, NULL, '2019-08-13 23:52:55', '2019-08-13 23:52:55', NULL),
(490, 6, 'MH04 JK0754', 'seater', 1, 1, NULL, '2019-08-13 23:53:38', '2019-08-13 23:53:38', NULL),
(491, 7, 'MH18 BG1483', 'seater', 1, 1, NULL, '2019-08-15 22:46:38', '2019-08-15 22:46:38', NULL),
(492, 7, 'MH18 BG2284', 'seater', 1, 1, NULL, '2019-08-15 22:47:09', '2019-08-15 22:47:09', NULL),
(493, 7, 'MH18 BG1150', 'seater', 1, 1, NULL, '2019-08-15 22:47:41', '2019-08-15 22:47:41', NULL),
(494, 7, 'MH18 BG1181', 'seater', 1, 1, NULL, '2019-08-15 22:48:03', '2019-08-15 22:48:03', NULL),
(495, 7, 'MH18 BG1208', 'seater', 1, 1, NULL, '2019-08-15 22:48:26', '2019-08-15 22:48:26', NULL),
(496, 7, 'MH18 BG1319', 'seater', 1, 1, NULL, '2019-08-15 22:48:54', '2019-08-15 22:48:54', NULL),
(497, 7, 'MH18 BG1367', 'seater', 1, 1, NULL, '2019-08-15 22:49:19', '2019-08-15 22:49:19', NULL),
(498, 7, 'MH18 BG3014', 'seater', 1, 1, NULL, '2019-08-15 22:50:02', '2019-08-15 22:50:02', NULL),
(499, 9, 'MH 14 GD 8440', 'seater', 1, 1, NULL, '2019-08-15 23:03:41', '2019-08-15 23:03:41', NULL),
(500, 6, 'MH 04 JK 0191', 'seater', 1, 1, NULL, '2019-08-20 22:47:18', '2019-08-20 22:47:18', NULL),
(501, 6, 'MH 04 JK 1269', 'seater', 1, 1, NULL, '2019-08-20 22:48:02', '2019-08-20 22:48:02', NULL),
(502, 7, 'MH18 BG2735', 'seater', 1, 1, NULL, '2019-09-02 13:48:39', '2019-09-02 13:48:39', NULL),
(503, 7, 'MH18 BG1257', 'seater', 1, 1, NULL, '2019-09-02 13:50:49', '2019-09-02 13:50:49', NULL),
(504, 7, 'MH18 BG2733', 'seater', 1, 1, NULL, '2019-09-02 13:51:34', '2019-09-02 13:51:34', NULL),
(505, 7, 'MH18 BG1487', 'seater', 1, 1, NULL, '2019-09-02 13:52:12', '2019-09-02 13:52:12', NULL),
(506, 7, 'MH18 BG1744', 'seater', 1, 1, NULL, '2019-09-02 13:52:51', '2019-09-02 13:52:51', NULL),
(507, 7, 'MH18 BG2734', 'seater', 1, 1, NULL, '2019-09-02 13:53:28', '2019-09-02 13:53:28', NULL),
(508, 7, 'MH18 BG2739', 'seater', 1, 1, NULL, '2019-09-02 13:54:07', '2019-09-02 13:54:07', NULL),
(509, 7, 'MH18 BG3358', 'seater', 1, 1, NULL, '2019-09-02 13:54:56', '2019-09-02 13:54:56', NULL),
(510, 7, 'MH18 BG1346', 'seater', 1, 1, NULL, '2019-09-08 13:46:24', '2019-09-08 13:46:24', NULL),
(511, 7, 'MH18 BG1432', 'seater', 1, 1, NULL, '2019-09-08 13:46:55', '2019-09-08 13:46:55', NULL);
INSERT INTO `vehicles` (`id`, `vendor_id`, `vehicle_no`, `bus_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(512, 7, 'MH18 BG1433', 'seater', 1, 1, NULL, '2019-09-08 13:47:17', '2019-09-08 13:47:17', NULL),
(513, 7, 'MH18 BG1436', 'seater', 1, 1, NULL, '2019-09-08 13:47:44', '2019-09-08 13:47:44', NULL),
(514, 7, 'MH18 BG1478', 'seater', 1, 1, NULL, '2019-09-08 13:48:10', '2019-09-08 13:48:10', NULL),
(515, 7, 'MH18 BG1508', 'seater', 1, 1, NULL, '2019-09-08 13:48:35', '2019-09-08 13:48:35', NULL),
(516, 7, 'MH18 BG1509', 'seater', 1, 1, NULL, '2019-09-08 13:49:48', '2019-09-08 13:49:48', NULL),
(517, 7, 'MH18 BG1531', 'seater', 1, 1, NULL, '2019-09-08 13:50:15', '2019-09-08 13:50:15', NULL),
(518, 7, 'MH18 BG1532', 'seater', 1, 1, NULL, '2019-09-08 13:50:42', '2019-09-08 13:50:42', NULL),
(519, 7, 'MH18 BG1235', 'seater', 1, 1, NULL, '2019-09-08 13:51:08', '2019-09-08 13:51:08', NULL),
(520, 8, 'MH49 AT4170', 'sleeper', 1, 1, 1, '2019-09-20 16:39:33', '2019-10-13 15:38:02', NULL),
(521, 8, 'MH29 BE2072', 'seater', 1, 1, NULL, '2019-09-30 18:39:56', '2019-09-30 18:39:56', NULL),
(522, 8, 'MH29 BE2073', 'seater', 1, 1, NULL, '2019-09-30 18:40:34', '2019-09-30 18:40:34', NULL),
(523, 8, 'MH49 AT4171', 'sleeper', 1, 1, NULL, '2019-10-13 15:42:27', '2019-10-13 15:42:27', NULL),
(524, 7, 'MH18 BG870', 'seater', 1, 1, NULL, '2019-10-16 16:59:43', '2019-10-16 16:59:43', NULL),
(525, 7, 'MH18 BG872', 'seater', 1, 1, NULL, '2019-10-16 17:00:10', '2019-10-16 17:00:10', NULL),
(526, 9, 'MH14 GU2940', 'seater', 1, 1, NULL, '2019-11-02 12:35:31', '2019-11-02 12:35:31', NULL),
(527, 9, 'MH14 GU703', 'seater', 1, 1, NULL, '2019-11-02 12:35:59', '2019-11-02 12:35:59', NULL),
(528, 9, 'MH14 GD8739', 'seater', 1, 1, NULL, '2019-11-02 12:37:16', '2019-11-02 12:37:16', NULL),
(529, 6, 'MH04 JK8749', 'seater', 1, 1, NULL, '2019-11-02 12:43:02', '2019-11-02 12:43:02', NULL),
(530, 1, '12368', 'sleeper', 0, 2, 2, '2019-11-15 07:22:55', '2019-11-15 11:01:37', NULL),
(531, 2, '987654', 'seater', 1, 2, NULL, '2019-11-15 11:02:00', '2019-11-15 11:02:00', NULL),
(532, 3, 'No Bus(Sai)', 'seater', 1, 1, 1, '2019-12-04 01:45:27', '2019-12-06 22:51:42', NULL),
(533, 2, 'No Bus(Aaron)', 'seater', 1, 1, NULL, '2019-12-06 22:51:01', '2019-12-06 22:51:01', NULL),
(534, 1, 'No Bus(RN)', 'seater', 1, 1, NULL, '2019-12-06 22:51:28', '2019-12-06 22:51:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendorinvoices`
--

CREATE TABLE `vendorinvoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `route_id` int(11) UNSIGNED NOT NULL,
  `division_id` int(11) DEFAULT NULL,
  `depot_id` int(10) UNSIGNED DEFAULT NULL,
  `billing_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(10) UNSIGNED DEFAULT NULL,
  `invoice_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vehicle_id` longtext COLLATE utf8mb4_unicode_ci,
  `date` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_complete` longtext COLLATE utf8mb4_unicode_ci,
  `diesel_ltr` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `diese_per_ltr_price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adblue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adblue_price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `breaddown_charge` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vor_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parking_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hault_tax` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `wash_exp` longtext COLLATE utf8mb4_unicode_ci,
  `other_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_km` float(10,2) NOT NULL,
  `diesel_as_per_gov` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_filled_diesel` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra_diesel_charged` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_amount` double DEFAULT NULL,
  `total_charge` double DEFAULT NULL,
  `grand_amount` float(10,2) DEFAULT NULL,
  `remarks` longtext COLLATE utf8mb4_unicode_ci,
  `publish_flag` tinyint(1) DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `update_status` tinyint(1) NOT NULL DEFAULT '0',
  `update_status_division` tinyint(1) NOT NULL DEFAULT '0',
  `idling_minutes` longtext COLLATE utf8mb4_unicode_ci,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendorinvoices`
--

INSERT INTO `vendorinvoices` (`id`, `route_id`, `division_id`, `depot_id`, `billing_period`, `vendor_id`, `invoice_no`, `vehicle_id`, `date`, `kms`, `schedule_complete`, `diesel_ltr`, `diese_per_ltr_price`, `adblue`, `adblue_price`, `breaddown_charge`, `vor_exp`, `parking_exp`, `hault_tax`, `wash_exp`, `other_exp`, `total_km`, `diesel_as_per_gov`, `extra_filled_diesel`, `extra_diesel_charged`, `total_amount`, `total_charge`, `grand_amount`, `remarks`, `publish_flag`, `is_approved`, `update_status`, `update_status_division`, `idling_minutes`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 60, 15, 29, '2019-11-01,2019-11-15', 2, 'VTest1', '22*++*22*++*26*++*22*++*24*++*25*++*23*++*24*++*24*++*36*++*36*++*41*++*22*++*26*++*24', '2019-11-01,2019-11-02,2019-11-03,2019-11-04,2019-11-05,2019-11-06,2019-11-07,2019-11-08,2019-11-09,2019-11-10,2019-11-11,2019-11-12,2019-11-13,2019-11-14,2019-11-15', '539,539,539,539,539,539,539,539,539,539,539,539,539,539,539', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '140,140,140,140,140,140,140,140,140,140,140,140,140,140,140', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '118,118,0,118,118,118,118,118,118,118,118,118,118,0,0', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 8085.00, '1880.23', '219.77', '13032.36', 128551.5, 14448.36, 114103.14, '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 1, 0, 0, 1, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 6, NULL, '2019-12-12 22:51:03', '2019-12-12 22:51:03', NULL),
(2, 61, 15, 29, '2019-11-01,2019-11-15', 2, 'VTest3', '22*++*22*++*22*++*26*++*24*++*24*++*24*++*25*++*24*++*23*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle*++*noVehicle', '2019-11-01,2019-11-02,2019-11-03,2019-11-04,2019-11-05,2019-11-06,2019-11-07,2019-11-08,2019-11-09,2019-11-10,2019-11-11,2019-11-12,2019-11-13,2019-11-14,2019-11-15', '539,539,539,539,539,539,539,539,539,539,0,0,0,0,0', '*++**++**++**++**++**++**++**++**++**++*1*++*1*++*1*++*1*++*1', '140,140,140,140,140,140,140,140,140,140,0,0,0,0,0', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '118,118,118,118,118,118,118,118,118,118,0,0,0,0,0', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 5390.00, '1253.49', '146.51', '8688.04', 97666.8, 9868.04, 87798.76, '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 1, 1, 0, 0, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 6, NULL, '2019-12-12 22:54:59', '2019-12-16 10:59:44', NULL),
(3, 62, 15, 29, '2019-11-01,2019-11-15', 2, 'VTest5', '22*++*23*++*22*++*26*++*23*++*23*++*23*++*23*++*22*++*26*++*23*++*23*++*23*++*22*++*27', '2019-11-01,2019-11-02,2019-11-03,2019-11-04,2019-11-05,2019-11-06,2019-11-07,2019-11-08,2019-11-09,2019-11-10,2019-11-11,2019-11-12,2019-11-13,2019-11-14,2019-11-15', '539,539,539,539,539,539,539,539,539,539,539,539,539,539,539', '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', '140,140,140,140,140,140,140,140,140,140,140,140,140,140,140', '59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3,59.3', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '118,118,118,118,118,118,118,0,118,118,118,118,0,0,0', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', 8085.00, '1880.23', '219.77', '13032.36', 128551.5, 14330.36, 114221.14, '*++**++**++**++**++**++**++**++**++**++**++**++**++**++*', 1, 1, 0, 1, '0,0,0,0,0,0,0,0,0,0,0,0,0,0,0', 6, NULL, '2019-12-12 22:57:16', '2019-12-16 10:08:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendors`
--

CREATE TABLE `vendors` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gst_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active_status` int(11) NOT NULL DEFAULT '1' COMMENT '0 for inactive 1 for active',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `user_id`, `address`, `pan_no`, `gst_no`, `bank_name`, `account_no`, `ifsc_code`, `active_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'R N Cabs Pvt. Ltd.', 1, 'Unit 402-405, 4th Floor, G Wing, Kailas Industrial Complex, Building no.2,\r\nS.S. Marg, Park Site, Vikhroli West, Mumbai - 400 079', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-02 15:48:16', '2019-01-02 15:48:16', NULL),
(2, 'Aaron Tours Pvt. Ltd.', 1, 'Shop no.4, Gayatrikrupa Estate, Opp. H.P. Petrol Pump, L.B.S. Marg, Vikhroli West, Mumbai - 400 079', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-02 15:50:10', '2019-01-02 15:50:10', NULL),
(3, 'Sai Travels', 2, '28 1/C, Opp Paman Apartment, Road no.4, Pestom Sagar, Chembur, Mumbai - 400 089', NULL, NULL, NULL, NULL, NULL, 0, '2019-01-02 15:51:23', '2019-11-13 10:24:58', NULL),
(4, 'Pais Auto Pvt. Ltd.', 1, '101, Shubham Heights, Near J.K. Regency Hotel / W.E. Highway, Old Nagardas Road, Andheri East, Mumbai - 400 069', NULL, NULL, NULL, NULL, NULL, 1, '2019-01-02 15:53:13', '2019-01-02 15:53:13', NULL),
(5, 'Bhagirathi Trans Corpo Pvt. Ltd.', 1, 'Unit no-2, Esspee Tower, Rajendra Nagar, Dattapada Road,Borivali (E), Mumbai – 400 066.', NULL, NULL, NULL, NULL, NULL, 1, '2019-04-29 18:50:06', '2019-04-29 18:50:06', NULL),
(6, 'Arham Transportation Pvt. Ltd.', 1, '105, URMIKUNJ COMPLEX, GORDHANWADI CROSS ROAD, KANKARIA, AHMEDABAD, GUJARAT - 380022', NULL, NULL, NULL, NULL, NULL, 1, '2019-05-15 22:10:12', '2019-05-15 22:10:12', NULL),
(7, 'Bafna Brothers', 1, '1489, Parola Road, Dhule - 424001', NULL, NULL, NULL, NULL, NULL, 1, '2019-05-15 23:51:45', '2019-05-15 23:51:45', NULL),
(8, 'Jai Agency', 1, 'TOWER NO 1, FLAT NO-1905 CAPITAL HEIGHTS, MEDICAL SQ, NAGPUR-440003', NULL, NULL, NULL, NULL, NULL, 1, '2019-05-16 00:01:29', '2019-05-16 00:01:43', NULL),
(9, 'Prasanna Purple Mobility Solutions Pvt. Ltd.', 1, '396, Shaniwar Peth, Near Ahilyadevi High School, Pune - 411030. Maharashtra , India.', NULL, NULL, NULL, NULL, NULL, 1, '2019-05-18 00:11:23', '2019-05-18 00:11:23', NULL),
(10, 'SKS Luxure Travel Pvt.Ltd.', 2, 'Corporate Office:201/201A,Prestige Plaza- II, Mumbai - Pune Road, Akurdi, Pune - 411035.', NULL, NULL, NULL, NULL, NULL, 0, '2019-05-18 01:28:59', '2019-11-13 10:24:45', NULL),
(11, 'tester vendor fgfgfgf', 2, 'tester address', NULL, NULL, NULL, NULL, NULL, 1, '2019-11-13 05:59:25', '2019-11-13 09:24:13', NULL),
(12, 'testing', 2, 'dsdf', NULL, NULL, NULL, NULL, NULL, 0, '2019-11-13 08:01:07', '2019-11-13 09:38:50', NULL),
(13, 'sdfdf dfgvgfgfg', 2, 'dfdf', NULL, NULL, NULL, NULL, NULL, 0, '2019-11-13 10:38:15', '2019-11-13 10:39:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_accountants`
--

CREATE TABLE `vendor_accountants` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_accountants`
--

INSERT INTO `vendor_accountants` (`id`, `vendor_id`, `user_id`) VALUES
(1, 1, 4),
(2, 2, 6),
(3, 3, 8),
(4, 4, 10),
(5, 6, 210),
(6, 6, 211),
(7, 6, 212),
(8, 8, 214),
(9, 9, 216),
(10, 9, 217),
(11, 9, 218),
(12, 10, 220),
(13, 10, 221),
(14, 10, 222),
(15, 5, 341),
(16, 8, 389),
(17, 12, 398);

-- --------------------------------------------------------

--
-- Table structure for table `vendor_managers`
--

CREATE TABLE `vendor_managers` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendor_managers`
--

INSERT INTO `vendor_managers` (`id`, `vendor_id`, `user_id`) VALUES
(1, 1, 3),
(2, 2, 5),
(3, 3, 7),
(4, 4, 9),
(5, 5, 156),
(6, 6, 209),
(7, 8, 213),
(8, 9, 215),
(9, 10, 219),
(10, 12, 397);

-- --------------------------------------------------------

--
-- Table structure for table `vmapprove`
--

CREATE TABLE `vmapprove` (
  `id` int(11) UNSIGNED NOT NULL,
  `approve` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vmapprove`
--

INSERT INTO `vmapprove` (`id`, `approve`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, '2018-12-26 20:11:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accesstypes`
--
ALTER TABLE `accesstypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `allowusers`
--
ALTER TABLE `allowusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allowusers_usertype_id_foreign` (`usertype_id`),
  ADD KEY `allowusers_accesstype_id_foreign` (`accesstype_id`);

--
-- Indexes for table `billsummaries`
--
ALTER TABLE `billsummaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `billsummaries_parisishtha_a_id_foreign` (`parisishtha_a_id`),
  ADD KEY `billsummaries_vendorinvoice_id_foreign` (`vendorinvoice_id`);

--
-- Indexes for table `billsummary_confirm`
--
ALTER TABLE `billsummary_confirm`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billsummary_log`
--
ALTER TABLE `billsummary_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `billsummary_view`
--
ALTER TABLE `billsummary_view`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `charges`
--
ALTER TABLE `charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `city_masters`
--
ALTER TABLE `city_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companydetails`
--
ALTER TABLE `companydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `depots`
--
ALTER TABLE `depots`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisions`
--
ALTER TABLE `divisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module_hierarchies`
--
ALTER TABLE `module_hierarchies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_hierarchies_module_id_foreign` (`module_id`),
  ADD KEY `module_hierarchies_usertype_id_foreign` (`usertype_id`);

--
-- Indexes for table `parisishtha_as`
--
ALTER TABLE `parisishtha_as`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parisishtha_as_depot_id_foreign` (`depot_id`),
  ADD KEY `parisishtha_as_vendor_id_foreign` (`vendor_id`),
  ADD KEY `parisishtha_as_vendorinvoice_id_foreign` (`vendorinvoice_id`),
  ADD KEY `parisishtha_as_parisishtha_b_id_foreign` (`parisishtha_b_id`);

--
-- Indexes for table `parisishtha_as_log`
--
ALTER TABLE `parisishtha_as_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parisishtha_bs`
--
ALTER TABLE `parisishtha_bs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parisishtha_bs_vendor_id_foreign` (`vendor_id`),
  ADD KEY `parisishtha_bs_vendorinvoice_id_foreign` (`vendorinvoice_id`);

--
-- Indexes for table `parisishtha_bs_log`
--
ALTER TABLE `parisishtha_bs_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_module_id_foreign` (`module_id`),
  ADD KEY `permissions_usertype_id_foreign` (`usertype_id`);

--
-- Indexes for table `rate_masters`
--
ALTER TABLE `rate_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_masters`
--
ALTER TABLE `route_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_division_id_foreign` (`division_id`),
  ADD KEY `users_depot_id_foreign` (`depot_id`),
  ADD KEY `users_usertype_id_foreign` (`usertype_id`),
  ADD KEY `users_accesstype_id_foreign` (`accesstype_id`);

--
-- Indexes for table `usertypes`
--
ALTER TABLE `usertypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master_logs`
--
ALTER TABLE `user_master_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendorinvoices`
--
ALTER TABLE `vendorinvoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parisishtha_bs_depot_id_foreign` (`depot_id`),
  ADD KEY `parisishtha_bs_vendor_id_foreign` (`vendor_id`),
  ADD KEY `parisishtha_bs_vendorinvoice_id_foreign` (`invoice_no`(250));

--
-- Indexes for table `vendors`
--
ALTER TABLE `vendors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_accountants`
--
ALTER TABLE `vendor_accountants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_accountants_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendor_accountants_user_id_foreign` (`user_id`);

--
-- Indexes for table `vendor_managers`
--
ALTER TABLE `vendor_managers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendor_managers_vendor_id_foreign` (`vendor_id`) USING BTREE,
  ADD KEY `vendor_managers_user_id_foreign` (`user_id`) USING BTREE;

--
-- Indexes for table `vmapprove`
--
ALTER TABLE `vmapprove`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accesstypes`
--
ALTER TABLE `accesstypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `allowusers`
--
ALTER TABLE `allowusers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `billsummaries`
--
ALTER TABLE `billsummaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `billsummary_confirm`
--
ALTER TABLE `billsummary_confirm`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `billsummary_log`
--
ALTER TABLE `billsummary_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `billsummary_view`
--
ALTER TABLE `billsummary_view`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `charges`
--
ALTER TABLE `charges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `city_masters`
--
ALTER TABLE `city_masters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companydetails`
--
ALTER TABLE `companydetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `depots`
--
ALTER TABLE `depots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `module_hierarchies`
--
ALTER TABLE `module_hierarchies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `parisishtha_as`
--
ALTER TABLE `parisishtha_as`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parisishtha_as_log`
--
ALTER TABLE `parisishtha_as_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parisishtha_bs`
--
ALTER TABLE `parisishtha_bs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `parisishtha_bs_log`
--
ALTER TABLE `parisishtha_bs_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `rate_masters`
--
ALTER TABLE `rate_masters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `route_masters`
--
ALTER TABLE `route_masters`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=394;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=400;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `user_master_logs`
--
ALTER TABLE `user_master_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=535;

--
-- AUTO_INCREMENT for table `vendorinvoices`
--
ALTER TABLE `vendorinvoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `vendor_accountants`
--
ALTER TABLE `vendor_accountants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vendor_managers`
--
ALTER TABLE `vendor_managers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `vmapprove`
--
ALTER TABLE `vmapprove`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
