-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 11, 2019 at 11:55 AM
-- Server version: 5.7.24-0ubuntu0.16.04.1
-- PHP Version: 7.1.25-1+ubuntu16.04.1+deb.sury.org+1

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

INSERT INTO `ss_address_zones` (`id`, `latitude`, `longitude`, `address`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '22.5709436', '88.431797', 'Street Number 18, GN Block, Sector V, Salt Lake City, West Bengal, India', 'A', 'N', '2019-01-07 01:25:58', '2019-01-11 05:41:14', 1, NULL, NULL, NULL),
(2, '28.7040592', '77.10249019999999', 'Delhi', 'A', 'N', '2019-01-07 01:26:26', '2019-01-07 01:26:26', 1, NULL, NULL, NULL),
(3, '19.0759837', '72.8776559', 'Mumbai', 'A', 'N', '2019-01-07 01:26:27', '2019-01-11 05:41:22', 1, NULL, NULL, NULL),
(4, '28.4594965', '77.02663830000006', 'Gurgaon, Haryana, India', 'A', 'N', '2019-01-07 01:26:53', '2019-01-07 01:26:53', 1, NULL, NULL, NULL),
(5, '28.599122', '77.1967646', 'Karnataka Bhavan, Chanakyapuri, New Delhi, Delhi, India', 'A', 'N', '2019-01-07 01:30:14', '2019-01-07 01:30:14', 1, NULL, NULL, NULL),
(6, '22.572646', '88.36389500000001', 'kolkata', 'A', 'N', '2019-01-07 01:43:05', '2019-01-07 01:43:05', 1, NULL, NULL, NULL),
(7, '17.385044', '78.486671', 'hyderabad', 'A', 'N', '2019-01-07 01:43:06', '2019-01-07 01:43:06', 1, NULL, NULL, NULL),
(8, '10.8505159', '76.2710833', 'kerala', 'A', 'N', '2019-01-07 01:43:07', '2019-01-07 01:43:07', 1, NULL, NULL, NULL),
(9, '18.9696228', '72.8193781', 'Mumbai Central, Mumbai, Maharashtra, India', 'A', 'N', '2019-01-07 01:53:58', '2019-01-07 01:53:58', 1, NULL, NULL, NULL),
(10, '18.7546171', '73.4062342', 'Lonavala', 'A', 'N', '2019-01-07 01:54:41', '2019-01-07 01:54:41', 1, NULL, NULL, NULL),
(11, '22.5957689', '88.26363940000002', 'Howrah', 'A', 'N', '2019-01-07 01:54:42', '2019-01-07 01:54:42', 1, NULL, NULL, NULL),
(12, '22.5735314', '88.4331189', 'Sector V', 'A', 'N', '2019-01-07 01:54:42', '2019-01-07 01:54:42', 1, NULL, NULL, NULL),
(13, '27.0448562', '88.2677211', 'Darjeeling Mall, Chauk Bazaar, Darjeeling, West Bengal, India', 'A', 'N', '2019-01-07 03:44:06', '2019-01-07 03:44:06', 1, NULL, NULL, NULL),
(14, '22.6032795', '88.42329560000007', 'Keshtopur Bus Stand, Kazi Nazrul Islam Avenue, Rabindrapally, Kestopur, Kolkata, West Bengal, India', 'A', 'N', '2019-01-07 07:14:24', '2019-01-07 07:14:24', 1, NULL, NULL, NULL),
(15, '23.5204443', '87.3119227', 'durgapur', 'A', 'N', '2019-01-08 00:08:37', '2019-01-08 00:08:37', 1, NULL, NULL, NULL),
(16, '23.2324214', '87.8614793', 'burdwan', 'A', 'N', '2019-01-08 00:08:38', '2019-01-08 00:08:38', 1, NULL, NULL, NULL),
(17, '24.1759039', '88.2801785', 'Murshidabad', 'A', 'N', '2019-01-08 04:57:16', '2019-01-08 04:57:16', 1, NULL, NULL, NULL),
(18, '23.6739452', '86.9523954', 'Asansol', 'A', 'N', '2019-01-08 04:57:17', '2019-01-08 04:57:17', 1, NULL, NULL, NULL),
(19, '26.7271012', '88.39528609999999', 'Siliguri', 'A', 'N', '2019-01-08 04:57:17', '2019-01-08 04:57:17', 1, NULL, NULL, NULL),
(20, '22.4744363', '88.1000377', 'uluberia\r', 'A', 'N', '2019-01-08 05:01:26', '2019-01-08 05:01:26', 1, NULL, NULL, NULL),
(21, '23.2324214', '87.8614793', 'burdwan\r', 'A', 'N', '2019-01-08 05:01:26', '2019-01-08 05:01:26', 1, NULL, NULL, NULL),
(22, '23.5204443', '87.3119227', 'durgapur\r', 'A', 'N', '2019-01-08 05:01:27', '2019-01-08 05:01:27', 1, NULL, NULL, NULL),
(23, '13.0499526', '80.2824026', 'Marina Beach', 'A', 'N', '2019-01-08 05:59:49', '2019-01-08 05:59:49', 1, NULL, NULL, NULL),
(24, '8.4003984', '76.97870759999999', 'Kovalam', 'A', 'N', '2019-01-08 05:59:50', '2019-01-08 05:59:50', 1, NULL, NULL, NULL),
(25, '37.0548315', '-94.4370419', 'Gulf', 'A', 'N', '2019-01-08 05:59:51', '2019-01-08 05:59:51', 1, NULL, NULL, NULL),
(26, '20.9516658', '85.0985236', 'Odisha, India', 'A', 'N', '2019-01-08 06:01:11', '2019-01-08 06:01:11', 1, NULL, NULL, NULL),
(27, '34.0836708', '74.7972825', 'srinagar', 'A', 'N', '2019-01-08 06:06:39', '2019-01-08 06:06:39', 1, NULL, NULL, NULL),
(28, '31.6339793', '74.8722642', 'amritsar', 'A', 'N', '2019-01-08 06:06:39', '2019-01-08 06:06:39', 1, NULL, NULL, NULL),
(29, '30.3397809', '76.3868797', 'patiala', 'A', 'N', '2019-01-08 06:06:40', '2019-01-08 06:06:40', 1, NULL, NULL, NULL),
(30, '40.708721', '-74.00536090000001', 'Nalandabodhi Buddhism centre, Fulton Street, New York, NY, USA', 'A', 'N', '2019-01-08 06:09:17', '2019-01-08 06:09:17', 1, NULL, NULL, NULL),
(31, '32.219042', '76.3234037', 'Dharamsala', 'A', 'N', '2019-01-08 06:11:02', '2019-01-08 06:11:02', 1, NULL, NULL, NULL),
(32, '34.1525864', '77.57705349999999', 'leh', 'A', 'N', '2019-01-08 06:11:04', '2019-01-08 06:11:04', 1, NULL, NULL, NULL),
(33, '19.8133822', '85.8314655', 'Puri, Odisha, India', 'A', 'N', '2019-01-08 06:11:47', '2019-01-08 06:11:47', 1, NULL, NULL, NULL),
(34, '23.4453054', '87.47030289999998', 'Panagarh, West Bengal, India', 'A', 'N', '2019-01-08 06:30:19', '2019-01-08 06:30:19', 1, NULL, NULL, NULL),
(35, '22.5445343', '88.22177330000001', 'Sankrail, Howrah, West Bengal, India', 'A', 'N', '2019-01-08 06:32:25', '2019-01-08 06:32:25', 1, NULL, NULL, NULL),
(36, '22.6197151', '88.2874736', 'Pakuria, West Bengal, India', 'A', 'N', '2019-01-08 06:33:24', '2019-01-08 06:33:24', 1, NULL, NULL, NULL),
(37, '40.1072627', '-74.0558461', 'New Jersey 35, Brielle, NJ, USA', 'A', 'N', '2019-01-08 06:47:30', '2019-01-08 06:47:30', 1, NULL, NULL, NULL),
(38, '22.4718579', '88.099126', 'Uluberia Station Railway Road, Nimdighi, Uluberia, Nona, West Bengal, India', 'A', 'N', '2019-01-08 06:49:24', '2019-01-11 05:42:04', 1, NULL, NULL, NULL),
(39, '26.5434772', '88.7205256', 'jalpaiguri', 'A', 'N', '2019-01-08 06:58:25', '2019-01-08 06:58:25', 1, NULL, NULL, NULL),
(40, '24.8748199', '88.13401909999999', 'gour', 'A', 'N', '2019-01-08 06:58:26', '2019-01-08 06:58:26', 1, NULL, NULL, NULL),
(41, '21.6266172', '87.5074315', 'digha', 'A', 'N', '2019-01-08 06:58:27', '2019-01-08 06:58:27', 1, NULL, NULL, NULL),
(42, '9.9312328', '76.26730409999999', 'cochi\r', 'A', 'N', '2019-01-08 07:00:26', '2019-01-08 07:00:26', 1, NULL, NULL, NULL),
(43, '17.6868159', '83.2184815', 'vishakhapattanam\r', 'A', 'N', '2019-01-08 07:00:27', '2019-01-08 07:00:27', 1, NULL, NULL, NULL),
(44, '39.678711', '-104.9838603', 'ladakh\r', 'A', 'N', '2019-01-08 07:00:28', '2019-01-08 07:00:28', 1, NULL, NULL, NULL),
(45, '22.6249719', '88.43857109999999', 'chinar park\r', 'A', 'N', '2019-01-08 07:02:18', '2019-01-08 07:02:18', 1, NULL, NULL, NULL),
(46, '22.5765243', '88.4796344', 'newtown rajarhat\r', 'A', 'N', '2019-01-08 07:02:19', '2019-01-08 07:02:19', 1, NULL, NULL, NULL),
(47, '22.4629461', '88.3967536', 'Garia\r', 'A', 'N', '2019-01-08 07:02:20', '2019-01-08 07:02:20', 1, NULL, NULL, NULL),
(48, '22.6018382', '88.38306550000001', 'Kolkata station\r', 'A', 'N', '2019-01-08 07:05:19', '2019-01-08 07:05:19', 1, NULL, NULL, NULL),
(49, '22.5760838', '88.35277119999999', 'chitpur\r', 'A', 'N', '2019-01-08 07:05:20', '2019-01-08 07:05:20', 1, NULL, NULL, NULL),
(50, '22.5981676', '88.3639986', 'Sovabazar\r', 'A', 'N', '2019-01-08 07:05:21', '2019-01-08 07:05:21', 1, NULL, NULL, NULL),
(51, '37.566535', '126.9779692', 'Seoul, South Korea', 'A', 'N', '2019-01-09 03:35:50', '2019-01-09 03:35:50', 1, NULL, NULL, NULL),
(52, '-7.4832133', '109.140438', 'Banyumas Regency, Central Java, Indonesia', 'A', 'N', '2019-01-09 03:54:02', '2019-01-09 03:54:02', 1, NULL, NULL, NULL),
(53, '13.3643802', '100.9976598', 'Vcxv 22 บ้านสวน-ธีระบัณฑิต 6 Bang Pla Soi, Chon Buri District, Chon Buri, Thailand', 'A', 'N', '2019-01-09 04:06:24', '2019-01-09 04:06:24', 1, NULL, NULL, NULL),
(54, '51.528561', '-0.270169', 'Asda Park Royal Superstore, Western Road, London, UK', 'A', 'N', '2019-01-09 04:17:52', '2019-01-09 04:17:52', 1, NULL, NULL, NULL),
(55, '22.6102648', '88.404737', 'Khudiram Bose Road, Hazrapara, Naskar Bagan, South Dum Dum, Kolkata, West Bengal, India', 'A', 'N', '2019-01-10 01:14:33', '2019-01-11 05:42:36', 1, NULL, NULL, NULL),
(56, '22.7004725', '88.3190717', 'Konnagar, Mirpur, West Bengal, India', 'D', 'Y', '2019-01-10 01:23:08', '2019-01-10 01:23:24', 1, NULL, '2019-01-10 01:23:24', 1),
(57, '22.5132769', '88.33990059999999', 'Chetla Road, Kalighat, Kolkata, West Bengal, India', 'D', 'Y', '2019-01-10 01:24:44', '2019-01-10 01:32:32', 1, NULL, '2019-01-10 01:32:32', 1),
(58, '22.5153936', '88.333062', 'Alipore Road, Kala Bagan, Chetla, Kolkata, West Bengal, India', 'D', 'Y', '2019-01-10 01:33:44', '2019-01-10 01:34:31', 1, NULL, '2019-01-10 01:34:31', 1),
(59, '22.4616267', '88.3061645', 'Thakurpukur, Kolkata, West Bengal, India', 'D', 'Y', '2019-01-10 01:35:56', '2019-01-10 01:41:59', 1, NULL, '2019-01-10 01:41:59', 1),
(60, '13.7518489', '100.64513199999999', 'Srinagarindra Road, Hua Mak, Bang Kapi, Bangkok, Thailand', 'D', 'Y', '2019-01-10 02:00:44', '2019-01-10 02:01:16', 1, NULL, '2019-01-10 02:01:16', 1),
(61, '32.555795', '76.0655834', 'Khajjiar, Himachal Pradesh, India', 'D', 'Y', '2019-01-10 02:02:04', '2019-01-10 02:05:45', 1, NULL, '2019-01-10 02:05:45', 1),
(62, '22.748331', '88.3385053', 'Sreerampur\r', 'A', 'N', '2019-01-10 02:14:51', '2019-01-10 02:14:51', 1, NULL, NULL, NULL),
(63, '18.9854394', '72.83456199999999', 'chinchpokli\r', 'A', 'N', '2019-01-10 02:14:53', '2019-01-10 02:14:53', 1, NULL, NULL, NULL),
(64, '12.9715987', '77.5945627', 'bengaluru\r', 'A', 'N', '2019-01-10 02:23:56', '2019-01-10 02:23:56', 1, NULL, NULL, NULL),
(65, '15.2993265', '74.12399599999999', 'goa\r', 'A', 'N', '2019-01-10 02:23:57', '2019-01-10 02:23:57', 1, NULL, NULL, NULL),
(66, '11.1271225', '78.6568942', 'tamilnadu\r', 'A', 'N', '2019-01-10 02:23:58', '2019-01-10 02:23:58', 1, NULL, NULL, NULL),
(67, '19.1095171', '72.8241298', 'Juhu Beach', 'A', 'N', '2019-01-10 02:26:01', '2019-01-10 02:26:01', 1, NULL, NULL, NULL),
(68, '18.1124372', '79.01929969999999', 'telengana', 'A', 'N', '2019-01-10 02:26:02', '2019-01-10 02:26:02', 1, NULL, NULL, NULL),
(69, '23.3440997', '85.309562', 'Ranchi', 'A', 'N', '2019-01-10 02:26:02', '2019-01-10 02:26:02', 1, NULL, NULL, NULL),
(70, '6.9270786', '79.861243', 'colombo\r', 'A', 'N', '2019-01-10 02:33:23', '2019-01-10 02:33:23', 1, NULL, NULL, NULL),
(71, '39.678711', '-104.9838603', 'ladakh', 'A', 'N', '2019-01-10 02:40:23', '2019-01-10 02:40:23', 1, NULL, NULL, NULL),
(72, '25.4670308', '91.366216', 'meghalaya', 'A', 'N', '2019-01-10 03:37:48', '2019-01-10 03:37:48', 1, NULL, NULL, NULL),
(73, '23.164543', '92.9375739', 'mizoram', 'A', 'N', '2019-01-10 03:37:49', '2019-01-10 03:37:49', 1, NULL, NULL, NULL),
(74, '27.4728327', '94.9119621', 'dibrugarh', 'A', 'N', '2019-01-10 03:39:57', '2019-01-10 03:39:57', 1, NULL, NULL, NULL),
(75, '25.5787726', '91.8932535', 'shillong', 'A', 'N', '2019-01-10 03:39:58', '2019-01-10 03:39:58', 1, NULL, NULL, NULL),
(76, '31.5203696', '74.35874729999999', 'lahore\r', 'A', 'N', '2019-01-10 03:44:20', '2019-01-10 03:44:20', 1, NULL, NULL, NULL),
(77, '24.8607343', '67.0011364', 'karachi\r', 'A', 'N', '2019-01-10 03:44:21', '2019-01-10 03:44:21', 1, NULL, NULL, NULL),
(78, '30.3397809', '76.3868797', 'patiala\r', 'A', 'N', '2019-01-10 03:47:45', '2019-01-10 03:47:45', 1, NULL, NULL, NULL),
(79, '23.722454', '81.024219', 'bandhavgarh\r', 'A', 'N', '2019-01-10 03:47:46', '2019-01-10 03:47:46', 1, NULL, NULL, NULL),
(80, '22.2815606', '80.6181218', 'kanha\r', 'D', 'Y', '2019-01-10 03:49:56', '2019-01-10 03:54:32', 1, NULL, '2019-01-10 03:54:32', 1),
(81, '33.778175', '76.57617139999999', 'kashmir\r', 'A', 'N', '2019-01-10 03:49:57', '2019-01-10 03:49:57', 1, NULL, NULL, NULL),
(82, '10.0889333', '77.05952479999999', 'Munnar', 'A', 'N', '2019-01-10 03:51:14', '2019-01-10 03:51:14', 1, NULL, NULL, NULL),
(83, '9.498066699999999', '76.3388484', 'Aleepy', 'D', 'Y', '2019-01-10 03:51:15', '2019-01-10 03:54:06', 1, NULL, '2019-01-10 03:54:06', 1),
(84, '18.7692034', '73.3767641', 'khandala', 'A', 'N', '2019-01-10 04:48:34', '2019-01-10 04:48:34', 1, NULL, NULL, NULL),
(85, '23.181467', '79.9864071', 'jabalpur', 'A', 'N', '2019-01-10 04:48:36', '2019-01-10 04:48:36', 1, NULL, NULL, NULL);

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
(1, 'CAT11', 'Cat Description 1', 'A', 'N', '2018-10-26 03:29:47', '2018-10-26 03:29:47', 1, NULL, NULL, NULL),
(2, 'CAT12', 'Cat Description 2', 'A', 'N', '2018-10-26 03:29:47', '2018-10-26 03:29:47', 1, NULL, NULL, NULL),
(3, 'CAT13', 'Cat Description 3', 'A', 'N', '2018-10-26 03:29:48', '2018-10-26 03:29:48', 1, NULL, NULL, NULL),
(4, 'CAT19999', 'Cat Description 19999', 'A', 'N', '2018-10-26 06:19:45', '2018-10-26 06:19:45', 1, NULL, NULL, NULL),
(5, 'CAT29999', 'Cat Description 299999', 'A', 'N', '2018-10-26 06:19:45', '2018-10-26 06:19:45', 1, NULL, NULL, NULL),
(6, 'CAT1', 'Cat Description 1', 'A', 'N', '2018-10-26 06:28:41', '2018-10-26 06:28:41', 2, NULL, NULL, NULL),
(7, 'CAT2', 'Cat Description 2', 'A', 'N', '2018-10-26 06:28:42', '2018-10-26 06:28:42', 2, NULL, NULL, NULL),
(8, 'CAT3', 'Cat Description 3', 'A', 'N', '2018-10-26 06:28:42', '2018-10-26 06:28:42', 2, NULL, NULL, NULL);

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
(1, 1, 1, 'Sankrail', 'SNK', 'A', 'N', '2018-09-12 00:23:46', '2018-09-12 03:56:18', 1, 1, NULL, NULL),
(2, 1, 1, 'Kolkata', 'KOL', 'A', 'N', '2018-09-12 01:09:33', '2018-09-21 08:05:11', 1, 1, NULL, NULL),
(3, 1, 1, 'Durgapur', 'DG', 'I', 'N', '2018-09-12 01:12:16', '2018-09-12 01:12:16', 1, NULL, NULL, NULL),
(4, 1, 1, 'Bolpur', 'BP', 'A', 'N', '2018-09-12 01:12:59', '2018-09-12 01:12:59', 1, NULL, NULL, NULL),
(5, 1, 1, 'Howrah', 'HWH', 'A', 'N', '2018-09-12 01:13:19', '2018-09-12 01:13:31', 1, 1, NULL, NULL),
(6, 1, 1, 'Baruipur', 'BRP', 'A', 'N', '2018-09-12 01:14:13', '2018-09-12 01:14:13', 1, NULL, NULL, NULL),
(7, 1, 1, 'Rajarhat', 'RJT', 'A', 'N', '2018-09-12 01:14:47', '2018-09-12 01:14:47', 1, NULL, NULL, NULL),
(8, 1, 1, 'Asansol', 'ASL', 'D', 'Y', '2018-09-12 01:15:14', '2018-09-27 00:49:57', 1, NULL, '2018-09-27 00:49:57', 1),
(9, 1, 10, 'Ghandhinagar', 'GN', 'A', 'N', '2018-09-12 01:16:31', '2018-09-12 01:16:31', 1, NULL, NULL, NULL),
(10, 1, 10, 'Ahmedabad', 'AHM', 'D', 'Y', '2018-09-12 01:17:13', '2018-10-03 05:15:23', 1, NULL, '2018-10-03 05:15:23', 1),
(11, 1, 10, 'Surat', 'ST', 'D', 'Y', '2018-09-12 01:17:58', '2018-10-03 05:03:56', 1, NULL, '2018-10-03 05:03:56', 1),
(12, 1, 10, 'Rajkot', 'RJK', 'D', 'Y', '2018-09-12 01:18:22', '2018-10-03 05:03:59', 1, NULL, '2018-10-03 05:03:59', 1),
(13, 1, 16, 'Mumbai', 'MUM', 'D', 'Y', '2018-09-18 04:55:33', '2018-10-03 05:04:06', 1, NULL, '2018-10-03 05:04:06', 1),
(14, 1, 17, 'Bhuj', 'BHU', 'D', 'Y', '2018-09-18 05:55:09', '2018-10-03 05:15:26', 1, NULL, '2018-10-03 05:15:26', 1),
(15, 1, 18, 'Ajanta', 'AJ', 'D', 'Y', '2018-09-18 05:55:10', '2018-10-03 05:15:39', 1, NULL, '2018-10-03 05:15:39', 1),
(16, 1, 19, 'Jaisalmer', 'JAI', 'D', 'Y', '2018-09-18 05:55:11', '2018-10-03 05:15:45', 1, NULL, '2018-10-03 05:15:45', 1),
(17, 1, 20, 'Lucknow', 'LKW', 'A', 'N', '2018-09-21 07:41:03', '2018-09-21 07:41:03', 1, NULL, NULL, NULL),
(18, 1, 18, 'Bhopal', 'BH', 'A', 'N', '2018-09-21 07:43:28', '2018-09-21 07:43:28', 1, NULL, NULL, NULL),
(19, 1, 21, 'Kolkata_new', 'KOL_new', 'D', 'Y', '2018-09-21 07:50:12', '2018-10-26 03:17:41', 1, NULL, '2018-10-26 03:17:41', 1),
(20, 1, 22, 'Kolkata99', 'KOL99', 'D', 'Y', '2018-09-21 07:54:11', '2018-10-26 03:17:44', 1, NULL, '2018-10-26 03:17:44', 1),
(21, 1, 23, 'Mumbai1', 'MUM1', 'D', 'Y', '2018-09-21 07:54:13', '2018-10-26 03:17:47', 1, NULL, '2018-10-26 03:17:47', 1),
(22, 1, 16, 'Mumbai', 'MUB', 'A', 'N', '2018-10-04 05:37:56', '2018-10-26 03:18:00', 1, 1, NULL, NULL);

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
(1, 'India', 'IN', 'A', 'N', '2018-09-07 02:01:12', '2018-09-07 02:01:12', 1, NULL, NULL, NULL);

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
(1, 1, 'IT EM 11', 'Item Description 1\r', 'A', 'N', '2018-10-26 03:29:47', '2018-10-26 03:29:47', 1, NULL, NULL, NULL),
(2, 2, 'IT EM 12', 'Item Description 2\r', 'A', 'N', '2018-10-26 03:29:47', '2018-10-26 03:29:47', 1, NULL, NULL, NULL),
(3, 3, 'IT EM 13', 'Item Description 3\r', 'A', 'N', '2018-10-26 03:29:48', '2018-10-26 03:29:48', 1, NULL, NULL, NULL),
(4, 4, 'IT EM 19999', 'Item Description 1\r', 'A', 'N', '2018-10-26 06:19:45', '2018-10-26 06:19:45', 1, NULL, NULL, NULL),
(5, 5, 'IT EM 29999', 'Item Description 2\r', 'A', 'N', '2018-10-26 06:19:45', '2018-10-26 06:19:45', 1, NULL, NULL, NULL),
(6, 6, 'IT EM 1', 'Item Description 1', 'A', 'N', '2018-10-26 06:28:41', '2018-10-26 06:28:41', 2, NULL, NULL, NULL),
(7, 7, 'IT EM 2', 'Item Description 2', 'A', 'N', '2018-10-26 06:28:42', '2018-10-26 06:28:42', 2, NULL, NULL, NULL),
(8, 8, 'IT EM 3', 'Item Description 3', 'A', 'N', '2018-10-26 06:28:42', '2018-10-26 06:28:42', 2, NULL, NULL, NULL);

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
(9, 'App\\User', 3),
(10, 'App\\User', 3),
(11, 'App\\User', 3),
(12, 'App\\User', 3);

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
(3, 'App\\User', 3);

