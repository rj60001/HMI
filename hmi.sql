-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 22, 2018 at 11:03 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
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
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `name` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `notes` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`did`, `uid`, `name`, `notes`) VALUES
(6, 11, 'Alzheimers', 'morkdmoirmriodg'),
(7, 11, 'MSS', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `histonemods`
--

CREATE TABLE `histonemods` (
  `hmid` tinyint(100) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `effectType` bit(1) NOT NULL COMMENT '1 = repression; 0 = activation.',
  `magnitude` float UNSIGNED NOT NULL COMMENT '0 = min, 10 = max',
  `notes` varchar(1000) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `histonemods`
--

INSERT INTO `histonemods` (`hmid`, `name`, `effectType`, `magnitude`, `notes`) VALUES
(1, 'H2ALys4Esa1', b'0', 1, NULL),
(2, 'H2ALys5Tip60/p300-CBP', b'0', 1, NULL),
(3, 'HS1Lys7Esa1', b'0', 1, NULL),
(4, 'H2BLys5p300/ATF2', b'0', 1, NULL),
(5, 'H2BLys11Gcn5', b'0', 1, NULL),
(6, 'H2BLys12p300-CBP/ATF2', b'0', 1, NULL),
(7, 'H2BLys15p300-CBP/ATF2', b'0', 1, NULL),
(8, 'H2BLys16Gcn5/Esa1', b'0', 1, NULL),
(9, 'H2BLys20p300', b'0', 1, NULL),
(10, 'H3Lys4Esa1', b'0', 1, NULL),
(11, 'H3Lys9Gcn5/SRC-1', b'0', 1, NULL),
(12, 'H3Lys14Gcn5/PCAF', b'0', 1, NULL),
(13, 'H3Lys14Esa1/Tip60', b'0', 1, 'Can cause DNA repair.'),
(14, 'H3Lys14SRC-1', b'0', 1, NULL),
(15, 'H3Lys14Elp3', b'0', 1, NULL),
(16, 'H3Lys14hTFIIIC90', b'0', 1, 'Aids RNA polymerase III transcription.'),
(17, 'H3Lys14TAF1', b'0', 1, 'Aids RNA polymerase II transcription.'),
(18, 'H3Lys14Sas2', b'0', 1, 'Helps to create euchromatin.'),
(19, 'H3Lys14Sas3', b'0', 1, 'Activates via elongation.'),
(20, 'H3Lys14p300', b'0', 1, NULL),
(21, 'H3Lys18Gcn5', b'0', 1, 'Can also cause DNA repair.'),
(22, 'H3Lys18p300/CBP', b'0', 1, 'Can also cause DNA replication'),
(23, 'H3Lys23Gcn5', b'0', 1, 'Also causes DNA reparation.'),
(24, 'H3Lys23Sas3', b'0', 1, 'Activation causes through DNA elongation.'),
(25, 'H3Lys23p300/CBP', b'0', 1, NULL),
(26, 'H3Lys27Gcn5', b'0', 1, NULL),
(27, 'H3Lys36Gcn5', b'0', 1, NULL),
(28, 'H3Lys56Spt10', b'0', 1, 'Can cause DNA repair.'),
(29, 'H4Lys5Esa1/Tip60', b'0', 1, 'Can also cause DNA repair.'),
(30, 'H4Lys5ATF2', b'0', 1, NULL),
(31, 'H4Lys5p300', b'0', 1, NULL),
(32, 'H4Lys8Gcn5/PCAF', b'0', 1, NULL),
(33, 'H4Lys8Esa1/Tip60', b'0', 1, 'May also cause DNA repair.'),
(34, 'H4Lys8ATF2', b'0', 1, NULL),
(35, 'H4Lys8Elp3', b'0', 1, 'Activation caused via elongation.'),
(36, 'H4Lys8p300', b'0', 1, NULL),
(37, 'H4Lys12Hat1', b'1', 1, 'Repression cause by telometric silencing. Can also cause histone deposition.'),
(38, 'H4Lys12Esa1/Tip60', b'0', 1, 'Also causes DNA repairation.'),
(39, 'H4Lys12p300', b'0', 1, NULL),
(40, 'H4Lys16ATF2', b'0', 1, 'Can also cause DNA reparation.'),
(41, 'H4Lys16Sas2', b'0', 1, 'Activation caused by turning chromatin structure into euchromatin.'),
(42, 'H1Lys26Ezh2', b'1', 1, 'Transcriptional silencing'),
(43, 'H2AArg3PRMT1\\6', b'0', 1, NULL),
(44, 'H2AArg3PRMT5\\7', b'1', 0.2, NULL),
(45, 'H4Arg2PRMT5/PRMT6', b'1', 0.2, NULL),
(46, 'H3Arg2PRMT5', b'0', 1, NULL),
(47, 'H3Arg8PRMT2/PRMT6', b'1', 0.2, NULL),
(48, 'H3Arg17CARM1', b'0', 0.2, NULL),
(49, 'H3Arg26CARM1', b'0', 0.2, NULL),
(50, 'H3Arg42CARM1', b'0', 0.2, NULL),
(51, 'H3Lys4Set1', b'0', 0.4, 'Activation causes by permissive euchromatin.'),
(52, 'H3Lys4Set7/9', b'0', 0.6, NULL),
(53, 'H3Lys4MLL/ALL-1', b'0', 0.2, NULL),
(54, 'H3Lys4Ash1', b'0', 0.2, NULL),
(55, 'H3Lys9Suv39h/Clr4', b'1', 3, NULL),
(56, 'H3Lys9G9a', b'0', 0.2, 'Is part of genomic imprinting, so only affects one chromosome at one specific location.'),
(57, 'H3Lys9SETDB1', b'1', 0.6, NULL),
(58, 'H3Lys9Dim-5/Kryptonite', b'0', 0.6, NULL),
(59, 'H3Lys9Ash1', b'0', 0, NULL),
(60, 'H3Lys27Ezh2', b'1', 1, 'Used in X inactivation (tri Me).'),
(61, 'H3Lys27G9a', b'1', 1, NULL),
(62, 'H3Lys36Set2', b'0', 0.2, 'Activation via elongation.'),
(63, 'H3Lys79Dot1', b'0', 0.2, 'Euchromatin for activation.'),
(64, 'H4Arg3PRMT1/PRMT6', b'0', 0.2, NULL),
(65, 'H4Arg3PRMT5/PRMT7', b'0', 0.2, NULL),
(66, 'H4Lys20PR-Set7', b'1', 1, NULL),
(67, 'H4Lys20Suv4-20h', b'1', 0.6, NULL),
(68, 'H4Lys20Ash1', b'1', 0.2, NULL),
(69, 'H1Ser27', b'0', 1, 'Decondensation of chromatin.'),
(70, 'H2ASer1MSK1', b'1', 0.2, NULL),
(71, 'H2AThr120Bub1/VprBP', b'1', 0.2, 'Also used for mitosis.'),
(72, 'H2BSer33Taf1', b'0', 1, NULL),
(73, 'H2BSer36AMPK', b'0', 1, NULL),
(74, 'H3Ser10MSK1/MSK2', b'0', 3, NULL),
(75, 'H3Ser10IKK-alpha', b'0', 1, NULL),
(76, 'H3Ser10Snf1', b'0', 1, NULL),
(77, 'H3Ser28MSK1/MSK2', b'0', 3, NULL),
(78, 'H3Tyr41JAK2', b'0', 1, NULL),
(79, 'H2ALys126Ubc9', b'0', 1, NULL),
(80, 'H2BLys123Rad6', b'0', 1, 'Activates via causing euchromatin.'),
(81, 'H2ALys6/Lys7Ubc9', b'1', 1, NULL),
(82, 'H4NterminalTailUbc9', b'1', 1, NULL),
(83, 'H3Lys4biotinidase', b'0', 1, NULL),
(84, 'H3Lys9biotinidase', b'0', 1, NULL),
(85, 'H3Lys18biotinidase', b'0', 1, NULL);

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

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `tid`, `uid`, `message`) VALUES
(33, 20, 11, 'poop'),
(34, 25, 11, 'Even spelling your subject name can be scary!');

-- --------------------------------------------------------

--
-- Table structure for table `nucelosomesequence`
--

CREATE TABLE `nucelosomesequence` (
  `nsid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `did` tinyint(100) UNSIGNED DEFAULT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `notes` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nucelosomesequence`
--

INSERT INTO `nucelosomesequence` (`nsid`, `uid`, `did`, `name`, `notes`) VALUES
(47, 11, 6, 'first poo', 'hiya! lol');

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

--
-- Dumping data for table `nucleosome`
--

INSERT INTO `nucleosome` (`nid`, `ndsid`, `histoneMods`, `nsid`) VALUES
(91, 121, '9,7,', 47),
(90, 120, '1,3,6,', 47),
(89, 119, '2,', 47),
(88, 118, '2,', 47),
(87, 117, '2,', 47),
(92, 122, '2,', 47);

-- --------------------------------------------------------

--
-- Table structure for table `nucleosomednasequence`
--

CREATE TABLE `nucleosomednasequence` (
  `ndsid` tinyint(100) UNSIGNED NOT NULL,
  `DNASequence` varchar(127) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nucleosomednasequence`
--

INSERT INTO `nucleosomednasequence` (`ndsid`, `DNASequence`) VALUES
(121, 'GATGATGGGTAGGGGCCTCCAATACATCCAACACTCTACGCCCTCTCCAAGAGCTAGAAGGGCACCCTGCAGTTGGAAAGGGAACTATTTCGTAAGGCGAGCCCATACCGTCACTCATGCGGAAGAC'),
(120, 'CTGATCGGTACGGTAACGGAGAATCTGTCGGGCTATGTCACTAATACTTTCCAAACGCCCCGTACCGATGCTGAACAAGTCGATGCAGGCTCCCGTCTTTGAAAAGGGGTAAACATACAAGTGGATA'),
(119, 'CCACGTGTTCGTTAACTGTTGATTGGTGGCACATAAGCAATATCGTAGTCCGTCAAATTCAGCTCTGTTATCCCGGGCGTTATGTGTCAAATGGCGTAGAACGGGATTGACTGTTTGACGGTAGCTG'),
(118, 'ACGTCGCGCGCGTAGACCTTTATCTCCGGTTCAAGCTAGGGATGTGGCTGCATGCTACGTTGTCACACCTACACTGCTCGAAGTAAATATGCGAAGCGCGCGGCCTGGCCGGAGGCGTTCCGCGCCG'),
(117, 'TGTCCTCATAGTTTGGGCATGTTTCCCTTGTAGGTGTGAAACCACTTAGCTTCGCGCCGTAGTCCCAATGAAAAACCTATGGACTTTGTTTTGGGTAGCACCAGGAATCTGAACCGTGTGAATGTGG'),
(122, 'A');

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

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`rid`, `mid`, `uid`, `message`) VALUES
(1, 33, 11, 'poop 2');

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
(20, 11, 'Welcome To The Forum', 'Hi guys, here you can introduce yourself to the community. I will start:\r\n\r\n[i]Hey, I am [b]Reiss[/b] and I am an aspiring Biology Studenty![/i]\r\n\r\nYou [b]can[/b] use mark down:\r\n\r\n[l][li]test[/li][/l]'),
(25, 11, 'Hiya!', 'Welcome to BBC Bitesize A Level Geography!');

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
(11, 'Reiss', 'Jones', 'reiss1999@gmail.com', 'iNvyRTQWLnT9Y', 'Student', '51aa5d862c9c17f7e374faf3de1a52e6', 1);

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
  MODIFY `did` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `histonemods`
--
ALTER TABLE `histonemods`
  MODIFY `hmid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `nucelosomesequence`
--
ALTER TABLE `nucelosomesequence`
  MODIFY `nsid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `nucleosome`
--
ALTER TABLE `nucleosome`
  MODIFY `nid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `nucleosomednasequence`
--
ALTER TABLE `nucleosomednasequence`
  MODIFY `ndsid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `rid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `tid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
