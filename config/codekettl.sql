-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 23, 2010 at 02:23 PM
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
  `topic` int(11) NOT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=72 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `parent_id`, `submission_id`, `topic`, `lft`, `rght`, `text`, `created`, `modified`) VALUES
(1, 2, 0, 2, 0, 1, 40, 'goodbye', '2010-02-13 13:48:35', '2010-02-13 13:48:35'),
(2, 2, 0, 2, 0, 41, 72, 'goodbye', '2010-02-13 13:49:42', '2010-02-13 13:49:42'),
(3, 2, 0, 2, 0, 73, 74, 'goodbye', '2010-02-13 13:49:43', '2010-02-13 13:49:43'),
(4, 2, 0, 2, 0, 75, 76, 'goodbye', '2010-02-13 13:49:44', '2010-02-13 13:49:44'),
(5, 2, 0, 2, 0, 77, 80, 'goodbye', '2010-02-13 13:50:12', '2010-02-13 13:50:12'),
(6, 2, 2, 2, 0, 42, 69, 'seeyou', '2010-02-13 17:40:42', '2010-02-13 17:40:42'),
(7, 2, 6, 2, 0, 43, 56, 'seeyoutoo', '2010-02-13 17:41:36', '2010-02-13 17:41:36'),
(8, 2, 7, 2, 0, 44, 49, 'Hello', '2010-02-15 16:12:18', '2010-02-15 16:12:18'),
(9, 2, 1, 2, 0, 2, 5, 'Hello', '2010-02-15 16:12:24', '2010-02-15 16:12:24'),
(10, 2, 5, 2, 0, 78, 79, 'Hello', '2010-02-15 16:12:38', '2010-02-15 16:12:38'),
(11, 2, 6, 2, 0, 57, 58, 'Hello', '2010-02-15 16:12:45', '2010-02-15 16:12:45'),
(12, 2, 6, 2, 0, 59, 60, 'Hello', '2010-02-15 16:13:20', '2010-02-15 16:13:20'),
(13, 2, 6, 2, 0, 61, 62, 'Hello', '2010-02-15 16:14:35', '2010-02-15 16:14:35'),
(14, 2, 6, 2, 0, 63, 64, 'Hello', '2010-02-15 16:14:37', '2010-02-15 16:14:37'),
(15, 2, 6, 2, 0, 65, 66, 'Hello', '2010-02-15 16:15:15', '2010-02-15 16:15:15'),
(16, 2, 8, 2, 0, 45, 48, 'Hello', '2010-02-15 16:15:27', '2010-02-15 16:15:27'),
(17, 2, 2, 2, 0, 70, 71, 'Hello', '2010-02-15 16:15:33', '2010-02-15 16:15:33'),
(18, 2, 7, 2, 0, 50, 51, 'Hello', '2010-02-15 16:15:42', '2010-02-15 16:15:42'),
(19, 2, 1, 2, 0, 6, 13, 'Hello', '2010-02-15 16:16:07', '2010-02-15 16:16:07'),
(20, 2, 6, 2, 0, 67, 68, 'Hello', '2010-02-15 16:16:17', '2010-02-15 16:16:17'),
(21, 2, 7, 2, 0, 52, 53, 'Hello', '2010-02-15 16:20:27', '2010-02-15 16:20:27'),
(22, 2, 0, 2, 0, 81, 82, '	A new comment', '2010-02-17 12:39:17', '2010-02-17 12:39:17'),
(23, 2, 0, 2, 0, 83, 84, '	A new comment', '2010-02-17 12:41:08', '2010-02-17 12:41:08'),
(24, 2, 0, 2, 0, 85, 86, '	This comment', '2010-02-17 12:47:47', '2010-02-17 12:47:47'),
(25, 2, 0, 2, 0, 87, 88, '	new style', '2010-02-17 13:13:44', '2010-02-17 13:13:44'),
(26, 2, 0, 2, 0, 89, 90, '	new style', '2010-02-17 13:22:29', '2010-02-17 13:22:29'),
(27, 2, 0, 2, 0, 91, 92, '	hi', '2010-02-17 13:22:48', '2010-02-17 13:22:48'),
(28, 2, 0, 2, 0, 93, 94, '	hi', '2010-02-17 13:24:51', '2010-02-17 13:24:51'),
(29, 2, 0, 2, 0, 95, 96, 'Hello, wonderful', '2010-02-17 13:26:31', '2010-02-17 13:26:31'),
(30, 2, 0, 2, 0, 97, 98, 'Hello', '2010-02-17 13:27:32', '2010-02-17 13:27:32'),
(31, 2, 0, 2, 0, 99, 100, 'Display this comments', '2010-02-17 13:28:00', '2010-02-17 13:28:00'),
(32, 2, 0, 2, 0, 101, 102, 'first test', '2010-02-17 13:35:16', '2010-02-17 13:35:16'),
(33, 2, 0, 2, 0, 103, 104, 'what up dogs?', '2010-02-17 13:36:22', '2010-02-17 13:36:22'),
(34, 2, 0, 2, 0, 105, 106, 'what up dogs?', '2010-02-17 13:36:40', '2010-02-17 13:36:40'),
(35, 2, 0, 2, 0, 107, 108, '	What\\''s up bitches?', '2010-02-17 13:39:02', '2010-02-17 13:39:02'),
(36, 2, 0, 2, 0, 109, 110, '<a href=\\"http:://www.google.com\\">here</a>', '2010-02-17 13:39:39', '2010-02-17 13:39:39'),
(37, 2, 0, 2, 0, 111, 112, 'test', '2010-02-17 13:47:58', '2010-02-17 13:47:58'),
(38, 2, 0, 2, 0, 113, 114, '<a href=\\"http://www.google.com\\">here</a>', '2010-02-17 13:48:21', '2010-02-17 13:48:21'),
(39, 2, 0, 2, 0, 115, 116, 'test', '2010-02-17 13:50:29', '2010-02-17 13:50:29'),
(40, 2, 0, 2, 0, 117, 118, 'blash', '2010-02-17 13:52:01', '2010-02-17 13:52:01'),
(41, 2, 0, 2, 0, 119, 120, 'here', '2010-02-17 13:52:23', '2010-02-17 13:52:23'),
(42, 2, 0, 2, 0, 121, 122, 'dfs', '2010-02-17 13:52:27', '2010-02-17 13:52:27'),
(43, 2, 0, 2, 0, 123, 124, '<a href=\\"http://www.google.com\\">hello</a>', '2010-02-17 13:52:48', '2010-02-17 13:52:48'),
(44, 2, 0, 2, 0, 125, 126, 'a new comment', '2010-02-17 13:53:17', '2010-02-17 13:53:17'),
(45, 2, 0, 2, 0, 127, 128, 'Hello', '2010-02-17 14:03:05', '2010-02-17 14:03:05'),
(46, 2, 7, 2, 0, 54, 55, 'New Reply', '2010-02-17 14:06:51', '2010-02-17 14:06:51'),
(47, 2, 16, 2, 0, 46, 47, 'New Reply', '2010-02-17 14:25:39', '2010-02-17 14:25:39'),
(48, 2, 19, 2, 0, 7, 12, 'New Reply', '2010-02-17 14:25:45', '2010-02-17 14:25:45'),
(49, 2, 48, 2, 0, 8, 11, '2', '2010-02-17 14:47:11', '2010-02-17 14:47:11'),
(50, 2, 1, 2, 0, 14, 15, 'New Reply', '2010-02-17 14:49:22', '2010-02-17 14:49:22'),
(51, 2, 1, 2, 0, 16, 17, 'New Reply', '2010-02-17 14:49:47', '2010-02-17 14:49:47'),
(52, 2, 49, 2, 0, 9, 10, 'New Reply', '2010-02-17 14:50:18', '2010-02-17 14:50:18'),
(53, 2, 1, 2, 0, 18, 39, 'New Reply', '2010-02-17 14:50:45', '2010-02-17 14:50:45'),
(54, 2, 53, 2, 0, 19, 38, 'New Reply', '2010-02-17 14:51:05', '2010-02-17 14:51:05'),
(55, 2, 54, 2, 0, 20, 35, 'New Reply', '2010-02-17 14:51:55', '2010-02-17 14:51:55'),
(56, 2, 55, 2, 0, 21, 30, 'New Reply', '2010-02-17 15:05:07', '2010-02-17 15:05:07'),
(57, 2, 56, 2, 0, 22, 29, 'New Reply', '2010-02-17 15:05:29', '2010-02-17 15:05:29'),
(58, 2, 57, 2, 0, 23, 28, 'New Reply', '2010-02-17 15:08:12', '2010-02-17 15:08:12'),
(59, 2, 58, 2, 0, 24, 27, 'New Reply', '2010-02-17 15:08:16', '2010-02-17 15:08:16'),
(60, 2, 59, 2, 0, 25, 26, 'New Reply', '2010-02-17 15:10:01', '2010-02-17 15:10:01'),
(61, 2, 55, 2, 0, 31, 34, 'New Reply', '2010-02-17 15:10:07', '2010-02-17 15:10:07'),
(62, 2, 61, 2, 0, 32, 33, 'New Reply', '2010-02-17 15:10:15', '2010-02-17 15:10:15'),
(63, 2, 9, 2, 0, 3, 4, 'New Reply', '2010-02-17 15:10:24', '2010-02-17 15:10:24'),
(64, 2, 0, 2, 0, 129, 130, '	display my new reply', '2010-02-17 15:12:35', '2010-02-17 15:12:35'),
(65, 2, 0, 2, 0, 131, 134, 'df', '2010-02-17 15:12:48', '2010-02-17 15:12:48'),
(66, 2, 65, 2, 0, 132, 133, 'New Reply', '2010-02-17 15:15:34', '2010-02-17 15:15:34'),
(67, 2, 0, 2, 0, 135, 136, '	to eat', '2010-02-17 15:53:47', '2010-02-17 15:53:47'),
(68, 2, 54, 2, 0, 36, 37, 'New Reply', '2010-02-17 15:54:31', '2010-02-17 15:54:31'),
(69, 2, 0, 10, 0, 137, 138, '		This is the first comment!', '2010-02-22 18:11:45', '2010-02-22 18:11:45'),
(70, 2, 0, 10, 0, 139, 140, 'This is another comment', '2010-02-22 18:14:12', '2010-02-22 18:14:12'),
(71, 2, 0, 10, 0, 141, 142, 'Yay! the third comment!', '2010-02-22 18:14:42', '2010-02-22 18:14:42');

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
  `description1` text NOT NULL,
  `text1` text NOT NULL,
  `description2` varchar(255) DEFAULT NULL,
  `text2` text,
  `description3` varchar(255) DEFAULT NULL,
  `text3` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`id`, `user_id`, `topic_id`, `upvotes`, `downvotes`, `rank`, `size`, `title`, `description1`, `text1`, `description2`, `text2`, `description3`, `text3`, `created`, `modified`) VALUES
