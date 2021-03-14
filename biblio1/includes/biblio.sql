-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 17 fév. 2021 à 17:11
-- Version du serveur :  10.4.6-MariaDB
-- Version de PHP : 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `biblio`
--
CREATE DATABASE IF NOT EXISTS biblio;
USE biblio;
-- --------------------------------------------------------

--
-- Structure de la table `abonne`
--

CREATE TABLE IF NOT EXISTS `abonne` (
  `id` int(11) NOT NULL,
  `pseudo` varchar(30) NOT NULL,
  `mdp` varchar(80) NOT NULL,
  `niveau` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `abonne`
--

INSERT INTO `abonne` (`id`, `pseudo`, `mdp`, `niveau`) VALUES
(2, 'anakin', '$2y$10$kjT9rZi2MzTt3lDcLRk/wOsdH6U4/xVKGNuFzW3mzMbaP7iEr/uHO', 10),
(4, 'solo', '$2y$10$RR5QCLk42YNFzSuRWPRhbOAg7kj182m7DxEj0qiSNW6pzL6AiHnOG', 30),
(12, 'stark', '$2y$10$YG2737pM.PcValJO/XDs3eYxG63qQRDhDBULSkJII.HzkcrWTdZfq', 10),
(14, 'admin', '$2y$10$aU.ps8qUCMFhG6lsDcYYPuO//CYi6cRzk5FlccvX2KB3FRv6xZ6Ii', 50),
(16, 'directeur', '$2y$10$.YUVralH0TTwT0.TavE9TeNokfuBqp.oU3s3FRtPUSWwTH15ANHOO', 50);

-- --------------------------------------------------------

--
-- Structure de la table `emprunt`
--

CREATE TABLE IF NOT EXISTS `emprunt` (
  `id` int(11) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date DEFAULT NULL,
  `abonne_id` int(11) NOT NULL,
  `livre_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `emprunt` (`id`, `date_emprunt`, `date_retour`, `abonne_id`, `livre_id`) VALUES
(1, '2021-02-18', '2021-02-01', 2, 1),
(2, '2021-02-03', '2021-02-01', 4, 2),
(3, '2021-02-18', NULL, 2, 3),
(4, '2021-02-18', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `livre`
--

CREATE TABLE IF NOT EXISTS `livre` (
  `id` int(11) NOT NULL,
  `titre` varchar(50) NOT NULL,
  `auteur` varchar(50) NOT NULL,
  `couverture` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `livre`
--

INSERT INTO `livre` (`id`, `titre`, `auteur`, `couverture`) VALUES
(1, '1984', 'George Orwell', '602bef4dbfd071984.jpg'),
(2, 'Dune', 'Frank Herbert', '602cece88cc75Dune.jpg'),
(3, 'Fondation', 'Isaac Asimov', '602ced016c834Fondation.jpg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `abonne`
--
ALTER TABLE `abonne`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pseudo` (`pseudo`);

--
-- Index pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `abonne_id` (`abonne_id`),
  ADD KEY `livre_id` (`livre_id`);

--
-- Index pour la table `livre`
--
ALTER TABLE `livre`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `abonne`
--
ALTER TABLE `abonne`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `emprunt`
--
ALTER TABLE `emprunt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `livre`
--
ALTER TABLE `livre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `emprunt`
--
ALTER TABLE `emprunt`
  ADD CONSTRAINT `emprunt_ibfk_1` FOREIGN KEY (`abonne_id`) REFERENCES `abonne` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `emprunt_ibfk_2` FOREIGN KEY (`livre_id`) REFERENCES `livre` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
