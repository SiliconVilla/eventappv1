

<div class="card">
    <!--div class="card-header"> <a @if(request()->is('eventos')) class="active btn btn-primary form-control" style="color: white;" @endif class="nav-link" href="{{ route('eventosIndex') }}">Ir a Eventos</a></div-->

    <div class="card-body">
        <ul class="list-group">
            @if (auth()->check())

                     
                <!-- Right Side Of Navbar -->
                    <ul class="" style="justify-content: center; text-align: center;">
                        <!-- Authentication Links -->
                            <!--li class=" list-group-item" style="margin-top: 7px;">
                                <a @if(request()->is('home')) class="active btn btn-primary form-control" style="color: white;" @endif class="nav-link" href="{{ route('home') }}">Ir a Eventos</a>
                                
                                
                            </li-->


                            @if (auth()->user()->role == 0)
                                @if($servicio->soporte_id == null && $servicio->level_id != 4)
                                <li style="padding: 7px;" >
                                    <a style="padding: 7px; color: white;" class="btn-primary nav-link" href="{{ route('incidenciaAtender', $servicio->id) }}">Atender</a>
                                </li>
                                @endif


                                @if($servicio->level_id !=4 && $servicio->soporte_id != null)
                                <li style="padding: 7px;" >
                                    <a style="padding: 7px; color: white;" class="btn-success nav-link" href="{{ route('incidenciaResolver', $servicio->id) }}">Resolver</a>
                                </li>
                                @endif

                            

                            

                            <li style="padding: 7px;" >
                                <a style="padding: 7px; color: white;" @if(request()->is('reportar')) class="active btn btn-warning form-control" style="color: white;" @endif class="nav-link btn-warning" href="{{ route('reportar') }}">Editar</a>
                            </li>

                            
                            
                            <li style="padding: 7px;">
                                <a style="padding: 7px; color: white;" @if(request()->is('reportar')) class="active btn btn-secondary form-control" style="color: white;" @endif class="nav-link btn-secondary" href="{{ route('avanzarNivel', $servicio->id) }}">Avanzar</a>
                            </li>


                            

                            <!-- Button trigger modal -->
                            <li style="padding: 7px;" >
                                <button type="button" class="form-control btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Formato
                                </button>
                            </li>

                            

                            

                            <!--li @if(str_contains(url()->current(), 'usuarios')) class="active btn btn-primary form-control" style="color: white;" @endif class=" dropdown list-group-item" style="margin-top: 7px;">
                                <a @if(str_contains(url()->current(), 'usuarios')) style="color: white;" @endif id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Administración
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a @if(str_contains(url()->current(), 'usuarios')) class="active btn btn-primary form-control" style="color: white;" @endif class="dropdown-item" href="{{ route('usuarios') }}">
                                        Usuarios
                                    </a>
                                    <a class="dropdown-item" href="{{ route('proyectos') }}">
                                        Proyectos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('configuracion') }}">
                                        Configuración
                                    </a>
                                    
                                </div>
                            </li-->

                            @endif

                            @if (auth()->user()->role == 1)
                                @if($servicio->soporte_id == null && $servicio->level_id != 4)
                            
                                <li style="padding: 7px;" >
                                    <a class="btn-primary nav-link" href="{{ route('incidenciaAtender', $servicio->id) }}">Atender</a>
                                </li>
                                @endif


                                @if(auth()->user()->id == $servicio->soporte_id && $servicio->level_id !=4 && $servicio->soporte_id != null)
                                
                                <li style="padding: 7px;" >
                                    <a @if(request()->is('reportar')) class="active btn btn-secondary form-control" style="color: white;" @endif class="nav-link btn-secondary" href="{{ route('avanzarNivel', $servicio->id) }}">Avanzar</a>
                                </li>

                                @endif

                            <!--li style="padding: 7px;" >
                                <a class="btn-success nav-link" href="{{ route('register') }}">Resolver"</a>
                            </li-->
                            

                            <!--li style="padding: 7px;" >
                                <a @if(request()->is('reportar')) class="active btn btn-warning form-control" style="color: white;" @endif class="nav-link btn-warning" href="{{ route('reportar') }}">Editar</a>
                            </li--

                            @if(auth()->user()->id == $servicio->soporte_id && $servicio->level_id != 4)
                            <li style="padding: 7px;" >
                                <a @if(request()->is('reportar')) class="active btn btn-secondary form-control" style="color: white;" @endif class="nav-link btn-secondary" href="{{ route('avanzarNivel', $servicio->id) }}">Avanzar</a>
                            </li>
                            @endif-->

                            <!--li @if(str_contains(url()->current(), 'usuarios')) class="active btn btn-primary form-control" style="color: white;" @endif class=" dropdown list-group-item" style="margin-top: 7px;">
                                <a @if(str_contains(url()->current(), 'usuarios')) style="color: white;" @endif id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Administración
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a @if(str_contains(url()->current(), 'usuarios')) class="active btn btn-primary form-control" style="color: white;" @endif class="dropdown-item" href="{{ route('usuarios') }}">
                                        Usuarios
                                    </a>
                                    <a class="dropdown-item" href="{{ route('proyectos') }}">
                                        Proyectos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('configuracion') }}">
                                        Configuración
                                    </a>
                                    
                                </div>
                            </li-->

                            @endif

                            @if (auth()->user()->role == 2)
                                @if(auth()->user()->id == $servicio->cliente_id && $servicio->level_id !=4 && $servicio->soporte_id == null)
                                <!--li style="padding: 7px;" >
                                    <a class="btn-primary nav-link" href="{{ route('register') }}">Atender</a>
                                </li-->

                                    

                                <li style="padding: 7px;" >
                                    <a class="btn-warning nav-link" href="{{ route('incidenciaResolver', $servicio->id) }}">Agenda Psicologia</a>

                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                              <tr>
                                                <th scope="col"></th>
                                                <!--th scope="col">First</th>
                                                <th scope="col">Last</th>
                                                <th scope="col">Handle</th-->
                                              </tr>
                                            </thead>
                                            <tbody>
                                                @if ($servicio->tipo->name == 'Citas Médicas')
                                                    @foreach ($psicologos as $project)
                                                        <tr>
                                                            <th scope="row"><a href="{{ route('incidenciaAbrir', $project->user_id) }}"><img style="width: 45%;" src="../public/imagenes/agendapsicol.png"/><br> {{ $project->name }}</a><?php echo htmlspecialchars_decode(stripslashes($project->programa)); ?></th>

                                                            
                                                                
                                                            
                                                        
                                                        </tr>
                                                        
                                                        
                                                    @endforeach
                                                @endif
                                              <!--tr>
                                                <th scope="row">1</th>
                                                <td>Mark</td>
                                                <td>Otto</td>
                                                <td>@mdo</td>
                                              </tr-->
                                              
                                            </tbody>
                                          </table>
                                      </div>
                                </li>
                                @endif
                                

                                <!--li style="padding: 7px;" >
                                    <a @if(request()->is('reportar')) class="active btn btn-warning form-control" style="color: white;" @endif class="nav-link btn-warning" href="{{ route('reportar') }}">Editar</a>
                                </li>
                    
                                <li style="padding: 7px;" >
                                    <a @if(request()->is('reportar')) class="active btn btn-secondary form-control" style="color: white;" @endif class="nav-link btn-secondary" href="{{ route('reportar') }}">Avanzar</a>
                                </li-->

                                <!--li @if(str_contains(url()->current(), 'usuarios')) class="active btn btn-primary form-control" style="color: white;" @endif class=" dropdown list-group-item" style="margin-top: 7px;">
                                    <a @if(str_contains(url()->current(), 'usuarios')) style="color: white;" @endif id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Administración
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a @if(str_contains(url()->current(), 'usuarios')) class="active btn btn-primary form-control" style="color: white;" @endif class="dropdown-item" href="{{ route('usuarios') }}">
                                            Usuarios
                                        </a>
                                        <a class="dropdown-item" href="{{ route('proyectos') }}">
                                            Proyectos
                                        </a>
                                        <a class="dropdown-item" href="{{ route('configuracion') }}">
                                            Configuración
                                        </a>
                                        
                                    </div>
                                </li-->

                            @endif

                           <!-- @if (auth()->user()->es_admin)
                            
                            @endif-->
                        
                    </ul>

            @else
                <li><a href="#" class="list-group-item" style="margin-top: 7px;">Bienvenido</a></li>
                <li><a href="instrucciones" class="list-group-item" style="margin-top: 7px;">Instrucciones</a></li>
                <li><a href="#" class="list-group-item" style="margin-top: 7px;">Créditos</a></li>
            @endif
        </ul>

        
    </div>
    
</div>


<script>
    
</script>


@push('scripts')
                                                            
@endpush

