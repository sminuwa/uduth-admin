-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 11, 2020 at 07:12 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.2.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `uduth`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `username`, `password`, `email`, `phone`, `gender`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'khalifa', 'khalifa', '$2y$10$QbTXX7rak6iUQBWY0KZZMeCFH5OQg17hYbeosMyGZK2c2YNX6DbIq', 'khalifa@gmail.com', '123476543', 'Mail', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `no` int(11) NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `configurations`
--

CREATE TABLE `configurations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '%',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `configurations`
--

INSERT INTO `configurations` (`id`, `name`, `value`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'patient_uid', 'UDUTH', '%', 2, '2020-01-21 23:00:00', '2020-01-21 23:00:00'),
(3, 'site_url', 'uduthctppp.com', '%', 2, '2020-01-25 23:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `experience` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `specialisation` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `doctor_activities`
--

CREATE TABLE `doctor_activities` (
  `id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `injury_id` int(11) NOT NULL,
  `visit_id` int(11) NOT NULL,
  `visit_status_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emails`
--

CREATE TABLE `emails` (
  `id` int(10) UNSIGNED NOT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recipient` blob NOT NULL,
  `cc` blob DEFAULT NULL,
  `bcc` blob DEFAULT NULL,
  `subject` blob NOT NULL,
  `view` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variables` blob DEFAULT NULL,
  `body` blob NOT NULL,
  `from` blob DEFAULT NULL,
  `attachments` blob DEFAULT NULL,
  `attempts` int(11) NOT NULL DEFAULT 0,
  `sending` tinyint(1) NOT NULL DEFAULT 0,
  `failed` tinyint(1) NOT NULL DEFAULT 0,
  `error` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `encrypted` tinyint(1) NOT NULL DEFAULT 0,
  `scheduled_at` timestamp NULL DEFAULT NULL,
  `sent_at` timestamp NULL DEFAULT NULL,
  `delivered_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `injuries`
--

CREATE TABLE `injuries` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2020_01_19_091607_create_appointments_table', 1),
(2, '2020_01_19_091607_create_configurations_table', 1),
(3, '2020_01_19_091607_create_departments_table', 1),
(4, '2020_01_19_091607_create_doctor_activities_table', 1),
(5, '2020_01_19_091607_create_doctors_table', 1),
(6, '2020_01_19_091607_create_injuries_table', 1),
(7, '2020_01_19_091607_create_patients_table', 1),
(8, '2020_01_19_091607_create_payment_status_table', 1),
(9, '2020_01_19_091607_create_payment_types_table', 1),
(10, '2020_01_19_091607_create_payments_table', 1),
(11, '2020_01_19_091607_create_privileges_table', 1),
(12, '2020_01_19_091607_create_referral_docs_table', 1),
(13, '2020_01_19_091607_create_reports_table', 1),
(14, '2020_01_19_091607_create_revenues_table', 1),
(15, '2020_01_19_091607_create_roles_table', 1),
(16, '2020_01_19_091607_create_service_types_table', 1),
(17, '2020_01_19_091607_create_services_table', 1),
(18, '2020_01_19_091607_create_users_table', 1),
(19, '2020_01_19_091607_create_visit_status_table', 1),
(20, '2020_01_19_091607_create_visits_table', 1),
(21, '2020_01_19_101305_create_permissions_table', 1),
(22, '2020_01_21_181049_create_revenue_configurations_table', 1),
(23, '2017_12_14_151403_create_emails_table', 2),
(24, '2017_12_14_151421_add_attachments_to_emails_table', 2),
(25, '2017_12_22_114011_add_from_to_emails_table', 2),
(26, '2020_01_27_093311_create_admins_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int(11) NOT NULL,
  `uid` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `age` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `companion` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hospital_referral_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `referral_letter` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `patient_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file_no` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `sync_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `uid`, `name`, `age`, `gender`, `address`, `phone`, `email`, `companion`, `hospital_referral_name`, `referral_letter`, `patient_type`, `file_no`, `user_id`, `sync_status`, `created_at`, `updated_at`) VALUES
(3, 'UDUTH2/20/0003', 'Mubarak Muhammad Sani', '27', 'Female', 'Zaria', '08035362419', 'mmm@mmm.com', 'Ibrahim Umar', NULL, NULL, 'Other', '1111', 2, 0, '2020-01-26 21:10:39', '2020-01-26 21:17:36');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `service_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `receipt_no` int(11) DEFAULT NULL,
  `sync_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `patient_id`, `service_id`, `service_type`, `service_amount`, `payment_type`, `payment_status`, `user_id`, `receipt_no`, `sync_status`, `created_at`, `updated_at`) VALUES
