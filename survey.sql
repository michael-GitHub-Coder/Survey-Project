-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 10:02 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `surveys_table`
--

CREATE TABLE `surveys_table` (
  `id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_birth` date NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `favorite_food` text DEFAULT NULL,
  `movies_rating` varchar(20) NOT NULL,
  `radio_rating` varchar(20) NOT NULL,
  `eat_out_rating` varchar(20) NOT NULL,
  `tv_rating` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `surveys_table`
--

INSERT INTO `surveys_table` (`id`, `full_name`, `email`, `date_of_birth`, `contact_number`, `favorite_food`, `movies_rating`, `radio_rating`, `eat_out_rating`, `tv_rating`) VALUES
(18, 'Michael 9', 'test9@gmail.com', '2003-02-04', '0630570016', 'Pasta', 'Agree', 'Agree', 'Strongly Agree', 'Agree'),
(19, 'Michael 10', 'test10@gmail.om', '2006-06-12', '0630570016', 'Pizza', 'Strongly Agree', 'Strongly Disagree', 'Strongly Agree', 'Strongly Disagree');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `surveys_table`
--
ALTER TABLE `surveys_table`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `surveys_table`
--
ALTER TABLE `surveys_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
