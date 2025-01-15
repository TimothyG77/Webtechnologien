-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 02, 2025 at 03:41 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gd-hotels`
--

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE `newsletter` (
  `news_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`news_id`, `title`, `picture`, `content`, `date`) VALUES
(16, 'Titel 2', 'form/uploads/Screenshot 2023-09-18 210752.png', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et e', '2024-12-25'),
(17, 'Title 3', 'form/uploads/Screenshot 2024-12-14 192715.png', 'Künstliche Intelligenz (KI), auch artifizielle Intelligenz (AI), englisch artificial intelligence, ist ein Teilgebiet der Informatik, das sich mit der Automatisierung intelligenten Verhaltens und dem maschinellen Lernen befasst. Der Begriff ist schwierig zu definieren, da es bereits an einer genauen Definition von Intelligenz mangelt.\r\n\r\nVersuchsweise wird Intelligenz definiert als die Eigenschaft, die ein Wesen befähigt, angemessen und vorausschauend in seiner Umgebung zu agieren. Dazu gehört d', '2024-12-30');

-- --------------------------------------------------------

--
-- Table structure for table `reservation`
--

CREATE TABLE `reservation` (
  `id` int(11) NOT NULL,
  `CheckInDate` date NOT NULL,
  `CheckOutDate` date NOT NULL,
  `Breakfast` varchar(50) NOT NULL,
  `Parking` varchar(50) NOT NULL,
  `Pets` varchar(50) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` datetime DEFAULT current_timestamp(),
  `status` varchar(50) NOT NULL,
  `price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `reservation`
--

INSERT INTO `reservation` (`id`, `CheckInDate`, `CheckOutDate`, `Breakfast`, `Parking`, `Pets`, `user_id`, `creation_date`, `status`, `price`) VALUES
(26, '2025-01-17', '2025-01-21', 'no', 'no', '', 20, '2025-01-01 00:00:00', 'new', 200),
(27, '2025-01-17', '2025-01-21', 'no', 'no', '', 14, '2025-01-01 00:00:00', 'confirmed', 200),
(28, '2025-01-17', '2025-01-21', 'no', 'no', '', 14, '2025-01-01 00:00:00', 'new', 200),
(34, '2025-01-16', '2025-01-18', 'no', 'yes', 'snake', 14, '2025-01-02 00:00:00', 'new', 114),
(35, '2025-01-10', '2025-01-12', 'no', 'yes', 'snake', 14, NULL, 'new', 114),
(36, '2025-01-28', '2025-01-31', 'no', 'yes', 'cats', 14, '2025-01-02 15:40:44', 'new', 171);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `salutation` varchar(4) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `useremail` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(260) NOT NULL,
  `role` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `salutation`, `firstname`, `lastname`, `useremail`, `username`, `password`, `role`, `status`) VALUES
(10, 'Mr', 'Testfirstname', 'Testlastname', 'test.testemail@gmail.com', 'testusername', '$2y$10$X6b89G9YGQEw3IxHIHnOSOsB4QjXn.ma9CWysm/13wo.cjJ5poR6K', 'user', 'active'),
(14, 'Mr', 'Solana', 'SOL', 'solana.sol@gmail.com', 'Solana', '$2y$10$/R9Ueh8Phal15fD6DlRxR.mjXU0.XSlp0hlplAAcuiiMA42Dabkbi', 'user', 'active'),
(16, 'Mr', 'Administrator', 'Administrator', 'admin.gdhotels@gmail.com', 'Administrator', '$2y$10$SkdsNGow0XRjTqfB4CDz8OkwDn.D4z8R7Wx87asu3Rk.p0yON2KkO', 'admin', 'active'),
(17, 'Mr', 'Manpreet', 'Misson', 'manpreet.misson@india.com', 'primarykey', '$2y$10$tCTNrAeh7hYs.R9K8if8aelTI.cib.wkFR.GM4rfxVUpawqx3KZ5C', 'user', 'inactive'),
(18, 'Mr', 'Philip', 'Zeisler', 'philip.zeisler@gmail.com', 'Federball', '$2y$10$O628F8map32klfA5.fK19.HwU/xUlf/MW0jEPlX9HAQ/XSwcv/7y2', 'user', 'active'),
(19, 'Mrs', 'Sebastian', 'Ecker', 'sebastian.ecker@gmail.com', 'werIstDas', '$2y$10$EzKCYbvsFfYW0jQA2yFrcebTxAaSOO8snMpHdUzkVw6nwbpR7ZgaS', 'user', 'inactive'),
(20, 'Mr', 'Felix', 'Dallinger', 'dallinger.felix@gmail.com', 'Hexe', '$2y$10$QDLUduTnkSroh.VL3SVWdOPycXvQnRJ2MiLdOto/JOUqPukwBBCXG', 'user', 'active'),
(21, 'Dive', 'Timothy', 'Gregorian', 'timo.gregorian@gmail.com', 'pinkConverse', '$2y$10$q2jXMJufcU3X.JjMmsnhk.Fydi3R/JQ/utVb9U1u/Cs9vlGZ.2r/u', 'user', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `newsletter`
--
ALTER TABLE `newsletter`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `reservation`
--
ALTER TABLE `reservation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `newsletter`
--
ALTER TABLE `newsletter`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reservation`
--
ALTER TABLE `reservation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
