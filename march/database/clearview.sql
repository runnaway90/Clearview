-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 15, 2012 at 09:29 PM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clearview`
--

-- --------------------------------------------------------

--
-- Table structure for table `albums`
--

CREATE TABLE IF NOT EXISTS `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `time` date NOT NULL,
  `place` varchar(100) NOT NULL,
  `society_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `albums`
--

INSERT INTO `albums` (`id`, `name`, `description`, `time`, `place`, `society_id`) VALUES
(20, 'blio', 'asda', '1998-11-09', 'Edinburgh', 2),
(21, 'blio', 'asda', '1998-11-09', 'Edinburgh', 2),
(22, 'blio', 'asda', '1998-11-09', 'Edinburgh', 2);

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `body` text NOT NULL,
  `short_description` text NOT NULL,
  `long_description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE IF NOT EXISTS `attendees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soc_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `title` varchar(140) COLLATE utf8_bin NOT NULL,
  `privacy_level` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `body` text COLLATE utf8_bin NOT NULL,
  `short_description` text COLLATE utf8_bin NOT NULL,
  `long_description` int(11) NOT NULL,
  `society_id` int(11) NOT NULL,
  `online_booking` tinyint(1) NOT NULL,
  `available_places` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `place` varchar(140) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=7 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `soc_id`, `event_id`, `title`, `privacy_level`, `price`, `body`, `short_description`, `long_description`, `society_id`, `online_booking`, `available_places`, `start_time`, `end_time`, `place`) VALUES
(1, 0, 0, '', 0, 0, '', '', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(2, 0, 0, 'dsdddddddddd', 0, 0, '', '', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(3, 0, 0, 'dsdddddddddd', 0, 0, '', '', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(4, 0, 0, 'ddaaaaa', 0, 0, '', '', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(5, 0, 0, 'Wowm', 20, 90, 0x736c6b646a616c7361, 0x6a736c64616a, 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', ''),
(6, 0, 0, '', 0, 0, '', '', 0, 0, 0, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) NOT NULL,
  `link` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `societies`
--

CREATE TABLE IF NOT EXISTS `societies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Dumping data for table `societies`
--

INSERT INTO `societies` (`id`, `name`, `description`) VALUES
(2, 'Clearview society', 0x4f757220736f6369657479),
(3, 'RoSoc', 0x526f6d616e69616e20536f6369657479);

-- --------------------------------------------------------

--
-- Table structure for table `society_members`
--

CREATE TABLE IF NOT EXISTS `society_members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `society_id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(3) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `dob` date NOT NULL,
  `university_id` int(1) NOT NULL,
  `membership_status_id` int(1) NOT NULL,
  `society_id` int(11) NOT NULL,
  `account_activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `E-mail` (`email`,`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `username`, `password`, `salt`, `firstname`, `surname`, `dob`, `university_id`, `membership_status_id`, `society_id`, `account_activated`) VALUES
(3, 's1038722@sms.ed.ac.uk', 'admin', '0fd9d8b25689ea0d66312087132cc511f67710cd2292d7accc59edc21eb3c668', '0cf', 'admin', 'mr admin', '2012-01-01', 0, 1, 2, 1),
(5, 'o.osman@sms.ed.ac.uk', 'ozzy', '061a8af101c3933ea885ed425fafaefd9b4cb5802f6187637c8cf8273b4ea00c', 'e9a', 'Ozgur', 'Osman', '2012-01-01', 0, 0, 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
