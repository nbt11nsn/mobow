-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 12 jan 2015 kl 14:55
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(9, 80302, 'Gävle', 'Alderholmsgatan 7', 17.1631151, 60.6786286),
(10, 80320, 'Gävle', 'Drottninggatan 4', 17.1399135, 60.673322),
(11, 80250, 'Gävle', 'Slottsgatan 1', 17.1470593, 60.6731804);

-- --------------------------------------------------------

--
-- Tabellstruktur `edit_foretag`
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
  `kontraktid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `edit_kntper`
--

CREATE TABLE IF NOT EXISTS `edit_kntper` (
  `fornamn` varchar(50) DEFAULT NULL,
  `efternamn` varchar(50) DEFAULT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `meddelande` int(11) DEFAULT NULL,
  `kontaktid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

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
(1, 'Oläst'),
(2, 'Mottagen'),
(3, 'Påbörjad'),
(4, 'Avslutad');

-- --------------------------------------------------------

--
-- Tabellstruktur `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
`ID` int(11) NOT NULL,
  `feltext` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `feltyp`
--

INSERT INTO `feltyp` (`ID`, `feltext`) VALUES
(1, 'Kabelbrott'),
(2, 'Startar inte'),
(3, 'Laddar inte'),
(4, 'asfdjkl');

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
('556009-9581', 'Kafe Edbom AB'),
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
(2, 'image/gcafe31x32.png', 'image/cafe31x32.png', 'Café');

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
('DavidO', 'David', 'Olsson', '0706181853', 'dav.olsson@gmail.com', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 1),
('Edbom', 'Kafé', 'Edbom', '123456789', 'nbt11nsn@student.hig.se', '$2y$10$Tk.1693nsr3GZw/T05bumuK5R4Vr5fF/D.czZTy4K9nsCEhxvDO9.', 0),
('WaynesA', 'Waynes', 'Aktiebolag', '084021700', 'info@waynescoffee.com', '$2y$10$cvarZJIs0fAice2XYgVgqOv7AtabPwRWQ4eVHNTbqgkrJzgR1W6da', 0);

-- --------------------------------------------------------

--
-- Tabellstruktur `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
`ID` int(11) NOT NULL,
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
  `orgnr` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumpning av Data i tabell `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `cihash`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `aihash`, `forecolor`, `backcolor`, `kontaktpersonid`, `ikonid`, `orgnr`) VALUES
(9, 'Wayne´s Coffee', '2015-01-12', 'Inget aktuellt just nu', '2d4fa571d16e4cb7976e23a0bd9deb61', '08-402 17 00', 1, 'image/logo/kontrakt9.jpg', 100, 100, 'http://www.waynescoffee.se/', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.', 'de389c2f6931684eaa8a3db7d6b025b8', '#0410a2', '#ffffff', 'WaynesA', 2, '556345-1201'),
(10, 'Wayne´s Coffee', '2015-01-12', NULL, NULL, '08-402 17 00', 1, 'image/logo/kontrakt10.jpg', 100, 100, 'http://www.waynescoffee.se/', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.', 'de389c2f6931684eaa8a3db7d6b025b8', '#0410a2', '#ffffff', 'WaynesA', 2, '556345-1201'),
(11, 'Kafe Edbom', '2015-01-12', NULL, NULL, '026-179431', 1, 'image/logo/kontrakt11.jpg', 100, 100, NULL, 'Alltid nybryggt kaffe. Gör egna smörgåsar och sallader. Hembakat kaffebröd. Lättare luncher och smörgåstårtor.', '044a5759fdc4ebea6b9c26f2e8d2a25f', '#ffffff', '#000000', 'Edbom', 2, '556009-9581');

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
(1, 'Oläst'),
(2, 'Godkänd'),
(3, 'Nekad');

-- --------------------------------------------------------

--
-- Tabellstruktur `msg`
--

CREATE TABLE IF NOT EXISTS `msg` (
`ID` int(11) NOT NULL,
  `meddelande` text NOT NULL,
  `kontraktid` int(11) DEFAULT NULL,
  `kontaktid` varchar(50) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

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
(1, 'sun', 'Söndag'),
(2, 'mon', 'Måndag'),
(3, 'thue', 'Tisdag'),
(4, 'wen', 'Onsdag'),
(5, 'thur', 'Torsdag'),
(6, 'fri', 'Fredag'),
(7, 'sat', 'Lördag');

--
-- Index för dumpade tabeller
--

--
-- Index för tabell `adress`
--
ALTER TABLE `adress`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
 ADD PRIMARY KEY (`kontraktid`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `status` (`status`), ADD KEY `ikonid` (`ikonid`), ADD KEY `meddelande` (`meddelande`);

--
-- Index för tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
 ADD PRIMARY KEY (`kontaktid`), ADD KEY `kontraktid` (`kontaktid`), ADD KEY `status` (`status`), ADD KEY `meddelande` (`meddelande`);

--
-- Index för tabell `faktura`
--
ALTER TABLE `faktura`
 ADD PRIMARY KEY (`ID`), ADD KEY `agarid` (`agarid`);

--
-- Index för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
 ADD PRIMARY KEY (`ID`), ADD KEY `fronid` (`fronid`), ADD KEY `tillid` (`tillid`), ADD KEY `medstatus` (`medstatus`), ADD KEY `feltypid` (`feltypid`);

--
-- Index för tabell `felstatus`
--
ALTER TABLE `felstatus`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `feltyp`
--
ALTER TABLE `feltyp`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `foretag`
--
ALTER TABLE `foretag`
 ADD PRIMARY KEY (`orgnr`);

--
-- Index för tabell `ikontyp`
--
ALTER TABLE `ikontyp`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `kontaktperson`
--
ALTER TABLE `kontaktperson`
 ADD PRIMARY KEY (`anvnamn`), ADD UNIQUE KEY `anvnamn` (`anvnamn`);

--
-- Index för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
 ADD PRIMARY KEY (`ID`), ADD KEY `ikonid` (`ikonid`), ADD KEY `kontaktpersonid` (`kontaktpersonid`), ADD KEY `foretagid` (`orgnr`), ADD KEY `foretagid_2` (`orgnr`), ADD KEY `orgnr` (`orgnr`);

--
-- Index för tabell `medstatus`
--
ALTER TABLE `medstatus`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `msg`
--
ALTER TABLE `msg`
 ADD PRIMARY KEY (`ID`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `kontaktid` (`kontaktid`);

--
-- Index för tabell `oppettider`
--
ALTER TABLE `oppettider`
 ADD PRIMARY KEY (`kontraktid`,`veckodagarid`), ADD KEY `veckodagarid` (`veckodagarid`);

--
-- Index för tabell `specialtider`
--
ALTER TABLE `specialtider`
 ADD PRIMARY KEY (`ID`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `kontraktid_2` (`kontraktid`,`veckodagarid`), ADD KEY `veckodagarid` (`veckodagarid`);

--
-- Index för tabell `veckodagar`
--
ALTER TABLE `veckodagar`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `adress`
--
ALTER TABLE `adress`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT för tabell `faktura`
--
ALTER TABLE `faktura`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT för tabell `felstatus`
--
ALTER TABLE `felstatus`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `feltyp`
--
ALTER TABLE `feltyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `ikontyp`
--
ALTER TABLE `ikontyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT för tabell `medstatus`
--
ALTER TABLE `medstatus`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `msg`
--
ALTER TABLE `msg`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `specialtider`
--
ALTER TABLE `specialtider`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `veckodagar`
--
ALTER TABLE `veckodagar`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Restriktioner för dumpade tabeller
--

--
-- Restriktioner för tabell `adress`
--
ALTER TABLE `adress`
ADD CONSTRAINT `kontrakt_ibfk_10` FOREIGN KEY (`ID`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
ADD CONSTRAINT `edit_foretag_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
ADD CONSTRAINT `edit_foretag_ibfk_2` FOREIGN KEY (`meddelande`) REFERENCES `msg` (`ID`) ON DELETE SET NULL,
ADD CONSTRAINT `kontrakt_ibfk_3` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Restriktioner för tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
ADD CONSTRAINT `edit_kntper_ibfk_1` FOREIGN KEY (`kontaktid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `edit_kntper_ibfk_2` FOREIGN KEY (`meddelande`) REFERENCES `msg` (`ID`) ON DELETE SET NULL,
ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Restriktioner för tabell `faktura`
--
ALTER TABLE `faktura`
ADD CONSTRAINT `kontrakt_ibfk_2` FOREIGN KEY (`agarid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
ADD CONSTRAINT `felmeddelande_ifbk_1` FOREIGN KEY (`fronid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `felmeddelande_ifbk_2` FOREIGN KEY (`tillid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `felmeddelande_ifbk_3` FOREIGN KEY (`medstatus`) REFERENCES `felstatus` (`ID`),
ADD CONSTRAINT `felmeddelande_ifbk_4` FOREIGN KEY (`feltypid`) REFERENCES `feltyp` (`ID`);

--
-- Restriktioner för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
ADD CONSTRAINT `ikon_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
ADD CONSTRAINT `kontrakt_ibfk_1` FOREIGN KEY (`kontaktpersonid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE,
ADD CONSTRAINT `orgnr_ibfk_1` FOREIGN KEY (`orgnr`) REFERENCES `foretag` (`orgnr`) ON DELETE CASCADE;

--
-- Restriktioner för tabell `msg`
--
ALTER TABLE `msg`
ADD CONSTRAINT `msg_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE ON UPDATE NO ACTION,
ADD CONSTRAINT `msg_ibfk_2` FOREIGN KEY (`kontaktid`) REFERENCES `kontaktperson` (`anvnamn`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Restriktioner för tabell `oppettider`
--
ALTER TABLE `oppettider`
ADD CONSTRAINT `kontraktid_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `veckodagar_ibfk_1` FOREIGN KEY (`veckodagarid`) REFERENCES `veckodagar` (`ID`);

--
-- Restriktioner för tabell `specialtider`
--
ALTER TABLE `specialtider`
ADD CONSTRAINT `specialtider_ibfk_1` FOREIGN KEY (`kontraktid`) REFERENCES `feltyp` (`ID`),
ADD CONSTRAINT `specialtider_ibfk_2` FOREIGN KEY (`veckodagarid`) REFERENCES `kontrakt` (`ID`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
