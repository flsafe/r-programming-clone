-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 10, 2010 at 12:05 PM
-- Server version: 5.1.43
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `codekettl`
--

-- --------------------------------------------------------

--
-- Table structure for table `algorithms`
--

DROP TABLE IF EXISTS `algorithms`;
CREATE TABLE IF NOT EXISTS `algorithms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `algorithms`
--

INSERT INTO `algorithms` (`id`, `name`) VALUES
(1, 'Sorting'),
(2, 'Searching'),
(3, 'Combinatorial'),
(4, 'Recursion'),
(5, 'Numerical'),
(6, 'Geometry'),
(7, 'Graphical'),
(8, 'Counting'),
(9, 'String Manipulation'),
(10, 'Dynamic Programming');

-- --------------------------------------------------------

--
-- Table structure for table `algorithms_topics`
--

DROP TABLE IF EXISTS `algorithms_topics`;
CREATE TABLE IF NOT EXISTS `algorithms_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `algorithm_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `algorithms_topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `comments`
--


-- --------------------------------------------------------

--
-- Table structure for table `data_structures`
--

DROP TABLE IF EXISTS `data_structures`;
CREATE TABLE IF NOT EXISTS `data_structures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `data_structures`
--

INSERT INTO `data_structures` (`id`, `name`) VALUES
(1, 'Arrays'),
(2, 'Linked Lists'),
(3, 'Trees'),
(4, 'Stacks'),
(5, 'Queues'),
(7, 'Graphs'),
(8, 'Hash Tables'),
(9, 'Heaps'),
(10, 'Sets'),
(11, 'Strings');

-- --------------------------------------------------------

--
-- Table structure for table `data_structures_topics`
--

DROP TABLE IF EXISTS `data_structures_topics`;
CREATE TABLE IF NOT EXISTS `data_structures_topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_structure_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `data_structures_topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

DROP TABLE IF EXISTS `submissions`;
CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `syntax` varchar(125) NOT NULL,
  `description1` text NOT NULL,
  `text1` text NOT NULL,
  `description2` varchar(255) DEFAULT NULL,
  `text2` text,
  `description3` varchar(255) DEFAULT NULL,
  `text3` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `submissions`
--


-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

DROP TABLE IF EXISTS `tickets`;
CREATE TABLE IF NOT EXISTS `tickets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hash` varchar(255) NOT NULL,
  `data` varchar(255) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tickets`
--


-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

DROP TABLE IF EXISTS `topics`;
CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `rank` double NOT NULL,
  `current_topic` tinyint(1) NOT NULL,
  `was_chosen` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `topics`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `users`
--


-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

DROP TABLE IF EXISTS `votes`;
CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `submission_id` int(11) NOT NULL,
  `upvote` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `votes`
--

