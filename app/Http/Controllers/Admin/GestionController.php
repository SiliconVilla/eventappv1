<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Apoyo;
use App\Models\Aposyosfull;
use App\Models\Asistencia;
use App\Models\Lista;
use App\Models\Estado;
use App\Models\Contarservicio;
use App\Models\Reservation;
use App\Models\Apoyosaldo;

use Jenssegers\Agent\Agent;


use DB;
use PDF;

use App\Exports\CorresponsabilidadExport;
use App\Exports\ApoyosfullExport;


use App\Exports\AsistenciasExport;
//use App\Imports\AsistenciasExport;
use Maatwebsite\Excel\Facades\Excel;







class GestionController extends Controller
{
    //
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index()
    {
        
    }
    

    public function create()
    {
       
    }

    public function store(Request $request) 
    {


        
    }



    
    public function cambiarEstadoEvento($id) 
    {

        $evento = Event::find($id);
        if ($evento->estado_id == 1){
            $evento->estado_id = 2;
        } else {
            $evento->estado_id = 1;
        }

        $evento->save();

        DB::statement("UPDATE activitys SET activitys.estado_id = 2 where activitys.event_id = $id");


        return back()->with('notification', 'El evento se editó Correctamente'); 


        
    }



    


    public function eventosjson()
    {
        
        $eventos = Event::all();
        //return response()->json($eventos);

        return response()->json(['eventos'=>$eventos]); 

         
         
    }

    


    public function apoyosCreate(Request $request)
    {

        //Llamado de datos desde el modelo
        //$apoyos = Apoyo::orderBy("user_id", "ASC")->orderBy("estado", "ASC")->get();
        //$apoyos = Apoyo::orderBy("estado", "ASC")->get();

        /*$actividades = DB::table('activitys')
            ->join('events', 'events.id', '=', 'activitys.event_id')
            ->join('places', 'places.id', '=', 'activitys.place_id')
            ->join('estados', 'estados.id', '=', 'activitys.estado_id')
            ->select('activitys.*', 'events.evento', 'places.place', 'estados.estado', 'events.estado_id')
            ->where('activitys.estado_id', '=', 1)
            //->orderByRaw('events.evento')
            ->orderByRaw('activitys.estado_id')
            ->orderByRaw('activitys.fecha')
            ->get();

        //*/

        $serviciosali = array('0','1','2','3','4','5');
        $cafeterias = array('Sin Asignar','Centro de Producción','Cafetería Central');

        
        
        

        $filtro = $request->get('buscarpor');

        /*if ($filtro) {
            # code...
            $apoyos = DB::table('apoyos')
            ->join('apoyo_saldo', 'apoyos.user_id', '=', 'apoyo_saldo.user_id')
            //->join('places', 'places.id', '=', 'activitys.place_id')
            //->join('estados', 'estados.id', '=', 'activitys.estado_id')
            ->select('apoyos.*', 'apoyo_saldo.saldoAnterior', 'apoyo_saldo.cantidadEntrada', 'apoyo_saldo.cantidadSalida', 'apoyo_saldo.saldo', 'apoyo_saldo.created_at', 'apoyo_saldo.updated_at')
            ->where('apoyos.user_id', 'like', "%$filtro%")->orderBy('estado', 'ASC')
            //->orderByRaw('events.evento')
            //->orderByRaw('activitys.estado_id')
            //->orderByRaw('activitys.fecha')
            ->get();
        } else {
            $apoyos = DB::table('apoyos')
            ->join('apoyo_saldo', 'apoyo_saldo.user_id', '=', 'apoyos.user_id')
            //->join('prodinventory', 'prodinventory.id', '=', 'order_prodinventory.product_id')
            ->select('apoyos.*', 'apoyo_saldo.saldoAnterior', 'apoyo_saldo.cantidadEntrada', 'apoyo_saldo.cantidadSalida', 'apoyo_saldo.saldo', 'apoyo_saldo.created_at', 'apoyo_saldo.updated_at')->get();

            //$apoyos = Apoyo::where('user_id', 'like', "%$filtro%")->orderBy('estado', 'ASC')->get();
        }*/

        $apoyos = Apoyo::where('id', 'like', "%$filtro%")->orderBy('estado', 'ASC')->paginate(10)/*->get()*/;
        //dd($apoyos);
        //$apoyos = Aposyosfull::where('user_id', 'like', "%$filtro%")->orderBy('estado', 'ASC')->get();

        //$apoyos = DB::table('aposyosfull')->get();
        
        return view('areas.gestion.apoyos', compact('apoyos', 'filtro', 'serviciosali', 'cafeterias'));
        //return response()->json($apoyos);
    }

