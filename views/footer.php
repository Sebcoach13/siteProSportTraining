    </div> 
    <footer>
        <div class="footer-content">
            <div class="footer-block footer-logo-section">
                <a href="/index.php?page=accueil"><img src="/assets/img/logo2.png" alt="Logo Pro Sport Training" class="footer-logo"></a>
                <p class="tagline">Pro Sport Training Coaching sportif personnalisé - Forme, santé, performance</p>
            </div>
            <div class="footer-block footer-info-section">
                <a href="tel:+33750152908"><i class="fas fa-phone"></i> +33 7 50 15 29 08</a> |
                <a href="mailto:seb-dac67@hotmail.fr"><i class="fas fa-envelope"></i> seb-dac67@hotmail.fr</a>
                <p>
                    <a href="/index.php?page=mentions-legales">Mentions Légales</a> | 
                    <a href="/index.php?page=politique-confidentialite">Politique de Confidentialité</a> | 
                    <a href="/index.php?page=cgv">CGV</a>
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
        <p class="footer-content">&copy; <?php echo date("Y"); ?> Pro Sport Training. Tous droits réservés.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr("#reservation_date", {
            dateFormat: "Y-m-d",
        });
    </script>
    
    <script src="./../assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let slideIndex = 0;
            showSlides();

            function showSlides() {
                let i;
                let slides = document.getElementsByClassName("mySlides");
                let dots = document.getElementsByClassName("dot");

                // Vérification pour s'assurer que les éléments existent
                if (slides.length === 0 || dots.length === 0) {
                    return;
                }

                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                
                slideIndex++;
                if (slideIndex > slides.length) {
                    slideIndex = 1
                }
                
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                
                slides[slideIndex - 1].style.display = "block";
                dots[slideIndex - 1].className += " active";
                
                setTimeout(showSlides, 4000);
            }
        });
    </script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const hamburgerBtn = document.querySelector('.hamburger-btn');
        const navMenu = document.querySelector('.nav-menu');
        
        if (hamburgerBtn && navMenu) {
            hamburgerBtn.addEventListener('click', () => {
                const isExpanded = hamburgerBtn.getAttribute('aria-expanded') === 'true' || false;
                hamburgerBtn.setAttribute('aria-expanded', !isExpanded);
                
                hamburgerBtn.classList.toggle('is-open');
                navMenu.classList.toggle('is-open');
            });
        }
    });
</script>
</body>
</html>