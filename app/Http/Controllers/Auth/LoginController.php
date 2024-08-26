<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //Principal-->   protected $redirectTo = RouteServiceProvider::HOME;
    //protected $redirectTo = RouteServiceProvider::HOMEINVENTARIOS;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    //Reemplaza linea Principal-->  
    public function redirectPath()
    {
        if (Auth::user()->role == '9' || Auth::user()->role == '10'){
        
            return '/verordenes';
        } else {
            return '/home';
        }
        
    }


    protected function authenticated()
    {
        $user = auth()->user();



        if ($user->role == 0 || $user->role == 2){
            $user->seleccionar_proyecto_id = Project::first()->id;
            $user->save();
            //return;
        } else {
            if (!$user->seleccionar_proyecto_id) {
                $user->seleccionar_proyecto_id = $user->projects->first()->id;
                $user->save();
            } elseif (!$user->seleccionar_proyecto_id == null){
                $user->seleccionar_proyecto_id = 1;
                $user->save();
            }
            $user->save();
            

        }

        
    }
}
