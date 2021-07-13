<?php

namespace App\Imports;

use App\Arboles;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Exception;

class ArbolesImportar implements ToModel,WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return User|null
     */
    public function model(array $row)
    {
        //campania	codigo	gps	fecha_siembra	fecha_foto	nombre	nombre_c
        return new Arboles([
           'campania' => $row['campania'],
           'codigo' => $row['codigo'],
           'gps' => $row['gps'],
           'fecha_siembra' => $row['fecha_foto'],
           'fecha_foto' => $row['fecha_foto'],
           'nombre' => $row['nombre'],
           'nombre_c' => $row['nombre_cientifico'],
           'area' => $row['area'],
           'ubicacion' => $row['ubicacion'],
           'status' => $row['status'],
           'num_arbol' => 1
        ]);
    }
}