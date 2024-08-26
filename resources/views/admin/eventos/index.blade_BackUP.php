@extends('layouts.app')

@section('content')

<style type="text/css">
    .w-5 {
        width: 7%;
    }

    .h-5 {
        width: 7%;
    }
    w-5 h-5
</style>
<br>
<br>

<div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
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
</div>

<br>
<div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">

    
    

    @foreach ($eventos as $evento)
      <div class="carousel-item active">
        <img src="{{ $evento->imagen }}" class="d-block w-100" alt="...">
      </div>
    @endforeach

  </div>
</div>


   
<!--div class="container" id="contenedorSlider" style="justify-content: center; border: solid 2px white;">
  

  <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
    <div class="carousel-indicators">

    @foreach( $eventos as $photo )
        <li data-bs-target="#carouselExampleDark" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}"></li>
    @endforeach
    
    </div>
    <div class="carousel-inner">
      @foreach( $eventos as $photo )
        <div class="carousel-item {{ $loop->first ? 'active' : '' }}" style="transition: 15.6s ease-in-out left;">
            <a href="actividad_evento/{{ $photo->id }}" style=""><img class="d-block img-fluid width100" style="width: 100%;" src="{{ $photo->imagen }}" alt=""></a>
                <div class="carousel-caption d-none d-md-block">
                  
                </div>
        </div>
      @endforeach

      
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>



</div-->

<script>
$(document).ready(function(){
    $('.product-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        dots: false,
        infinite: true,
        arrows: true
    });
});
</script>
        
@endsection
