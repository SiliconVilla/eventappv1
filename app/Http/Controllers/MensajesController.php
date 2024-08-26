<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensajes;

class MensajesController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){
        //dd($request->all());

        $reglas = [
            'mensaje' => 'required|min:5|max:255'
        ];

        $errormensaje = [
            'mensaje.required' => 'Escriba un mensaje...',
            'mensaje.min' => 'Al menos 5 caracteres',
            'mensaje.max' => 'Supera el máximo, 255, caracteres permitidos'
        ];

        $this->validate($request, $reglas, $errormensaje);

        $mensajes = new Mensajes();
        $mensajes->incident_id = $request->input('incidente_id');
        $mensajes->mensaje = $request->input('mensaje');
        $mensajes->cliente_id = auth()->user()->id;
        $mensajes->save();

        return back()->with('notification', 'Mensaje enviado Correctamente');
        

    }

    
    
    
}
