-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2023 at 05:05 AM
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
-- Database: `db_loha_auto_taxi_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `username` varchar(80) NOT NULL,
  `email_address` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_level` int(11) NOT NULL DEFAULT 1,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email_address`, `password`, `user_level`, `date_created`) VALUES
(1, 'Admin', 'administrator', 'admin', 'admin@gmail.com', '$2y$10$bcd/xvG4SgvuqbfA4J8WvOesGCGd5JLua5E3wd1NxYuLcOQcXIQtW', 1, '2023-10-04 19:08:37'),
(2, 'admin', 'administrator1', 'testadmin', 'admin@gmail.com', '$2y$10$qT.WyObtKCbieaAxBs5H0.wM9MsT1aTvZgJYQCzAOsRQBlMIF6JwK', 1, '2023-10-04 19:17:44'),
(3, 'Alex', 'Aaqil', 'aaqil', 'aaqil@gmail.com', '$2y$10$qT.WyObtKCbieaAxBs5H0.wM9MsT1aTvZgJYQCzAOsRQBlMIF6JwK', 1, '2023-10-04 22:02:50');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `registration_number`, `arrival_time`, `departure_time`, `date_today`, `date_created`) VALUES
(1, 'KBC 404B', '05:10:00', '06:10:00', '2023-10-05', '2023-10-04 21:10:41');

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
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
