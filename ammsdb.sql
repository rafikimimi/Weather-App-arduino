-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2017 at 06:04 AM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ammsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `loginDate` datetime NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`username`, `password`, `loginDate`, `role`, `status`) VALUES
('msigala@yahoo.com', 'c56d0e9a7ccec67b4ea131655038d604', '2017-04-06 00:00:00', 'admin', 'active'),
('rashidmtali@gmail.com', 'c56d0e9a7ccec67b4ea131655038d604', '2017-04-25 00:00:00', 'officer', 'active'),
('muserose1990@yahoo.com', 'a12e137401f7dfa7b446bebf904af3d3', '2017-04-12 18:10:37', 'officer', 'active'),
('jared@gmail.com', 'c1a323e22bc39972d646867221f8272c', '2017-04-12 18:11:48', 'officer', 'active'),
('sebarua@yahoo.com', 'b2a63dd1cf7e22ff2c3029a1e6faa4be', '2017-04-12 18:33:54', 'admin', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `meteolologydata`
--

CREATE TABLE `meteolologydata` (
  `MeteorologyId` varchar(10) NOT NULL,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `addedtime` datetime(6) NOT NULL,
  `stationname` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meteolologydata`
--

INSERT INTO `meteolologydata` (`MeteorologyId`, `temperature`, `humidity`, `addedtime`, `stationname`) VALUES
('123', 30.12, 28, '2017-04-13 16:08:16.374000', 'DODOMA'),
('123', 25, 24, '2017-04-13 16:53:16.374000', 'DODOMA'),
('456', 32, 35, '2017-04-13 17:26:12.196000', 'DODOMA'),
('122', 34, 100, '2017-04-13 17:29:15.251000', 'DODOMA'),
('234', 27, 40, '2017-04-14 15:26:27.000000', 'DODOMA'),
('234', 30, 25, '2017-04-14 07:10:11.087000', 'DODOMA'),
('345', 23, 30, '2017-04-19 10:19:21.000000', 'DODOMA');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `fname` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `bdate` datetime NOT NULL,
  `gender` varchar(100) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `dateRegistered` datetime NOT NULL,
  `RegisteredBy` varchar(100) NOT NULL,
  `Location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`fname`, `sname`, `bdate`, `gender`, `phone`, `email`, `address`, `dateRegistered`, `RegisteredBy`, `Location`) VALUES
('Selemani', 'Msigala', '2016-06-01 00:00:00', 'M', '+255719121529', 'msigala@yahoo.com', 'BOX 444 MOROGORO', '2017-04-12 00:00:00', 'System', ''),
('Rashid', 'Mtali', '2017-04-12 00:00:00', 'M', '+255755297919', 'rashidmtali@gmail.com', 'BOX 259 DODOMA', '2017-04-12 00:00:00', 'System', 'Dodoma'),
('Rose', 'Muse', '0000-00-00 00:00:00', 'Female', '+255766125679', 'muserose1990@yahoo.com', 'BOX 123 MAKULU', '2017-04-12 18:10:37', 'msigala@yahoo.com', 'DODOMA'),
('Joseph', 'Jared', '0000-00-00 00:00:00', 'Male', '+255765453412', 'jared@gmail.com', 'BOX 456 KIGOMA', '2017-04-12 18:11:48', 'msigala@yahoo.com', 'ARUSHA'),
('Jumanne', 'Sebarua', '0000-00-00 00:00:00', 'Male', '+255767899008', 'sebarua@yahoo.com', 'BOX 367 Dodoma', '2017-04-12 18:33:54', 'msigala@yahoo.com', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
