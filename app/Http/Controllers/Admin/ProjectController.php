<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Direccionapi;
use Jenssegers\Agent\Agent;
use App\Models\Activity;

use DB;

class ProjectController extends Controller
{
    //
    public function index() 
    {
        //Listando todo lo actividado
        //$proyectos = Project::all();
        $agent = new Agent();

        //Listando todos los proyectos incluidos los de ekiminación lógica
        $proyectos = Project::withTrashed()->get();        

        //$proyectos = User::where('role', '<>', 2)->get();
        return view('admin.proyectos.index')->with(compact('proyectos', 'agent'));     
    }

    public function store(Request $request) 
    {


        //Acceder a las reglas de validación desde el modelo al controlador 
        $this->validate($request, Project::$reglas, Project::$errormensaje);

        //$user = new Project();
        //Asignación de datos en masa, otra forma de guardar todo lo que se recibe en el request
        Project::create($request->all());

        return back()->with('notification', 'El proyecto se ha Registrado Correctamente'); 
    }

    public function edit($id) 
    {
        $agent = new Agent();


        $proyecto = Project::find($id);
        //Pasando categorias y niveles a la vista
        $categories = $proyecto->categories;
        $levels = $proyecto->levels;//Level::where('project_id', $id)->get()
        return view('admin.proyectos.edit')->with(compact('proyecto', 'categories', 'levels', 'agent')); 
    }

    public function update($id, Request $request) 
    {
        //Acceder a las reglas de validación desde el modelo al controlador 
        $this->validate($request, Project::$reglas, Project::$errormensaje);

        //Actualizando por arreglo asociativo, todos los campos del request se envían a la bd
        $proyecto = Project::find($id)->update($request->all());
      
        return back()->with('notification', 'El proyecto se actualizó Correctamente'); 
    }

    public function delete($id) 
    {
        //Eliminación lógica directa
        $proyecto = Project::find($id)->delete();
       
        return back()->with('notification', 'Proyecto Desactivado Correctamente');
    }

    public function restore($id) 
    {
        //Recuperando proyectos eliminados lógicamente
        $proyecto = Project::withTrashed()->find($id)->restore();
       
        return back()->with('notification', 'Proyecto Activado Correctamente');
    }


    //Médotos api android------------------------------------------------------------------
    public function indexItem() 
    {
        //Listando todo lo actividado
        //$proyectos = Project::all();

        //Listando todos los proyectos incluidos los de ekiminación lógica
        $proyectos = Project::withTrashed()->get();        

        //$proyectos = User::where('role', '<>', 2)->get();
        return response()->json($proyectos);     
    }

    public function storeItem(Request $request) 
    {


        //Acceder a las reglas de validación desde el modelo al controlador 
        //$this->validate($request, Project::$reglas, Project::$errormensaje);


        $projects = \DB::table('projects')->get();
        $response = \Response::json($projects)->setStatusCode(200, 'Success'); 
                              
        return $response;
    }

    public function editItem($id) 
    {
        $proyecto = Project::find($id);
        //Pasando categorias y niveles a la vista
        $categories = $proyecto->categories;
        $levels = $proyecto->levels;//Level::where('project_id', $id)->get()
        return view('admin.proyectos.edit')->with(compact('proyecto', 'categories', 'levels')); 
    }

    public function updateItem($id, Request $request) 
    {
        //Acceder a las reglas de validación desde el modelo al controlador 
        $this->validate($request, Project::$reglas, Project::$errormensaje);

        //Actualizando por arreglo asociativo, todos los campos del request se envían a la bd
        $proyecto = Project::find($id)->update($request->all());
      
        return back()->with('notification', 'El proyecto se actualizó Correctamente'); 
    }

    public function deleteItem($id) 
    {
        //Eliminación lógica directa
        $proyecto = Project::find($id)->delete();
       
        return back()->with('notification', 'Proyecto Desactivado Correctamente');
    }

    public function restoreItem($id) 
    {
        //Recuperando proyectos eliminados lógicamente
        $proyecto = Project::withTrashed()->find($id)->restore();
       
        return back()->with('notification', 'Proyecto Activado Correctamente');
    }

    public function enviarurl(Request $request)
    {
        return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'urlLocal',
            'location' => Direccionapi::all()
        ]);
    }

    public function checkbox(Request $request)
    {
        //dd($request->category);

        if(isset($request['actiid'])){
            if (is_array($_POST['actiid'])) {
                 foreach($_POST['actiid'] as $value){
                    $actividad = Activity::find($_POST['actiid']);
                    $actividad->estado_id = 2;
                    dd($actividad);
                    
                 }
              } else {
                $value = $_POST['actiid'];
                echo $value;
           }
        }

        /*return response()->json([
            'status'=>200,
            'success' => true,
            'message' => 'urlLocal',
            'location' => Direccionapi::all()
        ]);*/
    }



}
