-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2015 at 06:27 AM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `php_projects_reporting_system`
--
CREATE DATABASE IF NOT EXISTS `php_projects_reporting_system` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projects`;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
`client_id` int(11) NOT NULL,
  `client_organization` varchar(200) NOT NULL,
  `organization_type` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `date_added` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`client_id`, `client_organization`, `organization_type`, `address`, `telephone`, `email`, `date_added`) VALUES
(2, 'Afghan United Bank', 'Bank', 'Shahr-e-Naw', '078819283938', 'aub@afghanunitedbank.com', 1441709956),
(3, 'AUB', 'Bank', 'Shahr-e-Naw', '07892910293', 'aub@afghanunitedbank.com', 1441710046),
(4, 'AUB', 'Bank', 'Shahr-e-Naw', '07892910293', 'aub@afghanunitedbank.com', 1441710070);

-- --------------------------------------------------------

--
-- Table structure for table `contact_person`
--

DROP TABLE IF EXISTS `contact_person`;
CREATE TABLE IF NOT EXISTS `contact_person` (
`contact_person_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `email` varchar(200) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `viber` varchar(100) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date_added` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact_person`
--

INSERT INTO `contact_person` (`contact_person_id`, `name`, `phone`, `email`, `skype`, `viber`, `vendor_id`, `date_added`) VALUES
(3, 'Naim', '0788102939', 'mnaimfaizy@yahoo.com', 'mnaimfaizy', '0788103809', 2, 1441868401),
(4, 'Naim', '0788102939', 'test@example.com', 'test.test.com', '0788103809', 3, 1441870588);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

