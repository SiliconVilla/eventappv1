<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    //
    public function store(Request $request) 
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error
        $this->validate($request, [
            'namenivel' => 'required'
        ], [
            'namenivel.required' => 'Ingrese un nivel para guardar'
        ]);

        //$user = new Level();
        //Asignación de datos en masa, otra forma de guardar todo lo que se recibe en el request
        Level::create($request->all());

        return back()->with('notification', 'El nivel se ha Registrado Correctamente'); 
    }

    public function update(Request $request)
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error
        $this->validate($request, [
            'namenivelnew' => 'required'
        ], [
            'namenivelnew.required' => 'Ingrese una categoría para guardar'
        ]);

        
        $level_id = $request->input('level_id');
        $level = Level::find($level_id); 
        $level->namenivel = $request->input('namenivelnew');
        $level->save();

        return back()->with('notification', 'El Nivel se ha actualizado Correctamente'); 
    }

    public function delete($id) 
    {
        $nivel = Level::find($id);
        $nivel->delete();
        return back()->with('notification', 'Nivel Desactivado');
    }

    public function levelByProyecto($id)
    {
        return Level::where('project_id', $id)->get();
    }
}
