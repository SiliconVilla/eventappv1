@extends('layouts.app')

@section('asistencias')


  <div class="container" style="background-color:white;">
  <div class="row">
      <div class="col-md-7"  style="margin-top: 0%;">
      <h6 style="visibility: hidden;">
        @if(isset($asistencia))
          {{ $asistencia->activity_id }}
        @else
          {{ $id }}
        @endif
      </h6>
      <a class="btn btn-warning float-end" href="{{ url('asistencias-export')}}">Exportar datos a Excel</a>
      <br>
        <br>
        <h6>Lista de Asistencia a Reuniones, Actividades o Eventos Institucionales</h6>
        <br>
        <a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a>
        @if(isset($asistencia))
          <!--a href="{{ route('pdfview',['download'=>'pdf', 'id'=>$asistencia->activity_id]) }}">Generar PDF</a-->
        @else
          <!--a href="{{ route('pdfview',['download'=>'pdf', 'id'=>$id]) }}">Generar PDF</a-->
        @endif
        
      
      </div>
      
      <div class="col-md-5"  style="">
        
        <img src="{{ url('public/imagenes/logo_bunpalmira.png') }}" width="100%" style="text-align: center;">
      </div>
    </div>


    <div class="row" style="border: 1px black solid;">
      <div class="col-md-4"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Nombre del Evento / Taller / Reunión</h6>
        
      </div>
      
      <div class="col-md-8"  style="">
        
      <div style="width: 55%;  float: right; margin-top: 0;">
        @if(isset($asistencia))
          {{ $asistencia->evento }}-{{ $asistencia->actividad }}
        @else
          {{ $nEvento }}
        @endif
      </div>
        
      </div>
    </div>


    <div class="row" style="border: 1px black solid;">
      <div class="col-md-2"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Lugar de Evento:</h6>
        
      </div>
      
      <div class="col-md-3"  style="">
        @if(isset($asistencia))
          {{ $asistencia->lugar }}
        @else
          
        @endif
      
        
      </div>
      <div class="col-md-1"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Fecha:</h6>
        
      </div>
      
      <div class="col-md-2"  style="">
        @if(isset($asistencia))
          {{ $asistencia->fecha }}
        @else
          
        @endif
        
      </div>

      <div class="col-md-1"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>H. Inicio:</h6>
        
      </div>
      
      <div class="col-md-1"  style="">
        
        
      </div>

      <div class="col-md-1"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>H. Fin</h6>
        
      </div>
      
      <div class="col-md-1"  style="">
        
        
      </div>
    </div>



    <div class="row" style="border: 1px black solid;">
      <div class="col-md-2"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Organizado por:</h6>
        
      </div>
      
      <div class="col-md-4"  style="background-color:#ccc">
        
        
      </div>
      <div class="col-md-2"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Dependencia o Área:</h6>
        
      </div>
      
      <div class="col-md-4"  style="background-color:#ccc">
        
        
      </div>

      
    </div>


    <div class="row" style="border: 1px black solid;">
      <div class="col-md-3"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Capacitador(es):</h6>
        
      </div>
      
      <div class="col-md-9"  style="background-color:#ccc">
        
        
      </div>
      
    </div>


    <div class="row" style="">
      <div class="col-md-1"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>#</h6>
        
      </div>
      
      <div class="col-md-3"  style="background-color:#ccc">
      <h6>Nombres y Apellidos</h6>
        
      </div>
      <div class="col-md-2"  style="margin-top: 0%; background-color:#ccc">
        
      <h6>Doc. de Identidad</h6>
        
        
      </div>
      
      <div class="col-md-1"  style="background-color:#ccc">
      <h6>Código</h6>
      
      </div>

      <div class="col-md-3"  style="margin-top: 0%; background-color:#ccc">
        
        
      <h6>Correo Electrónico</h6>  
        
      </div>
      
      <div class="col-md-1"  style="background-color:#ccc">
        
      <h6>Teléfono</h6>
      
      </div>

      <div class="col-md-1"  style="margin-top: 0%; background-color:#ccc">
        
        
        <h6>Firma</h6>
        
      </div>
      
     
    </div>

    @foreach ($asistenciasreporte as $key => $item)
    <div class="row" style="border-bottom: 1px solid black;">
      
      <!--td class="col-md-1">key</td-->
      <div class="col-md-1">{{ $key+1 }}</div>
      <div class="col-md-3">{{ $item->nombre }}</div>
      <div class="col-md-2">{{ $item->user_id }}</div>
      <div class="col-md-1">{{ $item->codigo }}</div>
      <div class="col-md-3">{{ $item->email }}</div>
      <div class="col-md-1">{{ $item->celular }}</div>
      <div class="col-md-1">{{ $item->user_id }}</div>
      
    </div>
    @endforeach




    </div>
 


<div class="container" style="background-color:white">




  


    



    <style type="text/css">
       
       table {
          counter-reset: rowNumber;
        }

        table tr {
          counter-increment: rowNumber;
        }

        table tr td:first-child::before {
          content: counter(rowNumber);
          //min-width: 1em;
          //margin-right: 0.5em;
        }
        
    </style>



  
</div>

@endsection