
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {

                    headerToolbar: { center: 'dayGridMonth,timeGridWeek,dayGridDay' },
                    initialView: 'dayGridMonth',
                    height: 800,
                    selectable: true,
                    editable: true,
                    displayEventTime: true,
                    locale: 'de',
                    eventSources: [

                        // your event source
                        {
                            url: '/getTrainerEvents',
                            method: 'GET',
                            extraParams: {
                                trainerId: {{$trainer->id}}
                            },
                            failure: function() {
                                alert('there was an error while fetching events!');
                            },
                            color: 'green',   // a non-ajax option
                            textColor: 'white' // a non-ajax option
                        }
                    ],
                    dateClick: function(selectedDate) {
                        let flatpickrInstance
                        let startDate =  selectedDate.dateStr;

                        Swal.fire({
                            title: 'Neues Event erstellen',
                            html: '<table>' +
                                '<tr><th><label for="title">Titel</label></th><th><input type="text" class="swal2-input" id="title"></th></tr>' +
                                '<tr><td><label for="start">Start</label></td><td><input type="text" class="swal2-input flatDate" id="start" value=" '+ startDate +' "></td></tr>' +
                                '<tr><td><label for="end">Ende</label></td><td><input class="swal2-input flatDate" id="end" value=" '+ startDate +' "></td></tr>' +
                                '</table>'
                                    ,
                            confirmButtonText: 'Erstellen',
                            stopKeydownPropagation: false,
                            preConfirm: () => {
                                if (flatpickrInstance.selectedDates < new Date()) {
                                    Swal.showValidationMessage(`The departure date can't be in the past`)
                                }
                                var title = Swal.getPopup().querySelector('#title').value
                                var start = Swal.getPopup().querySelector('#start').value
                                var end = Swal.getPopup().querySelector('#end').value
                                if (!title || !start || !end) {
                                    Swal.showValidationMessage(`Alle Felder sind Pflichtfelder`)
                                }
                            },
                            willOpen: () => {
                                flatpickrInstance = flatpickr(
                                    // Swal.getPopup().querySelector('.flatDate')
                                    Swal.getPopup().querySelectorAll('.flatDate'),{
                                        altFormat: "d.m.y",
                                        altInput:  true
                                    },
                                )
                            }
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: "/editEvents",
                                    data: {
                                        title: title.value,
                                        start: start.value,
                                        end: end.value,
                                        type: 'create'
                                    },
                                    type: "POST",
                                    success: function (data) {
                                        displayMessage(data)
                                    }
                                })
                            }
                        });

                    },
                    eventDrop: function (eventDropInfo) {

                        var start = FullCalendar.formatDate(eventDropInfo.event.start, {
                            month: 'numeric',
                            year: 'numeric',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            locale: 'en'
                        });
                        var end = FullCalendar.formatDate(eventDropInfo.event.end, {
                            month: 'numeric',
                            year: 'numeric',
                            day: 'numeric',
                            hour: 'numeric',
                            minute: 'numeric',
                            locale: 'en'
                        });
                        var title = eventDropInfo.event.title;
                        $.ajax({
                            url: '/editEvents',
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                id: eventDropInfo.event.id,
                                type: 'update',
                                extras: eventDropInfo.event.extendedProps
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Event Updated Successfully");

                            }

                        });

                    },
                    eventMouseEnter: function( mouseEnterInfo ) {

                    },
                    eventClick: function (info) {
                        let  extras =  info.event.extendedProps
                        console.log(info.event.start);
                        Swal.fire({
                            title: 'Event details',
                            html: '<table>' +
                                '<tr><th><label for="title">Titel</label></th><th><span id="title">'+info.event.title+'</span></th></tr>' +
                                '<tr><th><label for="title">Location</label></th><th><input type="text" class="swal2-input" id="location" value="'+extras.location_id+'"></th></tr>' +
                                '<tr><td><label for="start">Start</label></td><td><input type="text" class="swal2-input flatDate" id="start" value=" '+ info.event.startStr +' "></td></tr>' +
                                '<tr><td><label for="end">Ende</label></td><td><input class="swal2-input flatDate" id="end" value=" '+ info.event.endStr +' "></td></tr>' +
                                '</table>'
                            ,
                            confirmButtonText: 'Speichern',
                            stopKeydownPropagation: false,
                            preConfirm: () => {
                                if (flatpickrInstance.selectedDates < new Date()) {
                                    Swal.showValidationMessage(`The departure date can't be in the past`)
                                }
                                var title = Swal.getPopup().querySelector('#title').value
                                var start = Swal.getPopup().querySelector('#start').value
                                var end = Swal.getPopup().querySelector('#end').value
                                if (!title || !start || !end) {
                                    Swal.showValidationMessage(`Alle Felder sind Pflichtfelder`)
                                }
                            },
                            willOpen: () => {
                                flatpickrInstance = flatpickr(
                                    // Swal.getPopup().querySelector('.flatDate')
                                    Swal.getPopup().querySelectorAll('.flatDate'),{
                                        altFormat: "d.m.y",
                                        altInput:  true
                                    },
                                )
                            }
                        })
                    }
                });
                function displayMessage(data) {
                    Swal.fire(
                        data.title,
                        icon = 'success',

                    )
                    calendar.refetchEvents();

                }
                $.ajaxSetup({
                    headers: {'X-CSRF-TOKEN': {!! json_encode(csrf_token()) !!},
                    }})

                calendar.render();
            });



        </script>
        <div class="row mx-4">


        <div class="col-md-9">
            <div id='calendar'></div>
        </div>
          <div class="col-md-3 border-2">
              <table table-bordered style="width: 100%">
                  <tr>
                      <th>
                          Legende
                      </th>
                  </tr>
                  <tr>
                      <th>
                          Farbe:
                      </th>
                      <th>
                          Art:
                      </th>
                  </tr>


              </table>
          </div>
        </div>

