-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 07, 2015 at 07:00 AM
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
  `fk_clinic_id` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_datetime_made`, `announcement_subject`, `announcement_details`, `fk_clinic_id`) VALUES
(23, '2015-01-28 15:50:38', 'kjh', 'kjh', 2),
(25, '2015-01-29 14:34:46', 'reid hersehl', 'lreeee ippsssuum', 1),
(26, '2015-01-29 14:35:45', 'torayno ka?', 'ryno', 1),
(27, '2015-01-29 14:35:52', 'galanido ka?', 'nideo', 1),
(28, '2015-01-30 04:53:11', 'Change Schedule', 'change change change', 2);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `appoint_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `status` enum('Pending','Approved','Reject','') NOT NULL,
  `message` varchar(500) DEFAULT NULL COMMENT 'if rejected',
  PRIMARY KEY (`appoint_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appoint_id`, `date`, `time`, `doctor_id`, `patient_id`, `status`, `message`) VALUES
(13, '2015-02-09', '13:00:00', 1, 1, 'Reject', 'sige man ka ug balik2 oy? unsa diay problema nimo???? tubaga ko!'),
(14, '2015-02-09', '09:50:00', 1, 1, 'Approved', NULL),
(15, '2015-02-09', '13:00:00', 1, 1, 'Approved', NULL),
(16, '2015-02-09', '13:00:00', 1, 1, 'Approved', NULL),
(17, '2015-02-09', '09:00:00', 1, 1, 'Approved', NULL),
(19, '2015-02-11', '12:00:00', 2, 1, 'Pending', NULL),
(20, '2015-02-12', '12:59:00', 3, 1, 'Approved', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `contact_num`, `clinic`, `u_id`, `specialization`) VALUES
(1, '123', 2, 3, 1),
(2, '123456', 1, 4, 1),
(3, '09258552005', 2, 5, 2),
(4, '09258552005', 1, 6, 2),
(5, '09258552005', 2, 7, 1),
(6, '09258552005', 2, 8, 2),
(7, '09258552005', 8, 9, 6);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `d_id`, `date`, `time_start`, `time_end`) VALUES
(1, 2, '2015-02-02', '08:00:00', '16:00:00'),
(2, 2, '2015-02-03', '08:00:00', '16:00:00'),
(3, 2, '2015-02-04', '08:00:00', '16:00:00'),
(4, 2, '2015-02-05', '08:00:00', '16:00:00'),
(5, 6, '2015-02-02', '09:00:00', '15:00:00'),
(6, 6, '2015-02-03', '09:00:00', '15:00:00'),
(7, 6, '2015-02-04', '09:00:00', '15:00:00'),
(8, 6, '2015-02-05', '09:00:00', '15:00:00'),
(9, 6, '2015-02-06', '09:00:00', '15:00:00'),
(10, 1, '2015-02-09', '09:00:00', '16:30:00'),
(11, 1, '2015-02-10', '08:30:00', '17:00:00'),
(12, 1, '2015-02-11', '08:30:00', '17:00:00'),
(13, 1, '2015-02-12', '08:30:00', '14:00:00'),
(14, 1, '2015-02-13', '08:30:00', '17:30:00'),
(15, 1, '2015-02-16', '11:00:00', '18:00:00'),
(16, 1, '2015-01-29', '08:00:00', '17:30:00'),
(17, 2, '2015-02-09', '09:00:00', '16:30:00'),
(18, 2, '2015-02-10', '09:00:00', '16:30:00'),
(19, 2, '2015-02-11', '09:00:00', '16:30:00'),
(20, 2, '2015-02-12', '09:00:00', '16:30:00'),
(21, 2, '2015-02-13', '09:00:00', '16:30:00');

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
(1, 'bacayan', 'FEMALE', 21, 1),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `avatar`, `utype`) VALUES
(1, 'zzz123.cb@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Kiko', 'Mizuhara', 'uploads/1456721_512575042215819_2081641341463869525_n.jpg', 'USER'),
(2, 'james_naruto2000@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Angel James', 'Torayono', 'assets/images/icon-user-default.png', 'ADMIN'),
(3, 'A@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'ariels', 'angeles', 'assets/images/icon-user-default.png', 'DOCTOR'),
(4, 'B@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bryan', 'Borces', 'assets/images/icon-user-default.png', 'DOCTOR'),
(5, 'C@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Camille', 'Canete', 'assets/images/icon-user-default.png', 'DOCTOR'),
(6, 'D@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Derek', 'Del Castillo', 'assets/images/icon-user-default.png', 'DOCTOR'),
(7, 'E@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Erik', 'Enriquez', 'assets/images/icon-user-default.png', 'DOCTOR'),
(8, 'F@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Freddy', 'Fabian', 'assets/images/icon-user-default.png', 'DOCTOR'),
(9, 'G@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Glory', 'Giordano', 'assets/images/icon-user-default.png', 'DOCTOR');

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
