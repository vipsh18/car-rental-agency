-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 27, 2022 at 09:18 AM
-- Server version: 8.0.18
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `car_rental_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `agencies`
--

DROP TABLE IF EXISTS `agencies`;
CREATE TABLE IF NOT EXISTS `agencies` (
  `agency_id` double NOT NULL AUTO_INCREMENT,
  `agency_email` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `agency_password` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `agency_reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`agency_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

DROP TABLE IF EXISTS `cars`;
CREATE TABLE IF NOT EXISTS `cars` (
  `car_id` double NOT NULL AUTO_INCREMENT,
  `car_agency` double NOT NULL,
  `car_renter` double DEFAULT NULL,
  `car_model` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `car_number` varchar(13) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `car_capacity` int(11) NOT NULL,
  `car_rent` float NOT NULL,
  `car_rented` tinyint(1) DEFAULT '0',
  `rent_start` date DEFAULT NULL,
  `rent_days` int(11) DEFAULT NULL,
  PRIMARY KEY (`car_id`),
  KEY `fk_agency_fk` (`car_agency`),
  KEY `fk_renter_fk` (`car_renter`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
CREATE TABLE IF NOT EXISTS `customers` (
  `cust_id` double NOT NULL AUTO_INCREMENT,
  `cust_email` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `cust_password` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `cust_rented_cars` text COLLATE utf8mb4_unicode_520_ci,
  `cust_reg_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cust_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
