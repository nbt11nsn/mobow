-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 14, 2014 at 11:03 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(1, 80320, 'Gävle', 'Stortorget 1', 17.1420337, 60.6748389),
(2, 91232, 'Vilhelmina', 'Postgatan 3', 16.6547774, 64.6230765),
(3, 80320, 'Gävle', 'Stortorget 1', 15.8253629, 60.2930402),
(4, 95391, 'Haparanda', 'Kukkolaforsen 184', 24.0548527, 65.9591007),
(5, 95336, 'Haparanda', 'Norrskensvägen 2', 24.1324517, 65.8429222),
(6, 80302, 'Gävle', 'Alderholmsgatan 7', 17.16285760793459, 60.6786653779345);

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
  `currinfo` text,
  `tele` int(11) DEFAULT NULL,
  `logurl` varchar(256) DEFAULT NULL,
  `logbredd` int(11) DEFAULT NULL,
  `loghojd` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `allminfo` text,
  `forecolor` varchar(7) DEFAULT NULL,
  `backcolor` varchar(7) DEFAULT NULL,
  `ikonid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `meddelande` text,
  `kontraktid` int(11) NOT NULL,
  PRIMARY KEY (`kontraktid`),
  KEY `kontraktid` (`kontraktid`),
  KEY `status` (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `edit_foretag`
--

INSERT INTO `edit_foretag` (`currinfo`, `tele`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `forecolor`, `backcolor`, `ikonid`, `status`, `meddelande`, `kontraktid`) VALUES
('', 12341234, NULL, NULL, NULL, 'http://sv.wikipedia.org/wiki/', '', '#abcdef', '#543210', NULL, 1, NULL, 4);

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
  `status` int(11) NOT NULL,
  `meddelande` mediumtext,
  `kontraktid` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `kontraktid` (`kontraktid`),
  KEY `status` (`status`)
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
  `datum` date NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `agarid` (`agarid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `faktura`
--

INSERT INTO `faktura` (`ID`, `namn`, `url`, `agarid`, `datum`) VALUES
(1, 'faktura1faktura1faktura1faktura1faktura1faktura1fa', '../faktura/faktura1.pdf', 1, '2014-12-01'),
(2, 'faktura2', '../faktura/faktura2.pdf', 2, '2014-12-03'),
(3, 'faktura3', '../faktura/faktura1.pdf', 3, '2014-11-04'),
(4, 'faktura4', '../faktura/faktura1.pdf', 4, '2013-07-16'),
(5, 'faktura5', '../faktura/faktura1.pdf', 5, '2014-12-10'),
(6, 'faktura6', '../faktura/faktura1.pdf', 1, '2014-08-19'),
(7, 'faktura7', '../faktura/faktura1.pdf', 2, '2014-08-19');

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
  `orgnr` varchar(20) NOT NULL,
  `namn` varchar(50) NOT NULL,
  PRIMARY KEY (`orgnr`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `foretag`
--

INSERT INTO `foretag` (`orgnr`, `namn`) VALUES
('133737-1337', 'leet org.'),
('225454-3458', 'Rubinola AB'),
('262648-2356', 'Solen AB'),
('454545-4545', 'Gevalia AB'),
('548795-3251', 'Svarta hålet AB'),
('556345-1201', 'Wayne och Margareta''s Coffee Aktiebolag');

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
  `anvnamn` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fornamn` varchar(50) NOT NULL,
  `efternamn` varchar(50) NOT NULL,
  `mobil` varchar(20) DEFAULT NULL,
  `mejl` varchar(50) NOT NULL,
  `losen` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  PRIMARY KEY (`anvnamn`),
  UNIQUE KEY `anvnamn` (`anvnamn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kontaktperson`
--

INSERT INTO `kontaktperson` (`anvnamn`, `fornamn`, `efternamn`, `mobil`, `mejl`, `losen`, `admin`) VALUES
('AdminM', 'Administrator', 'Mobow', '123456789', 'nbt11nsn@student.hig.se', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 1),
('AndersB', 'Anders', 'Blomkvist', '723548795', 'nbt11nsn@student.hig.se', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 0),
('KarlL', 'Karl', 'Lundh', '345678912', 'nbt11nsn@student.hig.se', '$2y$10$Uat1/q0s8A6X2.SG9HKCkeB6xPzbYHtjZe.9iEO43EmoaVEv2Tfm2', 0),
('MattiasD', 'Mattias', 'Didriksson', '732154879', 'nbt11nsn@student.hig.se', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 0),
('NiklasS', 'Niklas', 'Sjögren', '234567891', 'nbt11nsn@student.hig.se', '$2y$10$Uat1/q0s8A6X2.SG9HKCkeB6xPzbYHtjZe.9iEO43EmoaVEv2Tfm2', 0),
('RickardH', 'Rickard', 'Hedlund', '456789123', 'nbt11nsn@student.hig.se', '$2y$10$Uat1/q0s8A6X2.SG9HKCkeB6xPzbYHtjZe.9iEO43EmoaVEv2Tfm2', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kontorsnamn` varchar(50) NOT NULL,
  `sbesok` date NOT NULL DEFAULT '0000-00-00',
  `currinfo` text,
  `tele` varchar(20) DEFAULT NULL,
  `stn` int(11) unsigned NOT NULL,
  `logurl` varchar(256) DEFAULT NULL,
  `logbredd` int(11) DEFAULT NULL,
  `loghojd` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `allminfo` text,
  `forecolor` varchar(7) NOT NULL DEFAULT '#000000',
  `backcolor` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `kontaktpersonid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `adressid` int(11) NOT NULL,
  `ikonid` int(11) NOT NULL,
  `orgnr` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `adressid` (`adressid`),
  KEY `ikonid` (`ikonid`),
  KEY `kontaktpersonid` (`kontaktpersonid`),
  KEY `foretagid` (`orgnr`),
  KEY `foretagid_2` (`orgnr`),
  KEY `orgnr` (`orgnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `forecolor`, `backcolor`, `kontaktpersonid`, `adressid`, `ikonid`, `orgnr`) VALUES
