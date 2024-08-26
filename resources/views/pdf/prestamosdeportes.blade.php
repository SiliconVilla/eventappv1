<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formato Préstamo y Devolución de Implementos Deportivos</title>

    <style>
      @page {
        margin-left: 2cm;
        margin-right: 2cm;
        margin-bottom: 0.5cm;
      }

      

      @font-face { 
		    font-family: AncizarSans; 
		    src: url('public/fuentes/AncizarSans/AncizarSansBold0.otf'); 
		  } 

      @font-face { 
		    font-family: OpenSans; 
		    src: url('public/fuentes/open-sans/OpenSans-Italic.ttf'); 
		  } 


    </style>
    
  </head>
  <body>


    <div class="row"  style="font-family: OpenSans; font-style: italic;">
      <div class="col-md-5">
        
      
            <h5>Macroproceso: Bienestar Universitario
              <br>Proceso: Bienestar Universitario
              <br>Formato Préstamo y Devolución de Implementos Deportivos
            </h5>
      
   
      
        </div>
        
        <div class="col-md-3"  style="text-align: right; margin-top: -13%;">
            
            <img src="{{ url('public/imagenes/escudoUnal_black.png') }}" width="30%">
        </div>
      </div>
    </div>
    <br>

    <div class="row" style="border-top: solid 2px black; border-left: solid 2px black; border-right: solid 2px black; padding: 5px;">


      <table class="table table-bordered" style="width: 100%; text-align:center; border: solid 0px black;">
        <tbody>
            <tr>

            
                
              <td style="font-size: 12px; width: 49%; vertical-align:bottom; text-align:center; border: solid 1px black; padding-bottom: 4px;">
                PRÉSTAMO
                <BR>
                <?php 
                          
                    $timestamp = strtotime($prestamo->fecha);
                    echo "Fecha:__".date("d", $timestamp)."_";
                    echo "//";
                    echo "_".date("m", $timestamp)."_";
                    echo "//";
                    echo "_".date("Y", $timestamp)."__ ";
                    echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora:__".date("H:i", $timestamp)."__";
                ?>
                <BR>
                <BR>
                Nombre de Quién Presta:___{{ $prestamo->usuario }}____
              </td>

              <td style="font-size: 12px; width: 2%; vertical-align:bottom; text-align:center; border: solid 0px black;">
              </td>

              <td style="font-size: 12px; width: 49%; vertical-align:bottom; text-align:center; border: solid 1px black; padding-bottom: 4px;">
                DEVOLUCIÓN
                <BR>
                @if($prestamo->updated_at != null)
                    
                  <?php 
                  
                      
                      $timestamp = strtotime($prestamo->updated_at);
                      echo "Fecha:__".date("d", $timestamp)."_";
                      echo "//";
                      echo "_".date("m", $timestamp)."_";
                      echo "//";
                      echo "_".date("Y", $timestamp)."__ ";
                      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hora:__".date("H:i", $timestamp)."__";
                  ?>
                  
                @else
                    Fecha: _____//____//______ Hora:___:____
                @endif
                <BR>
                <BR>
                Nombre de Quién Recibe:___{{ $prestamo->servidor }}____
              
              </td>
          </tr>

        </tbody>
        
      </table>
      <br>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; width: 625px; vertical-align:bottom; border-bottom: solid 0px black;">Recibí del Área de actividad Física y Deporte, en calidad de Préstamo, los siguientes implementos deportivos
                </td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 500px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 500px; vertical-align:bottom; border-bottom: solid 1px black;">
                {{ $prestamo->elemento }} - {{ $prestamo->descripcion }}
                </td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 500px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 500px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>

            

        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 0px black;">Los cuales me comprometo a cuidar. De no ser así me comprometo y me haré responsable de la reposición de los mismos.

                </td>
                
            </tr>

        </tbody>
        
      </table>

      <table style="font-size: 13px; padding: 0px; text-align: center; border: solid 0px black;" class="table table-bordered">
        <tbody>
        
            <tr>
                

                <td style="font-size: 12px; text-align: left; border: solid 0px black;">Firma:</td>
                
                <td style="width: 205px; font-size: 12px; vertical-align:bottom; border-bottom: solid 1px black; text-align: center;">
                  {!! QrCode::size(25)->generate($firmaPrestamoQR); !!} {{ $prestamo->fecha }}
                </td>

                <td style="width: 70px; font-size: 12px; vertical-align:bottom; text-align: center;">
                  Estamento:
                </td>
                
                <td style="width: 90px; font-size: 12px; vertical-align:bottom; text-align: center;">
                  @if ( $prestamo->estamento == 'Docente')
                    Docentes X
                  @else 
                    Docentes O
                  @endif
                </td>
            
                
                <td style="width: 105px; font-size: 12px; vertical-align:bottom; text-align:center;">
                  @if ( $prestamo->estamento == 'Administrativo')
                    Administrativo X
                  @else 
                    Administrativo O
                  @endif
                </td>

                <td style="width: 90px; font-size: 12px; vertical-align:bottom; text-align:center;">
                  @if ( $prestamo->estamento == 'Estudiante Pregrado')
                    Estudiante X
                  @else 
                    Estudiante O
                  @endif
                </td>



            </tr>

            

        </tbody>
        
      </table>

      <table class="table table-bordered" style="">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">Nombre:</td>
                <td style="font-size: 12px; width: 200px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">D.I.:</td>
                <td style="font-size: 12px; width: 155px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->user_id }}</td>

                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">Código:</td>
                <td style="font-size: 12px; width: 110px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->codigo }}</td>
            </tr>

            

        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">Correo Electrónico:</td>
                <td style="font-size: 12px; width: 224px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->email }}</td>
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">Celular:</td>
                <td style="font-size: 12px; width: 220px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->celular }}</td>
            </tr>

            

        </tbody>
        
      </table>

      
    </div>

    <div class="row" style="border: solid 2px black;">

      <table class="table table-bordered" style="width: 100%; text-align:center; border: solid 1px black;">
        <tbody style="width: 100%; text-align:center; border: solid 0px black;">
            <tr style="width: 100%; text-align:center; border: solid 0px black;">

            
                
              <td style="font-size: 14px; width: 12%; vertical-align: center; text-align:center; border: solid 2px black;">
                <br>
                Nota:
                
              </td>

            

              <td style="font-size: 13px; width: 88%; text-align:justify; border: solid 2px black; padding: 6px; ">
                En los casos de reposición solamente se recibirá el mismo tipo de implemento de igual o mejor calidad y el usuario que no reponga el implemento, se le bloquearán futuros préstamos. Según Procedimiento de
                Préstamo de Implementos Deportivos
              
              </td>
          </tr>

        </tbody>
        
      </table>
    </div>

    

    <table style="font-style: italic; font-size: 13px; padding: 3px;" class="table table-bordered">
      <tbody>
      
          <tr>
              

              <td style="width: 250px; text-align: left;">Código: P.FT.07.008.011</td>
              
              <td style="width: 180px; text-align: left;">
                Versión: 3.0
              </td>
          
              
              <td style="width: 200px; text-align: right;">
                Página 1 de 1
              </td>


          </tr>

          

      </tbody>
      
    </table>

  


    


  </body>
</html>