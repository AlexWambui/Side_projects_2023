-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 12:41 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_ngong_stage_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `email_address` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_address`, `password`, `user_level`, `date_created`) VALUES
(1, 'Alexander', 'Dunlap', 'user_test@gmail.com', 'user', 1, '2021-09-27 08:31:03'),
(2, 'Caldwell', 'Sellers', 'edu@gmail.com', '1234', 1, '2021-09-30 14:34:06');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(6) NOT NULL,
  `registration_number` varchar(10) NOT NULL,
  `arrival_time` time NOT NULL,
  `departure_time` time NOT NULL,
  `date_today` date NOT NULL DEFAULT current_timestamp(),
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `registration_number`, `arrival_time`, `departure_time`, `date_today`, `date_created`) VALUES
(1, 'KDA 554E', '10:30:00', '11:02:00', '2021-09-28', '2021-09-27 10:57:05'),
(3, 'KCB 132A', '16:20:00', '16:25:00', '2021-09-27', '2021-09-28 06:05:47'),
(4, 'KBB 342F', '12:21:00', '12:23:00', '2021-09-27', '2021-09-28 06:18:19'),
(5, 'KAX 554Y', '15:18:00', '15:22:00', '2021-09-28', '2021-09-28 08:13:22'),
(6, 'KXY 433T', '18:11:00', '19:10:00', '2021-09-28', '2021-09-28 11:09:02'),
(7, 'KDA 776D', '17:36:00', '18:00:00', '2021-09-30', '2021-09-30 14:36:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
