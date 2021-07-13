<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class AreasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {        
        $url=URL::current();
        $pos = strrpos($url, "/en");

        $idioma="en";
        if ($pos === false) {
            $idioma="es";
        }

        $area = DB::table("areas")

            ->where("id","=",$request->id)

            ->get();

        //print_r($area);
        return view('proyecto_conservacion',[ "area"=>$area[0], 'idioma' => $idioma  ]); 
    }
    public function listar(Request $request)
    {        
        $area = DB::table("areas")
            ->get();
 
        return response()->json($area);
    }

    public function update(Request $request)
    {        


        DB::table('areas')
        ->where('id', $request->id)
        ->update([
            'titulo' => $request->titulo,
            'video' => $request->video,
            'texto' => $request->texto,
            'texto_link' => $request->texto_link,
            'link' => $request->link,
            ]);



        return response()->json(['status' => 'success']);
        
    }
    public function new(Request $request)
    {        


        DB::table('areas')
        ->insert( ['titulo' => 'Nueva area']);



        return response()->json(['status' => 'success']);
        
    }
    public function delete(Request $request)
    {        


        DB::table('areas')
        ->where('id', $request->id)
        ->delete();


        return response()->json(['status' => 'success']);
        
    }
    public function subir(Request $request)
    {
        $path = $request->file('file')->storeAs(
            'public',
            'proyecto'.$request->area.".jpg"
        );
        return response()->json(['status' => 'success', 'data' => $path]);
    }


}