    public function apoyoArchivar($id)
    {
        $apoyo = Apoyo::find($id);
        $apoyo->estado = 2;
        $apoyo->reserva = null;
        $apoyo->save();
        
        return back()->with('notification', 'Apoyo Desactivado Correctamente');
    }

    public function apoyoRestaurar($id)
    {
        $apoyo = Apoyo::find($id);
        $apoyo->estado = 1;
        $apoyo->save();
        
        return back()->with('notification', 'Apoyo Activado Correctamente');
    }

    public function activarReserva($id)
    {
        $apoyo = Apoyo::find($id);
        $apoyo->reserva = 'SI';
        $apoyo->save();
        
        return back()->with('notification', 'Reserva Activada Correctamente');
    }

    public function cambiarTarifa($user_id, $tarifa)
    {
        $apoyo = Apoyo::find($user_id);
        if ($tarifa == 'parcial') {
            $apoyo->tarifa  = 'BASICA TOTAL';
            
        } else if ($tarifa == 'total') {
            $apoyo->tarifa  = 'BASICA PARCIAL';
        }

        $apoyo->save();

        
        
        return back()->with('notification', 'Reserva Activada Correctamente');
    }

    ///PENDIENte
    public function actividadAsistencia()
    {
        //Llamado de datos desde el modelo
        $listado = Lista::all();
        //return view('admin.eventos.detailactivity', compact('listado'));

        $actividades = Activity::all();
        

        //
        /*$usuario = \Auth::user();
        if ($usuario->id_tipo_usuario !=1) {
            $actividades  = Activity::paginate(7);
            return view('Actividad.index', compact('actividades'));
        }*/
        $eventos = Event::where("estado_id","=",1)->get();
        $lugares = DB::table('places')->get();
        return view('admin.eventos.createactivity', compact('eventos', 'lugares', 'actividades'));
    }

    public function apoyoEliminar($id)
    {
        $apoyo = Apoyo::find($id);
        $apoyo->delete();
        return back()->with('notification', 'Apoyo Eliminado');
    }


    

    public function apoyoStore(Request $request)
    {
        //
       

        $apoyo = new Apoyo();
        $apoyo->id = $request->input('user_id');
        $apoyo->apoyo = $request->input('id_apoyo');
        $apoyo->tarifa = $request->input('tarifa');
        /*if ($request->input('descripcion') == '') {
            $actividad->descripcion = 'Desarrollo de la actividad';
        } else {
            $actividad->descripcion = $request->input('descripcion');
        }*/
        
        $apoyo->estado = $request->input('id_estado');
        $apoyo->save();





       
        //$actividad = response()->json(['actividades'=>$actividades]);
        //$actividades = Activity::where("estado_id","=",1)->get();
        //$actividades = Lista::all();
        //$eventos = Event::where("estado_id","=",1)->get();
        //$lugares = DB::table('places')->get();
        return back()->with('notification', 'Apoyo Asignado Correctamente');
        //return response()->json(['actividades'=>$actividades]);
    }

