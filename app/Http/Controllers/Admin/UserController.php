<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Level;
use App\Models\ProjectUser;
use App\Models\Lugar;
use App\Models\Event;
use App\Models\ProyectosUsuario;
use DB;

use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;

class UserController extends Controller
{
    //
    public function index() 
    {
        $agent = new Agent();
        //$usuarios = User::all();
        //$usuarios = User::where('role', '<>', 7)->get();
        //$usuarios = User::all();
        $usuarios = User::orderBy('id', 'ASC')->paginate(7);
        /*$usuarios = DB::table('users')
            ->join('oauth_access_tokens', 'oauth_access_tokens.user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.email', 'users.documento', 'users.corresponsabilidad', 'users.role', 'users.idestado', 'users.created_at', 'oauth_access_tokens.id as devid')
            ->orderByDesc('users.created_at')
            ->get();*/

        //$usuarios = User::orderBy('created_at', 'DESC')->get();
        return view('admin.usuarios.index')->with(compact('usuarios', 'agent'));  
        //return response()->json($usuarios);   	
    }

    public function deleteDevice($id) 
    {
        
        $usuario = DB::table('oauth_access_tokens')
            ->where('oauth_access_tokens.id', '=', $id);

        //$usuario = User::find($id);
        //dd($usuario);
        $usuario->delete();
        return back()->with('notification', 'Usuario Desactivado Correctamente');
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

    public function store(Request $request) 
    {
        $reglas = [
            'name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'min:8'],
            'documento' => ['required', 'min:8']
        ];

        $errormensaje = [
            'name.required' => 'Se necesita un nombre para el registro.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'email.required' => 'Se necesita un email para el registro',
            'email.email' => 'El email ingresado no es válido',
            'email.max' => 'El email no puede superar los 255 caracteres.',
            'email.unique' => 'El email ya se encuentra registrado',
            'password.min' => 'La contraseña debe contener al menos 8 caracteres',
            'password.required' => 'Se necesita una contraseña para el registro.',
            'documento.min' => 'El documento debe contener al menos 8 caracteres',
        ];

        $this->validate($request, $reglas, $errormensaje);

        $user = new User();
        $user->id = $request->input('documento');
        $user->name = $request->input('name');
        $user->documento = $request->input('documento');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return back()->with('notification', 'Usuario Registrado Correctamente');
    }

    public function edit($id) 
    {
        $agent = new Agent();
        $usuario = User::find($id);
        $proyectosUser = ProjectUser::where('user_id', $usuario->id)->get();
        $proyectos = Project::all();
       //$proyectosUsuario = ProyectosUsuario::where('user_id', $id)->get();

        $tokenacceso = DB::table('oauth_access_tokens')->where('user_id', $usuario->id)->get();
        
        $queryMenu = DB::table('menus')->where('menus.user_id', $usuario->id)->get();
        
        //$niveles = Level::where('id', $proyectosUser->project_id)->get();
        

        
        return view('admin.usuarios.edit')->with(compact('usuario', 'proyectos', 'agent', 'proyectosUser', 'queryMenu', 'tokenacceso')); 
        //return response()->json($tokenacceso); 
    }

    public function update($id, Request $request) 
    {
        $reglas = [
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

        $this->validate($request, $reglas, $errormensaje);

        $usuario = User::find($id);
        $usuario->name = $request->input('name');
        //$user->email = $request->input('email');
        $password = $request->input('password');
        if ($password) {
            $usuario->password = Hash::make($password);
        }
        $usuario->role = $request->input('role');
        $usuario->save();

        return back()->with('notification', 'Usuario Editado Correctamente');
    }

    public function delete($id) 
    {
        $usuario = User::find($id);
        $usuario->delete();
        return back()->with('notification', 'Usuario Desactivado Correctamente');
    }


    public function getProyectos(Request $request){
        if($request->ajax()){
            $levels = Level::where('project_id', $request->project_id)->get();
            
                
            return response()->json($levels);
        }

    }

    public function getProyectosUsuario($id){
       
        $proyectoUsuario = ProjectUser::where('user_id', $id)->get();
            
                
        return response()->json($proyectoUsuario);

    }

    public function asignarCorresp($id, $corresp)
    {
        $usuario = User::find($id);
        if ($corresp == 'no') {
            $usuario->corresponsabilidad  = 'NO';
            
        } else if ($corresp == 'si') {
            $usuario->corresponsabilidad  = 'SI';
        }

        $usuario->save();

        
        
        return back()->with('notification', 'Corresponsabilidad Asignada Correctamente');
    }
    

    public function asignarEstado($id, $estado)
    {
        $usuario = User::find($id);
        if ($estado == '2') {
            $usuario->idestado  = '2';
            
        } else if ($estado == '1') {
            $usuario->idestado  = '1';
        }

        $usuario->save();

        
        
        return back()->with('notification', 'Estado Asignado Correctamente');
    }
    

    public function storeMenu(Request $request)
    {

        $menu_id = $request->input('menu');
        $user_id = $request->input('user_id');

        $usuario = User::find($user_id);
        $proyectosUser = ProjectUser::where('user_id', $user_id)->get();

        //$project_user = ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->first();
        //$queryMenu = DB::table('menus')->where('menus.user_id', $usuario->id)->get();
        $proyectos = Project::all();
        
        DB::table('menus')->insert([
            'funcion' => $menu_id,
            'user_id' => $user_id
        ]);

        return back()->with('notification', 'Menú asignado correctamente');
        
    }

    public function deleteMenu($id)
    {
        DB::table('menus')->where('menus.id', $id)->delete();
        return back()->with('notification', 'El menú se elimnó del usuario');
    }

    public function deleteToken($id)
    {
        DB::table('oauth_access_tokens')->where('user_id', $id)->delete();
        return back()->with('notification', 'El token se elimnó del usuario');
    }
    
}
