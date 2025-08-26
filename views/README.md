<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte Prototype pour les Prestations </title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        /* Variables CSS basées sur votre charte graphique */
        :root {
            --primary-bg-color: #f5f0e1; /* Fond principal */
            --secondary-bg-color: #F5F5F5; /* Fond secondaire */
            --card-bg-color: #ffffff;
            --primary-text-color: #000000; /* Texte principal */
            --secondary-text-color: #666666;
            --button-bg-color: #299BE8; /* Fond des boutons */
            --button-text-color: #FFFEFE; /* Texte des boutons */
            --button-hover-bg-color: #1a71b8; /* Fond des boutons au survol */
            --card-border-radius: 12px;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Styles globaux */
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--primary-bg-color);
            margin: 0;
            padding: 20px;
            box-sizing: border-box;
            line-height: 1.6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .coaching-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .coaching-item {
            width: 100%;
            max-width: 350px;
            background-color: var(--card-bg-color);
            border-radius: var(--card-border-radius);
            box-shadow: var(--card-shadow);
            overflow: hidden;
            transition: transform 0.3s ease-in-out;
            box-sizing: border-box;
        }
        
        .coaching-item:hover {
            transform: translateY(-5px);
        }

        .coaching-photo {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .coaching-content {
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .coaching-item h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-text-color);
            margin: 0;
        }

        .coaching-item p {
            font-size: 1rem;
            color: var(--secondary-text-color);
            margin: 0;
        }

        .coaching-price {
            font-weight: 600;
            color: var(--button-bg-color);
            font-size: 1.1rem;
            margin-top: 10px;
        }

        .btn {
            background-color: var(--button-bg-color);
            color: var(--button-text-color);
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            transition: background-color 0.3s ease;
            display: block;
            margin-top: 15px;
        }

        .btn:hover {
            background-color: var(--button-hover-bg-color);
        }
    </style>
</head>
<body>
    <main>
        <section class="coaching-section">
            <!-- Carte prototype pour une prestation -->
            <div class="coaching-item">
                <!-- Image de remplacement pour le prototype -->
                <img src="https://placehold.co/350x200/299BE8/ffffff?text=Visuel+Prestation" alt="Placeholder pour image de prestation" class="coaching-photo">
                <div class="coaching-content">
                    <!-- Titre de remplacement -->
                    <h3>Titre de la prestation</h3>
                    <!-- Description de remplacement -->
                    <p>Description courte de la prestation. Cet espace sera utilisé pour présenter les bénéfices de chaque service de coaching.</p>
                    <!-- Prix de remplacement -->
                    <p class="coaching-price">Tarif : 00€ / séance</p>
                    <!-- Bouton de réservation -->
                    <a href="#" class="btn">Réserver cette prestation</a>
                </div>
            </div>
        </section>
    </main>
</body>
</html>