DROP TABLE IF EXISTS `district`;
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(100) NOT NULL,
  `province_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `district_name`, `province_id`) VALUES
(1, 'Paghman', 1),
(2, 'Chahar Asyab', 1),
(3, 'Musayi', 1),
(4, 'Kabul', 1),
(5, 'Bagrami', 1),
(6, 'Khak-e- Jabbar', 1),
(7, 'Deh Sabz', 1),
(8, 'Kalakan', 1),
(9, 'Mir Bacha Kot', 1),
(10, 'Shakardara', 1),
(11, 'Guldara', 1),
(12, 'Farza', 1),
(13, 'Estalef', 1),
(14, 'Qarabagh', 1),
(15, 'Surobi', 1),
(16, 'Hesa Awal-e- Kohestan', 2),
(17, 'Hisa Duwum-e- Kohestan', 2),
(18, 'Mahmud-e- Raqi', 2),
(19, 'Koh Band', 2),
(20, 'Nejrab', 2),
(21, 'Tagab', 2),
(22, 'Alasay', 2),
(23, 'Surkhe Parsa', 3),
(24, 'Chaharikar', 3),
(25, 'Koh-e- Safi', 3),
(26, 'Bagram', 3),
(27, 'Sayd Khel', 3),
(28, 'Jabalussaraj', 3),
(29, 'Salang', 3),
(30, 'Shinwari', 3),
(31, 'Syah Gerd', 3),
(32, 'Shekh  Ali', 3),
(33, 'Nerkh', 4),
(34, 'Maydan Shahr', 4),
(35, 'Jalrez', 4),
(36, 'Saydabad', 4),
(37, 'Jaghatu', 4),
(38, 'Chak', 4),
(39, 'Day Mirdad', 4),
(40, 'Hesa Awal-e- Behsud', 4),
(41, 'Markaz-e-Behsud', 4),
(42, 'Kharwar', 5),
(43, 'Azra', 5),
(44, 'Khoshi', 5),
(45, 'Charkh', 5),
(46, 'Baraki Barak', 5),
(47, 'Pul-e- Alam', 5),
(48, 'Mohammad Agha', 5),
(49, 'Hesarak', 6),
(50, 'Sherzad', 6),
(51, 'Khowgiani', 6),
(52, 'Deh Bala', 6),
(53, 'Chaparhar', 6),
(54, 'Surkh Rod', 6),
(55, 'Jalalabad', 6),
(56, 'Achin', 6),
(57, 'Kot', 6),
(58, 'Nazian', 6),
(59, 'Shinwar', 6),
(60, 'Rodat', 6),
(61, 'Dur Baba', 6),
(62, 'Muhmand Dara', 6),
(63, 'Lal Pur', 6),
(64, 'Goshta', 6),
(65, 'Behsud', 6),
(66, 'Kama', 6),
(67, 'Kuz Kunar', 6),
(68, 'Dara-e-Nur', 6),
(69, 'Pachier Agam', 6),
(70, 'Bati Kot', 6),
(71, 'Daulat Shah', 7),
(72, 'Alishang', 7),
(73, 'Qarghayi', 7),
(74, 'Mehtarlam', 7),
(75, 'Alingar', 7),
(76, 'Onaba(Anawa', 8),
(77, 'Rukha', 8),
(78, 'Dara', 8),
(79, 'Bazarak', 8),
(80, 'Shutul', 8),
(81, 'Parian', 8),
(82, 'Khenj (Hes-e- Awal', 8),
(83, 'Baghlan-e-jadid', 9),
(84, 'Burka', 9),
(85, 'Dahana-e-Ghory', 9),
(86, 'Pul-e- khumri', 9),
(87, 'Dushi', 9),
(88, 'Nahrin', 9),
(89, 'Khwaja Hejran', 9),
(90, 'Andarab', 9),
(91, 'Khenjan', 9),
(92, 'Tala wa barfak', 9),
(93, 'Guzargah-e- Nur', 9),
(94, 'Firing Wa Gharu', 9),
(95, 'Deh Salah', 9),
(96, 'Khowst wa Fereng', 9),
(97, 'Pul-e-Hesar', 9),
(98, 'Waras', 10),
(99, 'Panjab', 10),
(100, 'Bamyan', 10),
(101, 'Sayghan', 10),
(102, 'Shibar', 10),
(103, 'Kahmard', 10),
(104, 'Yakawlang', 10),
(105, 'Ajrestan', 11),
(106, 'Malestan', 11),
(107, 'Gelan', 11),
(108, 'Muqur', 11),
(109, 'Jaghuri', 11),
(110, 'Ab Band', 11),
(111, 'Giro', 11),
(112, 'Qarabagh', 11),
(113, 'Andar', 11),
(114, 'Waghaz', 11),
(115, 'Wali Muhammad-e- Shahid', 11),
(116, 'Jaghatu', 11),
(117, 'Rashidan', 11),
(118, 'Deh Yak', 11),
(119, 'Ghazni', 11),
(120, 'Zana Khan', 11),
(121, 'Khwaja Umari', 11),
(122, 'Nawur', 11),
(123, 'Nawa', 11),
(124, 'Dand wa Patan', 12),
(125, 'Chamkani', 12),
(126, 'Jani Khel', 12),
(127, 'Ali Khel (Jaji', 12),
(128, 'Lija Ahmad Khel', 12),
(129, 'Ahmadaba', 12),
(130, 'Sayed Karam', 12),
(131, 'Zadran', 12),
(132, 'Shawak', 12),
(133, 'Zurmat', 12),
(134, 'Gardez', 12),
(135, 'Nurgal', 13),
(136, 'Khas Kunar', 13),
(137, 'Sarkani', 13),
(138, 'Chawkay', 13),
(139, 'Narang', 13),
(140, 'Marawara', 13),
(141, 'Chapa Dara', 13),
(142, 'Asad Abad', 13),
(143, 'Dara-e-Pech', 13),
(144, 'Wata Pur', 13),
(145, 'Shigal wa shel tan', 13),
(146, 'Dangam', 13),
(147, 'Nari', 13),
(148, 'Bar Kunar', 13),
(149, 'Ghazi Abad', 13),
(150, 'Du Ab', 14),
(151, 'Wama', 14),
(152, 'Nurgaram', 14),
(153, 'Waygal', 14),
(154, 'Kamdesh', 14),
(155, 'Barg-e- Matal', 14),
(156, 'Poruns', 14),
(157, 'Mandol', 14),
(158, 'Shahr-e-Buzorg', 15),
(159, 'Yawan', 15),
(160, 'Raghistan', 15),
(161, 'Khwahan', 15),
(162, 'Kof Ab', 15),
(163, 'Yaftal-e-Sufla', 15),
(164, 'Kohistan', 15),
(165, 'Shaki', 15),
(166, 'Darwaz', 15),
(167, 'Darwaz-e-Balla', 15),
(168, 'Shighnan', 15),
(169, 'Arghanj Khwa', 15),
(170, 'Faiz Abad', 15),
(171, 'Shuhada', 15),
(172, 'Khash', 15),
(173, 'Argo', 15),
(174, 'Darayem', 15),
(175, 'Teshkan', 15),
(176, 'Baharak', 15),
(177, 'Warduj', 15),
(178, 'Jorm', 15),
(179, 'Zebak', 15),
(180, 'Ishkashem', 15),
(181, 'Wakhan', 15),
(182, 'Koran wa Monjan', 15),
(183, 'Yamgan', 15),
(184, 'Keshem', 15),
(185, 'Tagab', 15),
(186, 'Ishkamish', 16),
(187, 'Chal', 16),
(188, 'Namak Ab', 16),
(189, 'Farkhar', 16),
(190, 'Bangi', 16),
(191, 'Baharak', 16),
(192, 'Hazar Sumuch', 16),
(193, 'Taloqan', 16),
(194, 'Kalafgan', 16),
(195, 'Rostaq', 16),
(196, 'Dasht-e-Qala', 16),
(197, 'Khwaja Bahawuddin', 16),
(198, 'Darqad', 16),
(199, 'Yangi Qala', 16),
(200, 'Chah Ab', 16),
(201, 'Khwaja Ghar', 16),
(202, 'Warsaj', 16),
(203, 'Qala-e-Zal', 17),
(204, 'Chahar Darah', 17),
(205, 'Imam Saheb', 17),
(206, 'Dasht-e-Archi', 17),
(207, 'Kunduz', 17),
(208, 'Ali Abad', 17),
(209, 'Khan Abad', 17),
(210, 'Shor Tepa', 18),
(211, 'Sharak-e-Hayratan', 18),
(212, 'Kaldar', 18),
(213, 'Dawlat Abad', 18),
(214, 'Khulm', 18),
(215, 'Marmul', 18),
(216, 'Chahar Kent', 18),
(217, 'Deh Dadi', 18),
(218, 'Balkh', 18),
(219, 'Chahar Bolak', 18),
(220, 'Chemtal', 18),
(221, 'Sholgareh', 18),
(222, 'Kishindeh', 18),
(223, 'Zari', 18),
(224, 'Mazar-e-Sharif', 18),
(225, 'Nahr-e- Shahi', 18),
(226, 'Feroz Nakhchir', 19),
(227, 'Darah Suf-e-Bala', 19),
(228, 'Ruy-e-Du Ab', 19),
(229, 'Khuram wa Sarbagh', 19),
(230, 'Hazrat-e- Sultan', 19),
(231, 'Darah Suf-e- Payin', 19),
(232, 'Aybak', 19),
(233, 'Sar-e-Pul', 20),
(234, 'Sayad', 20),
(235, 'Sozma Qala', 20),
(236, 'Gosfandi', 20),
(237, 'Sang(SanCharak', 20),
(238, 'Balkh Ab', 20),
(239, 'Kohistanat', 20),
(240, 'Lal Wa Sarjangal', 21),
(241, 'Saghar', 21),
(242, 'Taywarah', 21),
(243, 'Tolak', 21),
(244, 'Shahrak', 21),
(245, 'Du Lina', 21),
(246, 'Chahar Sadra', 21),
(247, 'Chaghcharan', 21),
(248, 'Dawlat Yar', 21),
(249, 'Pasaband', 21),
(250, 'Gizab', 22),
(251, 'Nili', 22),
(252, 'Miramor', 22),
(253, 'Shahristan', 22),
(254, 'Ashtarlay', 22),
(255, 'Sang-e-Takht', 22),
(256, 'Khadir', 22),
(257, 'kiti', 22),
(258, 'Kajran', 22),
(259, 'Dehrawud', 23),
(260, 'Shahid-e-Hassas', 23),
(261, 'Tirin Kot', 23),
(262, 'Chora', 23),
(263, 'Khas Uruzgan', 23),
(264, 'Tarnak Wa Jaldak', 24),
(265, 'Mizan', 24),
(266, 'Atghar', 24),
(267, 'Day chopan', 24),
(268, 'Arghandab', 24),
(269, 'Qalat', 24),
(270, 'Kakar', 24),
(271, 'Shah Joy', 24),
(272, 'Shinkay', 24),
(273, 'Naw Bahar', 24),
(274, 'Shomulzay', 24),
(275, 'Turwo (Tarwe', 25),
(276, 'Wor Mamay', 25),
(277, 'Waza Khah', 25),
(278, 'Dila', 25),
(279, 'Zarghun Shahr', 25),
(280, 'Jani Khel', 25),
(281, 'Yahya Khel', 25),
(282, 'Omna', 25),
(283, 'Bermel (Burmul', 25),
(284, 'Gian', 25),
(285, 'Urgun', 25),
(286, 'Ziruk', 25),
(287, 'Nika', 25),
(288, 'Sar Hawzeh(Rawzeh', 25),
(289, 'Yosuf Khel', 25),
(290, 'Sharan', 25),
(291, 'Mata Khan', 25),
(292, 'Gomal', 25),
(293, 'Sarobi', 25),
(294, 'Mando Zayi', 26),
(295, 'Spera', 26),
(296, 'Tani', 26),
(297, 'Shamal (Shamul', 26),
(298, 'Gurbuz', 26),
(299, 'Khost(Matun', 26),
(300, 'Nadir Shah Kot', 26),
(301, 'Bak', 26),
(302, 'Jaji Maydan', 26),
(303, 'Sabri', 26),
(304, 'Musa Khel', 26),
(305, 'Qalandar', 26),
(306, 'Tere Zayi', 26),
(307, 'Darz Ab', 27),
(308, 'Qush Tepa', 27),
(309, 'Shiberghan', 27),
(310, 'Khwaja Du Koh', 27),
(311, 'Khanaqa', 27),
(312, 'Fayz Abad', 27),
(313, 'Mardyan', 27),
(314, 'Aqcha', 27),
(315, 'Mingajik', 27),
(316, 'Qarqin', 27),
(317, 'Khamyab', 27),
(318, 'Almar', 28),
(319, 'Kohistan', 28),
(320, 'Garziwan', 28),
(321, 'Bil Cheragh', 28),
(322, 'Pashtun kot', 28),
(323, 'Maymana', 28),
(324, 'Khwaja Sabzposh', 28),
(325, 'Shirin Tagab', 28),
(326, 'Dawlat Abad', 28),
(327, 'Qaram Qol', 28),
(328, 'Qorghan', 28),
(329, 'Khan-e-Chahar Bagh', 28),
(330, 'Andkhoy', 28),
(331, 'Qaysar', 28),
(332, 'Muqur', 29),
(333, 'Ab Kamari', 29),
(334, 'Qadis', 29),
(335, 'Jawand', 29),
(336, 'Bala Murghab', 29),
(337, 'Ghormach', 29),
(338, 'Qala-e-Naw', 29),
(339, 'Gulran', 30),
(340, 'Kohsan', 30),
(341, 'Kushk', 30),
(342, 'Kushk-e-Kohna', 30),
(343, 'Ghoryan', 30),
(344, 'Zinda Jan', 30),
(345, 'Adraskan', 30),
(346, 'Pashtun  Zarghun', 30),
(347, 'Farsi', 30),
(348, 'Obe', 30),
(349, 'Chisht-e-Sharif', 30),
(350, 'Karukh', 30),
(351, 'Hirat', 30),
(352, 'Injil', 30),
(353, 'Guzara', 30),
(354, 'Shindand', 30),
(355, 'Qala-e-Kah', 31),
(356, 'Pusht Rod', 31),
(357, 'Shib Koh', 31),
(358, 'Farah', 31),
(359, 'Bakwa', 31),
(360, 'Lash-e-Juwayn', 31),
(361, 'Bala Buluk', 31),
(362, 'Gulestan', 31),
(363, 'Khak-e-Safed', 31),
(364, 'Anar Dara', 31),
(365, 'Pur Chaman', 31),
(366, 'Deh shu', 32),
(367, 'Reg(khan Neshin', 32),
(368, 'Garm Ser', 32),
(369, 'Nad-e-Ali', 32),
(370, 'Nawa-e-Barak Zaiy', 32),
(371, 'Lashkar Gah', 32),
(372, 'Wa Sher', 32),
(373, 'Nahr-e-Saraj', 32),
(374, 'Naw Zad', 32),
(375, 'Musa Qaleh', 32),
(376, 'Sangin', 32),
(377, 'Kajaki', 32),
(378, 'Baghran', 32),
(379, 'Reg', 33),
(380, 'Spin Boldak', 33),
(381, 'Panj wayi', 33),
(382, 'Maywand', 33),
(383, 'Kandahar', 33),
(384, 'Zheray', 33),
(385, 'Arghistan', 33),
(386, 'Maruf', 33),
(387, 'Ghorak', 33),
(388, 'Khakrez', 33),
(389, 'Arghandab', 33),
(390, 'Daman', 33),
(391, 'Nesh', 33),
(392, 'Shah Wali Kot', 33),
(393, 'Miyanshin', 33),
(394, 'Shor Abak', 33),
(395, 'Kang', 34),
(396, 'Zaranj', 34),
(397, 'Khash Rod', 34),
(398, 'Chakhansur', 34),
(399, 'Chahar Burjak', 34);

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `user_id` int(11) NOT NULL,
  `time` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_attempts`
