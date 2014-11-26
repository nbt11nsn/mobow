-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 26, 2014 at 01:10 PM
-- Server version: 5.5.40-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mobowdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kontorsnamn` varchar(50) NOT NULL,
  `tele` int(11) DEFAULT NULL,
  `stn` int(11) NOT NULL,
  `kontaktpersonid` int(11) NOT NULL,
  `adressid` int(11) NOT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` text,
  `allminfo` text,
  `logurl` varchar(256) DEFAULT NULL,
  `ikonid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `tele`, `stn`, `kontaktpersonid`, `adressid`, `hemsida`, `oppet`, `allminfo`, `logurl`, `ikonid`) VALUES
(1, 'Gevalia', NULL, 1, 1, 1, 'http://www.google.com/', 'mån-fre: 9:00-22:00\r\nannars: stängt', 'random grejs', NULL, 1),
(2, 'Discovery', NULL, 3, 2, 2, 'http://www.aftonbladet.se/', 'STÄNGT!!!', NULL, 'image/logo/logo0.png', 2),
(3, 'Rubinola', NULL, 2, 3, 3, 'http://www.gd.se/', 'mån-sön: 01:30-03:30', 'massa text\r\nmassa text\r\nmassa text\r\nmassa text\r\nmassa text\r\nmassa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text', 'image/logo/03venus.png', 1),
(4, 'Solen', NULL, 1, 4, 4, 'http://sv.wikipedia.org/wiki/', 'mån-sön: 00:00-24:00', NULL, 'image/logo/01sun.png', 2),
(5, 'Svarta hålet', NULL, 10000, 5, 5, NULL, 'mån-sön: 10:03-10:04', NULL, 'image/logo/blackhole.png', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
