-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 14, 2018 at 12:06 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sslogistic`
--

-- --------------------------------------------------------

--
-- Table structure for table `ss_app_modules`
--

CREATE TABLE `ss_app_modules` (
  `id` bigint(20) NOT NULL,
  `parent_id` bigint(20) NOT NULL COMMENT 'primary key of ''app_modules''',
  `module_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `picture` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `css_class` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_app_module_functionalities`
--

CREATE TABLE `ss_app_module_functionalities` (
  `id` bigint(20) NOT NULL,
  `app_module_id` bigint(20) NOT NULL COMMENT 'primary key ''app_modules''',
  `function_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `function_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sort_order` int(11) NOT NULL,
  `api_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_categories`
--

CREATE TABLE `ss_categories` (
  `id` bigint(20) NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'test', 'test', 'A', 'N', '2018-08-07 11:21:00', '2018-08-07 11:21:00', 1, NULL, NULL, NULL),
(2, 'test99', 'test99', 'D', 'Y', '2018-08-07 06:02:35', '2018-08-07 06:03:06', 1, NULL, '2018-08-07 06:03:06', 1),
(3, 'test 1 cat', 'test 1 cat', 'A', 'N', '2018-08-07 07:51:32', '2018-08-07 07:51:32', 1, NULL, NULL, NULL),
(4, 'new cat', 'test', 'D', 'Y', '2018-08-08 06:06:29', '2018-08-08 06:12:29', 1, NULL, '2018-08-08 06:12:29', 1),
(5, 'fff', 'ffff', 'A', 'N', '2018-08-10 07:02:08', '2018-08-10 07:02:08', 1, NULL, NULL, NULL),
(6, 'ss', 'ss', 'D', 'Y', '2018-08-13 04:39:21', '2018-08-13 04:39:26', 1, NULL, '2018-08-13 04:39:26', 1);

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

--
-- Dumping data for table `ss_cities`
--

INSERT INTO `ss_cities` (`id`, `country_id`, `state_id`, `city_name`, `city_code`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 1, 'Kolkata', 'KOL', 'A', 'N', '2018-08-07 06:54:36', '2018-08-07 06:54:36', 1, NULL, NULL, NULL),
(2, 1, 1, 'Howrah', 'HWH', 'A', 'N', '2018-08-07 06:54:36', '2018-08-07 06:54:36', 1, NULL, NULL, NULL),
(3, 1, 2, 'Mumbai', 'MUM', 'A', 'N', '2018-08-07 06:55:30', '2018-08-07 06:55:30', 1, NULL, NULL, NULL),
(4, 1, 13, 'Amritsar', 'AMR', 'A', 'N', '2018-08-07 06:55:30', '2018-08-07 02:15:18', 1, NULL, NULL, NULL),
(5, 1, 1, 'd', 'd', 'D', 'N', '2018-08-07 02:02:51', '2018-08-07 02:02:59', 1, NULL, '2018-08-07 02:02:59', 1),
(6, 1, 3, 'Ajanta', 'AJ', 'A', 'N', '2018-08-07 02:27:07', '2018-08-07 03:50:14', 1, NULL, NULL, NULL),
(7, 2, 24, 'Dhaka', 'DH', 'D', 'Y', '2018-08-07 03:50:46', '2018-08-07 04:04:07', 1, NULL, '2018-08-07 04:04:07', 1),
(8, 2, 24, 'sss123', 'ssss1111', 'D', 'Y', '2018-08-07 03:54:17', '2018-08-07 03:54:38', 1, NULL, '2018-08-07 03:54:38', 1),
(9, 2, 24, 'xxx', 'xxx', 'D', 'Y', '2018-08-07 04:03:26', '2018-08-07 04:04:07', 1, NULL, '2018-08-07 04:04:07', 1),
(10, 1, 14, 'Ahmedabad', 'AH', 'A', 'N', '2018-08-07 06:00:02', '2018-08-07 06:00:02', 1, NULL, NULL, NULL),
(11, 1, 1, 'ss', 'ss', 'D', 'Y', '2018-08-13 04:39:09', '2018-08-13 04:39:14', 1, NULL, '2018-08-13 04:39:14', 1);

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

