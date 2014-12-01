-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 01, 2014 at 03:32 AM
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
CREATE DATABASE IF NOT EXISTS `mobowdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mobowdb`;

-- --------------------------------------------------------

--
-- Table structure for table `adress`
--

CREATE TABLE IF NOT EXISTS `adress` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `postnr` int(11) DEFAULT NULL,
  `stad` varchar(100) NOT NULL,
  `gata` varchar(100) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(1, 80320, 'Gävle', 'Stortorget 1', 17.1420337, 60.6748389),
(2, 91232, 'Vilhelmina', 'Postgatan 3', 16.6547774, 64.6230765),
(3, 77670, 'Vikmanshyttan', 'Rostugnsvägen 3', 15.8253629, 60.2930402),
(4, 95391, 'Haparanda', 'Kukkolaforsen 184', 24.0548527, 65.9591007),
(5, 95336, 'Haparanda', 'Norrskensvägen 2', 24.1324517, 65.8429222);

-- --------------------------------------------------------

--
-- Table structure for table `bestallning`
--

CREATE TABLE IF NOT EXISTS `bestallning` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `datum` date NOT NULL,
  `foretagsid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `edit_foretag`
--

CREATE TABLE IF NOT EXISTS `edit_foretag` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kontorsnamn` varchar(50) DEFAULT NULL,
  `tele` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` mediumtext,
  `allminfo` mediumtext,
  `logurl` varchar(256) DEFAULT NULL,
  `ikonid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `meddelande` mediumtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `edit_kntper`
--

CREATE TABLE IF NOT EXISTS `edit_kntper` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fornamn` varchar(50) DEFAULT NULL,
  `efternamn` varchar(50) DEFAULT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `meddelande` mediumtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `faktura`
--

CREATE TABLE IF NOT EXISTS `faktura` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `namn` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `agarid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `felmeddelande`
--

CREATE TABLE IF NOT EXISTS `felmeddelande` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `feltypid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `feltext` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `foretag`
--

CREATE TABLE IF NOT EXISTS `foretag` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `orgnr` varchar(20) NOT NULL,
  `namn` varchar(50) NOT NULL,
  `tele` int(11) DEFAULT NULL,
  `kontaktpersid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ikontyp`
--

CREATE TABLE IF NOT EXISTS `ikontyp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `imgurl` varchar(256) NOT NULL,
  `typ` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ikontyp`
--

INSERT INTO `ikontyp` (`ID`, `imgurl`, `typ`) VALUES
(1, 'image/restaurang24x32.png', 'Restaurang'),
(2, 'image/cafe31x32.png', 'Café');

-- --------------------------------------------------------

--
-- Table structure for table `kontaktperson`
--

CREATE TABLE IF NOT EXISTS `kontaktperson` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `fornamn` varchar(50) NOT NULL,
  `efternamn` varchar(50) NOT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) NOT NULL,
  `losen` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `anvnamn` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `anvnamn` (`anvnamn`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `kontaktperson`
--

INSERT INTO `kontaktperson` (`ID`, `fornamn`, `efternamn`, `mobil`, `mejl`, `losen`, `admin`, `anvnamn`) VALUES
(1, 'administrator', 'mobow', 123456789, 'nbt11nsn@student.hig.se', '$2y$10$Uat1/q0s8A6X2.SG9HKCkeB6xPzbYHtjZe.9iEO43EmoaVEv2Tfm2', 1, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kontorsnamn` varchar(50) NOT NULL,
  `tele` int(11) DEFAULT NULL,
  `stn` int(11) NOT NULL,
  `logurl` varchar(256) DEFAULT NULL,
  `logbredd` int(11) DEFAULT NULL,
  `loghojd` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` text,
  `allminfo` text,
  `forecolor` varchar(7) NOT NULL DEFAULT '#000000',
  `backcolor` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `kontaktpersonid` int(11) NOT NULL,
  `adressid` int(11) NOT NULL,
  `ikonid` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `oppet`, `allminfo`, `forecolor`, `backcolor`, `kontaktpersonid`, `adressid`, `ikonid`) VALUES
(1, 'Gevalia', NULL, 1, NULL, NULL, NULL, 'http://www.google.com/', 'mån-fre: 9:00-22:00\r\nsön: 10:03-10:33\r\nannars: stängt', 'random grejs', '#000000', '#FFFFFF', 1, 1, 1),
(2, 'Discovery', NULL, 3, 'image/logo/logo0.png', 32, 32, 'http://www.aftonbladet.se/', 'STÄNGE!!!', NULL, '#FF00FF', '#000000', 2, 2, 2),
(3, 'Rubinola', NULL, 2, 'image/logo/03venus.png', 256, 256, 'http://www.gd.se/', 'mån-sön: 01:30-03:30', 'massa text\r\nmassa text\r\nmassa text\r\nmassa text\r\nmassa text\r\nmassa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text\r\nmassa text massa text massa text', '#000000', '#FFFFFF', 3, 3, 1),
(4, 'Solen', NULL, 1, 'image/logo/01sun.png', 256, 256, 'http://sv.wikipedia.org/wiki/', 'mån-sön: 00:00-24:00', NULL, '#ABCDEF', '#543210', 4, 4, 1),
(5, 'Svarta hålet', NULL, 10000, 'image/logo/blackhole.png', 256, 256, NULL, 'mån-sön: 10:03-10:04', 'HEJHEJHEJHEJ', '#FF0000', '#00FFFF', 5, 5, 2);

-- --------------------------------------------------------

--
-- Table structure for table `probest`
--

CREATE TABLE IF NOT EXISTS `probest` (
  `bestallningsid` int(11) NOT NULL,
  `produktid` int(11) NOT NULL,
  `antal` int(11) NOT NULL,
  PRIMARY KEY (`bestallningsid`,`produktid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `produkt`
--

CREATE TABLE IF NOT EXISTS `produkt` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `maxbest` int(11) NOT NULL DEFAULT '0',
  `namn` varchar(100) NOT NULL,
  `bildurl` varchar(256) DEFAULT NULL,
  `info` mediumtext,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
