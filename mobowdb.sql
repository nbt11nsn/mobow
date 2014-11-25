-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Värd: 127.0.0.1
-- Tid vid skapande: 25 nov 2014 kl 16:25
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
CREATE DATABASE IF NOT EXISTS `mobowdb` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
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
  `long` double NOT NULL,
  `lat` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `bestallning`
--

CREATE TABLE IF NOT EXISTS `bestallning` (
`ID` int(11) NOT NULL,
  `datum` date NOT NULL,
  `foretagsid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `edit_foretag`
--

CREATE TABLE IF NOT EXISTS `edit_foretag` (
`ID` int(11) NOT NULL,
  `kontorsnamn` varchar(50) DEFAULT NULL,
  `tele` int(11) DEFAULT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` text,
  `allminfo` text,
  `logurl` varchar(256) DEFAULT NULL,
  `ikonid` int(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `meddelande` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `meddelande` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `faktura`
--

CREATE TABLE IF NOT EXISTS `faktura` (
`ID` int(11) NOT NULL,
  `namn` varchar(50) NOT NULL,
  `url` varchar(100) NOT NULL,
  `agarid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `felmeddelande`
--

CREATE TABLE IF NOT EXISTS `felmeddelande` (
`ID` int(11) NOT NULL,
  `text` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `feltypid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `feltyp`
--

CREATE TABLE IF NOT EXISTS `feltyp` (
`ID` int(11) NOT NULL,
  `feltext` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `ikontyp`
--

CREATE TABLE IF NOT EXISTS `ikontyp` (
`ID` int(11) NOT NULL,
  `url` varchar(256) NOT NULL,
  `typ` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `kontaktperson`
--

CREATE TABLE IF NOT EXISTS `kontaktperson` (
`ID` int(11) NOT NULL,
  `fornamn` varchar(50) NOT NULL,
  `efternamn` varchar(50) NOT NULL,
  `mobil` int(11) DEFAULT NULL,
  `mejl` varchar(50) NOT NULL,
  `losen` varchar(256) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `anvnamn` varchar(50) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumpning av Data i tabell `kontaktperson`
--

INSERT INTO `kontaktperson` (`ID`, `fornamn`, `efternamn`, `mobil`, `mejl`, `losen`, `admin`, `anvnamn`) VALUES
(1, 'administrator', 'mobow', 123456789, 'nbt11nsn@student.hig.se', 'mobow', 1, 'admin');

-- --------------------------------------------------------

--
-- Tabellstruktur `kontrakt`
--

CREATE TABLE IF NOT EXISTS `kontrakt` (
`ID` int(11) NOT NULL,
  `kontorsnamn` varchar(50) NOT NULL,
  `tele` int(11) DEFAULT NULL,
  `stn` int(11) NOT NULL,
  `kontaktpersonid` int(11) NOT NULL,
  `adressid` int(11) NOT NULL,
  `hemsida` varchar(256) DEFAULT NULL,
  `oppet` text,
  `allminfo` text,
  `logurl` varchar(256) DEFAULT NULL,
  `ikonid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellstruktur `probest`
--

CREATE TABLE IF NOT EXISTS `probest` (
  `bestallningsid` int(11) NOT NULL,
  `produktid` int(11) NOT NULL,
  `antal` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellstruktur `produkt`
--

CREATE TABLE IF NOT EXISTS `produkt` (
`ID` int(11) NOT NULL,
  `maxbest` int(11) NOT NULL DEFAULT '0',
  `namn` varchar(100) NOT NULL,
  `bildurl` varchar(256) DEFAULT NULL,
  `info` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
 ADD PRIMARY KEY (`ID`), ADD UNIQUE KEY `anvnamn` (`anvnamn`);

--
-- Index för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
 ADD PRIMARY KEY (`ID`);

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
-- AUTO_INCREMENT för dumpade tabeller
--

--
-- AUTO_INCREMENT för tabell `adress`
--
ALTER TABLE `adress`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
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
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `kontaktperson`
--
ALTER TABLE `kontaktperson`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT för tabell `kontrakt`
--
ALTER TABLE `kontrakt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT för tabell `produkt`
--
ALTER TABLE `produkt`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
