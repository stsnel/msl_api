<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\IOFactory;
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
use App\Models\MaterialKeyword;
use App\Converters\RockPhysicsConverter;
use App\Converters\ExcelToJsonConverter;
use App\Exports\FilterTreeExport;
use App\Converters\PorefluidsConverter;
use App\Converters\AnalogueModellingConverter;
use App\Converters\GeologicalAgeConverter;
use App\Converters\GeologicalSettingConverter;
use App\Converters\PaleomagnetismConverter;
use App\Converters\GeochemistryConverter;
use App\Exports\UnmatchedKeywordsExport;
use App\Mappers\Helpers\KeywordHelper;
use App\Exports\AbstractMatchingExport;
use App\Converters\MicroscopyConverter;
use App\Models\Vocabulary;
use App\Exports\UriLabelExport;
use App\Models\Keyword;

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
    
    public function processPoreFluidsFile(Request $request)
    {
        $request->validate([
            'porefluids-file' => 'required'
        ]);
        
        if($request->hasFile('porefluids-file')) {
            $converter = new PorefluidsConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('porefluids-file'));
            }, 'porefluids.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    
    public function processRockPhysicsFile(Request $request)
    {        
        $request->validate([
            'rockphysics-file' => 'required'
        ]);
        
        if($request->hasFile('rockphysics-file')) {
            $converter = new RockPhysicsConverter();            
                        
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('rockphysics-file'));
            }, 'rockphysics.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function processAnalogueModellingFile(Request $request)
    {
        $request->validate([
            'analogue-file' => 'required'
        ]);
        
        if($request->hasFile('analogue-file')) {
            $converter = new AnalogueModellingConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('analogue-file'));
            }, 'analogue.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function processGeologicalAgeFile(Request $request)
    {
        $request->validate([
            'geological-age-file' => 'required'
        ]);
        
        if($request->hasFile('geological-age-file')) {
            $converter = new GeologicalAgeConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('geological-age-file'));
            }, 'geological-age.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function processGeologicalSettingFile(Request $request)
    {
        $request->validate([
            'geological-setting-file' => 'required'
        ]);
        
        if($request->hasFile('geological-setting-file')) {
            $converter = new GeologicalSettingConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('geological-setting-file'));
            }, 'geological-setting.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function processPaleomagnetismFile(Request $request)
    {
        $request->validate([
            'paleomagnetism-file' => 'required'
        ]);
        
        if($request->hasFile('paleomagnetism-file')) {
            $converter = new PaleomagnetismConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('paleomagnetism-file'));
            }, 'paleomagnetism.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function processGeochemistryFile(Request $request)
    {
        $request->validate([
            'geochemistry-file' => 'required'
        ]);
        
        if($request->hasFile('geochemistry-file')) {
            $converter = new GeochemistryConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('geochemistry-file'));
            }, 'geochemistry.json');
                
        }
        
        return back()
        ->with('status','Error');
    }
    
    public function processMiscroscopyFile(Request $request)
    {
        $request->validate([
            'microscopy-file' => 'required'
        ]);
        
        if($request->hasFile('microscopy-file')) {
            $converter = new MicroscopyConverter();
            
            return response()->streamDownload(function () use($converter, $request) {
                echo $converter->ExcelToJson($request->file('microscopy-file'));
            }, 'microscopy.json');
                
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
    
    public function uriLabels()
    {
        return view('uri-labels');
    }
    
    public function uriLabelsDownload()
    {
        $exporter = new UriLabelExport();
        
        return response()->streamDownload(function () use($exporter) {
            echo $exporter->export();
        }, 'uri-labels.json');
    }
    
    public function filterTree()
    {
        return view('filter-tree');
    }            
    
    public function filterTreeDownload()
    {
        $exporter = new FilterTreeExport();
                
        return response()->streamDownload(function () use($exporter) {
            echo $exporter->exportInterpreted();
        }, 'interpreted.json');
    }
    
    public function filterTreeDownloadOriginal()
    {
        $exporter = new FilterTreeExport();
        
        return response()->streamDownload(function () use($exporter) {
            echo $exporter->exportOriginal();
        }, 'original.json');
    }
    
    public function viewUnmatchedKeywords()
    {
        $client = new \GuzzleHttp\Client();
        
        $searchRequest = new PackageSearch();
        $searchRequest->rows = 1000;
        $searchRequest->query = 'type: data-publication';
        
        try {
            $response = $client->request($searchRequest->method, $searchRequest->endPoint, $searchRequest->getAsQueryArray());
        } catch (\Exception $e) {
            
        }
        
        $content = json_decode($response->getBody(), true);
        $results = $content['result']['results'];                
                                
        $keywords = [];
        foreach ($results as $result) {
            if(count($result['tags']) > 0) {
                foreach ($result['tags'] as $tag) {
                    if(!array_key_exists($tag['name'], $keywords)) {
                        $keywords[$tag['name']] = 1;
                    } else {
                        $keywords[$tag['name']] = $keywords[$tag['name']] + 1;
                    }
                }
            }
        }
        
        uasort($keywords, function($a, $b) {
            return $b - $a;
        });
        
        return view('unmatched-keywords', ['keywords' => $keywords]);
    }
    
    public function downloadUnmatchedKeywords()
    {
        return Excel::download(new UnmatchedKeywordsExport(), 'unmatched-keywords.xlsx');
    }
    
    public function abstractMatching(Request $request)
    {
        $client = new \GuzzleHttp\Client();
        
        $OrganizationListrequest = new OrganizationList();
        
        try {
            $response = $client->request($OrganizationListrequest->method,
                $OrganizationListrequest->endPoint,
                $OrganizationListrequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $organizationListResponse = new OrganizationListResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        $organizations = $organizationListResponse->getOrganizations();
        
        $filteredOrganizations = [];        
        
        foreach ($organizations as $organization) {
            if($organization['name'] !== 'epos-multi-scale-laboratories-thematic-core-service')
            {
                $filteredOrganizations[] = $organization;
            }
        }
        
        $data = [];
        $selected = '';
        
        if ($request->has('datasetSource')) {
            $datasetSource = $request->query('datasetSource');
            $selected = $datasetSource;
            
            $searchRequest = new PackageSearch();
            $searchRequest->rows = 10;
            $searchRequest->query = 'type: data-publication';
            $searchRequest->filterQuery =  'owner_org:' . $datasetSource;
            
            try {
                $response = $client->request($searchRequest->method, $searchRequest->endPoint, $searchRequest->getAsQueryArray());
            } catch (\Exception $e) {
                
            }
            
            $content = json_decode($response->getBody(), true);
            $results = $content['result']['results'];
            
            //dd($results);
            
            $keywordHelper = new KeywordHelper();
                    
            foreach ($results as $result) {
                $item = [];
                $item['identifier'] = $result['msl_doi'];
                $item['title'] = $result['title'];
                $item['abstract'] = $result['notes'];
                $item['keywords'] = [];
                $keywords = $keywordHelper->extractFromText($item['abstract'] . ' ' . $item['title']);
                
                foreach ($keywords as $keyword) {
                    $item['keywords'][] = $keyword->getFullPath('>', true);
                }
                
                $data[] = $item;
            }
        }
                                
        
        return view('abstract-matching', ['data' => $data, 'organizations' => $filteredOrganizations, 'selected' => $selected]);
    }
    
    public function abstractMatchingDownload($dataRepo) 
    {
        return Excel::download(new AbstractMatchingExport($dataRepo), 'abstract-matching.xlsx');
    }
    
    public function queryGenerator()
    {
        /*
         * Produce Datacite query by using adusted vocabulary files in Excel format
         */
        
        $terms = [];
        
        // Materials
        $filepath = base_path('storage/app/datacite-input/materials_1-0 Reduced.xlsx');
        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestDataRow()) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            
            $rowData = [];
            
            foreach ($cellIterator as $cell) {
                $rowData[$cell->getColumn()] = $cell->getValue();
            }
            
            if(strlen($rowData['E']) > 0) {
                $terms[] = $rowData['E'];               
            } elseif(strlen($rowData['D']) > 0) {
                $terms[] = $rowData['D'];
            } elseif(strlen($rowData['C']) > 0) {
                $terms[] = $rowData['C'];
            } elseif(strlen($rowData['B']) > 0) {
                $terms[] = $rowData['B'];
            } elseif(strlen($rowData['A']) > 0) {
                $terms[] = $rowData['A'];
            }
            
            // add synonyms
            if(strlen($rowData['F']) > 0) {
                $terms = array_merge($terms, $this->extractSynonyms($rowData['F']));
            }            
        }
        
        $materialTerms = $terms;
        //dd(count($materialTerms)); //454
        
        $terms = [];
        //analogue modeling
        $filepath = base_path('storage/app/datacite-input/analogue_reduced.xlsx');
        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestDataRow()) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            
            $rowData = [];
            
            foreach ($cellIterator as $cell) {
                $rowData[$cell->getColumn()] = $cell->getValue();
            }                      
            
            if(strlen($rowData['E']) > 0) {
                $terms[] = $rowData['E'];
            } elseif(strlen($rowData['D']) > 0) {
                $terms[] = $rowData['D'];
            } elseif(strlen($rowData['C']) > 0) {
                $terms[] = $rowData['C'];
            } elseif(strlen($rowData['B']) > 0) {
                $terms[] = $rowData['B'];
            } elseif(strlen($rowData['A']) > 0) {
                $terms[] = $rowData['A'];
            }
            
            // add synonyms
            if(strlen($rowData['F']) > 0) {
                $terms = array_merge($terms, $this->extractSynonyms($rowData['F']));
            }
        }
        
        $analogueTerms = $terms;
        //dd(count($analogueTerms)); // 40
        
        
        $terms = [];
        //geochemistry
        $filepath = base_path('storage/app/datacite-input/geochemistry_1-0 reduced.xlsx');
        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestDataRow()) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            
            $rowData = [];
            
            foreach ($cellIterator as $cell) {
                $rowData[$cell->getColumn()] = $cell->getValue();
            }
                        
            if(strlen($rowData['D']) > 0) {
                $terms[] = $rowData['D'];
            } elseif(strlen($rowData['C']) > 0) {
                $terms[] = $rowData['C'];
            } elseif(strlen($rowData['B']) > 0) {
                $terms[] = $rowData['B'];
            } elseif(strlen($rowData['A']) > 0) {
                $terms[] = $rowData['A'];
            }
            
            // add synonyms
            if(strlen($rowData['E']) > 0) {
                $terms = array_merge($terms, $this->extractSynonyms($rowData['F']));
            }
        }
        
        $geochemistryTerms = $terms;
        //dd(count($geochemistryTerms), $geochemistryTerms); //68
        
        $terms = [];
        //microscopy
        $filepath = base_path('storage/app/datacite-input/microscopy_1-0 reduced.xlsx');
        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestDataRow()) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            
            $rowData = [];
            
            foreach ($cellIterator as $cell) {
                $rowData[$cell->getColumn()] = $cell->getValue();
            }
                        
            if(strlen($rowData['E']) > 0) {
                $terms[] = $rowData['E'];
            } elseif(strlen($rowData['D']) > 0) {
                $terms[] = $rowData['D'];
            } elseif(strlen($rowData['C']) > 0) {
                $terms[] = $rowData['C'];
            } elseif(strlen($rowData['B']) > 0) {
                $terms[] = $rowData['B'];
            } elseif(strlen($rowData['A']) > 0) {
                $terms[] = $rowData['A'];
            }
            
            // add synonyms
            if(strlen($rowData['F']) > 0) {
                $terms = array_merge($terms, $this->extractSynonyms($rowData['F']));
            }
        }
        
        $microscopyTerms = $terms;
        //dd(count($microscopyTerms), $microscopyTerms); //164
        
        
        $terms = [];
        //paleo
        $filepath = base_path('storage/app/datacite-input/paleomagnetism_1-0 reduced.xlsx');
        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestDataRow()) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            
            $rowData = [];
            
            foreach ($cellIterator as $cell) {
                $rowData[$cell->getColumn()] = $cell->getValue();
            }
                        
            if(strlen($rowData['E']) > 0) {
                $terms[] = $rowData['E'];
            } elseif(strlen($rowData['D']) > 0) {
                $terms[] = $rowData['D'];
            } elseif(strlen($rowData['C']) > 0) {
                $terms[] = $rowData['C'];
            } elseif(strlen($rowData['B']) > 0) {
                $terms[] = $rowData['B'];
            } elseif(strlen($rowData['A']) > 0) {
                $terms[] = $rowData['A'];
            }
            
            // add synonyms
            if(strlen($rowData['F']) > 0) {
                $terms = array_merge($terms, $this->extractSynonyms($rowData['F']));
            }
        }
        
        $paleoTerms = $terms;
        //dd(count($paleoTerms), $paleoTerms); //94
        
        
        $terms = [];
        //rock
        $filepath = base_path('storage/app/datacite-input/rockphysics_1-0 reduced.xlsx');
        $spreadsheet = IOFactory::load($filepath);
        $worksheet = $spreadsheet->getActiveSheet();
        
        foreach ($worksheet->getRowIterator(2, $worksheet->getHighestDataRow()) as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
            
            $rowData = [];
            
            foreach ($cellIterator as $cell) {
                $rowData[$cell->getColumn()] = $cell->getValue();
            }
                        
            if(strlen($rowData['E']) > 0) {
                $terms[] = $rowData['E'];
            } elseif(strlen($rowData['D']) > 0) {
                $terms[] = $rowData['D'];
            } elseif(strlen($rowData['C']) > 0) {
                $terms[] = $rowData['C'];
            } elseif(strlen($rowData['B']) > 0) {
                $terms[] = $rowData['B'];
            } elseif(strlen($rowData['A']) > 0) {
                $terms[] = $rowData['A'];
            }
            
            // add synonyms
            if(strlen($rowData['F']) > 0) {
                $terms = array_merge($terms, $this->extractSynonyms($rowData['F']));
            }
        }
        
        $rockTerms = $terms;
        dd(count($rockTerms), $rockTerms); //176
        
        
        
        /*
         //* Produce and display query for testing with datacite
         * Results of query should contain one word from two large groups:
         * 1. Material or Geologic setting vocabularies
         * 2. Apparatus and Technique sections of domain specific vocabularies
         */
        
        $materialVocab = Vocabulary::where('name', 'materials')->where('version', '1.1')->first();
        $materialTerms = $materialVocab->search_keywords;
        $terms = array();
        $query = "";
        $total = 0;
                        
        foreach ($materialTerms as $materialTerm) {
            $terms[] = '"' . $materialTerm->search_value . '"';
        }
                
        $geologicalSettingsVocab = Vocabulary::where('name', 'geologicalsetting')->where('version', '1.1')->first();
        $geologicalSettingsTerms = $geologicalSettingsVocab->search_keywords;
        
        foreach ($geologicalSettingsTerms as $geologicalSettingsTerm) {
            $terms[] = '"' . $geologicalSettingsTerm->search_value . '"';
        }
        
        $query .= "(" . implode(' OR ', $terms) . ")";
        
        $query .= " AND ";
        
        $total += count($terms);
        
        $terms = [];
                
        //analogue modeling apparatus        
        $keywords = Keyword::where('uri', 'like', 'https://epos-msl.uu.nl/voc/analoguemodelling/1.1/apparatus-%')->get();
        foreach ($keywords as $keyword) {
            foreach ($keyword->keyword_search as $searchKeyword) {
                $terms[] = '"' . $searchKeyword->search_value . '"';
            }
        }
        
        //geochemistry technique
        $keywords = Keyword::where('uri', 'like', 'https://epos-msl.uu.nl/voc/geochemistry/1.1/technique-%')->get();
        foreach ($keywords as $keyword) {
            foreach ($keyword->keyword_search as $searchKeyword) {
                $terms[] = '"' . $searchKeyword->search_value . '"';
            }
        }
        
        //microscopy apparatus        
        $keywords = Keyword::where('uri', 'like', 'https://epos-msl.uu.nl/voc/microscopy/1.1/apparatus-%')->get();
        foreach ($keywords as $keyword) {
            foreach ($keyword->keyword_search as $searchKeyword) {
                $terms[] = '"' . $searchKeyword->search_value . '"';
            }
        }
        
        //microscopy technique
        $keywords = Keyword::where('uri', 'like', 'https://epos-msl.uu.nl/voc/microscopy/1.1/technique-%')->get();
        foreach ($keywords as $keyword) {
            foreach ($keyword->keyword_search as $searchKeyword) {
                $terms[] = '"' . $searchKeyword->search_value . '"';
            }
        }
        
        //paleomagnetism apparatus        
        $keywords = Keyword::where('uri', 'like', 'https://epos-msl.uu.nl/voc/paleomagnetism/1.1/apparatus-%')->get();
        foreach ($keywords as $keyword) {
            foreach ($keyword->keyword_search as $searchKeyword) {
                $terms[] = '"' . $searchKeyword->search_value . '"';
            }
        }
        
        //rockphysics apparatus
        $terms = [];
        $keywords = Keyword::where('uri', 'like', 'https://epos-msl.uu.nl/voc/rockphysics/1.1/apparatus-%')->get();
        foreach ($keywords as $keyword) {
            foreach ($keyword->keyword_search as $searchKeyword) {
                $terms[] = '"' . $searchKeyword->search_value . '"';
            }
        }
        dd(count($terms));
        
        
        $query .= "(" . implode(' OR ', $terms) . ")";
        $total += count($terms);
        
        dd($total);
        
        return view('query-generator', ['query' => $query]);
    }
    
    private function extractSynonyms($string)
    {
        $synonyms = [];
        if(str_contains($string, '#')) {
            $parts = explode('#', $string);
            array_shift($parts);
            foreach ($parts as $part) {
                $synonyms[] = trim($part);
            }
        }
        
        return $synonyms;
    }
  
}
