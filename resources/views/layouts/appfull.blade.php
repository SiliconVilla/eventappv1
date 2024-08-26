<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EventAPP') }}</title>

    

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!--link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"-->

    <!-- Styles -->
    <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">

    <!--link href="{{ asset('resources/css/bootstrap.min.css') }}" rel="stylesheet"-->

    <style type="text/css">
    	@font-face { 
		    font-family: AncizarSans; 
		    src: url('public/fuentes/AncizarSans/AncizarSansBold0.otf'); 
		} 


         


    </style>




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


<!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script-->

  

    


       <style type="text/css">
           html{ height:100%; }
            body{ min-height:100%; padding:0; margin:0; position:relative; background-color:  #a3bd31; }

            body::after{ content:''; display:block; height:100%; }

            footer{ 
              position:absolute; 
              bottom:0; 
              width:100%; 
              height:115px; 
            }
       </style>
    
</head>
<body>
    <!--ul class="cb-slideshow" style="position: absolute; z-index: -100;">
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
            <li><span></span><div><h3></h3></div></li>
    </ul-->

    

    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'BUNPalmira') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            @if (auth()->check())
                            <form class="navbar-form">
                                <div class="form-group">
                                    <select name="lista_de_proyectos_app" id="lista_de_proyectos_app" class="form-control">
                                        @foreach (auth()->user()->ListadoProyectos as $project)
                                            <option value="{{ $project->id }}" @if($project->id==auth()->user()->seleccionar_proyecto_id) selected @endif >{{ $project->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>
                            @endif
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <!--li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li-->
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                @if(isset($agent))
                                    @if(!$agent->isDesktop())
                                      <h1>  {!! QrCode::size(150)->generate(auth()->user()->documento); !!} </h1>
                                    @endif
                                @endif

                                


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}

                                    </a>


                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                


                                </div>
                            </li>

        

                        
                            
                            
                        @endguest

                        @if (auth()->check())
                            @if(auth()->user()->role == 0)

                                <li>
                                    <a href="{{ url('home') }}" class="nav-link">Calendario</a>
                                </li>

                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Apoyos
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <!--a class="dropdown-item" href="{{ url('home') }}">
                                            Ver
                                        </a-->
                                        <a class="dropdown-item" href="{{ route('apoyosCreate') }}">
                                            Listar
                                        </a>
                                        <!--a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a-->
                                        
                                    </div>
                                <!--li>
                                    <a href="{{ route ('eventoCreate') }}" class="nav-link">Registrar Evento</a>
                                </li>
                                <li>
                                    <a href="{{ route ('actividadCreate') }}" class="nav-link">Registrar Actividad</a>
                                </li>
                                <!-li>
                                    <a href="gfse/admin" class="nav-link">Administrar</a-->
                                </li>
                                

                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Préstamos
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <!--a class="dropdown-item" href="{{ url('home') }}">
                                            Ver
                                        </a-->
                                        <a class="dropdown-item" href="{{ route('dashprestamos') }}">
                                            Ver
                                        </a>
                                        <!--a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a-->
                                        
                                    </div>
                                <!--li>
                                    <a href="{{ route ('eventoCreate') }}" class="nav-link">Registrar Evento</a>
                                </li>
                                <li>
                                    <a href="{{ route ('actividadCreate') }}" class="nav-link">Registrar Actividad</a>
                                </li>
                                <!-li>
                                    <a href="gfse/admin" class="nav-link">Administrar</a-->
                                </li>


                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Incidencias
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('home') }}">
                                            Ver
                                        </a>
                                        <a class="dropdown-item" href="{{ route('reportar') }}">
                                            Reportar
                                        </a>
                                        <!--a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a-->
                                        
                                    </div>
                                <!--li>
                                    <a href="{{ route ('eventoCreate') }}" class="nav-link">Registrar Evento</a>
                                </li>
                                <li>
                                    <a href="{{ route ('actividadCreate') }}" class="nav-link">Registrar Actividad</a>
                                </li>
                                <!-li>
                                    <a href="gfse/admin" class="nav-link">Administrar</a-->
                                </li>


                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Eventos
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('eventos') }}">
                                            Ver
                                        </a>
                                        <a class="dropdown-item" href="{{ route('eventoCreate') }}">
                                            Crear
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a>
                                        <a class="dropdown-item" href="{{ route('listaActividades') }}">
                                            Listar Actividades
                                        </a>
                                        
                                    </div>
                                <!--li>
                                    <a href="{{ route ('eventoCreate') }}" class="nav-link">Registrar Evento</a>
                                </li>
                                <li>
                                    <a href="{{ route ('actividadCreate') }}" class="nav-link">Registrar Actividad</a>
                                </li>
                                <!-li>
                                    <a href="gfse/admin" class="nav-link">Administrar</a-->
                                </li>
                                

                                <li class=" dropdown list-group-item">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Administración
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('usuarios') }}">
                                        Usuarios
                                    </a>
                                    <a class="dropdown-item" href="{{ route('proyectos') }}">
                                        Proyectos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('configuracion') }}">
                                        Configuración
                                    </a>

                                    <label id="labelQR" class="labelQR" for="">{!! QrCode::size(150)->generate(auth()->user()->documento); !!}</label>
                                    
                                </div>
                            </li>


                            @elseif(auth()->user()->role == 2)

                                <li>
                                    <a href="{{ url('home') }}" class="nav-link">Calendario</a>
                                </li>

                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Incidencias
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('home') }}">
                                            Ver
                                        </a>
                                        <a class="dropdown-item" href="{{ route('reportar') }}">
                                            Reportar
                                        </a>
                                        
                                    </div>
                      
                                </li>

                                <li>
                                    <a href="{{ url('eventos') }}" class="nav-link">Eventos</a>
                                </li>


                            
                            @elseif(auth()->user()->role == 1)

                                <!--li>
                                    <a href="{{ url('home') }}" class="nav-link">Calendario</a>
                                </li-->

                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Préstamos
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <!--a class="dropdown-item" href="{{ url('home') }}">
                                            Ver
                                        </a-->
                                        <a class="dropdown-item" href="{{ route('dashprestamos') }}">
                                            Ver
                                        </a>
                                        <!--a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a-->
                                        
                                    </div>
                                <!--li>
                                    <a href="{{ route ('eventoCreate') }}" class="nav-link">Registrar Evento</a>
                                </li>
                                <li>
                                    <a href="{{ route ('actividadCreate') }}" class="nav-link">Registrar Actividad</a>
                                </li>
                                <!-li>
                                    <a href="gfse/admin" class="nav-link">Administrar</a-->
                                </li>


                                <!--li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Incidencias
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('home') }}">
                                            Ver
                                        </a>
                                        <a class="dropdown-item" href="{{ route('reportar') }}">
                                            Reportar
                                        </a>
                                        <!-a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a->
                                        
                                    </div>
                                
                                </li-->


                                <!--li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Eventos
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ url('eventos') }}">
                                            Ver
                                        </a>
                                        <a class="dropdown-item" href="{{ route('eventoCreate') }}">
                                            Crear
                                        </a>
                                        <a class="dropdown-item" href="{{ route('actividadCreate') }}">
                                            Crear Actividad
                                        </a>
                                        
                                    </div>
                                
                                </li-->


                                <!--li class=" dropdown list-group-item">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Administración
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('usuarios') }}">
                                        Usuarios
                                    </a>
                                    <!--a class="dropdown-item" href="{{ route('proyectos') }}">
                                        Proyectos
                                    </a>
                                    <a class="dropdown-item" href="{{ route('configuracion') }}">
                                        Configuración
                                    </a-->
                                    
                                </div>
                                </li-->

                            @else<!--if(auth()->user()->role == 1)-->


                                <li class=" dropdown list-group-item">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        Asistencias
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                      
                                        <a class="dropdown-item" href="{{ route('regAsistencia') }}">
                                            Registrar
                                        </a>
                                        
                                        
                                    </div>
                                
                                </li>
                                

                            @endif
                        @endif

                        


                        
                    </ul>
                </div>
            </div>
        </nav>

        <!--Encabezado Áreas Oculto/Activo-->
        <!--nav class="fixed-top" style="margin-top: 54px; z-index: 1; vertical-align: bottom;">
            <div class="row" style="height: 30px;">
                <div style="background-color: #00769a; background-repeat: no-repeat; background-position: center; background-size: contain; background-image: url(public/imagenes/areas/ai/3acompanamiento.png); width: 20%; height: 40px;"></div>
                <div style="background-color: #716f6e; background-repeat: no-repeat; background-position: center; background-size: contain; background-image: url(public/imagenes/areas/gfse/3gestion.png); width: 20%; height: 40px;"></div>
                <div style="background-color: #2d1d42; background-repeat: no-repeat; background-position: center; background-size: contain; background-image: url(public/imagenes/areas/salud/3salud.png); width: 20%; height: 40px;"></div>
                <div style="background-color: #008b74; background-repeat: no-repeat; background-position: center; background-size: contain; background-image: url(public/imagenes/areas/afyd/3deporte.png); width: 20%; height: 40px;"></div>
                <div style="background-color: #651f43; background-repeat: no-repeat; background-position: center; background-size: contain; background-image: url(public/imagenes/areas/cultura/3cultura.png); width: 20%; height: 40px;"><a href="https://eventapp.asocia2.co/cultura" style="width: 100%; height: 100%; display: block; text-decoration: none;"></a></div>
            </div>

        </nav-->

        
        <main class="py-4 justify-content-center text-center" style="margin-top: 50px; text-align: center;">

            <div class="row" style="">
            @if(isset($agent))
                <div class="col-md-8" style="float: center;">
            @else
                <div class="col-md-12" style="float: left;">
            @endif

                    
                        @yield('content')
                   
                
                            
                </div>

                <br>

                <div class="col-md-4" style="float: right   ;">

                    @if(isset($agent))
                        @if($agent->isDesktop())
                            @if(str_contains(url()->current(), '/bunpalmira/home'))
                                @include('includes.menu')
                                <!--a href="#" class="btn btn-danger" target="_blank">Button</a-->
                            @endif
                                
                        @endif
                    @endif
                    
                   
                            
                </div>
            </div>
            
        </main>
        
        <div class="row">
            @yield('asistencias')
        </div>
    </div>

 


   <div>
    <!--footer class="fixed-bottom">    
        <div class="row" style="background-color: white; height: 120px; padding-top: 0px; padding: 15px;">
            
            <!--div class="col-md-4" style="color: black; text-align: center;"><h2 style="font-family: Arial; font-weight: bold; font-size: 120%;">Síguenos en:</h2>
            </div->
            <div class="col-md-6" style="font-family: Arial; font-weight: bold; font-size: 110%; color: black; text-align: center;">
                <a href="https://www.facebook.com/BUNPalmira/"><img src="{{ asset('public/imagenes/facebook.png') }}" width="35"></a>  
                <a href="https://www.instagram.com/bunpalmira/?hl=es-la"><img src="{{ asset('public/imagenes/insta.png') }}" width="35"> @bunpalmira</a>
                
            </div>
            

            <div class="col-md-6" style="text-align: center;">
            <img src="{{ asset('public/imagenes/logo_un.png') }}" style="width: 50%;">                
            </div>
        </div>

        </footer-->
    </div>
    

    
