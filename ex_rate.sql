-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 08:03 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ex_rate`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `model` varchar(255) NOT NULL,
  `body` varchar(255) NOT NULL,
  `engine` varchar(255) NOT NULL,
  `hp` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `engine_size` varchar(255) NOT NULL,
  `startdate` date NOT NULL,
  `enddate` date NOT NULL,
  `steering_system` varchar(255) NOT NULL,
  `airbag` varchar(255) NOT NULL,
  `brake_system` varchar(255) NOT NULL,
  `A_C` varchar(255) NOT NULL,
  `aid_kit` varchar(255) NOT NULL,
  `fire` varchar(255) NOT NULL,
  `km` varchar(255) NOT NULL,
  `ex_with` varchar(255) DEFAULT NULL,
  `images` varchar(255) NOT NULL,
  `payment` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `user_id`, `model`, `body`, `engine`, `hp`, `transmission`, `engine_size`, `startdate`, `enddate`, `steering_system`, `airbag`, `brake_system`, `A_C`, `aid_kit`, `fire`, `km`, `ex_with`, `images`, `payment`, `price`, `type`) VALUES
(35, 47, 'Bmw', 'Coupe', 'Diesel', '120', 'Automatic', '1600', '2021-06-26', '2021-06-26', 'Electric power', 'Yes', 'ABS', 'Yes', 'Yes', 'Yes', '5000', NULL, 'car-5.jpg', NULL, '100000', 'auction'),
(36, 47, 'Bmw', 'Coupe', 'Diesel', '120', 'Automatic', '1600', '2021-06-26', '2021-06-26', 'Electric power', 'Yes', 'ABS', 'Yes', 'Yes', 'Yes', '5000', NULL, 'car-5.jpg', NULL, '100000', 'auction'),
(37, 47, 'Audi', 'Coupe', 'Diesel', '2000', 'Automatic', '2000', '0000-00-00', '0000-00-00', 'Hydraulic', 'Yes', 'ABS', 'Yes', 'Yes', 'Yes', '50,000', 'same model higher class', 'car.jpg', NULL, NULL, 'exchange'),
(38, 45, 'Audi', 'Sedan', 'Diesel', '1600', 'Manual', '1600', '0000-00-00', '0000-00-00', 'Hydraulic', 'Yes', 'ABS', 'Yes', 'Yes', 'Yes', '100,000', 'different model higher class', '3992dce7d2_1024.jpg', NULL, NULL, 'exchange'),
(39, 45, 'Audi', 'Sedan', 'Diesel', '2000', 'Manual', '500', '2021-06-27', '2021-06-27', 'Electro-hydraulic', 'Yes', 'ABS', 'Yes', 'Yes', 'Yes', '100000', NULL, 'car bg.jpg', NULL, '3000000', 'auction');

-- --------------------------------------------------------

--
-- Table structure for table `ex_with`
--

CREATE TABLE `ex_with` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `car_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ex_with`
--

INSERT INTO `ex_with` (`id`, `user_id`, `car_id`, `description`) VALUES
(1, 45, 36, 'i need it');

-- --------------------------------------------------------

--
-- Table structure for table `rate`
--

CREATE TABLE `rate` (
  `rate_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `ratestar` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rate`
--

INSERT INTO `rate` (`rate_id`, `user_id`, `item_id`, `ratestar`) VALUES
(13, 43, 6, 2),
(14, 44, 6, 5),
(15, 45, 2, 4),
(16, 45, 1, 4),
(17, 46, 3, 3),
(18, 46, 2, 3),
(19, 46, 1, 3),
(20, 47, 3, 3),
(21, 47, 2, 3),
(22, 47, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `r_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `profile` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`r_id`, `user_id`, `name`, `image`, `profile`, `title`) VALUES
(1, 47, 'Mona Salem', 'car-4.jpg', 'avatar-12.jpg', 'what about ?'),
(2, 47, 'Mona Salem', 'car2.jpg', 'avatar-12.jpg', 'i need rate'),
(3, 45, 'Ahmed mohamed', 'car-2.jpg', 'avatar-9.jpg', '');

-- --------------------------------------------------------

--
-- Table structure for table `rating_comment`
--

CREATE TABLE `rating_comment` (
  `rc_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate_id` int(11) NOT NULL,
  `rc_text` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `u_id` int(11) NOT NULL,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `u_image` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `country` varchar(255) DEFAULT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`u_id`, `fname`, `lname`, `phone`, `email`, `u_image`, `password`, `country`, `type`) VALUES
(45, 'Ahmed', 'mohamed', '0123964682', 'ahmed@yahoo.com', 'avatar-9.jpg', '123', 'Cairo', 'user'),
(46, 'Mostafa', ' Ahmed', '01126719343', 'mostafa@yahoo.com', 'avatar-11.jpg', '123', 'Cairo', 'user'),
(47, 'Mona', 'Salem', '0109837363', 'mona@yahoo.com', 'avatar-12.jpg', '123', 'Cairo', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `par_id` (`user_id`);

--
-- Indexes for table `ex_with`
--
ALTER TABLE `ex_with`
  ADD PRIMARY KEY (`id`),
  ADD KEY `car_id` (`car_id`),
  ADD KEY `us_id` (`user_id`);

--
-- Indexes for table `rate`
--
ALTER TABLE `rate`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`r_id`),
  ADD KEY `fkId` (`user_id`);

--
-- Indexes for table `rating_comment`
--
ALTER TABLE `rating_comment`
  ADD PRIMARY KEY (`rc_id`),
  ADD KEY `fkIdd` (`user_id`),
  ADD KEY `fk_supd` (`rate_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`u_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ex_with`
--
ALTER TABLE `ex_with`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `rate`
--
ALTER TABLE `rate`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `rating_comment`
--
ALTER TABLE `rating_comment`
  MODIFY `rc_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `par_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ex_with`
--
ALTER TABLE `ex_with`
  ADD CONSTRAINT `car_id` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `us_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `fkId` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `rating_comment`
--
ALTER TABLE `rating_comment`
  ADD CONSTRAINT `fkIdd` FOREIGN KEY (`user_id`) REFERENCES `users` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_supd` FOREIGN KEY (`rate_id`) REFERENCES `rating` (`r_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
