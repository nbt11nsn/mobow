-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 08, 2015 at 02:14 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(2, 91232, 'Vilhelmina', 'Postgatan 3', 16.6547774, 64.6230765),
(3, 80320, 'Gävle', 'Stortorget 1', 15.8253629, 60.2930402),
(4, 95391, 'Haparanda', 'Kukkolaforsen 184', 24.0548527, 65.9591007),
(5, 95336, 'Haparanda', 'Norrskensvägen 2', 24.1324517, 65.8429222),
(6, 80302, 'Gävle', 'Alderholmsgatan 7', 17.16285760793459, 60.6786653779345),
(8, 80252, 'Gävle', 'Mobowgatan 52', 17.192, 60.673);

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
  `kontaktid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `kontraktid` (`kontaktid`),
  KEY `status` (`status`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `edit_kntper`
--

INSERT INTO `edit_kntper` (`ID`, `fornamn`, `efternamn`, `mobil`, `mejl`, `status`, `meddelande`, `kontaktid`) VALUES
(1, 'sefj', 'sfdj', NULL, NULL, 1, NULL, 'KarlL');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `faktura`
--

INSERT INTO `faktura` (`ID`, `namn`, `url`, `agarid`, `datum`) VALUES
(2, 'faktura2', 'faktura/faktura2.pdf', 2, '2014-12-03'),
(3, 'faktura3', 'faktura/faktura1.pdf', 3, '2014-11-04'),
(4, 'faktura4', 'faktura/faktura1.pdf', 4, '2013-07-16'),
(5, 'faktura5', 'faktura/faktura1.pdf', 5, '2014-12-10'),
(7, 'faktura7', 'faktura/faktura1.pdf', 2, '2014-08-19'),
(8, '234567891', 'faktura/faktura8_2014-12-16_234567891.pdf', 8, '2014-12-16'),
(9, '542845879', 'faktura/faktura8_2014-07-16_542845879.pdf', 8, '2014-07-16'),
(10, '542895687', 'faktura/faktura8_2014-07-16_542895687.pdf', 8, '2014-07-16');

-- --------------------------------------------------------

--
-- Table structure for table `felmeddelande`
--

CREATE TABLE IF NOT EXISTS `felmeddelande` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `medstatus` int(11) NOT NULL DEFAULT '1',
  `feltypid` int(11) NOT NULL,
  `fronid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tillid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fronid` (`fronid`),
  KEY `tillid` (`tillid`),
  KEY `medstatus` (`medstatus`),
  KEY `feltypid` (`feltypid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `felmeddelande`
--

INSERT INTO `felmeddelande` (`ID`, `text`, `medstatus`, `feltypid`, `fronid`, `tillid`) VALUES
(4, 'sdfaserasefhzsdfhasdfhsdfhsdfh', 4, 1, 'AndersB', 'AdminM'),
(7, 'Hej', 4, 2, 'AndersB', 'AdminM');

-- --------------------------------------------------------

--
-- Table structure for table `felstatus`
--

CREATE TABLE IF NOT EXISTS `felstatus` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `info` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `felstatus`
--

INSERT INTO `felstatus` (`ID`, `info`) VALUES
(1, 'Skickat'),
(2, 'Mottagen'),
(3, 'Påbörjad'),
(4, 'Avslutad');

-- --------------------------------------------------------

