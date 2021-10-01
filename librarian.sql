-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2021 at 11:03 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librarian`
--

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `id` int(11) NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `year` year(4) DEFAULT NULL,
  `category` int(11) DEFAULT NULL,
  `pages` int(11) DEFAULT NULL,
  `publisher` varchar(100) DEFAULT NULL,
  `age_from` int(11) NOT NULL,
  `is_available` tinyint(1) NOT NULL,
  `image_file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`id`, `author`, `title`, `year`, `category`, `pages`, `publisher`, `age_from`, `is_available`, `image_file`) VALUES
(1, 'Fabio Geda', 'In the sea there are crocodiles', 1992, 5, 234, 'Edmond books', 0, 1, '2b6b298ba215c925ac5a191f150f519e-3.jpg'),
(2, 'Joseph Fink', 'Welcome to night vale', 2001, 2, 386, 'O\'Donovan', 1, 1, '5c2WH6B1RrPt2T6zful0Q8RIJL9wPOMyrTKptETFHrE-2.webp'),
(3, 'Zhong Chuxi', 'The haunted garden', 1998, 3, 481, 'Nicolas publishing', 1, 1, '11-THE-HAUNTED-GARDEN-1.jpg'),
(4, 'Olympia lePoint', 'Answers unleashed volume 2', 2002, 1, 188, 'TED Speakers', 1, 1, '50976921_10157036403412855_5236442462498586624_n-2.jpg'),
(5, 'David Steward', 'Doing business', 2010, 1, 581, 'Ronnie', 1, 1, '9781401342944.webp'),
(6, 'Summer Kiska', 'Only words', 2019, 4, 391, 'Shane Books', 1, 1, 'b1_only_words_72_media_huge_thumbnail.jpg'),
(7, 'Claire Fogel', 'Blackthorne Forest', 2020, 0, 511, 'Basecco', 1, 1, 'blackthorne__forest_72_media_huge_thumbnail-1.jpg'),
(8, 'J. K. Rowling', 'Harry Potter and the Order of Phoenix', 2002, 3, 687, 'Rowling ', 0, 1, 'C1Fqt_0XcAAK6BX-1.jpg'),
(12, 'Matt Larkin', 'Tides of Mana', 1977, 3, 425, 'Eschaton', 0, 1, 'felix-ortiz-50537135-10155787214031993-57966626678505472-n.jpg'),
(13, 'Mindy Thompson', 'The bookshop of dust and dreams', 2011, 3, 212, 'Antreco Publishing', 0, 1, 'HI-RES-FINAL-COVER-TAKEN-FROM-AMAZON.jpg'),
(14, 'Jan Ruth', 'My life in horses', 2021, 1, 257, 'Dreamscapes', 1, 1, 'my-life-in-horses-cover-book-2-large-ebook.webp'),
(15, 'Catherine Clinton', 'Mrs Lincoln', 1928, 1, 408, 'Basecco', 1, 1, 'r960-303e201a0a342e28cdd8dded52a02415.jpg'),
(16, 'Irvin Kershner', 'The princess and the scoundrel', 1982, 2, 167, 'Hoth Press', 1, 1, 'star-wars-pulp-covers-esb.jpg'),
(17, 'Olan Thorensen', 'The pen and the sword', 2014, 0, 819, 'Dreamscapes', 1, 1, 'the_pen_and_the_sword_72_media_huge_thumbnail.jpg'),
(18, 'Shelley Marlow', 'Two augustus in a row', 1958, 6, 711, 'Antreco Publishing', 1, 1, 'two-augusts-in-a-row-in-a-row.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `is_admin` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `is_admin`) VALUES
(1, 'dave', '$2y$10$yb1uFK.20kZq2UhEL4Uux.QXpRILYcYNNBGcbwNeKUqWLJ1XXZtEO', NULL),
(2, 'admin', '$2y$10$Z7yhqwWF3RdBHv.iDO3W4OoEFsRmqgFDkAAcAmU08IFeSdzrb/YHS', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book`
--
ALTER TABLE `book`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
