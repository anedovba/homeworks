-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Час створення: Лис 08 2016 р., 19:51
-- Версія сервера: 10.1.16-MariaDB
-- Версія PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `mvc_group_609`
--

-- --------------------------------------------------------

--
-- Структура таблиці `author`
--

CREATE TABLE `author` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `date_birth` date NOT NULL,
  `date_death` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `author`
--

INSERT INTO `author` (`id`, `first_name`, `last_name`, `date_birth`, `date_death`) VALUES
(1, 'Stephen', 'King', '1947-09-21', NULL),
(2, 'Joshua', 'Bell', '1932-08-26', '2014-01-13'),
(3, 'Earl', 'Boyd', '1954-08-20', '1995-01-23'),
(4, 'Roger', 'Wallace', '1992-01-27', '2006-12-10'),
(5, 'Kathleen', 'Burton', '1927-09-30', '2009-04-19'),
(6, 'Gerald', 'Wagner', '1950-11-10', '2014-01-13'),
(7, 'Rose', 'White', '1994-05-21', '2012-09-06'),
(8, 'Carolyn', 'Gilbert', '1987-09-06', NULL),
(9, 'Daniel', 'White', '1962-05-18', '2009-12-05'),
(10, 'Gerald', 'Mcdonald', '1955-01-25', '2011-01-11'),
(11, 'Doris', 'Ross', '1945-07-05', '2004-01-31'),
(12, 'Earl', 'Marshall', '1959-07-03', '2016-09-07'),
(13, 'Shirley', 'Nguyen', '1946-05-20', NULL),
(14, 'Dorothy', 'Gonzales', '1977-04-04', '2014-05-10'),
(15, 'James', 'Reed', '1990-12-26', '2006-10-28'),
(16, 'Keith', 'Simpson', '1990-10-15', '2009-10-22'),
(17, 'Earl', 'Jones', '1988-04-04', '2013-06-24'),
(18, 'Irene', 'Welch', '1925-12-24', '1995-02-07'),
(19, 'Brenda', 'Hansen', '1990-09-21', '2000-07-22'),
(20, 'Janet', 'Nichols', '1951-09-19', NULL),
(21, 'Donna', 'Graham', '1960-07-24', '2002-12-07'),
(22, 'Jeffrey', 'Welch', '1938-03-25', '2015-08-04'),
(23, 'Chris', 'Rogers', '1974-08-07', '2014-08-22'),
(24, 'Irene', 'Bailey', '1924-12-05', '1996-01-15'),
(25, 'William', 'Owens', '1963-10-16', '1996-05-08'),
(26, 'Roy', 'Bowman', '1993-12-09', '2010-07-02'),
(27, 'Albert', 'Green', '1925-01-13', '1998-05-22'),
(28, 'Diana', 'Hill', '1982-08-28', '2014-05-09'),
(29, 'Johnny', 'Davis', '1925-07-22', '2009-02-13'),
(30, 'Eric', 'Kelly', '1988-08-15', '2004-02-14'),
(31, 'Roger', 'Phillips', '1986-10-26', '2008-04-02'),
(32, 'Mildred', 'Gonzales', '1924-12-22', '2012-05-29'),
(33, 'Billy', 'Coleman', '1967-09-28', '2000-11-01'),
(34, 'Kenneth', 'Peterson', '1939-01-09', '2009-03-30'),
(35, 'Susan', 'Crawford', '1921-05-17', '2011-03-25'),
(36, 'Carol', 'Montgomery', '1922-02-17', '2012-08-11'),
(37, 'Philip', 'Bailey', '1978-07-26', NULL),
(38, 'Janice', 'Ross', '1934-07-14', '2015-06-27'),
(39, 'Gary', 'Little', '1930-10-07', '2016-05-06'),
(40, 'Deborah', 'Parker', '1957-07-09', '2016-01-11'),
(41, 'Sharon', 'Romero', '1993-12-30', '1996-04-30'),
(42, 'Tina', 'Oliver', '1985-07-10', '2011-03-04'),
(43, 'Craig', 'Armstrong', '1950-05-12', '1998-11-19'),
(44, 'Andrew', 'Mendoza', '1958-05-22', '2004-11-16'),
(45, 'Roger', 'Ryan', '1924-01-13', '2001-02-04'),
(46, 'Carolyn', 'Parker', '1931-04-21', '2010-01-05'),
(47, 'Gloria', 'Jenkins', '1926-09-02', '2001-08-12'),
(48, 'Joseph', 'Ramirez', '1963-08-25', '2008-01-26'),
(49, 'Melissa', 'Scott', '1939-05-07', '2014-11-23'),
(50, 'Michelle', 'King', '1940-02-13', '2011-12-10'),
(51, 'Dennis', 'Hunter', '1939-08-05', NULL),
(52, 'Barbara', 'Kelley', '1924-06-04', '2007-08-05'),
(53, 'Bobby', 'Schmidt', '1975-09-29', '2011-10-28'),
(54, 'Edward', 'Perkins', '1941-02-06', '1995-06-24'),
(55, 'Denise', 'Tucker', '1925-07-18', '2005-06-04'),
(56, 'Katherine', 'Simmons', '1960-10-26', '1996-05-12'),
(57, 'Keith', 'Ray', '1974-05-08', NULL),
(58, 'Gloria', 'Peterson', '1990-08-28', NULL),
(59, 'Judy', 'Banks', '1985-07-26', NULL),
(60, 'Andrew', 'Price', '1931-03-17', '2010-02-04'),
(61, 'Angela', 'Medina', '1983-03-30', '2004-06-22'),
(62, 'Cheryl', 'Wells', '1989-03-10', '2008-07-29'),
(63, 'Amy', 'Burns', '1953-08-30', NULL),
(64, 'Patrick', 'Hall', '1932-06-01', '2015-06-24'),
(65, 'Jesse', 'Alvarez', '1963-03-29', '1998-09-30'),
(66, 'Roy', 'Gutierrez', '1962-04-04', '2014-08-13'),
(67, 'Aaron', 'Berry', '1930-04-14', '2014-12-21'),
(68, 'Randy', 'Hunter', '1964-05-07', '2005-01-03'),
(69, 'Ernest', 'Parker', '1989-06-09', NULL),
(70, 'Carol', 'Larson', '1951-09-11', '2000-07-12'),
(71, 'Susan', 'Castillo', '1977-10-12', '2005-07-10'),
(72, 'Ralph', 'Harper', '1921-03-31', '1997-08-10'),
(73, 'Helen', 'Clark', '1995-10-04', '2012-06-02'),
(74, 'Jack', 'Brown', '1927-01-05', '1997-03-27'),
(75, 'Gregory', 'Matthews', '1971-07-27', '1995-03-17'),
(76, 'Rose', 'Simpson', '1942-07-17', '2002-03-24'),
(77, 'Howard', 'Hernandez', '1953-01-07', '2003-10-11'),
(78, 'Irene', 'Franklin', '1925-05-10', '2010-06-25'),
(79, 'Raymond', 'Mendoza', '1954-03-01', '1995-07-20'),
(80, 'Carlos', 'Ward', '1956-04-01', '2014-09-10'),
(81, 'Phillip', 'Parker', '1967-05-23', '2001-01-16'),
(82, 'Russell', 'Watson', '1994-08-21', '1998-06-11'),
(83, 'Robert', 'Harvey', '1943-08-28', '2008-06-13'),
(84, 'Lawrence', 'West', '1979-10-18', '2014-10-31'),
(85, 'Linda', 'Hart', '1933-07-08', '1999-07-10'),
(86, 'Patricia', 'Austin', '1982-01-26', '2002-11-10'),
(87, 'William', 'Cox', '1924-12-26', '2011-01-24'),
(88, 'Martin', 'Bennett', '1983-12-05', '2003-02-22'),
(89, 'Kenneth', 'Robinson', '1956-12-08', '2006-10-05'),
(90, 'Willie', 'Richards', '1933-08-26', '2006-01-20'),
(91, 'Katherine', 'Day', '1971-08-24', '2004-06-21'),
(92, 'Samuel', 'Smith', '1948-03-29', '2000-01-05'),
(93, 'Laura', 'Webb', '1936-12-14', '2006-06-04'),
(94, 'Paula', 'Morris', '1946-10-05', '1995-02-28'),
(95, 'Linda', 'Bishop', '1941-05-15', '2016-10-14'),
(96, 'Sharon', 'Berry', '1927-01-31', '2006-05-18'),
(97, 'Rebecca', 'Matthews', '1985-07-08', '2011-05-23'),
(98, 'Clarence', 'Ward', '1949-10-12', NULL),
(99, 'Tammy', 'Perez', '1923-04-17', '2006-08-09'),
(100, 'Michael', 'Collins', '1971-01-10', '2014-12-17'),
(101, 'Karen', 'Lopez', '1959-07-01', '1996-03-01');

