-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 07 juil. 2023 à 10:41
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
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `choices`
--

INSERT INTO `choices` (`id_choice`, `id_question`, `bonne_reponse`, `reponse`, `reponce`, `reponze`) VALUES
(118, 148, 'Tek&No ?  ', 'Daft&Punk ?', 'Tek&Ken ? ', 'Tek&Nik ?'),
(119, 149, '  Occulus reparo ', 'Wingardium LeviOsa', 'Rictus Sempra', 'Petrificus Totalus'),
(120, 150, '  Mario Kart Double Dash  ', 'Mario Kart 8', 'Mario Kart DS', 'Mario Kart 7'),
(121, 151, 'Foot', 'Petit pas', 'Fusse', 'FUT'),
(128, 158, 'Balises fixes définis par le langage', 'Balises définis par l’utilisateur', 'Balises prédéfinis', 'Balises uniquement pour les liens'),
(129, 159, 'Id', 'Came', 'Classe', 'Text'),
(135, 165, 'Uruguay', 'Etats-Unis', 'Mexique', 'France'),
(136, 166, 'Argentin', 'Mexicain', 'Chilien', 'Brésilien'),
(137, 167, 'Pogba', 'Bakary Sagna', 'Dimitri Payet', 'Kingsley Coman'),
(138, 168, 'Afrique du Sud', 'Côte d\'Ivoire', 'Algérie', 'Nigéria'),
(139, 169, 'Girondins de Bordeaux', 'PSG', 'FC Nantes', 'AS Saint-Etienne');

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
) ENGINE=InnoDB AUTO_INCREMENT=170 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id_question`, `id_quizz`, `intitule`, `date_creation`) VALUES
(148, 93, 'Dans Foot2rue, et plus précisément dans l’équipe que l’on suit dans la série comment s’appelle les jumeaux de l’équipe ?', '2023-07-04'),
(149, 93, 'Dans les films Harry Potter, quel sort « running gag » lance Hermione à Harry lors de leurs années à Poudlard ?', '2023-07-04'),
(150, 93, 'Dans quel Mario Kart peut-on être à deux sur un même kart ? ', '2023-07-04'),
(151, 93, 'Quel est le nom du clan ennemi des tortue ninjas ?', '2023-07-04'),
(158, 97, 'HTML utilise des _____', '2023-07-05'),
(159, 97, ' Si nous souhaitons définir le style d’un seule élément, quel sélecteur CSS utiliserons-nous?', '2023-07-05'),
(165, 103, 'Dans quel pays se déroule la toute première Coupe du Monde de football en 1930 ?', '2023-07-07'),
(166, 103, 'Quelle est la nationalité de Lionel Messi ?', '2023-07-07'),
(167, 103, 'A l\'euro 2016, quel joueur français s\'est présenté avec un coq blanc dessiné sur le côté droit de la tête ?', '2023-07-07'),
(168, 103, 'Lequel de ces pays n\'a pas remporté la Coupe d\'Afrique des nations entre 2010 et 2020 ?', '2023-07-07'),
(169, 103, 'À quelle équipe de foot est associé le Stade Matmut Atlantique ?', '2023-07-07');

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
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `quizzes`
--

INSERT INTO `quizzes` (`id_quizz`, `id_test`, `titre`, `difficulte`, `date_creation`) VALUES
(93, 14, 'Random', 1, '2023-07-04'),
(97, 14, 'Développement web', 1, '2023-07-05'),
(103, 25, 'Foot', 2, '2023-07-07');

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
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id_test`, `pseudo`, `email`, `password`, `role`) VALUES
(14, 'paul', 'polo@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'admin'),
(24, 'JEEE', 'JEEE@GMAIL.COM', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'utilisateur'),
(25, 'zakijr', 'dzdz@gmail.com', '7f7d6e7fad8a7e840b92ac6b4922a1fc1e0545f3', 'quizzer');

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
-- Déchargement des données de la table `user_quizz`
--

INSERT INTO `user_quizz` (`id_test`, `id_quizz`, `score`) VALUES
(24, 93, '50'),
(14, 93, '30'),
(25, 93, '10'),
(25, 103, '30');

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
