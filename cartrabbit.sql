-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 09, 2021 at 09:41 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cartrabbit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

DROP TABLE IF EXISTS `tbl_booking`;
CREATE TABLE IF NOT EXISTS `tbl_booking` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_workshop_id` int(11) NOT NULL,
  `f_customer_id` int(11) NOT NULL,
  `f_workshop_date` varchar(20) NOT NULL,
  `f_workshop_type` int(10) NOT NULL,
  `f_workshop_booking_at` varchar(15) NOT NULL,
  `f_workshop_status` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`id`, `f_workshop_id`, `f_customer_id`, `f_workshop_date`, `f_workshop_type`, `f_workshop_booking_at`, `f_workshop_status`) VALUES
(34, 1, 1, '2021-07-02', 1, '2021/06/09', 'pending'),
(22, 1, 1, '2021-07-08', 1, '2021/06/09', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_user_name` varchar(55) NOT NULL,
  `f_user_phoneno` varchar(25) NOT NULL,
  `f_user_email` varchar(255) NOT NULL,
  `f_user_password` varchar(55) NOT NULL,
  `f_user_created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `f_user_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`id`, `f_user_name`, `f_user_phoneno`, `f_user_email`, `f_user_password`, `f_user_created_at`, `f_user_updated_at`) VALUES
(1, 'gokul', '8870005705', 'gokultest@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2021-06-08 16:47:53', '2021-06-08 16:47:53');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshop`
--

DROP TABLE IF EXISTS `tbl_workshop`;
CREATE TABLE IF NOT EXISTS `tbl_workshop` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_workshop_name` varchar(55) NOT NULL,
  `f_workshop_phono` varchar(15) NOT NULL,
  `f_workshop_desc` varchar(255) NOT NULL,
  `f_workshop_disc` float NOT NULL,
  `f_workshop_photo` varchar(255) NOT NULL,
  `f_workshop_status` int(2) NOT NULL,
  `f_updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `f_created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp(),
  `f_workshop_email` varchar(155) NOT NULL,
  `f_workshop_password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_workshop`
--

INSERT INTO `tbl_workshop` (`id`, `f_workshop_name`, `f_workshop_phono`, `f_workshop_desc`, `f_workshop_disc`, `f_workshop_photo`, `f_workshop_status`, `f_updated_at`, `f_created_at`, `f_workshop_email`, `f_workshop_password`) VALUES
(1, 'World Service', '8870005705', 'Good Service ', 15, 'image/workshop2.jpg', 1, '2021-06-09 14:34:08', '2021-06-09 14:34:08', 'test@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(2, 'One Service', '8870005705', 'Good Service ', 18, 'image/workshop1.jpg', 1, '2021-06-09 14:34:20', '2021-06-09 14:34:20', 'test1@gmail.com', '25d55ad283aa400af464c76d713c07ad'),
(7, 'Ravi Service Center', '71521043226', 'good service ', 0, 'image/vendor_450_logod5392a17-0afb-4a09-9492-70ca5871c602.jpg', 1, '2021-06-09 14:34:30', '2021-06-09 14:34:30', 'tester@gmail.com', '25f9e794323b453885f5181f1b624d0b');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
