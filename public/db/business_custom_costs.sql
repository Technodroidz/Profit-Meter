-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2021 at 01:07 PM
-- Server version: 5.7.31-0ubuntu0.18.04.1
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profit_meater_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_custom_costs`
--

CREATE TABLE `business_custom_costs` (
  `id` int(10) UNSIGNED NOT NULL,
  `custom_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `custom_slug` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `end_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `frequency` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `accept_include_marketing` int(11) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_custom_costs`
--

INSERT INTO `business_custom_costs` (`id`, `custom_name`, `custom_slug`, `category_id`, `start_date`, `end_date`, `frequency`, `cost`, `accept_include_marketing`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'About', 'about', 1, '2021-06-25', '2021-06-27', 'Daily', '4000', 2, NULL, '2021-06-30 12:01:05', '2021-06-30 12:01:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_custom_costs`
--
ALTER TABLE `business_custom_costs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `business_custom_costs_category_id_foreign` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_custom_costs`
--
ALTER TABLE `business_custom_costs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `business_custom_costs`
--
ALTER TABLE `business_custom_costs`
  ADD CONSTRAINT `business_custom_costs_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `business_categories` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
