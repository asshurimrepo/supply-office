-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.34 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL Version:             8.3.0.4694
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for bdiggers_sma
CREATE DATABASE IF NOT EXISTS `bdiggers_sma` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `bdiggers_sma`;


-- Dumping structure for table bdiggers_sma.billers
CREATE TABLE IF NOT EXISTS `billers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `country` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `logo` varchar(100) NOT NULL,
  `invoice_footer` varchar(1000) NOT NULL,
  `cf1` varchar(100) DEFAULT NULL,
  `cf2` varchar(100) DEFAULT NULL,
  `cf3` varchar(100) DEFAULT NULL,
  `cf4` varchar(100) DEFAULT NULL,
  `cf5` varchar(100) DEFAULT NULL,
  `cf6` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.billers: 1 rows
DELETE FROM `billers`;
/*!40000 ALTER TABLE `billers` DISABLE KEYS */;
INSERT INTO `billers` (`id`, `name`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`, `logo`, `invoice_footer`, `cf1`, `cf2`, `cf3`, `cf4`, `cf5`, `cf6`) VALUES
	(1, 'Mian Saleem', 'Tecdiary IT Solutions', 'No. 1, Street 1, Black A, My Condo ', 'Kuala Lumpur', 'WP', '58100', 'Malaysia', '0123456789', 'saleem@tecdiary.com', 'logo.png', 'Thank you for your business!', '', '', '', '', '', '');
/*!40000 ALTER TABLE `billers` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.calendar
CREATE TABLE IF NOT EXISTS `calendar` (
  `date` date NOT NULL,
  `data` varchar(255) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`date`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.calendar: 2 rows
DELETE FROM `calendar`;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` (`date`, `data`, `user_id`) VALUES
	('2013-10-18', 'Said Event!', NULL),
	('2014-01-14', 'Event!', NULL);
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.categories: 3 rows
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `code`, `name`) VALUES
	(1, 'E1', 'Electrical'),
	(2, 'H1', 'hardware'),
	(3, 'h2', 'sawings');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.comment
CREATE TABLE IF NOT EXISTS `comment` (
  `comment` text
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.comment: 1 rows
DELETE FROM `comment`;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`comment`) VALUES
	('&lt;ul&gt;\n &lt;li&gt;ITS A GOOD DAY TO START!! &lt;/li&gt;\n&lt;/ul&gt;\n&lt;br&gt;\n  WEPPEY!!\n&lt;p&gt;\n &lt;img src=&quot;http://braindiggers.com/annas/inventory/assets/uploads/images/996745_10200979000987835_1113349622_n.jpg&quot;&gt;\n&lt;/p&gt;');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `country` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cf1` varchar(100) DEFAULT NULL,
  `cf2` varchar(100) DEFAULT NULL,
  `cf3` varchar(100) DEFAULT NULL,
  `cf4` varchar(100) DEFAULT NULL,
  `cf5` varchar(100) DEFAULT NULL,
  `cf6` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.customers: 1 rows
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `name`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`, `cf1`, `cf2`, `cf3`, `cf4`, `cf5`, `cf6`) VALUES
	(1, 'Test Customer', 'Customer Company Name', 'Meciano Road', 'Dumaguete City', 'Philippines', '6200', 'Philippines', '0123456789', 'customer@tech.com', '0', '0', '0', '0', '0', '0');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.damage_products
CREATE TABLE IF NOT EXISTS `damage_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.damage_products: 1 rows
DELETE FROM `damage_products`;
/*!40000 ALTER TABLE `damage_products` DISABLE KEYS */;
INSERT INTO `damage_products` (`id`, `date`, `product_id`, `quantity`, `warehouse_id`, `note`, `user`, `updated_by`) VALUES
	(1, '2014-02-19', 2, 20, 1, '&lt;p&gt;\n Damage\n&lt;/p&gt;', 'Asshurim Larita', NULL);
