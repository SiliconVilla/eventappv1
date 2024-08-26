@extends('layouts.app')

@section('content')

<br>

<div class="card col-md-8" style="margin-top: 100px;">
    <div class="card-header">{{ __('Listado de Actividades') }}</div>
        <div class="card-body">
            <div class="">
                <div class="fixed-top" style="margin-top: 50px; text-align: center; font-weight: bold; font-size: 20px; background-color: #0069d9; color: white; padding-top: 2%; padding-bottom: 2%; ">
                    

                    <?php 
                        foreach ($listado as $key => $actividad) {
                           echo $actividad->evento;
                           break;
                        }
                    ?>

                    
        
  
                    
                </div>

                <div class="col-md-12" style="margin-top: 70px;">
                
                    <table id="tabla-listar-actividades" style="text-align: center;">
                        <thead></thead>
                        <tbody>
                            @foreach($listado as $actividad)
                            <tr style="border-bottom-style: solid; border-color: black; border-width: 1pt; background-color: black; width: 100%;">
                                <td style="width: 5%; text-align: center; font-weight: bold; background-color: white;">
                                  
                                <br>
                                    <h2>{{$actividad->dia_mes}}
                                    <br>
                                        @if($actividad->mes == "Jan")
                                        Ene
                                        @elseif($actividad->mes == "Feb")
                                        Feb
                                        @elseif($actividad->mes == "Mar")
                                        Mar
                                        @elseif($actividad->mes == "Apr")
                                        Abr
                                        @elseif($actividad->mes == "May")
                                        May
                                        @elseif($actividad->mes == "Jun")
                                        Jun
                                        @elseif($actividad->mes == "Jul")
                                        Jul
                                        @elseif($actividad->mes == "Aug")
                                        Ago
                                        @elseif($actividad->mes == "Sep")
                                        Sep
                                        @elseif($actividad->mes == "Oct")
                                        Oct
                                        @elseif($actividad->mes == "Nov")
                                        Nov
                                        @elseif($actividad->mes == "Dec")
                                        Dic
                                        @endif
                                    </h2>
                                    <br>
                                </td>

                                <td style="width: 25%; padding: 1%; background-color: #eaeec9;">
                                    <a href="detalle_actividad/{{ $actividad->activity_id }}">
                                        <h5 style="color: #712220; font-weight: bold;">
                                            <?php echo mb_strimwidth("$actividad->actividad" , 0, 40,"..."); ?>
                                            <!--{{$actividad->actividad}}-->
                                        </h5>
                                        <h6 style="color: #036474;">{{$actividad->lugar}}</h6>
                                        <h5 style="color: #6b4ab6;">{{$actividad->hora}}&nbsp;&nbsp;&nbsp;<a href="detalle_actividad/{{ $actividad->activity_id }}" class=""><img src="../public/imagenes/posicion.png" style="width: 30px;"></a>
                                        </h5> 
                                    
                                </td>


                            
                            @endforeach

                        </tbody>
                    </table>
                    

                </div>
            </div>
        </div>

</div>


    
