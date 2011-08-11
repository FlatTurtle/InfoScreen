-- phpMyAdmin SQL Dump
-- version 3.3.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 11, 2011 at 08:08 PM
-- Server version: 5.1.54
-- PHP Version: 5.3.5-1ubuntu7.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `flatturtle`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `username`, `password`) VALUES
(1, 'John', 'password');

-- --------------------------------------------------------

--
-- Table structure for table `infoscreens`
--

CREATE TABLE IF NOT EXISTS `infoscreens` (
  `id` int(11) NOT NULL,
  `customerid` int(11) NOT NULL,
  `title` text NOT NULL,
  `motd` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infoscreens`
--

INSERT INTO `infoscreens` (`id`, `customerid`, `title`, `motd`) VALUES
(1, 1, 'The Amadeus Square', 'The Amadeus Square');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `infoscreenid` int(11) NOT NULL,
  `key` varchar(20) NOT NULL,
  `value` varchar(150) NOT NULL,
  PRIMARY KEY (`infoscreenid`,`key`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`infoscreenid`, `key`, `value`) VALUES
(1, 'cycleinterval', '10'),
(1, 'rowstoshow', '10'),
(1, 'lang', 'EN'),
(1, 'color', '#fb8b1a'),
(1, 'logo', 'templates/FlatTurtle/img/amadeussquare.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `stations`
--

CREATE TABLE IF NOT EXISTS `stations` (
  `infoscreenid` int(11) NOT NULL,
  `stationid` varchar(25) NOT NULL,
  `type` varchar(10) NOT NULL,
  PRIMARY KEY (`infoscreenid`,`stationid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stations`
--

INSERT INTO `stations` (`infoscreenid`, `stationid`, `type`) VALUES
(1, 'BE.NMBS.008814001', 'NMBS'),
(1, 'BE.NMBS.008814118', 'NMBS'),
(1, 'BE.NMBS.008814373', 'NMBS');
