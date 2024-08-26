<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AndroidController extends Controller
{
    //
    public function index(Request $request)
    {
        return $request->user();
    }

    public function login(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if( Auth::attempt($credenciales)){
            $user = Auth::user();
            $token = md5(time()).'-'.md5($request->email);
            $user->forceFill([
                'api_token' => $token
            ])->save();
            return response()->json([
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'No hay resultado para las credenciales enviadas'
        ],401);
    }

    public function logout(Request $request)
    {
        $request->user->forceFill([
            'api_token' => null
        ])->save();

        return response()->json(['message' => 'ejecutado']);
    }
}
