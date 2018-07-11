-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2017 at 03:52 PM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `asid_coperative`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `idnumber` int(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `sex` enum('male','female') NOT NULL,
  `address` varchar(255) NOT NULL,
  `position` enum('1','2') NOT NULL,
  `profile` varchar(255) NOT NULL DEFAULT '../images/user.png',
  `regdate` datetime DEFAULT NULL,
  `status` enum('0','1') NOT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `privilege` enum('1','2') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `fname`, `lname`, `username`, `password`, `idnumber`, `email`, `phone`, `sex`, `address`, `position`, `profile`, `regdate`, `status`, `lastlogin`, `privilege`) VALUES
(4, 'nkubito', 'josy', 'nkubito', '60c5aa8226f8a4abd735478559ce8d50', 14444444, 'nkubito1@gmail.com', '0784348958', 'female', '', '1', './uploaded/20161230/depositphotos_10676348-stock-photo-cute-baby-boy-laughing.jpg', '2016-11-23 14:49:15', '1', '2017-01-24 15:22:56', '1'),
(5, 'gabin', 'Mbishinzemungu', 'gabin', 'a379cad412bc22a5ff16ab616563d2a6', 2147483647, 'gabin@gmail.com', '0788987899', 'male', '', '1', './uploaded/20161202/air_max.JPG', '2016-11-23 15:07:46', '1', '2016-12-02 12:58:43', '1'),
(6, 'frank', 'rugamba', 'frank', 'f4268dc08fcb6964e774a189f8cef8fc', 47899999, 'rugamba@gmail.com', '0789654231', 'male', '', '1', '../images/user.png', '2016-11-28 16:20:45', '1', '2016-12-28 12:56:44', '2'),
(7, 'adeline', 'nibagwire', 'adezo', '25f9e794323b453885f5181f1b624d0b', 2147483647, 'adezo@gmail.com', '078556165155', 'female', '', '1', '../images/user.png', '2016-11-28 16:10:08', '0', '0000-00-00 00:00:00', '2'),
(8, 'ines', 'ineza', 'inesyi', '25f9e794323b453885f5181f1b624d0b', 2147483647, 'ines@yahoo.fr', '075156156156', 'female', '', '1', '../images/user.png', '2016-11-28 16:11:17', '0', '0000-00-00 00:00:00', '2'),
(9, 'john', 'kagabo', 'john01', '25f9e794323b453885f5181f1b624d0b', 2147483647, 'john@hotmail.com', '0756165665', 'male', '', '1', '../images/user.png', '2016-11-28 16:12:27', '0', '0000-00-00 00:00:00', '1'),
(10, 'gaustave', 'iragaba', 'gust02', '25f9e794323b453885f5181f1b624d0b', 2147483647, 'gust@yahoo.fr', '0724858889', 'male', '', '1', '../images/user.png', '2016-11-28 16:16:52', '1', '0000-00-00 00:00:00', '1'),
(11, 'thierry', 'Dusabiringabo', 'thierry', '47855982090ed2a9c1e33bb597be5b6e', 2147483647, 'thierrry@gmail.com', '0785694214', 'male', '', '1', '../images/user.png', '2016-12-02 12:44:41', '1', '2016-12-28 13:17:06', '1'),
(12, 'the boss', 'the boss', 'theboss', 'b248e08d5c23541514558eea059c08cf', 1963, 'theboss@yahoo.fr', '0788654348', 'male', 'kibagabaga', '2', 'admin no profile now', '2016-12-23 10:35:53', '0', '0000-00-00 00:00:00', '1'),
(13, 'cyuzuzo', 'lc', 'cyuzuzo', 'ea202cd7ec483095ba0ee6cdbe966fec', 2147483647, 'cyuzulc@gmail.com', '0785452552', 'male', '', '1', '../images/user.png', '2016-12-30 09:16:57', '0', NULL, '1'),
(14, 'cyuzuzo', 'lc', 'cyuzuzo', 'ea202cd7ec483095ba0ee6cdbe966fec', 2147483647, 'cyuzu@gmail.com', '0785456987', 'male', '', '1', '../images/user.png', '2016-12-30 09:19:04', '0', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `budget`
--

CREATE TABLE IF NOT EXISTS `budget` (
  `id` int(11) NOT NULL,
  `budgetname` varchar(30) NOT NULL,
  `budgetamount` int(11) NOT NULL,
  `budgetexpense` int(11) NOT NULL,
  `budgetremaining` int(11) NOT NULL,
  `budgetyear` varchar(20) NOT NULL,
  `budgetmonth` varchar(50) NOT NULL,
  `serializeddata` text NOT NULL,
  `addedby` int(11) NOT NULL,
  `addedon` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budget`
--

INSERT INTO `budget` (`id`, `budgetname`, `budgetamount`, `budgetexpense`, `budgetremaining`, `budgetyear`, `budgetmonth`, `serializeddata`, `addedby`, `addedon`) VALUES
(1, 'transport', 15000, 5700, 9300, '2017', '01', 'a:2:{i:0;s:58:"nkubito1@gmail.com,1200,transport fees,2017-01-21 17:54:22";i:1;s:58:"nkubito1@gmail.com,4500,transport fees,2017-01-21 18:00:53";}', 4, '2017-01-21 18:00:53'),
(2, 'electricity', 20000, 0, 20000, '2017', '01', '', 4, '2017-01-21 17:50:59'),
(3, 'restauration', 0, 0, 0, '2017', '01', '', 4, '2017-01-21 19:12:20');

-- --------------------------------------------------------

--
-- Table structure for table `capital`
--

CREATE TABLE IF NOT EXISTS `capital` (
  `id` int(11) NOT NULL,
  `capitalamount` int(11) NOT NULL,
  `amout` int(11) NOT NULL,
  `adddate` datetime NOT NULL,
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `capital`
--

INSERT INTO `capital` (`id`, `capitalamount`, `amout`, `adddate`, `adminid`) VALUES
(1, 10000, 10000, '2017-01-21 17:09:57', 4),
(2, 12000, 2000, '2017-01-21 17:10:04', 4),
(3, 22000, 10000, '2017-01-21 17:10:10', 4),
(4, 27000, 5000, '2017-01-21 17:10:15', 4),
(5, 37000, 10000, '2017-01-21 17:10:21', 4),
(6, 47000, 10000, '2017-01-21 17:10:27', 4),
(7, 57000, 10000, '2017-01-21 17:10:47', 4),
(8, 64000, 7000, '2017-01-21 17:10:58', 4),
(9, 54000, -10000, '2017-01-21 17:50:13', 4),
(10, 39000, -15000, '2017-01-21 17:50:41', 4),
(11, 19000, -20000, '2017-01-21 17:50:58', 4),
(12, 4000, -15000, '2017-01-21 19:12:20', 4),
(13, 19000, 15000, '2017-01-21 19:13:27', 4),
(14, 27000, 8000, '2017-01-21 20:00:54', 4),
(15, 32400, 5400, '2017-01-21 20:01:18', 4);

-- --------------------------------------------------------

--
-- Table structure for table `contribution201701`
--

CREATE TABLE IF NOT EXISTS `contribution201701` (
  `id` int(11) NOT NULL,
  `contributorid` varchar(255) NOT NULL,
  `month` varchar(25) NOT NULL,
  `year` varchar(25) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `serializationdata` text NOT NULL,
  `deadline` datetime NOT NULL,
  `payeddate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contribution201701`
--

INSERT INTO `contribution201701` (`id`, `contributorid`, `month`, `year`, `amount`, `total`, `remaining`, `serializationdata`, `deadline`, `payeddate`) VALUES
(1, '1', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(2, '2', '01', '2017', 10000, 10000, 0, 'a:1:{i:0;s:44:"nkubito1@gmail.com,10000,2017-01-21 17:10:47";}', '2017-01-31 00:00:00', '2017-01-21 17:10:47'),
(3, '3', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(4, '4', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(5, '5', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(6, '6', '01', '2017', 7000, 10000, 3000, 'a:1:{i:0;s:43:"nkubito1@gmail.com,7000,2017-01-21 17:10:58";}', '2017-01-31 00:00:00', '2017-01-21 17:10:58'),
(7, '7', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(8, '8', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(9, '9', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(10, '10', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(11, '11', '01', '2017', 10000, 10000, 0, 'a:1:{i:0;s:44:"nkubito1@gmail.com,10000,2017-01-21 17:10:20";}', '2017-01-31 00:00:00', '2017-01-21 17:10:20'),
(12, '12', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(13, '13', '01', '2017', 5000, 10000, 5000, 'a:1:{i:0;s:43:"nkubito1@gmail.com,5000,2017-01-21 17:10:15";}', '2017-01-31 00:00:00', '2017-01-21 17:10:15'),
(14, '14', '01', '2017', 10000, 10000, 0, 'a:1:{i:0;s:44:"nkubito1@gmail.com,10000,2017-01-21 17:10:10";}', '2017-01-31 00:00:00', '2017-01-21 17:10:10'),
(15, '15', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(16, '16', '01', '2017', 10000, 10000, 0, 'a:1:{i:0;s:44:"nkubito1@gmail.com,10000,2017-01-21 17:10:27";}', '2017-01-31 00:00:00', '2017-01-21 17:10:27'),
(17, '17', '01', '2017', 10000, 10000, 0, 'a:2:{i:0;s:43:"nkubito1@gmail.com,2000,2017-01-21 17:10:04";i:1;s:43:"nkubito1@gmail.com,8000,2017-01-21 20:00:53";}', '2017-01-31 00:00:00', '2017-01-21 20:00:53'),
(18, '18', '01', '2017', 0, 10000, 10000, '', '2017-01-31 00:00:00', '0000-00-00 00:00:00'),
(19, '19', '01', '2017', 10000, 10000, 0, 'a:1:{i:0;s:44:"nkubito1@gmail.com,10000,2017-01-21 17:09:57";}', '2017-01-31 00:00:00', '2017-01-21 17:09:57');

-- --------------------------------------------------------

--
-- Table structure for table `contribution201702`
--

CREATE TABLE IF NOT EXISTS `contribution201702` (
  `id` int(11) NOT NULL,
  `contributorid` varchar(255) NOT NULL,
  `month` varchar(25) NOT NULL,
  `year` varchar(25) NOT NULL,
  `amount` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `remaining` int(11) NOT NULL,
  `serializationdata` text NOT NULL,
  `deadline` datetime NOT NULL,
  `payeddate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contribution201702`
--

INSERT INTO `contribution201702` (`id`, `contributorid`, `month`, `year`, `amount`, `total`, `remaining`, `serializationdata`, `deadline`, `payeddate`) VALUES
(1, '1', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(2, '2', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(3, '3', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(4, '4', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(5, '5', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(6, '6', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(7, '7', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(8, '8', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(9, '9', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(10, '10', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(11, '11', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(12, '12', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(13, '13', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(14, '14', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(15, '15', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(16, '16', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(17, '17', '02', '2017', 5400, 5400, 0, 'a:1:{i:0;s:43:"nkubito1@gmail.com,5400,2017-01-21 20:01:18";}', '2017-02-28 00:00:00', '2017-01-21 20:01:18'),
(18, '18', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00'),
(19, '19', '02', '2017', 0, 5400, 5400, '', '2017-02-28 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

CREATE TABLE IF NOT EXISTS `house` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `responsable` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `type` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `location` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `serialdata` longtext NOT NULL,
  `addon` datetime NOT NULL,
  `addby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`id`, `name`, `responsable`, `phone`, `type`, `payment`, `location`, `description`, `status`, `serialdata`, `addon`, `addby`) VALUES
(1, 'white house', 'alan', '0785469324', 3, 180000, 'kimironko', 'our first house', 1, '', '2017-01-24 15:43:09', 4);

-- --------------------------------------------------------

--
-- Table structure for table `imports201612`
--

CREATE TABLE IF NOT EXISTS `imports201612` (
  `id` int(11) NOT NULL,
  `userkey` varchar(255) NOT NULL,
  `context` varchar(25) NOT NULL,
  `import` longtext,
  `import_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imports201612`
--

INSERT INTO `imports201612` (`id`, `userkey`, `context`, `import`, `import_date`) VALUES
(1, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:9:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:9:"Id Number";i:4;s:3:"Sex";i:5;s:7:"Country";i:6;s:3:"Dob";i:7;s:10:"Crime date";i:8;s:10:"Crime type";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:9:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:9:"Id Number";i:4;s:3:"Sex";i:5;s:7:"Country";i:6;s:3:"Dob";i:7;s:10:"Crime date";i:8;s:10:"Crime type";}}}}', '2016-12-26 22:01:08'),
(2, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:06:27'),
(3, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:9:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:9:"Id Number";i:4;s:3:"Sex";i:5;s:7:"Country";i:6;s:3:"Dob";i:7;s:10:"Crime date";i:8;s:10:"Crime type";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:9:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:9:"Id Number";i:4;s:3:"Sex";i:5;s:7:"Country";i:6;s:3:"Dob";i:7;s:10:"Crime date";i:8;s:10:"Crime type";}}}}', '2016-12-26 22:13:07'),
(4, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:11:"Individuals";s:4:"rows";a:14:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}i:1;a:6:{i:0;s:1:"1";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:2;a:6:{i:0;s:1:"2";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:3;a:6:{i:0;s:1:"3";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:4;a:6:{i:0;s:1:"4";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:5;a:6:{i:0;s:1:"5";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:6;a:6:{i:0;s:1:"6";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:7;a:6:{i:0;s:1:"7";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:8;a:6:{i:0;s:1:"8";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:9;a:6:{i:0;s:1:"9";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:10;a:6:{i:0;s:2:"10";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:11;a:6:{i:0;s:2:"11";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:12;a:6:{i:0;s:2:"12";i:1;s:0:"";i:2;s:6:"198498";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}i:13;a:6:{i:0;s:2:"13";i:1;s:0:"";i:2;s:8:"13215161";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:14:28'),
(5, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:17:37'),
(6, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:20:25'),
(7, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:11:"Individuals";s:4:"rows";a:14:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}i:1;a:8:{i:0;s:1:"1";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:2;a:8:{i:0;s:1:"2";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:3;a:8:{i:0;s:1:"3";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:4;a:8:{i:0;s:1:"4";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:5;a:8:{i:0;s:1:"5";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:6;a:8:{i:0;s:1:"6";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:7;a:8:{i:0;s:1:"7";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:8;a:8:{i:0;s:1:"8";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:9;a:8:{i:0;s:1:"9";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:10;a:8:{i:0;s:2:"10";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:11;a:8:{i:0;s:2:"11";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:12;a:8:{i:0;s:2:"12";i:1;s:0:"";i:2;s:6:"198498";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:13;a:8:{i:0;s:2:"13";i:1;s:0:"";i:2;s:8:"13215161";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:20:38'),
(8, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:21:54'),
(9, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:22:31'),
(10, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:26:13'),
(11, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:29:29'),
(12, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:31:00'),
(13, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-26 22:33:49'),
(14, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-29 20:23:05'),
(15, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:11:"Individuals";s:4:"rows";a:14:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}i:1;a:8:{i:0;s:1:"1";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:2;a:8:{i:0;s:1:"2";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:3;a:8:{i:0;s:1:"3";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:4;a:8:{i:0;s:1:"4";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:5;a:8:{i:0;s:1:"5";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:6;a:8:{i:0;s:1:"6";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:7;a:8:{i:0;s:1:"7";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:8;a:8:{i:0;s:1:"8";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:9;a:8:{i:0;s:1:"9";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:10;a:8:{i:0;s:2:"10";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:11;a:8:{i:0;s:2:"11";i:1;s:0:"";i:2;s:10:"2147483647";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:12;a:8:{i:0;s:2:"12";i:1;s:0:"";i:2;s:6:"198498";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}i:13;a:8:{i:0;s:2:"13";i:1;s:0:"";i:2;s:8:"13215161";i:3;s:0:"";i:4;s:0:"";i:5;s:0:"";i:6;s:0:"";i:7;i:0;}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2016-12-30 08:49:04');

-- --------------------------------------------------------

--
-- Table structure for table `imports201701`
--

CREATE TABLE IF NOT EXISTS `imports201701` (
  `id` int(11) NOT NULL,
  `userkey` varchar(255) NOT NULL,
  `context` varchar(25) NOT NULL,
  `import` longtext,
  `import_date` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `imports201701`
--

INSERT INTO `imports201701` (`id`, `userkey`, `context`, `import`, `import_date`) VALUES
(1, '', 'registration', 'a:2:{i:0;a:2:{s:5:"sheet";s:7:"Members";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}i:1;a:2:{s:5:"sheet";s:9:"Worksheet";s:4:"rows";a:1:{i:0;a:7:{i:0;s:2:"No";i:1;s:10:"First Name";i:2;s:9:"Last Name";i:3;s:3:"Sex";i:4;s:5:"phone";i:5;s:5:"email";i:6;s:8:"username";}}}}', '2017-01-05 11:46:06');

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE IF NOT EXISTS `incomes` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `numberof` int(11) NOT NULL,
  `addedby` int(11) NOT NULL,
  `addedon` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `name`, `numberof`, `addedby`, `addedon`) VALUES
(1, 'house', 1, 4, '2017-01-24 15:41:20'),
(2, 'magazine', 1, 4, '2017-01-24 15:43:34');

-- --------------------------------------------------------

--
-- Table structure for table `interest`
--

CREATE TABLE IF NOT EXISTS `interest` (
  `id` int(11) NOT NULL,
  `interest` int(11) NOT NULL,
  `adddate` datetime NOT NULL,
  `adminid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `interest`
--

INSERT INTO `interest` (`id`, `interest`, `adddate`, `adminid`) VALUES
(1, 30, '2017-01-12 00:00:00', 1),
(2, 15, '2017-01-12 13:37:55', 4),
(3, 25, '2017-01-12 13:38:24', 4),
(4, 15, '2017-01-12 16:23:01', 4),
(5, 30, '2017-01-21 09:55:21', 4);

-- --------------------------------------------------------

--
-- Table structure for table `magazine`
--

CREATE TABLE IF NOT EXISTS `magazine` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `responsable` varchar(25) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `type` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `location` varchar(25) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `serialdata` longtext NOT NULL,
  `addon` datetime NOT NULL,
  `addby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `magazine`
--

INSERT INTO `magazine` (`id`, `name`, `responsable`, `phone`, `type`, `payment`, `location`, `description`, `status`, `serialdata`, `addon`, `addby`) VALUES
(1, 'chez ngabo', 'ngabo', '0745896574', 1, 20000, 'nyabugogo', 'first magazine', 1, '', '2017-01-24 15:44:46', 4);

-- --------------------------------------------------------

--
-- Table structure for table `markets`
--

CREATE TABLE IF NOT EXISTS `markets` (
  `id` int(11) NOT NULL,
  `place` varchar(255) NOT NULL,
  `serialdata` text NOT NULL,
  `addby` varchar(255) NOT NULL,
  `addeddate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `contact` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `postaddress` varchar(255) NOT NULL,
  `nationalid` int(11) NOT NULL,
  `payment` int(11) NOT NULL,
  `admittedyear` date NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL,
  `profile` varchar(255) NOT NULL,
  `addedby` int(11) NOT NULL,
  `addedon` datetime NOT NULL,
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `fname`, `lname`, `sex`, `birthday`, `contact`, `email`, `postaddress`, `nationalid`, `payment`, `admittedyear`, `username`, `password`, `status`, `profile`, `addedby`, `addedon`, `lastlogin`) VALUES
(1, 'John', 'MUHIZI', 'male', '1990-05-10', '+250785434895', 'muhizi@gmail.com', 'kimironko', 45454778, 12000, '2016-12-16', 'john', '8cdfc07f76f33a10321083519005ef26', '1', './uploaded/20161202/air_max.jpg', 4, '2016-12-08 03:54:31', '2016-12-30 13:19:28'),
(2, 'Diane', 'Umurerwa Wase', 'female', '1989-07-13', '+250782457996', 'umurerwa@gmail.com', 'Remera', 2147483647, 10000, '2015-02-19', 'diane', 'dianetest', '1', './uploaded/20161202/00-OPENER-10.25-1.jpg', 1, '2016-12-08 03:11:54', '0000-00-00 00:00:00'),
(3, 'Janvièr', 'Kanamugire', 'male', '1989-08-17', '0789665555', 'kanamugire@gmail.com', 'gikondo', 2147483647, 14000, '2016-11-24', '', '', '0', './uploaded/20161202/xmulford_chuck_profile.jpg.pagespeed.ic.BrKpOe4a3L.jpg', 1, '2016-12-08 03:14:32', '0000-00-00 00:00:00'),
(4, 'William Peter', 'RAMBA', 'male', '1990-07-25', '+250786365447', 'ramba@yahoo.fr', 'Kibagabaga', 2147483647, 19000, '2013-12-27', '', '', '1', './uploaded/20161202/7dda31cf8ec24bafd2265905d4f5c9fb.jpg', 1, '2016-12-08 03:44:03', '0000-00-00 00:00:00'),
(5, 'James', 'Kabanda', 'male', '1989-09-26', '+250785423694', 'kabanda@gmail.com', 'Remera', 2147483647, 22000, '2012-11-23', '', '', '1', './uploaded/20161202/877c91765d053216e078aeccce33b903.jpg', 1, '2016-12-08 03:22:40', '0000-00-00 00:00:00'),
(6, 'Clarisse Clara', 'Munezero', 'male', '1989-09-06', '+250728966335', 'clarisse@gmail.com', 'Kanombe', 2147483647, 15000, '2013-08-30', '', '', '0', './uploaded/20161202/1138.jpg', 1, '2016-12-08 03:24:04', '0000-00-00 00:00:00'),
(7, 'Freddy', 'Rugwiro gasana', 'male', '1990-02-08', '+250785569966', 'rugwiro@gmail.com', 'Kanombe', 2147483647, 15000, '2015-11-19', '', '', '1', './uploaded/20161202/149773_390965360990866_1252934591_n.jpg', 1, '2016-12-08 03:26:00', '0000-00-00 00:00:00'),
(8, 'Emmanuel', 'Rubangura', 'male', '1979-07-04', '+250789965555', 'emmanuel@gmail.com', 'Gikondo', 2147483647, 15000, '2010-07-29', '', '', '1', './uploaded/20161202/Cute-baby-boy-pics-for-facebook-profile-5-1024x768.jpg', 1, '2016-12-08 03:28:34', '0000-00-00 00:00:00'),
(9, 'Joanna', 'Ngarambe', 'female', '1992-07-22', '+250789665545', 'joannanga@yahoo.fr', 'Kimironko', 2147483647, 12000, '2015-11-27', '', '', '1', './uploaded/20161202/depositphotos_10676348-stock-photo-cute-baby-boy-laughing.jpg', 1, '2016-12-08 03:30:18', '0000-00-00 00:00:00'),
(10, 'Gisèle Nan', 'Munana', 'male', '1992-07-15', '+250736987455', 'munana@gmail.com', 'Gikondo', 2147483647, 12000, '2015-02-04', '', '', '0', './uploaded/20161202/facebook-profile-picture-baby-pic-avatar.jpg', 1, '2016-12-08 03:31:48', '0000-00-00 00:00:00'),
(11, 'Jeannette Jules', 'Umwali', 'male', '1989-05-18', '+250789663321', 'umwali@gmail.com', 'Kibagabaga', 2147483647, 13000, '2015-11-19', '', '', '1', './uploaded/20161202/profile_01401868635.jpg', 1, '2016-12-08 03:42:16', '0000-00-00 00:00:00'),
(12, 'Rosine', 'Abizeye', 'female', '1989-05-01', '+250789665222', 'abizeye@gmail.com', 'Kacyiru', 2147483647, 10000, '2014-08-29', '', '', '1', './uploaded/20161202/itm_beautiful-cute-babies-pictures-for-display-profile2013-05-02_04-09-58_1.jpg', 1, '2016-12-08 03:44:09', '0000-00-00 00:00:00'),
(13, 'Umunoza', 'Gisèle', 'male', '0000-00-00', '07854632147', 'giselumu@gmail.com', '', 2147483647, 0, '1992-12-24', 'giseleumu', 'f2918c3f5c0ec6f59ae612aef061edca', '1', './uploaded/20161202/1138.jpg', 1, '2016-12-10 03:37:14', '2017-01-12 10:44:38'),
(14, 'Umulisa', 'Diane', 'male', '2015-07-16', '0785632148', 'umulisa@yahoo.fr', '', 2147483647, 0, '1989-04-21', 'umulisa', '8cdfc07f76f33a10321083519005ef26', '0', './uploaded/20161202/jamer_hunt_profile.jpg', 12345, '2016-12-10 03:40:16', '2017-01-16 09:22:35'),
(15, 'Adeline', 'Nibagwire', 'female', '1993-03-05', '+250785462315', 'adeline@gmail.com', 'Remera', 2147483647, 0, '1991-11-10', 'adeline', '4288dd661cd59b228ec02b4561564ee7', '1', './uploaded/20161202/profile-pic-for-fb-57400.jpg', 4, '2016-12-18 23:14:21', '2017-01-13 10:53:56'),
(16, 'Rosette', 'Usanase', 'female', '1993-11-25', '+250785697412', 'usanase@yahoo.fr', 'Kimihurura', 2147483647, 0, '2014-05-26', 'rosette', '3d2f04c4d21bea749945f302c905f3b9', '1', './uploaded/20161202/student-profile-simone-bianchi-piantini.jpg', 4, '2016-12-18 23:20:09', '2017-01-12 10:48:57'),
(17, 'peter', 'lc', 'male', '0000-00-00', '087984894156', 'zudanga@gmail.com', '', 1519818999, 0, '0000-00-00', 'peter', '25f9e794323b453885f5181f1b624d0b', '1', './uploaded/20161202/user.png', 12345, '2016-12-21 00:01:08', '2017-01-21 17:47:35'),
(18, 'Ariane', 'Nayituliki', 'female', '1991-12-02', '+250785466633', 'ariane@gmail.com', 'Muhima', 2147483647, 0, '2016-02-05', 'ariane', 'bfeb6e26bbc796b74d66dfae669d458a', '1', './uploaded/20161202/user.png', 4, '2016-12-29 20:53:04', '2017-01-16 12:59:02'),
(19, 'grace', 'zimulinda', 'female', '0000-00-00', '0758964231', 'zimulinda2@gmail.com', '', 2147483647, 0, '0000-00-00', 'zimulinda', '89c58516040d7101307f4794c265ef9c', '1', './uploaded/20161202/00-OPENER-10.25-1.jpg', 12345, '2016-12-30 09:15:15', '2017-01-21 17:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `membersrequest`
--

CREATE TABLE IF NOT EXISTS `membersrequest` (
  `id` int(11) NOT NULL,
  `memberid` int(11) NOT NULL,
  `title` text NOT NULL,
  `amount` int(11) NOT NULL,
  `description` text NOT NULL,
  `comment` text NOT NULL,
  `paybackdate` datetime NOT NULL,
  `sentdate` datetime NOT NULL,
  `submissiondate` datetime NOT NULL,
  `dealine` datetime NOT NULL,
  `serializeddata` longtext NOT NULL,
  `status` enum('r','a','s','d') NOT NULL,
  `interest` int(11) NOT NULL,
  `interest_percent` int(11) NOT NULL,
  `totaltopayback` int(11) NOT NULL,
  `totalpayednow` int(11) NOT NULL,
  `remaining` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `membersrequest`
--

INSERT INTO `membersrequest` (`id`, `memberid`, `title`, `amount`, `description`, `comment`, `paybackdate`, `sentdate`, `submissiondate`, `dealine`, `serializeddata`, `status`, `interest`, `interest_percent`, `totaltopayback`, `totalpayednow`, `remaining`) VALUES
(1, 17, 'Kwiguriza mutuel', 10000, 'gusaba amafaranga', '', '2017-01-31 00:00:00', '2017-01-21 17:47:54', '2017-01-21 17:50:13', '2017-01-31 00:00:00', '', 'a', 900, 30, 10900, 0, 10900),
(2, 17, 'Kwiguriza amafaranga asanzwe', 14000, 'kwiguriza amafaranga asanzwe', '', '2017-02-28 00:00:00', '2017-01-21 17:48:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'r', 0, 0, 0, 0, 0),
(3, 19, 'Kwiguriza amafaranga y''abana kwishuli', 25000, 'amafaranga ', '', '2017-03-14 00:00:00', '2017-01-21 17:49:48', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '', 'r', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `network_id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `author` varchar(255) NOT NULL,
  `audience` text NOT NULL,
  `messages` text NOT NULL,
  `messagedate` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `network_id`, `creator`, `author`, `audience`, `messages`, `messagedate`) VALUES
(1, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'hello', '2016-12-28 18:29:40'),
(2, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'ok this is cool', '2016-12-28 18:55:29'),
(3, 1, 4, 'umulisa@yahoo.fr', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'not cool right?', '2016-12-28 18:55:58'),
(4, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'ok fine', '2016-12-28 18:56:59'),
(5, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'hhhhhh', '2016-12-28 19:07:08'),
(6, 3, 8, 'nkubito1@gmail.com', 'a:2:{i:0;s:16:"muhizi@gmail.com";i:1;s:18:"giselumu@gmail.com";}', 'jhghj', '2016-12-28 19:35:52'),
(7, 4, 7, 'zudanga@gmail.com', 's:507:"a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}";', 'hey', '2016-12-29 18:01:44'),
(8, 4, 7, 'nkubito1@gmail.com', 'a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}', 'whats up?', '2016-12-29 18:02:35'),
(9, 4, 7, 'zudanga@gmail.com', 's:507:"a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}";', 'um good man everything is cool right here.', '2016-12-29 18:04:36'),
(10, 4, 7, 'zudanga@gmail.com', 's:507:"a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}";', 'how about you', '2016-12-29 18:05:10'),
(11, 8, 11, 'nkubito1@gmail.com', 'a:4:{i:0;s:16:"munana@gmail.com";i:1;s:16:"umulisa@yahoo.fr";i:2;s:17:"zudanga@gmail.com";i:3;s:18:"emmanuel@gmail.com";}', 'here we goooooo.........', '2016-12-29 18:12:54'),
(12, 3, 8, 'giselumu@gmail.com', 's:64:"a:2:{i:0;s:16:"muhizi@gmail.com";i:1;s:18:"giselumu@gmail.com";}";', 'hello, this is gisel', '2016-12-30 11:44:46'),
(13, 3, 8, 'nkubito1@gmail.com', 'a:2:{i:0;s:16:"muhizi@gmail.com";i:1;s:18:"giselumu@gmail.com";}', 'dddd', '2016-12-30 11:45:35'),
(14, 9, 4, 'zimulinda2@gmail.com', 's:123:"a:4:{i:0;s:16:"ariane@gmail.com";i:1;s:17:"zudanga@gmail.com";i:2;s:16:"usanase@yahoo.fr";i:3;s:20:"zimulinda2@gmail.com";}";', 'here i am zimulinda', '2016-12-30 12:19:38'),
(15, 4, 7, 'giselumu@gmail.com', 's:507:"a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}";', 'hey everyone! i like this new group', '2016-12-30 14:35:21'),
(16, 9, 4, 'nkubito1@gmail.com', 'a:4:{i:0;s:16:"ariane@gmail.com";i:1;s:17:"zudanga@gmail.com";i:2;s:16:"usanase@yahoo.fr";i:3;s:20:"zimulinda2@gmail.com";}', 'hey zimulinda, how are you doing?', '2016-12-31 11:26:55'),
(17, 4, 7, 'nkubito1@gmail.com', 'a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}', 'dbcdjk ncdnjkdn nkdnn klnsdncsd knklnld knknds j  ds  nsdknksdn njkndsjncsd knjdnsjsd njnsdjndjs njnjnjjkc  d j sdjd j c sdj sdc   jnjnjjbj hhhhhh bjbjjkawqwe erdtrd', '2017-01-08 16:07:31'),
(18, 4, 7, 'nkubito1@gmail.com', 'a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}', 'bghgvhgvhgvhvhgvhgv jhhvghvghvghv hgvghvghvgvg', '2017-01-08 16:07:47'),
(19, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'fadsfa', '2017-01-15 16:55:05'),
(20, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'asfasf', '2017-01-15 16:55:09'),
(21, 1, 4, 'nkubito1@gmail.com', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', 'fasfasf', '2017-01-15 16:55:13'),
(22, 8, 11, 'nkubito1@gmail.com', 'a:4:{i:0;s:16:"munana@gmail.com";i:1;s:16:"umulisa@yahoo.fr";i:2;s:17:"zudanga@gmail.com";i:3;s:18:"emmanuel@gmail.com";}', 'fasfas', '2017-01-15 16:55:21'),
(23, 8, 11, 'nkubito1@gmail.com', 'a:4:{i:0;s:16:"munana@gmail.com";i:1;s:16:"umulisa@yahoo.fr";i:2;s:17:"zudanga@gmail.com";i:3;s:18:"emmanuel@gmail.com";}', 'asdasdasdasd', '2017-01-15 16:55:27'),
(24, 4, 7, 'nkubito1@gmail.com', 'a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}', 'llllllllllllll', '2017-01-16 09:45:12'),
(25, 8, 11, 'zudanga@gmail.com', 's:121:"a:4:{i:0;s:16:"munana@gmail.com";i:1;s:16:"umulisa@yahoo.fr";i:2;s:17:"zudanga@gmail.com";i:3;s:18:"emmanuel@gmail.com";}";', 'hey', '2017-01-20 15:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `network`
--

CREATE TABLE IF NOT EXISTS `network` (
  `id` int(11) NOT NULL,
  `creator` int(11) NOT NULL,
  `networkname` varchar(255) NOT NULL,
  `serialdata` text NOT NULL,
  `creationdate` datetime NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `network`
--

INSERT INTO `network` (`id`, `creator`, `networkname`, `serialdata`, `creationdate`, `status`) VALUES
(1, 4, 'imihigo', 'a:3:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";}', '2016-12-27 16:34:15', '1'),
(3, 8, 'HELLO OF LIFE', 'a:2:{i:0;s:16:"muhizi@gmail.com";i:1;s:18:"giselumu@gmail.com";}', '2016-12-27 16:46:37', '1'),
(4, 7, 'inama rusange', 'a:17:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";i:6;s:16:"munana@gmail.com";i:7;s:17:"abizeye@gmail.com";i:8;s:16:"usanase@yahoo.fr";i:9;s:14:"ramba@yahoo.fr";i:10;s:18:"clarisse@gmail.com";i:11;s:17:"kabanda@gmail.com";i:12;s:18:"emmanuel@gmail.com";i:13;s:18:"giselumu@gmail.com";i:14;s:17:"adeline@gmail.com";i:15;s:16:"umulisa@yahoo.fr";i:16;s:17:"zudanga@gmail.com";}', '2016-12-27 17:18:47', '0'),
(5, 9, 'gutora komite', 'a:6:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:18:"joannanga@yahoo.fr";i:3;s:17:"rugwiro@gmail.com";i:4;s:16:"umwali@gmail.com";i:5;s:18:"umurerwa@gmail.com";}', '2016-12-27 17:20:02', '1'),
(6, 10, 'inama ngaruka kwezi', 'a:5:{i:0;s:16:"muhizi@gmail.com";i:1;s:20:"kanamugire@gmail.com";i:2;s:14:"ramba@yahoo.fr";i:3;s:17:"adeline@gmail.com";i:4;s:18:"giselumu@gmail.com";}', '2016-12-27 17:21:22', '1'),
(7, 4, 'imbuto zo gutera', 'a:2:{i:0;s:16:"muhizi@gmail.com";i:1;s:17:"adeline@gmail.com";}', '2016-12-27 20:00:26', '1'),
(8, 11, 'testing', 'a:4:{i:0;s:16:"munana@gmail.com";i:1;s:16:"umulisa@yahoo.fr";i:2;s:17:"zudanga@gmail.com";i:3;s:18:"emmanuel@gmail.com";}', '2016-12-28 13:20:33', '0'),
(9, 4, 'testing2', 'a:4:{i:0;s:16:"ariane@gmail.com";i:1;s:17:"zudanga@gmail.com";i:2;s:16:"usanase@yahoo.fr";i:3;s:20:"zimulinda2@gmail.com";}', '2016-12-30 12:15:48', '1');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `publisheddate` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `title`, `author`, `description`, `publisheddate`) VALUES
(1, 'Her i am', 'nkubito1@gmail.com', 'here we are testing relax.\nits cool hum?you test our system its still in dev.', '2016-12-29 18:40:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `budget`
--
ALTER TABLE `budget`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `capital`
--
ALTER TABLE `capital`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribution201701`
--
ALTER TABLE `contribution201701`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contribution201702`
--
ALTER TABLE `contribution201702`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `house`
--
ALTER TABLE `house`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imports201612`
--
ALTER TABLE `imports201612`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imports201701`
--
ALTER TABLE `imports201701`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `interest`
--
ALTER TABLE `interest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `magazine`
--
ALTER TABLE `magazine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `markets`
--
ALTER TABLE `markets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `membersrequest`
--
ALTER TABLE `membersrequest`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `network`
--
ALTER TABLE `network`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `budget`
--
ALTER TABLE `budget`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `capital`
--
ALTER TABLE `capital`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `contribution201701`
--
ALTER TABLE `contribution201701`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `contribution201702`
--
ALTER TABLE `contribution201702`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `house`
--
ALTER TABLE `house`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `imports201612`
--
ALTER TABLE `imports201612`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `imports201701`
--
ALTER TABLE `imports201701`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `interest`
--
ALTER TABLE `interest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `magazine`
--
ALTER TABLE `magazine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `markets`
--
ALTER TABLE `markets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `membersrequest`
--
ALTER TABLE `membersrequest`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `network`
--
ALTER TABLE `network`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
