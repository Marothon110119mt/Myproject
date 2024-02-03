-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2024 at 09:05 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `bot`
--

CREATE TABLE `bot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `bot_id` varchar(255) DEFAULT NULL,
  `chat_id` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

CREATE TABLE `brand` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`id`, `name`, `code`, `photo`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'Ab', '39533949', '', NULL, '2023-03-06 05:55:16', '2023-03-06 05:55:16'),
(2, 'Coca', '11215193', '', NULL, '2024-01-23 13:40:54', '2024-01-23 13:40:54');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `subcategory` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `code`, `photo`, `subcategory`, `slug`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'Drink', '51358327', '', '1', '51358327', NULL, '2023-03-06 05:54:40', '2023-03-06 05:54:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue`
--

CREATE TABLE `issue` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(255) NOT NULL,
  `warehouse_id` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `issue_item`
--

CREATE TABLE `issue_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `issue_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_cost` decimal(8,2) NOT NULL,
  `product_tax` decimal(8,2) DEFAULT NULL,
  `product_discount` decimal(8,2) DEFAULT NULL,
  `product_subtotal` decimal(8,2) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2022_06_13_121005_create_product_table', 1),
(5, '2022_06_13_141543_create_brand_table', 1),
(6, '2022_06_13_141852_create_category_table', 1),
(7, '2022_06_13_142136_create_unit_table', 1),
(8, '2022_06_14_150944_create_subcategory_table', 1),
(9, '2022_10_03_035805_create_warehouse_table', 1),
(10, '2022_10_03_041439_create_payment_method_table', 1),
(11, '2022_10_04_030141_create_people_table', 1),
(12, '2022_10_04_080655_create_permission_tables', 1),
(13, '2022_10_05_013709_create_purchases_table', 1),
(14, '2022_10_09_024400_create_purchases_item_table', 1),
(15, '2022_10_10_064207_create_issue_item_table', 1),
(16, '2022_10_10_064500_create_issue_table', 1),
(17, '2022_10_11_075152_create_process_table', 1),
(18, '2022_10_14_032509_create_process_item_table', 1),
(19, '2022_10_26_050719_create_sales_table', 1),
(20, '2022_10_26_050752_create_sale_item_table', 1),
(21, '2022_10_28_082347_create_bot_table', 1),
(22, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(23, '2023_03_22_054157_add_approved_column', 2);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(4, 'App\\Models\\User', 4);

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
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `name`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'ABA', 'NULL', '2023-03-06 05:55:30', '2023-03-06 05:55:30'),
(2, 'WING', 'NULL', '2023-03-06 05:55:34', '2023-03-06 05:55:34'),
(3, 'Cash', 'NULL', '2023-03-14 05:37:00', '2023-03-14 05:37:00');

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `group_id` varchar(255) NOT NULL,
  `group_price` varchar(255) DEFAULT NULL,
  `cf1` varchar(255) DEFAULT NULL,
  `cf2` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `name`, `email`, `phone`, `address`, `city`, `state`, `postal_code`, `country`, `group_id`, `group_price`, `cf1`, `cf2`, `created_at`, `updated_at`) VALUES
(1, 'Customer', 'customer@gmail.com', '0987654321', 'PP', 'PP', '2000', '12345', 'PP', '1', NULL, NULL, NULL, '2023-03-06 05:56:16', '2023-03-06 05:56:16'),
(2, 'supplier', 'supplier@gmail.com', '0987654321', 'PP', 'PP', '2000', '12345', 'PP', '2', NULL, NULL, NULL, '2023-03-06 05:56:43', '2023-03-06 05:56:43');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'add product', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34'),
(2, 'edit product', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34'),
(3, 'delete product', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34');

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process`
--

CREATE TABLE `process` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(255) NOT NULL,
  `warehouse_id` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `process_item`
--

