<?php

namespace App\Exports;

use App\Arboles;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ArbolesExportar implements FromCollection, WithHeadings
{
    public function __construct(string $request)
    {        
        $this->request = json_decode($request);        
    }
    public function headings(): array
    {
        return [
            'ID',
            'GPS',
            'Fecha de siembra',
            'Fecha de foto',
            'Nombre',
            'Nombre Cientifico',
            'Estado (1 es activo - 0 es inactivo)',            
            'Código',
            'Campaña'
        ];
    }
    public function collection()
    {
        

        $nombreArbol='%%';
        if($this->request->nombreArbol) $nombreArbol=$this->request->nombreArbol;
        $campania='%%';
        if($this->request->campania) $campania=$this->request->campania;
        
        if( $this->request->anio ){         
            $arboles = Arboles::select('id','gps','fecha_siembra','fecha_foto','nombre','nombre_c','status','codigo','campania')
                ->where('nombre','like',$nombreArbol)
                ->where('campania','like',$campania)
                ->whereYear('fecha_foto', '=', $this->request->anio)
                ->orderBy('id', 'DESC')->get();
        }
        else{
            $arboles = Arboles::select('id','gps','fecha_siembra','fecha_foto','nombre','nombre_c','status','codigo','campania')
                ->where('nombre','like',$nombreArbol)
                ->where('campania','like',$campania)
                ->orderBy('id', 'DESC')
                ->get();
        }

        return collect($arboles);

    }
}