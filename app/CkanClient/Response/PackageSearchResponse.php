<?php
namespace App\CkanClient\Response;

class PackageSearchResponse extends BaseResponse
{
    

    public function __construct($body, $responseCode) {
        parent::__construct($body, $responseCode);
    }

    public function getTotalResultsCount()
    {
        return $this->responseBody['result']['count'];
    }

    public function getResults()
    {
        return $this->responseBody['result']['results'];
    }

    public function getFacets()
    {
        return $this->responseBody['result']['search_facets'];
    }
}