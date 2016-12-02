-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Czas generowania: 13 Lis 2016, 18:51
-- Wersja serwera: 5.7.16-0ubuntu0.16.04.1
-- Wersja PHP: 7.0.8-0ubuntu0.16.04.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Baza danych: `cinemas_db`
--
CREATE DATABASE IF NOT EXISTS `cinemas_db` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `cinemas_db`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Administratorzy`
--

DROP TABLE IF EXISTS `Administratorzy`;
CREATE TABLE IF NOT EXISTS `Administratorzy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Administratorzy`
--

INSERT INTO `Administratorzy` (`id`, `login`, `email`, `password`) VALUES
(1, 'root', 'root@boot.red.pl', '$2y$10$87qiRsPtcSP./4B8z/XE8OQJIHcd8kJ3qsJ6esoKNg2w.uX4kH/Cm');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Bilet`
--

DROP TABLE IF EXISTS `Bilet`;
CREATE TABLE IF NOT EXISTS `Bilet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `showing_id` int(11) NOT NULL,
  `quantity` int(11) UNSIGNED NOT NULL,
  `price` float(7,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `seans_id` (`showing_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Bilet`
--

INSERT INTO `Bilet` (`id`, `showing_id`, `quantity`, `price`) VALUES
(2, 3, 2, 12.50),
(3, 3, 2, 12.50),
(6, 19, 2, 4.00),
(7, 21, 3, 18.00),
(8, 19, 3, 14.00);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Film`
--

DROP TABLE IF EXISTS `Film`;
CREATE TABLE IF NOT EXISTS `Film` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci,
  `rating` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Film`
--

INSERT INTO `Film` (`id`, `name`, `description`, `rating`) VALUES
(1, 'Zbuntowana (2015)', 'Beatrice Prior konfrontuje się z wewnętrznymi demonami i kontynuuje walkę przeciwko ogromnemu sojuszowi, który może spowodować rozpad społeczeństwa.', 7),
(2, 'Seks, miłość i terapia (2014)', 'Lambert, seksoholik starający się zerwać z nałogiem, zatrudnia wiecznie niezaspokojoną nimfomankę.', 5),
(3, 'Ex Machina (2015)', 'Po wygraniu konkursu programista jednej z największych firm internetowych zostaje zaproszony do posiadłości swojego szefa. Na miejsce okazuje się, że jest częścią eksperymentu. ', 8),
(4, 'Sils Maria (2014)', 'Wybitna aktorka podczas kilku dni spędzonych w Alpach ze swoją asystentką na nowo odkrywa siebie. ', 7),
(5, 'Chappie (2015)', 'Dwóch gangsterów kradnie policyjnego androida, by wykorzystać go do swoich celów. ', 8),
(6, 'Kopciuszek (2015)', 'Po śmierci ojca zła macocha Elli zamienia dziewczynę w służącą. Los Kopciuszka odmieni dopiero Dobra Wróżka.', 8),
(7, 'Sąsiady (2014)', 'Ksiądz odwiedza po kolędzie kamienicę, odkrywając tajemnice jej lokatorów. ', 3),
(8, 'Złota klatka (2013)', 'Sara, nastolatka z Gwatemali, wyrusza w niebezpieczną podróż do Los Angeles w poszukiwaniu lepszego życia.', 9),
(9, 'Body/Ciało (2015)', 'Cyniczny prokurator i jego cierpiąca na anoreksję córka próbują odnaleźć się po tragicznej śmierci najbliższej osoby.', 6),
(10, 'Fru! (2014)', 'Ptaszek, który nigdy wcześniej nie wychylił dzioba poza rodzinne gniazdo, zostaje przez pomyłkę przewodnikiem stada.', 5),
(11, 'Disco Polo (2015)', 'Młodzi muzycy z prowincji w błyskawiczny sposób zdobywają szczyty list przebojów.', 2),
(12, 'Asteriks i Obeliks: Osiedle Bogów (2014)', 'Juliusz Cezar decyduje się na budowę dzielnicy mieszkaniowej dla właścicieli rzymskich i nazywa ją Osiedlem Bogów.', 9);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Kino`
--

DROP TABLE IF EXISTS `Kino`;
CREATE TABLE IF NOT EXISTS `Kino` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_polish_ci NOT NULL,
  `address` text COLLATE utf8_polish_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `Kino`
--

INSERT INTO `Kino` (`id`, `name`, `address`) VALUES
(1, 'Luna', 'ul. Marszałkowska 28'),
(2, 'Silver Screen Puławska', 'Centrum Europlex - ul. Puławska 17'),
(3, 'Iluzjon Filmoteki Narodowej', 'ul. Narbutta 50a'),
(4, 'Etnokino', 'Ul. Kredytowa 1, Warszawa'),
(5, 'Multikino Złote Tarasy', 'ul. Złota 59'),
(6, 'Kinoteka', 'pl. Defilad 1'),
(7, 'Cinema City Promenada', 'ul. Ostrobramska 75C'),
(8, 'Praha', 'ul. Jagielloñska 26'),
(9, 'Alchemia', 'ul. Jezuicka 4'),
(10, 'Muranów', 'ul. Zamenhofa 1'),
(11, 'Femina', 'al. Solidarności 115');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Platnosc`
--

DROP TABLE IF EXISTS `Platnosc`;
CREATE TABLE IF NOT EXISTS `Platnosc` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ticket_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bilet_id` (`ticket_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Platnosc`
--

INSERT INTO `Platnosc` (`id`, `ticket_id`, `type`, `date`) VALUES
(1, 3, 'cash', '2016-11-02'),
(2, 6, 'cash', '2016-11-13'),
(3, 7, 'Transfer', '2016-11-13'),
(4, 8, 'card', '2016-11-13');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Seans`
--

DROP TABLE IF EXISTS `Seans`;
CREATE TABLE IF NOT EXISTS `Seans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) NOT NULL,
  `cinema_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `SECONDARY` (`movie_id`,`cinema_id`),
  KEY `kino_id` (`movie_id`),
  KEY `film_id` (`cinema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Seans`
--

INSERT INTO `Seans` (`id`, `movie_id`, `cinema_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 4, 8),
(20, 5, 6),
(19, 6, 1),
(21, 10, 1),
(4, 10, 7);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Bilet`
--
ALTER TABLE `Bilet`
  ADD CONSTRAINT `Bilet_ibfk_1` FOREIGN KEY (`showing_id`) REFERENCES `Seans` (`id`);

--
-- Ograniczenia dla tabeli `Platnosc`
--
ALTER TABLE `Platnosc`
  ADD CONSTRAINT `Platnosc_ibfk_1` FOREIGN KEY (`ticket_id`) REFERENCES `Bilet` (`id`);

--
-- Ograniczenia dla tabeli `Seans`
--
ALTER TABLE `Seans`
  ADD CONSTRAINT `Seans_ibfk_1` FOREIGN KEY (`movie_id`) REFERENCES `Kino` (`id`),
  ADD CONSTRAINT `Seans_ibfk_2` FOREIGN KEY (`cinema_id`) REFERENCES `Film` (`id`);


