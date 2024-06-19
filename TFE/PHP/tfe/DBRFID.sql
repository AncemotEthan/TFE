-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 31 mai 2024 à 20:42
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dbrfid`
--

-- --------------------------------------------------------

--
-- Structure de la table `historique_connexions`
--

CREATE TABLE `historique_connexions` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `statut_connexion` enum('acceptee','refusee') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `historique_connexions`
--

INSERT INTO `historique_connexions` (`id`, `user_id`, `statut_connexion`, `timestamp`) VALUES
(2, 'D3ECF9FA', 'acceptee', '2024-05-26 13:19:45'),
(3, '239731fb', 'refusee', '2024-05-26 13:19:50'),
(4, 'D3ECF9FA', 'acceptee', '2024-05-26 13:21:37'),
(5, '239731fb', 'refusee', '2024-05-26 13:21:49'),
(6, 'D3ECF9FA', 'acceptee', '2024-05-26 13:25:09'),
(7, 'D3ECF9FA', 'acceptee', '2024-05-26 13:25:22'),
(8, 'D3ECF9FA', 'acceptee', '2024-05-26 13:25:31'),
(9, 'D3ECF9FA', 'acceptee', '2024-05-26 13:32:04'),
(10, '3302f5fa', 'refusee', '2024-05-26 13:32:13'),
(11, '3302f5fa', 'refusee', '2024-05-26 13:38:19'),
(12, 'D3ECF9FA', 'acceptee', '2024-05-26 13:38:28'),
(13, 'D3ECF9FA', 'acceptee', '2024-05-26 13:38:36'),
(14, 'D3ECF9FA', 'acceptee', '2024-05-26 13:41:32'),
(15, 'D3ECF9FA', 'acceptee', '2024-05-26 13:41:40'),
(16, '3302f5fa', 'refusee', '2024-05-26 15:28:11'),
(17, '3302f5fa', 'refusee', '2024-05-26 15:28:13'),
(18, 'D3ECF9FA', 'acceptee', '2024-05-26 15:28:19'),
(19, 'D3ECF9FA', 'acceptee', '2024-05-26 15:31:24'),
(20, 'D3ECF9FA', 'acceptee', '2024-05-26 19:45:19'),
(21, 'D3ECF9FA', 'refusee', '2024-05-26 19:45:26'),
(22, 'D3ECF9FA', 'refusee', '2024-05-26 19:46:36'),
(23, 'D3ECF9FA', 'acceptee', '2024-05-26 19:46:50'),
(24, 'D3ECF9FA', 'acceptee', '2024-05-26 19:47:22'),
(25, 'D3ECF9FA', 'acceptee', '2024-05-26 19:47:31'),
(26, '3302F5FA', 'refusee', '2024-05-26 19:48:19'),
(27, 'D3ECF9FA', 'acceptee', '2024-05-27 16:20:59'),
(28, 'D3ECF9FA', 'acceptee', '2024-05-27 16:23:02'),
(29, 'D3ECF9FA', 'acceptee', '2024-05-27 16:30:22'),
(30, 'D3ECF9FA', 'acceptee', '2024-05-28 19:20:51'),
(31, '03EDEEFA', 'refusee', '2024-05-29 13:19:35'),
(32, '03EDEEFA', 'refusee', '2024-05-29 13:21:22'),
(33, '03EDEEFA', 'refusee', '2024-05-29 13:22:42'),
(34, '624EF751', 'refusee', '2024-05-29 13:23:01'),
(35, 'A383EFFA', 'refusee', '2024-05-29 13:23:11'),
(36, '239731FB', 'refusee', '2024-05-29 13:23:20'),
(37, '3302F5FA', 'refusee', '2024-05-29 13:23:28'),
(38, '62FCC351', 'refusee', '2024-05-29 13:23:37'),
(39, '239731FB', 'refusee', '2024-05-29 14:24:28'),
(40, '239731FB', 'refusee', '2024-05-29 14:24:49'),
(41, 'D3ECF9FA', 'refusee', '2024-05-29 14:42:52'),
(42, 'D3ECF9FA', 'acceptee', '2024-05-30 07:28:53'),
(43, '624EF751', 'refusee', '2024-05-30 07:29:02'),
(44, '624EF751', 'refusee', '2024-05-30 07:33:20'),
(45, 'D3ECF9FA', 'refusee', '2024-05-30 07:34:42'),
(46, '624EF751', 'refusee', '2024-05-30 07:35:23'),
(47, '624EF751', 'refusee', '2024-05-30 07:35:29'),
(48, 'D3ECF9FA', 'refusee', '2024-05-30 07:35:39'),
(49, '624EF751', 'refusee', '2024-05-30 07:36:51'),
(50, '624EF751', 'refusee', '2024-05-30 07:37:21'),
(51, '624EF751', 'refusee', '2024-05-30 07:37:30'),
(52, '624EF751', 'refusee', '2024-05-30 07:37:45'),
(53, '624EF751', 'refusee', '2024-05-30 07:40:18'),
(54, 'D3ECF9FA', 'acceptee', '2024-05-30 07:40:32'),
(55, 'D3ECF9FA', 'acceptee', '2024-05-30 07:41:11'),
(56, 'D3ECF9FA', 'acceptee', '2024-05-30 07:42:34'),
(57, 'D3ECF9FA', 'acceptee', '2024-05-30 07:43:07'),
(58, '624EF751', 'refusee', '2024-05-30 07:44:34'),
(59, 'D3ECF9FA', 'acceptee', '2024-05-31 15:02:35'),
(60, 'D3ECF9FA', 'acceptee', '2024-05-31 15:03:32'),
(61, 'D3ECF9FA', 'acceptee', '2024-05-31 15:06:16'),
(62, 'D3ECF9FA', 'acceptee', '2024-05-31 15:13:46'),
(63, 'D3ECF9FA', 'acceptee', '2024-05-31 15:47:52'),
(64, 'D3ECF9FA', 'acceptee', '2024-05-31 15:48:03'),
(65, 'D3ECF9FA', 'acceptee', '2024-05-31 15:49:19'),
(66, 'D3ECF9FA', 'acceptee', '2024-05-31 15:50:07'),
(67, 'D3ECF9FA', 'acceptee', '2024-05-31 15:50:16'),
(68, 'D3ECF9FA', 'acceptee', '2024-05-31 15:50:25'),
(69, 'D3ECF9FA', 'acceptee', '2024-05-31 15:50:40'),
(70, 'D3ECF9FA', 'acceptee', '2024-05-31 15:52:26'),
(71, 'D3ECF9FA', 'acceptee', '2024-05-31 15:57:19'),
(72, 'A383EFFA', 'refusee', '2024-05-31 16:07:23'),
(73, 'A383EFFA', 'acceptee', '2024-05-31 16:07:32');

-- --------------------------------------------------------

--
-- Structure de la table `users_data`
--

CREATE TABLE `users_data` (
  `name` varchar(100) NOT NULL,
  `id` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(100) NOT NULL,
  `user_rights` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users_data`
--

INSERT INTO `users_data` (`name`, `id`, `gender`, `email`, `mobile`, `user_rights`) VALUES
('Ethan', 'D3ECF9FA', 'Homme', 'airthan35@gmail.com', '0472967175', 1);

-- --------------------------------------------------------

--
-- Structure de la table `users_login`
--

CREATE TABLE `users_login` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users_login`
--

INSERT INTO `users_login` (`id`, `username`, `password`, `email`, `created_at`) VALUES
(1, 'Ethan', '$2y$10$dZ1mm8gSm/vavEmzqUykv.G/HSEVGBKVRxRx4rUC44o1N9sS9DnVe', 'airthan35@gmail.com', '2024-05-20 18:46:03'),
(3, 'Antoine', '$2y$10$dZ1mm8gSm/vavEmzqUykv.G/HSEVGBKVRxRx4rUC44o1N9sS9DnVe', 'airthan35@gmail.com', '2024-05-20 18:47:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `historique_connexions`
--
ALTER TABLE `historique_connexions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `historique_connexions`
--
ALTER TABLE `historique_connexions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT pour la table `users_login`
--
ALTER TABLE `users_login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
