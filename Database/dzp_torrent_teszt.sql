-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 04:08 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dzp_torrent`
--
CREATE DATABASE IF NOT EXISTS `dzp_torrent` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `dzp_torrent`;

-- --------------------------------------------------------

--
-- Table structure for table `bounty`
--

CREATE TABLE IF NOT EXISTS `bounty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `description` text NOT NULL,
  `completed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `user_id`, `date`, `content`) VALUES
(1, 1, '2024-04-11 10:19:29', 'Sziasztok'),
(2, 2, '2024-04-11 10:19:35', 'hello'),
(3, 1, '2024-04-11 10:19:40', 'Hogy vagy?'),
(4, 2, '2024-04-11 10:19:44', 'jól, te?'),
(5, 1, '2024-04-11 10:19:53', 'Én nem'),
(6, 2, '2024-04-11 10:20:01', 'az nem jó:(');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `good_rating` int(11) NOT NULL,
  `bad_rating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `torrent_id` (`torrent_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `help_desk`
--

CREATE TABLE IF NOT EXISTS `help_desk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `resolved` tinyint(1) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `help_desk`
--

INSERT INTO `help_desk` (`id`, `user_id`, `topic`, `email`, `content`, `resolved`, `date`) VALUES
(1, 2, 'Sürgős!', 'petofisandor1823@gmail.com', 'Menjünk szabadságharcot indítani! Tali a Pilvaxban', 1, '2024-04-27 21:56:34');

-- --------------------------------------------------------

--
-- Table structure for table `leaderboard`
--

CREATE TABLE IF NOT EXISTS `leaderboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `points` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `actual` tinyint(1) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date`, `title`, `content`, `actual`, `user_id`) VALUES
(3, '2024-04-13 00:10:33', 'hír', 'Támadnak a földönkívüliek, vásároljatok konzerveket és bújjatok el!!', 1, 1),
(4, '2024-04-13 00:53:26', 'új hír', 'Lengyelország megtámadta Magyarországot mert elfogyott a rubik kockájuk', 0, 1),
(5, '2024-04-13 20:47:32', 'időjárás', 'esni fog valamikor', 1, 1),
(6, '2024-04-24 20:10:15', 'szúnyog riadó', 'elszaporodtak a gyilkos medveszúnyogok!!!', 0, 1),
(7, '2024-04-24 22:44:32', 'világvége', 'mindjárt becsapódik az Oumuamua aszterodia', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pictures`
--

CREATE TABLE IF NOT EXISTS `pictures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `torrent_id` int(11) NOT NULL,
  `image_data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `torrent_id` (`torrent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE IF NOT EXISTS `rank` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`id`, `name`) VALUES
(1, 'User'),
(2, 'Moderator'),
(3, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `statistics`
--

CREATE TABLE IF NOT EXISTS `statistics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `last_log_time` datetime NOT NULL,
  `lb_id` int(11) NOT NULL,
  `total_uploaded_size` varchar(25) NOT NULL,
  `total_download_size` varchar(25) NOT NULL,
  `current_upload` varchar(10) NOT NULL,
  `current_download` varchar(10) NOT NULL,
  `bounties_made` mediumint(9) NOT NULL,
  `bounties_completed` mediumint(9) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `lb_id` (`lb_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `torrents`
--

CREATE TABLE IF NOT EXISTS `torrents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `file_name` varchar(120) NOT NULL,
  `upload_time` datetime NOT NULL,
  `category_id` int(11) NOT NULL,
  `torrent_size` varchar(15) DEFAULT NULL,
  `file_number` int(11) NOT NULL,
  `rating_avg` decimal(10,0) DEFAULT NULL,
  `torrent_description` tinytext NOT NULL,
  `dot_torrent_file` blob NOT NULL,
  `info_hash` varchar(40) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `tdisplay_name` varchar(100) NOT NULL,
  `seeders` int(255) NOT NULL,
  `leechers` int(255) NOT NULL,
  `completed` int(255) NOT NULL,
  `is_anonymous` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `category_id` (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_category`
--

CREATE TABLE IF NOT EXISTS `torrent_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `torrent_category`
--

INSERT INTO `torrent_category` (`id`, `name`) VALUES
(1, 'Movie'),
(2, 'Series'),
(3, 'Lossy Audio'),
(4, 'Lossless Audio'),
(5, 'Software Application'),
(6, 'Software Game'),
(7, 'Pictures'),
(8, 'Literature');

-- --------------------------------------------------------

--
-- Table structure for table `torrent_rating`
--

CREATE TABLE IF NOT EXISTS `torrent_rating` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `torrent_seeded`
--

CREATE TABLE IF NOT EXISTS `torrent_seeded` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `seed_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(120) NOT NULL,
  `email` varchar(100) NOT NULL,
  `avatar_path` varchar(255) NOT NULL DEFAULT 'imgs/MONKE.png',
  `class_id` int(11) NOT NULL DEFAULT 1,
  `reg_time` date NOT NULL,
  `silenced` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `class_id` (`class_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `avatar_path`, `class_id`, `reg_time`, `silenced`) VALUES
(1, 'Admin', '3066628e7d6ce553cab5070c5b16528601ef798899f6d7da3449d5bc8cc501e3', 'admin@gmail.com', 'imgs/MONKE.png', 3, '2024-04-25', 0),
(2, 'Petofi_Sandor', 'b3c0c8b8969062510db35bbd92e7e05ed53432aff31bf921ef8649234d1cbaee', 'petofisandor1823@gmail.com', 'imgs/MONKE.png', 1, '2024-04-27', 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bounty`
--
ALTER TABLE `bounty`
  ADD CONSTRAINT `bounty_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `help_desk`
--
ALTER TABLE `help_desk`
  ADD CONSTRAINT `help_desk_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `leaderboard`
--
ALTER TABLE `leaderboard`
  ADD CONSTRAINT `leaderboard_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `pictures`
--
ALTER TABLE `pictures`
  ADD CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`torrent_id`) REFERENCES `torrents` (`id`);

--
-- Constraints for table `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `statistics_ibfk_2` FOREIGN KEY (`lb_id`) REFERENCES `leaderboard` (`id`);

--
-- Constraints for table `torrent_rating`
--
ALTER TABLE `torrent_rating`
  ADD CONSTRAINT `torrent_rating_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `torrent_seeded`
--
ALTER TABLE `torrent_seeded`
  ADD CONSTRAINT `torrent_seeded_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `rank` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