(1, 'Gevalia', '2014-06-05', '', '026-78458', 3, NULL, NULL, NULL, 'http://www.google.com/', 'random grejs', '#000000', '#ffffff', 'NiklasS', 1, 2, '454545-4545'),
(2, 'Gevalia Söder', '2014-09-16', 'sfdlkjsfdjkllkjdsf', '026-54875', 5, '../logo/logo0.png', 32, 32, 'http://www.aftonbladet.se/', '', '#ff00ff', '#000000', 'KarlL', 2, 2, '454545-4545'),
(3, 'Gevalia Norr', '2014-06-04', '', '026-78458', 3, '../logo/04earth.png', 256, 256, 'http://www.google.com/', 'random grejs', '#000000', '#ffffff', 'KarlL', 3, 1, '225454-3458'),
(4, 'Solen', '2014-09-16', '', '012341234', 2, '../logo/08saturn.png', 256, 256, 'http://sv.wikipedia.org/wiki/', '', '#abcdef', '#543210', 'MattiasD', 4, 1, '262648-2356'),
(5, 'Svarta hålet', '2014-09-16', NULL, '020-548454', 15, '../logo/blackhole.png', 256, 256, NULL, 'HEJHEJHEJHEJ', '#FF0000', '#00FFFF', 'RickardH', 5, 2, '548795-3251'),
(6, 'Wayne''s Coffee', '2014-05-28', NULL, '026-52454', 1, '../logo/wayne.jpg', 100, 100, 'http://www.waynescoffee.se/menyer.aspx', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.<br />\r\n', '#000000', '#ffffff', 'AndersB', 6, 2, '556345-1201'),
(7, 'IEEE', '2014-09-17', '', '020-548454', 15, '../logo/asteroid.png', 256, 256, '', 'HALLÅ', '#ff0000', '#00ffff', 'RickardH', 2, 2, '133737-1337');

-- --------------------------------------------------------

--
-- Table structure for table `medstatus`
--

CREATE TABLE IF NOT EXISTS `medstatus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Info` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `medstatus`
--

INSERT INTO `medstatus` (`ID`, `Info`) VALUES
(1, 'Mottagen'),
(2, 'Påbörjad'),
(3, 'Avslutad');

-- --------------------------------------------------------

--
-- Table structure for table `oppettider`
--

CREATE TABLE IF NOT EXISTS `oppettider` (
  `kontraktid` int(11) NOT NULL,
  `veckodagarid` int(11) NOT NULL,
  `oppet` time DEFAULT NULL,
  `stangt` time DEFAULT NULL,
  `arStangt` tinyint(1) NOT NULL,
  PRIMARY KEY (`kontraktid`,`veckodagarid`),
  KEY `veckodagarid` (`veckodagarid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oppettider`
--

INSERT INTO `oppettider` (`kontraktid`, `veckodagarid`, `oppet`, `stangt`, `arStangt`) VALUES
(1, 1, '04:24:00', '05:56:00', 1),
(1, 2, '12:24:00', '12:24:00', 0),
(1, 3, '05:52:00', '03:52:00', 1),
(1, 4, '05:12:00', '14:25:00', 0),
(1, 5, '04:56:00', '12:21:00', 0),
(1, 6, '12:59:00', '06:57:00', 1),
(1, 7, '06:59:00', '14:12:00', 0);

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

-- --------------------------------------------------------

--
-- Table structure for table `veckodagar`
--

CREATE TABLE IF NOT EXISTS `veckodagar` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `akro` varchar(4) NOT NULL,
  `veckonamn` varchar(8) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `veckodagar`
--

INSERT INTO `veckodagar` (`ID`, `akro`, `veckonamn`) VALUES
(1, 'Mån', 'Måndag'),
(2, 'Tis', 'Tisdag'),
(3, 'Ons', 'Onsdag'),
(4, 'Tors', 'Torsdag'),
(5, 'Fre', 'Fredag'),
(6, 'Lör', 'Lördag'),
(7, 'Sön', 'Söndag');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `edit_foretag`
--
ALTER TABLE `edit_foretag`
  ADD CONSTRAINT `kontrakt_ibfk_3` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Constraints for table `edit_kntper`
--
ALTER TABLE `edit_kntper`
  ADD CONSTRAINT `kontrakt_ibfk_5` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`),
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Constraints for table `faktura`
--
ALTER TABLE `faktura`
  ADD CONSTRAINT `kontrakt_ibfk_2` FOREIGN KEY (`agarid`) REFERENCES `kontrakt` (`ID`);

--
-- Constraints for table `kontrakt`
--
ALTER TABLE `kontrakt`
  ADD CONSTRAINT `adress_ibfk_1` FOREIGN KEY (`adressid`) REFERENCES `adress` (`ID`),
  ADD CONSTRAINT `ikon_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
  ADD CONSTRAINT `kontrakt_ibfk_1` FOREIGN KEY (`kontaktpersonid`) REFERENCES `kontaktperson` (`anvnamn`),
  ADD CONSTRAINT `orgnr_ibfk_1` FOREIGN KEY (`orgnr`) REFERENCES `foretag` (`orgnr`);

--
-- Constraints for table `oppettider`
--
ALTER TABLE `oppettider`
  ADD CONSTRAINT `veckodagar_ibfk_1` FOREIGN KEY (`veckodagarid`) REFERENCES `veckodagar` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
