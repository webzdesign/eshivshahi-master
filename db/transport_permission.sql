-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2018 at 05:51 PM
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
-- Database: `transport_permission`
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
(24, 'Division', NULL, NULL, '2018-08-31 12:50:54', '2018-09-12 09:16:59', NULL),
(23, 'Depot', NULL, NULL, '2018-08-31 12:50:28', '2018-08-31 12:50:28', NULL);

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
(1, 2, 1, 1, 0, NULL, '2018-09-10 16:46:40', '2018-09-10 16:46:40', NULL),
(2, 3, 1, 3, 0, NULL, '2018-09-10 16:46:53', '2018-09-10 16:46:53', NULL),
(3, 8, 23, 1, 0, NULL, '2018-09-10 16:47:13', '2018-09-10 16:47:13', NULL),
(4, 9, 23, 1, 0, NULL, '2018-09-10 16:47:49', '2018-09-10 16:47:49', NULL),
(5, 7, 23, 1, 0, NULL, '2018-09-10 16:48:05', '2018-09-10 16:48:05', NULL),
(6, 6, 23, 1, 0, NULL, '2018-09-10 16:48:20', '2018-09-10 16:48:20', NULL),
(7, 5, 24, 1, 0, NULL, '2018-09-10 16:48:47', '2018-09-10 16:48:47', NULL),
(8, 4, 24, 1, 0, NULL, '2018-09-10 16:49:02', '2018-09-10 16:49:02', NULL),
(9, 10, 24, 1, 0, NULL, '2018-09-10 16:49:25', '2018-09-10 16:49:25', NULL),
(11, 36, 23, 2, 0, 0, NULL, '2018-09-12 09:57:10', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `billsummaries`
--

CREATE TABLE `billsummaries` (
  `id` int(10) UNSIGNED NOT NULL,
  `parisishtha_a_id` int(10) UNSIGNED NOT NULL,
  `gov_voucher_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `vendorinvoice_id` int(10) UNSIGNED NOT NULL,
  `vendor_invoice_amt` double(10,2) NOT NULL,
  `gov_approve_amt` double(10,2) NOT NULL,
  `vendor_deduction_amt` double(10,2) NOT NULL,
  `final_payable_amt` double(10,2) NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(38, 20, 'Alibagh', NULL, '2018-09-06 00:42:45', '2018-09-06 00:42:45');

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
(20, 'Alibagh', NULL, '2018-09-06 00:20:45', '2018-09-06 00:20:45');

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
  `icon` varchar(191) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `module_name`, `display_name`, `display_sequence`, `routes`, `icon`) VALUES
(1, 'Divisions', 'Divisions', 1, 'division', 'fa fa-bars'),
(2, 'Depots', 'Depots', 2, 'depot', 'fa fa-bars'),
(4, 'User Types', 'User Types', 4, 'usertype', 'fa fa-bars'),
(3, 'Access Type', 'Access Type', 3, 'accesstype', 'fa fa-bars'),
(5, 'Allow User Logins', 'Allow User Logins', 5, 'allowuser', 'fa fa-bars'),
(6, 'User Master', 'User Master', 6, 'user', 'fa fa-bars'),
(8, 'Vendor Manager', 'Vendor Manager', 9, 'vendormanager', 'fa fa-bars'),
(7, 'Vendor', 'Vendor', 8, 'vendordetail', 'fa fa-bars'),
(9, 'Vendor Accountant', 'Vendor Accountant', 10, 'vendoraccountant', 'fa fa-bars'),
(10, 'Vehicle Master', 'Vehicle Master', 11, 'vehicle', 'fa fa-bars'),
(11, 'Vendor Invoice', 'Vendor Invoice', 12, 'vendorinvoice', 'fa fa-bars'),
(12, 'Parisishtha B', 'Parisishtha B', 13, 'parisishthab', 'fa fa-bars'),
(13, 'Parisishtha A', 'Parisishtha A', 14, 'parisishthaa', 'fa fa-bars'),
(14, 'Bill Summary', 'Bill Summary', 15, 'billsummary', 'fa fa-bars'),
(15, 'Parisishtha B Invoice\r\n', 'Parisishtha B Invoice', 16, 'parisishthabinvoice', 'fa fa-bars'),
(18, 'Permission\r\n', 'Permission', 7, 'permission', 'fa fa-bars');

-- --------------------------------------------------------

--
-- Table structure for table `module_hierarchies`
--

CREATE TABLE `module_hierarchies` (
  `id` int(10) UNSIGNED NOT NULL,
  `module_id` int(10) UNSIGNED NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL,
  `type` int(10) UNSIGNED NOT NULL,
  `hierarchy_sequence` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `parisishtha_as`
--

CREATE TABLE `parisishtha_as` (
  `id` int(10) UNSIGNED NOT NULL,
  `parisishtha_b_id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `billing_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `vendorinvoice_id` int(10) UNSIGNED NOT NULL,
  `voucher_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_date` date NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `total_kms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avg_kms` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `per_km_rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `total_amount` double NOT NULL,
  `avg_km_as_per_contract` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avg_km_total_as_per_contract` double NOT NULL,
  `rate_for_avg_km` double NOT NULL,
  `amount_for_avg_km` double NOT NULL,
  `total_amount_for_avg` double NOT NULL,
  `diesel_amt` double DEFAULT NULL,
  `diesel_rate` double DEFAULT NULL,
  `diesel_amount` double DEFAULT NULL,
  `diesel_final_amount` double DEFAULT NULL,
  `amountWoDeduct` double NOT NULL,
  `extra_diesel_amt` double NOT NULL,
  `vehical_exp` double NOT NULL,
  `vor_exp` double NOT NULL,
  `parking_charge` double NOT NULL,
  `hault_tax` double NOT NULL,
  `other_exp` double NOT NULL,
  `total_tax` double NOT NULL,
  `amount_payable` double NOT NULL,
  `status` int(11) DEFAULT NULL,
  `pay_status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parisishtha_as`
--

INSERT INTO `parisishtha_as` (`id`, `parisishtha_b_id`, `depot_id`, `billing_period`, `vendor_id`, `vendorinvoice_id`, `voucher_no`, `voucher_date`, `vehicle_id`, `total_kms`, `avg_kms`, `per_km_rate`, `amount`, `total_amount`, `avg_km_as_per_contract`, `avg_km_total_as_per_contract`, `rate_for_avg_km`, `amount_for_avg_km`, `total_amount_for_avg`, `diesel_amt`, `diesel_rate`, `diesel_amount`, `diesel_final_amount`, `amountWoDeduct`, `extra_diesel_amt`, `vehical_exp`, `vor_exp`, `parking_charge`, `hault_tax`, `other_exp`, `total_tax`, `amount_payable`, `status`, `pay_status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 29, '2018-09-01,2018-09-15', 1, 1, 'MSRTC/2018/0001', '2011-09-18', 1, '5919', '394.6', '18.12', 107252.28, 107252.28, '890', 445, 17.1, 15219, 15219, 0, 0, 0, 0, 122471.28, 45733, 0, 0, 1500, 0, 1800, 49033, 73438.28, 0, 0, 1, 52, '2018-09-11 06:18:18', '2018-09-12 07:34:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `parisishtha_bs`
--

CREATE TABLE `parisishtha_bs` (
  `id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `billing_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `vendorinvoice_id` int(10) UNSIGNED NOT NULL,
  `voucher_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `voucher_date` date NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `date` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `diesel_ltr` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `diese_per_ltr_price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adblue` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `adblue_price` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `breaddown_charge` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `vor_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `parking_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `hault_tax` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_exp` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_km` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `diesel_as_per_gov` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_filled_diesel` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `extra_diesel_charged` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_vendor_confirm` tinyint(1) NOT NULL DEFAULT '0',
  `is_parisishtha_a_created` tinyint(1) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL COMMENT '0-save,1-save and submit',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `parisishtha_bs`
--

INSERT INTO `parisishtha_bs` (`id`, `depot_id`, `billing_period`, `vendor_id`, `vendorinvoice_id`, `voucher_no`, `voucher_date`, `vehicle_id`, `date`, `kms`, `diesel_ltr`, `diese_per_ltr_price`, `adblue`, `adblue_price`, `breaddown_charge`, `vor_exp`, `parking_exp`, `hault_tax`, `other_exp`, `total_km`, `diesel_as_per_gov`, `extra_filled_diesel`, `extra_diesel_charged`, `is_vendor_confirm`, `is_parisishtha_a_created`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 29, '2018-09-01,2018-09-15', 1, 1, 'MSRTC/2018/0001', '2011-09-18', 1, '2018-09-01,2018-09-02,2018-09-03,2018-09-04,2018-09-05,2018-09-06,2018-09-07,2018-09-08,2018-09-09,2018-09-10,2018-09-11,2018-09-12,2018-09-13,2018-09-14,2018-09-15', '394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6,394.6', '152,369,0,0,150,157,163,152,130,145,123,115,141,140,135', '68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05,68.05', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', ',,,,,,,,,,,,,,', '100,100,100,100,100,100,100,100,100,100,100,100,100,100,100', ',,,,,,,,,,,,,,', '120,120,120,120,120,120,120,120,120,120,120,120,120,120,120', '5919.000000000001', '1399.95', '672.05', '45733.00', 1, 1, 1, 1, 1, '2018-09-11 06:10:28', '2018-09-11 06:18:18', NULL);

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
(1, 8, 11, 1, 1, 1),
(2, 8, 12, 1, 1, 1),
(3, 8, 13, 1, 1, 1),
(4, 8, 14, 1, 1, 1),
(5, 8, 15, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `usertype_id` int(10) UNSIGNED NOT NULL,
  `accesstype_id` int(10) UNSIGNED NOT NULL,
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

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email`, `password`, `division_id`, `depot_id`, `usertype_id`, `accesstype_id`, `created_by`, `updated_by`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Welcome', 'Admin', 'admin@gmail.com', '$2y$10$doI7dq.ykG3QCsycwgGqweMJ8A8N/mWc1WfWd9p8Vboq10WFcHZoq', 1, 11, 1, 1, 0, 0, 'zK25kt997ZbvuKc4WDPhasHEUO4VAvDhj9zN1RKxl3SkkzgJOyi9KGNhFDlb', '2018-08-30 07:30:13', '2018-08-30 07:30:21', NULL),
(52, 'Sudhir', 'More', 'sudhir@gmail.com', '$2y$10$eHzDIvqWHYPBDCKGGZ1O4ul6vvxPClRhYi1IVI8D55XKRTy/NvD/O', 15, 29, 4, 23, 1, 1, 'Yc3E2E7NiMw4y24NO4jLx2IZOIzP27VHfMHYtN6Sksvd9vGETBGkwLRSEJbN', '2018-09-10 17:16:48', '2018-09-12 08:27:25', NULL),
(50, 'Rahul', 'Asthana', 'rahul@gmail.com', '$2y$10$d/opCyTxdkDpyUJOqg6vVubsQY.rq.BEj5C55CAl/07WSWAXLXPam', 0, 0, 2, 1, 0, NULL, 'V3gCjpQVFOCv0YChQN1GlYDFFFcFv2Cio3EcXPw9YAw1IbWueKv7tK7TZurn', '2018-09-10 16:57:34', '2018-09-10 16:57:34', NULL),
(51, 'Mangesh', 'Kadam', 'mangesh@gmail.com', '$2y$10$ptypf89YD3OC59v2GDTd/eI2Ye1PrxPVsiDNfQbejI5WF9mwMOIZa', 0, 0, 3, 1, 50, NULL, '9T3RJemQeA3nVEqxpcbvQJTKtIgCVm1Cm6rhrjUudPb6t2JWdTLEs45hBOIc', '2018-09-10 17:00:06', '2018-09-10 17:00:06', NULL),
(54, 'Sudhir1', 'More', 'sudhir1@gmail.com', '$2y$10$eHzDIvqWHYPBDCKGGZ1O4ul6vvxPClRhYi1IVI8D55XKRTy/NvD/O', 15, 29, 8, 23, 1, NULL, 'Yc3E2E7NiMw4y24NO4jLx2IZOIzP27VHfMHYtN6Sksvd9vGETBGkwLRSEJbN', '2018-09-10 17:16:48', '2018-09-10 17:16:48', NULL);

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
(4, 'Account Officer', 0, 0, '2018-09-05 12:02:12', '2018-09-05 12:02:12', NULL),
(5, 'Division Traffic Officer', 0, 0, '2018-09-05 12:01:45', '2018-09-05 12:01:45', NULL),
(6, 'Depot Manager', 0, 0, '2018-09-05 12:01:21', '2018-09-05 12:01:21', NULL),
(7, 'Assistant Transport Inspector', 0, 0, '2018-09-05 12:00:29', '2018-09-08 09:33:59', NULL),
(8, 'Junior Accountant', 0, 0, '2018-09-05 11:58:55', '2018-09-05 11:58:55', NULL),
(9, 'Senior Clerk', 0, 0, '2018-08-31 08:17:39', '2018-08-31 12:52:08', NULL),
(10, 'Division Controller', 0, 0, '2018-09-05 12:02:41', '2018-09-08 14:14:40', NULL),
(36, 'test two', 0, 0, '2018-09-12 09:40:10', '2018-09-12 09:46:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `vehicle_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `vendor_id`, `division_id`, `depot_id`, `vehicle_no`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 15, 29, 'MH-03 AB 5051', 50, NULL, '2018-09-10 17:01:02', '2018-09-10 17:01:27', NULL),
(2, 1, 4, 7, 'MH03 CP4730', 50, NULL, '2018-09-11 15:17:23', '2018-09-11 15:17:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vendorinvoices`
--

CREATE TABLE `vendorinvoices` (
  `id` int(10) UNSIGNED NOT NULL,
  `vendor_id` int(10) UNSIGNED NOT NULL,
  `invoice_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice_date` date NOT NULL,
  `billing_period` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `division_id` int(10) UNSIGNED NOT NULL,
  `depot_id` int(10) UNSIGNED NOT NULL,
  `vehicle_id` int(10) UNSIGNED NOT NULL,
  `date` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `route` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `kms` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_kms` double(8,2) NOT NULL,
  `total_amount` double(8,2) NOT NULL,
  `publish_flag` int(1) NOT NULL DEFAULT '0',
  `is_approved` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendorinvoices`
--

INSERT INTO `vendorinvoices` (`id`, `vendor_id`, `invoice_no`, `invoice_date`, `billing_period`, `division_id`, `depot_id`, `vehicle_id`, `date`, `route`, `kms`, `rate`, `amount`, `remark`, `total_kms`, `total_amount`, `publish_flag`, `is_approved`, `created_by`, `updated_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'ABC/18-19/001', '2018-09-16', '2018-09-01,2018-09-15', 15, 29, 1, '2018-09-01,2018-09-02,2018-09-03,2018-09-04,2018-09-05,2018-09-06,2018-09-07,2018-09-08,2018-09-09,2018-09-10,2018-09-11,2018-09-12,2018-09-13,2018-09-14,2018-09-15', 'Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara,Mumbai Central to Satara', '270,270,270,270,270,270,270,270,270,270,270,270,270,270,270', '14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5,14.5', '3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00,3915.00', ',,,,,,,,,,,,,,', 4050.00, 58725.00, 1, 1, 0, 0, '2018-09-10 17:12:16', '2018-09-11 05:46:48', NULL),
(2, 1, '34', '2018-09-11', '2018-09-01,2018-09-03', 1, 2, 1, '2018-09-01,2018-09-02,2018-09-03', 'Route,Route,Route', '34,34,34', '34,34,34', '1156.00,1156.00,1156.00', ',,', 102.00, 3468.00, 1, 1, 0, 0, '2018-09-11 07:00:39', '2018-09-12 08:18:55', NULL);

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vendors`
--

INSERT INTO `vendors` (`id`, `vendor_name`, `user_id`, `address`, `pan_no`, `gst_no`, `bank_name`, `account_no`, `ifsc_code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'ABC Tours Pvt Ltd', 0, 'Kurla, Mumbai', 'ABCDE1234F', 'GSTN123456789', 'XYZ Bank', '1234567890', 'XYZB0000001', '2018-09-10 16:56:39', '2018-09-10 16:59:33', NULL);

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
(1, 1, 51);

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
(1, 1, 50);

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
  ADD KEY `billsummaries_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `billsummaries_parisishtha_a_id_foreign` (`parisishtha_a_id`),
  ADD KEY `billsummaries_vendorinvoice_id_foreign` (`vendorinvoice_id`);

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
  ADD KEY `parisishtha_as_vehicle_id_foreign` (`vehicle_id`),
  ADD KEY `parisishtha_as_parisishtha_b_id_foreign` (`parisishtha_b_id`);

--
-- Indexes for table `parisishtha_bs`
--
ALTER TABLE `parisishtha_bs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `parisishtha_bs_depot_id_foreign` (`depot_id`),
  ADD KEY `parisishtha_bs_vendor_id_foreign` (`vendor_id`),
  ADD KEY `parisishtha_bs_vendorinvoice_id_foreign` (`vendorinvoice_id`),
  ADD KEY `parisishtha_bs_vehicle_id_foreign` (`vehicle_id`);

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
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_division_id_foreign` (`division_id`),
  ADD KEY `vehicles_depot_id_foreign` (`depot_id`);

--
-- Indexes for table `vendorinvoices`
--
ALTER TABLE `vendorinvoices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vendorinvoices_vendor_id_foreign` (`vendor_id`),
  ADD KEY `vendorinvoices_division_id_foreign` (`division_id`),
  ADD KEY `vendorinvoices_depot_id_foreign` (`depot_id`),
  ADD KEY `vendorinvoices_vehicle_id_foreign` (`vehicle_id`);

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `billsummaries`
--
ALTER TABLE `billsummaries`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `companydetails`
--
ALTER TABLE `companydetails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `depots`
--
ALTER TABLE `depots`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `divisions`
--
ALTER TABLE `divisions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `module_hierarchies`
--
ALTER TABLE `module_hierarchies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parisishtha_as`
--
ALTER TABLE `parisishtha_as`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `parisishtha_bs`
--
ALTER TABLE `parisishtha_bs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `usertypes`
--
ALTER TABLE `usertypes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendorinvoices`
--
ALTER TABLE `vendorinvoices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vendors`
--
ALTER TABLE `vendors`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_accountants`
--
ALTER TABLE `vendor_accountants`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `vendor_managers`
--
ALTER TABLE `vendor_managers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
