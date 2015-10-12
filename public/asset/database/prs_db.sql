-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 28, 2015 at 09:41 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `prs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `applicator`
--

CREATE TABLE IF NOT EXISTS `applicator` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `applicator_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `architect`
--

CREATE TABLE IF NOT EXISTS `architect` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `architect_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `area_place` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=12 ;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area_no`, `area_place`, `created_at`, `updated_at`) VALUES
(1, '1', 'QUEZON CITY', '2015-07-05 23:03:13', '2015-07-05 23:03:13'),
(2, '2', 'PASIG CITY', '2015-07-05 23:03:28', '2015-07-05 23:03:28'),
(3, '3', 'MANILA CITY', '2015-07-19 18:14:30', '2015-07-19 18:14:30'),
(4, '4', 'TAGUIG CITY', '2015-07-19 18:14:44', '2015-07-19 18:14:44'),
(5, '5', 'MAKATI CITY', '2015-07-19 18:15:02', '2015-07-19 18:15:02'),
(6, '6', 'PASAY CITY', '2015-07-22 22:53:53', '2015-07-22 22:53:53'),
(7, '7', 'VALENZUELA CITY', '2015-07-22 22:54:13', '2015-07-22 22:54:13'),
(8, '8', 'PATEROS CITY', '2015-07-22 22:54:41', '2015-07-22 22:54:41'),
(9, '9', 'BULACAN', '2015-07-22 22:55:35', '2015-07-22 22:55:35'),
(10, '10', 'CAVITE', '2015-07-22 22:55:50', '2015-07-22 22:55:50'),
(11, '11', 'DAVAO CITY', '2015-07-22 22:56:18', '2015-07-22 22:56:18');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_areas`
--

CREATE TABLE IF NOT EXISTS `assigned_areas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `area_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `assigned_areas_area_id_foreign` (`area_id`),
  KEY `assigned_areas_user_id_foreign` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `assigned_areas`
--

INSERT INTO `assigned_areas` (`id`, `area_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 5, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 4, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 9, 5, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 11, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_roles`
--

CREATE TABLE IF NOT EXISTS `assigned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `assigned_roles_user_id_foreign` (`user_id`),
  KEY `assigned_roles_role_id_foreign` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `assigned_roles`
--

INSERT INTO `assigned_roles` (`id`, `user_id`, `role_id`) VALUES
(1, 1, 1),
(2, 2, 3),
(3, 3, 4),
(4, 4, 2),
(5, 5, 3),
(6, 6, 4),
(7, 7, 3),
(8, 8, 4);

-- --------------------------------------------------------

--
-- Table structure for table `attached_forcompany`
--

CREATE TABLE IF NOT EXISTS `attached_forcompany` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `type` int(5) NOT NULL,
  `forcompany_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `file_img` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `attached_forcompany`
--

INSERT INTO `attached_forcompany` (`id`, `type`, `forcompany_id`, `user_id`, `status`, `file_img`, `date_created`, `time_created`) VALUES
(1, 2, 1, 2, 1, 'add_project.docx', '2015-09-23', '01:02:45'),
(2, 2, 2, 2, 1, 'HOUSE UNIT RENTAL AGREEMENT.docx', '2015-09-28', '22:15:07');

-- --------------------------------------------------------

--
-- Table structure for table `attached_forcontact`
--

CREATE TABLE IF NOT EXISTS `attached_forcontact` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `type` int(5) NOT NULL,
  `forcontact_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `file_img` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `attached_forcontact`
--

INSERT INTO `attached_forcontact` (`id`, `type`, `forcontact_id`, `user_id`, `status`, `file_img`, `date_created`, `time_created`) VALUES
(2, 2, 2, 5, 1, 'screenshots.docx', '2015-09-22', '22:57:07'),
(3, 1, 3, 2, 1, 'new_raven_Floorplan_september_noprice-02.jpg', '2015-09-23', '23:03:28'),
(4, 2, 4, 2, 1, 'Warehouse and Cold Storage grouping.xls', '2015-09-24', '01:46:36');

-- --------------------------------------------------------

--
-- Table structure for table `attached_forothers`
--

CREATE TABLE IF NOT EXISTS `attached_forothers` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `type` int(5) NOT NULL,
  `forothers_id` int(10) NOT NULL,
  `user_id` int(5) NOT NULL,
  `status` int(5) NOT NULL,
  `file_img` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `attached_forothers`
--

