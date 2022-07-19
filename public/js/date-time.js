
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: { center: 'dayGridMonth,timeGridWeek,dayGridDay' },
        initialView: 'dayGridMonth',
        height: 800,
        selectable: true,
        editable: true,
        displayEventTime: true,
        dateClick: function() {
            let flatpickrInstance
            Swal.fire({
                title: 'Neues Event',
                html:
                    `<input class="swal2-input flatDate" id="start">
                       <input class="swal2-input" id="starter">`,
                confirmButtonText: 'Erstellen',
                stopKeydownPropagation: false,
                focusConfirm: false,

                preConfirm: () => {
                    if (flatpickrInstance.selectedDates[0] < new Date()) {
                        Swal.showValidationMessage(`The departure date can't be in the past`)
                    }
                    var title = Swal.getPopup().querySelector('#title').value
                    var start = Swal.getPopup().querySelector('#start').value
                    var end = Swal.getPopup().querySelector('#end').value
                    if (!title || !start) {
                        Swal.showValidationMessage(`Please enter login and password`)
                    }
                },
                willOpen: () => {
                    flatpickrInstance = flatpickr(
                        Swal.getPopup().querySelector('#starter')
                    )
                },
                allowOutsideClick: () => !Swal.isLoading()
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "/fullCalendarAjax",
                        data: {
                            title: title.value,
                            start: start.value,
                            end: end.value,
                            startTime: startTime.value,
                            eTime: eTime.value,
                            type: 'create'
                        },
                        type: "POST",
                        success: function () {
                            displayMessage("Event created.");
                            calendar.render();
                        }
                    })
                }
            });
        },


        events: {
            url: '/fullCalendar',
            method: 'GET',
            extraParams: {

            },
            failure: function() {
                alert('there was an error while fetching events!');
            },
            color: 'blue',   // a non-ajax option
            textColor: 'white' // a non-ajax option
        }
    });
    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': json_encode(csrf_token())
}})
    calendar.render();
})
function displayMessage(message) {
    Swal.fire(
        message,
        'That thing is still around?',
        'question'
    )
}

