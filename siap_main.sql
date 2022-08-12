-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2020 at 05:04 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `siap_main`
--

-- --------------------------------------------------------

--
-- Table structure for table `billings`
--

CREATE TABLE `billings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_id` int(11) NOT NULL,
  `tenant_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `merchant_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `merchant_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_periode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_total` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `billing_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_07_19_115407_create_tenants_table', 2),
(5, '2020_07_20_143137_create_billings_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tenants`
--

CREATE TABLE `tenants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tenant_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_dbname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_server` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_username` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_nohp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tenant_email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tenants`
--

INSERT INTO `tenants` (`id`, `tenant_name`, `tenant_dbname`, `tenant_server`, `tenant_username`, `tenant_password`, `tenant_pic`, `tenant_nohp`, `tenant_email`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'Siap Database', 'Siap DB', '192.168.0.0', 'test', '12345678', 'user', '0987654321', 'owner@siap.com', NULL, '2020-07-19 12:31:56', '2020-07-19 07:35:38'),
(2, 'sakjdgfsjahg', 'ghjghj', 'jhgjhghjg', 'hjgjhg', 'jhgjhgk', 'gjjhkgjkh', 'hjgjhgjh', 'gjkghjgjk', '2020-07-19 07:56:05', '2020-07-19 06:53:38', '2020-07-19 07:56:05'),
(3, 'sakjdgfsjahg', 'ghjghj', 'jhgjhghjg', 'hjgjhg', 'jhgjhgk', 'gjjhkgjkh', 'hjgjhgjh', 'gjkghjgjk', '2020-07-19 07:57:24', '2020-07-19 06:53:51', '2020-07-19 07:57:24'),
(4, 'eperform', 'eperform', '192.168.0.1', 'eperform', '12345678', 'umar', '0812367890', 'umar@eperform.com', NULL, '2020-07-19 06:55:03', '2020-07-19 06:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'billing@siap.com', NULL, '$2y$10$uXlvI9ffofC3923JmP1RIO9hPdIftpmIUpa.vsq/MU9xmxb3kfkcm', NULL, '2020-07-19 01:54:58', '2020-07-19 01:54:58'),
(3, 'irsyad', 'irsyad@billing.com', NULL, '$2y$10$UZpuzE9az7SPm6RJvBfICOoJizSPrqQRiR7b3G6J6X7DYyHFW9a42', NULL, '2020-07-20 05:57:52', '2020-07-20 05:57:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `billings`
--
ALTER TABLE `billings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `tenants`
--
ALTER TABLE `tenants`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `billings`
--
ALTER TABLE `billings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tenants`
--
ALTER TABLE `tenants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
