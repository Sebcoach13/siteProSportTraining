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




bdd: 


SET FOREIGN_KEY_CHECKS = 0;

-- Table des utilisateurs
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'client',
  `remember_token` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`firstname`, `lastname`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
  ('sebastien', 'Da costa', 'rayanedacosta361@gmail.com', '$2y$12$ENlm3TqsY9m9qdRXbMCbheykQH.JRcMGuEGbXoGQ8mIkgjE0C5bT.', 'client', NULL, '2025-07-24 18:15:06', '2025-07-27 15:35:34'),
  ('sebastien', 'Da costa', 'sebastiendacosta83@hotmail.fr', '$2y$12$PTfQi9Lep50iKAwp94nkw.oGA87SCeEgQqwzLaeooDTNt4TjpPJu.', 'client', NULL, '2025-08-12 14:19:38', '2025-08-12 14:19:38'),
  ('pascal', 'costa', 'pascalCosta@gmail.com', '$2y$12$goKVkWPb/IQKG0HUuyOq.OJNYbDy05GfmiNfQnGN13dcyw2VYGxwK', 'client', NULL, '2025-08-16 17:05:33', '2025-08-16 17:05:33');

-- Table des réservations
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `coach_id` int DEFAULT NULL,
  `service_type` varchar(100) NOT NULL,
  `reservation_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `duration_minutes` int NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `payment_status` enum('unpaid','paid','refunded') DEFAULT 'unpaid',
  `notes` text,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_reservation_user_id` (`user_id`),
  KEY `idx_reservation_coach_id` (`coach_id`),
  KEY `idx_reservation_date_time` (`reservation_date`,`start_time`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`coach_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table des paiements
CREATE TABLE IF NOT EXISTS `payments` (
  `id` int NOT NULL AUTO_INCREMENT,
  `reservation_id` int NOT NULL,
  `stripe_session_id` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `currency` varchar(3) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `reservation_id` (`reservation_id`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`reservation_id`) REFERENCES `reservations` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table des messages de contact
CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact_messages` (`firstname`, `lastname`, `email`, `subject`, `message`, `created_at`) VALUES
  ('sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'fr"fr"', '2025-08-12 15:45:37'),
  ('sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'rff', '2025-08-12 15:46:13'),
  ('sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'f"f', '2025-08-12 15:46:26'),
  ('sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'deéd', '2025-08-12 21:58:56'),
  ('sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'eded', '2025-08-12 22:01:49'),
  ('sebastien', 'Da costa', 'seb-dac67@hotmail.fr', 'Nouveau message de contact de sebastien Da costa', 'rer', '2025-08-14 17:39:54'),
  ('sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'efe', '2025-08-16 14:46:39'),
  ('sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'ezde', '2025-08-16 14:56:38'),
  ('sebastien', 'Da costa', 'rayanedacosta361@gmail.com', 'Nouveau message de contact de sebastien Da costa', 'edée', '2025-08-16 15:02:02');

-- Table des prix des services
CREATE TABLE IF NOT EXISTS `service_prices` (
  `id` int NOT NULL AUTO_INCREMENT,
  `service_type` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service_type` (`service_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `service_prices` (`service_type`, `price`) VALUES
  ('Boxe', 60.00),
  ('Coach Remise en Forme/Préparation Physique', 80.00),
  ('Musculation', 70.00);



