@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Editar Categorias') }}</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
         
         <div class="panel-body">
            @if (session('notification'))
                <div class="alert alert-success">
                    <ul>
                        {{ session('notification') }}
                    </ul>
                </div>
            @endif

            
            <form action="" method="POST">
                
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Proyecto') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $category->project_id) }}" required autocomplete="name" autofocus disabled>

                       
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="namecategoria" class="col-md-4 col-form-label text-md-right">{{ __('Categoria') }}</label>

                    <div class="col-md-6">
                        <input id="namecategoria" type="namecategoria" class="form-control" name="namecategoria" required value="{{ old('namecategoria', $category->namecategoria) }}">

                        
                    </div>
                </div>


               

                <div class="row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="form-control btn btn-primary" style="background-color: blue;">
                            {{ __('Guardar Cambios') }}
                        </button>
                    </div>
                </div>

                
            </form>
         </div>
         <br>

         <p><div class="row" style="justify-content: center; text-align: center;">
            

             <div class="col-md-12" style="border-style: solid; border-color: gray; border-radius: 5px;">
                 <p>Gestionar los Niveles de la categoría</p>
                 <form action="{{ route('niveles') }}" method="POST">
                    @csrf
                  <div class="row">
                    <input type="hidden" name="project_id" value="{{ $category->project_id }}">
                    <div class="col">
                      <input type="text" class="form-control" name="namenivel" placeholder="Agregue un nuevo Nivel">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn-success form-control" style="background-color: green;">
                            {{ __('Guardar') }}
                        </button>
                    </div>
                  </div>
                </form>
                <br>
                 <table class="table">
                      <thead class="thead-dark">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Nivel</th>
                          <th scope="col">Opciones</th>
                          
                        </tr>
                      </thead>
                      <tbody>
                        <!--$key representa la posición en la que nos encontramos, para enumerar-->
                        @foreach ($levels as $key => $level)
                        <tr>
                          <th scope="row">{{ $key+1 }}</th>
                          <td>{{ $level->namenivel }}</td>                                      
                          <td>
                            <!--Data-Level permite asignar un valor para accederlo posteriormente e implementar acciones con js-->
                              <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#exampleModal" data-level="{{ $level->id }}">Edi.</button>
                              <!--Otra forma de llamar una ruta, uzando su nombre, y pasando un parámetro-->
                              <a href="{{ route('nivelesEliminar', $level->id) }}" class="btn btn-sm btn-danger">Eliminar</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
             </div>


              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                        
                      <h5 class="modal-title" id="exampleModalLabel">Editar Nivel</h5>
                      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      <!--button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">&times;</button-->
                    </div>
                    <div class="modal-body">
                      <div class="modal-content">
                     
                      
                        
                      </div>
                      <form action="{{ route('nivelesActualizar') }}" method="POST">
                        @csrf
                          <div class="modal-body">
                            <input type="hidden" name="level_id" id="level_id" value="">
                            <div class="form-group">
                                <label for="nameNivel">Nivel</label>
                                <input type="text" class="form-control" name="namenivelnew" id="namenivelnew" value="">
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                          </div>
                        
                      </form>
                    </div>
                
                   
                    
                  </div>
                </div>
              </div>

             
         </div>
         

        
    </div>
</div>


        
@endsection

@section('scripts')
    <script src="{{ url('public/js/admin/proyectos/edit.js') }}"></script>
@endsection
