<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class RegistrosappController extends Controller
{
    public function getUserAsistencia(Request $request)
    {
       
        $queryUserAsis = DB::table('asistencias')
            ->where('email', $request->email)
            ->where('actividad', $request->actividad)
            ->where('activity_id', $request->activity_id)
            ->get();
        
        if ($queryUserAsis->isEmpty()) {

            return response()->json([
                'status'=>204,
                'success' => true,
                'message' => 'NO Existe Asistencia'
            ]);
            
        } else {
            return response()->json([
                'status'=>200,
                'message' => 'Ya Registrado',
                'asistencia' => $queryUserAsis
            ]);
        }
        
      

        //$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
    }
}
