@extends('layouts.app')

@section('content')

<style type="text/css">
    .w-5 {
        width: 7%;
    }

    .h-5 {
        width: 7%;
    }
    w-5 h-5
</style>


            <div class="card">
                <div class="card-header">{{ __('Encuestas de Satisfacción') }}</div>
                
                <div class="card-body">

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                     

                     

                    
                    <div class="container" id="contenedorSlider" style=" justify-content: center;">
                        <div class="row" style="justify-content: center;">


                    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSe59cZVNG48Ts2iQOvQRkJPK_iQxxtRRjaXL7KK00iGbDZq8A/viewform?embedded=true" width="700" height="1650" frameborder="0" marginheight="0" marginwidth="0">Cargando…</iframe>
                            

                        </div>  


                    </div>
                </div>
                <!--div>
                    <h2><a href="https://forms.gle/tjSm9MyvgJq38BEg9">Encuesta de Satisfacción Semana de Inducción</a></h2>
                </div-->
                <br>
               
                <br>
                <br>
                <br>


            </div>
        
@endsection