(1, 2, 1, 6, 4, 0, 0, 'Kth Order Statistic in O(lg n)', 'main.c', 'int main(){\r\n return 0;\r\n}', NULL, NULL, NULL, NULL, '2010-01-31 13:11:17', '2010-01-31 13:11:17'),
(2, 2, 1, 10, 10, 0, 27, 'A solution written in haskel', 'main.c', 'slkdfjslfjlsakfjlsakfjlskfj', NULL, NULL, NULL, NULL, '2010-02-01 10:34:09', '2010-02-01 10:34:09'),
(4, 2, 1, 0, 1, -1, 4, 'A solution in perl', 'main.pl', 'dlkf', NULL, NULL, NULL, NULL, '2010-02-08 21:27:49', '2010-02-08 21:27:49'),
(3, 1, 1, 13, 11, 0, 6, 'A solution written in Scala', 'main.scala', 'fsldkl', NULL, NULL, NULL, NULL, '2010-02-03 21:47:26', '2010-02-03 21:47:26'),
(5, 2, 1, 0, 1, 0, 90, '<a href=''http:://www.google.com''>test link</a>', '<a href=''http:://www.google.com''>test link</a>  [another test link](http://www.google.com)', '<a href=''http:://www.google.com''>test link</a>  [another test link](http://www.google.com)', NULL, NULL, NULL, NULL, '2010-02-11 23:58:58', '2010-02-11 23:58:58'),
(6, 2, 1, 0, 1, 0, 287, 'testing more markdown', 'testing more markdown', 'Header 1\r\n========\r\n\r\nheader 2\r\n--------\r\n\r\n###header 3###\r\n\r\nA quote:\r\n>Perfection..\r\n>nothing more to \r\n>take away\r\n\r\n1. a\r\n2. b\r\n3. c\r\n\r\n* a\r\n* b\r\n*c\r\n\r\nThis is a code block:\r\n    I''m in a block\r\n    four spaces\r\n\r\nplease don''t use the `<blink>` tag\r\n\r\nThe super<sup>script</sup> tag.', NULL, NULL, NULL, NULL, '2010-02-12 00:22:16', '2010-02-12 00:22:16'),
(7, 2, 1, 1, 0, 0, 8, '**Test Bold**', '**TEST BOLD**', '**TEST**', NULL, NULL, NULL, NULL, '2010-02-12 00:54:26', '2010-02-12 00:54:26'),
(8, 2, 1, 1, 0, 0, 51, 'highlight test', 'test highligth', 'int main(){\r\n for(int i =0 ; i< 10 ; i++)\r\n i--;\r\n}', NULL, NULL, NULL, NULL, '2010-02-12 01:32:27', '2010-02-12 01:32:27'),
(9, 2, 1, 1, 0, 0, 90, 'test syntax plug markdown', 'main.c', '<a href=''http:://www.google.com''>test link</a>  [another test link](http://www.google.com)', NULL, NULL, NULL, NULL, '2010-02-12 01:39:47', '2010-02-12 01:39:47'),
(10, 2, 1, 1, 0, 0, 3130, 'Snake code', 'snake codeIn statistics, the kth order statistic  of a statistical sample is equal to its kth-smallest value. Together with rank statistics, order statistics are among the most fundamental tools in non-parametric statistics and inference.\r\n\r\nImportant special cases of the order statistics are the minimum and maximum value of a sample, and (with some qualifications discussed below) the sample median and other sample quantiles.', 'import java.util.Iterator;\r\nimport java.util.LinkedList;\r\n\r\npublic class Snake {\r\n	\r\n	private LinkedList<Vect> segments;\r\n	private LinkedList<Vect> velocities;\r\n	\r\n	public Snake(int initialLength, Vect boardSize)\r\n	{\r\n		segments = new LinkedList<Vect>();\r\n		velocities = new LinkedList<Vect>();\r\n		buildInitalBody(segments, initialLength, boardSize);\r\n		buildInitialSegmentVelocities(velocities, initialLength);\r\n	}\r\n	\r\n	public void update(Vect usrDir, Vect[] goodies)\r\n	{\r\n		shiftVelocitiesRight(velocities);\r\n		if( usrDir != null && !turningIntoSelf(usrDir) )\r\n		{\r\n			turnSnakeTowards(new Vect(usrDir), velocities);\r\n		}\r\n		applyVelocitiesToSegments(velocities, segments);\r\n	}\r\n	\r\n	public int length()\r\n	{\r\n		return segments.size();\r\n	}\r\n	\r\n	public Vect[] body()\r\n	{\r\n		Vect bodyCopy[] = new Vect[segments.size()];\r\n		\r\n		Iterator<Vect> segIter = segments.iterator();\r\n		int i = 0;\r\n		while(segIter.hasNext())\r\n		{\r\n			bodyCopy[i++] = new Vect(segIter.next());\r\n		}\r\n		\r\n		return bodyCopy;\r\n	}\r\n	\r\n	public Vect[] velocities()\r\n	{\r\n		Vect velCopy[] = new Vect[velocities.size()];\r\n		\r\n		Iterator<Vect> velIter = velocities.iterator();\r\n		int i = 0;\r\n		while(velIter.hasNext())\r\n		{\r\n			velCopy[i++] = new Vect(velIter.next());\r\n		}\r\n		\r\n		return velCopy;\r\n	}\r\n	\r\n	private void buildInitalBody(LinkedList<Vect> body, int initialLength, Vect boardSize) {\r\n		Vect segment = getMiddlePos(boardSize);\r\n		Vect downDir = new Vect(0, 1);\r\n		\r\n		/*Build initial body in the down direction*/\r\n		for(int i = 0 ; i < initialLength; i++)\r\n		{\r\n			body.addLast(segment);\r\n			segment = Vect.add(segment, downDir);\r\n		}\r\n	}\r\n	\r\n	private void buildInitialSegmentVelocities(LinkedList<Vect> segv, int initialLength) \r\n	{\r\n		for(int i = 0 ; i < initialLength; i++)\r\n		{\r\n			segv.addLast(new Vect(0,-1)); /*Snake moves up initially*/\r\n		}\r\n	}\r\n	\r\n	private Vect getMiddlePos(Vect boardSize)\r\n	{\r\n		int halfBoardX = boardSize.x / 2;\r\n		int halfBoardY = boardSize.y / 2;\r\n		Vect pos = new Vect(halfBoardX, halfBoardY); /*initial pos in middle of board*/\r\n		return pos;\r\n	}\r\n	\r\n	private void shiftVelocitiesRight(LinkedList<Vect> segv)\r\n	{\r\n		segv.removeLast();\r\n		segv.addFirst(new Vect(segv.getFirst())); /*Copy what was at head*/\r\n	}\r\n	\r\n	private void turnSnakeTowards(Vect dir, LinkedList<Vect> velv) \r\n	{\r\n		/*Replace the head''s velocity so that on the right shift\r\n		 * the new velocity will be applied to the trailing snake segments*/\r\n		velv.removeFirst();   \r\n		velv.addFirst(new Vect(dir));	\r\n	}\r\n	\r\n	private boolean turningIntoSelf(Vect userDir)\r\n	{\r\n		Vect currentDir = velocities.getFirst();\r\n		Vect oppositeOfCurrentDir = Vect.oppositeDirectionOf(currentDir);\r\n		return userDir.equals(oppositeOfCurrentDir);\r\n	}\r\n	\r\n	private void applyVelocitiesToSegments(LinkedList<Vect> velv, \r\n										  LinkedList<Vect> segv)\r\n	{\r\n		Iterator<Vect> segIter = segv.iterator();\r\n		Iterator<Vect> velIter = velv.iterator();\r\n		while(segIter.hasNext() && velIter.hasNext())\r\n		{\r\n			Vect seg = segIter.next();\r\n			Vect vel = velIter.next();\r\n			\r\n			Vect updatedSeg = Vect.add(seg, vel);\r\n			seg.x = updatedSeg.x;\r\n			seg.y = updatedSeg.y;\r\n		}\r\n	}\r\n}\r\n', NULL, NULL, NULL, NULL, '2010-02-12 10:53:08', '2010-02-12 10:53:08');

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
  `title` varchar(125) NOT NULL,
  `text` text NOT NULL,
  `upvotes` int(11) NOT NULL,
  `downvotes` int(11) NOT NULL,
  `rank` int(11) NOT NULL,
  `current_topic` tinyint(1) NOT NULL,
  `was_chosen` tinyint(1) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `user_id`, `title`, `text`, `upvotes`, `downvotes`, `rank`, `current_topic`, `was_chosen`, `created`, `modified`) VALUES
