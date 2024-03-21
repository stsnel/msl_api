<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaboratoryUpdateGroupFast;
use App\Jobs\ProcessLaboratoryUpdateGroupFast;
use App\Exports\epos\RegistryExport;
use App\Models\Laboratory;

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
    
    public function updateFastData(Request $request)
    {
        $laboratoryUpdateGroup = LaboratoryUpdateGroupFast::create();        
        ProcessLaboratoryUpdateGroupFast::dispatch($laboratoryUpdateGroup);
                            
        $request->session()->flash('status', 'Updating using Fast started');        
        return redirect()->route('importers');        
    }
    
    public function registryTurtle()
    {
        $laboratories = Laboratory::where('fast_id', 50)->get();
        
        $exporter = new RegistryExport($laboratories);
        
        
        dd($exporter->export());
        
        dd('turtle file');
    }
    
  
}
