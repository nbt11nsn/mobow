-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- V�rd: 127.0.0.1
-- Tid vid skapande: 09 jan 2015 kl 09:47
-- Serverversion: 5.6.20
-- PHP-version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `mobowdb`
--
CREATE DATABASE IF NOT EXISTS `mobowdb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mobowdb`;

-- --------------------------------------------------------

--
-- Tabellstruktur `adress`
--

CREATE TABLE IF NOT EXISTS `adress` (
`ID` int(11) NOT NULL,
  `postnr` int(11) DEFAULT NULL,
  `stad` varchar(100) NOT NULL,
  `gata` varchar(100) NOT NULL,
  `lng` double NOT NULL,
  `lat` double NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(2, 91232, 'Vilhelmina', 'Postgatan 3', 16.6547774, 64.6230765),
(3, 80320, 'G�vle', 'Stortorget 1', 15.8253629, 60.2930402),
(4, 95391, 'Haparanda', 'Kukkolaforsen 184', 24.0548527, 65.9591007),
(5, 95336, 'Haparanda', 'Norrskensv�gen 2', 24.1324517, 65.8429222),
(6, 80302, 'G�vle', 'Alderholmsgatan 7', 17.16285760793459, 60.6786653779345),
(8, 80252, 'G�vle', 'Mobowgatan 52', 17.192, 60.673);

-- --------------------------------------------------------

--
-- Tabellstruktur `edit_foretag`
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
  `kontraktid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `edit_foretag`
--

INSERT INTO `edit_foretag` (`currinfo`, `tele`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `forecolor`, `backcolor`, `ikonid`, `status`, `meddelande`, `kontraktid`) VALUES
('', 12341234, NULL, NULL, NULL, 'http://sv.wikipedia.org/wiki/', '', '#abcdef', '#543210', NULL, 1, NULL, 4);

-- --------------------------------------------------------

--
-- Tabellstruktur `edit_kntper`
--

CREATE TABLE IF NOT EXISTS `edit_kntper` (
`ID` int(11) NOT NULL,
  `fornamn` varchar(50) DEFAULT NULL,
  `efternamn` varchar(50) DEFAULT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `meddelande` mediumtext,
  `kontaktid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `edit_kntper`
--

INSERT INTO `edit_kntper` (`ID`, `fornamn`, `efternamn`, `mobil`, `mejl`, `status`, `meddelande`, `kontaktid`) VALUES
(1, 'sefj', 'sfdj', NULL, NULL, 1, NULL, 'KarlL');

-- --------------------------------------------------------

--
-- Tabellstruktur `faktura`
--

CREATE TABLE IF NOT EXISTS `faktura` (
`ID` int(11) NOT NULL,
  `namn` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `agarid` int(11) NOT NULL,
  `datum` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumpning av Data i tabell `faktura`
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
-- Tabellstruktur `felmeddelande`
--

CREATE TABLE IF NOT EXISTS `felmeddelande` (
`ID` int(11) NOT NULL,
  `text` text NOT NULL,
  `medstatus` int(11) NOT NULL DEFAULT '1',
  `feltypid` int(11) NOT NULL,
  `fronid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `tillid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumpning av Data i tabell `felmeddelande`
--

INSERT INTO `felmeddelande` (`ID`, `text`, `medstatus`, `feltypid`, `fronid`, `tillid`) VALUES
(18, 'test', 2, 12, 'AndersB', 'AdminM'),
(19, 'Hej', 2, 13, 'AndersB', 'AdminM'),
(20, 'Hej', 2, 14, 'KarlL', 'AdminM'),
(21, 'asopdjaposjdaspodjaopsjd', 2, 15, 'AndersB', 'AdminM'),
(22, 'Heeej', 2, 16, 'AndersB', 'AdminM'),
(23, 'asdasd', 2, 16, 'AndersB', 'AdminM'),
(24, 'asdasdasdasd', 4, 16, 'AdminM', 'AndersB'),
(25, 'Chaaa', 2, 16, 'AndersB', 'AdminM'),
(26, 'SASDASD', 4, 14, 'AdminM', 'KarlL'),
(27, 'Coolio', 4, 16, 'AndersB', 'AdminM');

-- --------------------------------------------------------

--
-- Tabellstruktur `felstatus`
--

CREATE TABLE IF NOT EXISTS `felstatus` (
`ID` int(11) NOT NULL,
  `info` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `felstatus`
--

INSERT INTO `felstatus` (`ID`, `info`) VALUES
(1, 'Ol�st'),
(2, 'Mottagen'),
(3, 'P�b�rjad'),
(4, 'Avslutad');

-- --------------------------------------------------------

--
-- Tabellstruktur `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
`ID` int(11) NOT NULL,
  `feltext` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumpning av Data i tabell `feltyp`
--

INSERT INTO `feltyp` (`ID`, `feltext`) VALUES
(1, 'Kabelbrott'),
(2, 'Startar inte'),
(3, 'Laddar inte'),
(12, 'Test'),
(13, 'Hej'),
(14, 'Kaos'),
(15, 'UOAhsdo'),
(16, 'Tjena'),
(17, 'Tjena');

-- --------------------------------------------------------

--
-- Tabellstruktur `foretag`
--

CREATE TABLE IF NOT EXISTS `foretag` (
  `orgnr` varchar(20) NOT NULL,
  `namn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `foretag`
--

INSERT INTO `foretag` (`orgnr`, `namn`) VALUES
('133737-1337', 'leet org.'),
('225454-3458', 'Rubinola AB'),
('262648-2356', 'Solen AB'),
('454545-4545', 'Gevalia AB'),
('548795-3251', 'Svarta h�let AB'),
('556345-1201', 'Wayne och Margareta''s Coffee Aktiebolag'),
('910413-1234', 'Mobow');

-- --------------------------------------------------------

--
-- Tabellstruktur `ikontyp`
--

CREATE TABLE IF NOT EXISTS `ikontyp` (
`ID` int(11) NOT NULL,
  `opimgurl` varchar(256) NOT NULL,
  `stimgurl` varchar(256) NOT NULL,
  `typ` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `ikontyp`
--

INSERT INTO `ikontyp` (`ID`, `opimgurl`, `stimgurl`, `typ`) VALUES
(1, 'image/grestaurang24x32.png', 'image/restaurang24x32.png', 'Restaurang'),
(2, 'image/gcafe31x32.png', 'image/cafe31x32.png', 'Caf�');

-- --------------------------------------------------------

--
-- Tabellstruktur `kontaktperson`
--

CREATE TABLE IF NOT EXISTS `kontaktperson` (
  `anvnamn` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `fornamn` varchar(50) NOT NULL,
  `efternamn` varchar(50) NOT NULL,
  `mobil` varchar(20) DEFAULT NULL,
  `mejl` varchar(50) NOT NULL,
  `losen` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `kontaktperson`
--

INSERT INTO `kontaktperson` (`anvnamn`, `fornamn`, `efternamn`, `mobil`, `mejl`, `losen`, `admin`) VALUES
('AdminM', 'Administrator', 'Mobow', '123456789', 'nbt11nsn@student.hig.se', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 1),
('AndersB', 'Anders', 'Blomkvist', '723548795', 'nbt11nsn@student.hig.se', '$2y$10$zSW6TYJoE8XN9b5GZ0x.gePOHtcmPeR9auIIzQ87dXPXq0DMM5VCu', 0),
('DavidO', 'David', 'Olsson', '0123456789', 'kundtjanst@mobow.se', '$2y$10$.LODvRTvWP8HJPwFWCQ82uZO/nz/PIQxKDoHHnDmrIOQF/jEzeHVC', 1),
('KarlL', 'Karl', 'Lundh', '345678912', 'nbt11nsn@student.hig.se', '$2y$10$yAJqNxkCcl/3zHfm.WBAxuJa85z4Frj4KOQIhD7hdxQ97SamIaXz6', 0),
('MattiasD', 'Mattias', 'Didriksson', '732154879', 'nbt11nsn@student.hig.se', '$2y$10$jLjW0w8A.nhdno2ArRNcDO4NPEtdjC4UG48/VAMc6psre8XUunF.K', 0),
('NiklasS', 'Niklas', 'Sj�gren', '234567891', 'nbt11nsn@student.hig.se', '$2y$10$AcIafMqd0GgCAzgog7eJIO.9GOH2FaJ.0NpxT4nsuLUCYJenOqrNG', 0),
('RickardH', 'Rickard', 'Hedlund', '456789123', 'nbt11nsn@student.hig.se', '$2y$10$VWMASYpv0PD3a9uaHMna6uA5Lhkab/ejhpnRNc6c/Dp1Q4xrgdpy6', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
`ID` int(11) NOT NULL,
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
  `orgnr` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `forecolor`, `backcolor`, `kontaktpersonid`, `ikonid`, `orgnr`) VALUES
(2, 'Gevalia S�der', '2014-09-16', 'sfdlkjsfdjkllkjdsf', '026-54875', 5, 'image/logo/logo0.png', 32, 32, 'http://www.aftonbladet.se/', '', '#ff00ff', '#000000', 'KarlL', 2, '454545-4545'),
(3, 'Gevalia Norr', '2014-06-04', '', '026-78458', 3, 'image/logo/04earth.png', 256, 256, 'http://www.google.com/', 'random grejs', '#000000', '#ffffff', 'KarlL', 1, '225454-3458'),
(4, 'Solen', '2014-09-16', '', '012341234', 2, 'image/logo/08saturn.png', 256, 256, 'http://sv.wikipedia.org/wiki/', '', '#abcdef', '#543210', 'MattiasD', 1, '262648-2356'),
(5, 'Svarta h�let', '2014-09-16', NULL, '020-548454', 15, 'image/logo/blackhole.png', 256, 256, NULL, 'HEJHEJHEJHEJ', '#FF0000', '#00FFFF', 'RickardH', 2, '548795-3251'),
(6, 'Wayne''s Coffee', '2014-05-28', NULL, '026-52454', 1, 'image/logo/wayne.jpg', 100, 100, 'http://www.waynescoffee.se/menyer.aspx', 'Vi p� Wayne�s Coffee vill ge m�nniskor en m�jlighet att ta en paus i vardagen, en stund av avkoppling. Wayne�s Coffee har blivit k�nt som �det tredje rummet�, en m�tesplats mellan arbetet och hemmet. En frizon d�r v�nner tr�ffas och tar en fika tillsammans. I v�ra caf�er erbjudes  kaffe av eget m�rke, bakverk fr�n eget bageri och mat med naturliga r�varor av h�g kvalit�.<br />\r\n', '#000000', '#ffffff', 'AndersB', 2, '556345-1201'),
(8, 'Mobow', '2014-12-16', 'Livet ska inte styras av din batterim�tares siffror!', '123456789', 9, 'image/logo/kontraktMobow.png', 32, 32, 'http://www.mobow.se/', 'Mobilen �r v�rt fr�msta redskap med intill obegr�nsade anv�ndningsomr�den. En dag utan mobil �r f�r de flesta ot�nkbart.\r\nKorta batteritider begr�nsar oss och v�r kontakt med v�rlden. Mobow g�r din mobilanv�ndning gr�nsl�s.', '#634263', '#c1c1c1', 'DavidO', 1, '910413-1234');

-- --------------------------------------------------------

--
-- Tabellstruktur `medstatus`
--

CREATE TABLE IF NOT EXISTS `medstatus` (
`ID` int(11) NOT NULL,
  `Info` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `medstatus`
--

INSERT INTO `medstatus` (`ID`, `Info`) VALUES
(1, 'Ol�st'),
(2, 'Godk�nd'),
(3, 'Nekad');

-- --------------------------------------------------------

--
-- Tabellstruktur `oppettider`
--

CREATE TABLE IF NOT EXISTS `oppettider` (
  `kontraktid` int(11) NOT NULL,
  `veckodagarid` int(11) NOT NULL,
  `oppet` time DEFAULT NULL,
  `stangt` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `oppettider`
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
-- Tabellstruktur `specialtider`
--

CREATE TABLE IF NOT EXISTS `specialtider` (
`ID` int(11) NOT NULL,
  `kontraktid` int(11) NOT NULL,
  `specstart` date NOT NULL,
  `specslut` date NOT NULL,
  `veckodagarid` int(11) NOT NULL,
  `altoppet` time NOT NULL,
  `altstangt` time NOT NULL,
  `stangt` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `veckodagar`
--

CREATE TABLE IF NOT EXISTS `veckodagar` (
`ID` int(11) NOT NULL,
  `akro` varchar(4) NOT NULL,
  `veckonamn` varchar(8) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumpning av Data i tabell `veckodagar`
--

INSERT INTO `veckodagar` (`ID`, `akro`, `veckonamn`) VALUES
(1, 'sun', 'S�ndag'),
(2, 'mon', 'M�ndag'),
(3, 'thue', 'Tisdag'),
(4, 'wen', 'Onsdag'),
(5, 'thur', 'Torsdag'),
(6, 'fri', 'Fredag'),
(7, 'sat', 'L�rdag');

--
-- Index f�r dumpade tabeller
--

--
-- Index f�r tabell `adress`
--
ALTER TABLE `adress`
 ADD PRIMARY KEY (`ID`);

--
-- Index f�r tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
 ADD PRIMARY KEY (`kontraktid`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `status` (`status`);

--
-- Index f�r tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
 ADD PRIMARY KEY (`ID`), ADD KEY `kontraktid` (`kontaktid`), ADD KEY `status` (`status`);

--
-- Index f�r tabell `faktura`
--
ALTER TABLE `faktura`
 ADD PRIMARY KEY (`ID`), ADD KEY `agarid` (`agarid`);

--
-- Index f�r tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
 ADD PRIMARY KEY (`ID`), ADD KEY `fronid` (`fronid`), ADD KEY `tillid` (`tillid`), ADD KEY `medstatus` (`medstatus`), ADD KEY `feltypid` (`feltypid`);

--
-- Index f�r tabell `felstatus`
--
ALTER TABLE `felstatus`
 ADD PRIMARY KEY (`ID`);

--
-- Index f�r tabell `feltyp`
--
ALTER TABLE `feltyp`
 ADD PRIMARY KEY (`ID`);

--
-- Index f�r tabell `foretag`
--
ALTER TABLE `foretag`
 ADD PRIMARY KEY (`orgnr`);

--
-- Index f�r tabell `ikontyp`
--
ALTER TABLE `ikontyp`
 ADD PRIMARY KEY (`ID`);

--
-- Index f�r tabell `kontaktperson`
--
ALTER TABLE `kontaktperson`
 ADD PRIMARY KEY (`anvnamn`), ADD UNIQUE KEY `anvnamn` (`anvnamn`);

--
-- Index f�r tabell `kontrakt`
--
ALTER TABLE `kontrakt`
 ADD PRIMARY KEY (`ID`), ADD KEY `ikonid` (`ikonid`), ADD KEY `kontaktpersonid` (`kontaktpersonid`), ADD KEY `foretagid` (`orgnr`), ADD KEY `foretagid_2` (`orgnr`), ADD KEY `orgnr` (`orgnr`);

--
-- Index f�r tabell `medstatus`
--
ALTER TABLE `medstatus`
 ADD PRIMARY KEY (`ID`);

--
-- Index f�r tabell `oppettider`
--
ALTER TABLE `oppettider`
 ADD PRIMARY KEY (`kontraktid`,`veckodagarid`), ADD KEY `veckodagarid` (`veckodagarid`);

--
-- Index f�r tabell `specialtider`
--
ALTER TABLE `specialtider`
 ADD PRIMARY KEY (`ID`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `kontraktid_2` (`kontraktid`,`veckodagarid`), ADD KEY `veckodagarid` (`veckodagarid`);

--
-- Index f�r tabell `veckodagar`
--
ALTER TABLE `veckodagar`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT f�r dumpade tabeller
--

--
-- AUTO_INCREMENT f�r tabell `adress`
--
ALTER TABLE `adress`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT f�r tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT f�r tabell `faktura`
--
ALTER TABLE `faktura`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT f�r tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT f�r tabell `felstatus`
--
ALTER TABLE `felstatus`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT f�r tabell `feltyp`
--
ALTER TABLE `feltyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT f�r tabell `ikontyp`
--
ALTER TABLE `ikontyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT f�r tabell `kontrakt`
--
ALTER TABLE `kontrakt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT f�r tabell `medstatus`
--
ALTER TABLE `medstatus`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT f�r tabell `specialtider`
--
ALTER TABLE `specialtider`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT f�r tabell `veckodagar`
--
ALTER TABLE `veckodagar`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restriktioner f�r dumpade tabeller
--

--
-- Restriktioner f�r tabell `adress`
--
ALTER TABLE `adress`
ADD CONSTRAINT `kontrakt_ibfk_10` FOREIGN KEY (`ID`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE;

--
-- Restriktioner f�r tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
ADD CONSTRAINT `kontrakt_ibfk_3` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Restriktioner f�r tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
ADD CONSTRAINT `edit_kntper_ibfk_1` FOREIGN KEY (`kontaktid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Restriktioner f�r tabell `faktura`
--
ALTER TABLE `faktura`
ADD CONSTRAINT `kontrakt_ibfk_2` FOREIGN KEY (`agarid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE;

--
-- Restriktioner f�r tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
ADD CONSTRAINT `felmeddelande_ifbk_1` FOREIGN KEY (`fronid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `felmeddelande_ifbk_2` FOREIGN KEY (`tillid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `felmeddelande_ifbk_3` FOREIGN KEY (`medstatus`) REFERENCES `felstatus` (`ID`),
ADD CONSTRAINT `felmeddelande_ifbk_4` FOREIGN KEY (`feltypid`) REFERENCES `feltyp` (`ID`);

--
-- Restriktioner f�r tabell `kontrakt`
--
ALTER TABLE `kontrakt`
ADD CONSTRAINT `ikon_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
ADD CONSTRAINT `kontrakt_ibfk_1` FOREIGN KEY (`kontaktpersonid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `orgnr_ibfk_1` FOREIGN KEY (`orgnr`) REFERENCES `foretag` (`orgnr`) ON DELETE CASCADE;

--
-- Restriktioner f�r tabell `oppettider`
--
ALTER TABLE `oppettider`
ADD CONSTRAINT `kontraktid_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `veckodagar_ibfk_1` FOREIGN KEY (`veckodagarid`) REFERENCES `veckodagar` (`ID`);

--
-- Restriktioner f�r tabell `specialtider`
--
ALTER TABLE `specialtider`
ADD CONSTRAINT `specialtider_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `feltyp` (`ID`),
ADD CONSTRAINT `specialtider_ibfk_2` FOREIGN KEY (`veckodagarid`) REFERENCES `kontrakt` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
