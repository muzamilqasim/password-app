-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2024 at 02:49 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `password_app`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `username` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `username`, `password`, `image`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'a@gmail.com', 'admin', '$2y$12$1UMxk7iLh1YEbkTyHo2gUO1.XWtZAuLYI23R.JmGE8ZbE/OjHeU6O', '66e94c5a7cde51726565466.png', NULL, NULL, '2024-09-17 05:31:19');

-- --------------------------------------------------------

--
-- Table structure for table `app_passwords`
--

CREATE TABLE `app_passwords` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `key` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `app_passwords`
--

INSERT INTO `app_passwords` (`id`, `app_name`, `email`, `username`, `password`, `key`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Regan Lloyd', 'mahy@mailinator.com', 'koqanedyjy', 'UGEkJHcwcmQh', 'UGEkJHcwcmQh', NULL, '2024-09-17 05:18:10', '2024-09-17 05:18:10'),
(4, 'Zephania Bowen', 'hizynu@mailinator.com', 'ryfehybim', 'UGEkJHcwcmQh', 'UGEkJHcwcmQh', NULL, '2024-09-17 06:46:37', '2024-09-17 06:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_title` varchar(50) DEFAULT NULL,
  `email_from` varchar(50) DEFAULT NULL,
  `copyright_text` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `site_title`, `email_from`, `copyright_text`, `created_at`, `updated_at`) VALUES
(1, 'Password Manager', 'website@example.com', 'Copyright © 2024. All Rights Reserved.', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(2, '2024_03_30_155804_create_admins_table', 1),
(3, '2024_03_31_165330_create_general_settings_table', 1),
(4, '2024_04_03_181047_create_password_resets_table', 1),
(5, '2024_09_17_043802_create_app_passwords_table', 1),
(6, '2024_09_18_032849_create_password_manager_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_manager`
--

CREATE TABLE `password_manager` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `key` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_manager`
--

INSERT INTO `password_manager` (`id`, `app_name`, `email`, `username`, `password`, `key`, `image`, `created_at`, `updated_at`) VALUES
(3, 'Google Account (Primary)', 'muzamilq35@gmail.com', 'muzamilq35', 'QDcwNTcwNyR6YW1pbEA=', '', NULL, '2024-09-28 06:37:53', '2024-09-28 06:37:53'),
(4, 'Google Account (2nd)', 'muzamilove.27@gmail.com', 'muzamilove.27', 'QHphbWlsJDcwNTcwN0A=', '', NULL, '2024-09-28 06:40:05', '2024-09-28 06:40:05'),
(5, 'Google Account (3rd)', 'extra.zamil@gmail.com', 'extra.zamil', 'QGV4dHJhMjcxOTk3', '', NULL, '2024-09-28 07:06:26', '2024-09-28 07:07:08'),
(6, 'Google Account (4th)', 'muzamil.infoworld@gmail.com', 'muzamil.infoworld', 'bTI3cTE5OTdz', '', NULL, '2024-09-28 07:08:38', '2024-09-28 07:08:38'),
(7, 'HotMail', 'muzamilq35@hotmail.com', 'muzamilq35', 'bTI3cTE5OTdz', '', NULL, '2024-09-28 07:09:28', '2024-09-28 07:09:28'),
(8, 'Hostinger', NULL, NULL, 'QE0yN3ExOTk3c0A=', '', NULL, '2024-09-28 07:10:30', '2024-09-28 07:10:30'),
(9, 'VRC', NULL, NULL, 'QE03MDU3MDdxQCAtIFNlY3JldCBQaHJhc2U6IGFsc28gYW5rbGUgaW5kdXN0cnkgcXVlc3Rpb24gaG9ybiB0aWNrZXQgYXhpcyBibG91c2UgZ293biBiZWxpZXZlIGZydWl0IHJpZmxl', 'YTFlMGMyNzEyMTFhYWY4MTU4ZGViYzgzNzQzZDg3ZmU2OWZiMGEwYzUwNjc3M2UwN2JmYmMwYTc2MTgwM2UzYw==', NULL, '2024-09-28 07:14:55', '2024-09-28 07:16:06'),
(10, 'ChatGPT', 'muzamilq35@gmail.com', NULL, 'emFtaWxANzA1NzA3', '', NULL, '2024-09-28 07:19:51', '2024-09-28 07:19:51'),
(11, 'X', NULL, 'muzamil_707', 'bTcwNTcwN3E=', '', NULL, '2024-09-28 07:20:20', '2024-09-28 07:20:20'),
(12, 'Athene', 'muzamilove.27@gmail.com', NULL, 'QG03MDU3MDdxQA==', '', NULL, '2024-09-28 07:21:53', '2024-09-28 07:21:53'),
(13, 'OKX', 'muzamilq35@gmail.com', NULL, 'QE03MDU3MDdxQA==', '', NULL, '2024-09-28 07:22:27', '2024-09-28 07:22:27'),
(14, 'OEX', NULL, NULL, 'NzA1NzA3', 'bWVkYWwgZ2xvdyBiYXNpYyBzdW5ueSBzb3JyeSBmaXJzdCBmYWRlIGFncmVlIGFsYXJtIG1pc3MgYWJpbGl0eSBjb2FzdA==', NULL, '2024-09-28 07:23:30', '2024-09-28 07:23:30'),
(15, 'Meta Mask', NULL, NULL, 'QG0yN3ExOTk3c0A=', 'bGFiZWwsIHNhdG9zaGksIHBpY25pYywgY2FiaW4sIGFjdXN0aWMsIGNhbGlyZnksIGRhbmNlLCBzaXN0ZXIsIG1vdGlvbiwgb3pvbmUsIHNtb290aCwgdG95', NULL, '2024-09-28 07:24:31', '2024-09-28 07:24:31'),
(16, 'OGC', 'muzamilove.27@gmail.com', NULL, 'QG03MDU3MDdxQA==', '', NULL, '2024-09-28 07:25:13', '2024-09-28 07:25:13'),
(17, 'Satoshi', 'muzamilq35@gmail.com', NULL, 'QG03MDU3MDdxQA==', 'QXNzZXQgUGFzc3dvcmQ6IEBtNzA1NzA3cQ==', NULL, '2024-09-28 07:29:12', '2024-09-28 07:29:12'),
(18, 'LBank', 'muzamilq35@gmail.com', NULL, 'QG03MDU3MDdxQA==', '', NULL, '2024-09-28 07:31:45', '2024-09-28 07:31:45'),
(19, 'Binance', 'muzamilq35@gmail.com', NULL, 'WkFNSUwyN1ExOTk3Uw==', '', NULL, '2024-09-28 07:32:23', '2024-09-28 07:32:23'),
(20, 'Payoneer', 'muzamilq35@gmail.com', NULL, 'QG0yN3ExOTk3c0A=', '', NULL, '2024-09-28 07:32:59', '2024-09-28 07:32:59'),
(21, 'Solo Learn', 'muzamilove.27@gmail.com', NULL, 'bTI3cTE5OTdz', '', NULL, '2024-09-28 07:33:36', '2024-09-28 07:33:36'),
(22, 'DigiSkill', 'muzamilq35@gmail.com', NULL, 'bTI3cTE5OTdz', '', NULL, '2024-09-28 07:34:03', '2024-09-28 07:34:03'),
(23, 'LinkedIn', 'muzamilq35@gmail.com', NULL, 'QG11emFtaWw3MDU=', '', NULL, '2024-09-28 07:34:51', '2024-09-28 07:34:51'),
(24, 'Yahoo Baba', 'muzamilq35@gmail.com', NULL, 'NzA1NzA3', '', NULL, '2024-09-28 07:35:24', '2024-09-28 07:35:24'),
(25, 'Meezan Bank', NULL, 'muzamilq35', 'bTI3cTE5OTdz', '', NULL, '2024-09-28 07:35:57', '2024-09-28 07:35:57'),
(26, 'Trust Wallet', NULL, NULL, '', 'ZGVtaXNlIGNydWNpYWwgcmFtcCBraXRjaGVuIG1vYmlsZSBncmlkIGdsYWQgdW5sb2NrIGNvcHkgZ2lmdCBzcG9vbiBmbGFn', NULL, '2024-09-28 07:38:22', '2024-09-28 07:38:22'),
(27, 'Bee', 'muzamilove.27@gmail.com', NULL, 'QG03MDU3MDdxQA==', '', NULL, '2024-09-28 07:38:57', '2024-09-28 07:38:57'),
(28, 'NayaPay', NULL, 'muzamil.717', 'emFtaWwyN3ExOTk3c0A=', 'UElOOiAyNzE5OTc=', NULL, '2024-09-28 07:39:52', '2024-09-28 07:39:52'),
(29, 'EasyPaisa', 'muzamilq35@gmail.com', 'MUZAMIL MUZAMIL', 'MjcxOTk=', '', NULL, '2024-09-28 07:41:34', '2024-09-28 07:41:34'),
(30, 'JazzCash', 'muzamilq35@gmail.com', NULL, 'NzA1Nw==', '', NULL, '2024-09-28 07:42:36', '2024-09-28 07:42:36'),
(31, 'GitHub', 'muzamilq35@gmail.com', 'in computer: muzamilqasim', 'QG0yN3ExODk5N3NA', 'SW4gQ29tcHV0ZXI6IG03MDU3MDdx', NULL, '2024-09-28 07:44:44', '2024-09-28 07:44:44'),
(32, 'Discord', 'muzamilq35@gmail.com', NULL, 'QE0yN3ExOTk3c0A=', '', NULL, '2024-09-28 07:45:14', '2024-09-28 07:45:14'),
(33, 'Time Doctor', NULL, NULL, 'QE03MDU3MDdxQA==', '', NULL, '2024-09-28 07:45:38', '2024-09-28 07:45:38'),
(34, 'Pattern', NULL, NULL, '', '', '66f7facbd22441727527627.png', '2024-09-28 07:47:07', '2024-09-28 07:47:08');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`),
  ADD UNIQUE KEY `admins_username_unique` (`username`);

--
-- Indexes for table `app_passwords`
--
ALTER TABLE `app_passwords`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_manager`
--
ALTER TABLE `password_manager`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `app_passwords`
--
ALTER TABLE `app_passwords`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `password_manager`
--
ALTER TABLE `password_manager`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
