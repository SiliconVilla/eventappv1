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
          <div class="row mb-3">

              <div class="col-md-12">
                  
                  <div id="lista_buscar_paciente"></div>
                          
              </div>

          </div>

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
      </div>
    @endif
  @else
  <div class="row">
 
    
  </div>
  @endif
  
</div>
@endsection

@section('scripts')
    <script language="javascript">

        ////INICIO PACIENTES////////////
        //Busqueda de pacientes
        $(document).ready(function(){
            $('#name').on('keyup',function(){
                var query= $(this).val();
                if (query.length > 5) {
                  $.ajax({
                      url:"https://siliconvilla.io/bunpalmira/buscarEstamentos",
                      type:"GET",
                      data:{'name':query},
                      success:function(data){ 
                          $('#lista_buscar_paciente').html(data);
                      }
                  });
                }
                
                //end of ajax call
            });
        });

        //Cargar Datos Pacientes Tabla-Componentes HTML
        function runMe(elemento){
          
          //console.log(elemento);
          var idCel = document.getElementById('celdaid'+elemento).innerText;
          var nombreCel = document.getElementById('celdanombre'+elemento).innerText;
          var estamentoCel = document.getElementById('celdaestamento'+elemento).innerText;
          
          $('#name').val(nombreCel);
          /*$('#user_email').val(emailCel);
          $('#user_id').val(documentoCel);
          $('#idsexopac').val(sexoCel);
          $('#nacimientopac').val(nacimientoCel);
          $('#epspac').val(epsCel);
          $('#tel1pac').val(tel1Cel);
          $('#tel2pac').val(tel2Cel);*/

          document.getElementById('tablaEstamentos').remove();


        
        }


        //Funcion al quitar foco del control nombre paciente
        function removerTabla() {

            let element = document.getElementById('tablaPacientes');
            var valuenombrepaciente = document.getElementById('user_name').value;

            if (valuenombrepaciente.length < 1) {
                if (element !== null) {
                    document.getElementById('tablaPacientes').remove();
                }
                $('#user_email').val('');
                $('#user_id').val('');
                $('#idsexopac').val('');
                $('#nacimientopac').val('');
                $('#epspac').val('');
                $('#tel1pac').val('');
                $('#tel2pac').val('');
            }
        }

       
    </script>
@endsection
