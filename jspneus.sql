--
-- Base de données :  `jspneus`
--

-- --------------------------------------------------------

--
-- Structure de la table `pneus`
--

CREATE TABLE IF NOT EXISTS `pneus` (
  `reference` int(11) NOT NULL DEFAULT '0',
  `categorie` varchar(50) DEFAULT NULL,
  `dimension` varchar(50) DEFAULT NULL,
  `largeur` int(11) DEFAULT NULL,
  `serie` int(11) DEFAULT NULL,
  `jante` int(11) DEFAULT NULL,
  `charge` int(11) DEFAULT NULL,
  `vitesse` varchar(10) DEFAULT NULL,
  `consommation` varchar(10) DEFAULT NULL,
  `adherence` varchar(10) DEFAULT NULL,
  `bruit` int(11) DEFAULT NULL,
  `decibel` int(11) DEFAULT NULL,
  `marque` varchar(50) DEFAULT NULL,
  `profil` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `prix` float DEFAULT NULL,
  PRIMARY KEY (`reference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `pneus`
--

INSERT INTO `pneus` (`reference`, `categorie`, `dimension`, `largeur`, `serie`, `jante`, `charge`, `vitesse`, `consommation`, `adherence`, `bruit`, `decibel`, `marque`, `profil`, `stock`, `prix`) VALUES
(24965, 'TOURISME HIVER', '155/80 R13 79T', 155, 80, 13, 79, 'T', 'E', 'E', 2, 71, 'INFINITY', 'INF 049', 71, 79.99),
(24966, 'TOURISME HIVER', '155/80 R13 79T', 155, 80, 13, 79, 'T', 'E', 'E', 2, 71, 'INFINITY', 'INF 050', 50, 96.32),
(24967, 'TOURISME HIVER', '160/80 R13 79T', 160, 80, 13, 79, 'T', 'E', 'E', 2, 71, 'INFINITY', 'INF 050', 71, 123.23),
(24970, 'TOURISME HIVER', '155/80 R13 79T', 155, 80, 13, 79, 'T', 'E', 'E', 2, 71, 'TEST', 'INF 050', 50, 90),
(92788, 'TOURISME HIVER', '155/70 R13 75T', 155, 70, 13, 75, 'T', 'F', 'C', 2, 71, 'ACHILLES', 'W101 DOT13', 2, 45.15);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`user_id`, `user_nom`, `user_prenom`, `user_mail`, `user_password`, `user_connecte`, `user_newsletter`) VALUES
(1, 'test_nom', 'test_prenom', 'test_mail', 'test_mdp', 0, 1),
(3, 'Sam', 'Evo', 'test@testmail.com', '$2y$10$wc6TgjWtTdp7VhfukzHMLOBkBX6i/o98oAYcAj9CIVv6ISI6nZOpi', 0, 1),
(4, 'Sam', 'GHFD', 'samonil@hotmail.fr', '$2y$10$hdEHiwfPAJX.RFY8rB78duZQCgYf1JtwAhTN0zeJh.Z3DmoXcwIU.', 0, 1),
(5, 'Gui', 'Lo', 'hus@gmail.com', '$2y$10$zl8dfdlgf53gdGAxf8SOGOME3GoQkxk8Sx.MkSgQ2m7Th4zVAmJou', 1, 1),
(6, 'Deb', 'Mada', 'debphil@hotmail.fr', '$2y$10$oiLrqvJmhiYWaFjRtwmutuE/ohLsWIAIOox6meTsFMgrNfvgFgI.W', 1, 1),
(7, '', 'tes', 'samonil2@hotmail.fr', '$2y$10$Ny45bDNJHBE4dVX6hGYSkukbyarAKJVJfT5XTybP1R.sj3XUARO2C', 1, 1);