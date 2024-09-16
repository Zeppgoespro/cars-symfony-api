-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql-cars
-- Generation Time: Sep 16, 2024 at 02:21 PM
-- Server version: 9.0.1
-- PHP Version: 8.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `symfony`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`) VALUES
(2, 'Toyota'),
(3, 'BMW'),
(4, 'Mercedes');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int NOT NULL,
  `brand_id` int DEFAULT NULL,
  `model_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `photo`, `price`, `brand_id`, `model_id`) VALUES
(1, NULL, 1500000, 2, 2),
(2, NULL, 2000000, 2, 3),
(3, NULL, 3000000, 2, 4),
(4, NULL, 2200000, 3, 5),
(5, NULL, 3000000, 3, 6),
(6, NULL, 4000000, 3, 7),
(7, NULL, 2800000, 4, 8),
(8, NULL, 3500000, 4, 9),
(9, NULL, 5000000, 4, 10);

-- --------------------------------------------------------

--
-- Table structure for table `credit_programs`
--

CREATE TABLE `credit_programs` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `interest_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credit_programs`
--

INSERT INTO `credit_programs` (`id`, `title`, `interest_rate`) VALUES
(1, 'Alfa Energy', 12.3),
(2, 'Sber Super Long', 15),
(3, 'Tinkoff Mega Affordable', 10),
(4, 'VTB Uber Medium', 13.5);

-- --------------------------------------------------------

--
-- Table structure for table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8mb3_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20240914200050', '2024-09-14 20:07:24', 198),
('DoctrineMigrations\\Version20240915174448', '2024-09-15 17:54:06', 601),
('DoctrineMigrations\\Version20240915225210', '2024-09-15 23:04:05', 2482),
('DoctrineMigrations\\Version20240916003031', '2024-09-16 00:37:23', 377);

-- --------------------------------------------------------

--
-- Table structure for table `loan_requests`
--

CREATE TABLE `loan_requests` (
  `id` int NOT NULL,
  `car_id` int DEFAULT NULL,
  `initial_payment` double NOT NULL,
  `loan_term` int NOT NULL,
  `credit_program_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `car_id`, `initial_payment`, `loan_term`, `credit_program_id`) VALUES
(1, 1, 400000, 48, 2),
(2, 2, 500000, 60, 3);

-- --------------------------------------------------------

--
-- Table structure for table `models`
--

CREATE TABLE `models` (
  `id` int NOT NULL,
  `brand_id` int DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `models`
--

INSERT INTO `models` (`id`, `brand_id`, `name`) VALUES
(2, 2, 'Corolla'),
(3, 2, 'Camry'),
(4, 2, 'Land Cruiser'),
(5, 3, 'Series 3'),
(6, 3, 'Series 5'),
(7, 3, 'X5'),
(8, 4, 'C-Class'),
(9, 4, 'E-Class'),
(10, 4, 'S-Class');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_95C71D1444F5D008` (`brand_id`),
  ADD KEY `IDX_95C71D147975B7E7` (`model_id`);

--
-- Indexes for table `credit_programs`
--
ALTER TABLE `credit_programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Indexes for table `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_2CC32CFAC3C6F69F` (`car_id`),
  ADD KEY `IDX_2CC32CFACDC0BCB4` (`credit_program_id`);

--
-- Indexes for table `models`
--
ALTER TABLE `models`
  ADD PRIMARY KEY (`id`),
  ADD KEY `IDX_E4D6300944F5D008` (`brand_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `credit_programs`
--
ALTER TABLE `credit_programs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `loan_requests`
--
ALTER TABLE `loan_requests`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `models`
--
ALTER TABLE `models`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cars`
--
ALTER TABLE `cars`
  ADD CONSTRAINT `FK_95C71D1444F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`),
  ADD CONSTRAINT `FK_95C71D147975B7E7` FOREIGN KEY (`model_id`) REFERENCES `models` (`id`);

--
-- Constraints for table `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD CONSTRAINT `FK_2CC32CFAC3C6F69F` FOREIGN KEY (`car_id`) REFERENCES `cars` (`id`),
  ADD CONSTRAINT `FK_2CC32CFACDC0BCB4` FOREIGN KEY (`credit_program_id`) REFERENCES `credit_programs` (`id`);

--
-- Constraints for table `models`
--
ALTER TABLE `models`
  ADD CONSTRAINT `FK_E4D6300944F5D008` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
