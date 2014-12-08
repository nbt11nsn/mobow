-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 08 dec 2014 kl 15:16
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumpning av Data i tabell `adress`
--

INSERT INTO `adress` (`ID`, `postnr`, `stad`, `gata`, `lng`, `lat`) VALUES
(1, 80320, 'Gävle', 'Stortorget 1', 17.1420337, 60.6748389),
(2, 91232, 'Vilhelmina', 'Postgatan 3', 16.6547774, 64.6230765),
(3, 77670, 'Vikmanshyttan', 'Rostugnsvägen 3', 15.8253629, 60.2930402),
(4, 95391, 'Haparanda', 'Kukkolaforsen 184', 24.0548527, 65.9591007),
(5, 95336, 'Haparanda', 'Norrskensvägen 2', 24.1324517, 65.8429222),
(6, 80302, 'Gävle', 'Alderholmsgatan 7', 17.16285760793459, 60.6786653779345);

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
`ID` int(11) NOT NULL,
  `kontorsnamn` varchar(50) DEFAULT NULL,
  `tele` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` mediumtext,
  `allminfo` mediumtext,
  `logurl` varchar(256) DEFAULT NULL,
  `ikonid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `meddelande` mediumtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `status` int(11) DEFAULT NULL,
  `meddelande` mediumtext
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumpning av Data i tabell `faktura`
--

INSERT INTO `faktura` (`ID`, `namn`, `url`, `agarid`, `datum`) VALUES
(1, 'faktura1faktura1faktura1faktura1faktura1faktura1fa', 'faktura\\faktura1.pdf', 1, '2014-12-01'),
(2, 'faktura2', 'faktura\\faktura2.pdf', 2, '2014-12-03'),
(3, 'faktura3', 'faktura\\faktura1.pdf', 1, '2014-11-04'),
(4, 'faktura4', 'faktura\\faktura1.pdf', 1, '2013-07-16'),
(5, 'faktura5', 'faktura\\faktura1.pdf', 1, '2014-12-10'),
(6, 'faktura6', 'faktura\\faktura1.pdf', 1, '2014-08-19'),
(7, 'faktura7', 'faktura\\faktura1.pdf', 2, '2014-08-19');

-- --------------------------------------------------------

--
-- Tabellstruktur `felmeddelande`
--

