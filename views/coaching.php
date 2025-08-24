<?php
include_once __DIR__ . '/header.php';
?>

<main>
    <section class="coaching-section">
        <h2>Nos Prestations de Coaching</h2>
        <p>Découvrez nos différents programmes adaptés à vos objectifs.</p>

        <div class="coaching-item">
            <h3>Boxe</h3>
            <img src="/assets/img/coachBoxe.png" alt="Image de Boxe" class="coaching-photo">
            <p>Améliorez votre technique, votre endurance et votre force avec nos cours de boxe. Idéal pour le cardio et la confiance en soi.</p>
            <p class="coaching-price">Tarif : 60€ / séance</p>
            <a href="/index.php?page=agenda&service_id=1" class="btn">Réserver cette prestation</a>
        </div>

        <div class="coaching-item">
            <h3>Coach Remise en Forme/Préparation Physique</h3>
            <img src="/assets/img/coachPrepa.png" alt="Image de Préparation Physique" class="coaching-photo">
            <p>Optimisez vos performances sportives avec un programme de préparation physique sur mesure, adapté à votre discipline.</p>
            <p class="coaching-price">Tarif : 80€ / séance</p>
            <a href="/index.php?page=agenda&service_id=2" class="btn">Réserver cette prestation</a>
        </div>

        <div class="coaching-item">
            <h3>Musculation</h3>
            <img src="/assets/img/coachMuscu.png" alt="Image de Musculation" class="coaching-photo">
            <p>Développez votre masse musculaire et sculptez votre corps avec nos séances de musculation encadrées par des professionnels.</p>
            <p class="coaching-price">Tarif : 70€ / séance</p>
            <a href="/index.php?page=agenda&service_id=3" class="btn">Réserver cette prestation</a>
        </div>

    </section>
</main>

<?php
include_once __DIR__ . '/footer.php';
?>
