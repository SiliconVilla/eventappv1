@extends('layouts.app')



@section('content')





    <div class="card" style="justify-content: center; font-weight: bold; font-size: 18dp;">
        <div class="card-header">{{ __('1. Desliza las imágenes hasta encontrar el evento de tu interés, una vez ubiques la imágen haz click sobre ella para continuar.') }}</div>
        
        <div class="card-body">
            
            <div class="container" id="contenedorSlider" style=" justify-content: center;">
                <div class="row" style="justify-content: center;">

               
                    <img style="width: 50%;" src="public/imagenes/instrucciones/usoeventapp1.jpg">

                    

                </div>  


            </div>

            
        </div>
        <br>
    


    </div>

    <div class="card" style="justify-content: center; font-weight: bold; font-size: 18dp;">
        <div class="card-header">{{ __('2. Encontrarás la programación de toda la semana para tu carrera, haz click sobre cada actividad para continuar y conocer la ubicación dentro del campus.') }}</div>
        
        <div class="card-body">
            
            <div class="container" id="contenedorSlider" style=" justify-content: center;">
                <div class="row" style="justify-content: center;">

               
                    <img style="width: 50%;" src="public/imagenes/instrucciones/usoeventapp2.jpg">

                    

                </div>  


            </div>

           
        </div>
        <br>
    


    </div>


    <div class="card" style="justify-content: center; font-weight: bold; font-size: 18dp;">
        <div class="card-header">{{ __('3. Finalmente encontrarás el sitio donde se desarrollará la actividad, puedes hacer zoom al mapa e ir conociendo los diferentes espacios con los que cuenta la Sede Palmira para el desarrollo de sus actividades académicas, administrativas, deportivas y culturales.') }}</div>
        
        <div class="card-body">
            
            <div class="container" id="contenedorSlider" style=" justify-content: center;">
                <div class="row" style="justify-content: center;">

               
                    <img style="width: 50%;" src="public/imagenes/instrucciones/usoeventapp3.jpg">

                    

                </div>  


            </div>

            
        </div>
        <br>
        @include('includes.menu')


    </div>

@endsection


