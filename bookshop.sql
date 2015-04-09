-- phpMyAdmin SQL Dump
-- version 4.0.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 07 2015 г., 12:24
-- Версия сервера: 5.5.38-log
-- Версия PHP: 5.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `bookshop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `authors`
--

CREATE TABLE IF NOT EXISTS `authors` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `authors`
--

INSERT INTO `authors` (`id`, `name`) VALUES
(1, 'Erich Maria Remarque'),
(13, 'Agatha Christie'),
(10, 'Charles Dickens'),
(14, 'Modest'),
(18, 'Фёдор Михайлович Достоевский');

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` smallint(6) NOT NULL,
  `year` smallint(4) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `price`, `year`, `image`) VALUES
(1, 'Arch of Triumph', 'It is 1939, and, despite having no permission to perform surgery, Ravic, a very accomplished German surgeon and a stateless refugee living in Paris, has been ghost-operating on patients for two years on the behalf of two less skillful French physicians.\r\n\r\nUnwilling to return to Nazi Germany, which has stripped him of his citizenship, and unable to legally exist anywhere else in pre-war western Europe, Ravic manages to hang on. He is one of many displaced persons without passports or any other documents, who live under a constant threat of being captured and deported from one country to the next, and back again.\r\n\r\nThough Ravic has given up on the possibility of love, life has a curious way of taking a turn for the romantic, even during the worst of times, as he cautiously befriends an actress', 13, 1937, 'ArchOfTriumph.jpg'),
(2, 'Three Comrades', 'The city, which is never referred to by name (however, it is likely Berlin), is crowded by a growing number of jobless and marked by increasing violence between left and right. The novel starts out in the seedy milieu of bars where prostitutes mingle with the hopeless flotsam that the war left behind. While Robert and his friends manage to make a living dealing cars and driving an old taxi, economic survival in the city is getting harder by the day. It is in this setting that Robert meets Patrice Hollmann, a mysterious beautiful young woman with an upper-middle-class background. Their love affair intensifies as he introduces her to his life of bars and races and Robert''s nihilistic attitude slowly begins to change as he realizes how much he needs Pat.\r\n\r\nThe story takes an abrupt turn as Pat suffers a near-fatal lung hemorrhage during a summer holiday at the sea. Upon their return, Robert and Pat move in with each other but her days in the city are numbered, as she is scheduled to leave for a Swiss mountain sanatorium come winter. It is this temporal limitation of their happiness which makes their remaining time together so precious.\r\n\r\nAfter Pat has left for Switzerland, the political situation in the city heats up and Lenz, one of the comrades, is killed by a militant, not mentioned in the book by the actual name but supposed to be a Nazi. On top of this, Otto and Robert face bankruptcy and have to sell their workshop. In the midst of this misfortune, a telegram arrives informing them of Pat''s worsening state of health. The two remaining comrades don''t hesitate and drive the thousand kilometers to the tuberculosis sanatorium in the Alps to see her.\r\n\r\nReunited, Robert and an increasingly moribund Pat celebrate their remaining weeks before her inevitable death amidst the snow-covered summits of Switzerland. It is in the last part of the book that this beautiful love story finds closure and leaves the main character, a nihilist who has found love, forever changed.', 15, 2010, 'ThreeComrades.jpg'),
(11, 'The Posthumous Papers of the Pickwick Club', 'Written for publication as a serial, The Pickwick Papers is a sequence of loosely-related adventures. The action is given as occurring 1827–8, though critics have noted some seeming anachronisms.[4] It has been stated that Dickens satirized the case of George Norton suing Lord Melbourne in The Pickwick Papers.[5] The novel&#039;s main character, Samuel Pickwick, Esquire, is a kind and wealthy old gentleman, and the founder and perpetual president of the Pickwick Club. To extend his researches into the quaint and curious phenomena of life, he suggests that he and three other &quot;Pickwickians&quot; (Mr Nathaniel Winkle, Mr Augustus Snodgrass, and Mr Tracy Tupman) should make journeys to places remote from London and report on their findings to the other members of the club. Their travels throughout the English countryside by coach provide the chief theme of the novel. A distinctive and valuable feature of the work is the generally accurate description of the old coaching inns of England.[6] (One of the main families running the Bristol to Bath coaches at the time was started by Eleazer Pickwick).', 25, 2000, 'Pickwickclub_serial.jpg'),
(13, 'Ten Little Niggers', 'Eight people arrive on an isolated island off the Devonshire coast of England. Each appears to have an invitation tailored to his or her personal circumstances, such as an offer of employment or an unexpected late summer holiday. They are met by the island owners&#039; butler and cook (who have never met their employer), making a total of ten people known to be on the island. While awaiting their hosts, they find a framed copy of the nursery rhyme &quot;Ten Little Soldiers&quot; (&quot;Niggers&quot; or &quot;Indians&quot; in respective earlier editions) hanging on the wall, and notice ten figurines on the dining room table, as well as discussing other oddities about the house and their visit. The butler plays a gramophone (or &quot;phonograph&quot;) record while they are talking, as he had been instructed to do; unexpectedly the recording contains a voice that describes each visitor in turn and accuses each of having committed murder but evading justice, and asks if any of &quot;the accused&quot; wishes to give a defense. All are shocked and in the aftermath one of the guests (Anthony Marston) has a drink to help with the shock, however his drink was poisoned with potassium cyanide and he chokes and dies. Subsequently the guests notice one of the ten figurines is now broken, and the nursery rhyme appears to reflect the manner of death (&quot;One choked his little self and then there were nine&quot;).', 500, 1950, 'And_Then_There_Were_None_US_First_Edition_Cover_1940.jpg'),
(14, 'Gorodok', 'I want to return in Gorodok', 1, 1999, 'gorodok.jpg'),
(17, 'Братья Карамазовы', 'Роман «Братья Карамазовы» включает в себя сложную, отлично выстроенную и психологически выверенную детективную историю, при этом в канве детективного сюжета обыкновенное (на первый взгляд) уголовное происшествие не только сплетается с историей любовного соперничества, но и встраивается в общую картину современного Достоевскому общества[5]. Сюжет сложен и ветвится: от основного сюжета отделяются побочные линии.\r\n\r\nУголовное преступление, о котором идёт речь — убийство Фёдора Павловича Карамазова, человека пожилого и весьма состоятельного, его поваром Смердяковым, который приходился ему незаконным сыном. Почву для этого преступления подготовило соперничество между Фёдором Павловичем и его сыном Дмитрием из-за Грушеньки Светловой.', 100, 1880, 'Br_Karam.JPG');

