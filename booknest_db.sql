-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 11, 2024 at 12:55 PM
-- Server version: 8.0.23
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `booknest_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `acc_no` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `category` varchar(50) NOT NULL,
  `author` varchar(255) NOT NULL,
  `copies` int NOT NULL,
  `publisher` varchar(255) NOT NULL,
  `isbn` varchar(50) NOT NULL,
  `copyright_year` year NOT NULL,
  `class_no` varchar(50) NOT NULL,
  `price` double NOT NULL,
  `status` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  PRIMARY KEY (`acc_no`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`acc_no`, `title`, `category`, `author`, `copies`, `publisher`, `isbn`, `copyright_year`, `class_no`, `price`, `status`, `comment`) VALUES
(1, 'Modoldoova', 'English Fiction', 'Martin Wickramiasingha', 2, 'mw', '4125-956', 2019, 'EF', 750, 'old', ''),
(2, 'Alice in Wonderland', 'Englidh Fiction', 'Caroll Lewis', 1, 'Ladybird', '0-7124-1654-3', 2015, 'CAR-F', 1100, 'New', '');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `name` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(50) NOT NULL,
  `contact_no` char(10) NOT NULL,
  `grade_class` varchar(3) NOT NULL,
  `user_id` varchar(10) NOT NULL,
  `password` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`name`, `email`, `contact_no`, `grade_class`, `user_id`, `password`) VALUES
('Fazna Sheriffdeen', 'gfsheriffdeen@gmail.com', '0758528524', '11B', '4526', 'Qwerty@123'),
('Fathima', 'fathima@gmail.com', '0728569426', '11B', '4741', 'qazwsx123'),
('Chamaylee', 'chamaylee@gmail.com', '0758528524', '11B', '4785', 'qazwsx123'),
('rithosha', 'rithosha@gmail.com', '2178523698', '11D', '7850', 'qwerty123'),
('Sampath Perera', 'sampath@gmail.com', '0756985236', '', 'AAAA', 'admin@123');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
