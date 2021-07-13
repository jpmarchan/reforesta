<?php

namespace App\Http\Controllers;

use App\Codigos;
use App\Exports\CodigosExportar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class CodigosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        if ($request->accion != 'json') {
            //for xls
            //return json_encode($request->all());
            ob_clean();
            return Excel::download(new CodigosExportar(json_encode($request->all())), 'codigos.xls');
        } else {            
            $campania='%%';
            if($request->campania) $campania=$request->campania;
            $codigos =  DB::table("codigos_con_estado_uso");
            $codigos = $codigos->where('campania','like',$campania);
            if ($request->codigo!="") {
                $codigos=$codigos->where('codigo', 'like', $request->codigo );
            }
            if ($request->estado!="") {
                $codigos=$codigos->where('estado', '=', $request->estado );
            }
            $codigos=$codigos->paginate($request->paginado);
            return response()->json($codigos);
        }
    }
    public function generar(Request $request)
    {
        $arCodigos=explode(",",$request->cantidad);
        
        foreach ($arCodigos as &$valor) {
            $codigo = $this->generate_string();
            //ver que area pertenece actualmente
            $arbol=DB::table("arboles")->where('id',$valor)->get();

            //codigo de campanha previa
            $campaniaPrevia=($arbol[0]->campania);

            /**/ 
            //actualiar arbol
            DB::table("arboles")
                ->where('id',$valor)
                ->update(['campania' => $request->campania]);

            //crear codigo
            $codigos = new Codigos();
            $codigos->codigo = $codigo;
            $codigos->campania = $request->campania;
            $codigos->user = 1;
            $codigos->idioma = $request->idioma;
            $codigos->save();
            /**/

            //obtener el id del codigo a eliminar de la campanahha anterior
            $codigoRegEliminar =  DB::table("codigos_con_estado_uso");
            $codigoRegEliminar=$codigoRegEliminar->where('estado', '=', 0 );
            $codigoRegEliminar=$codigoRegEliminar->where('reserva', '=', 0 );
            $codigoRegEliminar=$codigoRegEliminar->where('campania','like', $campaniaPrevia )->get();
            $codigoEliminar=$codigoRegEliminar[0]->id;

            //Eliminar
            DB::table("codigos")
            ->where('id',$codigoEliminar)
            ->delete();

            //print_r($codigoEliminar);

            //exit();
            
        }

       

        return response()->json(['status' => 'success']);
    }
    public function generarCantidad(Request $request)
    {
        for ($x = 0; $x < $request->cantidad; $x++) {
            $codigo = $this->generate_string();
            //crear codigo
            $codigos = new Codigos();
            $codigos->codigo = $codigo;
            $codigos->campania = $request->campania;
            $codigos->user = 1;
            $codigos->idioma = $request->idioma;
            $codigos->save();
        } 
       
        return response()->json(['status' => 'success']);
    }
    
    public function actualizar_reserva(Request $request)
    {
        //print_r("aa");
        //exit();
        DB::table("codigos")
                ->where('id',$request->id)
                ->update(['reserva' => $request->reserva]);

        return response()->json(['status' => 'success']);
    }
 
    public function generate_string() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyz';
        $input_length = strlen($permitted_chars);
        $random_string = '';
        for($i = 0; $i < 11; $i++) {
            $random_character = $permitted_chars[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
    
        return $random_string;
    }
}