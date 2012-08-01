-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 01 Août 2012 à 12:10
-- Version du serveur: 5.5.24
-- Version de PHP: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `site_news`
--
CREATE DATABASE `site_news` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `site_news`;

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `id_news` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Contenu de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `id_news`, `commentaire`) VALUES
(10, 11, 'OÃ¹ sont les toilettes ? (Delphine)'),
(12, 11, 'Cool (Anonyme)'),
(13, 11, 'GÃ©nial ! (Prosper)'),
(14, 11, '42 (Kane)'),
(15, 11, 'Et voilÃ  ! (yop)'),
(16, 11, 'yo (Poly2)'),
(17, 11, 'La marmotte.			 (NuageCiel)'),
(18, 11, 'GG ! (Anonyme)'),
(19, 12, 'Et un peu Ã  moi ! (Nuage)'),
(20, 11, 'Hello\r\n	 (Nuage)'),
(21, 12, 'En fait c''est LE MIEN !!	 (Nuage)'),
(22, 12, 'JYFFJYF (Nuage)'),
(23, 11, 'Mon comm\r\n (Anonyme)'),
(24, 9, 'Mon com (Anonyme)'),
(25, 12, 'Yeah (Anonyme)'),
(26, 9, 'xD\r\n (Gnu)'),
(27, 11, 'J''lache un commmm xd ptdr (Anonyme)'),
(28, 8, 'GÃ©nial\r\n		 (Gnu2)'),
(29, 10, 'mon commentaire (Karchnu)'),
(30, 12, 'Cool Raoul ;) (Juliette)'),
(31, 12, 'Souris ! (GÃ©rard)'),
(32, 9, 'GÃ©gÃ© :P (GÃ©rard)'),
(33, 8, 'Chuis anonyme... (Anonyme)'),
(34, 10, 'mon comm (Anonyme)'),
(35, 10, 'bla (Juliette)'),
(36, 12, 'coucou (Poly2)');

-- --------------------------------------------------------

--
-- Structure de la table `membres`
--

CREATE TABLE IF NOT EXISTS `membres` (
  `pseudo` varchar(25) NOT NULL,
  `password` varchar(41) NOT NULL,
  PRIMARY KEY (`pseudo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membres`
--

INSERT INTO `membres` (`pseudo`, `password`) VALUES
('Alpha', 'a295e0bdde1938d1fbfd343e5a3e569e868e1465'),
('Gnu', 'ba324ca7b1c77fc20bb970d5aff6eea9377918a5'),
('Julie', '50f27cd8f4589ebe5886b19993fab6df309d6967'),
('Karchnu', '4827956a9765bf1ba5e492db18c60d4acbf0c373'),
('Nuage', '01a5158fc1def1a1607f3f5f4c5524c114c1e91d'),
('Poly', 'ae93407c39582ec7f712ea97f46b798607e8ac80'),
('Renard', '430ca8cfd8d3eaab4ab95574ecd63df8136fe28b'),
('tux', 'ba324ca7b1c77fc20bb970d5aff6eea9377918a5'),
('yop', '906e82256aa4d48abf153b5fa18a1e4055fa9a0b');

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` varchar(60) NOT NULL,
  `contenu` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `news`
--

INSERT INTO `news` (`id`, `titre`, `contenu`) VALUES
(8, 'Youpi (par Nuage)', 'C''est la danse des canards.\r\nTsoin. Tsoin.'),
(9, 'Le Yukulele (par Nuage)', 'Quel bel instrument !'),
(10, 'News 1 (par Julie)', 'Ã‰crivez votre news ici !!!!!!'),
(11, 'news2 (par Julie)', 'lol'),
(12, 'Mon canapÃ© (par Poly)', 'Il est grand.\r\nIl est beau.\r\nIl est violet.\r\nEt surtout...\r\n...il est Ã€ MOI !!!!'),
(13, 'Scoop (par Julie)', 'Il fait beau !');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
