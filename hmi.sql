-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2017 at 08:17 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hmi`
--

-- --------------------------------------------------------

--
-- Table structure for table `disease`
--

CREATE TABLE `disease` (
  `did` tinyint(100) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `histonemods`
--

CREATE TABLE `histonemods` (
  `hmid` tinyint(100) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `effectType` bit(1) NOT NULL COMMENT '1 = repression; 0 = activation.',
  `magnitude` tinyint(2) UNSIGNED NOT NULL COMMENT '0 = min, 10 = max'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `histonemods`
--

INSERT INTO `histonemods` (`hmid`, `name`, `effectType`, `magnitude`) VALUES
(1, 'H2ALys4', b'1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `mid` tinyint(100) UNSIGNED NOT NULL,
  `tid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `message` longtext COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nucelosomesequence`
--

CREATE TABLE `nucelosomesequence` (
  `nsid` tinyint(100) UNSIGNED NOT NULL,
  `did` tinyint(100) UNSIGNED DEFAULT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nucleosome`
--

CREATE TABLE `nucleosome` (
  `nid` tinyint(100) UNSIGNED NOT NULL,
  `ndsid` tinyint(100) UNSIGNED NOT NULL,
  `histoneMods` varchar(48) COLLATE latin1_general_ci NOT NULL COMMENT 'Each histoneMod to be separated by a comma.',
  `nsid` tinyint(100) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `nucleosomednasequence`
--

CREATE TABLE `nucleosomednasequence` (
  `ndsid` tinyint(100) UNSIGNED NOT NULL,
  `DNASequence` varchar(127) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `rid` tinyint(100) UNSIGNED NOT NULL,
  `mid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `message` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `tid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `subject` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `message` longtext COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`tid`, `uid`, `subject`, `message`) VALUES
(20, 11, 'Welcome To The Forum', 'Hi guys, here you can introduce yourself to the community. I will start:\r\n\r\n[i]Hey, I am [b]Reiss[/b] and I am an aspiring Biology Studenty![/i]\r\n\r\nYou [b]can[/b] use mark down:\r\n\r\n[l][li]test[/li][/l]');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `firstName` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `secondName` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `emailAddress` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `interest` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `hash` varchar(32) COLLATE latin1_general_ci DEFAULT NULL,
  `level` tinyint(1) UNSIGNED NOT NULL DEFAULT '0' COMMENT 'This is their forum level, 1 = admin.'
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `firstName`, `secondName`, `emailAddress`, `password`, `interest`, `hash`, `level`) VALUES
(11, 'Reiss', 'Jones', 'reiss1999@gmail.com', 'iNvyRTQWLnT9Y', 'Student', '51aa5d862c9c17f7e374faf3de1a52e6', 1),
(12, 'Dave', 'Daveboy', 'reiss1999dev@gmail.com', 'iNvyRTQWLnT9Y', 'Company', 'fba69756806d5ad07e3374a347b4de97', 0),
(13, 'Steven', 'Hawking', 'reissjones@outlook.com', 'iNvyRTQWLnT9Y', 'Scientist', 'fba69756806d5ad07e3374a347b4de97', 0),
(14, 'Ed', 'Digby', 'ed@ed.com', 'iNvyRTQWLnT9Y', 'Company', 'fba69756806d5ad07e3374a347b4de97', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `disease`
--
ALTER TABLE `disease`
  ADD PRIMARY KEY (`did`);

--
-- Indexes for table `histonemods`
--
ALTER TABLE `histonemods`
  ADD PRIMARY KEY (`hmid`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`mid`);

--
-- Indexes for table `nucelosomesequence`
--
ALTER TABLE `nucelosomesequence`
  ADD PRIMARY KEY (`nsid`);

--
-- Indexes for table `nucleosome`
--
ALTER TABLE `nucleosome`
  ADD PRIMARY KEY (`nid`);

--
-- Indexes for table `nucleosomednasequence`
--
ALTER TABLE `nucleosomednasequence`
  ADD PRIMARY KEY (`ndsid`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`rid`);

--
-- Indexes for table `thread`
--
ALTER TABLE `thread`
  ADD PRIMARY KEY (`tid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `disease`
--
ALTER TABLE `disease`
  MODIFY `did` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `histonemods`
--
ALTER TABLE `histonemods`
  MODIFY `hmid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- AUTO_INCREMENT for table `nucelosomesequence`
--
ALTER TABLE `nucelosomesequence`
  MODIFY `nsid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `nucleosome`
--
ALTER TABLE `nucleosome`
  MODIFY `nid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `nucleosomednasequence`
--
ALTER TABLE `nucleosomednasequence`
  MODIFY `ndsid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `rid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `tid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