-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql-messites.alwaysdata.net
-- Generation Time: Aug 26, 2025 at 10:08 PM
-- Server version: 10.11.13-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `messites_pro_sport_training_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `firstname`, `lastname`, `email`, `subject`, `message`, `created_at`) VALUES
(1, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'fr\"fr\"', '2025-08-12 13:45:37'),
(2, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'rff', '2025-08-12 13:46:13'),
(3, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'f\"f', '2025-08-12 13:46:26'),
(4, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'deéd', '2025-08-12 19:58:56'),
(5, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'eded', '2025-08-12 20:01:49'),
(6, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'rer', '2025-08-14 15:39:54'),
(7, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'efe', '2025-08-16 12:46:39'),
(8, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'ezde', '2025-08-16 12:56:38'),
(9, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'edée', '2025-08-16 13:02:02'),
(10, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'regqh', '2025-08-17 13:26:52'),
(11, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'regqh', '2025-08-17 13:27:02'),
(12, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', '\"réré', '2025-08-17 15:04:07'),
(13, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'ezfze', '2025-08-17 15:26:03'),
(14, 'Test', 'Test', 'Test@test.fr', 'Nouveau message de contact de Test Test', 'Test depuis form', '2025-08-17 16:00:22'),
(15, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'fhdh', '2025-08-17 16:29:47'),
(16, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'fhdh', '2025-08-17 16:29:52'),
(17, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'pop', '2025-08-17 16:31:52'),
(18, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'dzd', '2025-08-17 17:43:26'),
(19, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'aaaaa', '2025-08-17 19:37:54'),
(20, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'aaaaa', '2025-08-17 19:37:59'),
(21, 'sebastien', 'Da costa', 'vergueiro.steven@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'sqqs', '2025-08-24 19:50:30'),
(22, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'ddz', '2025-08-24 20:08:33'),
(23, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'rfr', '2025-08-24 21:47:53'),
(24, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'f((', '2025-08-24 21:55:28'),
(25, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'f(', '2025-08-24 22:04:50'),
(26, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'gr', '2025-08-24 22:27:55'),
(27, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'gr', '2025-08-24 22:28:00'),
(28, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'drg', '2025-08-24 22:32:46'),
(29, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'dez', '2025-08-24 22:51:10'),
(30, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'ffgre', '2025-08-24 23:09:06'),
(31, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'éed', '2025-08-26 11:42:22'),
(32, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'dsg', '2025-08-26 19:33:38'),
(33, 'sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'r\'f', '2025-08-26 19:33:51');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `reservation_id` int(11) NOT NULL,
  `stripe_session_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `coach_id` int(11) DEFAULT NULL,
  `service_type` varchar(100) NOT NULL,
  `reservation_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration_minutes` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','refunded') DEFAULT 'unpaid',
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `service_prices`
--

CREATE TABLE `service_prices` (
  `id` int(11) NOT NULL,
  `service_type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_prices`
--

INSERT INTO `service_prices` (`id`, `service_type`, `price`) VALUES
(1, 'Boxe', 60.00),
(2, 'Coach Remise en Forme/Préparation Physique', 80.00),
(3, 'Musculation', 70.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'client',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'sebastien', 'Da costa', 'rayanedacosta361@gmail.com', '$2y$12$ENlm3TqsY9m9qdRXbMCbheykQH.JRcMGuEGbXoGQ8mIkgjE0C5bT.', 'client', NULL, '2025-07-24 18:15:06', '2025-07-27 15:35:34'),
(2, 'sebastien', 'Da costa', 'sebastiendacosta83@hotmail.fr', '$2y$12$PTfQi9Lep50iKAwp94nkw.oGA87SCeEgQqwzLaeooDTNt4TjpPJu.', 'client', NULL, '2025-08-12 14:19:38', '2025-08-12 14:19:38'),
(3, 'pascal', 'costa', 'pascalCosta@gmail.com', '$2y$12$goKVkWPb/IQKG0HUuyOq.OJNYbDy05GfmiNfQnGN13dcyw2VYGxwK', 'client', NULL, '2025-08-16 17:05:33', '2025-08-16 17:05:33'),
(4, 'Test', 'Test', 'test@test.fr', '$2y$12$oshjAf5hWQ3KJ1c1mJqfKeOCBQstnDotkfrBX8.MmZ7zzcUsTtt2S', 'client', NULL, '2025-08-17 18:08:43', '2025-08-17 18:08:43'),
(7, 'bastien', 'coco', 'cocob@hotmail.fr', '$2y$12$VL5ObpJwlXVohF3ajVIBmOuI/WUavYDE6DaYWcce7ou28WDzff8zu', 'client', NULL, '2025-08-26 10:25:08', '2025-08-26 10:25:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reservation_id` (`reservation_id`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_reservation_user_id` (`user_id`),
  ADD KEY `idx_reservation_coach_id` (`coach_id`),
  ADD KEY `idx_reservation_date_time` (`reservation_date`,`start_time`);

--
-- Indexes for table `service_prices`
--
ALTER TABLE `service_prices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `service_type` (`service_type`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_prices`
--
ALTER TABLE `service_prices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`coach_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
