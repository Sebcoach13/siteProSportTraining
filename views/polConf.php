<?php
// views/politique-confidentialite.php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="legal-section">
        <h2>Politique de confidentialité</h2>
        
        <h3>1. Identité du responsable du traitement</h3>
        <p>Le présent site est exploité par :<br>
        DA COSTA Sébastien – Pro Sport Training<br>
        SIRET : 123 456 789 00012<br>
        Email : contact@prosporttraining.fr</p>

        <h3>2. Données personnelles collectées</h3>
        <p>Les données que nous collectons peuvent inclure :</p>
        <ul>
            <li>Nom et prénom</li>
            <li>Adresse email</li>
            <li>Numéro de téléphone</li>
            <li>Message envoyé via le formulaire</li>
            <li>Données de navigation (via cookies, si applicable)</li>
        </ul>

        <h3>3. Finalité du traitement</h3>
        <p>Les données sont collectées dans le cadre :</p>
        <ul>
            <li>De la prise de contact ou de réservation</li>
            <li>Du suivi client (planification de séances, échanges)</li>
            <li>De l’amélioration du site (analyse de trafic)</li>
            <li>Du respect des obligations légales</li>
        </ul>

        <h3>4. Durée de conservation</h3>
        <p>Les données sont conservées :</p>
        <ul>
            <li>Pendant 3 ans à compter du dernier contact pour les prospects</li>
            <li>Jusqu’à 5 ans pour les clients (obligations comptables)</li>
            <li>Cookies : maximum 13 mois</li>
        </ul>

        <h3>5. Partage des données</h3>
        <p>Vos données ne sont jamais revendues.<br>
        Elles peuvent être transmises uniquement à :</p>
        <ul>
            <li>L’hébergeur (pour assurer le bon fonctionnement du site)</li>
            <li>Outils d’analyse (type Google Analytics, si utilisé)</li>
        </ul>

        <h3>6. Vos droits</h3>
        <p>Conformément au RGPD, vous disposez de droits :</p>
        <ul>
            <li>Accès à vos données</li>
            <li>Rectification ou suppression</li>
            <li>Opposition au traitement</li>
            <li>Portabilité de vos données</li>
        </ul>
        <p>Pour exercer ces droits, envoyez un email à : contact@prosporttraining.fr</p>

        <h3>7. Cookies</h3>
        <p>Le site peut utiliser des cookies pour :</p>
        <ul>
            <li>Mesurer l’audience (ex. : Google Analytics)</li>
            <li>Améliorer l’expérience utilisateur</li>
        </ul>
        <p>Vous pouvez refuser les cookies ou les configurer via votre navigateur.</p>

        <h3>8. Sécurité</h3>
        <p>Vos données sont stockées sur des serveurs sécurisés et ne sont accessibles que par le responsable du traitement.</p>
    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>

<style>
    .legal-section {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        text-align: left;
    }
    .legal-section h2 {
        color: var(--color-text-primary);
        margin-bottom: 30px;
        font-size: var(--font-size-title-secondary);
        text-align: center;
    }
    .legal-section h3 {
        color: var(--color-text-primary);
        margin-top: 25px;
        margin-bottom: 15px;
        font-size: 1.5em;
    }
    .legal-section p {
        color: var(--color-text-primary);
        line-height: 1.6;
        margin-bottom: 10px;
    }
    .legal-section ul {
        list-style: disc inside;
        margin-left: 20px;
        margin-bottom: 20px;
        color: var(--color-text-primary);
    }
    .legal-section ul li {
        margin-bottom: 5px;
    }
</style>
