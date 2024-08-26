@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header"><p>{{ __('Gestionar Reservas de Usuario') }}</p></div>

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

            
                <div class="row mb-3">
                  <div class="col-md-1"><a href="{{ url()->previous() }}" class="btn btn-primary">Regresar</a></div>
                

                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Usuario') }}</label>

                    <div class="col-md-6">
                        <input id="usuario" type="text" class="form-control" name="usuario" value="{{ old('user_id', $usuario->user_id) }}" required autocomplete="usuario" readonly autofocus>

                       
                    </div>
                </div>
         </div>

         <br>
         <br>

         <div class="row">
          <div class="col-md-12" style="border-style: solid; border-color: gray; border-radius: 5px;">
                
          <p><form action="{{ route('reservaUsuario') }}" method="POST">
                    <!--@csrf-->
                  <div class="row">
                    <input type="hidden" name="user_id" value="{{ $usuario->user_id }}">
                    <div class="col">
                      <input type="date" class="form-control" name="fechareserva" value="{{ date('Y-m-d') }}" min="2023-10-02" max="2023-10-06">
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
                          <th scope="col">Fecha</th>
                          <th scope="col">Opciones</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($reservations as $key => $reservation)
                        <tr>
                          <td>{{ $reservation->reserva }}</td>                                      
                          <td>
                              <!--Data-Category permite asignar un valor para accederlo posteriormente e implementar acciones con js-->

                              <button type="buttton" class="" tittle="Editar" data-category="{{ $reservation->id }}"><img src="https://img.icons8.com/ios-glyphs/30/000000/edit--v4.png"/></button>
                              

                              <!--Otra forma de llamar una ruta, uzando su nombre, y pasando un parámetro-->
                              <a href="{{ route('reservaEliminar', $reservation->id) }}" class=""><img src="https://img.icons8.com/color/48/000000/delete-property.png"/></a>
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



        
@endsection

@section('scripts')
    <script src="{{ url('public/js/admin/proyectos/edit.js') }}"></script>
@endsection
