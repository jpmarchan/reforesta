<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndiceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index(Request $request)
    {
        return response()->json(['status' => 'success']);
    }
    
}