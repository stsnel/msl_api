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

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
        
        return view('home');
    }
    
    public function removeDataset()
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
        
        $organizationListResponse =  new OrganizationListResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        $organizations = $organizationListResponse->getOrganizations();
        
        return view('remove-dataset', ['organizations' => $organizations]);
    }
    
    public function removeDatasetConfirm(Request $request)
    {
        $results = [];
        
        if($request->has('datasetId')) {
            $datasetId = $request->query('datasetId');
            if($datasetId) {                
                $client = new \GuzzleHttp\Client();
                
                $searchRequest = new PackageSearch();                
                $searchRequest->query = 'name:' . $datasetId;
                try {
                    $response = $client->request($searchRequest->method, $searchRequest->endPoint, $searchRequest->getAsQueryArray());
                } catch (\Exception $e) {
                    
                }
                
                $content = json_decode($response->getBody(), true);                
                $results = $content['result']['results'];
                
                return view('remove-dataset-confirm', ['results' => $results]);
            } else {
                
            }
        } elseif ($request->has('datasetSource')) {
            $datasetSource = $request->query('datasetSource');
            
            if($datasetSource) {                
                $client = new \GuzzleHttp\Client();
                
                $searchRequest = new PackageSearch();
                $searchRequest->rows = 1000;
                $searchRequest->query = 'owner_org:' . $datasetSource;
                try {
                    $response = $client->request($searchRequest->method, $searchRequest->endPoint, $searchRequest->getAsQueryArray());
                } catch (\Exception $e) {
                    
                }
                
                $content = json_decode($response->getBody(), true);
                $results = $content['result']['results'];
                
                return view('remove-dataset-confirm', ['results' => $results]);
            }
        } else {
            
        }
        
        return view('remove-dataset-confirm', ['results' => $results]);
    }
    
    public function removeDatasetConfirmed(Request $request) 
    {
        if($request->has('names')) {
            $names = $request->input('names');
            
            foreach ($names as $name) {
                $datasetDelete = DatasetDelete::create([
                    'ckan_id' => $name
                ]);
                
                ProcessDatasetDelete::dispatch($datasetDelete);
            }
            
            $request->session()->flash('status', 'Task was successful!');
        }
        return redirect()->route('home');
    }
    
    public function queues()
    {
        $deletes = DatasetDelete::where('response_code', null)->get();
                
        return view('queues', ['deletes' => $deletes]);
    }
    
    public function deleteActions()
    {
        $deletes = DatasetDelete::paginate(50);
        
        return view('deletes', ['deletes' => $deletes]);
    }
    
    public function importers()
    {
        $importers = Importer::all();
        
        return view('importers', ['importers' => $importers]);
    }
    
    public function importerImports($id)
    {               
        $imports = Import::where('importer_id', (int)$id)->get();
        $importer = Importer::where('id', $id)->first();
     
        return view('importer-imports', ['imports' => $imports, 'importer' => $importer]);        
    }
    
    public function importerImportsFlow($id, $importId)
    {
        $sourceDatasetidentifiers = SourceDatasetIdentifier::where('import_id', $importId)->paginate(50);
        
        return view('importer-import-flow', ['sourceDatasetIdentifiers' => $sourceDatasetidentifiers, 'importer_id' => $id, 'import_id' => $importId]);
    }
    
    public function importerImportsLog($id, $importId)
    {
        $logs = MappingLog::where('import_id', $importId)->paginate(50);
        
        return view('importer-import-log', ['logs' => $logs, 'importer_id' => $id, 'import_id' => $importId]);
    }
    
    public function exportImportLog($id, $importId)
    {
        return Excel::download(new MappingLogsExport($importId), 'log.xlsx');
    }
    
    public function importerImportsDetail($importerid, $importId, $sourceDatasetIdentifierId)
    {
        $sourceDatasetIdentifier = SourceDatasetIdentifier::where('id', $sourceDatasetIdentifierId)->first();
        
        if($sourceDatasetIdentifier) {
            return view('importer-import-detail', ['sourceDatasetIdentifier' => $sourceDatasetIdentifier, 'importer_id' => $importerid, 'import_id' => $importId]);
        }
        
        abort(404, 'Invalid data requested');
    }
    
    public function createimport(Request $request)
    {
        if($request->has('importer-id')) {
            $importId = $request->input('importer-id');
            
            $import = Import::create([
                'importer_id' => $importId
            ]);
            
            ProcessImport::dispatch($import);
            
            $request->session()->flash('status', 'Import started');
        }
        
        return redirect()->route('importers');
    }
    
    public function imports()
    {
        $imports = Import::paginate(50);
        
        return view('imports', ['imports' => $imports]);
    }
    
    public function sourceDatasetIdentifiers()
    {
        $identifiers = SourceDatasetIdentifier::paginate(50);
        
        return view('source-dataset-identifiers', ['identifiers' => $identifiers]);
    }
    
    public function sourceDatasets()
    {
        $sourceDatasets = SourceDataset::paginate(50);
        
        return view('source-datasets', ['sourceDatasets' => $sourceDatasets]);
    }
    
    public function sourceDataset($id)
    {
        $sourceDatasetid = (int)$id;
        
        $sourceDataset = SourceDataset::where('id', $sourceDatasetid)->first();
        
        if($sourceDataset) {
            return view('source-dataset', ['sourceDataset' => $sourceDataset]);
        }
        
        abort(404, 'SourceDataset not found');
    }
    
    public function createActions()
    {
        $createActions = DatasetCreate::paginate(50);
        
        return view('creates', ['createActions' => $createActions]);
    }
    
    public function createAction($id)
    {
        $createActionId = (int)$id;
        
        $datasetCreate = DatasetCreate::where('id', $createActionId)->first();
        
        if($datasetCreate) {
            return view('create', ['datasetCreate' => $datasetCreate]);
        }
        
        abort(404, 'DatasetCreate not found');
    }
        
    public function test()
    {
        $importer = Importer::where('id', 1)->first();
        
        $newOptions = [
            'importProcessor' => [
                'type' => 'oaiListing',
                'options' => [
                    'oaiEndpoint' => 'https://doidb.wdc-terra.org/oaip/oai',
                    'metadataPrefix' => 'iso19139',
                    'setDefinition' => '~P3E9c3ViamVjdCUzQSUyMm11bHRpLXNjYWxlK2xhYm9yYXRvcmllcyUyMg'
                ]
            ],
            'identifierProcessor' => [
                'type' => 'oaiRetrieval',
                'options' => [
                    'oaiEndpoint' => 'https://doidb.wdc-terra.org/oaip/oai',
                    'metadataPrefix' => 'iso19139',
                ]
            ],
            'sourceDatasetProcessor' => [
                'type' => 'gfzMapper',
                'options' => []
            ]
        ];
        
        $importer->options = $newOptions;
        $importer->save();
        dd('ja');
        
        //test conversion of yoda excel file to json file
        $inputfile = "../storage/app/import-data/yoda/Datapublicaties_EPOS_v02.xlsx";
        //dd(Storage::disk()->exists("/import-data/yoda/Datapublicaties_EPOS_v02.xlsx"));
        
        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputfile);
        $worksheet = $spreadsheet->getActiveSheet();
        
        
        $fields = [];
        $observations = [];
        foreach ($worksheet->getRowIterator() as $row) {            
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(FALSE);
                        
            $observation = [];

            foreach ($cellIterator as $cell) {
                if($row->getRowIndex() == 1) {
                    $fields[$cell->getColumn()] = $cell->getValue();
                } else {
                    $observation[$fields[$cell->getColumn()]] = $cell->getValue();                     
                }                    
            }
            if(count($observation) > 0) {
                $observations[] = $observation;
            }            
        }
        
        dd(json_encode($observations, JSON_PRETTY_PRINT));        
        
        
        
        
        foreach ($worksheet->getRowIterator(3, $worksheet->getHighestDataRow()) as $row) {
            
            $cellIterator = $row->getCellIterator('A', 'E');
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,
            
            foreach ($cellIterator as $cell) {
                if($cell->getValue()) {
                    if($cell->getValue() !== "") {
                        $node = [
                            'value' => '',
                            'hyperlink' => '',
                            'level' => null
                        ];
                        
                        $node['value'] = $cell->getValue();
                        if($cell->hasHyperlink()) {
                            $node['hyperlink'] = $cell->getHyperlink()->getUrl();
                        }
                        $node['level'] = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($cell->getColumn());
                        
                        $nodes[] = $node;
                    }
                }
            }
        }
        
        
        
        
        
        
        $converter = new MaterialsConverter();
        dd($converter->ExcelToJson('../storage/app/keywords/MSL 2021 material_V9.xlsx'));
        
        //test Excel reading
        //$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        //$spreadsheet = $reader->load("../storage/app/keywords/MSL 2021 material_V9.xlsx");
        $inputFileName = '../storage/app/keywords/MSL 2021 material_V9.xlsx';
        
        //Storage::disk()->exists('neenee.xls');
        dd(Storage::disk()->exists("/keywords/MSL 2021 material_V9.xlsx"));
        
        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        
        
        
        
        //test datacite xml extraction
        //doi #1: 10.7288/V4/MAGIC/16834
        //doi #2: 10.24416/UU01-575EWU
        
        
        $client = new \GuzzleHttp\Client();
        
        $response = $client->request('GET', 'https://api.datacite.org/dois/10.24416%2FUU01-575EWU', [
            'headers' => [
                'Accept' => 'application/vnd.api+json',
            ],
        ]);
        
        $jsonResponseBody = json_decode($response->getBody(), true);
        $xmlEncoded = $jsonResponseBody['data']['attributes']['xml'];
        $xmlDecoded = base64_decode($xmlEncoded);
        
        echo "<pre>$xmlDecoded</pre>";
        exit();
        
        
        dd(base64_decode($xmlEncoded));
        
        
        dd($jsonResponseBody['data']['attributes']['xml']);
        
        
        dd(json_decode($response->getBody(), true));
        
        
        dd('test');
        
        
        
        //update options for gfz importer while testing
        $importer = Importer::where('id', 1)->first();
        
        dd($importer->options['importProcessor']['type']);                
        
        $newOptions = [
            'importProcessor' => [
                'type' => 'oaiListing',
                'options' => [
                    'oaiEndpoint' => 'https://doidb.wdc-terra.org/oaip/oai',
                    'metadataPrefix' => 'iso19139',
                    'setDefinition' => '~P3E9c3ViamVjdCUzQSUyMm11bHRpLXNjYWxlK2xhYm9yYXRvcmllcyUyMg'
                ]
            ],
            'identifierProcessor' => [
                'type' => 'oaiRetrieval',
                'options' => [
                    'oaiEndpoint' => 'https://doidb.wdc-terra.org/oaip/oai',
                    'metadataPrefix' => 'iso19139',
                ]
            ],
            'sourceDatasetProcessor' => [
                'type' => 'gfzMapper',
                'options' => []
            ]            
        ];
        
        $importer->options = $newOptions;
        $importer->save();
        
        dd($importer->options);
        
        
        //???        
        $client = new \GuzzleHttp\Client();
        $datasetCreate = DatasetCreate::where('id', 123)->first();
        
        //check if package is already in ckan
        $packageShowRequest = new PackageShow();
        $packageShowRequest->id = $datasetCreate->dataset['name'];
        
        dd($packageShowRequest);
        
        try {
            $response = $client->request(
                $packageShowRequest->method,
                $packageShowRequest->endPoint,
                $packageShowRequest->getPayloadAsArray()
                );
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        dd(json_decode($response->getBody(), true));
        dd($response);
        
        
        //test GFZ mapping subdomain detection
        $sourceDataset = SourceDataset::where('id', 118)->first();
        
        $mapper = new GfzMapper();
        
        $dataset = $mapper->map($sourceDataset);
        
        dd($dataset);
        
        
        
        //test gfz mapper alterations
        $sourceDataset = SourceDataset::where('id', 104)->first();
        
        //the DatasetCreate has to actually exist. The dataset property is always avialable but might be NULL.
        //in theory msl_source might also contain invalid information. However this is not crucial for these display purposes.
        //if instead the DOI value should be extracted from the msl_pids multi-valued field more checks are required as
        //multiple msl_pids might be present. These might also not be of type DOI or multiple DOIs might exists within
        //all available msl_pids.
        $datasetCreate = $sourceDataset->dataset_create->dataset['msl_source'];
        
        //below should resolve msl_pids fields even when empty.
        $datasetCreate = $sourceDataset->dataset_create->dataset['msl_pids'];
        
        dd($datasetCreate);
        
        $mapper = new GfzMapper();
        
        $dataset = $mapper->map($sourceDataset);
        
        dd($dataset::class);
        
        dd($dataset);
        
        
        $keyword = MaterialKeyword::where('id', '2')->first();
        
        $ancestors = $keyword->getAncestors();
        
        dd($keyword->getAncestorsValues());
        
        $values = [];
        foreach ($ancestors as $ancestor) {
            $values[] = $ancestor->value;
        }
        
        dd($values);
        dd($keyword->getAncestors());
        
        dd('test');
        
        $seeder = new MaterialKeywordsSeeder();
        $seeder->run();
        
        
        $test = new \DateTime('2019-08-30');
        $result = $test->format('Y-m-d H:i:s');
        
        $test2 = new \DateTime('2016-01');
        $result2 = $test2->format('Y-m-d H:i:s');
        
        //2016-01
        dd($result, $result2);
        
        
        //test gfz mapper alterations
        $sourceDataset = SourceDataset::where('id', 113)->first();
        $mapper = new GfzMapper();
        
        $dataset = $mapper->map($sourceDataset);
        
        dd($dataset);
        
        // test ftp listing
        // sample result from xml = ftp://datapub.gfz-potsdam.de/download/10.5880.FID.2018.008"
        
        $ftpHost = "datapub.gfz-potsdam.de";
        $ftpUser = "anonymous";
        $ftpPassword = "";
        
        $ftp = ftp_connect($ftpHost) or die("Couldn't connect to $ftpHost");
        
        //$mode = ftp_pasv($ftp, true);
        
        if (@ftp_login($ftp, $ftpUser, $ftpPassword)) {
            echo "Current directory: " . ftp_pwd($ftp) . "\n";
            $mode = ftp_pasv($ftp, true);
            
            try {
                //$test = "/download/10.5880.FID.2018.008";
                $test = "/download/10.5880.GFZ.4.1.2017.001/";
                
                ftp_chdir($ftp, $test);
            } catch (\Exception $e) {
                ftp_close($ftp);
                dd('JAJA');
            }
                                    
            //$contents = ftp_rawlist($ftp, "*");
            //$contents = ftp_rawlist($ftp, "*");
            
            echo "Current directory: " . ftp_pwd($ftp) . "\n";
            
            $contents = ftp_mlsd($ftp, "/download/10.5880.GFZ.4.1.2017.001");
            if($mode) {
                echo 'ja';
            } else {
                echo 'nee';
            }
            //$contents = ftp_nlist($ftp, '*');
            //dd($contents);
            
        } else {
            echo "Couldn't connect as $ftpUser\n";
        }
        
        
        
        // close the connection
        ftp_close($ftp);
        dd($contents);
        
        dd('jajaja');
        
        
        
        
        $converter = new MaterialsConverter();                
        dd($converter->ExcelToJson('../storage/app/keywords/MSL 2021 material_V9.xlsx'));
        
        //test Excel reading
        //$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        //$spreadsheet = $reader->load("../storage/app/keywords/MSL 2021 material_V9.xlsx");                
        $inputFileName = '../storage/app/keywords/MSL 2021 material_V9.xlsx';
        
        //Storage::disk()->exists('neenee.xls');
        dd(Storage::disk()->exists("/keywords/MSL 2021 material_V9.xlsx"));
        
        /** Load $inputFileName to a Spreadsheet Object  **/
        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($inputFileName);
        $worksheet = $spreadsheet->getActiveSheet();
        
        //dd($worksheet->calculateWorksheetDataDimension());
        //dd($worksheet->getHighestDataRow());
        
        $nodes = [];
        
        foreach ($worksheet->getRowIterator(3, $worksheet->getHighestDataRow()) as $row) {
            
            $cellIterator = $row->getCellIterator('A', 'E');
            $cellIterator->setIterateOnlyExistingCells(FALSE); // This loops through all cells,

            foreach ($cellIterator as $cell) {
                if($cell->getValue()) {
                    if($cell->getValue() !== "") {
                        $node = [
                            'value' => '',
                            'hyperlink' => '',
                            'level' => null
                        ];
                        
                        $node['value'] = $cell->getValue();
                        if($cell->hasHyperlink()) {
                            $node['hyperlink'] = $cell->getHyperlink()->getUrl();
                        }
                        $node['level'] = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($cell->getColumn());
                        
                        $nodes[] = $node;
                    }
                }
            }                            
        }
        
        dd($nodes);
        
        dd($spreadsheet);
                        
        
        dd('jaja');
        
        
        
        // test get formatted text citation
        $DataciteHelper = new DataciteCitationHelper();
        dd($DataciteHelper->getCitationString("10.1038/s41598-018-22889-3"));
        
        
        
        $client = new \GuzzleHttp\Client();
        
        $response = $client->request(
            'GET', 
            'https://doi.org/doi:10.1016/j.tecto.2017.11.018',
            ['headers' => [
                'Accept' => 'text/x-bibliography; style=apa'
            ]]);
        
        //dd($response->getStatusCode());
        //dd(json_decode($response->getBody(), true));
        dd((string)$response->getBody());
        
        
        
        // test ftp listing
        // sample result from xml = ftp://datapub.gfz-potsdam.de/download/10.5880.FID.2018.008"
        
        $ftpHost = "datapub.gfz-potsdam.de";
        $ftpUser = "anonymous";
        $ftpPassword = "";
        
        $ftp = ftp_connect($ftpHost) or die("Couldn't connect to $ftpHost"); 
        
        if (@ftp_login($ftp, $ftpUser, $ftpPassword)) {
            echo "Current directory: " . ftp_pwd($ftp) . "\n";
            
            
            if (ftp_chdir($ftp, "/download/10.5880.FID.2018.008")) {
                echo "Current directory is now: " . ftp_pwd($ftp) . "\n";
            } else {
                echo "Couldn't change directory\n";
            }
            
            
        } else {
            echo "Couldn't connect as $ftpUser\n";
        }
        
        // close the connection
        ftp_close($ftp);  
        
        dd('jaja');
        
        //test gfz mapper alterations
        $sourceDataset = SourceDataset::where('id', 122)->first();
        $mapper = new GfzMapper();
        
        $dataset = $mapper->map($sourceDataset);
        
        dd($dataset);
        
        // test get labs ids
        $client = new \GuzzleHttp\Client();
        $searchRequest = new PackageSearch();
        
        $searchRequest->rows = 1000;
        $searchRequest->query = 'type: lab';
        try {
            $response = $client->request($searchRequest->method, $searchRequest->endPoint, $searchRequest->getAsQueryArray());
        } catch (\Exception $e) {
            
        }
        
        $packageSearchResponse = new PackageSearchResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        
        dd($packageSearchResponse->getNameList());
        
        
        
        $content = json_decode($response->getBody(), true);
        dd($content);
        $results = $content['result']['results'];
        
        
        
        
        
        //test gfz mapper alterations
        $sourceDataset = SourceDataset::where('id', 122)->first();
        $mapper = new GfzMapper();
        
        $dataset = $mapper->map($sourceDataset);
        
        dd($dataset);
        
        
        //test new organization list ckan request
        $client = new \GuzzleHttp\Client();        
        $OrganizationListrequest = new OrganizationList();
        
        try {
            $response = $client->request($OrganizationListrequest->method,
                $OrganizationListrequest->endPoint,
                $OrganizationListrequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $organizationListResponse =  new OrganizationListResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        $organizations = $organizationListResponse->getOrganizations();
        
        dd($organizations);
        
        
        //test chaining
        $sourceDataset = SourceDataset::where('id', 1)->first();
        dd($sourceDataset->source_dataset_identifier->import->id);
        
        //$import = $sourceDataset->source_dataset_identifier->import->id;
        
        dd($import);
        
        
        dd($sourceDataset);
        
        
        
        // test update package to update existing package instead of creating one
        $client = new \GuzzleHttp\Client();
        
        $datasetCreate = DatasetCreate::where('id', 2)->first();
        
        $packageUpdateRequest = new PackageUpdate();
        $packageUpdateRequest->payload = $datasetCreate->dataset;
        
        //dd($packageUpdateRequest->getPayloadAsArray());
        
        try {
            $response = $client->request($packageUpdateRequest->method,
                $packageUpdateRequest->endPoint,
                $packageUpdateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        dd((string)$response->getBody());
        
        
        
        $client = new \GuzzleHttp\Client();
        
        $datasetCreate = DatasetCreate::where('id', 1)->first();
        
        $PackageCreateRequest = new PackageCreate();
        $PackageCreateRequest->payload = $datasetCreate->dataset;
        
        dd($PackageCreateRequest->getPayloadAsArray());
        
        try {
            $response = $client->request($PackageCreateRequest->method,
                $PackageCreateRequest->endPoint,
                $PackageCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        dd((string)$response->getBody());
        
        
        // test new check to see if id is already in ckan
        $client = new \GuzzleHttp\Client();
        
        $packageShowRequest = new PackageShow();
        $packageShowRequest->id = '6d5f0701af4e33dd009affe3ac3c1257';
        
        try {
            $response = $client->request(
                $packageShowRequest->method,
                $packageShowRequest->endPoint,
                $packageShowRequest->getPayloadAsArray()
                );
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        $packageShowResponse = new PackageShowResponse(json_decode($response->getBody(), true), $response->getStatusCode());
        dd($packageShowResponse->packageExists());
        
        
        
        
        $content = json_decode($response->getBody(), true);
        $statusCode = $response->getStatusCode();
        
        if($statusCode == 404) {
            if(isset($content['error']['__type'])) {
                if($content['error']['__type'] == 'Not Found Error') {
                    dd('jaja');
                }                
            }
        }
        
        
        //dd($response->getStatusCode());        
        dd($content);
        
        
        // test insert ckan call
        $client = new \GuzzleHttp\Client();
        
        $datasetCreate = DatasetCreate::where('id', 1)->first();
                        
        $PackageCreateRequest = new PackageCreate();
        $PackageCreateRequest->payload = $datasetCreate->dataset;
        
        dd($PackageCreateRequest->getPayloadAsArray());
        
        try {
            $response = $client->request($PackageCreateRequest->method,
                $PackageCreateRequest->endPoint,
                $PackageCreateRequest->getPayloadAsArray());
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        
        dd((string)$response->getBody());
        dd($PackageCreateRequest);
        dd('jaja');
        
        $sourceData = SourceDataset::where('id', 1)->first();
        
        $mapper = new GfzMapper();
        $dataset = $mapper->map($sourceData);
        
        $datasetCreate = DatasetCreate::create([
            'dataset_type' => 'rockphysics',
            'dataset' => (array)$dataset,
            'source_dataset_id' => $sourceData->id
        ]);
                
        //dd($dataset);
        dd('jaja');
        
        
        
        $xml = simplexml_load_string($sourceData->source_dataset);
        
        
        $xml->registerXPathNamespace('oai', 'http://www.openarchives.org/OAI/2.0/');
        /*
        $xml->registerXPathNamespace('oai-dc', 'http://www.openarchives.org/OAI/2.0/oai_dc/');
        $xml->registerXPathNamespace('dc', 'http://purl.org/dc/elements/1.1/');
        */
        
        $xml->registerXPathNamespace('gmd', 'http://www.isotc211.org/2005/gmd');
        $xml->registerXPathNamespace('gco', 'http://www.isotc211.org/2005/gco');
        //$xml->registerXPathNamespace('xsi', 'http://www.w3.org/2001/XMLSchema-instance');
        //$xml->registerXPathNamespace('xlink', 'http://www.w3.org/1999/xlink');
        
        
        
        //$test = $xml->xpath('PMH[1]/ListRecords[1]/record/metadata/gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString/node()');        
        //$test = $xml->xpath('OAI-PMH/GetRecord/record/metadata/gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString/node()');
        //$test = $xml->xpath('PMH[1]/ListRecords[1]/record/metadata');
        //$test = $xml->xpath('GetRecord');
        
        
        //title
        $test = $xml->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata/gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString/node()');
        //dd((string)$test[0]);
        
        //url/source
        $test = $xml->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata[1]/gmd:MD_Metadata[1]/gmd:distributionInfo[1]/gmd:MD_Distribution[1]/gmd:transferOptions[1]/gmd:MD_DigitalTransferOptions[1]/gmd:onLine[1]/gmd:CI_OnlineResource[1]/gmd:linkage[1]/gmd:URL[1]/node()[1]');
        //dd((string)$test[0]);
        
        //doi
        $test = $xml->xpath('/oai:OAI-PMH/oai:GetRecord/oai:record/oai:metadata[1]/gmd:MD_Metadata/gmd:fileIdentifier/gco:CharacterString/node()');
        dd((string)$test[0]);
        
        
        //$test = $xml->xpath('//gmd:MD_Metadata/gmd:identificationInfo/gmd:MD_DataIdentification/gmd:citation/gmd:CI_Citation/gmd:title/gco:CharacterString/node()');
        //dd((string)$test[0]);
        
        $test = 'jaja';
        
        
        dd($test);
        
        /*
        $import = Import::where('id',1)->first();
        $importer = $import->importer;
        
        dd($importer->options['endpoint'], $importer->options['metadataPrefix'], $importer->options['setDefinition']);
        
        
        $importer = Importer::where('id', 3)->first();
        
        $options = $importer->data_repository->name;
        dd($options);
        
        
        $endPoint = Endpoint::build('https://doidb.wdc-terra.org/oaip/oai');
        //$endPoint = Endpoint::build('https://public.yoda.uu.nl/oai/oai');
        
        //$results = $endPoint->identify();
        
        //test get IdentifierList
        
        $results = $endPoint->listIdentifiers('iso19139', null, null, '~P3E9c3ViamVjdCUzQSUyMm11bHRpLXNjYWxlK2xhYm9yYXRvcmllcyUyMg');
        
        //dd($results->getTotalRecordCount());
        
        foreach($results as $item) {
            dd((string)$item->identifier);
            var_dump($item);
        }
        
        return dd($results);
        
        */
        
        //test get single record
        $endPoint = Endpoint::build('https://doidb.wdc-terra.org/oaip/oai');
        $results = $endPoint->getRecord('oai:doidb.wdc-terra.org:6336', 'iso19139');
        //$nameSpaces = $results->getNamespaces(true);
        //return dd($nameSpaces);
        
        //dd($results->asXML());
        
        $xmlString = $results->asXML();
        //dd($xmlString);
        
        $testXml = simplexml_load_string($xmlString);
        
        dd($testXml);
        
        
        $node = $results->GetRecord->record->metadata->children("http://www.isotc211.org/2005/gmd");
        
        
        return dd($node);
    }
}
