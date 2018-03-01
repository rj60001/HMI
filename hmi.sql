-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2018 at 12:52 AM
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
  `did` int(100) UNSIGNED NOT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `notes` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL,
  `uid` int(100) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `disease`
--

INSERT INTO `disease` (`did`, `name`, `notes`, `uid`) VALUES
(13, 'Cancer Risks', NULL, 17),
(14, 'Test Disease', 'serfserfwesef', 21),
(15, 'Test Disease 2', 'bbb', 18),
(16, 'Alzhiemer\\\'s Disease', NULL, 18);

-- --------------------------------------------------------

--
-- Table structure for table `histonemods`
--

CREATE TABLE `histonemods` (
  `hmid` int(100) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE latin1_general_ci NOT NULL,
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
  `mid` int(100) UNSIGNED NOT NULL,
  `tid` int(100) UNSIGNED NOT NULL,
  `uid` int(100) UNSIGNED NOT NULL,
  `message` longtext COLLATE latin1_general_ci NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`mid`, `tid`, `uid`, `message`, `dateTime`) VALUES
(51, 34, 17, 'sgsdrgsdrg', '2018-02-25 20:55:39'),
(52, 34, 17, 'rgdgdrgdrrd', '2018-02-25 20:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `nucelosomesequence`
--

CREATE TABLE `nucelosomesequence` (
  `nsid` int(100) UNSIGNED NOT NULL,
  `uid` int(100) UNSIGNED NOT NULL,
  `did` int(100) UNSIGNED DEFAULT NULL,
  `name` varchar(300) COLLATE latin1_general_ci NOT NULL,
  `notes` varchar(2000) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nucelosomesequence`
--

INSERT INTO `nucelosomesequence` (`nsid`, `uid`, `did`, `name`, `notes`) VALUES
(54, 17, 13, 'Increased Cancer Risk Caused By Increased Proto-oncogene Eexpression', 'This causes an increase in the risk of cancer as the proto-oncogene HRas is activated via transcriptional repressive histone modification H2ASerMSK1.'),
(70, 17, 13, 'Decrease In Cancer Risk Caused By Repressive Mods', 'A decrease in expression of the proto-onco gene HRas decreases cancer risk.'),
(72, 18, 16, 'Histone Modification Increase Alzhiemer\\\'s Risk', 'This sequence increases the expression of beta-amyloid by increasing the affinity of the promoter using histone modifications that encourage acetylation.');

-- --------------------------------------------------------

--
-- Table structure for table `nucleosome`
--

CREATE TABLE `nucleosome` (
  `nid` int(100) UNSIGNED NOT NULL,
  `ndsid` int(100) UNSIGNED NOT NULL,
  `histoneMods` varchar(243) COLLATE latin1_general_ci NOT NULL COMMENT 'Each histoneMod to be separated by a comma.',
  `nsid` int(100) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nucleosome`
--

INSERT INTO `nucleosome` (`nid`, `ndsid`, `histoneMods`, `nsid`) VALUES
(149, 155, '2,1,4,', 54),
(150, 156, '8,', 54),
(151, 157, '9,10,', 54),
(152, 158, ' ', 54),
(153, 159, ' ', 54),
(154, 160, ' ', 54),
(155, 161, ' ', 54),
(156, 162, ' ', 54),
(157, 163, ' ', 54),
(158, 164, ' ', 54),
(159, 165, ' ', 54),
(160, 166, '', 54),
(161, 167, '', 54),
(162, 168, '', 54),
(163, 169, '', 54),
(164, 170, '', 54),
(165, 171, '', 54),
(166, 172, '', 54),
(167, 173, '', 54),
(168, 174, '2,1,', 55),
(169, 175, '13,14,', 55),
(170, 176, '21,24,', 55),
(171, 177, '', 55),
(172, 178, '', 55),
(173, 179, '17,55,', 55),
(174, 180, ' ', 55),
(175, 181, ' ', 55),
(176, 182, '', 55),
(177, 183, '', 55),
(178, 174, '1,2,1,2,', 62),
(179, 175, '4,', 62),
(180, 176, ' ', 62),
(181, 177, ' ', 62),
(182, 178, ' ', 62),
(183, 179, ' ', 62),
(184, 180, '', 62),
(185, 181, '', 62),
(186, 182, '', 62),
(187, 183, '', 62),
(188, 174, '1,2,1,2,', 63),
(189, 175, '4,', 63),
(190, 176, '', 63),
(191, 177, '', 63),
(192, 178, '', 63),
(193, 179, '', 63),
(194, 180, '', 63),
(195, 181, '', 63),
(196, 182, '', 63),
(197, 183, '', 63),
(198, 174, '1,2,1,2,', 64),
(199, 175, '4,', 64),
(200, 176, '_', 64),
(201, 177, '_', 64),
(202, 178, '_', 64),
(203, 179, '_', 64),
(204, 180, '', 64),
(205, 181, '', 64),
(206, 182, '', 64),
(207, 183, '', 64),
(208, 174, '1,2,1,2,', 65),
(209, 175, '4,', 65),
(210, 176, '_', 65),
(211, 177, '_', 65),
(212, 178, '_', 65),
(213, 179, '_', 65),
(214, 180, '', 65),
(215, 181, '', 65),
(216, 182, '', 65),
(217, 183, '', 65),
(218, 174, '1,2,1,2,', 66),
(219, 175, '4,', 66),
(220, 176, ' ', 66),
(221, 177, ' ', 66),
(222, 178, ' ', 66),
(223, 179, ' ', 66),
(224, 180, ' ', 66),
(225, 181, ' ', 66),
(226, 182, ' ', 66),
(227, 183, ' ', 66),
(228, 184, '2,', 67),
(229, 185, '30,29,22,', 67),
(230, 186, '8,13,', 67),
(231, 187, '37,34,', 67),
(232, 188, '1,', 67),
(234, 191, '1,2,', 68),
(235, 155, '56,', 69),
(236, 156, '56,', 69),
(237, 157, '56,', 69),
(238, 158, '56,', 69),
(239, 159, ' ', 69),
(240, 160, ' ', 69),
(241, 161, ' ', 69),
(242, 162, ' ', 69),
(243, 163, ' ', 69),
(244, 164, ' ', 69),
(245, 165, ' ', 69),
(246, 166, ' ', 69),
(247, 167, ' ', 69),
(248, 168, ' ', 69),
(249, 169, ' ', 69),
(250, 170, ' ', 69),
(251, 171, ' ', 69),
(252, 172, ' ', 69),
(253, 173, ' ', 69),
(254, 155, '82,', 70),
(255, 156, '', 70),
(256, 157, '65,', 70),
(257, 158, ' ', 70),
(258, 159, ' ', 70),
(259, 160, ' ', 70),
(260, 161, ' ', 70),
(261, 162, ' ', 70),
(262, 163, ' ', 70),
(263, 164, ' ', 70),
(264, 165, ' ', 70),
(265, 166, ' ', 70),
(266, 167, ' ', 70),
(267, 168, ' ', 70),
(268, 169, ' ', 70),
(269, 170, ' ', 70),
(270, 171, ' ', 70),
(271, 172, ' ', 70),
(272, 173, '82,', 70),
(273, 192, '4,2,', 71),
(274, 193, '6,5,', 71),
(275, 194, '8,3,', 71),
(276, 195, '11,12,', 71),
(277, 196, ' ', 71),
(278, 192, '2,', 72),
(279, 193, '1,', 72),
(280, 194, '3,', 72),
(281, 195, '', 72),
(282, 196, ' ', 72);

-- --------------------------------------------------------

--
-- Table structure for table `nucleosomednasequence`
--

CREATE TABLE `nucleosomednasequence` (
  `ndsid` int(100) UNSIGNED NOT NULL,
  `DNASequence` varchar(127) COLLATE latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `nucleosomednasequence`
--

INSERT INTO `nucleosomednasequence` (`ndsid`, `DNASequence`) VALUES
(183, 'ACGCTACATGTACGAAACCATGTTATGTATGCACTAGGTCAACAATAGGACATAGCCTTGTAGTTAACACGTAGCCCGGTCGTATAAGTACAGTAGACCCTTCGCCGGCATCCTATTTATTAAGTTA'),
(182, 'GCCACACCTTCCATTGTCGTGGCCACGCTCGGATTACACGGCAGAGGTGCTTGTGTTCCGACAGGCTAGCATATTATCCTAAGGCGTTACCCCAATCGTTTACCGTCGGATTTGCTATAGCCCCTGA'),
(181, 'AACACGAGTTCCCAAAACCAGGCGGGCTCGCCACGTCGGCTAATCCTGGTACATTATGTGAACAATGTTCTGAAGAAAATTTGTGAAAGAAGGACGGGTCATCGCCTACTATTAGCAACAACGGTCG'),
(180, 'TCAGGAAGCAGACACTGATTGACACGGTTTAGCAGAACGTTTGAGGACTAGGTCAAATTGAGTGGTTTAATATCGGCATGTCTGGCTTTAAAATTCAGTATAGTGCGCTGATCGGAGACGAATTAAA'),
(179, 'TTCATGTCCAAGCGAAAAGCCGCTCTACGGAATGGATCTACGTTACTGCCTGCATAAGGAGACCGGTGTAGCCAAGGACGAAAGCGACCCTAGGTTCTAACCGTCGACTTTGGCGGAAAGGTTTCAC'),
(178, 'TAGCGTCAGGTAGGCTAGCATGTGTCTTTCCTTCCAGGGGTATGCGGGTGCGTGGACAAATGAGCAGCATACGTATTTACTCGGCGTGCTTGGTCTCTCGTATTTCTCCTGGAGATCAAGGAAATGT'),
(177, 'CTCCGCTTCTAATACCGCACACTGGGCAATACGAGCTCAAGCCAGTCTCGCAGTAACGCTCATCAGCTAACGAAAGAGTTAGAGGCTCGCTAAATCGCACTGTCGGGGTCCCTTGGGTATTTTACAC'),
(176, 'TGTTCGTGTCATCTAGGAGGGGCGCGTAGGATAAATAATTCAATTAAGATATCGTTATGCTAGTATACGCCTACCCGTCACCGGCCAACAGTGTGCAGATGGCGCCACGAGTTACTGGCCCTGATTT'),
(175, 'CGGGAAGGGGTTCGCAAGTCGCACCCTAAACGATGTTGAAGGCTCAGGATGTACACGCACTAGTACAATACATACGTGTTCCGGCTCTTATCCTGCATCGGAAGCTCAATCATGCATCGCACCAGCG'),
(174, 'ACAATCTTCCTGCTCAGTGGTACATGGTTATCGTTATTGCTAGCCAGCCTGATAAGTAACACCACCACTGCGACCCTAATGCGCCCTTTCCACGAACACAGGGCTGTCCGATCCTATATTACGACTC'),
(173, 'GGATCACAGTAAATTATTGGATGGTCTTGAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA'),
(172, 'GCCGAGGTGACTGCAGACCCTCCCAGGGAGGCTGTGCACAGACTGTCTTGAACATCCCAAATGCCACCGGAACCCCAGCCCTTAGCTCCCCTCCCAGGCCTCTGTGGGCCCTTGTCGGGCACAGATG'),
(171, 'CAGCACAAGCTCAGGACATGGAGGTGCCGGATGCAGGAAGGAGGTGCAGACGGAAGGAGGAGGAAGGAAGGACGGAAGCAAGGAAGGAAGGAAGGGCTGCTGGAGCCCAGTCACCCCGGGACCGTGG'),
(170, 'GCGCTGGAGTGGAGGATGCCTTCTACACGTTGGTGCGTGAGATCCGGCAGCACAAGCTGCGGAAGCTGAACCCTCCTGATGAGAGTGGCCCCGGCTGCATGAGCTGCAAGTGTGTGCTCTCCTGACG'),
(169, 'CCCGAAGCTACGGCATCCCCTACATCGAGACCTCGGCCAAGACCCGGCAGGGCAGCCGCTCTGGCTCTAGCTCCAGCTCCGGGACCCTCTGGGACCCCCCGGGACCCATGTGACCCAGCGGCCCCTC'),
(168, 'GACATCCACCAGTACAGGGAGCAGATCAAACGGGTGAAGGACTCGGATGACGTGCCCATGGTGCTGGTGGGGAACAAGTGTGACCTGGCTGCACGCACTGTGGAATCTCGGCAGGCTCAGGACCTCG'),
(167, 'GACGTGCCTGTTGGACATCCTGGATACCGCCGGCCAGGAGGAGTACAGCGCCATGCGGGACCAGTACATGCGCACCGGGGAGGGCTTCCTGTGTGTGTTTGCCATCAACAACACCAAGTCTTTTGAG'),
(166, 'TGGTGGTGGGCGCCGGCGGTGTGGGCAAGAGTGCGCTGACCATCCAGCTGATCCAGAACCATTTTGTGGACGAATACGACCCCACTATAGAGGATTCCTACCGGAAGCAGGTGGTCATTGATGGGGA'),
(165, 'CCCGCCCCGGCCTCGGCCCCGGCCCTGGCCCCGGGGGCAGTCGCGCCTGTGAACGGTGGGGCAGGAGACCCTGTAGGAGGACCCCGGGCCGCAGGCCCCTGAGGAGCGATGACGGAATATAAGCTGG'),
(164, 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAACGAGTCTCCGCCGCCCGTGCCCTGCGCCCGCAACCCGAGCCGCACCCGCCGCGGACGGAGCCCATGCGCGGGGCGAACCGCGCGCCCCCGCCCCCGC'),
(163, 'GCTGTGCACAGACTGTCTTGAACATCCCAAATGCCACCGGAACCCCAGCCCTTAGCTCCCCTCCCAGGCCTCTGTGGGCCCTTGTCGGGCACAGATGGGATCACAGTAAATTATTGGATGGTCTTGA'),
(162, 'ATGCAGGAAGGAGGTGCAGACGGAAGGAGGAGGAAGGAAGGACGGAAGCAAGGAAGGAAGGAAGGGCTGCTGGAGCCCAGTCACCCCGGGACCGTGGGCCGAGGTGACTGCAGACCCTCCCAGGGAG'),
(161, 'TGGTGCGTGAGATCCGGCAGCACAAGCTGCGGAAGCTGAACCCTCCTGATGAGAGTGGCCCCGGCTGCATGAGCTGCAAGTGTGTGCTCTCCTGACGCAGCACAAGCTCAGGACATGGAGGTGCCGG'),
(160, 'CCTCGGCCAAGACCCGGCAGGGCAGCCGCTCTGGCTCTAGCTCCAGCTCCGGGACCCTCTGGGACCCCCCGGGACCCATGTGACCCAGCGGCCCCTCGCGCTGGAGTGGAGGATGCCTTCTACACGT'),
(159, 'CGGGTGAAGGACTCGGATGACGTGCCCATGGTGCTGGTGGGGAACAAGTGTGACCTGGCTGCACGCACTGTGGAATCTCGGCAGGCTCAGGACCTCGCCCGAAGCTACGGCATCCCCTACATCGAGA'),
(158, 'CGGCCAGGAGGAGTACAGCGCCATGCGGGACCAGTACATGCGCACCGGGGAGGGCTTCCTGTGTGTGTTTGCCATCAACAACACCAAGTCTTTTGAGGACATCCACCAGTACAGGGAGCAGATCAAA'),
(157, 'GTGCGCTGACCATCCAGCTGATCCAGAACCATTTTGTGGACGAATACGACCCCACTATAGAGGATTCCTACCGGAAGCAGGTGGTCATTGATGGGGAGACGTGCCTGTTGGACATCCTGGATACCGC'),
(156, 'CCGGGGGCAGTCGCGCCTGTGAACGGTGGGGCAGGAGACCCTGTAGGAGGACCCCGGGCCGCAGGCCCCTGAGGAGCGATGACGGAATATAAGCTGGTGGTGGTGGGCGCCGGCGGTGTGGGCAAGA'),
(155, 'CGAGTCTCCGCCGCCCGTGCCCTGCGCCCGCAACCCGAGCCGCACCCGCCGCGGACGGAGCCCATGCGCGGGGCGAACCGCGCGCCCCCGCCCCCGCCCCGCCCCGGCCTCGGCCCCGGCCCTGGCC'),
(184, 'CCGTCCCCGAGGCGGACACTGATTGACGCGGTTTTGTAGAAGGTTAGGGGAATAGGTTAGATTGAGTGGCTTAAGAATGTAAAATCTGGGATTATAGTGTAGTAATCTCTGATTAACGGTGACGGTT'),
(185, 'TTAAGACAGGTGTTCGCAAAATCAAGCGGGGTCATTTCAACAGATATTGCTGATGGTTTAGGCGTACAATGCCCTGAAGAATAATTAAGAAAAAAGCACCCCTCGTCGCCTAGAATTACCTACCGCG'),
(186, 'GTCCACCATACCTTCGATTATCGCGCCCACTCTCCCATTAGTCGGCAGAGGTGGTTGTGTTGCGATAGCCCAGTATGATATTCTAAGGCGTTACGCTGATGAATATTCTACAGAGTTGCCATAGGCG'),
(187, 'TTGAACGCTACACGGACGATACGAATTTACGTATAGAGCGGGTCATCGAAAGGTTATACTCTCGTAGTTAACATCTAGCCCGGCCCTATCAGTACAGCAGTGCCTTGAATGACATACTCATCATTAA'),
(188, 'ATTTTCTCTACAGCCAAACGACCAAGTGCATTTCCAGGGAGCGCGATGGAGATTCATTCTCTCGCCAGCACTGTAATAGGCACTAAAAGAGTGATGATAATCATGAGTGCCGCGCTAAGGTGGTGTC'),
(189, 'GGAACAAAGCGGTCTTACGGTCAGTCGTATTCCTTCTCGAGTTCCGTCCAGTTGAGCGTGTCACTCCCAGTGTACCTGCAAGCCGAGATGGCTGTGCTTGGAGTCAATCGCATGTAGGATGGTCTCC'),
(190, 'AGACACCGGGGCACCAGTTTTCACGCCTAAAGCATAAACGACGAGCAGTCATGAAAGTCTTAGTACTGGACGTGCCGTTTCACTGCGAATAATACCTGGAGCTGTACCGTTATTGCGCTGCATAGAT'),
(191, 'CGGCTAAGGAAGACGCCTGGTACGGCAGGACTATGAAACCAGTACAAAGGCAACATCCTCACTTGGGTGAACGGAAACGCAGTATTATGGTTACTTTTTGGATACGTGAAACATATCCCATGGTAGT'),
(192, 'TAAACTATCTGGACACTAACTGGACAGTGGACGGTTTGTGTTTAATCCAGGAGAAAGTGGCATGGCAGAAGGTTCATTTCTATAATTCAGGACAGACACAATGAAGAACAAGGGCAGCGTTTGAGGT'),
(193, 'CAGAAGTCCTCATTTACGGGGGTCGAATACGAATGATCTCTCCTAATTTTTCCTTCTTCCCCAACTCAGATGGATGTTACATCCCTGCTTAACAACAAAAAAAGACCCCCCGCCCCGCAAAATCCAC'),
(194, 'ACTGACCACCCCCTTTAACAAAACAAAACCAAAAACAAACAAAAATATAAGAAAGAAACAAAACCCAAGCCCAGAACCCTGCTTTCAAGAAGAAGTAAATGGGTTGGCCGCTTCTTTGCCAGGTCCT'),
(195, 'GCGCCTTGCTCCTTTGGTTCGTTCTAAAGATAGAAATTCCAGGTTGCTCGTGCCTGCTTTTGACGTTGGGGGTTAAAAAATGAGGTTTTGCTGTCTCAACAAGCAAAGAAAATCCTATTTCCTTTAA'),
(196, 'GCTTCACTCGTTCTCATTCTCTTCCAGAAACGCCTGCCCCACCTCTCCAAACCGAGAGAAAAAACGAAATGCGGATAAAAACGCACCCTAGC');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `rid` int(100) UNSIGNED NOT NULL,
  `mid` tinyint(100) UNSIGNED NOT NULL,
  `uid` tinyint(100) UNSIGNED NOT NULL,
  `message` longtext NOT NULL,
  `dateTime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`rid`, `mid`, `uid`, `message`, `dateTime`) VALUES
(1, 51, 17, 'rgdgdgdr', '2018-02-25 20:55:42'),
(2, 51, 17, 'grdgdrg', '2018-02-25 20:55:54');

-- --------------------------------------------------------

--
-- Table structure for table `thread`
--

CREATE TABLE `thread` (
  `tid` int(100) UNSIGNED NOT NULL,
  `uid` int(100) UNSIGNED NOT NULL,
  `subject` varchar(200) COLLATE latin1_general_ci NOT NULL,
  `message` longtext COLLATE latin1_general_ci NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

--
-- Dumping data for table `thread`
--

INSERT INTO `thread` (`tid`, `uid`, `subject`, `message`, `dateTime`) VALUES
(35, 17, 'Test 2', 'ttgdrgr', '2018-02-25 20:54:10'),
(34, 17, 'Test Thread', 'This is a test', '2018-02-11 12:10:35'),
(36, 17, 'test 3', 'test 3', '2018-02-25 20:54:26'),
(37, 17, 'This is a test', 'Hi [b]all[/b] [i]this[/i] is a [l][li]test[/li][/l]', '2018-02-28 13:57:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(100) UNSIGNED NOT NULL,
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
(20, 'Main', 'Admin', 'ma@admin.com', 'iNYLImWikOyyo', 'Company', NULL, 1),
(18, 'John', 'Gurdon', 'jg@example.com', 'iNWVgF3QuI94Y', 'Scientist', NULL, 0),
(17, 'Shinya', 'Yamanaka', 'sy@example.com', 'iNTQi9Exxoi/.', 'Scientist', NULL, 0),
(19, 'Alexander', 'Fleming', 'af@example.com', 'iNXFRtFDMI3.k', 'Curious', NULL, 0),
(21, 'Reiss', 'Jones', 'reiss1999@gmail.com', 'iNvyRTQWLnT9Y', 'Scientist', NULL, 0);

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
  MODIFY `did` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `histonemods`
--
ALTER TABLE `histonemods`
  MODIFY `hmid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `mid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `nucelosomesequence`
--
ALTER TABLE `nucelosomesequence`
  MODIFY `nsid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `nucleosome`
--
ALTER TABLE `nucleosome`
  MODIFY `nid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=283;

--
-- AUTO_INCREMENT for table `nucleosomednasequence`
--
ALTER TABLE `nucleosomednasequence`
  MODIFY `ndsid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=197;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `rid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `thread`
--
ALTER TABLE `thread`
  MODIFY `tid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