-- --------------------------------------------------------

--
-- Структура таблицы `book_to_author`
--

CREATE TABLE IF NOT EXISTS `book_to_author` (
  `my_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  PRIMARY KEY (`my_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Дамп данных таблицы `book_to_author`
--

INSERT INTO `book_to_author` (`my_id`, `book_id`, `author_id`) VALUES
(1, 1, 1),
(2, 2, 1),
(28, 14, 1),
(29, 14, 14),
(27, 13, 13),
(37, 17, 18),
(34, 11, 10);

-- --------------------------------------------------------

--
-- Структура таблицы `book_to_genre`
--

CREATE TABLE IF NOT EXISTS `book_to_genre` (
  `my_id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `genre_id` int(11) NOT NULL,
  PRIMARY KEY (`my_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Дамп данных таблицы `book_to_genre`
--

INSERT INTO `book_to_genre` (`my_id`, `book_id`, `genre_id`) VALUES
(1, 1, 4),
(2, 2, 4),
(5, 1, 1),
(32, 11, 1),
(28, 14, 17),
(27, 13, 2),
(35, 17, 22);

-- --------------------------------------------------------

--
-- Структура таблицы `book_to_order`
--

CREATE TABLE IF NOT EXISTS `book_to_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=64 ;

--
-- Дамп данных таблицы `book_to_order`
--

INSERT INTO `book_to_order` (`id`, `book_id`, `order_id`, `quantity`) VALUES
(31, 13, 15, 1),
(32, 1, 16, 1),
(33, 2, 16, 1),
(34, 11, 16, 1),
(35, 11, 17, 10),
(36, 2, 17, 4),
(37, 11, 18, 4),
(38, 2, 18, 1),
(39, 13, 18, 3),
(40, 14, 18, 6),
(41, 11, 19, 2),
(42, 2, 19, 3),
(43, 1, 19, 2),
(44, 13, 19, 2),
(45, 14, 19, 2),
(46, 1, 20, 2),
(47, 2, 20, 1),
(48, 2, 21, 6),
(49, 1, 21, 1),
(50, 11, 21, 3),
(51, 2, 22, 1),
(52, 1, 22, 2),
(53, 2, 23, 10),
(54, 14, 24, 14),
(55, 1, 24, 2),
(56, 11, 24, 4),
(57, 11, 25, 1),
(58, 2, 25, 1),
(59, 1, 25, 1),
(60, 1, 26, 1),
(61, 2, 26, 1),
(62, 11, 26, 1),
(63, 2, 27, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`cart_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=239 ;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `book_id`, `quantity`) VALUES
(205, 33, 1, 3),
(238, 32, 13, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE IF NOT EXISTS `genres` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Novel'),
(2, 'Detective'),
(4, 'Drama'),
(17, 'Modest genre'),
(21, 'Кириллица'),
(22, 'Roman');

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `payment_id` int(11) NOT NULL,
  `order_status` varchar(255) NOT NULL DEFAULT 'is processed',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`order_id`, `date_time`, `user_id`, `price`, `payment_id`, `order_status`) VALUES
(26, '2015-04-07 07:44:18', 31, 48, 1, 'is processed'),
(27, '2015-04-07 07:45:44', 32, 60, 2, 'is processed');

-- --------------------------------------------------------

--
-- Структура таблицы `order_status`
--

CREATE TABLE IF NOT EXISTS `order_status` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_name` varchar(255) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `order_status`
--

INSERT INTO `order_status` (`order_id`, `order_name`) VALUES
(1, 'is processed'),
(2, 'shipped'),
(3, 'at final destination'),
(4, 'declined');

-- --------------------------------------------------------

--
-- Структура таблицы `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_name` varchar(255) NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `payment`
--

INSERT INTO `payment` (`payment_id`, `payment_name`) VALUES
(1, 'cash'),
(2, 'cashless');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_login` varchar(11) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_discount` tinyint(4) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=47 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`user_id`, `user_login`, `user_pass`, `user_email`, `user_discount`) VALUES
(31, 'test', '587cc76db6fae7ad59712405336f15b3', 'fgdfdfsfsg@mail.com', 10),
(32, 'test2', 'b4ce75757e6dcbb2cbf1f5d511531573', 'fgdfdfsfsg@mail.com', 0),
(33, 'test3', 'a24dd5964966669ec7ff20ed453e009e', 'fgdfdfsfsg@mail.com', 0),
(45, 'test5', 'b6331deed87ff37f7e676807e632831c', 'fgdfdfsfsg@mail.com', 0),
(46, 'test55', 'b6331deed87ff37f7e676807e632831c', 'fgdfdfsfsg@mail.com', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
