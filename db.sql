-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for db_sdi
DROP DATABASE IF EXISTS `db_sdi`;
CREATE DATABASE IF NOT EXISTS `db_sdi` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_sdi`;

-- Dumping structure for table db_sdi.boms
CREATE TABLE IF NOT EXISTS `boms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `id_supplier_good` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `boms_id_product_index` (`id_product`),
  KEY `boms_id_supplier_good_index` (`id_supplier_good`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.boms: ~6 rows (approximately)
/*!40000 ALTER TABLE `boms` DISABLE KEYS */;
REPLACE INTO `boms` (`id`, `id_product`, `id_supplier_good`, `qty`) VALUES
	(8, 7, 5, 1),
	(9, 8, 3, 1),
	(10, 9, 3, 1),
	(11, 9, 3, 1),
	(12, 9, 3, 1),
	(13, 8, 3, 1);
/*!40000 ALTER TABLE `boms` ENABLE KEYS */;

-- Dumping structure for table db_sdi.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table db_sdi.material_ins
CREATE TABLE IF NOT EXISTS `material_ins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_materials` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_ins_id_materials_index` (`id_materials`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.material_ins: ~0 rows (approximately)
/*!40000 ALTER TABLE `material_ins` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_ins` ENABLE KEYS */;

-- Dumping structure for table db_sdi.material_outs
CREATE TABLE IF NOT EXISTS `material_outs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_materials` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `remark` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `material_outs_id_materials_index` (`id_materials`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.material_outs: ~0 rows (approximately)
/*!40000 ALTER TABLE `material_outs` DISABLE KEYS */;
/*!40000 ALTER TABLE `material_outs` ENABLE KEYS */;

-- Dumping structure for table db_sdi.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.migrations: ~14 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
REPLACE INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_04_07_130342_create_products_table', 1),
	(6, '2022_04_07_130628_create_suppliers_table', 1),
	(7, '2022_04_07_130852_create_supplier_goods_table', 1),
	(8, '2022_04_07_131327_create_boms_table', 1),
	(9, '2022_04_07_132959_create_productions_table', 1),
	(10, '2022_04_07_133235_create_po_calculations_table', 1),
	(11, '2022_06_16_195458_create_material_ins_table', 1),
	(12, '2022_06_16_195626_create_material_outs_table', 1),
	(13, '2022_06_17_132353_create_pos_table', 1),
	(14, '2022_06_17_132411_create_po_lists_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_sdi.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table db_sdi.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table db_sdi.pos
CREATE TABLE IF NOT EXISTS `pos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` int(11) NOT NULL,
  `terms` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.pos: ~3 rows (approximately)
/*!40000 ALTER TABLE `pos` DISABLE KEYS */;
REPLACE INTO `pos` (`id`, `code`, `num`, `terms`) VALUES
	(1, 'SDI-0001', 1, NULL),
	(2, 'SDI-0002', 2, 'CIF'),
	(3, 'SDI-0003', 3, 'CIF');
/*!40000 ALTER TABLE `pos` ENABLE KEYS */;

-- Dumping structure for table db_sdi.po_calculations
CREATE TABLE IF NOT EXISTS `po_calculations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_production` int(11) NOT NULL,
  `id_bom` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `po_calculations_id_production_index` (`id_production`),
  KEY `po_calculations_id_bom_index` (`id_bom`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.po_calculations: ~17 rows (approximately)
/*!40000 ALTER TABLE `po_calculations` DISABLE KEYS */;
REPLACE INTO `po_calculations` (`id`, `id_production`, `id_bom`) VALUES
	(1, 1, 1),
	(2, 2, 1),
	(3, 3, 1),
	(4, 4, 2),
	(5, 5, 3),
	(6, 6, 2),
	(7, 7, 3),
	(8, 8, 2),
	(9, 9, 3),
	(10, 10, 3),
	(11, 11, 4),
	(12, 12, 5),
	(13, 13, 4),
	(16, 15, 8),
	(17, 16, 8),
	(18, 17, 8),
	(19, 18, 9);
/*!40000 ALTER TABLE `po_calculations` ENABLE KEYS */;

-- Dumping structure for table db_sdi.po_lists
CREATE TABLE IF NOT EXISTS `po_lists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_po` int(11) NOT NULL,
  `id_supplier_good` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `delivery_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `po_lists_id_po_index` (`id_po`),
  KEY `po_lists_id_supplier_good_index` (`id_supplier_good`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.po_lists: ~3 rows (approximately)
/*!40000 ALTER TABLE `po_lists` DISABLE KEYS */;
REPLACE INTO `po_lists` (`id`, `id_po`, `id_supplier_good`, `qty`, `delivery_date`) VALUES
	(1, 1, 2, 1000000, '2022-01-12'),
	(2, 2, 5, 120650, '2022-01-03'),
	(3, 3, 5, 60950, '2022-02-07');
/*!40000 ALTER TABLE `po_lists` ENABLE KEYS */;

-- Dumping structure for table db_sdi.productions
CREATE TABLE IF NOT EXISTS `productions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_product` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `productions_id_product_index` (`id_product`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.productions: ~17 rows (approximately)
/*!40000 ALTER TABLE `productions` DISABLE KEYS */;
REPLACE INTO `productions` (`id`, `id_product`, `qty`, `date`) VALUES
	(1, 1, 5000, '2022-07-12'),
	(2, 1, 10000, '2022-08-01'),
	(3, 1, 1000, '2022-01-01'),
	(4, 2, 30200, '2022-03-01'),
	(5, 3, 30200, '2022-03-01'),
	(6, 2, 44100, '2022-04-01'),
	(7, 3, 44100, '2022-04-01'),
	(8, 2, 35300, '2022-07-01'),
	(9, 3, 35300, '2022-05-01'),
	(10, 3, 35200, '2022-05-01'),
	(11, 4, 5000, '2022-06-10'),
	(12, 5, 5000, '2022-06-10'),
	(13, 4, 5000, '2022-06-02'),
	(15, 7, 54400, '2022-01-01'),
	(16, 7, 66250, '2022-02-01'),
	(17, 7, 60950, '2022-03-01'),
	(18, 8, 22000, '2022-03-01');
/*!40000 ALTER TABLE `productions` ENABLE KEYS */;

-- Dumping structure for table db_sdi.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.products: ~3 rows (approximately)
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
REPLACE INTO `products` (`id`, `name`) VALUES
	(7, 'CU-37R/B/Y/Z/S'),
	(8, 'CU-45/B'),
	(9, 'CU-47/A/B');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table db_sdi.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `currency` enum('IDR','USD','JPY') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.suppliers: ~1 rows (approximately)
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
REPLACE INTO `suppliers` (`id`, `name`, `address`, `contact`, `currency`) VALUES
	(4, 'SWS Sales & Marketing Thailand', 'Bangkok, Thailand', 'Ms.Chamaree', 'USD');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;

-- Dumping structure for table db_sdi.supplier_goods
CREATE TABLE IF NOT EXISTS `supplier_goods` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `supplier_id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(9,2) NOT NULL,
  `unit` enum('pcs','kg','can') COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `supplier_goods_supplier_id_index` (`supplier_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.supplier_goods: ~2 rows (approximately)
/*!40000 ALTER TABLE `supplier_goods` DISABLE KEYS */;
REPLACE INTO `supplier_goods` (`id`, `supplier_id`, `code`, `name`, `price`, `unit`) VALUES
	(2, 1, '67289', 'AEC-375828629 (100)', 100.00, 'pcs'),
	(3, 2, '67939', 'CN 6098-8812', 1.00, 'pcs'),
	(4, 3, 'IV-2e88-9a5b', 'test', 0.50, 'pcs'),
	(5, 4, '67939 (V-279)', 'CN 6098-8812', 1.05, 'pcs');
/*!40000 ALTER TABLE `supplier_goods` ENABLE KEYS */;

-- Dumping structure for table db_sdi.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_sdi.users: ~0 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
REPLACE INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'Dicky Arjun', 'handerson_aryan@yahoo.com', NULL, '$2y$10$84rLSe/Xc2sHAs1RqOKBSu3EgvVreZHL1uVHEoPKF2Me31uH7mhMK', NULL, '2022-07-09 17:26:20', '2022-07-09 17:26:20');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
