<?php

namespace App\Imports;

use App\Prueba;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PruebaImportar implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Prueba|null
     */
    public function model(array $row)
    {
        return new Prueba([
           'nombre' => $row['nombre']
        ]);
    }
}