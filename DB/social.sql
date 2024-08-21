-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2024 at 04:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `social`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(500) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(1, 'John De', 'John_De_28', 'john@gmail.com', 'john123', '2024-08-21', 'sfdsdf', 1, 1, 'no', ''),
(2, 'Demo', 'demo_', 'demo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ','),
(3, 'Admin', 'admin_', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ','),
(4, 'Admin', 'admin__1', 'admin1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ','),
(5, 'Admin', 'admin__1_2', 'admin2@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ','),
(6, 'Admin', 'admin__1_2_3', 'admin3@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ','),
(7, 'Admin1', 'admin1_', 'adm@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ','),
(8, 'Admin1', 'admin1__1', 'joh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '2024-08-21', '../../assets/images/Defalut/profile.png', 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
