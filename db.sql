-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 03 Sty 2018, 16:09
-- Wersja serwera: 10.1.29-MariaDB
-- Wersja PHP: 7.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `mennica_raporty`
--
CREATE DATABASE IF NOT EXISTS `mennica_raporty` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mennica_raporty`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cok`
--

CREATE TABLE `cok` (
  `id` int(11) NOT NULL,
  `agent_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `agent_login` time NOT NULL,
  `agent_logout` time NOT NULL,
  `all_call_count` int(11) NOT NULL,
  `received_call_count` int(11) NOT NULL,
  `missed_call_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `imported_files`
--

CREATE TABLE `imported_files` (
  `id` int(11) NOT NULL,
  `miasto` varchar(10) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `number_of_records` int(11) NOT NULL,
  `import_date` datetime NOT NULL,
  `filetype` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `interwencje`
--

CREATE TABLE `interwencje` (
  `id` int(11) NOT NULL,
  `nra` int(5) NOT NULL,
  `data` datetime NOT NULL,
  `serwisant` varchar(255) NOT NULL,
  `usterka` varchar(255) NOT NULL,
  `miasto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `cok`
--
ALTER TABLE `cok`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `imported_files`
--
ALTER TABLE `imported_files`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `filename` (`filename`);

--
-- Indexes for table `interwencje`
--
ALTER TABLE `interwencje`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `cok`
--
ALTER TABLE `cok`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `imported_files`
--
ALTER TABLE `imported_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `interwencje`
--
ALTER TABLE `interwencje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;
