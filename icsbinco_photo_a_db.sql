-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 22, 2024 at 05:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `icsbinco_photo_a_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alphabet_book`
--

CREATE TABLE `alphabet_book` (
  `book_id` int(11) NOT NULL,
  `creator_email` varchar(255) NOT NULL,
  `A` int(11) DEFAULT NULL,
  `B` int(11) DEFAULT NULL,
  `C` int(11) DEFAULT NULL,
  `D` int(11) DEFAULT NULL,
  `E` int(11) DEFAULT NULL,
  `F` int(11) DEFAULT NULL,
  `G` int(11) DEFAULT NULL,
  `H` int(11) DEFAULT NULL,
  `I` int(11) DEFAULT NULL,
  `J` int(11) DEFAULT NULL,
  `K` int(11) DEFAULT NULL,
  `L` int(11) DEFAULT NULL,
  `M` int(11) DEFAULT NULL,
  `N` int(11) DEFAULT NULL,
  `O` int(11) DEFAULT NULL,
  `P` int(11) DEFAULT NULL,
  `Q` int(11) DEFAULT NULL,
  `R` int(11) DEFAULT NULL,
  `S` int(11) DEFAULT NULL,
  `T` int(11) DEFAULT NULL,
  `U` int(11) DEFAULT NULL,
  `V` int(11) DEFAULT NULL,
  `W` int(11) DEFAULT NULL,
  `X` int(11) DEFAULT NULL,
  `Y` int(11) DEFAULT NULL,
  `Z` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alphabet_book`
--

INSERT INTO `alphabet_book` (`book_id`, `creator_email`, `A`, `B`, `C`, `D`, `E`, `F`, `G`, `H`, `I`, `J`, `K`, `L`, `M`, `N`, `O`, `P`, `Q`, `R`, `S`, `T`, `U`, `V`, `W`, `X`, `Y`, `Z`) VALUES
(1, 'bob@example.com', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, 10, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'alice@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'bob@example.com', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 17, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'bob@example.com', NULL, NULL, NULL, NULL, NULL, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 19, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'bob@example.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blog_id` int(11) NOT NULL,
  `creator_email` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `event_date` date NOT NULL,
  `creation_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `modification_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `privacy_filter` enum('private','public') DEFAULT 'private'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blog_id`, `creator_email`, `title`, `description`, `event_date`, `creation_date`, `modification_date`, `privacy_filter`) VALUES
(1, 'alice@example.com', 'A for AI', 'A blog about the beauty of abstract art.', '2024-05-10', '2024-09-27 03:25:44', '2024-10-16 21:39:01', 'public'),
(2, 'alice@example.com', 'B for Books', 'My personal review of my favorite books.', '2024-06-01', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(3, 'alice@example.com', 'C for Cooking', 'Sharing some healthy and delicious recipes.', '2024-07-05', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(4, 'alice@example.com', 'D for Dance', 'An article about the art of dance.', '2024-07-18', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(5, 'alice@example.com', 'E for Exercise', 'Tips on staying fit and active.', '2024-08-20', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(6, 'bob@example.com', 'F for Football', 'The ultimate guide to enjoying football.', '2024-05-22', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(7, 'bob@example.com', 'G for Gardening', 'Gardening tips for a greener life.', '2024-06-10', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(8, 'bob@example.com', 'H for Hiking', 'An adventure into hiking trails.', '2024-06-28', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(9, 'bob@example.com', 'I for Innovation', 'Innovation in modern technology.', '2024-07-14', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(10, 'bob@example.com', 'J for Jazz', 'A deep dive into the world of Jazz music.', '2024-08-12', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(11, 'carol@example.com', 'K for Kite', 'A fun afternoon spent flying kites.', '2024-05-18', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(12, 'carol@example.com', 'L for Literature', 'Exploring classic literature from around the world.', '2024-06-02', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(13, 'carol@example.com', 'M for Music', 'How music influences mood and productivity.', '2024-07-01', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(14, 'carol@example.com', 'N for Nature', 'Capturing the beauty of nature through photography.', '2024-07-22', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(15, 'carol@example.com', 'O for Origami', 'A beginner’s guide to the art of Origami.', '2024-08-07', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(16, 'alice@example.com', 'P for Painting', 'An exploration of painting techniques.', '2024-06-15', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(17, 'bob@example.com', 'Q for Quilting', 'Quilting tips for beginners.', '2024-06-25', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(18, 'carol@example.com', 'R for Reading', 'The importance of reading in personal development.', '2024-07-04', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'private'),
(19, 'bob@example.com', 'S for Science', 'Discoveries in the field of science.', '2024-07-24', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public'),
(20, 'alice@example.com', 'T for Travel', 'A guide to traveling on a budget.', '2024-08-01', '2024-09-27 03:25:44', '2024-09-27 03:25:44', 'public');

-- --------------------------------------------------------

--
-- Table structure for table `preferences`
--

CREATE TABLE `preferences` (
  `name` varchar(100) NOT NULL,
  `value` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `active` tinyint(1) DEFAULT 1,
  `role` enum('admin','blogger') DEFAULT 'blogger',
  `created_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiration` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `token_created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`email`, `first_name`, `last_name`, `password`, `active`, `role`, `created_time`, `modified_time`, `reset_token`, `token_expiration`, `token_created_time`) VALUES
('alice@example.com', 'Alice', 'Johnson', 'hashed_password1', 1, 'blogger', '2024-09-27 03:25:44', '2024-09-27 03:25:44', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bob@example.com', 'Bob', 'Smith', 'hashed_password2', 1, 'admin', '2024-09-27 03:25:44', '2024-09-27 03:25:44', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('carol@example.com', 'Carol', 'Davis', 'hashed_password3', 1, 'blogger', '2024-09-27 03:25:44', '2024-09-27 03:25:44', NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alphabet_book`
--
ALTER TABLE `alphabet_book`
  ADD PRIMARY KEY (`book_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blog_id`);

--
-- Indexes for table `preferences`
--
ALTER TABLE `preferences`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alphabet_book`
--
ALTER TABLE `alphabet_book`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blog_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
