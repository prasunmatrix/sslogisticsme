-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2019 at 11:16 AM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.17-1+ubuntu16.04.1+deb.sury.org+3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sslogistics`
--

-- --------------------------------------------------------

--
-- Table structure for table `ss_address_zones`
--

CREATE TABLE `ss_address_zones` (
  `id` bigint(20) NOT NULL,
  `latitude` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_address_zones`
--

INSERT INTO `ss_address_zones` (`id`, `latitude`, `longitude`, `title`, `address`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '22.5445343', '88.22177330000001', 'SANKRAIL', 'Sankrail, Howrah, West Bengal, India', 'A', 'N', '2019-04-23 06:31:33', '2019-04-23 06:31:33', 1, NULL, NULL, NULL),
(2, '22.6809296', '88.29701419999999', 'DANKUNI', 'Dankuni, West Bengal, India', 'A', 'N', '2019-04-23 06:32:23', '2019-04-23 06:32:23', 1, NULL, NULL, NULL),
(3, '22.642257', '87.3190065', 'SALBONI', 'Salboni, West Bengal, India', 'A', 'N', '2019-04-23 06:33:28', '2019-04-23 06:33:28', 1, NULL, NULL, NULL),
(4, '22.5292775', '87.3289427', 'GODAPIYASAL', 'Godapiasal, West Bengal, India', 'A', 'N', '2019-04-23 06:34:18', '2019-04-23 06:34:18', 1, NULL, NULL, NULL),
(5, '22.6170463', '88.3713578', 'COSSIPORE', 'Cossipore, Kolkata, West Bengal, India', 'A', 'N', '2019-04-23 06:35:18', '2019-04-23 06:35:18', 1, NULL, NULL, NULL),
(6, '22.6197151', '88.2874736', 'PAKURIA', 'Pakuria, West Bengal, India', 'A', 'N', '2019-04-23 06:36:14', '2019-04-23 06:36:14', 1, NULL, NULL, NULL),
(7, '23.0812382', '88.28017850000003', 'PANDUA', 'Pandua, West Bengal, India', 'A', 'N', '2019-04-23 07:16:33', '2019-04-23 07:16:33', 6, NULL, NULL, NULL),
(8, '22.5125814', '88.6096575', 'BHANGAR', 'Bhangar, West Bengal, India', 'A', 'N', '2019-04-23 07:48:56', '2019-04-23 07:48:56', 10, NULL, NULL, NULL),
(9, '23.04785799999999', '88.51301439999997', 'CHAKDAH', 'Chakdaha, West Bengal, India', 'A', 'N', '2019-04-23 07:54:19', '2019-04-23 07:54:19', 7, NULL, NULL, NULL),
(10, '22.9011588', '88.38985520000006', 'CHINSURAH MOGRA', 'Chinsurah, West Bengal, India', 'A', 'N', '2019-04-23 07:56:00', '2019-04-23 07:56:00', 1, NULL, NULL, NULL),
(11, '22.3399696', '87.2269973', 'KALAIKUNDA', 'Kalaikunda, Kharagpur, West Bengal, India', 'A', 'N', '2019-04-23 07:58:52', '2019-04-23 07:58:52', 5, NULL, NULL, NULL),
(12, '22.9869789', '88.37734619999992', 'MOGRA', 'Mogra, Amodghata, West Bengal, India', 'A', 'N', '2019-04-23 08:16:25', '2019-04-23 08:16:25', 7, NULL, NULL, NULL),
(13, '23.0621122', '88.76598369999999', 'KRISHNANAGAR', 'BIDYUT DISTRIBUTORS, Gopalnagar, West Bengal, India', 'A', 'N', '2019-04-23 08:27:54', '2019-04-23 08:27:54', 4, NULL, NULL, NULL),
(14, '22.34601', '87.23197529999993', 'KHARAGPUR', 'Kharagpur, West Bengal, India', 'A', 'N', '2019-04-23 08:33:38', '2019-04-23 08:33:38', 5, NULL, NULL, NULL),
(15, '21.9001037', '87.53695960000005', 'EGRA', 'Egra, West Bengal, India', 'A', 'N', '2019-04-23 08:40:31', '2019-04-23 08:40:31', 4, NULL, NULL, NULL),
(16, '22.4671065', '87.97023200000001', 'BAGNAN', 'Bagnan, West Bengal, India', 'A', 'N', '2019-04-23 08:43:47', '2019-04-23 08:43:47', 5, NULL, NULL, NULL),
(17, '21.7859456', '87.04993530000002', 'RASOGOVINDPUR', 'Rasgovindpur, Odisha, India', 'A', 'N', '2019-04-23 08:46:07', '2019-04-23 08:46:07', 4, NULL, NULL, NULL),
(18, '22.6574017', '88.8671766', 'BASIRHAT- I', 'Basirhat, West Bengal, India', 'A', 'N', '2019-04-23 08:48:57', '2019-04-23 08:48:57', 1, NULL, NULL, NULL),
(19, '22.0666742', '88.06981180000002', 'HALDIA', 'Haldia, West Bengal, India', 'A', 'N', '2019-04-23 08:52:27', '2019-04-23 08:52:27', 5, NULL, NULL, NULL),
(20, '22.5957689', '88.26363939999999', 'HOWRAH', 'Howrah, West Bengal, India', 'A', 'N', '2019-04-23 22:54:08', '2019-04-23 22:54:08', 5, NULL, NULL, NULL),
(21, '21.9767009', '87.80114389999994', 'KHEJURI', 'Khejuri, West Bengal, India', 'A', 'N', '2019-04-23 23:10:12', '2019-04-23 23:10:12', 5, NULL, NULL, NULL),
(22, '22.4256613', '87.31988189999993', 'MIDNAPORE', 'Midnapore, West Bengal, India', 'A', 'N', '2019-04-23 23:45:26', '2019-04-23 23:45:26', 5, NULL, NULL, NULL),
(23, '22.4549909', '86.99743850000004', 'JHARGRAM', 'Jhargram, West Bengal, India', 'A', 'N', '2019-04-23 23:51:01', '2019-04-23 23:51:01', 5, NULL, NULL, NULL),
(24, '21.9809975', '87.60012219999999', 'PRATAPDIGHI', 'Pratap Dighi, West Bengal, India', 'A', 'N', '2019-04-24 00:10:46', '2019-04-24 00:10:46', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_categories`
--

CREATE TABLE `ss_categories` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_categories`
--

INSERT INTO `ss_categories` (`id`, `category_name`, `category_description`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'DESTINATION', 'DESTINATION', 'D', 'Y', '2019-04-23 06:47:20', '2019-04-23 06:48:48', 6, NULL, '2019-04-23 06:48:48', 1),
(2, 'CEMENT', 'CEMENT', 'D', 'Y', '2019-04-23 06:48:14', '2019-04-23 06:48:55', 6, NULL, '2019-04-23 06:48:55', 1),
(3, 'CEMENT BAG', 'PCP', 'D', 'Y', '2019-04-23 06:48:33', '2019-04-23 06:48:58', 7, NULL, '2019-04-23 06:48:58', 1),
(4, 'CEMENT BAG', 'CEMENT BAG', 'A', 'N', '2019-04-23 06:49:14', '2019-04-23 06:49:14', 1, NULL, NULL, NULL),
(5, 'CEMENT', 'LAFARGE', 'D', 'Y', '2019-04-23 06:49:26', '2019-04-23 06:54:24', 8, NULL, '2019-04-23 06:54:24', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ss_cities`
--

CREATE TABLE `ss_cities` (
  `id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL COMMENT 'primary key of ''countries''',
  `state_id` bigint(20) NOT NULL COMMENT 'primary key of ''states''',
  `city_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_countries`
--

CREATE TABLE `ss_countries` (
  `id` bigint(20) NOT NULL,
  `country_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_gps_trackings`
--

CREATE TABLE `ss_gps_trackings` (
  `id` bigint(20) NOT NULL,
  `gps_id` bigint(20) NOT NULL COMMENT '3rd party GPS devise id',
  `unit_id` bigint(20) NOT NULL COMMENT '3rd party GPS unit id',
  `latitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `longitude` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speed` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `datetime` timestamp NULL DEFAULT NULL,
  `location` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vehicle_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''vehicles''',
  `json` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_items`
--

CREATE TABLE `ss_items` (
  `id` bigint(20) NOT NULL,
  `category_id` bigint(20) NOT NULL COMMENT 'primary key of ''categories''',
  `item_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `item_description` text COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_items`
--

INSERT INTO `ss_items` (`id`, `category_id`, `item_name`, `item_description`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 4, 'OCL PCP', NULL, 'D', 'Y', '2019-04-23 06:52:53', '2019-04-23 07:25:04', 7, NULL, '2019-04-23 07:25:04', 1),
(2, 4, 'AMB-PPC', 'AMB-PPC', 'A', 'N', '2019-04-23 06:53:10', '2019-04-23 07:25:18', 1, 1, NULL, NULL),
(3, 4, 'AM PPC', 'AM PPC', 'D', 'Y', '2019-04-23 06:56:11', '2019-04-23 07:01:32', 4, NULL, '2019-04-23 07:01:32', 1),
(4, 4, 'JSW-PSC', 'JSW-PSC', 'A', 'N', '2019-04-23 06:56:12', '2019-04-23 07:25:34', 6, 1, NULL, NULL),
(5, 4, 'UTC-PPC', 'UTC-PPC', 'A', 'N', '2019-04-23 06:56:35', '2019-04-23 07:26:10', 5, 1, NULL, NULL),
(6, 4, 'JSW-PSC-NFR', 'JSW-PSC-NFR', 'A', 'N', '2019-04-23 06:56:49', '2019-04-23 07:26:27', 6, 1, NULL, NULL),
(7, 4, 'UTC-PPC-NFR', 'UTC-PPC-NFR', 'A', 'N', '2019-04-23 06:57:04', '2019-04-23 07:26:44', 5, 1, NULL, NULL),
(8, 4, 'LFC-PSC', 'LFC-PSC', 'A', 'N', '2019-04-23 06:59:14', '2019-04-23 07:26:59', 8, 1, NULL, NULL),
(9, 4, 'AMB-PPC-PLUS', 'AMB-PPC-PLUS', 'A', 'N', '2019-04-23 07:01:45', '2019-04-23 07:27:16', 4, 1, NULL, NULL),
(10, 4, 'AMB-PPC-NFR', 'AMB-PPC-NFR', 'A', 'N', '2019-04-23 07:02:11', '2019-04-23 07:27:59', 4, 1, NULL, NULL),
(11, 4, 'OCL-PCC-NFR', 'OCL-PCC-NFR', 'A', 'N', '2019-04-23 07:09:11', '2019-04-23 07:28:40', 7, 1, NULL, NULL),
(12, 4, 'OCL-PCC', 'OCL-PCC', 'A', 'N', '2019-04-23 07:10:07', '2019-04-23 07:29:08', 7, 1, NULL, NULL),
(13, 4, 'DAL-PSC', 'DAL-PSC', 'A', 'N', '2019-04-23 07:10:59', '2019-04-23 07:29:28', 7, 1, NULL, NULL),
(14, 4, 'DAL-DSP', 'DAL-DSP', 'A', 'N', '2019-04-23 07:11:23', '2019-04-23 07:29:45', 7, 1, NULL, NULL),
(15, 4, 'OCL-PSC-NFR', 'OCL-PSC-NFR', 'A', 'N', '2019-04-23 07:12:56', '2019-04-23 07:30:03', 7, 1, NULL, NULL),
(16, 4, 'DAL-FBC', 'DAL-FBC', 'A', 'N', '2019-04-23 07:13:28', '2019-04-23 07:30:26', 7, 1, NULL, NULL),
(17, 4, 'OCL-PPC-NFR', 'OCL-PPC-NFR', 'A', 'N', '2019-04-23 07:14:23', '2019-04-23 07:30:49', 7, 1, NULL, NULL),
(18, 4, 'ACC-PSC', 'ACC-PSC', 'A', 'N', '2019-04-23 07:15:26', '2019-04-23 07:31:18', 8, 1, NULL, NULL),
(19, 4, 'ACC-F2R', 'ACC-F2R', 'A', 'N', '2019-04-23 07:15:43', '2019-04-23 07:31:31', 8, 1, NULL, NULL),
(20, 4, 'UTC-PSC', 'UTC-PSC', 'A', 'N', '2019-04-23 07:16:05', '2019-04-23 07:32:01', 8, 1, NULL, NULL),
(21, 4, 'AMB-COM', 'AMB-COM', 'A', 'N', '2019-04-23 07:16:25', '2019-04-23 07:32:20', 8, 1, NULL, NULL),
(22, 4, 'AMB-OPC-NFR', 'AMB-OPC-NFR', 'A', 'N', '2019-04-23 07:33:02', '2019-04-23 07:33:02', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_model_has_permissions`
--

CREATE TABLE `ss_model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key of ss_permissions',
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL COMMENT 'primary key of ss_users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_model_has_permissions`
--

INSERT INTO `ss_model_has_permissions` (`permission_id`, `model_type`, `model_id`) VALUES
(4, 'App\\User', 2),
(8, 'App\\User', 2),
(12, 'App\\User', 2),
(13, 'App\\User', 2),
(14, 'App\\User', 2),
(15, 'App\\User', 2),
(16, 'App\\User', 2),
(17, 'App\\User', 2),
(18, 'App\\User', 2),
(19, 'App\\User', 2),
(20, 'App\\User', 2),
(21, 'App\\User', 2),
(22, 'App\\User', 2),
(23, 'App\\User', 2),
(24, 'App\\User', 2),
(26, 'App\\User', 2),
(27, 'App\\User', 2),
(28, 'App\\User', 2),
(29, 'App\\User', 2),
(31, 'App\\User', 2),
(58, 'App\\User', 2),
(59, 'App\\User', 2),
(60, 'App\\User', 2),
(64, 'App\\User', 2),
(65, 'App\\User', 2),
(66, 'App\\User', 2),
(67, 'App\\User', 2),
(68, 'App\\User', 2),
(72, 'App\\User', 2),
(4, 'App\\User', 3),
(8, 'App\\User', 3),
(12, 'App\\User', 3),
(13, 'App\\User', 3),
(14, 'App\\User', 3),
(15, 'App\\User', 3),
(16, 'App\\User', 3),
(17, 'App\\User', 3),
(18, 'App\\User', 3),
(19, 'App\\User', 3),
(20, 'App\\User', 3),
(21, 'App\\User', 3),
(22, 'App\\User', 3),
(23, 'App\\User', 3),
(24, 'App\\User', 3),
(26, 'App\\User', 3),
(27, 'App\\User', 3),
(28, 'App\\User', 3),
(29, 'App\\User', 3),
(31, 'App\\User', 3),
(58, 'App\\User', 3),
(59, 'App\\User', 3),
(60, 'App\\User', 3),
(64, 'App\\User', 3),
(65, 'App\\User', 3),
(66, 'App\\User', 3),
(67, 'App\\User', 3),
(68, 'App\\User', 3),
(72, 'App\\User', 3),
(4, 'App\\User', 4),
(8, 'App\\User', 4),
(12, 'App\\User', 4),
(13, 'App\\User', 4),
(14, 'App\\User', 4),
(15, 'App\\User', 4),
(16, 'App\\User', 4),
(17, 'App\\User', 4),
(18, 'App\\User', 4),
(19, 'App\\User', 4),
(20, 'App\\User', 4),
(21, 'App\\User', 4),
(22, 'App\\User', 4),
(23, 'App\\User', 4),
(24, 'App\\User', 4),
(26, 'App\\User', 4),
(27, 'App\\User', 4),
(28, 'App\\User', 4),
(29, 'App\\User', 4),
(31, 'App\\User', 4),
(58, 'App\\User', 4),
(59, 'App\\User', 4),
(60, 'App\\User', 4),
(64, 'App\\User', 4),
(65, 'App\\User', 4),
(66, 'App\\User', 4),
(67, 'App\\User', 4),
(68, 'App\\User', 4),
(72, 'App\\User', 4),
(4, 'App\\User', 5),
(8, 'App\\User', 5),
(12, 'App\\User', 5),
(13, 'App\\User', 5),
(14, 'App\\User', 5),
(15, 'App\\User', 5),
(16, 'App\\User', 5),
(17, 'App\\User', 5),
(18, 'App\\User', 5),
(19, 'App\\User', 5),
(20, 'App\\User', 5),
(21, 'App\\User', 5),
(22, 'App\\User', 5),
(23, 'App\\User', 5),
(24, 'App\\User', 5),
(26, 'App\\User', 5),
(27, 'App\\User', 5),
(28, 'App\\User', 5),
(29, 'App\\User', 5),
(31, 'App\\User', 5),
(58, 'App\\User', 5),
(59, 'App\\User', 5),
(60, 'App\\User', 5),
(64, 'App\\User', 5),
(65, 'App\\User', 5),
(66, 'App\\User', 5),
(67, 'App\\User', 5),
(68, 'App\\User', 5),
(72, 'App\\User', 5),
(4, 'App\\User', 6),
(8, 'App\\User', 6),
(12, 'App\\User', 6),
(13, 'App\\User', 6),
(14, 'App\\User', 6),
(15, 'App\\User', 6),
(16, 'App\\User', 6),
(17, 'App\\User', 6),
(18, 'App\\User', 6),
(19, 'App\\User', 6),
(20, 'App\\User', 6),
(21, 'App\\User', 6),
(22, 'App\\User', 6),
(23, 'App\\User', 6),
(24, 'App\\User', 6),
(26, 'App\\User', 6),
(27, 'App\\User', 6),
(28, 'App\\User', 6),
(29, 'App\\User', 6),
(31, 'App\\User', 6),
(58, 'App\\User', 6),
(59, 'App\\User', 6),
(60, 'App\\User', 6),
(64, 'App\\User', 6),
(65, 'App\\User', 6),
(66, 'App\\User', 6),
(67, 'App\\User', 6),
(68, 'App\\User', 6),
(72, 'App\\User', 6),
(4, 'App\\User', 7),
(8, 'App\\User', 7),
(12, 'App\\User', 7),
(13, 'App\\User', 7),
(14, 'App\\User', 7),
(15, 'App\\User', 7),
(16, 'App\\User', 7),
(17, 'App\\User', 7),
(18, 'App\\User', 7),
(19, 'App\\User', 7),
(20, 'App\\User', 7),
(21, 'App\\User', 7),
(22, 'App\\User', 7),
(23, 'App\\User', 7),
(24, 'App\\User', 7),
(26, 'App\\User', 7),
(27, 'App\\User', 7),
(28, 'App\\User', 7),
(29, 'App\\User', 7),
(31, 'App\\User', 7),
(58, 'App\\User', 7),
(59, 'App\\User', 7),
(60, 'App\\User', 7),
(64, 'App\\User', 7),
(65, 'App\\User', 7),
(66, 'App\\User', 7),
(67, 'App\\User', 7),
(68, 'App\\User', 7),
(72, 'App\\User', 7),
(4, 'App\\User', 8),
(8, 'App\\User', 8),
(12, 'App\\User', 8),
(13, 'App\\User', 8),
(14, 'App\\User', 8),
(15, 'App\\User', 8),
(16, 'App\\User', 8),
(17, 'App\\User', 8),
(18, 'App\\User', 8),
(19, 'App\\User', 8),
(20, 'App\\User', 8),
(21, 'App\\User', 8),
(22, 'App\\User', 8),
(23, 'App\\User', 8),
(24, 'App\\User', 8),
(26, 'App\\User', 8),
(27, 'App\\User', 8),
(28, 'App\\User', 8),
(29, 'App\\User', 8),
(31, 'App\\User', 8),
(58, 'App\\User', 8),
(59, 'App\\User', 8),
(60, 'App\\User', 8),
(64, 'App\\User', 8),
(65, 'App\\User', 8),
(66, 'App\\User', 8),
(67, 'App\\User', 8),
(68, 'App\\User', 8),
(72, 'App\\User', 8),
(1, 'App\\User', 9),
(2, 'App\\User', 9),
(3, 'App\\User', 9),
(4, 'App\\User', 9),
(5, 'App\\User', 9),
(6, 'App\\User', 9),
(7, 'App\\User', 9),
(8, 'App\\User', 9),
(9, 'App\\User', 9),
(10, 'App\\User', 9),
(11, 'App\\User', 9),
(12, 'App\\User', 9),
(13, 'App\\User', 9),
(14, 'App\\User', 9),
(15, 'App\\User', 9),
(16, 'App\\User', 9),
(17, 'App\\User', 9),
(18, 'App\\User', 9),
(19, 'App\\User', 9),
(20, 'App\\User', 9),
(21, 'App\\User', 9),
(22, 'App\\User', 9),
(23, 'App\\User', 9),
(24, 'App\\User', 9),
(25, 'App\\User', 9),
(26, 'App\\User', 9),
(27, 'App\\User', 9),
(28, 'App\\User', 9),
(29, 'App\\User', 9),
(30, 'App\\User', 9),
(31, 'App\\User', 9),
(32, 'App\\User', 9),
(33, 'App\\User', 9),
(34, 'App\\User', 9),
(35, 'App\\User', 9),
(36, 'App\\User', 9),
(37, 'App\\User', 9),
(38, 'App\\User', 9),
(39, 'App\\User', 9),
(43, 'App\\User', 9),
(49, 'App\\User', 9),
(50, 'App\\User', 9),
(51, 'App\\User', 9),
(52, 'App\\User', 9),
(53, 'App\\User', 9),
(54, 'App\\User', 9),
(55, 'App\\User', 9),
(56, 'App\\User', 9),
(57, 'App\\User', 9),
(58, 'App\\User', 9),
(59, 'App\\User', 9),
(60, 'App\\User', 9),
(61, 'App\\User', 9),
(62, 'App\\User', 9),
(63, 'App\\User', 9),
(64, 'App\\User', 9),
(65, 'App\\User', 9),
(66, 'App\\User', 9),
(67, 'App\\User', 9),
(68, 'App\\User', 9),
(69, 'App\\User', 9),
(70, 'App\\User', 9),
(71, 'App\\User', 9),
(72, 'App\\User', 9),
(1, 'App\\User', 10),
(2, 'App\\User', 10),
(3, 'App\\User', 10),
(4, 'App\\User', 10),
(5, 'App\\User', 10),
(6, 'App\\User', 10),
(7, 'App\\User', 10),
(8, 'App\\User', 10),
(9, 'App\\User', 10),
(10, 'App\\User', 10),
(11, 'App\\User', 10),
(12, 'App\\User', 10),
(13, 'App\\User', 10),
(14, 'App\\User', 10),
(15, 'App\\User', 10),
(16, 'App\\User', 10),
(17, 'App\\User', 10),
(18, 'App\\User', 10),
(19, 'App\\User', 10),
(20, 'App\\User', 10),
(21, 'App\\User', 10),
(22, 'App\\User', 10),
(23, 'App\\User', 10),
(24, 'App\\User', 10),
(25, 'App\\User', 10),
(26, 'App\\User', 10),
(27, 'App\\User', 10),
(28, 'App\\User', 10),
(29, 'App\\User', 10),
(30, 'App\\User', 10),
(31, 'App\\User', 10),
(32, 'App\\User', 10),
(33, 'App\\User', 10),
(34, 'App\\User', 10),
(35, 'App\\User', 10),
(36, 'App\\User', 10),
(37, 'App\\User', 10),
(38, 'App\\User', 10),
(39, 'App\\User', 10),
(43, 'App\\User', 10),
(49, 'App\\User', 10),
(50, 'App\\User', 10),
(51, 'App\\User', 10),
(52, 'App\\User', 10),
(53, 'App\\User', 10),
(54, 'App\\User', 10),
(55, 'App\\User', 10),
(56, 'App\\User', 10),
(57, 'App\\User', 10),
(58, 'App\\User', 10),
(59, 'App\\User', 10),
(60, 'App\\User', 10),
(61, 'App\\User', 10),
(62, 'App\\User', 10),
(63, 'App\\User', 10),
(64, 'App\\User', 10),
(65, 'App\\User', 10),
(66, 'App\\User', 10),
(67, 'App\\User', 10),
(68, 'App\\User', 10),
(69, 'App\\User', 10),
(70, 'App\\User', 10),
(71, 'App\\User', 10),
(72, 'App\\User', 10),
(1, 'App\\User', 11),
(2, 'App\\User', 11),
(3, 'App\\User', 11),
(4, 'App\\User', 11),
(5, 'App\\User', 11),
(6, 'App\\User', 11),
(7, 'App\\User', 11),
(8, 'App\\User', 11),
(9, 'App\\User', 11),
(10, 'App\\User', 11),
(11, 'App\\User', 11),
(12, 'App\\User', 11),
(13, 'App\\User', 11),
(14, 'App\\User', 11),
(15, 'App\\User', 11),
(16, 'App\\User', 11),
(17, 'App\\User', 11),
(18, 'App\\User', 11),
(19, 'App\\User', 11),
(20, 'App\\User', 11),
(21, 'App\\User', 11),
(22, 'App\\User', 11),
(23, 'App\\User', 11),
(24, 'App\\User', 11),
(25, 'App\\User', 11),
(26, 'App\\User', 11),
(27, 'App\\User', 11),
(28, 'App\\User', 11),
(29, 'App\\User', 11),
(30, 'App\\User', 11),
(31, 'App\\User', 11),
(32, 'App\\User', 11),
(33, 'App\\User', 11),
(34, 'App\\User', 11),
(35, 'App\\User', 11),
(36, 'App\\User', 11),
(37, 'App\\User', 11),
(38, 'App\\User', 11),
(39, 'App\\User', 11),
(40, 'App\\User', 11),
(41, 'App\\User', 11),
(42, 'App\\User', 11),
(43, 'App\\User', 11),
(44, 'App\\User', 11),
(45, 'App\\User', 11),
(46, 'App\\User', 11),
(47, 'App\\User', 11),
(48, 'App\\User', 11),
(49, 'App\\User', 11),
(50, 'App\\User', 11),
(51, 'App\\User', 11),
(52, 'App\\User', 11),
(53, 'App\\User', 11),
(54, 'App\\User', 11),
(55, 'App\\User', 11),
(56, 'App\\User', 11),
(57, 'App\\User', 11),
(58, 'App\\User', 11),
(59, 'App\\User', 11),
(60, 'App\\User', 11),
(61, 'App\\User', 11),
(62, 'App\\User', 11),
(63, 'App\\User', 11),
(64, 'App\\User', 11),
(65, 'App\\User', 11),
(66, 'App\\User', 11),
(67, 'App\\User', 11),
(68, 'App\\User', 11),
(69, 'App\\User', 11),
(70, 'App\\User', 11),
(71, 'App\\User', 11),
(72, 'App\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `ss_model_has_roles`
--

CREATE TABLE `ss_model_has_roles` (
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key of ss_roles',
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL COMMENT 'primary key of ss_users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_model_has_roles`
--

INSERT INTO `ss_model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\User', 1),
(3, 'App\\User', 2),
(3, 'App\\User', 3),
(3, 'App\\User', 4),
(3, 'App\\User', 5),
(3, 'App\\User', 6),
(3, 'App\\User', 7),
(3, 'App\\User', 8),
(2, 'App\\User', 9),
(2, 'App\\User', 10),
(1, 'App\\User', 11);

-- --------------------------------------------------------

--
-- Table structure for table `ss_parties`
--

CREATE TABLE `ss_parties` (
  `id` bigint(20) NOT NULL,
  `address_zone_id` bigint(20) NOT NULL COMMENT 'primary key of ''address_zones''',
  `party_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `party_description` text COLLATE utf8mb4_unicode_ci,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_parties`
--

INSERT INTO `ss_parties` (`id`, `address_zone_id`, `party_name`, `party_description`, `phone_number`, `email`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 7, 'KALI MATA HARDWARE', 'KALI MATA HARDWARE', NULL, NULL, 'A', 'N', '2019-04-23 07:18:05', '2019-04-23 07:18:05', 6, NULL, NULL, NULL),
(2, 8, 'DCBL-BHANGAR-E2E', 'BHANGAR E2E', NULL, NULL, 'A', 'N', '2019-04-23 07:30:29', '2019-04-23 07:49:42', 7, 10, NULL, NULL),
(3, 9, 'DCBL-CHAKDAH-E2E', NULL, NULL, NULL, 'A', 'N', '2019-04-23 07:56:45', '2019-04-23 07:56:45', 7, NULL, NULL, NULL),
(4, 9, 'DCBL-DANKUNI-E2E', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:01:53', '2019-04-23 08:01:53', 7, NULL, NULL, NULL),
(5, 5, 'DCBL-COSSIPORE-E2E', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:05:22', '2019-04-23 08:05:22', 7, NULL, NULL, NULL),
(6, 11, 'UTCL-KALAIKUNDA', '', NULL, NULL, 'A', 'N', '2019-04-23 08:12:40', '2019-04-23 08:12:40', 5, NULL, NULL, NULL),
(7, 5, 'HARI PADO SARKAR', '-', '', 'AAA@GMAIL.COM', 'A', 'N', '2019-04-23 08:13:18', '2019-04-23 08:13:18', 8, NULL, NULL, NULL),
(8, 8, 'DCBL-MOGRA-E2E', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:17:23', '2019-04-23 08:17:23', 7, NULL, NULL, NULL),
(9, 5, 'SARKAR AGENCY', '-', NULL, 'AA@GMAIL.COM', 'A', 'N', '2019-04-23 08:25:30', '2019-04-23 08:25:30', 8, NULL, NULL, NULL),
(10, 13, 'BIDYUT DISTRIBUTORS', 'KRISHNANAGAR', NULL, NULL, 'A', 'N', '2019-04-23 08:30:41', '2019-04-23 08:30:41', 4, NULL, NULL, NULL),
(11, 14, 'UTCL-KHARAGPUR', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:35:26', '2019-04-23 08:35:26', 5, NULL, NULL, NULL),
(12, 15, 'KAUSIK ENTERPRISE', 'KAUSIK ENTERPRISE', NULL, NULL, 'A', 'N', '2019-04-23 08:42:29', '2019-04-23 08:42:29', 4, NULL, NULL, NULL),
(13, 16, 'NIBEDITA BUILDING MATERIAL SUP', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:45:51', '2019-04-23 08:45:51', 5, NULL, NULL, NULL),
(14, 2, 'DCBL-DANKUN-IE2E', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:46:51', '2019-04-23 09:02:31', 7, 7, NULL, NULL),
(15, 17, 'KUNDU BROTHERS', 'KUNDU BROTHERS', NULL, NULL, 'A', 'N', '2019-04-23 08:52:48', '2019-04-23 08:52:48', 4, NULL, NULL, NULL),
(16, 12, 'NEW LITON ENTERPRISE', '-', '9853042317', 'INFO@SSLOGISTICS.ORG', 'A', 'N', '2019-04-23 08:55:10', '2019-04-23 08:55:10', 6, NULL, NULL, NULL),
(17, 19, 'JEET BUILDERS', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:59:58', '2019-04-23 08:59:58', 5, NULL, NULL, NULL),
(18, 20, 'KOLKATA CEMENT UDYOG', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:00:25', '2019-04-23 23:00:25', 5, NULL, NULL, NULL),
(19, 21, 'SAHOO BUILDERS', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:17:37', '2019-04-23 23:17:37', 5, NULL, NULL, NULL),
(20, 21, 'SAHOO BUILDER', '', '', '', 'A', 'N', '2019-04-23 23:37:43', '2019-04-23 23:37:43', 5, NULL, NULL, NULL),
(21, 14, 'MANDAL ENTERPRISE', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:42:44', '2019-04-23 23:42:44', 5, NULL, NULL, NULL),
(22, 22, 'SRI SRI MAA HARDWARE', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:48:55', '2019-04-23 23:48:55', 5, NULL, NULL, NULL),
(23, 15, 'KHANRA ENTERPRISE', NULL, NULL, NULL, 'A', 'N', '2019-04-24 00:01:22', '2019-04-24 00:01:22', 5, NULL, NULL, NULL),
(24, 23, 'SAHU SUPPLIERS', '', '', '', 'A', 'N', '2019-04-24 00:02:20', '2019-04-24 00:02:20', 5, NULL, NULL, NULL),
(25, 24, 'PAPAI ENTERPRISE', NULL, NULL, NULL, 'A', 'N', '2019-04-24 00:14:45', '2019-04-24 00:14:45', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_party_destinations`
--

CREATE TABLE `ss_party_destinations` (
  `id` bigint(20) NOT NULL,
  `party_id` bigint(20) NOT NULL COMMENT 'primary key of ''parties''',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL COMMENT 'primary key of ''cities''',
  `state_id` bigint(20) NOT NULL COMMENT 'primary key of ''states''',
  `country_id` bigint(20) NOT NULL COMMENT 'primary key of ''countries''',
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_permissions`
--

CREATE TABLE `ss_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_permissions`
--

INSERT INTO `ss_permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'category_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(2, 'category_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(3, 'category_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(4, 'category_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(5, 'sub_category_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(6, 'sub_category_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(7, 'sub_category_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(8, 'sub_category_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(9, 'plant_manage_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(10, 'plant_manage_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(11, 'plant_manage_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(12, 'plant_manage_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(13, 'party_manage_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(14, 'party_manage_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(15, 'party_manage_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(16, 'party_manage_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(17, 'petrol_pump_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(18, 'petrol_pump_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(19, 'petrol_pump_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(20, 'petrol_pump_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(21, 'truck_manage_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(22, 'truck_manage_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(23, 'truck_manage_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(24, 'truck_manage_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(25, 'truck_manage_gps_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(26, 'trip_manage_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(27, 'trip_manage_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(28, 'trip_manage_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(29, 'trip_manage_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(30, 'trip_manage_gps_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(31, 'trip_manage_upload_pdo', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(32, 'trip_manage_pdf_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(33, 'consolidated_trip', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(34, 'customer_report_management', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(35, 'vendor_report_management', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(36, 'diesel_report_management', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(37, 'cash_report_management', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(38, 'payment_report_management', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(39, 'trip_report_management', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(40, 'user_manage_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(41, 'user_manage_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(42, 'user_manage_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(43, 'user_manage_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(44, 'user_manage_assign_role', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(45, 'user_manage_add_role', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(46, 'user_manage_edit_role', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(47, 'user_manage_delete_role', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(48, 'user_manage_view_role', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(49, 'user_details', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(50, 'user_status', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(51, 'app_module_manage_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(52, 'app_module_manage_functionalities', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(53, 'notification_insurance_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(54, 'notification_permit_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(55, 'notification_tax_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(56, 'notification_pollution_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(57, 'notification_registration_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(58, 'approvle_adv_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(59, 'approvle_dsl_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(60, 'misclleneous_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(61, 'plant_laser', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(62, 'petrolpump_laser', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(63, 'petrolpump_payment', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(64, 'plant_payment', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(65, 'address_zone_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(66, 'address_zone_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(67, 'address_zone_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(68, 'address_zone_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(69, 'vendor_add', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(70, 'vendor_edit', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(71, 'vendor_delete', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(72, 'vendor_view', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(73, 'category_add', 'web', '2019-04-08 05:09:27', '2019-04-08 05:09:27', 1, 1, NULL, NULL),
(74, 'category_edit', 'web', '2019-04-08 05:09:27', '2019-04-08 05:09:27', 1, 1, NULL, NULL),
(75, 'category_delete', 'web', '2019-04-08 05:09:27', '2019-04-08 05:09:27', 1, 1, NULL, NULL),
(76, 'category_view', 'web', '2019-04-08 05:09:27', '2019-04-08 05:09:27', 1, 1, NULL, NULL),
(77, 'sub_category_add', 'web', '2019-04-08 05:09:27', '2019-04-08 05:09:27', 1, 1, NULL, NULL),
(78, 'sub_category_edit', 'web', '2019-04-08 05:09:27', '2019-04-08 05:09:27', 1, 1, NULL, NULL),
(79, 'sub_category_delete', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(80, 'sub_category_view', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(81, 'plant_manage_add', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(82, 'plant_manage_edit', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(83, 'plant_manage_delete', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(84, 'plant_manage_view', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(85, 'party_manage_add', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(86, 'party_manage_edit', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(87, 'party_manage_delete', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(88, 'party_manage_view', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(89, 'petrol_pump_add', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(90, 'petrol_pump_edit', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(91, 'petrol_pump_delete', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(92, 'petrol_pump_view', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(93, 'truck_manage_add', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(94, 'truck_manage_edit', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(95, 'truck_manage_delete', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(96, 'truck_manage_view', 'web', '2019-04-08 05:09:28', '2019-04-08 05:09:28', 1, 1, NULL, NULL),
(97, 'truck_manage_gps_view', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(98, 'trip_manage_add', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(99, 'trip_manage_edit', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(100, 'trip_manage_delete', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(101, 'trip_manage_view', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(102, 'trip_manage_gps_view', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(103, 'trip_manage_upload_pdo', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(104, 'trip_manage_pdf_view', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(105, 'consolidated_trip', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(106, 'customer_report_management', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(107, 'vendor_report_management', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(108, 'diesel_report_management', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(109, 'cash_report_management', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(110, 'payment_report_management', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(111, 'trip_report_management', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(112, 'user_manage_view', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(113, 'user_details', 'web', '2019-04-08 05:09:29', '2019-04-08 05:09:29', 1, 1, NULL, NULL),
(114, 'user_status', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(115, 'app_module_manage_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(116, 'app_module_manage_functionalities', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(117, 'notification_insurance_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(118, 'notification_permit_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(119, 'notification_tax_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(120, 'notification_pollution_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(121, 'notification_registration_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(122, 'approvle_adv_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(123, 'approvle_dsl_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(124, 'misclleneous_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(125, 'plant_laser', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(126, 'petrolpump_laser', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(127, 'petrolpump_payment', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(128, 'plant_payment', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(129, 'address_zone_add', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(130, 'address_zone_edit', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(131, 'address_zone_delete', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(132, 'address_zone_view', 'web', '2019-04-08 05:09:30', '2019-04-08 05:09:30', 1, 1, NULL, NULL),
(133, 'vendor_add', 'web', '2019-04-08 05:09:31', '2019-04-08 05:09:31', 1, 1, NULL, NULL),
(134, 'vendor_edit', 'web', '2019-04-08 05:09:31', '2019-04-08 05:09:31', 1, 1, NULL, NULL),
(135, 'vendor_delete', 'web', '2019-04-08 05:09:31', '2019-04-08 05:09:31', 1, 1, NULL, NULL),
(136, 'vendor_view', 'web', '2019-04-08 05:09:31', '2019-04-08 05:09:31', 1, 1, NULL, NULL),
(137, 'category_view', 'web', '2019-04-08 05:15:26', '2019-04-08 05:15:26', 1, 1, NULL, NULL),
(138, 'sub_category_view', 'web', '2019-04-08 05:15:26', '2019-04-08 05:15:26', 1, 1, NULL, NULL),
(139, 'plant_manage_view', 'web', '2019-04-08 05:15:26', '2019-04-08 05:15:26', 1, 1, NULL, NULL),
(140, 'party_manage_add', 'web', '2019-04-08 05:15:26', '2019-04-08 05:15:26', 1, 1, NULL, NULL),
(141, 'party_manage_edit', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(142, 'party_manage_delete', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(143, 'party_manage_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(144, 'petrol_pump_add', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(145, 'petrol_pump_edit', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(146, 'petrol_pump_delete', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(147, 'petrol_pump_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(148, 'truck_manage_add', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(149, 'truck_manage_edit', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(150, 'truck_manage_delete', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(151, 'truck_manage_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(152, 'truck_manage_gps_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(153, 'trip_manage_add', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(154, 'trip_manage_edit', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(155, 'trip_manage_delete', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(156, 'trip_manage_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(157, 'trip_manage_gps_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(158, 'trip_manage_upload_pdo', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(159, 'trip_manage_pdf_view', 'web', '2019-04-08 05:15:27', '2019-04-08 05:15:27', 1, 1, NULL, NULL),
(160, 'approvle_adv_view', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(161, 'approvle_dsl_view', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(162, 'misclleneous_view', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(163, 'plant_payment', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(164, 'address_zone_add', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(165, 'address_zone_edit', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(166, 'address_zone_delete', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(167, 'address_zone_view', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(168, 'vendor_view', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL),
(169, 'category_view', 'web', '2019-04-08 05:45:11', '2019-04-08 05:45:11', 1, 1, NULL, NULL),
(170, 'sub_category_view', 'web', '2019-04-08 05:45:11', '2019-04-08 05:45:11', 1, 1, NULL, NULL),
(171, 'plant_manage_view', 'web', '2019-04-08 05:45:11', '2019-04-08 05:45:11', 1, 1, NULL, NULL),
(172, 'party_manage_add', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(173, 'party_manage_edit', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(174, 'party_manage_delete', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(175, 'party_manage_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(176, 'petrol_pump_add', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(177, 'petrol_pump_edit', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(178, 'petrol_pump_delete', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(179, 'petrol_pump_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(180, 'truck_manage_add', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(181, 'truck_manage_edit', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(182, 'truck_manage_delete', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(183, 'truck_manage_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(184, 'truck_manage_gps_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(185, 'trip_manage_add', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(186, 'trip_manage_edit', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(187, 'trip_manage_delete', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(188, 'trip_manage_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(189, 'trip_manage_gps_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(190, 'trip_manage_upload_pdo', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(191, 'approvle_adv_view', 'web', '2019-04-08 05:45:12', '2019-04-08 05:45:12', 1, 1, NULL, NULL),
(192, 'approvle_dsl_view', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(193, 'misclleneous_view', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(194, 'plant_payment', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(195, 'address_zone_add', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(196, 'address_zone_edit', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(197, 'address_zone_delete', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(198, 'address_zone_view', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(199, 'vendor_view', 'web', '2019-04-08 05:45:13', '2019-04-08 05:45:13', 1, 1, NULL, NULL),
(200, 'category_view', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(201, 'sub_category_view', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(202, 'plant_manage_view', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(203, 'party_manage_add', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(204, 'party_manage_edit', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(205, 'party_manage_delete', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(206, 'party_manage_view', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(207, 'petrol_pump_add', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(208, 'petrol_pump_edit', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(209, 'petrol_pump_delete', 'web', '2019-04-11 09:18:32', '2019-04-11 09:18:32', 1, 1, NULL, NULL),
(210, 'petrol_pump_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(211, 'truck_manage_add', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(212, 'truck_manage_edit', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(213, 'truck_manage_delete', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(214, 'truck_manage_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(215, 'trip_manage_add', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(216, 'trip_manage_edit', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(217, 'trip_manage_delete', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(218, 'trip_manage_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(219, 'trip_manage_upload_pdo', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(220, 'notification_insurance_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(221, 'approvle_adv_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(222, 'approvle_dsl_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(223, 'misclleneous_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(224, 'plant_payment', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(225, 'address_zone_add', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(226, 'address_zone_edit', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(227, 'address_zone_delete', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(228, 'address_zone_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(229, 'vendor_view', 'web', '2019-04-11 09:18:33', '2019-04-11 09:18:33', 1, 1, NULL, NULL),
(230, 'category_view', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(231, 'sub_category_view', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(232, 'plant_manage_view', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(233, 'party_manage_add', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(234, 'party_manage_edit', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(235, 'party_manage_delete', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(236, 'party_manage_view', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(237, 'petrol_pump_add', 'web', '2019-04-11 09:18:56', '2019-04-11 09:18:56', 1, 1, NULL, NULL),
(238, 'petrol_pump_edit', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(239, 'petrol_pump_delete', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(240, 'petrol_pump_view', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(241, 'truck_manage_add', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(242, 'truck_manage_edit', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(243, 'truck_manage_delete', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(244, 'truck_manage_view', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(245, 'trip_manage_add', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(246, 'trip_manage_edit', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(247, 'trip_manage_delete', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(248, 'trip_manage_view', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(249, 'trip_manage_upload_pdo', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(250, 'approvle_adv_view', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(251, 'approvle_dsl_view', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(252, 'misclleneous_view', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(253, 'plant_payment', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(254, 'address_zone_add', 'web', '2019-04-11 09:18:57', '2019-04-11 09:18:57', 1, 1, NULL, NULL),
(255, 'address_zone_edit', 'web', '2019-04-11 09:18:58', '2019-04-11 09:18:58', 1, 1, NULL, NULL),
(256, 'address_zone_delete', 'web', '2019-04-11 09:18:58', '2019-04-11 09:18:58', 1, 1, NULL, NULL),
(257, 'address_zone_view', 'web', '2019-04-11 09:18:58', '2019-04-11 09:18:58', 1, 1, NULL, NULL),
(258, 'vendor_view', 'web', '2019-04-11 09:18:58', '2019-04-11 09:18:58', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_petrol_pumps`
--

CREATE TABLE `ss_petrol_pumps` (
  `id` bigint(20) NOT NULL,
  `petrol_pump_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_zone_id` bigint(20) NOT NULL COMMENT 'primary key of ''address_zones''',
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_petrol_pumps`
--

INSERT INTO `ss_petrol_pumps` (`id`, `petrol_pump_name`, `address_zone_id`, `contact_number`, `contact_email`, `contact_person`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'SINHA FUEL STATION', 3, '7003945868', 'SINHAFUELSTATION@GMAIL.COM', 'SIDDHART SINHA', 'A', 'N', '2019-04-23 07:21:31', '2019-04-23 07:21:31', 6, NULL, NULL, NULL),
(2, 'S C SEN', 3, NULL, NULL, NULL, 'A', 'N', '2019-04-23 07:29:36', '2019-04-23 09:07:44', 7, 7, NULL, NULL),
(3, 'SARAOGI SERVICE STATION', 5, NULL, NULL, '', 'A', 'N', '2019-04-23 08:15:48', '2019-04-23 08:15:48', 8, NULL, NULL, NULL),
(4, 'CHAURASIA SERVICE STATION', 2, '9433011167', NULL, 'SURENDRA CHAURASIA', 'A', 'N', '2019-04-23 08:18:22', '2019-04-23 08:18:22', 5, NULL, NULL, NULL),
(5, 'SUJATA SERVISE STATION', 1, '9831289295', NULL, 'GHOSH BABU', 'A', 'N', '2019-04-23 08:19:50', '2019-04-23 08:19:50', 4, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_petrol_pump_journal_lasers`
--

CREATE TABLE `ss_petrol_pump_journal_lasers` (
  `id` bigint(20) NOT NULL,
  `petrol_pump_id` bigint(20) NOT NULL COMMENT 'primary key of ''petrol_pumps''',
  `truck_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trucks''',
  `type` enum('D','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'C' COMMENT 'D=Debit, C=Credit',
  `trip_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trips''',
  `amount` decimal(15,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `approved_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `approved_on` timestamp NULL DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_petrol_pump_journal_lasers`
--

INSERT INTO `ss_petrol_pump_journal_lasers` (`id`, `petrol_pump_id`, `truck_id`, `type`, `trip_id`, `amount`, `description`, `entry_by`, `approved_by`, `approved_on`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 1, 'D', 1, '0.00', 'Diesel Amount paid to Drive named -', 6, NULL, NULL, 'A', 'N', '2019-04-23 07:24:29', '2019-04-23 07:24:29', 6, NULL, NULL, NULL),
(2, 2, 2, 'D', 2, '5000.00', 'Diesel Amount paid to Drive named -', 10, NULL, NULL, 'A', 'N', '2019-04-23 07:33:41', '2019-04-23 07:50:52', 7, 10, NULL, NULL),
(3, 2, 5, 'D', 3, '14253.15', 'Diesel Amount paid to Drive named -', 7, NULL, NULL, 'A', 'N', '2019-04-23 08:02:04', '2019-04-23 08:02:04', 7, NULL, NULL, NULL),
(4, 1, 3, 'D', 4, '0.00', 'Diesel Amount paid to Drive named -', 6, NULL, NULL, 'A', 'N', '2019-04-23 08:04:54', '2019-04-23 08:04:54', 6, NULL, NULL, NULL),
(5, 2, 6, 'D', 5, '14253.15', 'Diesel Amount paid to Drive named -', 7, NULL, NULL, 'A', 'N', '2019-04-23 08:05:53', '2019-04-23 08:05:53', 7, NULL, NULL, NULL),
(6, 3, 7, 'D', 6, '1000.00', 'Diesel Amount paid to Drive named -', 8, NULL, NULL, 'A', 'N', '2019-04-23 08:16:39', '2019-04-23 08:16:39', 8, NULL, NULL, NULL),
(7, 2, 8, 'D', 7, '5256.00', 'Diesel Amount paid to Drive named -', 7, NULL, NULL, 'A', 'N', '2019-04-23 08:17:38', '2019-04-23 08:49:02', 7, 7, NULL, NULL),
(8, 4, 4, 'D', 8, '3700.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 08:18:41', '2019-04-23 08:18:41', 5, NULL, NULL, NULL),
(9, 5, NULL, 'C', NULL, '50000.00', 'ADVANCE', 10, NULL, NULL, 'A', 'N', '2019-04-22 20:24:25', '2019-04-22 20:24:25', 10, NULL, NULL, NULL),
(10, 5, 11, 'D', 9, '4000.00', 'Diesel Amount paid to Drive named JITENDER', 4, NULL, NULL, 'A', 'N', '2019-04-23 08:33:57', '2019-04-23 08:33:57', 4, NULL, NULL, NULL),
(11, 4, 10, 'D', 10, '3500.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 08:35:58', '2019-04-23 08:35:58', 5, NULL, NULL, NULL),
(12, 5, 12, 'D', 11, '0.00', 'Diesel Amount paid to Drive named -', 4, NULL, NULL, 'A', 'N', '2019-04-23 08:45:37', '2019-04-23 08:45:37', 4, NULL, NULL, NULL),
(13, 4, 13, 'D', 12, '2200.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 08:46:11', '2019-04-23 08:49:00', 5, 5, NULL, NULL),
(14, 2, 14, 'D', 13, '2562.00', 'Diesel Amount paid to Drive named -', 7, NULL, NULL, 'A', 'N', '2019-04-23 08:47:10', '2019-04-23 08:47:10', 7, NULL, NULL, NULL),
(15, 5, 16, 'D', 14, '3000.00', 'Diesel Amount paid to Drive named -', 4, NULL, NULL, 'A', 'N', '2019-04-23 08:53:09', '2019-04-23 08:53:09', 4, NULL, NULL, NULL),
(16, 1, 15, 'D', 15, '10000.00', 'Diesel Amount paid to Drive named -', 6, NULL, NULL, 'A', 'N', '2019-04-23 08:55:46', '2019-04-23 08:59:39', 6, NULL, NULL, NULL),
(17, 4, 17, 'D', 16, '0.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 09:00:22', '2019-04-23 09:00:22', 5, NULL, NULL, NULL),
(18, 4, 18, 'D', 17, '0.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 23:00:30', '2019-04-23 23:00:30', 5, NULL, NULL, NULL),
(19, 4, 19, 'D', 18, '0.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 23:38:16', '2019-04-23 23:40:03', 5, 5, NULL, NULL),
(20, 4, 20, 'D', 19, '3700.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 23:43:31', '2019-04-23 23:43:31', 5, NULL, NULL, NULL),
(21, 4, 21, 'D', 20, '3500.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-23 23:49:24', '2019-04-23 23:49:24', 5, NULL, NULL, NULL),
(22, 4, 22, 'D', 21, '5100.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-24 00:02:39', '2019-04-24 00:02:39', 5, NULL, NULL, NULL),
(23, 4, 23, 'D', 22, '4800.00', 'Diesel Amount paid to Drive named -', 5, NULL, NULL, 'A', 'N', '2019-04-24 00:15:16', '2019-04-24 00:15:16', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_petrol_pump_journal_lasers_edit_requests`
--

CREATE TABLE `ss_petrol_pump_journal_lasers_edit_requests` (
  `id` bigint(20) NOT NULL,
  `petrol_pump_id` bigint(20) NOT NULL COMMENT 'primary key of ''petrol_pumps''',
  `trip_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trips''',
  `petrol_pump_journal_laser_id` bigint(20) NOT NULL COMMENT 'primary key of ''petrol_pump_journal_lasers''',
  `truck_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trucks''',
  `request_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `actual_amount` int(20) NOT NULL,
  `requested_amount` bigint(20) NOT NULL,
  `approved_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `approved_on` timestamp NULL DEFAULT NULL,
  `approval_status` enum('Pending','Approved','Disapproved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `approval_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_petrol_pump_journal_lasers_edit_requests`
--

INSERT INTO `ss_petrol_pump_journal_lasers_edit_requests` (`id`, `petrol_pump_id`, `trip_id`, `petrol_pump_journal_laser_id`, `truck_id`, `request_by`, `actual_amount`, `requested_amount`, `approved_by`, `approved_on`, `approval_status`, `approval_reason`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 15, 16, 15, 6, 12000, 10000, 10, '2019-04-22 20:59:39', 'Approved', 'OK', 'I', 'N', '2019-04-23 08:59:02', '2019-04-23 08:59:39', 6, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_plants`
--

CREATE TABLE `ss_plants` (
  `id` bigint(20) NOT NULL,
  `address_zone_id` bigint(20) NOT NULL COMMENT 'primary key of ''address_zones''',
  `type` enum('P','W') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'P = Plant, W = Warehouse',
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balance_amount` bigint(20) NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_plants`
--

INSERT INTO `ss_plants` (`id`, `address_zone_id`, `type`, `name`, `description`, `contact_number`, `contact_email`, `contact_person`, `balance_amount`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'P', 'AMB-SNK', 'AMBUJA CEMENT LIMITED', NULL, NULL, NULL, -1650, 'A', 'N', '2019-04-23 06:32:00', '2019-04-23 08:53:09', 1, NULL, NULL, NULL),
(2, 2, 'P', 'UT-DCW', 'ULTRATECH CEMENT LIMITED', NULL, NULL, NULL, 4150, 'A', 'N', '2019-04-23 06:33:05', '2019-04-24 00:15:16', 1, NULL, NULL, NULL),
(3, 3, 'P', 'JSW-SALBONI', 'JSW CEMENT LIMITED', NULL, NULL, NULL, 5700, 'A', 'N', '2019-04-23 06:33:55', '2019-04-23 08:55:46', 1, NULL, NULL, NULL),
(4, 4, 'P', 'OCL-BCW', 'DALMIA CEMENT BHARAT LIMITED', NULL, NULL, NULL, -9691, 'A', 'N', '2019-04-23 06:35:00', '2019-04-23 08:49:02', 1, NULL, NULL, NULL),
(5, 5, 'W', 'CED-OFF', 'COSSIPORE DEPOT', NULL, NULL, NULL, 100, 'A', 'N', '2019-04-23 06:35:41', '2019-04-23 08:16:39', 1, NULL, NULL, NULL),
(6, 6, 'W', 'OCL-PAKURIA', 'DCBL - PAKURIA DEPOT', NULL, NULL, NULL, 0, 'A', 'N', '2019-04-23 06:36:49', '2019-04-23 06:36:49', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_plant_addresses`
--

CREATE TABLE `ss_plant_addresses` (
  `id` bigint(20) NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL COMMENT 'primary key of ''cities''',
  `state_id` bigint(20) NOT NULL COMMENT 'primary key of ''states''',
  `country_id` bigint(20) NOT NULL COMMENT 'primary key of ''countries''',
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lng` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_plant_journal_lasers`
--

CREATE TABLE `ss_plant_journal_lasers` (
  `id` bigint(20) NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `type` enum('D','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'C' COMMENT 'D=Debit, C=Credit',
  `trip_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trips''',
  `amount` decimal(15,2) NOT NULL,
  `truck_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trucks''',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_type` enum('A','M','BG') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Advance, M=Misclleneous, BG=Balance Given',
  `entry_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `approval_status` enum('Approved','Disapproved','Pending') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `approved_on` timestamp NULL DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_plant_journal_lasers`
--

INSERT INTO `ss_plant_journal_lasers` (`id`, `plant_id`, `type`, `trip_id`, `amount`, `truck_id`, `description`, `entry_type`, `entry_by`, `approval_status`, `reason`, `approved_by`, `approved_on`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 06:32:00', '2019-04-23 06:32:00', 1, NULL, NULL, NULL),
(2, 2, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 06:33:05', '2019-04-23 06:33:05', 1, NULL, NULL, NULL),
(3, 3, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 06:33:55', '2019-04-23 06:33:55', 1, NULL, NULL, NULL),
(4, 4, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 06:35:00', '2019-04-23 06:35:00', 1, NULL, NULL, NULL),
(5, 5, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 06:35:41', '2019-04-23 06:35:41', 1, NULL, NULL, NULL),
(6, 6, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 06:36:49', '2019-04-23 06:36:49', 1, NULL, NULL, NULL),
(7, 3, 'D', 1, '50.00', 1, 'Advance Amount paid to Driver named -', 'A', 6, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 07:24:29', '2019-04-23 07:24:29', 6, NULL, NULL, NULL),
(8, 4, 'D', 2, '50.00', 2, 'Advance Amount paid to Driver named -', 'A', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 07:33:41', '2019-04-23 07:50:52', 7, 10, NULL, NULL),
(9, 1, 'C', NULL, '50000.00', NULL, 'FUND TRANSFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:56:36', '2019-04-22 19:56:36', 10, NULL, NULL, NULL),
(10, 3, 'C', NULL, '50000.00', NULL, 'FUND TRANSFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:57:01', '2019-04-22 19:57:01', 10, NULL, NULL, NULL),
(11, 4, 'C', NULL, '50000.00', NULL, 'FUND TRANSFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:57:19', '2019-04-22 19:57:19', 10, NULL, NULL, NULL),
(12, 6, 'C', NULL, '50000.00', NULL, 'FUND TRANSFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:57:33', '2019-04-22 19:57:33', 10, NULL, NULL, NULL),
(13, 4, 'C', NULL, '50000.00', NULL, 'FUND TRANSFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:59:08', '2019-04-22 19:59:08', 10, NULL, NULL, NULL),
(14, 6, 'C', NULL, '10000.00', NULL, 'FUND TRASNFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:59:24', '2019-04-22 19:59:24', 10, NULL, NULL, NULL),
(15, 2, 'C', NULL, '50000.00', NULL, 'FUND TRANSFER', 'BG', 10, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-22 19:59:37', '2019-04-22 19:59:37', 10, NULL, NULL, NULL),
(16, 4, 'D', 3, '2500.00', 5, 'Advance Amount paid to Driver named -', 'A', 7, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:02:04', '2019-04-23 08:02:04', 7, NULL, NULL, NULL),
(17, 3, 'D', 4, '550.00', 3, 'Advance Amount paid to Driver named -', 'A', 6, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:04:54', '2019-04-23 08:04:54', 6, NULL, NULL, NULL),
(18, 4, 'D', 5, '50.00', 6, 'Advance Amount paid to Driver named -', 'A', 7, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:05:53', '2019-04-23 08:05:53', 7, NULL, NULL, NULL),
(19, 5, 'D', 6, '100.00', 7, 'Advance Amount paid to Driver named -', 'A', 8, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:16:39', '2019-04-23 08:16:39', 8, NULL, NULL, NULL),
(20, 4, 'D', 7, '5859.00', 8, 'Advance Amount paid to Driver named -', 'A', 7, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:17:38', '2019-04-23 08:49:01', 7, 7, NULL, NULL),
(21, 2, 'D', 8, '1750.00', 4, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:18:41', '2019-04-23 08:18:41', 5, NULL, NULL, NULL),
(22, 1, 'D', 9, '2000.00', 11, 'Advance Amount paid to Driver named JITENDER', 'A', 4, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:33:57', '2019-04-23 09:10:37', 4, NULL, NULL, NULL),
(23, 4, 'D', NULL, '50000.00', NULL, 'FOR DAILY EXPENSES', 'M', 7, 'Approved', 'OK', 10, '2019-04-22 20:39:32', 'I', 'N', '2019-04-22 20:34:52', '2019-04-23 08:39:32', 7, NULL, NULL, NULL),
(24, 2, 'D', 10, '3650.00', 10, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:35:58', '2019-04-23 08:35:58', 5, NULL, NULL, NULL),
(25, 1, 'D', 11, '6850.00', 12, 'Advance Amount paid to Driver named -', 'A', 4, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:45:37', '2019-04-23 08:45:37', 4, NULL, NULL, NULL),
(26, 2, 'D', 12, '2800.00', 13, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:46:11', '2019-04-23 08:49:00', 5, 5, NULL, NULL),
(27, 4, 'D', 13, '10000.00', 14, 'Advance Amount paid to Driver named -', 'A', 7, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:47:10', '2019-04-23 09:10:53', 7, NULL, NULL, NULL),
(28, 1, 'D', 14, '2750.00', 16, 'Advance Amount paid to Driver named -', 'A', 4, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:53:09', '2019-04-23 08:53:09', 4, NULL, NULL, NULL),
(29, 3, 'D', 15, '6200.00', 15, 'Advance Amount paid to Driver named -', 'A', 6, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 08:55:46', '2019-04-23 08:55:46', 6, NULL, NULL, NULL),
(30, 2, 'D', 16, '4150.00', 17, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 09:00:22', '2019-04-23 09:00:22', 5, NULL, NULL, NULL),
(31, 2, 'D', 17, '3100.00', 18, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:00:30', '2019-04-23 23:00:30', 5, NULL, NULL, NULL),
(32, 2, 'D', 18, '5150.00', 19, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:38:15', '2019-04-23 23:40:03', 5, 5, NULL, NULL),
(33, 2, 'D', 19, '1750.00', 20, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:43:31', '2019-04-23 23:43:31', 5, NULL, NULL, NULL),
(34, 2, 'D', 20, '3150.00', 21, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-23 23:49:24', '2019-04-23 23:49:24', 5, NULL, NULL, NULL),
(35, 2, 'D', 21, '1750.00', 22, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-24 00:02:39', '2019-04-24 00:02:39', 5, NULL, NULL, NULL),
(36, 2, 'D', 22, '3650.00', 23, 'Advance Amount paid to Driver named -', 'A', 5, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-04-24 00:15:16', '2019-04-24 00:15:16', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_plant_journal_lasers_edit_requests`
--

CREATE TABLE `ss_plant_journal_lasers_edit_requests` (
  `id` bigint(20) NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `trip_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trips''',
  `plant_journal_laser_id` bigint(20) NOT NULL COMMENT 'primary key of ''plant_journal_lasers''',
  `truck_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trucks''',
  `request_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `actual_amount` bigint(20) NOT NULL,
  `requested_amount` bigint(20) NOT NULL,
  `approved_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `approved_on` timestamp NULL DEFAULT NULL,
  `approval_status` enum('Pending','Approved','Disapproved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `approval_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_plant_journal_lasers_edit_requests`
--

INSERT INTO `ss_plant_journal_lasers_edit_requests` (`id`, `plant_id`, `trip_id`, `plant_journal_laser_id`, `truck_id`, `request_by`, `actual_amount`, `requested_amount`, `approved_by`, `approved_on`, `approval_status`, `approval_reason`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 9, 22, 11, 4, 2450, 2000, 10, '2019-04-22 21:10:36', 'Approved', 'OK', 'I', 'N', '2019-04-23 08:34:16', '2019-04-23 09:10:36', 4, NULL, NULL, NULL),
(2, 4, 13, 27, 14, 7, 13100, 10000, 10, '2019-04-22 21:10:53', 'Approved', 'NOT OK', 'I', 'N', '2019-04-23 09:09:30', '2019-04-23 09:10:53', 7, NULL, NULL, NULL),
(3, 4, 5, 18, 6, 7, 50, 2500, 10, '2019-04-22 21:11:37', 'Disapproved', 'NOT OK', 'I', 'N', '2019-04-23 09:11:21', '2019-04-23 09:12:03', 7, 7, NULL, NULL),
(4, 4, 5, 18, 6, 7, 50, 3500, 10, '2019-04-22 21:12:15', 'Disapproved', 'NOT OK', 'I', 'N', '2019-04-23 09:12:03', '2019-04-23 09:12:15', 7, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_plant_user_relations`
--

CREATE TABLE `ss_plant_user_relations` (
  `id` bigint(20) NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `user_id` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `is_deleted` enum('Y','N') DEFAULT 'N' COMMENT 'Y=yes, N=no',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ss_plant_user_relations`
--

INSERT INTO `ss_plant_user_relations` (`id`, `plant_id`, `user_id`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 4, 'N', '2019-04-23 06:37:42', 1, '2019-04-23 06:37:42', NULL, NULL),
(2, 2, 5, 'N', '2019-04-23 06:38:40', 1, '2019-04-23 06:38:40', NULL, NULL),
(3, 3, 6, 'N', '2019-04-23 06:39:56', 1, '2019-04-23 06:39:56', NULL, NULL),
(4, 4, 7, 'N', '2019-04-23 06:41:06', 1, '2019-04-23 06:41:06', NULL, NULL),
(5, 5, 8, 'N', '2019-04-23 06:42:13', 1, '2019-04-23 06:42:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_roles`
--

CREATE TABLE `ss_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) NOT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_roles`
--

INSERT INTO `ss_roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_by`, `deleted_at`) VALUES
(1, 'Admin', 'web', '2019-04-07 18:30:00', '2019-04-07 18:30:00', 1, 1, NULL, NULL),
(2, 'Accountant', 'web', '2019-04-08 05:07:40', '2019-04-08 05:07:40', 1, 1, NULL, NULL),
(3, 'Supervisor', 'web', '2019-04-08 05:07:47', '2019-04-08 05:07:47', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_role_has_permissions`
--

CREATE TABLE `ss_role_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key of ss_permissions',
  `role_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key of ss_roles'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_role_has_permissions`
--

INSERT INTO `ss_role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1),
(17, 1),
(18, 1),
(19, 1),
(20, 1),
(21, 1),
(22, 1),
(23, 1),
(24, 1),
(25, 1),
(26, 1),
(27, 1),
(28, 1),
(29, 1),
(30, 1),
(31, 1),
(32, 1),
(33, 1),
(34, 1),
(35, 1),
(36, 1),
(37, 1),
(38, 1),
(39, 1),
(40, 1),
(41, 1),
(42, 1),
(43, 1),
(44, 1),
(45, 1),
(46, 1),
(47, 1),
(48, 1),
(49, 1),
(50, 1),
(51, 1),
(52, 1),
(53, 1),
(54, 1),
(55, 1),
(56, 1),
(57, 1),
(58, 1),
(59, 1),
(60, 1),
(61, 1),
(62, 1),
(63, 1),
(64, 1),
(65, 1),
(66, 1),
(67, 1),
(68, 1),
(69, 1),
(70, 1),
(71, 1),
(72, 1),
(73, 2),
(74, 2),
(75, 2),
(76, 2),
(77, 2),
(78, 2),
(79, 2),
(80, 2),
(81, 2),
(82, 2),
(83, 2),
(84, 2),
(85, 2),
(86, 2),
(87, 2),
(88, 2),
(89, 2),
(90, 2),
(91, 2),
(92, 2),
(93, 2),
(94, 2),
(95, 2),
(96, 2),
(97, 2),
(98, 2),
(99, 2),
(100, 2),
(101, 2),
(102, 2),
(103, 2),
(104, 2),
(105, 2),
(106, 2),
(107, 2),
(108, 2),
(109, 2),
(110, 2),
(111, 2),
(112, 2),
(113, 2),
(114, 2),
(115, 2),
(116, 2),
(117, 2),
(118, 2),
(119, 2),
(120, 2),
(121, 2),
(122, 2),
(123, 2),
(124, 2),
(125, 2),
(126, 2),
(127, 2),
(128, 2),
(129, 2),
(130, 2),
(131, 2),
(132, 2),
(133, 2),
(134, 2),
(135, 2),
(136, 2),
(230, 3),
(231, 3),
(232, 3),
(233, 3),
(234, 3),
(235, 3),
(236, 3),
(237, 3),
(238, 3),
(239, 3),
(240, 3),
(241, 3),
(242, 3),
(243, 3),
(244, 3),
(245, 3),
(246, 3),
(247, 3),
(248, 3),
(249, 3),
(250, 3),
(251, 3),
(252, 3),
(253, 3),
(254, 3),
(255, 3),
(256, 3),
(257, 3),
(258, 3);

-- --------------------------------------------------------

--
-- Table structure for table `ss_states`
--

CREATE TABLE `ss_states` (
  `id` bigint(20) NOT NULL,
  `country_id` bigint(20) NOT NULL COMMENT 'primary key of ''countries''',
  `state_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state_code` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_trips`
--

CREATE TABLE `ss_trips` (
  `id` bigint(20) NOT NULL,
  `trip_date` timestamp NULL DEFAULT NULL,
  `lr_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) NOT NULL COMMENT 'primary key of ''categories''',
  `subcategory_id` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'primary key of ''subcategories''',
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `invoice_challan_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `do_shipment_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `party_id` bigint(20) NOT NULL COMMENT 'primary key of ''parties''',
  `vendor_id` bigint(20) NOT NULL COMMENT 'primary key of ''vendors''',
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `quantity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'in Metric Ton',
  `truck_owner` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_driver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_driver_phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_driver_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `petrol_pump_id` bigint(20) NOT NULL COMMENT 'primary key of ''petrol_pumps''',
  `advance_amount` bigint(20) NOT NULL,
  `diesel_amount` bigint(20) NOT NULL,
  `trip_status` enum('Awaiting','Running','Cancelled','Settled','Unsettled','Completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Awaiting' COMMENT '''Awaiting'',''Running'',''Cancelled'',''Settled'',''Unsettled'',''Completed''',
  `GPS_trip_status` enum('Start','End') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Start',
  `POD_status` enum('No','Yes','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `current_challan_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `POD_uploaded_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `POD_uploaded_at` timestamp NULL DEFAULT NULL,
  `bags` int(11) DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `closed_at` timestamp NULL DEFAULT NULL,
  `closed_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `closing_reason` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_trips`
--

INSERT INTO `ss_trips` (`id`, `trip_date`, `lr_no`, `category_id`, `subcategory_id`, `plant_id`, `invoice_challan_no`, `do_shipment_no`, `party_id`, `vendor_id`, `truck_id`, `quantity`, `truck_owner`, `truck_driver_name`, `truck_driver_phone_number`, `truck_driver_email`, `petrol_pump_id`, `advance_amount`, `diesel_amount`, `trip_status`, `GPS_trip_status`, `POD_status`, `current_challan_status`, `POD_uploaded_by`, `POD_uploaded_at`, `bags`, `remarks`, `description`, `additional1`, `additional2`, `additional3`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `closed_at`, `closed_by`, `closing_reason`) VALUES
(1, '2019-04-22 07:24:29', 'SSL%2F9056', 4, '4', 3, 'WB1905006385', '3001437209', 1, 1, 1, '10', 'KALI MATA HARDWARE', '-', NULL, NULL, 1, 50, 0, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '06W', 'OL', '-', 'A', 'N', '2019-04-23 07:24:29', '2019-04-23 07:24:29', 6, NULL, NULL, NULL, NULL, NULL, NULL),
(2, '2019-04-22 07:50:51', 'SSL%2F9056', 4, '13', 4, 'WB1905006385', '5108418390', 2, 2, 2, '21', 'ROHIT SINGH', '-', '9804640747', 'RAJPUTROHIT01@GMAIL.COM', 2, 50, 5000, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '06W', 'OL', 'COSSIPORE ROAD', 'A', 'N', '2019-04-23 07:33:41', '2019-04-23 07:50:51', 7, 10, NULL, NULL, NULL, NULL, NULL),
(3, '2019-04-22 08:02:03', '-', 4, '13', 4, '-', '5108418391', 4, 2, 5, '4', 'ROHIT SINGH', '-', NULL, NULL, 2, 2500, 14253, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '-', '-', '-', 'A', 'N', '2019-04-23 08:02:03', '2019-04-23 08:02:03', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2019-04-23 08:04:54', 'SSL%2F9061', 4, '4', 3, 'WB1905006443', '3001437279', 1, 1, 3, '6', 'KALI MATA HARDWARE', '-', NULL, NULL, 1, 550, 0, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '10W', 'OL', 'NONE', 'A', 'N', '2019-04-23 08:04:54', '2019-04-23 08:04:54', 6, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2019-04-22 08:05:53', '-', 4, '13', 4, '-', '5108416224', 5, 2, 6, '16', 'ROHIT SINGH', '-', NULL, NULL, 2, 50, 14253, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '-', '-', '-', 'A', 'N', '2019-04-23 08:05:53', '2019-04-23 08:05:53', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(6, '2019-04-22 08:16:39', '-', 4, '20', 5, '-', '-', 7, 3, 7, '18', 'LALAN KUMAR SHAW', '-', NULL, NULL, 3, 100, 1000, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '-', '-', '-', 'A', 'N', '2019-04-23 08:16:39', '2019-04-23 08:16:39', 8, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2019-04-23 08:49:01', '-', 4, '13', 4, '-', '5108420116', 8, 2, 8, '16', 'ROHIT SINGH', '-', NULL, NULL, 2, 5859, 5256, 'Completed', 'End', 'Yes', NULL, 7, '2019-04-23 08:51:47', NULL, NULL, '-', '-', '-', '-', 'A', 'N', '2019-04-23 08:17:37', '2019-04-23 08:52:58', 7, 7, NULL, NULL, '2019-04-23 08:52:58', 7, 'COMPLETE TRIP'),
(8, '2019-04-22 08:18:41', 'SSL1892S', 4, '5', 2, '0', '69763001640', 6, 2, 4, '17', 'ROHIT SINGH', '-', NULL, NULL, 4, 1750, 3700, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '-', '-', '-', 'A', 'N', '2019-04-23 08:18:41', '2019-04-23 08:18:41', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2019-04-22 08:33:57', '913%000647', 4, '2', 1, '-', '-', 10, 4, 11, '17', '8170037581', 'JITENDER', NULL, NULL, 5, 2000, 4000, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '06W', '-', '-', 'A', 'N', '2019-04-23 08:33:57', '2019-04-23 09:10:36', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(10, '2019-04-22 08:35:58', 'SSL1892A', 4, '5', 2, '0', '6976300163', 11, 5, 10, '22', NULL, '-', NULL, NULL, 4, 3650, 3500, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '22MT, KHG-KHARAGPUR	UTCL', '-', '-', '-', 'A', 'N', '2019-04-23 08:35:58', '2019-04-23 08:35:58', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2019-04-22 08:45:37', '913%000635', 4, '2', 1, '-', '-', 12, 6, 12, '17', NULL, '-', NULL, NULL, 5, 6850, 0, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '06W', '-', '-', 'A', 'N', '2019-04-23 08:45:37', '2019-04-23 08:45:37', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(12, '2019-04-22 08:49:00', 'SSL....1876........', 4, '5', 2, '0', '6976300355', 13, 7, 13, '17', NULL, '-', NULL, 'null', 4, 2800, 2200, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT BAGNAN	NIBEDITA BUILDING MATERIAL SUP', '2019-04-22 20:38:55.0', '-', '-', 'A', 'N', '2019-04-23 08:46:11', '2019-04-23 08:49:00', 5, 5, NULL, NULL, NULL, NULL, NULL),
(13, '2019-04-23 08:47:10', '-', 4, '13', 4, '-', '5108406963', 14, 9, 14, '21', '-', '-', NULL, NULL, 2, 10000, 2562, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '-', '-', '-', 'A', 'N', '2019-04-23 08:47:10', '2019-04-23 09:10:53', 7, NULL, NULL, NULL, NULL, NULL, NULL),
(14, '2019-04-22 08:53:09', '913%000651', 4, '2', 1, '-', '-', 15, 2, 16, '21', 'ROHIT SINGH', '-', NULL, NULL, 5, 2750, 3000, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '-', '12W', '-', '-', 'A', 'N', '2019-04-23 08:53:09', '2019-04-23 08:53:09', 4, NULL, NULL, NULL, NULL, NULL, NULL),
(15, '2019-04-22 08:55:46', 'SSL%2F9058', 4, '4', 3, 'WB1905006502', '3001437263-O', 16, 8, 15, '16', 'AZHARUDDIN MONDAL', '-', '9007759038', 'info@sslogistics.org', 1, 6200, 10000, 'Completed', 'End', 'Yes', NULL, 6, '2019-04-23 09:09:17', NULL, NULL, '-', '10W', 'OL', '11/5/1 cossipore road kolkata-700002', 'A', 'N', '2019-04-23 08:55:46', '2019-04-23 09:09:17', 6, 6, NULL, NULL, '2019-04-23 09:08:42', 6, 'COMPLETE TRIP'),
(16, '2019-04-22 09:00:22', 'SSL....1897......', 4, '5', 2, '0', '6976300520', 17, 10, 17, '17', NULL, '-', NULL, NULL, 4, 4150, 0, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT HALDIA	JEET BUILDERS', '2019-04-22 20:29:11.0', '-', '-', 'A', 'N', '2019-04-23 09:00:22', '2019-04-23 09:00:22', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(17, '2019-04-22 23:00:30', 'SSL......3557.....', 4, '5', 2, '0', '6976300828', 18, 11, 18, '17', NULL, '-', NULL, NULL, 4, 3100, 0, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT HOWRAH	KOLKATA CEMENT UDYOG', '2019-04-23 19:48:32.0', '-', '-', 'A', 'N', '2019-04-23 23:00:30', '2019-04-23 23:00:30', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(18, '2019-04-22 23:40:03', 'SSL....1748........', 4, '5', 2, '0', '6976300402', 20, 12, 19, '17', NULL, '-', NULL, 'null', 4, 5150, 0, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT  KHEJURI	SAHOO BUILDERS', '2019-04-23 00:08:41.0', '-', '-', 'A', 'N', '2019-04-23 23:38:15', '2019-04-23 23:40:03', 5, 5, NULL, NULL, NULL, NULL, NULL),
(19, '2019-04-22 23:43:31', 'SSL3553A', 4, '5', 2, '0', '6976300508', 21, 2, 20, '17', 'ROHIT SINGH', '-', NULL, NULL, 4, 1750, 3700, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT, KHARAGPUR	MANDAL ENTERPRISE', '2019-04-23 07:37:39.0', '-', '-', 'A', 'N', '2019-04-23 23:43:31', '2019-04-23 23:43:31', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(20, '2019-04-22 23:49:24', 'SSL...3556.......', 4, '5', 2, '0', '6976300499', 22, 13, 21, '17', NULL, '-', NULL, NULL, 4, 3150, 3500, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT, MIDNAPORE	SRI SRI MAA HARDWARE', '2019-04-23 16:34:54.0', '-', '-', 'A', 'N', '2019-04-23 23:49:24', '2019-04-23 23:49:24', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(21, '2019-04-23 00:02:39', 'SSL3552W', 4, '5', 2, '0', '6976300501', 24, 2, 22, '17', 'ROHIT SINGH', '-', NULL, NULL, 4, 1750, 5100, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT JHARGRAM	SAHU SUPPLIERS', '2019-04-23 08:16:10.0', '-', '-', 'A', 'N', '2019-04-24 00:02:39', '2019-04-24 00:02:39', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(22, '2019-04-23 00:15:16', 'SSL....3555......', 4, '7', 2, '0', '6976300822', 25, 14, 23, '17', 'TANMOY MONDAL', '-', NULL, NULL, 4, 3650, 4800, 'Running', 'Start', 'No', NULL, NULL, NULL, NULL, NULL, '17MT, PRATAPDIGHI	PAPAI ENTERPRISE', '2019-04-23 17:08:28.0', '-', '-', 'A', 'N', '2019-04-24 00:15:16', '2019-04-24 00:15:16', 5, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_trip_payment_managements`
--

CREATE TABLE `ss_trip_payment_managements` (
  `id` bigint(20) NOT NULL,
  `trip_id` bigint(20) NOT NULL COMMENT 'primary key of ''trips''',
  `freight_charge` float(10,2) DEFAULT NULL,
  `toll` float(10,2) DEFAULT NULL,
  `unloading_charge` float(10,2) DEFAULT NULL,
  `tare_charge` float(10,2) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  `short_bag_amount` float(10,2) DEFAULT NULL,
  `balance` float(10,2) DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_trip_payment_managements`
--

INSERT INTO `ss_trip_payment_managements` (`id`, `trip_id`, `freight_charge`, `toll`, `unloading_charge`, `tare_charge`, `rate`, `short_bag_amount`, `balance`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 15, 8133.00, 253.00, 200.00, 0.00, 480, 320.00, -8387.00, 'A', 'N', '2019-04-23 09:11:44', '2019-04-23 09:11:44', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_trip_POD`
--

CREATE TABLE `ss_trip_POD` (
  `id` bigint(20) NOT NULL,
  `trip_id` bigint(20) NOT NULL COMMENT 'primary key of ''trips''',
  `pod_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','OK CHALLAN','UNSTAMPED CHALLAN','STAMPED SHORT CHALLAN','UNSTAMPED SHORT CHALLAN') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
  `is_active` enum('Y','N') NOT NULL DEFAULT 'Y' COMMENT 'Y=yes, N=no',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `reason` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ss_trip_POD`
--

INSERT INTO `ss_trip_POD` (`id`, `trip_id`, `pod_file`, `status`, `is_active`, `updated_by`, `reason`, `created_at`, `updated_at`) VALUES
(1, 7, 'pod_1556029306.pdf', 'Pending', 'Y', NULL, NULL, '2019-04-23 08:51:47', '2019-04-23 08:51:47'),
(2, 15, 'pod_1556030357.xlsx', 'Pending', 'Y', NULL, NULL, '2019-04-23 09:09:17', '2019-04-23 09:09:17');

-- --------------------------------------------------------

--
-- Table structure for table `ss_trucks`
--

CREATE TABLE `ss_trucks` (
  `id` bigint(20) NOT NULL,
  `vendor_id` bigint(20) NOT NULL COMMENT 'primary key of ''vendors''',
  `type` enum('C','M') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'C = Company, M = Market',
  `truck_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_trucks`
--

INSERT INTO `ss_trucks` (`id`, `vendor_id`, `type`, `truck_no`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'M', 'WB-15B-4750', 'A', 'N', '2019-04-23 07:10:45', '2019-04-23 07:10:45', 6, NULL, NULL, NULL),
(2, 2, 'M', 'WB-23E-1670', 'A', 'N', '2019-04-23 07:28:25', '2019-04-23 07:28:25', 7, NULL, NULL, NULL),
(3, 1, 'M', 'WB-41B-9853', 'A', 'N', '2019-04-23 07:35:07', '2019-04-23 07:35:07', 6, NULL, NULL, NULL),
(4, 2, 'M', 'WB-23E-8330', 'A', 'N', '2019-04-23 07:52:55', '2019-04-23 07:52:55', 5, NULL, NULL, NULL),
(5, 2, 'M', 'WB-23E-9295', 'A', 'N', '2019-04-23 08:00:02', '2019-04-23 08:00:02', 7, NULL, NULL, NULL),
(6, 2, 'M', 'WB-23D-5446', 'A', 'N', '2019-04-23 08:03:54', '2019-04-23 08:03:54', 7, NULL, NULL, NULL),
(7, 3, 'M', 'WB-23E-8536', 'A', 'N', '2019-04-23 08:08:04', '2019-04-23 08:08:04', 8, NULL, NULL, NULL),
(8, 2, 'M', 'WB-23E-7826', 'A', 'N', '2019-04-23 08:08:59', '2019-04-23 08:08:59', 7, NULL, NULL, NULL),
(9, 2, 'M', 'WB-19F-0276', 'A', 'N', '2019-04-23 08:24:02', '2019-04-23 08:24:02', 8, NULL, NULL, NULL),
(10, 5, 'M', 'WB-23D-0624', 'A', 'N', '2019-04-23 08:32:27', '2019-04-23 08:32:27', 5, NULL, NULL, NULL),
(11, 4, 'M', 'WB-11D-2065', 'A', 'N', '2019-04-23 08:33:13', '2019-04-23 08:33:13', 4, NULL, NULL, NULL),
(12, 6, 'M', 'WB-29A-4123', 'A', 'N', '2019-04-23 08:39:33', '2019-04-23 08:39:33', 4, NULL, NULL, NULL),
(13, 7, 'M', 'WB-23B-6117', 'A', 'N', '2019-04-23 08:42:52', '2019-04-23 08:42:52', 5, NULL, NULL, NULL),
(14, 9, 'M', 'WB-11D-1033', 'A', 'N', '2019-04-23 08:45:46', '2019-04-23 08:45:46', 7, NULL, NULL, NULL),
(15, 8, 'M', 'WB-31A-4696', 'A', 'N', '2019-04-23 08:46:42', '2019-04-23 08:46:42', 6, NULL, NULL, NULL),
(16, 2, 'M', 'WB-23D-7660', 'A', 'N', '2019-04-23 08:47:49', '2019-04-23 08:47:49', 4, NULL, NULL, NULL),
(17, 10, 'M', 'WB-23B-0739', 'A', 'N', '2019-04-23 08:57:46', '2019-04-23 08:57:46', 5, NULL, NULL, NULL),
(18, 11, 'M', 'WB-23C-2323', 'A', 'N', '2019-04-23 22:58:12', '2019-04-23 22:58:12', 5, NULL, NULL, NULL),
(19, 12, 'M', 'WB-23E-5869', 'A', 'N', '2019-04-23 23:16:14', '2019-04-23 23:16:14', 5, NULL, NULL, NULL),
(20, 2, 'M', 'WB-23E-9288', 'A', 'N', '2019-04-23 23:41:36', '2019-04-23 23:41:36', 5, NULL, NULL, NULL),
(21, 13, 'M', 'WB-11B-8252', 'A', 'N', '2019-04-23 23:47:58', '2019-04-23 23:47:58', 5, NULL, NULL, NULL),
(22, 2, 'M', 'WB-23E-8930', 'A', 'N', '2019-04-23 23:59:10', '2019-04-23 23:59:10', 5, NULL, NULL, NULL),
(23, 14, 'M', 'WB-59B-8145', 'A', 'N', '2019-04-24 00:13:50', '2019-04-24 00:13:50', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_insurances`
--

CREATE TABLE `ss_truck_insurances` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `policy_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `policy_on` timestamp NULL DEFAULT NULL,
  `policy_start` timestamp NULL DEFAULT NULL,
  `policy_end` timestamp NULL DEFAULT NULL,
  `policy_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `read_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_permits`
--

CREATE TABLE `ss_truck_permits` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `permit_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permit_on` timestamp NULL DEFAULT NULL,
  `permit_start` timestamp NULL DEFAULT NULL,
  `permit_end` timestamp NULL DEFAULT NULL,
  `permit_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `read_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_pollutions`
--

CREATE TABLE `ss_truck_pollutions` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `pollution_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pollution_on` timestamp NULL DEFAULT NULL,
  `pollution_start` timestamp NULL DEFAULT NULL,
  `pollution_end` timestamp NULL DEFAULT NULL,
  `pollution_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `read_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_registrations`
--

CREATE TABLE `ss_truck_registrations` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `registration_no` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_on` timestamp NULL DEFAULT NULL,
  `registration_start` timestamp NULL DEFAULT NULL,
  `registration_end` timestamp NULL DEFAULT NULL,
  `registration_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `read_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_truck_registrations`
--

INSERT INTO `ss_truck_registrations` (`id`, `truck_id`, `registration_no`, `name`, `registered_on`, `registration_start`, `registration_end`, `registration_file`, `status`, `read_status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 07:10:45', '2019-04-23 07:10:45', 6, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 07:28:25', '2019-04-23 07:28:25', 7, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 07:35:07', '2019-04-23 07:35:07', 6, NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 07:52:55', '2019-04-23 07:52:55', 5, NULL, NULL, NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:00:02', '2019-04-23 08:00:02', 7, NULL, NULL, NULL),
(6, 6, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:03:54', '2019-04-23 08:03:54', 7, NULL, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:08:05', '2019-04-23 08:08:05', 8, NULL, NULL, NULL),
(8, 8, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:08:59', '2019-04-23 08:08:59', 7, NULL, NULL, NULL),
(9, 9, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:24:02', '2019-04-23 08:24:02', 8, NULL, NULL, NULL),
(10, 10, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:32:27', '2019-04-23 08:32:27', 5, NULL, NULL, NULL),
(11, 11, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:33:13', '2019-04-23 08:33:13', 4, NULL, NULL, NULL),
(12, 12, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:39:33', '2019-04-23 08:39:33', 4, NULL, NULL, NULL),
(13, 13, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:42:52', '2019-04-23 08:42:52', 5, NULL, NULL, NULL),
(14, 14, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:45:46', '2019-04-23 08:45:46', 7, NULL, NULL, NULL),
(15, 15, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:46:42', '2019-04-23 08:46:42', 6, NULL, NULL, NULL),
(16, 16, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:47:49', '2019-04-23 08:47:49', 4, NULL, NULL, NULL),
(17, 17, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 08:57:46', '2019-04-23 08:57:46', 5, NULL, NULL, NULL),
(18, 18, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 22:58:13', '2019-04-23 22:58:13', 5, NULL, NULL, NULL),
(19, 19, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 23:16:14', '2019-04-23 23:16:14', 5, NULL, NULL, NULL),
(20, 20, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 23:41:36', '2019-04-23 23:41:36', 5, NULL, NULL, NULL),
(21, 21, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 23:47:58', '2019-04-23 23:47:58', 5, NULL, NULL, NULL),
(22, 22, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-23 23:59:10', '2019-04-23 23:59:10', 5, NULL, NULL, NULL),
(23, 23, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-04-24 00:13:50', '2019-04-24 00:13:50', 5, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_taxes`
--

CREATE TABLE `ss_truck_taxes` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `invoice_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_paid_date` timestamp NULL DEFAULT NULL,
  `tax_period_start` timestamp NULL DEFAULT NULL,
  `tax_period_end` timestamp NULL DEFAULT NULL,
  `tax_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `read_status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `ss_users`
--

CREATE TABLE `ss_users` (
  `id` bigint(20) NOT NULL,
  `user_role_id` bigint(20) DEFAULT '1' COMMENT 'primary key ''user_roles''',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` mediumtext COLLATE utf8mb4_unicode_ci,
  `last_login_ip` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_datetime` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_generated_time` timestamp NULL DEFAULT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_users`
--

INSERT INTO `ss_users` (`id`, `user_role_id`, `username`, `password`, `full_name`, `phone_number`, `profile_picture`, `last_login_ip`, `last_login_datetime`, `remember_token`, `token_generated_time`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'admin@sslogistic.com', '$2y$10$AQG8m8dNVRM9UYCzH7MCX.oYuGeCOlOzFhz0ybLH5WxoJ3N/9sp4S', 'Admin', '9876543210', 'image_1554722261.jpeg', '', '2019-04-24 00:15:22', NULL, NULL, 'A', 'N', '2019-04-07 13:00:00', '2019-04-24 00:15:22', 0, 1, NULL, NULL),
(2, 2, 'accountant@yopmail.com', '$2y$10$wOMk9YwKoAVCtXjFexgHNuf6pj3ysHw6NnN/ldO2o9vfyGeULvaFa', 'Accountant', '345456445', NULL, '', '2019-04-23 06:28:19', NULL, NULL, 'A', 'N', '2019-04-08 02:21:09', '2019-04-23 06:28:19', 1, 2, NULL, NULL),
(3, 3, 'supervisor@yopmail.com', '$2y$10$3ehRXOv3BDVKcZBaRD5y6eBo9j.wEGSKKFpbY7luxgVa1qyGzW5WW', 'Supervisor ', '121321321', NULL, '', '2019-04-11 00:14:45', NULL, NULL, 'A', 'N', '2019-04-08 02:21:49', '2019-04-22 12:04:02', 1, 1, NULL, NULL),
(4, 3, 'BIDYUTLAMA@GMAIL.COM', '$2y$10$eICXNUb6fz6SB5./QhIY3OjZSqW9ZABE21EDtlnqYr/uoDYpdESNm', 'BIDYUT LAMA', '8759561321', 'image_1556021396.jpg', '', '2019-04-23 23:21:21', NULL, NULL, 'A', 'N', '2019-04-23 06:37:42', '2019-04-23 23:21:21', 1, 4, NULL, NULL),
(5, 3, 'IMD145454@GMAIL.COM', '$2y$10$yeuFguOoBLgnJd0cPxOam.zEBC3Oazc8u7tROMa1rZD5LbseqlZ1q', 'MD IMRAN', '9883799158', NULL, '', '2019-04-23 22:36:08', NULL, NULL, 'A', 'N', '2019-04-23 06:38:40', '2019-04-23 22:36:08', 1, 1, NULL, NULL),
(6, 3, 'NISHAHELA8017@GMAIL.COM', '$2y$10$8sT3OeKkqvMTY3r2Siudn.ehnsPq4sYK50rix5TbUwVw/eb3MGsZe', 'NISHA HELA', '8017476057', NULL, '', '2019-04-23 23:46:56', NULL, NULL, 'A', 'N', '2019-04-23 06:39:56', '2019-04-23 23:46:56', 1, 1, NULL, NULL),
(7, 3, 'PS79176@GMAIL.COM', '$2y$10$S/vgwxidK7Pzl7tZgRP0XORIDcMEqs6FPKwZ6LCiTRrBmjNyJwF4.', 'PRASHANT SINGH', '9163767906', NULL, '', '2019-04-23 23:14:22', NULL, NULL, 'A', 'N', '2019-04-23 06:41:06', '2019-04-23 23:14:22', 1, 1, NULL, NULL),
(8, 3, 'PIYUSHAKASH2@GMAIL.COM', '$2y$10$vQywcOX4Sla36N2DGWMfZeURZw.WcqQmMOmzJKTH.OaDZOKZHC55O', 'PIYUSH PRATAP SINGH', '9883474749', 'common_customer_image.jpg', '', '2019-04-24 00:06:50', NULL, NULL, 'A', 'N', '2019-04-23 06:42:12', '2019-04-24 00:06:50', 1, 8, NULL, NULL),
(9, 2, 'MJMANISH00@GMAIL.COM', '$2y$10$yiLdNabVIzFiK3kxtn/4k.qXzmTpWlCGO2ix.qqlxKBRzDSRmL6KC', 'MANISH KUMAR JHA', '8442929537', NULL, '', '2019-04-23 06:43:21', NULL, NULL, 'A', 'N', '2019-04-23 06:42:58', '2019-04-23 06:43:21', 1, 1, NULL, NULL),
(10, 2, 'SHAWSANJAYKUMAR89@GMAIL.COM', '$2y$10$Z8TwzZpq3VnkIW7jha.oyOc/99vr2bjNKs2se3.fM9MdIrcTJRiSe', 'SANJAY KUMAR SHAW', '9051571351', NULL, '', '2019-04-23 06:45:55', NULL, NULL, 'A', 'N', '2019-04-23 06:43:54', '2019-04-23 06:45:55', 1, 1, NULL, NULL),
(11, 1, 'PRITHA.GUPTA.17@GMAIL.COM', '$2y$10$EKdjqZNUBenaqF97/9B.FuiYehzlxw5gWBwwnGDsUY4dGQsAEEGAm', 'PRITHA GUPTA', '8017818996', NULL, '', '2019-04-23 23:45:46', NULL, NULL, 'A', 'N', '2019-04-23 06:45:00', '2019-04-23 23:45:46', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_vendors`
--

CREATE TABLE `ss_vendors` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_no` bigint(20) NOT NULL,
  `account_holder_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('A','I','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Active, I=Inactive, D=Delete',
  `is_deleted` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `updated_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `deleted_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users'''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ss_vendors`
--

INSERT INTO `ss_vendors` (`id`, `name`, `contact_person`, `contact_number`, `contact_email`, `pan_number`, `bank_name`, `ifsc_code`, `account_no`, `account_holder_name`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'KALI MATA HARDWARE', 'KALI MATA HARDWARE', '9732528959', NULL, 'AOYPM9917Q', 'ALLAHABAD BANK', 'ALLA0212342', 50237200861, 'KALIMATA HARWARE', 'A', 'N', '2019-04-23 07:10:11', '2019-04-23 07:10:11', 6, NULL, NULL, NULL),
(2, 'SSLOGISTICS', 'ROHIT SINGH', '9804640747', 'ROHIT.SINGH@SSLOGISTICS.ORG', 'ACFFS8681L', 'HDFC BANK LIMITED', 'HDFC0004481', 1742560002760, 'S S LOGISTICS', 'A', 'N', '2019-04-23 07:14:19', '2019-04-23 07:14:19', 1, NULL, NULL, NULL),
(3, 'LALAN KUMAR SHAW', 'LALAN KUMAR SHAW', '8777292836', NULL, 'BIVPP6728G', 'STATE BANK OF INDIA', 'SBIN0011537', 31524513246, 'LALAN KUMAR SHAW', 'A', 'N', '2019-04-23 08:06:39', '2019-04-23 08:06:39', 8, NULL, NULL, NULL),
(4, 'RAJIV KUMAR SINGH', '8170037581', '8170037581', 'RAJIVKUMARSINGH@GAMAIL.COM', 'CRLPS6042N', 'HDFC', 'HDFC0001065', 50200036729908, 'RAJIV KUMAR SINGH', 'A', 'N', '2019-04-23 08:08:59', '2019-04-23 08:08:59', 4, NULL, NULL, NULL),
(5, 'PRASENJIT DUTTA', NULL, '8013720744', NULL, 'AFLPD2027C', 'UNITED BANK OF INDIA', 'UTBI0000958', 365010106450, 'PROSENJIT DUTTA', 'A', 'N', '2019-04-23 08:31:55', '2019-04-23 08:31:55', 5, NULL, NULL, NULL),
(6, 'SUMIT MONDAL', NULL, NULL, NULL, 'ASKPM0661K', 'BANDHAN BANK', 'BDBL0001409', 10170000036644, 'SUMIT MONDAL', 'A', 'N', '2019-04-23 08:39:02', '2019-04-23 08:39:02', 4, NULL, NULL, NULL),
(7, 'ANKIT KUMAR RAI', NULL, '8420934479', NULL, 'BSWPR9528R', 'UNION BANK OF INDIA', 'UBIN0536105', 361001010033444, 'A K SAREE TRADINGCO', 'A', 'N', '2019-04-23 08:42:25', '2019-04-23 08:42:25', 5, NULL, NULL, NULL),
(8, 'AZHARUDDIN MONDAL', 'AZHARUDDIN MONDAL', '9830098345', 'info@sslogistics.org', 'BHWPM2050A', 'IDBI BANK', 'IBKL0001469', 1469104000017134, 'AZHARUDDIN MONDAL', 'A', 'N', '2019-04-23 08:44:57', '2019-04-23 08:44:57', 6, NULL, NULL, NULL),
(9, 'SHIWA NAND SINGH', '-', NULL, NULL, 'AOYPM9917Q', 'ALLAHABAD BANK', 'SBIN0001201', 50237200861, 'BEHIND HP PETROL PUMP', 'A', 'N', '2019-04-23 08:45:09', '2019-04-23 08:45:09', 7, NULL, NULL, NULL),
(10, 'DIPU DA', NULL, NULL, NULL, 'BJLPB5561N', 'STATE BANK OF INDIA', 'SBIN0008431', 34596518102, 'AVIJIT BHOWMIK', 'A', 'N', '2019-04-23 08:57:20', '2019-04-23 08:57:20', 5, NULL, NULL, NULL),
(11, 'SAMIR GHOSH', NULL, '8910365852', NULL, 'AMXPG6709M', 'STATE BANK OF INDIA', 'SBIN0017365', 36231373586, 'SAMIR GHOSH', 'A', 'N', '2019-04-23 22:57:40', '2019-04-23 22:57:40', 5, NULL, NULL, NULL),
(12, 'ARNAB SARKAR', NULL, NULL, NULL, 'AESSG1235J', 'STATE BANK OF INDIA', 'SBIN0009469', 24523832285, 'ARNAB SARKAR', 'A', 'N', '2019-04-23 23:15:33', '2019-04-23 23:15:33', 5, NULL, NULL, NULL),
(13, 'MD ABDUL HAKIM', NULL, NULL, NULL, 'ABJPH0761P', 'STATE BANK OF INDIA', 'SBIN0012459', 20112173343, 'MD.ABDUL HAKIM', 'A', 'N', '2019-04-23 23:47:27', '2019-04-23 23:47:27', 5, NULL, NULL, NULL),
(14, 'TANMOY MONDAL', 'TANMOY MONDAL', NULL, NULL, 'BXQPM3765A', 'BANK OF INDIA', 'BKID0004081', 408110110002813, 'TANMOY MONDAL', 'A', 'N', '2019-04-24 00:13:08', '2019-04-24 00:13:08', 5, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ss_address_zones`
--
ALTER TABLE `ss_address_zones`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_categories`
--
ALTER TABLE `ss_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_cities`
--
ALTER TABLE `ss_cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_countries`
--
ALTER TABLE `ss_countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_gps_trackings`
--
ALTER TABLE `ss_gps_trackings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_items`
--
ALTER TABLE `ss_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_model_has_permissions`
--
ALTER TABLE `ss_model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `ss_model_has_roles`
--
ALTER TABLE `ss_model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_type_model_id_index` (`model_type`,`model_id`);

--
-- Indexes for table `ss_parties`
--
ALTER TABLE `ss_parties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_party_destinations`
--
ALTER TABLE `ss_party_destinations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_petrol_pumps`
--
ALTER TABLE `ss_petrol_pumps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_petrol_pump_journal_lasers`
--
ALTER TABLE `ss_petrol_pump_journal_lasers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_petrol_pump_journal_lasers_edit_requests`
--
ALTER TABLE `ss_petrol_pump_journal_lasers_edit_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_plants`
--
ALTER TABLE `ss_plants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_plant_addresses`
--
ALTER TABLE `ss_plant_addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_plant_journal_lasers_edit_requests`
--
ALTER TABLE `ss_plant_journal_lasers_edit_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_plant_user_relations`
--
ALTER TABLE `ss_plant_user_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_roles`
--
ALTER TABLE `ss_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_role_has_permissions`
--
ALTER TABLE `ss_role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`);

--
-- Indexes for table `ss_states`
--
ALTER TABLE `ss_states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_trips`
--
ALTER TABLE `ss_trips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_trip_payment_managements`
--
ALTER TABLE `ss_trip_payment_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_trip_POD`
--
ALTER TABLE `ss_trip_POD`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_trucks`
--
ALTER TABLE `ss_trucks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_truck_insurances`
--
ALTER TABLE `ss_truck_insurances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_truck_permits`
--
ALTER TABLE `ss_truck_permits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_truck_pollutions`
--
ALTER TABLE `ss_truck_pollutions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_truck_registrations`
--
ALTER TABLE `ss_truck_registrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_truck_taxes`
--
ALTER TABLE `ss_truck_taxes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_users`
--
ALTER TABLE `ss_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_vendors`
--
ALTER TABLE `ss_vendors`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ss_address_zones`
--
ALTER TABLE `ss_address_zones`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `ss_categories`
--
ALTER TABLE `ss_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ss_cities`
--
ALTER TABLE `ss_cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_countries`
--
ALTER TABLE `ss_countries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_gps_trackings`
--
ALTER TABLE `ss_gps_trackings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_items`
--
ALTER TABLE `ss_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ss_parties`
--
ALTER TABLE `ss_parties`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ss_party_destinations`
--
ALTER TABLE `ss_party_destinations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=259;
--
-- AUTO_INCREMENT for table `ss_petrol_pumps`
--
ALTER TABLE `ss_petrol_pumps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ss_petrol_pump_journal_lasers`
--
ALTER TABLE `ss_petrol_pump_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ss_petrol_pump_journal_lasers_edit_requests`
--
ALTER TABLE `ss_petrol_pump_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ss_plants`
--
ALTER TABLE `ss_plants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ss_plant_addresses`
--
ALTER TABLE `ss_plant_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers_edit_requests`
--
ALTER TABLE `ss_plant_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `ss_plant_user_relations`
--
ALTER TABLE `ss_plant_user_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ss_roles`
--
ALTER TABLE `ss_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_states`
--
ALTER TABLE `ss_states`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trips`
--
ALTER TABLE `ss_trips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ss_trip_payment_managements`
--
ALTER TABLE `ss_trip_payment_managements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ss_trip_POD`
--
ALTER TABLE `ss_trip_POD`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_trucks`
--
ALTER TABLE `ss_trucks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ss_truck_insurances`
--
ALTER TABLE `ss_truck_insurances`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_truck_permits`
--
ALTER TABLE `ss_truck_permits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_truck_pollutions`
--
ALTER TABLE `ss_truck_pollutions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_truck_registrations`
--
ALTER TABLE `ss_truck_registrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `ss_truck_taxes`
--
ALTER TABLE `ss_truck_taxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_users`
--
ALTER TABLE `ss_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_vendors`
--
ALTER TABLE `ss_vendors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
