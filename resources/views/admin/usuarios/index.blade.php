@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Registrar Nuevo Usuario') }}</div>
                

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
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                                <label for="documento" class="col-md-4 col-form-label text-md-right">{{ __('Document') }}</label>

                                <div class="col-md-6">
                                    <input id="documento" type="number" class="form-control @error('documento') is-invalid @enderror" name="documento" value="{{ old('documento') }}" required autocomplete="documento" autofocus>

                                    @error('documento')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Rol') }}</label>

                                <div class="col-md-6">

                                    <select name="role" class="form-control @error('role') is-invalid @enderror">
                                        <option value="0">Administrador</option>
                                        <option value="1">Soporte</option>
                                        <option value="2">Usuario</option>
                                        <option value="3">Acompañamiento</option>
                                        <option value="4">Cultura</option>
                                        <option value="5">Deportes</option>
                                        <option value="6">Dirección</option>
                                        <option value="7">Gestión</option>
                                        <option value="8">Salud</option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', str_random(10)) }}" required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                           

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="form-control btn btn-primary" style="background-color: blue;">
                                        {{ __('Registrar Usuario') }}
                                    </button>
                                </div>
                            </div>

                            
                        </form>
                     </div>

                     <br>
                     <br>
                     <div class="table-responsive">

                     
                     <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#ID</th>
                          <th scope="col">Nombre</th>
                          <th scope="col">Email</th>
                          <th scope="col">Rol</th>
                          <th scope="col">Estado</th>
                          <th scope="col">Corresp.</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($usuarios as $usuario)
                        <tr>
                          <th scope="row">{{ $usuario->id }}</th>
                          <td>{{ $usuario->name }}</td>
                          <td>{{ $usuario->email }}</td>
                          <td>
                            @if ($usuario->role == '1')
                                <?=str_replace( $usuario->role , ' ', 'Soporte')?>
                            @elseif ($usuario->role == '2')
                                <?=str_replace( $usuario->role , ' ', 'Usuario')?>
                            @elseif ($usuario->role == '3')
                                <?=str_replace( $usuario->role , ' ', 'Acompañamiento')?>
                            @elseif ($usuario->role == '4')
                                <?=str_replace( $usuario->role , ' ', 'Cultura')?>
                            @elseif ($usuario->role == '5')
                                <?=str_replace( $usuario->role , ' ', 'Deportes')?>
                            @elseif ($usuario->role == '6')
                                <?=str_replace( $usuario->role , ' ', 'Dirección')?>
                            @elseif ($usuario->role == '7')
                                <?=str_replace( $usuario->role , ' ', 'Gestión')?>
                            @elseif ($usuario->role == '8')
                                <?=str_replace( $usuario->role , ' ', 'Salud')?>
                            @elseif ($usuario->role == '9')
                                <?=str_replace( $usuario->role , ' ', 'Comercial Inv.')?>
                            @elseif ($usuario->role == '10')
                                <?=str_replace( $usuario->role , ' ', 'Dir.Admin Inv.')?>
                            @elseif ($usuario->role == '0')
                                <?=str_replace( $usuario->role , ' ', 'Admin')?>
                            @else
                                <?=str_replace( $usuario->role , ' ', 'NO ENCONTRADO')?>
                            @endif
                          </td>

                          <td><!---{{ $usuario->idestado }}-->
                            @if($usuario->idestado == '' || $usuario->idestado == '2')
                                <a href="{{ url('usuario', $usuario->id ) }}/estado/1" class="btn btn-sm btn-info">Activar</a>
                            @else
                                <a href="{{ url('usuario', $usuario->id ) }}/estado/2" class="btn btn-sm btn-danger">Desac.</a>
                            @endif
                          </td>
                          
                          <td><!--{{ $usuario->corresponsabilidad }}-->
                            @if($usuario->corresponsabilidad == '' || $usuario->corresponsabilidad == 'NO')
                                <a href="{{ url('usuario', $usuario->id ) }}/corresp/si" class="btn btn-sm btn-success">Activar</a>
                            @else
                                <a href="{{ url('usuario', $usuario->id ) }}/corresp/no" class="btn btn-sm btn-warning">Desac.</a>
                            @endif
                                

                          </td>
                          <td>
                            <a href="usuarios/{{ $usuario->id }}" class=""><img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v4.png"/></a>
                            <a href="usuarios/{{ $usuario->id }}/eliminar" class=""><img src="https://img.icons8.com/color/48/000000/delete-property.png"/></a>
                            <a href="{{ url('deleteDevice', $usuario->devid ) }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                                       
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>

                </div>
                <div class="row">
                    {{ $usuarios->links('pagination::bootstrap-5') }}
                </div>
                </div>
            </div>
        
@endsection
