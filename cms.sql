-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 13, 2023 at 12:43 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(3) NOT NULL,
  `cat_title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES
(48, 'PHP'),
(52, 'JavaScript'),
(58, 'Python'),
(64, 'C');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(3) NOT NULL,
  `comment_post_id` int(3) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(6, 138, 'Samuel Muabia', 'samuel.planet1@gmail.com', 'HELLO', 'disapproved', '2023-03-30'),
(7, 138, 'Samuel Muabia', 'samuel.planet1@gmail.com', 'HELLO', 'approved', '2023-03-30');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(3) NOT NULL,
  `post_category_id` int(3) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) NOT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comment_count` varchar(255) NOT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`, `post_views_count`) VALUES
(118, 58, 'Javascript', 'Edwin Diaz', '', '2023-04-06', 'images_3.jpg', '', 'javascript', '4', 'draft', 9),
(138, 58, '10+ Best Python Tutorials for Beginners [2023 MAR]— Learn Python Online', 'Samuel Muabia', '', '2023-04-06', 'images_4.jpg', '<p>Python is an object-orientated language that closely resembles the English language which makes it a great language to learn for beginners as well as seasoned professionals. Python is easy to learn a programming language with a wide variety of well-paying jobs in many fields, including data science, web development, and network programming. Python is one of the most widely used programming languages in the AI field of Artificial Intelligence thanks to its simplicity. It can seamlessly be used with data structures, and other frequently used AI algorithms. Examples of sites that use Python are Instagram, YouTube, Reddit, NASA, IBM, Nokia, etc.</p>', 'Python, Best Programming Language', '4', 'published', 15),
(142, 48, 'A neural implant can translate brain activity into sentences', 'Samuel Muabia', '', '2023-04-03', 'images_6.jpg', '<p>To communicate, people unable to talk often rely on small eye movements to spell out words, a painstakingly slow process. Now, using signals picked up by a brain implant, scientists have pulled entire sentences from the brain.</p><p>Some of these reconstructed words, <a href=\"https://www.nature.com/articles/s41586-019-1119-1\">spoken aloud by a virtual vocal cord</a>, are a little garbled. But overall, the sentences are understandable, researchers from the University of California, San Francisco report in the April 25 <i>Nature</i>.</p><p>Creating the audible synthetic sentences required years of analysis after brain signals were recorded, and the technique is not ready to be used outside of a lab. Still, the work shows “that just using the brain, it is possible to decode speech,” says UCSF speech scientist Gopala Anumanchipalli.</p><p>The technology described in the new study holds promise for ultimately restoring people’s abilities to speak fluently, says Frank Guenther, a speech neuroscientist at Boston University. “It’s hard to overstate the importance of that to these people…. It’s incredibly isolating and practically nightmarish to not be able to communicate needs or socially connect.”</p>', 'AI', '', 'published', 4),
(143, 48, '10+ Best Python Tutorials for Beginners [2023 MAR]— Learn Python Online', 'Samuel Muabia', '', '2023-04-05', 'images_4.jpg', '<p><a href=\"https://www.analyticsinsight.net/a-complete-guide-on-building-a-crypto-bot-with-python/\">Python</a> is one of the most preferred programming languages known for its simplicity and easy-to-read syntax with a variety of frameworks and a strong ecosystem, that python developers heavily depend on. Self-taught Python coders frequently encounter a piece of code on websites like stack overflow or GitHub that makes them uncomfortable about how the code functions. Python is a flexible language with an infinite number of possibilities, so sometimes even seasoned programmers struggle to learn new Python tricks and <a href=\"https://www.analyticsinsight.net/top-oops-concepts-in-python-that-every-programmer-must-know/\">python online courses</a> help them to encounter this problem. Sometimes it is challenging for beginners to grasp the language without any additional guidance. <a href=\"https://www.analyticsinsight.net/top-5-interesting-python-modules-that-every-programmer-should-know/\">Top python online courses</a> provide proper guidelines with the real-time project to understand the language easily. The article lists the <a href=\"https://www.analyticsinsight.net/top-10-python-libraries-for-ethical-hackers-to-use-in-2023/\">top 10 python online courses</a> for beginners to check out in 2023.</p>', 'Python, Best Programming Language', '', 'published', 22),
(144, 48, '10+ Best Python Tutorials for Beginners [2023 MAR]— Learn Python Online', 'Samuel Muabia', '', '2023-03-31', 'images_4.jpg', 'Python is an object-orientated language that closely resembles the English language which makes it a great language to learn for beginners as well as seasoned professionals. Python is easy to learn a programming language with a wide variety of well-paying jobs in many fields, including data science, web development, and network programming. Python is one of the most widely used programming languages in the AI field of Artificial Intelligence thanks to its simplicity. It can seamlessly be used with data structures, and other frequently used AI algorithms. Examples of sites that use Python are Instagram, YouTube, Reddit, NASA, IBM, Nokia, etc.', 'Python, Best Programming Language', '', 'published', 6),
(145, 48, 'A neural implant can translate brain activity into sentences', 'Samuel Muabia', '', '2023-04-13', 'images_6.jpg', '<p>spoken aloud by a virtual vocal cord, are a little garbled. But overall, the sentences are understandable, researchers from the University of California, San Francisco report in the April 25 <i>Nature</i>.</p><p> </p><p>Creating the audible synthetic sentences required years of analysis after brain signals were recorded, and the technique is not ready to be used outside of a lab. Still, the work shows “that just using the brain, it is possible to decode speech,” says UCSF speech scientist Gopala Anumanchipalli.</p><p>The technology described in the new study holds promise for ultimately restoring people’s abilities to speak fluently, says Frank Guenther, a speech neuroscientist at Boston University. “It’s hard to overstate the importance of that to these people…. It’s incredibly isolating and practically nightmarish to not be able to communicate needs or socially connect.”</p>', 'AI', '', 'draft', 23);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(3) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) NOT NULL,
  `user_lastname` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `randSalt` varchar(255) NOT NULL DEFAULT '$2y$10$iusesomecrazystrings22',
  `token` text NOT NULL,
  `user_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `randSalt`, `token`, `user_date`) VALUES
