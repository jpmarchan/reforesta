<?php

namespace App\Http\Controllers;

use App\Campanas;
use Illuminate\Http\Request;

class CampanasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
        $campanas = Campanas::get();
        
        return response()->json($campanas);
    }

}