-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2014 at 03:13 PM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_datetime_made` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `announcement_subject` varchar(45) NOT NULL,
  `announcement_details` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_datetime_made`, `announcement_subject`, `announcement_details`) VALUES
(4, '2014-11-11 20:51:56', 'sadf', ''),
(5, '2014-11-11 20:54:40', 'fghjk', ''),
(6, '2014-11-11 21:05:29', 'asdf', ''),
(7, '2014-11-22 05:53:06', 'asdf', ''),
(8, '2014-11-22 05:53:45', 'asdf', 'asdfasfasdfasdfasdf'),
(9, '2014-11-22 05:57:11', 'adsf', ''),
(10, '2014-11-22 07:14:33', 'Test', 'nsjfanieng'),
(11, '2014-11-22 07:18:16', 'Test', ''),
(12, '2014-11-22 07:18:21', 'gjhg', ''),
(13, '2014-11-22 07:20:59', 'reid', ''),
(14, '2014-11-22 07:23:18', 'reid', 'rsddsdf'),
(15, '2014-11-22 08:10:20', 'kl', 'kj'),
(16, '2014-11-22 08:12:06', 'kl', 'kj'),
(17, '2014-11-22 08:12:30', 'kl', 'kj'),
(18, '2014-11-22 08:12:48', 'k', 'j'),
(19, '2014-11-22 08:13:07', 'j', 'jj'),
(20, '2014-11-22 08:15:21', 'kjlkljk', 'jj'),
(21, '2014-11-22 08:16:01', 'k', 'j');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `p_id` int(11) NOT NULL AUTO_INCREMENT,
  `p_address` varchar(255) NOT NULL,
  `p_gender` enum('MALE','FEMALE') NOT NULL,
  `p_age` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`p_id`),
  UNIQUE KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `p_address`, `p_gender`, `p_age`, `u_id`) VALUES
(23, 'oh yea baby', 'MALE', 0, 3),
(24, 'Mabolo, Cebu City, 6000 Philippines', 'MALE', 20, 4),
(26, '11', 'MALE', 1, 1),
(28, 'Opon', 'MALE', 30, 8);

-- --------------------------------------------------------

--
-- Table structure for table `temp_users`
--

CREATE TABLE IF NOT EXISTS `temp_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` enum('MALE','FEMALE') NOT NULL,
  `address` varchar(255) NOT NULL,
  `utype` enum('USER','DOCTOR','ADMIN') NOT NULL,
  `key` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `temp_users`
--

INSERT INTO `temp_users` (`id`, `email`, `password`, `fname`, `lname`, `age`, `gender`, `address`, `utype`, `key`) VALUES
(1, 'zzzzzzzzz123.cb@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christine Grace', 'Bacatan', 1, 'FEMALE', '123', 'USER', 'd0d73fcc93c6d535a3f301db13d97aa2'),
(2, 'zz1z123.cb@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Christine Grace', 'Bacatan', 1, 'FEMALE', '1', 'USER', '95a749bc521519cb2e6c52d8ab1f1fdb'),
(3, 'zz11z123.cb@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Christine Grace', 'Bacatan', 1, 'FEMALE', '1', 'USER', 'a62ebe76343ce14f183263e91e15ddad');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT 'assets/images/icon-user-default.png',
  `utype` enum('USER','DOCTOR','ADMIN') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `avatar`, `utype`) VALUES
(1, 'james_naruto2000@yahoo.com', '202cb962ac59075b964b07152d234b70', 'Angel James', 'Torayno', 'assets/images/icon-user-default.png', 'ADMIN'),
(3, 'merricklance@yahoo.com', 'f830f69d23b8224b512a0dc2f5aec974', 'Merrick Lance', 'Noel', 'assets/images/icon-user-default.png', 'USER'),
(4, 'dummyemail@gmail.com', '60da11eb799d6a8da47e5cd6e4aa2273', 'Ernest Cesar', 'Cueva', 'assets/images/icon-user-default.png', 'USER'),
(8, 'zzz123.cb@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Erwin Gail', 'Sarmiento', 'assets/images/icon-user-default.png', 'USER');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
