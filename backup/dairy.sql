-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 31, 2017 at 04:35 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dairy`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getallcustomerinfo`()
BEGIN
       SELECT * FROM CUSTOMER;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `bratechart`
--

CREATE TABLE IF NOT EXISTS `bratechart` (
  `bfat` double NOT NULL,
  `brate` double NOT NULL,
  PRIMARY KEY (`bfat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bratechart`
--

INSERT INTO `bratechart` (`bfat`, `brate`) VALUES
(6.1, 30),
(6.2, 35),
(6.3, 40),
(6.4, 45),
(6.5, 50),
(6.6, 55),
(6.7, 60),
(6.8, 65);

-- --------------------------------------------------------

--
-- Table structure for table `collection`
--

CREATE TABLE IF NOT EXISTS `collection` (
  `date` date NOT NULL,
  `time` varchar(20) NOT NULL,
  `ssn` int(11) NOT NULL,
  `type` varchar(20) NOT NULL,
  `qty` double NOT NULL,
  `fat` double NOT NULL,
  `rate` double NOT NULL,
  `total` double NOT NULL,
  PRIMARY KEY (`date`,`time`,`ssn`,`type`),
  KEY `ssn` (`ssn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `collection`
--

INSERT INTO `collection` (`date`, `time`, `ssn`, `type`, `qty`, `fat`, `rate`, `total`) VALUES
('2017-10-30', 'Evening', 1, 'Buffalo', 15, 6.5, 50, 750),
('2017-10-30', 'Evening', 2, 'Buffalo', 25, 6.6, 55, 1375),
('2017-10-30', 'Morning', 1, 'Buffalo', 10, 6.1, 30, 300),
('2017-10-30', 'Morning', 2, 'Buffalo', 15, 6.4, 45, 675),
('2017-10-30', 'Morning', 3, 'Cow', 25, 5.5, 20, 500),
('2017-10-31', 'Evening', 1, 'Buffalo', 30, 6.6, 55, 1650),
('2017-10-31', 'Morning', 1, 'Buffalo', 20, 6.4, 45, 900);

-- --------------------------------------------------------

--
-- Table structure for table `cratechart`
--

CREATE TABLE IF NOT EXISTS `cratechart` (
  `cfat` double NOT NULL,
  `crate` double NOT NULL,
  PRIMARY KEY (`cfat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cratechart`
--

INSERT INTO `cratechart` (`cfat`, `crate`) VALUES
(5.5, 20),
(5.6, 25),
(5.7, 30),
(5.8, 35),
(5.9, 40),
(6, 45);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `ssn` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `address` varchar(20) NOT NULL,
  `type` varchar(11) NOT NULL,
  PRIMARY KEY (`ssn`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`ssn`, `name`, `address`, `type`) VALUES
(1, 'SUMAN HUGAR', 'SNK', 'Buffalo'),
(2, 'CHETANA DESHMUK', 'BGM', 'Buffalo'),
(3, 'SHRAVANI GHOLAP', 'NDS', 'Cow'),
(4, 'POOJA SOUDI', 'BNG', 'Cow');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `user` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  PRIMARY KEY (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user`, `password`) VALUES
('admin', '123456');

-- --------------------------------------------------------

--
-- Stand-in structure for view `viewbill`
--
CREATE TABLE IF NOT EXISTS `viewbill` (
`name` varchar(20)
,`date` date
,`time` varchar(20)
,`ssn` int(11)
,`type` varchar(20)
,`qty` double
,`fat` double
,`rate` double
,`total` double
);
-- --------------------------------------------------------

--
-- Structure for view `viewbill`
--
DROP TABLE IF EXISTS `viewbill`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `viewbill` AS select `cu`.`name` AS `name`,`co`.`date` AS `date`,`co`.`time` AS `time`,`co`.`ssn` AS `ssn`,`co`.`type` AS `type`,`co`.`qty` AS `qty`,`co`.`fat` AS `fat`,`co`.`rate` AS `rate`,`co`.`total` AS `total` from (`customer` `cu` join `collection` `co` on((`cu`.`ssn` = `co`.`ssn`)));

--
-- Constraints for dumped tables
--

--
-- Constraints for table `collection`
--
ALTER TABLE `collection`
  ADD CONSTRAINT `collection_ibfk_1` FOREIGN KEY (`ssn`) REFERENCES `customer` (`ssn`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
