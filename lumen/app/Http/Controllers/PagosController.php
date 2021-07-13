<?php

namespace App\Http\Controllers;

use App\Pagos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PagosController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $reporte = DB::table("reporte_pagos");      
        $reporte=$reporte->orderBy('pago_date', 'DESC'); 
        if ($request->correo) {
            $reporte=$reporte->where('pago_email', 'like', "%".$request->correo."%" );
        }
        $reporte=$reporte->paginate($request->paginado);  
        return response()->json($reporte);
    }
    
}