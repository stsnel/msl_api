<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Ckan\Request\PackageSearch;
use App\Mappers\Helpers\KeywordHelper;

class AbstractMatchingExport implements FromCollection, WithHeadings, WithMapping
{   
    public $repositoryId;
    
    public function __construct($repositoryId)
    {
        $this->repositoryId = $repositoryId;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $client = new \GuzzleHttp\Client();
        
        $datasetSource = $this->repositoryId;
        
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
        
        $keywordHelper = new KeywordHelper();
        
        $data = [];
        foreach ($results as $result) {
            $item = [];
            $item['identifier'] = $result['msl_doi'];
            $item['abstract'] = $result['notes'];    
            $item['title'] = $result['title'];
            $keywords = $keywordHelper->extractFromText($item['abstract'] . ' ' . $item['title']);
            $items = [];
            
            foreach ($keywords as $keyword) {
                $items[] = $keyword->getFullPath('>', true);
            }
            
            $item['keywords'] = implode(PHP_EOL, $items);
            
            $data[] = $item;
        }
        
        $collection = collect($data);
        
        return $collection;
    }
    
    public function headings(): array
    {
        return [
            'identifier',
            'title',
            'abstract',
            'keywords'
        ];
    }
    
    public function map($keywords): array
    {
        return [
            $keywords['identifier'],
            $keywords['title'],
            $keywords['abstract'],
            $keywords['keywords']
        ];
    }

}
