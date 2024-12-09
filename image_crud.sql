-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2023 at 11:16 AM
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
-- Database: `image_crud`
--

-- --------------------------------------------------------

--
-- Table structure for table `userposts`
--

CREATE TABLE `userposts` (
  `post_id` int(11) NOT NULL,
  `post_created` date DEFAULT current_timestamp(),
  `time_posted` time DEFAULT current_timestamp(),
  `image_post_id` int(11) DEFAULT NULL,
  `image_post` longblob DEFAULT NULL,
  `text_post` text DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `userposts`
--

INSERT INTO `userposts` (`post_id`, `post_created`, `time_posted`, `image_post_id`, `image_post`, `text_post`, `user_id`) VALUES
(100, '2023-08-29', '20:56:55', NULL, 0x55736572506f7374732f467269747a206a65726f6d652d546f6265732f313639333331333831352e6a7067, 'T_T', 15),
(101, '2023-08-29', '20:58:24', NULL, 0x55736572506f7374732f426f676172742d546f6265732f313639333331333930342e6a7067, '-_-', 16),
(102, '2023-08-30', '18:09:18', NULL, 0x55736572506f7374732f53656261737469616e2d4572676f2f313639333339303135382e6a7067, 'Working na ulit sya T_T', 17),
(103, '2023-09-02', '19:42:01', NULL, NULL, 'I\'m back on track', 15),
(104, '2023-09-02', '19:42:27', NULL, 0x55736572506f7374732f467269747a206a65726f6d652d546f6265732f313639333635343934372e6a7067, 'This should work', 15),
(105, '2023-09-02', '22:17:47', NULL, 0x55736572506f7374732f467269747a206a65726f6d652d546f6265732f313639333636343236372e676966, 'Good night <3', 15),
(106, '2023-09-02', '22:18:04', NULL, NULL, 'I\'m back with the C', 15),
(107, '2023-09-02', '22:21:12', NULL, NULL, 'Gumagana na sya ulit!', 17),
(108, '2023-09-03', '12:04:25', NULL, NULL, 'Everything is working so far <3 ', 16),
(109, '2023-09-03', '12:04:50', NULL, 0x55736572506f7374732f467269747a2d546f6265732f313639333731333839302e6a7067, 'Nice!!!', 16),
(110, '2023-09-03', '12:06:54', NULL, NULL, 'I\'m back on the track', 17),
(111, '2023-09-03', '12:07:13', NULL, 0x55736572506f7374732f53656261737469616e2d4572676f2f313639333731343033332e6a7067, 'Sunday!', 17),
(112, '2023-09-03', '15:14:05', NULL, 0x55736572506f7374732f48616e6e6168202d546f6265732f313639333732353234352e676966, 'Monday nanaman 0_0', 18),
(113, '2023-09-03', '15:15:45', NULL, NULL, 'Gumagana na lahat kunti nalang ', 18),
(114, '2023-09-03', '15:16:17', NULL, NULL, 'Ayun lang and dipa na gana ', 18),
(115, '2023-09-03', '16:59:42', NULL, 0x55736572506f7374732f4972656e65204a6f792d546f6265732f313639333733313538322e6a7067, 'happy birthday, sis! ', 19);

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
(15, 'Fritz jerome', 'Tobes', '', 0, 0, 'Admin@gmail.com', '123', 'profile_pictures/Fritz jerome_Tobes/Fritz.jpg', '2023-08-29', 'background_pictures/Fritz jerome_Tobes/admin_bg.jpg', '\"The only thing standing between you and your goal is the story you keep telling yourself as to why you can\'t achieve it.\" - Jordan Belfort', 'Madaluyong city ', 'https://www.facebook.com/FrtzRome/'),
(16, 'Fritz', 'Tobes', '', 0, 0, 'bogart21@gmail.com', '321', 'profile_pictures/Fritz_Tobes/17.jpg', '2023-08-29', 'background_pictures/Fritz_Tobes/15.jpg', '\"To be yourself in a world that is constantly trying to make you something else is the greatest accomplishment.\" - Ralph Waldo Emerson', 'Mandaluyong city', 'Wala pa'),
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
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
