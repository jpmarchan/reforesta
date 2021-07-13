<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function auth()
    {
        echo 'Autorizado';
    }

    public function authenticate(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('email'))->first();
        if($user){
            if (Hash::check($request->input('password'), $user->password)) {
                $apikey = base64_encode(str_random(40));
                User::where('email', $request->input('email'))->update(['api_token' => "$apikey"]);;
                return response()->json(['status' => 'success', 'api_token' => $apikey]);
            } else {
                return response()->json(['status' => 'fail'], 401);
            }
        }else{
            return response()->json(['status' => 'fail'], 401);
        }        
    }

    public function authenticate_pagos(Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $user = User::where('email', $request->input('username'))->first();
        if($user){
            if (Hash::check($request->input('password'), $user->password)) {
                $apikey = base64_encode(str_random(40));
                User::where('email', $request->input('username'))->update(['api_token' => "$apikey"]);;             
                return response()->json([
                    'id' => $user->id, 
                    'username' => $user->name,
                    'firstName' => $user->name,
                    'lastName' => $user->name,
                    'token' => $apikey
                ],200);
            } else {
                return response()->json(['message' => 'La contraseña es incorrecta '], 406);
            }
        }else{
            return response()->json(['message' => 'Usuario no encontrado'], 406);
        }        
    }

    public function check(Request $request)
    {
        //echo $request->input('api_token');
        $User = User::where('api_token',$request->input('api_token'))->first(['id']);
        //print_r($User);
        //return response()->json($User);
        return response()->json(['status' => 'success','user'=>$User]);        
    }
    

    public function index()
    {

        $Users = Users::paginate(20);
        return response()->json($Users);
    }
}
