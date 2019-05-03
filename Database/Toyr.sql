CREATE TABLE `orders`
(
  `id` int PRIMARY KEY,
  `user_id` int,
  `status` varchar(255),
  `created_at` timestamp
);

CREATE TABLE `orders_items`
(
  `order_id` int,
  `product_id` int,
  `quantity` int
);

CREATE TABLE `products`
(
  `id` int PRIMARY KEY,
  `name` varchar[255],
  `nr_sold` int,
  `units_in_stock` int,
  `price` DECIMAL(M,2),
  `status` varchar(255),
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `users`
(
  `id` int PRIMARY KEY,
  `user_image` blob,
  `username` varchar[255] UNIQUE,
  `password` text,
  `salt` text,
  `user_type` boolean,
  `firstname` varchar[255],
  `lastname` varchar[255],
  `email` varchar[255] UNIQUE,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `categories`
(
  `id` int PRIMARY KEY,
  `name` varchar[255],
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `categories_products`
(
  `id` int PRIMARY KEY,
  `product_id` int,
  `category_id` int
);

CREATE TABLE `addresses`
(
  `id` int PRIMARY KEY,
  `user_id` int,
  `firstname` varchar[255],
  `lastname` varchar[255],
  `telephone` varchar[15],
  `county` varchar[255],
  `locality` varchar[255],
  `street_address` varchar[255],
  `postal_code` varchar[12]
);

CREATE TABLE `special_event`
(
  `id` int PRIMARY KEY,
  `name` varchar[255],
  `starting_date` timestamp,
  `ending_date` timestamp,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `products_events`
(
  `id` int PRIMARY KEY,
  `product_id` int,
  `event_id` int
);

CREATE TABLE `product_discount`
(
  `id` int PRIMARY KEY,
  `product_id` int,
  `discount_percentage` int,
  `valid_from` timestamp,
  `valid_until` timestamp,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `promotions`
(
  `id` int PRIMARY KEY,
  `product_buyed_id` int,
  `product_buyed_quantity` int,
  `gifted_product` int,
  `gifted_product_quantity` int,
  `min_products` int,
  `min_money_spent` int,
  `total_discount` int,
  `created_at` timestamp,
  `updated_at` timestamp
);

CREATE TABLE `payments`
(
  `id` int PRIMARY KEY,
  `order_id` int,
  `credit_card_id` int,
  `amount` DECIMAL(M,2)
);

CREATE TABLE `credit_cards`
(
  `id` int PRIMARY KEY,
  `bank_name` varchar[255],
  `cardholder` varchar[255],
  `number` varchar[16],
  `expiration_month` varchar[255],
  `expiration_year` varchar[255],
  `security_code` varchar[255]
);

ALTER TABLE `orders` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `orders_items` ADD FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

ALTER TABLE `orders_items` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `categories_products` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `categories_products` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

ALTER TABLE `addresses` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

ALTER TABLE `products_events` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

ALTER TABLE `products_events` ADD FOREIGN KEY (`event_id`) REFERENCES `special_event` (`id`);

ALTER TABLE `products` ADD FOREIGN KEY (`id`) REFERENCES `product_discount` (`product_id`);

ALTER TABLE `products` ADD FOREIGN KEY (`id`) REFERENCES `promotions` (`product_buyed_id`);

ALTER TABLE `products` ADD FOREIGN KEY (`id`) REFERENCES `promotions` (`gifted_product`);

ALTER TABLE `orders` ADD FOREIGN KEY (`id`) REFERENCES `payments` (`order_id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`credit_card_id`) REFERENCES `credit_cards` (`id`);
