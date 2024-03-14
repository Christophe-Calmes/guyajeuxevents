-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mer. 13 mars 2024 à 09:42
-- Version du serveur : 8.0.36-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `guyagraines`
--

-- --------------------------------------------------------

--
-- Structure de la table `dataSite`
--

CREATE TABLE `dataSite` (
  `idDataSite` int NOT NULL,
  `titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `sousTitre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `titreHTML` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `dataSite`
--

INSERT INTO `dataSite` (`idDataSite`, `titre`, `sousTitre`, `description`, `titreHTML`) VALUES
(1, 'Guyajeux Réservation - LOCAL', 'Réserver une table ou un événement', 'jeux de plateau, boarding games, salon de provence, vente de jeux, figurines, bar à jeux, guyajeux, réservation, tables de jeux, boissons', 'Guyajeux Réservation - Local');

-- --------------------------------------------------------

--
-- Structure de la table `journaux`
--

CREATE TABLE `journaux` (
  `idConnexion` int NOT NULL,
  `ipUser` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `idUser` int NOT NULL DEFAULT '0',
  `login` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `mdpHacker` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `dateHeure` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `okConnexion` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `journaux`
--

INSERT INTO `journaux` (`idConnexion`, `ipUser`, `idUser`, `login`, `mdpHacker`, `dateHeure`, `okConnexion`) VALUES
(1, '127.0.0.1', 7, 'Admin', '0', '2023-07-12 13:45:12', 1),
(2, '127.0.0.1', 5, 'Aresh', '0', '2023-07-13 10:08:34', 1),
(3, '127.0.0.1', 7, 'Admin', '0', '2023-07-13 10:19:15', 1),
(4, '127.0.0.1', 5, 'Aresh', '0', '2023-07-17 09:38:09', 1),
(5, '127.0.0.1', 5, 'Aresh', '0', '2023-07-17 09:59:39', 1),
(6, '127.0.0.1', 5, 'Aresh', '0', '2023-07-17 10:00:16', 1),
(7, '127.0.0.1', 8, 'gandalf', '0', '2023-07-17 10:13:15', 1),
(8, '127.0.0.1', 0, 'gandalf', 'dusud', '2023-07-17 10:14:10', 0),
(9, '127.0.0.1', 8, 'gandalf', '0', '2023-07-17 10:14:22', 1),
(10, '127.0.0.1', 8, 'gandalf', '0', '2023-07-17 10:15:42', 1),
(11, '127.0.0.1', 8, 'gandalf', '0', '2023-07-17 10:16:56', 1),
(12, '127.0.0.1', 5, 'Aresh', '0', '2023-07-17 10:18:34', 1),
(13, '127.0.0.1', 7, 'Admin', '0', '2023-07-17 10:18:42', 1),
(14, '127.0.0.1', 0, 'gandalf', 'dusud', '2023-07-17 10:18:56', 0),
(15, '127.0.0.1', 8, 'gandalf', '0', '2023-07-17 10:19:09', 1),
(16, '127.0.0.1', 0, 'gandalf', 'christophe', '2023-07-17 10:19:50', 0),
(17, '127.0.0.1', 7, 'Admin', '0', '2023-07-17 10:20:28', 1),
(18, '127.0.0.1', 8, 'gandalf', '0', '2023-07-17 10:20:54', 1),
(19, '127.0.0.1', 7, 'Admin', '0', '2023-07-17 10:33:12', 1),
(20, '::1', 7, 'Admin', '0', '2023-07-17 10:35:00', 1),
(21, '127.0.0.1', 5, 'Aresh', '0', '2023-07-26 11:03:38', 1),
(22, '127.0.0.1', 7, 'Admin', '0', '2023-07-31 10:15:58', 1),
(23, '127.0.0.1', 7, 'Admin', '0', '2023-07-31 13:14:39', 1),
(24, '127.0.0.1', 7, 'Admin', '0', '2023-08-01 08:50:25', 1),
(25, '127.0.0.1', 5, 'Aresh', '0', '2023-10-06 18:17:20', 1),
(26, '127.0.0.1', 7, 'Admin', '0', '2023-10-06 18:17:33', 1),
(27, '127.0.0.1', 7, 'Admin', '0', '2023-10-06 21:44:49', 1),
(28, '127.0.0.1', 7, 'Admin', '0', '2023-10-07 12:40:01', 1),
(29, '127.0.0.1', 5, 'Aresh', '0', '2023-10-07 13:02:35', 1),
(30, '127.0.0.1', 7, 'Admin', '0', '2023-10-07 13:04:17', 1),
(31, '127.0.0.1', 7, 'Admin', '0', '2023-10-09 13:38:25', 1),
(32, '127.0.0.1', 5, 'Aresh', '0', '2023-10-09 13:40:06', 1),
(33, '127.0.0.1', 7, 'Admin', '0', '2023-10-09 13:55:25', 1),
(34, '127.0.0.1', 7, 'Admin', '0', '2023-10-09 14:00:32', 1),
(35, '127.0.0.1', 7, 'Admin', '0', '2023-10-09 15:35:08', 1),
(36, '127.0.0.1', 7, 'Admin', '0', '2023-10-09 15:39:26', 1),
(37, '127.0.0.1', 5, 'Aresh', '0', '2023-10-20 13:20:28', 1),
(38, '127.0.0.1', 7, 'Admin', '0', '2023-10-20 13:20:43', 1),
(39, '127.0.0.1', 7, 'Admin', '0', '2023-10-27 04:23:48', 1),
(40, '127.0.0.1', 7, 'Admin', '0', '2023-10-27 13:27:44', 1),
(41, '127.0.0.1', 7, 'Admin', '0', '2023-10-29 15:49:19', 1),
(42, '127.0.0.1', 7, 'Admin', '0', '2023-10-30 00:29:03', 1),
(43, '127.0.0.1', 7, 'Admin', '0', '2023-10-30 12:18:58', 1),
(44, '127.0.0.1', 7, 'Admin', '0', '2023-10-30 13:50:28', 1),
(45, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 06:53:09', 1),
(46, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 07:37:05', 1),
(47, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 07:39:31', 1),
(48, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 07:42:29', 1),
(49, '127.0.0.1', 5, 'Aresh', '0', '2023-10-31 07:43:02', 1),
(50, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 07:43:10', 1),
(51, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 13:04:19', 1),
(52, '127.0.0.1', 7, 'Admin', '0', '2023-10-31 14:29:47', 1),
(53, '::1', 0, 'Aresh', 'Christophe', '2023-10-31 15:24:54', 0),
(54, '::1', 5, 'Aresh', '0', '2023-10-31 15:25:03', 1),
(55, '127.0.0.1', 7, 'Admin', '0', '2023-11-02 12:33:52', 1),
(56, '127.0.0.1', 7, 'Admin', '0', '2023-11-03 08:56:18', 1),
(57, '127.0.0.1', 0, 'Beta', 'christophe', '2023-11-03 09:51:38', 0),
(58, '127.0.0.1', 9, 'Beta', '0', '2023-11-03 09:52:06', 1),
(59, '127.0.0.1', 9, 'Beta', '0', '2023-11-03 09:52:46', 1),
(60, '127.0.0.1', 7, 'Admin', '0', '2023-11-03 10:31:19', 1),
(61, '127.0.0.1', 7, 'Admin', '0', '2023-11-04 12:36:00', 1),
(62, '127.0.0.1', 7, 'Admin', '0', '2023-11-04 20:23:17', 1),
(63, '127.0.0.1', 7, 'Admin', '0', '2023-11-05 09:43:39', 1),
(64, '127.0.0.1', 7, 'Admin', '0', '2023-11-05 11:05:27', 1),
(65, '127.0.0.1', 7, 'Admin', '0', '2023-11-05 15:51:52', 1),
(66, '127.0.0.1', 5, 'Aresh', '0', '2023-12-24 14:58:03', 1),
(67, '127.0.0.1', 5, 'Aresh', '0', '2023-12-24 15:03:42', 1),
(68, '127.0.0.1', 7, 'Admin', '0', '2023-12-24 15:13:48', 1),
(69, '127.0.0.1', 5, 'Aresh', '0', '2024-02-07 10:39:30', 1),
(70, '127.0.0.1', 7, 'Admin', '0', '2024-02-07 10:40:10', 1),
(71, '127.0.0.1', 7, 'Admin', '0', '2024-02-08 16:17:44', 1),
(72, '127.0.0.1', 7, 'Admin', '0', '2024-02-08 16:48:46', 1),
(73, '127.0.0.1', 5, 'Aresh', '0', '2024-02-21 13:25:30', 1),
(74, '127.0.0.1', 7, 'Admin', '0', '2024-02-22 17:16:24', 1),
(75, '127.0.0.1', 7, 'Admin', '0', '2024-02-23 00:00:26', 1),
(76, '::1', 0, 'Admin', 'dusud', '2024-02-23 00:38:39', 0),
(77, '::1', 7, 'Admin', '0', '2024-02-23 00:38:50', 1),
(78, '::1', 0, 'admin', 'dusid', '2024-02-23 01:00:52', 0),
(79, '::1', 7, 'Admin', '0', '2024-02-23 01:01:06', 1),
(80, '::1', 0, 'Admin', 'dusud', '2024-02-23 08:46:50', 0),
(81, '::1', 7, 'Admin', '0', '2024-02-23 08:47:04', 1),
(82, '127.0.0.1', 5, 'Aresh', '0', '2024-03-01 05:40:17', 1),
(83, '127.0.0.1', 0, 'Aresh', 'Christophe', '2024-03-01 05:48:30', 0),
(84, '127.0.0.1', 5, 'Aresh', '0', '2024-03-01 05:48:43', 1),
(85, '::1', 5, 'Aresh', '0', '2024-03-01 05:52:06', 1),
(86, '127.0.0.1', 5, 'Aresh', '0', '2024-03-01 05:59:29', 1),
(87, '::1', 5, 'Aresh', '0', '2024-03-01 06:01:35', 1),
(88, '127.0.0.1', 5, 'Aresh', '0', '2024-03-01 06:11:28', 1),
(89, '127.0.0.1', 0, 'Aresh', 'chrisophe', '2024-03-01 10:32:50', 0),
(90, '127.0.0.1', 0, 'Aresh', 'christiophe', '2024-03-01 10:33:03', 0),
(91, '127.0.0.1', 5, 'Aresh', '0', '2024-03-01 10:33:16', 1),
(92, '127.0.0.1', 7, 'Admin', '0', '2024-03-01 17:33:37', 1),
(93, '127.0.0.1', 0, 'Admin', 'dusud', '2024-03-04 01:38:17', 0),
(94, '127.0.0.1', 7, 'Admin', '0', '2024-03-04 01:38:28', 1),
(95, '127.0.0.1', 9, 'Beta', '0', '2024-03-04 01:40:02', 1),
(96, '127.0.0.1', 7, 'Admin', '0', '2024-03-04 01:40:14', 1),
(97, '127.0.0.1', 9, 'Beta', '0', '2024-03-04 01:40:39', 1),
(98, '127.0.0.1', 7, 'Admin', '0', '2024-03-04 01:49:21', 1),
(99, '127.0.0.1', 9, 'Beta', '0', '2024-03-04 01:52:12', 1),
(100, '127.0.0.1', 7, 'Admin', '0', '2024-03-04 01:56:41', 1),
(101, '127.0.0.1', 9, 'Beta', '0', '2024-03-04 02:00:56', 1),
(102, '127.0.0.1', 9, 'Beta', '0', '2024-03-04 09:37:05', 1),
(103, '127.0.0.1', 7, 'Admin', '0', '2024-03-04 09:41:17', 1),
(104, '127.0.0.1', 9, 'Beta', '0', '2024-03-04 09:42:26', 1),
(105, '::1', 0, 'beta', 'vZaYqpkBh6srRCVO', '2024-03-04 09:54:43', 0),
(106, '::1', 0, 'beta', 'dusud', '2024-03-04 09:54:53', 0),
(107, '::1', 9, 'Beta', '0', '2024-03-04 09:55:04', 1),
(108, '::1', 0, 'beta', 'dusud', '2024-03-04 13:15:41', 0),
(109, '::1', 9, 'Beta', '0', '2024-03-04 13:15:55', 1),
(110, '::1', 9, 'Beta', '0', '2024-03-04 20:24:07', 1),
(111, '::1', 9, 'Beta', '0', '2024-03-05 08:09:18', 1),
(112, '::1', 7, 'Admin', '0', '2024-03-05 11:40:13', 1),
(113, '::1', 9, 'Beta', '0', '2024-03-05 11:41:12', 1),
(114, '::1', 9, 'Beta', '0', '2024-03-05 12:55:46', 1),
(115, '::1', 7, 'Admin', '0', '2024-03-05 13:45:51', 1),
(116, '::1', 9, 'Beta', '0', '2024-03-05 13:48:53', 1),
(117, '::1', 9, 'Beta', '0', '2024-03-05 16:31:18', 1),
(118, '::1', 7, 'Admin', '0', '2024-03-05 16:33:10', 1),
(119, '::1', 9, 'Beta', '0', '2024-03-05 16:33:45', 1),
(120, '::1', 7, 'Admin', '0', '2024-03-05 16:39:25', 1),
(121, '::1', 9, 'Beta', '0', '2024-03-05 16:43:08', 1),
(122, '::1', 7, 'Admin', '0', '2024-03-05 17:01:29', 1),
(123, '::1', 9, 'Beta', '0', '2024-03-05 17:02:37', 1),
(124, '::1', 9, 'Beta', '0', '2024-03-06 00:49:11', 1),
(125, '::1', 9, 'Beta', '0', '2024-03-06 09:02:54', 1),
(126, '::1', 7, 'Admin', '0', '2024-03-06 13:10:27', 1),
(127, '::1', 9, 'Beta', '0', '2024-03-06 13:19:27', 1),
(128, '::1', 0, 'Admin', 'dusud', '2024-03-06 13:28:48', 0),
(129, '::1', 7, 'Admin', '0', '2024-03-06 13:28:59', 1),
(130, '::1', 9, 'Beta', '0', '2024-03-06 13:30:03', 1),
(131, '::1', 7, 'Admin', '0', '2024-03-06 15:03:23', 1),
(132, '::1', 9, 'Beta', '0', '2024-03-06 15:41:44', 1),
(133, '::1', 9, 'Beta', '0', '2024-03-06 16:02:34', 1),
(134, '::1', 9, 'Beta', '0', '2024-03-06 16:13:41', 1),
(135, '::1', 7, 'Admin', '0', '2024-03-06 16:22:52', 1),
(136, '::1', 9, 'Beta', '0', '2024-03-06 16:24:25', 1),
(137, '::1', 9, 'Beta', '0', '2024-03-06 21:07:06', 1),
(138, '::1', 7, 'Admin', '0', '2024-03-06 21:09:46', 1),
(139, '::1', 9, 'Beta', '0', '2024-03-06 21:12:38', 1),
(140, '::1', 7, 'Admin', '0', '2024-03-06 22:02:06', 1),
(141, '::1', 9, 'Beta', '0', '2024-03-06 22:04:42', 1),
(142, '::1', 7, 'Admin', '0', '2024-03-06 22:29:55', 1),
(143, '::1', 9, 'Beta', '0', '2024-03-06 22:31:37', 1),
(144, '::1', 9, 'Beta', '0', '2024-03-06 22:33:36', 1),
(145, '::1', 7, 'Admin', '0', '2024-03-06 22:34:25', 1),
(146, '::1', 9, 'Beta', '0', '2024-03-06 22:36:46', 1),
(147, '::1', 0, 'Admin', 'dusud', '2024-03-06 22:39:36', 0),
(148, '::1', 7, 'Admin', '0', '2024-03-06 22:39:47', 1),
(149, '::1', 9, 'Beta', '0', '2024-03-06 22:42:06', 1),
(150, '::1', 9, 'Beta', '0', '2024-03-07 09:32:16', 1),
(151, '::1', 7, 'Admin', '0', '2024-03-07 09:35:12', 1),
(152, '::1', 9, 'Beta', '0', '2024-03-07 09:39:30', 1),
(153, '::1', 0, 'Admin', 'dusud', '2024-03-07 09:56:00', 0),
(154, '::1', 7, 'Admin', '0', '2024-03-07 09:56:16', 1),
(155, '::1', 9, 'Beta', '0', '2024-03-07 09:57:25', 1),
(156, '::1', 7, 'Admin', '0', '2024-03-07 10:05:33', 1),
(157, '::1', 9, 'Beta', '0', '2024-03-07 10:05:49', 1),
(158, '::1', 5, 'Aresh', '0', '2024-03-07 12:52:55', 1),
(159, '::1', 9, 'Beta', '0', '2024-03-07 12:53:12', 1),
(160, '::1', 0, 'beta', 'christope', '2024-03-07 14:06:33', 0),
(161, '::1', 9, 'Beta', '0', '2024-03-07 14:06:45', 1),
(162, '::1', 9, 'Beta', '0', '2024-03-07 14:15:25', 1),
(163, '::1', 5, 'Aresh', '0', '2024-03-07 14:59:58', 1),
(164, '::1', 9, 'Beta', '0', '2024-03-07 15:06:59', 1),
(165, '::1', 9, 'Beta', '0', '2024-03-07 19:02:01', 1),
(166, '::1', 9, 'Beta', '0', '2024-03-07 19:12:53', 1),
(167, '::1', 15, 'Eddie', '0', '2024-03-07 19:42:30', 1),
(168, '::1', 7, 'Admin', '0', '2024-03-07 19:47:20', 1),
(169, '::1', 15, 'Eddie', '0', '2024-03-07 19:56:23', 1),
(170, '::1', 7, 'Admin', '0', '2024-03-07 20:06:31', 1),
(171, '::1', 15, 'Eddie', '0', '2024-03-07 20:07:59', 1),
(172, '::1', 15, 'Eddie', '0', '2024-03-07 23:50:52', 1),
(173, '127.0.0.1', 7, 'Admin', '0', '2024-03-08 00:36:56', 1),
(174, '::1', 15, 'Eddie', '0', '2024-03-08 01:23:45', 1),
(175, '::1', 15, 'Eddie', '0', '2024-03-08 13:10:16', 1),
(176, '::1', 9, 'Beta', '0', '2024-03-08 13:10:39', 1),
(177, '::1', 15, 'Eddie', '0', '2024-03-08 13:12:11', 1),
(178, '::1', 14, 'Janet', '0', '2024-03-08 13:12:26', 1),
(179, '::1', 13, 'Brad', '0', '2024-03-08 13:12:44', 1),
(180, '::1', 15, 'Eddie', '0', '2024-03-08 13:43:32', 1),
(181, '::1', 0, 'Eddie', 'Chrsitophe', '2024-03-08 14:33:16', 0),
(182, '::1', 15, 'Eddie', '0', '2024-03-08 14:33:28', 1),
(183, '::1', 12, 'dscott', '0', '2024-03-08 15:01:57', 1),
(184, '::1', 14, 'Janet', '0', '2024-03-08 15:10:42', 1),
(185, '::1', 9, 'Beta', '0', '2024-03-08 15:15:47', 1),
(186, '::1', 9, 'Beta', '0', '2024-03-09 06:51:47', 1),
(187, '::1', 15, 'Eddie', '0', '2024-03-09 06:53:13', 1),
(188, '::1', 9, 'Beta', '0', '2024-03-09 07:03:46', 1),
(189, '::1', 12, 'dscott', '0', '2024-03-09 07:09:54', 1),
(190, '::1', 9, 'Beta', '0', '2024-03-09 07:15:32', 1),
(191, '::1', 9, 'Beta', '0', '2024-03-09 08:19:26', 1),
(192, '::1', 7, 'Admin', '0', '2024-03-09 08:24:18', 1),
(193, '::1', 9, 'Beta', '0', '2024-03-09 08:25:14', 1),
(194, '::1', 7, 'Admin', '0', '2024-03-11 08:23:33', 1),
(195, '::1', 9, 'Beta', '0', '2024-03-11 08:24:20', 1),
(196, '::1', 7, 'Admin', '0', '2024-03-11 09:46:16', 1),
(197, '::1', 9, 'Beta', '0', '2024-03-11 09:46:29', 1),
(198, '::1', 0, 'Admin', 'dusud', '2024-03-11 10:33:38', 0),
(199, '::1', 7, 'Admin', '0', '2024-03-11 10:37:48', 1),
(200, '::1', 0, 'beta', 'Christophe', '2024-03-11 10:42:08', 0),
(201, '::1', 9, 'Beta', '0', '2024-03-11 10:42:19', 1),
(202, '::1', 9, 'Beta', '0', '2024-03-11 12:01:25', 1),
(203, '::1', 9, 'Beta', '0', '2024-03-11 13:53:43', 1),
(204, '::1', 7, 'Admin', '0', '2024-03-11 13:57:52', 1),
(205, '::1', 9, 'Beta', '0', '2024-03-11 13:58:42', 1),
(206, '::1', 7, 'Admin', '0', '2024-03-11 16:24:12', 1),
(207, '::1', 9, 'Beta', '0', '2024-03-11 16:25:33', 1),
(208, '::1', 7, 'Admin', '0', '2024-03-11 16:41:12', 1),
(209, '::1', 9, 'Beta', '0', '2024-03-11 16:43:42', 1),
(210, '::1', 9, 'Beta', '0', '2024-03-11 22:43:13', 1),
(211, '::1', 9, 'Beta', '0', '2024-03-11 23:32:39', 1),
(212, '::1', 9, 'Beta', '0', '2024-03-12 13:41:52', 1),
(213, '::1', 7, 'Admin', '0', '2024-03-12 15:54:11', 1),
(214, '::1', 9, 'Beta', '0', '2024-03-12 15:59:20', 1),
(215, '::1', 9, 'Beta', '0', '2024-03-13 08:44:34', 1),
(216, '::1', 9, 'Beta', '0', '2024-03-13 09:39:32', 1),
(217, '::1', 7, 'Admin', '0', '2024-03-13 09:41:17', 1),
(218, '::1', 15, 'Eddie', '0', '2024-03-13 09:42:17', 1);

-- --------------------------------------------------------

--
-- Structure de la table `menuNav`
--

CREATE TABLE `menuNav` (
  `idMenuDeroulant` int NOT NULL,
  `titreMenu` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `menuNav`
--

INSERT INTO `menuNav` (`idMenuDeroulant`, `titreMenu`) VALUES
(1, 'Administration du site'),
(6, 'Administration User'),
(12, 'News'),
(13, 'Admin Evénements'),
(15, 'Evénements'),
(16, 'Admin Réserver tables');

-- --------------------------------------------------------

--
-- Structure de la table `modules`
--

CREATE TABLE `modules` (
  `id` int NOT NULL,
  `module` varchar(30) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `modules`
--

INSERT INTO `modules` (`id`, `module`, `valide`) VALUES
(1, 'Graines', 1),
(4, 'news', 1),
(5, 'Events', 1),
(6, 'reserveTables', 1);

-- --------------------------------------------------------

--
-- Structure de la table `navigation`
--

CREATE TABLE `navigation` (
  `idNav` int NOT NULL,
  `nomNav` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `cheminNav` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `menuVisible` tinyint(1) NOT NULL,
  `zoneMenu` int NOT NULL,
  `ordre` tinyint NOT NULL,
  `niveau` tinyint(1) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `deroulant` tinyint NOT NULL DEFAULT '0',
  `targetRoute` varchar(22) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '0',
  `idModule` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `navigation`
--

INSERT INTO `navigation` (`idNav`, `nomNav`, `cheminNav`, `menuVisible`, `zoneMenu`, `ordre`, `niveau`, `valide`, `deroulant`, `targetRoute`, `idModule`) VALUES
(72, 'connexion', 'modules/connexion/connexion.php', 1, 0, 10, 0, 1, 0, '2347346484478', 1),
(73, 'inscription', 'modules/users/inscription.php', 0, 0, 0, 0, 1, 0, '90781485603865', 1),
(74, 'Deco', 'modules/securiter/deconnexion.php', 1, 0, 20, 1, 1, 0, '964997884560417', 1),
(75, 'Deco', 'modules/securiter/deconnexion.php', 1, 0, 20, 2, 1, 0, '700436539587', 1),
(76, 'Administration du site', 'modules/navigation/erreurNav.php', 1, 0, 1, 2, 1, 1, '35416841975244', 1),
(77, 'Ajout lien de nav', 'modules/navigation/menuAdmin/creationNouveuMenu.php', 1, 1, 1, 2, 1, 0, '495749294443569', 1),
(78, 'Titres et SEO', 'modules/dataSite/titreInfo.php', 1, 1, 2, 2, 1, 0, '6734544650', 1),
(81, 'Brassage des liens', 'modules/navigation/menuAdmin/dynamique.php', 1, 1, 2, 2, 1, 0, '051661632455', 1),
(82, 'Ajout menu déroulant', 'modules/navigation/menuAdmin/ajoutMenuDeroulant.php', 1, 1, 2, 2, 1, 0, '62014639584', 1),
(85, 'Administration User', 'modules/navigation/erreurNav.php', 1, 0, 0, 2, 1, 6, '9533178394', 1),
(86, 'Users Actif', 'modules/users/administration/droitUser.php', 1, 6, 1, 2, 1, 6, '808722934236204', 1),
(87, 'Route Form', 'modules/navigation/menuAdmin/ajoutRouteForm.php', 1, 1, 2, 2, 1, 0, '6588611476646', 1),
(88, 'Users Anciens ', 'modules/users/administration/droitUserNonValide.php', 1, 6, 2, 2, 1, 0, '54554668544135', 1),
(89, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 19, 1, 1, 0, '36481945255', 1),
(90, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 1, 2, 1, 0, '8284434186843', 1),
(91, 'Journeaux de log', 'modules/journaux/journaux.php', 1, 0, 1, 2, 1, 0, '7690796430596764', 1),
(92, 'Admin nav', 'modules/navigation/menuAdmin/adminMenu.php', 1, 1, 2, 2, 1, 0, '6645916941667443', 1),
(93, 'modification lien nav', 'modules/navigation/menuAdmin/modificationNav.php', 0, 0, 0, 2, 1, 0, '26718324907689', 1),
(95, 'Admin modules', 'modules/navigation/menuAdmin/administrationModules.php', 1, 1, 7, 2, 1, 0, '635739393656732', 1),
(99, 'Add roles', 'modules/users/administration/addRole.php', 1, 6, 3, 2, 1, 0, '5554427991175', 1),
(100, 'Deco', 'modules/securiter/deconnexion.php', 1, 0, 20, 3, 1, 0, '4407275704464', 1),
(101, 'Profil', 'modules/users/administration/profilUser.php', 1, 0, 19, 3, 1, 0, '5152505702494', 1),
(102, 'News', 'modules/navigation/erreurNav.php', 1, 0, 0, 3, 1, 12, 'JtSLs56cwI0CzSU6', 4),
(103, 'Ajouter news', 'sources/news/addArticle.php', 1, 12, 1, 3, 1, 0, '6692709957664132', 4),
(104, 'Admin news', 'sources/news/adminNews.php', 1, 12, 2, 3, 1, 0, '2486050360460398', 4),
(105, 'displayOneNews', 'sources/news/displayOneNews.php', 0, 0, 0, 3, 1, 0, '9653546664813381', 4),
(106, 'Admin Evénements', 'modules/navigation/erreurNav.php', 1, 0, 0, 3, 1, 13, 'zRa5lK86rJ8laBpD', 5),
(107, 'Ajouter événements', 'sources/magasinEvents/administrationEvents/addEvents.php', 1, 13, 1, 3, 1, 0, '9376745490126748', 5),
(108, 'Evénements', 'sources/magasinEvents/publicEvents/visitorEvent.php', 1, 0, 1, 0, 1, 0, '1655445655145226', 5),
(109, 'Voir événements public', 'sources/magasinEvents/publicEvents/visitorEvent.php', 1, 13, 10, 3, 1, 13, '8341956839626749', 5),
(110, 'Admi Events valide', 'sources/magasinEvents/administrationEvents/adminEvents.php', 1, 13, 2, 3, 1, 13, '5593626973338548', 5),
(111, 'Admin événement non valide', 'sources/magasinEvents/administrationEvents/adminUnvalidEvents.php', 1, 13, 3, 3, 1, 13, '6868794398093643', 5),
(112, 'updateEvent', 'sources/magasinEvents/administrationEvents/updateEvent.php', 0, 0, 0, 3, 1, 0, '6180266659696349', 5),
(115, 'Evénements', 'modules/navigation/erreurNav.php', 1, 0, 0, 1, 1, 15, 'i8iujht6y4Guh7pw', 5),
(116, 'Evénements à venir', 'sources/magasinEvents/publicEvents/visitorEvent.php', 1, 15, 0, 1, 1, 0, '4662154494161536', 5),
(117, 'Inscription', 'sources/magasinEvents/publicEvents/registrationEvent.php', 1, 15, 1, 1, 1, 0, '8359196546504532', 5),
(119, 'Admin Réserver tables', 'modules/navigation/erreurNav.php', 1, 0, 0, 3, 1, 16, 'ARxb4uSgFiJyLtBA', 6),
(120, 'Horraire magasin', 'sources/reserveTablesByUser/administration/openCloseShop.php', 1, 16, 1, 3, 1, 16, '9082214856905885', 6),
(121, 'Administration tables', 'sources/reserveTablesByUser/administration/creatNewTable.php', 1, 16, 2, 3, 1, 16, '4550154914706564', 6),
(122, 'Réserver une table', 'sources/reserveTablesByUser/reserveTablePublic/reserveTable.php', 1, 0, 1, 1, 1, 0, '5956617559316644', 6);

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `idRole` int NOT NULL,
  `typeRole` varchar(15) NOT NULL,
  `accreditation` tinyint DEFAULT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`idRole`, `typeRole`, `accreditation`, `valide`) VALUES
(1, 'Visiteur', 0, 1),
(4, 'Membre', 1, 1),
(6, 'Administrateur', 2, 1),
(9, 'gestionnaire', 3, 1);

-- --------------------------------------------------------

--
-- Structure de la table `routageForm`
--

CREATE TABLE `routageForm` (
  `idForm` int NOT NULL,
  `chemin` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `securiter` tinyint(1) NOT NULL DEFAULT '0',
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  `route` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idModule` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `routageForm`
--

INSERT INTO `routageForm` (`idForm`, `chemin`, `securiter`, `valide`, `route`, `idModule`) VALUES
(1, 'modules/users/CUD/Create/inscriptionUser.php', 0, 1, '40573272544413648', 1),
(2, 'modules/securiter/connexionUser.php', 0, 1, '56130141550247353', 1),
(3, 'modules/users/CUD/Update/activationUser.php', 0, 1, '683865634551341', 1),
(4, 'modules/navigation/CUD/Create/addLien.php', 2, 1, '5367666365192262', 1),
(5, 'modules/dataSite/CUD/Update/updateDataSite.php', 2, 1, '18045215641577', 1),
(6, 'modules/navigation/CUD/Create/addMenusDeroulant.php', 2, 1, '87554351856492500835', 1),
(7, 'modules/navigation/CUD/Create/addRouteForm.php', 2, 1, '53123677394037501', 1),
(14, 'modules/users/CUD/Update/modAdminUser.php', 2, 1, '724265056547873648', 1),
(16, 'modules/users/CUD/Update/emailUser.php', 1, 1, '1743687685549351109', 1),
(17, 'modules/users/CUD/Update/loginUser.php', 1, 1, '450876606503765', 1),
(18, 'modules/users/CUD/Update/mdpUser.php', 1, 1, '505487633651165', 1),
(19, 'modules/journaux/deleteLog.php', 2, 1, '888530255958226224', 1),
(20, 'modules/navigation/CUD/update/updateLienNav.php', 2, 1, '81848276875956288651', 1),
(21, 'modules/navigation/CUD/Delete/deleteLienNav.php', 2, 1, '35813470856741', 1),
(22, 'modules/users/CUD/Update/desincriptionUser.php', 1, 1, '26466135657120415', 1),
(23, 'modules/navigation/CUD/update/updateModule.php', 2, 1, '6554444640171448571', 1),
(25, 'modules/navigation/CUD/Create/addModule.php', 2, 1, '62360055791501665', 1),
(29, 'modules/users/CUD/Create/addRoles.php', 2, 1, '1583659740963992405', 1),
(30, 'sources/news/CUD/Creat/CreatNews.php', 3, 1, '33066664806215499867', 4),
(31, 'sources/news/CUD/Update/updateNews.php', 3, 1, '52434474805545648316', 4),
(32, 'sources/news/CUD/Delete/deleteNews.php', 3, 1, '34841666622630462155', 4),
(33, 'sources/news/CUD/Update/updateCompletArticle.php', 3, 1, '79593438775055460464', 4),
(34, 'sources/magasinEvents/CUD/creatEvent.php', 3, 1, '16521690488460956499', 5),
(35, 'sources/magasinEvents/CUD/annulerEvent.php', 3, 1, '73769893431636343669', 5),
(36, 'sources/magasinEvents/CUD/ValiderEvent.php', 3, 1, '62369887507152254553', 5),
(37, 'sources/magasinEvents/CUD/updateEvent.php', 3, 1, '46662172862893666945', 5),
(38, 'sources/magasinEvents/CUD/registrationCUD/signUpEvent.php', 1, 1, '59689945216134056683', 5),
(39, 'sources/magasinEvents/CUD/registrationCUD/unsubscribeEvent.php', 1, 1, '79573522966405646156', 5),
(40, 'sources/magasinEvents/CUD/registrationCUD/deleteUserOnEvent.php', 3, 1, '1580352860546176383', 5),
(41, 'sources/reserveTablesByUser/CUD/Update/ChangeScheduleShop.php', 3, 1, '94414686410666664594', 6),
(42, 'sources/reserveTablesByUser/CUD/Update/AddTablesInShop.php', 3, 1, '37078746567315868600', 6),
(43, 'sources/reserveTablesByUser/CUD/Update/speedUpdateTable.php', 3, 1, '31207897622627285456', 6);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `idUser` int NOT NULL,
  `token` varchar(16) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `prenom` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `nom` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `login` varchar(60) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `mdp` varchar(120) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '0',
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`idUser`, `token`, `email`, `prenom`, `nom`, `login`, `mdp`, `valide`, `role`, `dateCreation`) VALUES
(5, 'WsJoyU5T7l', 'christophe.calmes22@gmail.com', 'Christophe', 'Calmes', 'Aresh', '$2y$10$AEx9/EbLyJ6YTZP4ODO1PunMyO5VcKdHW/aEtUkbKwUwgBmPchUtG', 1, 1, '2022-06-09 22:59:58'),
(7, 'Zo0NEqILvx', 'christophe.massage@orange.fr', 'Christophe', 'Calmes', 'Admin', '$2y$10$oADkGPsXhTD1m1.vawEEJevfSC1BwODMOuCHCntUrBQgpV5TmLy6S', 1, 2, '2022-06-12 14:26:13'),
(8, '3563780644378314', 'denis@gmail.com', 'Denis', 'Lamalice', 'gandalf', '$2y$10$gAR.NNm5ZtibroRRdQoWr.aaAkGl0j3QLjkqZvoxQhjQ86iZeGMvO', 0, 1, '2023-07-17 10:12:24'),
(9, 'sWOjTBkGwN', 'christophe.calmes2020@gmail.com', 'christophe', 'Calmes', 'Beta', '$2y$10$sX8wJ/cn0jeb8kYx8MzGDO5.4Z7LcVf/4YnhmWHJ6W1bi8pTXzufO', 1, 3, '2023-11-03 09:51:16'),
(12, 'cER5frXlg8', 'dscott@rockie.com', 'Emmett', 'Scott', 'dscott', '$2y$10$1msG7rlb1Bt1UOyRlPHDmOMg1FarRcDat3LaHk84cQgcQ.oO1sVim', 1, 1, '2024-03-07 19:37:17'),
(13, 'ZlAsoCumcF', 'brad@rockie.com', 'Brad', 'Major', 'Brad', '$2y$10$DAIG2STV4PCQGRynDMEEe.S.V87rlURldmQ5SFToKH3u4kcwwpIVG', 1, 1, '2024-03-07 19:38:28'),
(14, 'qTNEtH7tW4', 'janet@rockie.com', 'Janet', 'Weiss', 'Janet', '$2y$10$LzD1ASYFKsiPM0KcEkhv/OrVgUdcCBfFxXE5ZsDiOGNPoK8OE54UW', 1, 1, '2024-03-07 19:39:17'),
(15, 'N8uuWZOf2pUdMvu1', 'eddie@rockie.com', 'Eddie', 'Doe', 'Eddie', '$2y$10$HggYYVXmvI/rwcJOvJBDuOg/0GH.VFoBmu8HHZfJx7fDVLbBy74fa', 1, 1, '2024-03-07 19:40:25');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `dataSite`
--
ALTER TABLE `dataSite`
  ADD PRIMARY KEY (`idDataSite`);

--
-- Index pour la table `journaux`
--
ALTER TABLE `journaux`
  ADD PRIMARY KEY (`idConnexion`);

--
-- Index pour la table `menuNav`
--
ALTER TABLE `menuNav`
  ADD PRIMARY KEY (`idMenuDeroulant`);

--
-- Index pour la table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `navigation`
--
ALTER TABLE `navigation`
  ADD PRIMARY KEY (`idNav`),
  ADD KEY `lierModule` (`idModule`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`idRole`);

--
-- Index pour la table `routageForm`
--
ALTER TABLE `routageForm`
  ADD PRIMARY KEY (`idForm`),
  ADD KEY `lienModule` (`idModule`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `dataSite`
--
ALTER TABLE `dataSite`
  MODIFY `idDataSite` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `journaux`
--
ALTER TABLE `journaux`
  MODIFY `idConnexion` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=219;

--
-- AUTO_INCREMENT pour la table `menuNav`
--
ALTER TABLE `menuNav`
  MODIFY `idMenuDeroulant` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `navigation`
--
ALTER TABLE `navigation`
  MODIFY `idNav` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `idRole` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `routageForm`
--
ALTER TABLE `routageForm`
  MODIFY `idForm` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `navigation`
--
ALTER TABLE `navigation`
  ADD CONSTRAINT `lierModule` FOREIGN KEY (`idModule`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `routageForm`
--
ALTER TABLE `routageForm`
  ADD CONSTRAINT `lienModule` FOREIGN KEY (`idModule`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