    public function apoyoReservar(Request $request)
    {
        
        //return $request->input('category_id');

        /*$reglas = [
            'severity' => 'required|in:Baja,Normal,Alta',
            'description' => 'required|min:15',
            'category_id' => 'required|exists:categories,id',
            'tipo_id' => 'required'
        ];

        $errormensaje = [
            'category_id.exists' => 'La categoría seleccionada no existe.',
            'description.required' => 'Ingrese una descrición para la incidencia',
            'description.min' => 'La descripción debe contener mas de 15 caracteres'
        ];

        $this->validate($request, $reglas, $errormensaje);*/

        //$apoyo = DB::table('apoyos')
        //->where('apoyos.user_id','=', $request->user_id)->first();

        //$apoyo = Apoyo::firstOrFail()->where('user_id', $request->user_id);
        $apoyo = Apoyo::where('user_id', $request->user_id)->first();

        $apoyo->reserva = json_encode($request->fechareserva);
        $apoyo->save();
        

        //dd($apoyo);
        return back()->with('notification', 'Reservas Asignadas Correctamente');

       

       

    }
    

    public function selectServicios($id, Request $request)
    {

        
        $nservicios = $request->input('numservicios');

        $apoyo = Apoyo::find($id);
        $apoyo->servicios = $nservicios;
        $apoyo->save();

        return back()->with('notification', 'Servicios Asignados Correctamente');
    }

