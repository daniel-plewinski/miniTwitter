-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 01 Sie 2017, 10:05
-- Wersja serwera: 5.6.35
-- Wersja PHP: 7.0.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Baza danych: `twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comments`
--

CREATE TABLE `Comments` (
  `id` int(11) NOT NULL,
  `tweet_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment_date` date DEFAULT NULL,
  `comment_content` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Comments`
--

INSERT INTO `Comments` (`id`, `tweet_id`, `user_id`, `comment_date`, `comment_content`) VALUES
(3, 4, 1, '2017-07-23', 'Pierwszy nasz komentarz'),
(7, 4, 3, '2017-07-30', 'To jest komentarz do tweeta'),
(9, 6, 4, '2017-07-31', 'Taki tam komentarz'),
(11, 6, 3, '2017-07-30', 'Taki sobie komentarz');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Messages`
--

CREATE TABLE `Messages` (
  `id` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `to_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `message_date` date NOT NULL,
  `is_read` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Messages`
--

INSERT INTO `Messages` (`id`, `from_id`, `to_id`, `content`, `message_date`, `is_read`) VALUES
(2, 3, 4, 'Testowa', '2017-07-31', 0),
(3, 1, 3, 'Testowa wiadomość', '2017-07-31', 1),
(4, 2, 3, 'Testowa wiadomość', '2017-07-31', 1),
(5, 3, 2, 'Testowa wiadomość', '2017-07-31', 0),
(7, 3, 1, 'Testowa wiadomość', '2017-07-31', 0),
(8, 1, 2, 'Pięć wieków później zaczął być używany przemyśle elektronicznym, pozostając praktycznie niezmienionym. Spopularyzował się w latach 60. XX w. wraz z publikacją arkuszy Letrasetu, zawierających fragmenty Lorem Ipsum, a ostatnio z zawierającym różne wersje Lorem Ipsum oprogramowaniem przeznaczonym do realizacji druków na komputerach osobistych, jak Aldus PageMaker\r\n\r\nDo czego tego użyć?\r\nOgólnie znana teza głosi, iż użytkownika może rozpraszać zrozumiała zawartość strony, kiedy ten chce zobaczyć sam jej wygląd. Jedną z mocnych stron używania Lorem Ipsum jest to, że ma wiele różnych „kombinacji” zdań, słów i akapitów, w przeciwieństwie do zwykłego: „tekst, tekst, tekst”, sprawiającego, że wygląda to „zbyt czytelnie” po polsku. Wielu webmasterów i designerów używa Lorem Ipsum jako domyślnego modelu tekstu i wpisanie w internetowej wyszukiwarce ‘lorem ipsum’ spowoduje znalezienie bardzo wielu stron, które wciąż są w budowie. Wiele wersji tekstu ewoluowało i zmieniało się przez lata, czasem przez przypadek, czasem specjalnie (humorystyczne wstawki itd).', '2017-07-17', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweets`
--

CREATE TABLE `Tweets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `creation_date` date DEFAULT NULL,
  `content` varchar(140) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Zrzut danych tabeli `Tweets`
--

INSERT INTO `Tweets` (`id`, `user_id`, `creation_date`, `content`) VALUES
(4, 1, '2017-07-23', 'Pierwszy tweet'),
(5, 3, '2017-06-18', 'Drugi tweet'),
(6, 4, '2017-07-30', 'To jest mój Tweet testowy'),
(8, 3, '2017-07-30', 'Witam wszystkich');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Users`
--

CREATE TABLE `Users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `hash_pass` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `Users`
--

INSERT INTO `Users` (`id`, `email`, `username`, `hash_pass`) VALUES
(1, 'ala@onet.pl', 'Ala', '23512rqfwijeri32jr'),
(2, 'anowak@mgmail.com', 'Adam', '$2y$10$6oMTD1JVvSqfxWKi1j0yUu2P4T8UhEozhmW0lO3mNtyZ2TSnyRWYK'),
(3, 'tomek@mgmail.com', 'Tom', '$2y$10$S09vZG6g55QPloBb40.P2OYKLpq0mxqc1SrXu4kUeoWQQ7IExCZ8m'),
(4, 'aleksa@mgmail.com', 'aleksa', '$2y$10$TcuN5iP.beKzXxPlIhSB8ODVTxSa7VX/pzJX0SbRK0JzrVAYQC3QW'),
(10, 'ewa@mgmail.com', 'ewa', '$2y$10$Go18R.QHee1fwmxZjy0fC.hmtGk30.OpmvEYgs4MwM2seOGCdrxRe');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `Comments`
--
ALTER TABLE `Comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `comments_ibfk_1` (`tweet_id`);

--
-- Indexes for table `Messages`
--
ALTER TABLE `Messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `from_id` (`from_id`),
  ADD KEY `to_id` (`to_id`);

--
-- Indexes for table `Tweets`
--
ALTER TABLE `Tweets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `Users`
--
ALTER TABLE `Users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `Comments`
--
ALTER TABLE `Comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT dla tabeli `Messages`
--
ALTER TABLE `Messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `Users`
--
ALTER TABLE `Users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comments`
--
ALTER TABLE `Comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `Tweets` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Messages`
--
ALTER TABLE `Messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`from_id`) REFERENCES `Users` (`id`),
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`to_id`) REFERENCES `Users` (`id`);

--
-- Ograniczenia dla tabeli `Tweets`
--
ALTER TABLE `Tweets`
  ADD CONSTRAINT `tweets_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `Users` (`id`);
