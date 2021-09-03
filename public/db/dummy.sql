-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 06, 2021 at 10:14 PM
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
-- Database: `dummy`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_06_06_162616_create_tenant_user_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tenant_user`
--

CREATE TABLE `tenant_user` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenant_user`
--

INSERT INTO `tenant_user` (`id`, `name`, `email`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'demo', 'demo@gmail.com', 'Demo', 1, '2021-06-06 16:32:18', '2021-06-06 16:32:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenant_user`
--
ALTER TABLE `tenant_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tenant_user`
--
ALTER TABLE `tenant_user`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 01, 2021 at 01:06 PM
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
-- Table structure for table `business_categories`
--

CREATE TABLE `business_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_categories`
--

INSERT INTO `business_categories` (`id`, `category_name`, `slug_name`, `description`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Demo', 'demo', NULL, 1, NULL, '2021-06-30 12:00:31', '2021-06-30 12:00:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_categories`
--
ALTER TABLE `business_categories`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_categories`
--
ALTER TABLE `business_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
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

CREATE TABLE `shipping_cost_country_rules` (
  `id` int(11) NOT NULL,
  `country` varchar(255) NOT NULL,
  `shipping_cost` int(11) NOT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipping_cost_country_rules`
--
ALTER TABLE `shipping_cost_country_rules`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipping_cost_country_rules`
--
ALTER TABLE `shipping_cost_country_rules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `shipping_cost_settings` (
  `id` int(11) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shipping_cost_settings`
--
ALTER TABLE `shipping_cost_settings`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shipping_cost_settings`
--
ALTER TABLE `shipping_cost_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `shopify_products` (
  `id` int(11) NOT NULL,
  `product_id` text DEFAULT NULL,
  `title` text DEFAULT NULL,
  `body_html` text DEFAULT NULL,
  `vendor` varchar(255) DEFAULT NULL,
  `product_type` text DEFAULT NULL,
  `shopify_created_at` text DEFAULT NULL,
  `handle` text DEFAULT NULL,
  `shopify_updated_at` text DEFAULT NULL,
  `shopify_published_at` text DEFAULT NULL,
  `template_suffix` text DEFAULT NULL,
  `status` text DEFAULT NULL,
  `published_scope` text DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `admin_graphql_api_id` text DEFAULT NULL,
  `deleted_at` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopify_products`
--
ALTER TABLE `shopify_products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopify_products`
--
ALTER TABLE `shopify_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `shopify_product_variants` (
  `id` int(11) NOT NULL,
  `variant_id` varchar(255) DEFAULT NULL,
  `product_table_id` int(11) DEFAULT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `title` text DEFAULT NULL,
  `product_title` varchar(255) DEFAULT NULL,
  `price` text DEFAULT NULL,
  `profitrack_handling_cost` varchar(255) DEFAULT NULL,
  `sku` text DEFAULT NULL,
  `position` text DEFAULT NULL,
  `inventory_policy` text DEFAULT NULL,
  `compare_at_price` text DEFAULT NULL,
  `fulfillment_service` text DEFAULT NULL,
  `inventory_management` text DEFAULT NULL,
  `option1` text DEFAULT NULL,
  `option2` text DEFAULT NULL,
  `option3` text DEFAULT NULL,
  `shopify_created_at` text DEFAULT NULL,
  `shopify_updated_at` text DEFAULT NULL,
  `taxable` text DEFAULT NULL,
  `barcode` text DEFAULT NULL,
  `grams` text DEFAULT NULL,
  `image_id` text DEFAULT NULL,
  `weight` text DEFAULT NULL,
  `weight_unit` text DEFAULT NULL,
  `inventory_item_id` text DEFAULT NULL,
  `inventory_quantity` text DEFAULT NULL,
  `old_inventory_quantity` text DEFAULT NULL,
  `requires_shipping` text DEFAULT NULL,
  `admin_graphql_api_id` text DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopify_product_variants`
--
ALTER TABLE `shopify_product_variants`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopify_product_variants`
--
ALTER TABLE `shopify_product_variants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `shopify_product_variant_costs` (
  `id` int(11) NOT NULL,
  `variant_id` varchar(255) NOT NULL,
  `profitrack_product_cost` varchar(255) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopify_product_variant_costs`
--
ALTER TABLE `shopify_product_variant_costs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopify_product_variant_costs`
--
ALTER TABLE `shopify_product_variant_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `shopify_product_variant_shipping_costs` (
  `id` int(11) NOT NULL,
  `variant_id` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `shipping_cost` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `shopify_product_variant_shipping_costs`
--
ALTER TABLE `shopify_product_variant_shipping_costs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `shopify_product_variant_shipping_costs`
--
ALTER TABLE `shopify_product_variant_shipping_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

CREATE TABLE `transaction_costs` (
  `id` int(11) NOT NULL,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `percentage_fee` float(8,4) DEFAULT NULL,
  `fixed_fee` float(10,4) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transaction_costs`
--
ALTER TABLE `transaction_costs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transaction_costs`
--
ALTER TABLE `transaction_costs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