(1, 2, 'The Kth Order Statistic by mr_safe', 'Finding the minimum in an array of integers takes O(n) because you have to go through the entire array to find the smallest value. What about finding the 2nd smallest element? Or the 3rd? What about the (k)th smallest element in an array? Write an algorithm that finds the kth smallest value in an array. Use this prototype:\r\n\r\nint ksmallest(int k, int a[], int n); \r\n\r\nIn statistics, the kth order statistic  of a statistical sample is equal to its kth-smallest value. Together with rank statistics, order statistics are among the most fundamental tools in non-parametric statistics and inference.\r\n\r\nImportant special cases of the order statistics are the minimum and maximum value of a sample, and (with some qualifications discussed below) the sample median and other sample quantiles.', 1, 0, 1, 1, 0, '2010-01-29 16:14:07', '2010-01-29 16:14:07'),
(2, 4, 'Hey by Amanda', 'asdflkjfjdkk', 5, 5, 0, 0, 0, '2010-01-29 17:43:47', '2010-01-29 17:43:47'),
(3, 5, 'Finding the longest common subsequence by bbking by bbking', 'The longest common subsequence (LCS) problem is to find the longest subsequence common to all sequences in a set of sequences (often just two). It is a classic computer science problem, the basis of diff (a file comparison program that outputs the differences between two files), and has applications in bioinformatics.', 7, 8, 0, 0, 0, '2010-01-29 18:03:42', '2010-01-29 18:03:42'),
(4, 5, 'String to int', 'Converting a string variable to an integer variable in Java is easy. There are actually two different approaches, both equally simply. Below is an example of both approaches, with both use the same string variable to output to various integer variables.\r\n\r\nString myVariable = â€œ12345â€³;\r\n\r\nApproach 1:\r\nint approach1 = Integer.parseInt(myVariable);\r\n\r\nApproach 2:\r\nint approach2 = Integer.valueOf(myVariable);\r\n\r\nIf you have any opinion on why you use one approach over the other, let the community know!\r\n', 4, 4, 0, 0, 0, '2010-01-29 18:16:30', '2010-01-29 18:16:30'),
(5, 5, 'Reddit''s Ranking Algorithm', 'So, a couple people asked for an explanation, so here goes:\r\n\r\nt_s basically serves as "gravity" to make older posts fall down the page. Why Dec 8, 2005? Maybe that''s when they launched. Anyway, what t_s does in the function is equate a 10-fold increase in points with being submitted 12.5 hours (that''s 45,000 secs) later. So a 1-hour-old post would have to improve its vote differential 10x over the next 12.5 hours to maintain it''s rating to compensate for elapsed time. If a post''s vote differential increases more than 10x in 12.5 hours, its rating goes up.\r\n\r\nAs for where the numbers come from, I''m pretty sure they''re tuned by trial-and-error. It''s really hard to predict voting patterns beforehand (ie how fast should items "fall" from the main page?)\r\n\r\nThe log function is there because your first 10 upvotes should have more weight than the 101st to 110th upvotes. The way the formula is written (and assuming 0 downvotes), your first 10 upvotes have the same weight as the next 100 upvotes, which have the same weight as the next 1000, etc. Again, the base of the logarithm is somewhat arbitrary, and can be tuned by trial and error.\r\n\r\nAnd needless to say, if you have more downvotes than upvotes, your rating is negative. That''s about it.', 5, 6, 0, 0, 0, '2010-01-29 18:52:55', '2010-01-29 18:52:55'),
(6, 2, 'Hacker New Algorithm', 'I always imagined that the reddit/HN/Digg algorithms (if you can call it that) went something like this:\r\n\r\n1) submit article\r\n\r\n2) attach Unix timestamp\r\n\r\n3) increment/decrement each timestamp by a fixed time interval of Unix seconds for each upvote/downvote\r\n\r\nWith this scheme, there is one operation (add a positive or negative increment). Eventually each article will naturally decay as time moves on. You can adjust the size of the increment to be weighted more closer to the actual submission time and have the increment decay to an average to accelerate "hotter" postings to the top if you don''t like linear increments.\r\n\r\nThe overall idea is to project an article (in Unix timestamp) into the future by the number of upvotes; this timestamp is merely a ranking "key". The front page articles would have a Unix timestamp of one or two days into the future depending on how many votes. This would naturally place currently submitted articles somewhere a few pages back.\r\n\r\nIt more or less mimics the same thing (doesn''t it?).', 5, 6, 0, 0, 0, '2010-01-29 18:59:20', '2010-01-29 18:59:20'),
(7, 4, 'What is the biggest prime array from the arrays of the millenium?', 'Find the nth array of the integer that tells the secrets of the universe.', 20, 20, 0, 0, 0, '2010-01-31 16:15:18', '2010-01-31 16:15:18'),
(8, 2, 'Finding The Minimum In An Arbitrary Subset of an Array', 'How does ....', 13, 10, 0, 0, 0, '2010-02-03 13:43:42', '2010-02-03 13:43:42'),
(9, 2, 'A Singly Linked List', 'What is the smallest implementation of a linked list in C?', 3, 4, 0, 0, 0, '2010-02-03 13:52:52', '2010-02-03 13:52:52'),
(10, 2, 'A double linked list', 'Smalled implementation of a double linked list in C?', 3, 3, 0, 0, 0, '2010-02-03 13:53:51', '2010-02-03 13:53:51'),
(11, 3, 'Nth to last in a linked list', 'blah', 2, 3, 0, 0, 0, '2010-02-03 15:37:43', '2010-02-03 15:37:43'),
(12, 3, 'Logest Common Subsequence', 'blash', 3, 3, 0, 0, 0, '2010-02-03 15:40:13', '2010-02-03 15:40:13'),
(13, 3, 'fast fourier transform', 'blash', 3, 1, 0, 0, 0, '2010-02-03 15:43:03', '2010-02-03 15:43:03'),
(14, 3, 'testing primes', 'kjh', 3, 4, 0, 0, 0, '2010-02-03 15:46:07', '2010-02-03 15:46:07'),
(15, 3, 'Removing Duplicates From An Array', 'How do....', 6, 5, 0, 0, 0, '2010-02-03 15:52:20', '2010-02-03 15:52:20'),
(16, 2, 'Maximum Of Two Nums', 'blah', 5, 5, 0, 0, 0, '2010-02-03 16:21:39', '2010-02-03 16:21:39'),
(17, 2, 'Sum an array', 'blash', 5, 5, 0, 0, 0, '2010-02-03 16:23:43', '2010-02-03 16:23:43'),
(18, 4, 'jugle juice', 'sldfk', 2, 2, 0, 0, 0, '2010-02-03 19:22:39', '2010-02-03 19:22:39'),
(26, 2, '<img src=''bad''>testing markdown and html escaping', '<img src=''badplace''>\r\n<a href="http://www.google.com">bad link</a>\r\n\r\n[markdown test](http://www.google.com)', 1, 0, 0, 0, 0, '2010-02-12 01:03:50', '2010-02-12 01:03:50'),
(27, 11, 'test', 'This is a [test](http://www.google.com)\r\n\r\n###Header###', 3, 0, 1, 0, 0, '2010-02-16 12:41:11', '2010-02-16 12:41:11'),
(19, 2, 'sorting with quic sort', 'quick', 1, 0, 1, 0, 0, '2010-02-08 14:33:39', '2010-02-08 14:33:39'),
(20, 2, 'database filter', 'filter', 2, 1, 0, 0, 0, '2010-02-08 15:00:49', '2010-02-08 15:00:49'),
(21, 2, 'sql', 'sql', 1, 0, 1, 0, 0, '2010-02-08 15:05:00', '2010-02-08 15:05:00'),
(22, 2, 'sql', 'sql', 1, 0, 1, 0, 0, '2010-02-08 15:08:58', '2010-02-08 15:08:58'),
(23, 2, 'sql', 'sql', 1, 0, 1, 0, 0, '2010-02-08 15:09:21', '2010-02-08 15:09:21'),
(24, 2, 'sql', 'sql', 1, 0, 1, 0, 0, '2010-02-08 15:11:10', '2010-02-08 15:11:10'),
(25, 2, 'apache server', 'apache', 1, 0, 1, 0, 0, '2010-02-08 15:11:47', '2010-02-08 15:11:47');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created`, `modified`) VALUES
(1, 'flicea', 'flicea@utep.edu', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-01-26 12:15:53', '2010-01-26 12:15:53'),
(2, 'mr_safe', 'francisco.licea@gmail.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-01-27 22:18:11', '2010-01-27 22:18:11'),
(3, 'mac_daddy', 'flicea@miners.utep.edu', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-01-28 13:11:14', '2010-01-28 13:11:14'),
(4, 'Amanda', 'aigallegos08@gmail.com', '4d84bca63d92fe050275d59886da4a0d0d4dcdd3', '2010-01-29 17:43:04', '2010-01-29 17:43:04'),
(5, 'bbking', 'jamali@gmail.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-01-29 18:00:12', '2010-01-29 18:00:12'),
(6, 'chonchy', 'poopi@gmail.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-02-03 18:53:03', '2010-02-03 18:53:03'),
(7, 'chanchy', 'chanc@gmail.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-02-04 10:04:37', '2010-02-04 10:04:37'),
(8, 'unloud', 'unloud@gmail.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-02-04 10:20:08', '2010-02-04 10:20:08'),
(9, 'AmandaGallegos', 'smeefydeef@yahoo.com', '4d84bca63d92fe050275d59886da4a0d0d4dcdd3', '2010-02-07 11:03:45', '2010-02-07 11:03:45'),
(10, 'loncchi', 'lon@lon.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-02-10 17:52:58', '2010-02-10 17:52:58'),
(11, 'el_maestro', 'sdfs@gmail.com', '104ebb054ccb8abe19738875ad5b5626897841d0', '2010-02-16 12:40:06', '2010-02-16 12:40:06');

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=83 ;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `user_id`, `topic_id`, `submission_id`, `upvote`, `created`, `modified`) VALUES
(1, 3, 1, 0, 1, '2010-02-03 11:51:24', '2010-02-03 11:51:24'),
(2, 2, 2, 0, 0, '2010-02-03 12:10:58', '2010-02-03 12:10:58'),
(3, 3, 3, 0, 0, '2010-02-03 13:10:01', '2010-02-03 13:10:01'),
(4, 2, 4, 0, 0, '2010-02-03 13:41:19', '2010-02-03 13:41:19'),
(5, 2, 7, 0, 0, '2010-02-03 13:42:43', '2010-02-03 13:42:43'),
(6, 2, 8, 0, 0, '2010-02-03 13:46:09', '2010-02-03 13:46:09'),
(7, 2, 9, 0, 0, '2010-02-03 13:52:58', '2010-02-03 13:52:58'),
(8, 2, 10, 0, 0, '2010-02-03 13:53:58', '2010-02-03 13:53:58'),
(9, 3, 5, 0, 0, '2010-02-03 15:30:06', '2010-02-03 15:30:06'),
(10, 3, 10, 0, 0, '2010-02-03 15:30:30', '2010-02-03 15:30:30'),
(11, 3, 9, 0, 0, '2010-02-03 15:30:40', '2010-02-03 15:30:40'),
(12, 3, 8, 0, 1, '2010-02-03 15:30:50', '2010-02-03 15:30:50'),
(13, 3, 7, 0, 0, '2010-02-03 15:31:23', '2010-02-03 15:31:23'),
(14, 3, 6, 0, 0, '2010-02-03 15:36:55', '2010-02-03 15:36:55'),
(15, 3, 11, 0, 0, '2010-02-03 15:37:54', '2010-02-03 15:37:54'),
(16, 3, 12, 0, 0, '2010-02-03 15:40:17', '2010-02-03 15:40:17'),
(17, 3, 13, 0, 1, '2010-02-03 15:43:07', '2010-02-03 15:43:07'),
(18, 3, 14, 0, 0, '2010-02-03 15:46:12', '2010-02-03 15:46:12'),
(19, 3, 15, 0, 0, '2010-02-03 15:52:24', '2010-02-03 15:52:24'),
(20, 2, 17, 0, 0, '2010-02-03 16:24:08', '2010-02-03 16:24:08'),
(21, 6, 7, 0, 1, '2010-02-03 18:53:50', '2010-02-03 18:53:50'),
(22, 6, 8, 0, 1, '2010-02-03 18:53:57', '2010-02-03 18:53:57'),
(23, 6, 12, 0, 1, '2010-02-03 18:54:39', '2010-02-03 18:54:39'),
(24, 4, 7, 0, 0, '2010-02-03 18:58:31', '2010-02-03 18:58:31'),
(25, 4, 8, 0, 1, '2010-02-03 18:58:46', '2010-02-03 18:58:46'),
(26, 4, 9, 0, 0, '2010-02-03 18:58:49', '2010-02-03 18:58:49'),
(27, 4, 10, 0, 1, '2010-02-03 18:58:51', '2010-02-03 18:58:51'),
(28, 4, 17, 0, 1, '2010-02-03 18:59:37', '2010-02-03 18:59:37'),
(29, 4, 12, 0, 1, '2010-02-03 18:59:40', '2010-02-03 18:59:40'),
(30, 4, 11, 0, 1, '2010-02-03 18:59:46', '2010-02-03 18:59:46'),
(31, 4, 6, 0, 0, '2010-02-03 18:59:48', '2010-02-03 18:59:48'),
(32, 4, 5, 0, 0, '2010-02-03 18:59:55', '2010-02-03 18:59:55'),
(33, 4, 4, 0, 1, '2010-02-03 19:00:04', '2010-02-03 19:00:04'),
(34, 4, 3, 0, 0, '2010-02-03 19:00:09', '2010-02-03 19:00:09'),
(35, 4, 2, 0, 1, '2010-02-03 19:15:52', '2010-02-03 19:15:52'),
(36, 4, 13, 0, 1, '2010-02-03 19:16:06', '2010-02-03 19:16:06'),
(37, 4, 18, 0, 0, '2010-02-03 19:22:52', '2010-02-03 19:22:52'),
(38, 4, 16, 0, 1, '2010-02-03 19:23:18', '2010-02-03 19:23:18'),
(39, 4, 14, 0, 1, '2010-02-03 19:26:58', '2010-02-03 19:26:58'),
(40, 4, 15, 0, 1, '2010-02-03 19:27:04', '2010-02-03 19:27:04'),
(41, 1, 7, 0, 1, '2010-02-03 21:15:37', '2010-02-03 21:15:37'),
(42, 1, 16, 0, 0, '2010-02-03 21:15:55', '2010-02-03 21:15:55'),
(43, 1, 0, 2, 1, '2010-02-03 21:44:24', '2010-02-03 21:44:24'),
(44, 1, 0, 3, 1, '2010-02-03 21:47:52', '2010-02-03 21:47:52'),
(45, 2, 11, 0, 0, '2010-02-05 16:13:57', '2010-02-05 16:13:57'),
(46, 2, 16, 0, 0, '2010-02-05 18:35:51', '2010-02-05 18:35:51'),
(47, 2, 15, 0, 1, '2010-02-05 18:36:53', '2010-02-05 18:36:53'),
(48, 2, 6, 0, 0, '2010-02-05 18:44:05', '2010-02-05 18:44:05'),
(49, 2, 18, 0, 1, '2010-02-05 18:44:13', '2010-02-05 18:44:13'),
(50, 2, 13, 0, 1, '2010-02-06 09:36:47', '2010-02-06 09:36:47'),
(51, 2, 12, 0, 0, '2010-02-06 12:57:26', '2010-02-06 12:57:26'),
(52, 2, 14, 0, 0, '2010-02-06 12:57:39', '2010-02-06 12:57:39'),
(53, 2, 0, 3, 1, '2010-02-06 13:38:33', '2010-02-06 13:38:33'),
(54, 2, 3, 0, 0, '2010-02-06 13:55:58', '2010-02-06 13:55:58'),
(55, 2, 5, 0, 0, '2010-02-06 14:22:58', '2010-02-06 14:22:58'),
(56, 2, 0, 2, 0, '2010-02-06 17:03:48', '2010-02-06 17:03:48'),
(57, 2, 0, 1, 1, '2010-02-06 17:18:09', '2010-02-06 17:18:09'),
(58, 9, 3, 0, 1, '2010-02-07 11:04:19', '2010-02-07 11:04:19'),
(59, 9, 0, 3, 1, '2010-02-07 22:14:16', '2010-02-07 22:14:16'),
(60, 9, 0, 2, 0, '2010-02-07 22:14:19', '2010-02-07 22:14:19'),
(61, 9, 8, 0, 1, '2010-02-07 22:14:36', '2010-02-07 22:14:36'),
(62, 2, 19, 0, 1, '2010-02-08 14:33:45', '2010-02-08 14:33:45'),
(63, 2, 20, 0, 1, '2010-02-08 15:01:02', '2010-02-08 15:01:02'),
(64, 2, 23, 0, 1, '2010-02-08 15:09:21', '2010-02-08 15:09:21'),
(65, 2, 24, 0, 1, '2010-02-08 15:11:10', '2010-02-08 15:11:10'),
(66, 2, 25, 0, 1, '2010-02-08 15:11:47', '2010-02-08 15:11:47'),
(67, 2, 0, 4, 0, '2010-02-08 21:28:00', '2010-02-08 21:28:00'),
(68, 2, 0, 5, 0, '2010-02-11 23:58:58', '2010-02-11 23:58:58'),
(69, 2, 0, 6, 0, '2010-02-12 00:22:16', '2010-02-12 00:22:16'),
(70, 2, 0, 7, 1, '2010-02-12 00:54:26', '2010-02-12 00:54:26'),
(71, 2, 26, 0, 1, '2010-02-12 01:03:50', '2010-02-12 01:03:50'),
(72, 2, 0, 8, 1, '2010-02-12 01:32:27', '2010-02-12 01:32:27'),
(73, 2, 0, 9, 1, '2010-02-12 01:39:47', '2010-02-12 01:39:47'),
(74, 2, 0, 10, 1, '2010-02-12 10:53:08', '2010-02-12 10:53:08'),
(75, 11, 27, 0, 1, '2010-02-16 12:41:11', '2010-02-16 12:41:11'),
(76, 2, 27, 0, 1, '2010-02-16 12:42:29', '2010-02-16 12:42:29'),
(77, 3, 27, 0, 1, '2010-02-16 12:43:54', '2010-02-16 12:43:54'),
(78, 3, 20, 0, 0, '2010-02-16 12:44:27', '2010-02-16 12:44:27'),
(79, 3, 2, 0, 0, '2010-02-16 12:44:28', '2010-02-16 12:44:28'),
(80, 3, 4, 0, 0, '2010-02-16 12:44:31', '2010-02-16 12:44:31'),
(81, 3, 18, 0, 0, '2010-02-16 12:44:46', '2010-02-16 12:44:46'),
(82, 3, 17, 0, 0, '2010-02-16 12:44:47', '2010-02-16 12:44:47');
