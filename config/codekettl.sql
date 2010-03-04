-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 03, 2010 at 05:53 PM
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `topic_id`, `upvotes`, `downvotes`, `rank`, `size`, `title`, `syntax`, `description1`, `text1`, `description2`, `text2`, `description3`, `text3`, `created`, `modified`) VALUES
(1, 1, 1, 1, 1, 0, 2342, 'A Solution In Java Using The Calendar API', 'java5', 'I used the Java Calendar [api.](http://java.sun.com/j2se/1.5.0/docs/api/java/util/Calendar.html) The function printCal() starts by printing a header containing the days of the month. \r\n\r\nNext it finds on what day the fist of the month lands. For example if the first of the month is on a Thursday, then the code skips the days under Sunday, Monday, Tuesday and Wednesday.\r\n\r\nThen it simply prints out the rest of the days int the month making sure to go back to the start column after printing for Saturday.', 'import java.util.Calendar;\r\n\r\n\r\n\r\nclass MyCalander{\r\n\r\n    protected static int[] nDaysInMonth = {0, 31, 28, 31,\r\n                                           30, 31, 30,\r\n                                           31, 31, 30,\r\n                                           31, 30, 31};\r\n\r\n    protected static String[] months = {"", "January", "February",  "March",   "April",    "May", "June", "July", \r\n                                     "August",  "September", "October", "November", "December"};\r\n                                      \r\n\r\n    public void printCal(int month, int year)\r\n    {   	\r\n\r\n        /*Print header*/\r\n        System.out.println(months[month]+" "+year);\r\n        System.out.println("Su\\tMo\\tTu\\tWe\\tTh\\tFr\\tSa");\r\n\r\n        /*Find on what day the fist of the month is*/\r\n        Calendar c      = Calendar.getInstance();\r\n        c.clear();\r\n        c.set(year, month - 1, 1);\r\n        int fDayOfMonth = c.get(Calendar.DAY_OF_WEEK);\r\n        int spaces      = (fDayOfMonth - 1);\r\n        \r\n        /*Print empty slots on the cal before the first of month*/\r\n        for(int i = 0 ; i < spaces ; i++)\r\n        	System.out.print("\\t");\r\n        \r\n        int leapDay = 0, february = 2;\r\n        if(MyCalander.isLeapYear(year) && month == february)\r\n        	leapDay = 1;\r\n        \r\n\r\n        int day = 1, saturday = 7;\r\n        while(day <= nDaysInMonth[month] + leapDay)\r\n        {\r\n        	System.out.print(day + "\\t");\r\n        	c.set(Calendar.DAY_OF_MONTH, day);\r\n\r\n        	if(c.get(Calendar.DAY_OF_WEEK) == saturday)\r\n        		System.out.println();\r\n        	\r\n        	day++;\r\n        }\r\n    }\r\n    \r\n    public static boolean isLeapYear(int year)\r\n    {    \r\n        return (year % 4 == 0) && (year % 100 != 0) || (year % 400 ==0);\r\n    }                           \r\n                   \r\n    public static void main(String arg[])\r\n    {\r\n        try\r\n        {\r\n            int month = Integer.parseInt(arg[0]);\r\n            int year  = Integer.parseInt(arg[1]);\r\n            \r\n            month     = Math.max(1, Math.min(12, month));\r\n            year      = Math.max(1, Math.min(9999, year));\r\n            \r\n            new MyCalander().printCal(month, year);\r\n        }\r\n        catch(NumberFormatException e)\r\n        {\r\n            System.out.print("Not a valid month and year.");\r\n        }\r\n    }\r\n}\r\n', NULL, NULL, NULL, NULL, '2010-02-25 11:32:19', '2010-03-03 16:24:24');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `user_id`, `title`, `text`, `upvotes`, `downvotes`, `rank`, `current_topic`, `was_chosen`, `created`, `modified`) VALUES
(1, 1, 'Printing out a calendar given a year and month', 'The Unix cal command displays a simple calendar in a\r\ncompact form (see a sample run below). \r\n\r\n\r\n       February 2010\r\n    Su Mo Tu We Th Fr Sa\r\n       1  2  3  4  5  6\r\n    7  8  9 10 11 12 13\r\n    14 15 16 17 18 19 20\r\n    21 22 23 24 25 26 27\r\n    28\r\n\r\nWrite a program that does the same thing. The program should behave like the\r\nUnix cal command and display a calendar in a form shown above. It should take an optional month and year. For example, the following java commands should all produce the same output as above.\r\n\r\n    java MyCalendar\r\n\r\n    java MyCalendar 1\r\n\r\n    java MyCalendar 1 2010\r\n', 2, 0, 0.0010665385960503, 1, 1, '2010-02-25 11:16:01', '2010-03-03 17:20:03'),
(2, 1, 'The Snake', 'Remember the classic snake game? The one where you control a snake and it gets larger and larger as you eat things? The point of the game is to get the snake as big as possible without letting the snake overlap itself. [Check the game out here](http://www.miniclip.com/games/snake/en/) to see what I mean.\r\n\r\nThink about how to efficiently represent the snake. You should support two operations.\r\n\r\n    1)Change direction. Given a direction: left, right, up, down update\r\n      your snakes body like you see in the video game\r\n    2)Test if the snake body has overlapped itself.\r\n\r\nProvide code that represents your snake data-structure and code for the two operations above. ', 2, 0, 0.0013788679811786, 0, 0, '2010-02-26 10:49:33', '2010-03-03 17:45:55');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `modified`) VALUES
(1, 'mr_safe', 'francisco.licea@gmail.com', '2d65e0571bc2ab4349808d64408120c68c7710c2', '2010-02-25 09:47:02', '2010-02-25 09:47:02'),
(4, 'AmandaGallegos', 'Amanda@yahoo.com', 'ff9483b9307fe48882c4994da56096dea76ffd9a', '2010-03-01 23:34:09', '2010-03-01 23:34:09');

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

