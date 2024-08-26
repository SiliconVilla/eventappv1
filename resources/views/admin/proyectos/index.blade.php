@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Nuevo Proyecto') }}</div>
                

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                     
                     <div class="panel-body">
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
                        <form action="" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                                <div class="col-md-6">
                                    <input id="descripcion" type="text" class="form-control @error('descripcion') is-invalid @enderror" name="descripcion" value="{{ old('descripcion') }}" required autocomplete="descripcion">

                                    @error('descripcion')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                                <div class="col-md-6">
                                    <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date', date('Y-m-d')) }}" required>

                                    @error('date')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                           

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="form-control btn btn-primary" style="background-color: blue;">
                                        {{ __('Registrar Proyecto') }}
                                    </button>
                                </div>
                            </div>

                            
                        </form>
                     </div>

                     <br>
                     <br>

                     <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Descripción</th>
                          <th scope="col">Fecha</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($proyectos as $proyecto)
                        <tr>
                          <th scope="row">{{ $proyecto->id }}</th>
                          <td>{{ $proyecto->name }}</td>
                          <td>{{ $proyecto->descripcion }}</td>
                          <td>{{ $proyecto->date }}</td>
                          <td>
                              

                              @if ($proyecto->trashed())
                              <a href="proyectos/{{ $proyecto->id }}/restaurar" class="btn btn-sm btn-success">Activar</a>
                              @else
                              <a href="proyectos/{{ $proyecto->id }}" class="btn btn-sm btn-info">Editar</a>
                              <a href="proyectos/{{ $proyecto->id }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                              @endif
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                    
                </div>
            </div>
        
@endsection
