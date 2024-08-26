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


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"/>


    <style type="text/css">
    	@font-face { 
		    font-family: AncizarSans; 
		    src: url('public/fuentes/AncizarSans/AncizarSansBold0.otf'); 
		} 



        @import url('https://fonts.googleapis.com/css?family=Roboto');

        * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
        }

        body {
        font-family: 'Roboto', sans-serif;
        background: #333;
        color: #fff;
        line-height: 1.6;
        }

        .slider {
        position: relative;
        overflow: hidden;
        height: 100vh;
        width: 100vw;
        }

        .slide {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.4s ease-in-out;
        }

        .slide.current {
        opacity: 1;
        }

        .slide .content {
        position: absolute;
        bottom: 70px;
        left: -600px;
        opacity: 0;
        width: 600px;
        background-color: rgba(255, 255, 255, 0.8);
        color: #333;
        padding: 35px;
        }

        .slide .content h1 {
        margin-bottom: 10px;
        }

        .slide.current .content {
        opacity: 1;
        transform: translateX(600px);
        transition: all 0.7s ease-in-out 0.3s;
        }

        .buttons button#next {
        position: absolute;
        top: 40%;
        right: 15px;
        }

        .buttons button#prev {
        position: absolute;
        top: 40%;
        left: 15px;
        }

        .buttons button {
        border: 2px solid #fff;
        background-color: transparent;
        color: #fff;
        cursor: pointer;
        padding: 13px 15px;
        border-radius: 50%;
        outline: none;
        }

        .buttons button:hover {
        background-color: #fff;
        color: #333;
        }

        @media (max-width: 500px) {
        .slide .content {
            bottom: -300px;
            left: 0;
            width: 100%;
        }

        .slide.current .content {
            transform: translateY(-300px);
        }
        }


        

        /* Backgorund Images */
        
        /*.slide:first-child {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/Vertical_Tarjeta_Ceremonia_V1.40.jpg') no-repeat
            center top/cover;
        }
        .slide:nth-child(2) {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/unal_ATRIL-40.jpg') no-repeat
            center top/cover;
        }
        .slide:nth-child(3)  {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/unal_ATRIL-41.jpg') no-repeat
            center center/cover;
        }
        .slide:nth-child(4) {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/unal_ATRIL-44.jpg') no-repeat
            center top/cover;
        }
        .slide:nth-child(5)  {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/unal_ATRIL-4.jpg') no-repeat
            center center/cover;
        }/*
        .slide:nth-child(6)  {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/qrcultura_2022.jpg') no-repeat
            center center/cover;
        }
        .slide:nth-child(7) {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/sliderferia.jpg') no-repeat
            center top/cover;
        }
        .slide:nth-child(8)  {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/Valle_Invensible.jpg') no-repeat
            center center/cover;
        }
        .slide:nth-child(9)  {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/Alcaldia_de_Palmira.jpg') no-repeat
            center center/cover;
        }        
        .slide:nth-child(10) {
        background: url('https://aprendapp.online/bunpalmira/public/imagenes/slider/pantalla/unimedios/Bioversity_CIAT.jpg') no-repeat
            center top/cover;
        }*/      


    </style>

    @foreach ($imgsatril as $index=>$item)

        @if($index == 0)
            <!--{{ $index }}-->
            <style type="text/css">
                .slide:first-child {
                    background: url('<?php echo $item->imagen ?>') no-repeat
                        center top/cover;
                }
            </style>
        @else
            <!--?php echo $index+1 ?-->
            <style type="text/css">
                .slide:nth-child(<?php echo $index+1 ?>) {
                    background: url('<?php echo $item->imagen ?>') no-repeat
                        center top/cover;
                }
            </style>
        @endif

    @endforeach



    
</head>
<body>


    <div id="app">
        

        <div class="slider">

        @foreach ($imgsatril as $index=>$item)

            @if($index == 0)
                <!--{{ $index }}-->
                <div class="slide current">
                    <div class="content" style="visibility: hidden;">
                        <h1>Slide One</h1>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                            maxime, voluptatibus labore doloremque vero!
                        </p>
                    </div>
                </div>
            @else
                <!--?php echo $index+1 ?-->
                
                <div class="slide">
                    <div class="content" style="visibility: hidden;">
                        <h1>Slide Two</h1>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                            maxime, voluptatibus labore doloremque vero!
                        </p>
                    </div>
                </div>
            @endif

        @endforeach
            <!--div class="slide current">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide One</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Two</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Three</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Four</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Five</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <!-div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Six</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Seven</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Ocho</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Nine</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div>
            <div class="slide">
                <div class="content" style="visibility: hidden;">
                    <h1>Slide Ten</h1>
                    <p>
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Sit hic
                        maxime, voluptatibus labore doloremque vero!
                    </p>
                </div>
            </div-->
        </div>
        <div class="buttons">
        <button id="prev"><i class="fas fa-arrow-left"></i></button>
        <button id="next"><i class="fas fa-arrow-right"></i></button>
        </div>

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

        
        <main class="py-4 justify-content-center" style="margin-top: 50px;">

            <div class="container">
            @if(isset($agent))
                <div class="col-md-8" style="   float:  left    ;">
            @else
                <div class="col-md-12" style="   float:  left    ;">
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


<script type="text/javascript" src="public/backgroundfullslider/js/modernizr.custom.86080.js"></script>

<!--script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
   
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<!script type="text/javascript" src="{{ url('public/js/admin/usuarios/edit.js') }}"></script-->


<!--script type="text/javascript" src="{{ url('public/js/admin/app.js') }}"></script-->

    
      

    
    
    <script type="text/javascript">
        const slides = document.querySelectorAll('.slide');
        const next = document.querySelector('#next');
        const prev = document.querySelector('#prev');
        const auto = true; // Auto scroll
        const intervalTime = 20000;
        let slideInterval;

        const nextSlide = () => {
        // Get current class
        const current = document.querySelector('.current');
        // Remove current class
        current.classList.remove('current');
        // Check for next slide
        if (current.nextElementSibling) {
            // Add current to next sibling
            current.nextElementSibling.classList.add('current');
        } else {
            // Add current to start
            slides[0].classList.add('current');
        }
        setTimeout(() => current.classList.remove('current'));
        };

        const prevSlide = () => {
        // Get current class
        const current = document.querySelector('.current');
        // Remove current class
        current.classList.remove('current');
        // Check for prev slide
        if (current.previousElementSibling) {
            // Add current to prev sibling
            current.previousElementSibling.classList.add('current');
        } else {
            // Add current to last
            slides[slides.length - 1].classList.add('current');
        }
        setTimeout(() => current.classList.remove('current'));
        };

        // Button events
        next.addEventListener('click', e => {
        nextSlide();
        if (auto) {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, intervalTime);
        }
        });

        prev.addEventListener('click', e => {
        prevSlide();
        if (auto) {
            clearInterval(slideInterval);
            slideInterval = setInterval(nextSlide, intervalTime);
        }
        });

        // Auto slide
        if (auto) {
        // Run next slide at interval time
        slideInterval = setInterval(nextSlide, intervalTime);
        }
            
    </script>


</html>