CREATE TABLE `process_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `process_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_type` varchar(255) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `quantity` varchar(255) DEFAULT '0',
  `row` decimal(8,2) DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `cost` decimal(8,2) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `brand` varchar(255) DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `alert` varchar(255) DEFAULT '0',
  `hide` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `code`, `type`, `quantity`, `row`, `price`, `cost`, `photo`, `brand`, `category`, `unit`, `alert`, `hide`, `status`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'kongchansila', '49028384', 'Final', '6', NULL, 70.00, 20.00, '', '1', '1', '1', '10', NULL, NULL, NULL, '2023-03-21 06:47:43', '2024-01-23 13:37:03'),
(2, 'PHONE', '21267478', 'Final', '-1', NULL, 70.00, 20.00, '', '1', '1', '1', '2', NULL, NULL, NULL, '2023-03-21 06:53:33', '2023-03-23 01:52:56'),
(3, 'Coca', '001', 'Row', '11', NULL, 1.00, 0.50, '', '1', '1', '1', '10', NULL, NULL, NULL, '2024-01-23 13:40:20', '2024-01-23 14:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `reference_no` varchar(255) NOT NULL,
  `supplier_id` varchar(255) NOT NULL,
  `warehouse_id` varchar(255) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `total` decimal(25,4) NOT NULL,
  `grand_total` decimal(25,4) NOT NULL,
  `total_discount` decimal(25,4) NOT NULL,
  `shipping` varchar(255) DEFAULT NULL,
  `paid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases`
--

INSERT INTO `purchases` (`id`, `date`, `reference_no`, `supplier_id`, `warehouse_id`, `payment_method`, `note`, `total`, `grand_total`, `total_discount`, `shipping`, `paid`, `created_at`, `updated_at`) VALUES
(1, '2023-03-21 01:03:12', 'SILA', '2', '1', '2', NULL, 200.0000, 200.0000, 0.0000, '0', NULL, '2023-03-21 06:49:26', '2023-03-21 06:49:26'),
(2, '2023-03-21 01:03:40', 'SILA', '2', '1', '1', NULL, 20.0000, 20.0000, 0.0000, '0', NULL, '2023-03-21 06:51:47', '2023-03-21 06:51:47'),
(4, '2024-01-23 08:01:18', 'SILA', '2', '1', '1', '111111111', 0.0000, 0.0000, 1.0000, '1', NULL, '2024-01-23 13:53:36', '2024-01-23 13:53:36'),
(5, '2024-01-23 08:01:46', 'SILA', '2', '1', '1', '2222', 5.0000, 6.0000, 1.0000, '2', NULL, '2024-01-23 13:54:24', '2024-01-23 13:54:24'),
(6, '2024-01-23 09:01:21', 'Marothon', '2', '1', '1', '111', 0.5000, 1.5000, 0.0000, '1', NULL, '2024-01-23 14:27:38', '2024-01-23 14:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `purchases_item`
--

CREATE TABLE `purchases_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `purchases_id` varchar(255) NOT NULL,
  `product_id` varchar(255) NOT NULL,
  `product_code` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_cost` decimal(8,2) NOT NULL,
  `product_tax` decimal(8,2) DEFAULT NULL,
  `product_discount` decimal(8,2) DEFAULT NULL,
  `product_subtotal` decimal(8,2) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `purchases_item`
--

INSERT INTO `purchases_item` (`id`, `purchases_id`, `product_id`, `product_code`, `product_name`, `product_cost`, `product_tax`, `product_discount`, `product_subtotal`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '49028384', 'kongchansila', 20.00, 0.00, 0.00, 200.00, '10', '2023-03-21 06:49:26', '2023-03-21 06:49:26'),
(2, '2', '1', '49028384', 'kongchansila', 20.00, 0.00, 0.00, 20.00, '1', '2023-03-21 06:51:47', '2023-03-21 06:51:47'),
(4, '4', '3', '001', 'Coca', 0.50, 0.00, 0.00, 0.00, '0', '2024-01-23 13:53:36', '2024-01-23 13:53:36'),
(5, '5', '3', '001', 'Coca', 0.50, 0.00, 0.00, 5.00, '10', '2024-01-23 13:54:24', '2024-01-23 13:54:24'),
(6, '6', '3', '001', 'Coca', 0.50, 0.00, 0.00, 0.50, '1', '2024-01-23 14:27:38', '2024-01-23 14:27:38');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'owner', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34'),
(2, 'admin', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34'),
(3, 'staff', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34'),
(4, 'general_manager', 'web', '2023-03-06 05:53:34', '2023-03-06 05:53:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(2, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 1),
(3, 2),
(3, 3),
(3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `type` varchar(255) DEFAULT NULL,
  `customer_id` varchar(255) DEFAULT NULL,
  `warehouse_id` varchar(255) DEFAULT NULL,
  `total_item` varchar(255) DEFAULT NULL,
  `paying_by` varchar(255) DEFAULT NULL,
  `discount` decimal(25,2) DEFAULT NULL,
  `paid` decimal(25,2) DEFAULT NULL,
  `paid_khmer` decimal(25,2) DEFAULT NULL,
  `payableprice` decimal(25,2) DEFAULT NULL,
  `payablepricekhmer` decimal(25,2) DEFAULT NULL,
  `grand_total` decimal(25,2) DEFAULT NULL,
  `total` decimal(25,2) DEFAULT NULL,
  `balance` decimal(25,2) DEFAULT NULL,
  `balancekhmer` decimal(25,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `date`, `type`, `customer_id`, `warehouse_id`, `total_item`, `paying_by`, `discount`, `paid`, `paid_khmer`, `payableprice`, `payablepricekhmer`, `grand_total`, `total`, `balance`, `balancekhmer`, `created_at`, `updated_at`) VALUES
(1, '2023-03-21 14:12:56', '1', '1', '1', '2', '1', 10.00, NULL, 1000000.00, 130.00, 533000.00, 130.00, 140.00, -113.90, -467000.00, '2023-03-21 07:12:56', '2023-03-21 07:12:56'),
(2, '2023-03-23 08:52:56', '1', '1', '1', '2', '1', 0.00, 200.00, NULL, 140.00, 574000.00, 140.00, 140.00, -60.00, -246000.00, '2023-03-23 01:52:56', '2023-03-23 01:52:56'),
(3, '2024-01-23 08:19:49', '1', '1', '1', '1', '1', 0.00, 100.00, NULL, 70.00, 287000.00, 70.00, 70.00, -30.00, -123000.00, '2024-01-23 13:19:49', '2024-01-23 13:19:49'),
(4, '2024-01-23 08:37:03', '1', '1', '1', '1', '1', 0.00, 100.00, NULL, 70.00, 287000.00, 70.00, 70.00, -30.00, -123000.00, '2024-01-23 13:37:03', '2024-01-23 13:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE `sale_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sale_id` varchar(255) NOT NULL,
  `product_id` varchar(255) DEFAULT NULL,
  `product_code` varchar(255) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_price` decimal(8,2) DEFAULT NULL,
  `product_discount` decimal(8,2) DEFAULT NULL,
  `product_subtotal` decimal(8,2) DEFAULT NULL,
  `product_quantity` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`id`, `sale_id`, `product_id`, `product_code`, `product_name`, `product_price`, `product_discount`, `product_subtotal`, `product_quantity`, `created_at`, `updated_at`) VALUES
