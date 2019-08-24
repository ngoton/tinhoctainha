
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mer 17 Octobre 2018 à 02:14
-- Version du serveur: 10.1.24-MariaDB
-- Version de PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `u785355881_blog`
--

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(100) DEFAULT NULL,
  `categories_link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_link`) VALUES
(1, 'Lập trình', 'lap-trinh');

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `comments_name` varchar(100) DEFAULT NULL,
  `comments_email` varchar(100) DEFAULT NULL,
  `comments_content` text,
  `comments_date` int(11) DEFAULT NULL,
  `comments_posts` int(11) DEFAULT NULL,
  `comments_parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`comments_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `posts_id` int(11) NOT NULL AUTO_INCREMENT,
  `posts_link` varchar(255) DEFAULT NULL,
  `posts_title` varchar(255) DEFAULT NULL,
  `posts_desc` text,
  `posts_content` text,
  `posts_date` int(11) DEFAULT NULL,
  `posts_categories` varchar(100) DEFAULT NULL,
  `posts_tags` varchar(100) DEFAULT NULL,
  `posts_user` int(11) DEFAULT NULL,
  `posts_view` int(11) DEFAULT NULL,
  PRIMARY KEY (`posts_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `posts`
--

INSERT INTO `posts` (`posts_id`, `posts_link`, `posts_title`, `posts_desc`, `posts_content`, `posts_date`, `posts_categories`, `posts_tags`, `posts_user`, `posts_view`) VALUES
(1, 'bai-moi', 'Bài mới', 'dsdf sfsdsd ', 'sdsds sdsds dsdsd  dsdsdsdsd sdsdsd  dsds', 1457564400, '1', '1', 1, 19);

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `role_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Administrator');

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tags_id` int(11) NOT NULL AUTO_INCREMENT,
  `tags_name` varchar(100) DEFAULT NULL,
  `tags_link` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`tags_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `tags`
--

INSERT INTO `tags` (`tags_id`, `tags_name`, `tags_link`) VALUES
(1, 'PHP', 'php');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role` int(11) DEFAULT NULL,
  PRIMARY KEY (`users_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`users_id`, `username`, `password`, `email`, `role`) VALUES
(1, 'ngoton', '81dc9bdb52d04dc20036dbd8313ed055', 'ngoton@tinhoctainha.com', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
