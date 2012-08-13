-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2012 at 05:33 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `new_db`
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

--
-- Dumping data for table `available_screens`
--

INSERT INTO `available_screens` (`type_name`, `screen_id`) VALUES
('flatturtle', 1),
('flatturtle', 2),
('flatturtle', 3),
('flatturtle', 4),
('flatturtle', 5),
('flatturtle', 6),
('flatturtle', 7),
('flatturtle', 8),
('flatturtle', 9),
('flatturtle', 10),
('flatturtle', 11),
('flatturtle', 12),
('flatturtle', 13),
('john', 14),
('yeri', 15),
('yeri', 16),
('yeri', 17),
('yeri', 18),
('yeri', 19),
('john', 20),
('flatturtle', 21);

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
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `alias` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `screenshot` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`alias`, `name`, `description`, `screenshot`) VALUES
('airport', 'airport', NULL, NULL),
('delijn', 'de lijn', NULL, NULL),
('map', 'map', NULL, NULL),
('mivbstib', 'mivbstib', NULL, NULL),
('nmbs', 'nmbs', NULL, NULL),
('ttshuttles', 'shuttles', NULL, NULL),
('twitter', 'twitter', NULL, NULL),
('velo', 'velo', NULL, NULL),
('villo', 'villo', NULL, NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=77 ;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `key`, `value`, `module_alias`) VALUES
(1, 'location', 'BRU', 'airport'),
(2, 'location', 'Vorst Zuid', 'nmbs'),
(3, 'location', 'Mozartlaan 8, Drogenbos', 'map'),
(4, 'location', 'Gent Sint Pieters', 'nmbs'),
(5, 'location', 'Brussel Zuid', 'nmbs'),
(6, 'location', 'Luik Guillemins', 'nmbs'),
(7, 'location', 'Antwerpen Centraal', 'nmbs'),
(8, 'location', 'Brugge', 'map'),
(9, 'hashtag', 'editable', 'twitter'),
(10, 'location', 'Gent station Gent Sint Pieters', 'map'),
(11, 'location', 'Gentbrugge', 'nmbs'),
(12, 'location', 'Gaston Crommenlaan 8 Gent', 'map'),
(13, 'location', 'Antwerpen Zuid', 'nmbs'),
(14, 'location', 'Venusstraat 35 Antwerpen', 'map'),
(15, 'location', 'Brussels South', 'nmbs'),
(16, 'location', 'St Agatha Berchem', 'nmbs'),
(17, 'location', 'Keizer Karellaan 586, Sint-Agatha-Berchem', 'map'),
(18, 'location', 'Evere', 'nmbs'),
(19, 'location', 'Avenue des Olympiades 2, Brussels', 'map'),
(20, 'location', 'Brussels Schuman ', 'nmbs'),
(21, 'location', 'Kortenberglaan 172-182, Brussels', 'map'),
(22, 'location', 'Brussels Central', 'nmbs'),
(23, 'location', 'Avenue du Port 83c, Brussels', 'map'),
(24, 'location', 'STATION SAINT-JOB', 'mivbstib'),
(25, 'location', 'Nationalestraat 5, Antwerpen', 'map'),
(26, 'location', 'Antwerpen Berchem', 'nmbs'),
(27, 'location', 'Etterbeek', 'nmbs'),
(28, 'location', 'Merode', 'nmbs'),
(29, 'location', 'Witte Patersstraat 4, 1040 Brussel', 'map'),
(30, 'location', 'Brussels Noord', 'nmbs'),
(31, 'location', 'Brussels Congres', 'nmbs'),
(32, 'location', 'Rue Royale 180, Brussels', 'map'),
(33, 'location', 'TOUR ET TAXIS', 'mivbstib'),
(34, 'location', 'BERCHEM STATION', 'mivbstib'),
(35, 'location', 'MOZART', 'mivbstib'),
(36, 'location', 'Drogenbos Mozart', 'delijn'),
(37, 'location', 'PERMEKE', 'mivbstib'),
(38, 'location', 'GUEUX', 'mivbstib'),
(39, 'location', 'DE JAMBLINNE DE MEUX', 'mivbstib'),
(40, 'location', 'CONGRES', 'mivbstib'),
(41, 'location', 'BOTANIQUE', 'mivbstib'),
(42, 'location', 'Sint-Joost-ten-Node Kruidtuin', 'delijn'),
(43, 'location', 'Sint-Agatha-Berchem Shopping', 'delijn'),
(44, 'location', 'Havenlaan 83c, Brussels', 'map'),
(45, 'location', 'Borgtstraat 319, Grimbergen', 'map'),
(46, 'location', 'VILVORDE STATION', 'mivbstib'),
(47, 'location', 'Grimbergen Oude Schapenbaan', 'delijn'),
(48, 'location', 'JFK', 'airport'),
(49, 'location', 'Vilvoorde', 'nmbs'),
(50, 'location', 'Harelbeke', 'nmbs'),
(51, 'location', 'Gent Korenmarkt Perron 5', 'delijn'),
(52, 'location', 'Gent Dampoort', 'nmbs'),
(53, 'location', 'Gent Reep', 'delijn'),
(54, 'location', 'Heysel', 'mivbstib'),
(55, 'location', 'Centenaire', 'mivbstib'),
(56, 'location', 'Esplanade', 'mivbstib'),
(57, 'location', 'Brussel Koning Boudewijn', 'delijn'),
(58, 'location', '50.866249327319;4.3109249597703', 'villo'),
(59, 'location', '51.217702248989160000;4.420620492815168000', 'velo');

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

