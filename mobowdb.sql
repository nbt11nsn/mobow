-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 07 jan 2015 kl 13:18
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumpning av Data i tabell `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(1, 80320, 'Gävle', 'Stortorget 1', 17.1420337, 60.6748389),
(2, 91232, 'Vilhelmina', 'Postgatan 3', 16.6547774, 64.6230765),
(3, 80320, 'Gävle', 'Stortorget 1', 15.8253629, 60.2930402),
(4, 95391, 'Haparanda', 'Kukkolaforsen 184', 24.0548527, 65.9591007),
(5, 95336, 'Haparanda', 'Norrskensvägen 2', 24.1324517, 65.8429222),
(6, 80302, 'Gävle', 'Alderholmsgatan 7', 17.16285760793459, 60.6786653779345),
(7, 80252, 'Gävle', 'Mobowgatan 52', 17.192, 60.673);

-- --------------------------------------------------------

--
-- Tabellstruktur `bestallning`
--

CREATE TABLE IF NOT EXISTS `bestallning` (
`ID` int(11) NOT NULL,
  `datum` date NOT NULL,
  `foretagsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `kontraktid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
(1, 'faktura1', 'faktura/faktura1.pdf', 1, '2014-12-01'),
(2, 'faktura2', 'faktura/faktura2.pdf', 2, '2014-12-03'),
(3, 'faktura3', 'faktura/faktura1.pdf', 3, '2014-11-04'),
(4, 'faktura4', 'faktura/faktura1.pdf', 4, '2013-07-16'),
(5, 'faktura5', 'faktura/faktura1.pdf', 5, '2014-12-10'),
(6, 'faktura6', 'faktura/faktura1.pdf', 1, '2014-08-19'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumpning av Data i tabell `felmeddelande`
--

INSERT INTO `felmeddelande` (`ID`, `text`, `medstatus`, `feltypid`, `fronid`, `tillid`) VALUES
(4, 'sdfaserasefhzsdfhasdfhsdfhsdfh', 1, 1, 'AndersB', 'AdminM'),
(7, 'Hej', 1, 2, 'AndersB', 'AdminM');

-- --------------------------------------------------------

--
-- Tabellstruktur `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
`ID` int(11) NOT NULL,
  `feltext` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumpning av Data i tabell `feltyp`
--

