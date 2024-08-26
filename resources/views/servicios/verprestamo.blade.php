@extends('layouts.app')

@section('content')

<br>

<div class="row">


            <div class="col-md-8" style="background-color: white;">
                <div class="row">
                    <div class="" style="width: 60%;">
                    <a href="{{ route('dashprestamos') }}"><img style="width: 15%;" src="../public/imagenes/icons8-back-arrow.gif"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Detalle de Incidencia No. --->') }}
                    </div>
                    <div class="" style="width: 40%;">
                        <input id="id" class="btn btn-danger"  type="text" readonly name="id" value="{{ $prestamo->id }}">
                    </div>
                    
                </div>

                <div class="row">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        @if (session('notification'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('notification') }}
                                </ul>
                            </div>
                        @endif
                     
                     <div class="panel-body">
                        
                        <table class="table table-bordered">
                        <thead>
                            <tr>
                                <!--th>Cógido</th-->
                                <th>Elemento</th>
                                <th>Área</th>
                                <th>Descripción</th>
                                <th></th>
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!--td>{{ $prestamo->id }}</td-->
                                <td>{{ $prestamo->elemento }}</td>
                                <td>{{ $prestamo->tipo }} - {{ $prestamo->categoria }}</td>
                                <td>{{ $prestamo->descripcion }}</td>
                               
                                <td> 
                                   
                                    @if($prestamo->categoria == 'Actividad Física y Deporte')
                              
                                        <button type="button" class="form-control btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                            Formato
                                        </button>
                                    @elseif($prestamo->categoria == 'Cultura')
                                        <button type="button" class="form-control btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalFormatoCultura">
                                            Formato
                                        </button>
                                    @else
                                        -
                                    @endif
                              
                                </td>
                                

                                
                            </tr>
                        </tbody>

                        <thead>
                            <tr>
                                <th>Servidor</th>
                                <th>Usuario</th>
                                <th>Préstamo</th>
                                <th>Devolución</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $prestamo->servidor }}</td>
                                <td>{{ $prestamo->usuario }}</td>
                                <td>{{ $prestamo->fecha }}</td>
                                <td>{{ $prestamo->updated_at }}</td>
                                <!--td>{{ $prestamo->fecha }}</td-->
                                
                            </tr>
                        </tbody>

                        </table>


                        <!--table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Área</th>
                                <td>{{ $prestamo->fecha }}</td>
                            </tr>

                            <tr>
                                <th>Tipo</th>
                                <td>{{ $prestamo->fecha }}</td>
                            </tr>

                            </tr>
                                <th>Descripción</th>
                                <td>{{ $prestamo->descripcion }}</td>
                            </tr>

                            </tr>
                                <th>cliente</th>  
                                <td>{{ $prestamo->fecha }}</td>
                            </tr>

                      

                            </tr>
                                <th>Adjuntos</th>  
                                <td>"Servicio en creación..."</td>
                            </tr>

                        </tbody>
                        
                        </table-->

                     


                     </div>

                    
                </div>
                

            </div>

            <div class="col-md-4">
             @include('includes.menuverprestamo')
            </dvi>


     
            

            
</div>


