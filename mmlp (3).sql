-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 27, 2021 at 11:05 PM
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
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` text DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `Points` float DEFAULT NULL,
  `Payment_ID` int(11) DEFAULT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`username`, `email`, `password`, `phone`, `address`, `Points`, `Payment_ID`, `id`) VALUES
('JC', 'jcwarain@gmail.com', '$2y$10$mxWqc/B2cbtbmxw1BsjY3uUo2haXEVTdZKIz0CVUJKQvQd62wxajG', '+9234425982234', 'Toril', NULL, NULL, 0),
('JC123', 'jcwarain@yahoo.com', '$2y$10$WShzadhcbDOzju8AihpdUuXmIgfwm1jWl7.wDHg/LeiKmsOcgirpG', NULL, NULL, NULL, NULL, 8),
('Qeixo', 'jrwarain1@up.edu.ph', '$2y$10$jV9m.7OjBkhpU7w3EAW.deUE9C4hj1Y6gM7qnvUrvRIyXV0xIufZK', '09234425982', 'Toril, Davao City, Philippines', 23.2, NULL, 9);

-- --------------------------------------------------------

--
-- Table structure for table `food`
--

CREATE TABLE `food` (
  `food_id` int(30) NOT NULL,
  `ticket_id` int(30) NOT NULL,
  `fries_price` int(11) DEFAULT NULL,
  `num_fries` int(11) DEFAULT NULL,
  `popcorn_price` int(11) DEFAULT NULL,
  `num_popcorn` int(11) DEFAULT NULL,
  `nachos_price` int(11) DEFAULT NULL,
  `num_nachos` int(11) DEFAULT NULL,
  `softdrinks_price` int(11) DEFAULT NULL,
  `num_softdrinks` int(11) DEFAULT NULL,
  `water_price` int(11) DEFAULT NULL,
  `num_water` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food`
--