--
-- Dumping data for table `scheduled_tasks`
--

INSERT INTO `scheduled_tasks` (`id`, `screen_id`, `job_alias`, `day_of_month`, `month`, `day_of_week`, `hours`, `minutes`) VALUES
(3, 1, 'screen_on', '*', '*', '*', '7', '0'),
(4, 1, 'screen_off', '*', '*', '*', '20', '0'),
(5, 6, 'screen_on', '*', '*', '*', '7', '0'),
(6, 6, 'screen_off', '*', '*', '*', '22', '0'),
(7, 7, 'screen_on', '*', '*', '*', '7', '0'),
(8, 7, 'screen_off', '*', '*', '*', '19', '0'),
(9, 8, 'screen_on', '*', '*', '*', '7', '0'),
(10, 8, 'screen_off', '*', '*', '*', '21', '0'),
(11, 12, 'screen_on', '*', '*', '*', '7', '45'),
(12, 12, 'screen_off', '*', '*', '*', '19', '0'),
(13, 13, 'screen_on', '*', '*', '*', '6', '0'),
(14, 13, 'screen_off', '*', '*', '*', '0', '0'),
(15, 14, 'screen_on', '*', '*', '*', '8', '0'),
(16, 14, 'screen_off', '*', '*', '*', '20', '30'),
(17, 15, 'screen_on', '*', '*', '*', '5', '23'),
(18, 15, 'screen_off', '*', '*', '*', '2', '43'),
(19, 16, 'screen_on', '*', '*', '*', '6', '0'),
(20, 16, 'screen_off', '*', '*', '*', '0', '30'),
(21, 17, 'screen_on', '*', '*', '*', '9', '15'),
(22, 17, 'screen_off', '*', '*', '*', '22', '45'),
(23, 18, 'screen_on', '*', '*', '*', '6', '0'),
(24, 18, 'screen_off', '*', '*', '*', '23', '0'),
(25, 19, 'screen_on', '*', '*', '*', '7', '0'),
(26, 19, 'screen_off', '*', '*', '*', '23', '0'),
(27, 20, 'screen_on', '*', '*', '*', '8', '0'),
(28, 20, 'screen_off', '*', '*', '*', '19', '0');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `interval`, `lang`, `pincode`, `color`, `version-tag`, `alias`, `title`, `logo`, `hostname`) VALUES
(1, 15000, 'en', NULL, '#FB8B1A', 'stable', 'the-amadeus-square', 'The Amadeus Square', 'templates/default/img/amadeussquare.jpg', 'efikamx-561a07'),
(2, 15000, 'en', NULL, '#C70000', 'stable', 'iRail', 'iRail Liveboards', 'http://npo.irail.be/img/headerlogo.png', ''),
(3, 15000, 'nl', NULL, '#0075FA', 'stable', 'hogent', 'Hogeschool Gent', 'http://sites.google.com/site/thesissvenvdb/_/rsrc/1268125647077/home/logoHogent.jpg?height=105&width=240', ''),
(4, 15000, 'en', NULL, '#e9578e', 'stable', 'ibbt-zuiderpoort', 'IBBT', 'http://www.edingesawards.be/wp-content/uploads/ibbt_logo.gif', ''),
(5, 15000, 'nl', NULL, '#7e002f', 'stable', 'ua-venusstraat', 'Universiteit Antwerpen', 'http://img.flatturtle.com/infoscreen/logos/ua.jpg', ''),
(6, 15000, 'en', NULL, '#444324', 'stable', 'atlantis-access', 'Atlantis Square Access', 'http://img.flatturtle.com/infoscreen/logos/atlantis.png', 'efikamx-561dcb'),
(7, 15000, 'en', NULL, '#716F6E', 'stable', 'leopold3', 'LeopoldThree', 'http://img.flatturtle.com/infoscreen/logos/l3.jpg', ''),
(8, 15000, 'en', NULL, '#4F762E', 'stable', 'newcort', 'Newcort', 'http://img.flatturtle.com/infoscreen/logos/newcort.png', 'efikamx-561b94'),
(9, 10000, 'en', NULL, '#2057A7', 'stable', 'demo', 'FlatTurtle Demo', 'http://img.flatturtle.com/infoscreen/logos/flatturtle.png', ''),
(10, 15000, 'nl', NULL, '#26328C', 'stable', 'kdg-groenplaats', 'KdG (Groenplaats)', 'http://img.flatturtle.com/infoscreen/logos/kdglogo.png', ''),
(11, 15000, 'en', NULL, '#e6424a', 'stable', 'betagroup-coworking', 'BetaGroup Coworking', 'http://coworking.betagroup.be/assets/furniture/bgc-logo.gif', ''),
(12, 15000, 'en', NULL, '#1477A0', 'stable', 'royal-center', 'Royal Center', 'http://img.flatturtle.com/infoscreen/logos/royalcenter.jpg', 'efikamx-561b5a'),
(13, 15000, 'en', NULL, '#C14032', 'stable', 'tourtaxis', 'Tour & Taxis', 'http://img.flatturtle.com/infoscreen/logos/tourtaxis.png', ''),
(14, 150000, 'en', NULL, '#000000', 'stable', 'test1', 'yeri', 'http://twimg0-a.akamaihd.net/profile_images/1203982716/thumb_large_eRfglXxdkp4ced6a46a8282f4b14000060.png', 'efikamx-9ba5a6 '),
(15, 2000, 'en', NULL, '#000000', 'stable', 'test2', 'test2', 'http://img.flatturtle.com/flatturtle/logo/FlatTurtle-Turtle.png', 'efikamx-561a64'),
(16, 15000, 'en', NULL, '#000000', 'stable', 'test3', 'test3', 'http://img.flatturtle.com/flatturtle/logo/FlatTurtle-Turtle.png', 'efikamx-9ba3da'),
(17, 15000, 'nl', NULL, '#000000', 'stable', 'test4', 'test4', 'http://img.flatturtle.com/flatturtle/logo/FlatTurtle-Turtle.png', 'efikamx-9b9833'),
(18, 15000, 'fr', NULL, '#1477A0', 'stable', 'test5', 'test5', 'http://img.flatturtle.com/flatturtle/logo/FlatTurtle-Turtle.png', 'efikamx-9b98c6'),
(19, 15000, 'en', NULL, '#F0F0F0', 'stable', 'test6', 'test6', 'http://img.flatturtle.com/flatturtle/logo/FlatTurtle-Turtle.png', ''),
(20, 15000, 'en', NULL, '#FF0000', 'testing', 'isoc12', '#iSoc12', 'http://blog.irail.be/wp-content/uploads/2012/05/logo_summerofcode_final.png', 'efikamx-9ba51c'),
(21, 15000, 'en', NULL, '#22632F', 'stable', 'brosella', 'Brosella', 'http://img.flatturtle.com/infoscreen/logos/brosella.png', '');

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

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`alias`, `name`, `function`, `description`) VALUES
('screen_off', 'shutdown TV', 'try{application.enableScreen(false);}catch(err){}window.location = $("base").attr("href") + infoScreen.alias + "/sleep/";', NULL),
('screen_on', 'start TV', 'try{application.enableScreen(true);}catch(err){}window.location = $("base").attr("href") + infoScreen.alias; ', NULL);

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

