<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Apoyo;
use Illuminate\Support\Facades\Auth;
use DB;

class PassportAuthController extends Controller
{
    //
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:4',
            'email' => 'required|email',
            'password' => 'required|min:8',
            'documento' => 'required|min:8',
        ]);
 
        $user = User::create([
            'id' => $request->documento,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'documento' => $request->documento
        ]);
       
        $token = $user->createToken('LaravelAuthApp')->accessToken;
 
        return response()->json(['token' => $token], 200);
        /*return response()->json([
            'status'=>200,
            'success' => true,
            'token'=>$token,
            'user' => Auth::user()
        ]);*/
    }
 
    /**
     * Login
     */
    public function login(Request $request)
    {
        $data = [
            'email' => $request->email,
            'password' => $request->password,
            'idestado' => $request->idestado
        ];
 
        if (!auth()->attempt($data)) {
            
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        $countsesion = DB::table('oauth_access_tokens')
            ->join('users', 'users.id', '=', 'oauth_access_tokens.user_id')
            ->select('oauth_access_tokens.user_id', 'oauth_access_tokens.device_id', 'users.email')
            ->where('users.email','=', $request->email)->count();
            //->where('oauth_access_tokens.device_id','=', $request->device_id)->count();

        $clientesesion = DB::table('oauth_access_tokens')
            ->join('users', 'users.id', '=', 'oauth_access_tokens.user_id')
            ->select('oauth_access_tokens.user_id', 'oauth_access_tokens.device_id', 'users.email')
            ->where('oauth_access_tokens.device_id','=', $request->device_id)->first();



        if($countsesion > 1) {
            return response()->json(['error' => 'Sesión ya iniciada en otro dispositivo'], 401);
        } else if($countsesion == 1 ) {

            if($clientesesion){
                DB::table('oauth_access_tokens')->where('oauth_access_tokens.user_id', '=', $clientesesion->user_id)->delete();
        
                $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
    
                DB::table('oauth_access_tokens')
                  ->where('user_id', '=', $clientesesion->user_id)
                  ->update(['device_id' => $request->device_id]);
    
                return response()->json([
                    'status'=>200,
                    'success' => true,
                    'token'=> $token,
                    'user' => Auth::user()
                ]);
            } else {
                return response()->json(['error' => 'Sesión ya iniciada en otro dispositivo'], 501);
            }

            
        } else {
            $token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
            //return response()->json(['token' => $request->device_id]);      

            DB::table('oauth_access_tokens')
              ->where('user_id', '=', auth()->user()->id)
              ->update(['device_id' => $request->device_id]);

            
            return response()->json([
                'status'=>200,
                'success' => true,
                'token'=>$token,
                'user' => Auth::user()
            ]);
        }

        
        /*$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        //return response()->json(['token' => $token], 200);
        return response()->json([
            'status'=>200,
            'success' => true,
            'token'=>$token,
            'user' => Auth::user()
        ]);*/
    } 



    public function logoutall(Request $request){
        try {

            $request->user()->token()->revoke();
            return response()->json([
                'success' => true,
                'message' => 'Sesión Finalizada',
            ],200);
            
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => ''.$e
            ]);
        }

       
        
    }


    public function expiracionToken(Request $request)
    {
       

        $usuarioTokens = DB::table('oauth_access_tokens')
            ->join('users', 'users.id', '=', 'oauth_access_tokens.user_id')
            ->select('oauth_access_tokens.*', 'users.idestado')
            ->where('oauth_access_tokens.user_id', '=', $request->user_id)
            ->where('oauth_access_tokens.device_id', '=', $request->device_id)
            ->where('oauth_access_tokens.expires_at', '>=', now())
            ->where('users.idestado', '=', "1")
            ->get();

 
        if (!$usuarioTokens->isEmpty()) {
            return response()->json([
                'status'=>200,
                'success' => true,
                'user' => $usuarioTokens
            ]);
            
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        //$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
    }

    public function idAccessToken(Request $request)
    {
       

        $useridToken = DB::table('oauth_access_tokens')
            ->where('oauth_access_tokens.user_id', $request->user_id)
            ->where('oauth_access_tokens.expires_at', '>=', now())
            //->get();
            ->first();


        

 
        if ($useridToken) {
            $idAccessToken = $useridToken->id;

            return response()->json([
                'status'=>200,
                'success' => true,
                'user' => $useridToken,
                'id_access_token' => $idAccessToken
            ]);
            
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }

        //$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
    }

    public function deleteidtoken(Request $request)
    {
       

        $queryDel = DB::table('oauth_access_tokens')->where('oauth_access_tokens.id', '=', $request->id)->delete();
        
        if ($queryDel > 0) {

            return response()->json([
                'status'=>200,
                'success' => true,
                'message' => 'Token Eliminado',
                'token' => $request->id
            ]);
            
        } else {
            return response()->json(['message' => 'No Realizado'], 401);
        }
        
      

        //$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
    }

    public function menuUsuario(Request $request)
    {
       

        $queryMenu = DB::table('menus')->where('menus.user_id', $request->user_id)->get();
        
        if (!$queryMenu->isEmpty()) {

            return response()->json([
                'status'=>200,
                'success' => true,
                'message' => 'OK Menu Usuario',
                'menu' => $queryMenu
            ]);
            
        } else {
            return response()->json(['message' => 'SIN MENU'], 401);
        }
        
      

        //$token = auth()->user()->createToken('LaravelAuthApp')->accessToken;
        
    }


    //Login beneficiarios apoyos
    public function loginBeneficiario(Request $request)
    {

        $eventosall = '';
        
        $usuario = Apoyo::where('estado', '1')->where('user_id', $request->password)->where('email', $request->email)->first();

        if ($request->apiandroid) {
            if ($usuario) {
                return response()->json([
                    'status'=>200,
                    'success' => true,
                    'message' => 'usuariologin',
                    'post' => $usuario
                ]);
            } else {
                return response()->json([
                    'status'=>401,
                    'success' => false,
                    'message' => 'usuario no identificado o inactivo'
                ]);
            }
        } else {
            if ($usuario) {
                //$apoyo = Apoyo::find($request->user_id);

                
                $reservations = $usuario->reservaciones;
                //dd($reservations);

                return view('areas.gestion.beneficiarioreserva', compact('usuario','reservations'));
            } else {
                return back()->with('notification', 'No tiene usaurio activo'); 
            }
        }
        
        

        
    } 

}