(3, 2, 7, '13', '50000', 'Cash', 'Complete', 1, 3, 0, '2020-01-25 12:38:55', '2020-01-25 12:38:55'),
(4, 3, 8, '15', '50000', 'Cash', 'Complete', 2, 4, 0, '2020-01-26 21:10:39', '2020-01-26 21:10:39'),
(5, 2, 3, '6', '15000', 'Cash', 'Complete', 1, 5, 0, '2020-01-27 11:54:24', '2020-01-27 11:54:24'),
(7, 4, 3, '5', '30000', 'Cash', 'Complete', 1, 7, 0, '2020-01-27 11:55:55', '2020-01-27 11:55:55'),
(8, 5, 1, '1', '30000', 'Cash', 'Complete', 3, 8, 0, '2020-02-09 07:46:58', '2020-02-09 07:46:58'),
(9, 5, 7, '13', '50000', 'Cash', 'Complete', 3, 9, 0, '2020-02-09 09:28:15', '2020-02-09 09:28:15'),
(10, 6, 1, '1', '30000', 'Cash', 'Complete', 1, 10, 0, '2020-02-24 10:45:32', '2020-02-24 10:45:32');

-- --------------------------------------------------------

--
-- Table structure for table `payment_statuses`
--

CREATE TABLE `payment_statuses` (
  `id` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_statuses`
--

INSERT INTO `payment_statuses` (`id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Complete', NULL, NULL),
(2, 'Pending', NULL, NULL),
(3, 'Cancelled', NULL, NULL),
(4, 'Refunded', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `payment_types`
--

CREATE TABLE `payment_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_types`
--

INSERT INTO `payment_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Cash', NULL, NULL),
(2, 'POS', NULL, NULL),
(3, 'Bank Transfer', NULL, NULL),
(4, 'Cheque', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 2, 'delete.patient', '2020-02-23 23:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `privileges`
--

CREATE TABLE `privileges` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `createUser` int(11) NOT NULL DEFAULT 0,
  `updateUser` int(11) NOT NULL DEFAULT 0,
  `deleteUser` int(11) NOT NULL DEFAULT 0,
  `hospitalAccountPercentage` int(11) NOT NULL DEFAULT 0,
  `managementAccountPercentage` int(11) NOT NULL DEFAULT 0,
  `foresightAccountPercentage` int(11) NOT NULL DEFAULT 0,
  `kalifaAccountPercentage` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `referral_docs`
--

CREATE TABLE `referral_docs` (
  `id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) DEFAULT 0,
  `sync_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `user_id`, `subject`, `description`, `status`, `sync_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Hello', 'This is the report bodyThis is the report bodyThis is the report bodyThis is the report bodyThis is the report bodyThis is the report bodyThis is the report bodyThis is the report bodyThis is the report body', 0, 0, '2020-01-24 23:00:00', NULL),
(2, 1, 'Helloa', 'afasdfsdf', 1, 1, '2020-01-25 17:13:26', '2020-01-25 17:13:26'),
(3, 1, 'Helloa', 'afasdfsdf', 0, 0, '2020-01-25 17:16:16', '2020-01-25 17:16:16'),
(4, 1, 'Helloa', 'afasdfsdf', 0, 0, '2020-01-25 17:17:05', '2020-01-25 17:17:05'),
(5, 1, 'Report on network problem', 'Hello,\r\nThis is to report the issue of not being able to perform operation due to network problem', 0, 0, '2020-01-25 17:18:03', '2020-01-25 17:18:03'),
(6, 1, 'Report on network problem', 'Hello,\r\nThis is to report the issue of not being able to perform operation due to network problem', 0, 0, '2020-01-25 17:27:45', '2020-01-25 17:27:45'),
(7, 1, 'Another report', 'report goes here', 0, 0, '2020-01-25 17:28:10', '2020-01-25 17:28:10');

-- --------------------------------------------------------

--
-- Table structure for table `revenues`
--

CREATE TABLE `revenues` (
  `id` int(11) NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `revenue_configurations`
--

CREATE TABLE `revenue_configurations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '%',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prefix` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_id`, `name`, `prefix`, `created_at`, `updated_at`) VALUES
(1, 1, 'user', 'user', NULL, NULL),
(2, 3, 'admin', 'admin', NULL, NULL),
(3, 4, 'manager', 'manager', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Chest CT', '2019-01-01 13:59:18', '2019-01-01 13:59:18'),
(3, 'Abnominal CT (IVUCT)', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(4, 'Abnominal CT with Oral Contrast', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(5, 'Abnominal CT without Oral Contrast', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(6, 'Brain CT Angiography', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(7, 'Abnominal Angiography', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(8, 'Upper Limb Angiography', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(9, 'Lower Limb Angiography', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(10, 'Pelvic CT', '2019-01-01 13:59:38', '2019-01-01 13:59:38'),
(11, '11111Brain CT', '2019-01-01 13:59:18', '2019-01-01 13:59:18');

-- --------------------------------------------------------

--
-- Table structure for table `service_types`
--

CREATE TABLE `service_types` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `service_types`
--

INSERT INTO `service_types` (`id`, `name`, `amount`, `service_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Adult', '30000', 1, '1', '2018-12-29 13:16:52', NULL),
(2, 'Child', '15000', 1, '1', '2018-12-29 13:16:52', NULL),
(3, 'Adult', '30000', 2, '1', '2018-12-29 13:16:52', NULL),
(4, 'Child', '15000', 2, '1', '2018-12-29 13:16:52', NULL),
(5, 'Adult', '30000', 3, '1', '2018-12-29 13:16:52', NULL),
(6, 'Child', '15000', 3, '1', '2018-12-29 13:16:52', NULL),
(7, 'Adult', '35000', 4, '1', '2018-12-29 13:16:52', NULL),
(8, 'Child', '20000', 4, '1', '2018-12-29 13:16:52', NULL),
(9, 'Adult', '30000', 5, '1', '2018-12-29 13:16:52', NULL),
(10, 'Child', '15000', 5, '1', '2018-12-29 13:16:52', NULL),
(11, 'Adult', '50000', 6, '1', '2018-12-29 13:16:52', NULL),
(12, 'Child', '25000', 6, '1', '2018-12-29 13:16:52', NULL),
(13, 'Adult', '50000', 7, '1', '2018-12-29 13:16:52', NULL),
(14, 'Child', '25000', 7, '1', '2018-12-29 13:16:52', NULL),
(15, 'Adult', '50000', 8, '1', '2018-12-29 13:16:52', NULL),
(16, 'Child', '25000', 8, '1', '2018-12-29 13:16:52', NULL),
(17, 'Adult', '50000', 9, '1', '2018-12-29 13:16:52', NULL),
(18, 'Child', '25000', 9, '1', '2018-12-29 13:16:52', NULL),
(19, 'Adult', '30000', 10, '1', '2018-12-29 13:16:52', NULL),
(20, 'Child', '15000', 10, '1', '2018-12-29 13:16:52', NULL),
(28, 'Mubarak', '131231', 11, '3', '2020-02-27 12:07:44', '2020-02-27 12:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dob` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `picture` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT 'user.jpg',
  `account_name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_number` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('active','inactive','suspended') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'inactive',
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `dob`, `gender`, `email`, `phone`, `picture`, `account_name`, `account_number`, `account_type`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Sunusi Mohd Inuwa', 'sminuwa', '$2y$10$QbTXX7rak6iUQBWY0KZZMeCFH5OQg17hYbeosMyGZK2c2YNX6DbIq', NULL, 'Male', 'sminuwa@yahoo.com', '123190912312', 'user.jpg', NULL, NULL, NULL, 'suspended', 'wjv8IJSYg9i7SeWvUhQmdlqvzlM8k8kujTaKemMVdPecyehaEo3msVYapWwW', '2020-01-22 09:37:12', '2020-03-11 05:02:25'),
(3, 'Khalifa', 'khalifa', '$2y$10$QbTXX7rak6iUQBWY0KZZMeCFH5OQg17hYbeosMyGZK2c2YNX6DbIq', NULL, 'Male', 'khalifa@gmail.com', '08135067070', 'user.jpg', NULL, NULL, NULL, 'active', 'LCkwX9hLBbclmvRISJfOHufmFO9jiW1XM93ziUuqPRNYsBD2iEvQDFkTTBVu', '2020-01-22 09:37:12', '2020-02-29 08:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `visits`
--

CREATE TABLE `visits` (
  `id` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `status` int(11) DEFAULT 0,
  `patient_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `visit_status`
--

CREATE TABLE `visit_status` (
  `id` int(11) NOT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `configurations`
--
ALTER TABLE `configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctor_activities`
--
ALTER TABLE `doctor_activities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emails`
--
ALTER TABLE `emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `injuries`
--
ALTER TABLE `injuries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_types`
--
ALTER TABLE `payment_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `privileges`
--
ALTER TABLE `privileges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referral_docs`
--
ALTER TABLE `referral_docs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenues`
--
ALTER TABLE `revenues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `revenue_configurations`
--
ALTER TABLE `revenue_configurations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_types`
--
ALTER TABLE `service_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visits`
--
ALTER TABLE `visits`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `visit_status`
--
ALTER TABLE `visit_status`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configurations`
--
ALTER TABLE `configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `doctor_activities`
--
ALTER TABLE `doctor_activities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emails`
--
ALTER TABLE `emails`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `injuries`
--
ALTER TABLE `injuries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `payment_statuses`
--
ALTER TABLE `payment_statuses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_types`
--
ALTER TABLE `payment_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `privileges`
--
ALTER TABLE `privileges`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `referral_docs`
--
ALTER TABLE `referral_docs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `revenues`
--
ALTER TABLE `revenues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `revenue_configurations`
--
ALTER TABLE `revenue_configurations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `service_types`
--
ALTER TABLE `service_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `visits`
--
ALTER TABLE `visits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visit_status`
--
ALTER TABLE `visit_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