--
-- Dumping data for table `turtles`
--

INSERT INTO `turtles` (`id`, `module_alias`, `screen_id`, `colspan`, `order`, `group`, `source`) VALUES
(1, 'airport', 1, 1, 3, '3', ''),
(2, 'nmbs', 1, 1, 1, '1', ''),
(3, 'map', 1, 1, 2, '3', ''),
(4, 'nmbs', 2, 2, 0, '1', ''),
(5, 'nmbs', 2, 2, 0, '1', ''),
(6, 'nmbs', 2, 1, 0, '1', ''),
(7, 'nmbs', 2, 2, 0, '2', ''),
(8, 'nmbs', 2, 2, 0, '2', ''),
(9, 'map', 2, 1, 0, '3', ''),
(10, 'twitter', 2, 1, 0, '3', ''),
(11, 'nmbs', 3, 2, 0, '', ''),
(12, 'map', 3, 2, 0, '2', ''),
(13, 'nmbs', 4, 2, 0, '1', ''),
(14, 'nmbs', 4, 2, 0, '1', NULL),
(15, 'map', 4, 2, 0, '2', ''),
(16, 'nmbs', 5, 2, 0, '1', ''),
(17, 'nmbs', 5, 2, 0, '1', ''),
(18, 'map', 5, 2, 0, '2', ''),
(19, 'nmbs', 1, 1, 1, '2', ''),
(20, 'twitter', 5, 2, 0, '2', ''),
(21, 'twitter', 4, 2, 0, '2', ''),
(22, 'twitter', 3, 2, 0, '2', ''),
(23, 'nmbs', 6, 1, 1, '1', NULL),
(24, 'map', 6, 1, 2, '3', NULL),
(25, 'nmbs', 7, 1, 2, '2', NULL),
(26, 'map', 7, 1, 1, '1', NULL),
(27, 'nmbs', 8, 1, 1, '1', NULL),
(28, 'map', 8, 1, 3, '3', NULL),
(29, 'airport', 6, 1, 2, '3', NULL),
(30, 'airport', 7, 1, 3, '3', NULL),
(32, 'nmbs', 9, 1, 1, '1', NULL),
(33, 'nmbs', 9, 1, 1, '1', NULL),
(34, 'nmbs', 9, 1, 1, '1', NULL),
(41, 'map', 9, 1, 3, '3', NULL),
(42, 'airport', 9, 1, 2, '2', NULL),
(43, 'twitter', 9, 1, 3, '3', NULL),
(44, 'mivbstib', 9, 1, 2, '2', NULL),
(45, 'nmbs', 10, 1, 0, '1', NULL),
(46, 'map', 10, 1, 0, NULL, NULL),
(47, 'twitter', 10, 1, 0, NULL, NULL),
(48, 'nmbs', 10, 1, 0, '1', NULL),
(49, 'nmbs', 6, 1, 1, '2', ''),
(50, 'nmbs', 11, 1, 1, '1', NULL),
(51, 'nmbs', 11, 1, 1, '1', NULL),
(52, 'map', 11, 1, 2, '2', NULL),
(53, 'nmbs', 8, 1, 2, '2', NULL),
(54, 'nmbs', 12, 1, 0, '1', NULL),
(55, 'nmbs', 12, 1, 1, '2', NULL),
(56, 'map', 12, 1, 2, '3', NULL),
(58, 'nmbs', 13, 1, 1, '1', NULL),
(59, 'mivbstib', 13, 1, 1, '2', NULL),
(63, 'ttshuttles', 13, 1, 2, '1', NULL),
(66, 'mivbstib', 6, 1, 2, '1', NULL),
(67, 'mivbstib', 1, 0, 2, '2', NULL),
(68, 'delijn', 1, 0, 2, '1', NULL),
(69, 'mivbstib', 7, 1, 3, '3', NULL),
(70, 'mivbstib', 8, 1, 1, '1', NULL),
(71, 'mivbstib', 8, 1, 2, '2', NULL),
(72, 'mivbstib', 12, 1, 1, '2', NULL),
(73, 'mivbstib', 12, 1, 2, '3', NULL),
(74, 'delijn', 12, 1, 0, '1', NULL),
(75, 'delijn', 6, 1, 2, '2', ''),
(76, 'map', 13, 1, 2, '2', NULL),
(77, 'map', 14, 1, 1, '1', NULL),
(78, 'mivbstib', 15, 1, 1, '1', NULL),
(79, 'delijn', 15, 1, 2, '1', NULL),
(80, 'airport', 16, 1, 1, '1', NULL),
(81, 'airport', 16, 1, 2, '1', NULL),
(82, 'nmbs', 17, 1, 1, '1', NULL),
(83, 'nmbs', 17, 1, 2, '1', NULL),
(84, 'nmbs', 17, 1, 1, '2', NULL),
(85, 'nmbs', 17, 1, 2, '2', NULL),
(86, 'twitter', 18, 1, 1, '1', NULL),
(87, 'ttshuttles', 18, 1, 1, '2', NULL),
(88, 'twitter', 20, 2, 0, '0', NULL),
(89, 'nmbs', 20, 1, 0, '2', NULL),
(90, 'delijn', 20, 1, 2, '2', NULL),
(91, 'nmbs', 20, 1, 1, '3', NULL),
(92, 'delijn', 20, 1, 2, '3', NULL),
(93, 'twitter', 20, 2, 0, '0', NULL),
(94, 'twitter', 20, 2, 0, '0', NULL),
(95, 'mivbstib', 21, 1, 1, '0', NULL),
(96, 'mivbstib', 21, 1, 2, '1', NULL),
(97, 'mivbstib', 21, 1, 3, '0', NULL),
(98, 'delijn', 21, 1, 4, '1', NULL),
(99, 'villo', 9, 1, 2, '2', NULL),
(100, 'velo', 9, 1, 3, '3', '');

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