INSERT INTO `attached_forothers` (`id`, `type`, `forothers_id`, `user_id`, `status`, `file_img`, `date_created`, `time_created`) VALUES
(1, 2, 1, 7, 1, 'merge.docx', '2015-09-23', '04:32:09'),
(2, 2, 2, 2, 1, 'chase_jc.docx', '2015-09-24', '22:50:22'),
(3, 2, 2, 2, 1, 'prs new sample with proj categories.doc', '2015-09-24', '22:50:22'),
(4, 2, 3, 2, 1, 'prs new sample with proj categories.doc', '2015-09-28', '23:42:25'),
(5, 2, 5, 2, 1, 'add_project.docx', '2015-09-28', '02:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `attached_forproject`
--

CREATE TABLE IF NOT EXISTS `attached_forproject` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `type` int(5) NOT NULL,
  `forproject_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `file_img` varchar(250) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `attached_forproject`
--

INSERT INTO `attached_forproject` (`id`, `type`, `forproject_id`, `user_id`, `status`, `file_img`, `date_created`, `time_created`) VALUES
(1, 2, 1, 2, 1, 'merge.docx', '2015-09-23', '02:36:44'),
(2, 1, 1, 2, 1, 'Lighthouse.jpg', '2015-09-23', '02:36:44'),
(3, 2, 2, 2, 1, 'merge.docx', '2015-09-28', '22:58:39');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`, `description`, `created_at`, `updated_at`) VALUES
(1, 'HIGH-RISE BUILDING', '11 FLOOR ABOVE', '2015-07-01 19:39:47', '2015-07-01 19:39:47'),
(2, 'MEDIUM-RISE BUILDING', '4-10 FLOORS', '2015-07-01 19:40:03', '2015-07-01 19:40:03'),
(3, 'COMMERCIAL BUILDING', 'SHOPPING CENTRES', '2015-07-01 19:40:16', '2015-07-01 19:40:16'),
(4, 'COMMERCIAL BUILDING', 'SUPERMARKETS', '2015-07-01 19:40:29', '2015-07-01 19:40:29'),
(5, 'COMMERCIAL BUILDING', 'SHOPS', '2015-07-01 19:40:41', '2015-07-01 19:40:41'),
(6, 'COMMERCIAL BUILDING', 'RESTAURANTS AND CAFES', '2015-07-01 19:40:54', '2015-07-01 19:40:54'),
(7, 'RESIDENTIAL', 'SINGLE DETACHED-BUNGALOW TO 3 FLOORS', '2015-07-01 19:41:09', '2015-07-01 19:41:09'),
(8, 'TOWN HOUSE', 'APARTMENTS', '2015-07-01 19:41:23', '2015-07-01 19:41:23'),
(9, 'TOWN HOUSE', 'ESTATES', '2015-07-01 19:41:34', '2015-07-01 19:41:34'),
(10, 'TOWN HOUSE', 'HOUSES', '2015-07-01 19:41:47', '2015-07-01 19:41:47'),
(11, 'HOUSING', 'MASS HOUSING', '2015-07-01 19:42:02', '2015-07-01 19:42:02'),
(12, 'INSTITUTIONAL', 'HOTELS', '2015-07-01 19:42:18', '2015-07-01 19:42:18'),
(13, 'INSTITUTIONAL', 'SCHOOLS', '2015-07-01 19:42:31', '2015-07-01 19:42:31'),
(14, 'INSTITUTIONAL', 'HOSPITALS', '2015-07-01 19:42:45', '2015-07-01 19:42:45'),
(15, 'INSTITUTIONAL', 'CHURCHES', '2015-07-01 19:42:59', '2015-07-01 19:42:59'),
(16, 'INDUSTRIAL/WAREHOUSE', '', '2015-07-01 19:43:10', '2015-07-01 19:43:10'),
(17, 'GOVERNMENT', 'BUILDINGS', '2015-07-01 19:43:23', '2015-07-01 19:43:23'),
(18, 'GOVERNMENT', 'HOSPITALS', '2015-07-01 19:43:38', '2015-07-01 19:43:38'),
(19, 'GOVERNMENT', 'SCHOOLS', '2015-07-01 19:43:53', '2015-07-01 19:43:53'),
(20, 'FACILITIES', 'RECREATIONAL', '2015-07-01 19:44:04', '2015-07-01 19:44:04'),
(21, 'FACILITIES', 'TRANSPORT', '2015-07-01 19:44:17', '2015-07-01 19:44:17');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `province_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cities_province_id_foreign` (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1637 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `province_id`) VALUES
(0, 'N/A', 1),
(1, 'Bangued', 1),
(2, 'Boliney', 1),
(3, 'Bucay', 1),
(4, 'Bucloc', 1),
(5, 'Daguioman', 1),
(6, 'Danglas', 1),
(7, 'Dolores', 1),
(8, 'La Paz', 1),
(9, 'Lacub', 1),
(10, 'Lagangilang', 1),
(11, 'Lagayan', 1),
(12, 'Langiden', 1),
(13, 'Licuan-Baay', 1),
(14, 'Luba', 1),
(15, 'Malibcong', 1),
(16, 'Manabo', 1),
(17, 'Peñarrubia', 1),
(18, 'Pidigan', 1),
(19, 'Pilar', 1),
(20, 'Sallapadan', 1),
(21, 'San Isidro', 1),
(22, 'San Juan', 1),
(23, 'San Quintin', 1),
(24, 'Tayum', 1),
(25, 'Tineg', 1),
(26, 'Tubo', 1),
(27, 'Villaviciosa', 1),
(28, 'Butuan City', 2),
(29, 'Buenavista', 2),
(30, 'Cabadbaran', 2),
(31, 'Carmen', 2),
(32, 'Jabonga', 2),
(33, 'Kitcharao', 2),
(34, 'Las Nieves', 2),
(35, 'Magallanes', 2),
(36, 'Nasipit', 2),
(37, 'Remedios T. Romualdez', 2),
(38, 'Santiago', 2),
(39, 'Tubay', 2),
(40, 'Bayugan', 3),
(41, 'Bunawan', 3),
(42, 'Esperanza', 3),
(43, 'La Paz', 3),
(44, 'Loreto', 3),
(45, 'Prosperidad', 3),
(46, 'Rosario', 3),
(47, 'San Francisco', 3),
(48, 'San Luis', 3),
(49, 'Santa Josefa', 3),
(50, 'Sibagat', 3),
(51, 'Talacogon', 3),
(52, 'Trento', 3),
(53, 'Veruela', 3),
(54, 'Altavas', 4),
(55, 'Balete', 4),
(56, 'Banga', 4),
(57, 'Batan', 4),
(58, 'Buruanga', 4),
(59, 'Ibajay', 4),
(60, 'Kalibo', 4),
(61, 'Lezo', 4),
(62, 'Libacao', 4),
(63, 'Madalag', 4),
(64, 'Makato', 4),
(65, 'Malay', 4),
(66, 'Malinao', 4),
(67, 'Nabas', 4),
(68, 'New Washington', 4),
(69, 'Numancia', 4),
(70, 'Tangalan', 4),
(71, 'Legazpi City', 5),
(72, 'Ligao City', 5),
(73, 'Tabaco City', 5),
(74, 'Bacacay', 5),
(75, 'Camalig', 5),
(76, 'Daraga', 5),
(77, 'Guinobatan', 5),
(78, 'Jovellar', 5),
(79, 'Libon', 5),
(80, 'Malilipot', 5),
(81, 'Malinao', 5),
(82, 'Manito', 5),
(83, 'Oas', 5),
(84, 'Pio Duran', 5),
(85, 'Polangui', 5),
(86, 'Rapu-Rapu', 5),
(87, 'Santo Domingo', 5),
(88, 'Tiwi', 5),
(89, 'Anini-y', 6),
(90, 'Barbaza', 6),
(91, 'Belison', 6),
(92, 'Bugasong', 6),
(93, 'Caluya', 6),
(94, 'Culasi', 6),
(95, 'Hamtic', 6),
(96, 'Laua-an', 6),
(97, 'Libertad', 6),
(98, 'Pandan', 6),
(99, 'Patnongon', 6),
(100, 'San Jose', 6),
(101, 'San Remigio', 6),
(102, 'Sebaste', 6),
(103, 'Sibalom', 6),
(104, 'Tibiao', 6),
(105, 'Tobias Fornier', 6),
(106, 'Valderrama', 6),
(107, 'Calanasan', 7),
(108, 'Conner', 7),
(109, 'Flora', 7),
(110, 'Kabugao', 7),
(111, 'Luna', 7),
(112, 'Pudtol', 7),
(113, 'Santa Marcela', 7),
(114, 'Baler', 8),
(115, 'Casiguran', 8),
(116, 'Dilasag', 8),
(117, 'Dinalungan', 8),
(118, 'Dingalan', 8),
(119, 'Dipaculao', 8),
(120, 'Maria Aurora', 8),
(121, 'San Luis', 8),
(122, 'Isabela City', 9),
(123, 'Akbar', 9),
(124, 'Al-Barka', 9),
(125, 'Hadji Mohammad Ajul', 9),
(126, 'Hadji Muhtamad', 9),
(127, 'Lamitan', 9),
(128, 'Lantawan', 9),
(129, 'Maluso', 9),
(130, 'Sumisip', 9),
(131, 'Tabuan-Lasa', 9),
(132, 'Tipo-Tipo', 9),
(133, 'Tuburan', 9),
(134, 'Ungkaya Pukan', 9),
(135, 'Balanga City', 10),
(136, 'Abucay', 10),
(137, 'Bagac', 10),
(138, 'Dinalupihan', 10),
(139, 'Hermosa', 10),
(140, 'Limay', 10),
(141, 'Mariveles', 10),
(142, 'Morong', 10),
(143, 'Orani', 10),
(144, 'Orion', 10),
(145, 'Pilar', 10),
(146, 'Samal', 10),
(147, 'Basco', 11),
(148, 'Itbayat', 11),
(149, 'Ivana', 11),
(150, 'Mahatao', 11),
(151, 'Sabtang', 11),
(152, 'Uyugan', 11),
(153, 'Batangas City', 12),
(154, 'Lipa City', 12),
(155, 'Tanauan City', 12),
(156, 'Agoncillo', 12),
(157, 'Alitagtag', 12),
(158, 'Balayan', 12),
(159, 'Balete', 12),
(160, 'Bauan', 12),
(161, 'Calaca', 12),
(162, 'Calatagan', 12),
(163, 'Cuenca', 12),
(164, 'Ibaan', 12),
(165, 'Laurel', 12),
(166, 'Lemery', 12),
(167, 'Lian', 12),
(168, 'Lobo', 12),
(169, 'Mabini', 12),
(170, 'Malvar', 12),
(171, 'Mataas na Kahoy', 12),
(172, 'Nasugbu', 12),
(173, 'Padre Garcia', 12),
(174, 'Rosario', 12),
(175, 'San Jose', 12),
(176, 'San Juan', 12),
(177, 'San Luis', 12),
(178, 'San Nicolas', 12),
(179, 'San Pascual', 12),
(180, 'Santa Teresita', 12),
(181, 'Santo Tomas', 12),
(182, 'Taal', 12),
(183, 'Talisay', 12),
(184, 'Taysan', 12),
(185, 'Tingloy', 12),
(186, 'Tuy', 12),
(187, 'Baguio City', 13),
(188, 'Atok', 13),
(189, 'Bakun', 13),
(190, 'Bokod', 13),
(191, 'Buguias', 13),
(192, 'Itogon', 13),
(193, 'Kabayan', 13),
(194, 'Kapangan', 13),
(195, 'Kibungan', 13),
(196, 'La Trinidad', 13),
(197, 'Mankayan', 13),
(198, 'Sablan', 13),
(199, 'Tuba', 13),
(200, 'Tublay', 13),
(201, 'Almeria', 14),
(202, 'Biliran', 14),
(203, 'Cabucgayan', 14),
(204, 'Caibiran', 14),
(205, 'Culaba', 14),
(206, 'Kawayan', 14),
(207, 'Maripipi', 14),
(208, 'Naval', 14),
(209, 'Tagbilaran City', 15),
(210, 'Alburquerque', 15),
(211, 'Alicia', 15),
(212, 'Anda', 15),
(213, 'Antequera', 15),
(214, 'Baclayon', 15),
(215, 'Balilihan', 15),
(216, 'Batuan', 15),
(217, 'Bien Unido', 15),
(218, 'Bilar', 15),
(219, 'Buenavista', 15),
(220, 'Calape', 15),
(221, 'Candijay', 15),
(222, 'Carmen', 15),
(223, 'Catigbian', 15),
(224, 'Clarin', 15),
(225, 'Corella', 15),
(226, 'Cortes', 15),
(227, 'Dagohoy', 15),
(228, 'Danao', 15),
(229, 'Dauis', 15),
(230, 'Dimiao', 15),
(231, 'Duero', 15),
(232, 'Garcia Hernandez', 15),
(233, 'Getafe', 15),
(234, 'Guindulman', 15),
(235, 'Inabanga', 15),
(236, 'Jagna', 15),
(237, 'Lila', 15),
(238, 'Loay', 15),
(239, 'Loboc', 15),
(240, 'Loon', 15),
(241, 'Mabini', 15),
(242, 'Maribojoc', 15),
(243, 'Panglao', 15),
(244, 'Pilar', 15),
(245, 'President Carlos P. Garcia', 15),
(246, 'Sagbayan', 15),
(247, 'San Isidro', 15),
(248, 'San Miguel', 15),
(249, 'Sevilla', 15),
(250, 'Sierra Bullones', 15),
(251, 'Sikatuna', 15),
(252, 'Talibon', 15),
(253, 'Trinidad', 15),
(254, 'Tubigon', 15),
(255, 'Ubay', 15),
(256, 'Valencia', 15),
(257, 'Malaybalay City', 16),
(258, 'Valencia City', 16),
(259, 'Baungon', 16),
(260, 'Cabanglasan', 16),
(261, 'Damulog', 16),
(262, 'Dangcagan', 16),
(263, 'Don Carlos', 16),
(264, 'Impasug-ong', 16),
(265, 'Kadingilan', 16),
(266, 'Kalilangan', 16),
(267, 'Kibawe', 16),
(268, 'Kitaotao', 16),
(269, 'Lantapan', 16),
(270, 'Libona', 16),
(271, 'Malitbog', 16),
(272, 'Manolo Fortich', 16),
(273, 'Maramag', 16),
(274, 'Pangantucan', 16),
(275, 'Quezon', 16),
(276, 'San Fernando', 16),
(277, 'Sumilao', 16),
(278, 'Talakag', 16),
(279, 'Malolos City', 17),
(280, 'Meycauayan City', 17),
(281, 'San Jose del Monte City', 17),
(282, 'Angat', 17),
(283, 'Balagtas', 17),
(284, 'Baliuag', 17),
(285, 'Bocaue', 17),
(286, 'Bulacan', 17),
(287, 'Bustos', 17),
(288, 'Calumpit', 17),
(289, 'Doña Remedios Trinidad', 17),
(290, 'Guiguinto', 17),
(291, 'Hagonoy', 17),
(292, 'Marilao', 17),
(293, 'Norzagaray', 17),
(294, 'Obando', 17),
(295, 'Pandi', 17),
(296, 'Paombong', 17),
(297, 'Plaridel', 17),
(298, 'Pulilan', 17),
(299, 'San Ildefonso', 17),
(300, 'San Miguel', 17),
(301, 'San Rafael', 17),
(302, 'Santa Maria', 17),
(303, 'Tuguegarao City', 18),
(304, 'Abulug', 18),
(305, 'Alcala', 18),
(306, 'Allacapan', 18),
(307, 'Amulung', 18),
(308, 'Aparri', 18),
(309, 'Baggao', 18),
(310, 'Ballesteros', 18),
(311, 'Buguey', 18),
(312, 'Calayan', 18),
(313, 'Camalaniugan', 18),
(314, 'Claveria', 18),
(315, 'Enrile', 18),
(316, 'Gattaran', 18),
(317, 'Gonzaga', 18),
(318, 'Iguig', 18),
(319, 'Lal-lo', 18),
(320, 'Lasam', 18),
(321, 'Pamplona', 18),
(322, 'Peñablanca', 18),
(323, 'Piat', 18),
(324, 'Rizal', 18),
(325, 'Sanchez-Mira', 18),
(326, 'Santa Ana', 18),
(327, 'Santa Praxedes', 18),
(328, 'Santa Teresita', 18),
(329, 'Santo Niño', 18),
(330, 'Solana', 18),
(331, 'Tuao', 18),
(332, 'Basud', 19),
(333, 'Capalonga', 19),
(334, 'Daet', 19),
(335, 'Jose Panganiban', 19),
(336, 'Labo', 19),
(337, 'Mercedes', 19),
(338, 'Paracale', 19),
(339, 'San Lorenzo Ruiz', 19),
(340, 'San Vicente', 19),
(341, 'Santa Elena', 19),
(342, 'Talisay', 19),
(343, 'Vinzons', 19),
(344, 'Iriga City', 20),
(345, 'Naga City', 20),
(346, 'Baao', 20),
(347, 'Balatan', 20),
(348, 'Bato', 20),
(349, 'Bombon', 20),
(350, 'Buhi', 20),
(351, 'Bula', 20),
(352, 'Cabusao', 20),
(353, 'Calabanga', 20),
(354, 'Camaligan', 20),
(355, 'Canaman', 20),
(356, 'Caramoan', 20),
(357, 'Del Gallego', 20),
(358, 'Gainza', 20),
(359, 'Garchitorena', 20),
(360, 'Goa', 20),
(361, 'Lagonoy', 20),
(362, 'Libmanan', 20),
(363, 'Lupi', 20),
(364, 'Magarao', 20),
(365, 'Milaor', 20),
(366, 'Minalabac', 20),
(367, 'Nabua', 20),
(368, 'Ocampo', 20),
(369, 'Pamplona', 20),
(370, 'Pasacao', 20),
(371, 'Pili', 20),
(372, 'Presentacion', 20),
(373, 'Ragay', 20),
(374, 'Sagñay', 20),
(375, 'San Fernando', 20),
(376, 'San Jose', 20),
(377, 'Sipocot', 20),
(378, 'Siruma', 20),
(379, 'Tigaon', 20),
(380, 'Tinambac', 20),
(381, 'Catarman', 21),
(382, 'Guinsiliban', 21),
(383, 'Mahinog', 21),
(384, 'Mambajao', 21),
(385, 'Sagay', 21),
(386, 'Roxas City', 22),
(387, 'Cuartero', 22),
(388, 'Dao', 22),
(389, 'Dumalag', 22),
(390, 'Dumarao', 22),
(391, 'Ivisan', 22),
(392, 'Jamindan', 22),
(393, 'Ma-ayon', 22),
(394, 'Mambusao', 22),
(395, 'Panay', 22),
(396, 'Panitan', 22),
(397, 'Pilar', 22),
(398, 'Pontevedra', 22),
(399, 'President Roxas', 22),
(400, 'Sapi-an', 22),
(401, 'Sigma', 22),
(402, 'Tapaz', 22),
(403, 'Bagamanoc', 23),
(404, 'Baras', 23),
(405, 'Bato', 23),
(406, 'Caramoran', 23),
(407, 'Gigmoto', 23),
(408, 'Pandan', 23),
(409, 'Panganiban', 23),
(410, 'San Andres', 23),
(411, 'San Miguel', 23),
(412, 'Viga', 23),
(413, 'Virac', 23),
(414, 'Cavite City', 24),
(415, 'Dasmariñas City', 24),
(416, 'Tagaytay City', 24),
(417, 'Trece Martires City', 24),
(418, 'Alfonso', 24),
(419, 'Amadeo', 24),
(420, 'Bacoor', 24),
(421, 'Carmona', 24),
(422, 'General Mariano Alvarez', 24),
(423, 'General Emilio Aguinaldo', 24),
(424, 'General Trias', 24),
(425, 'Imus', 24),
(426, 'Indang', 24),
(427, 'Kawit', 24),
(428, 'Magallanes', 24),
(429, 'Maragondon', 24),
(430, 'Mendez', 24),
(431, 'Naic', 24),
(432, 'Noveleta', 24),
(433, 'Rosario', 24),
(434, 'Silang', 24),
(435, 'Tanza', 24),
(436, 'Ternate', 24),
(437, 'Bogo City', 25),
(438, 'Cebu City', 25),
(439, 'Carcar City', 25),
(440, 'Danao City', 25),
(441, 'Lapu-Lapu City', 25),
(442, 'Mandaue City', 25),
(443, 'Naga City', 25),
(444, 'Talisay City', 25),
(445, 'Toledo City', 25),
(446, 'Alcantara', 25),
(447, 'Alcoy', 25),
(448, 'Alegria', 25),
(449, 'Aloguinsan', 25),
(450, 'Argao', 25),
(451, 'Asturias', 25),
(452, 'Badian', 25),
(453, 'Balamban', 25),
(454, 'Bantayan', 25),
(455, 'Barili', 25),
(456, 'Boljoon', 25),
(457, 'Borbon', 25),
(458, 'Carmen', 25),
(459, 'Catmon', 25),
(460, 'Compostela', 25),
(461, 'Consolacion', 25),
(462, 'Cordoba', 25),
(463, 'Daanbantayan', 25),
(464, 'Dalaguete', 25),
(465, 'Dumanjug', 25),
(466, 'Ginatilan', 25),
(467, 'Liloan', 25),
(468, 'Madridejos', 25),
(469, 'Malabuyoc', 25),
(470, 'Medellin', 25),
(471, 'Minglanilla', 25),
(472, 'Moalboal', 25),
(473, 'Oslob', 25),
(474, 'Pilar', 25),
(475, 'Pinamungahan', 25),
(476, 'Poro', 25),
(477, 'Ronda', 25),
(478, 'Samboan', 25),
(479, 'San Fernando', 25),
(480, 'San Francisco', 25),
(481, 'San Remigio', 25),
(482, 'Santa Fe', 25),
(483, 'Santander', 25),
(484, 'Sibonga', 25),
(485, 'Sogod', 25),
(486, 'Tabogon', 25),
(487, 'Tabuelan', 25),
(488, 'Tuburan', 25),
(489, 'Tudela', 25),
(490, 'Compostela', 26),
(491, 'Laak', 26),
(492, 'Mabini', 26),
(493, 'Maco', 26),
(494, 'Maragusan', 26),
(495, 'Mawab', 26),
(496, 'Monkayo', 26),
(497, 'Montevista', 26),
(498, 'Nabunturan', 26),
(499, 'New Bataan', 26),
(500, 'Pantukan', 26),
(501, 'Kidapawan City', 27),
(502, 'Alamada', 27),
(503, 'Aleosan', 27),
(504, 'Antipas', 27),
(505, 'Arakan', 27),
(506, 'Banisilan', 27),
(507, 'Carmen', 27),
(508, 'Kabacan', 27),
(509, 'Libungan', 27),
(510, 'M''lang', 27),
(511, 'Magpet', 27),
(512, 'Makilala', 27),
(513, 'Matalam', 27),
(514, 'Midsayap', 27),
(515, 'Pigkawayan', 27),
(516, 'Pikit', 27),
(517, 'President Roxas', 27),
(518, 'Tulunan', 27),
(519, 'Panabo City', 28),
(520, 'Island Garden City of Samal', 28),
(521, 'Tagum City', 28),
(522, 'Asuncion', 28),
(523, 'Braulio E. Dujali', 28),
(524, 'Carmen', 28),
(525, 'Kapalong', 28),
(526, 'New Corella', 28),
(527, 'San Isidro', 28),
(528, 'Santo Tomas', 28),
(529, 'Talaingod', 28),
(530, 'Davao City', 29),
(531, 'Digos City', 29),
(532, 'Bansalan', 29),
(533, 'Don Marcelino', 29),
(534, 'Hagonoy', 29),
(535, 'Jose Abad Santos', 29),
(536, 'Kiblawan', 29),
(537, 'Magsaysay', 29),
(538, 'Malalag', 29),
(539, 'Malita', 29),
(540, 'Matanao', 29),
(541, 'Padada', 29),
(542, 'Santa Cruz', 29),
(543, 'Santa Maria', 29),
(544, 'Sarangani', 29),
(545, 'Sulop', 29),
(546, 'Mati City', 30),
(547, 'Baganga', 30),
(548, 'Banaybanay', 30),
(549, 'Boston', 30),
(550, 'Caraga', 30),
(551, 'Cateel', 30),
(552, 'Governor Generoso', 30),
(553, 'Lupon', 30),
(554, 'Manay', 30),
(555, 'San Isidro', 30),
(556, 'Tarragona', 30),
(557, 'Arteche', 31),
(558, 'Balangiga', 31),
(559, 'Balangkayan', 31),
(560, 'Borongan', 31),
(561, 'Can-avid', 31),
(562, 'Dolores', 31),
(563, 'General MacArthur', 31),
(564, 'Giporlos', 31),
(565, 'Guiuan', 31),
(566, 'Hernani', 31),
(567, 'Jipapad', 31),
(568, 'Lawaan', 31),
(569, 'Llorente', 31),
(570, 'Maslog', 31),
(571, 'Maydolong', 31),
(572, 'Mercedes', 31),
(573, 'Oras', 31),
(574, 'Quinapondan', 31),
(575, 'Salcedo', 31),
(576, 'San Julian', 31),
(577, 'San Policarpo', 31),
(578, 'Sulat', 31),
(579, 'Taft', 31),
(580, 'Buenavista', 32),
(581, 'Jordan', 32),
(582, 'Nueva Valencia', 32),
(583, 'San Lorenzo', 32),
(584, 'Sibunag', 32),
(585, 'Aguinaldo', 33),
(586, 'Alfonso Lista', 33),
(587, 'Asipulo', 33),
(588, 'Banaue', 33),
(589, 'Hingyon', 33),
(590, 'Hungduan', 33),
(591, 'Kiangan', 33),
(592, 'Lagawe', 33),
(593, 'Lamut', 33),
(594, 'Mayoyao', 33),
(595, 'Tinoc', 33),
(596, 'Batac City', 34),
(597, 'Laoag City', 34),
(598, 'Adams', 34),
(599, 'Bacarra', 34),
(600, 'Badoc', 34),
(601, 'Bangui', 34),
(602, 'Banna', 34),
(603, 'Burgos', 34),
(604, 'Carasi', 34),
(605, 'Currimao', 34),
(606, 'Dingras', 34),
(607, 'Dumalneg', 34),
(608, 'Marcos', 34),
(609, 'Nueva Era', 34),
(610, 'Pagudpud', 34),
(611, 'Paoay', 34),
(612, 'Pasuquin', 34),
(613, 'Piddig', 34),
(614, 'Pinili', 34),
(615, 'San Nicolas', 34),
(616, 'Sarrat', 34),
(617, 'Solsona', 34),
(618, 'Vintar', 34),
(619, 'Candon City', 35),
(620, 'Vigan City', 35),
(621, 'Alilem', 35),
(622, 'Banayoyo', 35),
(623, 'Bantay', 35),
(624, 'Burgos', 35),
(625, 'Cabugao', 35),
(626, 'Caoayan', 35),
(627, 'Cervantes', 35),
(628, 'Galimuyod', 35),
(629, 'Gregorio Del Pilar', 35),
(630, 'Lidlidda', 35),
(631, 'Magsingal', 35),
(632, 'Nagbukel', 35),
(633, 'Narvacan', 35),
(634, 'Quirino', 35),
(635, 'Salcedo', 35),
(636, 'San Emilio', 35),
(637, 'San Esteban', 35),
(638, 'San Ildefonso', 35),
(639, 'San Juan', 35),
(640, 'San Vicente', 35),
(641, 'Santa', 35),
(642, 'Santa Catalina', 35),
(643, 'Santa Cruz', 35),
(644, 'Santa Lucia', 35),
(645, 'Santa Maria', 35),
(646, 'Santiago', 35),
(647, 'Santo Domingo', 35),
(648, 'Sigay', 35),
(649, 'Sinait', 35),
(650, 'Sugpon', 35),
(651, 'Suyo', 35),
(652, 'Tagudin', 35),
(653, 'Iloilo City', 36),
(654, 'Passi City', 36),
(655, 'Ajuy', 36),
(656, 'Alimodian', 36),
(657, 'Anilao', 36),
(658, 'Badiangan', 36),
(659, 'Balasan', 36),
(660, 'Banate', 36),
(661, 'Barotac Nuevo', 36),
(662, 'Barotac Viejo', 36),
(663, 'Batad', 36),
(664, 'Bingawan', 36),
(665, 'Cabatuan', 36),
(666, 'Calinog', 36),
(667, 'Carles', 36),
(668, 'Concepcion', 36),
(669, 'Dingle', 36),
(670, 'Dueñas', 36),
(671, 'Dumangas', 36),
(672, 'Estancia', 36),
(673, 'Guimbal', 36),
(674, 'Igbaras', 36),
(675, 'Janiuay', 36),
(676, 'Lambunao', 36),
(677, 'Leganes', 36),
(678, 'Lemery', 36),
(679, 'Leon', 36),
(680, 'Maasin', 36),
(681, 'Miagao', 36),
(682, 'Mina', 36),
(683, 'New Lucena', 36),
(684, 'Oton', 36),
(685, 'Pavia', 36),
(686, 'Pototan', 36),
(687, 'San Dionisio', 36),
(688, 'San Enrique', 36),
(689, 'San Joaquin', 36),
(690, 'San Miguel', 36),
(691, 'San Rafael', 36),
(692, 'Santa Barbara', 36),
(693, 'Sara', 36),
(694, 'Tigbauan', 36),
(695, 'Tubungan', 36),
(696, 'Zarraga', 36),
(697, 'Cauayan City', 37),
(698, 'Santiago City', 37),
(699, 'Alicia', 37),
(700, 'Angadanan', 37),
(701, 'Aurora', 37),
(702, 'Benito Soliven', 37),
(703, 'Burgos', 37),
(704, 'Cabagan', 37),
(705, 'Cabatuan', 37),
(706, 'Cordon', 37),
(707, 'Delfin Albano', 37),
(708, 'Dinapigue', 37),
(709, 'Divilacan', 37),
(710, 'Echague', 37),
(711, 'Gamu', 37),
(712, 'Ilagan', 37),
(713, 'Jones', 37),
(714, 'Luna', 37),
(715, 'Maconacon', 37),
(716, 'Mallig', 37),
(717, 'Naguilian', 37),
(718, 'Palanan', 37),
(719, 'Quezon', 37),
(720, 'Quirino', 37),
(721, 'Ramon', 37),
(722, 'Reina Mercedes', 37),
(723, 'Roxas', 37),
(724, 'San Agustin', 37),
(725, 'San Guillermo', 37),
(726, 'San Isidro', 37),
(727, 'San Manuel', 37),
(728, 'San Mariano', 37),
(729, 'San Mateo', 37),
(730, 'San Pablo', 37),
(731, 'Santa Maria', 37),
(732, 'Santo Tomas', 37),
(733, 'Tumauini', 37),
(734, 'Tabuk', 38),
(735, 'Balbalan', 38),
(736, 'Lubuagan', 38),
(737, 'Pasil', 38),
(738, 'Pinukpuk', 38),
(739, 'Rizal', 38),
(740, 'Tanudan', 38),
(741, 'Tinglayan', 38),
(742, 'San Fernando City', 39),
(743, 'Agoo', 39),
(744, 'Aringay', 39),
(745, 'Bacnotan', 39),
(746, 'Bagulin', 39),
(747, 'Balaoan', 39),
(748, 'Bangar', 39),
(749, 'Bauang', 39),
(750, 'Burgos', 39),
(751, 'Caba', 39),
(752, 'Luna', 39),
(753, 'Naguilian', 39),
(754, 'Pugo', 39),
(755, 'Rosario', 39),
(756, 'San Gabriel', 39),
(757, 'San Juan', 39),
(758, 'Santo Tomas', 39),
(759, 'Santol', 39),
(760, 'Sudipen', 39),
(761, 'Tubao', 39),
(762, 'Biñan City', 40),
(763, 'Calamba City', 40),
(764, 'San Pablo City', 40),
(765, 'Santa Rosa City', 40),
(766, 'Alaminos', 40),
(767, 'Bay', 40),
(768, 'Cabuyao', 40),
(769, 'Calauan', 40),
(770, 'Cavinti', 40),
(771, 'Famy', 40),
(772, 'Kalayaan', 40),
(773, 'Liliw', 40),
(774, 'Los Baños', 40),
(775, 'Luisiana', 40),
(776, 'Lumban', 40),
(777, 'Mabitac', 40),
(778, 'Magdalena', 40),
(779, 'Majayjay', 40),
(780, 'Nagcarlan', 40),
(781, 'Paete', 40),
(782, 'Pagsanjan', 40),
(783, 'Pakil', 40),
(784, 'Pangil', 40),
(785, 'Pila', 40),
(786, 'Rizal', 40),
(787, 'San Pedro', 40),
(788, 'Santa Cruz', 40),
(789, 'Santa Maria', 40),
(790, 'Siniloan', 40),
(791, 'Victoria', 40),
(792, 'Iligan City', 41),
(793, 'Bacolod', 41),
(794, 'Baloi', 41),
(795, 'Baroy', 41),
(796, 'Kapatagan', 41),
(797, 'Kauswagan', 41),
(798, 'Kolambugan', 41),
(799, 'Lala', 41),
(800, 'Linamon', 41),
(801, 'Magsaysay', 41),
(802, 'Maigo', 41),
(803, 'Matungao', 41),
(804, 'Munai', 41),
(805, 'Nunungan', 41),
(806, 'Pantao Ragat', 41),
(807, 'Pantar', 41),
(808, 'Poona Piagapo', 41),
(809, 'Salvador', 41),
(810, 'Sapad', 41),
(811, 'Sultan Naga Dimaporo', 41),
(812, 'Tagoloan', 41),
(813, 'Tangcal', 41),
(814, 'Tubod', 41),
(815, 'Marawi City', 42),
(816, 'Bacolod-Kalawi', 42),
(817, 'Balabagan', 42),
(818, 'Balindong', 42),
(819, 'Bayang', 42),
(820, 'Binidayan', 42),
(821, 'Buadiposo-Buntong', 42),
(822, 'Bubong', 42),
(823, 'Bumbaran', 42),
(824, 'Butig', 42),
(825, 'Calanogas', 42),
(826, 'Ditsaan-Ramain', 42),
(827, 'Ganassi', 42),
(828, 'Kapai', 42),
(829, 'Kapatagan', 42),
(830, 'Lumba-Bayabao', 42),
(831, 'Lumbaca-Unayan', 42),
(832, 'Lumbatan', 42),
(833, 'Lumbayanague', 42),
(834, 'Madalum', 42),
(835, 'Madamba', 42),
(836, 'Maguing', 42),
(837, 'Malabang', 42),
(838, 'Marantao', 42),
(839, 'Marogong', 42),
(840, 'Masiu', 42),
(841, 'Mulondo', 42),
(842, 'Pagayawan', 42),
(843, 'Piagapo', 42),
(844, 'Poona Bayabao', 42),
(845, 'Pualas', 42),
(846, 'Saguiaran', 42),
(847, 'Sultan Dumalondong', 42),
(848, 'Picong', 42),
(849, 'Tagoloan II', 42),
(850, 'Tamparan', 42),
(851, 'Taraka', 42),
(852, 'Tubaran', 42),
(853, 'Tugaya', 42),
(854, 'Wao', 42),
(855, 'Ormoc City', 43),
(856, 'Tacloban City', 43),
(857, 'Abuyog', 43),
(858, 'Alangalang', 43),
(859, 'Albuera', 43),
(860, 'Babatngon', 43),
(861, 'Barugo', 43),
(862, 'Bato', 43),
(863, 'Baybay', 43),
(864, 'Burauen', 43),
(865, 'Calubian', 43),
(866, 'Capoocan', 43),
(867, 'Carigara', 43),
(868, 'Dagami', 43),
(869, 'Dulag', 43),
(870, 'Hilongos', 43),
(871, 'Hindang', 43),
(872, 'Inopacan', 43),
(873, 'Isabel', 43),
(874, 'Jaro', 43),
(875, 'Javier', 43),
(876, 'Julita', 43),
(877, 'Kananga', 43),
(878, 'La Paz', 43),
(879, 'Leyte', 43),
(880, 'Liloan', 43),
(881, 'MacArthur', 43),
(882, 'Mahaplag', 43),
(883, 'Matag-ob', 43),
(884, 'Matalom', 43),
(885, 'Mayorga', 43),
(886, 'Merida', 43),
(887, 'Palo', 43),
(888, 'Palompon', 43),
(889, 'Pastrana', 43),
(890, 'San Isidro', 43),
(891, 'San Miguel', 43),
(892, 'Santa Fe', 43),
(893, 'Sogod', 43),
(894, 'Tabango', 43),
(895, 'Tabontabon', 43),
(896, 'Tanauan', 43),
(897, 'Tolosa', 43),
(898, 'Tunga', 43),
(899, 'Villaba', 43),
(900, 'Cotabato City', 44),
(901, 'Ampatuan', 44),
(902, 'Barira', 44),
(903, 'Buldon', 44),
(904, 'Buluan', 44),
(905, 'Datu Abdullah Sangki', 44),
(906, 'Datu Anggal Midtimbang', 44),
(907, 'Datu Blah T. Sinsuat', 44),
(908, 'Datu Hoffer Ampatuan', 44),
(909, 'Datu Montawal', 44),
(910, 'Datu Odin Sinsuat', 44),
(911, 'Datu Paglas', 44),
(912, 'Datu Piang', 44),
(913, 'Datu Salibo', 44),
(914, 'Datu Saudi-Ampatuan', 44),
(915, 'Datu Unsay', 44),
(916, 'General Salipada K. Pendatun', 44),
(917, 'Guindulungan', 44),
(918, 'Kabuntalan', 44),
(919, 'Mamasapano', 44),
(920, 'Mangudadatu', 44),
(921, 'Matanog', 44),
(922, 'Northern Kabuntalan', 44),
(923, 'Pagalungan', 44),
(924, 'Paglat', 44),
(925, 'Pandag', 44),
(926, 'Parang', 44),
(927, 'Rajah Buayan', 44),
(928, 'Shariff Aguak', 44),
(929, 'Shariff Saydona Mustapha', 44),
(930, 'South Upi', 44),
(931, 'Sultan Kudarat', 44),
(932, 'Sultan Mastura', 44),
(933, 'Sultan sa Barongis', 44),
(934, 'Talayan', 44),
(935, 'Talitay', 44),
(936, 'Upi', 44),
(937, 'Boac', 45),
(938, 'Buenavista', 45),
(939, 'Gasan', 45),
(940, 'Mogpog', 45),
(941, 'Santa Cruz', 45),
(942, 'Torrijos', 45),
(943, 'Masbate City', 46),
(944, 'Aroroy', 46),
(945, 'Baleno', 46),
(946, 'Balud', 46),
(947, 'Batuan', 46),
(948, 'Cataingan', 46),
(949, 'Cawayan', 46),
(950, 'Claveria', 46),
(951, 'Dimasalang', 46),
(952, 'Esperanza', 46),
(953, 'Mandaon', 46),
(954, 'Milagros', 46),
(955, 'Mobo', 46),
(956, 'Monreal', 46),
(957, 'Palanas', 46),
(958, 'Pio V. Corpuz', 46),
(959, 'Placer', 46),
(960, 'San Fernando', 46),
(961, 'San Jacinto', 46),
(962, 'San Pascual', 46),
(963, 'Uson', 46),
(964, 'Caloocan', 47),
(965, 'Las Piñas', 47),
(966, 'Makati', 47),
(967, 'Malabon', 47),
(968, 'Mandaluyong', 47),
(969, 'Manila', 47),
(970, 'Marikina', 47),
(971, 'Muntinlupa', 47),
(972, 'Navotas', 47),
(973, 'Parañaque', 47),
(974, 'Pasay', 47),
(975, 'Pasig', 47),
(976, 'Quezon City', 47),
(977, 'San Juan City', 47),
(978, 'Taguig', 47),
(979, 'Valenzuela City', 47),
(980, 'Pateros', 47),
(981, 'Oroquieta City', 48),
(982, 'Ozamiz City', 48),
(983, 'Tangub City', 48),
(984, 'Aloran', 48),
(985, 'Baliangao', 48),
(986, 'Bonifacio', 48),
(987, 'Calamba', 48),
(988, 'Clarin', 48),
(989, 'Concepcion', 48),
(990, 'Don Victoriano Chiongbian', 48),
(991, 'Jimenez', 48),
(992, 'Lopez Jaena', 48),
(993, 'Panaon', 48),
(994, 'Plaridel', 48),
(995, 'Sapang Dalaga', 48),
(996, 'Sinacaban', 48),
(997, 'Tudela', 48),
(998, 'Cagayan de Oro', 49),
(999, 'Gingoog City', 49),
(1000, 'Alubijid', 49),
(1001, 'Balingasag', 49),
(1002, 'Balingoan', 49),
(1003, 'Binuangan', 49),
(1004, 'Claveria', 49),
(1005, 'El Salvador', 49),
(1006, 'Gitagum', 49),
(1007, 'Initao', 49),
(1008, 'Jasaan', 49),
(1009, 'Kinoguitan', 49),
(1010, 'Lagonglong', 49),
(1011, 'Laguindingan', 49),
(1012, 'Libertad', 49),
(1013, 'Lugait', 49),
(1014, 'Magsaysay', 49),
(1015, 'Manticao', 49),
(1016, 'Medina', 49),
(1017, 'Naawan', 49),
(1018, 'Opol', 49),
(1019, 'Salay', 49),
(1020, 'Sugbongcogon', 49),
(1021, 'Tagoloan', 49),
(1022, 'Talisayan', 49),
(1023, 'Villanueva', 49),
(1024, 'Barlig', 50),
(1025, 'Bauko', 50),
(1026, 'Besao', 50),
(1027, 'Bontoc', 50),
(1028, 'Natonin', 50),
(1029, 'Paracelis', 50),
(1030, 'Sabangan', 50),
(1031, 'Sadanga', 50),
(1032, 'Sagada', 50),
(1033, 'Tadian', 50),
(1034, 'Bacolod City', 51),
(1035, 'Bago City', 51),
(1036, 'Cadiz City', 51),
(1037, 'Escalante City', 51),
(1038, 'Himamaylan City', 51),
(1039, 'Kabankalan City', 51),
(1040, 'La Carlota City', 51),
(1041, 'Sagay City', 51),
(1042, 'San Carlos City', 51),
(1043, 'Silay City', 51),
(1044, 'Sipalay City', 51),
(1045, 'Talisay City', 51),
(1046, 'Victorias City', 51),
(1047, 'Binalbagan', 51),
(1048, 'Calatrava', 51),
(1049, 'Candoni', 51),
(1050, 'Cauayan', 51),
(1051, 'Enrique B. Magalona', 51),
(1052, 'Hinigaran', 51),
(1053, 'Hinoba-an', 51),
(1054, 'Ilog', 51),
(1055, 'Isabela', 51),
(1056, 'La Castellana', 51),
(1057, 'Manapla', 51),
(1058, 'Moises Padilla', 51),
(1059, 'Murcia', 51),
(1060, 'Pontevedra', 51),
(1061, 'Pulupandan', 51),
(1062, 'Salvador Benedicto', 51),
(1063, 'San Enrique', 51),
(1064, 'Toboso', 51),
(1065, 'Valladolid', 51),
(1066, 'Bais City', 52),
(1067, 'Bayawan City', 52),
(1068, 'Canlaon City', 52),
(1069, 'Guihulngan City', 52),
(1070, 'Dumaguete City', 52),
(1071, 'Tanjay City', 52),
(1072, 'Amlan', 52),
(1073, 'Ayungon', 52),
(1074, 'Bacong', 52),
(1075, 'Basay', 52),
(1076, 'Bindoy', 52),
(1077, 'Dauin', 52),
(1078, 'Jimalalud', 52),
(1079, 'La Libertad', 52),
(1080, 'Mabinay', 52),
(1081, 'Manjuyod', 52),
(1082, 'Pamplona', 52),
(1083, 'San Jose', 52),
(1084, 'Santa Catalina', 52),
(1085, 'Siaton', 52),
(1086, 'Sibulan', 52),
(1087, 'Tayasan', 52),
(1088, 'Valencia', 52),
(1089, 'Vallehermoso', 52),
(1090, 'Zamboanguita', 52),
(1091, 'Allen', 53),
(1092, 'Biri', 53),
(1093, 'Bobon', 53),
(1094, 'Capul', 53),
(1095, 'Catarman', 53),
(1096, 'Catubig', 53),
(1097, 'Gamay', 53),
(1098, 'Laoang', 53),
(1099, 'Lapinig', 53),
(1100, 'Las Navas', 53),
(1101, 'Lavezares', 53),
(1102, 'Lope de Vega', 53),
(1103, 'Mapanas', 53),
(1104, 'Mondragon', 53),
(1105, 'Palapag', 53),
(1106, 'Pambujan', 53),
(1107, 'Rosario', 53),
(1108, 'San Antonio', 53),
(1109, 'San Isidro', 53),
(1110, 'San Jose', 53),
(1111, 'San Roque', 53),
(1112, 'San Vicente', 53),
(1113, 'Silvino Lobos', 53),
(1114, 'Victoria', 53),
(1115, 'Cabanatuan City', 54),
(1116, 'Gapan City', 54),
(1117, 'Science City of Muñoz', 54),
(1118, 'Palayan City', 54),
(1119, 'San Jose City', 54),
(1120, 'Aliaga', 54),
(1121, 'Bongabon', 54),
(1122, 'Cabiao', 54),
(1123, 'Carranglan', 54),
(1124, 'Cuyapo', 54),
(1125, 'Gabaldon', 54),
(1126, 'General Mamerto Natividad', 54),
(1127, 'General Tinio', 54),
(1128, 'Guimba', 54),
(1129, 'Jaen', 54),
(1130, 'Laur', 54),
(1131, 'Licab', 54),
(1132, 'Llanera', 54),
(1133, 'Lupao', 54),
(1134, 'Nampicuan', 54),
(1135, 'Pantabangan', 54),
(1136, 'Peñaranda', 54),
(1137, 'Quezon', 54),
(1138, 'Rizal', 54),
(1139, 'San Antonio', 54),
(1140, 'San Isidro', 54),
(1141, 'San Leonardo', 54),
(1142, 'Santa Rosa', 54),
(1143, 'Santo Domingo', 54),
(1144, 'Talavera', 54),
(1145, 'Talugtug', 54),
(1146, 'Zaragoza', 54),
(1147, 'Alfonso Castaneda', 55),
(1148, 'Ambaguio', 55),
(1149, 'Aritao', 55),
(1150, 'Bagabag', 55),
(1151, 'Bambang', 55),
(1152, 'Bayombong', 55),
(1153, 'Diadi', 55),
(1154, 'Dupax del Norte', 55),
(1155, 'Dupax del Sur', 55),
(1156, 'Kasibu', 55),
(1157, 'Kayapa', 55),
(1158, 'Quezon', 55),
(1159, 'Santa Fe', 55),
(1160, 'Solano', 55),
(1161, 'Villaverde', 55),
(1162, 'Abra de Ilog', 56),
(1163, 'Calintaan', 56),
(1164, 'Looc', 56),
(1165, 'Lubang', 56),
(1166, 'Magsaysay', 56),
(1167, 'Mamburao', 56),
(1168, 'Paluan', 56),
(1169, 'Rizal', 56),
(1170, 'Sablayan', 56),
(1171, 'San Jose', 56),
(1172, 'Santa Cruz', 56),
(1173, 'Calapan City', 57),
(1174, 'Baco', 57),
(1175, 'Bansud', 57),
(1176, 'Bongabong', 57),
(1177, 'Bulalacao', 57),
(1178, 'Gloria', 57),
(1179, 'Mansalay', 57),
(1180, 'Naujan', 57),
(1181, 'Pinamalayan', 57),
(1182, 'Pola', 57),
(1183, 'Puerto Galera', 57),
(1184, 'Roxas', 57),
(1185, 'San Teodoro', 57),
(1186, 'Socorro', 57),
(1187, 'Victoria', 57),
(1188, 'Puerto Princesa City', 58),
(1189, 'Aborlan', 58),
(1190, 'Agutaya', 58),
(1191, 'Araceli', 58),
(1192, 'Balabac', 58),
(1193, 'Bataraza', 58),
(1194, 'Brooke''s Point', 58),
(1195, 'Busuanga', 58),
(1196, 'Cagayancillo', 58),
(1197, 'Coron', 58),
(1198, 'Culion', 58),
(1199, 'Cuyo', 58),
(1200, 'Dumaran', 58),
(1201, 'El Nido', 58),
(1202, 'Kalayaan', 58),
(1203, 'Linapacan', 58),
(1204, 'Magsaysay', 58),
(1205, 'Narra', 58),
(1206, 'Quezon', 58),
(1207, 'Rizal', 58),
(1208, 'Roxas', 58),
(1209, 'San Vicente', 58),
(1210, 'Sofronio Española', 58),
(1211, 'Taytay', 58),
(1212, 'Angeles City', 59),
(1213, 'City of San Fernando', 59),
(1214, 'Apalit', 59),
(1215, 'Arayat', 59),
(1216, 'Bacolor', 59),
(1217, 'Candaba', 59),
(1218, 'Floridablanca', 59),
(1219, 'Guagua', 59),
(1220, 'Lubao', 59),
(1221, 'Mabalacat', 59),
(1222, 'Macabebe', 59),
(1223, 'Magalang', 59),
(1224, 'Masantol', 59),
(1225, 'Mexico', 59),
(1226, 'Minalin', 59),
(1227, 'Porac', 59),
(1228, 'San Luis', 59),
(1229, 'San Simon', 59),
(1230, 'Santa Ana', 59),
(1231, 'Santa Rita', 59),
(1232, 'Santo Tomas', 59),
(1233, 'Sasmuan', 59),
(1234, 'Alaminos City', 60),
(1235, 'Dagupan City', 60),
(1236, 'San Carlos City', 60),
(1237, 'Urdaneta City', 60),
(1238, 'Agno', 60),
(1239, 'Aguilar', 60),
(1240, 'Alcala', 60),
(1241, 'Anda', 60),
(1242, 'Asingan', 60),
(1243, 'Balungao', 60),
(1244, 'Bani', 60),
(1245, 'Basista', 60),
(1246, 'Bautista', 60),
(1247, 'Bayambang', 60),
(1248, 'Binalonan', 60),
(1249, 'Binmaley', 60),
(1250, 'Bolinao', 60),
(1251, 'Bugallon', 60),
(1252, 'Burgos', 60),
(1253, 'Calasiao', 60),
(1254, 'Dasol', 60),
(1255, 'Infanta', 60),
(1256, 'Labrador', 60),
(1257, 'Laoac', 60),
(1258, 'Lingayen', 60),
(1259, 'Mabini', 60),
(1260, 'Malasiqui', 60),
(1261, 'Manaoag', 60),
(1262, 'Mangaldan', 60),
(1263, 'Mangatarem', 60),
(1264, 'Mapandan', 60),
(1265, 'Natividad', 60),
(1266, 'Pozzorubio', 60),
(1267, 'Rosales', 60),
(1268, 'San Fabian', 60),
(1269, 'San Jacinto', 60),
(1270, 'San Manuel', 60),
(1271, 'San Nicolas', 60),
(1272, 'San Quintin', 60),
(1273, 'Santa Barbara', 60),
(1274, 'Santa Maria', 60),
(1275, 'Santo Tomas', 60),
(1276, 'Sison', 60),
(1277, 'Sual', 60),
(1278, 'Tayug', 60),
(1279, 'Umingan', 60),
(1280, 'Urbiztondo', 60),
(1281, 'Villasis', 60),
(1282, 'Lucena City', 61),
(1283, 'Tayabas City', 61),
(1284, 'Agdangan', 61),
(1285, 'Alabat', 61),
(1286, 'Atimonan', 61),
(1287, 'Buenavista', 61),
(1288, 'Burdeos', 61),
(1289, 'Calauag', 61),
(1290, 'Candelaria', 61),
(1291, 'Catanauan', 61),
(1292, 'Dolores', 61),
(1293, 'General Luna', 61),
(1294, 'General Nakar', 61),
(1295, 'Guinayangan', 61),
(1296, 'Gumaca', 61),
(1297, 'Infanta', 61),
(1298, 'Jomalig', 61),
(1299, 'Lopez', 61),
(1300, 'Lucban', 61),
(1301, 'Macalelon', 61),
(1302, 'Mauban', 61),
(1303, 'Mulanay', 61),
(1304, 'Padre Burgos', 61),
(1305, 'Pagbilao', 61),
(1306, 'Panukulan', 61),
(1307, 'Patnanungan', 61),
(1308, 'Perez', 61),
(1309, 'Pitogo', 61),
(1310, 'Plaridel', 61),
(1311, 'Polillo', 61),
(1312, 'Quezon', 61),
(1313, 'Real', 61),
(1314, 'Sampaloc', 61),
(1315, 'San Andres', 61),
(1316, 'San Antonio', 61),
(1317, 'San Francisco', 61),
(1318, 'San Narciso', 61),
(1319, 'Sariaya', 61),
(1320, 'Tagkawayan', 61),
(1321, 'Tiaong', 61),
(1322, 'Unisan', 61),
(1323, 'Aglipay', 62),
(1324, 'Cabarroguis', 62),
(1325, 'Diffun', 62),
(1326, 'Maddela', 62),
(1327, 'Nagtipunan', 62),
(1328, 'Saguday', 62),
(1329, 'Antipolo City', 63),
(1330, 'Angono', 63),
(1331, 'Baras', 63),
(1332, 'Binangonan', 63),
(1333, 'Cainta', 63),
(1334, 'Cardona', 63),
(1335, 'Jalajala', 63),
(1336, 'Morong', 63),
(1337, 'Pililla', 63),
(1338, 'Rodriguez', 63),
(1339, 'San Mateo', 63),
(1340, 'Tanay', 63),
(1341, 'Taytay', 63),
(1342, 'Teresa', 63),
(1343, 'Alcantara', 64),
(1344, 'Banton', 64),
(1345, 'Cajidiocan', 64),
(1346, 'Calatrava', 64),
(1347, 'Concepcion', 64),
(1348, 'Corcuera', 64),
(1349, 'Ferrol', 64),
(1350, 'Looc', 64),
(1351, 'Magdiwang', 64),
(1352, 'Odiongan', 64),
(1353, 'Romblon', 64),
(1354, 'San Agustin', 64),
(1355, 'San Andres', 64),
(1356, 'San Fernando', 64),
(1357, 'San Jose', 64),
(1358, 'Santa Fe', 64),
(1359, 'Santa Maria', 64),
(1360, 'Calbayog City', 65),
(1361, 'Catbalogan City', 65),
(1362, 'Almagro', 65),
(1363, 'Basey', 65),
(1364, 'Calbiga', 65),
(1365, 'Daram', 65),
(1366, 'Gandara', 65),
(1367, 'Hinabangan', 65),
(1368, 'Jiabong', 65),
(1369, 'Marabut', 65),
(1370, 'Matuguinao', 65),
(1371, 'Motiong', 65),
(1372, 'Pagsanghan', 65),
(1373, 'Paranas', 65),
(1374, 'Pinabacdao', 65),
(1375, 'San Jorge', 65),
(1376, 'San Jose De Buan', 65),
(1377, 'San Sebastian', 65),
(1378, 'Santa Margarita', 65),
(1379, 'Santa Rita', 65),
(1380, 'Santo Niño', 65),
(1381, 'Tagapul-an', 65),
(1382, 'Talalora', 65),
(1383, 'Tarangnan', 65),
(1384, 'Villareal', 65),
(1385, 'Zumarraga', 65),
(1386, 'Alabel', 66),
(1387, 'Glan', 66),
(1388, 'Kiamba', 66),
(1389, 'Maasim', 66),
(1390, 'Maitum', 66),
(1391, 'Malapatan', 66),
(1392, 'Malungon', 66),
(1393, 'Enrique Villanueva', 67),
(1394, 'Larena', 67),
(1395, 'Lazi', 67),
(1396, 'Maria', 67),
(1397, 'San Juan', 67),
(1398, 'Siquijor', 67),
(1399, 'Sorsogon City', 68),
(1400, 'Barcelona', 68),
(1401, 'Bulan', 68),
(1402, 'Bulusan', 68),
(1403, 'Casiguran', 68),
(1404, 'Castilla', 68),
(1405, 'Donsol', 68),
(1406, 'Gubat', 68),
(1407, 'Irosin', 68),
(1408, 'Juban', 68),
(1409, 'Magallanes', 68),
(1410, 'Matnog', 68),
(1411, 'Pilar', 68),
(1412, 'Prieto Diaz', 68),
(1413, 'Santa Magdalena', 68),
(1414, 'General Santos City', 69),
(1415, 'Koronadal City', 69),
(1416, 'Banga', 69),
(1417, 'Lake Sebu', 69),
(1418, 'Norala', 69),
(1419, 'Polomolok', 69),
(1420, 'Santo Niño', 69),
(1421, 'Surallah', 69),
(1422, 'T''boli', 69),
(1423, 'Tampakan', 69),
(1424, 'Tantangan', 69),
(1425, 'Tupi', 69),
(1426, 'Maasin City', 70),
(1427, 'Anahawan', 70),
(1428, 'Bontoc', 70),
(1429, 'Hinunangan', 70),
(1430, 'Hinundayan', 70),
(1431, 'Libagon', 70),
(1432, 'Liloan', 70),
(1433, 'Limasawa', 70),
(1434, 'Macrohon', 70),
(1435, 'Malitbog', 70),
(1436, 'Padre Burgos', 70),
(1437, 'Pintuyan', 70),
(1438, 'Saint Bernard', 70),
(1439, 'San Francisco', 70),
(1440, 'San Juan', 70),
(1441, 'San Ricardo', 70),
(1442, 'Silago', 70),
(1443, 'Sogod', 70),
(1444, 'Tomas Oppus', 70),
(1445, 'Tacurong City', 71),
(1446, 'Bagumbayan', 71),
(1447, 'Columbio', 71),
(1448, 'Esperanza', 71),
(1449, 'Isulan', 71),
(1450, 'Kalamansig', 71),
(1451, 'Lambayong', 71),
(1452, 'Lebak', 71),
(1453, 'Lutayan', 71),
(1454, 'Palimbang', 71),
(1455, 'President Quirino', 71),
(1456, 'Senator Ninoy Aquino', 71),
(1457, 'Banguingui', 72),
(1458, 'Hadji Panglima Tahil', 72),
(1459, 'Indanan', 72),
(1460, 'Jolo', 72),
(1461, 'Kalingalan Caluang', 72),
(1462, 'Lugus', 72),
(1463, 'Luuk', 72),
(1464, 'Maimbung', 72),
(1465, 'Old Panamao', 72),
(1466, 'Omar', 72),
(1467, 'Pandami', 72),
(1468, 'Panglima Estino', 72),
(1469, 'Pangutaran', 72),
(1470, 'Parang', 72),
(1471, 'Pata', 72),
(1472, 'Patikul', 72),
(1473, 'Siasi', 72),
(1474, 'Talipao', 72),
(1475, 'Tapul', 72),
(1476, 'Surigao City', 73),
(1477, 'Alegria', 73),
(1478, 'Bacuag', 73),
(1479, 'Basilisa', 73),
(1480, 'Burgos', 73),
(1481, 'Cagdianao', 73),
(1482, 'Claver', 73),
(1483, 'Dapa', 73),
(1484, 'Del Carmen', 73),
(1485, 'Dinagat', 73),
(1486, 'General Luna', 73),
(1487, 'Gigaquit', 73),
(1488, 'Libjo', 73),
(1489, 'Loreto', 73),
(1490, 'Mainit', 73),
(1491, 'Malimono', 73),
(1492, 'Pilar', 73),
(1493, 'Placer', 73),
(1494, 'San Benito', 73),
(1495, 'San Francisco', 73),
(1496, 'San Isidro', 73),
(1497, 'San Jose', 73),
(1498, 'Santa Monica', 73),
(1499, 'Sison', 73),
(1500, 'Socorro', 73),
(1501, 'Tagana-an', 73),
(1502, 'Tubajon', 73),
(1503, 'Tubod', 73),
(1504, 'Bislig City', 74),
(1505, 'Tandag City', 74),
(1506, 'Barobo', 74),
(1507, 'Bayabas', 74),
(1508, 'Cagwait', 74),
(1509, 'Cantilan', 74),
(1510, 'Carmen', 74),
(1511, 'Carrascal', 74),
(1512, 'Cortes', 74),
(1513, 'Hinatuan', 74),
(1514, 'Lanuza', 74),
(1515, 'Lianga', 74),
(1516, 'Lingig', 74),
(1517, 'Madrid', 74),
(1518, 'Marihatag', 74),
(1519, 'San Agustin', 74),
(1520, 'San Miguel', 74),
(1521, 'Tagbina', 74),
(1522, 'Tago', 74),
(1523, 'Tarlac City', 75),
(1524, 'Anao', 75),
(1525, 'Bamban', 75),
(1526, 'Camiling', 75),
(1527, 'Capas', 75),
(1528, 'Concepcion', 75),
(1529, 'Gerona', 75),
(1530, 'La Paz', 75),
(1531, 'Mayantoc', 75),
(1532, 'Moncada', 75),
(1533, 'Paniqui', 75),
(1534, 'Pura', 75),
(1535, 'Ramos', 75),
(1536, 'San Clemente', 75),
(1537, 'San Jose', 75),
(1538, 'San Manuel', 75),
(1539, 'Santa Ignacia', 75),
(1540, 'Victoria', 75),
(1541, 'Bongao', 76),
(1542, 'Languyan', 76),
(1543, 'Mapun', 76),
(1544, 'Panglima Sugala', 76),
(1545, 'Sapa-Sapa', 76),
(1546, 'Sibutu', 76),
(1547, 'Simunul', 76),
(1548, 'Sitangkai', 76),
(1549, 'South Ubian', 76),
(1550, 'Tandubas', 76),
(1551, 'Turtle Islands', 76),
(1552, 'Olongapo City', 77),
(1553, 'Botolan', 77),
(1554, 'Cabangan', 77),
(1555, 'Candelaria', 77),
(1556, 'Castillejos', 77),
(1557, 'Iba', 77),
(1558, 'Masinloc', 77),
(1559, 'Palauig', 77),
(1560, 'San Antonio', 77),
(1561, 'San Felipe', 77),
(1562, 'San Marcelino', 77),
(1563, 'San Narciso', 77),
(1564, 'Santa Cruz', 77),
(1565, 'Subic', 77),
(1566, 'Dapitan City', 78),
(1567, 'Dipolog City', 78),
(1568, 'Bacungan', 78),
(1569, 'Baliguian', 78),
(1570, 'Godod', 78),
(1571, 'Gutalac', 78),
(1572, 'Jose Dalman', 78),
(1573, 'Kalawit', 78),
(1574, 'Katipunan', 78),
(1575, 'La Libertad', 78),
(1576, 'Labason', 78),
(1577, 'Liloy', 78),
(1578, 'Manukan', 78),
(1579, 'Mutia', 78),
(1580, 'Piñan', 78),
(1581, 'Polanco', 78),
(1582, 'President Manuel A. Roxas', 78),
(1583, 'Rizal', 78),
(1584, 'Salug', 78),
(1585, 'Sergio Osmeña Sr.', 78),
(1586, 'Siayan', 78),
(1587, 'Sibuco', 78),
(1588, 'Sibutad', 78),
(1589, 'Sindangan', 78),
(1590, 'Siocon', 78),
(1591, 'Sirawai', 78),
(1592, 'Tampilisan', 78),
(1593, 'Pagadian City', 79),
(1594, 'Zamboanga City', 79),
(1595, 'Aurora', 79),
(1596, 'Bayog', 79),
(1597, 'Dimataling', 79),
(1598, 'Dinas', 79),
(1599, 'Dumalinao', 79),
(1600, 'Dumingag', 79),
(1601, 'Guipos', 79),
(1602, 'Josefina', 79),
(1603, 'Kumalarang', 79),
(1604, 'Labangan', 79),
(1605, 'Lakewood', 79),
(1606, 'Lapuyan', 79),
(1607, 'Mahayag', 79),
(1608, 'Margosatubig', 79),
(1609, 'Midsalip', 79),
(1610, 'Molave', 79),
(1611, 'Pitogo', 79),
(1612, 'Ramon Magsaysay', 79),
(1613, 'San Miguel', 79),
(1614, 'San Pablo', 79),
(1615, 'Sominot', 79),
(1616, 'Tabina', 79),
(1617, 'Tambulig', 79),
(1618, 'Tigbao', 79),
(1619, 'Tukuran', 79),
(1620, 'Vincenzo A. Sagun', 79),
(1621, 'Alicia', 80),
(1622, 'Buug', 80),
(1623, 'Diplahan', 80),
(1624, 'Imelda', 80),
(1625, 'Ipil', 80),
(1626, 'Kabasalan', 80),
(1627, 'Mabuhay', 80),
(1628, 'Malangas', 80),
(1629, 'Naga', 80),
(1630, 'Olutanga', 80),
(1631, 'Payao', 80),
(1632, 'Roseller Lim', 80),
(1633, 'Siay', 80),
(1634, 'Talusan', 80),
(1635, 'Titay', 80),
(1636, 'Tungawan', 80);