<div class="col-md-12"  style="background-color: white;">

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%; background-image: url('public/imagenes/FormatoPrestamoDevolucionDeportes.png');" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Actividad Lúdico Deportiva</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
              

                <div class="container" style="background-color:white;">
                    <div class="row">
                        <div class="col-md-7"  style="margin-top: 0%;">
                        <h6 style="visibility: hidden;">{{ $prestamo->id }}</h6>
                      
                            <h6>Bienestar Universitario
                            <br>Actividad Física y Deportiva
                            <br>Formato Préstamo y Devolución de Implementos Deportivos
                            </h6>
                       
                            <!--a href="{{ route('pdfview',['download'=>'pdf', 'id'=>$prestamo->id]) }}">Generar PDF</a-->
                        
                        </div>
                        
                        <div class="col-md-5"  style="text-align: center;">
                            
                            <img src="{{ url('public/imagenes/escudoUnal_black.png') }}" width="60%">
                        </div>
                        </div>


                        <div class="row" style="margin-top: 10px; padding: 3px; border: 1px black solid;">
                        <div class="col-md-6"  style="border: solid 1px black; text-align: center; margin-top: 0%; background-color:#ffffff">
                            
                            
                            
                            <div class="row" style="">
                                <h6>PRÉSTAMO</h6>
                            </div>
                            <div class="row" style="">
                                <!--h6>Fecha: __dd__//_mm_//_aaaa_ Hora:_hh:mm_ {{ $prestamo->fecha }}</h6-->
                                
                                <h6>
                                <?php 
                                 
                                    $timestamp = strtotime($prestamo->fecha);
                                    echo "Fecha:__".date("d", $timestamp)."_";
                                    echo "//";
                                    echo "_".date("m", $timestamp)."_";
                                    echo "//";
                                    echo "_".date("Y", $timestamp)."__ ";
                                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora:__".date("H:i", $timestamp)."__";
                                ?>
                                </h6>
                                
                               
                            </div>
                            <div class="row" style="">
                                <h6>Nombre de Quién Presta:___{{ $prestamo->usuario }}____</h6>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-6"  style="border: solid 1px black; text-align: center; margin-top: 0%; background-color:#ffffff">
                            
                            
                            
                            <div class="row" style="">
                                <h6>PRÉSTAMO</h6>
                            </div>
                            <div class="row" style="">
                                
                                @if($prestamo->updated_at != null)
                                    <h6>
                                        <?php 
                                        
                                            
                                            $timestamp = strtotime($prestamo->updated_at);
                                            echo "Fecha:__".date("d", $timestamp)."_";
                                            echo "//";
                                            echo "_".date("m", $timestamp)."_";
                                            echo "//";
                                            echo "_".date("Y", $timestamp)."__ ";
                                            echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora:__".date("H:i", $timestamp)."__";
                                        ?>
                                    </h6>
                                @else
                                    <h6>Fecha: _____//____//______ Hora:___:____</h6>
                                @endif

                            </div>
                            <div class="row" style="">
                                <h6>Nombre de Quién Recibe:___{{ $prestamo->servidor }}____</h6>
                            </div>
                            
                        </div>
                        </div>


                        <div class="row" style="border-left: 1px black solid; border-right: 1px black solid; border-bottom: 1px black solid;">
                        <div class="col-md-12"  style="margin-top: 0%; background-color:#ffffff">
                            
                            
                            <h6>Recibí del Área de actividad Física y Deportiva, en calidad de Préstamo, los siguientes implementos deportivos</h6>
                            
                        </div>
                        
                        
                        
                        </div>


                        <div class="row" style="border-left: 1px black solid; border-right: 1px black solid;">
                      
                        <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                            
                        @if($prestamo->descripcion == '')
                            - N/A - 
                        @else
                            {{ $prestamo->elemento }} - {{ $prestamo->descripcion }}
                        @endif
                        
                        </div>
                        <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                             <br> 
                        </div>
                        <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                            
                        <br>
                        </div>
                        <div class="col-md-12"  style="border-bottom: 0px black solid; margin-top: 0%; background-color:#ffffff">
                        
                        <h6>Los cuales me comprometo a cuidar. De no ser así me comprometo y me haré responsable de la reposición de los mismos.</h6>
                            
                        </div>
                        
                        
                        
                        </div>


                        <div class="row" style="margin-top: 0px; border-left: 1px black solid; border-right: 1px black solid;">
                            <div class="col-md-4"  style="margin-top: 0%; background-color:#ffffff">
                                
                                
                                <h6 style="border-bottom: 1px solid black; padding: 5px;">Firma: {!! QrCode::size(25)->generate($firmaPrestamoQR); !!} {{ $prestamo->fecha }}</h6>
                                
                            </div>
                            
                    
                            <div class="col-md-2"  style="margin-top: 0%; text-align: right; background-color:#ffffff">
                                
                                
                                <h6>Estamento:</h6>


                                
                                
                            </div>

                            
                            
                            <div class="col-md-2"  style="">
                                @if ( $prestamo->estamento == 'Docente')
                                    <h6>Docente: X</h6>
                                @else 
                                    <h6>Docente:</h6>
                                @endif
                            </div>
                            
                            <div class="col-md-2"  style="">
                                @if ( $prestamo->estamento == 'Docente')
                                    <h6>Administrativo: X</h6>
                                @else 
                                    <h6>Administrativo:</h6>
                                @endif 
                                
                            </div>

                            <div class="col-md-2"  style="margin-top: 0%; background-color:#ffffff">
                                
                                @if ( $prestamo->estamento == 'Estudiante Pregrado')
                                    <h6>Estudiante: X</h6>
                                @else 
                                    <h6>Estudiante:</h6>
                                @endif
                            
                                
                            </div>
                        
                   
                        
                        
                        </div>



                        <div class="row" style="border-left: 1px black solid; border-right: 1px black solid;">
                            <div class="col-md-4"  style="margin-top: 0%; background-color:#ffffff">
                                
                                
                                <h6 style="border-bottom: 1px solid black;">Nombre: {{ $prestamo->usuario }}</h6>
                                
                            </div>
                        
                            <div class="col-md-4"  style="background-color:#ffffff">
                                <h6 style="border-bottom: 1px solid black;">D.I.: {{ $prestamo->user_id }}</h6>
                                
                            </div>

                            <div class="col-md-4"  style="background-color:#ffffff">
                                <h6 style="border-bottom: 1px solid black;">Código: {{ $prestamo->codigo }}</h6>
                                
                            </div>

                        
                        </div>


                        <div class="row" style="border-left: 1px black solid; border-right: 1px black solid;">
                        <div class="col-md-7"  style="margin-top: 0%; background-color:#ffffff">
                            
                            
                            <h6 style="border-bottom: 1px solid black;">Correo Electrónico: {{ $prestamo->email }}</h6>
                            
                        </div>
                        
                        <div class="col-md-5"  style="background-color:#ffffff">
                            
                            <h6 style="border-bottom: 1px solid black;">Celular: {{ $prestamo->celular }}</h6>
                        </div>
                        
                        </div>



                        <div class="row align-items-center" style="border: 1px solid black;">
                        
                        <!--td class="col-md-1">{{ $prestamo->id }}</td-->
                        
                            <div class="col-md-2"  style="text-align: center; border-right: 1px solid black;">Nota:</div>
                            <div class="col-md-10">En los casos de reposición solamente se recibirá el mismo tipo de implemento de igual o mejor calidad y el usuario que no reponga el implemento, se le bloquearán futuros préstamos. Según procedimiento Préstamos de Implementos Deportivos código U-PR-07.006.013</div>
                            
                      
                        
                        
                        </div>

                        @foreach ($mensajes as $key => $item)

                        <!--h6 style="border-bottom: 1px solid black;">Celular: {{ $item->mensajes }}</h6-->
                        
                        @endforeach


                        
                  
                    


                    <div class="container" style="background-color:white">




                    <div class="row" style="border: 0px black solid;">
                            <div class="col-md-4"  style="margin-top: 0%; background-color:#ffffff">
                                
                                
                                <h6>P-FT-07.006.005 </h6>
                                
                            </div>
                            
                            <div class="col-md-4"  style="background-color:#ffffff">
                                
                                <h6>Versión: 3.0</h6>
                            </div>

                            <div class="col-md-4"  style="background-color:#ffffff">
                                
                                <h6>Página 1 de 1</h6>
                            </div>
                        
                        </div>


                        </div>


                

                    
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!--button type="button" class="btn btn-primary">Save changes</button-->
                <a class="btn btn-warning float-end" href="{{ route('pdf',['download'=>'pdf', 'id'=>$prestamo->id]) }}">Generar PDF</a>
            </div>
            </div>
        </div>
    </div>


    <!--Mensajes-->
    <div class="panel panel-info">
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="panel-heading">
        
            <h3 class="panel title">
            <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Discusión</div>
            </h3>
        </div>

        <div class="panel-body">
            <ul class="media-list">
               

                @foreach ($mensajes as $mensaje)
                    <li class="media">
                        <img class="mr-3" src="{{ $mensaje->user->avatar_path }}" alt="Generic placeholder image">
                        <div class="media-body">
                        <h6 class="mt-0 mb-1">{{ $mensaje->mensaje }}</h6>
                        <small>{{ $mensaje->user->email }} | {{ $mensaje->created_at }}</small>
                        </div>
                        
                    </li>
                    <hr>
                @endforeach
            </ul>
            
                
        </div>

        <div class="panel-footer">
            <form action="../mensajes" method="POST">
            @csrf
                 <div class="input-group">
                    <input type="text" class="form-control" name="mensaje">
                    <input type="hidden" class="form-control" name="incidente_id" value="{{ $prestamo->id }}">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">Enviar</button>
                    </span>
                </div>
            </form>            
        </div>
        <hr>
        <br>
        
    </div>





    <!-- Modal Formato Cultura-->
    <div class="modal fade" id="modalFormatoCultura" tabindex="-1" aria-labelledby="modalFormatoCulturalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 80%; background-image: url('public/imagenes/FormatoPrestamoDevolucionDeportes.png');" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalFormatoCulturalLabel">Actividad Lúdico Cultural</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            <div class="modal-body">
              

                <div class="container" style="background-color:white; margin-left: 20px;">
                    <div class="row">
                        <div class="col-md-7"  style="margin-top: 0%;">
                        <h6 style="visibility: hidden;">{{ $prestamo->id }}</h6>
                      
                            <h6>Macroproceso: Bienestar Universitario
                            <br>Proceso: Bienestar Universitario
                            <br>Formato Solicitud de Equipos y Bienes
                            </h6>
                       
                            <!--a href="{{ route('pdfview',['download'=>'pdf', 'id'=>$prestamo->id]) }}">Generar PDF</a-->
                        
                        </div>
                        
                        <div class="col-md-5"  style="text-align: center;">
                            
                            <img src="{{ url('public/imagenes/escudoUnal_black.png') }}" width="60%">
                        </div>
                        </div>


                        <div class="row" style="margin-top: 10px; padding: 3px; border: 0px black solid;">
                        <div class="col-md-12"  style="border: solid 0px black; text-align: left; margin-top: 0%; background-color:#ffffff">
                            
                            
                            
                            <div class="row" style="">
                                <h6>NOMBRE DEL SOLICITANTE __________________________________________________________________</h6>
                            </div>
                            
                            <div class="row" style="">
                                
                                <div class="col-md-3">
                                    <h6>CÓDIGO ______________________</h6>
                                </div>

                                <div class="col-md-7">
                                    <h6>CARRERA __________________________________________________________________</h6>
                                </div>
                                
                                
                            </div>

                            <div class="row" style="">
                                <h6>No. DOCUMENTO DE IDENTIDAD: ____________________________________________________________________________</h6>
                            </div>
                            <br>
                            <div class="row" style="">
                                <div class="col-md-12"><h6>BIEN (ES) SOLICITADO (S)</h6></div>
                                <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                            
                                    @if($prestamo->descripcion == '')
                                        - N/A -
                                    @else
                                        {{ $prestamo->descripcion }}
                                    @endif
                                    
                                </div>
                                <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                                    <br> 
                                </div>
                                <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                                    
                                <br>
                                </div>
                                <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                                <br>
                                
                                </div>
                            </div>
                               <br>
                            <div class="row" style="">
                                <div class="row" style="">
                                    <h6>ACTIVIDAD EN LA CUAL SE VA A UTILIZAR: _________________________________________________________________________</h6>
                                </div>

                                <div class="row" style="">
                                    <h6>FECHA DE REALIZACIÓN DE LA ACTIVIDAD: ___________________________________________________________________________</h6>
                                </div>

                                <div class="row" style="">
                                    <div class="col-md-5">
                                        <h6>HORA DE INICIO ___________________________________</h6>
                                    </div>

                                    <div class="col-md-6">
                                        <h6>HORA DE FINALIZACIÓN ______________________________________</h6>
                                    </div>
                                    
                                </div>
                                <!--h6>Fecha: __dd__//_mm_//_aaaa_ Hora:_hh:mm_ {{ $prestamo->fecha }}</h6-->
                                
                                <div class="row" style="">
                                    <div class="col-md-12">
                                        <h7>Nombre del funcionario quien otorga el permiso para la actividad anterior de las dependencias de la Sede Palmira.</h7>
                                    </div> 
                                    
                                    <div class="col-md-12"  style="border-bottom: 1px black solid; margin-top: 0%; background-color:#ffffff">
                                    <br>
                                    
                                    </div>
                                    
                                </div>
                                 
                                <div class="row" style="margin-top: 15px;">
                                    
                                    <div class="col-md-12" style="border: solid 1px black; border-radius: 20px;">
                                        <h7>SEÑOR ESTUDIANTE: recuerde que los bienes y recursos de la universidad deberán ser autorizados para las actividades en este documento descritas y previamente autorizadas. Es su responsabilidad el cuidado, preservación, mantenimiento y devolución de los bienes entregados, en las condiciones y horarios que le sean asignados. Su abandono, deterioro o pérdida implicaran su responsabilidad personal y económica por el valor entregado. La Dirección de Bienestar analizara la viabilidad de esta solicitud, la cual, además está sujeta a disponibilidad de los equipos requeridos. El uso no autorizado de los bienes entregados, así como su abandono o daño son causal para negar un nuevo préstamo hasta cuando la Dirección de Bienestar lo considere pertinente.<br>
                                        El valor de los equipos; en caso de pérdida, será reportado al sistema de información académica (SIA) e impedirá su matrícula en el periodo siguiente hasta tanto no se haya resuelto la deuda.</h7>
                                    </div> 
                                    
                                    
                                
                                </div>


                                <div class="row" style="margin-top: 15px;">
                                    
                                    <div class="col-md-12" style="border: solid 0px black; border-radius: 20px;">
                                        <h7>FIRMA DE LA SOLICITUD POR EL ESTUDIANTE Declaro que conozco el contenido de este documento me comprometo a devolver los equipos recibidos en préstamo bajo la autorización de la dirección de Bienestar en las condiciones ya descritas.</h7>
                                    </div> 
                                    
                                    
                                
                                </div>

                                <div class="row" style="margin-top: 15px;">
                                
                                    <div class="col-md-6">
                                        <h6>NOMBRE ________________________________________________</h6>
                                    </div>

                                    <div class="col-md-6">
                                        <h6>TELÉFONO _____________________________________________</h6>
                                    </div>
                                
                                </div>

                                <div class="row" style="">
                                    <h6>CC _____________________________________________________</h6>
                                </div>



                                <div class="row" style="padding: 3px; border: solid 1px black; border-radius: 20px; text-align: center; margin-top: 15px;">
                                    
                                    <div class="col-md-12" style="">
                                        <h7>ESPACIO EXCLUSIVO PARA LA DIRECCIÓN DE BIENESTAR UNIVERSITARIO</h7>
                                    </div> 
                                    
                                    <div class="row" style="margin-top: 4px;">
                                        <div class="col-md-5"  style="text-align: right;">
                                    
                                            <h7>AUTORIZADO:</h6>

                                        </div>
                                    
                                        
                                
                                        <div class="col-md-3" style="text-align: center;">
                                            @if ( $prestamo->estamento == 'Docente')
                                                <h7>SÍ: X</h7>
                                            @else 
                                                <h7>Sí O</h7>
                                            @endif 
                                            
                                        </div>

                                        <div class="col-md-4" style="text-align: left;">
                                            
                                            @if ( $prestamo->estamento == 'Estudiante Pregrado')
                                                <h7>NO X</h7>
                                            @else 
                                                <h7>NO O</h7>
                                            @endif
                                        
                                            
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row" style="margin-top: 4px;">
                                        <div class="col-md-4"  style="text-align: right; margin-top: 0%; background-color:#ffffff">
                                            
                                            
                                            <h7 style="">FIRMA</h7>
                                            
                                        </div>
                                        

                                        <div class="col-md-5"  style="text-align: center; border-bottom: solid 1px black; margin-top: 0%; background-color:#ffffff">
                                            
                                            
                                            <h7 style="">{!! QrCode::size(25)->generate($firmaPrestamoQR); !!} {{ $prestamo->fecha }}</h7>
                                            
                                        </div>
                                
                                        
                            
                                    
                                    
                                    </div>


                                    
                                    
                                
                                </div>


                                <div class="row" style="text-align: center; margin-top: 15px;">
                                                                        
                                    
                                    <div class="col-md-4"  style="text-align: left;">
                                
                                        <h7>BIEN (ES) DEVUELTOS (S):</h6>

                                    </div>
                                
                                    
                            
                                    <div class="col-md-2" style="text-align: center;">
                                        @if ( $prestamo->estamento == 'Docente')
                                            <h7>Completos X</h7>
                                        @else 
                                            <h7>Completos O</h7>
                                        @endif 
                                        
                                    </div>

                                    <div class="col-md-2" style="text-align: left;">
                                        
                                        @if ( $prestamo->estamento == 'Estudiante Pregrado')
                                            <h7>Pendientes X</h7>
                                        @else 
                                            <h7>Pendientes O</h7>
                                        @endif
                                    
                                        
                                    </div>

                                    <div class="col-md-4" style="text-align: left;">
                                        
                                            <h7>¿Cuál? __________________________</h7>
                                    
                                        
                                    </div>
                              
                                    


                                    
                                    
                                
                                </div>

                                

                                


                                
                                
                               
                            </div>
                            
                            
                        </div>
                        
                        
                        </div>


                        




                        



                        
                        
                  
                    


                    <div class="container" style="background-color:white">




                        <div class="row" style="border: 0px black solid; margin-top: 20px;">
                            <div class="col-md-4"  style="margin-top: 0%; background-color:#ffffff">
                                
                                
                                <h6>P-FT-07.006.005 </h6>
                                
                            </div>
                            
                            <div class="col-md-4"  style="background-color:#ffffff">
                                
                                <h6>Versión: 3.0</h6>
                            </div>

                            <div class="col-md-4"  style="background-color:#ffffff">
                                
                                <h6>Página 1 de 1</h6>
                            </div>
                        
                        </div>


                    </div>


                

                    
                </div>

            </div>


            

            

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!--button type="button" class="btn btn-primary">Save changes</button-->
                <a class="btn btn-warning float-end" href="{{ route('pdf',['download'=>'pdf', 'id'=>$prestamo->id]) }}">Generar PDF</a>
            
                <!--a href="{{ route('pdf',['download'=>'pdf', 'id'=>$prestamo->id]) }}">Download PDF</a-->

            </div>
            </div>
        </div>
    </div>




</div>




        
@endsection