--

INSERT INTO `login_attempts` (`user_id`, `time`) VALUES
(1, '1433438351'),
(2, '1433444551'),
(4, '1434001792'),
(1, '1440389964'),
(1, '1441640120'),
(1, '1441860942');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
`id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` char(128) NOT NULL,
  `salt` char(128) NOT NULL,
  `member_group` varchar(30) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `salt`, `member_group`) VALUES
(1, 'admin', 'mnaimfaizy@yahoo.com', 'c5c273fca2418f1107c2e3c8a1f4d1fe0f27f16ead44e362e6a0bd68c1a43375961d2be924fd9c20a72d2344bce798cd490024506b6f53762acd0d8d25e3b8f4', 'a14249e41d8916416f53d5931fe1a0d1348e6074c2f7c4aa8d897d15a79ff092bb45d08c663171cebaf2f6b890327d923386b9f0aa32504bb3817ed0cf763277', 'Manager'),
(2, 'mnaimfaizy', 'mnaim.faizy@gmail.com', '9830176aad18c9c34a5c4081bccf136bfe4e1cf0197a3b30debb7ca3a7aba9814144af1098ab1affc10186c23a5fcc97071c77dc9c2b42e0fadc05e23c23d462', 'eaf5e981295659bb318a52afb23ab49d8e4460ab3d25310ddaad00f49ec3a1099a393a7ad189e8ca44d6b9c017be8bf0f315be0eb60ad112cc1b15854671d2b6', 'Manager'),
(3, 'Ahmad', 'ahmad@yahoo.com', 'cfae3a490023682bdc02aa997084fe464d4c71fa69caa3682d5749dba3d04c51ed40ea60c4a57d097628a3b9844b9cecb82c0fe50bbcdada835520a8e0522031', 'bbf76f76ffe87de5118cbbc4e22cf49c87b84e5382408fcad6a3f5caf6573ad8420b1cdfa3972a4947de357cbbb77658aae047b9144755b0ba593eb4f72e6f0c', 'Manager'),
(4, 'root', 'test@test.com', '1d65e97145b95f7922bab7b3bae1c980b0a3b810847ad34816e271470f494ffb9dfcb2c4db0d745b5f49ec51e6152265a4f46fd6ee848d8b74c6dc72b23d91a3', '5f12af5c69677bc16f7db08df2e0bbdbf1cd58eb764df58a4b69c3494b74d837a7ae9d4a5845957ab8beab48f3447311fb0e6926e2e3d4f0263eebc664437448', 'Administrator');

