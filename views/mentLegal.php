<?php
// views/mentions-legales.php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="legal-section">
        <h2>Mentions légales</h2>
        
        <h3>1. Éditeur du site</h3>
        <p>Nom du responsable : DA COSTA Sébastien</p>
        <p>Statut : Auto-entrepreneur</p>
        <p>SIRET : 123 456 789 00012</p>
        <p>Adresse : 451 rue Émile zola</p>
        <p>Email : contact@prosporttraining.fr</p>
        <p>Téléphone : 007 50 15 29 08</p>

        <h3>2. Directeur de publication</h3>
        <p>DA COSTA Sébastien – Fondateur du site Pro Sport Training</p>

        <h3>3. Hébergeur</h3>
        <p>OVH – 2 rue Kellermann, 59100 Roubaix, France</p>
        <p>Tél : 1007 – <a href="https://www.ovh.com" target="_blank" rel="noopener noreferrer">www.ovh.com</a></p>

        <h3>4. Propriété intellectuelle</h3>
        <p>Le contenu du site (textes, images, logos, vidéos) est protégé par les droits d'auteur. Toute reproduction, même partielle, est interdite sans autorisation écrite.</p>

        <h3>5. Responsabilité</h3>
        <p>Le propriétaire du site décline toute responsabilité en cas d'erreur, d'inaccessibilité ou de dysfonctionnement du site.</p>

        <h3>6. Traitement des données personnelles</h3>
        <p>Voir la <a href="/siteProSportTraining/index.php?page=politique-confidentialite">Politique de confidentialité</a> du site pour plus d'informations sur la collecte, l'utilisation et la protection de vos données.</p>

        <h3>7. Cookies</h3>
        <p>Le site peut utiliser des cookies à des fins de mesure d'audience ou de fonctionnement. Vous pouvez les refuser ou les configurer via votre navigateur.</p>
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
</style>
