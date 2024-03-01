<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    public function importLabData()
    {        
        return view('import-labdata');
    }
    
  
}
