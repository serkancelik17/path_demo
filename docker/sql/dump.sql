/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50738
 Source Host           : localhost:3306
 Source Schema         : path_demo

 Target Server Type    : MySQL
 Target Server Version : 50738
 File Encoding         : 65001

 Date: 22/06/2022 01:12:22
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for doctrine_migration_versions
-- ----------------------------
DROP TABLE IF EXISTS `doctrine_migration_versions`;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of doctrine_migration_versions
-- ----------------------------
BEGIN;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20220621170108', '2022-06-21 17:03:02', 161);
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20220621170807', '2022-06-21 17:08:35', 68);
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20220621170949', '2022-06-21 17:10:20', 89);
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20220621171119', '2022-06-21 17:11:40', 60);
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20220621171953', '2022-06-21 17:21:01', 75);
COMMIT;

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `address` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipping_date` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_E52FFDEEA76ED395` (`user_id`),
  CONSTRAINT `FK_E52FFDEEA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of orders
-- ----------------------------
BEGIN;
INSERT INTO `orders` (`id`, `order_code`, `product_id`, `quantity`, `address`, `shipping_date`, `user_id`) VALUES (1, 'ORDUZELTME', 999, 5, 'adres silindi', '2022-06-22 00:00:00', 1);
INSERT INTO `orders` (`id`, `order_code`, `product_id`, `quantity`, `address`, `shipping_date`, `user_id`) VALUES (2, 'ORD002', 95, 5, 'adres silindi', '2022-06-22 00:00:00', 2);
INSERT INTO `orders` (`id`, `order_code`, `product_id`, `quantity`, `address`, `shipping_date`, `user_id`) VALUES (3, 'ORD003', 25, 2, 'Esentepe cd. Mahmutbey sk. No: 10 Kadıköy / İstanbul', '2022-06-30 00:00:00', 3);
INSERT INTO `orders` (`id`, `order_code`, `product_id`, `quantity`, `address`, `shipping_date`, `user_id`) VALUES (4, 'ORD004', 45, 2, 'Mahmudiye Buld No: 45 Ankara', '2022-06-29 00:00:00', 1);
INSERT INTO `orders` (`id`, `order_code`, `product_id`, `quantity`, `address`, `shipping_date`, `user_id`) VALUES (5, 'ORD456845', 1258, 2, 'Esentepe cd. Mahmutbey sk. No: 10 Kadıköy / İstanbul', '2022-06-29 21:00:00', 1);
COMMIT;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(254) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of users
-- ----------------------------
BEGIN;
INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`) VALUES (1, 'client1', '$2y$13$9oCzParlsEmA6RCXruJKfuMxvLBvlmQnQNKerHruQcDWD45qLPHYy', 'client1@mail.com', 1);
INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`) VALUES (2, 'client2', '$2y$13$0zBnqD0jns4.XVuvSknpYOaaY5wzlEauC/puSU94DnBsIbrX5gkL6', 'client2@mail.com', 1);
INSERT INTO `users` (`id`, `username`, `password`, `email`, `is_active`) VALUES (3, 'client3', '$2y$13$3K373c6hxccFiewl.IIzM.w5ZHFMe22NFBUn69Y2kmJw3EuWA73Om', 'client3@mail.com', 1);
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