</body>

<!--Scripts-->
    <!--script src="{{ asset('resources/js/jquery-3.6.0.min.js') }}" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script-->


<!--script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>




<script src="https://kit.fontawesome.com/68531d8eec.js" crossorigin="anonymous"></script>



    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!script type="text/javascript" src="{{ url('public/js/admin/usuarios/edit.js') }}"></script-->

    @yield('scripts')

    <!--script src="{{ url('public/js/appv1.js?v=1200013') }}"></script-->

    <!--script type="text/javascript" src="{{ url('public/js/admin/app.js') }}"></script-->

    
        <!--script src="https://code.jquery.com/jquery-3.2.1.js"></script-->
        <script language="javascript">
        $(document).ready(function(){
            $("#select-projectUser").on('change', function () {
                var project_id = $(this).val();
                
                if(!project_id){
                    $('#select-levelUser').html('<option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Nivel</option>');
                    return;
                }
                //alert("ID Proyecto--> "+project_id);
                
                $.get("/bunpalmira/api/proyecto/"+project_id+"/niveles", function(data) {
                    //console.log(data);
                    var html_select = '<option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Nivel</option>';
                    for (var i=0; i<data.length; ++i){
                        html_select += '<option value="'+data[i].id+'" style="text-align: center  ;" class="justify-content-center">'+data[i].namenivel+'</option>';
                    }
                    $("#select-levelUser").html(html_select);
                });	
            });


            $("#category_id").on('change', function () {
                var category_id = $(this).val();
                
                if(!category_id){
                    $('#tipo_id').html('<option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Tipo</option>');
                    return;
                }
                //alert("ID Proyecto--> "+project_id);

                //https://siliconvilla.online/bunpalmira/tiposJson/5
                
                $.get("/bunpalmira/tiposJson/"+category_id, function(data) {
                    //console.log(data);
                    var html_select = '<option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Tipo</option>';
                    for (var i=0; i<data.length; ++i){
                        html_select += '<option value="'+data[i].id+'" style="text-align: center  ;" class="justify-content-center">'+data[i].name+'</option>';
                    }
                    $("#tipo_id").html(html_select);
                });	
            });


            $("#tipo_id").on('change', function () {
                var tipo_id = $(this).val();
                
                if(tipo_id == 4){
                    document.getElementById("card_documentos").style.visibility = "visible";
                } else {
                    document.getElementById("card_documentos").style.visibility = "hidden";
                }
                //alert("ID Proyecto--> "+project_id);

            });



            $('#buscarpor').on('change', function() {
                    document.forms['formAreasPrestamos'].submit();
            });

            /*$('#buscarpor').on('change', function() {
                    document.forms['formAreasPrestamos'].submit();
            });*/
          



            


           


            


        });
        </script>

    
    
        <script type="text/javascript">
        function reply_click(clicked_id)
        {
            //alert(clicked_id);
           // location.href = "{{ url('seleccionar/proyecto') }}/"+project_id;

        }
        </script>

        <script language="javascript">
            $(document).ready(function(){
                //alert('Ejecutado--> Pro,Edit');
                //Accediendo al atributo data category para implementar acciones sobre quien contenga dicho atributo
                $('[data-category]').on('click', editarCatModal);
                $('[data-level]').on('click', editarNivelModal);
            });

            function editarCatModal(){
                var category_id = $(this).data('category');
                //alert(category_id);
                $('#category_id').val(category_id);
                var catnamenew = $(this).parent().prev().text();
                //alert(catnamenew);
                $('#namecategorianew').val(catnamenew);
                $('#modalEditarCategoria').modal('show');
            }

            function editarNivelModal(){
                var level_id = $(this).data('level');
                //alert(category_id);
                $('#level_id').val(level_id);
                var nivnamenew = $(this).parent().prev().text();
                //alert(catName);
                $('#namenivelnew').val(nivnamenew);
                $('#modalEditarNivel').modal('show');
            }
        </script>

        <script language="javascript">
            $(function(){
                //alert('Ejecutado--> Bien¡¡¡');
                //Accediendo al atributo data category para implementar acciones sobre quien contenga dicho atributo
               $('#lista_de_proyectos_app').on('change', alSeleccionarProyecto);
            
            });


            function alSeleccionarProyecto(){
                var project_id = $(this).val();
                //alert('Ejecutado--> Seleccionar Proyecto '+project_id);
                location.href = "{{ url('seleccionar/proyecto') }}/"+project_id;

                
            }


            
        </script>


</html>
