-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 14 juin 2023 à 12:44
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

-- --------------------------------------------------------

--
-- Structure de la table `choices`
--

DROP TABLE IF EXISTS `choices`;
CREATE TABLE IF NOT EXISTS `choices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_question` int NOT NULL,
  `reponse` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `bonne_reponse` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_question` (`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `linkquestquizz`
--

DROP TABLE IF EXISTS `linkquestquizz`;
CREATE TABLE IF NOT EXISTS `linkquestquizz` (
  `id_question` int NOT NULL,
  `id_quizz` int NOT NULL,
  KEY `id_question` (`id_question`),
  KEY `id_quizz` (`id_quizz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id_question` int NOT NULL AUTO_INCREMENT,
  `id_quizz` int DEFAULT NULL,
  `intitule` varchar(255) DEFAULT NULL,
  `difficulte` int DEFAULT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`id_question`),
  KEY `id_quizz` (`id_quizz`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_test`, `pseudo`, `email`, `password`, `role`) VALUES
(22, 'gsm', 'stivegamy@outlook.fr', 'ffd95b7cdbe67e5e736f304f42ed96fc925b9f65', 'admin'),
(23, 'stive', 'stivegamy@outlook.fr', 'f88edff032ba24c8d9559fd3207c6a48eeeaf633', 'utilisateur');

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
-- Contraintes pour la table `linkquestquizz`
--
ALTER TABLE `linkquestquizz`
  ADD CONSTRAINT `linkquestquizz_ibfk_1` FOREIGN KEY (`id_question`) REFERENCES `questions` (`id_question`),
  ADD CONSTRAINT `linkquestquizz_ibfk_2` FOREIGN KEY (`id_quizz`) REFERENCES `quizzes` (`id_quizz`);

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
