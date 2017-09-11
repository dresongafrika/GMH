-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 11, 2017 at 03:18 PM
-- Server version: 5.7.14
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gospel_music_hotspot`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(50) NOT NULL,
  `admin_name` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_name`, `password`) VALUES
(1, 'dresong', 'people@8624');

-- --------------------------------------------------------

--
-- Table structure for table `advertisement`
--

CREATE TABLE `advertisement` (
  `ad_id` int(50) NOT NULL,
  `program_name` varchar(120) NOT NULL,
  `banner_link` varchar(120) NOT NULL,
  `phone_number` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `prog_url` varchar(120) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `message_id` int(50) NOT NULL,
  `message_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `guest_name` varchar(120) NOT NULL,
  `message_link` varchar(120) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fan_messages`
--

CREATE TABLE `fan_messages` (
  `artiste_name` varchar(120) NOT NULL,
  `message_link` varchar(120) NOT NULL,
  `message_date` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `artiste_id` int(30) NOT NULL,
  `first_name` varchar(120) DEFAULT NULL,
  `last_name` varchar(120) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `born_again` date DEFAULT NULL,
  `sex` enum('','MALE','FEMALE') NOT NULL,
  `country` varchar(120) DEFAULT NULL,
  `phone` varchar(120) DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `fb_link` varchar(120) DEFAULT NULL,
  `twitter_link` varchar(120) DEFAULT NULL,
  `artiste_name` varchar(120) NOT NULL,
  `password` varchar(120) DEFAULT NULL,
  `membership_date` timestamp NULL DEFAULT NULL,
  `expiry_date` timestamp NULL DEFAULT NULL,
  `transaction_id` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`artiste_id`, `first_name`, `last_name`, `dob`, `born_again`, `sex`, `country`, `phone`, `email`, `address`, `fb_link`, `twitter_link`, `artiste_name`, `password`, `membership_date`, `expiry_date`, `transaction_id`) VALUES
(77, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, '', '$2y$10$MrjK8EFOf0Mmseq0FrtDM.LAQZC/WQ0goWqMutWbeg2f0alTnPPyK', NULL, NULL, NULL),
(78, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 'jesus', '$2y$10$BfWHh.TeJkpTm.ylki.qQuzaiziL/5RflDBFZ25y2MPXylfwWhbxm', '2017-09-11 09:05:55', '2017-09-11 09:05:55', 'demo-59b5b980f0957'),
(79, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 'ejike', '$2y$10$oN9uI70teIo94W2L.iEQQOJOIboywYumHi10yUiBrnScZIFx8orbW', '2017-09-11 09:39:02', '2017-09-11 09:39:02', 'demo-59b659ab46c86'),
(80, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 'ifeanyi', '$2y$10$yYnOKPDiVOTzcXAjxtSCbu0I5EPI.znQfDoSbTRtc.ogXJ9CdAED.', '2017-09-11 10:12:14', '2017-09-11 10:12:14', 'demo-59b6614ab1c0e'),
(81, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, 'mercy', '$2y$10$3ND5Tt.HjpFZR3khTZe06es4Agzn3fRzjJuvAMVBQVIRyPGP6XJA.', '2017-09-11 11:17:49', '2017-09-11 11:17:49', 'demo-59b670c8eb34f');

-- --------------------------------------------------------

--
-- Table structure for table `members_songs`
--

CREATE TABLE `members_songs` (
  `artiste_id` int(50) NOT NULL,
  `artiste_name` varchar(120) NOT NULL,
  `song_title` varchar(120) NOT NULL,
  `album_name` varchar(150) NOT NULL,
  `album_art` varchar(120) NOT NULL,
  `song_link` varchar(250) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `music_promotion`
--

CREATE TABLE `music_promotion` (
  `artiste_id` int(30) NOT NULL,
  `artiste_name` varchar(120) NOT NULL,
  `phone` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `song_title` varchar(120) NOT NULL,
  `album_art` varchar(120) NOT NULL,
  `mp3_name` varchar(120) NOT NULL,
  `song_link` varchar(120) NOT NULL,
  `upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tmp_member`
--

CREATE TABLE `tmp_member` (
  `id` int(150) NOT NULL,
  `artiste_name` varchar(150) DEFAULT NULL,
  `password` varchar(150) DEFAULT NULL,
  `tmp_reg_time` timestamp(6) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tmp_member`
--

INSERT INTO `tmp_member` (`id`, `artiste_name`, `password`, `tmp_reg_time`) VALUES
(1, 'james', '', '0000-00-00 00:00:00.000000'),
(2, 'adeboye', 'kekdskdskdkd', '0000-00-00 00:00:00.000000'),
(3, 'gift', '$2y$10$gWeGPcJ39M2d3YDFAFc8Ae.FGBF9AD06w0Q4cXtQ5C5NP.Lv5Wj6y', '0000-00-00 00:00:00.000000'),
(4, 'bambam', '$2y$10$XYS.9TXaTpDS1DWzMsZNiu5.340yP8KW25gQEwfRYnxM6DDYdrpCu', '0000-00-00 00:00:00.000000'),
(5, 'jesus', '$2y$10$BfWHh.TeJkpTm.ylki.qQuzaiziL/5RflDBFZ25y2MPXylfwWhbxm', '0000-00-00 00:00:00.000000'),
(6, 'okereke', '$2y$10$4MmRcSG7QpBfJ/j21INeH.gyqVvAUp5Lwd/iqI3VRfEnl9vodzSOK', '2017-09-11 09:26:03.000000'),
(7, '', '$2y$10$O9JoAc7cZY5P3KbzMm4CDuDL7rNbDCDtmEO1uucHPN1sxh3.pLbr6', '2017-09-11 09:30:08.000000'),
(8, 'ugonna', '$2y$10$02mKfgWj9VFkfhNqstLSqe7/6wCCHCguR2h6RvUH8t7Dz4yBFPKeG', '2017-09-11 09:30:19.000000'),
(9, 'femi', '$2y$10$f1pz9YW79f9maQBBJG1bJe6DEI7RFIxbFNx0h3r/LUo9ZRMKpK9KC', '2017-09-11 09:32:16.000000'),
(12, 'aanu', '$2y$10$2Fl.JdY8sAoXyKRaisNLtuzqFxUv3blNrLCP1rlhR/tx09ET0Vew2', '2017-09-11 11:09:00.000000'),
(13, 'tim', '$2y$10$8fITOpL6XGTVSYZqkd.g0.89qHcxC/sSqnoT/fSYUj.i/cyfWc70m', '2017-09-11 11:12:40.000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `advertisement`
--
ALTER TABLE `advertisement`
  ADD PRIMARY KEY (`ad_id`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`artiste_id`);

--
-- Indexes for table `music_promotion`
--
ALTER TABLE `music_promotion`
  ADD PRIMARY KEY (`artiste_id`);

--
-- Indexes for table `tmp_member`
--
ALTER TABLE `tmp_member`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `advertisement`
--
ALTER TABLE `advertisement`
  MODIFY `ad_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `message_id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `artiste_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `music_promotion`
--
ALTER TABLE `music_promotion`
  MODIFY `artiste_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `tmp_member`
--
ALTER TABLE `tmp_member`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
