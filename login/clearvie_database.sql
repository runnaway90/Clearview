-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 27, 2012 at 03:47 PM
-- Server version: 5.1.56
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `clearvie_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `Events`
--

CREATE TABLE IF NOT EXISTS `Events` (
  `event_id` int(11) NOT NULL AUTO_INCREMENT,
  `society_id` int(11) NOT NULL,
  `host` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(200) DEFAULT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time DEFAULT NULL,
  `location` varchar(100) NOT NULL,
  `google_maps_link` varchar(100) DEFAULT NULL,
  `photo_id` int(11) DEFAULT NULL,
  `privacy_status` varchar(10) NOT NULL DEFAULT 'public',
  PRIMARY KEY (`event_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Societies`
--

CREATE TABLE IF NOT EXISTS `Societies` (
  `society_id` int(11) NOT NULL AUTO_INCREMENT,
  `society_name` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `society_website` varchar(150) NOT NULL,
  `university_id` int(1) NOT NULL,
  PRIMARY KEY (`society_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Subscribtions`
--

CREATE TABLE IF NOT EXISTS `Subscribtions` (
  `user_id` int(11) NOT NULL,
  `society_id` int(11) NOT NULL,
  `membership_status` varchar(10) NOT NULL,
  `request_status` varchar(10) NOT NULL DEFAULT 'pending',
  PRIMARY KEY (`user_id`,`society_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(64) NOT NULL,
  `salt` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `salt`) VALUES
(8, 'test', 'b7ade2fd5d7d1d7a049006bf42b9ecad319f498095e5300aa4cacb1d04c91f49', '575'),
(10, 'runnaway90', '0a7d1b640499a242eb83ca8acef0be5ee3605846eaeeebca3a934800f97ba9f2', '44f'),
(11, 'ra', '67a2c93161715f6190a968f00cd67bccba107d2029827f9386309a30521c7095', 'ea2');

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
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
  `account_activated` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `E-mail` (`email`,`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Users`
--

INSERT INTO `Users` (`user_id`, `email`, `username`, `password`, `salt`, `firstname`, `surname`, `dob`, `university_id`, `membership_status_id`, `account_activated`) VALUES
(2, 's1038722@sms.ed.ac.uk', 'a', '0d7d51f3e5baaa8a433b94e878e80eda5429443009578e8bd2931130281b8e71', '41d', 'a', 'a', '1991-01-01', 0, 0, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
