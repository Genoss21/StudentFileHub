-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 07:33 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `odms_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `userposts`
--

CREATE TABLE `userposts` (
  `post_id` int(11) NOT NULL,
  `post_created` date DEFAULT current_timestamp(),
  `time_posted` time DEFAULT current_timestamp(),
  `file_post` text DEFAULT NULL,
  `text_post` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`post_id`, `post_created`, `time_posted`, `file_post`, `text_post`, `user_id`) VALUES
(286, '2024-12-11', '02:33:28', 'uploads/fritzjerometobes/Circle - Copy (2).docx,uploads/fritzjerometobes/Deadpool mask - Copy (2).pdf,uploads/fritzjerometobes/firewatch-pc-game-1920x1080.jpg,uploads/fritzjerometobes/Spring Boot - Learning Roadmap - Copy (2).xlsx', '4 files', 20);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `ifirstname` varchar(50) NOT NULL,
  `ilastname` varchar(50) NOT NULL,
  `ibirth_month` text DEFAULT NULL,
  `ibirth_day` int(11) DEFAULT NULL,
  `ibirth_year` int(11) DEFAULT NULL,
  `iUserEmail` varchar(100) NOT NULL,
  `iUserPassword` varchar(100) NOT NULL,
  `profile_picture` varchar(255) NOT NULL DEFAULT 'Images/user.jpg',
  `date_created` date DEFAULT NULL,
  `background_picture` varchar(255) NOT NULL DEFAULT 'Images/tokyo.jpg',
  `bio` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `ifirstname`, `ilastname`, `ibirth_month`, `ibirth_day`, `ibirth_year`, `iUserEmail`, `iUserPassword`, `profile_picture`, `date_created`, `background_picture`, `bio`, `location`, `website`) VALUES
(20, 'Fritz jerome', 'Tobes', 'May', 21, 2000, 'ADMIN_1@gmail.com', '$2y$10$6VNmx/UcWM.nLri5YIxy9ueCo89whUP.C.rMie5ZqMGUI7sqcsMUa', 'Images/Fritz.jpg', '2024-12-10', 'Images/bryan-natanael-JJHudePsxcA-unsplash.jpg', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userposts`
--
ALTER TABLE `userposts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `UserEmail` (`iUserEmail`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userposts`
--
ALTER TABLE `userposts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=287;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
