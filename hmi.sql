-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 30, 2018 at 08:30 PM
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
  `name` varchar(500) COLLATE latin1_general_ci NOT NULL,
  `notes` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`did`, `name`, `notes`, `uid`) VALUES
(6, 'Alzheimers', 'M', 11),
(10, 'Cancer Risks', 'A group of sequences that influence the chances of getting cancer.', 11);

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
(43, 'H2AArg3PRMT1/6', b'0', 1, NULL),
(44, 'H2AArg3PRMT5/7', b'1', 0.2, NULL),
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
  `message` longtext COLLATE latin1_general_ci NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
(49, 11, 10, 'HRas Repression by H2ASerMSK1', 'This causes a decrease in the risk of cancer as the proto-oncogene HRas is repressed by attracted kinase proteins via transcriptional repressive histone modification H2ASerMSK1.'),
(48, 11, 6, 'Increased Expression of the APP (Beta-Amyloid Precursor Protein) Gene Via Increased Promoter Affinity', 'This sequence increases the expression of beta-amyloid by increasing the affinity of the promoter using histone modifications that encourage acetylation.'),
(51, 11, 10, 'Increased Cancer Risk Caused By H2ALys4Esa1 Activation Histone Modifications', 'The H2ALys4Esa1 histone modification causes a increase in gene expression. This can cause for an increase in cancer risk as the chance of a cell becoming cancerous increases when these modifications are applied to a proto-oncogene.');

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
(92, 122, 'TRUE3,', 47),
(93, 123, '2,2,2,', 47),
(94, 122, '1,1,1,', 47),
(95, 1, '1', 47),
(96, 122, '1,1,1,', 47),
(97, 125, '1,', 48),
(98, 126, '1,', 48),
(99, 127, '1,', 48),
(100, 128, '1,', 48),
(101, 129, '1,', 48),
(106, 133, '70,', 49),
(107, 134, '70,', 49),
(108, 135, '70,', 49),
(109, 136, ' ', 49),
(110, 137, ' ', 49),
(111, 138, ' ', 49),
(112, 139, ' ', 49),
(113, 140, '', 49),
(114, 141, '', 49),
(115, 142, '', 49),
(116, 133, '70,', 49),
(117, 134, '70,', 49),
(118, 135, '70,', 49),
(119, 136, ' ', 49),
(120, 137, ' ', 49),
(121, 138, ' ', 49),
(122, 139, ' ', 49),
(123, 140, '', 49),
(124, 141, '', 49),
(125, 142, '', 49),
(127, 133, '1,', 51),
(128, 134, '1,', 51),
(129, 135, '1,', 51),
(130, 136, '1,', 51),
(131, 137, '1,', 51),
(132, 138, '1,', 51),
(133, 139, '1,', 51),
(134, 140, '1,', 51),
(135, 141, '1,', 51),
(136, 143, '1,', 51),
(137, 144, ' ', 51),
(138, 145, ' ', 51),
(139, 146, ' ', 51),
(140, 147, ' ', 51),
(141, 148, ' ', 51),
(142, 149, '', 51),
(143, 150, '', 51),
(144, 151, '', 51),
(145, 152, '', 51),
(147, 153, '2,2,2,8,8,15,28,39,39,85,', 52),
(148, 154, '', 53);

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
(122, 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'),
(123, 'ttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttttt'),
(124, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(125, 'TAAACTATCTGGACACTAACTGGACAGTGGACGGTTTGTGTTTAATCCAGGAGAAAGTGGCATGGCAGAAGGTTCATTTCTATAATTCAGGACAGACACAATGAAGAACAAGGGCAGCGTTTGAGGT'),
(126, 'CAGAAGTCCTCATTTACGGGGGTCGAATACGAATGATCTCTCCTAATTTTTCCTTCTTCCCCAACTCAGATGGATGTTACATCCCTGCTTAACAACAAAAAAAGACCCCCCGCCCCGCAAAATCCAC'),
(127, 'ACTGACCACCCCCTTTAACAAAACAAAACCAAAAACAAACAAAAATATAAGAAAGAAACAAAACCCAAGCCCAGAACCCTGCTTTCAAGAAGAAGTAAATGGGTTGGCCGCTTCTTTGCCAGGTCCT'),
(128, 'GCGCCTTGCTCCTTTGGTTCGTTCTAAAGATAGAAATTCCAGGTTGCTCGTGCCTGCTTTTGACGTTGGGGGTTAAAAAATGAGGTTTTGCTGTCTCAACAAGCAAAGAAAATCCTATTTCCTTTAA'),
(129, 'GCTTCACTCGTTCTCATTCTCTTCCAGAAACGCCTGCCCCACCTCTCCAAACCGAGAGAAAAAACGAAATGCGGATAAAAACGCACCCTAGC'),
(130, 'TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT'),
(131, 'A'),
(132, 'T'),
(133, 'CGAGTCTCCGCCGCCCGTGCCCTGCGCCCGCAACCCGAGCCGCACCCGCCGCGGACGGAGCCCATGCGCGGGGCGAACCGCGCGCCCCCGCCCCCGCCCCGCCCCGGCCTCGGCCCCGGCCCTGGCC'),
(134, 'CCGGGGGCAGTCGCGCCTGTGAACGGTGGGGCAGGAGACCCTGTAGGAGGACCCCGGGCCGCAGGCCCCTGAGGAGCGATGACGGAATATAAGCTGGTGGTGGTGGGCGCCGGCGGTGTGGGCAAGA'),
(135, 'GTGCGCTGACCATCCAGCTGATCCAGAACCATTTTGTGGACGAATACGACCCCACTATAGAGGATTCCTACCGGAAGCAGGTGGTCATTGATGGGGAGACGTGCCTGTTGGACATCCTGGATACCGC'),
(136, 'CGGCCAGGAGGAGTACAGCGCCATGCGGGACCAGTACATGCGCACCGGGGAGGGCTTCCTGTGTGTGTTTGCCATCAACAACACCAAGTCTTTTGAGGACATCCACCAGTACAGGGAGCAGATCAAA'),
(137, 'CGGGTGAAGGACTCGGATGACGTGCCCATGGTGCTGGTGGGGAACAAGTGTGACCTGGCTGCACGCACTGTGGAATCTCGGCAGGCTCAGGACCTCGCCCGAAGCTACGGCATCCCCTACATCGAGA'),
(138, 'CCTCGGCCAAGACCCGGCAGGGCAGCCGCTCTGGCTCTAGCTCCAGCTCCGGGACCCTCTGGGACCCCCCGGGACCCATGTGACCCAGCGGCCCCTCGCGCTGGAGTGGAGGATGCCTTCTACACGT'),
(139, 'TGGTGCGTGAGATCCGGCAGCACAAGCTGCGGAAGCTGAACCCTCCTGATGAGAGTGGCCCCGGCTGCATGAGCTGCAAGTGTGTGCTCTCCTGACGCAGCACAAGCTCAGGACATGGAGGTGCCGG'),
(140, 'ATGCAGGAAGGAGGTGCAGACGGAAGGAGGAGGAAGGAAGGACGGAAGCAAGGAAGGAAGGAAGGGCTGCTGGAGCCCAGTCACCCCGGGACCGTGGGCCGAGGTGACTGCAGACCCTCCCAGGGAG'),
(141, 'GCTGTGCACAGACTGTCTTGAACATCCCAAATGCCACCGGAACCCCAGCCCTTAGCTCCCCTCCCAGGCCTCTGTGGGCCCTTGTCGGGCACAGATGGGATCACAGTAAATTATTGGATGGTCTTGA'),
(142, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(143, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAACGAGTCTCCGCCGCCCGTGCCCTGCGCCCGCAACCCGAGCCGCACCCGCCGCGGACGGAGCCCATGCGCGGGGCGAACCGCGCGCCCCCGCCCCCGC'),
(144, 'CCCGCCCCGGCCTCGGCCCCGGCCCTGGCCCCGGGGGCAGTCGCGCCTGTGAACGGTGGGGCAGGAGACCCTGTAGGAGGACCCCGGGCCGCAGGCCCCTGAGGAGCGATGACGGAATATAAGCTGG'),
(145, 'TGGTGGTGGGCGCCGGCGGTGTGGGCAAGAGTGCGCTGACCATCCAGCTGATCCAGAACCATTTTGTGGACGAATACGACCCCACTATAGAGGATTCCTACCGGAAGCAGGTGGTCATTGATGGGGA'),
(146, 'GACGTGCCTGTTGGACATCCTGGATACCGCCGGCCAGGAGGAGTACAGCGCCATGCGGGACCAGTACATGCGCACCGGGGAGGGCTTCCTGTGTGTGTTTGCCATCAACAACACCAAGTCTTTTGAG'),
(147, 'GACATCCACCAGTACAGGGAGCAGATCAAACGGGTGAAGGACTCGGATGACGTGCCCATGGTGCTGGTGGGGAACAAGTGTGACCTGGCTGCACGCACTGTGGAATCTCGGCAGGCTCAGGACCTCG'),
(148, 'CCCGAAGCTACGGCATCCCCTACATCGAGACCTCGGCCAAGACCCGGCAGGGCAGCCGCTCTGGCTCTAGCTCCAGCTCCGGGACCCTCTGGGACCCCCCGGGACCCATGTGACCCAGCGGCCCCTC'),
(149, 'GCGCTGGAGTGGAGGATGCCTTCTACACGTTGGTGCGTGAGATCCGGCAGCACAAGCTGCGGAAGCTGAACCCTCCTGATGAGAGTGGCCCCGGCTGCATGAGCTGCAAGTGTGTGCTCTCCTGACG'),
(150, 'CAGCACAAGCTCAGGACATGGAGGTGCCGGATGCAGGAAGGAGGTGCAGACGGAAGGAGGAGGAAGGAAGGACGGAAGCAAGGAAGGAAGGAAGGGCTGCTGGAGCCCAGTCACCCCGGGACCGTGG'),
(151, 'GCCGAGGTGACTGCAGACCCTCCCAGGGAGGCTGTGCACAGACTGTCTTGAACATCCCAAATGCCACCGGAACCCCAGCCCTTAGCTCCCCTCCCAGGCCTCTGTGGGCCCTTGTCGGGCACAGATG'),
(152, 'GGATCACAGTAAATTATTGGATGGTCTTGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(153, 'AGCTTGACTTGGGAAAAAAAAAAAAAGT'),
(154, 'AAAAAAAAAAAA');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `rid` tinyint(100) UNSIGNED NOT NULL,
  `mid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `message` longtext NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `tid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `subject` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `message` longtext COLLATE latin1_general_ci NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

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
(11, 'Reiss', 'Jones', 'reiss1999@gmail.com', 'iNvyRTQWLnT9Y', 'Student', NULL, 1),
(15, 'Testing', 'testuser', 'testuser@example.com', 'iNb94HCC8oFx.', 'Company', NULL, 0);

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
  MODIFY `did` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `histonemods`
--
ALTER TABLE `histonemods`
  MODIFY `hmid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `nucelosomesequence`
--
ALTER TABLE `nucelosomesequence`
  MODIFY `nsid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `nucleosome`
--
ALTER TABLE `nucleosome`
  MODIFY `nid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=149;

--
-- AUTO_INCREMENT for table `nucleosomednasequence`
--
ALTER TABLE `nucleosomednasequence`
  MODIFY `ndsid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `rid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `tid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` tinyint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