--
-- Table structure for table `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `feltext` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `feltyp`
--

INSERT INTO `feltyp` (`ID`, `feltext`) VALUES
(1, 'Kabelbrott'),
(2, 'Startar inte'),
(3, 'Laddar inte');

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
('556345-1201', 'Wayne och Margareta''s Coffee Aktiebolag'),
('910413-1234', 'Mobow');

-- --------------------------------------------------------

--
-- Table structure for table `ikontyp`
--

CREATE TABLE IF NOT EXISTS `ikontyp` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `opimgurl` varchar(256) NOT NULL,
  `stimgurl` varchar(256) NOT NULL,
  `typ` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `ikontyp`
--

INSERT INTO `ikontyp` (`ID`, `opimgurl`, `stimgurl`, `typ`) VALUES
(1, 'image/grestaurang24x32.png', 'image/restaurang24x32.png', 'Restaurang'),
(2, 'image/gcafe31x32.png', 'image/cafe31x32.png', 'Café');

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
('AndersB', 'Anders', 'Blomkvist', '723548795', 'nbt11nsn@student.hig.se', '$2y$10$zSW6TYJoE8XN9b5GZ0x.gePOHtcmPeR9auIIzQ87dXPXq0DMM5VCu', 0),
('DavidO', 'David', 'Olsson', '0123456789', 'kundtjanst@mobow.se', '$2y$10$.LODvRTvWP8HJPwFWCQ82uZO/nz/PIQxKDoHHnDmrIOQF/jEzeHVC', 1),
('KarlL', 'Karl', 'Lundh', '345678912', 'nbt11nsn@student.hig.se', '$2y$10$yAJqNxkCcl/3zHfm.WBAxuJa85z4Frj4KOQIhD7hdxQ97SamIaXz6', 0),
('MattiasD', 'Mattias', 'Didriksson', '732154879', 'nbt11nsn@student.hig.se', '$2y$10$jLjW0w8A.nhdno2ArRNcDO4NPEtdjC4UG48/VAMc6psre8XUunF.K', 0),
('NiklasS', 'Niklas', 'Sjögren', '234567891', 'nbt11nsn@student.hig.se', '$2y$10$AcIafMqd0GgCAzgog7eJIO.9GOH2FaJ.0NpxT4nsuLUCYJenOqrNG', 0),
('RickardH', 'Rickard', 'Hedlund', '456789123', 'nbt11nsn@student.hig.se', '$2y$10$VWMASYpv0PD3a9uaHMna6uA5Lhkab/ejhpnRNc6c/Dp1Q4xrgdpy6', 0);

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
  `ikonid` int(11) NOT NULL,
  `orgnr` varchar(20) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `ikonid` (`ikonid`),
  KEY `kontaktpersonid` (`kontaktpersonid`),
  KEY `foretagid` (`orgnr`),
  KEY `foretagid_2` (`orgnr`),
  KEY `orgnr` (`orgnr`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `forecolor`, `backcolor`, `kontaktpersonid`, `ikonid`, `orgnr`) VALUES
(2, 'Gevalia Söder', '2014-09-16', 'sfdlkjsfdjkllkjdsf', '026-54875', 5, 'image/logo/logo0.png', 32, 32, 'http://www.aftonbladet.se/', '', '#ff00ff', '#000000', 'KarlL', 2, '454545-4545'),
(3, 'Gevalia Norr', '2014-06-04', '', '026-78458', 3, 'image/logo/04earth.png', 256, 256, 'http://www.google.com/', 'random grejs', '#000000', '#ffffff', 'KarlL', 1, '225454-3458'),
(4, 'Solen', '2014-09-16', '', '012341234', 2, 'image/logo/08saturn.png', 256, 256, 'http://sv.wikipedia.org/wiki/', '', '#abcdef', '#543210', 'MattiasD', 1, '262648-2356'),
(5, 'Svarta hålet', '2014-09-16', NULL, '020-548454', 15, 'image/logo/blackhole.png', 256, 256, NULL, 'HEJHEJHEJHEJ', '#FF0000', '#00FFFF', 'RickardH', 2, '548795-3251'),
(6, 'Wayne''s Coffee', '2014-05-28', NULL, '026-52454', 1, 'image/logo/wayne.jpg', 100, 100, 'http://www.waynescoffee.se/menyer.aspx', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.<br />\r\n', '#000000', '#ffffff', 'AndersB', 2, '556345-1201'),
(8, 'Mobow', '2014-12-16', 'Livet ska inte styras av din batterimätares siffror!', '123456789', 9, 'image/logo/kontraktMobow.png', 32, 32, 'http://www.mobow.se/', 'Mobilen är vårt främsta redskap med intill obegränsade användningsområden. En dag utan mobil är för de flesta otänkbart.\r\nKorta batteritider begränsar oss och vår kontakt med världen. Mobow gör din mobilanvändning gränslös.', '#634263', '#c1c1c1', 'DavidO', 1, '910413-1234');

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
(1, 'Oläst'),
(2, 'Godkänd'),
(3, 'Nekad');

-- --------------------------------------------------------

--
-- Table structure for table `oppettider`
--

CREATE TABLE IF NOT EXISTS `oppettider` (
  `kontraktid` int(11) NOT NULL,
  `veckodagarid` int(11) NOT NULL,
  `oppet` time DEFAULT NULL,
  `stangt` time DEFAULT NULL,
  PRIMARY KEY (`kontraktid`,`veckodagarid`),
  KEY `veckodagarid` (`veckodagarid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `oppettider`
