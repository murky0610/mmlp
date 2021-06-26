-- phpMyAdmin SQL DUMP
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2021 at 09:49 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mmlp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `ticket_id` int(30) NOT NULL,
  `movie_id` int(30) NOT NULL,
  `ts_id` int(30) NOT NULL,
  `qty` int(11) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `id` int(11) NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`ticket_id`, `movie_id`, `ts_id`, `qty`, `date`, `time`, `id`, `price`) VALUES
(151, 12, 4, 30, '0000-00-00', '00:00:00', 9, 1800),
(152, 10, 4, 5, '0000-00-00', '00:00:00', 9, 200),
(153, 10, 4, 4, '0000-00-00', '14:00:00', 9, 160),
(154, 10, 4, 4, '0000-00-00', '10:00:00', 9, 160),
(155, 10, 4, 5, '2021-07-08', '10:00:00', 9, 200);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `connect to 'customers'` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `connect to 'customers'` FOREIGN KEY (`id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `customers->id` FOREIGN KEY (`id`) REFERENCES `customers` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