(4, 'Samuel', '$2y$12$A5QV.I4wbI9y8AqucKgvmuUPUfcUs4ZgLP9vu1fKYFjBVgJwEiEhC', 'Samuel', 'Planet', 'samuel.planet1@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', '', '2023-03-30'),
(5, 'Sam', '$2y$12$A5QV.I4wbI9y8AqucKgvmuUPUfcUs4ZgLP9vu1fKYFjBVgJwEiEhC', 'Samuel', 'Planet', 'samuel.planet1@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', '', '2023-04-04'),
(7, 'test', '$2y$12$r2Zcakc2sxlmOTXHi6EQl.OSkwy9CQzna6dBejKN/7VjUR0FbOw0u', 'Samuel', 'Mua', 'test@gmail.com', '', 'Admin', '$2y$10$iusesomecrazystrings22', '', '2023-04-04'),
(8, 'MUA', '$2y$12$wHXhbluev8szYImpvbltLuh1rY4Dg.l/C6.XJq9LyQuJY54mhlFDC', 'Samuel', 'Planet', 'samuel.planet4@gmail.com', '', 'Subscriber', '$2y$10$iusesomecrazystrings22', '', '2004-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(44, '', 1447434996),
(45, 's47g806mg6788i92u5ogm6kqi4', 1447441570),
(46, '72clfovqk7vo2p8fiii26tkmr4', 1447461586),
(47, '3gs3q67k5ntpma8tbp2kuvof23', 1447691896),
(48, 'bouqd4fslhn2b1nv20k559col1', 1447796024),
(49, 'tign71tbpar4di74k13f8nr022', 1447867949),
(50, 'ju0s1j019d1qlc1q4tb703rgm3', 1447880891),
(51, 'tp6khbvgo4hdlfueekpmaefcu0', 1447952096),
(52, 'kv0klvlajm8j50d3uqt6go4bm6', 1448174347),
(53, 'qsdv073j4c3lqd6m0rtdpg3615', 1448296313),
(54, 'tmliedhtcgvi8r96l6qplehos4', 1448292854),
(55, 'vrumjbdrjrauucdhg6cta8hhn6', 1448800892),
(56, 'eb1ae8996caf679d187c1037ec9620b1', 1478098539),
(57, '40780dfe8631b764c435168775d44432', 1479443689),
(58, '6d9081fbf0106e9bfef3e77f6fa68f8a', 1481004509),
(59, 'b57212ad3e92b65c05d8ddcd1805a370', 1481382178),
(60, '3cf8d2b7eb470cb635a6102868ae9bd6', 1481397855),
(61, 'c7e0ac8eeeaaf5d3ac4329af9bf4b777', 1481685807),
(62, 'b50a5d9ab4b00848c009d472c63ae2cd', 1485830805),
(63, '3ef98f25d1b1762dd799f33b1a2b2657', 1499988384),
(64, '229f256600c1d05e81bd5036d941069a', 1499993069),
(65, '34aea21ebd8d1ae1b572236a4783cbad', 1500065466),
(66, 'l8p8rgabjjrvl361sog4ds41cl', 1680618684),
(67, 'gfsps5959ikdlb8n567aq99c8j', 1680602792),
(68, 'q7q5n6tprliait8mpo0394g5j2', 1680699300),
(69, 'uuf78cinlf5mjis3p3lsjqpep2', 1680699300),
(70, 'qco3shpgpl32hv0icm52kni07j', 1680783434),
(71, '0ngponcic39grobjphaqdfipra', 1680854576),
(72, '84vsgmvngf82bafasaslbpjiap', 1681113635),
(73, 'bf8tapo66m951b9mbio4fhc3ou', 1681304234),
(74, 'b7f2htrp9b18h0hjmg1ipfu4bi', 1681379016),
(75, 'esjjstmnessicgd84qr7u3aoq7', 1681382303);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
