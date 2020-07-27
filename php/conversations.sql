-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Lun 27 Juillet 2020 à 22:09
-- Version du serveur :  5.6.21
-- Version de PHP :  5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `chat`
--

-- --------------------------------------------------------

--
-- Structure de la table `conversations`
--

CREATE TABLE IF NOT EXISTS `conversations` (
`id` int(11) NOT NULL,
  `user_from` varchar(255) NOT NULL,
  `user_to` varchar(255) NOT NULL,
  `sent_at` bigint(20) NOT NULL,
  `statut` varchar(20) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Contenu de la table `conversations`
--

INSERT INTO `conversations` (`id`, `user_from`, `user_to`, `sent_at`, `statut`, `message`) VALUES
(1, 'Omoi', 'Melen', 155574854545440, 'not seen', 'Hello!'),
(2, 'Omoi', 'Sakura', 155574854545440, 'seen', 'Hello!');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `conversations`
--
ALTER TABLE `conversations`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `conversations`
--
ALTER TABLE `conversations`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
