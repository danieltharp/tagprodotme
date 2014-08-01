-- phpMyAdmin SQL Dump
-- version 4.1.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 01, 2014 at 12:03 PM
-- Server version: 5.6.17
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bluesoul_tagprostats`
--

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE IF NOT EXISTS `games` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gameno` int(10) unsigned NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `name` varchar(15) NOT NULL,
  `plusminus` tinyint(4) NOT NULL,
  `played` smallint(5) unsigned NOT NULL,
  `score` smallint(6) NOT NULL,
  `tags` tinyint(3) unsigned NOT NULL,
  `pops` tinyint(3) unsigned NOT NULL,
  `grabs` tinyint(3) unsigned NOT NULL,
  `drops` tinyint(3) unsigned NOT NULL,
  `hold` smallint(5) unsigned NOT NULL,
  `captures` tinyint(3) unsigned NOT NULL,
  `prevent` smallint(5) unsigned NOT NULL,
  `returns` tinyint(3) unsigned NOT NULL,
  `roam` int(4) DEFAULT NULL,
  `support` tinyint(3) unsigned NOT NULL,
  `teamcaps` tinyint(3) unsigned NOT NULL,
  `oppcaps` tinyint(3) unsigned NOT NULL,
  `arrival` mediumint(9) NOT NULL,
  `departure` mediumint(9) NOT NULL,
  `bombtime` mediumint(8) unsigned NOT NULL,
  `tagprotime` mediumint(8) unsigned NOT NULL,
  `griptime` mediumint(8) unsigned NOT NULL,
  `speedtime` mediumint(8) unsigned NOT NULL,
  `tagpros` tinyint(3) unsigned NOT NULL,
  `grips` tinyint(3) unsigned NOT NULL,
  `bombs` tinyint(3) unsigned NOT NULL,
  `powerups` tinyint(3) unsigned NOT NULL,
  `team` tinyint(1) NOT NULL,
  `degree` smallint(5) unsigned NOT NULL,
  `win` tinyint(1) NOT NULL,
  `iwon` tinyint(1) unsigned DEFAULT NULL,
  `map` varchar(127) DEFAULT NULL,
  `host` varchar(100) DEFAULT NULL,
  `auth` varchar(1) DEFAULT NULL,
  `elo` smallint(5) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `name` (`name`),
  KEY `name_2` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=0 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
