-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 21, 2012 at 07:25 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `newdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `available_modules`
--

CREATE TABLE IF NOT EXISTS `available_modules` (
  `type_name` varchar(255) NOT NULL,
  `module_alias` varchar(255) NOT NULL,
  PRIMARY KEY (`type_name`,`module_alias`),
  KEY `module_alias` (`module_alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `available_screens`
--

CREATE TABLE IF NOT EXISTS `available_screens` (
  `type_name` varchar(255) NOT NULL,
  `screen_id` int(11) NOT NULL,
  PRIMARY KEY (`type_name`,`screen_id`),
  KEY `screen_id` (`screen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `available_tasks`
--

CREATE TABLE IF NOT EXISTS `available_tasks` (
  `type_name` varchar(255) NOT NULL,
  `job_alias` varchar(255) NOT NULL,
  PRIMARY KEY (`type_name`,`job_alias`),
  KEY `job_id` (`job_alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `available_users`
--

CREATE TABLE IF NOT EXISTS `available_users` (
  `type_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  PRIMARY KEY (`type_name`,`user_name`),
  KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `ip_address` varchar(16) COLLATE utf8_bin NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`session_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(40) COLLATE utf8_bin NOT NULL,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `module_alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `module_name` (`module_alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=60 ;

-- --------------------------------------------------------

--
-- Table structure for table `scheduled_tasks`
--

CREATE TABLE IF NOT EXISTS `scheduled_tasks` (
  `id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `job_alias` varchar(255) NOT NULL,
  `day_of_month` varchar(50) NOT NULL,
  `month` varchar(50) NOT NULL,
  `day_of_week` varchar(50) NOT NULL,
  `hours` varchar(50) NOT NULL,
  `minutes` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `screen_id` (`screen_id`),
  KEY `screen_id_2` (`screen_id`),
  KEY `job_alias` (`job_alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE IF NOT EXISTS `screens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `interval` int(11) NOT NULL DEFAULT '15000',
  `lang` varchar(10) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `version-tag` varchar(50) NOT NULL DEFAULT 'stable',
  `alias` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `hostname` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `pincode` (`pincode`,`hostname`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `function` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE IF NOT EXISTS `tokens` (
  `value` varchar(255) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `expiration` datetime NOT NULL,
  `ip` varchar(20) NOT NULL,
  `user-agent` varchar(255) NOT NULL,
  PRIMARY KEY (`value`,`screen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `turtles`
--

CREATE TABLE IF NOT EXISTS `turtles` (
  `id` int(11) NOT NULL,
  `module_alias` varchar(255) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `colspan` int(11) NOT NULL,
  `order` tinyint(4) NOT NULL,
  `group` varchar(255) DEFAULT NULL,
  `source` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `module_name` (`module_alias`,`screen_id`),
  KEY `module_alias` (`module_alias`),
  KEY `screen_id` (`screen_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `turtle_config`
--

CREATE TABLE IF NOT EXISTS `turtle_config` (
  `option_id` int(11) NOT NULL,
  `turtle_id` int(11) NOT NULL,
  `extra_value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`option_id`,`turtle_id`),
  KEY `turtle_id` (`turtle_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_bin NOT NULL,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `activated` tinyint(1) NOT NULL DEFAULT '1',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `ban_reason` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `new_password_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `new_password_requested` datetime DEFAULT NULL,
  `new_email` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `new_email_key` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users2`
--

CREATE TABLE IF NOT EXISTS `users2` (
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `type_name` (`type_name`(191)),
  KEY `type_name_2` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_autologin`
--

CREATE TABLE IF NOT EXISTS `user_autologin` (
  `key_id` char(32) COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `user_agent` varchar(150) COLLATE utf8_bin NOT NULL,
  `last_ip` varchar(40) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE IF NOT EXISTS `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `country` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `available_modules`
--
ALTER TABLE `available_modules`
  ADD CONSTRAINT `available_modules_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE,
  ADD CONSTRAINT `available_modules_ibfk_2` FOREIGN KEY (`module_alias`) REFERENCES `modules` (`alias`) ON DELETE CASCADE;

--
-- Constraints for table `available_screens`
--
ALTER TABLE `available_screens`
  ADD CONSTRAINT `available_screens_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE,
  ADD CONSTRAINT `available_screens_ibfk_2` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `available_tasks`
--
ALTER TABLE `available_tasks`
  ADD CONSTRAINT `available_tasks_ibfk_2` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `available_users`
--
ALTER TABLE `available_users`
  ADD CONSTRAINT `available_users_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `options`
--
ALTER TABLE `options`
  ADD CONSTRAINT `options_ibfk_1` FOREIGN KEY (`module_alias`) REFERENCES `modules` (`alias`) ON DELETE CASCADE;

--
-- Constraints for table `scheduled_tasks`
--
ALTER TABLE `scheduled_tasks`
  ADD CONSTRAINT `scheduled_tasks_ibfk_1` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `scheduled_tasks_ibfk_2` FOREIGN KEY (`job_alias`) REFERENCES `tasks` (`alias`) ON DELETE CASCADE;

--
-- Constraints for table `turtles`
--
ALTER TABLE `turtles`
  ADD CONSTRAINT `turtles_ibfk_1` FOREIGN KEY (`module_alias`) REFERENCES `modules` (`alias`) ON DELETE CASCADE,
  ADD CONSTRAINT `turtles_ibfk_2` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `turtle_config`
--
ALTER TABLE `turtle_config`
  ADD CONSTRAINT `turtle_config_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turtle_config_ibfk_2` FOREIGN KEY (`turtle_id`) REFERENCES `turtles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users2`
--
ALTER TABLE `users2`
  ADD CONSTRAINT `users2_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