CREATE TABLE IF NOT EXISTS `felmeddelande` (
`ID` int(11) NOT NULL,
  `text` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `feltypid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
`ID` int(11) NOT NULL,
  `feltext` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `foretag`
--

CREATE TABLE IF NOT EXISTS `foretag` (
`ID` int(11) NOT NULL,
  `orgnr` varchar(20) NOT NULL,
  `namn` varchar(50) NOT NULL,
  `tele` int(11) DEFAULT NULL,
  `kontaktpersid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `ikontyp`
--

CREATE TABLE IF NOT EXISTS `ikontyp` (
`ID` int(11) NOT NULL,
  `imgurl` varchar(256) NOT NULL,
  `typ` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumpning av Data i tabell `ikontyp`
--

INSERT INTO `ikontyp` (`ID`, `imgurl`, `typ`) VALUES
(1, 'image/restaurang24x32.png', 'Restaurang'),
(2, 'image/cafe31x32.png', 'Café');

-- --------------------------------------------------------

--
-- Tabellstruktur `kontaktperson`
--

CREATE TABLE IF NOT EXISTS `kontaktperson` (
  `anvnamn` varchar(50) NOT NULL,
  `fornamn` varchar(50) NOT NULL,
  `efternamn` varchar(50) NOT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) NOT NULL,
  `losen` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumpning av Data i tabell `kontaktperson`
--

INSERT INTO `kontaktperson` (`anvnamn`, `fornamn`, `efternamn`, `mobil`, `mejl`, `losen`, `admin`) VALUES
('admin', 'administrator', 'mobow', 123456789, 'nbt11nsn@student.hig.se', '$2y$10$Uat1/q0s8A6X2.SG9HKCkeB6xPzbYHtjZe.9iEO43EmoaVEv2Tfm2', 1),
('KarlL', 'Karl', 'Lundh', 345678912, 'nbt11nsn@student.hig.se', 'mobow', 2),
('NiklasS', 'Niklas', 'Sjögren', 234567891, 'nbt11nsn@student.hig.se', 'mobow', 3),
('test', 'Rickard', 'Hedlund', 456789123, 'nbt11nsn@student.hig.se', 'asdlkj', 4);

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
  `stn` int(11) NOT NULL,
  `logurl` varchar(256) DEFAULT NULL,
  `logbredd` int(11) DEFAULT NULL,
  `loghojd` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` text,
  `allminfo` text,
  `forecolor` varchar(7) NOT NULL DEFAULT '#000000',
  `backcolor` varchar(7) NOT NULL DEFAULT '#FFFFFF',
  `kontaktpersonid` varchar(50) NOT NULL,
  `adressid` int(11) NOT NULL,
  `ikonid` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumpning av Data i tabell `kontrakt`
--

INSERT INTO `kontrakt` (`ID`, `kontorsnamn`, `sbesok`, `currinfo`, `tele`, `stn`, `logurl`, `logbredd`, `loghojd`, `hemsida`, `oppet`, `allminfo`, `forecolor`, `backcolor`, `kontaktpersonid`, `adressid`, `ikonid`) VALUES
(1, 'Gevalia', '2014-06-05', '', '', 1, NULL, NULL, NULL, 'http://www.google.com/', 'mån-fre: 9:00-22:00\r\nsön: 10:03-10:33\r\nannars: stängt', 'random grejs', '#000000', '#ffffff', 'admin', 1, 1),
(2, 'Discovery', '2014-09-16', 'sfdlkjsfdjkllkjdsf', '', 3, 'image/logo/logo0.png', 32, 32, 'http://www.aftonbladet.se/', 'STÄNGT!!!', '', '#ff00ff', '#000000', 'NiklasS', 2, 2),
(3, 'Rubinola', '2014-05-05', NULL, '', 2, 'image/logo/04earth.png', 256, 256, 'http://www.gd.se/', 'mån-sön: 01:30-03:30', 'massa text<br />\r\nmassa text<br />\r\nmassa text<br />\r\nmassa text<br />\r\nmassa text<br />\r\nmassa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text<br />\r\nmassa text massa text massa text', '#000000', '#ffffff', 'NiklasS', 3, 1),
(4, 'Solen', '2014-09-16', '', '012341234', 2, 'image/logo/08saturn.png', 256, 256, 'http://sv.wikipedia.org/wiki/', 'mån-sön: 00:00-24:00', '', '#abcdef', '#543210', 'KarlL', 4, 1),
(5, 'Svarta hålet', '2014-09-16', NULL, NULL, 10000, 'image/logo/blackhole.png', 256, 256, NULL, 'mån-sön: 10:03-10:04', 'HEJHEJHEJHEJ', '#FF0000', '#00FFFF', 'test', 5, 2),
(6, 'Wayne''s Coffee', '2014-05-28', NULL, '', 1, 'image/logo/wayne.jpg', 100, 100, 'http://www.waynescoffee.se/menyer.aspx', 'Vardag 9 - 19<br />\r\nLördag 11 - 18<br />\r\nSöndag 12 - 18', 'Vi på Wayne´s Coffee vill ge människor en möjlighet att ta en paus i vardagen, en stund av avkoppling. Wayne´s Coffee har blivit känt som ”det tredje rummet”, en mötesplats mellan arbetet och hemmet. En frizon där vänner träffas och tar en fika tillsammans. I våra caféer erbjudes  kaffe av eget märke, bakverk från eget bageri och mat med naturliga råvaror av hög kvalité.<br />\r\n', '#000000', '#ffffff', 'admin', 6, 2);

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
(1, 'Mån', 'Måndag'),
(2, 'Tis', 'Tisdag'),
(3, 'Ons', 'Onsdag'),
(4, 'Tors', 'Torsdag'),
(5, 'Fre', 'Fredag'),
(6, 'Lör', 'Lördag'),
(7, 'Sön', 'Söndag');

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
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `edit_kntper`
--
ALTER TABLE `edit_kntper`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `faktura`
--
ALTER TABLE `faktura`
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
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
 ADD PRIMARY KEY (`ID`);

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
 ADD PRIMARY KEY (`ID`);

--
-- Index för tabell `oppettider`
--
ALTER TABLE `oppettider`
 ADD PRIMARY KEY (`kontraktid`,`veckodagarid`);

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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT för tabell `bestallning`
--
ALTER TABLE `bestallning`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `edit_foretag`
--
ALTER TABLE `edit_foretag`
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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT för tabell `felmeddelande`
--
ALTER TABLE `felmeddelande`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `feltyp`
--
ALTER TABLE `feltyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `foretag`
--
ALTER TABLE `foretag`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `ikontyp`
--
ALTER TABLE `ikontyp`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT för tabell `produkt`
--
ALTER TABLE `produkt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `veckodagar`
--
ALTER TABLE `veckodagar`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
