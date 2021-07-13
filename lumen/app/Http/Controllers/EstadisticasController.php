<?php

namespace App\Http\Controllers;

use App\Arboles;
use App\Codigos;
use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EstadisticasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        //$arboles = Arboles::paginate(20);
        //return response()->json($arboles);
    }
    public function dashboard()
    {
        $arbStatus1 = Arboles::where('status',1)->count();
        $arbStatus0 = Arboles::where('status',0)->count();
        $codigos = Codigos::all()->count();
        $usuarios = Usuarios::all()->count();

        return response()->json([
            'arboles' => [
                'activos' => $arbStatus1,
                'inactivos' => $arbStatus0,
            ],
            'codigos' => $codigos,
            'adopciones' => $usuarios
        ]);
    }
    
    public function estadisticas_data(Request $request){
        $data = DB::table($request->requerimiento)->get();
        return response()->json($data);
    }

    /*public function adoptados_por_meses(){
        $data = DB::table('dashboard_adoptados_por_meses')->get();
        return response()->json($data);
    }
    public function adoptados_por_zonas(){
        $data = DB::table('dashboard_adoptados_por_zonas')->get();
        return response()->json($data);
    }
    public function libres_por_zonas(){
        $data = DB::table('dashboard_libres_por_zonas')->get();
        return response()->json($data);
    }
    */
}