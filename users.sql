-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2018 at 02:49 PM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_anggota`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `oauth_provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `oauth_uid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `locale` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `picture_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `profile_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `oauth_provider`, `oauth_uid`, `first_name`, `last_name`, `email`, `gender`, `locale`, `picture_url`, `profile_url`, `created`, `modified`, `status`) VALUES
(22, 'google', '101136577193889456756', 'wira', 'kampit', 'wirakampit@gmail.com', '', 'in', 'https://lh5.googleusercontent.com/-hSdQfiA-Qzo/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7qfhARZi9vLII7lo65GvEUq7gZjHQ/mo/photo.jpg', 'https://plus.google.com/101136577193889456756', '2018-08-13 14:02:32', '2018-08-13 19:46:50', 1),
(23, 'google', '110261403958901029355', 'wira', 'kusuma', 'kusumawira98@gmail.com', '', 'in', 'https://lh3.googleusercontent.com/-I3lnqRDk9wI/AAAAAAAAAAI/AAAAAAAAABU/x3uVTsuKOU8/photo.jpg', 'https://plus.google.com/110261403958901029355', '2018-08-13 14:32:49', '2018-08-13 19:46:09', 0),
(24, 'google', '116278572693771529074', 'WIRA KUSUMA WARDANA', '-', 'wira.kusuma.tif16@polban.ac.id', '', 'en', 'https://lh5.googleusercontent.com/-45KyWxfsn4I/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7oZcheRyw14X86TP4CIotlRn77ZEA/mo/photo.jpg', '', '2018-08-13 17:50:30', '2018-08-13 19:32:31', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
