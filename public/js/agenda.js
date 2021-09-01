document.addEventListener("DOMContentLoaded", function () {
    let formulario = document.getElementById("form");

    var calendarEl = document.getElementById("agenda");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        hiddenDays: [0, 6],
        events: [],

        slotDuration: "01:00",
        //defaultView: "agendaWeek",
        scrollTime: "09:00",
        slotMinTime: "09:00",
        slotMaxTime: "18:00",
        locale: "es",
        timeFormat: {
            agenda: "H:mm{ - h:mm}",
        },
        // headerToolbar: {
        //     left: "prev,next today",
        //     center: "title",
        //     right: "dayGridMonth, timeGridWeek, listWeek",
        // },

        dateClick: function (date, jsEvent, view) {
            var actual = new Date();
            if (date.date < actual) {
                date.dayEl.style.backgroundColor = "yellow";
            } else {
                alert(
                    "Error agenda: No se puede solicitar una cita en una fecha anterior a hoy"
                );
                return;
            }

            if (date.view.type == "dayGridMonth") {
                this.changeView("timeGridDay", date.dateStr);
            }
            if (date.view.type == "timeGridDay") {
                //  var hora = "01:00:00".split(":");

                //alert("Clicked on: " + info.dateStr);

                // change the day's background color just for fun
                // info.date.style.backgroundColor = "red";
                $("#appointment").modal("show");
                $("#startTime").val(
                    moment(date.dateStr).format("YYYY-DD-MM H:mm:ss")
                );
                $("#endTime").val(
                    moment(date.dateStr)
                        .add(moment.duration("01:00:00"))
                        .format("YYYY-DD-MM H:mm:ss")
                );
            }
        },
    });
    calendar.render();
});
