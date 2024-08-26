<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Formato Solicitud de Equipos y Bienes</title>

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
              <br>Formato Solicitud de Equipos y Bienes
            </h5>
      
   
      
        </div>
        
        <div class="col-md-3"  style="text-align: right; margin-top: -13%;">
            
            <img src="{{ url('public/imagenes/escudoUnal_black.png') }}" width="30%">
        </div>
      </div>
    </div>

    <div class="row">


      <table class="table table-bordered">
        <tbody>
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">NOMBRE DEL SOLICITANTE </td>
                <td style="font-size: 12px; width: 370px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">CÓDIGO: </td>
                <td style="font-size: 12px; width: 110px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">CARRERA: </td>
                <td style="font-size: 12px; width: 370px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

            

        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">No. DOCUMENTO DE IDENTIDAD: </td>
                <td style="font-size: 12px; width: 410px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

            

        </tbody>
        
      </table>
      <BR>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 0px black;">BIEN (ES) SOLICITADO (S)</td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>

            

        </tbody>
        
      </table>

      <br>
      <table class="table table-bordered">
        <tbody>
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">ACTIVIDAD EN LA CUAL SE VA A UTILIZAR </td>
                <td style="font-size: 12px; width: 370px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">FECHA DE REALIZACIÓN DE LA ACTIVIDAD: </td>
                <td style="font-size: 12px; width: 380px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">HORA DE INICIO</td>
                <td style="font-size: 12px; width: 210px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">HORA DE FINALIZACIÓN</td>
                <td style="font-size: 12px; width: 180px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

            

        </tbody>
        
      </table>

      <BR>
      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 15px; width: 650px; vertical-align:bottom; border-bottom: solid 0px black;">Nombre del funcionario quien otorga el permiso para la actividad anterior de las dependencias de la Sede Palmira.</td>
                
            </tr>
            <tr>
                
                <td style="font-size: 12px; width: 650px; vertical-align:bottom; border-bottom: solid 1px black;"><BR></td>
                
            </tr>
            

        </tbody>
        
      </table>
      <BR>
      <div class="col-md-12" style="font-size: 14px; text-align: justify; border: solid 1px black; border-radius: 20px; padding: 5px;">
          SEÑOR ESTUDIANTE: recuerde que los bienes y recursos de la universidad deberán ser autorizados para las actividades en este documento descritas y previamente autorizadas. Es su responsabilidad el cuidado,&nbsp;&nbsp;&nbsp; preservación, mantenimiento y devolución de los bienes entregados, en las condiciones y horarios que le sean asignados. Su abandono, deterioro o pérdida implicaran su responsabilidad personal y económica por el valor entregado. La Dirección de Bienestar analizara la viabilidad de esta solicitud, la cual, además está sujeta a disponibilidad de los equipos requeridos. El uso no autorizado de los bienes entregados, así como su abandono o daño son causal para negar un nuevo préstamo hasta cuando la Dirección de Bienestar lo considere pertinente.<br>
          El valor de los equipos; en caso de pérdida, será reportado al sistema de información académica (SIA) e impedirá &nbsp; su matrícula en el periodo siguiente hasta tanto no se haya resuelto la deuda.
      </div>

      <BR>
      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 14px; text-align: justify; width: 650px; vertical-align:bottom; border-bottom: solid 0px black;">FIRMA DE LA SOLICITUD POR EL ESTUDIANTE Declaro que conozco el contenido de este documento me comprometo a devolver los&nbsp; equipos recibidos &nbsp;en préstamo&nbsp; bajo la autorización de la dirección de &nbsp;Bienestar en &nbsp; las condiciones ya descritas.</td>
                
            </tr>


        </tbody>
        
      </table>
      <br>
      <table class="table table-bordered">
        <tbody>
        
            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">NOMBRE</td>
                <td style="font-size: 12px; width: 230px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">TELÉFONO</td>
                <td style="font-size: 12px; width: 200px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>
        </tbody>
        
      </table>

      <table class="table table-bordered">
        <tbody>

            <tr>
                
                <td style="font-size: 12px; vertical-align:bottom; border-bottom: solid 0px black;">CC</td>
                <td style="font-size: 12px; width: 265px; vertical-align:bottom; text-align:center; border-bottom: solid 1px black;">{{ $prestamo->usuario }}</td>
            </tr>

            

        </tbody>
        
      </table>
      <br>
      

      <div class="row" style="font-size: 13px; padding: 7px; border: solid 1px black; border-radius: 20px; text-align: center;">
                  
        <div class="col-md-12">
            ESPACIO EXCLUSIVO PARA LA DIRECCIÓN DE BIENESTAR UNIVERSITARIO
        </div>
        <br>
        <table style="font-size: 13px; padding: 3px; text-align: center;" class="table table-bordered">
          <tbody>
          
              <tr>
                  

                  <td style="width: 270px; font-size: 12px; text-align: right;">AUTORIZADO</td>
                  
                  <td style="font-size: 12px; width: 70px; vertical-align:bottom; text-align: center;">
                    @if ( $prestamo->estamento == 'Docente')
                        SÍ X
                    @else 
                        SI O
                    @endif
                  </td>
              
                  
                  <td style="font-size: 12px; width: 70px; vertical-align:bottom; text-align:center;">
                    @if ( $prestamo->estamento == 'Estudiante Pregrado')
                        NO X
                    @else 
                        NO O
                    @endif
                  </td>
              </tr>

              

          </tbody>
          
        </table>
        <br>
        

        <table style="font-size: 13px; padding: 3px; text-align: center;" class="table table-bordered">
          <tbody>
          
              <tr>
                  

                  <td style="width: 130px; font-size: 12px; text-align: right;">FIRMA</td>
                  
                  <td style="font-size: 12px; width: 420px; border-bottom: solid 1px black; vertical-align:bottom; text-align: center;">
                    @if ( $prestamo->estamento == 'Docente')
                      {{ $firmaPrestamoQR }}
                    @else 
                      {{ $firmaPrestamoQR }}
                    @endif
                  </td>
              
                  
                  
              </tr>

              

          </tbody>
          
        </table>





          
          
      
      </div>


      <br>
      <table style="font-size: 13px; padding: 3px; text-align: center;" class="table table-bordered">
        <tbody>
        
            <tr>
                

                <td style="width: 200px; font-size: 12px; text-align: left;">BIEN (ES) DEVUELTOS (S):</td>
                
                <td style="font-size: 12px; width: 110px; vertical-align:bottom; text-align: center;">
                  @if ( $prestamo->estamento == 'Docente')
                      Completos X
                  @else 
                      Completos O
                  @endif
                </td>
            
                
                <td style="font-size: 12px; width: 110px; vertical-align:bottom; text-align:center;">
                  @if ( $prestamo->estamento == 'Estudiante Pregrado')
                      Pendientes X
                  @else 
                      Pendientes O
                  @endif
                </td>

                <td style="width: 200px; font-size: 12px; text-align: right;">¿Cuál?___________________</td>


            </tr>

            

        </tbody>
        
      </table>
      
      <br>
      
      <table style="font-style: italic; font-size: 13px; padding: 3px;" class="table table-bordered">
        <tbody>
        
            <tr>
                

                <td style="width: 250px; text-align: left;">Código P-FT-07.006.005</td>
                
                <td style="width: 180px; text-align: left;">
                  Versión: 2.0
                </td>
            
                
                <td style="width: 200px; text-align: right;">
                  Página 1 de 1
                </td>


            </tr>

            

        </tbody>
        
      </table>

      
    </div>

    

  




  </body>
</html>