    public function selectCafeteria($id, Request $request)
    {

        
        $nlugar = $request->input('lugarapoyo');

        $apoyo = Apoyo::find($id);
        $apoyo->lugar = $nlugar;
        $apoyo->save();

        return back()->with('notification', 'Cafetería Asignada Correctamente');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexActividades()
    {
        //Llamado de datos desde el modelo
        $actividades = Lista::all();
        return view('admin.eventos.actividadeslista', compact('actividades'));
    }



    



    /**
    * @return \Illuminate\Support\Collection
    */
    public function export() 
    {
        $fecha = date('Y-m-d_H:i:s');
        return Excel::download(new AsistenciasExport, 'Export_Actividades'.$fecha.'.xlsx');
    }
       
    /*
    * @return \Illuminate\Support\Collection
    
    public function import() 
    {
        Excel::import(new AsistenciasExport,request()->file('file'));
               
        return back();
    }*/



    public function contarServicios(){

        $cuentaservicio = Contarservicio::all();

        return response()->json($cuentaservicio);
    }

    public function asistenciasIndex(Request $request)
    {


        $filtro = $request->get('buscarpor');

        $filtrofecha = $request->get('buscarfecha');

        $fechaConsulta = date("d/m/Y", strtotime($filtrofecha));

        //dd($filtrofecha);

        if ($filtro != null && $filtrofecha != null) {
            $silinks = "SI";
            $asistencias = Asistencia::where('user_id', 'like', "%$filtro%")->where('actividad', 'Gestión Alimentaria')->orderBy('fecha', 'DESC')->get();//paginate(15);
            //$asistencias = Asistencia::where('user_id', 'like', "%$filtro%")->orderBy('fecha', 'DESC')->paginate(15);
        } else {
            $silinks = "NO";
            $asistencias = Asistencia::where('user_id', 'like', "%$filtro%")->where('fecha', 'like', "%$fechaConsulta%")->where('actividad', 'Gestión Alimentaria')->orderBy('fecha', 'ASC')->/*get();*/paginate(15);
            //$asistencias = Asistencia::where('user_id', 'like', "%$filtro%")->orderBy('fecha', 'DESC')->paginate(15);
            
            //->paginate(15); remplaza a -get();
        }
        
        
        
        return view('areas.gestion.asistencias', compact('asistencias', 'filtro', 'silinks'));
        //return response()->json($asistencias);
    }

    public function asistenciaEliminar($id)
    {
        $asistencia = Asistencia::find($id);
        $asistencia->delete();
        return back()->with('notification', 'Asistencia Eliminada');
    }

    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportCorrespon() 
    {
        $fecha = date('Y-m-d_H:i:s');
        return Excel::download(new CorresponsabilidadExport, 'Export_Correspnsabilidad'.$fecha.'.xlsx');
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function exportApoyosFull() 
    {
        $fecha = date('Y-m-d_H:i:s');
        return Excel::download(new ApoyosfullExport, 'Export_ApoyosFull_Corr'.$fecha.'.xlsx');
    }


    public function editarApoyo(Request $request) 
    {
        $agent = new Agent();

        
        if ($request->apiandroid) {
            $queryReservas = DB::table('reservations')->where('reservations.user_id', $request->id)->get();
        
            if (!$queryReservas->isEmpty()) {

                return response()->json([
                    'status'=>200,
                    'success' => true,
                    'message' => 'OK Reservas Usuario',
                    'reservas' => $queryReservas
                ]);
                
            } else {
                return response()->json(['message' => 'SIN RESERVAS'], 401);
            }
        } else {

            $user = auth()->user();
           
            $apoyo = Apoyo::find($request->id);

            if ($user->es_admin) {
                $apoyosaldo = Apoyosaldo::where('user_id', '=', $apoyo->user_id)->orderBy('id','DESC')->paginate(7);
                # code...
            } else {
                $apoyosaldo = Apoyosaldo::where('user_id', '=', $apoyo->user_id)->orderBy('id','DESC')->paginate(7);
            }
            //$apoyosaldo = Apoyosaldo::where('user_id', '=', $apoyo->user_id)->orderBy('created_at','DESC')->paginate(7);
            
            //dd($apoyosaldo);
            //$apoyosaldo = $apoyo->saldos;
            //->where('actividad', 'Gestión Alimentaria')->orderBy('fecha', 'ASC')->get()
            //Pasando reservas a la vista
            $reservations = $apoyo->reservaciones;
            //return response()->json($apoyosaldo);
            return view('areas.gestion.apoyosedit')->with(compact('apoyo', 'reservations', 'apoyosaldo')); 
        }

        
    }

    public function saldoEliminar($id)
    {
        $actividad = Apoyosaldo::find($id);
        $actividad->delete();
        return back()->with('notification', 'Saldo Eliminado');
    }

    //
    public function reservaUsuario(Request $request) 
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error        

        if ($request->apiandroid) {
            $fechaString = $request->get('fechareserva');
            $newFechaReserva = date("d/m/Y", strtotime($fechaString));

            $reserva = new Reservation();
            $reserva->user_id = $request->user_id;
            $reserva->reserva = $request->reserva;
            $reserva->save();

            return response()->json([
                'status'=>200,
                'success' => true,
                'message' => 'reservaguardada',
                'post' => $reserva
            ]);
        } else {

            $fechaString = $request->get('fechareserva');
            
            if(is_array($fechaString)) { 
                echo "Array"; 
                //dd($fechaString[0]);
                //$newFechaReserva = date("d/m/Y", strtotime($fechaString[0]));

                for ($i=0; $i < count($fechaString); $i++) { 
                    $reserva = new Reservation();
                    $reserva->user_id = $request->input('user_id');
                    $reserva->reserva = $fechaString[$i];
                    $reserva->save();    

                    /*$apoyosaldo = new Apoyosaldo();
                    $apoyosaldo->user_id = $request->input('user_id');
                    $apoyosaldo->cantidadEntrada = -3000;
                    $apoyosaldo->save();*/

                    

                }
                
            } else { 

                $fechaString = $request->input('fechareserva');

                if ($fechaString != null) {
                    $newFechaReserva = date("d/m/Y", strtotime($fechaString));

                    $reserva = new Reservation();
                    $reserva->user_id = $request->input('user_id');
                    $reserva->reserva = $newFechaReserva;
                    $reserva->save();  

                    //dd($reserva);

                    //$saldoentrada = $request->get('saldoentrada');
                    $saldoentrada = -3000;

                    /*$apoyosaldo = new Apoyosaldo();
                    $apoyosaldo->user_id = $request->input('user_id');
                    $apoyosaldo->cantidadEntrada = $saldoentrada;
                    $apoyosaldo->save();*/

                    return back()->with('notification', 'La Reserva se asignó Correctamente');
                }

                return back()->with('notification', 'No Modificado');
                 
            }
           
            

            
    
            return back()->with('notification', 'La Reserva se asignó Correctamente');
        }
        
    }

    public function saldoAprobar(Request $request) 
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error        

        if ($request->apiandroid) {
            $fechaString = $request->get('fechareserva');
            $newFechaReserva = date("d/m/Y", strtotime($fechaString));

            $reserva = new Reservation();
            $reserva->user_id = $request->user_id;
            $reserva->reserva = $request->reserva;
            $reserva->save();

            return response()->json([
                'status'=>200,
                'success' => true,
                'message' => 'reservaguardada',
                'post' => $reserva
            ]);
        } else {

            

            $idApoyo = $request->id;
            //$apoyosaldo = Apoyosaldo::where('id', '=', $idApoyo);
            $apoyosaldo = Apoyosaldo::find($idApoyo);

            if ($apoyosaldo != null) {
                $apoyosaldo->soportepago = 'APROBADO';
                $apoyosaldo->save();

                //dd($apoyosaldo);

                return back()->with('notification', 'SALDO aprobado Correctamente');
            }           
    
            //return back()->with('notification', 'La Reserva se asignó Correctamente');
        }
        
    }

    