-- --------------------------------------------------------

--
-- Table structure for table `classifications`
--

CREATE TABLE IF NOT EXISTS `classifications` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `classification` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `classifications`
--

INSERT INTO `classifications` (`id`, `classification`, `description`, `created_at`, `updated_at`) VALUES
(1, 'NEW CONSTRUCTION', '', '2015-07-01 19:39:11', '2015-07-01 19:39:11'),
(2, 'REPAINTING', '', '2015-07-01 19:39:22', '2015-07-01 19:39:22');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE IF NOT EXISTS `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city_id` int(10) unsigned NOT NULL,
  `province_id` int(10) unsigned NOT NULL,
  `region` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street2` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id2` int(10) NOT NULL,
  `province_id2` int(10) NOT NULL,
  `region2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street3` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `city_id3` int(10) NOT NULL,
  `province_id3` int(10) NOT NULL,
  `region3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_number2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `telephone_number3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `status` int(5) NOT NULL,
  `notif` float NOT NULL,
  `notif_dt` datetime NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `companies_type_id_foreign` (`type_id`),
  KEY `companies_city_id_foreign` (`city_id`),
  KEY `companies_province_id_foreign` (`province_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `type_id`, `street`, `city_id`, `province_id`, `region`, `country`, `zip_code`, `street2`, `city_id2`, `province_id2`, `region2`, `country2`, `zip_code2`, `street3`, `city_id3`, `province_id3`, `region3`, `country3`, `zip_code3`, `telephone_number`, `fax_number`, `mobile_number`, `email`, `telephone_number2`, `fax_number2`, `mobile_number2`, `email2`, `telephone_number3`, `fax_number3`, `mobile_number3`, `email3`, `remarks`, `status`, `notif`, `notif_dt`, `created_by`, `approved_by`, `created_at`, `updated_at`) VALUES
(1, 'MDC', 2, '123 LEGAZPI VILLAGE', 966, 0, 'NCR', 'PHILIIPPINES', '1124', '', 0, 0, '', '', '', '', 0, 0, '', '', '', '952-72-85', 'MDC-123456', '09091234567', 'MARKETING@MDC.COM.PH', '', '', '', '', '', '', '', '', '', 2, 2, '0000-00-00 00:00:00', 2, 8, '2015-09-20 18:39:08', '2015-09-20 18:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `company_status`
--

CREATE TABLE IF NOT EXISTS `company_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `update` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `access` int(4) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `company_status`
--

INSERT INTO `company_status` (`id`, `company_id`, `user_id`, `update`, `created_by`, `access`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'CREATE MDC IN COMPANY RECORD', 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 8, 'APPROVED THE REQUEST FOR MDC', 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` int(10) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `category` int(10) NOT NULL,
  `company` int(10) unsigned NOT NULL,
  `street` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `street_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `city_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `province_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `country_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code_2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `approved_by` int(10) NOT NULL,
  `status` int(5) NOT NULL,
  `notif` float NOT NULL,
  `notif_dt` datetime NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `contacts_created_by_foreign` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `position`, `fullname`, `gender`, `category`, `company`, `street`, `city`, `province`, `country`, `zip_code`, `street_2`, `city_2`, `province_2`, `country_2`, `zip_code_2`, `contact_number`, `contact_number2`, `contact_number3`, `remarks`, `created_by`, `approved_by`, `status`, `notif`, `notif_dt`, `created_at`, `updated_at`) VALUES
(1, 7, 'ANTHONY JADE SALCEDO', 'MALE', 2, 0, '255 TIERRA VERA SUBDIVISION DILIMAN', 'QUEZON CITY', '', 'PHILIPPINES', '1121', '255 TIERRA VERA SUBDIVISION DILIMAN', 'QUEZON CITY', '', 'PHILIPPINES', '1121', '09262554210', '', '', '', 2, 8, 2, 2, '0000-00-00 00:00:00', '2015-09-20 18:41:18', '2015-09-20 18:49:01'),
(2, 10, 'PETER HANS LEE', 'MALE', 1, 1, '123 LEGAZPI VILLAGE', 'MAKATI', '0', 'PHILIIPPINES', '1124', '', '', '', '', '', '09262554210', '', '', '', 2, 8, 2, 2, '0000-00-00 00:00:00', '2015-09-20 18:48:13', '2015-09-20 18:48:41');

-- --------------------------------------------------------

--
-- Table structure for table `contact_status`
--

CREATE TABLE IF NOT EXISTS `contact_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `update` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `access` int(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `contact_status`
--

INSERT INTO `contact_status` (`id`, `contact_id`, `user_id`, `update`, `created_by`, `access`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'CREATE ANTHONY JADE SALCEDO IN CONTACTS RECORD', 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 2, 2, 'CREATE PETER HANS LEE IN CONTACTS RECORD', 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 2, 8, 'APPROVED THE REQUEST FOR PETER HANS LEE', 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 8, 'APPROVED THE REQUEST FOR ANTHONY JADE SALCEDO', 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `dealer_supplier`
--

CREATE TABLE IF NOT EXISTS `dealer_supplier` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `dealer_supplier_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `department` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department`, `created_at`, `updated_at`) VALUES
(1, 'ADMINISTRATOR DEPARTMENT', '2015-07-02 02:00:00', '2015-07-02 02:00:00'),
(2, 'MARKETING DEPARTMENT', '2015-07-01 19:47:50', '2015-07-01 19:47:50'),
(3, 'CUSTOMER CARE DEPARTMENT', '2015-07-01 19:48:04', '2015-07-01 19:48:04'),
(4, 'ACCOUNTING DEPARTMENT', '2015-07-01 19:48:19', '2015-07-01 19:48:19');

-- --------------------------------------------------------

--
-- Table structure for table `developer`
--

CREATE TABLE IF NOT EXISTS `developer` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `developer_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `gencon`
--

CREATE TABLE IF NOT EXISTS `gencon` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `gencon_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item`, `created_at`, `updated_at`) VALUES
(1, 'T-SHIRTS', '2015-07-01 19:53:48', '2015-07-01 19:53:48'),
(2, 'PAINTINGS', '2015-07-01 19:53:59', '2015-07-01 19:53:59'),
(3, 'CALLING CARDS', '2015-07-01 19:54:13', '2015-07-01 19:54:13'),
(4, 'PAINT BROCHURES', '2015-07-01 19:54:30', '2015-07-01 19:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2015_04_14_080731_create_users', 1),
('2015_04_14_082220_create_users', 2),
('2015_04_14_082547_create_users', 3),
('2015_04_28_072218_confide_setup_users_table', 4),
('2015_04_28_073302_confide_setup_users_table', 5),
('2015_04_30_022454_entrust_setup_tables', 6),
('2015_04_30_093555_create_contacts', 7),
('2015_05_05_053213_create_departments', 8),
('2015_05_05_053601_create_departments', 9),
('2015_05_07_054640_create_states_table', 10),
('2015_05_07_054824_create_provinces_table', 11),
('2015_05_07_055644_create_cities_table', 12),
('2015_05_11_070503_create_types_table', 12),
('2015_05_12_054352_create_areas_table', 13),
('2015_05_12_090304_create_items_table', 14),
('2015_05_13_054015_add_fields_on_Users_Table', 15),
('2015_05_13_075328_add_department_in_users_table', 16),
('2015_05_18_052848_create_contact_status_table', 17),
('2015_05_18_054355_create_contacts_table', 18),
('2015_05_18_065411_create_contactlist_status_table', 19),
('2015_05_19_094423_create_companies_table', 20),
('2015_05_20_065654_create_company_status_table', 21),
('2015_06_01_033413_create_assigned_areas_table', 22),
('2015_06_01_072508_add_fields_in_types_table', 23),
('2015_06_08_055348_create_project_classifications_table', 24),
('2015_06_08_055348_create_classifications_table', 25),
('2015_06_08_064705_create_categories_table', 25),
('2015_06_09_022723_create_stages_table', 26),
('2015_06_09_030009_create_status_table', 27),
('2015_06_10_052944_create_project_status_table', 28),
('2015_06_10_053351_create_projects_table', 29),
('2015_06_15_103346_create_project_images_table', 30),
('2015_06_16_070139_create_project_image_states_table', 31),
('2015_07_07_013057_create_positions_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `mytask_forcompany`
--

CREATE TABLE IF NOT EXISTS `mytask_forcompany` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `company_id` int(10) NOT NULL,
  `task_id` int(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `status` int(4) NOT NULL,
  `approved_request` int(4) NOT NULL,
  `final_amount` double(10,2) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `comments` varchar(250) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `mytask_forcompany`
--

INSERT INTO `mytask_forcompany` (`id`, `company_id`, `task_id`, `amount`, `remarks`, `status`, `approved_request`, `final_amount`, `date_start`, `date_end`, `comments`, `created_by`, `approved_by`, `date_created`, `time_created`) VALUES
(1, 1, 4, 2500.00, 'testing of unit on-site.', 2, 2, 2000.00, '2015-09-25', '2015-09-27', '', 2, 3, '2015-09-23', '01:02:45'),
(2, 1, 3, 275.00, 'ON-SITE CLIENT IN TRINOMA MALL FOR 2 DAYS.', 2, 2, 300.00, '2015-09-24', '2015-09-25', '', 2, 5, '2015-09-28', '22:16:16'),
(3, 1, 4, 2.00, 'for testing only.', 1, 0, 0.00, '2015-09-28', '2015-09-28', '', 2, 0, '2015-09-28', '00:10:55'),
(4, 1, 4, 20.00, 'test company.', 2, 2, 200.00, '2015-09-28', '2015-09-28', '', 2, 3, '2015-09-28', '01:54:22');

-- --------------------------------------------------------

--
-- Table structure for table `mytask_forcontact`
--

CREATE TABLE IF NOT EXISTS `mytask_forcontact` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) NOT NULL,
  `task_id` int(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `status` int(4) NOT NULL,
  `approved_request` int(4) NOT NULL,
  `final_amount` double(10,2) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `created_by` int(10) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `approved_by` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mytask_forcontact`
--

INSERT INTO `mytask_forcontact` (`id`, `contact_id`, `task_id`, `amount`, `remarks`, `status`, `approved_request`, `final_amount`, `comments`, `created_by`, `date_start`, `date_end`, `approved_by`, `date_created`, `time_created`) VALUES
(2, 2, 4, 1000.00, 'for test only.', 2, 1, 1000.00, 'ok', 5, '2015-09-23', '2015-09-25', 2, '2015-09-22', '22:57:07'),
(3, 1, 1, 1000.00, 'budget in on-site client in baguio.', 2, 2, 750.00, '', 2, '2015-09-25', '2015-10-02', 8, '2015-09-23', '23:06:18'),
(4, 1, 1, 1500.00, 'BUDGET FOR PAINT BRUSH\r\n\r\nATTACHED(LIST OF PAINT BRUSH).', 1, 1, 0.00, '', 2, '2015-09-25', '2015-09-26', 8, '2015-09-24', '01:46:36'),
(5, 2, 4, 10.00, 'test contact.', 2, 2, 100.00, '', 2, '2015-09-28', '2015-09-28', 3, '2015-09-28', '01:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `mytask_forothers`
--

CREATE TABLE IF NOT EXISTS `mytask_forothers` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `status` int(4) NOT NULL,
  `approved_request` int(5) NOT NULL,
  `final_amount` double(10,2) NOT NULL,
  `comment` varchar(250) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mytask_forothers`
--

INSERT INTO `mytask_forothers` (`id`, `task_id`, `amount`, `remarks`, `date_start`, `date_end`, `status`, `approved_request`, `final_amount`, `comment`, `created_by`, `approved_by`, `date_created`, `time_created`) VALUES
(1, 4, 150.00, 'test of others.', '2015-09-25', '2015-09-25', 1, 0, 0.00, '', 7, 0, '2015-09-23', '04:32:09'),
(2, 1, 1500.00, 'used for buy materials.', '2015-09-25', '2015-09-25', 2, 2, 2000.00, '', 2, 8, '2015-09-24', '22:50:22'),
(3, 4, 15000.00, 'CHASE ANNIVERSARY.\r\n\r\nATTACHED.\r\n-LIST OF ALL REQUIREMENTS THAT WE NEEDED FOR SETUP THE PARTY.', '2015-09-30', '2015-09-30', 2, 2, 25000.00, '', 2, 3, '2015-09-28', '23:45:05'),
(4, 4, 10.00, 'for test only.', '2015-09-28', '2015-09-28', 2, 2, 0.00, '', 2, 3, '2015-09-28', '00:05:30'),
(5, 4, 40.00, 'test others.', '2015-09-28', '2015-09-28', 2, 2, 4000.00, '', 2, 3, '2015-09-28', '02:50:39');

-- --------------------------------------------------------

--
-- Table structure for table `mytask_forproject`
--

CREATE TABLE IF NOT EXISTS `mytask_forproject` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `task_id` int(10) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `remarks` varchar(250) NOT NULL,
  `status` int(4) NOT NULL,
  `approved_request` int(5) NOT NULL,
  `final_amount` double(10,2) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `comments` varchar(250) NOT NULL,
  `created_by` int(10) NOT NULL,
  `approved_by` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `mytask_forproject`
--

INSERT INTO `mytask_forproject` (`id`, `project_id`, `task_id`, `amount`, `remarks`, `status`, `approved_request`, `final_amount`, `date_start`, `date_end`, `comments`, `created_by`, `approved_by`, `date_created`, `time_created`) VALUES
(1, 1, 3, 200.00, 'for onsite testing.', 2, 2, 250.00, '2015-09-24', '2015-09-25', '', 2, 5, '2015-09-23', '02:36:44'),
(2, 1, 2, 200.00, 'FROM CHASE TO TRINOMA.', 2, 2, 250.00, '2015-09-28', '2015-09-28', '', 2, 6, '2015-09-28', '23:01:21'),
(3, 1, 4, 30.00, 'testing project.', 2, 2, 3000.00, '2015-09-28', '2015-09-28', '', 2, 3, '2015-09-28', '02:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `password_reminders`
--

CREATE TABLE IF NOT EXISTS `password_reminders` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE IF NOT EXISTS `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `permission_role_permission_id_foreign` (`permission_id`),
  KEY `permission_role_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE IF NOT EXISTS `positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `position`, `created_at`, `updated_at`) VALUES
(1, 'CHIEF EXECUTIVE OFFICER', '2015-07-06 18:30:55', '2015-07-06 18:30:55'),
(2, 'CHIEF OPERATIONS OFFICER', '2015-07-06 18:31:22', '2015-07-06 18:31:22'),
(3, 'ENGINEER', '2015-07-06 18:31:40', '2015-07-06 18:31:40'),
(5, 'INTERIOR DESIGNER', '2015-07-06 18:32:35', '2015-07-06 18:32:35'),
(6, 'ACCOUNTANT', '2015-07-06 18:32:52', '2015-07-06 18:44:23'),
(7, 'ARCHITECT', '2015-07-06 18:46:47', '2015-07-06 18:46:47'),
(8, 'PROJECT DEVELOPER', '2015-07-07 19:06:03', '2015-07-07 19:06:03'),
(9, 'GENERAL CONTRACTOR', '2015-07-07 19:06:19', '2015-07-07 19:06:19'),
(10, 'PROJECT MANAGER OR DESIGNER', '2015-07-07 19:06:44', '2015-07-07 19:06:44'),
(11, 'PROJECT APPLICATOR', '2015-07-07 19:07:04', '2015-07-07 19:07:04'),
(12, 'DEALER OR SUPPLIER', '2015-07-07 19:07:21', '2015-07-07 19:07:21'),
(14, 'SUB - GENERAL CONTRACTOR', '2015-08-10 21:55:37', '2015-08-10 21:55:37'),
(17, 'SUB - PROJECT APPLICATOR', '2015-08-10 21:56:37', '2015-08-10 21:56:37'),
(18, 'SUB - DEALER OR SUPPLIER', '2015-08-10 21:56:55', '2015-08-10 21:56:55');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date_reported` date NOT NULL,
  `bdo_id` int(10) unsigned NOT NULL,
  `area_id` int(10) unsigned NOT NULL,
  `project_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `project_owner` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `city` int(10) NOT NULL,
  `province` int(10) NOT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `developer` int(10) unsigned NOT NULL,
  `sub_developer` int(10) NOT NULL,
  `general_contractor` int(10) unsigned NOT NULL,
  `sub_general_contractor` int(10) NOT NULL,
  `project_mgr_designer` int(10) unsigned NOT NULL,
  `sub_project_mgr_designer` int(10) NOT NULL,
  `architect` int(10) unsigned NOT NULL,
  `sub_architect` int(10) NOT NULL,
  `applicator` int(10) unsigned NOT NULL,
  `sub_applicator` int(10) NOT NULL,
  `dealer_supplier` int(10) unsigned NOT NULL,
  `sub_dealer_supplier` int(10) NOT NULL,
  `project_classification` int(10) unsigned NOT NULL,
  `project_category` int(10) unsigned NOT NULL,
  `project_stage` int(10) unsigned NOT NULL,
  `project_status` int(10) unsigned NOT NULL,
  `project_details` text COLLATE utf8_unicode_ci NOT NULL,
  `painting_dtstart` date NOT NULL,
  `painting_dtend` date NOT NULL,
  `painting_specification` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_specification_2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_specification_3` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `paints` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_requirement` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_cost` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `paints2` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_requirement2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_cost2` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `paints3` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `area3` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_requirement3` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `painting_cost3` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `notif` int(11) NOT NULL,
  `notif_dt` date NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `approved_by` int(10) unsigned NOT NULL,
  `remarks` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `status_forthread` int(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `projects_project_classification_foreign` (`project_classification`),
  KEY `projects_project_category_foreign` (`project_category`),
  KEY `projects_project_stage_foreign` (`project_stage`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `date_reported`, `bdo_id`, `area_id`, `project_name`, `project_owner`, `street`, `city`, `province`, `country`, `zip_code`, `developer`, `sub_developer`, `general_contractor`, `sub_general_contractor`, `project_mgr_designer`, `sub_project_mgr_designer`, `architect`, `sub_architect`, `applicator`, `sub_applicator`, `dealer_supplier`, `sub_dealer_supplier`, `project_classification`, `project_category`, `project_stage`, `project_status`, `project_details`, `painting_dtstart`, `painting_dtend`, `painting_specification`, `painting_specification_2`, `painting_specification_3`, `paints`, `area`, `painting_requirement`, `painting_cost`, `paints2`, `area2`, `painting_requirement2`, `painting_cost2`, `paints3`, `area3`, `painting_requirement3`, `painting_cost3`, `status`, `notif`, `notif_dt`, `created_by`, `approved_by`, `remarks`, `created_at`, `updated_at`, `status_forthread`) VALUES
(1, '2015-09-21', 2, 1, 'TRINOMA LEFT WING AND ANNEX MALL', 'LANDMARK CORPORATION', '1 TRINOMA MALL', 976, 0, 'PHILIIPPINES', '1121', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 3, 2, 0, 'WRITE DETAILS HERE.', '0000-00-00', '0000-00-00', 'N/A', 'N/A', 'N/A', '', '', '', '', '', '', '', '', '', '', '', '', 0, 2, '0000-00-00', 2, 8, '', '2015-09-20 18:55:38', '2015-09-20 19:03:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `project_files`
--

CREATE TABLE IF NOT EXISTS `project_files` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `file` varchar(250) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project_files`
--

INSERT INTO `project_files` (`id`, `user_id`, `project_id`, `file`, `status`) VALUES
(1, 2, 1, 'Warehouse and Cold Storage grouping.xls', 0);

-- --------------------------------------------------------

--
-- Table structure for table `project_images`
--

CREATE TABLE IF NOT EXISTS `project_images` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `project_id` int(10) NOT NULL,
  `image` varchar(150) NOT NULL,
  `status` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_image_states`
--

CREATE TABLE IF NOT EXISTS `project_image_states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project_image_states`
--

INSERT INTO `project_image_states` (`id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'Before Painting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'During Painting', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'After Painting', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_mgr_designer`
--

CREATE TABLE IF NOT EXISTS `project_mgr_designer` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `project_mgr_designer_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project_mgr_designer`
--

INSERT INTO `project_mgr_designer` (`id`, `project_id`, `user_id`, `project_mgr_designer_id`, `status`, `date_created`, `time_created`) VALUES
(1, 1, 2, 2, 2, '2015-09-21', '22:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `project_status`
--

CREATE TABLE IF NOT EXISTS `project_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `update` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `access` int(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_status`
--

INSERT INTO `project_status` (`id`, `project_id`, `user_id`, `update`, `created_by`, `access`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'CREATE TRINOMA LEFT WING AND ANNEX MALL IN PROJECT RECORD', 2, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 8, 'APPROVED THE REQUEST FOR TRINOMA LEFT WING AND ANNEX MALL', 2, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_thread`
--

CREATE TABLE IF NOT EXISTS `project_thread` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `proj_id` int(10) NOT NULL,
  `remarks` text NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `returned` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `project_thread`
--

INSERT INTO `project_thread` (`id`, `user_id`, `proj_id`, `remarks`, `date_created`, `time_created`, `returned`) VALUES
(1, 2, 1, 'test only', '2015-09-21', '23:01:07', 2),
(2, 2, 1, 'test only', '2015-09-21', '23:03:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `project_thread_file`
--

CREATE TABLE IF NOT EXISTS `project_thread_file` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `proj_id` int(10) NOT NULL,
  `proj_thread_id` int(10) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `project_thread_file`
--

INSERT INTO `project_thread_file` (`id`, `user_id`, `proj_id`, `proj_thread_id`, `filename`, `datetime_created`) VALUES
(1, 2, 1, 2, 'screenshots.docx', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `project_thread_image`
--

CREATE TABLE IF NOT EXISTS `project_thread_image` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `proj_id` int(10) NOT NULL,
  `proj_thread_id` int(10) NOT NULL,
  `filename` varchar(150) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `project_users`
--

CREATE TABLE IF NOT EXISTS `project_users` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `created_by` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `project_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `status_forthread` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `project_users`
--

INSERT INTO `project_users` (`id`, `created_by`, `user_id`, `name`, `project_id`, `status`, `status_forthread`) VALUES
(1, 2, 2, '', 1, 0, 1),
(2, 2, 2, '', 1, 0, 1),
(3, 2, 2, '', 1, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `provinces_state_id_foreign` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=81 ;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `province`, `state_id`) VALUES
(0, '0', 1),
(1, 'Abra', 1),
(2, 'Agusan del Norte', 3),
(3, 'Agusan del Sur', 3),
(4, 'Aklan', 2),
(5, 'Albay', 1),
(6, 'Antique', 2),
(7, 'Apayao', 1),
(8, 'Aurora', 1),
(9, 'Basilan', 3),
(10, 'Bataan', 1),
(11, 'Batanes', 1),
(12, 'Batangas', 1),
(13, 'Benguet', 1),
(14, 'Biliran', 2),
(15, 'Bohol', 2),
(16, 'Bukidnon', 3),
(17, 'Bulacan', 1),
(18, 'Cagayan', 1),
(19, 'Camarines Norte', 1),
(20, 'Camarines Sur', 1),
(21, 'Camiguin', 3),
(22, 'Capiz', 2),
(23, 'Catanduanes', 1),
(24, 'Cavite', 1),
(25, 'Cebu', 2),
(26, 'Compostela Valley', 3),
(27, 'Cotabato', 3),
(28, 'Davao del Norte', 3),
(29, 'Davao del Sur', 3),
(30, 'Davao Oriental', 3),
(31, 'Eastern Samar', 2),
(32, 'Guimaras', 2),
(33, 'Ifugao', 1),
(34, 'Ilocos Norte', 1),
(35, 'Ilocos Sur', 1),
(36, 'Iloilo', 2),
(37, 'Isabela', 1),
(38, 'Kalinga', 1),
(39, 'La Union', 1),
(40, 'Laguna', 1),
(41, 'Lanao del Norte', 3),
(42, 'Lanao del Sur', 3),
(43, 'Leyte', 2),
(44, 'Maguindanao', 3),
(45, 'Marinduque', 1),
(46, 'Masbate', 1),
(47, 'Metro Manila', 1),
(48, 'Misamis Occidental', 3),
(49, 'Misamis Oriental', 3),
(50, 'Mountain Province', 1),
(51, 'Negros Occidental', 2),
(52, 'Negros Oriental', 2),
(53, 'Northern Samar', 2),
(54, 'Nueva Ecija', 1),
(55, 'Nueva Vizcaya', 1),
(56, 'Occidental Mindoro', 1),
(57, 'Oriental Mindoro', 1),
(58, 'Palawan', 1),
(59, 'Pampanga', 1),
(60, 'Pangasinan', 1),
(61, 'Quezon', 1),
(62, 'Quirino', 1),
(63, 'Rizal', 1),
(64, 'Romblon', 1),
(65, 'Samar', 2),
(66, 'Sarangani', 3),
(67, 'Siquijor', 2),
(68, 'Sorsogon', 1),
(69, 'South Cotabato', 3),
(70, 'Southern Leyte', 2),
(71, 'Sultan Kudarat', 3),
(72, 'Sulu', 3),
(73, 'Surigao del Norte', 3),
(74, 'Surigao del Sur', 3),
(75, 'Tarlac', 1),
(76, 'Tawi-Tawi', 3),
(77, 'Zambales', 1),
(78, 'Zamboanga del Norte', 3),
(79, 'Zamboanga del Sur', 3),
(80, 'Zamboanga Sibugay', 3);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'ADMIN', '2015-06-21 18:59:17', '2015-06-21 18:59:17'),
(2, 'BDO HEAD', '2015-06-21 18:59:29', '2015-06-21 18:59:29'),
(3, 'BDO', '2015-06-21 18:59:41', '2015-06-21 18:59:41'),
(4, 'APPROVER', '2015-06-25 19:24:42', '2015-06-25 19:24:42');

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `stage` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`id`, `stage`, `description`, `created_at`, `updated_at`) VALUES
(1, 'DESIGN & DOCUMENTATION', 'SCHEMATIC DESIGN AND PROJECT PLANS ARE BEING DRAFTED FOR PLANNING APPROVAL.', '2015-07-01 19:44:48', '2015-07-01 19:44:48'),
(2, 'BIDDING', 'BIDS ARE BEING CALLED FOR MAIN CONTRACTOR', '2015-07-01 19:45:09', '2015-07-01 19:45:09'),
(3, 'CONSTRUCTION', 'MAIN CONTRACTOR HAS COMMENCED WORK ON SITE. MAIN CONTRACT AWARDED FOR SUBCONTRACT/S BIDDING OR SUBCONTRACT/S AWARDED ', '2015-07-01 19:45:38', '2015-07-01 19:45:38');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `state`, `created_at`, `updated_at`) VALUES
(1, 'LUZON', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'VISAYAS', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'MINDANAO', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE IF NOT EXISTS `statuses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 'AWARDED', 'PROJECTS  AWARDED. BASICALLY SPECIFIED FOR THE PROJECT', '2015-07-01 19:46:07', '2015-07-01 19:46:07'),
(2, 'PAINTING STARTED', 'PAINTING HAS COMMENCED WORK ON SITE. BASIS IN REPORTING CONSUMMATED AMOUNT', '2015-07-01 19:46:24', '2015-07-01 19:46:24'),
(3, 'LOST', 'NAME OF COMPETITOR/PAINT COMPANY USED IN THE PROJECT', '2015-07-01 19:46:43', '2015-07-01 19:46:43'),
(4, 'PROJECT ON-HOLD', 'NO BUDGET', '2015-08-19 21:51:48', '2015-08-19 21:51:48'),
(5, 'PROJECT CANCELLED', 'DUMMY PROJECT', '2015-08-19 21:53:03', '2015-08-19 21:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `sub_applicator`
--

CREATE TABLE IF NOT EXISTS `sub_applicator` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sub_applicator_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_architect`
--

CREATE TABLE IF NOT EXISTS `sub_architect` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sub_architect_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `sub_architect`
--

INSERT INTO `sub_architect` (`id`, `project_id`, `user_id`, `sub_architect_id`, `status`, `date_created`, `time_created`) VALUES
(1, 1, 2, 1, 2, '2015-09-21', '22:55:38');

-- --------------------------------------------------------

--
-- Table structure for table `sub_dealer_supplier`
--

CREATE TABLE IF NOT EXISTS `sub_dealer_supplier` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sub_dealer_supplier_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_developer`
--

CREATE TABLE IF NOT EXISTS `sub_developer` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sub_developer_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_gencon`
--

CREATE TABLE IF NOT EXISTS `sub_gencon` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sub_gencon_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `sub_project_mgr_designer`
--

CREATE TABLE IF NOT EXISTS `sub_project_mgr_designer` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `sub_project_mgr_designer_id` int(10) NOT NULL,
  `status` int(10) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `task` varchar(150) NOT NULL,
  `description` varchar(250) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task`, `description`, `created_at`, `updated_at`) VALUES
(1, 'EXPENSES', 'ALL TASK EXPENSES.', '2015-09-09 05:45:08', '2015-09-09 05:45:08'),
(2, 'TRAVEL', 'ALL TASK WITH TRAVEL.', '2015-09-09 06:40:08', '2015-09-09 06:40:08'),
(3, 'QUOTATION', 'ALL QUOTATION.', '2015-09-09 06:40:38', '2015-09-09 06:40:38'),
(4, 'TESTING', 'FOR TESTING ONLY.', '2015-09-14 06:22:42', '2015-09-14 06:22:42');

-- --------------------------------------------------------

--
-- Table structure for table `task_approver`
--

CREATE TABLE IF NOT EXISTS `task_approver` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(5) NOT NULL,
  `user_id` int(10) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Dumping data for table `task_approver`
--

INSERT INTO `task_approver` (`id`, `task_id`, `user_id`, `datetime_created`) VALUES
(20, 1, 4, '0000-00-00 00:00:00'),
(21, 4, 4, '0000-00-00 00:00:00'),
(22, 3, 4, '0000-00-00 00:00:00'),
(23, 2, 4, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `task_receiver`
--

CREATE TABLE IF NOT EXISTS `task_receiver` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `task_id` int(5) NOT NULL,
  `user_id` int(10) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `task_receiver`
--

INSERT INTO `task_receiver` (`id`, `task_id`, `user_id`, `datetime_created`) VALUES
(18, 1, 8, '0000-00-00 00:00:00'),
(19, 4, 3, '0000-00-00 00:00:00'),
(20, 3, 5, '0000-00-00 00:00:00'),
(21, 2, 6, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forcompany`
--

CREATE TABLE IF NOT EXISTS `thread_forcompany` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forcompany_id` int(10) NOT NULL,
  `thread` text NOT NULL,
  `closed` int(5) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `thread_forcompany`
--

INSERT INTO `thread_forcompany` (`id`, `user_id`, `forcompany_id`, `thread`, `closed`, `date_created`, `time_created`, `status`) VALUES
(1, 3, 1, 'OK. TEST ! REQUEST.', 0, '2015-09-23', '01:55:50', 2),
(2, 4, 1, 'OKAY CLEARED.', 1, '2015-09-23', '02:18:25', 2),
(3, 4, 1, 'OKAY CLEARED.', 1, '2015-09-23', '02:21:45', 2),
(4, 3, 1, 'APPROVED.', 0, '2015-09-23', '02:22:54', 2),
(5, 5, 2, 'OK. TEST START!', 0, '2015-09-28', '22:32:31', 2),
(6, 4, 2, 'GIVE  HER 300 PESO.', 1, '2015-09-28', '22:51:30', 2),
(7, 5, 2, 'OK. TEST END!', 0, '2015-09-28', '22:53:03', 2),
(8, 3, 4, 'FORWARDED TO APPROVER.', 0, '2015-09-28', '02:00:36', 2),
(9, 4, 4, 'REQUEST CLOSED.', 1, '2015-09-28', '02:02:17', 2),
(10, 3, 4, 'REQUEST APPROVED.', 0, '2015-09-28', '02:06:34', 2),
(11, 3, 4, 'REQUEST APPROVED.', 0, '2015-09-28', '02:06:36', 2);

-- --------------------------------------------------------

--
-- Table structure for table `thread_forcompany_file`
--

CREATE TABLE IF NOT EXISTS `thread_forcompany_file` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forcompany_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `thread_forcompany_file`
--

INSERT INTO `thread_forcompany_file` (`id`, `user_id`, `forcompany_id`, `thread_id`, `filename`, `datetime_created`) VALUES
(1, 3, 1, 1, 'add_project.docx', '0000-00-00 00:00:00'),
(2, 4, 1, 2, 'chase_jc.docx', '0000-00-00 00:00:00'),
(3, 3, 4, 8, 'screenshots.docx', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forcompany_image`
--

CREATE TABLE IF NOT EXISTS `thread_forcompany_image` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forcompany_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `thread_forcompany_image`
--

INSERT INTO `thread_forcompany_image` (`id`, `user_id`, `forcompany_id`, `thread_id`, `image`, `datetime_created`) VALUES
(1, 3, 1, 1, 'Jellyfish.jpg', '0000-00-00 00:00:00'),
(2, 5, 2, 5, 'Koala.jpg', '0000-00-00 00:00:00'),
(3, 4, 2, 6, 'Tulips.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forcontact`
--

CREATE TABLE IF NOT EXISTS `thread_forcontact` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forcontact_id` int(10) NOT NULL,
  `thread` text NOT NULL,
  `closed` int(5) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `thread_forcontact`
--

INSERT INTO `thread_forcontact` (`id`, `user_id`, `forcontact_id`, `thread`, `closed`, `date_created`, `time_created`, `status`) VALUES
(1, 7, 2, 'I  CANVAS AND HERE''S THE COPY OF TICKET THAT I SAW IN INTERNET.', 0, '2015-09-22', '23:01:49', 2),
(2, 2, 2, 'FOR TEST ONLY.', 0, '2015-09-22', '03:00:04', 2),
(3, 2, 2, '', 0, '2015-09-22', '03:02:59', 2),
(4, 7, 2, 'OKAY.', 1, '2015-09-22', '04:37:03', 2),
(5, 7, 2, 'OK.', 0, '2015-09-22', '05:26:58', 2),
(6, 8, 3, 'CONFIRMED CAME ON THAT DATE.', 0, '2015-09-23', '23:09:25', 2),
(7, 4, 3, 'OK.', 1, '2015-09-23', '23:33:35', 2),
(8, 8, 3, 'APPROVED.', 0, '2015-09-23', '23:38:18', 2),
(9, 8, 4, 'OK TESTED.', 0, '2015-09-24', '05:06:14', 2),
(10, 3, 5, 'TESTED. FORWARD TO APPROVER.', 0, '2015-09-28', '01:06:30', 2),
(11, 4, 5, 'WRITE REMARKS HERE.', 0, '2015-09-28', '01:12:59', 2),
(12, 4, 5, 'REQUEST APPROVED.', 1, '2015-09-28', '01:24:27', 2),
(13, 4, 5, 'REQUEST APPROVED.', 1, '2015-09-28', '01:26:51', 2),
(14, 3, 5, 'REQUEST DONE.', 0, '2015-09-28', '01:37:33', 2);

-- --------------------------------------------------------

--
-- Table structure for table `thread_forcontact_file`
--

CREATE TABLE IF NOT EXISTS `thread_forcontact_file` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forcontact_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `thread_forcontact_file`
--

INSERT INTO `thread_forcontact_file` (`id`, `user_id`, `forcontact_id`, `thread_id`, `filename`, `datetime_created`) VALUES
(1, 2, 2, 2, 'add_project.docx', '0000-00-00 00:00:00'),
(2, 7, 2, 4, 'chase_jc.docx', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forcontact_image`
--

CREATE TABLE IF NOT EXISTS `thread_forcontact_image` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forcontact_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `thread_forcontact_image`
--

INSERT INTO `thread_forcontact_image` (`id`, `user_id`, `forcontact_id`, `thread_id`, `image`, `datetime_created`) VALUES
(1, 7, 2, 1, 'new_raven_Floorplan_september_noprice-01.jpg', '0000-00-00 00:00:00'),
(2, 8, 3, 6, 'Penguins.jpg', '0000-00-00 00:00:00'),
(3, 4, 3, 7, 'Penguins.jpg', '0000-00-00 00:00:00'),
(4, 8, 3, 8, 'Desert.jpg', '0000-00-00 00:00:00'),
(5, 8, 4, 9, 'me-suit.png', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forothers`
--

CREATE TABLE IF NOT EXISTS `thread_forothers` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forothers_id` int(10) NOT NULL,
  `thread` text NOT NULL,
  `closed` int(5) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `thread_forothers`
--

INSERT INTO `thread_forothers` (`id`, `user_id`, `forothers_id`, `thread`, `closed`, `date_created`, `time_created`, `status`) VALUES
(1, 8, 2, 'OK. TESTED.', 0, '2015-09-24', '23:24:25', 2),
(2, 4, 2, 'TRY IT.', 0, '2015-09-24', '23:33:57', 2),
(3, 4, 2, 'TRY IT ! FOR THE SECOND TIME..', 0, '2015-09-24', '23:37:15', 2),
(4, 4, 2, 'TRY IT ! FOR THE FOURTH TIME..', 0, '2015-09-24', '23:43:12', 2),
(5, 4, 2, 'BUDGET THE AMOUNT FOR MEAL ALLOWANCE, TRAVEL FAIR AND OTHERS THAT THEY NEEDED.', 1, '2015-09-24', '23:44:41', 2),
(6, 8, 2, 'REQUEST TESTED.', 0, '2015-09-24', '23:45:20', 2),
(7, 3, 3, 'TEST BY ME...', 0, '2015-09-28', '23:53:11', 2),
(8, 3, 3, 'PLEASE PROCESS THIS IMMEDIATELY.', 0, '2015-09-28', '23:56:41', 2),
(9, 4, 3, 'MAKE IT 25000 THE BUDGET FOR THE EVENT.', 1, '2015-09-28', '00:00:10', 2),
(10, 3, 3, 'OK. TASK DONE.', 0, '2015-09-28', '00:01:55', 2),
(11, 3, 4, 'TEST START', 0, '2015-09-28', '00:06:01', 2),
(12, 3, 4, 'TEST CLOSED', 0, '2015-09-28', '00:06:26', 2),
(13, 3, 5, 'OK TEST', 0, '2015-09-28', '02:53:19', 2),
(14, 4, 5, 'WRITE REMARKS HERE.', 0, '2015-09-28', '02:56:19', 2),
(15, 4, 5, 'TASK DONE,', 1, '2015-09-28', '03:01:12', 2),
(16, 3, 5, 'DONE.', 0, '2015-09-28', '03:02:17', 2);

-- --------------------------------------------------------

--
-- Table structure for table `thread_forothers_file`
--

CREATE TABLE IF NOT EXISTS `thread_forothers_file` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forothers_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `thread_forothers_file`
--

INSERT INTO `thread_forothers_file` (`id`, `user_id`, `forothers_id`, `thread_id`, `filename`, `datetime_created`) VALUES
(1, 4, 2, 2, 'screenshots.docx', '0000-00-00 00:00:00'),
(2, 4, 2, 3, 'Warehouse and Cold Storage grouping.xls', '0000-00-00 00:00:00'),
(3, 4, 2, 4, 'Warehouse and Cold Storage grouping.xls', '0000-00-00 00:00:00'),
(4, 4, 2, 5, 'Warehouse and Cold Storage grouping.xls', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forothers_image`
--

CREATE TABLE IF NOT EXISTS `thread_forothers_image` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forothers_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `thread_forothers_image`
--

INSERT INTO `thread_forothers_image` (`id`, `user_id`, `forothers_id`, `thread_id`, `image`, `datetime_created`) VALUES
(1, 8, 2, 1, 'me-suit.png', '0000-00-00 00:00:00'),
(2, 3, 3, 7, 'new_raven_Floorplan_september_noprice-02.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forproject`
--

CREATE TABLE IF NOT EXISTS `thread_forproject` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forproject_id` int(10) NOT NULL,
  `thread` text NOT NULL,
  `closed` int(5) NOT NULL,
  `date_created` date NOT NULL,
  `time_created` time NOT NULL,
  `status` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `thread_forproject`
--

INSERT INTO `thread_forproject` (`id`, `user_id`, `forproject_id`, `thread`, `closed`, `date_created`, `time_created`, `status`) VALUES
(1, 5, 1, 'OK', 0, '2015-09-23', '03:39:02', 2),
(2, 4, 1, 'OK', 1, '2015-09-23', '03:48:52', 2),
(3, 4, 1, 'OK', 1, '2015-09-23', '03:49:45', 2),
(4, 5, 1, 'TASK DONE.', 0, '2015-09-23', '03:50:39', 2),
(5, 5, 1, 'WRITE REMARKS HERE.', 0, '2015-09-23', '03:54:03', 2),
(6, 5, 1, 'DONE.', 0, '2015-09-23', '03:56:54', 2),
(7, 6, 2, 'TEST START.', 0, '2015-09-28', '23:14:26', 2),
(8, 4, 2, 'ADD 50 PESO ON BDO''S ALLOWANCE.', 0, '2015-09-28', '23:33:53', 2),
(9, 6, 2, 'IT''S UP TO YOU MA''AM !', 0, '2015-09-28', '23:34:47', 2),
(10, 4, 2, 'OKAY! REQUEST APPROVED.', 1, '2015-09-28', '23:35:55', 2),
(11, 6, 2, 'TEST. END.', 0, '2015-09-28', '23:36:33', 2),
(12, 3, 3, 'SENT TO APPROVER.', 0, '2015-09-28', '02:35:58', 2),
(13, 4, 3, 'REQUEST DONE.', 1, '2015-09-28', '02:42:30', 2),
(14, 3, 3, 'OK. TASK DONE.', 0, '2015-09-28', '02:45:41', 2);

-- --------------------------------------------------------

--
-- Table structure for table `thread_forproject_file`
--

CREATE TABLE IF NOT EXISTS `thread_forproject_file` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forproject_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `filename` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `thread_forproject_file`
--

INSERT INTO `thread_forproject_file` (`id`, `user_id`, `forproject_id`, `thread_id`, `filename`, `datetime_created`) VALUES
(1, 5, 1, 1, 'charter timetable.xlsx', '0000-00-00 00:00:00'),
(2, 4, 1, 3, 'Warehouse and Cold Storage grouping.xls', '0000-00-00 00:00:00'),
(3, 6, 2, 7, 'P323 Araneta Phase 2 FRICE_POS D1.0 (1)(1).xlsx', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `thread_forproject_image`
--

CREATE TABLE IF NOT EXISTS `thread_forproject_image` (
  `id` bigint(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `forproject_id` int(10) NOT NULL,
  `thread_id` int(10) NOT NULL,
  `image` varchar(250) NOT NULL,
  `datetime_created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `thread_forproject_image`
--

INSERT INTO `thread_forproject_image` (`id`, `user_id`, `forproject_id`, `thread_id`, `image`, `datetime_created`) VALUES
(1, 4, 3, 13, 'Penguins.jpg', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `client_type` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `desc` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

--
-- Dumping data for table `types`
--

INSERT INTO `types` (`id`, `client_type`, `desc`, `created_at`, `updated_at`) VALUES
(1, 'COMPANY', '', '2015-07-01 19:37:22', '2015-07-01 19:37:22'),
(2, 'CORPORATION', '', '2015-07-01 19:37:37', '2015-07-01 19:37:37'),
(3, 'ASSOSCIATION', '', '2015-07-01 19:37:47', '2015-07-01 19:37:47'),
(4, 'DEALERS', '', '2015-07-01 19:38:04', '2015-07-01 19:38:04'),
(5, 'INDIVIDUAL', '', '2015-07-01 19:38:15', '2015-07-01 19:38:15'),
(6, 'OUTRIGHT ACCOUNT', '', '2015-07-01 19:38:28', '2015-07-01 19:38:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `middle_initial` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dept_id` int(10) NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `confirmation_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `confirmed` tinyint(1) NOT NULL DEFAULT '1',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_username_unique` (`username`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_initial`, `last_name`, `dept_id`, `username`, `email`, `password`, `image`, `confirmation_code`, `remember_token`, `created_at`, `confirmed`, `active`, `updated_at`) VALUES
(1, 'JC', 'L', 'YANGA', 1, 'admin', 'JCYANGA28@YAHOO.COM', '$2y$10$y6hv5bn57Ne9Hz7MrJps0.FrvHHf.TfreCXvbOfXe3XfSn7aa1Awq', 'default.png', '36c8bdcde75255bfa0d7f03d83d3e99e', 'X8N7XCO91tjsP0WEAAlCTmL660rhPW4Bw8BIol0EQRMu8WPnGumd38jbwWGR', '2015-07-02 02:00:00', 1, 1, '2015-09-27 19:51:42'),
(2, 'QUENNIE', 'A', 'ALIAZAS', 2, 'bdo_quennie', 'bdo.quennie@davies.com', '$2y$10$qjIUaRaBna671SCoGtk./ezY4dl/AM.HD5Rd..1k6FoBY0L/v3myy', 'default.png', 'aded0b39846b19b12a84ef7aacdea483', 'ad7mRvVzSvKBofEVB3Hfd31fxEFze8tKGipTzS75lLeyWoKS33vN9fmjbv8t', '2015-07-05 23:05:11', 1, 1, '2015-09-27 23:02:43'),
(3, 'MARIA', 'A', 'CLARA', 3, 'cc_mariaclara', 'cc.mariaclara@yahoo.com', '$2y$10$4VFMfWTGb91oQdqRLjZl3eiCJy4bMOo11w8TIh5bZCJR3RdF6BT3G', 'default.png', '3d718b2c55fd4681cdb26744be9c4ca9', 'puvTuACFcgwgvg9mOA7AIxEFkoH91eLquAbOnMOtCeV6QG0GQIkOwWwAqXuj', '2015-07-05 23:09:46', 1, 1, '2015-09-27 23:03:00'),
(4, 'JUAN', 'D', 'DELA CRUZ', 2, 'bdoh_juan', 'bdo.juan@yahoo.com', '$2y$10$lWmVfffl.UHA7Do.6nnOX.7CbosZLTu7Ph/lgaDn4sCn1tuy60gKm', 'default.png', 'e1d325211bf688bd75ccb22aa87e1caa', 'Qp9WGQK5Y0grejpAZvZyzWMGcbAqDWhEDy2PB7AKsOPO1gr0JcBCE4bvJKlF', '2015-07-05 23:10:36', 1, 1, '2015-09-27 23:02:50'),
(5, 'LORY', 'M', 'ORTILLE', 2, 'bdo_lory', 'lory@davies.com.ph', '$2y$10$SnFyZt981WerRgeIkz9OdOiua5IUolILtNkQ1Je50RHonDBnPiKH6', 'default.png', '49d5e83d7a7d72278d74dc1613c953bf', 'ocf2fld7BMG9PW0K9N3PawxYEK9CFfCwpSIkSMMz2x6uKPU0nr6lNmTs8efP', '2015-07-19 18:12:07', 1, 1, '2015-09-23 01:13:14'),
(6, 'RYZZA', 'D', 'ILAO', 3, 'cc_ryzza', 'ryzza@davies.com.ph', '$2y$10$6mrZxYuM0YTTRUnpkeIk5e/A77ey6iIHkt3dkSqwpRaq6SNAgXgYe', 'default.png', '55daf8bfd3b8bffee65cb970c306a301', 'Z1J9YthPo9xeC5cTodHJxghQ8N1pllLOQ1upnB36WqqtCLXqseOuFemIrivb', '2015-07-19 18:13:05', 1, 1, '2015-09-27 21:01:52'),
(7, 'JENNY', 'A', 'DELA CRUZ', 2, 'bdo_jenny', 'jenny@charter.com', '$2y$10$T2qOY3NItz3Ok1iQINApSONskwK6idgIMkMJPqZfDdh2kSrgdBPFu', 'default.png', 'f253df2f1d88312e7d0171a73469fecd', 'c6KVzQfd03Fw5hb3UZiW3Xjn8dSghxecHw32FWpVQRAHLlMJHTje2HlVL9Ad', '2015-08-19 19:48:15', 1, 1, '2015-09-23 01:40:22'),
(8, 'JENNY II', 'A', 'DELA CRUZ', 3, 'cc_jenny', 'jennyii@yahoo.com', '$2y$10$pgWjTMgNW3iPzFjdOg0seODR4wqjh7ZRLT3KqilFBVjCnFm0qOtue', 'default.png', '16259c480aa58a7a2f4e1f429a0b6948', 'QPi7BM7977OGZcGtC2FxviouJManfR49AkwOhT4ElWAzJbIUfeLGM2AD2rWT', '2015-08-19 19:49:37', 1, 1, '2015-09-22 20:51:05');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_areas`
--
ALTER TABLE `assigned_areas`
  ADD CONSTRAINT `assigned_areas_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`),
  ADD CONSTRAINT `assigned_areas_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `assigned_roles`
--
ALTER TABLE `assigned_roles`
  ADD CONSTRAINT `assigned_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `assigned_roles_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `companies`
--
ALTER TABLE `companies`
  ADD CONSTRAINT `companies_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `companies_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`),
  ADD CONSTRAINT `companies_type_id_foreign` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`);

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`),
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);

--
-- Constraints for table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_project_category_foreign` FOREIGN KEY (`project_category`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `projects_project_classification_foreign` FOREIGN KEY (`project_classification`) REFERENCES `classifications` (`id`),
  ADD CONSTRAINT `projects_project_stage_foreign` FOREIGN KEY (`project_stage`) REFERENCES `stages` (`id`);

--
-- Constraints for table `provinces`
--
ALTER TABLE `provinces`
  ADD CONSTRAINT `provinces_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
