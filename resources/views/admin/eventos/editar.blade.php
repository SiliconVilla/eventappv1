@extends('layouts.app')

@section('content')

<div class="container" style="margin-top: 80px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registrar Evento</div>

                <div class="card-body">


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="" enctype="multipart/form-data">
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
                            <label for="evento" class="col-md-4 col-form-label text-md-right">Evento:</label>

                            <div class="col-md-6">
                                <input id="evento" type="text" class="form-control{{ $errors->has('evento') ? ' is-invalid' : '' }}" name="evento" value="{{ old('evento', $evento->evento) }}" required autofocus placeholder="Evento:">

                                @if ($errors->has('evento'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('evento') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ruta" class="col-md-4 col-form-label text-md-right">RutaAnterior:</label>

                            <div class="col-md-6">
                                <input id="ruta" type="text" class="form-control{{ $errors->has('ruta') ? ' is-invalid' : '' }}" name="ruta" value="{{ old('evento', $evento->imagen) }}" readonly>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="archivo" class="col-md-4 col-form-label text-md-right">ArchivoNuevo:</label>

                            <div class="col-md-6">
                                <input id="archivo" type="file" class="form-control" name="archivo" value="{{ old('archivo') }}">

                                
                            </div>
                        </div>








                        <div class="form-group row">
                            <label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label>

                            <div class="col-md-6">

                                <script>
                                    function myFunction() {
                                      document.getElementById("id_estado").selectedIndex = {{ $evento->estado_id }};
                                    }
                                    window.onload = myFunction;
                                </script>

                                <select name="id_estado" class="form-control">
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                  
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
        
@endsection
