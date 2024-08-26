@extends('layouts.app')

@section('content')

<br>

<div class="row">


            <div class="col-md-8" style="background-color: white;">
                <div class="row">
                    <div class="" style="width: 60%;">
                    <a href="../home"><img style="width: 15%;" src="../public/imagenes/icons8-back-arrow.gif"/></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ __('Detalle de Incidencia No. --->') }}
                    </div>
                    <div class="" style="width: 40%;">
                        <input id="id" class="btn btn-danger"  type="text" readonly name="id" value="{{ $servicio->id }}">
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
                                <th>Cógido</th>
                                <th>Importancia</th>
                                <th>Proyecto</th>
                                <th>Opciones</th>
                                
                                
                                
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $servicio->id }}</td>
                                <td>{{ $servicio->severidad }}</td>
                                <td>{{ $servicio->project->name }}</td>
                               
                                <td> 
                                   
                                    @if(($servicio['level_id']) == 4)
                                    <a href="{{ route('incidenciaAbrir', $servicio->id) }}"><img style="width: 45%;" src="../public/imagenes/icons8-load-from-cloud.gif"/><br> Abrir</a>

                                    @else
                                    

                                        
                                
                                    @endif
                                </td>

                                

                                
                            </tr>
                        </tbody>

                        <thead>
                            <tr>
                                <th>Responsable</th>
                                <th>Creación</th>
                                <th>Actualización</th>
                                <th>Estado</th>  
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $servicio->nombre_soporte }}</td>
                                <td>{{ $servicio->created_at }}</td>
                                <td>{{ $servicio->update_at }}</td>
                                <td>{{ $servicio->nivel->namenivel }}</td>
                                
                            </tr>
                        </tbody>

                        </table>


                        <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th>Área</th>
                                <td>{{ $servicio->category->namecategoria }}</td>
                            </tr>

                            <tr>
                                <th>Tipo</th>
                                <td>{{ $servicio->tipo->name }}</td>
                            </tr>

                            </tr>
                                <th>Descripción</th>
                                <td>{{ $servicio->descripcion }}</td>
                            </tr>

                            </tr>
                                <th>cliente</th>  
                                <td>{{ $servicio->cliente->name }}</td>
                            </tr>

                      

                            </tr>
                                <th>Adjuntos</th>  
                                <td>"Servicio en creación..."</td>
                            </tr>

                        </tbody>
                        
                        </table>

                     


                     </div>

                    
                </div>
                

            </div>

            <div class="col-md-4">
             @include('includes.menuverincidencia')
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
                        <h6 style="visibility: hidden;">{{ $servicio->id }}</h6>
                      
                            <h6>Bienestar Universitario
                            <br>Actividad Física y Deportiva
                            <br>Formato Préstamo y Devolución de Implementos Deportivos
                            </h6>
                       
                            <!--a href="{{ route('pdfview',['download'=>'pdf', 'id'=>$servicio->id]) }}">Generar PDF</a-->
                        
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
                                <h6>Fecha: __dd__//_mm_//_aaaa_ Hora:_hh:mm_</h6>
                            </div>
                            <div class="row" style="">
                                <h6>Nombre de Quién Presta:______________________</h6>
                            </div>
                            
                        </div>
                        
                        <div class="col-md-6"  style="border: solid 1px black; text-align: center; margin-top: 0%; background-color:#ffffff">
                            
                            
                            
                            <div class="row" style="">
                                <h6>PRÉSTAMO</h6>
                            </div>
                            <div class="row" style="">
                                <h6>Fecha: __dd__//_mm_//_aaaa_ Hora:_hh:mm_</h6>
                            </div>
                            <div class="row" style="">
                                <h6>Nombre de Quién Recibe:______________________</h6>
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
                            
                            {{ $servicio->descripcion }}
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
                            
                            
                            <h6 style="border-bottom: 1px solid black;">Firma: {{ $servicio->cliente_id }}</h6>
                            
                        </div>
                        
                 
                        <div class="col-md-2"  style="margin-top: 0%; text-align: right; background-color:#ffffff">
                            
                            
                            <h6>Estamento:</h6>
                            
                        </div>
                        
                        <div class="col-md-1"  style="">
                            <h6>Docente:</h6>
                            
                        </div>
                        <div class="col-md-1"  style="">
                            
                            
                        </div>

                        <div class="col-md-1"  style="margin-top: 0%; background-color:#ffffff">
                            
                            
                            <h6>Administrativo:</h6>
                            
                        </div>
                        <div class="col-md-1"  style="">
                            
                            
                        </div>
                        
                        <div class="col-md-1"  style="">
                            
                         <h6>Estudiante:</h6>
                        </div>
                        <div class="col-md-1"  style="">
                            
                            O
                        </div>

                   
                        
                        
                        </div>



                        <div class="row" style="border-left: 1px black solid; border-right: 1px black solid;">
                            <div class="col-md-4"  style="margin-top: 0%; background-color:#ffffff">
                                
                                
                                <h6 style="border-bottom: 1px solid black;">Nombre: {{ $servicio->cliente_id }}</h6>
                                
                            </div>
                        
                            <div class="col-md-4"  style="background-color:#ffffff">
                                <h6 style="border-bottom: 1px solid black;">D.I.: {{ $servicio->cliente_id }}</h6>
                                
                            </div>

                            <div class="col-md-4"  style="background-color:#ffffff">
                                <h6 style="border-bottom: 1px solid black;">Código: {{ $servicio->cliente_id }}</h6>
                                
                            </div>

                        
                        </div>


                        <div class="row" style="border-left: 1px black solid; border-right: 1px black solid;">
                        <div class="col-md-7"  style="margin-top: 0%; background-color:#ffffff">
                            
                            
                            <h6 style="border-bottom: 1px solid black;">Correo Electrónico: {{ $servicio->cliente_id }}</h6>
                            
                        </div>
                        
                        <div class="col-md-5"  style="background-color:#ffffff">
                            
                            <h6 style="border-bottom: 1px solid black;">Celular: {{ $servicio->cliente_id }}</h6>
                        </div>
                        
                        </div>



                        <div class="row align-items-center" style="border: 1px solid black;">
                        
                        <!--td class="col-md-1">{{ $servicio->id }}</td-->
                        
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
                <button type="button" class="btn btn-primary">Save changes</button>
                <a class="btn btn-warning float-end" href="{{ url('asistencias-export')}}">Exportar datos a Excel</a>
            </div>
            </div>
        </div>
    </div>

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
                    <input type="hidden" class="form-control" name="incidente_id" value="{{ $servicio->id }}">
                    <span class="input-group-btn">
                        <button class="btn btn-info" type="submit">Enviar</button>
                    </span>
                </div>
            </form>            
        </div>
        <hr>
        <br>
        
    </div>
</div>




        
@endsection


