<?php

namespace App\Http\Controllers;

use App\Ckan\Request\PackageSearch;
use App\Response\ErrorResponse;
use App\Response\RockPhysicsResponse;
use Illuminate\Http\Request;

class RockPhysicsController extends Controller
{

    public function index(Request $request) {
        $action = 'action/package_search';
        $endpoint = config('ckan.ckan_api_url') . $action;

        $client = new \GuzzleHttp\Client();

        $searchRequest = new PackageSearch();
        $searchRequest->setbyRequest($request);
        $searchRequest->filterQuery = 'type:rockphysics';

        $identifier = $request->get('identifier');

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
}
