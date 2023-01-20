-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 24, 2022 at 03:23 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job__post`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `decsr` text NOT NULL,
  `tags` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `user_id`, `company_name`, `title`, `decsr`, `tags`, `image`, `location`) VALUES
(7, 84, 'Kilo Health', 'Front-end Engineer', 'Build responsive websites that are used by millions of customers.\r\nWork in a cross-functional team, collaborating with frontend and mobile engineers, product managers, and UX designers.\r\nWrite clean code that serves as an example to others.', 'react,vue,typescript', 'https://res.cloudinary.com/ddmcmjx3v/image/upload/v1671696020/my_uploads/testm5xw352ii1.jpg', 'Riga, Latvia Remote '),
(8, 84, 'Vivid Resourcing Ltd', 'Frontend React.js Developer', 'I\'m currently partnered with a gaming tech company in Belgium hiring for a Frontend Developer who enjoys working with React.js.\r\nThis client is one the fastest scale-up companies in Belgium and are continuing to grow the software team.', 'React,typecsript,redux', 'https://res.cloudinary.com/ddmcmjx3v/image/upload/v1671697852/my_uploads/testmtSyiyUT9X.jpg', 'Brussels, Brussels Region');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `session` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `session_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`session`, `user_id`, `session_id`) VALUES
('743f5a2d41b1b496d5f6f28e1b60466f5fe66fcfec3081d5b7e5d38a3440a913ed9ada7e451ade9231848631e71c041cdc6d6a96f683c03993ccabceab90a391343b82e2ec5df05e74401d761434f280c01ae0046954dc0794d366bcf787d5ea5df8d0d48a67fdb08a99048a8dff0283177d8920230dd7a49fe', 84, 74);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `password`, `email`) VALUES
(84, 'test@test.com', '$2y$10$GlBVNynCIG4Kc3YNYFu3aegkADMgUYz/1IQSPQoefkMGLR/3dZJYK', 'test@test1.com'),
(86, 'test@test.com', '$2y$10$6nb0v69SSg15FlS2C3wOOOSCwU7kDnVdntRKApZ0yB8f9d1MWOnh2', 'test@test333.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `tags` (`tags`),
  ADD KEY `user_id` (`user_id`);
ALTER TABLE `posts` ADD FULLTEXT KEY `FULLTEXT` (`title`,`tags`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `session_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
