-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas wygenerowania: 12 Maj 2014, 16:21
-- Wersja serwera: 5.5.34
-- Wersja PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `musicfolio`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `accounts`
--

CREATE TABLE IF NOT EXISTS `accounts` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_polish_ci NOT NULL,
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `accounts`
--

INSERT INTO `accounts` (`account_id`, `login`, `password`) VALUES
(1, 'test', '1b4f0e9851971998e732078544c96b36c3d01cedf7caa332359d6f1d83567014');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `ads`
--

CREATE TABLE IF NOT EXISTS `ads` (
  `ad_id` int(11) NOT NULL AUTO_INCREMENT,
  `ad_type` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  `ad_author_id` int(11) NOT NULL,
  PRIMARY KEY (`ad_id`),
  UNIQUE KEY `ad_id` (`ad_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `artists`
--

CREATE TABLE IF NOT EXISTS `artists` (
  `artist_account_id` int(11) NOT NULL,
  `nick` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `avatar_id` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`artist_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `artists`
--

INSERT INTO `artists` (`artist_account_id`, `nick`, `avatar_id`) VALUES
(1, 'Wojciu', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `bands`
--

CREATE TABLE IF NOT EXISTS `bands` (
  `band_id` int(11) NOT NULL AUTO_INCREMENT,
  `band_artist_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  `photo_id` varchar(255) COLLATE utf8_polish_ci DEFAULT NULL,
  PRIMARY KEY (`band_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
