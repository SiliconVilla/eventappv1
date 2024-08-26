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
        
@endsection
