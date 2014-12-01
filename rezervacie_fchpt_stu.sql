-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Po 01.Dec 2014, 22:05
-- Verzia serveru: 5.6.20
-- Verzia PHP: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databáza: `rezervacie fchpt stu`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `logy`
--

CREATE TABLE IF NOT EXISTS `logy` (
`ID` int(11) NOT NULL,
  `Uzivatel` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Akcia` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Datum` datetime NOT NULL,
  `Popis` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `mapa_rezervacie`
--

CREATE TABLE IF NOT EXISTS `mapa_rezervacie` (
`ID` int(11) NOT NULL,
  `ID_Rezervacia` int(11) NOT NULL,
  `Zaciatok` datetime NOT NULL,
  `Koniec` datetime NOT NULL,
  `Pocet_Osob` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `miestnost`
--

CREATE TABLE IF NOT EXISTS `miestnost` (
`ID` int(11) NOT NULL,
  `Kapacita` int(3) NOT NULL,
  `Nazov` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ID_Typ_Miestnosti` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `rezervacia`
--

CREATE TABLE IF NOT EXISTS `rezervacia` (
`ID` int(11) NOT NULL,
  `ID_Uzivatel` int(11) NOT NULL,
  `ID_Miestnost` int(11) NOT NULL,
  `Ucel` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `typy_miestnosti`
--

CREATE TABLE IF NOT EXISTS `typy_miestnosti` (
`ID` int(11) NOT NULL,
  `Nazov` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `uzivatel`
--

CREATE TABLE IF NOT EXISTS `uzivatel` (
`ID` int(11) NOT NULL,
  `Meno` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `Priezvisko` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Login` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `Heslo` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `Admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `logy`
--
ALTER TABLE `logy`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `mapa_rezervacie`
--
ALTER TABLE `mapa_rezervacie`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `miestnost`
--
ALTER TABLE `miestnost`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `rezervacia`
--
ALTER TABLE `rezervacia`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `typy_miestnosti`
--
ALTER TABLE `typy_miestnosti`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `uzivatel`
--
ALTER TABLE `uzivatel`
 ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `logy`
--
ALTER TABLE `logy`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `mapa_rezervacie`
--
ALTER TABLE `mapa_rezervacie`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `miestnost`
--
ALTER TABLE `miestnost`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `rezervacia`
--
ALTER TABLE `rezervacia`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `typy_miestnosti`
--
ALTER TABLE `typy_miestnosti`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uzivatel`
--
ALTER TABLE `uzivatel`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