--
-- Dumping data for table `ss_countries`
--

INSERT INTO `ss_countries` (`id`, `country_name`, `country_code`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'India', 'IN', 'A', 'N', '2018-08-02 12:46:21', '2018-08-02 12:46:21', 1, NULL, NULL, NULL),
(2, 'Bangladesh', 'BAN', 'A', 'N', '2018-08-02 12:46:21', '2018-08-02 12:46:21', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_gps_trackings`
--

CREATE TABLE `ss_gps_trackings` (
  `id` bigint(20) NOT NULL,
  `gps_id` bigint(20) NOT NULL,
  `unit_id` bigint(20) NOT NULL,
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
  `item_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 1, 'test item', 'test item', 'A', 'N', '2018-08-07 12:46:27', '2018-08-07 12:46:27', 1, NULL, NULL, NULL),
(2, 1, 'aaaa', 'aaaa', 'D', 'Y', '2018-08-07 07:51:06', '2018-08-07 07:57:17', 1, NULL, '2018-08-07 07:57:17', 1),
(3, 3, 'nnnn123', 'nnnnn123', 'A', 'N', '2018-08-07 07:52:37', '2018-08-07 07:56:06', 1, NULL, NULL, NULL),
(4, 4, 'test1', 'test1', 'D', 'Y', '2018-08-08 06:06:45', '2018-08-08 06:12:29', 1, NULL, '2018-08-08 06:12:29', 1),
(5, 4, 'test2', 'test2', 'D', 'Y', '2018-08-08 06:07:13', '2018-08-08 06:12:29', 1, NULL, '2018-08-08 06:12:29', 1),
(6, 1, 'test item 1234', 'test item', 'A', 'N', '2018-08-09 08:15:51', '2018-08-09 08:15:51', 1, NULL, NULL, NULL),
(7, 3, 'new test 1234', 'nnnnn123', 'A', 'N', '2018-08-09 08:15:51', '2018-08-09 08:15:51', 1, NULL, NULL, NULL),
(8, 3, 'san', 'san', 'A', 'N', '2018-08-09 08:17:21', '2018-08-09 08:17:21', 1, NULL, NULL, NULL),
(9, 1, 'MMSPL', 'MMSPL', 'A', 'N', '2018-08-09 08:17:22', '2018-08-09 08:17:22', 1, NULL, NULL, NULL),
(10, 1, 'Item1', 'Item1', 'A', 'N', '2018-08-09 23:45:10', '2018-08-09 23:45:10', 1, NULL, NULL, NULL),
(11, 3, 'Item2', 'Item2', 'A', 'N', '2018-08-09 23:45:10', '2018-08-09 23:45:10', 1, NULL, NULL, NULL),
(12, 1, 'Item3', 'Item3', 'A', 'N', '2018-08-09 23:45:10', '2018-08-09 23:45:10', 1, NULL, NULL, NULL),
(13, 3, 'Item4', 'Item4', 'A', 'N', '2018-08-09 23:45:11', '2018-08-09 23:45:11', 1, NULL, NULL, NULL),
(14, 3, 'Item6', 'Item6', 'I', 'N', '2018-08-10 00:04:09', '2018-08-10 00:04:09', 1, NULL, NULL, NULL),
(15, 1, 'Item5', 'Item5', 'A', 'N', '2018-08-10 00:04:09', '2018-08-10 00:04:09', 1, NULL, NULL, NULL),
(16, 3, 'Item8', 'Item8', 'A', 'N', '2018-08-10 00:04:09', '2018-08-10 00:04:09', 1, NULL, NULL, NULL),
(17, 1, 'Item7', 'Item7', 'A', 'N', '2018-08-10 00:04:09', '2018-08-10 00:04:09', 1, NULL, NULL, NULL),
(18, 1, 'sssss', 'sssss', 'D', 'Y', '2018-08-13 04:39:35', '2018-08-13 04:39:45', 1, NULL, '2018-08-13 04:39:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ss_parties`
--

CREATE TABLE `ss_parties` (
  `id` bigint(20) NOT NULL,
  `party_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `party_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `ss_parties` (`id`, `party_name`, `party_description`, `phone_number`, `email`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'Test Party Name', 'Test Desc', '21212', 'testparty@ss.com', 'A', 'N', '2018-08-10 11:54:36', '2018-08-10 11:54:36', 1, NULL, NULL, NULL),
(2, 'Test New Party Name ', 'Test Ne wDesc', '6547', 'testnewparty@ss.com', 'A', 'N', '2018-08-10 11:59:36', '2018-08-10 11:59:36', 1, NULL, NULL, NULL),
(3, 'test 10_08_2018', 'test', 'undefined', 'test_10_08_2018@ss.com', 'A', 'N', '2018-08-10 07:24:06', '2018-08-10 07:24:06', 1, NULL, NULL, NULL),
(4, 'Party33', 'Party33', 'undefined', 'party33@ss.com', 'D', 'Y', '2018-08-10 07:44:46', '2018-08-10 07:49:23', 1, NULL, '2018-08-10 07:49:23', 1),
(5, 'Party1', 'Party1', '226547', 'party1@ss.com', 'A', 'N', '2018-08-10 07:44:46', '2018-08-10 07:44:46', 1, NULL, NULL, NULL),
(6, 'Party2', 'Party2', '21212', 'party2@ss.com', 'A', 'N', '2018-08-10 07:44:46', '2018-08-10 07:44:46', 1, NULL, NULL, NULL),
(7, 's', 's', 'undefined', 's@s.com', 'I', 'N', '2018-08-13 04:56:12', '2018-08-13 04:56:12', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_party_destinations`
--

CREATE TABLE `ss_party_destinations` (
  `id` bigint(20) NOT NULL,
  `party_id` bigint(20) NOT NULL COMMENT 'primary key of ''parties''',
  `city_id` bigint(20) NOT NULL COMMENT 'primary key of ''cities''',
  `state_id` bigint(20) NOT NULL COMMENT 'primary key of ''states''',
  `country_id` bigint(20) NOT NULL COMMENT 'primary key of ''countries''',
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Dumping data for table `ss_party_destinations`
--

INSERT INTO `ss_party_destinations` (`id`, `party_id`, `city_id`, `state_id`, `country_id`, `contact_number`, `contact_email`, `contact_person`, `lat`, `lng`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 1, 1, 1, '33698745', 'pd1@ss.com', 'John Smith', '22.54554', '88.54544', 'A', 'N', '2018-08-13 07:30:37', '2018-08-13 07:30:37', 1, NULL, NULL, NULL),
(2, 2, 3, 2, 1, '33698745', 'pd1@ss.com', 'Ajay Sharma', '19.001', '72.001', 'A', 'N', '2018-08-13 07:30:37', '2018-08-13 04:13:46', 1, NULL, NULL, NULL),
(3, 1, 1, 1, 1, '99876543', 'pd3@ss.com', 'Tom Smith', '22.54554', '88.54544', 'A', 'N', '2018-08-13 02:10:51', '2018-08-13 02:10:51', 1, NULL, NULL, NULL),
(4, 2, 3, 2, 1, '229977554', 'pd4@ss.com', 'John Smith', '19.076', '72.8777', 'A', 'N', '2018-08-13 02:10:51', '2018-08-13 02:10:51', 1, NULL, NULL, NULL),
(5, 5, 4, 13, 1, '9988554477', 'test_13_08_2018@ss.com', 'Sukhbinder Singh', '31.6340', '74.8723', 'A', 'N', '2018-08-13 04:09:47', '2018-08-13 04:09:47', 1, NULL, NULL, NULL),
(6, 6, 6, 3, 1, '222', 'test@ss.com', 'test', '1212', '1122', 'D', 'Y', '2018-08-13 04:15:00', '2018-08-13 04:15:08', 1, NULL, '2018-08-13 04:15:08', 1),
(7, 6, 2, 1, 1, '12323', 'tt@ss.com', 'wwww', '22.878', '89.87897', 'D', 'Y', '2018-08-13 04:36:46', '2018-08-13 04:37:02', 1, NULL, '2018-08-13 04:37:02', 1),
(8, 2, 1, 1, 1, '2312312', 'dddddd@ss.com', 'aasd', '22.22222', '88.54564', 'I', 'N', '2018-08-13 04:43:33', '2018-08-13 04:43:33', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_petrol_pumps`
--

CREATE TABLE `ss_petrol_pumps` (
  `id` bigint(20) NOT NULL,
  `petrol_pump_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) NOT NULL COMMENT 'primary key of ''cities''',
  `state_id` bigint(20) NOT NULL COMMENT 'primary key of ''states''',
  `country_id` bigint(20) NOT NULL COMMENT 'primary key of ''countries''',
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `ss_petrol_pumps` (`id`, `petrol_pump_name`, `address`, `city_id`, `state_id`, `country_id`, `contact_number`, `contact_email`, `contact_person`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'SS Petrol Pump', 'Sector V, Kolkata', 1, 1, 1, '54564564', 'sspetrol@ss.com', 'John Smith', 'A', 'N', '2018-08-09 09:40:21', '2018-08-09 09:40:21', 1, NULL, NULL, NULL),
(2, 'Test Petrol Pump', 'Lonavala', 3, 2, 1, '54564564', 'testpetrol@ss.com', 'John Smith', 'A', 'N', '2018-08-09 09:40:21', '2018-08-09 09:45:07', 1, NULL, NULL, NULL),
(3, 'test', 'Ultadanga', 1, 1, 1, '2222', 'test@ss.com', 'Test Person', 'D', 'Y', '2018-08-09 05:32:55', '2018-08-09 05:48:11', 1, NULL, '2018-08-09 05:48:11', 1),
(4, 'Howrah Petrol Pump', 'Howrah 711234', 2, 1, 1, '7656798', 'howrahpump@ss.com', 'test 123', 'A', 'N', '2018-08-09 05:51:31', '2018-08-09 05:51:51', 1, NULL, NULL, NULL),
(5, 'Petrol Pump1', 'Lonavala', 3, 2, 1, '9876543210', 'pp1@ss.com', 'John Smith', 'A', 'N', '2018-08-10 00:45:48', '2018-08-10 00:45:48', 1, NULL, NULL, NULL),
(6, 'Petrol Pump3', 'Howrah 711234', 2, 1, 1, '7656798', 'pp3@ss.com', 'Leo', 'A', 'N', '2018-08-10 00:45:48', '2018-08-10 00:45:48', 1, NULL, NULL, NULL),
(7, 'Petrol Pump2', 'Sector V', 1, 1, 1, '54564564', 'pp2@ss.com', 'Steve Smith', 'A', 'N', '2018-08-10 00:45:48', '2018-08-10 00:45:48', 1, NULL, NULL, NULL),
(8, 's', 's', 1, 1, 1, '54564', 'sasas@dd.com', 'ss', 'D', 'Y', '2018-08-13 04:56:52', '2018-08-13 04:56:58', 1, NULL, '2018-08-13 04:56:58', 1);

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
  `amount` float(10,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `approved_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
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
  `approved_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
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

-- --------------------------------------------------------

--
-- Table structure for table `ss_plants`
--

CREATE TABLE `ss_plants` (
  `id` bigint(20) NOT NULL,
  `type` enum('P','W') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'P = Plant, W = Warehouse',
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance_amount` float NOT NULL,
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

INSERT INTO `ss_plants` (`id`, `type`, `name`, `description`, `contact_number`, `contact_email`, `contact_person`, `balance_amount`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'P', 'Test Plant', 'test description', '9876543210', 'testplant@sslogistic.com', 'John Smith', 10000, 'A', 'N', '2018-08-08 12:25:04', '2018-08-08 12:25:04', 1, NULL, NULL, NULL),
(2, 'P', 'Test Plant 2', 'test description 2', '9876543210', 'testplant2@sslogistic.com', 'John Smith', 10000, 'D', 'Y', '2018-08-08 12:25:04', '2018-08-08 07:36:27', 1, NULL, '2018-08-08 07:36:27', 1),
(3, 'P', 'Test Name', 'test desc', '6576576', 'testname@ss.com', 'test person', 98769, 'A', 'N', '2018-08-08 07:27:45', '2018-08-08 12:58:20', 1, NULL, NULL, NULL),
(4, 'W', 'Plant_08_08_2018', 'test1', '9809899', 'plant_08_08_2018@ss.com', 'John Smithss', 8787, 'A', 'N', '2018-08-08 07:30:23', '2018-08-08 07:35:53', 1, NULL, NULL, NULL),
(5, 'P', 'Plan1', 'Plan1', '6576576', 'plant1@ss.com', 'Will Robinson', 98769, 'A', 'N', '2018-08-10 00:07:11', '2018-08-10 00:07:11', 1, NULL, NULL, NULL),
(6, 'W', 'Plant3', 'Plant3', '9809899', 'plant3@ss.com', 'John Smithss', 8787, 'A', 'N', '2018-08-10 00:07:11', '2018-08-10 00:07:11', 1, NULL, NULL, NULL),
(7, 'P', 'Plant2', 'Plant2', '9876543210', 'plant2@sslogistic.com', 'Adam', 10000, 'I', 'N', '2018-08-10 00:07:11', '2018-08-10 00:07:11', 1, NULL, NULL, NULL),
(8, 'P', 'ddd1233', 'ddd', '231231', 'ddd@ss.com', 'dddsd', 231231, 'A', 'N', '2018-08-10 07:09:08', '2018-08-10 07:19:47', 1, NULL, NULL, NULL),
(9, 'P', 'sss', 'ssss', '51454', 'ssss@dd.com', 'dhhd', 7267, 'D', 'Y', '2018-08-13 04:52:19', '2018-08-13 04:52:28', 1, NULL, '2018-08-13 04:52:28', 1),
(10, 'P', 'sss', 'ssss', '5454', 'ss@dd.com', 'asdsad', 5456, 'I', 'N', '2018-08-13 04:53:56', '2018-08-13 04:53:56', 1, NULL, NULL, NULL);

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
  `lat` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lng` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_plant_journal_edit_requests`
--

CREATE TABLE `ss_plant_journal_edit_requests` (
  `id` bigint(20) NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `trip_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trips''',
  `plant_journal_laser_id` bigint(20) NOT NULL COMMENT 'primary key of ''plant_journal_lasers''',
  `truck_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trucks''',
  `request_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `approved_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
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

-- --------------------------------------------------------

--
-- Table structure for table `ss_plant_journal_lasers`
--

CREATE TABLE `ss_plant_journal_lasers` (
  `id` bigint(20) NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `type` enum('D','C') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'C' COMMENT 'D=Debit, C=Credit',
  `trip_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trips''',
  `amount` float(10,2) NOT NULL,
  `truck_id` bigint(20) DEFAULT NULL COMMENT 'primary key of ''trucks''',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `entry_type` enum('A','M','BG') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'A' COMMENT 'A=Advance, M=Misclleneous, BG=Balance Given',
  `entry_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
  `approved_by` bigint(20) NOT NULL COMMENT 'primary key of ''users''',
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

--
-- Dumping data for table `ss_states`
--

INSERT INTO `ss_states` (`id`, `country_id`, `state_name`, `state_code`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'West Bengal', 'WB', 'A', 'N', '2018-08-03 05:28:29', '2018-08-03 05:28:29', 1, NULL, NULL, NULL),
(2, 1, 'Maharashtra', 'MH', 'A', 'N', '2018-08-03 05:28:29', '2018-08-03 05:28:29', 1, NULL, NULL, NULL),
(3, 1, 'Madhya Pradesh', 'MP', 'A', 'N', '2018-08-03 05:28:29', '2018-08-03 05:28:29', 1, NULL, NULL, NULL),
(4, 1, 'Tamil Nadu ', 'TN', 'A', 'N', '2018-08-03 05:28:29', '2018-08-03 05:28:29', 1, NULL, NULL, NULL),
(10, 1, 'Kerala', 'KL', 'A', 'N', '2018-08-03 10:12:29', '2018-08-03 10:12:29', 1, NULL, NULL, NULL),
(11, 1, 'Andhra Pradesh', 'AP', 'A', 'N', '2018-08-03 10:12:29', '2018-08-03 10:12:29', 1, NULL, NULL, NULL),
(12, 1, 'Haryana', 'HR', 'A', 'N', '2018-08-03 10:12:29', '2018-08-03 10:12:29', 1, NULL, NULL, NULL),
(13, 1, 'Punjab', 'PB', 'A', 'N', '2018-08-03 10:12:29', '2018-08-03 10:12:29', 1, NULL, NULL, NULL),
(14, 1, 'Gujrat', 'GJ', 'A', 'N', '2018-08-03 10:12:29', '2018-08-03 10:12:29', 1, NULL, NULL, NULL),
(15, 1, 'Jammu and Kashmir', 'JK', 'A', 'N', '2018-08-06 04:14:03', '2018-08-06 04:14:42', 1, NULL, NULL, NULL),
(16, 1, 'Assam', 'AS', 'A', 'N', '2018-08-06 04:17:23', '2018-08-06 04:17:23', 1, NULL, NULL, NULL),
(17, 1, 'Odisha', 'OR', 'A', 'N', '2018-08-06 04:19:01', '2018-08-06 04:19:01', 1, NULL, NULL, NULL),
(18, 1, 'Uttar Pradesh', 'UP', 'A', 'N', '2018-08-06 04:20:30', '2018-08-06 04:20:30', 1, NULL, NULL, NULL),
(19, 1, 'Himachal Pradesh', 'HP', 'A', 'N', '2018-08-06 04:31:02', '2018-08-06 04:31:02', 1, NULL, NULL, NULL),
(20, 1, 'testnew', 'test', 'D', 'N', '2018-08-06 07:07:34', '2018-08-06 08:17:22', 1, NULL, '2018-08-06 08:17:22', 1),
(22, 1, 'test_06_08_2018_1', 'TS06082018', 'D', 'N', '2018-08-06 07:29:44', '2018-08-07 00:08:27', 1, NULL, '2018-08-07 00:08:27', 1),
(23, 1, 'test12377', 'test12377', 'D', 'N', '2018-08-07 00:49:17', '2018-08-07 00:49:31', 1, NULL, '2018-08-07 00:49:31', 1),
(24, 2, 'BAN11', 'BAN11', 'D', 'Y', '2018-08-07 02:26:38', '2018-08-07 04:04:07', 1, NULL, '2018-08-07 04:04:07', 1),
(25, 1, 'Rajasthan', 'RJ', 'A', 'N', '2018-08-07 03:52:28', '2018-08-07 03:52:46', 1, NULL, NULL, NULL),
(26, 1, 'cc', 'cc', 'D', 'Y', '2018-08-13 04:35:32', '2018-08-13 04:35:38', 1, NULL, '2018-08-13 04:35:38', 1),
(27, 1, 's', 's', 'D', 'Y', '2018-08-13 04:38:54', '2018-08-13 04:38:58', 1, NULL, '2018-08-13 04:38:58', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ss_trips`
--

CREATE TABLE `ss_trips` (
  `id` bigint(20) NOT NULL,
  `trip_date` timestamp NULL DEFAULT NULL,
  `lr_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plant_id` bigint(20) NOT NULL COMMENT 'primary key of ''plants''',
  `plant_address_id` bigint(20) NOT NULL COMMENT 'primary key of ''plant_addresses''',
  `invoice_challan_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `do_shipment_no` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `party_id` bigint(20) NOT NULL COMMENT 'primary key of ''parties''',
  `party_destination_id` bigint(20) NOT NULL COMMENT 'primary key of ''party_destinations''',
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `quantity` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'in Metric Ton',
  `truck_owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `truck_driver_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_driver_phone_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `truck_driver_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `petrol_pump_id` bigint(20) NOT NULL COMMENT 'primary key of ''petrol_pumps''',
  `advance_amount` float(10,2) NOT NULL,
  `diesel_amount` float(10,2) NOT NULL,
  `trip_status` enum('Awaiting','Running','Cancelled','Settled','Unsettled') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Running',
  `GPS_trip_status` enum('Start','End') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Start',
  `POD_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `POD_status` enum('No','Yes','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `POD_uploaded_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `POD_uploaded_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `ss_trip_payment_managements`
--

CREATE TABLE `ss_trip_payment_managements` (
  `id` bigint(20) NOT NULL,
  `trip_id` bigint(20) NOT NULL COMMENT 'primary key of ''trips''',
  `freight_charge` float(10,2) DEFAULT NULL,
  `toll` float(10,2) DEFAULT NULL,
  `unloading_charge` float(10,2) DEFAULT NULL,
  `tare_charge` float(10,2) DEFAULT NULL,
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

-- --------------------------------------------------------

--
-- Table structure for table `ss_trucks`
--

CREATE TABLE `ss_trucks` (
  `id` bigint(20) NOT NULL,
  `type` enum('C','M') COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'C = Company, M = Market',
  `truck_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bank_details` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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

INSERT INTO `ss_trucks` (`id`, `type`, `truck_no`, `contact_number`, `contact_email`, `contact_person`, `pan_number`, `bank_details`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'C', 'WB04E-2018', '3232223', 'tr@ss.com', 'John Smith', 'HJ8778HJK', 'SBI', 'A', 'N', '2018-08-10 08:00:43', '2018-08-10 08:00:43', 1, NULL, NULL, NULL),
(2, 'M', 'WB04E-20181', '323222399', 'tr1@ss.com', 'Jacob Smith', 'GFDR5456', 'UBI', 'A', 'N', '2018-08-10 09:00:43', '2018-08-10 09:00:43', 1, NULL, NULL, NULL),
(3, 'M', 'WB01H9082', '6565656', 'test@ss.com', 'Kaaaaaal', 'NHYU7676', 'ICICI', 'D', 'Y', '2018-08-10 04:35:54', '2018-08-10 04:40:17', 1, NULL, '2018-08-10 04:40:17', 1),
(4, 'C', 'sss', '21313', 'sasas@dd.com', 'asdasd', 'asdads', 'asdasd', 'D', 'Y', '2018-08-13 04:55:26', '2018-08-13 04:55:47', 1, NULL, '2018-08-13 04:55:47', 1),
(5, 'C', 'WB04E-2018123', '324234', 'dddddd@ss.com', 'sqssqss', 'adsada', 'dsadsdd', 'I', 'N', '2018-08-13 07:25:42', '2018-08-13 07:25:42', 1, NULL, NULL, NULL),
(6, 'C', 'WB04E-20181097', '34234', 'dddddd@ss.com', 'sqssqss', 'adsada', 'dsadsdd', 'D', 'Y', '2018-08-13 07:29:39', '2018-08-13 07:29:45', 1, NULL, '2018-08-13 07:29:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_insurances`
--

CREATE TABLE `ss_truck_insurances` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `policy_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `policy_on` timestamp NULL DEFAULT NULL,
  `policy_start` timestamp NULL DEFAULT NULL,
  `policy_end` timestamp NULL DEFAULT NULL,
  `policy_file` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Dumping data for table `ss_truck_insurances`
--

INSERT INTO `ss_truck_insurances` (`id`, `truck_id`, `policy_no`, `name`, `policy_on`, `policy_start`, `policy_end`, `policy_file`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'POLICY123456', 'Test Insurance', '2018-08-12 22:30:00', '2018-08-12 23:30:00', '2019-08-12 23:30:00', 'test', 'A', 'N', '2018-08-13 13:07:08', '2018-08-13 13:07:08', 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_truck_permits`
--

CREATE TABLE `ss_truck_permits` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `permit_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `permit_on` timestamp NULL DEFAULT NULL,
  `permit_start` timestamp NULL DEFAULT NULL,
  `permit_end` timestamp NULL DEFAULT NULL,
  `permit_file` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_truck_registrations`
--

CREATE TABLE `ss_truck_registrations` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `registration_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `registered_on` timestamp NULL DEFAULT NULL,
  `registration_start` timestamp NULL DEFAULT NULL,
  `registration_end` timestamp NULL DEFAULT NULL,
  `registration_file` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_truck_taxes`
--

CREATE TABLE `ss_truck_taxes` (
  `id` bigint(20) NOT NULL,
  `truck_id` bigint(20) NOT NULL COMMENT 'primary key of ''trucks''',
  `invoice_no` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_paid_date` timestamp NULL DEFAULT NULL,
  `tax_period_start` timestamp NULL DEFAULT NULL,
  `tax_period_end` timestamp NULL DEFAULT NULL,
  `tax_file` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_users`
--

CREATE TABLE `ss_users` (
  `id` bigint(20) NOT NULL,
  `user_role_id` bigint(20) NOT NULL COMMENT 'primary key ''user_roles''',
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_picture` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_ip` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login_datetime` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `token_generated_time` timestamp NULL DEFAULT NULL,
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
-- Dumping data for table `ss_users`
--

INSERT INTO `ss_users` (`id`, `user_role_id`, `username`, `password`, `full_name`, `phone_number`, `profile_picture`, `last_login_ip`, `last_login_datetime`, `remember_token`, `token_generated_time`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'admin@sslogistic.com', '$2y$10$HkxJalx2plpwOE94cDs/Wu6Qq3AwvvbN7J0RmMOklb1ynckJc8O7q', 'John Smithss123', '54768771235', '1533209020_images (8).jpg', '203.200.180.178', '2018-08-13 23:48:51', 'k7p1m5d1', '2018-08-08 01:23:25', 'A', 'N', '2018-07-26 05:12:29', '2018-08-13 23:48:51', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_user_roles`
--

CREATE TABLE `ss_user_roles` (
  `id` bigint(20) NOT NULL,
  `role_name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Table structure for table `ss_user_role_permissions`
--

CREATE TABLE `ss_user_role_permissions` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(20) NOT NULL COMMENT 'primary key of ''users_roles''',
  `app_module_id` bigint(20) NOT NULL COMMENT 'primary key of ''app_modules''',
  `app_module_functionality_id` bigint(20) NOT NULL COMMENT 'primary key of ''app_module_functionalities''',
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
-- Indexes for dumped tables
--

--
-- Indexes for table `ss_app_modules`
--
ALTER TABLE `ss_app_modules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_app_module_functionalities`
--
ALTER TABLE `ss_app_module_functionalities`
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
-- Indexes for table `ss_plant_journal_edit_requests`
--
ALTER TABLE `ss_plant_journal_edit_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `ss_user_roles`
--
ALTER TABLE `ss_user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ss_user_role_permissions`
--
ALTER TABLE `ss_user_role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ss_app_modules`
--
ALTER TABLE `ss_app_modules`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_app_module_functionalities`
--
ALTER TABLE `ss_app_module_functionalities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_categories`
--
ALTER TABLE `ss_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ss_cities`
--
ALTER TABLE `ss_cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_countries`
--
ALTER TABLE `ss_countries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_gps_trackings`
--
ALTER TABLE `ss_gps_trackings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_items`
--
ALTER TABLE `ss_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `ss_parties`
--
ALTER TABLE `ss_parties`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `ss_party_destinations`
--
ALTER TABLE `ss_party_destinations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ss_petrol_pumps`
--
ALTER TABLE `ss_petrol_pumps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ss_petrol_pump_journal_lasers`
--
ALTER TABLE `ss_petrol_pump_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_petrol_pump_journal_lasers_edit_requests`
--
ALTER TABLE `ss_petrol_pump_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plants`
--
ALTER TABLE `ss_plants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ss_plant_addresses`
--
ALTER TABLE `ss_plant_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_journal_edit_requests`
--
ALTER TABLE `ss_plant_journal_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_states`
--
ALTER TABLE `ss_states`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `ss_trips`
--
ALTER TABLE `ss_trips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trip_payment_managements`
--
ALTER TABLE `ss_trip_payment_managements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trucks`
--
ALTER TABLE `ss_trucks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ss_truck_insurances`
--
ALTER TABLE `ss_truck_insurances`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ss_truck_permits`
--
ALTER TABLE `ss_truck_permits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_truck_registrations`
--
ALTER TABLE `ss_truck_registrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_truck_taxes`
--
ALTER TABLE `ss_truck_taxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_users`
--
ALTER TABLE `ss_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ss_user_roles`
--
ALTER TABLE `ss_user_roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_user_role_permissions`
--
ALTER TABLE `ss_user_role_permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
