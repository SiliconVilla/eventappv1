@extends('layouts.app')

@section('content')

<style type="text/css">
    .w-5 {
        width: 7%;
    }

    .h-5 {
        width: 7%;
    }
    w-5 h-5
</style>


            <div class="card">
                <div class="card-header">{{ __('Lista de Eventos') }}</div>
                
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <!--table class="table">
                      <!--thead class="thead-dark">
                        <tr  style="text-align: center;">
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <!th scope="col">Imagen</th->
                          <!th scope="col">Archivo</th->
                          <th scope="col">Opciones</th>
                        </tr->
                      </thead>
                      <tbody>
                        @foreach ($eventos as $proyecto)
                        <tr>
                          <th scope="row">{{ $proyecto->id }}</th>
                          <td>{{ $proyecto->evento }}</td>
                          
                          <td>
                              
                              <a href="proyectos/{{ $proyecto->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                              <a href="proyectos/{{ $proyecto->id }}" class="btn btn-sm btn-info">Editar</a>
                              <a href="proyectos/{{ $proyecto->id }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>

                          </td>
                        </tr>

                        @endforeach
                      </tbody>

                    </table-->

                     

                     

                    
                    <div class="container" id="contenedorSlider" style=" justify-content: center;">
                        <!--div class="row">
                                <a style="padding: 10px;" href="{{ route('encuesta-ai-grupo') }}" class="btn btn-primary btn-primary"><span class="glyphicon glyphicon-check"></span> Encuesta Taller de Acompañamiento Estudiantil</a>

                        </div>  

                        <br>    

                        <div class="row">



                                <a style="padding: 10px;" href="{{ route('encuesta-ai-induc') }}" class="btn btn-primary btn-success"><span class="glyphicon glyphicon-check"></span> Encuesta Jornada de Inducción Pregrado 2022-01</a>

    
                       

                          

                        </div--> 

                        <div id="carouselExampleControls" class="carousel slide col-md-10" style="justify-content: center;" data-ride="carousel" data-interval="13000" >
 
                          <ol class="carousel-indicators" hidden="true" style="">
                          @foreach( $eventos as $photo )
                              <li data-target="#carouselExampleIndicators" data-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
                          @endforeach
                          </ol>
                        
                          <div class="carousel-inner" role="listbox">
                            @foreach( $eventos as $photo )
                              <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                  <a href="actividad_evento/{{ $photo->id }}" style=""><img class="d-block img-fluid width100" style="width: 100%;" src="{{ $photo->imagen }}" alt=""></a>
                                      <div class="carousel-caption d-none d-md-block">
                                        
                                      </div>
                              </div>
                            @endforeach
                          </div>
                          <a style="background-color; black;" class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>




                        </div>


                    </div>
                </div>
                <!--div>
                    <h2><a href="https://forms.gle/tjSm9MyvgJq38BEg9">Encuesta de Satisfacción Semana de Inducción</a></h2>
                </div-->
                <br>
               
                <br>
                <br>
                <br>


            </div>
        
@endsection