/*!40000 ALTER TABLE `damage_products` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.date_format
CREATE TABLE IF NOT EXISTS `date_format` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `js` varchar(20) NOT NULL,
  `php` varchar(20) NOT NULL,
  `sql` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.date_format: 4 rows
DELETE FROM `date_format`;
/*!40000 ALTER TABLE `date_format` DISABLE KEYS */;
INSERT INTO `date_format` (`id`, `js`, `php`, `sql`) VALUES
	(1, 'mm-dd-yyyy', 'm-d-Y', '%m-%d-%Y'),
	(2, 'mm/dd/yyyy', 'm/d/Y', '%m/%d/%Y'),
	(3, 'dd-mm-yyyy', 'd-m-Y', '%d-%m-%Y'),
	(4, 'dd/mm/yyyy', 'd/m/Y', '%d/%m/%Y');
/*!40000 ALTER TABLE `date_format` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.deliveries
CREATE TABLE IF NOT EXISTS `deliveries` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` varchar(10) NOT NULL,
  `reference_no` varchar(55) NOT NULL,
  `customer` varchar(55) NOT NULL,
  `address` varchar(1000) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.deliveries: 1 rows
DELETE FROM `deliveries`;
/*!40000 ALTER TABLE `deliveries` DISABLE KEYS */;
INSERT INTO `deliveries` (`id`, `date`, `time`, `reference_no`, `customer`, `address`, `note`, `user`, `updated_by`) VALUES
	(1, '2014-01-08', '03:00 PM', 'SL-0006', 'Asshurim', '    . \nTel: ', '', 'First Name Last Name', NULL);
/*!40000 ALTER TABLE `deliveries` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.discounts
CREATE TABLE IF NOT EXISTS `discounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `discount` decimal(4,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.discounts: 4 rows
DELETE FROM `discounts`;
/*!40000 ALTER TABLE `discounts` DISABLE KEYS */;
INSERT INTO `discounts` (`id`, `name`, `discount`, `type`) VALUES
	(1, 'No Discount', 0.00, '2'),
	(2, '2.5 Percent', 2.50, '1'),
	(3, '5 Percent', 5.00, '1'),
	(4, '10 Percent', 10.00, '1');
/*!40000 ALTER TABLE `discounts` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.groups
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.groups: 5 rows
DELETE FROM `groups`;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` (`id`, `name`, `description`) VALUES
	(1, 'owner', 'Owner'),
	(2, 'admin', 'Administrator'),
	(3, 'purchaser', 'Purchasing Staff'),
	(4, 'salesman', 'Sales Staff'),
	(5, 'viewer', 'View Only User');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.invoice_types
CREATE TABLE IF NOT EXISTS `invoice_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `type` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.invoice_types: 0 rows
DELETE FROM `invoice_types`;
/*!40000 ALTER TABLE `invoice_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `invoice_types` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.login_attempts
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.login_attempts: 0 rows
DELETE FROM `login_attempts`;
/*!40000 ALTER TABLE `login_attempts` DISABLE KEYS */;
/*!40000 ALTER TABLE `login_attempts` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.pos_settings
CREATE TABLE IF NOT EXISTS `pos_settings` (
  `pos_id` int(1) NOT NULL,
  `cat_limit` int(11) NOT NULL,
  `pro_limit` int(11) NOT NULL,
  `default_category` int(11) NOT NULL,
  `default_customer` int(11) NOT NULL,
  `default_biller` int(11) NOT NULL,
  `display_time` varchar(3) NOT NULL DEFAULT 'yes',
  `cf_title1` varchar(255) DEFAULT NULL,
  `cf_title2` varchar(255) DEFAULT NULL,
  `cf_value1` varchar(255) DEFAULT NULL,
  `cf_value2` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`pos_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.pos_settings: 1 rows
DELETE FROM `pos_settings`;
/*!40000 ALTER TABLE `pos_settings` DISABLE KEYS */;
INSERT INTO `pos_settings` (`pos_id`, `cat_limit`, `pro_limit`, `default_category`, `default_customer`, `default_biller`, `display_time`, `cf_title1`, `cf_title2`, `cf_value1`, `cf_value2`) VALUES
	(1, 22, 30, 1, 2, 1, 'yes', '', '', '', '');
