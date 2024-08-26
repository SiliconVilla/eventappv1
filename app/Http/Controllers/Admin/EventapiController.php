<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Activity;
use App\Models\Lugar;
use App\Models\Lista;
use App\Models\Contarservicio;
use DB;



class EventapiController extends Controller
{
    //
    public function eventoCrear(Request $request){

        $eventapp = new Event();
        $eventapp->evento = $request->nombreevento;
        $renombreimg = time().$request->imagenevento;
        //$imagenevento = "";
        if ($request->archivoimg != '') {
            $namebd = 'public/imagenes/slider/'.$renombreimg;
            file_put_contents(public_path().'/imagenes/slider/'.$renombreimg,base64_decode($request->archivoimg));
            //$archivoimg->move(public_path().'/imagenes/slider/', $name);
            $eventapp->imagen = $namebd;
                        
        }

        
        //$eventapp->imagen = $request->imagenevento;
        $eventapp->estado_id = $request->estadoid;
        $eventapp->save();
        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'eventoguardado',
            'post' => $eventapp
        ]);
    }

    public function eventosListar(Request $request){

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'listaeventos',
            'eventosall' => Event::all(),
            'posts' => Event::where('estado_id', '1')->where('tipo_evento', '5')->orderBy('orden', 'DESC')->get(),
            'lugares' => Lugar::all()
        ]);
    }

    public function lugaresListar(Request $request){

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'listalugares',
            'lugares' => Lugar::all(),
            'posts' => Event::all()
        ]);
    }


    public function actividadCrear(Request $request){

        $actividad = new Activity();
        $actividad->event_id = $request->id_evento;
        $actividad->actividad = $request->actividad;
        if ($request->descripcion == '') {
            $actividad->descripcion = 'Desarrollo de la actividad';
        } else {
            $actividad->descripcion = $request->descripcion;
        }
        
        $actividad->place_id = $request->id_lugar;
        $actividad->fecha = $request->fecha;
        $actividad->estado_id = $request->id_estado;
        $actividad->save();

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'actividadguardada',
            'post' => $actividad
        ]);
    }

    public function listaActividadesEvent(Request $request)
    {
        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'listaactividades',
            //'actividades' => Activity::where("event_id","=",$request->event_id)->get()
            'actividades' => DB::table('activitys')
            ->join('events', 'events.id', '=', 'activitys.event_id')
            ->join('places', 'places.id', '=', 'activitys.place_id')
            ->join('estados', 'estados.id', '=', 'activitys.estado_id')
            ->select('activitys.*', 'events.evento', 'places.place', 'estados.estado', 'events.estado_id')
            ->where('activitys.estado_id', '=', 1)
            ->where('event_id',"=",$request->event_id)
            ->orderByDesc('activitys.estado_id')
            ->orderByDesc('activitys.fecha')
            ->get()
        ]);
    }

    public function detalleActividad(Request $request)
    {

        $filtro = $request->get('fechaservicio');

        $newDate = date("d/m/Y", strtotime($filtro));

        $cuentaservicio = Contarservicio::all();
         
        //$listado = Lista::where('activity_id', $id)->first();
        $listado = Lista::where('activity_id', $request->actividad_id)->first();
        
        //$evento = Event::where('id', $listado->event_id)->first();
        $evento = Event::where('id', $request->event_id)->first();

        return view('admin.eventos.detailactivity', compact('listado', 'evento', 'cuentaservicio', 'newDate', 'filtro'));

        /*return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'detalleactividad',
            'listado' => Lista::where('activity_id', $request->actividad_id)->first(),
            'evento' => Event::where('id', $request->event_id)->first()
        ]);*/
    }

    
 

    
}


