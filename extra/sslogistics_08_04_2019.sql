-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 08, 2019 at 04:17 PM
-- Server version: 5.7.25-0ubuntu0.16.04.2
-- PHP Version: 7.2.16-1+ubuntu16.04.1+deb.sury.org+1

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

-- --------------------------------------------------------

--
-- Table structure for table `ss_model_has_permissions`
--

CREATE TABLE `ss_model_has_permissions` (
  `permission_id` int(10) UNSIGNED NOT NULL COMMENT 'primary key of ss_permissions',
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL COMMENT 'primary key of ss_users'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, 'App\\User', 1);

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
(168, 'vendor_view', 'web', '2019-04-08 05:15:28', '2019-04-08 05:15:28', 1, 1, NULL, NULL);

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
(137, 3),
(138, 3),
(139, 3),
(140, 3),
(141, 3),
(142, 3),
(143, 3),
(144, 3),
(145, 3),
(146, 3),
(147, 3),
(148, 3),
(149, 3),
(150, 3),
(151, 3),
(152, 3),
(153, 3),
(154, 3),
(155, 3),
(156, 3),
(157, 3),
(158, 3),
(159, 3),
(160, 3),
(161, 3),
(162, 3),
(163, 3),
(164, 3),
(165, 3),
(166, 3),
(167, 3),
(168, 3);

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
(1, 1, 'admin@sslogistic.com', '$2y$10$AQG8m8dNVRM9UYCzH7MCX.oYuGeCOlOzFhz0ybLH5WxoJ3N/9sp4S', 'Admin', '9876543210', NULL, '', '2019-04-08 05:17:27', NULL, NULL, 'A', 'N', '2019-04-07 18:30:00', '2019-04-08 05:17:27', 0, NULL, NULL, NULL);

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
(1, 'SSLogistics', 'ADMIN', '9876543210', 'test@sslogistics.com', 'HJKIU8763E', 'SBI', 'SBIN0007587', 54564654564, 'THE SUPER ADMIN', 'A', 'N', '2019-04-07 19:07:11', '2019-04-08 00:37:39', 1, NULL, NULL, NULL);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_categories`
--
ALTER TABLE `ss_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_parties`
--
ALTER TABLE `ss_parties`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_party_destinations`
--
ALTER TABLE `ss_party_destinations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=169;
--
-- AUTO_INCREMENT for table `ss_petrol_pumps`
--
ALTER TABLE `ss_petrol_pumps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_addresses`
--
ALTER TABLE `ss_plant_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers_edit_requests`
--
ALTER TABLE `ss_plant_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_user_relations`
--
ALTER TABLE `ss_plant_user_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trip_payment_managements`
--
ALTER TABLE `ss_trip_payment_managements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trip_POD`
--
ALTER TABLE `ss_trip_POD`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trucks`
--
ALTER TABLE `ss_trucks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `ss_vendors`
--
ALTER TABLE `ss_vendors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
