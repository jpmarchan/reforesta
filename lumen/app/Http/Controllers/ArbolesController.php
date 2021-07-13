<?php



namespace App\Http\Controllers;



use App\Arboles;

use App\ArbolesCampanias;

use App\ArbolesNombres;

use Illuminate\Http\Request;

use App\Exports\ArbolesExportar;

use App\Imports\ArbolesImportar;;



use Maatwebsite\Excel\Facades\Excel;



class ArbolesController extends Controller

{

    /**

     * Create a new controller instance.

     *

     * @return void

     */

    public function index(Request $request)

    {

        $nombreArbol = '%%';

        if ($request->nombreArbol) $nombreArbol = $request->nombreArbol;

        $campania = '%%';

        if ($request->campania) $campania = $request->campania;



        if ($request->accion != 'json') {

            //for xls
            ob_clean();
            return Excel::download(new ArbolesExportar(json_encode($request->all())), 'arboles.xls');

        } else {

            $arboles = Arboles::select('id','gps','fecha_siembra','fecha_foto','nombre','nombre_c','codigo','campania','status');
            $arboles=$arboles->where('nombre', 'like', $nombreArbol);
            $arboles=$arboles->where('campania', 'like', $campania);
            if ($request->anio) {
                $arboles=$arboles->whereYear('fecha_foto', '=', $request->anio);
            }
            if ($request->estado!="") {                
                $arboles=$arboles->where('status', '=', $request->estado);
            }
            if ($request->area) {
                $arboles=$arboles->where('codigo', 'like', $request->area."%" );
            }
            $arboles=$arboles->orderBy('id', 'DESC');                
            $arboles=$arboles->paginate($request->paginado);

        }//if

        return response()->json($arboles);

    }



    public function subir(Request $request)

    {

        $path = $request->file('file')->storeAs(

            'files_importar',

            'arboles.xls'

        );

        return response()->json(['status' => 'success', 'data' => $path]);

    }



    public function importar()

    {

        $response = Excel::import(new ArbolesImportar, 'files_importar\arboles.xls');

        //print_r($response);

        return response()->json(['status' => 'success']);

    }

    public function nombre_arboles()

    {

        $nombres = ArbolesNombres::all();

        return response()->json($nombres);

    }

    public function campanias()

    {

        $campanias = ArbolesCampanias::all();

        return response()->json($campanias);

    }

}

