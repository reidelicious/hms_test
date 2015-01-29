-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 29, 2015 at 04:50 PM
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
  `fk_clinic_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_datetime_made`, `announcement_subject`, `announcement_details`, `fk_clinic_id`) VALUES
(1, '2015-01-28 14:37:30', 'lala', 'hehehe', 0),
(23, '2015-01-28 15:50:38', 'kjh', 'kjh', 2),
(24, '2015-01-28 15:51:53', 'admin', 'admin', 0),
(25, '2015-01-29 14:34:46', 'reid hersehl', 'lreeee ippsssuum', 1),
(26, '2015-01-29 14:35:45', 'torayno ka?', 'ryno', 1),
(27, '2015-01-29 14:35:52', 'galanido ka?', 'nideo', 1);

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
  `room_num` varchar(20) NOT NULL,
  PRIMARY KEY (`clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_category`, `room_num`) VALUES
(1, 'Anesthesiologists', 1, 'lb442'),
(2, 'Anesthetic equipment', 1, 'lb132'),
(3, 'Cardiac procedures', 2, 'lb120'),
(4, 'Heart diseases', 2, 'lb152'),
(5, 'BELO', 3, 'lb168'),
(6, 'skin derma', 3, 'lb123'),
(7, 'Adolescence?', 4, 'lb555'),
(8, 'Vaccination?', 4, 'lb900'),
(9, 'uro LAb', 8, 'gb 100');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `contact_num`, `clinic`, `u_id`, `specialization`) VALUES
(1, '123', 2, 3, 1),
(2, '123456', 1, 4, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `medical_specialist`
--

CREATE TABLE IF NOT EXISTS `medical_specialist` (
  `specialist_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `specialist` varchar(45) NOT NULL,
  PRIMARY KEY (`specialist_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `medical_specialist`
--

INSERT INTO `medical_specialist` (`specialist_id`, `specialist`) VALUES
(1, 'Anesthesia'),
(2, ' Cardiology'),
(3, 'Dermatology'),
(4, ' Pediatrics'),
(6, 'Immunology'),
(8, 'Urology');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `p_address`, `p_gender`, `p_age`, `u_id`) VALUES
(1, 'bacayan', 'FEMALE', 20, 1),
(2, '0', '', 0, 2);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `avatar`, `utype`) VALUES
(1, 'zzz123.cb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'christine grace', 'bacatan', 'assets/images/icon-user-default.png', 'USER'),
(2, 'james_naruto2000@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Angel James', 'Torayono', 'assets/images/icon-user-default.png', 'ADMIN'),
(3, 'A@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'ariels', 'angeles', 'assets/images/icon-user-default.png', 'DOCTOR'),
(4, 'B@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bryan', 'Borces', 'assets/images/icon-user-default.png', 'DOCTOR');

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
