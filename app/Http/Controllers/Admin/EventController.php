<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Event;
use App\Models\Activity;
use App\Models\Asistencia;
use App\Models\Lista;
use App\Models\Listaactividad;
use App\Models\Estado;
use Jenssegers\Agent\Agent;
use App\Models\Category;
use App\Models\Lugar;
use App\Models\Contarservicio;
use App\Models\Imgscreen;
use App\Models\User;
use App\Models\Persona;


use DB;
use PDF;

use App\Exports\AsistenciasExport;
//use App\Imports\AsistenciasExport;
use Maatwebsite\Excel\Facades\Excel;







class EventController extends Controller
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
        //use App\Models\Event;

        //Listando todos los proyectos incluidos los de ekiminación lógica
        //$proyectos = Project::withTrashed()->get();
        $agentEven = new Agent();
        //$eventos = Event::all();

        $eventos = DB::table('events')->where('estado_id', '1')->where('tipo_evento', '5')->orderBy('orden', 'DESC')->get();

        //$eventos = DB::table('events')->paginate(15);

        $categories = Category::all();

        //dd($eventos->all());
        
        return view('admin.eventos.index')->with(compact('eventos', 'categories', 'agentEven'));
    }

    

    public function eventosJsonAll()
    {
        
        $eventos = Event::all();
        //return response()->json($eventos);

        return response()->json([
            'success' => true,
            'status'=>200,
            'message' => 'eventosJson',
            'eventos'=>$eventos
        ]); 

         
         
    }

    public function editarEvento($id) 
    {
        $agent = new Agent();
        $evento = Event::find($id);
        //$proyectosUser = ProjectUser::where('user_id', $usuario->id)->get();
        //$proyectos = Project::all();
        //$proyectosUsuario = ProyectosUsuario::where('user_id', $id)->get();
        //$niveles = Level::where('id', $proyectosUser->project_id)->get();
        
    return view('admin.eventos.editar')->with(compact('evento', /*'agent'*/)); 
        //return response()->json($projects_users); 
    }

    public function eventoActualizar($id, Request $request) 
    {
        $reglas = [
            'evento' => ['required', 'max:255'],
            //'email' => ['required', 'email', 'max:255', 'unique:users'],
            //'password' => ['min:8']
        ];

        $errormensaje = [
            'evento.required' => 'Se necesita un evento para el registro.',
            'evento.max' => 'El evento no puede superar los 255 caracteres.',
            //'email.required' => 'Se necesita un email para el registro',
            //'email.email' => 'El email ingresado no es válido',
            //'email.max' => 'El email no puede superar los 255 caracteres.',
            //'email.unique' => 'El email ya se encuentra registrado',
            //'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            //'password.required' => 'Se necesita una contraseña para el registro.'
        ];

        $this->validate($request, $reglas, $errormensaje);

        $eventapp = Event::find($id);
        $eventapp->evento = $request->input('evento');

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $name = 'public/imagenes/slider/'.time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/slider/', $name);
            $eventapp->imagen = $name;
            
            $image_path = public_path().str_ireplace("public", "", $request->input('ruta'));
            unlink($image_path);

            
        }
        $eventapp->estado_id = $request->input('id_estado');
        $eventapp->save();

        
        //dd($image_path);
        return back()->with('notification', 'El evento se ha editado Correctamente'); 

        
    }

    public function eventoEliminar($id)
    {
        $evento = Event::find($id);

        $image_path = public_path().str_ireplace("public", "", $evento->imagen);
        
        if (@getimagesize($image_path)) {
            //echo "El archivo existe";
            unlink($image_path);
        }

        //dd($image_path);
        $evento->delete();
        return back()->with('notification', 'Evento Eliminado');
    }

    public function pantalla()
    {
        //use App\Models\Event;

        //Listando todos los proyectos incluidos los de ekiminación lógica
        //$proyectos = Project::withTrashed()->get();
        $agent = new Agent();
        //$eventos = Event::all();

        $eventos = DB::table('events')->where('estado_id', '2')->orderBy('orden', 'DESC')->get();

        //$eventos = DB::table('events')->paginate(15);

        //dd($eventos->all());
        
        return view('layouts.apppantalla')->with(compact('eventos'));
    }

    

    public function create()
    {
        return view('admin.eventos.create');
        /*if(\Auth::check()){

            $usuario = \Auth::user();{

                if ($usuario->id_tipo_usuario !=1 ) {
                    $eventos = Event::paginate(7);
                    return view('admin.eventos.create', compact('eventos'));
                } else {

                    
                }
            }
            
                
        }*/
    }

    public function store(Request $request) 
    {


        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $name = 'public/imagenes/slider/'.time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/slider/', $name);
        }


        $eventapp = new Event();
        $eventapp->evento = $request->input('evento');
        $eventapp->imagen = $name;
        $eventapp->estado_id = $request->input('id_estado');
        $eventapp->save();

        return back()->with('notification', 'El evento se ha Registrado Correctamente'); 


        
    }



    public function regAsistenciaView()
    {
    
        $usuario = \Auth::user();{

            

            if ($usuario) {
                if ($usuario->role == 0 || $usuario->role == 1) {
                    $eventos = Event::where('estado_id', '1')->orderBy('orden', 'DESC')->get();
                    $eventosall = Event::all();
                } else {
                    $eventos = Event::where('estado_id', '1')->where('area_id', $usuario->role)->orderBy('evento', 'ASC')->get();
                }
                return view('admin.eventos.regasistencia', compact('eventos'));
            } else {
                echo "No Inició Sesión";
                return redirect('login');
            }
        }        
        

        //$eventos = Event::where("estado_id","=",1)->get();
        //$agent = new Agent();
        //return view('admin.eventos.regasistencia', compact('eventos'));
        //return response()->json($agent);    
    }


    public function storeAsistencias(Request $request) 
    {

        

        $usuario = \Auth::user();{

            

            if ($usuario ) {

                //dd($usuario);

                $docid = $request->input('name');
                $evento = $request->input('evento');
                $activityid = $request->input('id_actividad');
                $fecha = $request->input('fechadb');

                $newDate = date("d/m/Y", strtotime($fecha));

                $regasistencia = new Asistencia();
                $regasistencia->email = $docid;
                $regasistencia->actividad = $evento;
                $regasistencia->user_id = $docid;
                $regasistencia->activity_id = $activityid;
                $regasistencia->fecha = $newDate;
                $regasistencia->metodoreg = $request->input('registro');

                
                $regasistencia->save();

                $horasco = DB::table('corresponsabilidads')
                    ->select(DB::raw('SUM(horas) as horasc'))
                    ->where('user_id', '=', $docid)
                    ->first();

                if ($horasco->horasc > 0) {
                    return back()->with('notification', 'Registro Correcto -> '.$request->input('name').' / Horas Corr: '.$horasco->horasc);
                } else {
                    return back()->with('notification', 'Registro Correcto -> '.$request->input('name'));
                }

                //return $horasco;
                

            } else {

                return back()->with('notification', 'No tiene permisos para ejecutar esta acción'); 
            }
        }


        


        
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



    public function get_activity_by_event($id)
    {

        $listado = Lista::all()->where('event_id', $id)->sortBy('fecha');//->whereDate('fecha', '>', date('Y-m-d')) 
        return view('admin.eventos.activityevent', compact('listado'));
        //return response()->json($listado);
    }

    

    public function get_detail_activity($id, Request $request)
    {

        $filtro = $request->get('fechaservicio');

        $newDate = date("d/m/Y", strtotime($filtro));

        $cuentaservicio = Contarservicio::all();
         
        $listado = Lista::where('activity_id', $id)->first(); 
        
        $evento = Event::where('id', $listado->event_id)->first();

        $persona = Persona::all();

        //return view('admin.eventos.detailactivity', compact('listado', 'evento', 'cuentaservicio', 'newDate', 'filtro'));
        return view('admin.eventos.regasistencias1', compact('listado', 'evento', 'cuentaservicio', 'newDate', 'filtro'));
        //dd($newDate);
        //return response()->json($listado);    
    }

    public function buscarEstamentos(Request $request){

        
 
        if($request->ajax()){
 
            $data=Persona::select('id', 'user_id', 'estamento')
            ->where('id','like','%'.$request->name.'%')
            ->orwhere('user_id','like','%'.$request->name.'%')
            ->orwhere('estamento','like','%'.$request->name.'%')->get();

            $output='';
            if(count($data)>0){
                $output ='
                    <table class="table table-hover" id="tablaEstamentos">
                    <thead>
                    <tr>
                        <th scope="col" style="">ID</th>
                        <th scope="col" style="">USER_ID</th>
                        <th scope="col" style="">ESTAMENTO</th>
                    </tr>
                    </thead>
                    <tbody>';
                        foreach($data as $row){
                            $output .='
                            <tr>
                            <td id="celdaid'.$row->id.'"onclick="runMe('.$row->id.');">'.$row->id.'</td>
                            <td id="celdanombre'.$row->id.'"onclick="runMe('.$row->id.');">'.$row->user_id.'</td>
                            <td id="celdaestamento'.$row->id.'"onclick="runMe('.$row->id.');" style="">'.$row->estamento.'</td>
                            <!--td class="btn btn-info" onclick="runMe('.$row->id.');">Seleccionar</td-->
                            </tr>
                            ';
                        }
                $output .= '
                    </tbody>
                    </table>';
            }
            else{
                $output .='NO ENCONTRADO';
            }
            return $output;
        }
        //return response()->json($data);
    }



    


    public function eventosjson()
    {
        
        $eventos = Event::all();
        //return response()->json($eventos);

        return response()->json(['eventos'=>$eventos]); 

         
         
    }

    public function asistenciasjson()
    {
        
        $eventos = Asistencia::all();
        //return response()->json($eventos);

        return response()->json(['eventos'=>$eventos]); 

         
         
    }


    public function actividadCreate()
    {

        //Llamado de datos desde el modelo
        $listado = Lista::all();
        //return view('admin.eventos.detailactivity', compact('listado'));

        //$actividades = Activity::all();
        
        $actividades = DB::table('activitys')
            ->join('events', 'events.id', '=', 'activitys.event_id')
            ->join('places', 'places.id', '=', 'activitys.place_id')
            ->join('estados', 'estados.id', '=', 'activitys.estado_id')
            ->select('activitys.*', 'events.evento', 'places.place', 'estados.estado', 'events.estado_id')
            ->where('activitys.estado_id', '=', 1)
            //->orderByRaw('events.evento')
            ->orderByDesc('activitys.estado_id')
            ->orderByDesc('activitys.fecha')
            ->paginate(7);
            //->get();

        //
        /*$usuario = \Auth::user();
        if ($usuario->id_tipo_usuario !=1) {
            $actividades  = Activity::paginate(7);
            return view('Actividad.index', compact('actividades'));
        }*/

        //dd($actividades->all());

        $nhorasc = array('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16');



        $eventos = Event::where("estado_id","=",1)->orderBy('evento')->get();
        $lugares = DB::table('places')->get();
        return view('admin.eventos.createactivity', compact('eventos', 'lugares', 'actividades', 'nhorasc'));
        //return response()->json($actividades);
    }

    public function actividadEdit($evid, $id) 
    {
        //$agent = new Agent();


        $actividad = Activity::find($id);
        //Pasando categorias y niveles a la vista
        //$eventos = Event::all();
        $lugares = DB::table('places')->get();
             
        $lugar = $actividad->lugar;
        $evento = Event::where('id', $evid)->first();
        //return response()->json($lugar);
        return view('admin.eventos.editactivity')->with(compact('actividad', 'lugares', 'evento', 'lugar'/*, 'levels', 'agent'¨*/)); 
    }

    public function actividadUpdate($id, Request $request) 
    {
        /*$reglas = [
            'name' => ['required', 'max:255'],
            //'email' => ['required', 'email', 'max:255', 'unique:users'],
            //'password' => ['min:8']
        ];

        $errormensaje = [
            'name.required' => 'Se necesita un nombre para el registro.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            //'email.required' => 'Se necesita un email para el registro',
            //'email.email' => 'El email ingresado no es válido',
            //'email.max' => 'El email no puede superar los 255 caracteres.',
            //'email.unique' => 'El email ya se encuentra registrado',
            //'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            //'password.required' => 'Se necesita una contraseña para el registro.'
        ];

        $this->validate($request, $reglas, $errormensaje);*/

        $actividad = Activity::find($id);
        //$actividad->event_id = $request->input('id_evento');
        $actividad->actividad = $request->input('actividad');
        if ($request->input('descripcion') == '') {
            $actividad->descripcion = 'Desarrollo de la actividad';
        } else {
            $actividad->descripcion = $request->input('descripcion');
        }
        $actividad->place_id = $request->input('id_lugar');
        $actividad->fecha = $request->input('fecha');
        $actividad->estado_id = $request->input('id_estado');
        $actividad->save();

        $eventos = Event::where("estado_id","=",1)->get();
        $lugares = DB::table('places')->get();
        //Llamado de datos desde el modelo
        $listactividades = Listaactividad::all();
        return view('admin.eventos.actividadeslista', compact('listactividades', 'eventos', 'lugares'));
        //return response()->json($listactividades);
    }


    public function actividadArchivar($id)
    {
        $actividad = Activity::find($id);
        $actividad->estado_id = 2;
        $actividad->save();
        
        return back()->with('notification', 'Actividad Archivada Correctamente');
    }

    public function actividadArchivarAPI(Request $request)
    {

        //$usuario = \Auth::user();

        $actividad = Activity::find($request->id);
        $actividad->estado_id = 2;
        $actividad->save();

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'Actividad Archivada'
        ]);

        /*if ($usuario) {

            
            
        } else {
            return response()->json(['message' => 'No Autorizado'], 401);
        }*/
        
      

        //$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
    }

    public function actividadRestaurar($id)
    {
        $actividad = Activity::find($id);
        $actividad->estado_id = 1;
        $actividad->save();
        
        return back()->with('notification', 'Actividad Restaurada Correctamente');
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

    public function actividadEliminar($id)
    {
        $actividad = Activity::find($id);
        $actividad->delete();
        return back()->with('notification', 'Asistencia Eliminada');
    }


    

    public function actividadStore(Request $request)
    {
        //
       

        $actividad = new Activity();
        $actividad->event_id = $request->input('id_evento');
        $actividad->actividad = $request->input('actividad');
        if ($request->input('descripcion') == '') {
            $actividad->descripcion = 'Desarrollo de la actividad';
        } else {
            $actividad->descripcion = $request->input('descripcion');
        }
        
        $actividad->place_id = $request->input('id_lugar');
        $actividad->fecha = $request->input('fecha');
        if ($request->input('horasc') == '') {
            $actividad->horasc = '0';
        } else {
            $actividad->horasc = $request->input('horasc');
        }
        
        $actividad->estado_id = $request->input('id_estado');
        $actividad->save();




        //dd($actividades->all());
       
        //$actividad = response()->json(['actividades'=>$actividades]);
        //$actividades = Activity::where("estado_id","=",1)->get();
        //$actividades = Lista::all();
        $eventos = Event::where("estado_id","=",1)->get();
        $lugares = DB::table('places')->get();
        return back()->with('notification', 'Actividad Registrada Correctamente');
        //return response()->json(['actividades'=>$actividades]);
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

    public function listaActividades()
    {
        $eventos = Event::where("estado_id","=",1)->get();
        $lugares = DB::table('places')->get();
        //Llamado de datos desde el modelo
        $listactividades = Listaactividad::orderBy("est_act_id", "desc")->orderBy("activity_id", "asc")->get();
        //$listactividades = DB::table('listaactividades')->orderBy('est_act_id', 'DESC')->get();
        return view('admin.eventos.actividadeslista', compact('listactividades', 'eventos', 'lugares'));
        //return response()->json($listactividades);
    }



    


    public function generatePDF(Request $request, $id)
    {

        //$asistencias = DB:://Asistencia::all();
        //$asistencias = DB::table('asistencias')->get();//->orderBy('created_at', 'desc')->first();
        
        $evento = Event::where('id', $id)->first();
        $nEvento = $evento->evento;

        $asistenciasreporte = DB::table('asistenciareporte')->where('evento', $nEvento)->get();
        $asistencias = DB::table('asistencias')->where('actividad', $nEvento)->get();
        view()->share('asistencias', $asistencias);
        view()->share('nEvento', $nEvento);
        view()->share('id', $id);

        //dd($asistenciasreporte->all());
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];
        if ($request->has('download')) {
            $pdf = PDF::loadView('asistenciaspdf');
            return $pdf->download('ejemplo.pdf');
        }
        //dd($asistencias->all());
        return view('asistenciaspdf')->with(compact('asistenciasreporte', 'asistencias', 'nEvento', 'id'));
        //$pdf = PDF::loadView('asistenciaspdf', $asistencias)->setPaper('letter', 'landscape');*/
        //return $pdf->download('itsolutionstuff.pdf');
    }




    public function pdfview(Request $request, $id)
    {

        //$asistencias = DB:://Asistencia::all();


        $asistencias = DB::table('asistencias')->where('actividad', $nEvento)->get();

       // $asistencias = DB::table('asistencias')->get();//->orderBy('created_at', 'desc')->first();
        
        $evento = Event::where('id', $id)->first();
        $nEvento = $evento->evento;

        view()->share('asistencias', $asistencias);
        view()->share('nEvento', $nEvento);
        view()->share('id', $id);
        

        //dd($nEvento);

        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y')
        ];

        if ($request->has('download')) {
            $pdf = PDF::loadView('asistenciaspdf')->setOptions(['defaultFont' => 'sans-serif']);
            return $pdf->download('ejemplo.pdf');
            //dd($request);
        }
          
        
        //return view('asistenciaspdf')->with(compact('asistencias', 'nEvento'));
        //$pdf = PDF::loadView('asistenciaspdf', $asistencias)->setPaper('letter', 'landscape');*/
        //return $pdf->download('itsolutionstuff.pdf');
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


    public function selectTipo($id, Request $request)
    {
        $evento = Event::find($id);
        $tipo = $request->input('lista-tipos');
        $evento->tipo_evento = $tipo;
        $evento->save();

        return redirect()->route('home');
    }

    public function cambiarCategoria($id, Request $request)
    {
        $evento = Event::find($id);
        $area = $request->input('lista-areas');
        $evento->area_id = $area;
        $evento->save();

        return redirect()->route('home');
    }

    

    public function selectHorasC($id, Request $request)
    {
        $actividad = Activity::find($id);
        $nhoras = $request->input('lista-horas');
        $actividad->horasc = $nhoras;
        $actividad->save();

        return back()->with('notification', 'Horas Asignadas Correctamente');
    }


    public function generatePDFActividad(Request $request, $id, $fecha)
    {

        //$asistencias = DB:://Asistencia::all();
        //$asistencias = DB::table('asistencias')->get();//->orderBy('created_at', 'desc')->first();
        
        $fechaConsulta = date("d/m/Y", strtotime($fecha));

        $asistenciasreporte = DB::table('asistenciareporte')->where('activity_id', $id)->get();
        $asistencia = DB::table('asistenciareporte')->where('activity_id', $id)->first();

        if ($asistencia == null) {
            return back();
        }

        
        //dd($asistencia);
        return view('asistenciaspdf')->with(compact('asistenciasreporte', 'asistencia'));
        //$pdf = PDF::loadView('asistenciaspdf', $asistencias)->setPaper('letter', 'landscape');*/
        //return $pdf->download('itsolutionstuff.pdf');
    }



    ///EventApiController Passport
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

        $eventosall = '';
        
        if ($request->role == 0 || $request->role == 1) {
            $eventos = Event::where('estado_id', '1')->orderBy('orden', 'DESC')->get();
            $eventosall = Event::all();
            $usuarios = User::where('idestado', '1')->orderBy('id', 'DESC')->get();
        } else {
            $usuarios = User::where('role', $request->role)->orderBy('id', 'ASC')->get();
            $eventos = Event::where('estado_id', '1')->where('area_id', $request->role)->orderBy('evento', 'ASC')->get();
        }

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'listaeventos',
            'eventosall' => $eventosall,
            'usuarios' => $usuarios,
            'posts' => $eventos,
            'lugares' => Lugar::all()
        ]);
        
    }

    public function espicialistasListar(Request $request){

        $eventosall = '';
        
        if ($request->role == 0 || $request->role == 1) {
            $usuarios = User::where('idestado', '1')->orderBy('id', 'DESC')->get();
            $eventosall = User::all();
        } else {
            $usuarios = User::where('role', $request->role)->orderBy('id', 'ASC')->get();
        }

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'listaeventos',
            'usuarios' => $usuarios,
            'eventosall' => $eventosall,
            'posts' => $usuarios,
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

    public function areasListar(Request $request){

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'listaareas',
            'areas' => Category::all()
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
        $actividad->horasc = $request->horasc;
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
            //'actividades' => DB::table('actividadesbyevent')->where('event_id',"=",$request->event_id)->get()
            
            'actividades' => DB::table('activitys')
            ->join('events', 'events.id', '=', 'activitys.event_id')
            ->join('places', 'places.id', '=', 'activitys.place_id')
            ->join('estados', 'estados.id', '=', 'activitys.estado_id')
            ->select('activitys.*', 'events.evento', 'places.place', 'estados.estado', 'events.estado_id')
            ->where('activitys.estado_id', '=', 1)
            ->where('activitys.fecha', '>=', now())
            ->where('event_id',"=",$request->event_id)
            ->orderByDesc('activitys.estado_id')
            ->orderBy('activitys.fecha')
            ->get()
        ]);
    }

    public function actividadXEvento($id)
    {
        return DB::table('activitys')
            ->join('events', 'events.id', '=', 'activitys.event_id')
            ->join('places', 'places.id', '=', 'activitys.place_id')
            ->join('estados', 'estados.id', '=', 'activitys.estado_id')
            ->select('activitys.*', 'events.evento', 'places.place', 'estados.estado', 'events.estado_id')
            ->where('activitys.estado_id', '=', 1)
            ->where('activitys.fecha', '>=', now())
            ->where('event_id',"=",$id)
            ->orderByDesc('activitys.estado_id')
            ->orderBy('activitys.fecha')
            ->get();
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

    public function contarServicios(Request $request){

        if ($request->fechafiltro && ($request->lugarapoyo != "")){
            $cuentaservicio = Contarservicio::where('fecha', $request->fechafiltro)
            ->where('lugar', $request->lugarapoyo)->get();
        }else if ($request->fechafiltro) {
            $cuentaservicio = Contarservicio::where('fecha', $request->fechafiltro)->get();
        } else {
            
        }
        
        /*if ($request->fechafiltro) {
            $cuentaservicio = Contarservicio::where('fecha', $request->fechafiltro)->get();
        } else {
            
        }*/

        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'cuentaservicios',
            'servicios' => $cuentaservicio
        ]);
    }


    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function indexAtril()
    {
        //$agentEven = new Agent();

        //$imgsatril = Imgscreen::all();
        $imgsatril = Imgscreen::orderBy('orden', 'ASC')->get();

        $listorden = array('1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16');

        $lists = [];
        foreach($imgsatril as $key => $value)
        {
            
            if ($value->orden != $listorden[$key]) {
                $lists[$key] = $key;
                //echo $value->orden;
                //array_splice($listorden, $key, 1);
            }
                
        }

        $array_num = count($imgsatril);
        for ($i = $array_num+1; $i < 20-$array_num; ++$i){
            $lists[$i] = $i;
        }

        //$listorden = DB::table('imgscreens')
          //              ->select('orden')
            //            ->orderBy('orden', 'ASC')
              //          ->get();
        
        //DB::table('events')->where('estado_id', '1')->where('tipo_evento', '5')->orderBy('orden', 'DESC')->get();

        //dd($eventos->all());

        //return response()->json($lists);
        
        return view('adminatril')->with(compact('imgsatril', 'listorden'));
    }

    

    public function cambiarEstadoImagenAtril($id) 
    {

        $imgscreen = Imgscreen::find($id);
        if ($imgscreen->estado == 1){
            $imgscreen->estado = 2;
        } else {
            $imgscreen->estado = 1;
        }

        $imgscreen->save();

        return back()->with('notification', 'El estado se editó Correctamente'); 
        
    }

    public function createImgAtril()
    {
        return view('admin.eventos.createimgatril');
        
    }

    public function storeImgAtril(Request $request) 
    {


        if ($request->hasFile('imagen')) {
            $file = $request->file('imagen');
            $name = 'public/imagenes/atril/'.time().$file->getClientOriginalName();
            $file->move(public_path().'/imagenes/atril/', $name);
        }


        $imgatrilnueva = new Imgscreen();
        $imgatrilnueva->imagen = $name;
        $imgatrilnueva->estado = $request->input('estado');;
        $imgatrilnueva->orden = $request->input('orden');
        $imgatrilnueva->save();

        return back()->with('notification', 'La imagen se subió Correctamente'); 


        
    }

    public function verAtril()
    {
        
        $imgsatril = Imgscreen::where('estado', '1')->orderBy('orden', 'ASC')->get();
        
        //DB::table('events')->where('estado_id', '1')->where('tipo_evento', '5')->orderBy('orden', 'DESC')->get();

        //dd($eventos->all());
        

        //return response()->json($imgsatril);
        
        return view('layouts.apppantalla')->with(compact('imgsatril'));

        //$eventos = DB::table('events')->where('estado_id', '1')->where('tipo_evento', '5')->orderBy('orden', 'DESC')->get();

        //$eventos = DB::table('events')->paginate(15);

        //dd($eventos->all());
        
    }

    

    
}
