@extends('layouts.app')

@section('content')

<style type="text/css">
    	.w-5 { 
            height: 20px; 
		} 
</style>

<div class="container" style="margin-top: 80px; text-align: center; min-height: 400px;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Registrar Actividad</div>

                <div class="card-body">
                    
                


                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif


                    <br>

                    @if (auth()->user()->es_admin)

                    <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Apoyos Socioeconómicos</div>

                        <div style="display: flex;">
                                    
                            <form class="form-inline" id="formFiltroApoyos" name="formFiltroApoyos">
                            
                            <div class="col-md-12" style="padding: 10px;">


                            <div class="col-md-12">
                                <input id="buscarpor" name="buscarpor" type="number" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" autofocus placeholder="Documento a buscar:" @if(isset($filtro)) value="{{ $filtro}}"  @endif>

                                @if ($errors->has('user_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="col-md-12">
                                <input id="buscarfecha" name="buscarfecha" type="date" class="form-control" @if(isset($filtro)) value="{{ $filtro }}" @else value="{{ date('Y-m-d') }}"  @endif>

                                
                            </div>
                            
                        
                            </div>

                            <div class="col-md-12" style="padding: 10px;">
                            <button class="btn btn-success form-control" type="submit">Filtrar</button>
                            </div>
                                
                                
                            
                            <!--input name="buscarpor" class="form-control me-2" type="search" placeholder="Flitrar" aria-label="Filtrar"-->
                            
                            </form>
                        
                        </div>

                        <!--div style="display: flex;">
                                    
                            <form class="form-inline" id="formFiltroApoyos" name="formFiltroApoyos">
                            
                            <div class="col-md-12" style="padding: 10px;">


                            <div class="col-md-12">
                                <input id="buscarfecha" name="buscarfecha" type="date" class="form-control" @if(isset($filtro)) value="{{ $filtro }}" @else value="{{ date('Y-m-d') }}"  @endif>

                                
                            </div>
                            
                        
                            </div>

                            <div class="col-md-12" style="padding: 10px;">
                            <button class="btn btn-success form-control" type="submit">Filtrar</button>
                            </div>
                                
                                
                            
                            <!--input name="buscarpor" class="form-control me-2" type="search" placeholder="Flitrar" aria-label="Filtrar"->
                            
                            </form>
                        
                        </div-->

                        <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Asistencias</div>
                        <table class="table">
                            <thead class="thead-dark">
                                <tr  style="text-align: center;">
                                    <th scope="col">#</th>
                                    <th scope="col">Usuario</th>
                                    <th scope="col">Evento</th>
                                    <th scope="col">Actividad</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Met.Reg.</th>
                                    <th scope="col">Opciones</th>
                                </tr>
                            </thead>
                        <tbody>
                            @foreach ($asistencias as $key => $asistencia)
                            <tr>
                                <td scope="row"><a href="asistencias/{{ $asistencia->id }}">{{ $key+1 }}</a></th>
                                <td>{{ $asistencia->user_id }}</td>
                                <td>{{ $asistencia->actividad }}</td>
                                <td>{{ $asistencia->activitys->actividad }}</td>
                                <td>{{ $asistencia->fecha }}</td>
                                <td>{{ $asistencia->metodoreg }}</td>
                                <td>
                                    <a href="{{ url('asistencias', $asistencia->id ) }}/eliminar" class="btn btn-sm btn-danger">Eliminar</a>
                                </td>
                            </tr>

                        

                            @endforeach
                        </tbody>
                            

                        </table>
                        
                    @endif
                    
                </div>
                
        
            </div>
        </div>
    </div>
</div>





@endsection


