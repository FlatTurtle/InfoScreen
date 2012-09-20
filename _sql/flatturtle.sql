-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 27, 2011 at 08:32 
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `flatturtle`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `lang` varchar(10) DEFAULT 'en',
  `interval` int(11) NOT NULL DEFAULT '15000',
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `infoscreens`
--

INSERT INTO `infoscreens` (`id`, `customer_id`, `title`, `alias`, `logo`, `color`, `lang`, `interval`) VALUES
(1, 1, 'FlatTurtle', 'demo', 'https://static.0x04.com/2012/01/flatturtle.png', '#607E16', 'en', 15000);

-- --------------------------------------------------------

--
-- Table structure for table `turtles`
--

CREATE TABLE IF NOT EXISTS `turtles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `infoscreen_id` int(11) NOT NULL,
  `module` varchar(255) NOT NULL,
  `colspan` int(2) NOT NULL DEFAULT '1',
  `order` int(2) NOT NULL DEFAULT '-1',
  `group` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `infoscreen_id` (`infoscreen_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `turtles`
--

INSERT INTO `turtles` (`id`, `infoscreen_id`, `module`, `colspan`, `order`, `group`, `source`) VALUES
(1, 1, 'airport', 1, 1, '', ''),
(2, 1, 'nmbs', 1, 2, '', ''),
(3, 1, 'map', 1, 3, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `turtle_options`
--

CREATE TABLE IF NOT EXISTS `turtle_options` (
  `turtle_id` int(11) NOT NULL,
  `key` varchar(20) NOT NULL,
  `value` varchar(255) NOT NULL,
  KEY `turtle_id` (`turtle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `turtle_options`
--

INSERT INTO `turtle_options` (`turtle_id`, `key`, `value`) VALUES
(1, 'location', 'BRU'),
(2, 'location', 'Gent'),
(3, 'location', 'Gent');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `infoscreens`
--
ALTER TABLE `infoscreens`
  ADD CONSTRAINT `infoscreens_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `turtles`
--
ALTER TABLE `turtles`
  ADD CONSTRAINT `turtles_ibfk_1` FOREIGN KEY (`infoscreen_id`) REFERENCES `infoscreens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `turtle_options`
--
ALTER TABLE `turtle_options`
  ADD CONSTRAINT `turtle_options_ibfk_1` FOREIGN KEY (`turtle_id`) REFERENCES `turtles` (`id`) ON DELETE CASCADE;
