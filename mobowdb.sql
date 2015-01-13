-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 13, 2015 at 04:13 PM
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(9, 80302, 'Gävle', 'Alderholmsgatan 7', 17.1631151, 60.6786286),
(10, 80320, 'Gävle', 'Drottninggatan 4', 17.1399135, 60.673322),
(11, 80250, 'Gävle', 'Slottsgatan 1', 17.1470593, 60.6731804);

-- --------------------------------------------------------

--
-- Table structure for table `edit_foretag`
--

CREATE TABLE IF NOT EXISTS `edit_foretag` (
  `currinfo` text,
  `cihash` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tele` varchar(20) DEFAULT NULL,
  `logurl` varchar(256) DEFAULT NULL,
  `logbredd` int(11) DEFAULT NULL,
  `loghojd` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `allminfo` text,
  `aihash` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `forecolor` varchar(7) DEFAULT NULL,
  `backcolor` varchar(7) DEFAULT NULL,
  `ikonid` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `meddelande` int(11) DEFAULT NULL,
  `kontraktid` int(11) NOT NULL,
  PRIMARY KEY (`kontraktid`),
  KEY `kontraktid` (`kontraktid`),
  KEY `status` (`status`),
  KEY `ikonid` (`ikonid`),
  KEY `meddelande` (`meddelande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `edit_kntper`
--

CREATE TABLE IF NOT EXISTS `edit_kntper` (
  `fornamn` varchar(50) DEFAULT NULL,
  `efternamn` varchar(50) DEFAULT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `meddelande` int(11) DEFAULT NULL,
  `kontaktid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`kontaktid`),
  KEY `kontraktid` (`kontaktid`),
  KEY `status` (`status`),
  KEY `meddelande` (`meddelande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `tilladmin` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `fronid` (`fronid`),
  KEY `tillid` (`tilladmin`),
  KEY `medstatus` (`medstatus`),
  KEY `feltypid` (`feltypid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `felmeddelande`
--

INSERT INTO `felmeddelande` (`ID`, `text`, `medstatus`, `feltypid`, `fronid`, `tilladmin`) VALUES
(11, 'fsfsdfsddsf', 2, 1, 'WaynesA', 0);

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
(1, 'Oläst'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
('556009-9581', 'Kafe Edbom AB'),
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
('DavidO', 'David', 'Olsson', '0706181853', 'dav.olsson@gmail.com', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 1),
('Edbom', 'Kafé', 'Edbom', '123456789', 'nbt11nsn@student.hig.se', '$2y$10$Tk.1693nsr3GZw/T05bumuK5R4Vr5fF/D.czZTy4K9nsCEhxvDO9.', 0),
('WaynesA', 'Waynes', 'Aktiebolag', '084021700', 'info@waynescoffee.com', '$2y$10$cvarZJIs0fAice2XYgVgqOv7AtabPwRWQ4eVHNTbqgkrJzgR1W6da', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `kontorsnamn` varchar(50) NOT NULL,
  `sbesok` date NOT NULL DEFAULT '0000-00-00',
  `currinfo` text,
  `cihash` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `tele` varchar(20) DEFAULT NULL,
  `stn` int(11) unsigned NOT NULL,
  `logurl` varchar(256) DEFAULT NULL,
  `logbredd` int(11) DEFAULT NULL,
  `loghojd` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `allminfo` text,
  `aihash` varchar(64) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `cihash`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `aihash`, `forecolor`, `backcolor`, `kontaktpersonid`, `ikonid`, `orgnr`) VALUES
(9, 'Wayne´s Coffee', '2015-01-12', 'Wayne´s Friends är vår kundklubb med ett inbyggt digitalt stämpelkort. För varje varm eller kall kaffedryck du köper får du en stämpel i ditt digitala stämpelkort. När du samlat ihop nio stämplar får du den 10:e koppen gratis.', '19eea01295d88401718c30319ace4a26', '08-402 17 00', 1, 'image/logo/kontrakt9.jpg', 100, 100, 'http://www.waynescoffee.se/', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.', 'de389c2f6931684eaa8a3db7d6b025b8', '#0410a2', '#ffffff', 'WaynesA', 2, '556345-1201'),
(10, 'Wayne´s Coffee', '2015-01-12', 'Wayne´s Friends är vår kundklubb med ett inbyggt digitalt stämpelkort. För varje varm eller kall kaffedryck du köper får du en stämpel i ditt digitala stämpelkort. När du samlat ihop nio stämplar får du den 10:e koppen gratis.', '19eea01295d88401718c30319ace4a26', '08-402 17 00', 1, 'image/logo/kontrakt10.jpg', 100, 100, 'http://www.waynescoffee.se/', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.', 'de389c2f6931684eaa8a3db7d6b025b8', '#0410a2', '#ffffff', 'WaynesA', 2, '556345-1201'),
(11, 'Kafe Edbom', '2015-01-12', 'Alltid nybryggt kaffe. Gör egna smörgåsar och sallader. Hembakat kaffebröd. Lättare luncher och smörgåstårtor.', '044a5759fdc4ebea6b9c26f2e8d2a25f', '026-179431', 1, 'image/logo/kontrakt11.jpg', 100, 100, '', '<br />\r\nKafé Edbom ligger centralt i stadsbiblioteket och är en naturlig mötesplats. Här kan du läsa en bok eller tidning medan du dricker en kopp kaffe. Vi har både svenska och utländska dagstidningar och tidskrifter.', 'f3d3556c36afd9d2421520df7344fdd9', '#ffffff', '#000000', 'Edbom', 2, '556009-9581');

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
-- Table structure for table `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `meddelande` text NOT NULL,
  `kontraktid` int(11) DEFAULT NULL,
  `kontaktid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `kontraktid` (`kontraktid`),
  KEY `kontaktid` (`kontaktid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

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
(9, 1, '11:00:00', '22:00:00'),
(9, 2, '09:30:00', '22:00:00'),
(9, 3, '09:30:00', '22:00:00'),
(9, 4, '09:30:00', '22:00:00'),
(9, 5, '09:30:00', '22:00:00'),
(9, 6, '09:30:00', '22:00:00'),
(9, 7, '10:00:00', '22:00:00'),
(10, 1, '11:00:00', '22:00:00'),
(10, 2, '09:30:00', '22:00:00'),
(10, 3, '09:30:00', '22:00:00'),
(10, 4, '09:30:00', '22:00:00'),
(10, 5, '09:30:00', '22:00:00'),
(10, 6, '09:30:00', '22:00:00'),
(10, 7, '10:00:00', '22:00:00'),
(11, 2, '08:00:00', '18:00:00'),
(11, 3, '08:00:00', '18:00:00'),
(11, 4, '08:00:00', '18:00:00'),
(11, 5, '08:00:00', '18:00:00'),
(11, 6, '10:00:00', '16:00:00'),
(11, 7, '10:00:00', '16:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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
  ADD CONSTRAINT `edit_foretag_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
  ADD CONSTRAINT `edit_foretag_ibfk_2` FOREIGN KEY (`meddelande`) REFERENCES `msg` (`ID`) ON DELETE SET NULL,
  ADD CONSTRAINT `kontrakt_ibfk_3` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
  ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Constraints for table `edit_kntper`
--
ALTER TABLE `edit_kntper`
  ADD CONSTRAINT `edit_kntper_ibfk_1` FOREIGN KEY (`kontaktid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `edit_kntper_ibfk_2` FOREIGN KEY (`meddelande`) REFERENCES `msg` (`ID`) ON DELETE SET NULL,
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
  ADD CONSTRAINT `felmeddelande_ifbk_1` FOREIGN KEY (`fronid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `felmeddelande_ifbk_3` FOREIGN KEY (`medstatus`) REFERENCES `felstatus` (`ID`),
  ADD CONSTRAINT `felmeddelande_ifbk_4` FOREIGN KEY (`feltypid`) REFERENCES `feltyp` (`ID`);

--
-- Constraints for table `kontrakt`
--
ALTER TABLE `kontrakt`
  ADD CONSTRAINT `ikon_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
  ADD CONSTRAINT `kontrakt_ibfk_1` FOREIGN KEY (`kontaktpersonid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
  ADD CONSTRAINT `orgnr_ibfk_1` FOREIGN KEY (`orgnr`) REFERENCES `foretag` (`orgnr`) ON DELETE CASCADE;

--
-- Constraints for table `msg`
--
ALTER TABLE `msg`
  ADD CONSTRAINT `msg_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `msg_ibfk_2` FOREIGN KEY (`kontaktid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `specialtider_ibfk_2` FOREIGN KEY (`veckodagarid`) REFERENCES `veckodagar` (`ID`),
  ADD CONSTRAINT `specialtider_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
