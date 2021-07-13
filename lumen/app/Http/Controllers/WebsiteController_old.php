<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class WebsiteController extends Controller
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
        $website = DB::table("website")
            ->get();
        
        return response()->json($website);

        //print_r($area);

        //return view('proyecto_conservacion',["area"=>$area[0]]);
    }
    public function dashboard()
    {

    }

    public function grabar(Request $request)
    {


        $datos=(json_decode($request->datos));
        foreach ($datos as &$dato) {
            DB::table('website')
            ->where('id',$dato->id)
            ->update(['valor' => $dato->valor]);
        }
        //return response()->json($request);
    }
    
    /*public function estadisticas_data(Request $request){
        $data = DB::table($request->requerimiento)->get();
        return response()->json($data);
    }*/

}