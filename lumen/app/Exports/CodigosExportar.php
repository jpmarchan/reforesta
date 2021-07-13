<?php

namespace App\Exports;


use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;

class CodigosExportar implements FromCollection, WithHeadings
{
    public function __construct(string $request)
    {        
        $this->request = json_decode($request);        
    }
    public function headings(): array
    {
        return [
            'ID',
            'Código',
            'Campaña',
            'Estado'
        ];
    } 
    public function collection()
    {
        

        $campania='%%';
        if($this->request->campania) $campania=$this->request->campania;
        $codigos =  DB::table("codigos_con_estado_uso")->select('id', 'codigo','campania','estado');
        $codigos = $codigos->where('campania','like',$campania);        
        if ($this->request->estado!="") {
            $codigos=$codigos->where('estado', '=', $this->request->estado );
        }
        $codigos=$codigos->get();

        
        //print_r($codigos);
        //exit();


        return collect($codigos);

    }
}