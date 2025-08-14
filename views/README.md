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
