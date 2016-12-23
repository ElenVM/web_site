-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 22 2016 г., 23:45
-- Версия сервера: 5.6.29-log
-- Версия PHP: 7.0.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `news-portal`
--

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(10) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `client_name`, `name`) VALUES
(1, 'root.jpg', 'fc0425acc2acdc0b10590101996ef53173eaed52.jpg'),
(2, 'ic_launcher.png', '97a6ac70011a30bcb3ba372d96a27557be2abc68.png');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(10) NOT NULL,
  `user_id` int(10) DEFAULT NULL,
  `category_id` int(10) NOT NULL,
  `image_id` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `user_id`, `category_id`, `image_id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 'Как это работает?', 'Проверка', '2016-12-22 19:23:37', '2016-12-22 19:23:37'),
(2, 1, 1, 2, 'Multipart Request. Почему не работает?', 'Содержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое СодержимоеСодержимое Содержимое', '2016-12-22 19:42:38', '2016-12-22 19:42:38');

-- --------------------------------------------------------

--
-- Структура таблицы `news_categories`
--

CREATE TABLE IF NOT EXISTS `news_categories` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `news_categories`
--

INSERT INTO `news_categories` (`id`, `name`) VALUES
(1, 'Смартфоны'),
(2, 'Аксессуары');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `remember_token`, `is_admin`, `created_at`, `updated_at`) VALUES
(1, 'abler98', '$2y$10$lggPrJI4lo5B4OzfzVD6He8qH9FHAV2cUGKci2vr7R5huu9BuDcOq', 'abler98@gmail.com', '777b19e1e29fa16682588ea682e4412e', 1, '2016-12-22 16:32:52', '2016-12-22 18:32:52');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news_categories`
--
ALTER TABLE `news_categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `news_categories`
--
ALTER TABLE `news_categories`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