    public function buscarDiaReserva(Request $request){

        
 
        if($request->ajax()){
 
           /* $data=User::select('id', 'name', 'documento', 'telefono', 'email')
            ->where('id','like','%'.$request->namepaciente.'%')
            ->orwhere('name','like','%'.$request->namepaciente.'%')
            ->orwhere('email','like','%'.$request->namepaciente.'%')->get();*/

            $data = Reservation::
                    //join('institution_user', 'institution_user.id_user', '=', 'users.id')->
                    //join('institutions', 'institutions.id', '=', 'institution_user.id_institution')
                    //->select('users.id', 'users.name', 'users.documento', 'users.telefono', 'users.email', 'institution_user.id_institution', 'institutions.name  as nomempresa')
                    where('user_id', '=', $request->usuario)
                    ->where('reserva','=', $request->diareserva)
                    ->get();

                    
            
            

            
            if (!$data->isEmpty()) {
                $response = [
                    'status'=>'ok',
                    'success'=>true,
                    'reserva'=>$request->diareserva,
                    'message'=>'!'
                ];
            } else {
                $response = [
                    'status'=>'ok',
                    'success'=>false,
                    'message'=>'NO!'
                ];
            }

            return $response;

            //dd($data);

            /*$data=User::where('id','like','%'.$request->search.'%')
            ->orwhere('name','like','%'.$request->search.'%')
            ->orwhere('email','like','%'.$request->search.'%')->get();*/
 
            
        }
        //return response()->json($data);
    }

    public function saldoUsuario(Request $request) 
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error        

        if ($request->apiandroid) {
            $fechaString = $request->get('fechareserva');
            $newFechaReserva = date("d/m/Y", strtotime($fechaString));

            $reserva = new Reservation();
            $reserva->user_id = $request->user_id;
            $reserva->reserva = $request->reserva;
            $reserva->save();

            return response()->json([
                'status'=>200,
                'success' => true,
                'message' => 'reservaguardada',
                'post' => $reserva
            ]);
        } else {

            

            $user = auth()->user();
            $saldoentrada = $request->get('saldoentrada');

            $apoyosaldo = new Apoyosaldo();

            if ($user->es_admin) {
                $apoyosaldo->soportepago = 'APROBADO';
            }
            $apoyosaldo->user_id = $request->user_id;
            $apoyosaldo->cantidadEntrada = $saldoentrada;
            $apoyosaldo->save();
    
            return back()->with('notification', 'Saldo cargado Correctamente');

            
            
        }
        
    }


    public function reservaEliminar($id)
    {
        $reserva = Reservation::find($id);
        $reserva->delete();
        return back()->with('notification', 'Reserva Eliminada');
    }


   
      

}
