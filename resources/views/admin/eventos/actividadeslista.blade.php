@extends('layouts.appfull')

@section('content')
<br>
<div class="row">
    <!--div class="row">
        <div class="col-md-12">

            <table class="table table table-striped" style="background-color: white;" >
              <thead class="thead-dark">
                <tr>
                  <!--th scope="col">id_evento</th->
                  <th scope="col">evento</th>
                  <th scope="col">actividad</th>
                  <th scope="col">descripcion</th>
                  <th scope="col">id_lugar</th>
                  <th scope="col">id_estado</th>
                  <th scope="col">actividadEdt</th>
                </tr>
              </thead>
              <tbody>

                @foreach($listactividades as $actividad)  
                <tr>
                    <!--th scope="row">{{ $actividad->activity_id }}</th->
                    <td>{{ $actividad->evento }}</td>
                    <td>{{ $actividad->actividad }}</td>
                    <td>{{ $actividad->descripcion }}</td>
                    <td>{{ $actividad->lugar }}</td>
                    <td>{{ $actividad->fechafull }}</td>
                    <td>
                        @if($actividad->est_act_id == 1)
                            <a href="{{ url('actividades', $actividad->activity_id ) }}/archivar" class="btn btn-sm btn-success">Desac.</a>
                        @else
                            <a href="{{ $actividad->activity_id }}/restaurar" class="btn btn-sm btn-warning">Act.</a>
                        @endif
                            <a href="{{ $actividad->event_id }}/{{ $actividad->activity_id }}/editar" class="btn btn-sm btn-info">Editar</a>
                            <a href="{{ $actividad->activity_id }}/eliminar" class="btn btn-sm btn-danger">Elim.</a>
                    </td>
                </tr>
                @endforeach

                
              </tbody>
            </table>

                            
                            
        </div>
    </div-->

    <div class="row">


        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
        
        <div class="container">
         <div class="card col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xl-6" style="width: 28rem; background: lightblue;">
            <div class="container text-center">
               <h2>Laravel 9 Mi Calendario</h2>
            </div>
         </div>
         <div id='calendar'></div>
        </div>
    
        <script>
                $(document).ready(function () {
                
                var SITEURL = "{{ url('/') }}";
                
                $.ajaxSetup({
                    headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                
                var calendar = $('#calendar').fullCalendar({
                editable: true,
                events: SITEURL + "/fullcalendar",
                displayEventTime: false,
                editable: true,
                eventRender: function (event, element, view) {
                    if (event.allDay === 'true') {
                            event.allDay = true;
                    } else {
                            event.allDay = false;
                    }
                },
                selectable: true,
                selectHelper: true,
                select: function (start, end, allDay) {
                    var title = prompt('Event Title:');
                    if (title) {
                        var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                        $.ajax({
                            url: SITEURL + "/fullcalendarAjax",
                            data: {
                                title: title,
                                start: start,
                                end: end,
                                type: 'add'
                            },
                            type: "POST",
                            success: function (data) {
                                displayMessage("Evento Creado Exitosamente");

                                calendar.fullCalendar('renderEvent',
                                    {
                                        id: data.id,
                                        title: title,
                                        start: start,
                                        end: end,
                                        allDay: allDay
                                    },true);

                                calendar.fullCalendar('unselect');
                            }
                        });
                    }
                },
                eventDrop: function (event, delta) {
                    var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                    var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");

                    $.ajax({
                        url: SITEURL + '/fullcalendarAjax',
                        data: {
                            title: event.title,
                            start: start,
                            end: end,
                            id: event.id,
                            type: 'update'
                        },
                        type: "POST",
                        success: function (response) {
                            displayMessage("Evento Actualizado Exitosamente");
                        }
                    });
                },
                eventClick: function (event) {
                    var deleteMsg = confirm("¿Desea eliminar este Evento?");
                    if (deleteMsg) {
                        $.ajax({
                            type: "POST",
                            url: SITEURL + '/fullcalendarAjax',
                            data: {
                                    id: event.id,
                                    type: 'delete'
                            },
                            success: function (response) {
                                calendar.fullCalendar('removeEvents', event.id);
                                displayMessage("Evento Eliminado Exitosamente");
                            }
                        });
                    }
                }

                });
                
                });
                
                function displayMessage(message) {
                    toastr.success(message, 'Event');
                } 
                
        </script>

    </div>
    
</div>



@endsection