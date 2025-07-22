document.addEventListener('DOMContentLoaded', function() {
    // Initialisation de Flatpickr seulement si l'élément datepicker existe sur la page
    const datepickerInput = document.getElementById("datepicker");
    if (datepickerInput) {
        flatpickr(datepickerInput, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
            // Assurez-vous d'inclure le CSS de Flatpickr dans votre header.php !
            // <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        });
    }

    // Gestion de la soumission du formulaire d'agenda
    const agendaForm = document.getElementById("agendaForm");
    if (agendaForm) { // Vérifie si le formulaire existe sur la page
        agendaForm.addEventListener("submit", function(e) {
            e.preventDefault(); // Empêche la soumission par défaut du formulaire

            const datetime = datepickerInput ? datepickerInput.value : ''; // Récupère la valeur du datepicker

            if (datetime) {
                // Stocke la date et l'heure sélectionnées dans le localStorage
                localStorage.setItem("selectedDateTime", datetime);

                // Redirection vers la page du panier
                // ATTENTION : Pour l'architecture MVC PHP, vous ne devriez PAS rediriger vers '/panier.html'
                // Vous devriez rediriger vers l'entrée de votre routeur PHP pour le panier, par ex:
                window.location.href = "index.php?page=panier";
            } else {
                alert("Veuillez choisir une date et une heure !");
            }
        });
    }
});