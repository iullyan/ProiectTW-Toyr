-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2019 at 10:08 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";



--
-- Database: `toyr`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses`
(
    `id`             int(11)      NOT NULL,
    `user_id`        int(11)      NOT NULL,
    `firstname`      varchar(255) NOT NULL,
    `lastname`       varchar(255) NOT NULL,
    `telephone`      varchar(15)  NOT NULL,
    `county`         varchar(255) NOT NULL,
    `locality`       varchar(255) NOT NULL,
    `street_address` varchar(255) NOT NULL,
    `postal_code`    varchar(12)  NOT NULL
);


-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories`
(
    `id`         int(11)      NOT NULL,
    `name`       varchar(255) NOT NULL,
    `created_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`)
VALUES (1, 'Plușuri', '2019-06-12 19:46:10', '2019-06-12 19:46:10'),
       (2, 'Lego', '2019-06-12 19:47:26', '2019-06-12 19:47:26'),
       (3, 'Arme de jucărie', '2019-06-12 19:47:26', '2019-06-12 19:47:26');

-- --------------------------------------------------------

--
-- Table structure for table `credit_cards`
--

CREATE TABLE `credit_cards`
(
    `id`               int(11)      NOT NULL,
    `bank_name`        varchar(255) NOT NULL,
    `cardholder`       varchar(255) NOT NULL,
    `card_number`      varchar(16)  NOT NULL,
    `expiration_month` varchar(255) NOT NULL,
    `expiration_year`  varchar(255) NOT NULL,
    `security_code`    varchar(255) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts`
(
    `id`                  int(11)          NOT NULL,
    `product_id`          int(11)          NOT NULL,
    `discount_percentage` int(10) UNSIGNED NOT NULL DEFAULT '0',
    `price_with_discount` int(10) UNSIGNED NOT NULL,
    `valid_from`          timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `valid_until`         timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `created_at`          timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`          timestamp        NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders`
(
    `id`         int(11)   NOT NULL,
    `user_id`    int(11)   NOT NULL,
    `status`     enum ('paid','delivered','ongoing_delivery') DEFAULT NULL,
    `created_at` timestamp NOT NULL                           DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `orders_items`
--

CREATE TABLE `orders_items`
(
    `id`         int(11) NOT NULL,
    `order_id`   int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `quantity`   int(10) UNSIGNED DEFAULT '0'
);

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments`
(
    `id`             int(11) NOT NULL,
    `order_id`       int(11) NOT NULL,
    `credit_card_id` int(11) NOT NULL,
    `amount`         decimal(10, 2) UNSIGNED DEFAULT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products`
(
    `id`             int(11)                 NOT NULL,
    `age_lower_bound` int                    DEFAULT NULL,
    `category_id`    int(11)                 NOT NULL,
    `name`           varchar(255)            NOT NULL,
    `nr_sold`        int(10) UNSIGNED                 DEFAULT '0',
    `description`    text,
    `image`          varchar(255)                     DEFAULT NULL,
    `price`          decimal(10, 2) UNSIGNED NOT NULL,
    `units_in_stock` int(10) UNSIGNED                 DEFAULT '0',
    `created_at`     timestamp               NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`     timestamp               NOT NULL DEFAULT CURRENT_TIMESTAMP
);

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `nr_sold`, `description`, `image`, `price`, `units_in_stock`,
                        `created_at`, `updated_at`)
