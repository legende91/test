-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Client: 127.0.0.1
-- Généré le: Mar 11 Février 2014 à 14:44
-- Version du serveur: 5.6.14
-- Version de PHP: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `blogconception`
--
CREATE DATABASE IF NOT EXISTS `blogconception` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `blogconception`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(100) NOT NULL,
  `date_pub` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `contenu` text NOT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `membre_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_article_membre1_idx` (`membre_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `article`
--

INSERT INTO `article` (`id`, `titre`, `date_pub`, `contenu`, `photo`, `membre_id`) VALUES
(1, 'Happy', '2014-02-05 12:00:17', 'ifdsjgjk sj kjdfhkgdfh kdfsh kgjdfdf', NULL, 1),
(2, 'Un super article', '2014-02-05 12:16:03', 'Il vraiment vachement très très très bien écrit', NULL, 1),
(3, 'nfgnhgf', '2014-02-05 12:24:16', 'hgf gfh gf fgh fggfhfghf ggf fg', NULL, 1),
(4, 'fdg fdg dfg df', '2014-02-05 12:24:46', 'dfgfd dnhfdjh dfkbjhdfb jhfdbhfd', NULL, 1),
(5, 'Totoh', '2014-02-05 14:14:41', 'L''article avec un apostr kh jkshkjfdsh kjdfh kg judf', NULL, 1),
(6, 'gnfgn gfnvb', '2014-02-05 14:27:01', 'fgnfgnfgnfgngfgfngfnfggnf', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(45) NOT NULL,
  `parent_id` smallint(5) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom_UNIQUE` (`nom`),
  KEY `fk_categorie_categorie1_idx` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `categorie_article`
--

DROP TABLE IF EXISTS `categorie_article`;
CREATE TABLE IF NOT EXISTS `categorie_article` (
  `article_id` smallint(5) unsigned NOT NULL,
  `categorie_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`article_id`,`categorie_id`),
  KEY `fk_article_has_categorie_categorie1_idx` (`categorie_id`),
  KEY `fk_article_has_categorie_article1_idx` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `contenu` text NOT NULL,
  `article_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentaire_article_idx` (`article_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

DROP TABLE IF EXISTS `membre`;
CREATE TABLE IF NOT EXISTS `membre` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(25) NOT NULL,
  `pass` char(32) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login_UNIQUE` (`login`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`id`, `login`, `pass`) VALUES
(1, 'romain', '65b542cacafb43a8da1d9cbbef7941e7');

-- --------------------------------------------------------

--
-- Structure de la table `profile`
--

DROP TABLE IF EXISTS `profile`;
CREATE TABLE IF NOT EXISTS `profile` (
  `email` varchar(100) DEFAULT NULL,
  `twitter` varchar(45) DEFAULT NULL,
  `membre_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`membre_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `fk_article_membre1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD CONSTRAINT `fk_categorie_categorie1` FOREIGN KEY (`parent_id`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `categorie_article`
--
ALTER TABLE `categorie_article`
  ADD CONSTRAINT `fk_article_has_categorie_article1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_article_has_categorie_categorie1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `commentaire`
--
ALTER TABLE `commentaire`
  ADD CONSTRAINT `fk_commentaire_article` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `profile`
--
ALTER TABLE `profile`
  ADD CONSTRAINT `fk_profile_membre1` FOREIGN KEY (`membre_id`) REFERENCES `membre` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
