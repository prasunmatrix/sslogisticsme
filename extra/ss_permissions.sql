-- phpMyAdmin SQL Dump
-- version 4.6.6deb1+deb.cihar.com~xenial.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 27, 2018 at 03:12 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.1.20-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devsslogistics`
--

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
(1, 'city_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(2, 'city_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(3, 'city_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(4, 'city_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(5, 'state_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(6, 'state_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(7, 'state_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(8, 'state_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(9, 'category_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(10, 'category_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(11, 'category_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(12, 'category_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(13, 'sub_category_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(14, 'sub_category_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(15, 'sub_category_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(16, 'sub_category_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(17, 'plant_manage_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(18, 'plant_manage_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(19, 'plant_manage_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(20, 'plant_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(21, 'plant_manage_address_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(22, 'Plant_manage_address_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(23, 'party_manage_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(24, 'party_manage_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(25, 'party_manage_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(26, 'party_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(27, 'party_manage_distination_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(28, 'party_manage_distination_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(29, 'party_manage_distination_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(30, 'party_manage_distination_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(31, 'petrol_pump_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(32, 'petrol_pump_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(33, 'petrol_pump_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(34, 'petrol_pump_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(35, 'truck_manage_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(36, 'truck_manage_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(37, 'truck_manage_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(38, 'truck_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(39, 'trip_manage_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(40, 'trip_manage_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(41, 'trip_manage_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(42, 'trip_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(43, 'trip_manage_gps_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(44, 'trip_manage_upload_pdo', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(45, 'trip_manage_pdf_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(46, 'report_manage_print', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(47, 'report_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(48, 'user_manage_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(49, 'user_manage_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(50, 'user_manage_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(51, 'user_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(52, 'user_manage_assign_role', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(53, 'user_manage_add_role', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(54, 'user_manage_edit_role', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(55, 'user_manage_delete_role', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(56, 'user_manage_view_role', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(57, 'app_module_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(58, 'app_module_manage_functionalities', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(59, 'notification_insurance_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(60, 'notification_permit_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(61, 'notification_tax_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(62, 'notification_pollution_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(63, 'approvle_adv_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(64, 'approvle_dsl_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(65, 'payment_manage_add', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(66, 'payment_manage_edit', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(67, 'payment_manage_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(68, 'payment_manage_view', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL),
(69, 'city_view', 'web', '2018-08-22 01:08:05', '2018-08-22 01:08:05', 1, 1, NULL, NULL),
(70, 'city_view', 'web', '2018-08-22 01:08:37', '2018-08-22 01:08:37', 1, 1, NULL, NULL),
(71, 'state_view', 'web', '2018-08-22 01:08:37', '2018-08-22 01:08:37', 1, 1, NULL, NULL),
(72, 'category_view', 'web', '2018-08-22 01:08:37', '2018-08-22 01:08:37', 1, 1, NULL, NULL),
(73, 'sub_category_view', 'web', '2018-08-22 01:08:37', '2018-08-22 01:08:37', 1, 1, NULL, NULL),
(74, 'city_add', 'web', '2018-08-22 04:23:59', '2018-08-22 04:23:59', 1, 1, NULL, NULL),
(75, 'city_edit', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(76, 'city_delete', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(77, 'city_view', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(78, 'state_add', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(79, 'state_edit', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(80, 'state_delete', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(81, 'state_view', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(82, 'category_add', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(83, 'category_edit', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(84, 'category_delete', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(85, 'category_view', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(86, 'sub_category_add', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(87, 'sub_category_edit', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(88, 'sub_category_delete', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(89, 'sub_category_view', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(90, 'plant_manage_add', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(91, 'plant_manage_edit', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(92, 'plant_manage_delete', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(93, 'plant_manage_view', 'web', '2018-08-22 04:24:00', '2018-08-22 04:24:00', 1, 1, NULL, NULL),
(94, 'plant_manage_address_add', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(95, 'Plant_manage_address_view', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(96, 'party_manage_add', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(97, 'party_manage_edit', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(98, 'party_manage_delete', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(99, 'party_manage_view', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(100, 'party_manage_distination_add', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(101, 'party_manage_distination_edit', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(102, 'party_manage_distination_delete', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(103, 'party_manage_distination_view', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(104, 'petrol_pump_add', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(105, 'petrol_pump_edit', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(106, 'petrol_pump_delete', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(107, 'petrol_pump_view', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(108, 'truck_manage_add', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(109, 'truck_manage_edit', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(110, 'truck_manage_delete', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(111, 'truck_manage_view', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(112, 'trip_manage_add', 'web', '2018-08-22 04:24:01', '2018-08-22 04:24:01', 1, 1, NULL, NULL),
(113, 'trip_manage_edit', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(114, 'trip_manage_delete', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(115, 'trip_manage_view', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(116, 'trip_manage_gps_view', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(117, 'trip_manage_upload_pdo', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(118, 'trip_manage_pdf_view', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(119, 'report_manage_print', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(120, 'report_manage_view', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(121, 'user_manage_add', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(122, 'user_manage_edit', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(123, 'user_manage_delete', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(124, 'user_manage_view', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(125, 'user_manage_assign_role', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(126, 'user_manage_add_role', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(127, 'user_manage_edit_role', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(128, 'user_manage_delete_role', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(129, 'user_manage_view_role', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(130, 'app_module_manage_view', 'web', '2018-08-22 04:24:02', '2018-08-22 04:24:02', 1, 1, NULL, NULL),
(131, 'app_module_manage_functionalities', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(132, 'notification_insurance_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(133, 'notification_permit_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(134, 'notification_tax_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(135, 'notification_pollution_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(136, 'approvle_adv_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(137, 'approvle_dsl_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(138, 'payment_manage_add', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(139, 'payment_manage_edit', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(140, 'payment_manage_delete', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(141, 'payment_manage_view', 'web', '2018-08-22 04:24:03', '2018-08-22 04:24:03', 1, 1, NULL, NULL),
(142, 'city_add', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(143, 'city_edit', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(144, 'city_delete', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(145, 'city_view', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(146, 'state_add', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(147, 'state_edit', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(148, 'state_delete', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(149, 'state_view', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(150, 'category_add', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(151, 'category_edit', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(152, 'category_delete', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(153, 'category_view', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(154, 'sub_category_add', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(155, 'sub_category_edit', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(156, 'sub_category_delete', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(157, 'sub_category_view', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(158, 'plant_manage_add', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(159, 'plant_manage_edit', 'web', '2018-08-24 03:08:23', '2018-08-24 03:08:23', 6, 6, NULL, NULL),
(160, 'plant_manage_delete', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(161, 'plant_manage_view', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(162, 'plant_manage_address_add', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(163, 'Plant_manage_address_view', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(164, 'party_manage_add', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(165, 'party_manage_edit', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(166, 'party_manage_delete', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(167, 'party_manage_view', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(168, 'party_manage_distination_add', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(169, 'party_manage_distination_edit', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(170, 'party_manage_distination_delete', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(171, 'party_manage_distination_view', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(172, 'petrol_pump_add', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(173, 'petrol_pump_edit', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(174, 'petrol_pump_delete', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(175, 'petrol_pump_view', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(176, 'truck_manage_add', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(177, 'truck_manage_edit', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(178, 'truck_manage_delete', 'web', '2018-08-24 03:08:24', '2018-08-24 03:08:24', 6, 6, NULL, NULL),
(179, 'truck_manage_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(180, 'trip_manage_add', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(181, 'trip_manage_edit', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(182, 'trip_manage_delete', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(183, 'trip_manage_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(184, 'trip_manage_gps_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(185, 'trip_manage_upload_pdo', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(186, 'trip_manage_pdf_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(187, 'report_manage_print', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(188, 'report_manage_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(189, 'user_manage_add', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(190, 'user_manage_edit', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(191, 'user_manage_delete', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(192, 'user_manage_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(193, 'user_manage_assign_role', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(194, 'user_manage_add_role', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(195, 'user_manage_edit_role', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(196, 'user_manage_delete_role', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(197, 'user_manage_view_role', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(198, 'app_module_manage_view', 'web', '2018-08-24 03:08:25', '2018-08-24 03:08:25', 6, 6, NULL, NULL),
(199, 'app_module_manage_functionalities', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(200, 'notification_insurance_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(201, 'notification_permit_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(202, 'notification_tax_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(203, 'notification_pollution_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(204, 'approvle_adv_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(205, 'approvle_dsl_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(206, 'payment_manage_add', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(207, 'payment_manage_edit', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(208, 'payment_manage_delete', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(209, 'payment_manage_view', 'web', '2018-08-24 03:08:26', '2018-08-24 03:08:26', 6, 6, NULL, NULL),
(210, 'country_view', 'web', '2018-08-23 18:30:00', '2018-08-23 18:30:00', 1, 1, NULL, NULL),
(211, 'plant_manage_address_add', 'web', '2018-08-23 18:30:00', '2018-08-23 18:30:00', 1, 1, NULL, NULL),
(212, 'plant_manage_address_delete', 'web', '2018-08-20 18:30:00', '2018-08-20 18:30:00', 1, 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ss_permissions`
--
ALTER TABLE `ss_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
