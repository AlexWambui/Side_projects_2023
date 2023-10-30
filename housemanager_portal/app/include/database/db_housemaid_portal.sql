-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 25, 2021 at 01:33 PM
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
-- Database: `db_housemaid_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `job_title` varchar(70) NOT NULL,
  `job_description` varchar(200) NOT NULL,
  `salary` double NOT NULL,
  `job_status` varchar(10) NOT NULL DEFAULT 'open',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `user_id`, `job_title`, `job_description`, `salary`, `job_status`, `date_created`) VALUES
(1, 3, 'Care Taker', 'Taking care of the house (cleaning).', 5000, 'open', '2021-10-19'),
(3, 3, 'Laundry', 'Clean clothes for family of six.', 4000, 'closed', '2021-10-19'),
(4, 5, 'House Keeper', 'Must be good at laudry.', 12000, 'open', '2021-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `job_applications`
--

CREATE TABLE `job_applications` (
  `id` int(6) NOT NULL,
  `maid_id` int(6) NOT NULL,
  `job_id` int(6) NOT NULL,
  `application_status` varchar(15) NOT NULL DEFAULT 'pending',
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `job_applications`
--

INSERT INTO `job_applications` (`id`, `maid_id`, `job_id`, `application_status`, `date_created`) VALUES
(2, 1, 3, 'declined', '2021-10-20'),
(3, 4, 1, 'accepted', '2021-10-20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) NOT NULL,
  `first_name` varchar(70) NOT NULL,
  `last_name` varchar(70) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `email_address` varchar(70) NOT NULL,
  `username` varchar(70) NOT NULL,
  `password` varchar(200) NOT NULL,
  `user_level` int(2) NOT NULL,
  `verification` varchar(20) NOT NULL DEFAULT 'pending',
  `residence` varchar(70) NOT NULL DEFAULT 'unknown',
  `skills` varchar(200) NOT NULL DEFAULT 'unknown',
  `profile_picture` varchar(200) NOT NULL DEFAULT 'uploads/default_pic.jpg',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `phone_number`, `email_address`, `username`, `password`, `user_level`, `verification`, `residence`, `skills`, `profile_picture`, `date_created`) VALUES
(1, 'Natalie', 'Elliott', '+1 (948) 305-8471', 'jipaziq@mailinator.com', 'natalie', 'nat', 1, 'verified', 'Kiambu', 'Cooking, baking, hospitality.', 'uploads/default_pic.jpg', '2021-10-18 08:29:43'),
(2, 'Admin', 'DBAdmin', '+1 (896) 657-6618', 'admin@gmail.com', 'admin', 'admin', 3, 'verified', 'unknown', '', 'uploads/default_pic.jpg', '2021-10-18 19:39:37'),
(3, 'Stewart', 'Boyle', '+1 (699) 542-3832', 'seeker@gmail.com', 'seeker', 'seeker', 2, 'verified', 'Nairobi', '', 'uploads/default_pic.jpg', '2021-10-18 20:08:20'),
(4, 'Grace', 'Jenny', '+1 (846) 685-3995', 'grace@gmail.com', 'grace', 'grace', 1, 'pending', 'Thika', 'Laundry, cooking, pet keeping.', 'uploads/default_pic.jpg', '2021-10-19 22:08:15'),
(5, 'Alexandra', 'Christian', '+1 (622) 358-2397', 'alexandra@yahoo.com', 'alexandra', 'alex', 2, 'verified', 'Thika', '', 'uploads/default_pic.jpg', '2021-10-19 22:21:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_applications`
--
ALTER TABLE `job_applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `maid_id` (`maid_id`,`job_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `job_applications`
--
ALTER TABLE `job_applications`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