-- --------------------------------------------------------

--
-- Table structure for table `phpjobscheduler`
--

DROP TABLE IF EXISTS `phpjobscheduler`;
CREATE TABLE IF NOT EXISTS `phpjobscheduler` (
`id` int(11) NOT NULL,
  `scriptpath` varchar(255) DEFAULT NULL,
  `name` varchar(128) DEFAULT NULL,
  `time_interval` int(11) DEFAULT NULL,
  `fire_time` int(11) NOT NULL DEFAULT '0',
  `time_last_fired` int(11) DEFAULT NULL,
  `run_only_once` tinyint(1) NOT NULL DEFAULT '0',
  `currently_running` tinyint(1) NOT NULL DEFAULT '0',
  `paused` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpjobscheduler`
--

INSERT INTO `phpjobscheduler` (`id`, `scriptpath`, `name`, `time_interval`, `fire_time`, `time_last_fired`, `run_only_once`, `currently_running`, `paused`) VALUES
(1, 'http://localhost/projects/ajax/check_renewal.php', 'Email renewal projects info to boss', 86400, 1442311140, 1442224740, 0, 0, 0),
(2, 'http://localhost/projects/phpmysqlautobackup/run.php', 'Backup projects database', 86400, 1442311312, 1442224912, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `phpjobscheduler_logs`
--

DROP TABLE IF EXISTS `phpjobscheduler_logs`;
CREATE TABLE IF NOT EXISTS `phpjobscheduler_logs` (
`id` int(11) NOT NULL,
  `date_added` int(11) DEFAULT NULL,
  `script` varchar(128) DEFAULT NULL,
  `output` text,
  `execution_time` varchar(60) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpjobscheduler_logs`
--

INSERT INTO `phpjobscheduler_logs` (`id`, `date_added`, `script`, `output`, `execution_time`) VALUES
(1, 1442138708, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.15801 seconds via PHP CURL '),
(2, 1442139938, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.01300 seconds via PHP CURL '),
(3, 1442139996, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.01700 seconds via PHP CURL '),
(4, 1442140040, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.01700 seconds via PHP CURL '),
(5, 1442140044, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.12501 seconds via PHP CURL '),
(6, 1442140047, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.03400 seconds via PHP CURL '),
(7, 1442140051, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.02700 seconds via PHP CURL '),
(8, 1442140164, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.01300 seconds via PHP CURL '),
(9, 1442140166, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.03600 seconds via PHP CURL '),
(10, 1442140599, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.03600 seconds via PHP CURL '),
(11, 1442140664, 'http://localhost/projects/ajax/check_renewal.php', '\r\nEmail Sent Successfully - Email Sent Successfully - ', '0.02300 seconds via PHP CURL '),
(12, 1442141559, 'http://localhost/projects/ajax/check_renewal.php', '\r\n', '0.26702 seconds via PHP CURL '),
(13, 1444019242, 'http://localhost/projects/ajax/check_renewal.php', '\r\n', '3.39719 seconds via PHP CURL '),
(14, 1444019254, 'http://localhost/projects/phpmysqlautobackup/run.php', '', '10.74062 seconds via PHP CURL ');

-- --------------------------------------------------------

--
-- Table structure for table `phpmysqlautobackup`
--

DROP TABLE IF EXISTS `phpmysqlautobackup`;
CREATE TABLE IF NOT EXISTS `phpmysqlautobackup` (
  `id` int(11) NOT NULL,
  `version` varchar(6) DEFAULT NULL,
  `time_last_run` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpmysqlautobackup`
--

INSERT INTO `phpmysqlautobackup` (`id`, `version`, `time_last_run`) VALUES
(1, '1.6.3', 1444019244);

-- --------------------------------------------------------

--
-- Table structure for table `phpmysqlautobackup_log`
--

DROP TABLE IF EXISTS `phpmysqlautobackup_log`;
CREATE TABLE IF NOT EXISTS `phpmysqlautobackup_log` (
  `date` int(11) NOT NULL,
  `bytes` int(11) NOT NULL,
  `lines` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `phpmysqlautobackup_log`
--

INSERT INTO `phpmysqlautobackup_log` (`date`, `bytes`, `lines`) VALUES
(1442135928, 56700, 456),
(1444019247, 60715, 471);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
`product_id` int(11) NOT NULL,
  `product_name` varchar(200) NOT NULL,
  `poc` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `skype` varchar(100) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `date_added` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_name`, `poc`, `email`, `tel`, `skype`, `vendor_id`, `date_added`) VALUES
(4, 'Oracle', 'Naim', 'mnaim.faizy@gmail.com', '07828192821', 'mnaimfaizy', 2, 1441868401),
(5, 'Oracle', 'Naim', 'mnaim.faizy@gmail.com', '07828192821', 'mnaimfaizy', 3, 1441870588);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
`project_id` int(20) NOT NULL,
  `project_title` varchar(100) NOT NULL,
  `description_of_activities` text NOT NULL,
  `province` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `organization` varchar(200) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_phone` varchar(30) NOT NULL,
  `cost_in_usd` int(20) NOT NULL,
  `start_date` int(50) NOT NULL,
  `end_date` int(50) NOT NULL,
  `completed` varchar(5) NOT NULL,
  `subcontractor` varchar(100) NOT NULL,
  `department` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `taxation` varchar(20) NOT NULL,
  `project_by_ascc_employee` varchar(100) NOT NULL,
  `invoice_afs` int(100) NOT NULL,
  `rate` varchar(50) NOT NULL,
  `invoice_usd` int(100) NOT NULL,
  `received_date` date NOT NULL,
  `total_amount_spent` int(100) NOT NULL,
  `total_amount_shared` int(100) NOT NULL,
  `net_profit_afs` int(100) NOT NULL,
  `net_profit_usd` int(100) NOT NULL,
  `project_file` varchar(200) NOT NULL,
  `client_id` int(11) NOT NULL,
  `date_added` int(100) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_title`, `description_of_activities`, `province`, `district`, `organization`, `client_name`, `client_phone`, `cost_in_usd`, `start_date`, `end_date`, `completed`, `subcontractor`, `department`, `unit`, `taxation`, `project_by_ascc_employee`, `invoice_afs`, `rate`, `invoice_usd`, `received_date`, `total_amount_spent`, `total_amount_shared`, `net_profit_afs`, `net_profit_usd`, `project_file`, `client_id`, `date_added`, `status`) VALUES
(1, 'test', 'This is test description. This is test description.This is test description.This is test description.This is test description.This is test description.This is test description.This is test description.', '1', '2', 'Afghan United Bank', 'Naim FAizy', '788103809', 30000, 19700101, 1444678200, 'No', 'Saleem', 'Head Office', '500', 'Yes', 'Yama', 20000, '56.9', 2000, '1970-01-01', 20000, 1800, 10000, 200, 'black-hat-seo_1.jpg', 0, 8, 'Active'),
(2, 'TEst 2', 'This is some test descriptition number 2  This is some test descriptition number 2  This is some test descriptition number 2  This is some test descriptition number 2  This is some test descriptition number 2  This is some test descriptition number 2', '33', '382', 'AUB', 'Mohammad Naim Faizy', '892910291', 20012, 19700101, 1444678200, 'Yes', 'Saleem Jamshedi', 'IT', '500', 'Yes', 'Salam Khan', 20000, '56.9', 2000, '1970-01-01', 20000, 1800, 10000, 200, 'Fancy-Black-Pant.jpg', 0, 8, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

DROP TABLE IF EXISTS `province`;
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int(11) NOT NULL,
  `province_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`province_id`, `province_name`) VALUES
(1, 'Kabul'),
(2, 'Kapisa'),
(3, 'Parwan'),
(4, 'Wardak'),
(5, 'Logar'),
(6, 'Nangarhar'),
(7, 'Laghman'),
(8, 'Panjsher'),
(9, 'Baghlan'),
(10, 'Bamyan'),
(11, 'Ghazni'),
(12, 'Paktya'),
(13, 'Kunar'),
(14, 'Nuristan'),
(15, 'Badakhshan'),
(16, 'Takhar'),
(17, 'Kunduz'),
(18, 'Balkh'),
(19, 'Samangan'),
(20, 'Sar-e-Pul'),
(21, 'Ghor'),
(22, 'Daykundi'),
(23, 'Uruzgan'),
(24, 'Zabul'),
(25, 'Paktika'),
(26, 'Khost'),
(27, 'Jawzjan'),
(28, 'Faryab'),
(29, 'Badghis'),
(30, 'Hirat'),
(31, 'Farah'),
(32, 'Hilmand'),
(33, 'Kandahar'),
(34, 'Nimroz');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

DROP TABLE IF EXISTS `vendor`;
CREATE TABLE IF NOT EXISTS `vendor` (
`vendor_id` int(11) NOT NULL,
  `vendor_name` varchar(200) NOT NULL,
  `address` varchar(300) NOT NULL,
  `profile` text NOT NULL,
  `profile_file` varchar(200) NOT NULL,
  `date_added` int(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`vendor_id`, `vendor_name`, `address`, `profile`, `profile_file`, `date_added`) VALUES
(2, 'TEst Vendor', 'Kabul - Afghanistan', 'this is some profile texts;lakjsd;lakjsd;flkajsd;lfkja;slkdfja;skdjf;alkskdjf;alskdjf;asldkjf;alskdjf;laksddjff;alskdjf;alskddjf;alskdjff;alksdjdf', '', 1441868401),
(3, 'TEst Vendor1', 'Shahr-e-Naw', 'this is some profile texts;lakjsd;lakjsd;flkajsd;lfkja;slkdfja;skdjf;alkskdjf;alskdjf;asldkjf;alskdjf;laksddjff;alskdjf;alskddjf;alskdjff;alksdjdf', '', 1441870588);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
 ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `contact_person`
--
ALTER TABLE `contact_person`
 ADD PRIMARY KEY (`contact_person_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
 ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpjobscheduler`
--
ALTER TABLE `phpjobscheduler`
 ADD PRIMARY KEY (`id`), ADD KEY `fire_time` (`fire_time`);

--
-- Indexes for table `phpjobscheduler_logs`
--
ALTER TABLE `phpjobscheduler_logs`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpmysqlautobackup`
--
ALTER TABLE `phpmysqlautobackup`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `phpmysqlautobackup_log`
--
ALTER TABLE `phpmysqlautobackup_log`
 ADD PRIMARY KEY (`date`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
 ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`project_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
 ADD PRIMARY KEY (`province_id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
 ADD PRIMARY KEY (`vendor_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `contact_person`
--
ALTER TABLE `contact_person`
MODIFY `contact_person_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `phpjobscheduler`
--
ALTER TABLE `phpjobscheduler`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `phpjobscheduler_logs`
--
ALTER TABLE `phpjobscheduler_logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
MODIFY `project_id` int(20) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
MODIFY `vendor_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
