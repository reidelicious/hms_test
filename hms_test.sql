-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2015 at 01:50 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hms_test`
--
CREATE DATABASE IF NOT EXISTS `hms_test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `hms_test`;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

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
(21, '2014-11-22 08:16:01', 'k', 'j'),
(22, '2015-01-07 05:54:48', 'hi', 'dinosaur nga torayno'),
(23, '2015-01-07 06:03:15', 'HI', 'NICK'),
(24, '2015-01-07 06:04:44', 'BYE', 'NICK'),
(25, '2015-01-07 06:05:47', 'HOHOHOHO', 'HOHOHOHOHOH'),
(26, '2015-01-07 06:08:15', 'HI', 'HOHOHO');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE IF NOT EXISTS `clinic` (
  `clinic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_name` varchar(45) NOT NULL,
  `clinic_category` int(11) NOT NULL,
  PRIMARY KEY (`clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_category`) VALUES
(1, 'heya', 1),
(6, 'lim', 1),
(7, 'hjkjh', 2),
(8, 'hjkjh', 2);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `d_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_num` varchar(20) NOT NULL,
  `clinic` int(11) unsigned NOT NULL,
  `u_id` int(11) NOT NULL,
  `specialization` int(11) unsigned NOT NULL,
  PRIMARY KEY (`d_id`),
  UNIQUE KEY `u_id` (`u_id`),
  KEY `specialization` (`specialization`),
  KEY `clinic` (`clinic`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `contact_num`, `clinic`, `u_id`, `specialization`) VALUES
(9, '09258552005', 1, 17, 1),
(10, '09258552005', 1, 18, 2),
(11, '123', 1, 19, 2),
(12, '123', 1, 20, 2),
(13, '123', 1, 21, 2),
(14, '123', 1, 22, 2),
(15, '123', 1, 23, 2),
(16, '123', 1, 24, 2),
(17, '123', 1, 25, 2),
(18, '123', 1, 26, 2),
(19, '123', 6, 27, 1),
(20, '123', 6, 28, 1),
(21, '123', 6, 29, 1),
(22, '123', 6, 30, 1),
(23, '123', 6, 31, 1),
(24, '123', 6, 32, 1),
(25, '123', 6, 33, 1),
(26, '123', 6, 34, 1),
(27, '123', 6, 35, 1),
(28, '123', 6, 36, 1),
(29, '123', 6, 37, 1),
(30, '123', 6, 38, 1),
(31, '123', 6, 39, 1),
(32, '123', 6, 40, 1),
(33, '123', 6, 41, 1),
(34, '123', 6, 42, 1),
(35, '123', 6, 43, 1),
(36, '123', 6, 44, 1),
(37, '123', 1, 45, 1),
(38, '123', 1, 46, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedule`
--

CREATE TABLE IF NOT EXISTS `doctor_schedule` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `d_id` int(11) unsigned NOT NULL,
  `date` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `d_id` (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `d_id`, `date`, `time_start`, `time_end`) VALUES
(1, 11, '2015-01-22', '09:30:00', '18:00:00'),
(3, 11, '2015-01-16', '10:00:00', '18:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `medical_specialist`
--

CREATE TABLE IF NOT EXISTS `medical_specialist` (
  `specialist_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `specialist` varchar(45) NOT NULL,
  PRIMARY KEY (`specialist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `medical_specialist`
--

INSERT INTO `medical_specialist` (`specialist_id`, `specialist`) VALUES
(1, 'Cardiologist'),
(2, 'Dermatologist');

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
(28, 'talamban', 'MALE', 89, 8);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `temp_users`
--

INSERT INTO `temp_users` (`id`, `email`, `password`, `fname`, `lname`, `age`, `gender`, `address`, `utype`, `key`) VALUES
(1, 'zzzzzzzzz123.cb@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Christine Grace', 'Bacatan', 1, 'FEMALE', '123', 'USER', 'd0d73fcc93c6d535a3f301db13d97aa2'),
(2, 'zz1z123.cb@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Christine Grace', 'Bacatan', 1, 'FEMALE', '1', 'USER', '95a749bc521519cb2e6c52d8ab1f1fdb'),
(3, 'zz11z123.cb@gmail.com', 'c4ca4238a0b923820dcc509a6f75849b', 'Christine Grace', 'Bacatan', 1, 'FEMALE', '1', 'USER', 'a62ebe76343ce14f183263e91e15ddad'),
(4, 'ivan.torayno@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', '1234', '213', 12, 'MALE', '123', 'USER', 'a59739fb7186aee27289e28189bb2099'),
(5, 'marjhun.galanido@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Marjhun Christopher', 'Galanido', 21, 'MALE', 'Cantagay', 'USER', 'ced5dcb3af7a2497c8d7d419cc18f236');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=47 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `avatar`, `utype`) VALUES
(1, 'james_naruto2000@yahoo.com', '202cb962ac59075b964b07152d234b70', 'Louie', 'Abueva', 'uploads/IMG_20141218_2011241.JPG', 'ADMIN'),
(3, 'merricklance@yahoo.com', 'f830f69d23b8224b512a0dc2f5aec974', 'Merrick Lance', 'Noel', 'assets/images/icon-user-default.png', 'USER'),
(4, 'dummyemail@gmail.com', '60da11eb799d6a8da47e5cd6e4aa2273', 'Ernest Cesar', 'Cueva', 'assets/images/icon-user-default.png', 'USER'),
(8, 'zzz123.cb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'glalaa', 'milk', 'uploads/reid2.jpg', 'USER'),
(9, 'judithfrato@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'bla', 'bla', 'assets/images/red.jpg', 'DOCTOR'),
(10, 'ivan.torayno@yahoo.com', '202cb962ac59075b964b07152d234b70', '11', '11', 'assets/images/icon-user-default.png', 'DOCTOR'),
(11, 'nanana@yahoo.com', '202cb962ac59075b964b07152d234b70', '123', '123', 'assets/images/icon-user-default.png', 'DOCTOR'),
(12, 'blabla@yahoo.com', '202cb962ac59075b964b07152d234b70', '555', '555', 'assets/images/icon-user-default.png', 'DOCTOR'),
(13, 'james_naruto211000@yahoo.com', '202cb962ac59075b964b07152d234b70', '123', '123', 'assets/images/icon-user-default.png', 'DOCTOR'),
(14, 'jaja@yahoo.com', '202cb962ac59075b964b07152d234b70', '123', '123', 'assets/images/icon-user-default.png', 'DOCTOR'),
(15, 'mcgalanido@yahoo.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Marjhun', 'Galanido', 'assets/images/icon-user-default.png', 'DOCTOR'),
(16, 'princess.bermoy@yahoo.com', '202cb962ac59075b964b07152d234b70', 'Princess', 'bermoy', 'assets/images/icon-user-default.png', 'DOCTOR'),
(17, 'toraynogwapo@yahoo.com', '9996535e07258a7bbfd8b132435c5962', 'James', 'Torayno nga dinosaur', 'assets/images/icon-user-default.png', 'DOCTOR'),
(18, 'marjhungwapo@yahoo.com', '9996535e07258a7bbfd8b132435c5962', 'Marjhun', 'Galanido gwapo', 'assets/images/icon-user-default.png', 'DOCTOR'),
(19, 'A@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'A', 'A', 'assets/images/icon-user-default.png', 'DOCTOR'),
(20, 'B@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'B', 'B', 'assets/images/icon-user-default.png', 'DOCTOR'),
(21, 'C@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'C', 'C', 'assets/images/icon-user-default.png', 'DOCTOR'),
(22, 'D@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'D', 'D', 'assets/images/icon-user-default.png', 'DOCTOR'),
(23, 'E@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'E', 'E', 'assets/images/icon-user-default.png', 'DOCTOR'),
(24, 'F@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'F', 'F', 'assets/images/icon-user-default.png', 'DOCTOR'),
(25, 'G@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'G', 'G', 'assets/images/icon-user-default.png', 'DOCTOR'),
(26, 'H@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'H', 'H', 'assets/images/icon-user-default.png', 'DOCTOR'),
(27, 'I@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'I', 'I', 'assets/images/icon-user-default.png', 'DOCTOR'),
(28, 'J@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'J', 'J', 'assets/images/icon-user-default.png', 'DOCTOR'),
(29, 'K@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'K', 'K', 'assets/images/icon-user-default.png', 'DOCTOR'),
(30, 'L@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'L', 'L', 'assets/images/icon-user-default.png', 'DOCTOR'),
(31, 'M@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'M', 'M', 'assets/images/icon-user-default.png', 'DOCTOR'),
(32, 'N@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'N', 'N', 'assets/images/icon-user-default.png', 'DOCTOR'),
(33, 'O@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'O', 'O', 'assets/images/icon-user-default.png', 'DOCTOR'),
(34, 'P@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'P', 'P', 'assets/images/icon-user-default.png', 'DOCTOR'),
(35, 'Q@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Q', 'Q', 'assets/images/icon-user-default.png', 'DOCTOR'),
(36, 'R@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'R', 'R', 'assets/images/icon-user-default.png', 'DOCTOR'),
(37, 'S@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'S', 'S', 'assets/images/icon-user-default.png', 'DOCTOR'),
(38, 'T@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'T', 'T', 'assets/images/icon-user-default.png', 'DOCTOR'),
(39, 'U@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'U', 'U', 'assets/images/icon-user-default.png', 'DOCTOR'),
(40, 'V@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'V', 'V', 'assets/images/icon-user-default.png', 'DOCTOR'),
(41, 'W@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'W', 'W', 'assets/images/icon-user-default.png', 'DOCTOR'),
(42, 'X@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'X', 'X', 'assets/images/icon-user-default.png', 'DOCTOR'),
(43, 'Y@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Y', 'Y', 'assets/images/icon-user-default.png', 'DOCTOR'),
(44, 'Z@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Z', 'Z', 'assets/images/icon-user-default.png', 'DOCTOR'),
(45, 'aa@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'reid', 'angeles', 'assets/images/icon-user-default.png', 'DOCTOR'),
(46, 'aaa@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'angels', 'azalor', 'assets/images/icon-user-default.png', 'DOCTOR');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctors_ibfk_2` FOREIGN KEY (`specialization`) REFERENCES `medical_specialist` (`specialist_id`),
  ADD CONSTRAINT `doctors_ibfk_3` FOREIGN KEY (`clinic`) REFERENCES `clinic` (`clinic_id`);

--
-- Constraints for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD CONSTRAINT `doctor_schedule_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `doctors` (`d_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
