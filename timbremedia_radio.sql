-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2016 at 12:48 PM
-- Server version: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `timbremedia_radio`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE IF NOT EXISTS `admin_users` (
`id` mediumint(15) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `last_name` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `crypted_password` varchar(500) NOT NULL,
  `email` varchar(200) NOT NULL,
  `user_type_id` mediumint(15) NOT NULL,
  `login_date` datetime NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `first_name`, `last_name`, `username`, `crypted_password`, `email`, `user_type_id`, `login_date`) VALUES
(1, 'ANEESH', 'MOHAN', 'admin', 'e92705f75ec824c3babab6ce7e014910', 'aneesh@techmart.solutions', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(16) NOT NULL DEFAULT '0',
  `user_agent` varchar(50) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`session_id`, `ip_address`, `user_agent`, `last_activity`, `user_data`) VALUES
('b5a48ff833621a8fc2c2c8e4e8316de3', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1455784735, ''),
('cc61507be0a79420b659e5ab80a49d1b', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1455784797, 'a:8:{s:9:"user_data";s:0:"";s:14:"ADMIN_USERNAME";s:5:"admin";s:10:"ADMIN_NAME";s:12:"ANEESH MOHAN";s:12:"ADMIN_USERID";s:1:"1";s:11:"ADMIN_EMAIL";s:25:"aneesh@techmart.solutions";s:12:"USER_TYPE_ID";s:1:"0";s:9:"startDate";s:10:"2010-01-01";s:7:"endDate";s:10:"2016-02-18";}'),
('276a1f18215f2ce85e693adc51565038', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1455785737, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:7:{s:14:"ADMIN_USERNAME";s:5:"admin";s:10:"ADMIN_NAME";s:12:"ANEESH MOHAN";s:12:"ADMIN_USERID";s:1:"1";s:11:"ADMIN_EMAIL";s:25:"aneesh@techmart.solutions";s:12:"USER_TYPE_ID";s:1:"0";s:9:"startDate";s:10:"2010-01-01";s:7:"endDate";s:10:"2016-02-18";}}'),
('8c3ae26ba494acebcf7870c9f793f788', '::1', 'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/53', 1455795171, 'a:2:{s:9:"user_data";s:0:"";s:9:"logged_in";a:7:{s:14:"ADMIN_USERNAME";s:5:"admin";s:10:"ADMIN_NAME";s:12:"ANEESH MOHAN";s:12:"ADMIN_USERID";s:1:"1";s:11:"ADMIN_EMAIL";s:25:"aneesh@techmart.solutions";s:12:"USER_TYPE_ID";s:1:"0";s:9:"startDate";s:10:"2010-01-01";s:7:"endDate";s:10:"2016-02-18";}}');

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
`id` mediumint(15) NOT NULL,
  `name` varchar(200) NOT NULL,
  `logo` varchar(500) NOT NULL,
  `location` varchar(300) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE IF NOT EXISTS `schedules` (
`id` mediumint(15) NOT NULL,
  `programme_name` varchar(400) NOT NULL,
  `company_id` mediumint(15) NOT NULL,
  `track_id` mediumint(15) NOT NULL,
  `starting_time` datetime NOT NULL,
  `ending_time` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tracks`
--

CREATE TABLE IF NOT EXISTS `tracks` (
`id` mediumint(15) NOT NULL,
  `name` varchar(400) NOT NULL,
  `audio_src` varchar(400) NOT NULL,
  `duration` int(15) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`id` mediumint(15) NOT NULL,
  `first_name` varchar(300) NOT NULL,
  `last_name` varchar(300) NOT NULL,
  `username` varchar(300) NOT NULL,
  `password` varchar(400) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `company_id` mediumint(15) NOT NULL,
  `last_login` datetime NOT NULL,
  `logged_out` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `login_status` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ci_sessions`
--
ALTER TABLE `ci_sessions`
 ADD PRIMARY KEY (`session_id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracks`
--
ALTER TABLE `tracks`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
MODIFY `id` mediumint(15) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
MODIFY `id` mediumint(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
MODIFY `id` mediumint(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tracks`
--
ALTER TABLE `tracks`
MODIFY `id` mediumint(15) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `id` mediumint(15) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