INSERT INTO `food` (`food_id`, `ticket_id`, `fries_price`, `num_fries`, `popcorn_price`, `num_popcorn`, `nachos_price`, `num_nachos`, `softdrinks_price`, `num_softdrinks`, `water_price`, `num_water`) VALUES
(40, 177, 100, 2, 80, 2, 160, 2, 80, 2, 40, 2),
(41, 181, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `food_menu`
--

CREATE TABLE `food_menu` (
  `id` int(11) NOT NULL,
  `fries_menu_price` int(11) NOT NULL,
  `popcorn_menu_price` int(11) NOT NULL,
  `nachos_menu_price` int(11) NOT NULL,
  `softdrinks_menu_price` int(11) NOT NULL,
  `water_menu_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `food_menu`
--

INSERT INTO `food_menu` (`id`, `fries_menu_price`, `popcorn_menu_price`, `nachos_menu_price`, `softdrinks_menu_price`, `water_menu_price`) VALUES
(1, 50, 40, 80, 40, 20);

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `cover_img` text NOT NULL,
  `description` text NOT NULL,
  `duration` float NOT NULL,
  `date_showing` date NOT NULL,
  `end_date` date NOT NULL,
  `price` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `title`, `cover_img`, `description`, `duration`, `date_showing`, `end_date`, `price`) VALUES
(10, 'Malcolm & Marie', 'malcolm.jpg', 'A filmmaker on the brink of Hollywood glory and his girlfriend, whose story made his career, find themselves pushed towards a reckoning as a single tumultuous night decides the fate of their relationship.\r\nRated +18', 1.9, '2021-06-25', '2021-07-25', 40),
(11, 'Raya and the Last Dragon', 'Raya.webp', 'Raya, a warrior, sets out to track down Sisu, a dragon, who transferred all her powers into a magical gem which is now scattered all over the kingdom of Kumandra, dividing its people.', 2, '2021-06-19', '2021-07-25', 50),
(12, 'The Mitchells vs. the Machines', 'mitchell.jpg', 'Young Katie Mitchell embarks on a road trip with her proud parents, younger brother and beloved dog to start her first year at film school. But their plans to bond as a family soon get interrupted when the world\'s electronic devices come to life to stage an uprising. With help from two friendly robots, the Mitchells must now come together to save one another -- and the planet -- from the new technological revolution.', 2, '2021-06-19', '2021-07-25', 60),
(14, 'Outside the Wire', 'out_wire.jpg', 'In the near future, a drone pilot sent into a war zone finds himself paired up with a top-secret android officer on a mission to stop a nuclear attack.', 1.9, '2021-06-19', '2021-07-25', 50),
(16, 'The Little Things', 'little.jpg', 'Deputy Sheriff Joe \"Deke\" Deacon joins forces with Sgt. Jim Baxter to search for a serial killer who\'s terrorizing Los Angeles. As they track the culprit, Baxter is unaware that the investigation is dredging up echoes of Deke\'s past, uncovering disturbing secrets that could threaten more than his case.', 2.2, '2021-06-19', '2021-07-25', 60),
(19, 'Mortal Kombat 11', 'MK11.jpg', 'Hunted by the fearsome warrior Sub-Zero, MMA fighter Cole Young finds sanctuary at the temple of Lord Raiden. Training with experienced fighters Liu Kang, Kung Lao and the rogue mercenary Kano, Cole prepares to stand with Earth\'s greatest champions to take on the enemies from Outworld in a high-stakes battle for the universe. <be>', 1.83, '2021-06-25', '2021-07-25', 40);

-- --------------------------------------------------------

--
-- Table structure for table `movies_showtime`
--

CREATE TABLE `movies_showtime` (
  `id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `ts_id` int(11) NOT NULL,
  `showdate` date NOT NULL,
  `showtime` time NOT NULL,
  `available_seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `movies_showtime`
--

INSERT INTO `movies_showtime` (`id`, `movie_id`, `ts_id`, `showdate`, `showtime`, `available_seats`) VALUES
(8, 10, 2, '2021-07-08', '14:00:00', 20),
(9, 10, 3, '2021-07-08', '14:00:00', 30),
(12, 10, 4, '2021-07-01', '15:00:00', 30),
(13, 10, 4, '2021-07-03', '12:00:00', 30),
(14, 10, 5, '2021-07-03', '12:00:00', 30),
(15, 10, 5, '2021-07-01', '15:00:00', 30),
(16, 11, 4, '2021-07-02', '19:00:00', 30),
(17, 11, 5, '2021-07-02', '19:00:00', 30),
(18, 11, 4, '2021-07-03', '19:00:00', 30),
(19, 11, 5, '2021-07-03', '19:00:00', 30),
(20, 11, 2, '2021-07-08', '16:00:00', 20),
(21, 11, 3, '2021-07-08', '16:00:00', 30),
(22, 14, 4, '2021-07-10', '19:00:00', 30),
(23, 14, 5, '2021-07-10', '19:00:00', 30),
(24, 14, 2, '2021-07-11', '17:00:00', 20),
(25, 14, 3, '2021-07-11', '17:00:00', 30),
(26, 14, 4, '2021-07-13', '16:00:00', 30),
(27, 14, 5, '2021-07-13', '16:00:00', 30),
(28, 12, 2, '2021-07-09', '19:00:00', 20),
(29, 12, 3, '2021-07-09', '19:00:00', 30),
(30, 12, 4, '2021-07-10', '15:00:00', 30),
(31, 12, 5, '2021-07-10', '15:00:00', 30),
(32, 12, 2, '2021-07-13', '19:00:00', 20),
(33, 12, 3, '2021-07-13', '19:00:00', 30),
(34, 16, 4, '2021-07-14', '19:00:00', 30),
(35, 16, 5, '2021-07-14', '19:00:00', 30),
(36, 16, 2, '2021-07-11', '10:00:00', 30),
(37, 16, 3, '2021-07-11', '10:00:00', 30),
(38, 16, 4, '2021-07-14', '15:00:00', 30),
(39, 16, 5, '2021-07-14', '15:00:00', 30),
(40, 19, 4, '2021-07-06', '15:00:00', 30),
(41, 19, 5, '2021-07-06', '15:00:00', 30),
(42, 19, 2, '2021-07-04', '10:00:00', 20),
(43, 19, 3, '2021-07-04', '10:00:00', 30),
(44, 19, 2, '2021-07-05', '17:00:00', 20),
(45, 19, 3, '2021-07-05', '17:00:00', 30);

-- --------------------------------------------------------

--
-- Table structure for table `payment_form`
--

CREATE TABLE `payment_form` (
  `payment_ID` int(11) NOT NULL,
  `Paymaya_ID` int(11) DEFAULT NULL,
  `GCash_ID` int(11) DEFAULT NULL,
  `debit_card_no` int(11) DEFAULT NULL,
  `credit_card_no` int(11) DEFAULT NULL,
  `Paypal_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `theater`
--

CREATE TABLE `theater` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater`
--

INSERT INTO `theater` (`id`, `name`) VALUES
(1, '3D'),
(2, 'Theater 1');

-- --------------------------------------------------------

--
-- Table structure for table `theater_settings`
--

CREATE TABLE `theater_settings` (
  `id` int(30) NOT NULL,
  `theater_id` int(30) NOT NULL,
  `seat_group` varchar(250) NOT NULL,
  `seat_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `theater_settings`
--

INSERT INTO `theater_settings` (`id`, `theater_id`, `seat_group`, `seat_count`) VALUES
(2, 1, 'Box 1', 20),
(3, 1, 'Box 2', 30),
(4, 2, 'Box 1', 30),
(5, 2, 'Box 2', 30);

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
(177, 10, 4, 4, '2021-01-01', '15:00:00', 9, 160),
(181, 10, 4, 3, '2021-01-01', '15:00:00', 9, 120),
(182, 10, 4, 3, '2021-01-01', '15:00:00', 9, 120),
(187, 12, 2, 3, '2021-07-09', '19:00:00', 9, 180);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `food`
--
ALTER TABLE `food`
  ADD PRIMARY KEY (`food_id`),
  ADD KEY `tickets->ticket-id_1` (`ticket_id`);

--
-- Indexes for table `food_menu`
--
ALTER TABLE `food_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `movies_showtime`
--
ALTER TABLE `movies_showtime`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theater_settings and id` (`ts_id`);

--
-- Indexes for table `payment_form`
--
ALTER TABLE `payment_form`
  ADD PRIMARY KEY (`payment_ID`);

--
-- Indexes for table `theater`
--
ALTER TABLE `theater`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `theater_settings`
--
ALTER TABLE `theater_settings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `theater->ticket-id` (`theater_id`);

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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `food`
--
ALTER TABLE `food`
  MODIFY `food_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `food_menu`
--
ALTER TABLE `food_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `movies_showtime`
--
ALTER TABLE `movies_showtime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `payment_form`
--
ALTER TABLE `payment_form`
  MODIFY `payment_ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `theater`
--
ALTER TABLE `theater`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `ticket_id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `food`
--
ALTER TABLE `food`
  ADD CONSTRAINT `tickets->ticket-id` FOREIGN KEY (`ticket_id`) REFERENCES `tickets` (`ticket_id`);

--
-- Constraints for table `movies_showtime`
--
ALTER TABLE `movies_showtime`
  ADD CONSTRAINT `theater_settings and id` FOREIGN KEY (`ts_id`) REFERENCES `theater_settings` (`id`);

--
-- Constraints for table `theater_settings`
--
ALTER TABLE `theater_settings`
  ADD CONSTRAINT `theater->ticket-id` FOREIGN KEY (`theater_id`) REFERENCES `theater` (`id`);

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
