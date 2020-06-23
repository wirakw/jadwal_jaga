-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2018 at 09:38 AM
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
-- Stand-in structure for view `calendar`
-- (See below for the actual view)
--
CREATE TABLE `calendar` (
`title` varchar(255)
,`status` varchar(20)
,`start` datetime
,`Email` varchar(100)
);

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `dev_sebelumnya` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `color` varchar(7) NOT NULL DEFAULT '#3a87ad',
  `start` datetime NOT NULL,
  `end` datetime DEFAULT NULL,
  `update_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `dev_sebelumnya`, `status`, `description`, `color`, `start`, `end`, `update_at`) VALUES
(140, 'Wira Kusuma Wardana', 'Sidiq', 'secondary', '', '#6298ef', '2018-07-31 00:00:00', '2018-08-01 00:00:00', '2018-08-09 00:00:00'),
(141, 'Sidiq', 'Wira Kusuma Wardana', 'primary', '', '#094cb7', '2018-07-31 00:00:00', '2018-08-01 00:00:00', '2018-08-10 00:00:00'),
(142, 'Gani', '', 'secondary', '', '#6298ef', '2018-08-01 00:00:00', '2018-08-02 00:00:00', '0000-00-00 00:00:00'),
(143, 'Cecep Sutisna', 'Sidiq', 'primary', '', '#094cb7', '2018-08-01 00:00:00', '2018-08-02 00:00:00', '2018-08-10 00:00:00'),
(144, 'Arief', '', 'secondary', '', '#6298ef', '2018-08-09 00:00:00', '2018-08-10 00:00:00', '0000-00-00 00:00:00'),
(145, 'Cecep Sutisna', '', 'primary', '', '#094cb7', '2018-08-09 00:00:00', '2018-08-10 00:00:00', '0000-00-00 00:00:00'),
(146, 'Sidiq', '', 'secondary', '', '#6298ef', '2018-08-08 00:00:00', '2018-08-09 00:00:00', '0000-00-00 00:00:00'),
(147, 'Arief', 'Gani', 'primary', 'sakit', '#094cb7', '2018-08-08 00:00:00', '2018-08-09 00:00:00', '2018-08-11 00:00:00'),
(148, 'Gani', 'Cecep Sutisna', 'primary', '', '#094cb7', '2018-08-10 00:00:00', '2018-08-11 00:00:00', '2018-08-09 00:00:00'),
(149, 'Wira Kusuma Wardana', 'Sidiq', 'secondary', '', '#6298ef', '2018-08-10 00:00:00', '2018-08-11 00:00:00', '2018-08-09 00:00:00'),
(150, 'Arief', 'Wira Kusuma Wardana', 'primary', '', '#094cb7', '2018-08-11 00:00:00', '2018-08-12 00:00:00', '2018-08-10 00:00:00'),
(151, 'Cecep Sutisna', 'Sidiq', 'secondary', '', '#6298ef', '2018-08-11 00:00:00', '2018-08-12 00:00:00', '2018-08-10 00:00:00'),
(154, 'Gani', '', 'secondary', '', '#6298ef', '2018-08-15 00:00:00', '2018-08-16 00:00:00', '0000-00-00 00:00:00'),
(155, 'Angga', 'Wira Kusuma Wardana', 'primary', '', '#094cb7', '2018-08-15 00:00:00', '2018-08-16 00:00:00', '2018-08-11 00:00:00'),
(156, 'Angga', '', 'secondary', '', '#6298ef', '2018-08-02 00:00:00', '2018-08-03 00:00:00', '0000-00-00 00:00:00'),
(157, 'Arief', '', 'primary', '', '#094cb7', '2018-08-02 00:00:00', '2018-08-03 00:00:00', '0000-00-00 00:00:00'),
(158, 'Sidiq', '', 'secondary', '', '#6298ef', '2018-08-16 00:00:00', '2018-08-17 00:00:00', '0000-00-00 00:00:00'),
(159, 'Arief', 'Wira Kusuma Wardana', 'primary', '', '#094cb7', '2018-08-16 00:00:00', '2018-08-17 00:00:00', '2018-08-13 00:00:00'),
(160, 'Angga', 'Wira Kusuma Wardana', 'primary', '', '#094cb7', '2018-08-06 00:00:00', '2018-08-07 00:00:00', '2018-08-12 00:00:00'),
(161, 'Cecep Sutisna', '', 'secondary', '', '#6298ef', '2018-08-06 00:00:00', '2018-08-07 00:00:00', '0000-00-00 00:00:00'),
(162, 'Cecep Sutisna', '', 'primary', '', '#094cb7', '2018-08-03 00:00:00', '2018-08-04 00:00:00', '0000-00-00 00:00:00'),
(163, 'Gani', '', 'secondary', '', '#6298ef', '2018-08-03 00:00:00', '2018-08-04 00:00:00', '0000-00-00 00:00:00'),
(164, 'Gani', '', 'primary', '', '#094cb7', '2018-08-07 00:00:00', '2018-08-08 00:00:00', '0000-00-00 00:00:00'),
(165, 'Angga', '', 'secondary', '', '#6298ef', '2018-08-07 00:00:00', '2018-08-08 00:00:00', '0000-00-00 00:00:00'),
(166, 'Wira Kusuma Wardana', '', 'primary', '', '#094cb7', '2018-07-29 00:00:00', '2018-07-30 00:00:00', '0000-00-00 00:00:00'),
(167, 'Angga', '', 'secondary', '', '#6298ef', '2018-07-29 00:00:00', '2018-07-30 00:00:00', '0000-00-00 00:00:00'),
(168, 'Wira Kusuma Wardana', '', 'primary', '', '#094cb7', '2018-08-14 00:00:00', '2018-08-15 00:00:00', '0000-00-00 00:00:00'),
(169, 'Cecep Sutisna', '', 'secondary', '', '#6298ef', '2018-08-14 00:00:00', '2018-08-15 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `log_mail`
--

CREATE TABLE `log_mail` (
  `id` int(11) NOT NULL,
  `waktu_kirim` datetime NOT NULL,
  `email_penerima` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `log_mail`
--

INSERT INTO `log_mail` (`id`, `waktu_kirim`, `email_penerima`) VALUES
(12, '2018-08-08 11:57:21', 'wirakampit@gmail.com'),
(13, '2018-08-08 11:57:33', 'wirakampit@gmail.com'),
(14, '2018-08-08 11:57:48', 'wirakampit@gmail.com'),
(15, '2018-08-08 13:30:21', 'wirakampit@gmail.com'),
(16, '2018-08-08 13:30:26', 'wirakampit@gmail.com'),
(17, '2018-08-08 13:43:49', 'wirakampit@gmail.com'),
(18, '2018-08-08 13:43:51', 'wirakampit@gmail.com'),
(19, '2018-08-08 13:46:05', 'wirakampit@gmail.com'),
(20, '2018-08-08 13:46:07', 'wirakampit@gmail.com'),
(21, '2018-08-08 14:13:17', 'wirakampit@gmail.com'),
(22, '2018-08-09 09:41:12', 'wirakampit@gmail.com'),
(23, '2018-08-09 14:29:37', 'wirakampit@gmail.com'),
(24, '2018-08-09 14:39:11', 'wirakampit@gmail.com'),
(25, '2018-08-09 14:47:09', 'wirakampit@gmail.com'),
(26, '2018-08-09 14:57:54', 'wirakampit@gmail.com'),
(27, '2018-08-09 15:16:16', 'wirakampit@gmail.com'),
(30, '2018-08-09 15:38:43', ''),
(31, '2018-08-09 15:38:43', ''),
(32, '2018-08-09 15:42:08', 'cecep.sutisna.tif16@polban.ac.id'),
(33, '2018-08-09 15:42:08', 'wirakampit@gmail.com'),
(34, '2018-08-09 15:44:45', 'Gani@gmail.com'),
(35, '2018-08-09 15:44:45', 'sidiq@gmail.com'),
(36, '2018-08-09 15:48:01', 'Gani@gmail.com'),
(37, '2018-08-09 15:48:01', 'sidiq@gmail.com'),
(38, '2018-08-09 15:50:12', 'cecep.sutisna.tif16@polban.ac.id'),
(39, '2018-08-09 15:50:12', 'wirakampit@gmail.com'),
(40, '2018-08-09 15:52:25', 'wirakampit@gmail.com'),
(41, '2018-08-09 15:52:25', 'wira.kusuma.tif16@polban.ac.id'),
(42, '2018-08-09 15:54:38', 'cecep.sutisna.tif16@polban.ac.id'),
(43, '2018-08-09 15:54:38', 'wirakampit@gmail.com'),
(44, '2018-08-09 16:08:42', 'cecep.sutisna.tif16@polban.ac.id'),
(45, '2018-08-09 16:08:42', 'wirakampit@gmail.com'),
(46, '2018-08-10 07:25:37', 'angga@gmail.com'),
(47, '2018-08-10 07:25:37', 'sidiq@gmail.com'),
(48, '2018-08-13 15:03:25', 'cecep.sutisna.tif16@polban.ac.id'),
(49, '2018-08-13 15:03:25', 'wirakampit@gmail.com'),
(50, '2018-08-13 15:08:13', 'cecep.sutisna.tif16@polban.ac.id'),
(51, '2018-08-13 15:08:13', 'wirakampit@gmail.com'),
(52, '2018-08-13 15:15:03', 'cecep.sutisna.tif16@polban.ac.id'),
(53, '2018-08-13 15:15:03', 'wirakampit@gmail.com'),
(54, '2018-08-13 15:18:12', 'cecep.sutisna.tif16@polban.ac.id'),
(55, '2018-08-13 15:18:12', 'wirakampit@gmail.com'),
(56, '2018-08-13 15:20:36', 'cecep.sutisna.tif16@polban.ac.id'),
(57, '2018-08-13 15:20:36', 'wirakampit@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `t_anggota`
--

CREATE TABLE `t_anggota` (
  `id` int(4) NOT NULL,
  `Kode` varchar(100) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Status` enum('Primary','Secondary','null') NOT NULL,
  `Peran` enum('Administrator','Developer','Support') NOT NULL,
  `Email` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_anggota`
--

INSERT INTO `t_anggota` (`id`, `Kode`, `Nama`, `Status`, `Peran`, `Email`, `created_at`, `updated_at`) VALUES
(6, 'AD-01', 'Cecep Sutisna', 'Primary', 'Administrator', 'cecep.sutisna.tif16@polban.ac.id', '2018-07-25 05:13:07', '2018-08-01 05:37:56'),
(7, 'DV-01', 'Wira Kusuma Wardana', 'Primary', 'Developer', 'wirakampit@gmail.com', '2018-07-25 05:16:16', '2018-07-27 06:42:43'),
(8, 'DV-02', 'Arief', 'Primary', 'Developer', 'arief@gmail.com', '2018-07-25 05:16:41', '2018-07-26 11:07:31'),
(9, 'DV-03', 'Gani', 'Primary', 'Developer', 'Gani@gmail.com', '2018-07-25 05:17:32', '2018-07-26 10:19:11'),
(10, 'DV-04', 'Angga', 'Primary', 'Developer', 'angga@gmail.com', '2018-07-25 05:17:43', '2018-07-26 10:19:19'),
(11, 'DV-05', 'Sidiq', 'Primary', 'Developer', 'sidiq@gmail.com', '2018-07-25 05:17:51', '2018-07-26 10:19:26'),
(12, 'DV-06', 'Amar', 'Secondary', 'Developer', 'amar@gmail.com', '2018-07-25 05:18:02', '2018-07-26 10:19:35'),
(13, 'DV-07', 'Rio', 'Secondary', 'Developer', 'rio@gmail.com', '2018-07-25 05:18:11', '2018-07-26 10:19:44'),
(14, 'AD-02', 'Wildan', 'Secondary', 'Administrator', 'wildan@gmail.com', '2018-07-25 05:18:21', '2018-07-31 10:15:29'),
(17, 'DV-08', 'Tia', 'Secondary', 'Developer', 'tia@gmail.com', '2018-07-25 05:18:48', '2018-08-01 05:38:14'),
(18, 'DV-09', 'Fajar', 'Secondary', 'Developer', 'fajar@gmail.com', '2018-07-25 05:52:14', '2018-07-26 10:59:00'),
(19, 'DV-10', 'Fatur', 'Secondary', 'Developer', 'fatur@gmail.com', '2018-07-26 06:13:48', '2018-07-26 10:20:21'),
(21, 'SP-01', 'Rizka', 'null', 'Support', 'rian@gmail.com', '2018-07-26 10:18:15', '2018-07-26 10:20:47');

-- --------------------------------------------------------

--
-- Table structure for table `t_izin`
--

CREATE TABLE `t_izin` (
  `id` int(4) NOT NULL,
  `Kode` varchar(100) NOT NULL,
  `Nama` char(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `Ket` enum('Izin','Sakit','Tugas_Kantor') NOT NULL,
  `Alasan` text NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t_izin`