INSERT INTO `feltyp` (`ID`, `feltext`) VALUES
(1, 'Tjena'),
(2, 'Hej'),
(3, 'Hej');

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
('548795-3251', 'Svarta hålet AB'),
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
('AdminM', 'Administrator', 'Mobow', '123456789', 'nbt11nsn@student.hig.se', '$2y$10$eBrVNjh2cgMgJRty0o2nC.oMUaHON/OaCYR18.2rIhTDV0OrwdPJm', 1),
('AndersB', 'Anders', 'Blomkvist', '723548795', 'nbt11nsn@student.hig.se', '$2y$10$zSW6TYJoE8XN9b5GZ0x.gePOHtcmPeR9auIIzQ87dXPXq0DMM5VCu', 0),
('DavidO', 'David', 'Olsson', '0123456789', 'kundtjanst@mobow.se', '$2y$10$.LODvRTvWP8HJPwFWCQ82uZO/nz/PIQxKDoHHnDmrIOQF/jEzeHVC', 1),
('KarlL', 'Karl', 'Lundh', '345678912', 'nbt11nsn@student.hig.se', '$2y$10$yAJqNxkCcl/3zHfm.WBAxuJa85z4Frj4KOQIhD7hdxQ97SamIaXz6', 0),
('MattiasD', 'Mattias', 'Didriksson', '732154879', 'nbt11nsn@student.hig.se', '$2y$10$jLjW0w8A.nhdno2ArRNcDO4NPEtdjC4UG48/VAMc6psre8XUunF.K', 0),
('NiklasS', 'Niklas', 'Sjögren', '234567891', 'nbt11nsn@student.hig.se', '$2y$10$AcIafMqd0GgCAzgog7eJIO.9GOH2FaJ.0NpxT4nsuLUCYJenOqrNG', 0),
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
  `adressid` int(11) NOT NULL,
  `ikonid` int(11) NOT NULL,
  `orgnr` varchar(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumpning av Data i tabell `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `allminfo`, `forecolor`, `backcolor`, `kontaktpersonid`, `adressid`, `ikonid`, `orgnr`) VALUES
(1, 'Gevalia', '2014-06-05', '', '026-78458', 3, NULL, NULL, NULL, 'http://www.google.com/', 'random grejs', '#000000', '#ffffff', 'NiklasS', 1, 2, '454545-4545'),
(2, 'Gevalia Söder', '2014-09-16', 'sfdlkjsfdjkllkjdsf', '026-54875', 5, 'image/logo/logo0.png', 32, 32, 'http://www.aftonbladet.se/', '', '#ff00ff', '#000000', 'KarlL', 2, 2, '454545-4545'),
(3, 'Gevalia Norr', '2014-06-04', '', '026-78458', 3, 'image/logo/04earth.png', 256, 256, 'http://www.google.com/', 'random grejs', '#000000', '#ffffff', 'KarlL', 3, 1, '225454-3458'),
(4, 'Solen', '2014-09-16', '', '012341234', 2, 'image/logo/08saturn.png', 256, 256, 'http://sv.wikipedia.org/wiki/', '', '#abcdef', '#543210', 'MattiasD', 4, 1, '262648-2356'),
(5, 'Svarta hålet', '2014-09-16', NULL, '020-548454', 15, 'image/logo/blackhole.png', 256, 256, NULL, 'HEJHEJHEJHEJ', '#FF0000', '#00FFFF', 'RickardH', 5, 2, '548795-3251'),
(6, 'Wayne''s Coffee', '2014-05-28', NULL, '026-52454', 1, 'image/logo/wayne.jpg', 100, 100, 'http://www.waynescoffee.se/menyer.aspx', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.<br />\r\n', '#000000', '#ffffff', 'AndersB', 6, 2, '556345-1201'),
(8, 'Mobow', '2014-12-16', 'Livet ska inte styras av din batterimätares siffror!', '123456789', 9, 'image/logo/kontraktMobow.png', 32, 32, 'http://www.mobow.se/', 'Mobilen är vårt främsta redskap med intill obegränsade användningsområden. En dag utan mobil är för de flesta otänkbart.\r\nKorta batteritider begränsar oss och vår kontakt med världen. Mobow gör din mobilanvändning gränslös.', '#634263', '#c1c1c1', 'DavidO', 7, 1, '910413-1234');

-- --------------------------------------------------------

--
-- Tabellstruktur `medstatus`
--

CREATE TABLE IF NOT EXISTS `medstatus` (
`ID` int(11) NOT NULL,
  `Info` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumpning av Data i tabell `medstatus`
--

INSERT INTO `medstatus` (`ID`, `Info`) VALUES
(1, 'Skickad'),
(2, 'Påbörjad'),
(3, 'Avslutad'),
(4, 'Mottagen');

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
(1, 1, '14:00:00', '14:00:00'),
(1, 5, '06:59:00', '14:12:00');

-- --------------------------------------------------------

--
-- Tabellstruktur `probest`
--

CREATE TABLE IF NOT EXISTS `probest` (
  `bestallningsid` int(11) NOT NULL,
  `produktid` int(11) NOT NULL,
  `antal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellstruktur `produkt`
--

CREATE TABLE IF NOT EXISTS `produkt` (
`ID` int(11) NOT NULL,
  `maxbest` int(11) NOT NULL DEFAULT '0',
  `namn` varchar(100) NOT NULL,
  `bildurl` varchar(256) DEFAULT NULL,
  `info` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
-- Index för tabell `bestallning`
--
ALTER TABLE `bestallning`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
 ADD PRIMARY KEY (`kontraktid`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `status` (`status`);

--
-- Index för tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
 ADD PRIMARY KEY (`ID`), ADD KEY `kontraktid` (`kontraktid`), ADD KEY `status` (`status`);

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
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `adressid_2` (`adressid`), ADD KEY `adressid` (`adressid`), ADD KEY `ikonid` (`ikonid`), ADD KEY `kontaktpersonid` (`kontaktpersonid`), ADD KEY `foretagid` (`orgnr`), ADD KEY `foretagid_2` (`orgnr`), ADD KEY `orgnr` (`orgnr`);

--
-- Index för tabell `medstatus`
--
ALTER TABLE `medstatus`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `oppettider`
--
ALTER TABLE `oppettider`
 ADD PRIMARY KEY (`kontraktid`,`veckodagarid`), ADD KEY `veckodagarid` (`veckodagarid`);

--
-- Index för tabell `probest`
--
ALTER TABLE `probest`
 ADD PRIMARY KEY (`bestallningsid`,`produktid`);

--
-- Index för tabell `produkt`
--
ALTER TABLE `produkt`
 ADD PRIMARY KEY (`ID`);

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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `bestallning`
--
ALTER TABLE `bestallning`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `faktura`
--
ALTER TABLE `faktura`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `feltyp`
--
ALTER TABLE `feltyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT för tabell `ikontyp`
--
ALTER TABLE `ikontyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT för tabell `medstatus`
--
ALTER TABLE `medstatus`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT för tabell `produkt`
--
ALTER TABLE `produkt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
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
-- Restriktioner för tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
ADD CONSTRAINT `kontrakt_ibfk_3` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`) ON DELETE CASCADE,
ADD CONSTRAINT `status_ibfk_1` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Restriktioner för tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
ADD CONSTRAINT `kontrakt_ibfk_5` FOREIGN KEY (`kontraktid`) REFERENCES `kontrakt` (`ID`),
ADD CONSTRAINT `status_ibfk_2` FOREIGN KEY (`status`) REFERENCES `medstatus` (`ID`);

--
-- Restriktioner för tabell `faktura`
--
ALTER TABLE `faktura`
ADD CONSTRAINT `kontrakt_ibfk_2` FOREIGN KEY (`agarid`) REFERENCES `kontrakt` (`ID`);

--
-- Restriktioner för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
ADD CONSTRAINT `felmeddelande_ifbk_1` FOREIGN KEY (`fronid`) REFERENCES `kontaktperson` (`anvnamn`),
ADD CONSTRAINT `felmeddelande_ifbk_2` FOREIGN KEY (`tillid`) REFERENCES `kontaktperson` (`anvnamn`),
ADD CONSTRAINT `felmeddelande_ifbk_3` FOREIGN KEY (`medstatus`) REFERENCES `medstatus` (`ID`),
ADD CONSTRAINT `felmeddelande_ifbk_4` FOREIGN KEY (`feltypid`) REFERENCES `feltyp` (`ID`);

--
-- Restriktioner för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
ADD CONSTRAINT `adress_ibfk_1` FOREIGN KEY (`adressid`) REFERENCES `adress` (`ID`),
ADD CONSTRAINT `ikon_ibfk_1` FOREIGN KEY (`ikonid`) REFERENCES `ikontyp` (`ID`),
ADD CONSTRAINT `kontrakt_ibfk_1` FOREIGN KEY (`kontaktpersonid`) REFERENCES `kontaktperson` (`anvnamn`),
ADD CONSTRAINT `orgnr_ibfk_1` FOREIGN KEY (`orgnr`) REFERENCES `foretag` (`orgnr`);

--
-- Restriktioner för tabell `oppettider`
--
ALTER TABLE `oppettider`
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
