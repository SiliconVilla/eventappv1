@extends('layouts.app')

@section('content')

  <div class="container" style="margin-top: 80px;">
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">Subir Imagen para Atril</div>

                  <div class="card-body">


                      @if (session('status'))
                          <div class="alert alert-success">
                              {{ session('status') }}
                          </div>
                      @endif

                      <form method="POST" action="{{ route('imgAtrilStore') }}" enctype="multipart/form-data">
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

                              <div class="form-group row">

                                  <div class="col-md-6">
                                      <input id="imagen" type="file" class="form-control{{ $errors->has('imagen') ? ' is-invalid' : '' }}" name="imagen" value="{{ old('imagen') }}" required>

                                      @if ($errors->has('imagen'))
                                          <span class="invalid-feedback">
                                              <strong>{{ $errors->first('imagen') }}</strong>
                                          </span>
                                      @endif
                                  </div>
                              </div>


                              <div class="form-group row">
                                  <!--label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label-->

                                  <div class="col-md-6">

                                      <select name="estado" class="form-control">
                                      <option value="1">Activo</option>
                                      <option value="2">Inactivo</option>
                                      
                                      </select>


                                  </div>
                              </div>


                              <div class="form-group row">
                                  <!--label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label-->

                                  <div class="col-md-6">

                                      <select name="orden" class="form-control">
                                      <option value="1">1</option>
                                      <option value="2">2</option>
                                      <option value="3">3</option>
                                      <option value="4">4</option>
                                      <option value="5">5</option>
                                      <option value="6">6</option>
                                      <option value="7">7</option>
                                      <option value="8">8</option>
                                      <option value="9">9</option>
                                      <option value="10">10</option>

                                      
                                      </select>


                                  </div>
                              </div>

                          <div class="form-group row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      Guardar...
                                  </button>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

    <br>
    <div class="card-header">{{ __('Imágenes en Atril') }}</div>
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


    <div class="row">
    @foreach ($imgsatril as $item)

      <!-- Modal -->
      <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

              <img src="{{ $item->imagen }}" style="width: 300px; height: 507px; object-fit: cover;">
              
            </div>
            <div class="modal-footer">
              <button type="button" class="form-control btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!--button type="button" class="btn btn-primary">Save changes</button-->
            </div>
          </div>
        </div>
      </div>

        
        <div class="col-md-4">
            <!--a href="{{ url('actividad_evento') }}/{{$item->id}}"-->

            <div class="card" style="width: 100%;">
              <img src="{{ $item->imagen }}" class="card-img-top" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal{{$item->id}}">
              <!--div class="card-header">ID => {{ $item->id }}</div-->
              <div class="card-body">
                <!--h5 class="card-title">ESTADO => {{ $item->estado }}</h5-->
                <p class="card-text">

                    <select name="lista_de_orden_img{{ $item->id }}" id="lista_de_orden_img{{ $item->id }}" data-img="{{ $item->id }}" class="form-control">
                        @foreach ($listorden as $key)
                            <option value="{{ $key }}" @if( $key == $item->orden) selected @endif >{{ $key }}</option>
                        @endforeach
                    </select>

                    @if($item->estado == 1)
                        <a href="{{ url('imgatril', $item->id ) }}/cambiarEstado" class="btn btn-sm btn-danger">Desactivar</a>
                        
                        <input id="eventID" type="hidden" class="form-control " name="eventID" value="{{ $item->id }}"  required readonly>

                    @else
                        <a href="{{ url('imgatril', $item->id ) }}/cambiarEstado" class="btn btn-sm btn-success">Activar</a>
                    @endif
                        <a href="eventos/{{ $item->id }}/eliminar" class="btn btn-sm btn-dark">Elim.</a>

                    

                </p>
              </div>
            </div>

                <!--div class="card">
                    <div class="card-header">{{ $item->id }}</div>
                    <div class="card-body">
                        <!-{{ $item->imagen }}->
                        <img style="width: 100%;" src="{{ $item->imagen }}" alt="" />
                    </div>
                    <div class="row">{{ $item->estado }}</div>
                    <div class="row">{{ $item->orden }}</div>
                    <div class="card-header">{{ $item->id }}</div>
                </div-->
                <br>
        </div>        
        
    @endforeach 
    </div>

          
        
@endsection
