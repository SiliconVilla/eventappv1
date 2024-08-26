@extends('layouts.app')

@section('content')

<style type="text/css">
    .w-5 {
        width: 7%;
    }

    .h-5 {
        width: 7%;
    }
    
</style>

<br>

            <div class="card">
                <!--div class="card-header">{{ __('Lista de Eventos') }}</div-->
                
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
                    <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Eventos</div>
                    <div class="table-responsive">
                      <table class="table">
                        <thead class="thead-dark">
                          <tr  style="text-align: center;">
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <!--th scope="col">Imagen</th-->
                            <th scope="col">Categoria</th>
                            <th scope="col">Orden</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Opciones</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($eventos as $proyecto)
                          <tr>
                            <th scope="row"><a href="actividad_evento/{{ $proyecto->id }}">{{ $proyecto->id }}</th>
                            <td><!--{{ $proyecto->evento }}-->
                              <a href="eventos/{{ $proyecto->id }}" class="">{{ $proyecto->evento }}</a>
                            </td>
                            
                            <td>
                              <form action="eventos/{{ $proyecto->id }}/cambiarCategoria" class="btn btn-sm btn-dange">
                                <select onchange="this.form.submit()" name="lista-areas" id="lista-areas" class="btn btn-sm btn-dange">
                                    @foreach ($categories as $categoria)
                                        <option value="{{ $categoria->id }}" @if($categoria->id==$proyecto->area_id) selected @endif ><?php echo mb_strimwidth(" $categoria->namecategoria ", 1, 10, "..."); ?></option>
                                    @endforeach
                                </select>
                              </form>
                            </td>

                            <td>{{ $proyecto->orden }}</td>
                            
                            <td>

                              <form action="eventos/{{ $proyecto->id }}/cambiarTipo" class="btn btn-sm btn-dange">

                                <select onchange="this.form.submit()" name="lista-tipos" id="lista-tipos" class="btn btn-sm btn-dange">
                                    @foreach ($categories as $categoria)
                                        <option value="{{ $categoria->id }}" @if($categoria->id==$proyecto->tipo_evento) selected @endif >{{ $categoria->id }}</option>
                                    @endforeach
                                </select>
                              </form>

                            </td>

                            <td>

                              @if($proyecto->estado_id == 1)
                                <a href="{{ url('eventos', $proyecto->id ) }}/cambiarEstado" class="btn btn-sm btn-danger">Arc.</a>
                                <!--a href="{{ url('eventos', $proyecto->id ) }}/cambiarTipo" class="btn btn-sm btn-danger">Tipo</a-->
                                <input id="eventID" type="hidden" class="form-control " name="eventID" value="{{ $proyecto->id }}"  required readonly>

                              @else
                                <a href="{{ url('eventos', $proyecto->id ) }}/cambiarEstado" class="btn btn-sm btn-success">Rest.</a>
                              @endif
                                <a href="eventos/{{ $proyecto->id }}/asistencia" class="btn btn-sm btn-info">Asis.</a>
                                <a href="eventos/{{ $proyecto->id }}/eliminar" class="btn btn-sm btn-dark">Elim.</a>
                                

                            </td>
                          </tr>

                        

                          @endforeach
                        </tbody>

                      </table>

                      {{ $eventos->links('pagination::bootstrap-5') }}
                    </div>


                    <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Préstamos</div>

                    <div class="table-responsive">
                      <table class="table table-striped border-info" style="background-color: skyblue; height: 250px; color: black;">
                      

                    <!--table class="table"-->
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
                        @isset($prestamos )
                        @foreach ($prestamos as $prestamo)
                        <tr>
                        
                          <th scope="row"><a href="verPrestamo/{{ $prestamo->id }}">{{ $prestamo->id }}</th>
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
                            @if($prestamo->updated_at == null)

                                

                            <a href="{{ route('devolverPrestamo', $prestamo->id) }}" class="btn btn-sm btn-dark">Recibir</a>
                            @else


                            <a href="abrirPrestamo/{{ $prestamo->id }}/abrir" class="btn btn-sm btn-success">Activar</a>
                            <a href="eventos/{{ $prestamo->id }}/asistencia" class="btn btn-sm btn-info">Asistencias</a>
                            <a href="{{ route('eliminarPrestamo', $prestamo->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                            @endif
                          @else
                            @if($prestamo->updated_at == null)

                              

                                <a href="{{ route('devolverPrestamo', $prestamo->id) }}" class="btn btn-sm btn-dark">Recibir</a>
                            @else

                            
                                <a href="abrirPrestamo/{{ $prestamo->id }}/abrir" class="btn btn-sm btn-success">Activar</a>
                                <a href="eventos/{{ $prestamo->id }}/asistencia" class="btn btn-sm btn-info">Asistencias</a>
                                <a href="{{ route('eliminarPrestamo', $prestamo->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                            @endif
                          @endif
                          
                          </td>
                        </tr>

                      

                        @endforeach
                        @endif
                      </tbody>

                    </table>



                    
                    <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Incidencias</div>

                    <div class="table-responsive">
                      <table class="table table-striped border-info" style="background-color: skyblue; height: 250px; color: black;">
                      

                    <!--table class="table table-responsive"-->
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
                    </table>
                    <div class="row" style="text-align: center;"> {{ $incidentes->links('pagination::bootstrap-5') }} </div>
                    <hr>
                    @else
                     
                    @endif

                    
                    
                    


                    @if (!auth()->user()->es_cliente)

                    
                    
                    <div class="table-responsive"  style="margin-top: 30px; background-color: skyblue; height: 470px; color: black;">
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
                            <td><?php echo mb_strimwidth(" $servicio->descripcion ", 1, 20, "..."); ?></td-->
                          
  
                        </tr>

                       
                        @endforeach
                        @endif
                          
                        </tbody>

                        <caption>
                          -------
                        </caption>

                      </table>
                    </div>


                      <br>

                      <div class="table-responsive">
                      <table class="table table-striped border-info" style="background-color: skyblue; height: 250px; color: black;">
                        <thead>
                           <tr>
                            <div class="card-header">{{ __('Incidencias sin asignar') }}</div>
                            
                          </tr>
                          <tr>
                            <th scope="col">Ref.</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Importancia</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de Registro</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Opciones</th>
                          </tr>
                        </thead>
                        <tbody id="dashboard_no_asignadas" >

                          @if(isset($servicios_pendientes))
                            @foreach ($servicios_pendientes as $serviciopen)
                              
                              <tr>
                                <th scope="row"><a href="{{ route('verIncidencia', $serviciopen->id) }}" class=""><img src="public/imagenes/bell.gif" style="width: 100%;"/>      {{ $serviciopen->id }}</a></th>
                                  <td>{{ $serviciopen->category->namecategoria }}</td>
                                  <td>{{ $serviciopen->severidad }}</td>
                                  <td>{{ $serviciopen->nivel->namenivel }}</td>
                                  <td>{{ $serviciopen->created_at }}</td>
                                  <td><?php echo mb_strimwidth(" $serviciopen->descripcion ", 1, 20, "..."); ?></td>
                                  <td>
                                
                                      <a href="{{ route('incidenciaAtender', $serviciopen->id) }}" class="btn btn-sm btn-dark">Atender</a>
                                      
                                  </td>
                                
        
                              </tr>
      
                                        
                            @endforeach
                          @endif
                          
                        </tbody>

                        <caption>
                          ------
                        </caption>

                      </table>
                    </div>
                    @else
                      <!--Es cliente logueado-->
             

                      

                      <div class="card row" style="">
                        <!--img src="..." class="card-img-top" alt="..."-->
                        <div class="card-body">
                          <h5 class="card-title">Saldo Apoyo Alimentario</h5>

                          <div class="col-md-12">
                            DIAS RESERVADOS
                          </div>

                         
                          <div class="row" style="justify-content: center;">
                            @isset($reservasusuario)
                            @foreach($reservasusuario as $reservac)
                            <div class="col-md-2 btn btn-info" style="margin: 5px;">
                              <!--{{ $reservac->reserva }}-->
                              <a href="{{ route('reservaEliminar', $reservac->id) }}" style="color: brown;">{{ $reservac->reserva }}<img style="width: 10%; margin-left: 7px;" src="https://img.icons8.com/color/48/000000/delete-property.png"/></a>
                            </div>
                            
                            

                            </td>
                            
                                
                            @endforeach
                            @endif
                          </div>
                          
                          

                          <div class="table-responsive">
                            <table class="table">
                              <thead>
                                <tr>
                                    
                                  
                                
                                    
                                </tr>
                                <tr>
                                  
                                </tr>
                                <!--tr>
                                </td>

                                  
                                  
                                    
                                  
                                </tr-->
                              </thead>
                              <tbody>
                                @isset($reservasusuario)
                                @if (count($reservasusuario) < count($fechaAlimnArrDif))

                                
                                


                              


                                <tr>
                                  @php
                                      $reservasCargadas = json_decode($apoyo->reserva)
                                  @endphp

                                  
                                  




                                  <form action="{{ route('reservaUsuario') }}" method="POST">
                                    @csrf

                                    <input type="hidden" id="user_id" class="form-control" name="user_id" readonly value="{{ $apoyo->id }}">

                                    @isset($arrayalmuerzos)
                                    @foreach ($arrayalmuerzos as $almuercito)

                                      <!--{{ $loop->index }}     // start with 0
                                      {{ $loop->iteration }} // start with 1
                                      {{ $almuercito }}-->

                                      @isset(($fechasApoyoAlimentario))
                                      @if ( $loop->index < count($fechasApoyoAlimentario))


                          
                                      
                                        
                                        
                                        <td><!--a href="https://forms.gle/n3NVHvGJFGdtMkrt8" class="btn btn-success" @if ($apoyo->saldo < 3000) style="display: none;" @endif >{{ $almuercito }}--><div class="form-check">
                                        
                                          <label class="form-check-label" for="flexCheckDefault">
                                            <strong>{{ $fechasApoyoAlimentario[$loop->index] }}</strong> 
                                          </label>
                                          <br>
                                          <div class="row" style="justify-content: center;">
                                            <input class="form-check-input" type="checkbox" value="{{ $fechasApoyoAlimentario[$loop->index] }}" name="fechareserva[]" id="{{ $fechasApoyoAlimentario[$loop->index] }}" onclick="myFunction('{{ $fechasApoyoAlimentario[$loop->index] }}')">
                                          </div>


                                            <p id="text" style="display:none">Ya reservado!</p>
                                          
                                        </div><!--/a--></td>
                                      @endif
                                      @endif

                                    

                                      
                                    
        
                                    @endforeach
                                    @endif

                                    <input type="submit" class="btn btn-success form-control" value="Enviar Reserva">
                                  
                                  </form>

                                  <?php/* for ($i=0; $i < count($fechasApoyoAlimentario); $i++) { 
                                    echo $arrayalmuerzos[$i];
                                  } */?>
                                  
                                  
                                </tr>

                          
                                @endif
                                @endif
                               
                              </tbody>
                            </table>
                          </div>
                          

                          <br>
                            
                          
                          @isset($apoyo) 
                          <p class="card-text"><strong><?php
                            echo "SALDO: $ ".number_format($apoyo->saldo, 2);
                          ?></strong> Disponible para {{ $entero1 }} almuerzos<p>
                            <a href="https://www.e-collect.com/customers/Plus/UnalPalmiraPagosPlus.htm" class="btn-warning form-control" target="_blank" >Recargar Cuenta</a>
                             
                          
                          <hr>
                            <div class="col-md-12" style="text-align: center;">SALDOS</div>
                              <div class="col-md-12" style="border-style: none; border-color: rgb(67, 225, 125); border-radius: 5px;">
                                
                                <p>
                                <form action="{{ route('saldoUsuario') }}" method="POST">
                                    @csrf
                                  <div class="row">
                                    <input type="hidden" name="user_id" value="{{ $apoyo->id }}">
                                    <div class="col">
                                      <input type="number" id="saldoentrada" class="form-control" name="saldoentrada" placeholder="Ingrese el nuevo valor" required>
                                    </div>
                                    <div class="col">
                                        <button type="submit" class="btn-success form-control" style="background-color: rgb(215, 43, 43);">
                                            {{ __('Guardar') }}
                                        </button>
                                    </div>
                                  </div>
                                </form>
                                <p>

                                  <p>
                                    <div class="table-responsive">
                                    <table class="table">
                                      <thead class="thead-dark">
                                        <tr>
                                          <!--th scope="col">#</th-->
                                          <th scope="col">SaldoAnterior</th>
                                          <th scope="col">Entrada</th>
                                          <th scope="col">Salida</th>
                                          <th scope="col">Saldo</th>
                                          <th scope="col">CreatedAt</th>
                                          <th scope="col">Opciones</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @isset($apoyosaldo)
                                        @foreach ($apoyosaldo as $key => $saldo)
                                        <tr>
                                          <td>{{ $saldo->saldoAnterior }}</td>
                                          <td>{{ $saldo->cantidadEntrada }}</td>
                                          <td>{{ $saldo->cantidadSalida }}</td>
                                          <td>{{ $saldo->saldo }}</td>
                                          <td>{{ $saldo->created_at }}</td>
                                          <td>
                                              <!--Data-Category permite asignar un valor para accederlo posteriormente e implementar acciones con js-->
    
                                              @if ($saldo->cantidadEntrada > 0)
                                                <div class="form-group row">
    
                                                  @if ($saldo->soportepago == 'Sin Asignar')
                                                  <div class="col-md-12">
    
                                                    <div class="col-md-12">
                                                      Soporte de Pago:
                                                    </div>
    
                                                    <form method="POST" action="{{ route('subirArchivo') }}" enctype="multipart/form-data">
                                                      @csrf
                      
                                                      <input style="display: none;" name="id_saldo" id="id_saldo" readonly class="form-control" type="text" value="{{ $saldo->id }}"/> 
    
                                                    <div class="col-md-12">
                                                      <input id="archivo" type="file" accept=".jpg, .jpeg, .png" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}" name="archivo" value="{{ old('archivo') }}" required>  
                                                    </div>
                                                    
    
                                                    @if ($errors->has('archivo'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('archivo') }}</strong>
                                                        </span>
                                                    @endif
    
                                                    <div class="form-group row mb-0">
                                                      <div class="col-md-12 offset-md-4">
                                                          <button type="submit" class="btn btn-primary">
                                                              Cargar
                                                          </button>
                                                      </div>
                                                  </div>
                                                    </form>
                                                </div>
                                                
                                                  @endif
                                        
                                                  
    
                                                  
                                                  
                                                  @if (count($errors) > 0)
                                                      <div class="alert alert-danger">
                                                          <ul>
                                                              @foreach ($errors->all() as $error)
                                                                  <li>{{ $error }}</li>
                                                              @endforeach
                                                          </ul>
                                                      </div>
                                                  @endif     
                                                  
                                                </div>
                                              @endif
    
                                              
    
    
                                              <div class="form-group row">
    
                                                <div class="col-md-4">
                                                  @if((str_contains($saldo->soportepago, 'CargadoCliente')))
    
                                                  <button class="btn btn-success" >Verificando...</button>
                                                  @elseif(($saldo->soportepago == 'APROBADO' && $saldo->cantidadSalida == 0))
                                                  <img src="https://siliconvilla.io/bunpalmira/public/imagenes/icons8-approve.gif"/>
                                                  <!--button class="btn btn-sm btn-info" >Aprobado</button-->
                                                  @elseif(($saldo->soportepago == 'APROBADO' && $saldo->cantidadSalida > 0))
                                                  <img src="https://siliconvilla.io/bunpalmira/public/imagenes/icons8-just-eat-48.png"/>
                                                  <!--button class="btn btn-sm btn-info" >Aprobado</button-->
                                                  
                                                  @endif
                                                </div>
    
                                                @if (auth()->user()->es_admin)
                                                  <div class="col-md-4">
                                                    <button type="buttton" class="" tittle="Editar" data-category="{{ $saldo->id }}"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v4.png"/></button>
                                                
                                                  </div>
                                                
                                                  <div class="col-md-4">
                                                    <!--Otra forma de llamar una ruta, uzando su nombre, y pasando un parámetro-->
                                                    <a href="{{ route('reservaEliminar', $saldo->id) }}" class=""><img src="https://img.icons8.com/color/48/000000/delete-property.png"/></a>
                                                  </div>
                                                @endif
    
                                                
    
                                              </div>
                                          </td>
                                        </tr>
                                        @endforeach
                                        @endif
    
                                        
                                      </tbody>
                                    </table>
                                    </div>
                                    
                              </div>
                                


                                {{ $apoyosaldo ->links('pagination::bootstrap-5') }}

                                

                            <!--div class="row">


                              <div class="card">
                                <div class="card-header">{{ __('Recargar Cuenta') }}</div>
                
                                <div class="card-body">
                                    <!--form method="POST" action="{{ route('register') }}">
                                        @csrf->


                  
                
                                        <div class="row mb-3">
                                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('first_name') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>
                
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="row mb-3">
                                            <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('last_name') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">
                
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        
                                        
                                        
                                       <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-form-label text-md-right">email</label>
                
                                            <div class="col-md-6">
                                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email") }}" required autocomplete="email">
                                            </div>
                                        </div>
                
                
                
                                        <div class="row mb-3">
                                            <label for="document_number" class="col-md-4 col-form-label text-md-right">{{ __('document_number') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="document_number" type="number" class="form-control @error('document_number') is-invalid @enderror" name="document_number" required autocomplete="new-document_number">
                
                                                @error('document_number')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                
                                        <div class="row mb-3">
                                            <label for="document_type" class="col-md-4 col-form-label text-md-right">{{ __('document_type') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="document_type" type="number" class="form-control" name="document_type" required autocomplete="new-document_type">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="cellphone" class="col-md-4 col-form-label text-md-right">{{ __('cellphone') }}</label>
                
                                            <div class="col-md-6">
                                                <input id="cellphone" type="number" class="form-control" name="cellphone" required autocomplete="new-cellphone">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                          <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('description') }}</label>
              
                                          <div class="col-md-6">
                                              <input id="description" type="text" class="form-control" name="description" required autocomplete="new-description">
                                          </div>
                                        </div>


                                        <div class="row mb-3">
                                          <label for="total_value" class="col-md-4 col-form-label text-md-right">{{ __('total_value') }}</label>
              
                                          <div class="col-md-6">
                                              <input id="total_value" type="number" class="form-control" name="total_value" required autocomplete="new-total_value">
                                          </div>
                                        </div>


                
                                        <!--div class="row mb-0">
                                            <div class="col-md-6 offset-md-4">
                                                <button type="submit" class="btn btn-primary">
                                                    {{ __('Register') }}
                                                </button>
                                            </div>
                                        </div-->
                                    <!--/form->
                                </div-->
                            </div>


                            <!--div class="row">

                              <!--button class="btn btn-success" onclick="addPago()">ADD PAGO</button->
                              

                              @if(isset($ordencliente))                                       

                                @if($ordencliente->estado == 'Abierta')
                                    
                                @endif
                              @else 
                                  <button id="btnregordencli" name="btnregordencli" class="btn btn-warning" onclick="addOrdenCargaSaldo()">Registrar Orden de Cliente</button>
                              @endif 

                                
                            </div-->

                            <div class="row">
                                

                              <div class="col-md-12">
                                  
                                  

                                  
                                  
                              </div>
                              
                            </div>

                        


                         
                          @endif
                        
                        

                        </div>
                      </div>

                    @endif
                        <br>

                    <!--div class="table-responsive">
                      <table class="table table-striped border-info" style="background-color: skyblue; height: 250px; color: black;">
                        <thead>
                          <tr>
                            <div class="card-header">{{ __('Incidencias Creadas Por Mi') }}</div>
                            
                          </tr>
                          <tr>
                            <th scope="col">Ref.</th>
                            <th scope="col">Categoria</th>
                            <th scope="col">Importancia</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha de Registro</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Responsable</th>
                          </tr>
                        </thead>
                        <tbody id="dashboard_asignadas_socios" >

                          @foreach ($servicios_solicitados as $serviciosoli)
                            
                            <tr>
                              <th scope="row"><!--a href="{{ route('verIncidencia', $serviciosoli->id) }}" class=""><img src="public/imagenes/phonelink-ring.gif" style="width: 100%;"/>      {{ $serviciosoli->id }}</a->
                              
                              @if($serviciosoli->level_id == 2 || $serviciosoli->level_id == 3)
                                <a href="{{ route('verIncidencia', $serviciosoli->id) }}" class="">
                                  <img src="public/imagenes/icons8-ball-point-pen.gif" style="width: 60%;"/><br>{{ $serviciosoli->id }}
                                </a>
                              @elseif($serviciosoli->level_id == 1)
                                    <!--a href="incidencia/{{ $serviciosoli->id }}/restaurar" class="btn btn-sm btn-success">Activar</a->
                                <a href="{{ route('verIncidencia', $serviciosoli->id) }}" class="">
                                  <img src="public/imagenes/circles-menu-1.gif" style="width: 60%;"/><br>{{ $serviciosoli->id }}
                                </a>
                              @endif
                                    
          

                              </th>
                                
                              
                              
                              <td>{{ $serviciosoli->category->namecategoria }}</td>
                                <td>{{ $serviciosoli->severidad }}</td>
                                <td>{{ $serviciosoli->nivel->namenivel }}</td>
                                <td>{{ $serviciosoli->created_at }}</td>
                                <td><?php echo mb_strimwidth(" $serviciosoli->descripcion ", 1, 20, "..."); ?>
                               
                                </td>
                                <td>{{ $serviciosoli->nombre_soporte}}</td>
                              
      
                            </tr>
    
                                      
                            @endforeach
                          
                        </tbody>

                        <caption>
                          -----
                        </caption>

                      </table-->

                    </div>
                </div> 



            </div>

            
  
  
                
        
@endsection

@section('scripts')
    <script language="javascript">



      function myFunction($idcheck) {  
        var user_id = document.getElementById('user_id').value;
        
        $.ajax({
            url:"buscarDiaReserva",
            type:"GET",
            data:{'diareserva':$idcheck, 'usuario':user_id},
            success:function(response){ 
                
                if(response.reserva){
                  alert(response.reserva+">> Ya Reservado!",);
                  document.getElementById($idcheck).checked = false;
                  document.getElementById($idcheck).style.display = "none";
                }
                
            }
        });
        
        var checkBox = document.getElementById($idcheck);
        var text = document.getElementById("text");
        if (checkBox.checked == true){
          document.getElementById('text').innerHTML = checkBox.value;


          var checkedValue = null; 
          var inputElements = document.getElementsByClassName('form-check-input');
          for(var i=0; inputElements[i]; ++i){
                if(inputElements[i].checked){
                    checkedValue = inputElements[i].value;
                    break;
                }
          }

          text.style.display = "block";
        } else {
          text.style.display = "none";
        }
      }  



      function addPago() {

        let currentdate = new Date(); 

        let sumafecha = currentdate.getDate() + (currentdate.getMonth()+1) + currentdate.getFullYear() +    currentdate.getHours() + currentdate.getMinutes() + currentdate.getSeconds()+258455;


        // let currentdate = new Date(); 

        //let sumafecha = currentdate.getDate() + (currentdate.getMonth()+1) + currentdate.getFullYear() +    currentdate.getHours() + currentdate.getMinutes() + currentdate.getSeconds();

        //alert(sumafecha);

          $.ajax({
              type: 'post',
              data: {

            
                
                
                  first_name: "sumafecha",
                  last_name: "docCliente",
                  email: "nitCliente@correo.com",
                  document_number: 122412553,
                  document_type: 1,
                  cellphone: 312523552,
                  description: "emailCli",
                  total_value: 15200,
                  private_api_key: "NUvsEiTsa0PBk25Y8x0DGLexlcITO7Lc",
                  _token: "{{ csrf_token() }}"
              },
              url: "https://staging.wenjoy.com.co/api/1.0/pc/create-purchase-key",
              success: function(response) {
                  
                  alert(response.payment_url);
                  location.replace(response.payment_url)
                  
                  /*if (response.message.toString() === 'Nueva Orden de Cliente Registrada!') {
                      //$('#pedidonumero').val(pedidonumeroOrden);

                    // document.getElementById('ordencotiza').style.visibility = "visible";
                      
                      alert(response.message);   
                  } else {
                      alert(response.message);
                  }*/
                  
              }
              
          });


      }

      //Registrar nueva ordenCliente
      function addOrdenCargaSaldo() {


        var first_name = $('#first_name').val();
        var last_name = $('#last_name').val();
        var email = $('#email').val();
        var document_number = $('#document_number').val();
        var document_type = $('#document_type').val();
        var cellphone = $('#cellphone').val();
        var description = $('#description').val();
        var total_value = $('#total_value').val();

        if(first_name.length < 3 || last_name.length < 3 || email.length < 3 || document_number.length < 3 || document_type.length < 1 || total_value == '0'){
            alert("Por favor ingrese todos los campos requeridos");
        } else {

            $.ajax({
                type: 'post',
                data: {
                    first_name: first_name,
                    last_name: last_name,
                    email: email,
                    document_number: document_number,
                    document_type: document_type,
                    cellphone: cellphone,
                    description: description,
                    total_value: total_value,
                    private_api_key: "NUvsEiTsa0PBk25Y8x0DGLexlcITO7Lc",
                    _token: "{{ csrf_token() }}"
                },

                url: "https://staging.wenjoy.com.co/api/1.0/pc/create-purchase-key",
                success: function(response) {
                    
                    //alert(response.message);

                    alert(response.payment_url);
                    location.replace(response.payment_url)
                    
                    
                    
                }
                
            });

        }


      }

    </script> 

  @endsection


