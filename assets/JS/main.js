document.addEventListener('DOMContentLoaded', function() {
    const datepickerInput = document.getElementById("datepicker");
    if (datepickerInput) {
        flatpickr(datepickerInput, {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: "today",
        });
    }

    // Gestion de la soumission du formulaire d'agenda
    const agendaForm = document.getElementById("agendaForm");
    if (agendaForm) { 
        agendaForm.addEventListener("submit", function(e) {
            e.preventDefault(); 

            const datetime = datepickerInput ? datepickerInput.value : ''; 

            if (datetime) {
                localStorage.setItem("selectedDateTime", datetime);

                window.location.href = "index.php?page=panier";
            } else {
                alert("Veuillez choisir une date et une heure !");
            }
        });
    }
});
