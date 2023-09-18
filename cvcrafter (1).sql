-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 18 sep. 2023 à 06:44
-- Version du serveur : 8.0.33
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `cvcrafter`
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `competence`
--

INSERT INTO `competence` (`id`, `utilisateurs_id`, `nom`, `niveau`) VALUES
(1, 3, 'Graphisme', 'Fort');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `experience`
--

INSERT INTO `experience` (`id`, `utilisateurs_id`, `poste`, `employeur`, `ville`, `date_start`, `date_end`, `description`) VALUES
(1, 3, 'Graphiste', 'dgsfdg', 'Mougins', '2023-09-01', '2023-09-10', 'sdczfcd'),
(2, 3, 'hfudhfiusfd', 'dfdfdf', 'dfdfdf', '2023-09-01', '2023-09-06', 'fdfdfdf'),
(3, 3, 'ddf', 'dfdf', 'dfdfdf', '2023-09-06', '2023-09-29', 'dfdf'),
(4, 5, 'Editrice', 'Hachette', 'Paris', '2023-07-05', '2023-10-14', 'Editrice jeunesse chez Hachette');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`id`, `utilisateurs_id`, `nom_formation`, `nom_etablissement`, `ville`, `date_start`, `date_end`, `description`) VALUES
(1, 3, 'Dev Web', 'La Plateforme', 'Cannes', '2023-09-01', '2023-09-30', 'La Plateforme'),
(2, 3, 'Dev Web', 'La Plateforme', 'Cannes', '2023-09-01', '2023-09-28', 'La Plateforme');

-- --------------------------------------------------------

--
-- Structure de la table `interet`
--

DROP TABLE IF EXISTS `interet`;
CREATE TABLE IF NOT EXISTS `interet` (
  `id` int NOT NULL AUTO_INCREMENT,
  `utilisateurs_id` int NOT NULL,
  `nom` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `interet`
--

INSERT INTO `interet` (`id`, `utilisateurs_id`, `nom`) VALUES
(1, 3, 'Dessin'),
(2, 3, 'Lire');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `langue`
--

INSERT INTO `langue` (`id`, `utilisateurs_id`, `nom`, `niveau`) VALUES
(1, 3, 'Allemand', 'Scolaire');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `prenom`, `nom`, `password`, `phone`, `postal`, `ville`, `photo`) VALUES
(1, 'lilo', 'loa', 'nao', '$2y$10$HiLU.pZdkCQQjf/uYjyFN.v7B9qGZwS/Ey1qn/ux/ePiCg.WYem8C', '55984984', '06250', 'Mougins', '97aa0abf.jpg'),
(2, 'fziegz', 'mario', 'alvaro', 'plom', '06840248', '061452', 'Cannes', '1.png'),
(3, 'oser5', 'lisa', 'pech', 'plom', '06548841', '06160', 'Vallauris', '1.png'),
(4, 'estelle', 'estelle', 'dose', '$2y$10$1N.MobtaSjbl1T2XHFq21.4KtVc.YBtkUTnvmnqpJFC399F6vYAE.', '06488585', '06150', 'Antibes', '1.png'),
(5, 'chouchou', 'qsdf', 'qsfd', 'Etoile', '067832568', '06150', 'Cannes', '1.png'),
(6, 'Hanasun', 'Estelle', 'Dose', '', '528524', '06250', 'Mougins', '18.jpg'),
(7, 'a', 'b', 'a', '', '48921562', '11112', 'Mougins', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
