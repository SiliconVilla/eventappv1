@extends('layouts.app')
<script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

  <style>
    
    #html5-qrcode-button-camera-start {
      background-color: yellow;
      background-color: #04AA6D; /* Green */
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
    }



  </style>


@section('content')
<div class="container" style="margin-top: 100px; margin-bottom: 103px;">

  @if (auth()->check())
    @if(auth()->user()->role == 3)

      <div class="row">


        <!--div class="col">
            <button type="button" id="btniniciar" onclick="iniciarlector()"  class="btn-info form-control" style="@if(isset($productonuevo)) visibility: hidden; @endif">
                {{ __('Registrar Asistencia') }}
            </button>
        </div-->
      

        <!--div class="col">
            <button type="button" id="btndetener"  class="btn-success form-control" style="@if(isset($productonuevo)) visibility: hidden; @endif">
                {{ __('Cerrar Lector') }}
            </button>
        </div-->

        <div class="col">

            <a href="{{ route('get_activity_by_event', $evento->id) }}" class="btn btn-danger form-control">Terminar</a>

        </div>
      </div>
      

  

    

    @endif
  @endif

    

  <!--ESPACIO PARA EL LECTOR QR DESDE WEB-->
  <hr>

  @if(isset(auth()->user()->role))
    @if(auth()->user()->role != null && auth()->user()->role != 2)

    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    @if (session('notification'))
        <div class="alert alert-success">
            <ul>
                {{ session('notification') }}
            </ul>
        </div>
    @endif

    <div class="card">
      <div class="card-header">Registro de Asistencia</div>
      <div class="card-body">
      <form method="POST" action="{{ route('storeAsistencias') }}" id="formqrcode" name="formqrcode">
            @csrf

            <div class="row">

                <div class="col-md-4">
                    <input id="name" type="text" class="form-control" name="name">
                </div>

                <div class="col-md-4">
                    <input id="evento" value="{{ $listado->evento }}" type="text" class="form-control" name="evento" readonly>
                </div>

                <div class="col-md-4">
                  <input id="actividad" value="{{ $listado->actividad }}" type="text" class="form-control" name="actividad" readonly>
                  <input id="id_actividad" style="visibility: hidden;" value="{{ $listado->activity_id }}" type="text" class="form-control" name="id_actividad" readonly>
                </div>

                <br>
                <div class="col-md-12">
                    <input id="registro" type="hidden" value="RegWEB" class="form-control" name="registro">
                    <input id="horasc" type="hidden" value="{{ $listado->horasc }}" class="form-control" name="horasc">
                    <input id="soporte_id" type="hidden" value="{{ auth()->user()->id }}" class="form-control" name="soporte_id">
                </div>
                <br>
                <?php
                    $dt = new DateTime();

                    echo '<input id="fechadb" class="form-control" name="fechadb" readonly type="date" value="' . $dt->format('Y-m-d') . '" />';
                ?>


            </div>

            <br>
            
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Registrar') }}
                    </button>
                </div>
            </div>
        </form>
      </div>
    
    </div>

      <div id="reader" style="visibility: visible;" width="300px"></div>

      <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

      <script>
          function onScanSuccess(decodedText, decodedResult) {
              // handle the scanned code as you like, for example:
              console.log(`Code matched = ${decodedText}`, decodedResult);
              document.getElementById('name').value=decodedText;
              document.getElementById("html5-qrcode-button-camera-stop").click();
              var audio = new Audio('https://siliconvilla.io/bunpalmira/public/audios/beep-07a.mp3');
              audio.play();
              let counter = 0;
              setInterval(() => {
                  counter++
                  document.getElementById("formqrcode").submit();
                  
              }, 2000);
          }

          function onScanFailure(error) {
              // handle scan failure, usually better to ignore and keep scanning.
              // for example:
              //console.warn(`Code scan error = ${error}`);
          }

          let html5QrcodeScanner = new Html5QrcodeScanner(
              "reader",
              { fps: 10, qrbox: {width: 250, height: 250} },
              /* verbose= */ false);
          
          html5QrcodeScanner.render(onScanSuccess, onScanFailure);

          $(document).ready(function() {
              document.getElementById("html5-qrcode-button-camera-stop").click();
          });

      </script>
    @endif
  @else
  <div class="row">
      <div class="col-md-12" style="text-align: center;">
      
        <table id="tabla-listar-actividades" style="text-align: center; width: 100%;">
          <thead style="width: 100%;"></thead>
          <tbody style="width: 100%;">
          
          
          
          <tr style="width: 100%; background-color: white;" id="encabezado">
            <td><h4 style="color: #712220; font-weight: bold; text-align: center; border-bottom-style: solid; border-top-style: solid;">{{$listado->actividad}}</h4></td>
          </tr>
          
          <tr style="border-bottom-style: solid; background-color: white;" id="fechahora">
            <td style="text-align: center; font-weight: bold; background-color: white;">
              <h4>
              @if($listado->dia_sem == "Monday")
              Lunes
              @elseif($listado->dia_sem == "Tuesday")
              Martes
              @elseif($listado->dia_sem == "Wednesday")
              Miércoles
              @elseif($listado->dia_sem == "Thursday")
              Jueves
              @elseif($listado->dia_sem == "Friday")
              Viernes
              @elseif($listado->dia_sem == "Saturday")
              Sábado
              @elseif($listado->dia_sem == "Sunday")
              Domingo
              @endif

              {{$listado->dia_mes}} de 
                                                
              @if($listado->mes == "Jan")
              Ene
              @elseif($listado->mes == "Feb")
              Feb
              @elseif($listado->mes == "Mar")
              Mar
              @elseif($listado->mes == "Apr")
              Abr
              @elseif($listado->mes == "May")
              May
              @elseif($listado->mes == "Jun")
              Jun
              @elseif($listado->mes == "Jul")
              Jul
              @elseif($listado->mes == "Aug")
              Ago
              @elseif($listado->mes == "Sep")
              Sep
              @elseif($listado->mes == "Oct")
              Oct
              @elseif($listado->mes == "Nov")
              Nov
              @elseif($listado->mes == "Dec")
              Dic
              @endif
              de {{$listado->anio}}</h4>
              <h4 style="color: #6b4ab6;">{{$listado->hora}}</h4>
            </td>
          </tr>

          <tr>
            <td>
              <!--style>
                /* Always set the map height explicitly to define the size of the div
                * element that contains the map. */
                  #map {
                    height: 100%;
                  }
                  
                  /* Optional: Makes the sample page fill the window. */
              </style>
              
              <?php $latitud = ($listado->latitud);?>
              <?php $longitud = ($listado->longitud);?>
              <?php $lugar = ($listado->lugar);?>

              <div id="map" style="height: 280px; width: 100%; border-style: solid;"></div>

              <script>
                var customLabel = {
                  restaurant: {
                    label: 'R'
                  },
                  bar: {
                    label: 'B'
                  }
                };

                function initMap() {
                  var map = new google.maps.Map(document.getElementById('map'), {
                    center: new google.maps.LatLng(<?php echo $latitud; ?>, <?php echo $longitud; ?>),
                    zoom: 18
                  });

                  var infoWindow = new google.maps.InfoWindow;
                  // Change this depending on the name of your PHP or XML file
                  downloadUrl('https://asocia2.co/coordenadas_eventapp/index.php', function(data) {
                  var xml = data.responseXML;
                  var markers = xml.documentElement.getElementsByTagName('marker');
                  Array.prototype.forEach.call(markers, function(markerElem) {
                    var name = "<?php echo($lugar) ?>";
                    var address = markerElem.getAttribute('');
                    var type = markerElem.getAttribute('type');
                    var point = new google.maps.LatLng(
                      parseFloat(<?php echo $latitud; ?>),
                      parseFloat(<?php echo $longitud; ?>));

                    var infowincontent = document.createElement('div');
                    var strong = document.createElement('strong');
                    strong.textContent = name
                    infowincontent.appendChild(strong);
                    infowincontent.appendChild(document.createElement('br'));

                    var text = document.createElement('text');
                    text.textContent = address
                    infowincontent.appendChild(text);
                    var icon = customLabel[type] || {};
                    var marker = new google.maps.Marker({
                      map: map,
                      position: point,
                      label: icon.label
                    });
     
                    marker.addListener('click', function() {
                      infoWindow.setContent(infowincontent);
                      infoWindow.open(map, marker);
                    });
                  });
                  });
                }

                function downloadUrl(url, callback) {
                  var request = window.ActiveXObject ?
                  new ActiveXObject('Microsoft.XMLHTTP') :
                  new XMLHttpRequest;

                  request.onreadystatechange = function() {
                    if (request.readyState == 4) {
                      request.onreadystatechange = doNothing;
                      callback(request, request.status);
                    }
                  };

                  request.open('GET', url, true);
                  request.send(null);
                }

                function doNothing() {}
              </script>
              
              <script async defer
                  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC56Hj7AcvI5RZZQYT6TYChdH2kgQjYzgM&callback=initMap">
              </script> -->

              
				<style>

            @media (min-width: 768px) and (max-width: 1366px){
              #map { 
                width: 100%;
                height: 540px;
              }
            }

            @media (max-width: 767px){
              #map { 
                width: 100%;
                height: 150px;
              }
            }

            @media (max-width: 480px){
              #map { 
                width: 100%;
                height: 200px;
              }
            }
				  
				</style>

              <?php $latitud = ($listado->latitud);?>
              <?php $longitud = ($listado->longitud);?>
              <?php $lugar = ($listado->lugar);?>

   <div id="map" style=""></div>
	 <script>

  var iconPos = L.icon({
    iconUrl: 'https://eventapp.asocia2.co/public/imagenes/iconPos.png',
    iconSize: [30, 48]
  });
	 
	var map = L.map('map').
	setView([3.51206, -76.30712], 
	14);
	 
	L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	    //attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
	    zoom: 12,
	    maxZoom: 18
	}).addTo(map);

	L.control.scale().addTo(map);
	L.marker([<?php echo $latitud; ?>, <?php echo $longitud; ?>], {draggable: true, title: '<?php echo $lugar; ?>'//, icon: iconPos
  }).addTo(map);

	 </script>

            </td>
          </tr>

          <tr style="background-color: white; border-top-style: solid; border-top-color: #712220;">
            <td>
              <h5 class="row" style="margin: 2%; text-align: center;">{{ $listado->descripcion }}</h5>
            </td>
          </tr>
    

        </tbody>
      </table>
    </div>

    <!--?php
    $dt = new DateTime();
    echo $dt->format('Y-m-d H:i:s');
    ?-->

    
  </div>
  @endif

  

  @if($listado->evento == 'Gestión Alimentaria')

      <div style="row;">
                                        
          <form class="row" id="formFiltroApoyos" name="formFiltroApoyos">
          
            <div class="col-md-6" style="padding: 10px;">
              <div class="col-md-12">
                  <input id="fechaservicio" name="fechaservicio" type="date" class="form-control" @if(isset($filtrofecha)) value="{{ $filtro }}" @else value="{{ date('Y-m-d') }}"  @endif>

                  @if ($errors->has('user_id'))
                      <span class="invalid-feedback">
                          <strong>{{ $errors->first('user_id') }}</strong>
                      </span>
                  @endif
              </div>
            </div>

            <div class="col-md-6" style="padding: 10px;">
              <button class="btn btn-success form-control" type="submit">Filtrar</button>
            </div>
                        
          </form>
      </div>


      <?php $acumulador = 0; $acumulador2 = 0; ?>

      @foreach ($cuentaservicio as $key => $cuenta)
        @if($cuenta->tarifa == 'BASICA PARCIAL' && $cuenta->fecha == $newDate)
          <?php $acumulador += 1; ?>
        @elseif($cuenta->tarifa == 'BASICA TOTAL' && $cuenta->fecha == $newDate)
          <?php $acumulador2 += 1; ?>
        @endif
      @endforeach

      <!--?php echo $acumulador." - "; echo $acumulador2." >>> "; echo $newDate; ?-->

      <table class="table table-responsive">
        <thead class="thead-dark">
          <tr  style="text-align: center;">
            <th scope="col">FECHA</th>
            <th scope="col">TOTAL</th>
            <th scope="col">PARCIAL</th>
            
          </tr>
        </thead>
        <tbody>
          <tr>
            <td style='text-align:center; vertical-align:middle'>@if(isset($newDate)) {{ $newDate }} @else {{ date('d-m-Y') }}  @endif</td>
            <td style='text-align:center; vertical-align:middle'><?php echo $acumulador2; ?></td>
            <td style='text-align:center; vertical-align:middle'><?php echo $acumulador; ?></td>
            
          </tr>

        </tbody>

      </table>
      
  @endif
</div>
