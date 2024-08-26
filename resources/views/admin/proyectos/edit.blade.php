@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header">{{ __('Editar Proyectos') }}</div>

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

            <!--@if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif-->
            <form action="" method="POST">
                
                @csrf

                <div class="row mb-3">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name', $proyecto->name) }}" required autocomplete="name" autofocus>

                       
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="descripcion" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                    <div class="col-md-6">
                        <input id="descripcion" type="descripcion" class="form-control" name="descripcion" required value="{{ old('descripcion', $proyecto->descripcion) }}">

                        
                    </div>
                </div>


                <div class="row mb-3">
                    <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Fecha') }}</label>

                    <div class="col-md-6">
                        <input id="date" required type="date" class="form-control" name="date" value="{{ old('date', $proyecto->date) }}">

                      
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
         <br>

         <p><div class="row">
             <div class="col-md-6" style="border-style: solid; border-color: gray; border-radius: 5px;">
                <p>Gestionar las Categorías del Proyecto</p>
                <form action="{{ route('categorias') }}" method="POST">
                    @csrf
                  <div class="row">
                    <input type="hidden" name="project_id" value="{{ $proyecto->id }}">
                    <div class="col">
                      <input type="text" class="form-control" name="namecategoria" placeholder="Agregue una nueva Categoría">
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
                          <!--th scope="col">#</th-->
                          <th scope="col">Nombre</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($categories as $key => $category)
                        <tr>
                          <!--th scope="row">{{ $key+1 }}</th-->
                          <td>{{ $category->namecategoria }}</td>                                      
                          <td>
                              <!--Data-Category permite asignar un valor para accederlo posteriormente e implementar acciones con js-->

                              <button type="buttton" class="" tittle="Editar" data-category="{{ $category->id }}"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v4.png"/></button>
                              

                              <!--a href="proyectos/{{ $proyecto->id }}"class="btn-sm btn-info" data-category="{{ $category->id }}">Edi.</a-->

                              <!--a class="btn-sm btn-info" href="categoriasjson/{{ $proyecto->id }}/{{ $category->id }}">Editar</a-->

                              <!--Otra forma de llamar una ruta, uzando su nombre, y pasando un parámetro-->
                              <a href="{{ route('categoriaEliminar', $category->id) }}" class=""><img src="https://img.icons8.com/color/48/000000/delete-property.png"/></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
             </div>

             <div class="col-md-6" style="border-style: solid; border-color: gray; border-radius: 5px;">
                 <p>Gestionar Niveles</p>
                 <form action="{{ route('niveles') }}" method="POST">
                    @csrf
                  <div class="row">
                    <input type="hidden" name="project_id" value="{{ $proyecto->id }}">
                    <div class="col">
                      <input type="text" class="form-control" name="namenivel" placeholder="Ingrese Nivel">
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
                        <!-$key representa la posición en la que nos encontramos, para enumerar->
                        @foreach ($levels as $key => $level)
                        <tr>
                          <th scope="row">{{ $key+1 }}</th>
                          <td>{{ $level->namenivel }}</td>                                      
                          <td>
                            <!-Data-Level permite asignar un valor para accederlo posteriormente e implementar acciones con js->
                              <!--button type="button" class="btn btn-sm btn-info" data-level="{{ $level->id }}">Edi.</button-->
                              <button type="buttton" class="" tittle="Editar" data-level="{{ $level->id }}"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v4.png"/></button>
                              
                              <!-Otra forma de llamar una ruta, uzando su nombre, y pasando un parámetro->
                              <a href="{{ route('nivelesEliminar', $level->id) }}" class=""><img src="https://img.icons8.com/color/48/000000/delete-property.png"/></a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
             </div>

             
         </div>
         

        
    </div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalEditarCategoria">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Categoría</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ route('categoriaActualizar') }}" method="POST">
        @csrf
          <div class="modal-body">
            <input type="hidden" name="category_id" id="category_id" value="">
            <div class="form-group">
                <label for="namecategorianew">Categoría</label>
                <input type="text" class="form-control" name="namecategorianew" id="namecategorianew" value="">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>


<div class="modal" tabindex="-1" role="dialog" id="modalEditarNivel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Editar Nivel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
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
            <button type="submit" class="btn btn-primary">Guardar</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          </div>
      </form>
    </div>
  </div>
</div>
        
@endsection

@section('scripts')
    <script src="{{ url('public/js/admin/proyectos/edit.js') }}"></script>
@endsection