-- --------------------------------------------------------

--
-- Table structure for table `ss_parties`
--

CREATE TABLE `ss_parties` (
  `id` bigint(20) NOT NULL,
  `address_zone_id` bigint(20) NOT NULL COMMENT 'primary key of ''address_zones''',
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

INSERT INTO `ss_parties` (`id`, `address_zone_id`, `party_name`, `party_description`, `phone_number`, `email`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 5, 'New Party 1', 'test', '07789897', 'bill@test.com', 'A', 'N', '2019-01-07 01:30:14', '2019-01-07 01:30:14', 1, NULL, NULL, NULL),
(2, 6, 'New Party 145', 'Party A Description', '6768657', 'partya@test.com', 'A', 'N', '2019-01-07 01:43:05', '2019-01-07 01:50:46', 1, 1, NULL, NULL),
(3, 7, 'Party B1', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-07 01:43:06', '2019-01-07 01:43:06', 1, NULL, NULL, NULL),
(4, 8, 'Party C1', 'Party C Description', '8765677', 'partyc@test.com', 'A', 'N', '2019-01-07 01:43:07', '2019-01-07 01:43:07', 1, NULL, NULL, NULL),
(5, 11, 'Party A17', 'Party A Description', '6768657', 'partya@test.com', 'A', 'N', '2019-01-07 07:32:19', '2019-01-07 07:32:19', 1, NULL, NULL, NULL),
(6, 15, 'Party B17', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-08 00:08:37', '2019-01-08 00:08:37', 1, NULL, NULL, NULL),
(7, 16, 'Party C17', 'Party C Description', '8765677', 'partyc@test.com', 'A', 'N', '2019-01-08 00:08:38', '2019-01-08 00:08:38', 1, NULL, NULL, NULL),
(8, 17, 'Party A81', 'Party A Description', '6768657', 'partya8@test.com', 'A', 'N', '2019-01-08 04:57:16', '2019-01-08 04:57:16', 1, NULL, NULL, NULL),
(9, 18, 'Party B81', 'Party B Description', '9786555', 'partyb8@test.com', 'A', 'N', '2019-01-08 04:57:17', '2019-01-08 04:57:17', 1, NULL, NULL, NULL),
(10, 19, 'Party C81', 'Party C Description', '8765677', 'partyc8@test.com', 'A', 'N', '2019-01-08 04:57:17', '2019-01-08 04:57:17', 1, NULL, NULL, NULL),
(11, 20, 'Party A51', 'Party A Description', '6768657', 'partya@test.com', 'A', 'N', '2019-01-08 05:01:26', '2019-01-08 05:01:26', 1, NULL, NULL, NULL),
(12, 21, 'Party B51', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-08 05:01:26', '2019-01-08 05:01:26', 1, NULL, NULL, NULL),
(13, 22, 'Party C51', 'Party C Description', '8765677', 'partyc@test.com', 'A', 'N', '2019-01-08 05:01:27', '2019-01-08 05:01:27', 1, NULL, NULL, NULL),
(14, 20, 'Party A511', 'Party A Description', '6768657', 'partya@test.com', 'A', 'N', '2019-01-08 05:36:33', '2019-01-08 05:36:33', 1, NULL, NULL, NULL),
(15, 21, 'Party B511', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-08 05:36:33', '2019-01-08 05:36:33', 1, NULL, NULL, NULL),
(16, 22, 'Party C511', 'Party C Description', '8765677', 'partyc@test.com', 'A', 'N', '2019-01-08 05:36:33', '2019-01-08 05:36:33', 1, NULL, NULL, NULL),
(17, 27, 'Party A8119', 'Party A Description', '6768657', 'partya8@test.com', 'A', 'N', '2019-01-08 06:06:39', '2019-01-08 06:06:39', 1, NULL, NULL, NULL),
(18, 28, 'Party B8119', 'Party B Description', '9786555', 'partyb8@test.com', 'A', 'N', '2019-01-08 06:06:39', '2019-01-08 06:06:39', 1, NULL, NULL, NULL),
(19, 29, 'Party C8119', 'Party C Description', '8765677', 'partyc8@test.com', 'A', 'N', '2019-01-08 06:06:40', '2019-01-08 06:06:40', 1, NULL, NULL, NULL),
(20, 30, 'test9999956456464', 'ssss', '2412412412', 'bill@test.com', 'A', 'N', '2019-01-08 06:09:17', '2019-01-08 06:09:17', 1, NULL, NULL, NULL),
(21, 42, 'Party Aww', 'Party A Description', '6768657', 'partya@test.com', 'A', 'N', '2019-01-08 07:00:26', '2019-01-08 07:00:26', 1, NULL, NULL, NULL),
(22, 43, 'Party Bww', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-08 07:00:27', '2019-01-08 07:00:27', 1, NULL, NULL, NULL),
(23, 44, 'Party Cww', 'Party C Description', '8765677', 'partyc@test.com', 'A', 'N', '2019-01-08 07:00:28', '2019-01-08 07:00:28', 1, NULL, NULL, NULL),
(24, 52, 'KUKUUKUKUKUKUK', 'GFDFGDGDFGDFG', '235434', 'tr@ss.com', 'D', 'Y', '2019-01-09 03:54:02', '2019-01-09 06:17:16', 1, NULL, '2019-01-09 06:17:16', 1),
(25, 57, 'PARTY 10-01-2019', 'TGDASDADSA', '56564565', 'tr@ss.com', 'D', 'Y', '2019-01-10 01:24:44', '2019-01-10 01:32:11', 1, NULL, '2019-01-10 01:32:11', 1),
(26, 59, 'KUKUUKUKUKUKUK10012019', 'GFDFGDGDFGDFG', '235434', 'tr@ss.com', 'D', 'Y', '2019-01-10 01:36:39', '2019-01-10 01:37:24', 1, NULL, '2019-01-10 01:37:24', 1),
(27, 61, 'SAN', 'FDFDFDF', '5456464', 'test@ss.com', 'D', 'Y', '2019-01-10 02:03:59', '2019-01-10 02:05:21', 1, NULL, '2019-01-10 02:05:21', 1),
(28, 64, 'Party A19', 'Party A Description', '6768657', 'partya@test.com', 'A', 'N', '2019-01-10 02:23:57', '2019-01-10 02:23:57', 1, NULL, NULL, NULL),
(29, 65, 'Party B19', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-10 02:23:57', '2019-01-10 02:23:57', 1, NULL, NULL, NULL),
(30, 66, 'Party C19', 'Party C Description', '8765677', 'partyc@test.com', 'A', 'N', '2019-01-10 02:23:58', '2019-01-10 02:23:58', 1, NULL, NULL, NULL),
(31, 80, 'Party A19_1', 'Party A Description', '6768657', 'partya@test.com', 'D', 'Y', '2019-01-10 03:49:56', '2019-01-10 03:54:26', 1, NULL, '2019-01-10 03:54:26', 1),
(32, 81, 'Party B19_1', 'Party B Description', '9786555', 'partyb@test.com', 'A', 'N', '2019-01-10 03:49:57', '2019-01-10 03:49:57', 1, NULL, NULL, NULL);

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

--
-- Dumping data for table `ss_party_destinations`
--

INSERT INTO `ss_party_destinations` (`id`, `party_id`, `address`, `city_id`, `state_id`, `country_id`, `contact_number`, `contact_email`, `contact_person`, `lat`, `lng`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'GT Road', 22, 16, 1, '773333', 's@mailinator.com', 'S.Sharma', NULL, NULL, 'A', 'N', '2018-10-26 03:58:51', '2018-10-26 03:58:51', 1, NULL, NULL, NULL),
(2, 2, 'Ultadanga', 2, 1, 1, '9967654', 'test1@test.com', 'Person1', '22.594817', '88.3868594', 'A', 'N', '2018-10-26 05:19:49', '2018-10-26 05:19:49', 1, NULL, NULL, NULL),
(3, 3, 'Tollygunj', 2, 1, 1, '2312312', 'test2@test.com', 'Person2', '22.4986357', '88.3453906', 'A', 'N', '2018-10-26 05:19:50', '2018-10-26 05:19:50', 1, NULL, NULL, NULL),
(4, 4, 'Alambagh', 17, 20, 1, '8856744', 'test3@test.com', 'Person3', '26.8166485', '80.9076582', 'A', 'N', '2018-10-26 05:19:52', '2018-10-26 05:19:52', 1, NULL, NULL, NULL),
(5, 7, 'Kadamtala', 5, 1, 1, '3367743333', 'test341@test.com', 'Person178\r', '22.5868855', '88.3169456', 'A', 'N', '2018-10-26 06:17:04', '2018-10-26 06:17:04', 1, NULL, NULL, NULL),
(6, 8, 'Ring road', 3, 1, 1, '3567744', 'test278@test.com', 'Person902\r', '23.5683067', '87.3021322', 'A', 'N', '2018-10-26 06:17:05', '2018-10-26 06:17:05', 1, NULL, NULL, NULL);

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
(69, 'plant_manage_add', 'web', '2019-01-07 01:24:52', '2019-01-07 01:24:52', 1, 1, NULL, NULL),
(70, 'plant_manage_edit', 'web', '2019-01-07 01:24:52', '2019-01-07 01:24:52', 1, 1, NULL, NULL),
(71, 'plant_manage_delete', 'web', '2019-01-07 01:24:52', '2019-01-07 01:24:52', 1, 1, NULL, NULL),
(72, 'plant_manage_view', 'web', '2019-01-07 01:24:52', '2019-01-07 01:24:52', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_petrol_pumps`
--

CREATE TABLE `ss_petrol_pumps` (
  `id` bigint(20) NOT NULL,
  `petrol_pump_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address_zone_id` bigint(20) NOT NULL COMMENT 'primary key of ''address_zones''',
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

INSERT INTO `ss_petrol_pumps` (`id`, `petrol_pump_name`, `address_zone_id`, `contact_number`, `contact_email`, `contact_person`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 'pp1', 9, '87897877', 'test@sslogistic.com', 'test', 'A', 'N', '2019-01-07 01:53:58', '2019-01-07 01:53:58', 1, NULL, NULL, NULL),
(2, 'Petrol Pump 111', 10, '9876543210', 'pp1@test.com', 'Person1', 'A', 'N', '2019-01-07 01:54:41', '2019-01-07 01:54:41', 1, NULL, NULL, NULL),
(3, 'Petrol Pump 211', 13, '2577656798', 'pp2@test.com', 'Person2', 'A', 'N', '2019-01-07 01:54:42', '2019-01-07 03:44:06', 1, 1, NULL, NULL),
(4, 'Petrol Pump 311', 12, '7854564564', 'pp3@ss.com', 'Person3', 'A', 'N', '2019-01-07 01:54:42', '2019-01-07 01:54:42', 1, NULL, NULL, NULL),
(5, 'Petrol Pump 12', 10, '9876543210', 'pp1@test.com', 'Person1', 'A', 'N', '2019-01-08 05:40:19', '2019-01-08 05:40:19', 1, NULL, NULL, NULL),
(6, 'Petrol Pump 22', 11, '2577656798', 'pp2@test.com', 'Person2', 'A', 'N', '2019-01-08 05:40:20', '2019-01-08 05:40:20', 1, NULL, NULL, NULL),
(7, 'Petrol Pump 32', 12, '7854564564', 'pp3@ss.com', 'Person3', 'A', 'N', '2019-01-08 05:40:20', '2019-01-08 05:40:20', 1, NULL, NULL, NULL),
(8, 'Petrol Pump 122', 23, '9876543210', 'pp1@test.com', 'Person1', 'A', 'N', '2019-01-08 05:59:49', '2019-01-08 05:59:49', 1, NULL, NULL, NULL),
(9, 'Petrol Pump 222', 24, '2577656798', 'pp2@test.com', 'Person2', 'A', 'N', '2019-01-08 05:59:50', '2019-01-08 05:59:50', 1, NULL, NULL, NULL),
(10, 'Petrol Pump 322', 25, '7854564564', 'pp3@ss.com', 'Person3', 'A', 'N', '2019-01-08 05:59:51', '2019-01-08 05:59:51', 1, NULL, NULL, NULL),
(11, 'pp08012019', 26, '87897877', 'tn@ss.com', 'Ajay', 'I', 'N', '2019-01-08 06:01:11', '2019-01-08 06:01:11', 1, NULL, NULL, NULL),
(12, 'Petrol Pump 1r', 10, '9876543210', 'pp1@test.com', 'Person1\r', 'A', 'N', '2019-01-08 06:56:47', '2019-01-08 06:56:47', 1, NULL, NULL, NULL),
(13, 'Petrol Pump 2r', 11, '2577656798', 'pp2@test.com', 'Person2\r', 'A', 'N', '2019-01-08 06:56:47', '2019-01-08 06:56:47', 1, NULL, NULL, NULL),
(14, 'Petrol Pump 3r', 12, '7854564564', 'pp3@ss.com', 'Person3\r', 'A', 'N', '2019-01-08 06:56:47', '2019-01-08 06:56:47', 1, NULL, NULL, NULL),
(15, 'Petrol Pump 1ree', 39, '9876543210', 'pp1@test.com', 'Person1\r', 'A', 'N', '2019-01-08 06:58:25', '2019-01-08 06:58:25', 1, NULL, NULL, NULL),
(16, 'Petrol Pump 2ree', 40, '2577656798', 'pp2@test.com', 'Person2\r', 'A', 'N', '2019-01-08 06:58:26', '2019-01-08 06:58:26', 1, NULL, NULL, NULL),
(17, 'Petrol Pump 3ree', 41, '7854564564', 'pp3@ss.com', 'Person3\r', 'A', 'N', '2019-01-08 06:58:27', '2019-01-08 06:58:27', 1, NULL, NULL, NULL),
(18, 'VCZXCVXCVCX', 53, '343242', 'tr@ss.co.in', 'DSFSFSF', 'D', 'Y', '2019-01-09 04:06:24', '2019-01-09 06:17:33', 1, NULL, '2019-01-09 06:17:33', 1),
(19, 'DSF5464645', 54, '325453', 'tr@ss.co.in', 'DSFSFSF32534', 'I', 'N', '2019-01-09 04:17:53', '2019-01-09 04:17:53', 1, NULL, NULL, NULL),
(20, 'PETROL PUMP 10-01-2019', 58, '66565065', 'tr@ss.co.in', 'TEST1', 'D', 'Y', '2019-01-10 01:33:44', '2019-01-10 01:34:26', 1, NULL, '2019-01-10 01:34:26', 1),
(21, 'SAN', 61, '42342343', 'test@ss.com', 'TEST', 'D', 'Y', '2019-01-10 02:04:35', '2019-01-10 02:05:38', 1, NULL, '2019-01-10 02:05:38', 1),
(22, 'Petrol Pump 119', 67, '9876543210', 'pp1@test.com', 'Person1\r', 'A', 'N', '2019-01-10 02:26:01', '2019-01-10 02:26:01', 1, NULL, NULL, NULL),
(23, 'Petrol Pump 219', 68, '2577656798', 'pp2@test.com', 'Person2\r', 'A', 'N', '2019-01-10 02:26:02', '2019-01-10 02:26:02', 1, NULL, NULL, NULL),
(24, 'Petrol Pump 319', 69, '7854564564', 'pp3@ss.com', 'Person3\r', 'A', 'N', '2019-01-10 02:26:02', '2019-01-10 02:26:02', 1, NULL, NULL, NULL),
(25, 'Petrol Pump 119_1', 82, '9876543210', 'pp1@test.com', 'Person1\r', 'A', 'N', '2019-01-10 03:51:14', '2019-01-10 03:51:14', 1, NULL, NULL, NULL),
(26, 'Petrol Pump 219_1', 83, '2577656798', 'pp2@test.com', 'Person2\r', 'D', 'Y', '2019-01-10 03:51:15', '2019-01-10 03:54:00', 1, NULL, '2019-01-10 03:54:00', 1);

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
  `approved_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `approved_on` timestamp NULL DEFAULT NULL,
  `approval_status` enum('Pending','Approved','Disapproved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
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
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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

INSERT INTO `ss_plants` (`id`, `address_zone_id`, `type`, `name`, `description`, `contact_number`, `contact_email`, `contact_person`, `balance_amount`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'P', 'New Test Plant', 'test', NULL, NULL, NULL, 3423420, 'A', 'N', '2019-01-07 01:25:58', '2019-01-07 01:25:58', 1, NULL, NULL, NULL),
(2, 2, 'W', 'Wirehouse A1', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-07 01:26:26', '2019-01-07 01:26:26', 1, NULL, NULL, NULL),
(3, 3, 'W', 'Wirehouse B1', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-07 01:26:27', '2019-01-07 01:26:27', 1, NULL, NULL, NULL),
(4, 4, 'W', 'Test Plant', 'testing', NULL, NULL, NULL, 78654, 'A', 'N', '2019-01-07 01:27:42', '2019-01-07 01:27:42', 1, NULL, NULL, NULL),
(5, 31, 'W', 'Wirehouse A8', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-08 06:11:02', '2019-01-08 06:11:02', 1, NULL, NULL, NULL),
(6, 32, 'W', 'Wirehouse B8', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-08 06:11:04', '2019-01-08 06:11:04', 1, NULL, NULL, NULL),
(7, 33, 'P', 'ssssasdavsdvewqweqw', 'test', NULL, NULL, NULL, 522336, 'A', 'N', '2019-01-08 06:11:48', '2019-01-08 06:11:48', 1, NULL, NULL, NULL),
(8, 35, 'P', 'Ambuja Cement Limited', 'Sankrail Plant', NULL, NULL, NULL, 0, 'A', 'N', '2019-01-08 06:32:25', '2019-01-08 06:32:25', 1, NULL, NULL, NULL),
(9, 36, 'W', 'Dalmia Cement (Bharat) Limited', 'Pakuria Depot', NULL, NULL, NULL, 0, 'A', 'N', '2019-01-08 06:33:24', '2019-01-08 06:33:24', 1, NULL, NULL, NULL),
(10, 38, 'P', 'New Plant 08-01-2019', 'test', NULL, NULL, NULL, 100000, 'A', 'N', '2019-01-08 06:49:24', '2019-01-08 06:49:24', 1, NULL, NULL, NULL),
(11, 45, 'P', 'Plant A988', 'Testing Description A', NULL, NULL, NULL, 115456, 'A', 'N', '2019-01-08 07:02:18', '2019-01-08 07:02:18', 1, NULL, NULL, NULL),
(12, 46, 'W', 'Wirehouse A988', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-08 07:02:19', '2019-01-08 07:02:19', 1, NULL, NULL, NULL),
(13, 47, 'W', 'Wirehouse B988', 'Testing Description 2', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-08 07:02:20', '2019-01-08 07:02:20', 1, NULL, NULL, NULL),
(14, 48, 'P', 'Plant A98899', 'Testing Description A', NULL, NULL, NULL, 115456, 'A', 'N', '2019-01-08 07:05:19', '2019-01-08 07:05:19', 1, NULL, NULL, NULL),
(15, 49, 'W', 'Wirehouse A98899', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-08 07:05:20', '2019-01-08 07:05:20', 1, NULL, NULL, NULL),
(16, 50, 'W', 'Wirehouse B98899', 'Testing Description 2', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-08 07:05:21', '2019-01-08 07:05:21', 1, NULL, NULL, NULL),
(17, 51, 'P', 'CCCCCCCCCCCCCCCCCCCCCCCCCCCCASDSADASD', 'CCCCCCCCCCCCCCCCCCC', NULL, NULL, NULL, 54564, 'D', 'Y', '2019-01-09 03:35:50', '2019-01-09 06:16:54', 1, 1, '2019-01-09 06:16:54', 1),
(18, 55, 'P', 'PLANT 10_01_2019', 'TESTING', NULL, NULL, NULL, 25000, 'A', 'N', '2019-01-10 01:14:33', '2019-01-10 01:14:33', 1, NULL, NULL, NULL),
(19, 59, 'P', 'P10-01-19', 'HHJHJGHJGGGJH', NULL, NULL, NULL, 100000, 'D', 'Y', '2019-01-10 01:35:57', '2019-01-10 01:41:48', 1, NULL, '2019-01-10 01:41:48', 1),
(20, 61, 'P', 'SAN', 'TEST', NULL, NULL, NULL, 100000, 'D', 'Y', '2019-01-10 02:02:05', '2019-01-10 02:05:01', 1, NULL, '2019-01-10 02:05:01', 1),
(21, 62, 'P', 'Plant A 10_01-2019', 'Testing Description A', NULL, NULL, NULL, 115456, 'A', 'N', '2019-01-10 02:14:51', '2019-01-10 02:14:51', 1, NULL, NULL, NULL),
(22, 63, 'W', 'Wirehouse A 10_01_2019', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 02:14:53', '2019-01-10 02:14:53', 1, NULL, NULL, NULL),
(23, 70, 'W', 'Wirehouse B 10_01_2019', 'Testing Description 2', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-10 02:33:23', '2019-01-10 02:33:23', 1, NULL, NULL, NULL),
(24, 31, 'W', 'Wirehouse A81', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 02:40:22', '2019-01-10 02:40:22', 1, NULL, NULL, NULL),
(25, 71, 'W', 'Wirehouse B81', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-10 02:40:23', '2019-01-10 02:40:23', 1, NULL, NULL, NULL),
(26, 31, 'W', 'Wirehouse A8111', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 03:34:33', '2019-01-10 03:34:33', 1, NULL, NULL, NULL),
(27, 71, 'W', 'Wirehouse B8111', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-10 03:34:33', '2019-01-10 03:34:33', 1, NULL, NULL, NULL),
(28, 72, 'W', 'Wirehouse A899', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 03:37:48', '2019-01-10 03:37:48', 1, NULL, NULL, NULL),
(29, 73, 'W', 'Wirehouse B899', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-10 03:37:49', '2019-01-10 03:37:49', 1, NULL, NULL, NULL),
(30, 74, 'W', 'Wirehouse A8992', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 03:39:57', '2019-01-10 03:39:57', 1, NULL, NULL, NULL),
(31, 75, 'W', 'Wirehouse B8992', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-10 03:39:58', '2019-01-10 03:39:58', 1, NULL, NULL, NULL),
(32, 76, 'P', 'Plant A 10_01-20191_1', 'Testing Description A', NULL, NULL, NULL, 115456, 'A', 'N', '2019-01-10 03:44:20', '2019-01-10 03:44:20', 1, NULL, NULL, NULL),
(33, 77, 'W', 'Wirehouse A 10_01_20191_1', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 03:44:21', '2019-01-10 03:44:21', 1, NULL, NULL, NULL),
(34, 78, 'P', 'Plant Patiala', 'Testing Description A', NULL, NULL, NULL, 115456, 'A', 'N', '2019-01-10 03:47:45', '2019-01-10 03:47:45', 1, NULL, NULL, NULL),
(35, 79, 'W', 'Wirehouse Bandhavgarh', 'Testing Description 1', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 03:47:46', '2019-01-10 03:47:46', 1, NULL, NULL, NULL),
(36, 84, 'W', 'Wirehouse C8992', 'Testing Description 11', NULL, NULL, NULL, 228787, 'A', 'N', '2019-01-10 04:48:34', '2019-01-10 04:48:34', 1, NULL, NULL, NULL),
(37, 85, 'W', 'Wirehouse D8992', 'Testing Description 21', NULL, NULL, NULL, 310000, 'A', 'N', '2019-01-10 04:48:36', '2019-01-10 04:48:36', 1, NULL, NULL, NULL);

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

--
-- Dumping data for table `ss_plant_addresses`
--

INSERT INTO `ss_plant_addresses` (`id`, `plant_id`, `address`, `city_id`, `state_id`, `country_id`, `lat`, `lng`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'GT Road', 5, 1, 1, NULL, NULL, 'A', 'N', '2018-10-26 03:50:59', '2018-10-26 03:50:59', 1, NULL, NULL, NULL),
(2, 5, 'Ultadanga', 2, 1, 1, '22.594817', '88.3868594', 'A', 'N', '2018-10-26 05:21:44', '2018-10-26 05:21:44', 1, NULL, NULL, NULL),
(3, 6, 'Shyambazar', 2, 1, 1, '22.5982031', '88.36868659999999', 'A', 'N', '2018-10-26 05:21:45', '2018-10-26 05:21:45', 1, NULL, NULL, NULL),
(4, 7, 'Ultadanga', 2, 1, 1, '22.594817', '88.3868594', 'A', 'N', '2018-10-26 05:21:46', '2018-10-26 05:21:46', 1, NULL, NULL, NULL),
(5, 8, 'Add 1', 2, 1, 1, '22.57918', '88.4288188', 'A', 'N', '2018-10-26 05:54:26', '2018-10-26 05:54:26', 1, NULL, NULL, NULL),
(6, 9, 'Add 2', 17, 20, 1, '26.8466937', '80.94616599999999', 'A', 'N', '2018-10-26 05:54:28', '2018-10-26 05:54:28', 1, NULL, NULL, NULL),
(7, 10, 'Add 3', 18, 18, 1, '23.2139408', '77.4364806', 'A', 'N', '2018-10-26 05:54:29', '2018-10-26 05:54:29', 1, NULL, NULL, NULL),
(8, 11, 'Add 1', 2, 1, 1, '22.57918', '88.4288188', 'D', 'Y', '2018-10-26 05:56:31', '2018-10-26 05:56:44', 1, NULL, '2018-10-26 05:56:44', 1),
(9, 12, 'Add 1', 2, 1, 1, '22.57918', '88.4288188', 'A', 'N', '2018-10-26 05:57:09', '2018-10-26 05:57:09', 1, NULL, NULL, NULL),
(10, 15, 'Add 1kas\r', 2, 1, 1, '22.6520429', '88.4463299', 'A', 'N', '2018-10-26 06:15:59', '2018-10-26 06:15:59', 1, NULL, NULL, NULL),
(11, 16, 'Add 2aks\r', 17, 20, 1, '26.8466937', '80.94616599999999', 'A', 'N', '2018-10-26 06:16:00', '2018-10-26 06:16:00', 1, NULL, NULL, NULL),
(12, 19, 'Add 189\r', 2, 1, 1, '22.572646', '88.36389500000001', 'A', 'N', '2018-10-26 06:29:31', '2018-10-26 06:29:31', 2, NULL, NULL, NULL),
(13, 20, 'Add 289\r', 17, 20, 1, '26.8466937', '80.94616599999999', 'A', 'N', '2018-10-26 06:29:32', '2018-10-26 06:29:32', 2, NULL, NULL, NULL);

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

INSERT INTO `ss_plant_journal_lasers` (`id`, `plant_id`, `type`, `trip_id`, `amount`, `truck_id`, `description`, `entry_type`, `entry_by`, `approved_by`, `approved_on`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, 1, 'C', NULL, 3423423.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-07 01:25:59', '2019-01-07 01:25:59', 1, NULL, NULL, NULL),
(2, 2, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-07 01:26:26', '2019-01-07 01:26:26', 1, NULL, NULL, NULL),
(3, 3, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-07 01:26:27', '2019-01-07 01:26:27', 1, NULL, NULL, NULL),
(4, 4, 'C', NULL, 78654.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-07 01:27:42', '2019-01-07 01:27:42', 1, NULL, NULL, NULL),
(5, 5, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 06:11:03', '2019-01-08 06:11:03', 1, NULL, NULL, NULL),
(6, 6, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 06:11:04', '2019-01-08 06:11:04', 1, NULL, NULL, NULL),
(7, 7, 'C', NULL, 522336.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 06:11:48', '2019-01-08 06:11:48', 1, NULL, NULL, NULL),
(8, 8, 'C', NULL, 0.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 06:32:25', '2019-01-08 06:32:25', 1, NULL, NULL, NULL),
(9, 9, 'C', NULL, 0.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 06:33:24', '2019-01-08 06:33:24', 1, NULL, NULL, NULL),
(10, 10, 'C', NULL, 100000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 06:49:25', '2019-01-08 06:49:25', 1, NULL, NULL, NULL),
(11, 11, 'C', NULL, 115456.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 07:02:18', '2019-01-08 07:02:18', 1, NULL, NULL, NULL),
(12, 12, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 07:02:20', '2019-01-08 07:02:20', 1, NULL, NULL, NULL),
(13, 13, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 07:02:20', '2019-01-08 07:02:20', 1, NULL, NULL, NULL),
(14, 14, 'C', NULL, 115456.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 07:05:19', '2019-01-08 07:05:19', 1, NULL, NULL, NULL),
(15, 15, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 07:05:20', '2019-01-08 07:05:20', 1, NULL, NULL, NULL),
(16, 16, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-08 07:05:22', '2019-01-08 07:05:22', 1, NULL, NULL, NULL),
(17, 17, 'C', NULL, 54564.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'D', 'Y', '2019-01-09 03:35:50', '2019-01-09 06:16:54', 1, 1, '2019-01-09 06:16:54', 1),
(18, 18, 'C', NULL, 25000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 01:14:33', '2019-01-10 01:14:33', 1, NULL, NULL, NULL),
(19, 19, 'C', NULL, 100000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'D', 'Y', '2019-01-10 01:35:57', '2019-01-10 01:41:47', 1, NULL, '2019-01-10 01:41:47', 1),
(20, 20, 'C', NULL, 100000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'D', 'Y', '2019-01-10 02:02:05', '2019-01-10 02:05:01', 1, NULL, '2019-01-10 02:05:01', 1),
(21, 21, 'C', NULL, 115456.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 02:14:51', '2019-01-10 02:14:51', 1, NULL, NULL, NULL),
(22, 22, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 02:14:53', '2019-01-10 02:14:53', 1, NULL, NULL, NULL),
(23, 23, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 02:33:23', '2019-01-10 02:33:23', 1, NULL, NULL, NULL),
(24, 24, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 02:40:22', '2019-01-10 02:40:22', 1, NULL, NULL, NULL),
(25, 25, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 02:40:23', '2019-01-10 02:40:23', 1, NULL, NULL, NULL),
(26, 26, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:34:33', '2019-01-10 03:34:33', 1, NULL, NULL, NULL),
(27, 27, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:34:33', '2019-01-10 03:34:33', 1, NULL, NULL, NULL),
(28, 28, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:37:48', '2019-01-10 03:37:48', 1, NULL, NULL, NULL),
(29, 29, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:37:49', '2019-01-10 03:37:49', 1, NULL, NULL, NULL),
(30, 30, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:39:57', '2019-01-10 03:39:57', 1, NULL, NULL, NULL),
(31, 31, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:39:59', '2019-01-10 03:39:59', 1, NULL, NULL, NULL),
(32, 32, 'C', NULL, 115456.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:44:20', '2019-01-10 03:44:20', 1, NULL, NULL, NULL),
(33, 33, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:44:21', '2019-01-10 03:44:21', 1, NULL, NULL, NULL),
(34, 34, 'C', NULL, 115456.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:47:45', '2019-01-10 03:47:45', 1, NULL, NULL, NULL),
(35, 35, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 03:47:46', '2019-01-10 03:47:46', 1, NULL, NULL, NULL),
(36, 36, 'C', NULL, 228787.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 04:48:35', '2019-01-10 04:48:35', 1, NULL, NULL, NULL),
(37, 37, 'C', NULL, 310000.00, NULL, 'Balance Initiation', 'BG', 1, NULL, NULL, 'A', 'N', '2019-01-10 04:48:36', '2019-01-10 04:48:36', 1, NULL, NULL, NULL);

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
  `approved_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `approved_on` timestamp NULL DEFAULT NULL,
  `approval_status` enum('Pending','Approved','Disapproved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending',
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

--
-- Dumping data for table `ss_plant_user_relations`
--

INSERT INTO `ss_plant_user_relations` (`id`, `plant_id`, `user_id`, `is_deleted`, `created_at`, `created_by`, `updated_at`, `deleted_at`, `deleted_by`) VALUES
(1, 2, 14, 'N', '2019-01-07 01:26:26', 1, '2019-01-07 01:26:26', NULL, NULL),
(2, 3, 15, 'N', '2019-01-07 01:26:27', 1, '2019-01-07 01:26:27', NULL, NULL),
(3, 1, 3, 'N', '2019-01-07 01:28:33', 1, '2019-01-07 01:28:33', NULL, NULL),
(4, 5, 17, 'N', '2019-01-08 06:11:03', 1, '2019-01-08 06:11:03', NULL, NULL),
(5, 6, 18, 'N', '2019-01-08 06:11:04', 1, '2019-01-08 06:11:04', NULL, NULL),
(6, 11, 19, 'N', '2019-01-08 07:02:18', 1, '2019-01-08 07:02:18', NULL, NULL),
(7, 12, 20, 'N', '2019-01-08 07:02:20', 1, '2019-01-08 07:02:20', NULL, NULL),
(8, 13, 21, 'N', '2019-01-08 07:02:20', 1, '2019-01-08 07:02:20', NULL, NULL),
(9, 14, 22, 'N', '2019-01-08 07:05:19', 1, '2019-01-08 07:05:19', NULL, NULL),
(10, 15, 23, 'N', '2019-01-08 07:05:20', 1, '2019-01-08 07:05:20', NULL, NULL),
(11, 16, 24, 'N', '2019-01-08 07:05:21', 1, '2019-01-08 07:05:21', NULL, NULL),
(12, 21, 25, 'N', '2019-01-10 02:14:51', 1, '2019-01-10 02:14:51', NULL, NULL),
(13, 22, 26, 'N', '2019-01-10 02:14:53', 1, '2019-01-10 02:14:53', NULL, NULL),
(14, 23, 27, 'N', '2019-01-10 02:33:23', 1, '2019-01-10 02:33:23', NULL, NULL),
(15, 24, 28, 'N', '2019-01-10 02:40:22', 1, '2019-01-10 02:40:22', NULL, NULL),
(16, 25, 29, 'N', '2019-01-10 02:40:23', 1, '2019-01-10 02:40:23', NULL, NULL),
(17, 26, 30, 'N', '2019-01-10 03:34:33', 1, '2019-01-10 03:34:33', NULL, NULL),
(18, 27, 31, 'N', '2019-01-10 03:34:33', 1, '2019-01-10 03:34:33', NULL, NULL),
(19, 28, 32, 'N', '2019-01-10 03:37:48', 1, '2019-01-10 03:37:48', NULL, NULL),
(20, 29, 33, 'N', '2019-01-10 03:37:49', 1, '2019-01-10 03:37:49', NULL, NULL),
(21, 30, 34, 'N', '2019-01-10 03:39:57', 1, '2019-01-10 03:39:57', NULL, NULL),
(22, 31, 35, 'N', '2019-01-10 03:39:58', 1, '2019-01-10 03:39:58', NULL, NULL),
(23, 32, 36, 'N', '2019-01-10 03:44:20', 1, '2019-01-10 03:44:20', NULL, NULL),
(24, 33, 37, 'N', '2019-01-10 03:44:21', 1, '2019-01-10 03:44:21', NULL, NULL),
(25, 34, 38, 'N', '2019-01-10 03:47:45', 1, '2019-01-10 03:47:45', NULL, NULL),
(26, 35, 39, 'N', '2019-01-10 03:47:46', 1, '2019-01-10 03:47:46', NULL, NULL),
(27, 36, 40, 'N', '2019-01-10 04:48:35', 1, '2019-01-10 04:48:35', NULL, NULL),
(28, 37, 41, 'N', '2019-01-10 04:48:36', 1, '2019-01-10 04:48:36', NULL, NULL);

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
(69, 3),
(70, 3),
(71, 3),
(72, 3);

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
(1, 1, 'West Bengal', 'WB', 'A', 'N', '2018-09-12 00:22:53', '2018-09-12 01:08:06', 1, 1, NULL, NULL),
(2, 1, 'Bihar', 'BR', 'D', 'Y', '2018-09-12 00:23:09', '2018-10-03 00:41:06', 1, 1, '2018-10-03 00:41:06', 1),
(3, 1, 'Andhra Pradesh', 'AP', 'D', 'Y', '2018-09-12 00:41:15', '2018-10-03 00:41:10', 1, NULL, '2018-10-03 00:41:10', 1),
(4, 1, 'Arunachal Pradesh', 'AR', 'D', 'Y', '2018-09-12 00:42:48', '2018-10-03 00:41:16', 1, NULL, '2018-10-03 00:41:16', 1),
(5, 1, 'Assam', 'AS', 'I', 'N', '2018-09-12 00:43:10', '2018-09-12 00:43:10', 1, NULL, NULL, NULL),
(6, 1, 'Chandigarh', 'CH', 'D', 'Y', '2018-09-12 00:44:22', '2018-10-03 00:46:32', 1, NULL, '2018-10-03 00:46:32', 1),
(7, 1, 'Chhattisgarh', 'CT', 'D', 'Y', '2018-09-12 00:44:46', '2018-10-03 00:41:20', 1, NULL, '2018-10-03 00:41:20', 1),
(8, 1, 'Delhi', 'DL', 'D', 'Y', '2018-09-12 00:45:25', '2018-10-03 00:46:27', 1, NULL, '2018-10-03 00:46:27', 1),
(9, 1, 'Goa', 'GA', 'D', 'Y', '2018-09-12 00:50:10', '2018-10-03 00:47:20', 1, NULL, '2018-10-03 00:47:20', 1),
(10, 1, 'Gujarat', 'GJ', 'A', 'N', '2018-09-12 00:50:33', '2018-09-12 00:50:33', 1, NULL, NULL, NULL),
(11, 1, 'Haryana', 'HR', 'D', 'Y', '2018-09-12 00:51:05', '2018-10-03 00:46:43', 1, NULL, '2018-10-03 00:46:43', 1),
(12, 1, 'Himachal Pradesh', 'HP', 'D', 'Y', '2018-09-12 00:51:31', '2018-10-03 00:47:34', 1, NULL, '2018-10-03 00:47:34', 1),
(13, 1, 'Jammu and Kashmir', 'JK', 'D', 'Y', '2018-09-12 00:52:00', '2018-10-03 00:46:45', 1, NULL, '2018-10-03 00:46:45', 1),
(14, 1, 'Jharkhand', 'JH', 'D', 'Y', '2018-09-12 00:53:42', '2018-09-27 00:38:24', 1, NULL, '2018-09-27 00:38:24', 1),
(15, 1, 'Karnataka', 'KA', 'D', 'Y', '2018-09-12 00:54:05', '2018-10-03 00:46:49', 1, NULL, '2018-10-03 00:46:49', 1),
(16, 1, 'Maharashtra', 'MH', 'A', 'N', '2018-09-18 04:55:33', '2018-09-18 04:55:33', 1, NULL, NULL, NULL),
(17, 1, 'Gujrat', 'GUJ', 'A', 'N', '2018-09-18 05:55:09', '2018-09-18 05:55:09', 1, NULL, NULL, NULL),
(18, 1, 'Madhya Pradesh', 'MP', 'A', 'N', '2018-09-18 05:55:10', '2018-09-18 05:55:10', 1, NULL, NULL, NULL),
(19, 1, 'Rajasthan', 'RJ', 'A', 'N', '2018-09-18 05:55:11', '2018-09-18 05:55:11', 1, NULL, NULL, NULL),
(20, 1, 'Uttar Pradesh', 'UP', 'A', 'N', '2018-09-21 07:41:02', '2018-09-21 07:41:02', 1, NULL, NULL, NULL),
(21, 1, 'West_B_new', 'WB_NEW', 'D', 'Y', '2018-09-21 07:50:12', '2018-10-26 06:28:14', 1, NULL, '2018-10-26 06:28:14', 2),
(22, 1, 'West Bengal99', 'WB99', 'A', 'N', '2018-09-21 07:54:11', '2018-09-21 07:54:11', 1, NULL, NULL, NULL),
(23, 1, 'Maharashtra1', 'MH1', 'A', 'N', '2018-09-21 07:54:13', '2018-09-21 07:54:13', 1, NULL, NULL, NULL),
(24, 1, 'Abc', 'Ab', 'I', 'N', '2018-10-03 00:35:36', '2018-10-03 00:35:36', 1, NULL, NULL, NULL),
(25, 1, 'West Bengaltyyyuyuyyy', 'xcvv', 'I', 'N', '2018-10-03 00:40:57', '2018-10-03 00:40:57', 1, NULL, NULL, NULL);

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
  `trip_status` enum('Awaiting','Running','Cancelled','Settled','Unsettled','Closed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Awaiting',
  `GPS_trip_status` enum('Start','End') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Start',
  `POD_file` mediumtext COLLATE utf8mb4_unicode_ci,
  `POD_status` enum('No','Yes','D') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No',
  `POD_uploaded_by` bigint(20) DEFAULT NULL COMMENT 'primary key of ''users''',
  `POD_uploaded_at` timestamp NULL DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
-- Dumping data for table `ss_trips`
--

INSERT INTO `ss_trips` (`id`, `trip_date`, `lr_no`, `category_id`, `subcategory_id`, `plant_id`, `plant_address_id`, `invoice_challan_no`, `do_shipment_no`, `party_id`, `party_destination_id`, `truck_id`, `quantity`, `truck_owner`, `truck_driver_name`, `truck_driver_phone_number`, `truck_driver_email`, `petrol_pump_id`, `advance_amount`, `diesel_amount`, `trip_status`, `GPS_trip_status`, `POD_file`, `POD_status`, `POD_uploaded_by`, `POD_uploaded_at`, `description`, `status`, `is_deleted`, `created_at`, `updated_at`, `created_by`, `updated_by`, `deleted_at`, `deleted_by`) VALUES
(1, '2018-10-24 18:30:00', '6578665', 1, '1', 1, 1, '5687556', '54465444', 1, 1, 1, '500', 'D.Kumar', 'SJ', NULL, NULL, 1, 521000.00, 7120002.00, 'Awaiting', 'Start', NULL, 'No', NULL, NULL, 'test', 'A', 'N', '2018-10-26 04:07:47', '2018-10-26 07:48:57', 1, 2, NULL, NULL),
(2, '2018-10-26 18:30:00', '23322', 1, '1', 5, 2, '23322', '34444', 1, 1, 2, '3322', 'SP', 'AS', NULL, NULL, 9, 22200.00, 1000.00, 'Awaiting', 'Start', NULL, 'No', NULL, NULL, 'Test', 'A', 'N', '2018-10-26 06:53:09', '2018-10-26 07:49:06', 2, 2, NULL, NULL);

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
(1, 2, 'M', 'WB-09R-9872', 'A', 'N', '2019-01-07 02:20:30', '2019-01-07 02:20:30', 1, NULL, NULL, NULL),
(2, 3, 'M', 'WB-09U-0971', 'A', 'N', '2019-01-07 02:21:20', '2019-01-10 05:50:45', 1, NULL, NULL, NULL),
(3, 1, 'C', 'WB-03G-1893', 'A', 'N', '2019-01-07 02:22:51', '2019-01-10 06:02:29', 1, 1, NULL, NULL),
(4, 2, 'M', 'WB-12C-1211', 'D', 'Y', '2019-01-08 07:16:14', '2019-01-09 06:18:15', 1, NULL, '2019-01-09 06:18:15', 1),
(5, 1, 'C', 'WB-09U-0978', 'A', 'N', '2019-01-09 04:48:23', '2019-01-10 06:02:01', 1, 1, NULL, NULL),
(6, 6, 'M', '', 'D', 'Y', '2019-01-10 01:46:01', '2019-01-10 01:53:33', 1, NULL, '2019-01-10 01:53:33', 1),
(7, 7, 'M', NULL, 'D', 'Y', '2019-01-10 02:07:16', '2019-01-10 02:07:52', 1, NULL, '2019-01-10 02:07:52', 1),
(8, 8, 'M', 'WB-09U-9263', 'D', 'Y', '2019-01-10 02:09:16', '2019-01-10 04:05:08', 1, NULL, '2019-01-10 04:05:08', 1),
(9, 1, 'C', 'WB-09R-1836', 'A', 'N', '2019-01-10 04:03:09', '2019-01-10 04:03:09', 1, NULL, NULL, NULL),
(10, 9, 'M', 'WB-07U-8121', 'A', 'N', '2019-01-10 06:03:53', '2019-01-10 06:03:53', 1, NULL, NULL, NULL),
(11, 2, 'M', 'WB-11A-2314', 'A', 'N', '2019-01-11 00:48:04', '2019-01-11 00:48:04', 1, NULL, NULL, NULL);

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
(1, 3, 'R332R23R23WEREWR', NULL, '2018-12-31 18:30:00', NULL, '2019-01-21 18:30:00', '', 'A', '1', 'N', '2019-01-07 02:22:51', '2019-01-11 00:48:59', 1, 1, NULL, NULL),
(2, 5, 'WRWRE325345', NULL, '2018-12-31 18:30:00', NULL, '2019-01-22 18:30:00', '', 'A', '1', 'N', '2019-01-09 04:48:23', '2019-01-11 00:48:59', 1, 1, NULL, NULL),
(3, 9, 'WERWRWR', NULL, '2018-12-31 18:30:00', NULL, '2019-01-27 18:30:00', 'insurance_1547112789.jpg', 'A', '1', 'N', '2019-01-10 04:03:09', '2019-01-11 00:48:59', 1, NULL, NULL, NULL);

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
(1, 3, '3432423423', NULL, '2018-12-31 18:30:00', NULL, '2019-01-30 18:30:00', '', 'A', '1', 'N', '2019-01-07 02:22:51', '2019-01-11 00:49:04', 1, 1, NULL, NULL),
(2, 5, 'SAAS4323234', NULL, '2018-12-31 18:30:00', NULL, '2019-01-22 18:30:00', '', 'A', '1', 'N', '2019-01-09 04:48:23', '2019-01-11 00:49:04', 1, 1, NULL, NULL),
(3, 9, 'WERWERWEREWR', NULL, '2018-12-31 18:30:00', NULL, '2019-01-30 18:30:00', 'permit_1547112789.jpg', 'A', '1', 'N', '2019-01-10 04:03:09', '2019-01-11 00:49:04', 1, NULL, NULL, NULL);

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
(1, 3, 'ZXCZXXCC123', NULL, '2019-01-07 18:30:00', NULL, '2019-02-03 18:30:00', '', 'A', '0', 'N', '2019-01-07 02:22:51', '2019-01-10 06:02:29', 1, 1, NULL, NULL),
(2, 5, 'SFDFSD24354', NULL, '2018-12-31 18:30:00', NULL, '2019-01-29 18:30:00', '', 'A', '0', 'N', '2019-01-09 04:48:23', '2019-01-10 06:02:01', 1, 1, NULL, NULL),
(3, 9, 'POLL6756765', NULL, '2018-12-31 18:30:00', NULL, '2019-01-29 18:30:00', 'pollution_1547112789.jpg', 'A', '0', 'N', '2019-01-10 04:03:09', '2019-01-10 04:03:09', 1, NULL, NULL, NULL);

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
(1, 1, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-01-07 02:20:30', '2019-01-10 05:52:24', 1, 1, NULL, NULL),
(2, 2, '5657657', NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-01-07 02:21:20', '2019-01-10 05:50:45', 1, 1, NULL, NULL),
(3, 3, 'REGNewCom907978', NULL, '2019-01-07 18:30:00', NULL, '2019-01-30 18:30:00', '', 'A', '0', 'N', '2019-01-07 02:22:51', '2019-01-10 06:02:29', 1, 1, NULL, NULL),
(4, 4, 'WB-12C-1211', NULL, NULL, NULL, NULL, '', 'D', '0', 'Y', '2019-01-08 07:16:14', '2019-01-09 06:18:15', 1, NULL, '2019-01-09 06:18:15', 1),
(5, 5, 'SASADASDASADS', NULL, '2018-12-31 18:30:00', NULL, '2019-01-13 18:30:00', '', 'A', '0', 'N', '2019-01-09 04:48:23', '2019-01-10 06:02:01', 1, 1, NULL, NULL),
(6, 6, 'HUIHIHUI', NULL, NULL, NULL, NULL, '', 'D', '0', 'Y', '2019-01-10 01:46:01', '2019-01-10 01:53:33', 1, NULL, '2019-01-10 01:53:33', 1),
(7, 7, 'REG123456', NULL, NULL, NULL, NULL, '', 'D', '0', 'Y', '2019-01-10 02:07:16', '2019-01-10 02:07:52', 1, NULL, '2019-01-10 02:07:52', 1),
(8, 8, NULL, NULL, NULL, NULL, NULL, '', 'D', '0', 'Y', '2019-01-10 02:09:16', '2019-01-10 04:05:08', 1, NULL, '2019-01-10 04:05:08', 1),
(9, 9, NULL, NULL, '2018-12-31 18:30:00', NULL, '2019-01-30 18:30:00', 'registration_1547112789.png', 'A', '0', 'N', '2019-01-10 04:03:09', '2019-01-10 04:03:09', 1, NULL, NULL, NULL),
(10, 10, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-01-10 06:03:53', '2019-01-10 06:03:53', 1, NULL, NULL, NULL),
(11, 11, NULL, NULL, NULL, NULL, NULL, '', 'A', '0', 'N', '2019-01-11 00:48:05', '2019-01-11 00:48:05', 1, NULL, NULL, NULL);

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
(1, 3, '2532435345', NULL, '2019-01-16 18:30:00', NULL, '2019-02-03 18:30:00', '', 'A', '0', 'N', '2019-01-07 02:22:51', '2019-01-10 06:02:29', 1, 1, NULL, NULL),
(2, 5, 'SDFDFS23532', NULL, '2018-12-31 18:30:00', NULL, '2019-01-15 18:30:00', '', 'A', '0', 'N', '2019-01-09 04:48:23', '2019-01-10 06:02:01', 1, 1, NULL, NULL),
(3, 9, 'REWEWRW', NULL, '2018-12-31 18:30:00', NULL, '2019-01-20 18:30:00', 'tax_1547112789.png', 'A', '0', 'N', '2019-01-10 04:03:09', '2019-01-10 04:03:09', 1, NULL, NULL, NULL);

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
(1, 1, 'admin@sslogistic.com', '$2y$10$xYOk6DFgBqfq90thBPDzguVHiZa8TMKi6e.eAHt1bNRVz.JPLRMcW', 'Admin', '9876543210', NULL, '', '2019-01-11 00:45:47', NULL, NULL, 'A', 'N', '2018-12-23 13:00:00', '2019-01-11 00:45:47', 0, NULL, NULL, NULL),
(2, 2, 'accountant@sslogistic.com', '$2y$10$xYOk6DFgBqfq90thBPDzguVHiZa8TMKi6e.eAHt1bNRVz.JPLRMcW', 'Accountant', '9876543210', NULL, '', '2019-01-01 17:53:29', NULL, NULL, 'A', 'N', '2018-12-23 13:00:00', '2019-01-01 17:53:29', 0, NULL, NULL, NULL),
(3, 3, 'supervisor@sslogistic.com', '$2y$10$xYOk6DFgBqfq90thBPDzguVHiZa8TMKi6e.eAHt1bNRVz.JPLRMcW', 'Supervisor', '9876543210', NULL, '', '2019-01-09 07:29:11', NULL, NULL, 'A', 'N', '2018-12-23 13:00:00', '2019-01-09 07:29:11', 0, NULL, NULL, NULL),
(14, 3, 'test11@test.com', '$2y$10$QQDJkty2ClfZK0R3VMlfe.RMsq19YI/ezYqo8gh5ErerQyrKG7l52', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-07 01:26:24', '2019-01-07 01:26:24', 1, 1, NULL, NULL),
(15, 3, 'test32@test.com', '$2y$10$neykPptrlEq94D/.WuUwM.OQ3lxvUu/ckHwV2F78OEGE.5gjZfdY6', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-07 01:26:26', '2019-01-07 01:26:26', 1, 1, NULL, NULL),
(16, 3, 'test1@test.com', '$2y$10$alubiPf6fEY3c.LMwdWC/.NIrMoOwfdXzA5vsvtQuHUxizrc9.CHC', 'Super1', '6362222', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 05:34:35', '2019-01-08 05:34:35', 1, 1, NULL, NULL),
(17, 3, 'test115@test.com', '$2y$10$HYimsYAn1afAbdqccwaZRO1zzHSIF5ZOlSBYZA/Vpj5C.aXNZDRsu', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 06:11:02', '2019-01-08 06:11:02', 1, 1, NULL, NULL),
(18, 3, 'test325@test.com', '$2y$10$llhDZbBHIpGN87bvr2O72.cqZgkEnGxmA.df4wTwJXtvYCKoxSgbi', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 06:11:03', '2019-01-08 06:11:03', 1, 1, NULL, NULL),
(19, 3, 'test19@test.com', '$2y$10$TWzyZq/8Jvkvf5uWkSh0C.ISURpOxVQvZKwXA3rxRJmnLfIFceFhO', 'Super1', '6362222', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 06:52:52', '2019-01-08 06:52:52', 1, 1, NULL, NULL),
(20, 3, 'test29@test.com', '$2y$10$3WTrq31DmlcXjWeg9ji9wOsgIQ8pVo8qOYd3cLyMfTr1Nm.IGuzdu', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 07:02:19', '2019-01-08 07:02:19', 1, 1, NULL, NULL),
(21, 3, 'test39@test.com', '$2y$10$UPnNxvfU1MEDjcwnXTikNe6ZIua.mvqmwYTka7GRD5sdUqzuuGtGi', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 07:02:20', '2019-01-08 07:02:20', 1, 1, NULL, NULL),
(22, 3, 'test19888@test.com', '$2y$10$bG0rhG02yqHQBpUiexvL6Oe1psP7aXWe5xRD0rxBTvBDB591gtJ6m', 'Super1', '6362222', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 07:05:18', '2019-01-08 07:05:18', 1, 1, NULL, NULL),
(23, 3, 'test2988@test.com', '$2y$10$r8TnhfwGUW0/ff53deOZHuxWk8e/SrU47mrW4X2l8TuOGK9bJt98C', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 07:05:19', '2019-01-08 07:05:19', 1, 1, NULL, NULL),
(24, 3, 'test3988@test.com', '$2y$10$URRUKOtQr73Wy16qSgUXCOM5nX08E.ogisxEofu04wwC5ux9u5nHu', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-08 07:05:20', '2019-01-08 07:05:20', 1, 1, NULL, NULL),
(25, 3, 'test119@test.com', '$2y$10$p6/9cPmW3bxVaJNbhtP1Wes/V/.Nn3jrRyjE1qcJfWQz61kelRl.y', 'Super1', '6362222', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 02:14:50', '2019-01-10 02:14:50', 1, 1, NULL, NULL),
(26, 3, 'test219@test.com', '$2y$10$IJuHkw8Q/1ZFIZpCrtXOGeHSWPxX.iEton8epbTkvuHuXL95owdke', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 02:14:52', '2019-01-10 02:14:52', 1, 1, NULL, NULL),
(27, 3, 'test319@test.com', '$2y$10$VIagPYo2AeqY5Cy5p.n9WOXCtrblQEWj2M5zP9sSgrZsjjVRjkQ7e', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 02:14:53', '2019-01-10 02:14:53', 1, 1, NULL, NULL),
(28, 3, 'test1151@test.com', '$2y$10$kCRNtUxKBmfNPWFhC7PsbuPCZFrpmg11.gv.SyKGKU3ioPwF528dK', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 02:40:22', '2019-01-10 02:40:22', 1, 1, NULL, NULL),
(29, 3, 'test3251@test.com', '$2y$10$MOhZQipjC0npcEEQwncvmuNPNrz3u.vMiPt./kwL3fabFZJOLg8i6', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 02:40:22', '2019-01-10 02:40:22', 1, 1, NULL, NULL),
(30, 3, 'test11521@test.com', '$2y$10$WvUUZqpyhlJ3UN0c9x.jlerzABqC5ANFoPbYrNjILEoG8HsAQdOQq', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:34:33', '2019-01-10 03:34:33', 1, 1, NULL, NULL),
(31, 3, 'test32251@test.com', '$2y$10$3FwdqLFkWUVsYcebkU3KluNpGTKorDBtXsfKy4ug2WwKjfHNtZGWO', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:34:33', '2019-01-10 03:34:33', 1, 1, NULL, NULL),
(32, 3, 'test1199@test.com', '$2y$10$NvT8mNpO3OWm2DaMcuCkO.OPElgAXWK7rhLKgcqUpYrP7BaS5naiu', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:37:47', '2019-01-10 03:37:47', 1, 1, NULL, NULL),
(33, 3, 'test3299@test.com', '$2y$10$BPTngCMid..lDY6HLfhjMOB956leoRngczIleOfri6XsrYbJV37RW', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:37:48', '2019-01-10 03:37:48', 1, 1, NULL, NULL),
(34, 3, 'test11992@test.com', '$2y$10$mOjdH7S3MRDAxYNXj/784uIDplqRDwl22A68LrOVheMm3AUBstAhy', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:39:56', '2019-01-10 03:39:56', 1, 1, NULL, NULL),
(35, 3, 'test32992@test.com', '$2y$10$cVXYbHm0q5d5.lfcLAQnlOjLuar.qf5bLcFyZ5N50nf0kitaqK.LS', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:39:58', '2019-01-10 03:39:58', 1, 1, NULL, NULL),
(36, 3, 'test11911@test.com', '$2y$10$P4lb8j17O/NwAto6YffexexBKyvU26sVpOruuS.yMq3/VL/FviFQa', 'Super1', '6362222', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:44:19', '2019-01-10 03:44:19', 1, 1, NULL, NULL),
(37, 3, 'test21911@test.com', '$2y$10$2.UeddVpy0WRdHJvRZdZZOuvKdD5OSEBuRSkatP6EfzkwnJR3svRO', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:44:20', '2019-01-10 03:44:20', 1, 1, NULL, NULL),
(38, 3, 'test119112@test.com', '$2y$10$nBmecQZGe5aOuiLuC9ybxO0BTbS0o.blTOnGGo4Qf7cL3Z/.O0WU6', 'Super1', '6362222', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:47:44', '2019-01-10 03:47:44', 1, 1, NULL, NULL),
(39, 3, 'test219112@test.com', '$2y$10$io0hytGteVpWjmnEqBwyd.9NtS0E8r39meEhF3FkMWjZc5n57NQWS', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 03:47:45', '2019-01-10 03:47:45', 1, 1, NULL, NULL),
(40, 3, 'testc11992@test.com', '$2y$10$F3s.RskCeEvgDwEaZeM.FOdryDZ3pdGOWjPHho70J.OeaAL6FZsIy', 'Super2', '4786666', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 04:48:33', '2019-01-10 04:48:33', 1, 1, NULL, NULL),
(41, 3, 'testd32992@test.com', '$2y$10$XckKclcAgDZ3m9olpvaANurFdwXesvuLtv0UZSHsB1JgWu7up6Cfm', 'Super3', '9786446', NULL, NULL, NULL, NULL, NULL, 'A', 'N', '2019-01-10 04:48:35', '2019-01-10 04:48:35', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ss_vendors`
--

CREATE TABLE `ss_vendors` (
  `id` bigint(20) NOT NULL,
  `name` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(1, 'SSLogistics', 'Super Admin', '9876543210', 'test@sslogistic.com', 'NHY7765', 'SBI', 'SBI000088766', 87787867678, 'Admin admin', 'A', 'N', '2019-01-07 02:07:45', '2019-01-07 02:07:45', 1, NULL, NULL, NULL),
(2, 'M/S Rohit Singh', 'Rohit Singh', '9804640747', 'info@sslogistics.org', 'BTUPS9409M', 'HDFC BANK LIMITED', 'HDFC000174', 1742020001911, 'ROHIT SINGH', 'A', 'N', '2019-01-07 02:08:23', '2019-01-08 06:37:18', 1, 1, NULL, NULL),
(3, 'ppppppp', 'ppppppp', '87897877', 'bbbbb@sslogistic.com', 'NHY7765', 'sda', 'adfsdfsdf', 23876542354, 'sdfsdfsdsdfdsf', 'A', 'N', '2019-01-07 02:21:12', '2019-01-07 02:21:12', 1, NULL, NULL, NULL),
(4, 'M/s DILIP MATRIX', 'Dilip Shaw', '7003112303', 'dilip@matrix.com', 'abcd9401m', 'xyz bank', 'bvcg000154', 1245779912, 'Dilip Shaw', 'D', 'Y', '2019-01-08 06:38:53', '2019-01-09 06:10:18', 1, NULL, '2019-01-09 06:10:18', 1),
(5, 'TEST1', 'TEST1', '45645456', 'test1@ss.com', 'IOKYU9876T', 'SBI', 'WTRERTE', 14243314, 'FDDS', 'D', 'Y', '2019-01-09 06:05:22', '2019-01-09 06:09:46', 1, NULL, '2019-01-09 06:09:46', 1),
(6, 'COMPANY 10-01-2019', 'DFSFDSDS', '1433422', 'dfs@ss.com', 'LKJIU2354L', 'SBI', 'ADSSD34122', 14243314, 'FDDS', 'D', 'Y', '2019-01-10 01:45:03', '2019-01-10 01:53:38', 1, NULL, '2019-01-10 01:53:38', 1),
(7, 'C1', 'C1', '42342343', 'test@ss.com', 'YHGRT5698K', 'SBI', 'SBI00001234', 54566546, 'TEST', 'D', 'Y', '2019-01-10 02:06:48', '2019-01-10 02:07:56', 1, NULL, '2019-01-10 02:07:56', 1),
(8, 'C2', 'C2', '42342343', 'test@ss.com', 'KLOIU8765R', 'SBI', 'SBI00001234', 23525345354, 'C2', 'A', 'N', '2019-01-10 02:08:51', '2019-01-10 02:08:51', 1, NULL, NULL, NULL),
(9, 'C21234', 'C2', '42342343', 'test@ss.com', 'RETRE1234R', 'SBI', 'SBI00001234', 23423424243, 'SASDSDDEW', 'I', 'N', '2019-01-10 03:57:05', '2019-01-10 03:57:05', 1, NULL, NULL, NULL);

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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;
--
-- AUTO_INCREMENT for table `ss_categories`
--
ALTER TABLE `ss_categories`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ss_cities`
--
ALTER TABLE `ss_cities`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `ss_countries`
--
ALTER TABLE `ss_countries`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `ss_gps_trackings`
--
ALTER TABLE `ss_gps_trackings`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_items`
--
ALTER TABLE `ss_items`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `ss_parties`
--
ALTER TABLE `ss_parties`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `ss_party_destinations`
--
ALTER TABLE `ss_party_destinations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT for table `ss_petrol_pumps`
--
ALTER TABLE `ss_petrol_pumps`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `ss_plant_addresses`
--
ALTER TABLE `ss_plant_addresses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers`
--
ALTER TABLE `ss_plant_journal_lasers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;
--
-- AUTO_INCREMENT for table `ss_plant_journal_lasers_edit_requests`
--
ALTER TABLE `ss_plant_journal_lasers_edit_requests`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_plant_user_relations`
--
ALTER TABLE `ss_plant_user_relations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `ss_roles`
--
ALTER TABLE `ss_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_states`
--
ALTER TABLE `ss_states`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `ss_trips`
--
ALTER TABLE `ss_trips`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `ss_trip_payment_managements`
--
ALTER TABLE `ss_trip_payment_managements`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `ss_trucks`
--
ALTER TABLE `ss_trucks`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_truck_insurances`
--
ALTER TABLE `ss_truck_insurances`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_truck_permits`
--
ALTER TABLE `ss_truck_permits`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_truck_pollutions`
--
ALTER TABLE `ss_truck_pollutions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_truck_registrations`
--
ALTER TABLE `ss_truck_registrations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `ss_truck_taxes`
--
ALTER TABLE `ss_truck_taxes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `ss_users`
--
ALTER TABLE `ss_users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `ss_vendors`
--
ALTER TABLE `ss_vendors`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
