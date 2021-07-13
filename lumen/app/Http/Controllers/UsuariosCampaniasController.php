<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;

class UsuariosCampaniasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        //print_r($request);
        //exit();
        if($request->campana){
            $codigos = Usuarios::where('codigos.campania',$request->campana)
            ->orderBy('usuarios.id', 'DESC')
            ->leftJoin('codigos', 'usuarios.id_codigo', '=', 'codigos.id')
            ->paginate(12);
        }else{
            $codigos = Usuarios::orderBy('usuarios.id', 'DESC')
            ->leftJoin('codigos', 'usuarios.id_codigo', '=', 'codigos.id')
            ->paginate(12);
        }
        
        
        return response()->json($codigos);
    }

}