-- --------------------------------------------------------

--
-- Структура таблиці `book`
--

CREATE TABLE `book` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `is_active` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `style_id` tinyint(3) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `book`
--

INSERT INTO `book` (`id`, `title`, `description`, `price`, `is_active`, `style_id`) VALUES
(1, 'New Book', 'erat quisque erat eros viverra eget congue eget semper rutrum nulla nunc purus phasellus in felis donec semper sapien a libero nam dui proin leo odio porttitor id consequat in consequat ut nulla sed accumsan felis', '12350.45', 1, 2),
(2, 'Vestibulum ante ipsum.', 'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', '2809.11', 0, 1),
(3, 'Vestibulum quam sapien.', 'Morbi non lectus. Aliquam sit amet diam in magna bibendum imperdiet. Nullam orci pede, venenatis non, sodales sed, tincidunt eu, felis.', '1063.74', 0, 5),
(4, 'Morbi.', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.', '2042.08', 0, 1),
(5, 'Vivamus.', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Proin risus. Praesent lectus.', '4965.23', 0, 1),
(6, 'Suspendisse ornare consequat lectus.', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.', '1208.10', 1, 1),
(7, 'Donec vitae nisi.', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '459.91', 0, 7),
(8, 'Nulla ac enim.', 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Vivamus vestibulum sagittis sapien. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '1069.36', 0, 1),
(9, 'In hac habitasse platea dictumst.', 'Quisque id justo sit amet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nulla dapibus dolor vel est. Donec odio justo, sollicitudin ut, suscipit a, feugiat et, eros.', '2783.80', 0, 8),
(10, 'Cras in purus eu magna vulputate luctus.', 'In sagittis dui vel nisl. Duis ac nibh. Fusce lacus purus, aliquet at, feugiat non, pretium quis, lectus.', '763.94', 0, 9),
(11, 'In hac habitasse platea dictumst.', 'Duis consequat dui nec nisi volutpat eleifend. Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus.', '1738.92', 0, 8),
(12, 'Etiam pretium iaculis justo.', 'In hac habitasse platea dictumst. Etiam faucibus cursus urna. Ut tellus.', '1538.66', 1, 8),
(13, 'Praesent id massa id nisl venenatis lacinia.', 'Aenean lectus. Pellentesque eget nunc. Donec quis orci eget orci vehicula condimentum.', '4568.85', 0, 3),
(14, 'Aliquam sit amet diam in magna bibendum imperdiet.', 'Duis bibendum, felis sed interdum venenatis, turpis enim blandit mi, in porttitor pede justo eu massa. Donec dapibus. Duis at velit eu est congue elementum.', '1304.71', 1, 8),
(15, 'Sed vel enim sit amet nunc viverra dapibus.', 'Nam ultrices, libero non mattis pulvinar, nulla pede ullamcorper augue, a suscipit nulla elit ac nulla. Sed vel enim sit amet nunc viverra dapibus. Nulla suscipit ligula in lacus.', '1796.46', 0, 4),
(16, 'Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', 'Curabitur gravida nisi at nibh. In hac habitasse platea dictumst. Aliquam augue quam, sollicitudin vitae, consectetuer eget, rutrum at, lorem.', '631.75', 0, 7),
(17, 'Nulla mollis molestie lorem.', 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Mauris viverra diam vitae quam. Suspendisse potenti.', '3810.89', 0, 7),
(18, 'Vivamus vel nulla eget eros elementum pellentesque.', 'Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui.', '4150.84', 0, 6),
(19, 'Curabitur in libero ut massa volutpat convallis.', 'Fusce consequat. Nulla nisl. Nunc nisl.', '587.73', 1, 1),
(20, 'Praesent blandit lacinia erat.', 'Aliquam quis turpis eget elit sodales scelerisque. Mauris sit amet eros. Suspendisse accumsan tortor quis turpis.', '1077.98', 1, 2),
(21, 'My new site', 'tortor quis turpis sed ante vivamus tortor duis ma...', '112121.20', 1, 4);

-- --------------------------------------------------------

--
-- Структура таблиці `style`
--

CREATE TABLE `style` (
  `id` tinyint(3) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `style`
--

INSERT INTO `style` (`id`, `name`) VALUES
(1, 'Tempus'),
(2, 'Commodo'),
(3, 'Enim'),
(4, 'Gravida'),
(5, 'Curabitur'),
(6, 'Justo'),
(7, 'Lacinia'),
(8, 'Sed'),
(9, 'Porta'),
(10, 'Nec');

-- --------------------------------------------------------

--
-- Структура таблиці `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп даних таблиці `user`
--

INSERT INTO `user` (`id`, `email`, `password`) VALUES
(1, 'a@a.a', '008711578f40488d394f72018bbf1409');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`),
  ADD KEY `style_id` (`style_id`);

--
-- Індекси таблиці `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`id`);

--
-- Індекси таблиці `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
--
-- AUTO_INCREMENT для таблиці `book`
--
ALTER TABLE `book`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT для таблиці `style`
--
ALTER TABLE `style`
  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT для таблиці `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- Обмеження зовнішнього ключа збережених таблиць
--

--
-- Обмеження зовнішнього ключа таблиці `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`style_id`) REFERENCES `style` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
