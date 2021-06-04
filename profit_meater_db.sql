-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 01, 2021 at 03:46 PM
-- Server version: 8.0.23-0ubuntu0.20.04.1
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profit_meater_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `bussines_user`
--

CREATE TABLE `bussines_user` (
  `id` bigint UNSIGNED NOT NULL,
  `user_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `join_data` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `staus` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bussines_user`
--

INSERT INTO `bussines_user` (`id`, `user_name`, `join_data`, `phone_number`, `email`, `staus`, `created_at`, `updated_at`) VALUES
(5, 'DilipDD', '2021-05-26', '0790585410', 'skyadav780081@gmail.com', NULL, '2021-05-25 21:07:53', '2021-05-25 21:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `company_details`
--

CREATE TABLE `company_details` (
  `id` bigint UNSIGNED NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `company_details`
--

INSERT INTO `company_details` (`id`, `company_name`, `logo`, `number`, `email`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Dilip', 'logo/profitmetear866370366.png', '0790585410', 'dilipyadav@pnjsharptech.com', 'Noida', '2021-05-31 13:50:37', '2021-05-31 19:34:36');

-- --------------------------------------------------------

--
-- Table structure for table `device_contract`
--

CREATE TABLE `device_contract` (
  `id` bigint UNSIGNED NOT NULL,
  `contarct_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `createDate` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `device_contract`
--

INSERT INTO `device_contract` (`id`, `contarct_name`, `createDate`, `created_at`, `updated_at`) VALUES
(6, 'ALl over the india', '2021-05-14', '2021-05-12 00:38:24', '2021-05-12 00:38:24'),
(7, 'Test', '2021-05-17', '2021-05-15 23:37:56', '2021-05-15 23:37:56'),
(8, 'Dilip', '2021-05-21', '2021-05-20 15:37:41', '2021-05-20 15:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int NOT NULL,
  `migration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_12_10_055212_create_roles_table', 1),
(4, '2019_12_10_062124_create_ip_addresses_table', 1),
(5, '2019_12_18_060640_create_keywords_table', 1),
(6, '2019_12_18_061116_create_projects_table', 1),
(7, '2019_12_18_064007_create_domain_types_table', 1),
(8, '2019_12_18_064108_create_domain_status_table', 1),
(9, '2019_12_20_131559_create_project_assign_keywords_table', 1),
(10, '2019_12_21_044355_create_project_assign_users_tables', 1),
(15, '2021_05_10_224502_create_product_category_table', 4),
(16, '2021_05_10_225540_create_seriyal_cat_table', 5),
(20, '2021_05_11_214736_create_device_contract_table', 7),
(21, '2021_05_14_205531_create_report_table', 8),
(22, '2021_05_14_224637_create_secretariant_table', 9),
(23, '2021_05_14_225222_create_under_secretariant_catlog_table', 10),
(24, '2021_05_14_225751_create_contract_deportment_catlog_table', 11),
(25, '2021_05_14_230247_create_administrative_unit_catlog_table', 12),
(26, '2021_05_14_231333_create_global_catlog_table', 13),
(35, '2021_05_25_180715_create_subscruptionplane_table', 18),
(37, '2021_05_26_2030222_create_paypal_config_table', 19),
(38, '2021_05_26_203803_create_strip_config_table', 20),
(39, '2021_05_31_180753_create_company_details_table', 21);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `role_name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `delete_id` int NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `status`, `delete_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'admin', 1, 1, NULL, NULL, NULL),
(2, 'Oprater', 1, 1, NULL, NULL, NULL),
(3, 'Gem', 1, 1, NULL, NULL, NULL),
(4, 'Billing', 1, 1, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `secretariant`
--

CREATE TABLE `secretariant` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rcf_tax_id` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sector` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contract_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int NOT NULL,
  `deleted_at` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `secretariant`
--

INSERT INTO `secretariant` (`id`, `name`, `rcf_tax_id`, `sector`, `contract_id`, `created_at`, `status`, `deleted_at`) VALUES
(2, 'DDDD SSS', 'D6362662', 'Demo', 6, '2021-05-15 23:45:56', 0, NULL),
(3, '22', '3332', 'AUXILIAR', 8, '2021-05-20 16:27:34', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `setting_config`
--

CREATE TABLE `setting_config` (
  `id` bigint UNSIGNED NOT NULL,
  `public_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `privet_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `currency` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_user` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `host_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `port_number` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `driver_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mail_encription_type` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `setting_config`
--

INSERT INTO `setting_config` (`id`, `public_key`, `privet_key`, `currency`, `email_user`, `host_name`, `password`, `port_number`, `driver_type`, `mail_encription_type`, `created_at`, `updated_at`) VALUES
(1, 'DD', '56565ggtftf', 'USD', NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-26 17:35:38', '2021-05-29 13:30:43'),
(2, 'DDD', 'SSSSSSSSSSS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-26 17:36:01', '2021-06-01 04:28:10'),
(3, NULL, NULL, NULL, 'abc@gmail.com', 'Diabc@gmail.com', 'wwwwwwwwwww12345677', 'AA883483', NULL, 'SMTP', '2021-05-26 18:10:41', '2021-06-01 04:37:34');

-- --------------------------------------------------------

--
-- Table structure for table `strip_config`
--

CREATE TABLE `strip_config` (
  `id` bigint UNSIGNED NOT NULL,
  `public_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `privet_key` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `currency` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subscruptionplane`
--

CREATE TABLE `subscruptionplane` (
  `id` bigint UNSIGNED NOT NULL,
  `package_name` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package_amount` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pachage_duration` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_decription` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `deleted_at` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pachage_log_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `staus` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscruptionplane`
--

INSERT INTO `subscruptionplane` (`id`, `package_name`, `package_amount`, `pachage_duration`, `short_decription`, `deleted_at`, `status`, `created_at`, `pachage_log_description`, `staus`) VALUES
(4, 'Dilip Noida', '22', '11', 'DDD', '', 1, '2021-05-30 09:21:51', 'DDD', NULL),
(5, 'Demo', '100', '2', '2', '', 2, '2021-05-30 20:04:06', 'Demo', NULL),
(6, 'Demo', '200.22', '22', 'Alll', NULL, 1, '2021-05-31 19:23:54', 'testing', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int DEFAULT NULL,
  `role_id` int NOT NULL,
  `id` int NOT NULL,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `bussiness_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `married_status` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_pic` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `owner_doc` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `login_status` tinyint(1) NOT NULL DEFAULT '1',
  `dob` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `shofiy_store_url` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `number` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `role_id`, `id`, `name`, `email`, `bussiness_name`, `address`, `married_status`, `owner_pic`, `owner_doc`, `email_verified_at`, `username`, `password`, `login_status`, `dob`, `last_name`, `status`, `shofiy_store_url`, `number`, `gender`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(NULL, 1, 1, 'Admin', 'admin@gmail.com', NULL, 'New Delhi', 'married', 'owner_pic/profitmetear1778821938.jpeg', NULL, NULL, 'Admin', '$2y$10$WvCNUJVHel9/PZ3zVehjOeaeEIZDlnc3D1URAzVh3NFWXdjPj26Y2', 1, '2021-05-28', 'Dilip', 1, NULL, '7905854106', 'Female', NULL, '2019-12-20 20:06:55', '2021-06-01 04:39:17', NULL),
(NULL, 3, 4, 'Biling Admin', 'user@gmail.com', '44', 'New Delhi ', NULL, NULL, NULL, NULL, 'Biling Admin', '$2y$10$MqFgc8RjkKK9OKFc4vX2Lurad67EuUCTaN7UQ7RAlIY4cYxmE.5KC', 1, NULL, '44', 1, '44', '786543', NULL, NULL, '2019-12-20 14:36:55', '2021-05-27 17:35:00', NULL),
(NULL, 3, 5, 'Dilip Noida', 'gem@gmail.com', 'SS', NULL, NULL, NULL, NULL, NULL, 'Dilip Noida', '$2y$10$KJO9hkMadXVQEQJ52lAhD.CXAbI2Njb9kJKgAYv9mVG8GJ.vPV1Z6', 1, NULL, 'yadav', 1, 'SSSSS', '7905854105', NULL, NULL, '2021-05-13 14:03:34', '2021-05-27 17:42:19', NULL),
(NULL, 2, 6, 'Oprater Admin', 'oprater@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Oprater Admin', '$2y$10$MqFgc8RjkKK9OKFc4vX2Lurad67EuUCTaN7UQ7RAlIY4cYxmE.5KC', 1, NULL, NULL, 1, NULL, NULL, NULL, NULL, '2021-05-13 14:08:17', '2021-05-19 17:23:59', NULL),
(NULL, 3, 10, 'Oprater Admin', 'oprater@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, 'Oprater Admin', '$2y$10$MqFgc8RjkKK9OKFc4vX2Lurad67EuUCTaN7UQ7RAlIY4cYxmE.5KC', 1, NULL, NULL, 0, NULL, '7905854103', NULL, NULL, '2021-05-27 17:15:51', '2021-05-27 17:15:51', NULL),
(NULL, 3, 14, 'rahil', 'applicationrahul2345@gmail.com', 'DDD', NULL, NULL, NULL, NULL, NULL, 'rahil', '$2y$10$NOl.n5EPJVJN8u5kKRrereTu4hBhwbk6qRdBWPc/MoiHo.fJenT4e', 1, NULL, 'yadav', 0, 'ddd', '765432', NULL, NULL, '2021-05-27 17:33:45', '2021-05-27 17:33:45', NULL),
(NULL, 2, 15, 'Dilip Noida', 'dkyadav4931@gmail.com', 'Dilip', NULL, NULL, NULL, NULL, NULL, 'Dilip Noida', '$2y$10$ZMVcOUdOUkQ5LpDJs/5iieUhn41CWixiv.gbdrlxp2yd0IVJndfqy', 1, NULL, 'Noida', 1, 'DDDD', '07905854106', NULL, NULL, '2021-05-29 04:03:09', '2021-05-29 04:03:09', NULL),
(NULL, 2, 16, 'Dilip Noida', 'dilip@gmail.com', 'Devlopment', NULL, NULL, NULL, NULL, NULL, 'Dilip Noida', '$2y$10$95TwGn8qoS3.hYkH9RGvq.9ZdZN5xgc8daFhWz0HhAPZPc9qqT1qq', 1, NULL, 'Noida', 1, 'DDDD', '07905854106', NULL, NULL, '2021-05-29 04:10:44', '2021-05-29 04:10:44', NULL),
(NULL, 2, 17, 'Biling Admin', 'user@gmail.com', '44', NULL, NULL, NULL, NULL, NULL, 'Biling Admin', '$2y$10$MqFgc8RjkKK9OKFc4vX2Lurad67EuUCTaN7UQ7RAlIY4cYxmE.5KC', 1, NULL, '44', 0, '44', '786543', NULL, NULL, '2021-06-01 04:09:24', '2021-06-01 04:09:24', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bussines_user`
--
ALTER TABLE `bussines_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company_details`
--
ALTER TABLE `company_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `device_contract`
--
ALTER TABLE `device_contract`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secretariant`
--
ALTER TABLE `secretariant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `secretariant_contract_id_foreign` (`contract_id`);

--
-- Indexes for table `setting_config`
--
ALTER TABLE `setting_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `strip_config`
--
ALTER TABLE `strip_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscruptionplane`
--
ALTER TABLE `subscruptionplane`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bussines_user`
--
ALTER TABLE `bussines_user`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `company_details`
--
ALTER TABLE `company_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `device_contract`
--
ALTER TABLE `device_contract`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `secretariant`
--
ALTER TABLE `secretariant`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `setting_config`
--
ALTER TABLE `setting_config`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `strip_config`
--
ALTER TABLE `strip_config`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subscruptionplane`
--
ALTER TABLE `subscruptionplane`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `secretariant`
--
ALTER TABLE `secretariant`
  ADD CONSTRAINT `secretariant_contract_id_foreign` FOREIGN KEY (`contract_id`) REFERENCES `device_contract` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
