@extends('layouts.app')

@section('content')
            <div class="card">
                <div class="card-header">{{ __('Editar Usuario') }}</div>

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

                        <!--@if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif-->
                        <form action="" method="POST">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control " name="name" value="{{ old('name', $usuario->name) }}"  autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control " name="email" readonly value="{{ old('email', $usuario->email) }}"  autocomplete="email">

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
                                    <script>
                                    function myFunction() {
                                      document.getElementById("role").selectedIndex = {{ $usuario->role }};
                                    }
                                    window.onload = myFunction;
                                    </script>

                                    <select id="role" name="role" class="form-control ">
                                        <option value="0">Administrador</option>
                                        <option value="1">Soporte</option>
                                        <option value="2">Usuario</option>
                                        <option value="3">Acompañamiento</option>
                                        <option value="4">Cultura</option>
                                        <option value="5">Deportes</option>
                                        <option value="6">Dirección</option>
                                        <option value="7">Gestión</option>
                                        <option value="8">Salud</option>
                                        <option value="9">Comercial Inv.</option>
                                        <option value="10">Dir. Admin Inv.</option>
                                    </select>

                                    @error('role')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-right"><em>Edite ese campo solo si desea modificar la contraseña</em></label>

                                <div class="col-md-6">
                                    <input id="password" type="text" class="form-control" name="password" autocomplete="new-password">

                                </div>
                            </div>

                           

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="form-control btn btn-primary" style="background-color: blue;">
                                        {{ __('Guardar Cambios') }}
                                    </button>
                                </div>
                            </div>

                            
                        </form>
                     </div>


                     <div>
                    
                     </div>

                     

                     <br>

                     <div class="col-md-12" style="border:solid; border-color: #E9967A;">

                        <br>

                        <table class="table table-responsive">
                            <thead class="thead-dark">
                                <tr>
                                <!--th scope="col">#</th-->
                                <th scope="col">Token</th>
                                <th scope="col">user_id</th>
                                <th scope="col">device_id</th>
                                <th scope="col">created_at</th>
                                <th scope="col">Opciones</th>
                                
                                </tr>
                            </thead>
                            <tbody>
                        

                                @foreach ($tokenacceso as $token)
                                <tr>
                                    <td><?php echo substr( $token->id , 0, 10).'---'; ?></td>
                                    <td>{{ $token->user_id }}</td>
                                    <td>{{ $token->device_id }}</td>
                                    <td>{{ $token->created_at }}</td>
                                    <td>
                                    <a href="{{ url('token', $token->user_id ) }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                                    <!--a href="" class="btn btn-sm btn-danger">Eliminar</a-->
                                </td>
                                </tr>
                                
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    
                    <br>


                    
                    <div class="row">

                        
                        <div class="col-md-6" style="border:solid; border-color: #008B8B;">
                            <br>
                            <form action="{{ route('proyectoUsuario') }}" method="POST">
                                @csrf
                                    <input type="hidden" name="user_id" value="{{ $usuario->id }}">
                                <div class="row form-row align-items-center">
                                    <div class="col-md-04">

                                    <div class="form-group">
                                        <select id="select-projectUser" name="project_id" class="form-control">
                                            <option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Semestre</option>
                                            @foreach ($proyectos as $project)
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                    </div>
                                    <div class="col-md-04">
                                    

                                    <div class="form-group">
                                        <select id="select-levelUser" name="level_id" class="form-control">
                                            <option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Nivel</option>
                                            
                                        </select>
                                    </div>

                                    </div>
                                
                                    <div class="col-md-04">
                                    <button type="submit" class="form-control btn btn-primary mb-2">Asignar</button>
                                    </div>
                                </div>

                            </form>

                            <br>

                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <!--th scope="col">#</th-->
                                    <th scope="col">Proyecto</th>
                                    <th scope="col">Nivel</th>
                                    <th scope="col">Opciones</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                            

                                    @foreach ($proyectosUser as $project_user1)
                                    <tr>
                                        <td>{{ $project_user1->project->name }}</td>
                                        <td>{{ $project_user1->level->namenivel }}</td>
                                        <td>
                                        <a href="{{ url('proyecto-usuario', $project_user1->id ) }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                                        <!--a href="" class="btn btn-sm btn-danger">Eliminar</a-->
                                    </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>


                        <div class="col-md-6" style="border:solid; border-color: #E9967A;">

                            <br>
                            <form action="{{ route('storeMenu') }}" method="POST">
                                @csrf
                                    <input type="hidden" id="user_id" name="user_id" value="{{ $usuario->id }}">
                                <div class="row form-row align-items-center">
                                    <div class="col-md-04">

                                    <div class="form-group">

                                        <select id="menu" name="menu" class="form-control ">
                                            <option value="speventos">Spinner Eventos</option>
                                            <option value="actividadesevento">Act. x Evento</option>
                                            <option value="corresponsabilidad">Corresponsabilidad</option>
                                            <option value="regevento">Reg. Evento</option>
                                            <option value="eventos">Lista Eventos</option>
                                            <option value="regactividad">Reg. Actividad</option>
                                            <option value="delactividad">Elim. Actividad</option>
                                        </select>

                                    </div>

                                    </div>
                                
                                    <div class="col-md-04">
                                    <button type="submit" class="form-control btn btn-primary mb-2">Asignar</button>
                                    </div>
                                </div>

                            </form>

                            <br>

                            <table class="table">
                                <thead class="thead-dark">
                                    <tr>
                                    <!--th scope="col">#</th-->
                                    <th scope="col">IDMenu</th>
                                    <th scope="col">Función</th>
                                    <th scope="col">Opciones</th>
                                    
                                    </tr>
                                </thead>
                                <tbody>
                            

                                    @foreach ($queryMenu as $queryM)
                                    <tr>
                                        <td>{{ $queryM->id }}</td>
                                        <td>{{ $queryM->funcion }}</td>
                                        <td>
                                        <a href="{{ url('menu-usuario', $queryM->id ) }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                                        <!--a href="" class="btn btn-sm btn-danger">Eliminar</a-->
                                    </td>
                                    </tr>
                                    
                                    @endforeach
                                </tbody>
                            </table>
                            
                        </div>

                    </div>
                    
                </div>
            </div>
        
@endsection