(1, '1', '1', '49028384', 'kongchansila', 70.00, NULL, 70.00, '1', '2023-03-21 07:12:56', '2023-03-21 07:12:56'),
(2, '1', '1', '49028384', 'kongchansila', 70.00, NULL, 70.00, '1', '2023-03-21 07:12:56', '2023-03-21 07:12:56'),
(3, '2', '1', '49028384', 'kongchansila', 70.00, NULL, 70.00, '1', '2023-03-23 01:52:56', '2023-03-23 01:52:56'),
(4, '2', '2', '21267478', 'PHONE', 70.00, NULL, 70.00, '1', '2023-03-23 01:52:56', '2023-03-23 01:52:56'),
(5, '3', '1', '49028384', 'kongchansila', 70.00, NULL, 70.00, '1', '2024-01-23 13:19:49', '2024-01-23 13:19:49'),
(6, '4', '1', '49028384', 'kongchansila', 70.00, NULL, 70.00, '1', '2024-01-23 13:37:03', '2024-01-23 13:37:03');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE `subcategory` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`id`, `name`, `code`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'soft drink', '48262227', 'NULL', '2023-03-06 05:54:30', '2023-03-06 05:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

CREATE TABLE `unit` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `unit`
--

INSERT INTO `unit` (`id`, `name`, `code`, `photo`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'pcs', '05706994', 'NULL', NULL, '2023-03-06 05:55:03', '2023-03-06 05:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `status`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `approved`) VALUES
(1, 'owner', '0968877203', '1', 'owner@gmail.com', '2023-03-06 05:53:34', '$2y$10$JBe4GjmU9LXkeE/FEdCYz.oQTIHXtDUd.wAPN640tsGNjX35sxE6e', NULL, '2023-03-06 05:53:34', '2023-03-06 05:53:34', 0),
(2, 'admin', '0968877203', '1', 'admin@gmail.com', '2023-03-06 05:53:34', '$2y$10$XuTR0QJAuywAN8PAL.iaEeFTYPC0dHcEmQ/9xpqqZT/26.nnaG4hW', NULL, '2023-03-06 05:53:34', '2023-03-06 05:53:34', 0),
(3, 'staff', '0968877203', '1', 'staff@gmail.com', '2023-03-06 05:53:34', '$2y$10$69BvFashK9wGyev4IZlaAusWgW2GK6Ev8qLp2Yhl2nkJ6RuuhAgpK', NULL, '2023-03-06 05:53:34', '2023-03-06 05:53:34', 0),
(4, 'general_manager', '0968877203', '1', 'general_manager@gmail.com', '2023-03-06 05:53:34', '$2y$10$/d2V50JwDMeHLNVXeFsVXekh0oe.nyRyKqTizd.mMNLKeYsHR2PCq', NULL, '2023-03-06 05:53:34', '2023-03-06 05:53:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `name`, `code`, `photo`, `detail`, `created_at`, `updated_at`) VALUES
(1, 'TK', '67106106', 'NULL', NULL, '2023-03-06 05:55:23', '2023-03-06 05:55:23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bot`
--
ALTER TABLE `bot`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brand`
--
ALTER TABLE `brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `issue`
--
ALTER TABLE `issue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_item`
--
ALTER TABLE `issue_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `people`
--
ALTER TABLE `people`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `people_name_unique` (`name`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `process`
--
ALTER TABLE `process`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `process_item`
--
ALTER TABLE `process_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchases_item`
--
ALTER TABLE `purchases_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_item`
--
ALTER TABLE `sale_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subcategory`
--
ALTER TABLE `subcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unit`
--
ALTER TABLE `unit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bot`
--
ALTER TABLE `bot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brand`
--
ALTER TABLE `brand`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue`
--
ALTER TABLE `issue`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `issue_item`
--
ALTER TABLE `issue_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `people`
--
ALTER TABLE `people`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process`
--
ALTER TABLE `process`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `process_item`
--
ALTER TABLE `process_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `purchases_item`
--
ALTER TABLE `purchases_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sale_item`
--
ALTER TABLE `sale_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `subcategory`
--
ALTER TABLE `subcategory`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `unit`
--
ALTER TABLE `unit`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
