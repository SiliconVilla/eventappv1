<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'EventAPP') }}</title>

    


    <!-- Styles -->
    <link href="{{ asset('resources/css/app.css') }}" rel="stylesheet">

    <link href="{{ url('public/css/bootstrap.min.css') }}" rel="stylesheet">

    <style type="text/css">
    	@font-face { 
		    font-family: AncizarSans; 
		    src: url('public/fuentes/AncizarSans/AncizarSansBold0.otf'); 
		} 

    </style>


    <!-- slick slider CSS library files -->
    <link href="{{ url('public/css/slick.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ url('public/css/slick-theme.css') }}" type="text/css" rel="stylesheet">
   
  

    


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
 
    

    <div id="app">
        <nav id="barranavegacion" class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
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
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registro') }}</a>
                                </li>
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


                                    <a class="dropdown-item" href="{{ route('clearCache') }}">
                                        {{ __('Borrar Cache') }}

                                    </a>

                                    


                                </div>
                            </li>

        

                        
                            
                            
                        @endguest

                        @if (auth()->check())
                            @if(auth()->user()->role == 0)

                                <li>
                                    <a href="{{ url('home') }}" class="nav-link">Reservas Gestion y Fomento</a>
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
                                            Beneficiarios
                                        </a>
                                        <a class="dropdown-item" href="{{ route('asistenciasIndex') }}">
                                            Asistencias
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

                                        <a class="dropdown-item" href="{{ route('pantalla') }}" target="_blank" rel="noopener">
                                            Ver Atril
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
                                

                                    <hr></hr>
                                    
                                   

                                    <label id="labelQR" class="labelQR" for="">{!! QrCode::size(150)->generate(auth()->user()->documento); !!}</label>
                                    
                                </div>
                            </li>


                            @elseif(auth()->user()->role == 2)

                                <li>
                                    <a href="{{ url('home') }}" class="nav-link">Reservas Gestion y Fomento</a>
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
                                        
                                    </div>
                      
                                </li-->

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

            <div class="container" style="">
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





<script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>

<script src="{{ url('public/js/popper-2.9.2.min.js') }}"></script>

<script src="{{ url('public/js/bootstrap-5.0.2.min.js') }}"></script>

<script src="{{ url('public/js/fontawesonkit.js') }}"></script>


<!-- slick slider JS library file -->
<script type="text/javascript" src="{{ url('public/js/slick.min.js') }}"></script>




<script>
$(document).ready(function(){
    $('.product-slider').slick({
        autoplay:true,
        autoplaySpeed:15000,
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        arrows: true,
        centerMode:false
    });
});
</script>

  
   

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
          
            
            
            

            $("#id_evento").on('change', function () {
                var evento_id = $(this).val();

                document.getElementById('eventosel').value = $( "#id_evento option:selected" ).text();
                
                if(!evento_id){
                    $('#select-actividad').html('<option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Nivel</option>');
                    return;
                }
                //alert("ID Evento--> "+evento_id);
                
                $.get("/bunpalmira/api/evento/"+evento_id+"/actividades", function(data) {
                    //console.log(data);
                    var html_select = '<option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Nivel</option>';
                    for (var i=0; i<data.length; ++i){
                        html_select += '<option value="'+data[i].id+'" style="text-align: center  ;" class="justify-content-center">'+data[i].actividad+'</option>';
                    }
                    $("#select-actividad").html(html_select);
                });	

                

            });

            $("#select-actividad").on('change', function () {
                var actividadID = $(this).val();

                
                if(!actividadID){
                    document.getElementById("reader").style.visibility = "hidden";
                    document.getElementById("html5-qrcode-button-camera-stop").click();
                    return;
                }
                //alert("ID Evento--> "+evento_id);
                
                document.getElementById("reader").style.visibility = "visible";
                


            });

            


            


            


        });

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


            $(function(){
                //alert('Ejecutado--> Bien¡¡¡');
                //Accediendo al atributo data category para implementar acciones sobre quien contenga dicho atributo
                var img_id = $('[data-img]').data('img');
               $('#lista_de_orden_img'+img_id).on('change', alSeleccionarOrden);
            
            });


            function alSeleccionarOrden(){
                var orden_id = $(this).val();
                var img_id = $('[data-img]').data('img');
                //alert('Ejecutado--> Seleccionar Proyecto '+project_id);
                location.href = "{{ url('seleccionar/orden') }}/"+img_id+"/"+orden_id;

                
            }


            
        </script>

        <script language="javascript">
            /*$(function(){
                //alert('Ejecutado--> Bien¡¡¡');
                //Accediendo al atributo data category para implementar acciones sobre quien contenga dicho atributo
               $('#lista_de_proyectos_app').on('change', alSeleccionarProyecto);
            
            });*/


            function ocultarBarraNavegacionEventos(){

                document.getElementById("btnocultarnav").style.visibility = "hidden";
                document.getElementById("barranavegacion").style.visibility = "hidden";


                
            }


            
        </script>


</html>
