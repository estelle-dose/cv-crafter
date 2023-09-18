-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 14 sep. 2023 à 11:40
-- Version du serveur : 8.0.32
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cv-crafter`
--

-- --------------------------------------------------------

--
-- Structure de la table `competence`
--

DROP TABLE IF EXISTS `competence`;
CREATE TABLE IF NOT EXISTS `competence` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `nom` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `cv_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cv`
--

DROP TABLE IF EXISTS `cv`;
CREATE TABLE IF NOT EXISTS `cv` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `experience`
--

DROP TABLE IF EXISTS `experience`;
CREATE TABLE IF NOT EXISTS `experience` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `poste` varchar(255) NOT NULL,
  `employeur` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `cv_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `nom_formation` varchar(255) NOT NULL,
  `nom_etablissement` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `cv_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `interet`
--

DROP TABLE IF EXISTS `interet`;
CREATE TABLE IF NOT EXISTS `interet` (
  `id` int NOT NULL,
  `utilisateurs_id` int NOT NULL,
  `nom` int NOT NULL,
  `cv_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `langue`
--

DROP TABLE IF EXISTS `langue`;
CREATE TABLE IF NOT EXISTS `langue` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `nom` varchar(255) NOT NULL,
  `niveau` varchar(255) NOT NULL,
  `cv_id` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `phone` varchar(55) NOT NULL,
  `postal` varchar(255) NOT NULL,
  `ville` varchar(255) NOT NULL,
  `photo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'profil_default.jpg',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`, `phone`, `postal`, `ville`, `photo`) VALUES
(1, 'lilo', 'lo', 'nao', 'plom', '', '', '', NULL),
(2, 'fziegz', 'mario', 'alvaro', 'plom', '06840248', '061452', 'Cannes', '1.png'),
(3, 'oser5', 'lisa', 'pech', 'plom', '06548841', '06160', 'Vallauris', '1.png'),
(4, 'estelle', 'estelle', 'dose', 'plom', '06488585', '061520', 'Antibes', '1.png'),
(5, 'chouchou', 'qsdf', 'qsfd', '', '067832568', '06150', 'Cannes', '1.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
