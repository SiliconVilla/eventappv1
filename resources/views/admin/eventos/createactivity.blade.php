@extends('layouts.app')

@section('content')



<div class="container" style="margin-top: 80px; text-align: center; min-height: 400px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registrar Actividad</div>

                <div class="card-body">
                    
                @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
 
                    <form method="POST" action="{{ route('actividadStore') }}">
                        @csrf



                        <div class="form-group row"> 

                        @if (session('notification'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('notification') }}
                                </ul>
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
                            <!--label for="id_evento" class="col-md-4 col-form-label text-md-right">Actividad:</label-->

                            <div class="col-md-12">
                                <select class="form-control" name="id_evento">
                                  <option>Seleccionar Evento</option>

                                  @foreach ($eventos as $item)
                                    <option value="{{ $item->id }}" >{{ $item->evento }} </option>
                                  @endforeach    
                                </select>
                            </div>
                              
                            </div>
                        



                        <div class="form-group row">
                            <!--label for="name" class="col-md-4 col-form-label text-md-right">Actividad:</label-->

                            <div class="col-md-12">
                                <input id="actividad" type="text" class="form-control{{ $errors->has('actividad') ? ' is-invalid' : '' }}" name="actividad" value="{{ old('actividad') }}" required autofocus placeholder="Actividad:">

                                @if ($errors->has('actividad'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('actividad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <!--label for="email" class="col-md-4 col-form-label text-md-right">Descripción:</label-->

                            <div class="col-md-12">

                                <textarea id="descripcion" type="textarea" rows="5" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" value="{{ old('descripcion') }}" placeholder="Desarrollo de la actividad"></textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                        <div class="form-group row">       
                            <!--label for="id_lugar" class="col-md-4 col-form-label text-md-right">Lugar:</label-->

                            <div class="col-md-12">
                                <select class="form-control" name="id_lugar">
                                  <option>Seleccione un lugar</option>

                                  @foreach ($lugares as $item)
                                    <option value="{{ $item->id }}" >{{ $item->place }} </option>
                                  @endforeach    
                                </select>
                            </div>
                              
                        </div>

                        

<hr>

                            <div class="form-group row">
                              <label for="fecha" class="col-md-12 col-form-label text-md-center">Establecer fecha y hora</label>
                              <div class="col-md-12">
                                <input class="form-control" type="datetime-local" value="" id="fecha" name="fecha">
                              </div>
                            </div>


<hr>

                        <div class="form-group row">
                            <!--label for="name" class="col-md-4 col-form-label text-md-right">Actividad:</label-->

                            <div class="col-md-12">
                                <input id="horasc" type="text" class="form-control{{ $errors->has('horasc') ? ' is-invalid' : '' }}" name="horasc" value="{{ old('horasc') }}" autofocus placeholder="Corresponsabilidad:">

                                @if ($errors->has('horasc'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('horasc') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


<hr>


                        <div class="form-group row">
                            <!--label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label-->

                            <div class="col-md-12">

                                <select name="id_estado" class="form-control">
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                  
                                </select>


                            </div>
                        </div>


                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    Guardar Actividad
                                </button>
                            </div>
                        </div>
                    </form>

                    <br>

                    @if (auth()->check() != null)

                        @if (auth()->user()->es_admin)


                        <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Actividades</div>
                        
                        <div class="row" style="border-style: solid; border-color: yellow;">
                        
                            

                            <div class="col-md-12" style="border-style: solid; border-color: yellow;">
                                <table class="table table-responsive">
                                    <thead class="thead-dark">
                                        <tr  style="text-align: center;">
                                        <th scope="col">#</th>
                                        <th scope="col">Evento</th>
                                        <th scope="col" style="width: 250px;">Actividad</th>
                                        <!--th scope="col">Descripción</th-->
                                        <!--th scope="col">Lugar</th-->
                                        <th scope="col">Fecha</th>
                                        <!--th scope="col">Estado</th-->
                                        <th scope="col">Horas.C</th>
                                        <th scope="col">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($actividades as $actividad)
                                        <tr style="height: 58px;">
                                        <th scope="row">
                                            
                                            <a href="actividad_evento/{{ $actividad->id }}">{{ $actividad->id }}
                                        </th>
                                        <td>{{ $actividad->evento }}</td>
                                        <td><!--{{ $actividad->actividad }}-->
                                            <?php echo mb_strimwidth(" $actividad->actividad ", 1, 20, "..."); ?>
                                        </td>
                                        <!--td>{{ $actividad->descripcion }}</td-->
                                        <!--td>{{ $actividad->place }}</td-->
                                        <td>{{ $actividad->fecha }}</td>
                                        <!--td>{{ $actividad->estado }}</td-->
                                        <td><!--{{ $actividad->horasc }}-->

                                        

                                        <form action="../actividades/{{ $actividad->id }}/selectHorasC" class="btn btn-sm btn-dange">

                                        <select onchange="this.form.submit()" name="lista-horas" id="lista-horas" class="btn btn-sm btn-dange">

                                                @foreach ($nhorasc as $key => $value)
                                                    {{ $value }}
                                                    <option value="{{ $value }}" @if($value == $actividad->horasc) selected @endif >{{ $value }}</option>
                                                @endforeach
                                            
                                        </select>
                                        </form>
                                        
                                            
                                        </td>
                                        <td>
                                            @if($actividad->estado_id == 1)
                                                <a href="{{ url('actividades', $actividad->id ) }}/archivar" class="btn btn-sm btn-success">Desac.</a>
                                            @else
                                                <a href="actividades/{{ $actividad->id }}/restaurar" class="btn btn-sm btn-warning">Act.</a>
                                            @endif
                                            <a href="../actividades/{{ $actividad->id }}/{{ $actividad->fecha }}/asistencia" class="btn btn-sm btn-info">Asist.</a>
                                            <a href="{{ url('actividades', $actividad->id ) }}/eliminar" class="btn btn-sm btn-danger">Elim.</a>

                                        </td>
                                        </tr>

                                    

                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                            <div class="col-md-12">
                                {{ $actividades->links('pagination::bootstrap-5') }}
                            </div>
                            

                        </div>


                            
                        @endif
                    
                    @else
                        <script>window.location = "/bunpalmira";</script>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>





@endsection


