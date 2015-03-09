-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2015 at 03:09 PM
-- Server version: 5.5.32
-- PHP Version: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `das`
--
CREATE DATABASE IF NOT EXISTS `das` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `das`;

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE IF NOT EXISTS `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `announcement_datetime_made` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `announcement_subject` varchar(45) NOT NULL,
  `announcement_details` longtext,
  `fk_clinic_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_clinic_id` (`fk_clinic_id`),
  KEY `fk_clinic_id_2` (`fk_clinic_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `announcement_datetime_made`, `announcement_subject`, `announcement_details`, `fk_clinic_id`) VALUES
(1, '2015-03-07 06:18:41', 'first build', 'ANnouncement''s first build', 1),
(2, '2015-03-07 06:18:59', 'second build', 'second announcement here', 1),
(3, '2015-03-07 13:24:40', 'The system is down', 'Sorry or the inconvenien', 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE IF NOT EXISTS `appointments` (
  `appoint_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `doctor_id` int(11) unsigned NOT NULL,
  `patient_id` int(11) unsigned NOT NULL,
  `status` enum('Pending','Approved','Reject','Cancelled') NOT NULL,
  `message` varchar(500) DEFAULT NULL COMMENT 'if rejected',
  `appointment_made` date NOT NULL,
  PRIMARY KEY (`appoint_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `patient_id` (`patient_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`appoint_id`, `date`, `time`, `doctor_id`, `patient_id`, `status`, `message`, `appointment_made`) VALUES
(1, '2015-03-09', '09:30:00', 1, 7, 'Cancelled', NULL, '2015-03-07'),
(2, '2015-03-09', '09:30:00', 2, 7, 'Cancelled', NULL, '2015-03-07'),
(3, '2015-03-10', '09:30:00', 6, 7, 'Cancelled', NULL, '2015-03-07'),
(4, '2015-03-09', '09:30:00', 6, 6, 'Approved', NULL, '2015-03-07'),
(5, '2015-03-09', '09:30:00', 1, 5, 'Cancelled', NULL, '2015-03-07'),
(6, '2015-03-10', '10:30:00', 1, 5, 'Pending', NULL, '2015-03-07'),
(7, '2015-03-07', '09:00:00', 1, 5, 'Approved', NULL, '2015-03-07'),
(8, '2015-03-11', '10:30:00', 1, 5, 'Pending', NULL, '2015-03-07'),
(9, '2015-03-12', '10:30:00', 1, 5, 'Pending', NULL, '2015-03-07');

-- --------------------------------------------------------

--
-- Table structure for table `clinic`
--

CREATE TABLE IF NOT EXISTS `clinic` (
  `clinic_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `clinic_name` varchar(45) NOT NULL,
  `clinic_category` int(11) unsigned NOT NULL,
  `room_num` varchar(20) NOT NULL,
  PRIMARY KEY (`clinic_id`),
  KEY `clinic_category` (`clinic_category`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `clinic`
--

INSERT INTO `clinic` (`clinic_id`, `clinic_name`, `clinic_category`, `room_num`) VALUES
(1, 'Asdfasdf', 1, 'lb445'),
(2, 'Justice League Satellite', 4, 'LB123'),
(3, 'Batcave', 2, 'LB1234'),
(4, 'Fortress of Solitude', 6, 'LB12345'),
(5, 'Themyscira', 4, 'LB234'),
(6, 'Secret Sanctuary', 8, 'LB098'),
(7, 'Cave', 1, 'LB469');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `d_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `contact_num` varchar(20) NOT NULL,
  `clinic` int(11) unsigned NOT NULL,
  `u_id` int(11) NOT NULL,
  `specialization` int(11) unsigned NOT NULL,
  PRIMARY KEY (`d_id`),
  KEY `specialization` (`specialization`),
  KEY `clinic` (`clinic`),
  KEY `u_id` (`u_id`),
  KEY `u_id_2` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`d_id`, `contact_num`, `clinic`, `u_id`, `specialization`) VALUES
(1, '09258552005', 1, 3, 1),
(2, '09075775917', 1, 5, 2),
(3, '09258552005', 2, 7, 4),
(4, '09258552005', 3, 8, 2),
(5, '09075775917', 5, 9, 4),
(6, '09258552005', 1, 11, 1),
(7, '09258552005', 2, 12, 4),
(8, '09258552005', 2, 13, 4),
(9, '09258552005', 3, 14, 2),
(10, '09258552005', 3, 15, 2),
(11, '09258552005', 5, 16, 4),
(12, '09258552005', 5, 17, 4),
(13, '09258552005', 3, 18, 2),
(14, '09258552005', 3, 19, 2),
(15, '09258552005', 4, 20, 6),
(16, '09258552005', 1, 21, 1),
(17, '09258552005', 5, 22, 4),
(18, '09258552005', 5, 23, 4),
(19, '09258552005', 3, 24, 2),
(20, '09258552005', 3, 25, 2),
(21, '09258552005', 4, 26, 6),
(22, '09258552005', 1, 27, 1),
(23, '09258552005', 1, 28, 1),
(24, '09258552005', 4, 29, 6),
(25, '09258552005', 1, 30, 1),
(26, '09258552005', 3, 31, 2),
(27, '09258552005', 1, 32, 1),
(28, '09258552005', 1, 33, 1),
(29, '09258552005', 5, 34, 4),
(30, '09258552005', 1, 35, 1),
(31, '09258552005', 1, 38, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=73 ;

--
-- Dumping data for table `doctor_schedule`
--

INSERT INTO `doctor_schedule` (`id`, `d_id`, `date`, `time_start`, `time_end`) VALUES
(33, 1, '2015-03-09', '09:30:00', '16:00:00'),
(34, 1, '2015-03-10', '10:30:00', '16:00:00'),
(35, 2, '2015-03-09', '09:30:00', '15:00:00'),
(36, 2, '2015-03-10', '09:30:00', '16:00:00'),
(37, 2, '2015-03-11', '09:30:00', '16:00:00'),
(38, 2, '2015-03-12', '09:30:00', '16:00:00'),
(39, 2, '2015-03-13', '09:30:00', '16:00:00'),
(40, 2, '2015-03-16', '09:30:00', '16:00:00'),
(41, 2, '2015-03-17', '09:30:00', '16:00:00'),
(42, 2, '2015-03-18', '09:30:00', '16:00:00'),
(43, 2, '2015-03-19', '09:30:00', '16:00:00'),
(44, 2, '2015-03-20', '09:30:00', '16:00:00'),
(45, 2, '2015-03-23', '09:30:00', '16:00:00'),
(46, 2, '2015-03-24', '09:30:00', '16:00:00'),
(47, 1, '2015-03-11', '10:30:00', '16:00:00'),
(48, 1, '2015-03-12', '10:30:00', '16:00:00'),
(49, 1, '2015-03-13', '10:30:00', '15:00:00'),
(50, 1, '2015-03-16', '10:00:00', '15:30:00'),
(51, 1, '2015-03-17', '10:00:00', '15:30:00'),
(52, 1, '2015-03-18', '10:00:00', '15:30:00'),
(53, 1, '2015-03-19', '10:00:00', '15:30:00'),
(54, 1, '2015-03-20', '10:00:00', '15:30:00'),
(55, 1, '2015-03-23', '10:00:00', '15:30:00'),
(56, 1, '2015-03-24', '10:00:00', '15:30:00'),
(57, 1, '2015-03-25', '10:00:00', '15:30:00'),
(58, 1, '2015-03-26', '10:00:00', '15:30:00'),
(59, 1, '2015-03-27', '09:30:00', '16:00:00'),
(60, 1, '2015-03-30', '09:30:00', '16:00:00'),
(61, 1, '2015-03-31', '09:30:00', '16:00:00'),
(62, 6, '2015-03-09', '09:30:00', '15:00:00'),
(63, 6, '2015-03-10', '09:30:00', '15:00:00'),
(64, 6, '2015-03-11', '09:30:00', '15:00:00'),
(65, 6, '2015-03-12', '09:30:00', '15:00:00'),
(66, 6, '2015-03-13', '09:30:00', '15:00:00'),
(67, 6, '2015-03-16', '09:30:00', '13:30:00'),
(68, 6, '2015-03-17', '09:30:00', '15:00:00'),
(69, 6, '2015-03-18', '09:30:00', '15:00:00'),
(70, 6, '2015-03-19', '09:30:00', '15:00:00'),
(71, 6, '2015-03-20', '09:30:00', '15:00:00'),
(72, 1, '2015-03-07', '09:00:00', '18:00:00');

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
  PRIMARY KEY (`p_id`),
  KEY `u_id` (`u_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `p_address`, `p_gender`, `p_age`, `u_id`) VALUES
(1, 'blabla', 'FEMALE', 25, 1),
(2, 'blabla', 'MALE', 16, 2),
(4, 'Nasipit Talamban Cebu City', 'FEMALE', 20, 6),
(5, 'New York', '', 26, 10),
(6, 'Lapu-lapu', 'MALE', 21, 36),
(7, 'Talamban Cebu City', 'MALE', 20, 37);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `temp_users`
--

INSERT INTO `temp_users` (`id`, `email`, `password`, `fname`, `lname`, `age`, `gender`, `address`, `utype`, `key`) VALUES
(2, 'glamburst04@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ma. Princess', 'Bermoy', 21, 'FEMALE', 'Tagbilaran City', 'USER', '819288b6a8b37dbaac17f5bed9861231'),
(3, 'conradogeromojr@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Conrado', 'Geromo', 20, 'MALE', 'Canjulao Jagna, Bohol', 'USER', '239fc2dc91061bfdf6962fc21f0e841e'),
(5, 'louieabueva@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Louie', 'Abueva', 21, 'MALE', 'Mabolo', 'USER', '0d4ff0ff6cdc88856bff17a49b1c753e'),
(6, 'louieabueva@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Louie', 'Abueva', 21, 'MALE', 'Mabolo', 'USER', '1d6676b18c4b4e23831caf03ef865cfe'),
(7, 'louieabueva@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'Louie', 'Abueva', 21, 'MALE', 'Mabolo', 'USER', '4543e0e5f31220b549865b411ebca0fb');

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
  `timeline` varchar(50) NOT NULL DEFAULT 'bg-cyan',
  `utype` enum('USER','DOCTOR','ADMIN') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `fname`, `lname`, `avatar`, `timeline`, `utype`) VALUES
(1, 'chung_bobo@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Heno', 'Joshua', 'uploads/10590693_512575072215816_3272211137704235041_n.jpg', 'bg-crimson', 'USER'),
(2, 'admin@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Admin', 'uploads/1513831_512575075549149_352118089383852098_n.jpg', 'bg-teal', 'ADMIN'),
(3, 'henoheno@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vilma', 'Entero', 'uploads/1466218_512575122215811_5538023964208549600_n.jpg', 'bg-black', 'DOCTOR'),
(5, 'princess.bermoy@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ma Princess', 'Bermoy', 'uploads/10944205_1388558924784435_913281954_o.jpg', 'bg-teal', 'DOCTOR'),
(6, 'jenelle1894@gmail.com', 'fcea920f7412b5da7be0cf42b8c93759', 'Jenelle', 'Casanas', 'assets/images/icon-user-default.png', 'bg-pink', 'USER'),
(7, 'clark.kent@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Clark', 'Kent', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(8, 'bruce.wayne@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bruce', 'Wayne', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(9, 'princess.diana@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Princess', 'Diana', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(10, 'peter.parker@yahoo.com', 'c33367701511b4f6020ec61ded352059', 'Peter Spiderman', 'Parker', 'uploads/1366x768_undead_dragon.jpg', 'bg-lime', 'USER'),
(11, 'AAA@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Adrian', 'Angeles', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(12, 'BBB@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Bryan', 'Borces', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(13, 'CCC@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Carlos', 'Canete', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(14, 'DDD@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Dave', 'Dy', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(15, 'EEE@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Edward', 'Enriquez', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(16, 'FFF@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ford', 'Flores', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(17, 'GGG@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Georgie', 'Greyson', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(18, 'HHH@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Henry', 'Huang', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(19, 'III@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ivy', 'Ibarra', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(20, 'JJJ@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Jay', 'Jorge', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(21, 'KKK@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Karen', 'Khu', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(22, 'LLL@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Lorenzo', 'Lim', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(23, 'MMM@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Mary', 'Munoz', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(24, 'NNN@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Noel', 'Nunez', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(25, 'OOO@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Oliver', 'Ortega', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(26, 'PPP@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Peter', 'Perez', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(27, 'QQQ@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Quennie', 'Quara', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(28, 'RRR@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ronald', 'Reid', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(29, 'SSS@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Sachiko', 'Suarez', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(30, 'TTT@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Tom', 'Torilla', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(31, 'UUU@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ultear', 'Urgello', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(32, 'VVV@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Vince', 'Valencia', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(33, 'WWW@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Wickle', 'Winston', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(34, 'YYY@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Ycha', 'Yu', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(35, 'ZZZ@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Zack', 'Zorro', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR'),
(36, 'james_naruto2000@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Angel James', 'Torayno', 'assets/images/icon-user-default.png', 'bg-cyan', 'USER'),
(37, 'marjhun.galanido@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'Marjhun Christopher', 'Galanido', 'assets/images/icon-user-default.png', 'bg-cyan', 'USER'),
(38, 'reideliciouss@yahoo.com', 'e10adc3949ba59abbe56e057f20f883e', 'angel', 'torayno', 'assets/images/icon-user-default.png', 'bg-cyan', 'DOCTOR');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`p_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`d_id`);

--
-- Constraints for table `clinic`
--
ALTER TABLE `clinic`
  ADD CONSTRAINT `clinic_ibfk_1` FOREIGN KEY (`clinic_category`) REFERENCES `medical_specialist` (`specialist_id`);

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`specialization`) REFERENCES `medical_specialist` (`specialist_id`),
  ADD CONSTRAINT `doctors_ibfk_3` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `doctors_ibfk_4` FOREIGN KEY (`clinic`) REFERENCES `clinic` (`clinic_id`);

--
-- Constraints for table `doctor_schedule`
--
ALTER TABLE `doctor_schedule`
  ADD CONSTRAINT `doctor_schedule_ibfk_1` FOREIGN KEY (`d_id`) REFERENCES `doctors` (`d_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