--
-- Dumping data for table `turtle_config`
--

INSERT INTO `turtle_config` (`option_id`, `turtle_id`, `extra_value`) VALUES
(1, 1, NULL),
(1, 29, NULL),
(1, 30, NULL),
(1, 42, NULL),
(1, 80, NULL),
(2, 2, NULL),
(3, 3, NULL),
(4, 4, NULL),
(4, 11, NULL),
(4, 13, NULL),
(4, 89, NULL),
(5, 5, NULL),
(6, 6, NULL),
(7, 8, NULL),
(7, 17, NULL),
(7, 45, NULL),
(7, 83, NULL),
(8, 9, NULL),
(9, 10, 'iRail'),
(9, 20, 'antwerpen'),
(9, 21, 'IBBT'),
(9, 22, 'hogent'),
(9, 43, 'BrusselsAirport'),
(9, 47, NULL),
(9, 86, 'iRail'),
(9, 88, 'iSoc12'),
(9, 93, 'iRail'),
(9, 94, 'code9000'),
(10, 12, NULL),
(11, 14, NULL),
(12, 15, NULL),
(13, 16, NULL),
(14, 18, NULL),
(15, 19, NULL),
(15, 34, NULL),
(15, 53, NULL),
(15, 82, NULL),
(16, 23, NULL),
(17, 24, NULL),
(18, 25, NULL),
(19, 26, NULL),
(20, 27, NULL),
(21, 28, NULL),
(22, 33, NULL),
(23, 41, NULL),
(24, 44, NULL),
(25, 46, NULL),
(26, 48, NULL),
(27, 50, NULL),
(28, 51, NULL),
(29, 52, NULL),
(30, 32, NULL),
(30, 49, NULL),
(30, 54, NULL),
(30, 58, NULL),
(31, 55, NULL),
(32, 56, NULL),
(33, 59, NULL),
(34, 66, NULL),
(35, 67, NULL),
(36, 68, NULL),
(37, 69, NULL),
(38, 70, NULL),
(39, 71, NULL),
(40, 72, NULL),
(41, 73, NULL),
(42, 74, NULL),
(43, 75, NULL),
(44, 76, NULL),
(45, 77, NULL),
(46, 78, NULL),
(47, 79, NULL),
(48, 81, NULL),
(49, 84, NULL),
(50, 85, NULL),
(51, 90, NULL),
(52, 7, NULL),
(52, 91, NULL),
(53, 92, NULL),
(54, 95, NULL),
(55, 96, NULL),
(56, 97, NULL),
(57, 98, NULL),
(58, 99, NULL),
(59, 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`name`) VALUES
('flatturtle'),
('john'),
('yeri');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `type_name` (`type_name`(191)),
  KEY `type_name_2` (`type_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `type_name`) VALUES
('flatturtle', 'test', 'flatturtle'),
('John', 'password', 'john'),
('yeri', 'abc', 'yeri');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `available_modules`
--
ALTER TABLE `available_modules`
  ADD CONSTRAINT `available_modules_ibfk_2` FOREIGN KEY (`module_alias`) REFERENCES `modules` (`alias`) ON DELETE CASCADE,
  ADD CONSTRAINT `available_modules_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE;

--
-- Constraints for table `available_screens`
--
ALTER TABLE `available_screens`
  ADD CONSTRAINT `available_screens_ibfk_2` FOREIGN KEY (`screen_id`) REFERENCES `screens` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `available_screens_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `turtle_config_ibfk_2` FOREIGN KEY (`turtle_id`) REFERENCES `turtles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `turtle_config_ibfk_1` FOREIGN KEY (`option_id`) REFERENCES `options` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`type_name`) REFERENCES `types` (`name`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
