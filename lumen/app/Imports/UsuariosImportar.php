<?php

namespace App\Imports;

use App\Codigos;
use App\Usuarios;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\DB;

class UsuariosImportar implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        //print_r($row["codigo"]."<br>");

        $codigo = Codigos::where("codigo","like", trim($row["codigo"]))->get();        
        //print_r($codigo->count());
        //exit();
        if($codigo->count()>0){
            //verificar si existe en usuarios
            $usuario = Usuarios::where("id_codigo","=",$codigo[0]["id"])->get();
            // si no existe insertar
            if($usuario->count()==0){
                //buscamos arbol a insertar
                $arbol = DB::table("arboles_libres")
                    ->where("campania","like",$codigo[0]["campania"])
                    ->limit(1)
                    ->get();

               
                if($arbol->count()==1){                    
                    DB::table('arboles')
                    ->where('id', $arbol[0]->id)
                    ->update(['status' => 2]);

                    //$date = DateTime::createFromFormat('Y/m/d', $row['fecha']);

                    return new Usuarios([
                        'id_arbol' => $arbol[0]->id,
                        'id_codigo' =>$codigo[0]["id"],
                        'nombre' => $row['nombre'],
                        'apellido' => $row['apellido'],
                        'dni' => $row['dni'],
                        'nacionalidad' => $row['nacionalidad'],
                        'email' => $row['correo'],
                        'metodopago' => $row['metodo'], 
                        'tipo_certificado' => $row['tipo'],
                        'nombre_de' => $row['dedicatoria'],
                        'nombre_certificado' => $row['nombre_certificado'],
                        'fecha_registro' =>$row['fecha']
                    ]);


                    ////////////////
                }else{
                    throw new Exception('No hay arboles.');
                }
                
            }else{
                throw new Exception('Usuario existe.');
            }            
        }else{
            //print_r(response()->json(['status' => 'error','mensaje' => 'Codigo no existe']));
            //print_r(json_encode(["status" => "error","mensaje" => 'Codigo no existe' ]));  
            //return false;
            //print_r(json_encode(["status" => "error","mensaje" => 'Codigo no existe' ]));
            //exit();
            throw new Exception('Codigo "' . $row["codigo"] . '" no existe.');
        }
    }
}