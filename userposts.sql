-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2024 at 02:56 PM
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
(176, '2024-12-09', '21:06:04', 'uploads/fritz jerometobes/Hoplinks.docx', 'popopop', 15);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `userposts`
--
ALTER TABLE `userposts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `userposts`
--
ALTER TABLE `userposts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=177;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
