<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pro Sport Training - Accueil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

    <div class="slideshow-container">

        <div class="mySlides fade">
            <img src="/siteProSportTraining/assets/img/boxe.png" style="width:100%" alt="Image 1 du carrousel : boxe pour tout niveau">
            <div class="text">boxe pour tout niveau</div>
        </div>

        <div class="mySlides fade">
            <img src="/siteProSportTraining/assets/img/force.jpg" style="width:100%" alt="Image 2 du carrousel : sport de force">
            <div class="text">sport de force</div>
        </div>

        <div class="mySlides fade">
            <img src="/siteProSportTraining/assets/img/streatch.jpg" style="width:100%" alt="Image 3 du carrousel : remise en forme">
            <div class="text">remise en forme </div>
        </div>
        
        <div class="mySlides fade">
            <img src="/siteProSportTraining/assets/img/prepaP.jpg" style="width:100%" alt="Image 4 du carrousel : préparation physique"> 
            <div class="text">Preparation physique</div>
        </div>

        <div style="text-align:center">
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
            <span class="dot"></span>
        </div>
    </div>
    <main>
        <h2>🎯 Coaching sportif personnalisé pour des résultats concrets</h2>
        <p>Retrouvez la forme, gagnez en énergie ou atteignez vos objectifs physiques grâce à un accompagnement 100 % sur mesure.
        Je vous propose un coaching adapté à votre niveau, vos besoins et votre rythme.</p>

        <h2>💼 Mes domaines d’accompagnement</h2>
        <ul>
            <li>✅ Perte de poids</li>
            <li>✅ Reprise du sport</li>
            <li>✅ Renforcement musculaire</li>
            <li>✅ Préparation physique</li>
            <li>✅ Boxe forme & santé</li>
            <li>✅ Travail au poids du corps</li>
        </ul>

        <h2>💪 Pourquoi choisir Pro Sport Training ?</h2>
        <ul>
            <li>Programme personnalisé : chaque séance est conçue selon votre profil</li>
            <li>Suivi évolutif : on adapte en temps réel selon vos progrès et votre forme</li>
            <li>Motivation & écoute : je suis là pour vous encourager, vous guider, vous soutenir</li>
            <li>Accompagnement global : forme physique, mental, régularité</li>
        </ul>

        <h2>🧑‍🏫 Votre coach</h2>
        <p>Coach diplômé, passionné par la transformation durable, je vous accompagne avec bienveillance et exigence. Mon objectif : vous faire progresser en toute sécurité, avec des résultats visibles et durables.</p>

        <h2>📞 Envie de commencer ?</h2>
        <p>Prenez rendez-vous pour un premier échange gratuit. Nous définirons ensemble vos objectifs, votre emploi du temps, et la meilleure manière d’y arriver.</p>
        <p>
            <a href="/siteProSportTraining/index.php?page=contact" class="btn">Me contacter</a>
        </p>
    </main>
    <footer>
        <div class="footer-content">
            <div class="footer-block footer-logo-section">
                <a href="/siteProSportTraining/index.php?page=accueil"><img src="/siteProSportTraining/assets/img/logo2.png" alt="Logo Pro Sport Training" class="footer-logo"></a>
                <p class="tagline">Pro Sport Training Coaching sportif personnalisé - Forme, santé, performance</p>
            </div>
            <div class="footer-block footer-info-section">
                <a href="tel:+33750152908"><i class="fas fa-phone"></i> +33 7 50 15 29 08</a> |
                <a href="mailto:seb-dac67@hotmail.fr"><i class="fas fa-envelope"></i> seb-dac67@hotmail.fr</a>
                <p>
                    <a href="/siteProSportTraining/index.php?page=mentions-legales">Mentions Légales</a> | 
                    <a href="/siteProSportTraining/index.php?page=politique-confidentialite">Politique de Confidentialité</a>
                </p>
            </div>
            <div class="footer-block footer-social-section">
                <p>Me suivre</p>
                <a href="https://www.instagram.com" target="_blank" rel="noopener noreferrer">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="https://www.facebook.com/sebastiencoachsportif13?locale=fr_FR" target="_blank" rel="noopener noreferrer">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Pro Sport Training. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        // Initialisation de Flatpickr si un champ #reservation_date existe sur cette page
        flatpickr("#reservation_date", {
            dateFormat: "Y-m-d",
        });
    </script>
    
    <script src="/siteProSportTraining/assets/js/main.js"></script>

    <script src="/siteProSportTraining/frontend/agenda-app/public/carousel.js"></script>

</body>
</html>