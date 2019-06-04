DROP TABLE IF EXISTS orders, orders_items, products, users, categories, categories_products, addresses, special_event,
products_events,  product_discount, promotions, payments, credit_cards, product_price, product_images;

#dupa ce comanda e platita o sa aiba mai multe status-uri
CREATE TABLE `orders`
(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `status` ENUM('paid', 'delivered', 'ongoing_delivery'),
  `created_at` timestamp NOT NULL
);

CREATE TABLE `orders_items`
(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `product_id` int NOT NULL,
  `quantity` int unsigned DEFAULT 0
);

CREATE TABLE `categories`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
);

CREATE TABLE `products`
(
  `id` int PRIMARY KEY AUTO_INCREMENT,
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL UNIQUE,
  `nr_sold` int unsigned DEFAULT 0,
  `description` text,
  `units_in_stock` int unsigned DEFAULT 0,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
);
CREATE TABLE `product_images`
(
	`id` int PRIMARY KEY AUTO_INCREMENT,
    `product_id` int NOT NULL,
    `name` varchar(255),
    `front_img_flag` boolean,
    `created_at` timestamp,
    `updated_at` timestamp
);
CREATE TABLE `product_price`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `product_id` int NOT NULL UNIQUE,
  `base_price` DECIMAL(10,2) unsigned NOT NULL,
  `discount_percentage`  int unsigned DEFAULT 0,
  `price_with_discount` int unsigned,
  `valid_from` timestamp NOT NULL,
  `valid_until` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
);
CREATE TABLE `users`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `username` varchar(255) NOT NULL UNIQUE,
  `password` text NOT NULL,
  `salt` text NOT NULL,
  `user_type` ENUM('admin', 'customer') NOT NULL,
  `firstname` varchar(255),
  `lastname` varchar(255),
  `email` varchar(255) NOT NULL UNIQUE,
  `avatar_img` blob,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
);

CREATE TABLE `addresses`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `telephone` varchar(15) NOT NULL,
  `county` varchar(255) NOT NULL,
  `locality` varchar(255) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `postal_code` varchar(12) NOT NULL
);

CREATE TABLE `special_event`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `starting_date` timestamp NOT NULL,
  `ending_date` timestamp NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
);

CREATE TABLE `products_events`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `event_id` int NOT NULL
);



/*Pot fi mai multe tipuri de promotii
cand cumperi un produs si primesti altele
cand cheltuiesti o suma minima de bani si primesti un produs saun un discount etc
*/
CREATE TABLE `promotions`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `product_buyed_id` int NOT NULL,
  `gifted_product_id` int ,
  `product_units_bought` int DEFAULT 1,
  `min_money_spent` int ,
  `gifted_product_quantity` int unsigned,
  `total_discount` int unsigned,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
);

CREATE TABLE `payments`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `order_id` int NOT NULL,
  `credit_card_id` int NOT NULL,
  `amount` DECIMAL(10,2) unsigned  NULL
);

CREATE TABLE `credit_cards`
(
  `id` int PRIMARY KEY  AUTO_INCREMENT,
  `bank_name` varchar(255) NOT NULL,
  `cardholder` varchar(255) NOT NULL,
  `card_number` varchar(16) NOT NULL,
  `expiration_month` varchar(255) NOT NULL,
  `expiration_year` varchar(255) NOT NULL,
  `security_code` varchar(255) NOT NULL,
  UNIQUE(cardholder, card_number)
);

ALTER TABLE `orders` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

ALTER TABLE `orders_items` ADD FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

ALTER TABLE `orders_items` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `products` ADD FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON UPDATE CASCADE ON DELETE CASCADE ;

ALTER TABLE `addresses` ADD FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE  ON DELETE CASCADE ;

ALTER TABLE `products_events` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `products_events` ADD FOREIGN KEY (`event_id`) REFERENCES `special_event` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `orders` ADD FOREIGN KEY (`id`) REFERENCES `payments` (`id`);

ALTER TABLE `payments` ADD FOREIGN KEY (`credit_card_id`) REFERENCES `credit_cards` (`id`);

ALTER TABLE `promotions` ADD FOREIGN KEY (`product_buyed_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `promotions` ADD FOREIGN KEY (`gifted_product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `product_price` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;

ALTER TABLE `product_images` ADD FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON UPDATE CASCADE ON DELETE CASCADE;
