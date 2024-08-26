@extends('layouts.app')

@section('content')

@if(!$agentEven->isMobile())
  <button id="btnocultarnav" class="btn btn-info" onclick="ocultarBarraNavegacionEventos()">Ocultar BarraNavegación</button>
@endif


@if($agentEven->isMobile())
  <style type="text/css">
      
    .product-slider{
      width:400px;
      margin:0px auto;
      text-align: center;
      padding:15px;
      color:white;
      .parent-slide{
        padding:15px;
      }
      img{
        display: block;
        margin:auto;
      }
    }
    
  </style>
@else
  <style type="text/css">
      
    .product-slider{
      width:901px;
      margin:0px auto;
      text-align: center;
      padding:20px;
      color:white;
      .parent-slide{
        padding:15px;
      }
      img{
        display: block;
        margin:auto;
      }
    }
    
  </style>
@endif




<br>
<br>

<!--div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="5" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="6" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <a href="actividad_evento/15"><img src="public/imagenes/slider/974agronomia.png" class="d-block w-100" alt="..."></a>
    </div>
    <div class="carousel-item">
      <a href="actividad_evento/16"><img src="public/imagenes/slider/1209agricola.png" class="d-block w-100" alt="..."></a>
    </div>
    <div class="carousel-item">
      <a href="actividad_evento/17"><img src="public/imagenes/slider/1655administracion.png" class="d-block w-100" alt="..."></a>
    </div>
    <div class="carousel-item">
      <a href="actividad_evento/18"><img src="public/imagenes/slider/19241ambiental.png" class="d-block w-100" alt="..."></a>
    </div>
    <div class="carousel-item">
      <a href="actividad_evento/19"><img src="public/imagenes/slider/29260disenio.png" class="d-block w-100" alt="..."></a>
    </div>
    <div class="carousel-item">
      <a href="actividad_evento/20"><img src="public/imagenes/slider/165988agroindustrial.png" class="d-block w-100" alt="..."></a>
    </div>
    <div class="carousel-item">
      <a href="actividad_evento/21"><img src="public/imagenes/slider/9311zootecnia.png" class="d-block w-100" alt="..."></a>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div-->

<br>
  


<div class="row">

  <div class="product-slider">
     
    
    @foreach ($eventos as $evento)
      
        <div class="slide">
            
            @if($agentEven->isMobile())
              <a href="{{ url('actividad_evento', $evento->id) }}"><img style="width: 100%;" src="{{ $evento->imagen }}" alt="" />
              </a>
            @else
              
              <a href="{{ url('actividad_evento') }}/{{$evento->id}}"><img src="{{ $evento->imagen }}" alt="" />
              </a>
            @endif
  
        </div>
    @endforeach
  
  </div>

</div>



        
@endsection
