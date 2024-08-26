<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mensajes;
use App\Models\Category;
use App\Models\Prestamos;
use App\Models\Persona;
use DB;
use Illuminate\Support\Facades\Hash;
use PDF;

class PrestamosController extends Controller
{
    //

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    

    public function dashprestamos(Request $request)
    {

        //Listando todos los proyectos incluidos los de ekiminación lógica
        //$proyectos = Project::withTrashed()->get();

        $categories = Category::where('project_id', 1)->get();
        
        $user = auth()->user();
        //$persona = Persona::where('user_id', $user->id)->first();
        
        $filtro = $request->get('buscarpor');
        

        if($user->es_admin){
        
            

            $prestamos = Prestamos::withTrashed()->get();
            

           
        } else {

            //$prestamos = Prestamos::all();
            $prestamos = Prestamos::where('categoria', 'like', "%$filtro%")->get();
        }
        
        

        //$servicios_solicitados = Incident::where('cliente_id', auth()->user()->id)->where('project_id', $user->seleccionar_proyecto_id)->get();
        
       /* if($user->seleccionar_proyecto_id === null){
            $proyecto_seleccionado = 1;    
        } else {
            $proyecto_seleccionado = $user->seleccionar_proyecto_id;
        }*/        

        if(!$user->es_cliente){
            //$mis_servicios = Incident::where('project_id', $user->seleccionar_proyecto_id)->where('soporte_id', $user->id)->get();

            //$projectUsuario = ProjectUser::where('project_id', $user->seleccionar_proyecto_id)->where('user_id', $user->id)->first();
        
            
            return view('areas.deportes.prestamos')->with(compact('prestamos', 'categories', 'user', 'filtro'));
            //dd($persona);
            
           
        }
       
        //dd($servicios_solicitados->all());
        //return view('home')->with(compact('eventos', 'agent', 'categories', 'servicios_solicitados', 'incidentes'));
    }


    public function verPrestamo($id){
        
        $user = auth()->user();
        $prestamo = DB::table('listaprestamos')->where('id', $id)->first();
        //dd($prestamo);
        $mensajes = Mensajes::where('incidente_id', $id);


        $persona = Persona::where('user_id', $prestamo->user_id)->first();

        $firmaPrestamoQR = Hash::make($prestamo->user_id);
        
        //$mensajes = $servicio->mensajes;
        //dd($mensajes->all());
        return view('servicios.verprestamo')->with(compact('prestamo', 'mensajes', 'persona', 'firmaPrestamoQR'));
        //return response()->json($firmaPrestamoQR);
    }


    public function invoice(Request $request) 
    {
        $user = auth()->user();
        $prestamo = DB::table('listaprestamos')->where('id', $request->id)->first();
        //dd($prestamo);
        $mensajes = Mensajes::where('incidente_id', $request->id);


        $persona = Persona::where('user_id', $prestamo->user_id)->first();

        $firmaPrestamoQR = Hash::make($prestamo->user_id);

        

        view()->share('prestamo',$prestamo);
        view()->share('persona',$persona);
        view()->share('firmaPrestamoQR',$firmaPrestamoQR);
        view()->share('mensajes',$mensajes);


        if($request->has('download')){
            if ($prestamo->categoria == 'Cultura') {
                $pdf = PDF::loadView('pdf.prestamoscultura')->setPaper('letter', 'portrait');
            } else {
                $pdf = PDF::loadView('pdf.prestamosdeportes')->setPaper('letter', 'portrait');
            }
            
            return $pdf->download('prestamo_'.$request->id.'.pdf');
            //return $pdf->stream('prestamo_'.$request->id.'.pdf');
        }

        //return view('pdf.invoice');
    }


    public function abrirPrestamo($id)
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

        $servicio_solicitado = Prestamos::findOrFail($id);

        if(auth()->user()->role == 0  || auth()->user()->role == 1){
            $servicio_solicitado->updated_at = null;
            $servicio_solicitado->save();
            return back();
        }
        if($servicio_solicitado->cliente_id != auth()->user()->id){
            return back();
        } else {
            $servicio_solicitado->updated_at = null;
            $servicio_solicitado->save();
            return back();
            //return view('servicios.verincidencia')->with(compact('servicio'));
        }

    }


    

    public function restaurarPrestamo($id) 
    {
        //Recuperando proyectos eliminados lógicamente
        /*$servicio_solicitado = Incident::withTrashed()->find($id)->restore();
        $servicio_editado = Incident::find($id)->get();
        $servicio_editado->level_id = 1;
        $servicio_editado->soporte_id = null;
        $servicio_editado->save();*/
       
        


        Prestamos::withTrashed()->find($id)->update([
           
           'updated_at' => null,
           'deleted_at' => null
        ]);

        return back()->with('notification', 'Incidencia Abierta¡');
    }



}
