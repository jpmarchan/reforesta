<?php

namespace App\Http\Controllers;

use App\Tiposcertificado;
use Illuminate\Http\Request;

class TiposcertificadoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        $tc = Tiposcertificado::all();
        return response()->json($tc);
    }
    
}