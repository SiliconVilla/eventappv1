@extends('layouts.app')

@section('content')



<!--div class="container" style="margin-top: 80px; text-align: center; min-height: 400px;">
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
 
                    <form method="POST" action="{{ route('eventoActualizar', $actividad->id) }}">
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
                            <!--label for="id_evento" class="col-md-4 col-form-label text-md-right">Actividad:</label->

                            
                            <div class="form-group row">
                            <!--label for="name" class="col-md-4 col-form-label text-md-right">Actividad:</label->

                                <div class="col-md-12">
                                    <input id="activity_id" type="text" class="form-control{{ $errors->has('activity_id') ? ' is-invalid' : '' }}" name="activity_id" value="{{ old('evento', $evento->evento) }}" required autofocus placeholder="Evento:" readonly>

                                    @if ($errors->has('evento'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('evento') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                              
                            </div>
                        



                        <div class="form-group row">
                            <!--label for="name" class="col-md-4 col-form-label text-md-right">Actividad:</label->

                            <div class="col-md-12">
                                <input id="actividad" type="text" class="form-control{{ $errors->has('actividad') ? ' is-invalid' : '' }}" name="actividad" value="{{ old('actividad', $actividad->actividad) }}" required autofocus placeholder="Actividad:">

                                @if ($errors->has('actividad'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('actividad') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <!--label for="email" class="col-md-4 col-form-label text-md-right">Descripción:</label->

                            <div class="col-md-12">

                                <textarea id="descripcion" type="text" rows="5" class="form-control{{ $errors->has('descripcion') ? ' is-invalid' : '' }}" name="descripcion" placeholder="Desarrollo de la actividad">{{ old('descripcion', $actividad->descripcion) }}</textarea>

                                @if ($errors->has('descripcion'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('descripcion') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>





                            <div class="form-group row">       
                            <!--label for="id_lugar" class="col-md-4 col-form-label text-md-right">Lugar:</label->

                            <div class="col-md-12">
                                

                                <select class="form-control" name="id_lugar" id="id_lugar">
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
                                <input class="form-control" type="datetime-local" value="<!--?php echo date("Y-m-d\TH:i:s", strtotime($actividad->fecha)); ?>" id="fecha" name="fecha">
                              </div>
                            </div>


<hr>





                        <div class="form-group row">
                            <!--label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label->

                            <div class="col-md-12">

                                <select name="id_estado" id="id_estado" class="form-control">
                                  <option>Seleccione un lugar</option>
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
                        
                        @endif
                    
                    @else
                        <script>window.location = "/bunpalmira";</script>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function myFunction() {
        document.getElementById("id_lugar").selectedIndex = {{ $lugar->id }};
        document.getElementById("id_estado").selectedIndex = {{ $actividad->estado_id }};
    }
    window.onload = myFunction;
</script>


@endsection


