document.addEventListener('DOMContentLoaded', function() {

    $.ajax({
        url: "../api/v1/events",
        method: "GET",
    }).done(function(data) {
        //console.log(data)
        let events = JSON.parse(data);
        console.log(events)

        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'timeGrid', 'list' ],
            events: events,
            locale: 'es'
        })
        
        calendar.render();
    }).fail(function(){
        console.log('error al cargar ajax')
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'dayGrid', 'timeGrid', 'list' ],
            events: {},
            locale: 'es'
        })
        calendar.render();
    });
});