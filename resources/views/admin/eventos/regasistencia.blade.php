@extends('layouts.app')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
<script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>


@section('content')

<div class="card">
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

    <br>
    <div class="card-header">{{ __('Eventos') }}</div>

    <div class="row">
    @foreach ($eventos as $item)
        
        <div class="col-md-3">
            <a href="{{ url('actividad_evento') }}/{{$item->id}}">
                <div class="card">
                    <div class="card-header">{{ $item->id }}</div>
                    <div class="card-body">
                        {{ $item->evento }}
                        <img style="width: 100%;" src="{{ $item->imagen }}" alt="" />
                    </div>
                </div>
                <br>
            </a>
        </div>        
        
    @endforeach 
    </div>

    
</div>



<hr>

        
@endsection            