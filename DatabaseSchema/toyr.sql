-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2019 at 01:46 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toyr`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `lastname` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `telephone` varchar(15) COLLATE utf8_general_mysql500_ci NOT NULL,
  `county` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `locality` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `street_address` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `postal_code` varchar(12) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `cardholder` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `card_number` varchar(16) COLLATE utf8_general_mysql500_ci NOT NULL,
  `expiration_month` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `expiration_year` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `security_code` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `discount_percentage` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `price_with_discount` int(10) UNSIGNED NOT NULL,
  `valid_from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('paid','delivered','ongoing_delivery') COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `address_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(10) UNSIGNED DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `credit_card_id` int(11) NOT NULL,
  `amount` decimal(10,2) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `age_lower_bound` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `nr_sold` int(10) UNSIGNED DEFAULT '0',
  `description` text COLLATE utf8_general_mysql500_ci,
  `image` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `units_in_stock` int(10) UNSIGNED DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products_events`
--

CREATE TABLE `products_events` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions` (
  `id` int(11) NOT NULL,
  `product_bought_id` int(11) NOT NULL,
  `gifted_product_id` int(11) DEFAULT NULL,
  `product_units_bought` int(11) DEFAULT '1',
  `gifted_product_quantity` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_from` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_until` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `special_event`
--

CREATE TABLE `special_event` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `starting_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ending_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `image` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `password` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `salt` text COLLATE utf8_general_mysql500_ci NOT NULL,
  `user_type` enum('admin','customer') COLLATE utf8_general_mysql500_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_general_mysql500_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_general_mysql500_ci NOT NULL,
  `avatar_img` blob,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_mysql500_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credit_cards`
--
ALTER TABLE `credit_cards`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cardholder` (`cardholder`,`card_number`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credit_card_id` (`credit_card_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `products_events`
--
ALTER TABLE `products_events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `promotions`
--
ALTER TABLE `promotions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_buyed_id` (`product_bought_id`),
  ADD KEY `gifted_product_id` (`gifted_product_id`);

--
-- Indexes for table `special_event`
--
ALTER TABLE `special_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders_items`
--
ALTER TABLE `orders_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `products_events`
--
ALTER TABLE `products_events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `special_event`
--
ALTER TABLE `special_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `discounts`
--
ALTER TABLE `discounts`
  ADD CONSTRAINT `discounts_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`id`) REFERENCES `payments` (`id`);

--
-- Constraints for table `orders_items`
--
ALTER TABLE `orders_items`
  ADD CONSTRAINT `orders_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`credit_card_id`) REFERENCES `credit_cards` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products_events`
--
ALTER TABLE `products_events`
  ADD CONSTRAINT `products_events_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_events_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `special_event` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `promotions`
--
ALTER TABLE `promotions`
  ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_bought_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `promotions_ibfk_2` FOREIGN KEY (`gifted_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
