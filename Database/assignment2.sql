-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2020 at 12:39 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment2`
--
CREATE DATABASE IF NOT EXISTS `assignment2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `assignment2`;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `post_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `likes`:
--   `post_id`
--       `microphonepost` -> `id`
--

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`post_id`, `user_id`, `post_text`) VALUES
(103, 1, ''),
(102, 3, ''),
(102, 3, ''),
(100, 1, ''),
(102, 2, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(108, 3, ''),
(127, 3, '');

-- --------------------------------------------------------

--
-- Table structure for table `microphonepost`
--

CREATE TABLE `microphonepost` (
  `id` int(15) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `text` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `likes` int(11) DEFAULT NULL,
  `reply_to` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `microphonepost`:
--

--
-- Dumping data for table `microphonepost`
--

INSERT INTO `microphonepost` (`id`, `user_id`, `name`, `text`, `post_date`, `likes`, `reply_to`) VALUES
(100, 10, 'Best Innovative', 'Well Microphone are good Invention ', '2020-06-14 08:19:02', 0, 104),
(101, 15, 'Microphonone Best', 'Microphone is bad invention', '2020-06-14 09:32:07', 10, 104),
(102, 100, 'feduni', 'Microphone is sophisticated in use', '2020-06-14 08:21:05', NULL, NULL),
(103, 10, 'Best Innovative', 'Excellent for smaller/unattractive sounding rooms for isolating the instrument', '2020-06-14 08:21:20', NULL, NULL),
(104, 15, 'Microphonone Best', 'Impressive for concert amplification and recording', '2020-06-14 08:21:38', NULL, NULL),
(105, 15, 'Best Innovative', 'Universal multipattern studio microphone', '2020-06-14 08:20:38', NULL, NULL),
(106, 101, 'Microphone I8', 'This microphone is awesome', '2020-06-14 08:27:41', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reply`
--

CREATE TABLE `reply` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `reply_text` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- RELATIONSHIPS FOR TABLE `reply`:
--   `post_id`
--       `microphonepost` -> `id`
--   `user_id`
--       `users` -> `id`
--   `post_id`
--       `microphonepost` -> `id`
--   `user_id`
--       `users` -> `id`
--

--
-- Dumping data for table `reply`
--

INSERT INTO `reply` (`id`, `user_id`, `post_id`, `reply_text`, `date`) VALUES
(17, 15, 103, 'yes well said Mr. Balvinder', '2020-06-14 09:08:57'),
(18, 15, 103, 'hmmmmm', '2020-06-14 09:09:41'),
(19, 10, 100, 'yes it is', '2020-06-14 09:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `users`:
--

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(1, 'David', '$2y$12$/uzuvYyW6EBmOYirvsndDeMne/z2foz9f7b/ih8qUR8VFzO3UU/dS'),
(10, 'Ghaman', '$2y$12$73uOmc5hje2DUX.RmnsrROhIdBCBaz8AIrqHVd3nrUamSF/WCbqG.'),
(15, 'Balvinder Sngh', '$2y$12$bI6GHf43qDyrHtGMp.Mz1OIo05mQfhQVK7OTTgufrGwyHeuEpU29q'),
(100, 'Monty', '$2y$12$kNIraTGYlMoy1.MSkNpziuaA8iXq.iZVWmGwJ8D8zW6mLBrckfqtS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `microphonepost`
--
ALTER TABLE `microphonepost`
  ADD PRIMARY KEY (`id`,`user_id`) USING BTREE,
  ADD KEY `reply_to` (`reply_to`);

--
-- Indexes for table `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `microphonepost`
--
ALTER TABLE `microphonepost`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `reply`
--
ALTER TABLE `reply`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `microphonepost` (`id`);

--
-- Constraints for table `reply`
--
ALTER TABLE `reply`
  ADD CONSTRAINT `reply_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `microphonepost` (`id`),
  ADD CONSTRAINT `reply_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
