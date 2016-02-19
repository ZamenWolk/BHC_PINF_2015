-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Ven 19 Février 2016 à 15:54
-- Version du serveur :  5.6.17-log
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `jspneus`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nom` varchar(255) DEFAULT NULL,
  `user_prenom` varchar(255) DEFAULT NULL,
  `user_mail` varchar(255) NOT NULL DEFAULT '',
  `user_password` varchar(255) DEFAULT NULL,
  `user_connecte` tinyint(1) NOT NULL DEFAULT '0',
  `user_newsletter` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`,`user_mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_password`, `user_connecte`, `user_newsletter`) VALUES
(1, 'test_nom', 'test_prenom', 'test_mail', 'test_mdp', 0, 1),
(3, 'Sam', 'Evo', 'test@testmail.com', '$2y$10$wc6TgjWtTdp7VhfukzHMLOBkBX6i/o98oAYcAj9CIVv6ISI6nZOpi', 0, 1),
(4, 'Sam', 'GHFD', 'samonil@hotmail.fr', '$2y$10$hdEHiwfPAJX.RFY8rB78duZQCgYf1JtwAhTN0zeJh.Z3DmoXcwIU.', 0, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
