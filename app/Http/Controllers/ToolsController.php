<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Phpoaipmh\Endpoint;
use App\Ckan\Request\PackageSearch;
use App\Models\DatasetDelete;
use App\Jobs\ProcessDatasetDelete;
use App\Models\Importer;
use App\Models\Import;
use App\Jobs\ProcessImport;
use App\Models\SourceDatasetIdentifier;
use App\Models\SourceDataset;
use App\Mappers\GfzMapper;
use App\Models\DatasetCreate;
use App\Ckan\Request\PackageCreate;
use App\Ckan\Request\PackageShow;
use App\Ckan\Response\PackageShowResponse;
use App\Ckan\Request\PackageUpdate;
use App\Ckan\Request\OrganizationList;
use App\Ckan\Response\OrganizationListResponse;
use App\Models\MappingLog;
use App\Ckan\Response\PackageSearchResponse;
use App\Mappers\Helpers\DataciteCitationHelper;
use App\Converters\MaterialsConverter;
use App\Exports\MappingLogsExport;
use Database\Seeders\MaterialKeywordsSeeder;
use App\Models\MaterialKeyword;
use App\Converters\RockPhysicsConverter;
use App\Converters\ExcelToJsonConverter;
use App\Exports\FilterTreeExport;

class ToolsController extends Controller
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
        
    public function convertKeywords()
    {        
        return view('convert-keywords');
    }
    
    public function processMaterialsFile(Request $request)
    {
        $request->validate([
            'materials-file' => 'required'
        ]);
                        
        if($request->hasFile('materials-file')) {
            $converter = new MaterialsConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('materials-file'));
            }, 'materials.json');
                        
        }
        
        return back()
            ->with('status','Error');
    }
    
    public function processRockPhysicsFile(Request $request)
    {        
        $request->validate([
            'rockphysics-file' => 'required',
            'sheet' => 'required'
        ]);
        
        if($request->hasFile('rockphysics-file')) {
            $converter = new RockPhysicsConverter();            
            $fullSheetName = '';
            
            switch ($request->input('sheet')) {
                case 'apparatus':
                    $fullSheetName = 'Apparatus';
                    break;
                    
                case 'ancillary':
                    $fullSheetName = 'Ancillary equipment';
                    break;
                    
                case 'pore':
                    $fullSheetName = 'Pore fluid';
                    break;
                    
                case 'measured':
                    $fullSheetName = 'Measured property';
                    break;
                    
                case 'inferred':
                    $fullSheetName = 'Inferred deformation behavior';
                    break;
            }
            
            
            return response()->streamDownload(function () use($converter, $request, $fullSheetName) {
                echo $converter->ExcelToJson($request->file('rockphysics-file'), $fullSheetName);
            }, $fullSheetName . '.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function convertExcel()
    {
        return view('convert-excel');
    }
    
    public function processExcelToJson(Request $request)
    {
        $request->validate([
            'excel-file' => 'required'
        ]);
        
        if($request->hasFile('excel-file')) {
            $converter = new ExcelToJsonConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('excel-file'));
            }, 'converted.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function filterTree()
    {
        return view('filter-tree');
    }
    
    public function filterTreeDownload()
    {
        $exporter = new FilterTreeExport();
                
        return response()->streamDownload(function () use($exporter) {
            echo $exporter->export();
        }, 'test.json');
    }
  
}
