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

<br>

            <div class="card">
                
                <div class="card-body">

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

                    @if (auth()->user()->es_admin)
                    <!--div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Eventos</div>
                    <table class="table">
                      <thead class="thead-dark">
                        <tr  style="text-align: center;">
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <!-th scope="col">Imagen</th->
                          <!-th scope="col">Archivo</th->
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($prestamos as $proyecto)
                        <tr>
                          <th scope="row"><a href="actividad_evento/{{ $proyecto->id }}">{{ $proyecto->id }}</th>
                          <td>{{ $proyecto->evento }}</td>
                          
                          <td>
                              
                              <a href="proyectos/{{ $proyecto->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                              <a href="eventos/{{ $proyecto->id }}/asistencia" class="btn btn-sm btn-info">Asistencias</a>
                              <a href="proyectos/{{ $proyecto->id }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>

                          </td>
                        </tr>

                      

                        @endforeach
                      </tbody>

                    </table-->



                    <!--div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Préstamos</div>
                    <table class="table">
                      <thead class="thead-dark">
                        <tr  style="text-align: center;">
                          <th scope="col">#</th>
                          <th scope="col">Elemento</th>
                          <th scope="col">Área</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Usuario</th>
                          <th scope="col">Servidor</th>
                          <th scope="col">Préstamo</th>
                          <th scope="col">Devolución</th>

                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($prestamos as $prestamo)
                        <tr>
                        
                          <th scope="row"><a href="verPrestamo/{{ $prestamo->id }}">{{ $prestamo->id }}</th>
                          <td>{{ $prestamo->elemento }}</td>
                          <!-td>{{ $prestamo->tipo }}</td->
                          <td>{{ $prestamo->categoria }}</td>
                          <td>{{ $prestamo->descripcion }}</td>
                          <td>{{ $prestamo->usuario }}</td>
                          <td>{{ $prestamo->servidor }}</td>
                          <td>{{ $prestamo->fecha }}</td>
                          <td>{{ $prestamo->updated_at }}</td>
                          
                          <td>

                          @if($prestamo->updated_at == null)

                              <a href="{{ route('devolverPrestamo', $prestamo->id) }}" class="btn btn-sm btn-dark">Recibir</a>
                          @else

                          
                              <a href="proyectos/{{ $prestamo->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                              <a href="eventos/{{ $prestamo->id }}/asistencia" class="btn btn-sm btn-info">Asistencias</a>
                              <a href="{{ route('eliminarPrestamo', $prestamo->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                          @endif
                          </td>
                        </tr>

                      

                        @endforeach
                      </tbody>

                    </table-->



                    
                    <!--div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Incidencias</div>
                    <table class="table table-responsive">
                    <thead class="thead-dark">
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Responsable</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Opciones</th>
                      </tr>
                      <hr>
                    </thead>
                    <tbody>
                    

                    

                    @if(isset($incidentes))
                    
                      @foreach ($incidentes as $incidente)
                      <tr>
                        <th scope="row"><a href="{{ route('verIncidencia', $incidente->id) }}" class="">{{ $incidente->id }}</th>
                        <td>
                          @if(isset($incidente->level_id))
                            {{ $incidente->nombre_soporte }}
                          @else 
                            ""
                          @endif
                          
                        </td>
                        <td>{{ $incidente->cliente->name }}</td>
                        <td>{{ $incidente->created_at }}</td>
                        <td>{{ $incidente->nivel->namenivel }}</td>
                        <td>{{ $incidente->cliente->email }}</td>
                        <td>
                            

                            @if ($incidente->trashed())
                              <a href="incidencia/{{ $incidente->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                            @else
                              @if($incidente->level_id == 4)
                                <a href="{{ route('incidenciaAbrir', $incidente->id) }}" class="btn btn-sm btn-info">Editar</a>
                              @else 
                                <a href="{{ route('verIncidencia', $incidente->id) }}" class="btn btn-sm btn-success">Abierta</a>
                              
                              @endif
                              
                            
                            <a href="proyectos/{{ $incidente->id }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    @endif
                    
                    </tbody>
                    </table-->
                  
                    <hr>
                    @else
                     
                    @endif

                    
                    
                    


                    @if (!auth()->user()->es_cliente)

                    
                    
                    <!--div class="table-responsive"  style="margin-top: 30px; background-color: skyblue; height: 470px; color: black;">
                      <table class="table table-striped border-info">
                        <thead>
                            <tr>
                            <div class="card-header">{{ __('Incidencias asignadas a mi') }}</div>
                            
                            <!--th scope="col">Ref.</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Importancia</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de Registro</th>
                            <th scope="col">Descripción</th-->

                          </tr>
                          
                          
                          
                            
                        
                        </thead>
                        <tbody id="dashboard_mis_incidencias" style="background-color: skyblue; color: black;">


                        

                        @if(isset($mis_servicios))

                        @foreach ($mis_servicios as $servicio)


                        <tr style="background-color: skyblue; height: 250px; color: black;">
                         
                          <div class="col-md-3"  style="margin-top: 10px; float: left; background-color: skyblue; height: 250px; color: black;">
                              <div class="card text-center">
                                  <div class="card-body">

                                  @if($servicio->level_id != 4)
                                    <a href="{{ route('verIncidencia', $servicio->id) }}" class="">
                                      <img src="public/imagenes/icons8-check-circle.gif" style="width: 30%;"/>  - {{ $servicio->id }}
                                    </a>
                                  @else
                                    @if ($servicio->trashed())
                                        <a href="incidencia/{{ $servicio->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                                    @else
                                        <!--a href="incidencia/{{ $servicio->id }}" class="btn btn-sm btn-info">Editar</a-->
                                        <a href="incidencia/{{ $servicio->id }}/eliminar" class="btn btn-sm btn-danger">Archivar</a>
                                    @endif
                                    <!--a href="{{ route('verIncidencia', $servicio->id) }}" class="">
                                      <img style="width: 45%;" src="public/imagenes/icons8-check-circle.gif"/>  - {{ $servicio->id }}
                                    </a-->
                                  
                                  @endif
                                        
                                  </div>
                                  <div class="card-footer">
                                      <p hidden>Jayder</p>
                                      <p>{{ $servicio->category->namecategoria }}</p>
                                      <p>{{ $servicio->severidad }}</p>
                                      <p>{{ $servicio->nivel->namenivel }}</p>
                                      <!--p>{{ $servicio->created_at }}</p-->

                                      <p>{{ date('d-M-y', strtotime($servicio->created_at)) }}</p>

                                  </div>
                              </div>
                          </div>
          
                        
                      
                  
                          
                        
                          <!--th scope="row">
                          @if($servicio->level_id != 4)
                            <a href="{{ route('verIncidencia', $servicio->id) }}" class="">
                              <img src="public/imagenes/icons8-check-circle.gif" style="width: 60%;"/>  - {{ $servicio->id }}
                            </a>
                          @else
                            @if ($servicio->trashed())
                                <a href="incidencia/{{ $servicio->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                            @else
                                <!-a href="incidencia/{{ $servicio->id }}" class="btn btn-sm btn-info">Editar</a->
                                <a href="incidencia/{{ $servicio->id }}/eliminar" class="btn btn-sm btn-danger">Archivar</a>
                            @endif
                            <!-a href="{{ route('verIncidencia', $servicio->id) }}" class="">
                              <img style="width: 45%;" src="public/imagenes/icons8-check-circle.gif"/>  {{ $servicio->id }}
                            </a->
                          
                          @endif

                          

                          </th>
                            <td>{{ $servicio->category->namecategoria }}</td>
                            <td>{{ $servicio->severidad }}</td>
                            <td>{{ $servicio->nivel->namenivel }}</td>
                            <td>{{ $servicio->created_at }}</td>
                            <td><?php echo mb_strimwidth(" $servicio->descripcion ", 1, 20, "..."); ?></td->
                          
  
                        </tr>

                       
                        @endforeach
                        @endif
                          
                        </tbody>

                        <caption>
                          <!-Captions of the table->
                        </caption>

                      </table>
                    </div-->


                      <br>

                      <div class="table-responsive">
                      <table class="table table-striped border-info" style="background-color: skyblue; height: 250px; color: black;">
                        <thead>
                           <!--tr>
                            <div class="card-header">{{ __('Listado de Préstamos') }}</div>
                  
                          </tr-->

                          <tr>
                            @if($user->es_admin)

                            <div  style="padding: 10px;" class="card-header">{{ __('Listado de Préstamos') }}</div>
                            
                            @else
                              

                            <div style="display: flex;">
                                
                                  <form class="form-inline" id="formAreasPrestamos" name="formAreasPrestamos">

                                  <div class="card-header col-md-4">{{ __('Listado de Préstamos') }}</div>
                                    
                                  <div class="col-md-3" style="padding: 10px;">


                                  
                                    <select id="buscarpor" name="buscarpor" class="form-control">
                                    filtro
                                    @if(isset($filtro))
                                    <option value="{{ $filtro}}" style="text-align: center  ;" class="justify-content-center">{{ $filtro }}</option>
                                    <option value="" style="text-align: center  ;" class="justify-content-center">Mostrar Todos</option>
                                    @else
                                    <option value="" style="text-align: center  ;" class="justify-content-center">Filtro por Áreas</option>
                                    @endif
                                        
                                        
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->namecategoria }}">{{ $category->namecategoria }}</option>
                                        @endforeach
                                    </select>
                                  </div>

                                  <div class="col-md-3" style="padding: 10px;">
                                    <!--button class="btn btn-success form-control" type="submit">Filtrar</button-->
                                  </div>
                                        
                                        
                                  
                                    <!--input name="buscarpor" class="form-control me-2" type="search" placeholder="Flitrar" aria-label="Filtrar"-->
                                    
                                  </form>
                                
                            </div>
                            
                            @endif
                          </tr>

                          <tr  style="text-align: center;">
                          <th scope="col">#</th>
                          <th scope="col">Elemento</th>
                          <th scope="col">Área</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Usuario</th>
                          <th scope="col">Servidor</th>
                          <th scope="col">Préstamo</th>
                          <th scope="col">Devolución</th>

                          <th scope="col">Opciones</th>
                        </thead>
                        <tbody id="dashboard_no_asignadas" >

                          @foreach ($prestamos as $prestamo)

                          <tr>
                        
                            <th scope="row"><a class="btn btn-success" href="verPrestamo/{{ $prestamo->id }}">{{ $prestamo->id }}</th>
                            <td>{{ $prestamo->elemento }}</td>
                            <!--td>{{ $prestamo->tipo }}</td-->
                            <td>{{ $prestamo->categoria }}</td>
                            <td>{{ $prestamo->descripcion }}</td>
                            <td>{{ $prestamo->usuario }}</td>
                            <td>{{ $prestamo->servidor }}</td>
                            <td>{{ $prestamo->fecha }}</td>
                            <td>{{ $prestamo->updated_at }}</td>
                            
                            <td>

                            @if($prestamo->trashed())
                              @if($prestamo->updated_at != null)

                             

                              <a href="restaurarPrestamo/{{ $prestamo->id }}/restaurar" class="btn btn-sm btn-warning fa-solid fa-arrow-rotate-right"></a>
                              @else

                              <a href="{{ route('devolverPrestamo', $prestamo->id) }}" class="btn btn-sm btn-dark">Recibir</a>

                              
                              @endif
                            @else

                              @if($prestamo->updated_at == null)

                                  <a href="{{ route('devolverPrestamo', $prestamo->id) }}" class="btn btn-sm btn-dark">Recibir</a>
                              @else
                              
                                  <a href="abrirPrestamo/{{ $prestamo->id }}/abrir" class="btn btn-sm btn-warning fa-solid fa-arrow-rotate-right"></a>
                                  
                                  <a href="{{ route('eliminarPrestamo', $prestamo->id) }}" class="btn btn-sm btn-danger fa-solid fa-folder-minus"></a>
                              @endif
                            @endif
                            </td>
                          </tr>
                            
                            
    
                                      
                            @endforeach
                          
                        </tbody>

                        <caption>
                          Captions of the table
                        </caption>

                      </table>
                    </div>
                    @endif
                        <br>

                    
                </div>



            </div>

  
    
            
        
@endsection