--

INSERT INTO `t_izin` (`id`, `Kode`, `Nama`, `created_at`, `Ket`, `Alasan`, `updated_at`) VALUES
(11, 'undefined', 'Wira Kusuma Wardana', '2018-07-02 06:06:13', 'Sakit', 'Meriang', '2018-08-01 05:27:23'),
(12, 'undefined', 'Cecep Sutisna', '2018-07-27 06:17:19', 'Tugas_Kantor', 'Tugas di Makassar', '2018-07-27 09:13:43');

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
(22, 'google', '101136577193889456756', 'wira', 'kampit', 'wirakampit@gmail.com', '', 'in', 'https://lh5.googleusercontent.com/-hSdQfiA-Qzo/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7qfhARZi9vLII7lo65GvEUq7gZjHQ/mo/photo.jpg', 'https://plus.google.com/101136577193889456756', '2018-08-13 14:02:32', '2018-08-14 09:57:36', 1),
(23, 'google', '110261403958901029355', 'wira', 'kusuma', 'kusumawira98@gmail.com', '', 'in', 'https://lh3.googleusercontent.com/-I3lnqRDk9wI/AAAAAAAAAAI/AAAAAAAAABU/x3uVTsuKOU8/photo.jpg', 'https://plus.google.com/110261403958901029355', '2018-08-13 14:32:49', '2018-08-14 09:58:45', 1),
(24, 'google', '116278572693771529074', 'WIRA KUSUMA WARDANA', '-', 'wira.kusuma.tif16@polban.ac.id', '', 'en', 'https://lh5.googleusercontent.com/-45KyWxfsn4I/AAAAAAAAAAI/AAAAAAAAAAA/AAnnY7oZcheRyw14X86TP4CIotlRn77ZEA/mo/photo.jpg', '', '2018-08-13 17:50:30', '2018-08-13 19:32:31', 0);

-- --------------------------------------------------------

--
-- Structure for view `calendar`
--
DROP TABLE IF EXISTS `calendar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `calendar`  AS  select `e`.`title` AS `title`,`e`.`status` AS `status`,`e`.`start` AS `start`,`t`.`Email` AS `Email` from ((`events` `e` join `log_mail` `l`) join `t_anggota` `t`) where (`e`.`title` = `t`.`Nama`) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log_mail`
--
ALTER TABLE `log_mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t_anggota`
--
ALTER TABLE `t_anggota`
  ADD PRIMARY KEY (`id`,`Kode`);

--
-- Indexes for table `t_izin`
--
ALTER TABLE `t_izin`
  ADD PRIMARY KEY (`id`,`Kode`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `log_mail`
--
ALTER TABLE `log_mail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `t_anggota`
--
ALTER TABLE `t_anggota`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `t_izin`
--
ALTER TABLE `t_izin`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
