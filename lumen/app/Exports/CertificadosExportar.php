<?php

namespace App\Exports;

use App\Usuarios;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CertificadosExportar implements FromCollection, WithHeadings
{
    public function __construct(string $request)
    {        
        $this->request = json_decode($request);        
    }
    public function headings(): array
    {
        return [
            'ID',
            'DNI',
            'Nombre',
            'Apellido',
            'Nombre Certificado',
            'Nombre De',
            'Codigo de Foto',
            'Fecha de registro',
            'Campaña',
            'Tipo de certificado',
            'GPS',
            'Email',
            'Nacionalidad',
            'Nombre de Arbol',
            'Nombre científico de Arbol',
            'Codigo Usado'
        ];
    }
    public function collection()
    {     

        $buscar = $this->request->buscar;        
        $codigos = DB::table('certificados_exportar');
        $codigos=$codigos->where(function($query) use($buscar){
                $query->where('nombre', 'like', '%' . $buscar . '%')
                ->orWhere('apellido', 'like', '%' . $buscar . '%')
                ->orWhere('nombre_certificado', 'like', '%' . $buscar . '%');
            });
        if ($this->request->area) {
            $codigos=$codigos->where('codigo', 'like', $this->request->area."%" );
        }            
        if ($this->request->campana) {
            $codigos=$codigos->where('campania', 'like' , $this->request->campana);
        }
        if ($this->request->desde) {
            $codigos=$codigos->where('fecha_registro', '>=' , $this->request->desde);
        }
        if ($this->request->hasta) {
            $codigos=$codigos->where('fecha_registro', '<=' , $this->request->hasta);
        }
        $codigos=$codigos->get();
        
        //print_r($codigos);
        //die();

        return collect($codigos);

    }
}