/*!40000 ALTER TABLE `pos_settings` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` char(255) NOT NULL,
  `unit` varchar(50) DEFAULT NULL,
  `size` varchar(55) NOT NULL,
  `um` varchar(55) DEFAULT NULL,
  `cost` decimal(25,2) DEFAULT NULL,
  `price` decimal(25,2) NOT NULL,
  `alert_quantity` int(11) NOT NULL DEFAULT '20',
  `image` varchar(255) DEFAULT 'no_image.jpg',
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `cf1` varchar(255) DEFAULT NULL,
  `cf2` varchar(255) DEFAULT NULL,
  `cf3` varchar(255) DEFAULT NULL,
  `cf4` varchar(255) DEFAULT NULL,
  `cf5` varchar(255) DEFAULT NULL,
  `cf6` varchar(255) DEFAULT NULL,
  `cf7` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.products: 3 rows
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `code`, `name`, `unit`, `size`, `um`, `cost`, `price`, `alert_quantity`, `image`, `category_id`, `subcategory_id`, `cf1`, `cf2`, `cf3`, `cf4`, `cf5`, `cf6`, `cf7`) VALUES
	(2, 'e.1', 'LSS Power Generator', 'Pieces', '50', NULL, 7.00, 7.00, 15, 'h4.jpg', 2, 0, '', '', '', '', '', '', NULL),
	(4, '122', 'ash', 's', '12', NULL, 12.00, 13.00, 12, 'no_image.jpg', 1, 0, '', '', '', '', '', '', NULL),
	(5, '7687678', 'Transcript of Records', '1', '1', NULL, 1.00, 1.00, 12, 'no_image.jpg', 1, 0, '0', '0', '0', '0', '0', '0', NULL);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.purchases
CREATE TABLE IF NOT EXISTS `purchases` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(55) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `supplier_name` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(1000) NOT NULL,
  `total` decimal(25,2) NOT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.purchases: 0 rows
DELETE FROM `purchases`;
/*!40000 ALTER TABLE `purchases` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchases` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.purchase_items
CREATE TABLE IF NOT EXISTS `purchase_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `tax_amount` decimal(25,2) DEFAULT NULL,
  `gross_total` decimal(25,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.purchase_items: 0 rows
DELETE FROM `purchase_items`;
/*!40000 ALTER TABLE `purchase_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `purchase_items` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.quotes
CREATE TABLE IF NOT EXISTS `quotes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `biller_id` int(11) NOT NULL,
  `biller_name` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `internal_note` varchar(1000) DEFAULT NULL,
  `inv_total` decimal(25,2) NOT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `total` decimal(25,2) NOT NULL,
  `invoice_type` int(11) DEFAULT NULL,
  `in_type` varchar(55) DEFAULT NULL,
  `total_tax2` decimal(25,2) DEFAULT NULL,
  `tax_rate2_id` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `inv_discount` decimal(25,2) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.quotes: 0 rows
DELETE FROM `quotes`;
/*!40000 ALTER TABLE `quotes` DISABLE KEYS */;
/*!40000 ALTER TABLE `quotes` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.quote_items
CREATE TABLE IF NOT EXISTS `quote_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quote_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `gross_total` decimal(25,2) NOT NULL,
  `val_tax` decimal(25,2) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `discount_val` decimal(25,2) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.quote_items: 0 rows
DELETE FROM `quote_items`;
/*!40000 ALTER TABLE `quote_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `quote_items` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.sales
CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(55) NOT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `biller_id` int(11) NOT NULL,
  `biller_name` varchar(55) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `internal_note` varchar(1000) DEFAULT NULL,
  `inv_total` decimal(25,2) NOT NULL,
  `total_tax` decimal(25,2) DEFAULT NULL,
  `total` decimal(25,2) NOT NULL,
  `invoice_type` int(11) DEFAULT NULL,
  `in_type` varchar(55) DEFAULT NULL,
  `total_tax2` decimal(25,2) DEFAULT NULL,
  `tax_rate2_id` int(11) DEFAULT NULL,
  `inv_discount` decimal(25,2) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `updated_by` varchar(255) DEFAULT NULL,
  `paid_by` varchar(55) DEFAULT 'cash',
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.sales: 6 rows
DELETE FROM `sales`;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` (`id`, `reference_no`, `warehouse_id`, `biller_id`, `biller_name`, `customer_id`, `customer_name`, `date`, `note`, `internal_note`, `inv_total`, `total_tax`, `total`, `invoice_type`, `in_type`, `total_tax2`, `tax_rate2_id`, `inv_discount`, `discount_id`, `user`, `updated_by`, `paid_by`, `count`) VALUES
	(1, 'SL-0001', 1, 1, 'Mian Saleem', 1, 'Test Customer', '2013-08-21', NULL, NULL, 60.00, 14.40, 76.14, NULL, NULL, 3.60, 3, 1.86, 0, 'Owner Owner', NULL, 'cash', 3),
	(2, 'SL-0002', 1, 1, 'Mian Saleem', 1, 'Test Customer', '2013-08-21', NULL, NULL, 40.00, 9.60, 50.76, NULL, NULL, 2.40, 3, 1.24, 0, 'Owner Owner', NULL, 'cash', 2),
	(3, 'SL-0003', 1, 1, 'Mian Saleem', 1, 'Test Customer', '2013-08-21', NULL, NULL, 100.00, 24.00, 126.90, NULL, NULL, 6.00, 3, 3.10, 0, 'Owner Owner', NULL, 'cash', 5),
	(4, 'SL-0004', 1, 1, 'Mian Saleem', 2, 'Asshurim', '2013-10-29', NULL, NULL, 2160.00, 518.40, 2540.16, NULL, NULL, 129.60, 3, 267.84, 0, 'Briiggs Horcerada', NULL, 'cash', 36),
	(5, 'SL-0005', 1, 1, 'Mian Saleem', 2, 'Asshurim', '2013-10-31', NULL, NULL, 14.00, 3.36, 17.77, NULL, NULL, 0.84, 3, 0.43, 0, 'Briiggs Horcerada', NULL, 'cash', 2),
	(6, 'SL-0006', 1, 1, 'Mian Saleem', 2, 'Asshurim', '2014-01-08', NULL, NULL, 13.00, 3.12, 16.50, NULL, NULL, 0.78, 3, 0.40, 0, 'Asshurim Larita', NULL, 'cash', 1);
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.sale_items
CREATE TABLE IF NOT EXISTS `sale_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `gross_total` decimal(25,2) NOT NULL,
  `val_tax` decimal(25,2) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `discount_val` decimal(25,2) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.sale_items: 14 rows
DELETE FROM `sale_items`;
/*!40000 ALTER TABLE `sale_items` DISABLE KEYS */;
INSERT INTO `sale_items` (`id`, `sale_id`, `product_id`, `product_code`, `product_name`, `product_unit`, `tax_rate_id`, `tax`, `quantity`, `unit_price`, `gross_total`, `val_tax`, `serial_no`, `discount_val`, `discount`, `discount_id`) VALUES
	(1, 1, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(2, 1, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(3, 1, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(4, 2, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(5, 2, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(6, 3, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(7, 3, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(8, 3, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(9, 3, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(10, 3, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '', 0.62, '2.50%', 2),
	(11, 4, 1, '001', 'telefono', 'pza', 2, '24.00%', 36, 60.00, 2160.00, 518.40, 'iolk', 267.84, '10.00%', 4),
	(12, 5, 2, 'e.1', 'LSS Power Generator', 'Pieces', 2, '24.00%', 1, 7.00, 7.00, 1.68, '', 0.22, '2.50%', 2),
	(13, 5, 2, 'e.1', 'LSS Power Generator', 'Pieces', 2, '24.00%', 1, 7.00, 7.00, 1.68, '', 0.22, '2.50%', 2),
	(14, 6, 4, '122', 'ash', 's', 2, '24.00%', 1, 13.00, 13.00, 3.12, '', 0.40, '2.50%', 2);
/*!40000 ALTER TABLE `sale_items` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.settings
CREATE TABLE IF NOT EXISTS `settings` (
  `setting_id` int(1) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo2` varchar(255) NOT NULL,
  `site_name` varchar(55) NOT NULL,
  `language` varchar(20) NOT NULL,
  `default_warehouse` int(2) NOT NULL,
  `currency_prefix` varchar(3) NOT NULL,
  `default_invoice_type` int(2) NOT NULL,
  `default_tax_rate` int(2) NOT NULL,
  `rows_per_page` int(2) NOT NULL,
  `no_of_rows` int(2) NOT NULL,
  `total_rows` int(2) NOT NULL,
  `version` varchar(5) NOT NULL DEFAULT '1.2',
  `default_tax_rate2` int(11) NOT NULL DEFAULT '0',
  `dateformat` int(11) NOT NULL,
  `sales_prefix` varchar(20) NOT NULL,
  `quote_prefix` varchar(55) NOT NULL,
  `purchase_prefix` varchar(55) NOT NULL,
  `transfer_prefix` varchar(55) NOT NULL,
  `barcode_symbology` varchar(20) NOT NULL,
  `theme` varchar(20) NOT NULL,
  `product_serial` tinyint(4) NOT NULL,
  `default_discount` int(11) NOT NULL,
  `discount_option` tinyint(4) NOT NULL,
  `discount_method` tinyint(4) NOT NULL,
  `tax1` tinyint(4) NOT NULL,
  `tax2` tinyint(4) NOT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.settings: 1 rows
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`setting_id`, `logo`, `logo2`, `site_name`, `language`, `default_warehouse`, `currency_prefix`, `default_invoice_type`, `default_tax_rate`, `rows_per_page`, `no_of_rows`, `total_rows`, `version`, `default_tax_rate2`, `dateformat`, `sales_prefix`, `quote_prefix`, `purchase_prefix`, `transfer_prefix`, `barcode_symbology`, `theme`, `product_serial`, `default_discount`, `discount_option`, `discount_method`, `tax1`, `tax2`) VALUES
	(1, 'small-logo1.png', 'login_logos1.png', 'NORSU Supply Office', 'english', 1, 'PHP', 2, 2, 10, 9, 30, '2.0', 3, 3, 'SL', 'QU', 'PO', 'TR', 'code128', 'cosmo', 0, 2, 2, 2, 1, 1);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.subcategories
CREATE TABLE IF NOT EXISTS `subcategories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `code` varchar(55) NOT NULL,
  `name` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.subcategories: 2 rows
DELETE FROM `subcategories`;
/*!40000 ALTER TABLE `subcategories` DISABLE KEYS */;
INSERT INTO `subcategories` (`id`, `category_id`, `code`, `name`) VALUES
	(1, 1, 'bulb', 'bulb'),
	(2, 1, 'wire', 'wires');
/*!40000 ALTER TABLE `subcategories` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.suppliers
CREATE TABLE IF NOT EXISTS `suppliers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `company` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  `state` varchar(55) NOT NULL,
  `postal_code` varchar(8) NOT NULL,
  `country` varchar(55) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cf1` varchar(100) DEFAULT NULL,
  `cf2` varchar(100) DEFAULT NULL,
  `cf3` varchar(100) DEFAULT NULL,
  `cf4` varchar(100) DEFAULT NULL,
  `cf5` varchar(100) DEFAULT NULL,
  `cf6` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.suppliers: 3 rows
DELETE FROM `suppliers`;
/*!40000 ALTER TABLE `suppliers` DISABLE KEYS */;
INSERT INTO `suppliers` (`id`, `name`, `company`, `address`, `city`, `state`, `postal_code`, `country`, `phone`, `email`, `cf1`, `cf2`, `cf3`, `cf4`, `cf5`, `cf6`) VALUES
	(1, 'Test Supplier', 'Supplier Company Name', 'Supplier Address', 'Petaling Jaya', 'Selangor', '46050', 'Malaysia', '0123456789', 'supplier@tecdiary.com', '-', '-', '-', '-', '-', '-'),
	(2, 'Briggs', 'CS company', 'rizal st', 'Makati', 'Philippines', '7114', 'Philippines', '09057936867', 'briggs_gone@yahoo.com', '', '', '', '', '', ''),
	(3, 'Asshurim', '-', 'Dumaguete City', 'DUa', 'wewe', '12321', 'Philippines', '12312312321', 'asshurim@yahoo.com', '', '', '', '', '', '');
/*!40000 ALTER TABLE `suppliers` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.suspended_bills
CREATE TABLE IF NOT EXISTS `suspended_bills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `customer_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `tax1` float(25,2) DEFAULT NULL,
  `tax2` float(25,2) DEFAULT NULL,
  `discount` decimal(25,2) DEFAULT NULL,
  `inv_total` decimal(25,2) NOT NULL,
  `total` float(25,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.suspended_bills: 1 rows
DELETE FROM `suspended_bills`;
/*!40000 ALTER TABLE `suspended_bills` DISABLE KEYS */;
INSERT INTO `suspended_bills` (`id`, `date`, `customer_id`, `count`, `tax1`, `tax2`, `discount`, `inv_total`, `total`) VALUES
	(1, '2013-08-22', 1, 8, 182.40, 45.60, 23.56, 760.00, 964.44);
/*!40000 ALTER TABLE `suspended_bills` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.suspended_items
CREATE TABLE IF NOT EXISTS `suspended_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `suspend_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) DEFAULT NULL,
  `tax_rate_id` int(11) DEFAULT NULL,
  `tax` varchar(55) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(25,2) NOT NULL,
  `gross_total` decimal(25,2) NOT NULL,
  `val_tax` decimal(25,2) DEFAULT NULL,
  `discount` varchar(55) DEFAULT NULL,
  `discount_id` int(11) DEFAULT NULL,
  `discount_val` decimal(25,2) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.suspended_items: 3 rows
DELETE FROM `suspended_items`;
/*!40000 ALTER TABLE `suspended_items` DISABLE KEYS */;
INSERT INTO `suspended_items` (`id`, `suspend_id`, `product_id`, `product_code`, `product_name`, `product_unit`, `tax_rate_id`, `tax`, `quantity`, `unit_price`, `gross_total`, `val_tax`, `discount`, `discount_id`, `discount_val`, `serial_no`) VALUES
	(1, 1, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '2.50%', 2, 0.62, ''),
	(2, 1, 1, '001', 'telefono', 'pza', 2, '24.00%', 1, 20.00, 20.00, 4.80, '2.50%', 2, 0.62, ''),
	(3, 1, 1, '001', 'telefono', 'pza', 2, '24.00%', 6, 120.00, 720.00, 172.80, '2.50%', 2, 22.32, '');
/*!40000 ALTER TABLE `suspended_items` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.tax_rates
CREATE TABLE IF NOT EXISTS `tax_rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(55) NOT NULL,
  `rate` decimal(4,2) NOT NULL,
  `type` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.tax_rates: 4 rows
DELETE FROM `tax_rates`;
/*!40000 ALTER TABLE `tax_rates` DISABLE KEYS */;
INSERT INTO `tax_rates` (`id`, `name`, `rate`, `type`) VALUES
	(1, 'No Tax', 0.00, '2'),
	(2, 'VAT', 24.00, '1'),
	(3, 'GST', 6.00, '1'),
	(4, 'PVM', 21.00, '1');
/*!40000 ALTER TABLE `tax_rates` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.transfers
CREATE TABLE IF NOT EXISTS `transfers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_no` varchar(55) NOT NULL,
  `date` date NOT NULL,
  `from_warehouse_id` int(11) NOT NULL,
  `from_warehouse_code` varchar(55) NOT NULL,
  `from_warehouse_name` varchar(55) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `to_warehouse_code` varchar(55) NOT NULL,
  `to_warehouse_name` varchar(55) NOT NULL,
  `note` varchar(1000) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.transfers: 2 rows
DELETE FROM `transfers`;
/*!40000 ALTER TABLE `transfers` DISABLE KEYS */;
INSERT INTO `transfers` (`id`, `transfer_no`, `date`, `from_warehouse_id`, `from_warehouse_code`, `from_warehouse_name`, `to_warehouse_id`, `to_warehouse_code`, `to_warehouse_name`, `note`, `user`) VALUES
	(1, 'TR-0001', '2013-10-31', 1, 'WHI', 'Warehouse 1', 2, 'WHII', 'Warehouse 2', '', 'Briiggs Horcerada'),
	(2, 'TR-0002', '2013-10-31', 2, 'WHII', 'Warehouse 2', 1, 'WHI', 'Warehouse 1', '', 'Briiggs Horcerada');
/*!40000 ALTER TABLE `transfers` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.transfer_items
CREATE TABLE IF NOT EXISTS `transfer_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_code` varchar(55) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_unit` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.transfer_items: 2 rows
DELETE FROM `transfer_items`;
/*!40000 ALTER TABLE `transfer_items` DISABLE KEYS */;
INSERT INTO `transfer_items` (`id`, `transfer_id`, `product_id`, `product_code`, `product_name`, `product_unit`, `quantity`) VALUES
	(1, 1, 2, 'e.1', 'LSS Power Generator', 'Pieces', 50),
	(2, 2, 3, 'E.12', 'Nunash Push Button', 'bundles', 50);
/*!40000 ALTER TABLE `transfer_items` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(40) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.users: 1 rows
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
	(1, _binary 0x7F0000, 'admin', '7fd63a1ac42ee4d05af2cd73b6902ec76d2befc1', NULL, 'fcimpi@gmail.com', NULL, NULL, NULL, NULL, 1351661704, 1393822123, 1, 'Asshurim', 'Larita', 'ANNAS Stock Manager', '0105292122');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.users_groups
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.users_groups: 1 rows
DELETE FROM `users_groups`;
/*!40000 ALTER TABLE `users_groups` DISABLE KEYS */;
INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
	(1, 1, 1);
/*!40000 ALTER TABLE `users_groups` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.warehouses
CREATE TABLE IF NOT EXISTS `warehouses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(55) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.warehouses: 2 rows
DELETE FROM `warehouses`;
/*!40000 ALTER TABLE `warehouses` DISABLE KEYS */;
INSERT INTO `warehouses` (`id`, `code`, `name`, `address`, `city`) VALUES
	(1, 'WHI', 'Warehouse 1', 'Address', 'City'),
	(2, 'WHII', 'Warehouse 2', 'Address', 'City');
/*!40000 ALTER TABLE `warehouses` ENABLE KEYS */;


-- Dumping structure for table bdiggers_sma.warehouses_products
CREATE TABLE IF NOT EXISTS `warehouses_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- Dumping data for table bdiggers_sma.warehouses_products: 3 rows
DELETE FROM `warehouses_products`;
/*!40000 ALTER TABLE `warehouses_products` DISABLE KEYS */;
INSERT INTO `warehouses_products` (`id`, `product_id`, `warehouse_id`, `quantity`) VALUES
	(2, 2, 1, -116),
	(3, 2, 2, 48),
	(6, 4, 1, -11);
/*!40000 ALTER TABLE `warehouses_products` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
