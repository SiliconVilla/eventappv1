<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Incident;
use App\Models\Event;
use App\Models\Project;
use App\Models\ProjectUser;
use App\Models\Estincident;
use App\Models\Mensajes;
use App\Models\Prestamos;
use Jenssegers\Agent\Agent;
use App\Models\Contact;
use Mail;
use App\Models\Inventory;
use App\Models\Order;
use App\Models\Persona;
use App\Models\Imgscreen;
use App\Models\Appoinment;
use App\Models\Apoyo;
use App\Models\Apoyosaldo;

use DB;

use SimpleSoftwareIO\QrCode\Facades\QrCode;



class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //use App\Models\Event;

        //Listando todos los proyectos incluidos los de ekiminación lógica
        //$proyectos = Project::withTrashed()->get();
        $user = auth()->user();
        $user_id = $user->id;

        dd($user);

        $arrayalmuerzos = array();
        
       


        $apoyo = Apoyo::find($user->id);

      
        
        
        if (($apoyo != null || $apoyo !='')) {
            
            $apoyosaldo = Apoyosaldo::where('user_id', '=', $apoyo->id)->orderBy('id','DESC')->paginate(7);

            
            

           $reservasusuario = DB::table('reservations')
            ->select('id','reserva')
            ->where('reservations.user_id','=', $user->documento)->get();

        
            
            $fechaAlimnArrDif = ['20/08/2024','21/08/2024','22/08/2024','23/08/2024','24/08/2024','25/08/2024','26/08/2024','27/08/2024','28/08/2024','29/08/2024','30/08/2024'];

            $arrayConReservas = array();
            for ($i=0; $i < count($reservasusuario); $i++) { 
                $arrayConReservas[$i] = $reservasusuario[$i]->reserva;
            }




            $fechasApoyoAlimentario = array_values(array_diff($fechaAlimnArrDif, $arrayConReservas));
        
            
            $cantiAlmuerzos = number_format(($apoyo->saldo/3000), 02, '.', '');

            $enteroAlmuerzos = explode(".",$cantiAlmuerzos);
            $entero1 =$enteroAlmuerzos[0];

            

            for ($i=0; $i < $cantiAlmuerzos; $i++) { 
                $arrayalmuerzos[$i] = $i+1;
            }
        }

        
    
        $roleasignado = DB::table('levels')
            ->join('project_user', 'project_user.level_id', '=', 'levels.id')
            ->join('users', 'users.id', '=', 'project_user.user_id')
            ->select('levels.namenivel')
            ->where('project_user.user_id','=', $user->id)->first();


        $agent = new Agent();
    

        $eventos = Event::query()
            ->orderBy('estado_id', 'ASC')
            ->orderBy('evento', 'ASC')
            ->paginate(7);
        $prestamos = Prestamos::all();
    
        $incidentes = Incident::withTrashed()->paginate(5);
        $categories = Category::all();
        $servicios_solicitados = Incident::where('cliente_id', auth()->user()->id)->where('project_id', $user->seleccionar_proyecto_id)->get();
        
        if($user->seleccionar_proyecto_id === null){
            $proyecto_seleccionado = 1;    
        } else {
            $proyecto_seleccionado = $user->seleccionar_proyecto_id;
        }
        
        $user->qrcode = Hash::make($user->email); 

        
        if($user->role == 1){
            

            $mis_servicios = Incident::where('project_id', $user->seleccionar_proyecto_id)->where('soporte_id', $user->id)->get();

            $projectUsuario = ProjectUser::where('project_id', $user->seleccionar_proyecto_id)->where('user_id', $user->id)->first();

         
            $user->save();
        
            if (isset($projectUsuario)) {
                $servicios_pendientes = Incident::where('soporte_id', NULL)->where('level_id', $projectUsuario->level_id)->get();
            }
            
           
                

            if(isset($mis_servicios)){
                if(isset($servicios_pendientes)){
                    return view('admin.inventarios.jefebodega')->with(compact('eventos', 'incidentes', 'mis_servicios', 'categories', 'servicios_pendientes', 'servicios_solicitados', 'prestamos', 'roleasignado', 'inventarios', 'countinventarios', 'ordenes'));
                
                }
        
            }
          
            $user->save();
            $rol = $roleasignado->namenivel;
            return view('admin.inventarios.jefebodega')->with(compact('eventos', 'categories', 'servicios_solicitados', 'incidentes', 'roleasignado', 'rol',  'inventarios', 'countinventarios', 'ordenes'));

        
        } else if($user->role == 2){


            $mis_servicios = Incident::where('project_id', $user->seleccionar_proyecto_id)->where('soporte_id', $user->id)->get();

            $projectUsuario = ProjectUser::where('project_id', $user->seleccionar_proyecto_id)->where('user_id', $user->id)->first();

         
            $user->save();

            
        
            if (isset($projectUsuario)) {
                $servicios_pendientes = Incident::where('soporte_id', NULL)->where('level_id', $projectUsuario->level_id)->get();
            } else {
                $servicios_pendientes = array();
            }
           
                
            $apoyosaldoVerificar = Apoyosaldo::where('id', '=', $user->id)->orderBy('created_at','DESC')->paginate(7);
            if ($apoyo) {
                return view('home')->with(compact('eventos', 'incidentes', 'agent', 'mis_servicios', 'categories', 'servicios_pendientes', 'servicios_solicitados', 'prestamos', 'roleasignado', 'apoyo', 'cantiAlmuerzos', 'arrayalmuerzos', 'fechasApoyoAlimentario', 'reservasusuario', 'entero1','fechaAlimnArrDif','apoyosaldo'));
            } else {
                return view('home')->with(compact('eventos', 'incidentes', 'agent', 'mis_servicios', 'categories', 'servicios_pendientes', 'servicios_solicitados', 'prestamos', 'roleasignado'));
            }
            
            
          
        
            $user->save();
            return view('home')->with(compact('eventos', 'agent', 'categories', 'servicios_solicitados', 'incidentes','reservasusuario','fechasApoyoAlimentario','apoyo','entero1','fechaAlimnArrDif','apoyosaldo',$user->id));
        
        } else {
            $mis_servicios = Incident::where('project_id', $user->seleccionar_proyecto_id)->where('soporte_id', $user->id)->get();

            $projectUsuario = ProjectUser::where('project_id', $user->seleccionar_proyecto_id)->where('user_id', $user->id)->first();

         
            $user->save();
        
            if (isset($projectUsuario)) {
                $servicios_pendientes = Incident::where('soporte_id', NULL)->where('level_id', $projectUsuario->level_id)->get();
            }
            
           
                

            if(isset($mis_servicios)){
                if(isset($servicios_pendientes)){
                    return view('home')->with(compact('eventos', 'incidentes', 'agent', 'mis_servicios', 'categories', 'servicios_pendientes', 'servicios_solicitados', 'prestamos', 'roleasignado'));
                
                }
        
            }
          
        
            $user->save();
            return view('home')->with(compact('eventos', 'agent', 'categories', 'servicios_solicitados', 'incidentes','apoyo'));
        
        }
        

        
    }


    public function imageUpload(Request $req) {
        $postObj = new Post;

        if($req->hasFile('archivo')) {
            $filename = $req->file('archivo')->getClientOriginalName(); // get the file name
            $getfilenamewitoutext = pathinfo($filename, PATHINFO_FILENAME); // get the file name without extension
            $getfileExtension = $req->file('archivo')->getClientOriginalExtension(); // get the file extension
            $createnewFileName = time().'_'.str_replace(' ','_', $getfilenamewitoutext).'.'.$getfileExtension; // create new random file name
            $img_path = $req->file('archivo')->storeAs('public/post_img', $createnewFileName); // get the image path
            $postObj->image = $createnewFileName; // pass file name with column
        }

        if($postObj->save()) { // save file in databse
            return ['status' => true, 'message' => "Image uploded successfully"];       
        }
        else {
            return ['status' => false, 'message' => "Error : Image not uploded successfully"];       

        }

    }

    public function verIncidencia($id){
        $servicio = Incident::findOrFail($id);
        //$mensajes = Mensajes::where('incidente_id', $id);

        $servicio = Incident::findOrFail($id);

        //$cita = Appoinment::all();

        $events = [];
 
        //$appointments = Appointment::with(['client', 'employee'])->get();
        $cita = DB::table('appointments')
            ->join('users', 'users.documento', '=', 'appointments.patient_id')
            ->join('persona', 'persona.user_id', '=', 'appointments.doctor_id')
            ->select('users.name', 'appointments.*', 'persona.*')
            ->where('persona.estamento','=', 'PSICOLOGO')->get();
 
        foreach ($cita as $appointment) {
            $events[] = [
                'title' => $appointment->name . ' ('.$appointment->user_id.')',
                'start' => $appointment->scheduled_start,
                'end' => $appointment->scheduled_end,
            ];
        }

        //$psicologos = Persona::where('estamento', 'PSICOLOGO')->get();

        $psicologos = DB::table('persona')
            ->join('users', 'users.documento', '=', 'persona.user_id')
            //->join('users', 'users.id', '=', 'project_user.user_id')
            ->select('users.name', 'persona.*')
            ->where('persona.estamento','=', 'PSICOLOGO')->get();
        
        $mensajes = $servicio->mensajes;
        //dd($events);
        return view('servicios.verincidencia')->with(compact('servicio', 'mensajes', 'psicologos', 'events'));
        //return response()->json($psicologos);
    }

    public function getReportar()
    {
        $categories = Category::where('project_id', 1)->get();
        //$incidenteNext = Contact::orderBy("created_at","desc")->get();



        //$incidentenext = Incident::all();

     
        $incidentelast = DB::table('incidents')->orderBy('created_at', 'desc')->first();
        $incidentenext = $incidentelast->id+1;
        //return response()->json($incidentenext);
        return view('reportar')->with(compact('categories', 'incidentenext'));
    }

    

    



    public function postReportar(Request $request)
    {
        //dd($request->all());
        //return $request->input('category_id');

        $reglas = [
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

        $this->validate($request, $reglas, $errormensaje);

       
        

        $incident = new Incident();
        $incident->severidad = $request->input('severity');
        $incident->descripcion = $request->input('description');
        $incident->category_id = $request->input('category_id');
        $incident->category_id = $request->input('category_id');
        $incident->tipo_id = $request->input('tipo_id');

        $usuario = auth()->user();

                
        $incident->cliente_id = $usuario->id;

       
        $incident->project_id = $usuario->seleccionar_proyecto_id;
        $incident->level_id =  1;

        if($incident->project_id == null){
            $incident->project_id = 1;    
        }

       

        $incident->save();
        

        //Mail::to('asocia2.co@gmail.com')->send(new NotificacionMail($incident->project_id));

        //return back()->with('notification', 'Incidencia Creada Correctamente');

        $categories = Category::where('project_id', 1)->get();
        //return view('reportar')->with(compact('categories'), 'notification', 'Incidencia Creada Correctamente');

        return redirec('home')->with('notification', 'Incidencia Creada Correctamente');

        //return response()->json($incident);

        //return '<script type="text/javascript">alert("hello!");</script>';

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEventos()
    {
        //Listando todo lo actividado
        //$proyectos = Project::all();

        //Listando todos los proyectos incluidos los de ekiminación lógica
        $proyectos = Project::withTrashed()->get();        

        //$proyectos = User::where('role', '<>', 2)->get();
        return view('admin.proyectos.index')->with(compact('proyectos'));   
    }


    public function seleccionarProyecto($id)
    {
        //validar asociación de usuario
        $usuario = auth()->user();
        $usuario->seleccionar_proyecto_id = $id;
        $usuario->save();
        return back();

    }

    public function seleccionarOrden($img, $id)
    {
        //validar asociación de usuario
        $imgeditar = Imgscreen::find($img);
        $imgeditar->orden = $id;
        $imgeditar->save();
        return back();

    }


    public function devolverPrestamo($id)
    {
        $agent = new Agent();
        $user = auth()->user();
        $prestamo = Prestamos::findOrFail($id);
        
        $now = new \DateTime();
        $fechaDevolucion = $now->format('d-m-Y H:i:s');
       
        $prestamo->updated_at = $fechaDevolucion;
        $prestamo->save();

        return back();

        /*
        

       if(!$user->es_cliente){
            $mis_servicios = Incident::where('project_id', $user->seleccionar_proyecto_id)->where('soporte_id', $user->id)->get();

            $projectUsuario = ProjectUser::where('project_id', $user->seleccionar_proyecto_id)->where('user_id', $user->id)->first();

            $servicios_pendientes = Incident::where('soporte_id', NULL)->where('level_id', $projectUsuario->level_id)->get();
            return view('home')->with(compact('eventos', 'agent', 'mis_servicios', 'categories', 'servicios_pendientes', 'servicios_solicitados'));
            
        }
        //return response()->json($proyectoUsuario);
        
        return view('home')->with(compact('eventos', 'agent', 'categories', 'servicios_solicitados'));*/
    }
    

    public function eliminarPrestamo($id) 
    {
        //Eliminación lógica directa
        $prestamo = Prestamos::find($id)->delete();
        return back();//->with('notification', 'Proyecto Desactivado Correctamente');
    }
}
