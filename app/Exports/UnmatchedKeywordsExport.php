<?php

namespace App\Exports;

use App\Models\MappingLog;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Ckan\Request\PackageSearch;

class UnmatchedKeywordsExport implements FromCollection, WithHeadings, WithMapping
{   
    
    public function __construct()
    {

    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
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
        
        $split = [];
        foreach ($keywords as $key => $value) {
            $extended = [];
            $extended['name'] = $key;
            $extended['count'] = $value;
            $split[] = $extended;
        }        
            
        $collection = collect($split);
        
        return $collection;
    }
    
    public function headings(): array
    {
        return [
            'keyword',
            'count'
        ];
    }
    
    public function map($keywords): array
    {
        return [
            $keywords['name'],
            $keywords['count']
        ];
    }

}
