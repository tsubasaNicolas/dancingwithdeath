<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ 'Dancing with Death' }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">


    <!-- full calendar -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.css">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/main.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.9.0/locales-all.js"></script>


</head>
<body style="background-color:#1F618D">
    <div id="app">
        <nav class="navbar navbar-expand-md shadow-sm navbar-expand-lg navbar-light" style="background-color:#34495E;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{  'Dancing with Death' }}
                </a>
                <button class="navbar-toggler btn btn-warning" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                 aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon text-white"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <!-- Left Side Of Navbar -->
            @if(Auth::check())

                    <ul class="navbar-nav mr-auto">
                    <a class="nav-link text-white" href="{{ route('appointments.index') }}">{{ __('Appointments') }}</a>

                    </ul>
             @endif

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <!-- <script src="{{ asset('js/agenda.js') }}"></script> -->
<?php

        $exp = explode("/", $_SERVER["REQUEST_URI"]);

?>

@if($exp[1] =='appointments')
     
      
        <script>

            
 document.addEventListener("DOMContentLoaded", function () {
    let formulario = document.getElementById("form");

    var calendarEl = document.getElementById("agenda");
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: "dayGridMonth",
        hiddenDays: [0, 6],
        //themeSystem: 'bootstrap'
        events: [           

         
@if(Auth::user())

            
     @foreach ($appointments as $appointment )

{
    id:'{{$appointment->id}}',
    title:'{{$appointment->name}}',
    start:'{{$appointment->startTime}}',
    end:'{{$appointment->endTime}}',
},
    
@endforeach


          @endif
 
    
          
        ],

        eventClick:function(calEvent, jsEvent, view) {

            $('#eventModal').modal();

            console.log(calEvent.event.title);
            $("#name0").html(calEvent.event.title);
            $("#date").html( moment(calEvent.event.start).format("YYYY-MM-DD"));
            $("#appointmentId").val(calEvent.event.id);
            $("#hour").html( moment(calEvent.event.start).format("HH:mm"));

        },

        slotDuration: "01:00",
        allDaySlot:false,
        scrollTime: "09:00",
        slotMinTime: "09:00",
        slotMaxTime: "18:00",
      //  locale: "es",
     
        headerToolbar: {
            left: "prev,next today",
            center: "title",
            right: "dayGridMonth, listWeek",
        },

        dateClick: function (date, jsEvent, view) {
            var actual = new Date();
            if (date.date > actual) {        
               console.log("entry")
            } else{
               
                 Swal.fire({
            title: 'Sorry !',
            text: 'You cannot request an appointment on a date before today',
            icon: 'error',
            confirmButtonText: 'OK'
                    });
                return;
            }

            if (date.view.type == "dayGridMonth") {
                this.changeView("timeGridDay", date.dateStr);
            }
            if (date.view.type == "timeGridDay") {
                
                $("#appointment").modal("show");
                $("#startTime").val(
                    moment(date.dateStr).format("YYYY-MM-DD H:mm:ss")
                );
                $("#endTime").val(
                    moment(date.dateStr)
                        .add(moment.duration("01:00:00"))
                        .format("YYYY-MM-DD H:mm:ss")
                );
               
            }
        },
    });
    calendar.render();
});


        </script>

@endif
      



        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

            @if(session('register')=="Yes")

            <script type="text/javascript">
                Swal.fire({  
            title: 'Congratulations !',
            text: 'You already have a date to dance with death',
            icon: 'success',
            confirmButtonText: 'OK'
            });
            </script>

            @elseif (session('delete')=="Yes")
              <script type="text/javascript">
                Swal.fire({

            title: 'Success !',
            text: 'You have canceled the appointment',
            icon: 'success',
            confirmButtonText: 'OK'
            });

            </script>
            @endif

                    <main class="py-4">
                        @yield('content')
                    </main>
            </div>

                
 </body>
</html>