VALUES (1, 1, 'Ursuleț baby albastru figurină în 35 cm - Keel Toys', 666, NULL, '1', '666.00', 666,
        '2019-06-12 19:48:34', '2019-06-12 19:48:34'),
       (2, 1, 'Orangutan pluș 20 cm - Keel Toys', 6,
        'Din păcate în libertate trăiesc din ce în ce mai puțini. Copii pot să aibă o aventură fantastică cu această jucărie, special făcut pentru copii cărora le plac foarte mult plușurile. Acest produs este plăcut la atingere, are o apariție interesantă. Plușurile Keel Toys revin cu calitatea obișnuită, este ideal pentru mici și mari.',
        '2', '56.00', 6, '2019-06-12 19:50:13', '2019-06-12 19:50:13'),
       (3, 1, 'Rechin alb pluș de 30 cm - Keel Toys', 3,
        'Un nou prieten pentru copii, pot să aibă o aventură fantastică cu această jucărie, special făcut pentru copii cărora le plac foarte mult plușurile. Acest produs este plăcut la atingere, are o apariție interesantă. Plușurile Keel Toys revin cu calitatea obișnuită, este ideal pentru mici și mari.\r\nEste din material foarte moale.',
        '3', '123.00', 12, '2019-06-12 19:51:38', '2019-06-12 19:51:38'),
       (4, 2, 'LEGO City: Curve and Crossroad', 3,
        'În fiecare oraș LEGO este nevoie de străzi, unde locatarii pot să călătorească. În acest pachet se poate găsi două baze de culoarea gri, pe una este o curbă, iar pe celălalt intersecție. Elementele respective se pot alătura pe străzile deja existente, evident se pot folosi bazele clădirilor diferite. Pe străzile se poate circula cu vehicule LEGO, copii pot să cunoască mai bine regulile de circulație. ',
        '4', '500.00', 4444, '2019-06-12 19:53:17', '2019-06-12 19:53:17'),
       (5, 3, 'Arizona pistol cu 8 focuri 65 cm', 43,
        'Să înceapă distracția! Armele cu cartuș de bandă întotdeauna au fost ușor de folosite, erau siguri și foarte distractivi. Fiecare împușcătură sună de parcă ar fi pistolul sau pușca adevărată. Această jucărie este special făcut pentru băieți, deci cu siguranță distracția o să fie garantată. ',
        '5', '100.00', 43, '2019-06-12 19:56:07', '2019-06-12 19:56:07'),
       (6, 3, 'Ak 47', 10000000, 'Dezlănțuie talibanul din tine cu o armă veritabilă', '6', '10000.00', 47,
        '2019-06-12 20:01:58', '2019-06-12 20:01:58'),
       (7, 3, 'Mp40', 555, 'Caută-l pe Ivan la Stalingrad. Ai grijă la diaree... e frig acolo.', '7', '66596.00', 55,
        '2019-06-12 20:05:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `products_events`
--

CREATE TABLE `products_events`
(
    `id`         int(11) NOT NULL,
    `product_id` int(11) NOT NULL,
    `event_id`   int(11) NOT NULL
);

-- --------------------------------------------------------

--
-- Table structure for table `promotions`
--

CREATE TABLE `promotions`
(
    `id`                      int(11)   NOT NULL,
    `bought_product_id`        int(11)   NOT NULL,
    `gifted_product_id`       int(11)            DEFAULT NULL,
    `product_units_bought`    int(11)            DEFAULT '1',
    `gifted_product_quantity` int(10) UNSIGNED   DEFAULT NULL,
    `created_at`              timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`              timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `valid_from`              timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `valid_until`             timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- --------------------------------------------------------

--
-- Table structure for table `special_event`
--

CREATE TABLE `special_event`
(
    `id`            int(11)      NOT NULL,
    `name`          varchar(255) NOT NULL,
    `starting_date` timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `ending_date`   timestamp    NOT NULL DEFAULT '0000-00-00 00:00:00',
    `created_at`    timestamp    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at`    timestamp    NOT NULL DEFAULT '0000-00-00 00:00:00'
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users`
(
    `id`         int(11)                   NOT NULL,
    `username`   varchar(255)              NOT NULL,
    `password`   text                      NOT NULL,
    `salt`       text                      NOT NULL,
    `user_type`  enum ('admin','customer') NOT NULL,
    `firstname`  varchar(255)                       DEFAULT NULL,
    `lastname`   varchar(255)                       DEFAULT NULL,
    `email`      varchar(255)              NOT NULL,
    `avatar_img` blob,
    `created_at` timestamp                 NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` timestamp                 NOT NULL DEFAULT CURRENT_TIMESTAMP
);

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
    ADD UNIQUE KEY `cardholder` (`cardholder`, `card_number`);

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
    ADD KEY `product_buyed_id` (`product_buyed_id`),
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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `credit_cards`
--
ALTER TABLE `credit_cards`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `discounts`
--
ALTER TABLE `discounts`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
    AUTO_INCREMENT = 8;

--
-- AUTO_INCREMENT for table `products_events`
--
ALTER TABLE `products_events`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promotions`
--
ALTER TABLE `promotions`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `special_event`
--
ALTER TABLE `special_event`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
    ADD CONSTRAINT `promotions_ibfk_1` FOREIGN KEY (`product_buyed_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
    ADD CONSTRAINT `promotions_ibfk_2` FOREIGN KEY (`gifted_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;


