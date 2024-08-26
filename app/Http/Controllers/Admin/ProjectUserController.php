<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectUser;

class ProjectUserController extends Controller
{
    //Validar que el nivel pertenezca al proyecto
    //Asegurar que el proyecto exista
    //Asegurar que el nivel exista
    //Asegurar que el usuario exista


    public function store(Request $request)
    {

        $project_id = $request->input('project_id');
        $user_id = $request->input('user_id');

        $project_user = ProjectUser::where('project_id', $project_id)->where('user_id', $user_id)->first();
        

        $project_user = new ProjectUser();
        $project_user->project_id = $project_id;
        $project_user->user_id = $user_id;
        $project_user->level_id = $request->input('level_id');
        $project_user->save();

        return back()->with('notification', 'El usuario se asignó al proyecto');

        

        /**if ($project_user) {
            return back()->with('notification', 'El usuario ya pertenece al proyecto');
        } else {
            $project_user = new ProjectUser();
            $project_user->project_id = $project_id;
            $project_user->user_id = $user_id;
            $project_user->level_id = $request->input('level_id');
            $project_user->save();

            return back()->with('notification', 'El usuario se asignó al proyecto');
        }**/

        
    }

    public function delete($id)
    {
        ProjectUser::find($id)->delete();
        return back()->with('notification', 'El usuario se elimnó del proyecto');
    }
}
