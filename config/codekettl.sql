-- phpMyAdmin SQL Dump
-- version 3.2.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 26, 2010 at 01:34 PM
-- Server version: 5.0.86
-- PHP Version: 5.3.0

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `codekettl`
--

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE IF NOT EXISTS `submissions` (
  `id` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `size` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description1` varchar(255) NOT NULL,
  `text1` text NOT NULL,
  `description2` varchar(255) default NULL,
  `text2` text,
  `description3` varchar(255) default NULL,
  `text3` text,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `created` datetime default NULL,
  `modified` datetime default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;
