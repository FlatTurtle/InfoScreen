-- phpMyAdmin SQL Dump
-- version 3.4.5deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 17, 2012 at 06:59 PM
-- Server version: 5.1.61
-- PHP Version: 5.3.6-13ubuntu3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `flatturtle`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobname` varchar(30) NOT NULL,
  `javascript` varchar(1000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `jobname`, `javascript`) VALUES
(1, 'screen_on', 'try{application.enableScreen(true);}catch(err){}window.location = $("base").attr("href") + infoScreen.alias; '),
(2, 'screen_off', 'try{application.enableScreen(false);}catch(err){}window.location = $("base").attr("href") + infoScreen.alias + "/sleep/";');

-- --------------------------------------------------------

--
-- Table structure for table `jobtab`
--

CREATE TABLE IF NOT EXISTS `jobtab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `infoscreen_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `minutes` varchar(50) NOT NULL,
  `hours` varchar(50) NOT NULL,
  `day_of_month` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `day_of_week` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `infoscreen_id` (`infoscreen_id`),
  KEY `job_id` (`job_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

