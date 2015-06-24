-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2015 at 04:16 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ip_contacts`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_ranges`
--

CREATE TABLE IF NOT EXISTS `ip_ranges` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  `network` varchar(50) NOT NULL,
  `broadcast` varchar(50) NOT NULL,
  `cidr` int(3) NOT NULL,
  `ipv` int(1) NOT NULL,
  `company` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `contacts` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `start` (`start`),
  UNIQUE KEY `end` (`end`),
  KEY `cidr` (`cidr`),
  KEY `ipv` (`ipv`),
  KEY `company` (`company`),
  KEY `network` (`network`),
  KEY `broadcast` (`broadcast`),
  KEY `provider` (`provider`),
  KEY `notes` (`notes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- Table structure for table `ip_ranges_deleted`
--

CREATE TABLE IF NOT EXISTS `ip_ranges_deleted` (
  `id` int(25) NOT NULL AUTO_INCREMENT,
  `start` varchar(100) NOT NULL,
  `end` varchar(100) NOT NULL,
  `network` varchar(50) NOT NULL,
  `broadcast` varchar(50) NOT NULL,
  `cidr` int(3) NOT NULL,
  `ipv` int(1) NOT NULL,
  `company` varchar(255) NOT NULL,
  `notes` varchar(255) NOT NULL,
  `provider` varchar(255) NOT NULL,
  `contacts` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cidr` (`cidr`),
  KEY `ipv` (`ipv`),
  KEY `company` (`company`),
  KEY `start` (`start`),
  KEY `end` (`end`),
  KEY `network` (`network`),
  KEY `broadcast` (`broadcast`),
  KEY `provider` (`provider`),
  KEY `notes` (`notes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
