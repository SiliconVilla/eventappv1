<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Incident;
use App\Models\ProjectUser;
use Jenssegers\Agent\Agent;
use App\Models\Event;
use App\Models\Category;
use App\Mail\NotificacionMail;
use App\Mail\MailNivelsiguiente;
use Storage;
use DB;
use Mail;

class IncidentController extends Controller
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

    public function contactForm()
    {

        $categories = Category::where('project_id', 1)->get();
        //$incidenteNext = Contact::orderBy("created_at","desc")->get();



        //$incidentenext = Contact::all();

     
        $incidentelast = DB::table('incidents')->orderBy('created_at', 'desc')->first();
        

        if ($incidentelast != null) {
            $incidentenext = $incidentelast->id+1;
            return view('reportar')->with(compact('categories', 'incidentenext'));
        } else {
            $incidentenext = 1;
            return view('reportar')->with(compact('categories', 'incidentenext'));
        }
        

        
        //return view('reportar')->with(compact('categories', 'incidentenext'));
    }

    public function storeContactForm(Request $request)
    {

        $incident = new Incident();
        $incident->severidad = $request->input('severity');
        $incident->descripcion = $request->input('description');
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
    
        /*$contacto = new Contact();
        $contacto->name = $request->input('name');
        $contacto->email = $request->input('email');
        $contacto->phone = $request->input('phone');
        $contacto->subject = $request->input('subject');
        $contacto->message = $request->input('message');

        $usuario = auth()->user();*/

                
        //$incident->cliente_id = $usuario->id;

       
        /*$incident->project_id = $usuario->seleccionar_proyecto_id;
        $incident->level_id =  1;

        if($incident->project_id == null){
            $incident->project_id = 1;    
        }*/

        //$contacto->save();

        //$emails = ['bunpalmira@siliconvilla.online', $usuario->email ];

        //Mail::to($emails)->send(new NotificacionMail());
        /*$request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required',
        ]);*/

        //$input = $request->all();

        //Contact::create($input);*/

        return redirect('home')->with('notification', 'Incidencia Creada Correctamente');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function atender($id)
    {
        $agent = new Agent();
        $user = auth()->user();
        $eventos = Event::all();
        $categories = Category::all();
        $servicios_solicitados = Incident::where('cliente_id', auth()->user()->id)->where('project_id', $user->seleccionar_proyecto_id)->get();
        $servicio_solicitado = Incident::findOrFail($id);
        $proyectoUsuario = ProjectUser::where('project_id', $servicio_solicitado->project_id)
                                            ->where('user_id', $user->id)->first();

        if(!$proyectoUsuario){
            return back();
        }

        if($proyectoUsuario->level_id != $servicio_solicitado->level_id){
            return back();
        }

        $servicio_solicitado->soporte_id = $user->id;
        $servicio_solicitado->save();

        return back();


        

       if(!$user->es_cliente){
            $mis_servicios = Incident::where('project_id', $user->seleccionar_proyecto_id)->where('soporte_id', $user->id)->get();

            $projectUsuario = ProjectUser::where('project_id', $user->seleccionar_proyecto_id)->where('user_id', $user->id)->first();

            $servicios_pendientes = Incident::where('soporte_id', NULL)->where('level_id', $projectUsuario->level_id)->get();
            return view('home')->with(compact('eventos', 'agent', 'mis_servicios', 'categories', 'servicios_pendientes', 'servicios_solicitados'));
            
        }
        //return response()->json($proyectoUsuario);
        
        return view('home')->with(compact('eventos', 'agent', 'categories', 'servicios_solicitados'));
    }

    public function resolver($id){

        $servicio_solicitado = Incident::findOrFail($id);

        if(auth()->user()->role == 0){
            $servicio_solicitado->level_id = 4;
            $servicio_solicitado->save();
            return back();
        }
        if($servicio_solicitado->cliente_id != auth()->user()->id){
            return back();
        } else {
            $servicio_solicitado->level_id = 4;
            $servicio_solicitado->save();
            return back();
            //return view('servicios.verincidencia')->with(compact('servicio'));
        }
        
        
       
        return response()->json($servicio_solicitado);
    }

    
    public function abrir($id)
    {
        /*$agent = new Agent();
        $user = auth()->user();
        //$eventos = Event::all();
        //$categories = Category::all();
        //$servicios_solicitados = Incident::where('cliente_id', auth()->user()->id)->where('project_id', $user->seleccionar_proyecto_id)->get();
        $servicio_solicitado = Incident::findOrFail($id);
        $proyectoUsuario = ProjectUser::where('project_id', $servicio_solicitado->project_id)
                                            ->where('user_id', $user->id)->first();

        if(!$proyectoUsuario){
            return back();
        }

        if($proyectoUsuario->level_id != $servicio_solicitado->level_id){
            return back();
        }

        //$servicio_solicitado->soporte_id = null;
        $servicio_solicitado->level_id = 1;
        $servicio_solicitado->save();

        return back()->with('notification', 'Incidencia Abierta Nuevamente');*/

        $servicio_solicitado = Incident::findOrFail($id);

        if(auth()->user()->role == 0){
            $servicio_solicitado->level_id = 1;
            $servicio_solicitado->save();
            return back();
        }
        if($servicio_solicitado->cliente_id != auth()->user()->id){
            return back();
        } else {
            $servicio_solicitado->level_id = 1;
            $servicio_solicitado->save();
            return back();
            //return view('servicios.verincidencia')->with(compact('servicio'));
        }

    }


    public function eliminar($id) 
    {
        //Eliminación lógica directa
        $servicio_solicitado = Incident::find($id)->delete();
        return back();//->with('notification', 'Proyecto Desactivado Correctamente');
    }

    public function restaurar($id) 
    {
        //Recuperando proyectos eliminados lógicamente
        /*$servicio_solicitado = Incident::withTrashed()->find($id)->restore();
        $servicio_editado = Incident::find($id)->get();
        $servicio_editado->level_id = 1;
        $servicio_editado->soporte_id = null;
        $servicio_editado->save();*/
       
        


        Incident::withTrashed()->find($id)->update([
           'level_id' => 1,
           'soporte_id' => null,
           'deleted_at' => null
        ]);

        return back()->with('notification', 'Incidencia Abierta¡');
    }


    public function avanzarNivel($id){

        $servicio_solicitado = Incident::findOrFail($id);
        $level_id = $servicio_solicitado->level_id;

        if(auth()->user()->role == 0 || auth()->user()->role == 1){
            $project = $servicio_solicitado->project;
            $levels = $project->levels;

            $siguienteNivel_id = $this->getSiguienteNivel($level_id, $levels);

            if ($siguienteNivel_id){
                $servicio_solicitado->level_id = $siguienteNivel_id;
                //$servicio_solicitado->soporte_id = null;

                $emailCliente = User::
                    join('incidents', 'incidents.cliente_id', '=', 'users.id')
                    ->select('users.email')
                    ->where('incidents.id', '=', $id)
                    ->get();


                    
                    
                $emailCliente1 = $emailCliente->first();

                $usuario = auth()->user();

                $emails = ['bunpalmira@siliconvilla.online', $usuario->email, $emailCliente1 ];
                Mail::to($emails)->send(new MailNivelsiguiente());

             
                //dd($emailCliente, $usuario, $emailCliente1);
                $servicio_solicitado->save();
                return back();
            }

            //$emails = ['bunpalmira@siliconvilla.online', $usuario->email ];



            //dd($levels);
            
          /*  $servicio_solicitado->level_id = level_id + 1;
            $servicio_solicitado->save();
            return back();*/
        }
        /*if($servicio_solicitado->cliente_id != auth()->user()->id){
            return back();
        } else {
            //$servicio_solicitado->level_id = level_id + 1;
            //$servicio_solicitado->save();
            //return back();
            //return view('servicios.verincidencia')->with(compact('servicio'));
        }

        
        
        
       
        return response()->json($servicio_solicitado);*/
        return back()->with('notification', 'La incidencia está resuelta');


    }

    public function getSiguienteNivel($level_id, $levels){
        //dd(sizeof($levels));
        if(sizeof($levels) <= 1){
            return null;


        }

        $position = -1;
        for ($i=0; $i < sizeof($levels)-1; $i++) { 
            # code...
            if($levels[$i]->id == $level_id){
                $position = $i;
                break;
            }
        }

        if ($position == -1) {
            # code...
            return null;
        }

        /*if ($position == sizeof($levels)-1) {
            # code...
            return null;
        }*/

        return $levels[$position+1]->id;
        dd($levels[$i+1]);

    }


    public function documentoPDF($user, $archivo )
    {
        $directorio = "private/$user/$archivo";
        //dd($directorio);
        if (Storage::exists($directorio)) {
            
            return Storage::download($directorio);
        }

        return 777;
    }

}
