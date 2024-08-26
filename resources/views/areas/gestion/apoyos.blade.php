@extends('layouts.app')

@section('content')


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



                    
                    <form method="POST" action="{{ route('apoyoStore') }}">
                        @csrf



                        <div class="form-group row"> 

                        @if (session('notification'))
                            <div class="alert alert-success">
                                <ul>
                                    {{ session('notification') }}
                                </ul>
                            </div>
                        @endif
                        
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif      
                            <!--label for="id_evento" class="col-md-4 col-form-label text-md-right">Actividad:</label-->

                 
                              
                            </div>
                        



                        <div class="form-group row">
                            <!--label for="name" class="col-md-4 col-form-label text-md-right">Actividad:</label-->

                            <div class="col-md-12">
                                <input id="user_id" type="number" class="form-control{{ $errors->has('user_id') ? ' is-invalid' : '' }}" name="user_id" value="{{ old('user_id') }}" required autofocus placeholder="Documento de Usuario:">

                                @if ($errors->has('user_id'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('user_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <hr>
                            <div class="form-group row">       
                            <!--label for="id_lugar" class="col-md-4 col-form-label text-md-right">Lugar:</label-->

                            <div class="col-md-12">
                                <select class="form-control" name="id_apoyo">

                                    <option value="APOYO ALIMENTARIO">APOYO ALIMENTARIO</option>
                                    <option value="APOYO TRANSPORTE" >APOYO TRANSPORTE</option>
                                    <option value="APOYO TRANSPORTE" >APOYO ECONOMICO</option>
                                     
                                </select>
                            </div>
                              
                            </div>

                        <hr>

                         


                        <div class="form-group row">
                            <!--label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label-->

                            <div class="col-md-12">

                                <select name="id_estado" class="form-control">
                                  <option value="1">Activo</option>
                                  <option value="2">Inactivo</option>
                                  
                                </select>


                            </div>
                        </div>

                        <hr>


                        <div class="form-group row">
                            <!--label for="id_estado" class="col-md-4 col-form-label text-md-right">Estado:</label-->

                            <div class="col-md-12">

                                <select name="tarifa" class="form-control">
                                  <option value="BASICA PARCIAL">PARCIAL</option>
                                  <option value="BASICA TOTAL">TOTAL</option>
                                  
                                </select>


                            </div>
                        </div>
                        
                        <hr>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-md-12">
                                    Adjudicar Beneficiario
                                </button>
                            </div>
                        </div>
                    </form>

                    <br>

                    @if (auth()->user()->es_admin)

                    <div class="row" style="background-color: green; justify-content: center;color: white;font-weight: bold;">Apoyos Socioeconómicos</div>

                        <div class="row" style="display: flex;">
                                    
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
                            
                        
                            </div>

                            <div class="col-md-12" style="padding: 10px;">
                            <button class="btn btn-success form-control" type="submit">Filtrar</button>
                            </div>
                                
                                
                            
                            <!--input name="buscarpor" class="form-control me-2" type="search" placeholder="Flitrar" aria-label="Filtrar"-->
                            
                            </form>


                           
                            
                        
                        </div>

                        <div class="row">
                            <div class="col-md-5">
                                <a class="btn btn-warning float-end" href="{{ url('corresp-export')}}">Exportar Corresp a Excel</a>
                            </div>

                            <div class="col-md-5">
                                <a class="btn btn-danger float-end" href="{{ url('apoyosfull-export')}}">Exportar Apoyos Total</a>        
                            </div>
                            
                        
                        

                        </div>

                        
                        <div class="row">
                            <div class="table-responsive" >
                                <table class="table">
                                  <thead class="thead-dark">
                                    <tr  style="text-align: center;">
                                      <th scope="col">#</th>
                                      <th scope="col">Usuario</th>
                                      <th scope="col">Apoyo</th>
                                      <th scope="col">Lugar</th>
                                      <th scope="col">Tarifa</th>
                                      <th scope="col">#serv.</th>
                                      <th scope="col">Reserva</th>
                                      <th scope="col">Horas.C</th>
                                      
                                      <th scope="col">saldoAnterior</th>
                                      <th scope="col">cantidadEntrada</th>
                                      <th scope="col">cantidadSalida</th>
                                      <th scope="col">saldo</th>
                                      <th scope="col">Opciones</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                    @foreach ($apoyos as $key => $apoyo)
                                    <tr>
                                      <td scope="row"><a href="{{ $apoyo->user_id }}/editar">{{ $key+1 }}</td>
                                      <td>{{ $apoyo->user_id }}</td>
                                      <td>{{ $apoyo->apoyo }}</td>
                                      <td><!--{{ $apoyo->lugar }}-->
                                        <form action="../apoyos/{{ $apoyo->user_id }}/lugar" class="btn btn-sm btn-dange">
            
                                            <select onchange="this.form.submit()" name="lugarapoyo" id="lugarapoyo" class="btn btn-sm btn-dange">
            
                                                @foreach ($cafeterias as $key => $value)
                                                    {{ $value }}
                                                    <option value="{{ $value }}" @if($value == $apoyo->lugar) selected @endif >{{ $value }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </form>
                                      </td>
                                      <td><!--{{ $apoyo->tarifa }}-->
                                        @if($apoyo->tarifa == 'BASICA PARCIAL')
                                            <a href="{{ url('apoyos', $apoyo->user_id ) }}/tarifa/parcial" class="btn btn-sm btn-success">PARCIAL</a>
                                        @else
                                            <a href="{{ url('apoyos', $apoyo->user_id ) }}/tarifa/total" class="btn btn-sm btn-warning">TOTAL</a>
                                        @endif
                                            
                                        
                                      </td>
                                      <td><!--{{ $apoyo->servicios }}-->
                                        <form action="../apoyos/{{ $apoyo->user_id }}/servicios" class="btn btn-sm btn-dange">
            
                                            <select onchange="this.form.submit()" name="numservicios" id="numservicios" class="btn btn-sm btn-dange">
            
                                                @foreach ($serviciosali as $key => $value)
                                                    {{ $value }}
                                                    <option value="{{ $value }}" @if($value == $apoyo->servicios) selected @endif >{{ $value }}</option>
                                                @endforeach
                                                
                                            </select>
                                        </form>
                                      </td>
                                      <td>
                                        @if($apoyo->reserva == null && $apoyo->estado == 1)
                                            <a href="{{ url('apoyos', $apoyo->user_id ) }}/reserva" class="btn btn-sm btn-info">Reservar</a>
                                        @elseif($apoyo->estado == 2)
                                            Inactivo
                                        @else
                                            {{ $apoyo->reserva }}
                                        @endif
                                      </td>
                                      <td>{{ $apoyo->corresponsabilidad }}</td>
                                      <td>{{ $apoyo->saldoAnterior }}</td>
                                      <td>{{ $apoyo->cantidadEntrada }}</td>
                                      <td>{{ $apoyo->cantidadSalida }}</td>
                                      <td>{{ $apoyo->saldo }}</td>
                                      <td>
                                        @if($apoyo->estado == 1)
                                            <a href="{{ url('apoyos', $apoyo->user_id ) }}/archivar" class="btn btn-sm btn-success">Desac.</a>
                                        @else
                                            <a href="{{ url('apoyos', $apoyo->user_id ) }}/restaurar" class="btn btn-sm btn-warning">Act.</a>
                                        @endif
                                            <a href="{{ url('apoyos', $apoyo->user_id ) }}/eliminar" class="btn btn-sm btn-danger">Elimin.</a>
            
                                      </td>
                                    </tr>
            
                                  
            
                                    @endforeach
                                  </tbody>
            
                                  
                                </table>
                                </div>
                        </div>

                       
                    
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
    {{ $apoyos->links('pagination::bootstrap-5') }}
</div>


<!--div class="row" style="height: 10px;">
    {{ $apoyos->links() }}
</div-->


@endsection


