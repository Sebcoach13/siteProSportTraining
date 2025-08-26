<main>
    <section id="agenda-section">
        <h2>Notre Agenda</h2>
        <p>Consultez les disponibilités et les événements à venir. Réservez votre séance dès maintenant !</p>
        
        <div id="calendar-container">
            <div id="calendar"></div>
        </div>
    </section>
</main>

<!-- Scripts JavaScript de FullCalendar  -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js"></script>
<!-- Script pour la localisation en français -->
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/locales-all.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
            },
            locale: 'fr',
            buttonText: {
                today: 'Aujourd\'hui',
                month: 'Mois',
                week: 'Semaine',
                day: 'Jour',
                list: 'Liste'
            },
            events: [
                { title: 'Rendez-vous client', start: '2025-07-23', color: '#299BE8' },
                { title: 'Séance de coaching', start: '2025-07-30T14:00:00', end: '2025-07-30T15:30:00', color: '#4682B4' },
                { title: 'Réunion d\'équipe', start: '2025-07-31T09:00:00', end: '2025-07-31T10:00:00', color: '#32CD32' },
                { title: 'Jour férié', start: '2025-08-01', allDay: true, color: '#DDA0DD' }
            ],
            
            dateClick: function(info) {
                let isDateTaken = calendar.getEvents().some(event => {
                    return info.dateStr === event.startStr.substring(0, 10);
                });

                if (isDateTaken) {
                    alert('Cette date est déjà réservée. Veuillez en choisir une autre.');
                    return;
                }

                const urlParams = new URLSearchParams(window.location.search);
                const serviceId = urlParams.get('service_id');

                if (!serviceId) {
                    alert('Veuillez sélectionner une prestation de coaching avant de choisir une date. Vous allez être redirigé vers la page Coaching.');
                    window.location.href = '/index.php?page=coaching';
                    return;
                }

                if (confirm('Voulez-vous réserver la date du ' + info.dateStr + ' pour la prestation sélectionnée ?')) {
                    window.location.href = '/index.php?page=panier&date=' + info.dateStr + '&service_id=' + serviceId;
                }
            },

            eventClick: function(info) {
                alert('Événement cliqué : ' + info.event.title + ' le ' + info.event.startStr);
            },

            selectable: true,
            select: function(info) {
                
            },

            editable: true,
            eventDrop: function(info) {
                alert('Événement déplacé : ' + info.event.title + ' vers ' + info.event.start.toLocaleString());
            }
        });
        calendar.render();
    });
</script>
