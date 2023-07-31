-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 29, 2019 at 12:08 PM
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

--
-- Dumping data for table `ss_address_zones`
--

INSERT INTO `ss_address_zones` (`id`, `latitude`, `longitude`, `title`, `address`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '22.572646', '88.36389500000001', 'KOLK', 'Kolkata, West Bengal, India', 'A', 'N', '2019-02-27 03:46:29', '2019-03-11 00:56:40', 1, 1, NULL, NULL),
(2, '19.0759837', '72.8776559', 'MUM', 'Mumbai, Maharashtra, India', 'A', 'N', '2019-02-27 23:55:10', '2019-03-11 05:46:43', 1, NULL, NULL, NULL),
(3, '22.5867296', '88.41709879999996', 'SALTLAKE', 'Salt Lake City, West Bengal, India', 'D', 'Y', '2019-03-01 01:20:53', '2019-03-24 10:00:38', 1, NULL, '2019-03-24 10:00:38', 1),
(4, '22.5957689', '88.26363939999999', 'HWH', 'Howrah, West Bengal, India', 'A', 'N', '2019-03-11 00:42:55', '2019-03-11 00:42:55', 1, NULL, NULL, NULL),
(12, '11.11', '11.11', 'DEL', 'Delhi, India', 'A', 'N', '2019-03-11 06:09:00', '2019-03-11 06:09:00', 1, NULL, NULL, NULL),
(13, '11.11', '11.11', 'HYD', 'Hyderabad, Telangana, India', 'D', 'Y', '2019-03-11 06:14:02', '2019-03-24 10:00:50', 1, NULL, '2019-03-24 10:00:50', 1),
(14, '11.11', '11.11', 'BEN', 'Bengaluru, Karnataka, India', 'A', 'N', '2019-03-11 06:17:43', '2019-03-11 06:17:43', 1, NULL, NULL, NULL),
(15, '11.11', '11.11', 'CHE', 'chennai', 'A', 'N', '2019-03-11 06:19:16', '2019-03-11 06:19:16', 1, NULL, NULL, NULL),
(16, '11.11', '11.11', 'Sik', 'Sikkim, India', 'D', 'Y', '2019-03-11 06:20:20', '2019-03-24 10:00:30', 1, NULL, '2019-03-24 10:00:30', 1),
(17, '11.11', '11.11', 'test', 'DD2/21 Cao Thắng, phường 5, District 3, Ho Chi Minh City, Vietnam', 'A', 'N', '2019-03-11 06:21:39', '2019-03-11 06:21:39', 1, NULL, NULL, NULL),
(18, '11.11', '11.11', 'DUR', 'Durgapure', 'A', 'N', '2019-03-11 06:30:49', '2019-03-11 06:30:49', 1, NULL, NULL, NULL),
(19, '11.11', '11.11', 'GUJ', 'Gujarat, India', 'A', 'N', '2019-03-11 06:34:15', '2019-03-11 06:34:15', 1, NULL, NULL, NULL),
(20, '11.11', '11.11', 'hhhh', 'hhhhhhhhhhh', 'D', 'Y', '2019-03-11 06:45:34', '2019-03-24 09:59:56', 1, NULL, '2019-03-24 09:59:56', 1),
(21, '11.11', '11.11', 'ssss', 'São Paulo, State of São Paulo, Brazil', 'D', 'Y', '2019-03-11 06:52:23', '2019-03-24 09:59:59', 1, NULL, '2019-03-24 09:59:59', 1),
(22, '11.11', '11.11', 'vvvv', 'vvvvvvvvvv', 'D', 'Y', '2019-03-11 06:54:27', '2019-03-24 10:00:02', 1, NULL, '2019-03-24 10:00:02', 1),
(23, '11.11', '11.11', 'kkkk', 'K.K.K.K. Invest Aps, Klokkerfaldet, Aarhus V, Denmark', 'D', 'Y', '2019-03-11 06:57:13', '2019-03-24 10:00:06', 1, NULL, '2019-03-24 10:00:06', 1),
(24, '11.11', '11.11', 'ffff', 'ffffffff', 'A', 'N', '2019-03-11 06:58:00', '2019-03-11 06:58:00', 1, NULL, NULL, NULL),
(25, '11.11', '11.11', 'gggg', 'Jalan Raya Pantura No.Gg.1, Bungor, Banyuglugur, Situbondo Regency, East Java, Indonesia', 'D', 'Y', '2019-03-11 07:08:45', '2019-03-24 10:00:15', 1, NULL, '2019-03-24 10:00:15', 1),
(26, '11.11', '11.11', 'zzz', 'zzzzzzzzzzzz', 'D', 'Y', '2019-03-11 07:09:50', '2019-03-24 10:00:12', 1, NULL, '2019-03-24 10:00:12', 1),
(27, '11.11', '11.11', 'bhjiuy', 'bhiusa', 'A', 'N', '2019-03-11 08:22:20', '2019-03-11 08:22:20', 1, NULL, NULL, NULL),
(28, '11.11', '11.11', 'fdfdfd', 'ffdfdfdfdfdf', 'D', 'Y', '2019-03-11 08:23:03', '2019-03-24 09:58:35', 1, NULL, '2019-03-24 09:58:35', 1),
(29, '22.572646', '88.36389500000001', 'KOL', 'Kolkata', 'A', 'N', '2019-03-12 01:36:41', '2019-03-12 01:36:41', 1, NULL, NULL, NULL),
(30, '22.572646', '88.36389500000001', 'KOL1', 'Kolkata1', 'A', 'N', '2019-03-12 01:37:24', '2019-03-12 01:37:24', 1, NULL, NULL, NULL),
(31, '11.11', '11.11', 'BHO', 'Bhopal, Madhya Pradesh, India', 'A', 'N', '2019-03-12 03:44:08', '2019-03-12 03:44:08', 1, NULL, NULL, NULL),
(32, '11.11', '11.11', 'xxxx', 'xxxxxxxxx', 'D', 'Y', '2019-03-12 03:49:01', '2019-03-24 09:58:48', 1, NULL, '2019-03-24 09:58:48', 1),
(33, '11.11', '11.11', 'yyyyy', 'yyyyy', 'D', 'Y', '2019-03-12 04:02:12', '2019-03-24 09:58:52', 1, NULL, '2019-03-24 09:58:52', 1),
(34, '11.11', '11.11', 'bvvvbbn', 'Boston, MA, USA', 'D', 'Y', '2019-03-12 04:23:05', '2019-03-24 09:58:55', 1, NULL, '2019-03-24 09:58:55', 1),
(35, '11.11', '11.11', 'mnmnmnmn', 'mnmnmnmn', 'D', 'Y', '2019-03-12 04:43:11', '2019-03-24 09:58:58', 1, NULL, '2019-03-24 09:58:58', 1),
(36, '11.11', '11.11', 'xcxcxcxcxc', 'xcxcxcxcxcxc', 'D', 'Y', '2019-03-12 04:45:22', '2019-03-24 09:59:04', 1, NULL, '2019-03-24 09:59:04', 1),
(37, '11.11', '11.11', 'ppppppppppppp', 'ppppppppppppppppppppp', 'D', 'Y', '2019-03-12 04:45:44', '2019-03-24 09:59:08', 1, NULL, '2019-03-24 09:59:08', 1),
(38, '11.11', '11.11', 'tttttttt', 'tttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt - tabuleiro - Benedito Bentes, Maceió - State of Alagoas, Brazil', 'D', 'Y', '2019-03-12 04:46:22', '2019-03-24 09:59:10', 1, NULL, '2019-03-24 09:59:10', 1),
(39, '11.11', '11.11', 'bhbhbhbh', 'bhbhbhbhb', 'D', 'Y', '2019-03-12 04:53:15', '2019-03-24 09:59:38', 1, NULL, '2019-03-24 09:59:38', 1),
(40, '11.11', '11.11', 'rgdbdfbfghb', 'fghfghfghfgh', 'D', 'Y', '2019-03-12 04:54:21', '2019-03-24 09:59:35', 1, NULL, '2019-03-24 09:59:35', 1),
(41, '11.11', '11.11', 'zurich', 'Zürich, Switzerland', 'D', 'Y', '2019-03-12 05:14:50', '2019-03-24 09:59:19', 1, NULL, '2019-03-24 09:59:19', 1),
(42, '11.11', '11.11', 'vfx', 'VfR Mannheim 1896 e.V., Theodor-Heuss-Anlage, Mannheim, Germany', 'D', 'Y', '2019-03-12 05:21:18', '2019-03-24 09:59:21', 1, NULL, '2019-03-24 09:59:21', 1),
(43, '11.11', '11.11', 'Jahangirpuri', 'Jahangirpuri, New Delhi, Delhi, India', 'D', 'Y', '2019-03-12 05:22:32', '2019-03-24 09:59:16', 1, NULL, '2019-03-24 09:59:16', 1),
(44, '11.11', '11.11', 'ranchi', 'Ranchi, Jharkhand, India', 'A', 'N', '2019-03-12 05:23:26', '2019-03-12 05:23:26', 1, NULL, NULL, NULL),
(45, '11.11', '11.11', 'p1', 'P111 Giải Phóng, Phương Liệt, Thanh Xuân, Hanoi, Vietnam', 'D', 'Y', '2019-03-12 05:25:14', '2019-03-24 09:59:31', 1, NULL, '2019-03-24 09:59:31', 1),
(46, '11.11', '11.11', 'p2', 'p2', 'A', 'N', '2019-03-12 05:25:55', '2019-03-12 05:25:55', 1, NULL, NULL, NULL),
(47, '11.11', '11.11', 'berlin', 'Berlin, Germany', 'A', 'N', '2019-03-12 05:30:44', '2019-03-12 05:30:44', 1, NULL, NULL, NULL),
(48, '21.9088379', '87.26929419999999', 'DANTAN', 'Dantan, West Bengal, India', 'A', 'N', '2019-03-24 10:02:42', '2019-03-24 10:02:42', 1, NULL, NULL, NULL),
(49, '22.62301829999999', '87.82058640000002', 'JAGATPUR', 'Jagatpur, West Bengal, India', 'A', 'N', '2019-03-24 10:03:18', '2019-03-24 10:03:18', 1, NULL, NULL, NULL),
(50, '23.4008744', '88.50139620000004', 'KRISHNANAGAR', 'Krishnanagar, West Bengal, India', 'A', 'N', '2019-03-24 10:04:28', '2019-03-24 10:04:28', 1, NULL, NULL, NULL),
(51, '23.70040789999999', '88.04364439999995', 'KETUGRAM', 'Ketugram, West Bengal, India', 'A', 'N', '2019-03-24 10:04:47', '2019-03-24 10:04:47', 1, NULL, NULL, NULL),
(52, '23.3612635', '88.60241689999998', 'HANSKHALI', 'Hanskhali, West Bengal, India', 'A', 'N', '2019-03-24 10:05:09', '2019-03-24 10:05:09', 1, NULL, NULL, NULL),
(53, '21.79644429999999', '86.65860640000005', 'DUKURA', 'Dukura, Odisha, India', 'A', 'N', '2019-03-24 10:06:01', '2019-03-24 10:06:01', 1, NULL, NULL, NULL),
(54, '22.5445343', '88.22177330000001', 'SANKRAIL', 'Sankrail, Howrah, West Bengal, India', 'A', 'N', '2019-03-24 10:08:16', '2019-03-24 10:08:16', 1, NULL, NULL, NULL),
(55, '22.5738343', '88.1779182', 'DHULAGARH', 'Dhulagori, Howrah, West Bengal, India', 'A', 'N', '2019-03-24 10:14:35', '2019-03-24 10:14:35', 1, NULL, NULL, NULL),
(56, '22.2059482', '86.8947789', 'GOPIBALLAVPUR', 'Gopiballabpur, West Bengal, India', 'A', 'N', '2019-03-25 00:59:53', '2019-03-25 00:59:53', 1, NULL, NULL, NULL),
(57, '22.6808348', '88.29293129999996', 'DANKUNI', 'Dankuni, West Bengal, India', 'A', 'N', '2019-03-25 07:48:50', '2019-03-25 07:49:31', 1, 1, NULL, NULL),
(58, '22.34601', '87.23197529999993', 'KHARAGPUR', 'Kharagpur, West Bengal, India', 'A', 'N', '2019-03-25 07:50:16', '2019-03-25 07:50:16', 1, NULL, NULL, NULL),
(59, '22.4308892', '87.32149079999999', 'MEDINIPUR', 'Medinipur, West Bengal, India', 'A', 'N', '2019-03-25 07:50:52', '2019-03-25 07:50:52', 1, NULL, NULL, NULL),
(60, '23.4453054', '87.47030289999998', 'PANAGARH', 'Panagarh, West Bengal, India', 'A', 'N', '2019-03-25 07:51:25', '2019-03-25 07:51:25', 1, NULL, NULL, NULL),
(61, '24.1759039', '88.28017850000003', 'RANINAGAR [MUR]', 'Murshidabad, West Bengal, India', 'A', 'N', '2019-03-27 23:02:03', '2019-03-27 23:02:03', 1, NULL, NULL, NULL);

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
(1, 'Category 1', NULL, 'A', 'N', '2019-02-27 03:44:29', '2019-03-19 00:49:59', 1, 2, NULL, NULL),
(2, 'Cat 12_03_2019', 'test', 'A', 'N', '2019-03-12 00:42:06', '2019-03-12 00:42:06', 1, NULL, NULL, NULL),
(3, 'Category 14_03_2019', 'test description', 'A', 'N', '2019-03-14 01:26:52', '2019-03-14 01:26:52', 3, NULL, NULL, NULL),
(4, 'Cat QA', 'QA creating cat for testing', 'A', 'N', '2019-03-15 01:28:28', '2019-03-15 01:28:28', 1, NULL, NULL, NULL),
(5, 'CAT123', NULL, 'I', 'N', '2019-03-19 00:50:50', '2019-03-19 00:50:50', 2, NULL, NULL, NULL),
(6, 'Cement', 'Bag Cement Material', 'A', 'N', '2019-03-24 09:54:03', '2019-03-24 09:54:03', 1, NULL, NULL, NULL),
(7, 'PAPER', 'PCS OF PAPER', 'A', 'N', '2019-03-27 22:38:15', '2019-03-27 22:38:15', 1, NULL, NULL, NULL);

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
(1, 1, 'SubCat 1', NULL, 'A', 'N', '2019-02-27 03:44:41', '2019-02-27 03:44:41', 1, NULL, NULL, NULL),
(2, 2, 'Subcat 12_03_2019', 'test desc', 'A', 'N', '2019-03-12 00:42:25', '2019-03-12 00:42:25', 1, NULL, NULL, NULL),
(3, 3, 'Subcat 14_03_2019', 'test description', 'A', 'N', '2019-03-14 01:27:27', '2019-03-14 01:27:27', 3, NULL, NULL, NULL),
(4, 4, 'QA123', 'Test QA', 'A', 'N', '2019-03-15 01:29:03', '2019-03-15 01:29:03', 1, NULL, NULL, NULL),
(5, 6, 'PPC', 'Portland Pozzolana Cement', 'A', 'N', '2019-03-24 09:55:09', '2019-03-24 09:56:10', 1, 1, NULL, NULL),
(6, 6, 'PSC', 'Portland Slag Cement', 'A', 'N', '2019-03-24 09:56:53', '2019-03-24 09:56:53', 1, NULL, NULL, NULL),
(7, 6, 'OPC', 'Ordinary Portland Cement', 'A', 'N', '2019-03-24 09:57:26', '2019-03-24 09:57:26', 1, NULL, NULL, NULL),
(8, 6, 'DALMIA', NULL, 'A', 'N', '2019-03-25 04:04:29', '2019-03-25 04:04:29', 5, NULL, NULL, NULL),
(9, 6, 'PSC/N', NULL, 'A', 'N', '2019-03-27 07:58:49', '2019-03-27 07:58:49', 1, NULL, NULL, NULL),
(10, 7, 'A4 SIZE', 'N/A', 'A', 'N', '2019-03-27 22:44:32', '2019-03-27 22:44:32', 1, NULL, NULL, NULL);

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
(1, 'App\\User', 1),
(2, 'App\\User', 1),
(3, 'App\\User', 1),
(4, 'App\\User', 1),
(5, 'App\\User', 1),
(6, 'App\\User', 1),
(7, 'App\\User', 1),
(8, 'App\\User', 1),
(9, 'App\\User', 1),
(10, 'App\\User', 1),
(11, 'App\\User', 1),
(12, 'App\\User', 1),
(13, 'App\\User', 1),
(14, 'App\\User', 1),
(15, 'App\\User', 1),
(16, 'App\\User', 1),
(17, 'App\\User', 1),
(18, 'App\\User', 1),
(19, 'App\\User', 1),
(20, 'App\\User', 1),
(21, 'App\\User', 1),
(22, 'App\\User', 1),
(23, 'App\\User', 1),
(24, 'App\\User', 1),
(25, 'App\\User', 1),
(26, 'App\\User', 1),
(27, 'App\\User', 1),
(28, 'App\\User', 1),
(29, 'App\\User', 1),
(30, 'App\\User', 1),
(31, 'App\\User', 1),
(32, 'App\\User', 1),
(33, 'App\\User', 1),
(34, 'App\\User', 1),
(35, 'App\\User', 1),
(36, 'App\\User', 1),
(37, 'App\\User', 1),
(38, 'App\\User', 1),
(39, 'App\\User', 1),
(40, 'App\\User', 1),
(41, 'App\\User', 1),
(42, 'App\\User', 1),
(43, 'App\\User', 1),
(44, 'App\\User', 1),
(45, 'App\\User', 1),
(46, 'App\\User', 1),
(47, 'App\\User', 1),
(48, 'App\\User', 1),
(49, 'App\\User', 1),
(50, 'App\\User', 1),
(51, 'App\\User', 1),
(52, 'App\\User', 1),
(53, 'App\\User', 1),
(54, 'App\\User', 1),
(55, 'App\\User', 1),
(56, 'App\\User', 1),
(57, 'App\\User', 1),
(58, 'App\\User', 1),
(59, 'App\\User', 1),
(60, 'App\\User', 1),
(61, 'App\\User', 1),
(62, 'App\\User', 1),
(63, 'App\\User', 1),
(64, 'App\\User', 1),
(65, 'App\\User', 1),
(66, 'App\\User', 1),
(67, 'App\\User', 1),
(68, 'App\\User', 1),
(1, 'App\\User', 2),
(2, 'App\\User', 2),
(3, 'App\\User', 2),
(4, 'App\\User', 2),
(5, 'App\\User', 2),
(6, 'App\\User', 2),
(7, 'App\\User', 2),
(8, 'App\\User', 2),
(9, 'App\\User', 2),
(10, 'App\\User', 2),
(11, 'App\\User', 2),
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
(25, 'App\\User', 2),
(26, 'App\\User', 2),
(27, 'App\\User', 2),
(28, 'App\\User', 2),
(29, 'App\\User', 2),
(30, 'App\\User', 2),
(31, 'App\\User', 2),
(32, 'App\\User', 2),
(33, 'App\\User', 2),
(34, 'App\\User', 2),
(35, 'App\\User', 2),
(36, 'App\\User', 2),
(37, 'App\\User', 2),
(38, 'App\\User', 2),
(39, 'App\\User', 2),
(40, 'App\\User', 2),
(41, 'App\\User', 2),
(42, 'App\\User', 2),
(43, 'App\\User', 2),
(44, 'App\\User', 2),
(45, 'App\\User', 2),
(46, 'App\\User', 2),
(47, 'App\\User', 2),
(48, 'App\\User', 2),
(49, 'App\\User', 2),
(50, 'App\\User', 2),
(51, 'App\\User', 2),
(52, 'App\\User', 2),
(53, 'App\\User', 2),
(54, 'App\\User', 2),
(55, 'App\\User', 2),
(56, 'App\\User', 2),
(57, 'App\\User', 2),
(58, 'App\\User', 2),
(59, 'App\\User', 2),
(60, 'App\\User', 2),
(61, 'App\\User', 2),
(62, 'App\\User', 2),
(63, 'App\\User', 2),
(64, 'App\\User', 2),
(65, 'App\\User', 2),
(66, 'App\\User', 2),
(67, 'App\\User', 2),
(68, 'App\\User', 2),
(1, 'App\\User', 3),
(4, 'App\\User', 3),
(5, 'App\\User', 3),
(8, 'App\\User', 3),
(9, 'App\\User', 3),
(10, 'App\\User', 3),
(11, 'App\\User', 3),
(12, 'App\\User', 3),
(13, 'App\\User', 3),
(16, 'App\\User', 3),
(17, 'App\\User', 3),
(20, 'App\\User', 3),
(21, 'App\\User', 3),
(24, 'App\\User', 3),
(26, 'App\\User', 3),
(27, 'App\\User', 3),
(28, 'App\\User', 3),
(29, 'App\\User', 3),
(30, 'App\\User', 3),
(31, 'App\\User', 3),
(32, 'App\\User', 3),
(53, 'App\\User', 3),
(54, 'App\\User', 3),
(55, 'App\\User', 3),
(56, 'App\\User', 3),
(59, 'App\\User', 3),
(60, 'App\\User', 3),
(64, 'App\\User', 3),
(65, 'App\\User', 3),
(68, 'App\\User', 3),
(1, 'App\\User', 4),
(4, 'App\\User', 4),
(5, 'App\\User', 4),
(8, 'App\\User', 4),
(9, 'App\\User', 4),
(10, 'App\\User', 4),
(11, 'App\\User', 4),
(12, 'App\\User', 4),
(13, 'App\\User', 4),
(16, 'App\\User', 4),
(17, 'App\\User', 4),
(20, 'App\\User', 4),
(21, 'App\\User', 4),
(24, 'App\\User', 4),
(26, 'App\\User', 4),
(27, 'App\\User', 4),
(28, 'App\\User', 4),
(29, 'App\\User', 4),
(30, 'App\\User', 4),
(31, 'App\\User', 4),
(32, 'App\\User', 4),
(53, 'App\\User', 4),
(54, 'App\\User', 4),
(55, 'App\\User', 4),
(56, 'App\\User', 4),
(59, 'App\\User', 4),
(60, 'App\\User', 4),
(64, 'App\\User', 4),
(65, 'App\\User', 4),
(68, 'App\\User', 4),
(1, 'App\\User', 5),
(4, 'App\\User', 5),
(5, 'App\\User', 5),
(8, 'App\\User', 5),
(9, 'App\\User', 5),
(10, 'App\\User', 5),
(11, 'App\\User', 5),
(12, 'App\\User', 5),
(13, 'App\\User', 5),
(16, 'App\\User', 5),
(17, 'App\\User', 5),
(20, 'App\\User', 5),
(21, 'App\\User', 5),
(24, 'App\\User', 5),
(26, 'App\\User', 5),
(27, 'App\\User', 5),
(28, 'App\\User', 5),
(29, 'App\\User', 5),
(30, 'App\\User', 5),
(31, 'App\\User', 5),
(32, 'App\\User', 5),
(53, 'App\\User', 5),
(54, 'App\\User', 5),
(55, 'App\\User', 5),
(56, 'App\\User', 5),
(59, 'App\\User', 5),
(60, 'App\\User', 5),
(64, 'App\\User', 5),
(65, 'App\\User', 5),
(68, 'App\\User', 5);

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
(2, 'App\\User', 2),
(3, 'App\\User', 3),
(3, 'App\\User', 4),
(3, 'App\\User', 5);

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
(1, 1, 'PARTY 1', 'TEST', '321321321', 'TEST@SS.COM', 'A', 'N', '2019-02-27 03:48:06', '2019-02-27 03:48:06', 1, NULL, NULL, NULL),
(2, 2, 'PARTY 2', 'TEST DESC', '3656565', 'TEST@SS.COM', 'A', 'N', '2019-03-11 02:07:09', '2019-03-11 02:07:31', 1, 1, NULL, NULL),
(3, 18, 'PP1', 'PP', '111111111', 'TEST@SS.COM', 'A', 'N', '2019-03-11 06:31:10', '2019-03-11 06:31:10', 1, NULL, NULL, NULL),
(4, 4, 'PARTY876786', 'DDD', '4242342', 'TEST@SS.COM', 'A', 'N', '2019-03-11 08:05:12', '2019-03-11 08:05:12', 1, NULL, NULL, NULL),
(5, 4, 'GGGGGGGGGGGGGGGGGG', 'GGGGGGGGGGGG', '5555555555', 'TEST@SS.COM', 'A', 'N', '2019-03-11 08:07:41', '2019-03-11 08:07:41', 1, NULL, NULL, NULL),
(6, 24, 'VFFFVFVFVFF', 'DDD', '1213213212', 'TEST@SS.COM', 'A', 'N', '2019-03-11 08:11:25', '2019-03-11 08:11:25', 1, NULL, NULL, NULL),
(7, 4, 'CDSFE', 'SSS', '21321132', 'TEST@SS.COM', 'A', 'N', '2019-03-11 08:15:51', '2019-03-11 08:15:51', 1, NULL, NULL, NULL),
(8, 24, 'DSFDFGVDVDGBDFB', 'ASDAD', '23123', 'TEST@SS.COM', 'A', 'N', '2019-03-11 08:17:23', '2019-03-11 08:17:23', 1, NULL, NULL, NULL),
(9, 17, 'JHGIKGHSSAD', 'ASDAD', '21321132', 'TEST@SS.COM', 'A', 'N', '2019-03-11 08:19:09', '2019-03-11 08:19:09', 1, NULL, NULL, NULL),
(10, 15, 'PARTY 12_03_2019', 'TEST', '4564564654', 'TEST@SS.COM', 'A', 'N', '2019-03-12 00:50:06', '2019-03-12 00:50:06', 1, NULL, NULL, NULL),
(11, 46, 'P1', 'DDD', '256456456', 'TEST@SS.COM', 'A', 'N', '2019-03-12 05:25:30', '2019-03-12 05:26:04', 1, 1, NULL, NULL),
(12, 31, 'PARTY 14_03_2019', 'TEST', '9876543210', 'BILL@TEST.COM', 'A', 'N', '2019-03-14 01:38:51', '2019-03-14 01:38:51', 3, NULL, NULL, NULL),
(13, 4, 'SUMAN', 'OUR VERY OLD PARTY', '887899', 'SUMAN@GMAIL.COM', 'A', 'N', '2019-03-15 01:32:11', '2019-03-15 01:32:11', 1, NULL, NULL, NULL),
(14, 53, 'SAHU ENTERPRISE', 'SAHU ENTERPRISE', NULL, NULL, 'A', 'N', '2019-03-24 10:10:20', '2019-03-24 10:10:20', 1, NULL, NULL, NULL),
(15, 52, 'LASKAR BUILDERS', 'LASKAR BUILDERS', NULL, NULL, 'A', 'N', '2019-03-24 10:10:55', '2019-03-24 10:10:55', 1, NULL, NULL, NULL),
(16, 51, 'PANCHANAN H/W STORES', 'PANCHANAN H/W STORES', NULL, NULL, 'A', 'N', '2019-03-24 10:11:26', '2019-03-24 10:11:26', 1, NULL, NULL, NULL),
(17, 50, 'ACL WARE HOUSE', 'ACL WARE HOUSE', NULL, NULL, 'A', 'N', '2019-03-24 10:11:55', '2019-03-24 10:11:55', 1, NULL, NULL, NULL),
(18, 49, 'SUNIL KUMAR DE', 'SUNIL KUMAR DE', NULL, NULL, 'A', 'N', '2019-03-24 10:12:21', '2019-03-24 10:12:21', 1, NULL, NULL, NULL),
(19, 48, 'CHOWDHURY TRADERS', 'CHOWDHURY TRADERS', NULL, NULL, 'A', 'N', '2019-03-24 10:12:41', '2019-03-24 10:12:41', 1, NULL, NULL, NULL),
(20, 48, 'SANDHYA RANI MONDAL', 'SANDHYA RANI MONDAL', NULL, NULL, 'A', 'N', '2019-03-24 10:46:22', '2019-03-24 10:46:22', 5, NULL, NULL, NULL),
(21, 48, 'NEW GHOSH BUILDERS', NULL, NULL, NULL, 'A', 'N', '2019-03-25 04:39:49', '2019-03-25 04:39:49', 5, NULL, NULL, NULL);

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
(1, 'category_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(2, 'category_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(3, 'category_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(4, 'category_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(5, 'sub_category_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(6, 'sub_category_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(7, 'sub_category_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(8, 'sub_category_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(9, 'plant_manage_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(10, 'plant_manage_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(11, 'plant_manage_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(12, 'plant_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(13, 'party_manage_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(14, 'party_manage_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(15, 'party_manage_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(16, 'party_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(17, 'petrol_pump_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(18, 'petrol_pump_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(19, 'petrol_pump_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(20, 'petrol_pump_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(21, 'truck_manage_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(22, 'truck_manage_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(23, 'truck_manage_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(24, 'truck_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(25, 'truck_manage_gps_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(26, 'trip_manage_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(27, 'trip_manage_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(28, 'trip_manage_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(29, 'trip_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(30, 'trip_manage_gps_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(31, 'trip_manage_upload_pdo', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(32, 'trip_manage_pdf_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(33, 'report_manage_print', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(34, 'report_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(35, 'user_manage_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(36, 'user_manage_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(37, 'user_manage_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(38, 'user_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(39, 'user_manage_assign_role', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(40, 'user_manage_add_role', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(41, 'user_manage_edit_role', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(42, 'user_manage_delete_role', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(43, 'user_manage_view_role', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(44, 'user_details', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(45, 'user_status', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(46, 'app_module_manage_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(47, 'app_module_manage_functionalities', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(48, 'notification_insurance_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(49, 'notification_permit_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(50, 'notification_tax_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(51, 'notification_pollution_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(52, 'notification_registration_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(53, 'approvle_adv_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(54, 'approvle_dsl_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(55, 'misclleneous_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(56, 'plant_laser', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(57, 'petrolpump_laser', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(58, 'petrolpump_payment', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(59, 'plant_payment', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(60, 'consolidated_trip', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(61, 'address_zone_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(62, 'address_zone_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(63, 'address_zone_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(64, 'address_zone_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(65, 'vendor_add', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(66, 'vendor_edit', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(67, 'vendor_delete', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(68, 'vendor_view', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(69, 'plant_manage_add', 'web', '2019-01-15 19:30:59', '2019-01-15 19:30:59', 1, 1, NULL, NULL),
(70, 'plant_manage_edit', 'web', '2019-01-15 19:31:00', '2019-01-15 19:31:00', 1, 1, NULL, NULL),
(71, 'plant_manage_delete', 'web', '2019-01-15 19:31:00', '2019-01-15 19:31:00', 1, 1, NULL, NULL),
(72, 'plant_manage_view', 'web', '2019-01-15 19:31:00', '2019-01-15 19:31:00', 1, 1, NULL, NULL),
(73, 'plant_manage_add', 'web', '2019-02-22 05:34:30', '2019-02-22 05:34:30', 1, 1, NULL, NULL),
(74, 'plant_manage_edit', 'web', '2019-02-22 05:34:30', '2019-02-22 05:34:30', 1, 1, NULL, NULL),
(75, 'plant_manage_delete', 'web', '2019-02-22 05:34:30', '2019-02-22 05:34:30', 1, 1, NULL, NULL),
(76, 'plant_manage_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(77, 'trip_manage_add', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(78, 'trip_manage_edit', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(79, 'trip_manage_delete', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(80, 'trip_manage_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(81, 'trip_manage_gps_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(82, 'trip_manage_upload_pdo', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(83, 'trip_manage_pdf_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(84, 'approvle_adv_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(85, 'approvle_dsl_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(86, 'misclleneous_view', 'web', '2019-02-22 05:34:31', '2019-02-22 05:34:31', 1, 1, NULL, NULL),
(87, 'category_add', 'web', '2019-03-11 23:49:45', '2019-03-11 23:49:45', 1, 1, NULL, NULL),
(88, 'category_view', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(89, 'sub_category_add', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(90, 'sub_category_view', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(91, 'plant_manage_add', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(92, 'plant_manage_edit', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(93, 'plant_manage_delete', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(94, 'plant_manage_view', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(95, 'party_manage_add', 'web', '2019-03-11 23:49:46', '2019-03-11 23:49:46', 1, 1, NULL, NULL),
(96, 'party_manage_view', 'web', '2019-03-11 23:49:47', '2019-03-11 23:49:47', 1, 1, NULL, NULL),
(97, 'petrol_pump_add', 'web', '2019-03-11 23:49:47', '2019-03-11 23:49:47', 1, 1, NULL, NULL),
(98, 'petrol_pump_view', 'web', '2019-03-11 23:49:47', '2019-03-11 23:49:47', 1, 1, NULL, NULL),
(99, 'truck_manage_add', 'web', '2019-03-11 23:49:47', '2019-03-11 23:49:47', 1, 1, NULL, NULL),
(100, 'truck_manage_view', 'web', '2019-03-11 23:49:47', '2019-03-11 23:49:47', 1, 1, NULL, NULL),
(101, 'trip_manage_add', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(102, 'trip_manage_edit', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(103, 'trip_manage_delete', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(104, 'trip_manage_view', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(105, 'trip_manage_gps_view', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(106, 'trip_manage_upload_pdo', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(107, 'trip_manage_pdf_view', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(108, 'approvle_adv_view', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(109, 'approvle_dsl_view', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(110, 'misclleneous_view', 'web', '2019-03-11 23:49:48', '2019-03-11 23:49:48', 1, 1, NULL, NULL),
(111, 'vendor_add', 'web', '2019-03-11 23:49:49', '2019-03-11 23:49:49', 1, 1, NULL, NULL),
(112, 'vendor_view', 'web', '2019-03-11 23:49:49', '2019-03-11 23:49:49', 1, 1, NULL, NULL),
(113, 'category_add', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(114, 'category_view', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(115, 'sub_category_add', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(116, 'sub_category_view', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(117, 'plant_manage_add', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(118, 'plant_manage_edit', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(119, 'plant_manage_delete', 'web', '2019-03-12 00:07:49', '2019-03-12 00:07:49', 1, 1, NULL, NULL),
(120, 'plant_manage_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(121, 'party_manage_add', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(122, 'party_manage_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(123, 'petrol_pump_add', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(124, 'petrol_pump_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(125, 'truck_manage_add', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(126, 'truck_manage_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(127, 'trip_manage_add', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(128, 'trip_manage_edit', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(129, 'trip_manage_delete', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(130, 'trip_manage_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(131, 'trip_manage_gps_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(132, 'trip_manage_upload_pdo', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(133, 'trip_manage_pdf_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(134, 'approvle_adv_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(135, 'approvle_dsl_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(136, 'misclleneous_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(137, 'address_zone_view', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(138, 'vendor_add', 'web', '2019-03-12 00:07:50', '2019-03-12 00:07:50', 1, 1, NULL, NULL),
(139, 'vendor_view', 'web', '2019-03-12 00:07:51', '2019-03-12 00:07:51', 1, 1, NULL, NULL),
(140, 'category_add', 'web', '2019-03-14 04:20:19', '2019-03-14 04:20:19', 1, 1, NULL, NULL),
(141, 'category_view', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(142, 'sub_category_add', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(143, 'sub_category_view', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(144, 'plant_manage_add', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(145, 'plant_manage_edit', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(146, 'plant_manage_delete', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(147, 'plant_manage_view', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(148, 'party_manage_add', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(149, 'party_manage_view', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(150, 'petrol_pump_add', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(151, 'petrol_pump_view', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(152, 'truck_manage_add', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(153, 'truck_manage_view', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(154, 'trip_manage_add', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(155, 'trip_manage_edit', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(156, 'trip_manage_delete', 'web', '2019-03-14 04:20:20', '2019-03-14 04:20:20', 1, 1, NULL, NULL),
(157, 'trip_manage_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(158, 'trip_manage_gps_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(159, 'trip_manage_upload_pdo', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(160, 'trip_manage_pdf_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(161, 'consolidated_trip', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(162, 'approvle_adv_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(163, 'approvle_dsl_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(164, 'misclleneous_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(165, 'plant_laser', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(166, 'plant_payment', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(167, 'address_zone_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(168, 'vendor_add', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(169, 'vendor_view', 'web', '2019-03-14 04:20:21', '2019-03-14 04:20:21', 1, 1, NULL, NULL),
(170, 'category_add', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(171, 'category_view', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(172, 'sub_category_add', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(173, 'sub_category_view', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(174, 'plant_manage_add', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(175, 'plant_manage_edit', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(176, 'plant_manage_delete', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(177, 'plant_manage_view', 'web', '2019-03-14 04:21:47', '2019-03-14 04:21:47', 1, 1, NULL, NULL),
(178, 'party_manage_add', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(179, 'party_manage_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(180, 'petrol_pump_add', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(181, 'petrol_pump_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(182, 'truck_manage_add', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(183, 'truck_manage_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(184, 'trip_manage_add', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(185, 'trip_manage_edit', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(186, 'trip_manage_delete', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(187, 'trip_manage_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(188, 'trip_manage_gps_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(189, 'trip_manage_upload_pdo', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(190, 'trip_manage_pdf_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(191, 'approvle_adv_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(192, 'approvle_dsl_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(193, 'misclleneous_view', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(194, 'plant_laser', 'web', '2019-03-14 04:21:48', '2019-03-14 04:21:48', 1, 1, NULL, NULL),
(195, 'plant_payment', 'web', '2019-03-14 04:21:49', '2019-03-14 04:21:49', 1, 1, NULL, NULL),
(196, 'address_zone_view', 'web', '2019-03-14 04:21:49', '2019-03-14 04:21:49', 1, 1, NULL, NULL),
(197, 'vendor_add', 'web', '2019-03-14 04:21:49', '2019-03-14 04:21:49', 1, 1, NULL, NULL),
(198, 'vendor_view', 'web', '2019-03-14 04:21:49', '2019-03-14 04:21:49', 1, 1, NULL, NULL),
(199, 'category_add', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(200, 'category_view', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(201, 'sub_category_add', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(202, 'sub_category_view', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(203, 'plant_manage_add', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(204, 'plant_manage_edit', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(205, 'plant_manage_delete', 'web', '2019-03-14 04:53:11', '2019-03-14 04:53:11', 1, 1, NULL, NULL),
(206, 'plant_manage_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(207, 'party_manage_add', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(208, 'party_manage_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(209, 'petrol_pump_add', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(210, 'petrol_pump_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(211, 'truck_manage_add', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(212, 'truck_manage_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(213, 'trip_manage_add', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(214, 'trip_manage_edit', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(215, 'trip_manage_delete', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(216, 'trip_manage_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(217, 'trip_manage_gps_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(218, 'trip_manage_upload_pdo', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(219, 'trip_manage_pdf_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(220, 'consolidated_trip', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(221, 'approvle_adv_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(222, 'approvle_dsl_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(223, 'misclleneous_view', 'web', '2019-03-14 04:53:12', '2019-03-14 04:53:12', 1, 1, NULL, NULL),
(224, 'plant_laser', 'web', '2019-03-14 04:53:13', '2019-03-14 04:53:13', 1, 1, NULL, NULL),
(225, 'plant_payment', 'web', '2019-03-14 04:53:13', '2019-03-14 04:53:13', 1, 1, NULL, NULL),
(226, 'address_zone_view', 'web', '2019-03-14 04:53:13', '2019-03-14 04:53:13', 1, 1, NULL, NULL),
(227, 'vendor_add', 'web', '2019-03-14 04:53:13', '2019-03-14 04:53:13', 1, 1, NULL, NULL),
(228, 'vendor_view', 'web', '2019-03-14 04:53:13', '2019-03-14 04:53:13', 1, 1, NULL, NULL),
(229, 'category_add', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(230, 'category_edit', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(231, 'category_delete', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(232, 'category_view', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(233, 'sub_category_add', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(234, 'sub_category_edit', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(235, 'sub_category_delete', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(236, 'sub_category_view', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(237, 'plant_manage_add', 'web', '2019-03-15 07:18:38', '2019-03-15 07:18:38', 1, 1, NULL, NULL),
(238, 'plant_manage_edit', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(239, 'plant_manage_delete', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(240, 'plant_manage_view', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(241, 'party_manage_add', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(242, 'party_manage_edit', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(243, 'party_manage_delete', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(244, 'party_manage_view', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(245, 'petrol_pump_add', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(246, 'petrol_pump_edit', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(247, 'petrol_pump_delete', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(248, 'petrol_pump_view', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(249, 'truck_manage_add', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(250, 'truck_manage_edit', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(251, 'truck_manage_delete', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(252, 'truck_manage_view', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(253, 'truck_manage_gps_view', 'web', '2019-03-15 07:18:39', '2019-03-15 07:18:39', 1, 1, NULL, NULL),
(254, 'trip_manage_add', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(255, 'trip_manage_edit', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(256, 'trip_manage_delete', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(257, 'trip_manage_view', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(258, 'trip_manage_gps_view', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(259, 'trip_manage_upload_pdo', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(260, 'trip_manage_pdf_view', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(261, 'consolidated_trip', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(262, 'report_manage_print', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(263, 'report_manage_view', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(264, 'user_manage_add', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(265, 'user_manage_edit', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(266, 'user_manage_delete', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(267, 'user_manage_view', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(268, 'user_manage_assign_role', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(269, 'user_manage_add_role', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(270, 'user_manage_edit_role', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(271, 'user_manage_delete_role', 'web', '2019-03-15 07:18:40', '2019-03-15 07:18:40', 1, 1, NULL, NULL),
(272, 'user_manage_view_role', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(273, 'user_details', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(274, 'user_status', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(275, 'app_module_manage_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(276, 'app_module_manage_functionalities', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(277, 'notification_insurance_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(278, 'notification_permit_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(279, 'notification_tax_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(280, 'notification_pollution_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(281, 'notification_registration_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(282, 'approvle_adv_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(283, 'approvle_dsl_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(284, 'misclleneous_view', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(285, 'plant_laser', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(286, 'petrolpump_laser', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(287, 'petrolpump_payment', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(288, 'plant_payment', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(289, 'address_zone_add', 'web', '2019-03-15 07:18:41', '2019-03-15 07:18:41', 1, 1, NULL, NULL),
(290, 'address_zone_edit', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL),
(291, 'address_zone_delete', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL),
(292, 'address_zone_view', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL),
(293, 'vendor_add', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL),
(294, 'vendor_edit', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL),
(295, 'vendor_delete', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL),
(296, 'vendor_view', 'web', '2019-03-15 07:18:42', '2019-03-15 07:18:42', 1, 1, NULL, NULL);

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
(1, 'PETROL 1', 1, '323123131', 'test@ss.com', 'TEST', 'A', 'N', '2019-02-27 03:48:36', '2019-02-27 03:48:36', 1, NULL, NULL, NULL),
(2, 'PETROL 2', 4, '65656565', 'test@ss.com', 'TEST', 'A', 'N', '2019-03-11 02:22:53', '2019-03-11 02:23:03', 1, 1, NULL, NULL),
(3, 'WWWW', 19, '132132131', 'test@ss.com', 'TEST', 'A', 'N', '2019-03-11 06:34:32', '2019-03-11 06:34:32', 1, NULL, NULL, NULL),
(4, 'PP123456', 12, '32121312', 'test@ss.com', 'TEST', 'A', 'N', '2019-03-11 07:59:49', '2019-03-11 07:59:49', 1, NULL, NULL, NULL),
(5, 'PP 12_03_2019', 14, '654654564', 'test@ss.com', 'GGGGG', 'A', 'N', '2019-03-12 00:57:51', '2019-03-12 00:57:51', 1, NULL, NULL, NULL),
(6, 'Petrol Pump 299', 4, '2577656798', 'pp2@test.com', 'Person2', 'A', 'N', '2019-03-12 02:28:52', '2019-03-12 02:28:52', 1, NULL, NULL, NULL),
(7, 'Petrol Pump 2993', 4, '2577656798', 'pp2@test.com', 'Person2', 'A', 'N', '2019-03-12 03:10:00', '2019-03-12 03:10:00', 1, NULL, NULL, NULL),
(8, 'PP1', 47, '654564564', 'test@ss.com', 'TEST', 'A', 'N', '2019-03-12 05:31:05', '2019-03-12 05:31:05', 1, NULL, NULL, NULL),
(9, 'PP 14_03_2019', 31, '9654123687', 'san@ss.com', 'AJAY', 'A', 'N', '2019-03-14 01:42:29', '2019-03-14 01:42:29', 3, NULL, NULL, NULL),
(10, 'PETROL 1 QA', 4, '9877', 'qa1@gmail.com', 'SWETA', 'A', 'N', '2019-03-15 01:32:53', '2019-03-15 01:32:53', 1, NULL, NULL, NULL),
(11, 'SUJATA SERVICE STATION', 55, '9876431270', NULL, 'MR. GHOSH', 'A', 'N', '2019-03-24 10:15:21', '2019-03-24 10:15:21', 1, NULL, NULL, NULL),
(12, 'UTNI', 48, NULL, NULL, NULL, 'A', 'N', '2019-03-24 10:39:56', '2019-03-24 10:39:56', 5, NULL, NULL, NULL);

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
(1, 1, 2, 'D', 1, '3500.00', 'Diesel Amount paid to Drive named test', 1, NULL, NULL, 'A', 'N', '2019-02-27 03:49:32', '2019-03-06 06:14:25', 1, 1, NULL, NULL),
(2, 1, 1, 'D', 2, '1000.00', 'Diesel Amount paid to Drive named test', 1, NULL, NULL, 'A', 'N', '2019-03-12 00:26:52', '2019-03-12 00:26:52', 1, NULL, NULL, NULL),
(3, 5, 3, 'D', 3, '100.00', 'Diesel Amount paid to Drive named raju', 1, NULL, NULL, 'A', 'N', '2019-03-12 00:59:18', '2019-03-12 00:59:18', 1, NULL, NULL, NULL),
(4, 9, 4, 'D', 4, '5000.00', 'Diesel Amount paid to Drive named bijay', 3, NULL, NULL, 'A', 'N', '2019-03-14 01:42:46', '2019-03-14 01:42:46', 3, NULL, NULL, NULL),
(5, 1, 5, 'D', 5, '2222.00', 'Diesel Amount paid to Drive named bijay', 3, NULL, NULL, 'A', 'N', '2019-03-15 00:33:33', '2019-03-15 00:33:33', 3, NULL, NULL, NULL),
(6, 10, 1, 'D', 6, '90000.00', 'Diesel Amount paid to Drive named Mr. Abc', 1, NULL, NULL, 'A', 'N', '2019-03-15 01:36:56', '2019-03-15 01:36:56', 1, NULL, NULL, NULL),
(7, 10, 2, 'D', 7, '700.00', 'Diesel Amount paid to Drive named Alok', 5, NULL, NULL, 'A', 'N', '2019-03-15 07:32:45', '2019-03-15 07:32:45', 5, NULL, NULL, NULL),
(8, 1, 6, 'D', 8, '2555.00', 'Diesel Amount paid to Drive named raju', 2, NULL, NULL, 'A', 'N', '2019-03-15 07:40:12', '2019-03-15 07:40:12', 2, NULL, NULL, NULL),
(9, 1, NULL, 'C', NULL, '40000.00', 'Paying to Petrol Pump', 1, NULL, NULL, 'A', 'N', '2019-03-18 01:38:30', '2019-03-18 01:38:30', 1, NULL, NULL, NULL),
(10, 11, 9, 'D', 9, '0.00', 'Diesel Amount paid to Drive named abc', 5, NULL, NULL, 'A', 'N', '2019-03-24 10:46:54', '2019-03-24 10:46:54', 5, NULL, NULL, NULL),
(11, 11, 10, 'D', 10, '2000.00', 'Diesel Amount paid to Drive named RAM BHAROSA YADAV', 5, NULL, NULL, 'A', 'N', '2019-03-25 04:42:36', '2019-03-25 04:42:36', 5, NULL, NULL, NULL),
(12, 11, NULL, 'C', NULL, '10000.00', '122', 1, NULL, NULL, 'A', 'N', '2019-03-26 19:55:44', '2019-03-26 19:55:44', 1, NULL, NULL, NULL),
(13, 11, 11, 'D', 11, '5800.00', 'Diesel Amount paid to Drive named SANTOSH SHAW', 1, NULL, NULL, 'A', 'N', '2019-03-28 00:22:58', '2019-03-28 00:22:58', 1, NULL, NULL, NULL);

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
(1, 1, 1, 1, 2, 3, 2500, 2300, 1, '2019-02-28 04:11:00', 'Approved', NULL, 'I', 'N', '2019-02-28 04:10:22', '2019-03-12 00:13:23', 3, 3, NULL, NULL),
(2, 1, 1, 1, 2, 3, 2300, 3200, 1, '2019-02-28 04:17:54', 'Approved', NULL, 'I', 'N', '2019-02-28 04:15:02', '2019-03-12 00:13:23', 3, 3, NULL, NULL),
(3, 1, 1, 1, 2, 3, 3200, 10000, 1, '2019-02-28 04:21:12', 'Disapproved', 'not a valid amount', 'I', 'N', '2019-02-28 04:20:41', '2019-03-12 00:13:23', 3, 3, NULL, NULL),
(4, 1, 1, 1, 2, 1, 3200, 3500, 1, '2019-03-06 06:13:10', 'Approved', 'test', 'I', 'N', '2019-03-06 06:12:30', '2019-03-12 05:44:14', 1, 3, NULL, NULL),
(5, 1, 1, 1, 2, 1, 3500, 3200, 1, '2019-03-06 06:14:53', 'Approved', 'OK', 'I', 'N', '2019-03-06 06:13:59', '2019-03-12 00:13:23', 1, 3, NULL, NULL),
(6, 1, 1, 1, 2, 3, 3200, 3500, 1, '2019-03-12 00:13:52', 'Approved', 'the amount is approved', 'I', 'N', '2019-03-12 00:13:23', '2019-03-12 00:13:52', 3, NULL, NULL, NULL),
(7, 9, 4, 4, 4, 3, 5000, 5500, 1, '2019-03-14 01:46:32', 'Approved', 'Approved....', 'I', 'N', '2019-03-14 01:46:01', '2019-03-14 01:46:32', 3, NULL, NULL, NULL),
(8, 10, 6, 6, 1, 1, 90000, 10000, 2, '2019-03-15 07:28:48', 'Approved', 'approved', 'I', 'N', '2019-03-15 02:12:14', '2019-03-19 04:57:56', 1, 5, NULL, NULL),
(9, 1, 2, 2, 1, 1, 1000, 2000, 1, '2019-03-19 04:36:53', 'Approved', 'undefined', 'I', 'N', '2019-03-19 04:32:25', '2019-03-19 04:36:53', 1, NULL, NULL, NULL),
(10, 1, 5, 5, 5, 1, 2222, 3333, 1, '2019-03-19 04:54:47', 'Approved', 'test reason is here', 'I', 'N', '2019-03-19 04:47:30', '2019-03-19 04:54:47', 1, NULL, NULL, NULL),
(11, 10, 6, 6, 1, 5, 10000, 2000, 1, '2019-03-19 04:59:24', 'Disapproved', 'not approved', 'I', 'N', '2019-03-19 04:57:56', '2019-03-19 04:59:24', 5, NULL, NULL, NULL);

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
(1, 1, 'P', 'PLANT 1', 'TEST', NULL, NULL, NULL, -1000, 'A', 'N', '2019-02-27 03:46:29', '2019-03-15 07:40:13', 3, NULL, NULL, NULL),
(2, 2, 'P', 'PLANT 2', 'TEST', NULL, NULL, NULL, 10000, 'A', 'N', '2019-02-27 23:55:10', '2019-02-27 23:55:10', 1, NULL, NULL, NULL),
(3, 1, 'P', 'PLANT 3', 'TEST', NULL, NULL, NULL, -9000, 'A', 'N', '2019-03-11 01:58:33', '2019-03-12 00:26:53', 1, 1, NULL, NULL),
(4, 15, 'P', 'TEST NEW PLANT', 'TEST', NULL, NULL, NULL, 20000, 'A', 'N', '2019-03-11 06:19:37', '2019-03-11 06:19:37', 1, NULL, NULL, NULL),
(5, 19, 'P', 'FFSFSDFSDF', 'SDFSDF', NULL, NULL, NULL, 10000, 'A', 'N', '2019-03-11 07:57:58', '2019-03-11 07:57:58', 1, NULL, NULL, NULL),
(6, 14, 'P', 'PLANT 12_03_2019', 'TEST', NULL, NULL, NULL, -9000, 'A', 'N', '2019-03-12 00:49:20', '2019-03-12 00:59:18', 1, NULL, NULL, NULL),
(7, 2, 'P', 'Plant A9', 'Testing Description A', NULL, NULL, NULL, 115456, 'A', 'N', '2019-03-12 01:36:35', '2019-03-12 01:36:35', 1, NULL, NULL, NULL),
(8, 29, 'W', 'Wirehouse A9', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-03-12 01:36:41', '2019-03-12 01:36:41', 1, NULL, NULL, NULL),
(9, 12, 'W', 'Wirehouse B9', 'Testing Description 2', NULL, NULL, NULL, 310000, 'A', 'N', '2019-03-12 01:36:41', '2019-03-12 01:36:41', 1, NULL, NULL, NULL),
(10, 30, 'W', 'Wirehouse A91', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-03-12 01:37:25', '2019-03-12 01:37:25', 1, NULL, NULL, NULL),
(11, 44, 'P', 'P1', 'P1', NULL, NULL, NULL, 5000, 'A', 'N', '2019-03-12 05:23:05', '2019-03-12 05:24:49', 1, 1, NULL, NULL),
(12, 29, 'P', 'PLANT 14_03_2019', 'TEST', NULL, NULL, NULL, 10000, 'A', 'N', '2019-03-14 01:31:16', '2019-03-14 01:31:16', 3, NULL, NULL, NULL),
(13, 4, 'P', 'PLANT QA1', 'PLANT CREATED BY QA', NULL, NULL, NULL, 20045500, 'A', 'N', '2019-03-15 01:31:04', '2019-03-15 07:32:45', 1, NULL, NULL, NULL),
(14, 14, 'P', 'TEST98765', NULL, NULL, NULL, NULL, 1000, 'A', 'N', '2019-03-15 07:22:45', '2019-03-15 07:22:45', 2, NULL, NULL, NULL),
(15, 54, 'P', 'AMB SNK', 'AMBUJA CEMENT LIMTED - SANKRAIL UNIT', NULL, NULL, NULL, 7350, 'A', 'N', '2019-03-24 10:08:55', '2019-03-28 00:22:59', 1, 1, NULL, NULL),
(16, 48, 'P', 'UTNI', 'UTNI', NULL, NULL, NULL, 0, 'A', 'N', '2019-03-24 10:38:47', '2019-03-24 10:38:47', 5, NULL, NULL, NULL),
(17, 55, 'P', 'AMBUJA', 'AMBUJA - CEMENT PLANT - SNK', NULL, NULL, NULL, 10000, 'A', 'N', '2019-03-25 04:35:56', '2019-03-25 04:35:56', 5, NULL, NULL, NULL),
(18, 49, 'P', 'DALMIA CEMENT BHARAT LIMITED', 'DCBL-KHARAGPUR', NULL, NULL, NULL, 10000, 'A', 'N', '2019-03-25 07:43:52', '2019-03-25 07:43:52', 1, NULL, NULL, NULL),
(19, 55, 'P', 'JSW', 'JHINDAL CEMENT LIMITED', NULL, NULL, NULL, 10000, 'A', 'N', '2019-03-25 07:44:48', '2019-03-25 07:44:48', 1, NULL, NULL, NULL),
(20, 51, 'P', 'ULTRATECH CEMENT LIMITED', 'ULTRATECH CEMENT LIMITED-DANKUNI', NULL, NULL, NULL, 10000, 'A', 'N', '2019-03-25 07:46:10', '2019-03-25 07:46:10', 1, NULL, NULL, NULL);

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
(1, 1, 'C', NULL, '1000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-02-27 03:46:29', '2019-03-15 10:32:46', 1, NULL, NULL, NULL),
(2, 1, 'D', 1, '5000.00', 2, 'Advance Amount paid to Driver named test', 'A', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-02-27 03:49:32', '2019-03-15 10:32:43', 1, 1, NULL, NULL),
(3, 2, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-02-27 23:55:10', '2019-03-15 10:32:50', 1, NULL, NULL, NULL),
(4, 3, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-11 01:58:33', '2019-03-15 10:32:58', 1, 1, NULL, NULL),
(5, 4, 'C', NULL, '20000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-11 06:19:37', '2019-03-15 10:33:01', 1, NULL, NULL, NULL),
(6, 5, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-11 07:57:58', '2019-03-15 10:33:05', 1, NULL, NULL, NULL),
(7, 3, 'D', 2, '1000.00', 1, 'Advance Amount paid to Driver named test', 'A', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 00:26:52', '2019-03-15 10:32:54', 1, NULL, NULL, NULL),
(8, 6, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 00:49:20', '2019-03-15 10:33:14', 1, NULL, NULL, NULL),
(9, 6, 'D', 3, '1000.00', 3, 'Advance Amount paid to Driver named raju', 'A', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 00:59:18', '2019-03-15 10:33:09', 1, NULL, NULL, NULL),
(10, 7, 'C', NULL, '115456.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 01:36:35', '2019-03-15 10:33:18', 1, NULL, NULL, NULL),
(11, 8, 'C', NULL, '228787.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 01:36:41', '2019-03-15 10:33:29', 1, NULL, NULL, NULL),
(12, 9, 'C', NULL, '310000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 01:36:41', '2019-03-15 10:33:32', 1, NULL, NULL, NULL),
(13, 10, 'C', NULL, '228787.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 01:37:25', '2019-03-15 10:33:35', 1, NULL, NULL, NULL),
(14, 11, 'C', NULL, '5000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-12 05:23:05', '2019-03-15 10:33:38', 1, 1, NULL, NULL),
(15, 12, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 3, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 01:31:16', '2019-03-15 10:33:52', 3, NULL, NULL, NULL),
(16, 1, 'D', 4, '10000.00', 4, 'Advance Amount paid to Driver named bijay', 'A', 3, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 01:42:46', '2019-03-15 10:32:39', 3, NULL, NULL, NULL),
(17, 12, 'C', NULL, '200.00', NULL, 'test', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 04:24:22', '2019-03-15 10:33:48', 1, NULL, NULL, NULL),
(18, 1, 'D', NULL, '2000.00', NULL, 'test', 'M', 3, 'Approved', NULL, 1, '2019-03-14 05:39:04', 'A', 'N', '2019-03-14 04:40:03', '2019-03-15 10:32:36', 3, NULL, NULL, NULL),
(19, 1, 'C', NULL, '20000.00', NULL, 'Balance', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 04:41:13', '2019-03-15 10:32:33', 1, NULL, NULL, NULL),
(20, 1, 'D', NULL, '5000.00', NULL, 'test', 'M', 3, 'Approved', NULL, 1, '2019-03-14 05:25:48', 'A', 'N', '2019-03-14 05:25:34', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(21, 1, 'D', NULL, '100.00', NULL, 'test', 'M', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 05:49:15', '2019-03-15 10:43:48', 1, NULL, NULL, NULL),
(22, 1, 'D', NULL, '2323.00', NULL, 'rrrrr', 'M', 3, 'Approved', NULL, 1, '2019-03-14 05:49:56', 'A', 'N', '2019-03-14 05:49:36', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(23, 1, 'D', NULL, '1111.00', NULL, 'aasf', 'M', 3, 'Approved', NULL, 1, '2019-03-14 05:52:43', 'A', 'N', '2019-03-14 05:52:24', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(24, 1, 'D', NULL, '2222.00', NULL, 'test', 'M', 3, 'Approved', NULL, 1, '2019-03-14 05:55:57', 'A', 'N', '2019-03-14 05:54:11', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(25, 1, 'D', NULL, '5555.00', NULL, 'test description', 'M', 3, 'Approved', NULL, 1, '2019-03-14 05:58:13', 'A', 'N', '2019-03-14 05:57:57', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(26, 12, 'C', NULL, '500.00', NULL, 'test', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 05:58:33', '2019-03-15 10:33:45', 1, NULL, NULL, NULL),
(27, 12, 'D', NULL, '900.00', NULL, 'test', 'M', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 05:58:54', '2019-03-15 10:33:42', 1, NULL, NULL, NULL),
(28, 1, 'C', NULL, '50000.00', NULL, 'balnce', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-14 06:00:00', '2019-03-15 10:43:48', 1, NULL, NULL, NULL),
(29, 1, 'D', 5, '10000.00', 5, 'Advance Amount paid to Driver named bijay', 'A', 3, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-15 00:33:33', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(30, 1, 'D', NULL, '1000.00', NULL, 'test', 'M', 3, 'Approved', NULL, 1, '2019-03-15 00:45:23', 'A', 'N', '2019-03-15 00:44:05', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(31, 13, 'C', NULL, '20000000.00', NULL, 'Balance Initiation', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-15 01:31:04', '2019-03-15 10:34:06', 1, NULL, NULL, NULL),
(32, 13, 'D', 6, '4500.00', 1, 'Advance Amount paid to Driver named Mr. Abc', 'A', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-15 01:36:56', '2019-03-15 10:34:02', 1, NULL, NULL, NULL),
(33, 13, 'D', NULL, '5000.00', NULL, 'adding payment in plant', 'M', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-15 03:49:09', '2019-03-15 10:33:58', 1, NULL, NULL, NULL),
(34, 1, 'D', NULL, '3456.00', NULL, 'test', 'M', 3, 'Approved', NULL, NULL, NULL, 'I', 'N', '2019-03-15 03:51:49', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(35, 13, 'D', NULL, '1000.00', NULL, 'abc', 'M', 5, 'Approved', NULL, NULL, NULL, 'I', 'N', '2019-03-15 03:56:15', '2019-03-15 10:33:55', 5, NULL, NULL, NULL),
(36, 1, 'D', NULL, '3456.00', NULL, 'test', 'M', 3, 'Approved', NULL, NULL, NULL, 'I', 'N', '2019-03-15 04:24:21', '2019-03-15 10:43:48', 3, NULL, NULL, NULL),
(37, 1, 'D', NULL, '10000.00', NULL, 'test', 'M', 3, 'Disapproved', 'not approved', 1, '2019-03-15 05:18:21', 'I', 'N', '2019-03-15 05:14:33', '2019-03-15 05:18:21', 3, NULL, NULL, NULL),
(38, 1, 'D', NULL, '10000.00', NULL, 'test', 'M', 3, 'Approved', 'test', 1, '2019-03-15 05:17:28', 'I', 'N', '2019-03-15 05:14:33', '2019-03-15 05:17:28', 3, NULL, NULL, NULL),
(39, 1, 'D', NULL, '9999.00', NULL, 'test description', 'M', 3, 'Disapproved', 'testing reason for not approving', 1, '2019-03-15 05:20:20', 'I', 'N', '2019-03-15 05:19:44', '2019-03-15 05:20:20', 3, NULL, NULL, NULL),
(40, 1, 'C', NULL, '56789.00', NULL, 'balance', 'BG', 1, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-15 05:21:05', '2019-03-15 05:21:05', 1, NULL, NULL, NULL),
(41, 1, 'C', NULL, '77777.00', NULL, 'dddd', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-15 05:29:46', '2019-03-15 05:29:46', 1, NULL, NULL, NULL),
(42, 1, 'D', NULL, '8888.00', NULL, 'test desc', 'M', 3, 'Approved', 'test', 1, '2019-03-15 05:30:52', 'I', 'N', '2019-03-15 05:30:25', '2019-03-15 05:30:52', 3, NULL, NULL, NULL),
(43, 13, 'D', NULL, '2000.00', NULL, 'testing', 'M', 5, 'Disapproved', 'No', 2, '2019-03-15 07:29:07', 'I', 'N', '2019-03-15 05:57:45', '2019-03-15 07:29:07', 5, NULL, NULL, NULL),
(44, 14, 'C', NULL, '1000.00', NULL, 'Balance Initiation', 'BG', 2, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-15 07:22:45', '2019-03-15 07:22:45', 2, NULL, NULL, NULL),
(45, 13, 'D', 7, '50000.00', 2, 'Advance Amount paid to Driver named Alok', 'A', 5, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-15 07:32:45', '2019-03-15 07:32:45', 5, NULL, NULL, NULL),
(46, 1, 'D', 8, '1000.00', 6, 'Advance Amount paid to Driver named raju', 'A', 2, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-15 07:40:12', '2019-03-15 07:40:12', 2, NULL, NULL, NULL),
(47, 13, 'D', NULL, '30000.00', NULL, 'desc', 'M', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-19 04:33:44', '2019-03-19 04:33:44', 1, NULL, NULL, NULL),
(48, 13, 'D', NULL, '2000.00', NULL, 'abc', 'M', 5, 'Approved', 'undefined', 1, '2019-03-19 04:36:19', 'I', 'N', '2019-03-19 04:35:14', '2019-03-19 04:36:19', 5, NULL, NULL, NULL),
(49, 13, 'D', NULL, '2000.00', NULL, 'abc', 'M', 5, 'Disapproved', 'Not ok', 1, '2019-03-19 05:10:56', 'I', 'N', '2019-03-19 05:10:21', '2019-03-19 05:10:56', 5, NULL, NULL, NULL),
(50, 15, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 1, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-24 10:08:56', '2019-03-24 10:09:27', 1, 1, NULL, NULL),
(51, 16, 'C', NULL, '0.00', NULL, 'Balance Initiation', 'BG', 5, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-24 10:38:47', '2019-03-24 10:38:47', 5, NULL, NULL, NULL),
(52, 15, 'D', 9, '6850.00', 9, 'Advance Amount paid to Driver named abc', 'A', 5, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-24 10:46:54', '2019-03-24 10:46:54', 5, NULL, NULL, NULL),
(53, 17, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 5, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-25 04:35:56', '2019-03-25 04:35:56', 5, NULL, NULL, NULL),
(54, 15, 'D', 10, '2500.00', 10, 'Advance Amount paid to Driver named RAM BHAROSA YADAV', 'A', 5, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-25 04:42:36', '2019-03-25 04:42:36', 5, NULL, NULL, NULL),
(55, 17, 'C', NULL, '10000.00', NULL, 'ADVANCE', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-25 04:57:55', '2019-03-25 04:57:55', 1, NULL, NULL, NULL),
(56, 17, 'C', NULL, '20000.00', NULL, 'ADVANCE', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-25 04:59:01', '2019-03-25 04:59:01', 1, NULL, NULL, NULL),
(57, 18, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-25 07:43:52', '2019-03-25 07:43:52', 1, NULL, NULL, NULL),
(58, 19, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-25 07:44:48', '2019-03-25 07:44:48', 1, NULL, NULL, NULL),
(59, 20, 'C', NULL, '10000.00', NULL, 'Balance Initiation', 'BG', 1, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-25 07:46:10', '2019-03-25 07:46:10', 1, NULL, NULL, NULL),
(60, 15, 'D', 11, '3000.00', 11, 'Advance Amount paid to Driver named SANTOSH SHAW', 'A', 1, 'Pending', NULL, NULL, NULL, 'A', 'N', '2019-03-28 00:22:58', '2019-03-28 00:22:58', 1, NULL, NULL, NULL),
(61, 17, 'C', NULL, '50000.00', NULL, 'ADV TRANSFER TO PLANT', 'BG', 1, 'Approved', NULL, NULL, NULL, 'A', 'N', '2019-03-28 00:31:29', '2019-03-28 00:31:29', 1, NULL, NULL, NULL);

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
(1, 1, 1, 2, 2, 3, 3000, 3100, 1, '2019-02-28 04:00:39', 'Approved', NULL, 'I', 'N', '2019-02-28 04:00:03', '2019-03-19 04:32:13', 3, 1, NULL, NULL),
(2, 1, 1, 2, 2, 3, 3100, 5000, 1, '2019-02-28 04:04:47', 'Approved', NULL, 'I', 'N', '2019-02-28 04:04:07', '2019-03-19 04:32:13', 3, 1, NULL, NULL),
(3, 1, 1, 2, 2, 3, 5000, 40000, 1, '2019-03-11 23:47:35', 'Disapproved', 'its not correct amount', 'I', 'N', '2019-02-28 04:30:23', '2019-03-19 04:32:13', 3, 1, NULL, NULL),
(4, 1, 1, 2, 2, 3, 5000, 3100, 1, '2019-03-12 00:14:56', 'Approved', 'approved kjdfkjskdfj kfjksadfj', 'I', 'N', '2019-03-12 00:11:48', '2019-03-19 04:32:13', 3, 1, NULL, NULL),
(5, 1, 4, 16, 4, 3, 10000, 12000, 1, '2019-03-14 01:45:41', 'Approved', 'Amount is approved !!!!', 'I', 'N', '2019-03-14 01:44:15', '2019-03-19 04:47:21', 3, 1, NULL, NULL),
(6, 1, 1, 2, 2, 3, 3100, 5000, 1, '2019-03-15 00:40:31', 'Disapproved', 'ttttttt', 'I', 'N', '2019-03-15 00:39:54', '2019-03-19 04:32:13', 3, 1, NULL, NULL),
(7, 1, 1, 2, 2, 3, 3100, 40000, 1, '2019-03-15 00:41:00', 'Approved', 'ggggg', 'I', 'N', '2019-03-15 00:40:47', '2019-03-19 04:32:13', 3, 1, NULL, NULL),
(8, 13, 6, 32, 1, 1, 4500, 5000, 1, '2019-03-15 06:53:39', 'Approved', 'this is approved', 'I', 'N', '2019-03-15 02:09:30', '2019-03-19 04:57:45', 1, 5, NULL, NULL),
(9, 1, 8, 46, 6, 2, 1000, 5000, 2, '2019-03-14 19:44:15', 'Approved', 'test note', 'I', 'N', '2019-03-15 07:43:55', '2019-03-15 07:44:39', 2, 2, NULL, NULL),
(10, 1, 8, 46, 6, 2, 5000, 8222, 2, '2019-03-14 19:45:02', 'Disapproved', 'test reason', 'I', 'N', '2019-03-15 07:44:40', '2019-03-15 07:45:02', 2, NULL, NULL, NULL),
(11, 1, 1, 2, 2, 1, 40000, 1000, 1, '2019-03-19 04:26:13', 'Disapproved', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book', 'I', 'N', '2019-03-19 04:10:52', '2019-03-19 04:32:13', 1, 1, NULL, NULL),
(12, 1, 1, 2, 2, 1, 40000, 5000, 1, '2019-03-19 04:36:42', 'Approved', 'undefined', 'I', 'N', '2019-03-19 04:32:13', '2019-03-19 04:36:42', 1, NULL, NULL, NULL),
(13, 1, 4, 16, 4, 1, 12000, 13000, 1, '2019-03-19 04:54:26', 'Approved', 'test reason is here', 'I', 'N', '2019-03-19 04:47:21', '2019-03-19 04:54:26', 1, NULL, NULL, NULL),
(14, 13, 6, 32, 1, 5, 5000, 1000, 1, '2019-03-19 04:58:42', 'Approved', 'ok', 'I', 'N', '2019-03-19 04:57:45', '2019-03-19 04:58:42', 5, NULL, NULL, NULL);

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
(1, 1, 3, 'N', '2019-02-27 23:43:04', 1, '2019-02-27 23:43:04', NULL, NULL),
(2, 2, 4, 'N', '2019-02-27 23:55:35', 1, '2019-02-27 23:55:35', NULL, NULL),
(3, 13, 5, 'Y', '2019-03-24 16:07:24', 1, '2019-03-24 10:37:24', '2019-03-24 10:37:24', 1),
(4, 15, 5, 'N', '2019-03-24 10:37:24', 1, '2019-03-24 10:37:24', NULL, NULL);

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
(1, 'Admin', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(2, 'Accountant', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL),
(3, 'Supervisor', 'web', '2019-01-03 13:00:00', '2019-01-03 13:00:00', 1, 1, NULL, NULL);

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
(199, 3),
(200, 3),
(201, 3),
(202, 3),
(203, 3),
(204, 3),
(205, 3),
(206, 3),
(207, 3),
(208, 3),
(209, 3),
(210, 3),
(211, 3),
(212, 3),
(213, 3),
(214, 3),
(215, 3),
(216, 3),
(217, 3),
(218, 3),
(219, 3),
(220, 3),
(221, 3),
(222, 3),
(223, 3),
(224, 3),
(225, 3),
(226, 3),
(227, 3),
(228, 3),
(229, 2),
(230, 2),
(231, 2),
(232, 2),
(233, 2),
(234, 2),
(235, 2),
(236, 2),
(237, 2),
(238, 2),
(239, 2),
(240, 2),
(241, 2),
(242, 2),
(243, 2),
(244, 2),
(245, 2),
(246, 2),
(247, 2),
(248, 2),
(249, 2),
(250, 2),
(251, 2),
(252, 2),
(253, 2),
(254, 2),
(255, 2),
(256, 2),
(257, 2),
(258, 2),
(259, 2),
(260, 2),
(261, 2),
(262, 2),
(263, 2),
(264, 2),
(265, 2),
(266, 2),
(267, 2),
(268, 2),
(269, 2),
(270, 2),
(271, 2),
(272, 2),
(273, 2),
(274, 2),
(275, 2),
(276, 2),
(277, 2),
(278, 2),
(279, 2),
(280, 2),
(281, 2),
(282, 2),
(283, 2),
(284, 2),
(285, 2),
(286, 2),
(287, 2),
(288, 2),
(289, 2),
(290, 2),
(291, 2),
(292, 2),
(293, 2),
(294, 2),
(295, 2),
(296, 2);

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
  `trip_status` enum('Awaiting','Running','Cancelled','Settled','Unsettled','Closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Awaiting' COMMENT '''Awaiting'',''Running'',''Cancelled'',''Settled'',''Unsettled'',''Closed''',
  `GPS_trip_status` enum('Start','End') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Start',
  `POD_status` enum('No','Yes','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `POD_uploaded_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `POD_uploaded_at` timestamp NULL DEFAULT NULL,
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

INSERT INTO `ss_trips` (`id`, `trip_date`, `lr_no`, `category_id`, `subcategory_id`, `plant_id`, `invoice_challan_no`, `do_shipment_no`, `party_id`, `vendor_id`, `truck_id`, `quantity`, `truck_owner`, `truck_driver_name`, `truck_driver_phone_number`, `truck_driver_email`, `petrol_pump_id`, `advance_amount`, `diesel_amount`, `trip_status`, `GPS_trip_status`, `POD_status`, `POD_uploaded_by`, `POD_uploaded_at`, `description`, `additional1`, `additional2`, `additional3`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`, `closed_at`, `closed_by`, `closing_reason`) VALUES
(1, '2019-02-27 18:30:00', 'LR1234', 1, '1', 1, '123545', 'SH1234', 1, 1, 2, '1001', 'ROHIT SINGH', 'test', '13213132', 'test@ss.com', 1, 5000, 3500, 'Settled', 'End', 'Yes', 3, '2019-03-13 05:09:12', 'test 12345', 'test1', 'test2', 'test3', 'A', 'N', '2019-02-27 00:49:32', '2019-03-19 04:36:42', 1, 1, NULL, NULL, NULL, NULL, NULL),
(2, '2019-03-11 18:30:00', '12345', 1, '1', 1, '12345', '12345', 4, 1, 1, '100', 'ROHIT SINGH', 'test', '31231231', 'test@ss.com', 1, 1000, 2000, 'Settled', 'Start', 'Yes', 3, '2019-03-14 01:57:36', 'test desc', 'test', 'test', 'test', 'A', 'N', '2019-03-12 00:26:52', '2019-03-19 04:36:53', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '2019-03-12 18:30:00', 'LR12345', 2, '2', 6, 'CH12345', 'SH12345', 10, 2, 3, '500', 'TEST PERSON', 'raju', '6456464564', 'raju@ss.com', 5, 1000, 100, 'Settled', 'Start', 'Yes', 2, '2019-03-19 01:31:10', 'test desc', 'test additional 1', 'test additional 2', 'test additional 3', 'A', 'N', '2019-03-12 00:59:17', '2019-03-19 01:32:04', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(4, '2019-03-14 18:30:00', 'LR12345', 3, '3', 1, 'CH12345', 'SH12345', 12, 4, 4, '1000', 'AJAY', 'bijay', '31654564', 'test@ss.com', 9, 13000, 5500, 'Settled', 'Start', 'Yes', 3, '2019-03-14 01:49:36', 'test', 'test1', 'test2', 'test3', 'A', 'N', '2019-03-14 01:42:46', '2019-03-19 04:54:26', 3, NULL, NULL, NULL, NULL, NULL, NULL),
(5, '2019-03-20 18:30:00', 'dddd', 1, '1', 1, 'ddddd', 'dddd', 1, 2, 5, '1111', 'ROHIT SINGH', 'bijay', '1243234234', 'test@ss.com', 1, 10000, 3333, 'Settled', 'End', 'Yes', 1, '2019-03-19 01:53:45', 'erwerwerewr', '111', '111', '1111', 'A', 'N', '2019-03-15 00:33:33', '2019-03-24 10:57:25', 3, 2, NULL, NULL, '2019-03-24 10:57:05', 2, 'Complete'),
(6, '2019-03-15 18:30:00', '25344', 4, '4', 13, '22122', '8768667', 13, 1, 1, '2333', 'ADMIN', 'Mr. Abc', '9896786556', 'aa@gmail.com', 10, 1000, 10000, 'Settled', 'Start', 'Yes', 1, '2019-03-15 07:01:50', 'Hello Description', 'abc', 'aaa', 'bbb', 'A', 'N', '2019-03-15 01:36:56', '2019-03-19 04:58:42', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(7, '2019-03-17 18:30:00', '5677', 4, '4', 13, '452122', '56656434', 13, 1, 2, '900', 'ADMIN', 'Alok', '12345678', 'alok@gmail.com', 10, 50000, 700, 'Settled', 'Start', 'Yes', 2, '2019-03-19 01:33:26', 'Test', 'Abc', 'EFg', 'Hik', 'A', 'N', '2019-03-15 07:32:45', '2019-03-20 10:49:51', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(8, '2019-03-20 18:30:00', '12345', 1, '1', 1, '12345', '12345', 12, 1, 6, '100', 'ADMIN', 'raju', NULL, '\'\'', 1, 5000, 2555, 'Settled', 'Start', 'Yes', 1, '2019-03-19 01:27:48', 'test', 'test', 'test', 'test', 'A', 'N', '2019-03-15 07:40:12', '2019-03-21 19:10:03', 2, NULL, NULL, NULL, NULL, NULL, NULL),
(9, '2019-03-23 18:30:00', '813\07623', 6, '5', 15, '123456', '5308676211', 20, 5, 9, '17', 'SUMIT MONDAL', 'abc', '987854671', '\'\'', 11, 6850, 0, 'Settled', 'End', 'Yes', 5, '2019-03-24 10:50:45', '0', '0', '0', '0', 'A', 'N', '2019-03-24 10:46:54', '2019-03-24 10:56:28', 5, 5, NULL, NULL, '2019-03-24 10:53:07', 5, 'Complete'),
(10, '2019-03-24 18:30:00', 'SSL/8649-U', 6, '6', 15, 'WB1803121549', '3001400831-U', 21, 8, 10, '22', 'RAM BHAROSA YADAV', 'RAM BHAROSA YADAV', '9830012345', '\'\'', 11, 2500, 2000, 'Running', 'Start', 'Yes', 1, '2019-03-25 05:02:04', 'SLIP NO-249/BY SRAVAN', '9830025124', 'SUMON', 'LOWER CHAMBI GAON, P.S KURSEONG, P.O SITTONG 1', 'A', 'N', '2019-03-25 04:42:36', '2019-03-25 05:02:04', 5, NULL, NULL, NULL, NULL, NULL, NULL),
(11, '2019-03-26 18:30:00', '813\07674', 6, '6', 15, '813\07674', '5308679479', 21, 9, 11, '21', 'LALLAN KUMAR SHAW', 'SANTOSH SHAW', NULL, NULL, 11, 3000, 5800, 'Running', 'Start', 'No', NULL, NULL, 'DHULAGARH TO DANTAN 21MT AMB CEMENT ADV DIESEL', '8670427936', 'LALLAN KUMAR SHAW', 'ORRISA', 'A', 'N', '2019-03-28 00:22:58', '2019-03-28 00:22:58', 1, NULL, NULL, NULL, NULL, NULL, NULL);

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

--
-- Dumping data for table `ss_trip_payment_managements`
--

INSERT INTO `ss_trip_payment_managements` (`id`, `trip_id`, `freight_charge`, `toll`, `unloading_charge`, `tare_charge`, `balance`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 100.00, 200.00, 300.00, 400.00, 394400.00, 'A', 'N', '2019-03-13 01:23:06', '2019-03-13 01:23:06', 1, NULL, NULL, NULL),
(2, 4, 100.00, 200.00, 300.00, 400.00, 383100.00, 'A', 'N', '2019-03-14 01:53:41', '2019-03-14 01:53:41', 1, NULL, NULL, NULL),
(3, 2, 1000.00, 2000.00, 3000.00, 4000.00, 404000.00, 'A', 'N', '2019-03-14 02:37:49', '2019-03-14 02:37:59', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_trip_POD`
--

CREATE TABLE `ss_trip_POD` (
  `id` bigint(20) NOT NULL,
  `trip_id` bigint(20) NOT NULL COMMENT 'primary key of ''trips''',
  `pod_file` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('Pending','Approved','Disapproved') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
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
(1, 1, 'pod_1552473552.jpeg', 'Approved', 'N', 1, 'test', '2019-03-13 05:09:12', '2019-03-13 05:09:32'),
(2, 2, 'pod_1552474533.jpeg', 'Disapproved', 'N', 1, 'test', '2019-03-13 05:25:34', '2019-03-13 05:25:58'),
(3, 2, 'pod_1552474594.jpeg', 'Disapproved', 'N', 1, 'test', '2019-03-13 05:26:34', '2019-03-13 06:16:32'),
(4, 2, 'pod_1552477633.jpeg', 'Disapproved', 'N', 1, 'testg', '2019-03-13 06:17:13', '2019-03-13 06:18:13'),
(5, 2, 'pod_1552543276.jpg', 'Disapproved', 'N', 1, 'test reason', '2019-03-14 00:31:16', '2019-03-14 00:57:43'),
(6, 2, 'pod_1552546078.png', 'Disapproved', 'N', 1, 'This is not any POD. Please upload proper POD', '2019-03-14 01:17:59', '2019-03-14 01:21:07'),
(7, 2, 'pod_1552547050.jpg', 'Disapproved', 'N', 1, 'test reason', '2019-03-14 01:34:10', '2019-03-14 01:34:50'),
(8, 4, 'pod_1552547823.jpeg', 'Disapproved', 'N', 1, 'Please upload POD instead of image of dogs !!!!', '2019-03-14 01:47:03', '2019-03-14 01:48:36'),
(9, 4, 'pod_1552547976.jpeg', 'Approved', 'N', 1, 'Approved', '2019-03-14 01:49:36', '2019-03-14 01:49:57'),
(10, 2, 'pod_1552548456.png', 'Approved', 'N', 1, 'drfyhg', '2019-03-14 01:57:36', '2019-03-15 00:32:03'),
(11, 5, 'pod_1552629903.jpg', 'Disapproved', 'N', 1, 'test', '2019-03-15 00:35:03', '2019-03-15 00:36:09'),
(12, 6, 'pod_1552653110.jpeg', 'Approved', 'N', 2, 'undefined', '2019-03-15 07:01:50', '2019-03-19 01:01:56'),
(13, 8, 'pod_1552655470.jpeg', 'Disapproved', 'N', 2, 'test', '2019-03-15 07:41:11', '2019-03-15 07:41:29'),
(14, 8, 'pod_1552978668.jpeg', 'Approved', 'N', 1, 'test reason', '2019-03-19 01:27:48', '2019-03-19 01:28:05'),
(15, 3, 'pod_1552978870.jpg', 'Approved', 'N', 2, 'yes approved...', '2019-03-19 01:31:10', '2019-03-19 01:32:04'),
(16, 7, 'pod_1552978963.jpg', 'Disapproved', 'N', 2, 'test', '2019-03-19 01:32:43', '2019-03-19 01:32:59'),
(17, 7, 'pod_1552979006.jpg', 'Approved', 'N', 2, 'test', '2019-03-19 01:33:26', '2019-03-19 01:33:40'),
(18, 5, 'pod_1552980217.jpeg', 'Approved', 'N', 2, 'OK', '2019-03-19 01:53:37', '2019-03-24 10:57:25'),
(19, 5, 'pod_1552980225.jpeg', 'Pending', 'N', NULL, NULL, '2019-03-19 01:53:45', '2019-03-24 10:57:25'),
(20, 9, 'pod_1553444445.JPG', 'Approved', 'N', 2, 'OK', '2019-03-24 10:50:46', '2019-03-24 10:56:28'),
(21, 10, 'pod_1553509924.PDF', 'Pending', 'Y', NULL, NULL, '2019-03-25 05:02:04', '2019-03-25 05:02:04');

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
(1, 1, 'M', 'WB-03B-8820', 'A', 'N', '2019-02-26 03:18:19', '2019-02-26 03:18:19', 1, NULL, NULL, NULL),
(2, 1, 'M', 'WB-09Y-9817', 'A', 'N', '2019-02-27 03:45:19', '2019-02-27 03:45:19', 1, NULL, NULL, NULL),
(3, 2, 'M', 'WB-01B-9273', 'A', 'N', '2019-03-12 00:46:03', '2019-03-12 00:46:03', 1, NULL, NULL, NULL),
(4, 4, 'M', 'WB-14M-2019', 'A', 'N', '2019-03-14 01:29:51', '2019-03-14 01:29:51', 3, NULL, NULL, NULL),
(5, 2, 'M', 'WB-09R-9873', 'A', 'N', '2019-03-15 00:33:07', '2019-03-15 00:33:07', 3, NULL, NULL, NULL),
(6, 1, 'C', 'WB-09U-1928', 'A', 'N', '2019-03-15 04:19:11', '2019-03-24 10:30:24', 1, 1, NULL, NULL),
(7, 7, 'M', 'WB-23A-8265', 'A', 'N', '2019-03-24 10:20:56', '2019-03-24 10:20:56', 1, NULL, NULL, NULL),
(8, 1, 'C', 'WB-25G-2867', 'A', 'N', '2019-03-24 10:22:52', '2019-03-24 10:27:13', 1, 1, NULL, NULL),
(9, 5, 'M', 'WB-29A-4123', 'A', 'N', '2019-03-24 10:44:55', '2019-03-24 10:44:55', 5, NULL, NULL, NULL),
(10, 8, 'M', 'WB-23A-9091', 'A', 'N', '2019-03-25 04:31:12', '2019-03-25 04:31:12', 5, NULL, NULL, NULL),
(11, 9, 'M', 'WB-65A-6531', 'I', 'N', '2019-03-27 23:58:17', '2019-03-27 23:58:17', 1, NULL, NULL, NULL);

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

--
-- Dumping data for table `ss_truck_insurances`
--

INSERT INTO `ss_truck_insurances` (`id`, `truck_id`, `policy_no`, `name`, `policy_on`, `policy_start`, `policy_end`, `policy_file`, `status`, `read_status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 6, 'FFFFFF', NULL, '2019-02-28 18:30:00', NULL, '2019-03-26 18:30:00', '', 'A', '1', 'N', '2019-03-15 04:19:11', '2019-03-24 10:30:24', 1, 1, NULL, NULL),
(2, 8, 'WB25G2867', NULL, '2019-03-10 18:30:00', NULL, '2019-03-24 18:30:00', '', 'A', '1', 'N', '2019-03-24 10:22:52', '2019-03-24 10:27:13', 1, 1, NULL, NULL);

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

--
-- Dumping data for table `ss_truck_permits`
--

INSERT INTO `ss_truck_permits` (`id`, `truck_id`, `permit_no`, `name`, `permit_on`, `permit_start`, `permit_end`, `permit_file`, `status`, `read_status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 6, 'RRRRRRR', NULL, '2019-02-28 18:30:00', NULL, '2019-04-13 18:30:00', '', 'A', '1', 'N', '2019-03-15 04:19:11', '2019-03-24 10:30:24', 1, 1, NULL, NULL),
(2, 8, 'SDAS', NULL, '2019-03-17 18:30:00', NULL, '2019-03-24 18:30:00', '', 'A', '1', 'N', '2019-03-24 10:22:53', '2019-03-24 10:27:13', 1, 1, NULL, NULL);

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

--
-- Dumping data for table `ss_truck_pollutions`
--

INSERT INTO `ss_truck_pollutions` (`id`, `truck_id`, `pollution_no`, `name`, `pollution_on`, `pollution_start`, `pollution_end`, `pollution_file`, `status`, `read_status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 6, 'FGFGH', NULL, '2019-02-28 18:30:00', NULL, '2019-03-27 18:30:00', '', 'A', '1', 'N', '2019-03-15 04:19:11', '2019-03-24 10:30:24', 1, 1, NULL, NULL),
(2, 8, 'WB25G2867', NULL, '2019-03-03 18:30:00', NULL, '2019-03-25 18:30:00', '', 'A', '1', 'N', '2019-03-24 10:22:53', '2019-03-24 10:27:13', 1, 1, NULL, NULL);

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
(1, 1, NULL, NULL, NULL, NULL, NULL, '', 'A', '1', 'N', '2019-02-26 03:18:19', '2019-03-24 10:31:03', 1, NULL, NULL, NULL),
(2, 2, NULL, NULL, NULL, NULL, NULL, '', 'A', '1', 'N', '2019-02-27 03:45:19', '2019-03-24 10:31:03', 1, NULL, NULL, NULL),
(3, 3, NULL, NULL, NULL, NULL, NULL, '', 'A', '1', 'N', '2019-03-12 00:46:03', '2019-03-24 10:31:03', 1, NULL, NULL, NULL),
(4, 4, NULL, NULL, NULL, NULL, NULL, '', 'A', '1', 'N', '2019-03-14 01:29:51', '2019-03-24 10:31:03', 3, NULL, NULL, NULL),
(5, 5, NULL, NULL, NULL, NULL, NULL, '', 'A', '1', 'N', '2019-03-15 00:33:07', '2019-03-24 10:31:03', 3, NULL, NULL, NULL),
(6, 6, NULL, NULL, '2019-02-28 18:30:00', NULL, '2019-03-27 18:30:00', '', 'A', '1', 'N', '2019-03-15 04:19:11', '2019-03-24 10:31:03', 1, 1, NULL, NULL),
(7, 7, NULL, NULL, NULL, NULL, NULL, '', 'A', '1', 'N', '2019-03-24 10:20:56', '2019-03-24 10:31:03', 1, NULL, NULL, NULL),
(8, 8, NULL, NULL, '2019-02-28 18:30:00', NULL, '2019-03-24 18:30:00', '', 'A', '1', 'N', '2019-03-24 10:22:52', '2019-03-24 10:31:03', 1, 1, NULL, NULL),
(9, 9, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-03-24 10:44:55', '2019-03-24 10:44:55', 5, NULL, NULL, NULL),
(10, 10, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-03-25 04:31:12', '2019-03-25 04:31:12', 5, NULL, NULL, NULL),
(11, 11, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-03-27 23:58:17', '2019-03-27 23:58:17', 1, NULL, NULL, NULL);

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

--
-- Dumping data for table `ss_truck_taxes`
--

INSERT INTO `ss_truck_taxes` (`id`, `truck_id`, `invoice_no`, `name`, `tax_paid_date`, `tax_period_start`, `tax_period_end`, `tax_file`, `status`, `read_status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 6, 'WEWRRE', NULL, '2019-02-28 18:30:00', NULL, '2019-03-26 18:30:00', '', 'A', '1', 'N', '2019-03-15 04:19:11', '2019-03-24 10:30:47', 1, 1, NULL, NULL),
(2, 8, 'WB25G2867', NULL, '2019-03-03 18:30:00', NULL, '2019-03-24 18:30:00', '', 'A', '1', 'N', '2019-03-24 10:22:53', '2019-03-24 10:30:47', 1, 1, NULL, NULL);

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
(1, 1, 'admin@sslogistic.com', '$2y$10$xYOk6DFgBqfq90thBPDzguVHiZa8TMKi6e.eAHt1bNRVz.JPLRMcW', 'Admin', '9876543210', 'image_1552559792.jpeg', '', '2019-03-29 01:06:50', NULL, NULL, 'A', 'N', '2018-12-23 07:30:00', '2019-03-29 01:06:50', 0, 1, NULL, NULL),
(2, 2, 'accountant@yopmail.com', '$2y$10$qe/2.XvDgEn8TpYek2Uh3OzaQptnUhJwugGxI4pZhWzOnZ79gWwrq', 'Accountant', '13232323', NULL, '', '2019-03-25 04:48:54', 'e3d3j8o8', '2019-03-15 07:20:16', 'A', 'N', '2019-02-27 23:42:18', '2019-03-25 04:48:54', 1, 1, NULL, NULL),
(3, 3, 'supervisor@yopmail.com', '$2y$10$920ElxqvYHaAfCbdn.wFVuVK9J2r4sTjmX/SSz5A5OACRvy7vHtk6', 'Supervisorss', '356456466', 'image_1552548717.jpg', '', '2019-03-15 03:51:00', NULL, NULL, 'A', 'N', '2019-02-27 23:43:04', '2019-03-15 03:51:00', 1, 3, NULL, NULL),
(4, 3, 'supervisor2@yopmail.com', '$2y$10$YaIytSpyAg1p.8VvmKGkNeCQMiDiTFTja5jEHhYU2xTEaepb21guy', 'Supervisor2', '54546467', NULL, '', '2019-02-27 23:55:56', NULL, NULL, 'A', 'N', '2019-02-27 23:55:35', '2019-02-27 23:55:56', 1, 1, NULL, NULL),
(5, 3, 'supervisor@malinator.com', '$2y$10$.xe9EnyAqokWWyuZXmiC3exr16yYjysJ346AdrC4ms0dV1C4gpA4q', 'Supervisor QA', '9989899000', NULL, '', '2019-03-25 03:59:29', NULL, NULL, 'A', 'N', '2019-03-15 03:52:06', '2019-03-25 03:59:29', 1, 1, NULL, NULL);

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
(1, 'SSLogistics', 'ADMIN', '9876543219', 'admin@sslogistic.com', 'JHUYI6142R', 'SBI', 'SBIN0007587', 5456456465464, 'ADMIN', 'A', 'N', '2019-03-12 07:10:51', '2019-03-12 12:41:50', 1, NULL, NULL, NULL),
(2, 'ROHIT SINGH', 'ROHIT SINGH', '9804640747', 'ROHIT.SINGH@SSLOGISTICS.ORG', 'BTUPS9409M', 'HDFC BANK LIMITED', 'HDFC0000174', 127600002760, 'ROHIT SINGH', 'A', 'N', '2019-02-26 03:17:58', '2019-03-12 12:41:55', 1, NULL, NULL, NULL),
(3, 'TEST COMPANY', 'TEST PERSON', '767778678', 'test@ss.com', 'GHJIU8976Y', 'SBI', 'SBIN0001800', 36526987452, 'TEST ACCOUNT HOLDER', 'A', 'N', '2019-03-12 00:45:39', '2019-03-12 12:41:58', 1, NULL, NULL, NULL),
(4, 'COMPANY 14_03_2019', 'AJAY', '87897877', 'test@sslogistic.com', 'FGHYT7865R', 'SBI', 'SBIN0012358', 238765423542, 'BIJAY', 'A', 'N', '2019-03-14 01:29:26', '2019-03-14 01:29:26', 3, NULL, NULL, NULL),
(5, 'SUMIT MONDAL', 'SUMIT MONDAL', '9876431270', NULL, 'BTUPS9409M', 'HDFC', 'HDFC9089081', 1124878641, 'SUMIT MONDAL', 'A', 'N', '2019-03-24 10:17:11', '2019-03-24 10:17:11', 1, NULL, NULL, NULL),
(6, 'RABI SHANKAR SHAW', 'RABI SHANKAR SHAW', '9856412589', NULL, 'BTUPS9409M', 'HDFC', 'HDFC9089081', 2745641278, 'RABI SHANKAR SHAW', 'A', 'N', '2019-03-24 10:18:05', '2019-03-24 10:18:05', 1, NULL, NULL, NULL),
(7, 'GOPAL PAL', 'GOPAL PAL', '9856412589', NULL, 'BTUPS9409M', 'HDFC', 'HDFC9089081', 2745641278, 'GOPAL PAL', 'A', 'N', '2019-03-24 10:19:04', '2019-03-24 10:19:04', 1, NULL, NULL, NULL),
(8, 'RAM BHAROSA YADAV', 'RAM BHAROSA YADAV', '9830012345', NULL, 'AFYPY0621A', 'ANDHRA BANK', 'ANDB0000815', 81510011004973, 'RAM BHAROSA YADAV', 'A', 'N', '2019-03-25 04:29:40', '2019-03-25 04:29:40', 5, NULL, NULL, NULL),
(9, 'LALLAN ASSOCIATES', 'LALLAN KUMAR SHAW', '8013485985', NULL, 'CIAPS0529Q', 'STATE BANK OF INDIA', 'SBIN0011537', 31524513246, 'LALAN KUMAR SHAW', 'A', 'N', '2019-03-27 23:46:06', '2019-03-27 23:46:06', 1, NULL, NULL, NULL);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `ss_categories`
--
ALTER TABLE `ss_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `ss_parties`
--
ALTER TABLE `ss_parties`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ss_party_destinations`
--
ALTER TABLE `ss_party_destinations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=297;
--
-- AUTO_INCREMENT for table `ss_petrol_pumps`
--
ALTER TABLE `ss_petrol_pumps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `ss_petrol_pump_journal_lasers`
--
ALTER TABLE `ss_petrol_pump_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ss_petrol_pump_journal_lasers_edit_requests`
--
ALTER TABLE `ss_petrol_pump_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_plants`
--
ALTER TABLE `ss_plants`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `ss_plant_addresses`
--
ALTER TABLE `ss_plant_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers_edit_requests`
--
ALTER TABLE `ss_plant_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `ss_plant_user_relations`
--
ALTER TABLE `ss_plant_user_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_trip_payment_managements`
--
ALTER TABLE `ss_trip_payment_managements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_trip_POD`
--
ALTER TABLE `ss_trip_POD`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT for table `ss_trucks`
--
ALTER TABLE `ss_trucks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_truck_insurances`
--
ALTER TABLE `ss_truck_insurances`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_truck_permits`
--
ALTER TABLE `ss_truck_permits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_truck_pollutions`
--
ALTER TABLE `ss_truck_pollutions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_truck_registrations`
--
ALTER TABLE `ss_truck_registrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_truck_taxes`
--
ALTER TABLE `ss_truck_taxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_users`
--
ALTER TABLE `ss_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `ss_vendors`
--
ALTER TABLE `ss_vendors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
