<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('remove-dataset');
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
                $searchRequest->query = 'maintainer:' . $datasetSource;
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
        $deletes = DatasetDelete::all();
        
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
        $sourceDatasetidentifiers = SourceDatasetIdentifier::where('import_id', $importId)->get();
        
        return view('importer-import-flow', ['sourceDatasetIdentifiers' => $sourceDatasetidentifiers]);
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
        $imports = Import::all();
        
        return view('imports', ['imports' => $imports]);
    }
    
    public function sourceDatasetIdentifiers()
    {
        $identifiers = SourceDatasetIdentifier::all();
        
        return view('source-dataset-identifiers', ['identifiers' => $identifiers]);
    }
    
    public function sourceDatasets()
    {
        $sourceDatasets = SourceDataset::all();
        
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
        $createActions = DatasetCreate::all();
        
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
        //test chaining
        $sourceDataset = SourceDataset::where('id', 1)->first();
        dd($sourceDataset->source_dataset_identifier->import->id);
        
        //$import = $sourceDataset->source_dataset_identifier->import->id;
        
        dd($import);
        
        
        dd($sourceDataset);
        
        
        
        
        //test gfz mapper alterations
        $sourceDataset = SourceDataset::where('id', 1)->first();        
        $mapper = new GfzMapper();
        
        $dataset = $mapper->map($sourceDataset);
        
        dd($dataset);
        
        
        
        
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
