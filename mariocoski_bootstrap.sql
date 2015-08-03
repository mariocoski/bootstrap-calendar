-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 03 Sie 2015, 10:37
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Create Database: `mariocoski_bootstrap`
--

CREATE DATABASE IF NOT EXISTS `mariocoski_bootstrap`;
USE `mariocoski_bootstrap`;

--
-- Struktura tabeli dla tabeli `mariocoski_calendar`
--

CREATE TABLE IF NOT EXISTS `mariocoski_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(150) NOT NULL,
  `postcode` varchar(20) NOT NULL,
  `city` varchar(100) NOT NULL,
  `country` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `calendar_id` (`calendar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `mariocoski_calendar`
--

INSERT INTO `mariocoski_calendar` (`id`, `calendar_id`, `company_name`, `address`, `postcode`, `city`, `country`, `website`) VALUES
(1, 334455, 'Your Company 1', 'Street Name 1', 'Postcode 1', 'City 1', 'Country', 'www.example.com'),
(2, 667788, 'Your Company 2', 'Street Name 2', 'Postcode 2', 'City 2', 'Country', 'www.example2.com');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mariocoski_event`
--

CREATE TABLE IF NOT EXISTS `mariocoski_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `calendar_id` int(11) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `booked` tinyint(1) NOT NULL DEFAULT '0',
  `noticed` tinyint(1) NOT NULL DEFAULT '0',
  `deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `calendar_id` (`calendar_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mariocoski_user`
--

CREATE TABLE IF NOT EXISTS `mariocoski_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(250) NOT NULL,
  `salt` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Zrzut danych tabeli `mariocoski_user`
--

INSERT INTO `mariocoski_user` (`id`, `email`, `password`, `salt`) VALUES
(1, 'test@test.pl', 'password', 'salt');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `mariocoski_user_calendar`
--

CREATE TABLE IF NOT EXISTS `mariocoski_user_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `calendar_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `calendar_id` (`calendar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `mariocoski_user_calendar`
--

INSERT INTO `mariocoski_user_calendar` (`id`, `user_id`, `calendar_id`) VALUES
(1, 1, 334455),
(2, 1, 667788);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `mariocoski_user_calendar`
--
ALTER TABLE `mariocoski_user_calendar`
  ADD CONSTRAINT `mariocoski_user_calendar_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `mariocoski_user` (`id`),
  ADD CONSTRAINT `mariocoski_user_calendar_ibfk_2` FOREIGN KEY (`calendar_id`) REFERENCES `mariocoski_calendar` (`calendar_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
