<?php

namespace App\Http\Controllers;

use App\Ckan\Request\PackageSearch;
use App\Response\ErrorResponse;
use App\Response\RockPhysicsResponse;
use Illuminate\Http\Request;

class RockPhysicsController extends Controller
{
    private $queryMappings = [
        'tags' => 'tags',
        'title' => 'title',
        'authorName' => 'msl_author_name_text',
        'labName' => 'msl_lab_name_text',
    ];
    
    public function index(Request $request) {
        $action = 'action/package_search';
        $endpoint = config('ckan.ckan_api_url') . $action;

        $client = new \GuzzleHttp\Client();

        $searchRequest = new PackageSearch();
        
        
        
        $searchRequest->setbyRequest($request, $this->buildQuery($request));
        $searchRequest->filterQuery = 'type:rockphysics';

        //dd($searchRequest->getAsQueryArray());

        try {
            $response = $client->request('GET', $endpoint, $searchRequest->getAsQueryArray());
        } catch (\Exception $e) {
            $errorResponse = new ErrorResponse();
            $errorResponse->message = 'Malformed request to CKAN.';
            return $errorResponse->getAsLaravelResponse();
        }

        //Check if response is ok
        if($response->getStatusCode() !== 200) {
            $errorResponse = new ErrorResponse();
            $errorResponse->message = 'Error received from CKAN api.';
            return $errorResponse->getAsLaravelResponse();
        }

        //build api response object
        $rockPhysicsResponse = new RockPhysicsResponse();
        $rockPhysicsResponse->setByCkanResponse($response);

        //return response object
        return $rockPhysicsResponse->getAsLaravelResponse();
    }
    
    
    private function buildQuery(Request $request)
    {
        $queryParts = [];
        
        foreach ($this->queryMappings as $key => $value)
        {
            if($request->filled($key)) {
                $queryParts[] = $value . ':' . $request->get($key);
            }
        }
        
        if(count($queryParts) > 0) {
            if($request->filled('query')) {
                $queryParts[] = $request->get('query');
            }
        }
        
        if(count($queryParts) > 0) {
            return implode(' AND ', $queryParts);
        }                
        
        return '';
    }
}
