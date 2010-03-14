-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 14, 2010 at 01:55 PM
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
