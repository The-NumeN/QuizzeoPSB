-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : lun. 26 juin 2023 à 12:42
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `quizzeo`
--
create database quizzeo;
use quizzeo;
-- --------------------------------------------------------

--
-- Structure de la table `choices`
--

DROP TABLE IF EXISTS `choices`;
CREATE TABLE IF NOT EXISTS `choices` (
  `id_choice` int NOT NULL AUTO_INCREMENT,
  `id_question` int NOT NULL,
  `bonne_reponse` varchar(100) NOT NULL,
  `reponse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `reponce` varchar(100) NOT NULL,
  `reponze` varchar(100) NOT NULL,
  PRIMARY KEY (`id_choice`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `choices`
--

INSERT INTO `choices` (`id_choice`, `id_question`, `bonne_reponse`, `reponse`, `reponce`, `reponze`) VALUES
(1, 9, 'B', 'C', 'D', 'E'),
(2, 10, 'marche', 're', 'ess', 'aye');

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int NOT NULL AUTO_INCREMENT,
  `id_quizz` int NOT NULL,
  `intitule` varchar(255) DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`id_question`),
  KEY `id_quizz` (`id_quizz`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_question`, `id_quizz`, `intitule`, `date_creation`) VALUES
(7, 17, 'STP', '2023-06-23'),
(8, 18, 'A', '2023-06-23'),
(9, 19, 'A', '2023-06-23'),
(10, 20, 'sa', '2023-06-26');

-- --------------------------------------------------------

--
-- Structure de la table `quizzes`
--

DROP TABLE IF EXISTS `quizzes`;
CREATE TABLE IF NOT EXISTS `quizzes` (
  `id_quizz` int NOT NULL AUTO_INCREMENT,
  `id_test` int NOT NULL,
  `titre` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `difficulte` int NOT NULL,
  `date_creation` date NOT NULL,
  PRIMARY KEY (`id_quizz`),
  KEY `id_quizzer` (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id_quizz`, `id_test`, `titre`, `difficulte`, `date_creation`) VALUES
(17, 20, 'tessttt', 2, '2023-06-23'),
(18, 20, 'zxx', 1, '2023-06-23'),
(19, 20, 'Développeur web', 1, '2023-06-23'),
(20, 16, 'Stive ', 3, '2023-06-26');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_test` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` enum('utilisateur','quizzer','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_test`, `pseudo`, `email`, `password`, `role`) VALUES
(14, 'paul', 'polo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin'),
(16, 'stive', 'sad@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'quizzer'),
(20, 'BMG', 'CC@GMAIL.COM', 'd5f12e53a182c062b6bf30c1445153faff12269a', 'quizzer'),
(21, 'ABC', 'ABC@gmail.com', '8cb2237d0679ca88db6464eac60da96345513964', 'quizzer'),
(22, 'aqz', 'csc@gmail.com', '4c1b52409cf6be3896cf163fa17b32e4da293f2e', 'quizzer'),
(23, 'xsxx', 'xzx@gmail.com', 'c7d6801df723bd569e53aa0edb1a5917ae4078c8', 'quizzer'),
(24, 'JEEE', 'JEEE@GMAIL.COM', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'utilisateur');

-- --------------------------------------------------------

--
-- Structure de la table `user_quizz`
--

DROP TABLE IF EXISTS `user_quizz`;
CREATE TABLE IF NOT EXISTS `user_quizz` (
  `id_test` int NOT NULL,
  `id_quizz` int NOT NULL,
  `score` varchar(100) NOT NULL,
  KEY `id_quizz` (`id_quizz`),
  KEY `id_test` (`id_test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `choices`
--
ALTER TABLE `choices`
  ADD CONSTRAINT `choices_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`);

--
-- Contraintes pour la table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_quizz`) REFERENCES `quizzes` (`id_quizz`);

--
-- Contraintes pour la table `quizzes`
--
ALTER TABLE `quizzes`
  ADD CONSTRAINT `quizzes_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `users` (`id_test`);

--
-- Contraintes pour la table `user_quizz`
--
ALTER TABLE `user_quizz`
  ADD CONSTRAINT `user_quizz_ibfk_1` FOREIGN KEY (`id_test`) REFERENCES `users` (`id_test`),
  ADD CONSTRAINT `user_quizz_ibfk_2` FOREIGN KEY (`id_quizz`) REFERENCES `quizzes` (`id_quizz`),
  ADD CONSTRAINT `user_quizz_ibfk_3` FOREIGN KEY (`id_test`) REFERENCES `users` (`id_test`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
