-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: mariadb106.server683681.nazwa.pl:3306
-- Czas generowania: 02 Gru 2022, 20:01
-- Wersja serwera: 10.6.7-MariaDB-log
-- Wersja PHP: 7.2.24-0ubuntu0.18.04.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Baza danych: `server683681_phpprojekt`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Zrzut danych tabeli `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(1, 'BLUM'),
(2, 'GTV'),
(3, 'HEFELE'),
(4, 'TEST'),
(5, 'JOHN'),
(6, 'JOHN'),
(7, 'TEST1');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `cart`
--

CREATE TABLE `cart` (
  `quantity` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Zrzut danych tabeli `cart`
--

INSERT INTO `cart` (`quantity`, `user_id`, `product_id`) VALUES
(1, 3, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb3_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Zrzut danych tabeli `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Uchwyty'),
(2, 'Zawiasy'),
(3, 'Podnośniki'),
(4, 'Szuflady'),
(5, 'Test');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `subject` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `contact`
--

INSERT INTO `contact` (`id`, `name`, `subject`, `email`, `message`) VALUES
(1, 'Piotr', 'Piotrek2@wp.pl', 'Problem', 'Problem mamy'),
(2, 'Jakub', 'Jakubowski@interia.pl', 'Problem z zakupem żarówki', 'Nie mogę zakupić żarówek'),
(3, 'Kuba', 'Kuba22@interia.pl', 'Problem', 'Mam problem\r\n'),
(4, 'Marek', 'Mareczek00@gmail.com', 'Żarówki', 'Niestety nie ma dostępnych żarówek jakich chce');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8mb3_polish_ci NOT NULL,
  `description` text COLLATE utf8mb3_polish_ci NOT NULL,
  `id_brand` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `picture` text COLLATE utf8mb3_polish_ci NOT NULL,
  `price` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Zrzut danych tabeli `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `id_brand`, `id_category`, `picture`, `price`) VALUES
(1, 'blum zc7t0350', 'Uchwyt na talerze firmy blum.', 1, 1, '1.jpg', 178.14),
(4, 'Test', 'test', 1, 1, '2.png', 111);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `reviews`
--

CREATE TABLE `reviews` (
  `id_user` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8mb3_polish_ci NOT NULL,
  `content` text COLLATE utf8mb3_polish_ci NOT NULL,
  `stars` int(11) NOT NULL,
  `date` date NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_polish_ci;

--
-- Zrzut danych tabeli `reviews`
--

INSERT INTO `reviews` (`id_user`, `title`, `content`, `stars`, `date`, `id_product`) VALUES
(3, 'test1', 'test1', 2, '2022-11-22', 1),
(3, 'Test2', 'Test2', 3, '2022-11-22', 1),
(3, 'Test3', 'test3', 5, '2022-11-22', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `role`) VALUES
(3, 'Kuba', '$2y$10$cn1RfiUdDYVpn7KcWn6jguw6miMAj9k8CAhRfZRu8fpOjT2psVLNO', '2022-11-18 15:29:53', 'admin'),
(6, 'Patrykowski', '$2y$10$RN/HuGnpy7AC8vMaVlbKw.g7qxdg5UkBdzioz0fLkccyp6GJio3ZS', '2022-11-19 19:58:18', 'user'),
(7, 'Hubert', '$2y$10$DKMRH6PR9afEwAGJPvMFcuPXJBeilkdCoobfdwnhv/MfPt8KuHuGO', '2022-11-19 20:02:51', 'user'),
(8, 'Marcin', '$2y$10$QDWy/0cRjNC/SNJclglpGuVMJ4.uLiHz6zmZb9grBBM6H/NHPsUIS', '2022-12-02 03:05:13', 'user'),
(9, 'Piotr', '$2y$10$sjNtYiPnfyPX3gZ0HTTTKeXQTYEAsthclTa2Ha8k9hIOmXL70aVfG', '2022-12-02 18:37:29', 'user'),
(10, 'Mikolaj', '$2y$10$Qr1L9/gweF8zrFLR3kijouVd.PbL3E5hE/KefVt4eOzs4m0fgdLca', '2022-12-02 18:39:29', 'user'),
(11, 'User1', '$2y$10$9kgBVmY3iqn2614XSMzhz.q/q4ZwrVfDfb9QC0vrCewB5Zvwt/woi', '2022-12-02 18:59:56', 'user'),
(12, 'Lolek1', '$2y$10$4r4OCzB5GSgQ8VwjvHWjOeqk9QyPmcoFocXdsdPgf3/WwzhpYS.Cu', '2022-12-02 19:51:01', 'user');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;
