<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Category;
use App\Models\Level;
use App\Models\Tipo;
use Jenssegers\Agent\Agent;

class CategoryController extends Controller
{


    //

     //Médotos api android------------------------------------------------------------------
    public function indexItem($id) 
    {
        //Listando todo lo actividado
        //$proyectos = Project::all();

        $agent = new Agent();   

        $category = Category::find($id);
        //Pasando categorias y niveles a la vista
        //$categories = $proyecto->categories;
        $levels = Level::where('project_id', $category->id)->get();
        return view('admin.proyectos.editcategorianivel')->with(compact('category', 'levels', 'agent'));     

        //$proyectos = User::where('role', '<>', 2)->get();
        
        //return response()->json($categorias);     
    }

    public function index($id) 
    {
        //Listando todo lo actividado
        //$proyectos = Project::all();

        $agent = new Agent();   

        $category = Category::find($id);
        //Pasando categorias y niveles a la vista
        //$categories = $proyecto->categories;
        $levels = Level::where('project_id', $category->id)->get();
        return view('admin.proyectos.editcategorianivel')->with(compact('category', 'levels', 'agent'));     

        //$proyectos = User::where('role', '<>', 2)->get();
        
        //return response()->json($categorias);     
    }

    //
    public function store(Request $request) 
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error
        $this->validate($request, [
            'namecategoria' => 'required'
        ], [
            'namecategoria.required' => 'Ingrese una categoría para guardar'
        ]);

        //$user = new Category();
        //Asignación de datos en masa, otra forma de guardar todo lo que se recibe en el request
        Category::create($request->all());

        return back()->with('notification', 'La categoría se ha Registrado Correctamente'); 
    }

    public function update(Request $request)
    {
        //Validación directa ya que sólo es un campo, se incluyen los mensajes de error
        $this->validate($request, [
            'namecategorianew' => 'required'
        ], [
            'namecategorianew.required' => 'Ingrese una categoría para guardar'
        ]);

        
        $category_id = $request->input('category_id');
        $category = Category::find($category_id); 
        $category->namecategoria = $request->input('namecategorianew');
        $category->save();

        return back()->with('notification', 'La categoría se ha editado Correctamente'); 
    }


    public function delete($id) 
    {
        $categoria = Category::find($id);
        $categoria->delete();
        return back()->with('notification', 'Categoría Desactivado');
    }


    public function tiposJson($id) 
    {
        //Listando todo lo actividado
        //$proyectos = Project::all();

        $agent = new Agent();   

        $category = Category::find($id);
        //Pasando categorias y niveles a la vista
        //$categories = $proyecto->categories;
        $tipos = Tipo::where('category_id', $id)->get();
        //return view('admin.proyectos.editcategorianivel')->with(compact('category', 'levels', 'agent'));     

        //$proyectos = User::where('role', '<>', 2)->get();
        
        return response()->json($tipos);     
    }

    
}
