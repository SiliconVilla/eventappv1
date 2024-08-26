@extends('layouts.app')

@section('content')
<br>
<br>
<br>
            <div class="card">
                <div class="card-header">{{ __('Registrar Incidencia') }}</div>

                <div class="card-body">
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

                        
                     
                     <div class="panel-body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row justify-content-center">
                            <!-- src="https://siliconvilla.online/bunpalmira/private/jjcabezasm/jjcabezasm_1700858688.pdf
                            " width="50%" height="600">
                                    This browser does not support PDFs. Please download the PDF to view it: <a href="https://siliconvilla.online/bunpalmira/private/jjcabezasm/jjcabezasm_1700858688.pdf
                                    ">Download PDF</a>
                            </iframe>

                            <div class="row justify-content-center">
                                <div id="detail_div_a4">                      
                                     <embed src="https://siliconvilla.online/bunpalmira/private/jjcabezasm/jjcabezasm_1700858688.pdf" type="application/pdf" width="100%" height="600px">
                                 </div>
                           </div-->
                        </div>

                        <form action="" method="POST">
                            @csrf
                            
                            <label for="id">ID Incidencia</label>
                            <input type="text" name="id" id="id" value="{{ $incidentenext }}" readonly class="form-control"/>
                            <div class="form-group">
                                <label for="category_id">Área</label>
                                <select id="category_id" name="category_id" class="form-control">
                                    <option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Área de Bienestar</option>
                                    
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->namecategoria }}</option>
                                    @endforeach
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="tipo_id">Tipo</label>
                                <select id="tipo_id" name="tipo_id" class="form-control">
                                    <option value="" style="text-align: center  ;" class="justify-content-center">Seleccione Tipo</option>
                                    
                                    
                                </select>
                                
                            </div>

                            <div class="form-group">
                                <label for="severity">Importancia</label>
                                <select name="severity" class="form-control">

                                    <option value="Baja">Baja</option>
                                    <option value="Normal">Normal</option>
                                    <option value="Alta">Alta</option>

                                </select>
                            </div>
                            <divc class="form-group">
                                <label for="description">Descripción</label>
                                <textarea name="description" class="form-control">Este campo está en pruebas en este momento{{ old('description')}}</textarea> 
                            </div>
                            <div class="form-group" style="padding: 10px;">
                                <button type="submit" class="btn btn-primary">Registrar Incidencia</button>
                            </div>
                        </form>
                     </div>
                </div>
            </div>


            <div class="card" id="card_documentos" style="visibility: hidden;">
                <div class="card-header">{{ __('El trámite requiere documentos soporte') }}</div>

                <div class="card-body">


                    <div class="form-group row">
                        

                        <div class="row">
                            <form method="POST" action="{{ route('subirArchivo') }}" enctype="multipart/form-data">
                                @csrf

                                

                                <div class="form-group row">
                                
                                    @if (session('notificationArchivo'))
                                        <div class="alert alert-success">
                                            <ul>
                                                {{ session('notificationArchivo') }}
                                                <div class="form-group row">
                                                <a style="color: white;" class="btn btn-primary nav-link" href="{{ session('notificationArchivo') }}">Descargar</a>
                                                <label for="email" class="col-md-12 col-form-label text-md-right">Carta dirigida al Comité de Matrícula con la solicitud motivada y expresa:</label>

                                                <div class="col-md-12">
                                                    <input id="archivo" type="file" accept=".pdf" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}" name="archivo" value="{{ old('archivo') }}" required>

                                                    @if ($errors->has('archivo'))
                                                        <span class="invalid-feedback">
                                                            <strong>{{ $errors->first('archivo') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                </div>
                                            </ul>
                                        </div>
                                    @else
                                    <div class="form-group row">
                                    <label for="email" class="col-md-12 col-form-label text-md-right">Carta dirigida al Comité de Matrícula con la solicitud motivada y expresa:</label>

                                    <div class="col-md-12">
                                        <input id="archivo" type="file" accept=".pdf" class="form-control{{ $errors->has('archivo') ? ' is-invalid' : '' }}" name="archivo" value="{{ old('archivo') }}" required>

                                        @if ($errors->has('archivo'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('archivo') }}</strong>
                                            </span>
                                        @endif
                                    </div>
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
                                    
                                </div>

                                


                                <div class="form-group row mb-0">
                                    <div class="col-md-12 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            Cargar
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                      
                    </div>
                
                </div>

                </div>
            </div>
        
@endsection
