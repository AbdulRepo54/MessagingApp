-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2024 at 08:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`, `created_at`) VALUES
(1, 1525433299, 48115379, 'You good gang?', '2024-07-18 17:44:31'),
(2, 48115379, 1525433299, 'Yeah im good lil bro', '2024-07-18 17:45:02'),
(3, 48115379, 829161284, 'hey lil bro', '2024-07-18 21:02:00'),
(4, 829161284, 48115379, 'whats good gang', '2024-07-18 21:02:38'),
(5, 48115379, 829161284, 'wheres my money', '2024-07-18 21:49:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `unique_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Offline now',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `unique_id`, `fname`, `lname`, `email`, `password`, `img`, `status`, `created_at`) VALUES
(1, 829161284, 'John', 'doe', 'Johnathandoe@gmail.com', 'Johnathandoe', '1721324229john doe.jpg', 'Active now', '2024-07-18 17:37:09'),
(2, 1424672439, 'Naruto', 'Uzumaki', 'naruto@example.com', 'naruto123', '1721324474naruto.jpg', 'Offline now', '2024-07-18 17:41:14'),
(3, 1525433299, 'Donald', 'Trump', 'trump@example.com', 'trump123', '1721324515trump.jpg', 'Offline now', '2024-07-18 17:41:55'),
(4, 85962439, 'Joe', 'biden', 'joebiden@example.com', 'joebiden123', '1721324558joebiden.png', 'Offline now', '2024-07-18 17:42:38'),
(5, 510324003, 'Cristiano', 'Ronaldo', 'ronaldo@example.com', 'ronaldo123', '1721324588ronaldo.jpg', 'Offline now', '2024-07-18 17:43:08'),
(6, 485983272, 'Darren', 'Watkins', 'bob@example.com', 'bob123', '1721324620bob.jpg', 'Offline now', '2024-07-18 17:43:40'),
(7, 48115379, 'Mohammed', 'D', 'mohamed@example.com', 'mohamed123', '1721324655mohamed.png', 'Offline now', '2024-07-18 17:44:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`),
  ADD KEY `incoming_msg_id` (`incoming_msg_id`),
  ADD KEY `outgoing_msg_id` (`outgoing_msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`incoming_msg_id`) REFERENCES `users` (`unique_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`outgoing_msg_id`) REFERENCES `users` (`unique_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
