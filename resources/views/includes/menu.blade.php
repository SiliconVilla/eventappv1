

<div class="card">
    <div class="card-header"> <a @if(request()->is('eventos')) class="active btn btn-primary form-control" style="color: white;" @endif class="nav-link" href="{{ route('eventosIndex') }}">Ir a Eventos</a></div>

    <div class="card-body">
        <ul class="list-group">
            @if (auth()->check())

                     
                <!-- Right Side Of Navbar -->
                    <ul class="" style="justify-content: center; text-align: center;">
                        <!-- Authentication Links -->
                            <!--li class=" list-group-item" style="margin-top: 7px;">
                                <a @if(request()->is('home')) class="active btn btn-primary form-control" style="color: white;" @endif class="nav-link" href="{{ route('home') }}">Ir a Eventos</a>
                                
                                
                            </li-->

                            <li class=" list-group-item" style="margin-top: 7px;">
                                {!! QrCode::size(150)->generate(auth()->user()->documento); !!}
                            </li>

                            

                            @if (!auth()->user()->es_cliente)
                            <li class=" list-group-item" style="margin-top: 7px;">
                                <a class="nav-link" href="{{ route('register') }}">Ver Incidencias</a>
                            </li>
                            @endif

                            <li class=" list-group-item" style="margin-top: 7px;">
                                <a @if(request()->is('reportar')) class="active btn btn-primary form-control" style="color: white;" @endif class="nav-link" href="{{ route('reportar') }}">Reportar Incidencia</a>
                            </li>

                            @if (auth()->user()->es_admin)
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
                        
                    </ul>

            @else
                <li><a href="#" class="list-group-item" style="margin-top: 7px;">Bienvenido</a></li>
                <li><a href="instrucciones" class="list-group-item" style="margin-top: 7px;">Instrucciones</a></li>
                <li><a href="#" class="list-group-item" style="margin-top: 7px;">Créditos</a></li>
            @endif
        </ul>

    </div>
</div>