--

INSERT INTO `oppettider` (`kontraktid`, `veckodagarid`, `oppet`, `stangt`) VALUES
(2, 1, '23:24:00', '12:34:00'),
(2, 2, '05:45:00', '12:25:00'),
(2, 3, '12:25:00', '12:36:00'),
(2, 4, '06:00:00', '20:00:00'),
(2, 6, '11:23:00', '13:25:00'),
(2, 7, '05:59:00', '05:12:00'),
(3, 1, '04:15:00', '05:52:00'),
(3, 2, '03:46:00', '12:24:00'),
(3, 3, '05:34:00', '05:51:00'),
(3, 4, '12:24:00', '12:45:00'),
(3, 5, '12:45:00', '14:25:00'),
(3, 6, '05:23:00', '12:51:00'),
(3, 7, '15:56:00', '03:46:00'),
(5, 1, '12:15:00', '05:25:00'),
(5, 3, '06:59:00', '12:15:00'),
(5, 5, '15:16:00', '12:56:00'),
(5, 7, '12:16:00', '04:12:00'),
(8, 1, '12:14:00', '12:36:00'),
(8, 2, '04:46:00', '23:34:00'),
(8, 4, '23:59:00', '23:46:00'),
(8, 7, '14:31:00', '12:04:00');

-- --------------------------------------------------------

--
-- Table structure for table `specialtider`
--

CREATE TABLE IF NOT EXISTS `specialtider` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kontraktid` int(11) NOT NULL,
  `specstart` date NOT NULL,
  `specslut` date NOT NULL,
  `veckodagarid` int(11) NOT NULL,
  `altoppet` time NOT NULL,
  `altstangt` time NOT NULL,
  `stangt` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  KEY `kontraktid` (`kontraktid`),
  KEY `kontraktid_2` (`kontraktid`,`veckodagarid`),
  KEY `veckodagarid` (`veckodagarid`)
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
(1, 'sun', 'Söndag'),
(2, 'mon', 'Måndag'),
(3, 'thue', 'Tisdag'),
(4, 'wen', 'Onsdag'),
(5, 'thur', 'Torsdag'),
(6, 'fri', 'Fredag'),
(7, 'sat', 'Lördag');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `adress`
--
ALTER TABLE `adress`
  ADD CONSTRAINT `kontrakt_ibfk_10` FOREIGN KEY (`ID`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `edit_kntper_ibfk_1` FOREIGN KEY (`kontaktid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Constraints for table `faktura`
--
ALTER TABLE `faktura`
  ADD CONSTRAINT `kontrakt_ibfk_2` FOREIGN KEY (`agarid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE;

--
-- Constraints for table `felmeddelande`
--
ALTER TABLE `felmeddelande`
  ADD CONSTRAINT `felmeddelande_ifbk_3` FOREIGN KEY (`medstatus`) REFERENCES `felstatus` (`ID`),
  ADD CONSTRAINT `felmeddelande_ifbk_1` FOREIGN KEY (`fronid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `felmeddelande_ifbk_2` FOREIGN KEY (`tillid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `felmeddelande_ifbk_4` FOREIGN KEY (`feltypid`) REFERENCES `feltyp` (`ID`);

--
-- Constraints for table `kontrakt`
--
ALTER TABLE `kontrakt`
  ADD CONSTRAINT `ikon_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
  ADD CONSTRAINT `kontrakt_ibfk_1` FOREIGN KEY (`kontaktpersonid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `orgnr_ibfk_1` FOREIGN KEY (`orgnr`) REFERENCES `foretag` (`orgnr`) ON DELETE CASCADE;

--
-- Constraints for table `oppettider`
--
ALTER TABLE `oppettider`
  ADD CONSTRAINT `kontraktid_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `veckodagar_ibfk_1` FOREIGN KEY (`veckodagarid`) REFERENCES `veckodagar` (`ID`);

--
-- Constraints for table `specialtider`
--
ALTER TABLE `specialtider`
  ADD CONSTRAINT `specialtider_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `feltyp` (`ID`),
  ADD CONSTRAINT `specialtider_ibfk_2` FOREIGN KEY (`veckodagarid`) REFERENCES `kontrakt` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
