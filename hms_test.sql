-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 28, 2015 at 07:20 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_datetime_made`, `announcement_subject`, `announcement_details`, `fk_clinic_id`) VALUES
(5, '2015-02-23 06:54:49', 'Admin Making Announcement', 'yeah', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appoint_id`, `date`, `time`, `doctor_id`, `patient_id`, `status`, `message`) VALUES
(8, '2015-03-09', '13:30:00', 1, 1, 'Pending', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_category`, `room_num`) VALUES
(1, 'anesthiss', 1, 'lb445');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `d_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_num` varchar(20) NOT NULL,
  `clinic` int(11) unsigned NOT NULL,
  `u_id` int(11) unsigned NOT NULL,
  `specialization` int(11) unsigned NOT NULL,
  PRIMARY KEY (`d_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `contact_num`, `clinic`, `u_id`, `specialization`) VALUES
(1, '1111', 1, 3, 1);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `d_id`, `date`, `time_start`, `time_end`) VALUES
(33, 1, '2015-03-09', '09:30:00', '13:30:00'),
(34, 1, '2015-03-10', '09:30:00', '12:00:00');

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
  `p_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `p_address` varchar(255) NOT NULL,
  `p_gender` enum('MALE','FEMALE') NOT NULL,
  `p_age` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`p_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `p_address`, `p_gender`, `p_age`, `u_id`) VALUES
(1, 'blabla', 'MALE', 25, 1),
(2, 'blabla', 'MALE', 16, 2);

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
  `timeline` varchar(50) NOT NULL DEFAULT 'bg-teal',
  `utype` enum('USER','DOCTOR','ADMIN') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `avatar`, `timeline`, `utype`) VALUES
(1, 'chung_bobo@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'hemo joshua', 'bobo', 'uploads/Untitled.png', 'bg-crimson', 'USER'),
(2, 'james_naruto2000@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'angel', 'torayno', 'assets/images/icon-user-default.png', 'bg-teal', 'ADMIN'),
(3, 'henoheno@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'heno', 'bobo', 'assets/images/icon-user-default.png', 'bg-pink', 'DOCTOR');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
