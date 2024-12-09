-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 03:52 PM
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
  `file_post` varchar(255) DEFAULT NULL,
  `text_post` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`post_id`, `post_created`, `time_posted`, `file_post`, `text_post`, `user_id`) VALUES
(155, '2024-12-09', '15:57:52', 'uploads/fritz jerometobes/Screenshot 2024-08-03 114857.png', '', 15),
(156, '2024-12-09', '17:56:41', 'uploads/fritztobes/bryan-natanael-JJHudePsxcA-unsplash.jpg', 'Image test', 16),
(157, '2024-12-09', '18:05:17', 'uploads/fritztobes/DLL for LC 43.2a _ b-Solving right triangle (Joya).docx', 'Word Test', 16),
(158, '2024-12-09', '18:07:19', 'uploads/fritztobes/pngwing.com.png', '', 16),
(159, '2024-12-09', '19:18:19', 'uploads/fritz jerometobes/Circle.docx', 'Word test', 15),
(160, '2024-12-09', '19:24:20', 'uploads/fritz jerometobes/Hoplinks.docx', 'Test 2', 15),
(161, '2024-12-09', '19:32:30', 'uploads/fritz jerometobes/Hoplinks.docx', 'Test2 ', 15),
(162, '2024-12-09', '19:47:46', 'uploads/fritz jerometobes/Hoplinks.docx', 'Test 3', 15),
(163, '2024-12-09', '19:49:04', 'uploads/fritz jerometobes/Hoplinks.docx', 'Test 4', 15),
(164, '2024-12-09', '20:20:47', 'uploads/fritz jerometobes/Hoplinks.docx', 'Test 4', 15),
(165, '2024-12-09', '20:21:41', 'uploads/fritz jerometobes/Hoplinks.docx', 'Test 4', 15),
(166, '2024-12-09', '20:23:16', 'uploads/fritz jerometobes/Circle.docx', 'Test 5', 15),
(167, '2024-12-09', '20:23:45', 'uploads/fritz jerometobes/Circle.docx', 'Test 5', 15),
(168, '2024-12-09', '20:23:55', 'uploads/fritz jerometobes/Circle.docx', 'Test 5', 15),
(169, '2024-12-09', '20:40:07', 'uploads/fritz jerometobes/Circle.docx', 'sadasd', 15),
(170, '2024-12-09', '20:43:02', 'uploads/fritz jerometobes/Circle.docx', 'sersr', 15),
(171, '2024-12-09', '20:50:35', 'uploads/fritz jerometobes/Circle.docx', 'sadad', 15),
(172, '2024-12-09', '20:50:50', 'uploads/fritz jerometobes/Circle.docx', 'ghgh', 15),
(173, '2024-12-09', '21:01:25', 'uploads/fritz jerometobes/Circle.docx', 'asdasda', 15),
(174, '2024-12-09', '21:03:02', 'uploads/fritz jerometobes/Circle.docx', 'kjljkljklj', 15),
(175, '2024-12-09', '21:05:57', 'uploads/fritz jerometobes/Circle.docx', 'sdfsdfs', 15),
(176, '2024-12-09', '21:06:04', 'uploads/fritz jerometobes/Hoplinks.docx', 'popopop', 15),
(177, '2024-12-09', '22:09:41', 'uploads/fritz jerometobes/Circle.docx', 'lololololo', 15),
(178, '2024-12-09', '22:27:29', 'uploads/fritz jerometobes/Circle.docx', 'rfrfrfr', 15),
(179, '2024-12-09', '22:40:07', 'uploads/fritz jerometobes/Circle.docx', '', 15),
(180, '2024-12-09', '22:40:27', 'uploads/fritz jerometobes/Circle.docx', 'asdasd', 15),
(181, '2024-12-09', '22:40:48', 'uploads/fritz jerometobes/Hoplinks.docx', '12312413', 15),
(182, '2024-12-09', '22:44:24', 'uploads/fritz jerometobes/Circle.docx', '34234234232645645', 15);

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
(15, 'Fritz jerome', 'Tobes', '', 0, 0, 'Admin@gmail.com', '123', 'profile_pictures/Fritz jerome_Tobes/Fritz.jpg', '2023-08-29', 'background_pictures/Fritz jerome_Tobes/color-taps-abstract-8k-uq-1920x1080.jpg', '\"The only thing standing between you and your goal is the story you keep telling yourself as to why you can\'t achieve it.\" - Jordan Belfort', 'Madaluyong city', 'https://www.facebook.com/FrtzRome/'),
(16, 'Fritz', 'Tobes', '', 0, 0, 'bogart21@gmail.com', '321', 'profile_pictures/Fritz_Tobes/17.jpg', '2023-08-29', 'background_pictures/Fritz_Tobes/bryan-natanael-JJHudePsxcA-unsplash.jpg', '\"To be yourself in a world that is constantly trying to make you something else is the greatest accomplishment.\" - Ralph Waldo Emerson', 'Mandaluyong city', 'Wala pa'),
(17, 'Sebastian', 'Ergo', '', 0, 0, 'Sebastian@gmail.com', '456', 'profile_pictures/Sebastian_Ergo/baste.jpg', '2023-08-30', 'background_pictures/Sebastian_Ergo/16.jpg', 'EZ just go with the flow trust the process', 'Palapag northern Samar', 'https://www.facebook.com/bastekingsglaive.ergo'),
(18, 'Hannah ', 'Tobes', '', 0, 0, 'Hannah03@gmail.com', '159', 'profile_pictures/Hannah _Tobes/13.jpg', '2023-09-03', 'background_pictures/Hannah _Tobes/noot-noot-meme.gif', 'Life is weird so am I ', 'Parañaque City', 'wala pa '),
(19, 'Irene Joy', 'Tobes', '', 0, 0, 'ireneganda@gmail.com', '147', 'profile_pictures/Irene Joy_Tobes/12.jpg', '2023-09-03', 'background_pictures/Irene Joy_Tobes/oUbyAsPCQk54EgDID34efAPnCLAHmI9ZzGCAAA~tplv-dy-lqen-new_1456_816_q80 (1).jpeg', 'stay weird', 'Parañaque City', 'https://www.facebook.com/AnonymousQueen.30');

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
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
